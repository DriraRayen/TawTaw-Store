<?php
session_start();
include 'connexion.php';


if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit;
}

$user_id = $_SESSION['user_id'];

$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['variation_id'])) {
    echo json_encode(['success' => false, 'message' => 'Variation ID is required.']);
    exit;
}

$variation_id = intval($data['variation_id']);

$sql = "DELETE FROM cart WHERE user_id = ? AND variation_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $user_id, $variation_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Item removed from cart successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to remove item from cart.']);
}

$stmt->close();
$conn->close();
?>