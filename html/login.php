<?php
require_once '../includes/flash.php';
$flashMessages = get_flash_messages();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/button.css">
    <link rel="stylesheet" href="../css/notifications.css">
    <title>TawTaw/login</title>
</head>

<body class="login-page">
    <header>
        <h1>TawTaw Store</h1>
        <div class="line"></div>
    </header>
    <div class="container">
        <div class="glassy-card">
            <h1>Log in</h1>
            <p>Empowering the Future with Technology</p>
            <form method="POST" action="../php/verify-login.php">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <button type="submit" class="btx-red">Sign in</button>


                <p id="new">New to TawTaw &nbsp; <a href="signup.php"><span>Join Now!</span></a></p>
            </form>
        </div>
    </div>
    <footer>
        <div class="line"></div>
        <p>© 2025 [TawTaw Store]. All rights reserved."</p>
    </footer>
    <script src="../JS/notifications.js"></script>
    <script src="../JS/control-login.js"></script>
    <script>
        (function () {
            const messages = <?php echo json_encode($flashMessages, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;
            if (Array.isArray(messages) && typeof window.showToast === "function") {
                messages.forEach((msg) => {
                    if (!msg || typeof msg.message !== "string") {
                        return;
                    }
                    const type = typeof msg.type === "string" ? msg.type : "info";
                    window.showToast(msg.message, { type });
                });
            }
        })();
    </script>
</body>

</html>