<?php

  $name = $_POST['name'];
  $description = $_POST['description'];
  $cost = $_POST["cost"];
  
  $output = "";
  if (empty($name) || empty($description) || empty($cost)) {
      $output .= "Error please fill out all fields. \n\n ";
  }
  if (strlen($name) > 40) {
      $output .= "Error name is longer than 40 chracters. \n\n ";
  }
  if (strlen($pass) > 255) {
      $output .= "Error description is longer than 255 chracters. \n\n ";
  }
  if (!preg_match("/^\d{1,5}(?:\.\d{1,2})?$/", $cost )) {
    $output .= "Error cost length patern accepts #####.##. \n\n ";
  } 
  if (!empty($output)) {
      $output .= "Please navigate back.";
      include_once  $root . '/components/error.html.php';
      exit();  
  }

?>
