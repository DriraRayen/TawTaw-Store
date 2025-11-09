<?php
require_once '../includes/session-init.php';
require_once '../php/cart-helpers.php';

if (!$isLoggedIn) {
   header('Location: login.php');
   exit;
}

$userId = (int) $_SESSION['user_id'];

// Capture selected variations from the cart page (GET) or the ongoing session.
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
   $itemsParam = $_GET['items'] ?? '';
   if (!empty($itemsParam)) {
      $selectedVariations = array_values(array_unique(array_filter(array_map('intval', explode(',', $itemsParam)))));
      if (!empty($selectedVariations)) {
         $_SESSION['checkout_items'] = $selectedVariations;
      }
   }
}

$selectedVariations = $_SESSION['checkout_items'] ?? [];
$selectedVariations = array_values(array_filter(array_map('intval', (array) $selectedVariations)));
$_SESSION['checkout_items'] = $selectedVariations;

if (empty($selectedVariations)) {
   header('Location: cart.php');
   exit;
}

$cartItems = fetchUserCartItems($userId, $selectedVariations);
$cartSummary = summarizeCartItems($cartItems);

if (empty($cartItems) || $cartSummary['count'] === 0) {
   unset($_SESSION['checkout_items']);
   header('Location: cart.php');
   exit;
}

$cartItemCount = $cartSummary['count'];
$cartTotalAmount = $cartSummary['total'];

$errors = [];
$firstName = '';
$lastName = '';
$address = '';
$city = '';
$phone = '';
$modeOfPayment = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $firstName = trim($_POST['first_name'] ?? '');
   $lastName = trim($_POST['last_name'] ?? '');
   $address = trim($_POST['address'] ?? '');
   $city = trim($_POST['city'] ?? '');
   $phone = trim($_POST['phone'] ?? '');
   $modeOfPayment = $_POST['mode-of-payment'] ?? '';

   if ($firstName === '') {
      $errors[] = 'First name is required.';
   }

   if ($lastName === '') {
      $errors[] = 'Last name is required.';
   }

   if ($address === '') {
      $errors[] = 'Address is required.';
   }

   if ($city === '') {
      $errors[] = 'City is required.';
   }

   if ($phone === '' || !preg_match('/^[0-9]{8,15}$/', $phone)) {
      $errors[] = 'Please provide a valid phone number.';
   }

   if ($modeOfPayment === '') {
      $errors[] = 'Please choose a payment method.';
   }

   if (empty($errors)) {
      $purchaseError = null;
      if (!completePurchase($userId, $cartItems, $purchaseError)) {
         $errors[] = $purchaseError ?? 'Unable to complete your order at this time. Please try again.';
      } else {
         $_SESSION['payment_success'] = true;
         unset($_SESSION['checkout_items']);
         header('Location: s-pay.php');
         exit;
      }
   }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="stylesheet" href="../css/style.css">
   <link rel="stylesheet" href="../css/button.css">
   <link rel="stylesheet" href="../css/pay.css">

   <title>TawTaw/Checkout</title>
</head>

<body>
   <?php include '../includes/header.php'; ?>
   <div class="container" id="check">
      <form class="glassy-card" method="POST" action="">
         <h1>Check Out Form</h1>
         <?php if (!empty($errors)): ?>
            <div class="error-list">
               <ul>
                  <?php foreach ($errors as $error): ?>
                     <li><?php echo htmlspecialchars($error); ?></li>
                  <?php endforeach; ?>
               </ul>
            </div>
         <?php endif; ?>
         <div class="container">
            <div class="input-holder">
               <h3>Fill Out Your Information </h3>
               <input type="text" name="first_name" placeholder="First Name"
                  value="<?php echo htmlspecialchars($firstName); ?>">
               <input type="text" name="last_name" placeholder="Last Name"
                  value="<?php echo htmlspecialchars($lastName); ?>">
               <input type="text" name="address" placeholder="Address" value="<?php echo htmlspecialchars($address); ?>">
               <input type="text" name="city" placeholder="City" value="<?php echo htmlspecialchars($city); ?>">
               <input type="text" name="phone" placeholder="Telephone Number"
                  value="<?php echo htmlspecialchars($phone); ?>">
            </div>
            <hr>
            <div class="input-holder">
               <h3>Order Confirmation</h3>
               <p>Number of items : <span><?php echo htmlspecialchars($cartItemCount); ?></span></p>
               <p>SumTotal : <span><?php echo htmlspecialchars(number_format($cartTotalAmount, 3)); ?> TND</span></p>
               <hr>
               <h3>Choose mode of payment</h3>
               <div><input type="radio" value="Paypal" name="mode-of-payment" id="Paypal"
                     <?php echo $modeOfPayment === 'Paypal' ? 'checked' : ''; ?>>
                  <label for="Paypal">Paypal</label>
               </div>
               <div><input type="radio" value="Bank Card" name="mode-of-payment" id="Bank"
                     <?php echo $modeOfPayment === 'Bank Card' ? 'checked' : ''; ?>>
                  <label for="Bank">Bank card</label>
               </div>
               <button class="btx-grey" type="button" onclick="window.location.href='cart.php'">See Items</button>
            </div>
         </div>
         <div class="button-holder">
            <button class="btx-red" type="submit">Next</button>
            <button class="btx-blue-reverse" type="button" onclick="window.history.back()">Return</button>
         </div>
      </form>
   </div>
   <?php include '../includes/footer.php'; ?>
   <?php include '../includes/scripts.php'; ?>
</body>

</html>