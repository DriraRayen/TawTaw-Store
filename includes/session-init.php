<?php
/**
 * Session Initialization - Centralized session management
 * Include this file at the top of every page that needs session access
 */

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
   session_start();
}

// Set login status variable
$isLoggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);

// Optional: Add session timeout (30 minutes of inactivity)
$timeout_duration = 1800; // 30 minutes in seconds

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
   // Last request was more than 30 minutes ago
   session_unset();
   session_destroy();
   $isLoggedIn = false;
}

// Update last activity time
$_SESSION['LAST_ACTIVITY'] = time();
?>