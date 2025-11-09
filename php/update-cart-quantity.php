<?php
require_once '../includes/session-init.php';
header('Content-Type: application/json');

if (!$isLoggedIn) {
   echo json_encode([
      'success' => false,
      'message' => 'You need to be logged in to update your cart.',
   ]);
   exit;
}

$rawInput = file_get_contents('php://input');
$payload = json_decode($rawInput, true);

if (!is_array($payload)) {
   echo json_encode([
      'success' => false,
      'message' => 'Invalid request payload.',
   ]);
   exit;
}

$variationId = isset($payload['variation_id']) ? (int) $payload['variation_id'] : 0;
$quantity = isset($payload['quantity']) ? (int) $payload['quantity'] : 0;

if ($variationId <= 0 || $quantity <= 0) {
   echo json_encode([
      'success' => false,
      'message' => 'A valid item and quantity are required.',
   ]);
   exit;
}

include __DIR__ . '/connexion.php';

// Ensure the requested variation exists and has sufficient stock
$stockStmt = $conn->prepare('SELECT quantity FROM product_variation WHERE variation_id = ?');
if (!$stockStmt) {
   echo json_encode([
      'success' => false,
      'message' => 'Unable to validate product stock.',
   ]);
   $conn->close();
   exit;
}

$stockStmt->bind_param('i', $variationId);
$stockStmt->execute();
$stockStmt->bind_result($availableStock);

if (!$stockStmt->fetch()) {
   $stockStmt->close();
   $conn->close();
   echo json_encode([
      'success' => false,
      'message' => 'Product variation not found.',
   ]);
   exit;
}

$stockStmt->close();

if ($availableStock <= 0) {
   $conn->close();
   echo json_encode([
      'success' => false,
      'message' => 'This item is currently out of stock.',
   ]);
   exit;
}

if ($quantity > $availableStock) {
   $quantity = (int) $availableStock;
}

$updateStmt = $conn->prepare('UPDATE cart SET quantity = ? WHERE user_id = ? AND variation_id = ?');
if (!$updateStmt) {
   $conn->close();
   echo json_encode([
      'success' => false,
      'message' => 'Unable to update the cart at this time.',
   ]);
   exit;
}

$userId = (int) $_SESSION['user_id'];
$updateStmt->bind_param('iii', $quantity, $userId, $variationId);
$updateStmt->execute();

if ($updateStmt->affected_rows === 0) {
   $updateStmt->close();
   $conn->close();
   echo json_encode([
      'success' => false,
      'message' => 'Item was not found in your cart.',
   ]);
   exit;
}

$updateStmt->close();
$conn->close();

echo json_encode([
   'success' => true,
   'quantity' => $quantity,
]);
?>