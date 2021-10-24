<?php

session_start();

$root = $_SERVER["DOCUMENT_ROOT"];

if (isset($_POST["action"]) && $_POST["action"] == "Cancel Registration" && $_SESSION["login"]) {

  include_once $root . "/includes/db.inc.php";

  include_once $root . "/includes/deregistration.inc.php";
  
  header("Location: ./logout.php");
  exit();
}
if (isset($_POST["action"]) && $_POST["action"] == "Purchase" && $_SESSION["login"]) {

  include_once $root . "/includes/db.inc.php";
 
  try {
    $sql = "INSERT INTO orders (quantity,client_id,item_id)
            VALUES (:quantity,:client_id,:item_id)";
    $s = $pdo->prepare($sql);
    foreach ($_SESSION["cart"] as $items) {
      $s->bindValue(":quantity", $items["quantity"]);
      $s->bindValue(":client_id", $_SESSION["client_id"]);
      $s->bindValue(":item_id", $items["item_id"]);
      $s->execute();
    }
  } catch (PDOException $e) {
    $output = "Error inserting order. " . $e->getMessage();
    include_once  $root . "/components/error.html.php";
    exit();
  }
  
  unset($_SESSION["cart"]);
  header("Location: ./orders.php");
  exit();
}
if (isset($_POST["action"]) && $_POST["action"] == "Remove" && $_SESSION["login"]) {

  unset($_SESSION["cart"][$_POST["remove"]]);

  header("Location: ./cart.php");
  exit();
}
if ($_SESSION["login"] && !isset($_POST["action"])) {

  include_once $root . "/includes/db.inc.php";

  include_once $root . "/includes/user.inc.php";

  include_once $root . "/components/cart.html.php";
  exit();
}
if (isset($_POST["action"]) && $_POST["action"] == "Login") {

  include_once $root . "/includes/login.valid.inc.php";

  include_once $root . "/includes/db.inc.php";

  include_once $root . "/includes/login.inc.php";

  include_once $root . "/includes/user.inc.php";

  include_once $root . "/components/cart.html.php";
  exit();
}
if (!$_SESSION["login"]) {

  echo file_get_contents($root . "/components/login.html");
  exit();
}

?>
