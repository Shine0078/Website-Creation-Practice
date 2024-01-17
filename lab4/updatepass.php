<?php


$file = "Lab4.php";
$date = " December 09 ,2023";
$title = "Lab4";
$desc = "This file contains update password";
$banner = " Web Development Course - Lab 4";
include "./includes/header.php";


$current_pass="";
$new_pass="";
$confirm_new_pass="";

$error="";
$message="";

if(!(isset($_SESSION['user']['type']) && ($_SESSION['user']['type']==ADMIN))){
    header("sign-in.php");
}
if(@$_SERVER["REQEST_METHOD"]=="POST"){

    $current_pass=trim($_POST['inputCurrentPass']);
    $new_pass=trim($_POST['inputNewPass']);
    $confirm_new_pass=trim($_POST['inputConfirmPass']);

    //data validation

        //current password
    if(!isset($current_pass)|| $current_pass==""){
        $error.="You must enter password.</br>";
    }
    //password new validation
    if(!isset($new_pass)|| $new_pass==""){
        $error.="You must enter new password.</br>";
    }
    //confirm new password
    if(!isset($confirm_new_pass)|| $confirm_new_pass==""){
        $error.="You must enter confirm password.</br>";
    }

    elseif (strcmp($new_pass,$confirm_new_pass)<>0){
        $error.="You have to enter the password and confirm password the same.</br>";
    }  


    if($error=""){
        insert_user($email_address,$new_pass)
        $message.="You successfully updated your password.";
        $current_pass="";
        $new_pass="";
        $confirm_new_pass="";
    }
    else{
        $message.="Please try again."
    }
}
if(isset($_SESSION['message'])){
    $message= $_SESSION['message'];
    unset($_SESSION['message']);
}

?>
<h3>
    <?php
    echo $message;
    ?>
</h3>
<form class="form-updatePassword" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>"
<h2>
    <?php echo $error;?>
</h2>
<h1>
    To update your password fill out the following:
</h1>
<label for="inputCurrentPass" class="sr-only"> Current Password</label>
<input type="Password" name="inputCurrentPass" required autofocus>

<label for="inputNewPass" class="sr-only"> New Password</label>
<input type="Password" name="inputNewPass" required autofocus>

<label for="inputConfirmPass" class="sr-only"> Current Password</label>
<input type="Password" name="inputCurrentPass" required autofocus>

</form>

<?php
include "./includes/footer.php";
?>