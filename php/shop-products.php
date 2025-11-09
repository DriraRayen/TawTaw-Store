<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'connexion.php';

// Resolve category filter preference
$definedVars = get_defined_vars();
$categoryFilter = null;
$hasCategoryVar = array_key_exists('category', $definedVars);

if ($hasCategoryVar) {
    $categoryFilter = $category;
} elseif (isset($_GET['category'])) {
    $categoryFilter = $_GET['category'];
}

if (is_string($categoryFilter)) {
    $categoryFilter = trim($categoryFilter);
}

if ($categoryFilter === '' || $categoryFilter === null || $categoryFilter === false) {
    $categoryFilter = null;
}

// Build the base SQL query to show a single representative variation per product
$sql = "
SELECT 
    p.product_id,
    pv.variation_id,
    p.name AS product_name,
    p.company,
    p.description,
    p.category,
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

if ($categoryFilter) {
    $sql .= " AND LOWER(p.category) = LOWER(?)";
}

$sql .= " ORDER BY p.name ASC";

if ($stmt = $conn->prepare($sql)) {
    if ($categoryFilter) {
        $stmt->bind_param('s', $categoryFilter);
    }
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = false;
}

if ($result && $result->num_rows > 0) {
    while ($product = $result->fetch_assoc()) {

        $isFavourite = false;
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $favSql = "SELECT * FROM favourates WHERE user_id = ? AND variation_id = ?";
            $favStmt = $conn->prepare($favSql);
            $favStmt->bind_param('ii', $user_id, $product['variation_id']);
            $favStmt->execute();
            $favResult = $favStmt->get_result();
            $isFavourite = $favResult->num_rows > 0;
            $favStmt->close();
        }

        echo '<div class="container"
    data-category="' . htmlspecialchars($product['category']) . '"
    data-company="' . htmlspecialchars($product['company']) . '"
    data-price="' . htmlspecialchars($product['price']) . '"
    data-stock="' . htmlspecialchars($product['quantity']) . '"
    data-name="' . htmlspecialchars($product['product_name']) . '"
    data-description="' . htmlspecialchars($product['description']) . '"
    data-product-id="' . htmlspecialchars($product['product_id']) . '">
       <div class="container" id="right-shop-details">
           <div class="product-image"><img src="../' . htmlspecialchars($product['image_url']) . '" alt="product-image"></div>
           <div class="middle-card">
               <div class="button-holder">
                   <h3>' . htmlspecialchars($product['product_name']) . '</h3>
                   <img 
                       class="heart" 
                       src="../Images/Icons/' . ($isFavourite ? 'heart_on.svg' : 'heart.svg') . '" 
                       onclick="toggleFavourite(this, ' . htmlspecialchars($product['variation_id']) . ')" 
                       data-favourite="' . ($isFavourite ? 'true' : 'false') . '"
                   >
               </div>
               <div>
                   <p class="cart-details-details">' . htmlspecialchars($product['description']) . '</p>
               </div>
               <div class="button-holder">
                   <button class="btx-red" id="product" onclick="window.location.href=\'../html/product.php?variation_id=' . htmlspecialchars($product['variation_id']) . '\'">More</button>   
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
           <div class="right-card">
               <div>
                   <h3>' . number_format($product['price'], 2) . ' TND</h3>';
        if ($product['quantity'] > 0) {
            echo '<p>In stock</p>';
        } else {
            echo '<p>Out of stock</p>';
        }
        echo '</div>
               <div>
                   <button class="btx-blue" onclick="addToCart(' . htmlspecialchars($product['variation_id']) . ')" ' . ($product['quantity'] > 0 ? '' : 'disabled') . '>Add to Cart</button>   
                   <button class="btx-red-reverse quick-buy" data-variation="' . htmlspecialchars($product['variation_id']) . '" ' . ($product['quantity'] > 0 ? '' : 'disabled') . '>Buy</button>
               </div>
           </div>
       </div>
   </div>';

    }
} else {
    echo '<div class="container"><p>No products found.</p></div>';
}

$stmt && $stmt->close();
$conn->close();
?>