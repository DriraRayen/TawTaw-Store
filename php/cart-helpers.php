<?php
/**
 * Cart-related helper functions.
 */

/**
 * Fetch cart items for a given user. Optionally restrict results to specific variations.
 *
 * @param int $userId
 * @param array $variationIds
 * @return array
 */
function fetchUserCartItems(int $userId, array $variationIds = []): array
{
   include __DIR__ . '/connexion.php';

   $variationIds = array_values(array_filter(array_map('intval', $variationIds)));

   $filterClause = '';
   $typeString = 'i';
   $parameters = [&$typeString, &$userId];

   if (!empty($variationIds)) {
      $placeholders = implode(',', array_fill(0, count($variationIds), '?'));
      $filterClause = " AND ci.variation_id IN ($placeholders)";
      foreach ($variationIds as $index => $variationId) {
         $typeString .= 'i';
         $parameters[] = &$variationIds[$index];
      }
   }

   $sql = '
        SELECT 
            p.product_id,
            pv.variation_id,
            p.name AS product_name,
            p.company,
            p.description,
            pv.price,
            pv.color,
            pv.quantity AS stock_quantity,
            ci.quantity AS cart_quantity,
            COALESCE(pi.image_url, "Images/Products/default.png") AS image_url,
            CASE WHEN fav.variation_id IS NULL THEN 0 ELSE 1 END AS is_favourite
        FROM cart ci
        JOIN product_variation pv ON ci.variation_id = pv.variation_id
        JOIN products p ON pv.product_id = p.product_id
        LEFT JOIN product_images pi ON pv.variation_id = pi.variation_id
        LEFT JOIN favourates fav ON fav.user_id = ci.user_id AND fav.variation_id = pv.variation_id
        WHERE ci.user_id = ?' . $filterClause . '
        GROUP BY ci.cart_id
    ';

   $stmt = $conn->prepare($sql);
   if (!$stmt) {
      $conn->close();
      return [];
   }

   call_user_func_array([$stmt, 'bind_param'], $parameters);
   $stmt->execute();
   $result = $stmt->get_result();

   $items = [];
   while ($row = $result->fetch_assoc()) {
      $items[] = $row;
   }

   $stmt->close();
   $conn->close();

   return $items;
}

/**
 * Summarize cart quantities and totals.
 *
 * @param array $cartItems
 * @return array{count:int,total:float}
 */
function summarizeCartItems(array $cartItems): array
{
   $count = 0;
   $total = 0.0;

   foreach ($cartItems as $item) {
      $quantity = (int) ($item['cart_quantity'] ?? 0);
      $price = (float) ($item['price'] ?? 0);
      $count += $quantity;
      $total += $price * $quantity;
   }

   return [
      'count' => $count,
      'total' => $total,
   ];
}

/**
 * Remove selected cart items for the provided user.
 *
 * @param int $userId
 * @param array $variationIds
 * @return bool
 */
function removeCartItems(int $userId, array $variationIds): bool
{
   $variationIds = array_values(array_filter(array_map('intval', $variationIds)));
   if (empty($variationIds)) {
      return false;
   }

   include __DIR__ . '/connexion.php';

   $placeholders = implode(',', array_fill(0, count($variationIds), '?'));
   $typeString = 'i' . str_repeat('i', count($variationIds));

   $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND variation_id IN ($placeholders)");
   if (!$stmt) {
      $conn->close();
      return false;
   }

   $parameters = [&$typeString, &$userId];
   foreach ($variationIds as $index => $variationId) {
      $parameters[] = &$variationIds[$index];
   }

   call_user_func_array([$stmt, 'bind_param'], $parameters);
   $success = $stmt->execute();
   if ($success && $stmt->affected_rows === 0) {
      $success = false;
   }

   $stmt->close();
   $conn->close();

   return $success;
}

/**
 * Finalise a purchase by verifying stock, decrementing inventory, and removing the selected cart rows.
 *
 * @param int $userId
 * @param array $cartItems
 * @param string|null $errorMessage
 * @return bool
 */
function completePurchase(int $userId, array $cartItems, ?string &$errorMessage = null): bool
{
   $filteredItems = array_values(array_filter($cartItems, static function ($item) {
      return (int) ($item['cart_quantity'] ?? 0) > 0
         && (int) ($item['variation_id'] ?? 0) > 0;
   }));

   if (empty($filteredItems)) {
      $errorMessage = 'No items selected for checkout.';
      return false;
   }

   include __DIR__ . '/connexion.php';

   if (!$conn->begin_transaction()) {
      $errorMessage = 'Unable to start checkout transaction.';
      $conn->close();
      return false;
   }

   foreach ($filteredItems as $item) {
      $variationId = (int) $item['variation_id'];
      $requestedQuantity = (int) $item['cart_quantity'];

      // Lock the variation row to validate stock.
      $stockStmt = $conn->prepare('SELECT quantity FROM product_variation WHERE variation_id = ? FOR UPDATE');
      if (!$stockStmt) {
         $conn->rollback();
         $conn->close();
         $errorMessage = 'Unable to validate product stock.';
         return false;
      }

      $stockStmt->bind_param('i', $variationId);
      $stockStmt->execute();
      $stockStmt->bind_result($availableStock);

      if (!$stockStmt->fetch()) {
         $stockStmt->close();
         $conn->rollback();
         $conn->close();
         $errorMessage = 'The selected product could not be found.';
         return false;
      }

      $stockStmt->close();

      if ($availableStock < $requestedQuantity) {
         $conn->rollback();
         $conn->close();
         $productName = $item['product_name'] ?? 'Selected item';
         $errorMessage = sprintf(
            'Not enough stock for "%s". Only %d left.',
            $productName,
            (int) $availableStock
         );
         return false;
      }

      $updateStmt = $conn->prepare('UPDATE product_variation SET quantity = quantity - ? WHERE variation_id = ?');
      if (!$updateStmt) {
         $conn->rollback();
         $conn->close();
         $errorMessage = 'Unable to update product stock.';
         return false;
      }

      $updateStmt->bind_param('ii', $requestedQuantity, $variationId);
      if (!$updateStmt->execute()) {
         $updateStmt->close();
         $conn->rollback();
         $conn->close();
         $errorMessage = 'Failed to apply stock changes.';
         return false;
      }

      $updateStmt->close();

      $deleteStmt = $conn->prepare('DELETE FROM cart WHERE user_id = ? AND variation_id = ?');
      if (!$deleteStmt) {
         $conn->rollback();
         $conn->close();
         $errorMessage = 'Unable to remove purchased items from the cart.';
         return false;
      }

      $deleteStmt->bind_param('ii', $userId, $variationId);
      if (!$deleteStmt->execute()) {
         $deleteStmt->close();
         $conn->rollback();
         $conn->close();
         $errorMessage = 'Failed to clear purchased items from the cart.';
         return false;
      }

      $deleteStmt->close();
   }

   if (!$conn->commit()) {
      $conn->rollback();
      $conn->close();
      $errorMessage = 'Unable to finalise your order at this time.';
      return false;
   }

   $conn->close();
   return true;
}
?>