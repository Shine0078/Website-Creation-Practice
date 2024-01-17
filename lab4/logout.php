<?php
$title= "LOG-OUT PAGE";
$name="Samuel Abraham";
$file="logout.php";
$date="8/9/2023";
include "./includes/header.php";
    
$today = date("Ymd");
$now = date("Y-m-d G:i:s");
$email_address = $_SESSION['user']['emailaddress'];

$results = pg_execute($conn,'last_access_update',array($now,$email_address));
session_unset();
session_destroy();
session_start();


$handle = fopen("./logs/".$today.".txt", 'a');
fwrite($handle, "You successflly logged out at".$now.".User <".$email_address.">sign.in");
fclose($handle);
header("Location:sign-in.php");

?>