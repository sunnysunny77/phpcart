<?php

session_start();

$root = $_SERVER["DOCUMENT_ROOT"];

if (isset($_POST["action"]) && $_POST["action"] == "Change Login" && $_SESSION["admin"]) {

  include_once $root . "/includes/login.valid.inc.php";
  
  include_once $root . "/includes/db.inc.php";

  try {
    $sql = "UPDATE admins
            SET email=:email, password=:password
            WHERE email=:emailwhere";
    $s = $pdo->prepare($sql);
    $s->bindValue(":email", $email);
    $s->bindValue(":password", md5($pass . "store"));
    $s->bindValue(":emailwhere", $_SESSION["email"]);
    $s->execute();
  } 
  catch (PDOException $e) {
    $output = "Error updating credentials. " . $e->getMessage();
    include_once $root . "/components/error.html.php";
    exit();
  }

  $_SESSION["email"] = $email;

  $output = "Updated credentials.";
  include_once $root . "/components/output.html.php";
  header( "refresh:5;./admin.php" );
  exit();
}
if (isset($_POST["action"]) && $_POST["action"] == "Insert Item" && $_SESSION["admin"]) {

  include_once $root . "/includes/store.valid.inc.php";

  if (!is_uploaded_file($_FILES["upload"]["tmp_name"])) {

    $output = "There was no file uploaded. \n\n Please navigate back.";
    include_once  $root . "/components/error.html.php";
    exit();
  }
  
  $uploadfile = $_FILES["upload"]["tmp_name"];
  $uploadname = $_FILES["upload"]["name"];
  $uploadtype = $_FILES["upload"]["type"];
  $uploaddata = file_get_contents($uploadfile);
  
  include_once $root . "/includes/db.inc.php";

  try {
    $sql = "INSERT IGNORE INTO mimetypes (mimetype)
            VALUES (:mimetype)";
    $s = $pdo->prepare($sql);
    $s->bindValue(":mimetype", $uploadtype);
    $s->execute();
  }
  catch (PDOException $e) {
    $output = "Error inserting mimetype. " . $e->getMessage();
    include_once  $root . "/components/error.html.php";
    exit();
  }
  
  try {
    $sql = "INSERT INTO files (filename,filedata,mimetype_id) 
            VALUES (:filename,:filedata,(SELECT mimetype_id FROM mimetypes WHERE mimetype = :mimetype))";
    $s = $pdo->prepare($sql);
    $s->bindValue(":filename", $uploadname);
    $s->bindValue(":filedata", $uploaddata);
    $s->bindValue(":mimetype", $uploadtype);
    $s->execute();
  }
  catch (PDOException $e) {
    $output = "Error inserting file. " . $e->getMessage();
    include_once  $root . "/components/error.html.php";
    exit();
  }

  $file_id = $pdo->lastInsertId();

  try {
    $sql = "INSERT INTO items
            (name,description,cost,file_id)
            VALUES (:name, :description,:cost,:file_id)";
    $s = $pdo->prepare($sql);
    $s->bindValue(":name", $name);
    $s->bindValue(":description", $description);
    $s->bindValue(":cost", $cost);
    $s->bindValue(":file_id", $file_id);
    $s->execute();
  } 
  catch (PDOException $e) {
    $output = "Error inserting item. " . $e->getMessage();
    include_once $root . "/components/error.html.php";
    exit();
  }

  $output = "Inserted item.";
  include_once $root . "/components/output.html.php";
  header( "refresh:5;./admin.php" );
  exit();
}
if (isset($_POST["action"]) && $_POST["action"] == "Update Item" && $_SESSION["admin"]) {

  include_once $root . "/includes/store.valid.inc.php";

  include_once $root . "/includes/db.inc.php";

  if (is_uploaded_file($_FILES["upload"]["tmp_name"])) {

    $file_id = $_POST["file_id"];
    $uploadfile = $_FILES["upload"]["tmp_name"];
    $uploadname = $_FILES["upload"]["name"];
    $uploadtype = $_FILES["upload"]["type"];
    $uploaddata = file_get_contents($uploadfile);

    try {
      $sql = "INSERT IGNORE INTO mimetypes (mimetype)
              VALUES (:mimetype)";
      $s = $pdo->prepare($sql);
      $s->bindValue(":mimetype", $uploadtype);
      $s->execute();
    }
    catch (PDOException $e) {
      $output = "Error inserting mimetype. " . $e->getMessage();
      include_once  $root . "/components/error.html.php";
      exit();
    }
    
    try {
      $sql = "UPDATE files SET
              filename = :filename,
              filedata = :filedata,
              mimetype_id = (SELECT mimetype_id FROM mimetypes WHERE mimetype = :mimetype )
              WHERE file_id = :id";
      $s = $pdo->prepare($sql);
      $s->bindValue(":filename", $uploadname);
      $s->bindValue(":filedata", $uploaddata);
      $s->bindValue(":mimetype", $uploadtype);
      $s->bindValue(":id", $file_id);
      $s->execute();
    }
    catch (PDOException $e) {
      $output = "Error updating file. " . $e->getMessage();
      include_once  $root . "/components/error.html.php";
      exit();
    }
  }

  try {
    $sql = "UPDATE items
            SET name=:name,description=:description,cost=:cost
            WHERE item_id=:item_id";
    $s = $pdo->prepare($sql);
    $s->bindValue(":name", $name);
    $s->bindValue(":description", $description);
    $s->bindValue(":cost", $cost);
    $s->bindValue(":item_id", $_POST["item_id"]);
    $s->execute();
  } 
  catch (PDOException $e) {
    $output = "Error updating item. " . $e->getMessage();
    include_once $root . "/components/error.html.php";
    exit();
  }

  $output = "Updated item.";
  include_once $root . "/components/output.html.php";
  header( "refresh:5;./admin.php" );
  exit();
}
if (isset($_POST["action"]) && $_POST["action"] == "Delete Item" && $_SESSION["admin"]) {

  include_once $root . "/includes/db.inc.php";
  
  try {
    $sql = "DELETE FROM items
            WHERE item_id NOT IN 
            (SELECT item_id FROM orders)
            AND item_id=:item_id";
    $s = $pdo->prepare($sql);
    $s->bindValue(":item_id", $_POST["item_id"]);
    $s->execute();
  } 
  catch (PDOException $e) {
    $output = "Error deleting item. " . $e->getMessage();
    include_once $root . "/components/error.html.php";
    exit();
  }

  if ($s->rowCount() == 0) {
    $output = "Error deleting item as it has a current order. ";
    include_once $root . "/components/error.html.php";
    exit();
  }

  try {
    $sql = "DELETE FROM files
            WHERE file_id=:file_id";
    $s = $pdo->prepare($sql);
    $s->bindValue(":file_id", $_POST["file_id"]);
    $s->execute();
  } 
  catch (PDOException $e) {
    $output = "Error deleting files. " . $e->getMessage();
    include_once $root . "/components/error.html.php";
    exit();
  }

  try {
    $sql = "DELETE FROM mimetypes WHERE 
        mimetype_id NOT IN 
        (SELECT mimetype_id FROM files)";
    $s = $pdo->prepare($sql);
    $s->execute();
  }
  catch (PDOException $e) {
      $output = "Error deleting mimetype. " . $e->getMessage();
      include_once  $root . "/components/error.html.php";
      exit();
  }

  $output = "Deleted item.";
  include_once $root . "/components/output.html.php";
  header( "refresh:5;./admin.php" );
  exit();
}
if ($_SESSION["admin"] && !isset($_POST["action"])) {

  include_once $root . "/includes/db.inc.php";
  
  include_once $root . "/includes/store.inc.php";

  include_once $root . "/components/admin.html.php";
  exit();
}
if (isset($_POST["action"]) && $_POST["action"] == "Login") {

  include_once $root . "/includes/login.valid.inc.php";

  include_once $root . "/includes/db.inc.php";

  try {
    $sql = "SELECT email FROM admins WHERE email = :email AND password = :pass";
    $s = $pdo->prepare($sql);
    $s->bindValue(":email", $email);
    $s->bindValue(":pass", md5($pass . "store"));
    $s->execute();
  }
  catch (PDOException $e) {
      $output = "Error fetching credentials. " . $e->getMessage();
      include_once  $root . "/components/error.html.php";
      exit();
  }

  if ($s->rowCount() == 0) {
      $output = "Incorrect credentials.";
      include_once  $root . "/components/error.html.php";
      header( "refresh:5;./" );
      exit();
  }

  $_SESSION["admin"] = true;

  $_SESSION["email"] = $s->fetch()["email"];

  include_once $root . "/includes/store.inc.php";

  include_once $root . "/components/admin.html.php";
  exit();
}
if (!$_SESSION["admin"]) {

  echo file_get_contents($root . "/components/login.html");
  exit();
}

?>
