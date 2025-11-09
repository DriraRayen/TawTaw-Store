<?php
// Add error reporting to see what's causing the error
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // Start the session at the very beginning
require 'connexion.php';
require_once __DIR__ . '/../includes/flash.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the form
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Query to check if the email exists using a prepared statement
    $stmt = $conn->prepare('SELECT user_id, email, password FROM users WHERE email = ?');
    if ($stmt === false) {
        add_flash_message('error', 'Login is unavailable right now. Try again.');
        header('Location: ../html/login.php');
        exit();
    }

    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $stmt->close();

        $storedPassword = $user['password'];
        $loginSuccessful = false;

        if (password_verify($password, $storedPassword)) {
            $loginSuccessful = true;

            // Rehash if the algorithm parameters have changed
            if (password_needs_rehash($storedPassword, PASSWORD_DEFAULT)) {
                $newHash = password_hash($password, PASSWORD_DEFAULT);
                $rehashStmt = $conn->prepare('UPDATE users SET password = ? WHERE user_id = ?');
                if ($rehashStmt) {
                    $rehashStmt->bind_param('si', $newHash, $user['user_id']);
                    $rehashStmt->execute();
                    $rehashStmt->close();
                }
            }
        } elseif ($password === $storedPassword && password_get_info($storedPassword)['algo'] === 0) {
            // Legacy plain-text password detected; upgrade it to a hash
            $loginSuccessful = true;
            $newHash = password_hash($password, PASSWORD_DEFAULT);
            $rehashStmt = $conn->prepare('UPDATE users SET password = ? WHERE user_id = ?');
            if ($rehashStmt) {
                $rehashStmt->bind_param('si', $newHash, $user['user_id']);
                $rehashStmt->execute();
                $rehashStmt->close();
            }
        }

        if ($loginSuccessful) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['login_success'] = true;
            header('Location: ../html/s-log.php');
            exit();
        }

        add_flash_message('error', 'Incorrect password. Try again.');
        header('Location: ../html/login.php');
        exit();
    }

    if ($stmt) {
        $stmt->close();
    }

    add_flash_message('info', "We couldn't find that email. Create an account.");
    header('Location: ../html/signup.php');
    exit();
}

// Close the database connection
$conn->close();
?>