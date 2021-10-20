<?php 

session_start();

$root = $_SERVER['DOCUMENT_ROOT'];

if (isset($_POST['action']) && $_POST['action'] == 'Add' && !$_SESSION['login']) {

  echo file_get_contents($root . '/components/login.html');
  exit();
}
if (isset($_POST['action']) && $_POST['action'] == 'Add' && $_SESSION['login']) {

  $_SESSION['cart'][] = ["item_id" =>$_POST['item_id'],"quantity" =>$_POST['quantity'],"name" =>$_POST['name'],"description" =>$_POST['description'],"cost" =>$_POST['cost']];
  
  header('Location: ./');
  exit();
}
if (isset($_POST['action']) && $_POST['action'] == 'Login') {

  include_once $root . "/includes/login.valid.inc.php";

  include_once $root . "/includes/db.inc.php";

  include_once $root . "/includes/login.inc.php";

  include_once $root . "/includes/store.inc.php";

  include_once $root . "/components/index.html.php";
  exit();
}
if (!isset($_POST['action'])) {

  include_once $root . "/includes/db.inc.php";

  include_once $root . "/includes/store.inc.php";

  include_once $root . "/components/index.html.php";
  exit();
}

?>
