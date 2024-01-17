<?php
$title= "LOG-OUT PAGE";
$name="Samuel Abraham";
$file="logout.php";
$date="8/9/2023";
   include "./includes/header.php";
   session_start();
   
   $user=$_SESSION['user'];
   $email_address=$user['EmailAddress'];
   session_unset();

   session_destroy();
   
   session_start();

   ob_start();

   $_SESSION['message']="You have successfully logged out";

   write_to_log("Sign out","SUCCESS",$email_address);

   header("Location:sign-in.php");
   ob_flush();
   
   include "./includes/footer.php";


?>