<?php
require_once '../includes/session-init.php';
require_once '../includes/flash.php';
$flashMessages = get_flash_messages();
if (empty($_SESSION['payment_success'])) {
   if ($isLoggedIn) {
      header('Location: index.php');
   } else {
      header('Location: login.php');
   }
   exit;
}

unset($_SESSION['payment_success']);
unset($_SESSION['checkout_items']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="../css/form.css">
   <link rel="stylesheet" href="../css/button.css">
   <title>TawTaw/Payment Success</title>
</head>

<body class="login-page">
   <header>
      <h1>TawTaw Store</h1>
      <div class="line"></div>
   </header>
   <div class="container">
      <div class="glassy-card" id="success">
         <div id="welcome">
            <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
               <path fill="#31C1E1" fill-rule="evenodd"
                  d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10m-1.177-7.86l-2.765-2.767L7 12.431l3.119 3.121a1 1 0 0 0 1.414 0l5.952-5.95l-1.062-1.062z" />
            </svg>
            <h1>Success</h1>
            <p>Order Confirmed</p>
         </div>
         <button class="btx-blue-reverse" onclick="window.location.href='index.php'">Done</button>
      </div>
   </div>
   <footer>
      <div class="line"></div>
      <p>© 2025 [TawTaw Store]. All rights reserved.</p>
   </footer>
</body>

</html>