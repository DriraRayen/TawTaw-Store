<?php
session_start();
include 'connexion.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit;
}

$user_id = $_SESSION['user_id'];

$data = json_decode(file_get_contents('php://input'), true);
if (!is_array($data) || !isset($data['variation_id'])) {
    echo json_encode(['success' => false, 'message' => 'Variation ID is required.']);
    exit;
}

$variation_id = (int) $data['variation_id'];
$quantity = isset($data['quantity']) ? (int) $data['quantity'] : 1;
$mode = isset($data['mode']) && $data['mode'] === 'set' ? 'set' : 'increment';

if ($variation_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid variation selection.']);
    exit;
}

if ($quantity <= 0) {
    $quantity = 1;
}

$productSql = "SELECT quantity FROM product_variation WHERE variation_id = ?";
$productStmt = $conn->prepare($productSql);
if (!$productStmt) {
    echo json_encode(['success' => false, 'message' => 'Unable to prepare product lookup.']);
    exit;
}

$productStmt->bind_param('i', $variation_id);
$productStmt->execute();
$productStmt->bind_result($availableStock);

if (!$productStmt->fetch()) {
    $productStmt->close();
    $conn->close();
    echo json_encode(['success' => false, 'message' => 'Invalid variation ID.']);
    exit;
}

$productStmt->close();

if ($availableStock <= 0) {
    $conn->close();
    echo json_encode(['success' => false, 'message' => 'This item is currently out of stock.']);
    exit;
}

$quantity = min($quantity, (int) $availableStock);

$cartSql = "SELECT quantity FROM cart WHERE user_id = ? AND variation_id = ?";
$cartStmt = $conn->prepare($cartSql);
$cartStmt->bind_param('ii', $user_id, $variation_id);
$cartStmt->execute();
$cartResult = $cartStmt->get_result();
$existingQuantity = 0;

if ($cartRow = $cartResult->fetch_assoc()) {
    $existingQuantity = (int) $cartRow['quantity'];
}

$cartStmt->close();

$success = false;

if ($mode === 'set') {
    $newQuantity = $quantity;
    if ($existingQuantity > 0) {
        $updateSql = "UPDATE cart SET quantity = ? WHERE user_id = ? AND variation_id = ?";
        $updateStmt = $conn->prepare($updateSql);
        if ($updateStmt) {
            $updateStmt->bind_param('iii', $newQuantity, $user_id, $variation_id);
            $success = $updateStmt->execute();
            $updateStmt->close();
        }
    } else {
        $insertSql = "INSERT INTO cart (user_id, variation_id, quantity) VALUES (?, ?, ?)";
        $insertStmt = $conn->prepare($insertSql);
        if ($insertStmt) {
            $insertStmt->bind_param('iii', $user_id, $variation_id, $newQuantity);
            $success = $insertStmt->execute();
            $insertStmt->close();
        }
    }
} else {
    $newQuantity = $existingQuantity + $quantity;
    $newQuantity = min($newQuantity, (int) $availableStock);

    if ($existingQuantity > 0) {
        $updateSql = "UPDATE cart SET quantity = ? WHERE user_id = ? AND variation_id = ?";
        $updateStmt = $conn->prepare($updateSql);
        if ($updateStmt) {
            $updateStmt->bind_param('iii', $newQuantity, $user_id, $variation_id);
            $success = $updateStmt->execute();
            $updateStmt->close();
        }
    } else {
        $insertSql = "INSERT INTO cart (user_id, variation_id, quantity) VALUES (?, ?, ?)";
        $insertStmt = $conn->prepare($insertSql);
        if ($insertStmt) {
            $insertStmt->bind_param('iii', $user_id, $variation_id, $newQuantity);
            $success = $insertStmt->execute();
            $insertStmt->close();
        }
    }
}

$conn->close();

if (!$success) {
    echo json_encode(['success' => false, 'message' => 'Failed to update cart.']);
    exit;
}

echo json_encode([
    'success' => true,
    'message' => $mode === 'set' ? 'Cart updated successfully.' : 'Item added to cart successfully.',
    'quantity' => $newQuantity,
]);
?>