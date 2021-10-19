<?php

try {
  $sql = 'SELECT date, quantity, name, description, cost, order_id FROM items, orders WHERE orders.client_id = :id  AND items.item_id = orders.item_id';
  $s = $pdo->prepare($sql);
  $s->bindValue(':id', $_SESSION['client_id']);
  $s->execute();
}

catch (PDOException $e) {
  $output = 'Error fetching orders: ' . $e->getMessage();
  require $root . '/components/error.html.php';
  exit();
}

$items = $s->fetchAll(); 

?>
