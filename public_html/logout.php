<?php

  session_start();
  
  unset ($_SESSION["login"]);
  unset ($_SESSION["admin"]);
  unset ($_SESSION["client_id"]);
  unset ($_SESSION["email"]);
  unset ($_SESSION["cart"]);
  header('Location: ./');
  exit();

?>
