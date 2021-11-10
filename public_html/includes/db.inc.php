<?php


try
{
  $pdo = new PDO("mysql:host=localhost;dbname=store", "root","");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->exec("SET NAMES 'utf8'");
}
catch (PDOException $e) {
  $output = "Unable to connect to the database server.";
  include_once $root . "/components/error.html.php";
  exit();
}

?>