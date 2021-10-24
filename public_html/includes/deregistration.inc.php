<?php

try {
  $sql = "DELETE FROM clients
          WHERE client_id NOT IN 
          (SELECT client_id FROM orders)
          AND email=:email";
  $s = $pdo->prepare($sql);
  $s->bindValue(":email", $_POST["email"]);
  $s->execute();
} catch (PDOException $e) {
  $output = "Error deleting item. " . $e->getMessage();
  include_once $root . "/components/error.html.php";
  exit();
}

if ($s->rowCount() == 0) {
  $output = "Error deleting client as it has current orders.";
  include_once $root . "/components/error.html.php";
  exit();
}

try {
  $sql = "DELETE FROM post_codes WHERE 
          post_code_id NOT IN 
          (SELECT post_code_id FROM clients)";
  $s = $pdo->prepare($sql);
  $s->execute();
}
catch (PDOException $e) {
    $output = "Error deleting post code. " . $e->getMessage();
    include_once  $root . "/components/error.html.php";
    exit();
}

try {
  $sql = "DELETE FROM suberbs WHERE 
      suberb_id NOT IN 
      (SELECT suberb_id FROM clients)";
  $s = $pdo->prepare($sql);
  $s->execute();
}
catch (PDOException $e) {
    $output = "Error deleting suberb. " . $e->getMessage();
    include_once  $root . "/components/error.html.php";
    exit();
}

?>
