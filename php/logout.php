<?php
session_start();
require_once __DIR__ . '/../includes/flash.php';

$message = 'You have been logged out. Hope to see you soon!';

$_SESSION = [];

if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}

session_destroy();

session_start();
require_once __DIR__ . '/../includes/flash.php';
add_flash_message('info', $message);

header('Location: ../html/index.php');
exit();