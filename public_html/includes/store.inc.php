<?php

try {
  $sql = "SELECT * FROM items";
  $s = $pdo->query($sql);
  
}
catch (PDOException $e) {
  $output = "Error fetching items. " . $e->getMessage();
  include_once $root . "/components/error.html.php";
  exit();
}

if ($s->rowCount() == 0) {
  $output = "Error no items found.";
  include_once $root . "/components/error.html.php";
  exit();
}

$items = $s->fetchAll();

?>
