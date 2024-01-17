<!--Name: Samuel Abraham,
 * Date: December 11, 2023
 * Description: This file contains client details
-->
<?php


$title = "CLIENT REGISTRATION";
$name = "Samuel Abraham";
$file = "clients.php";
$date = "8/9/2023";
$desc = "This file is used to create the clients..";

include "./includes/header.php";

$email_address = "";
$fName = "";
$lName = "";
$phone = "";
$extension="";
$message = "";
$error = "";
$sales_id = '1002';


if(!(isset($_SESSION['user']['type'])&&
($_SESSION['user']['type']==ADMIN))){
    header("sign-in.php");
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email_address=trim($_POST['inputEmail']);
    
    $fName = trim($_POST['inputFName']);
    $lName = trim($_POST['inputLName']);
    $phone_number = trim($_POST['inputPhone']);
    $extension = trim($_POST['inputExtension']);
    

    if(isset($_SESSION['user']['type'])&&($_SESSION['user']['type']==ADMIN)){
        $sales_person = $_POST['inputSalesPerson'];
    }
    if(!isset($fName)|| $fName==""){
        $error.="You must enter first name.</br>";
    }
    //last name 
    if(!isset($lName)|| $lName==""){
        $error.="You must enter last name.</br>";
    }
    //email
    if(!isset($email_address)|| $email_address==""){
        $error.="You must enter email.</br>";
    }
    elseif(!filter_var($email_address,FILTER_VALIDATE_EMAIL)){
        $error.= $email_address. " is invalid email.</br>";
        $email_address="";
    }
    elseif(user_exists($email_address)){
        $error.="This email ".$email_address." is already exits. </br>";
    }
    //phone number validation.
    if(!isset($phone_number)|| $phone_number==""){
        $error.="You must enter phone number .</br>";
    }
    else if (strlen($phone_number) != 10)
    {
        $error.="You must enter proper phone number.</br>";
    }
    //extension validations
    if(!isset($extension)|| $extension==""){
        $error.="You must enter extension .</br>";
    }
    //file validation
    if($_FILES['uploadfileName']['error'] != 0){
        $error.= "Problem uploading your file.";
    }
    else if($_FILES['uploadfileName']['type'] !="image/jpeg"
        && $_FILES['uploadfileName']['type'] !="image/pjpeg"
        &&$_FILES['uploadfileName']['type'] !="image/gif"
        &&$_FILES['uploadfileName']['type'] !="image/png")
    {
        $error.= "Your profile picture must be of type JPEG.";
    }
    //check for the size of the file, in bytes
    else if($_FILES['uploadfileName']['size']>3000000) 
    {
        $error.="file selected is too big, file must be smaller than 3MB";
    }
    else{
        $logo_path = "./files_uploaded/".$email_address."new_file.jpeg";
        move_uploaded_file($_FILES['uploadfileName']['tmp_name'],$logo_path);
    }

    if($error!=""){
        $error.="</br> Please try again.";
        $_SESSION['message']=$error;
    }
    else{
        if(isset($_SESSION['user']['type'])&&($_SESSION['user']['type']==AGENT)){
            $sales_id=$_SESSION['user']['id'];
        }
        else{
            $sales_id=$sales_person;
        }
        insert_client($email_address,$fName,$lName,$phone_number,$extension,$logo_path,$sales_id);
        $_SESSION['message']="You successfully registered client";
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

<?php 
$form_user = array(
    array(
        'type'=>'email',
        'name'=>'inputEmail',
        'value'=>'',
        'label'=>'Email Address'
    ),
    array(
        'type'=>'text',
        'name'=>'inputFName',
        'value'=>'',
        'label'=>'First Name'
    ),
    array(
        'type'=>'text',
        'name'=>'inputLName',
        'value'=>'',
        'label'=>'Last Name'
    ),
    array(
        'type'=>'phone',
        'name'=>'inputPhone',
        'value'=>'',
        'label'=>'Phone Number'
    ),
    array(
        'type'=>'text',
        'name'=>'inputExtension',
        'value'=>'',
        'label'=>'Extension'
    ),
    array(
        'type'=>'file',
        'name'=>'uploadfileName',
        'value'=>'',
        'label'=>'Select file for upload'
    ),
    array(
        'type'=>'select',
        'name'=>'inputSalesPerson',
        'value'=>'',
        'label'=>''
    ),
    array(
        'type'=>'submit',
        'name'=>'',
        'value'=>'',
        'label'=>'Register'
    ),
    array(
        'type'=>'reset',
        'name'=>'',
        'value'=>'',
        'label'=>'Clear'
    )

);

//from the function.php
display_Form($form_user);
$page = 1;
if(isset($_GET['page'])){
    $page = $_GET['page'];
}

display_table(
    array(
        "id" => "ID",
        "emailaddress" => "Email Address",
        "firstname" => "First Name",
        "lastname" => "Last Name",
        "phonenumber" => "Phone Number",
        "extension" => "Extension",
        "logo_path" => "Logo"
    ),
    client_select_all($page),
    client_count(),
    $page
);

?>


<?php
include "./includes/footer.php";
?>    