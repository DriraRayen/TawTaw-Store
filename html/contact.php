<?php
require_once '../includes/session-init.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="stylesheet" href="../css/style.css">
   <link rel="stylesheet" href="../css/contact.css">
   <link rel="stylesheet" href="../css/button.css">
   <title>TawTaw/Contact</title>
</head>

<body>
   <?php include '../includes/header.php'; ?>
   <div class="contact">
      <h1 class="section"><span>Contact </span> our team <span>!</span></h1>
      <hr class="hr">
      <form action="https://api.web3forms.com/submit" method="POST">
         <input type="hidden" name="access_key" value="ae80fd77-91dc-45f7-9f55-5474379144ac">
         <div class="container">
            <div>
               <input type="text" name="first_name" placeholder="First Name" required>
               <input type="text" name="last_name" placeholder="Last Name" required>
            </div>
            <div>
               <input type="email" name="email" placeholder="Email.address@domain.com" required>
               <input type="number" name="phone" placeholder="Phone Number" required>
            </div>
            <textarea name="message" placeholder="Leave us a message.." required></textarea>
         </div>
         <div class="button-holder">
            <button class="btx-red" type="submit">Send</button>
         </div>
      </form>
   </div>
   <?php include '../includes/footer.php'; ?>
   <?php include '../includes/scripts.php'; ?>
</body>

</html>