<?php

require 'connexion.php';
require_once __DIR__ . '/../includes/flash.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve data from the HTML form
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);
  $confirm_password = trim($_POST['confirm_password']);

  // Check if passwords match
  if ($password !== $confirm_password) {
    add_flash_message('error', 'Passwords must match.');
    header('Location: ../html/signup.php');
    exit();
  }

  // Check if the email already exists using a prepared statement
  $checkStmt = $conn->prepare('SELECT user_id FROM users WHERE email = ?');
  if ($checkStmt === false) {
    add_flash_message('error', 'Signup is unavailable right now. Try again.');
    header('Location: ../html/signup.php');
    exit();
  }

  $checkStmt->bind_param('s', $email);
  $checkStmt->execute();
  $checkStmt->store_result();

  if ($checkStmt->num_rows > 0) {
    $checkStmt->close();
    add_flash_message('info', 'That email already has an account. Log in instead.');
    header('Location: ../html/signup.php');
    exit();
  }
  $checkStmt->close();

  // Hash the password securely before storing it
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Insert the new user using a prepared statement
  $insertStmt = $conn->prepare('INSERT INTO users (email, password) VALUES (?, ?)');
  if ($insertStmt === false) {
    add_flash_message('error', 'Signup is unavailable right now. Try again.');
    header('Location: ../html/signup.php');
    exit();
  }

  $insertStmt->bind_param('ss', $email, $hashedPassword);

  if ($insertStmt->execute()) {
    $insertStmt->close();
    add_flash_message('info', 'Signup complete. Log in now.');
    header('Location: ../html/login.php');
    exit();
  }

  $insertStmt->close();
  add_flash_message('error', 'Signup failed. Try again.');
  header('Location: ../html/signup.php');
  exit();
}

// Close the database connection
$conn->close();
?>