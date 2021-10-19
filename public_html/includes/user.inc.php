<?php

try {
  $sql = 'SELECT  name, email, phone, street, suberb, post_code, state FROM clients, suberbs, post_codes, states WHERE clients.client_id = :id AND suberbs.suberb_id = clients.suberb_id AND  post_codes.post_code_id = clients.post_code_id AND states.state_id = clients.state_id ';
  $s = $pdo->prepare($sql);
  $s->bindValue(':id', $_SESSION['client_id']);
  $s->execute();
}

catch (PDOException $e) {
  $output = 'Error fetching orders: ' . $e->getMessage();
  require $root . '/components/error.html.php';
  exit();
}

$user = $s->fetch();

?>
