<?php

include '../php/connexion.php';

$productDetailsData = [
    'about' => '',
    'cpu' => '',
    'display' => '',
    'availability_note' => '',
    'warranty' => '',
    'delivery_note' => '',
];
$productSpecificationsData = [];

if (!isset($_GET['variation_id'])) {
    echo '<p>Variation not found.</p>';
    exit;
}

$variation_id = intval($_GET['variation_id']);


$productSql = "SELECT product_id FROM product_variation WHERE variation_id = ?";
$productStmt = $conn->prepare($productSql);
$productStmt->bind_param('i', $variation_id);
$productStmt->execute();
$productResult = $productStmt->get_result();

if ($productResult->num_rows === 0) {
    echo '<p>Invalid variation selected.</p>';
    exit;
}

$productRow = $productResult->fetch_assoc();
$product_id = $productRow['product_id'];
$productStmt->close();

$sql = "
SELECT 
    pv.variation_id,
    pv.storage,
    pv.memory,
    pv.color,
    pv.price,
    pv.quantity,
    p.name AS product_name,
    p.company,
    p.category,
    p.description,
    pi.image_url
FROM product_variation pv
JOIN products p ON pv.product_id = p.product_id
LEFT JOIN product_images pi ON pv.variation_id = pi.variation_id
WHERE pv.product_id = ?
ORDER BY pv.variation_id, pi.image_url
";

$variationMap = [];
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $product_id);
$stmt->execute();
$result = $stmt->get_result();
$placeholderImage = 'Images/Products/placeholder.png';


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $variationId = (int) $row['variation_id'];

        if (!isset($variationMap[$variationId])) {
            $variationMap[$variationId] = [
                'variation_id' => $variationId,
                'storage' => $row['storage'],
                'memory' => $row['memory'],
                'color' => $row['color'],
                'price' => $row['price'],
                'quantity' => $row['quantity'],
                'product_name' => $row['product_name'],
                'company' => $row['company'],
                'category' => $row['category'],
                'description' => $row['description'],
                'is_favourite' => false,
                'images' => [],
            ];
        }

        $imagePath = trim((string) ($row['image_url'] ?? ''));
        if ($imagePath !== '') {
            $variationMap[$variationId]['images'][] = $imagePath;
        }
    }
} else {
    echo '<p>No variations found for this product.</p>';
    exit;
}

$stmt->close();

$variations = array_values($variationMap);

foreach ($variations as &$variation) {
    $variation['images'] = array_values(array_unique($variation['images']));
    if (empty($variation['images'])) {
        $variation['images'][] = $placeholderImage;
    }
}
unset($variation);

$detailsSql = "SELECT about, cpu, display, availability_note, warranty, delivery_note FROM product_details WHERE product_id = ? LIMIT 1";
$detailsStmt = $conn->prepare($detailsSql);
if ($detailsStmt) {
    $detailsStmt->bind_param('i', $product_id);
    if ($detailsStmt->execute()) {
        $detailsResult = $detailsStmt->get_result();
        if ($detailsRow = $detailsResult->fetch_assoc()) {
            foreach ($productDetailsData as $key => $defaultValue) {
                $productDetailsData[$key] = isset($detailsRow[$key]) ? (string) ($detailsRow[$key] ?? '') : $defaultValue;
            }
        }
    }
    $detailsStmt->close();
}

$specSql = "SELECT label, value FROM product_specifications WHERE product_id = ? ORDER BY display_order, label";
$specStmt = $conn->prepare($specSql);
if ($specStmt) {
    $specStmt->bind_param('i', $product_id);
    if ($specStmt->execute()) {
        $specResult = $specStmt->get_result();
        while ($specRow = $specResult->fetch_assoc()) {
            $label = isset($specRow['label']) ? trim((string) $specRow['label']) : '';
            $value = isset($specRow['value']) ? trim((string) $specRow['value']) : '';
            if ($label !== '' && $value !== '') {
                $productSpecificationsData[] = [
                    'label' => $label,
                    'value' => $value,
                ];
            }
        }
    }
    $specStmt->close();
}


$favouritesMap = [];
if (!empty($variations) && isset($_SESSION['user_id'])) {
    $userId = (int) $_SESSION['user_id'];
    $favSql = "SELECT variation_id FROM favourates WHERE user_id = ?";
    $favStmt = $conn->prepare($favSql);
    if ($favStmt) {
        $favStmt->bind_param('i', $userId);
        if ($favStmt->execute()) {
            $favResult = $favStmt->get_result();
            while ($favRow = $favResult->fetch_assoc()) {
                $favVariationId = isset($favRow['variation_id']) ? (int) $favRow['variation_id'] : null;
                if ($favVariationId) {
                    $favouritesMap[$favVariationId] = true;
                }
            }
        }
        $favStmt->close();
    }
}

foreach ($variations as &$variation) {
    $variationId = (int) $variation['variation_id'];
    $variation['is_favourite'] = isset($favouritesMap[$variationId]);
}
unset($variation);

$conn->close();


$uniqueStorageOptions = array_unique(array_column($variations, 'storage'));
$uniqueColorOptions = array_unique(array_column($variations, 'color'));
echo '<script>window.variations = ' . json_encode($variations, JSON_UNESCAPED_SLASHES) . ';</script>';
echo '<script>window.productDetails = ' . json_encode($productDetailsData, JSON_UNESCAPED_SLASHES) . ';</script>';
echo '<script>window.productSpecifications = ' . json_encode($productSpecificationsData, JSON_UNESCAPED_SLASHES) . ';</script>';

function generateQuantityOptions($quantity)
{
    $quantity = max(0, (int) $quantity);

    if ($quantity === 0) {
        return '<option value="0" disabled selected>Out of stock</option>';
    }
    $options = '';
    for ($i = 1; $i <= $quantity; $i++) {
        $options .= '<option value="' . $i . '">Quantity: ' . $i . '</option>';
    }
    return $options;
}


$selectedVariation = null;
foreach ($variations as $variation) {
    if ($variation['variation_id'] == $variation_id) {
        $selectedVariation = $variation;
        break;
    }
}

if (!$selectedVariation) {
    $selectedVariation = $variations[0];
}

echo '<script>window.initialVariationId = ' . (int) $selectedVariation['variation_id'] . ';</script>';


if (!empty($variations)) {
    $product = $selectedVariation;
    $currentImages = $product['images'];
    $primaryImage = $currentImages[0] ?? $placeholderImage;
    $heartIcon = $product['is_favourite'] ? '../Images/Icons/heart_on.svg' : '../Images/Icons/heart.svg';
    echo '
<div class="main-card">
    <h3 class="chemin">Home >> Shop >> ' . htmlspecialchars($product['company']) . ' >> 
        <span>' . htmlspecialchars($product['product_name']) . '</span>
    </h3>
    <div class="container">
        <div class="left-product">
            <div class="image-container">
                <img src="../' . htmlspecialchars($primaryImage) . '" alt="Product Image" id="main-img">
            </div>
            <div class="gallery-strip" role="group" aria-label="Product image gallery">
                <button class="gallery-nav" id="gallery-prev" type="button" aria-label="Previous image">
                    <svg width="29" height="36" viewBox="0 0 29 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2.14368 21.241C-0.278165 19.6631 -0.278166 16.1162 2.14368 14.5383L22.7164 1.13401C25.3772 -0.599632 28.9 1.30967 28.9 4.4854V31.2939C28.9 34.4696 25.3772 36.3789 22.7164 34.6453L2.14368 21.241Z"
                            fill="#FF2330" /> 
                    </svg>
                </button>
                <div class="thumbnail-track" id="thumbnail-track" role="list">
';

    foreach ($currentImages as $index => $imagePath) {
        echo '                    <button class="image-holder thumbnail-button' . ($index === 0 ? ' active' : '') . '" type="button" data-index="' . $index . '" role="listitem" aria-label="Show image ' . ($index + 1) . '">
                        <img src="../' . htmlspecialchars($imagePath) . '" alt="Product Image ' . ($index + 1) . '" class="side-img">
                    </button>
';
    }

    echo '                </div>
                <button class="gallery-nav" id="gallery-next" type="button" aria-label="Next image">
                    <svg width="30" height="36" viewBox="0 0 30 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M27.3896 14.5383C29.8115 16.1162 29.8115 19.6631 27.3896 21.241L6.81694 34.6453C4.15617 36.3789 0.633326 34.4696 0.633326 31.2939V4.4854C0.633326 1.30967 4.15617 -0.599634 6.81694 1.13401L27.3896 14.5383Z" fill="#FF2330"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div class="center-product">
            <div class="top">
                <div class="button-holder">
                    <h2>' . htmlspecialchars($product['product_name']) . '</h2>
                    <img class="heart" src="' . htmlspecialchars($heartIcon, ENT_QUOTES) . '" alt="Toggle favourite"
                        data-favourite="' . ($product['is_favourite'] ? 'true' : 'false') . '" data-variation-id="' . (int) $product['variation_id'] . '"
                        aria-pressed="' . ($product['is_favourite'] ? 'true' : 'false') . '">
                </div>
                <p class="product-price" >' . number_format($product['price'], 2) . ' TND</p>
                <p>' . htmlspecialchars($product['description']) . '</p>
                <div class="button-holder">';
    $nonEmptyStorageOptions = array_filter($uniqueStorageOptions, function ($s) {
        return trim($s) !== '';
    });
    if (!empty($nonEmptyStorageOptions)) {

        foreach ($nonEmptyStorageOptions as $storage) {
            echo '<button class="choice" type="button" data-storage="' . htmlspecialchars($storage, ENT_QUOTES) . '">' . htmlspecialchars($storage) . '</button>';
        }
        echo '</div>
                        <hr id="hr">
                        <div class="button-holder">';
    }
    foreach ($uniqueColorOptions as $color) {
        echo '<button class="choice" type="button" data-color="' . htmlspecialchars($color, ENT_QUOTES) . '">' . htmlspecialchars($color) . '</button>';
    }

    echo '</div>
            </div>
            <div class="bottom">
                <div class="button-holder">
                    <p><span>Hot </span>right <span>now!</span></p>
                    <p><span>Highly </span>Rated</p>
                    <p><span>Low </span>Returns</p>
                </div>
                <div class="button-holder">
                    <button class="btx-red">Rate Now</button>
                    <div class="rating">';

    for ($i = 0; $i < 5; $i++) {
        echo '<svg width="25" height="23" viewBox="0 0 25 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.5 0L15.3064 8.63729H24.3882L17.0409 13.9754L19.8473 22.6127L12.5 17.2746L5.15268 22.6127L7.95911 13.9754L0.611794 8.63729H9.69357L12.5 0Z" fill="#FF2330" />
                              </svg>';
    }

    echo '<p>10</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-product">
            <div class="top">
                <h2 class="product-price" >' . number_format($product['price'], 2) . ' TND</h2>
                <p><span>Free </span> Shipping in <span> Tunisia</span></p>
                <p>Delivery on Tuesday, November 26</p>
                <p><span>Only ' . $product['quantity'] . '</span> left in stock - order <span>soon.</span></p>
                <p>Gift receipt included for easy returns</p>
            </div>
            <div class="bottom">
                <select name="quantity" id="quantity">
                    ' . generateQuantityOptions($product['quantity']) . '
                </select>
                <button class="btx-red" id="buy">Buy Now</button>
                <button class="btx-red" id="add-to-cart" ' . ($product['quantity'] > 0 ? '' : 'disabled') . '>Add To Cart</button>
            </div>
        </div>
    </div>
</div>
';
}
?>