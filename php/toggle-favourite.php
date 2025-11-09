<?php
session_start();
include 'connexion.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit;
}

$user_id = $_SESSION['user_id'];

$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['variation_id']) || !isset($data['action'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
    exit;
}

$variation_id = intval($data['variation_id']);
$action = $data['action'];


if ($action === 'add') {
    $sql = "INSERT INTO favourates (user_id, variation_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $user_id, $variation_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Added to favourites.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add to favourites.']);
    }
} elseif ($action === 'remove') {
    $sql = "DELETE FROM favourates WHERE user_id = ? AND variation_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $user_id, $variation_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Removed from favourites.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to remove from favourites.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid action.']);
}

$stmt->close();
$conn->close();
?>