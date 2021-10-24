<?php

$email = $_POST["email"];
$pass = $_POST["pass"];

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
if (preg_match("/^[^0-9]+$/", $pass )) {
    $output .= "Error password patern accepts atleast one #. \n\n ";
} 
if (preg_match("/^[^A-Z]+$/", $pass )) {
    $output .= "Error password patern accepts atleast one capital letter. \n\n ";
} 
if (preg_match("/^[^a-z]+$/", $pass )) {
    $output .= "Error password patern accepts atleast one lowercase letter. \n\n ";
} 
if (strlen($pass) > 40 ) {
    $output .= "Error password is longer than 40 chracters. \n\n ";
}
if (strlen($pass) < 8) {
    $output .= "Error password is less than 8 chracters. \n\n ";
}
if (!empty($output)) {
    include_once  $root . "/components/error.html.php";
    header( "refresh:5;./" );
    exit();  
}

?>
