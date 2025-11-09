<?php
require_once '../includes/session-init.php';

$cartItemCount = 0;
$cartTotalAmount = 0.0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/items.css">
    <link rel="stylesheet" href="../css/button.css">
    <title>TawTaw/home-l</title>
</head>

<body>
    <?php include '../includes/header.php'; ?>
    <div class="items">
        <h2 class="section"><span>Items &nbsp;</span>in the cart</h2>
        <hr class="hr">
        <?php
        include '../php/cart-products.php';
        $cartItemLabel = $cartItemCount === 1 ? 'item' : 'items';
        $formattedTotal = number_format($cartTotalAmount, 3);
        $isCartEmpty = $cartItemCount === 0;
        ?>
        <div class="container">
            <div class="button-holder" id="cart-buttons">
                <button class="btx-blue" id="cart-summary"
                    data-default-count="<?php echo htmlspecialchars($cartItemCount); ?>"
                    data-default-total="<?php echo htmlspecialchars($formattedTotal); ?>" <?php echo $isCartEmpty ? ' disabled' : ''; ?>>
                    (<span id="selected-count"><?php echo htmlspecialchars($cartItemCount); ?></span>
                    <span id="selected-label"><?php echo htmlspecialchars($cartItemLabel); ?></span>) :
                    <span id="selected-total"><?php echo htmlspecialchars($formattedTotal); ?></span> TND
                </button>
                <button class="btx-red" id="checkout-button" type="button" <?php echo $isCartEmpty ? ' disabled' : ''; ?>>Check out</button>
            </div>
        </div>

    </div>
    <?php include '../includes/footer.php'; ?>
    <?php include '../includes/scripts.php'; ?>
</body>

</html>