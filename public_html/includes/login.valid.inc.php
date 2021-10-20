<?php

$email = $_POST['email'];
$pass = $_POST['pass'];

$output = "";
if (empty($email) || empty($pass)) {
    $output .= "Error please fill out all fields. \n\n ";
}
if (!preg_match("/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/", $email )) {
  $output .= "Error email patern accepts examaple@example.com. \n\n ";
} 
if (strlen($email) > 40) {
    $output .= "Error username is longer than 40 chracters. \n\n ";
}
if (strlen($pass) > 40) {
    $output .= "Error password is longer than 40 chracters. \n\n ";
}
if (!empty($output)) {
    include_once  $root . '/components/error.html.php';
    header( "refresh:5;./" );
    exit();  
}

?>
