<?php
include 'connexion.php';

$category = isset($category) ? trim($category) : null;
if ($category === '') {
    $category = null;
}

$sql = "
SELECT 
    p.product_id,
    pv.variation_id,
    p.name AS product_name,
    p.company,
    p.description,
    pv.price,
    pv.color,
    pv.quantity,
    COALESCE(pi.image_url, 'Images/Products/placeholder.png') AS image_url
FROM products p
JOIN product_variation pv ON pv.variation_id = (
    SELECT pv_inner.variation_id
    FROM product_variation pv_inner
    WHERE pv_inner.product_id = p.product_id
    ORDER BY pv_inner.price ASC, pv_inner.variation_id ASC
    LIMIT 1
)
LEFT JOIN (
    SELECT variation_id, MIN(image_url) AS image_url
    FROM product_images
    GROUP BY variation_id
) pi ON pi.variation_id = pv.variation_id
WHERE 1 = 1";

if ($category) {
    $sql .= " AND LOWER(p.category) = LOWER(?)";
}

$sql .= " ORDER BY p.name ASC LIMIT 6";

$stmt = $conn->prepare($sql);
$result = false;

if ($stmt) {
    if ($category) {
        $stmt->bind_param('s', $category);
    }
    $stmt->execute();
    $result = $stmt->get_result();
}

if ($result && $result->num_rows > 0) {
    while ($product = $result->fetch_assoc()) {
        $imagePath = isset($product['image_url']) ? trim($product['image_url']) : '';
        if ($imagePath === '') {
            $imageSrc = '../Images/Products/placeholder.png';
        } elseif (preg_match('/^https?:\/\//i', $imagePath) || strpos($imagePath, '//') === 0) {
            $imageSrc = $imagePath;
        } else {
            $imageSrc = '../' . ltrim($imagePath, '/');
        }

        echo '<div class="product-card" onclick="window.location.href=\'product.php?variation_id=' . htmlspecialchars($product['variation_id']) . '\'" style="cursor: pointer;">
        <div class="product-card-image">';

        if (!empty($imageSrc)) {
            echo '<img src="' . htmlspecialchars($imageSrc) . '" alt="">';
        }

        echo '</div>
        <div class="product-card-summary">
            <h3>' . htmlspecialchars($product['company']) . ' || ' . htmlspecialchars($product['product_name']) . '</h3>';

        echo '<p>' . htmlspecialchars($product['description']) . '</p>
            <div class="button-holder">
                <p class="price">' . number_format($product['price'], 2) . ' TND</p>
                <button class="btx-add" onclick="event.stopPropagation(); addToCart(' . htmlspecialchars($product['variation_id']) . ')" ' . ($product['quantity'] > 0 ? '' : 'disabled') . '>Add to cart</button>
            </div>
        </div>
        </div>';
    }
} else {
    echo "No products found.";
}

if ($stmt) {
    $stmt->close();
}

$conn->close();
?>