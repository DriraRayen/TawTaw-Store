<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
   session_start();
}

if (!function_exists('add_flash_message')) {
   function add_flash_message(string $type, string $message): void
   {
      if (!isset($_SESSION['flash_messages']) || !is_array($_SESSION['flash_messages'])) {
         $_SESSION['flash_messages'] = [];
      }

      $_SESSION['flash_messages'][] = [
         'type' => $type,
         'message' => $message,
      ];
   }
}

if (!function_exists('get_flash_messages')) {
   /**
    * Retrieve and clear flash messages from the session.
    *
    * @return array<int, array<string, string>>
    */
   function get_flash_messages(): array
   {
      if (!isset($_SESSION['flash_messages']) || !is_array($_SESSION['flash_messages'])) {
         return [];
      }

      $messages = $_SESSION['flash_messages'];
      unset($_SESSION['flash_messages']);

      return $messages;
   }
}
