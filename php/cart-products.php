<?php

require_once __DIR__ . '/cart-helpers.php';

$cartItemCount = 0;
$cartTotalAmount = 0.0;

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo '<p class="Error-php">Please log in to view your cart.</p>';
    exit;
}

[$cartItems, $cartSummary] = (function (int $userId) {
    $items = fetchUserCartItems($userId);
    $summary = summarizeCartItems($items);
    return [$items, $summary];
})((int) $_SESSION['user_id']);

$cartItemCount = $cartSummary['count'];
$cartTotalAmount = $cartSummary['total'];

if (!empty($cartItems)) {
    foreach ($cartItems as $product) {
        $isFavourite = (bool) $product['is_favourite'];
        $variationId = (int) $product['variation_id'];
        $unitPrice = (float) $product['price'];
        $cartQuantity = (int) $product['cart_quantity'];
        $stockQuantity = (int) $product['stock_quantity'];

        $checkboxAttributes = sprintf(
            'class="select-pay" data-variation="%d" data-price="%s" data-quantity="%d" checked',
            $variationId,
            htmlspecialchars(number_format($unitPrice, 3, '.', '')),
            $cartQuantity
        );

        echo '<div class="container cart-item" data-variation="' . htmlspecialchars($variationId) . '" data-price="' . htmlspecialchars(number_format($unitPrice, 3, '.', '')) . '" data-quantity="' . htmlspecialchars($cartQuantity) . '">
            <div class="product-image"><img src="../' . htmlspecialchars($product['image_url']) . '" alt="product-image"></div>
            <div class="cart-details">
                <div class="button-holder">
                    <h3>' . htmlspecialchars($product['product_name']) . '</h3>
<img 
                        class="heart" 
                        src="../Images/Icons/' . ($isFavourite ? 'heart_on.svg' : 'heart.svg') . '" 
                        onclick="toggleFavourite(this, ' . htmlspecialchars($product['variation_id']) . ')" 
                        data-favourite="' . ($isFavourite ? 'true' : 'false') . '"
                    >                </div>
                <div>
                    <p class="cart-details-details" id="stock">' . ($product['stock_quantity'] > 0 ? 'In Stock' : '<span style="color: red;">Out of Stock</span>') . '</p>
                    <p class="cart-details-details"><span>Color :</span> ' . htmlspecialchars($product['color']) . '</p>
                    <p class="cart-details-details"><span>Quantity :</span> <span class="cart-quantity-display" data-variation="' . htmlspecialchars($variationId) . '">' . htmlspecialchars($cartQuantity) . '</span></p>
                </div>
                <div class="button-holder">
                    <button class="btx-blue" id="product" onclick="window.location.href=\'../html/product.php?variation_id=' . htmlspecialchars($product['variation_id']) . '\'">More Details</button>
                    <button class="btx-red-reverse" onclick="deleteFromCart(' . htmlspecialchars($product['variation_id']) . ')">Delete</button>
                </div>
            </div>
            <div class="cart-options">
                <div class="button-holder">
                    <h3>Price</h3>
                    <input type="checkbox" ' . $checkboxAttributes . '>
                </div>
                <p><span>' . number_format($unitPrice, 3) . ' TND</span></p>
                <div>
                    <input type="number" class="cart-quantity-input" data-variation="' . htmlspecialchars($variationId) . '" value="' . htmlspecialchars($cartQuantity) . '" min="1" max="' . htmlspecialchars($stockQuantity) . '">
                    <button class="btx-red-reverse buy-now" type="button" data-variation="' . htmlspecialchars($variationId) . '">Buy</button>
                </div>
            </div>
        </div>';
    }
} else {
    echo '<p>Your cart is empty.</p>';
}
?>