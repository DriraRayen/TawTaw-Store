<?php require '../php/connexion.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/button.css">
    <title>User Data</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>

<body>
    <header>
        <h1>User Information</h1>
        <div class="line"></div>
    </header>
    <div class="container">
        <div class="glassy-card">
            <?php include '../php/fetch-users.php'; ?>
        </div>
    </div>
    <footer>
        <div class="line"></div>
        <p>© 2025 [TawTaw Store]. All rights reserved.</p>
    </footer>
</body>

</html>
<?php $conn->close(); ?>