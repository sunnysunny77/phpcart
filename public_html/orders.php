<?php 

session_start();

$root = $_SERVER['DOCUMENT_ROOT'];

if (isset($_POST['action']) && $_POST['action'] == 'Cancel Registration' && $_SESSION['login']) {

  include_once $root . "/includes/db.inc.php";

  include_once $root . "/includes/deregistration.inc.php";
  
  header('Location: ./logout.php');
  exit();
}
if (isset($_POST['action']) && $_POST['action'] == 'Arrived' && $_SESSION['login']) {
  
  include_once $root . "/includes/db.inc.php";

  try {
    $sql = 'DELETE FROM orders
            WHERE order_id= :order_id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':order_id', $_POST['remove']);
    $s->execute();
  }
  catch (PDOException $e) {
    $output = 'Error deleting order. ' . $e->getMessage();;
    include_once  $root . '/components/error.html.php';
    exit();
  }

  header('Location: ./orders.php');
  exit();
}
if ($_SESSION['login'] && !isset($_POST['action'])) {

  include_once $root . "/includes/db.inc.php";

  include_once $root . "/includes/user.inc.php";

  include_once $root . "/includes/items.inc.php";

  include_once $root . '/components/orders.html.php';
  exit();
}
if (isset($_POST['action']) && $_POST['action'] == 'Login') {

  include_once $root . "/includes/login.valid.inc.php";

  include_once $root . "/includes/db.inc.php";

  include_once $root . "/includes/login.inc.php";
  
  include_once $root . "/includes/user.inc.php";

  include_once $root . "/includes/items.inc.php";

  include_once $root . '/components/orders.html.php';
  exit();
}
if (!$_SESSION['login']) {

  echo file_get_contents($root . '/components/login.html');
  exit();
}

?>
