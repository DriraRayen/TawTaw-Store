<?php
// Footer component - checks if user is logged in for conditional links
if (!isset($isLoggedIn)) {
   $isLoggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}
?>
<footer>
   <div>
      <h4>you can find us on</h4>
      <div><img src="../Images/Icons/facebook.png" class="pointer" alt="Facebook logo">
         <a>Facebook.com</a>
      </div>
      <div><img src="../Images/Icons/instagram.png" alt="Instagram logo" class="pointer">
         <a>Instagram.com</a>
      </div>
      <div><img src="../Images/Icons/mail.png" alt="email logo" class="pointer">
         <a>email@domaine.com</a>
      </div>
      <div><img src="../Images/Icons/telephone-call.png" alt="Number logo" class="pointer">
         <a>Number</a>
      </div>
      <div><img src="../Images/Icons/gps-navigation.png" alt="location logo" class="pointer">
         <a>Address of the store</a>
      </div>
   </div>
   <div class="gap-footer">
      <h4>Tawtaw</h4>
      <a href="index.php">home</a>
      <a href="shop.php">shop</a>
      <a href="contact.php">contact</a>
   </div>
   <div class="gap-footer">
      <h4>Categories</h4>
      <a href="shop.php?category=Desktop">Desktop</a>
      <a href="shop.php?category=Laptop">Laptop</a>
      <a href="shop.php?category=Smartphone">Smart phone</a>
      <a href="shop.php?category=SmartWatch">Smart watch</a>
      <a href="shop.php?category=Smarttv">Smart tv</a>
   </div>
</footer>