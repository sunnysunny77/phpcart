<?php
require $_SERVER['DOCUMENT_ROOT'] . "/../keys.php"; 
try
{
  $pdo = new PDO('mysql:host=localhost;dbname=cart', 'root', $db);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->exec('SET NAMES "utf8"');
}
catch (PDOException $e) {
  $output = 'Unable to connect to the database server.';
  require $root . '/components/error.html.php';
  exit();
}
