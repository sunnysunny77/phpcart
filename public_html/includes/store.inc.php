<?php

try {
  $sql = 'SELECT * FROM items';
  $result = $pdo->query($sql);
  
}
catch (PDOException $e) {
  $output = 'Error fetching items: ' . $e->getMessage();
  require $root . '/components/error.html.php';
  exit();
}

if ($result->rowCount() == 0) {
  $output = "Error no items found.";
  require $root . '/components/error.html.php';
  exit();
}

$items = $result->fetchAll();

?>
