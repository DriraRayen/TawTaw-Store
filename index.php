<?php
// Root entry point. Redirects users to the appropriate index depending on login status.
session_start();

// If session contains user id (adjust key if your app uses another name) consider user logged in
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
   header('Location: html/index.php');
   exit;
}

header('Location: html/index.php');
exit;
