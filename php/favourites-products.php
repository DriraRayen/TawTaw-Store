<?php
include 'connexion.php';

if (!isset($_SESSION['user_id'])) {
    echo '<p>Please log in to view your favourites.</p>';
    exit;
}

$user_id = $_SESSION['user_id'];


$sql = "
SELECT 
    p.product_id,
    p.name AS product_name,
    p.company,
    p.description,
    pv.variation_id,
    pv.price,
    pv.color,
    pv.quantity,
    pi.image_url
FROM favourates f
JOIN product_variation pv ON f.variation_id = pv.variation_id
JOIN products p ON pv.product_id = p.product_id
LEFT JOIN product_images pi ON pv.variation_id = pi.variation_id
WHERE f.user_id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
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

        echo '<div class="container favourite-card">';
        echo '<div class="product-image"><img src="../' . htmlspecialchars($product['image_url']) . '" alt="product-image"></div>';
        echo '<div class="middle-card">';
        echo '<div class="button-holder favourite-header">';
        echo '<h3>' . htmlspecialchars($product['product_name']) . '</h3>';
        echo '<img class="heart" src="../Images/Icons/' . ($isFavourite ? 'heart_on.svg' : 'heart.svg') . '" onclick="toggleFavourite(this, ' . htmlspecialchars($product['variation_id']) . ')" data-favourite="' . ($isFavourite ? 'true' : 'false') . '">';
        echo '</div>';
        echo '<div>';
        echo '<p class="cart-details-details">' . htmlspecialchars($product['description']) . '</p>';
        if (!empty($product['color'])) {
            echo '<p class="cart-details-details"><span>Color :</span> ' . htmlspecialchars($product['color']) . '</p>';
        }
        echo '</div>';
        echo '<div class="button-holder favourite-actions">';
        echo '<button class="btx-red" id="product" onclick="window.location.href=\'../html/product.php?variation_id=' . htmlspecialchars($product['variation_id']) . '\'">More</button>';
        echo '<div class="rating">';
        for ($i = 0; $i < 5; $i++) {
            echo '<svg width="25" height="23" viewBox="0 0 25 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.5 0L15.3064 8.63729H24.3882L17.0409 13.9754L19.8473 22.6127L12.5 17.2746L5.15268 22.6127L7.95911 13.9754L0.611794 8.63729H9.69357L12.5 0Z" fill="#FF2330" />
                  </svg>';
        }

        echo '<p>10</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '<div class="right-card">';
        echo '<div>';
        echo '<h3>' . number_format($product['price'], 2) . ' TND</h3>';

        if ($product['quantity'] > 0) {
            echo '<p>In stock</p>';
        } else {
            echo '<p style="color: red;">Out of stock</p>';
        }

        echo '</div>';
        echo '<div class="button-holder">';
        echo '<button class="btx-blue" onclick="addToCart(' . htmlspecialchars($product['variation_id']) . ')" ' . ($product['quantity'] > 0 ? '' : 'disabled') . '>Add to cart</button>';
        echo '<button class="btx-red-reverse quick-buy" data-variation="' . htmlspecialchars($product['variation_id']) . '" ' . ($product['quantity'] > 0 ? '' : 'disabled') . '>Buy</button>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<p>No favourites found.</p>';
}

$stmt->close();
$conn->close();
?>