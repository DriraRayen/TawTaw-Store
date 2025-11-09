<?php
// Common scripts - loads appropriate scripts based on login status
require_once __DIR__ . '/flash.php';

if (!isset($isLoggedIn)) {
   $isLoggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

$flashMessages = get_flash_messages();
?>
<!-- Inject login status for JavaScript -->
<script>
   const isUserLoggedIn = <?php echo $isLoggedIn ? 'true' : 'false'; ?>;
</script>
<script>
   window.appFlashMessages = <?php echo json_encode($flashMessages, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;
</script>
<!-- Common navigation and utilities -->
<script src="../JS/notifications.js"></script>
<script src="../JS/index.js"></script>
<!-- Cart and favourites management -->
<script src="../JS/cart-functions.js"></script>
<?php if (basename($_SERVER['PHP_SELF']) === 'cart.php'): ?>
   <!-- Cart page specific interactions -->
   <script src="../JS/cart-page.js"></script>
<?php endif; ?>
<?php if ($isLoggedIn): ?>
   <!-- Logout functionality (only for logged-in users) -->
   <script src="../JS/logout.js"></script>
<?php endif; ?>
<script>
   if (Array.isArray(window.appFlashMessages) && typeof window.showToast === "function") {
      window.appFlashMessages.forEach((msg) => {
         const type = msg && typeof msg.type === "string" ? msg.type : "info";
         const message = msg && typeof msg.message === "string" ? msg.message : "";
         if (message) {
            window.showToast(message, { type });
         }
      });
   }
</script>