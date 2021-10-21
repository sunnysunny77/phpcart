<?php

try {
    $sql = 'SELECT client_id FROM clients WHERE email = :email AND password = :pass';
    $s = $pdo->prepare($sql);
    $s->bindValue(':email', $email);
    $s->bindValue(':pass', md5($pass . "store"));
    $s->execute();
}
catch (PDOException $e) {
    $output = 'Error fetching credentials. ' . $e->getMessage();
    include_once  $root . '/components/error.html.php';
    exit();
}
if ($s->rowCount() == 0) {
    $output = "Incorrect credentials. \n\n Please navigate back.";
    include_once  $root . '/components/error.html.php';
    exit();
}

$_SESSION['login'] = true;

$_SESSION['client_id'] = $s->fetch()["client_id"];

?>
