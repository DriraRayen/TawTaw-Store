<?php
require_once '../includes/session-init.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/items.css">
    <link rel="stylesheet" href="../css/button.css">
    <title>TawTaw/Favourites</title>
</head>

<body>
    <?php include '../includes/header.php'; ?>
    <div class="items">
        <h2 class="section">Favourites <span>!</span></h2>
        <hr class="hr">
        <?php
        // Include the PHP file that fetches and displays the user's favourite products
        include '../php/favourites-products.php';
        ?>
    </div>
    <?php include '../includes/footer.php'; ?>
    <?php include '../includes/scripts.php'; ?>

</body>

</html>