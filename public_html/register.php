<?php

$root = $_SERVER['DOCUMENT_ROOT'];

if (isset($_POST['action']) && $_POST['action'] == 'Register') {

  $name = $_POST['name'];
  $phone = $_POST["phone"];
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $street = $_POST['street'];
  $suberb = $_POST['suberb'];
  $code = $_POST['code'];
  $state = $_POST['state'];

  $output = "";
  if (empty($name) || empty($phone) || empty($email) || empty($pass) || empty($street) || empty($suberb) || empty($code) || empty($state)) {
    $output .= "Error please fill out all fields. \n\n ";
  }
  if (!preg_match("/^[A-Z \.\-']{2,40}$/i", $name)) {
    $output .= "Error enter your name. \n\n";
  }
  if (!preg_match("/^[+]?[0-9]{3,15}$/", $phone )) {
    $output .= "Error phone number patern accepts +###############. \n\n";
  }
  if (!preg_match("/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/", $email)) {
    $output .= "Error email patern accepts examaple@example.com. \n\n ";
  }
  if (strlen($email) > 40) {
    $output .= "Error username is longer than 40 chracters. \n\n ";
  }
  if (strlen($pass) > 40) {
    $output .= "Error password is longer than 40 chracters. \n\n ";
  }
  if (strlen($street) > 40) {
    $output .= "Error street address is longer than 40 chracters. \n\n ";
  }
  if (!preg_match("/[a-z]/i", $suberb)) {
    $output .= "Error suberb patern accepts a-z. \n\n";
  }
  if (strlen($suberb) > 40) {
    $output .= "Error suberb is longer than 40 chracters. \n\n ";
  }
  if (!preg_match("/^\d{4}$/", $code)) {
    $output .= "Error post code patern accepts ####. \n\n";
  }
  if (empty($state)) {
    $output .= "Error select your state. \n\n";
  }
  if (!empty($output)) {
    $output .= "Please navigate back. \n\n";
    include_once  $root . '/components/error.html.php';
    exit();
  }

  include_once $root . "/includes/db.inc.php";

  try {
    $sql = 'INSERT IGNORE INTO post_codes (post_code)
            VALUES (:code)';
    $s = $pdo->prepare($sql);
    $s->bindValue(':code', $code);
    $s->execute();
  } catch (PDOException $e) {
    $output = 'Error inserting post code. ' . $e->getMessage();
    include_once $root . '/components/error.html.php';
    exit();
  }

  try {
    $sql = 'INSERT IGNORE INTO suberbs (suberb)
            VALUES (:suberb)';
    $s = $pdo->prepare($sql);
    $s->bindValue(':suberb', strtoupper($suberb));
    $s->execute();
  } catch (PDOException $e) {
    $output = 'Error inserting suberb. ' . $e->getMessage();
    include_once $root . '/components/error.html.php';
    exit();
  }

  try {
    $sql = 'INSERT INTO clients (name, phone, email, password, street, suberb_id, post_code_id, state_id)
            VALUES (:name, :phone, :email, :password, :street, (SELECT suberb_id FROM suberbs WHERE suberb = :suberb ), (SELECT post_code_id FROM post_codes WHERE post_code = :post_code ), (SELECT state_id FROM states WHERE state = :state ))';
    $s = $pdo->prepare($sql);
    $s->bindValue(':name', $name);
    $s->bindValue(':phone', $phone);
    $s->bindValue(':email', $email);
    $s->bindValue(':password', md5($pass . "store"));
    $s->bindValue(':street', strtoupper($street));
    $s->bindValue(':suberb', strtoupper($suberb));
    $s->bindValue(':post_code', $code);
    $s->bindValue(':state', $state);
    $s->execute();
  } catch (PDOException $e) {
    if ($e->getCode() == 23000) {
      $output = 'Error duplicate email.';
      include_once $root . '/components/error.html.php';
      exit();
  } 
    $output = 'Error inserting client: ' . $e->getMessage();
    include_once $root . '/components/error.html.php';
    exit();
  }

  header('Location: ./logout.php');
  exit();
} 

include_once $root . "/components/register.html";
exit();

?>
