<?php
    $title= "SALES PEOPLE REGISTRATION";
    $name="Samuel Abraham";
    $file="salespeople.php";
    $date="8/9/2023";
    include "./includes/header.php";


    $email_address="";
    $fName="";
    $lName="";
    $password1="";
    $password2="";
    $phone="";
    $message="";
    $error="";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        $fName = trim($_POST["inputFName"]);
        $lName = trim($_POST["inputLName"]);
        $email_address = trim($_POST["inputEmail"]);
        $password1 = trim($_POST["inputPassword2"]);
        $password2 = trim($_POST["inputPassword2"]);
        $phone = trim($_POST["inputPhone"]);

        //validate First Name and other components
        if(!isset($fName)|| $fName == "")
        {
            $error.= "You must enter Your First Name.<br/>";
        }

        if(!isset($lName)|| $lName == "")
        {
            $error.= "You must enter Your Last Name.<br/>";
        }
        //email Address
        if(!isset($email_address)|| $email_address == "")
        {
            $error.= "You must enter Your Email Address .<br/>";
        }
        elseif(!filter_var($email_address, FILTER_VALIDATE_EMAIL))
        {
            $error.= "<em>". $email_address. "</em> is not a valid email address"; 
            $email_address ="";
        }
        elseif(user_select(Semail address))
        { 
            $error .= "This email (".$email_address.") already exists.<br/>"; 
            $email_address ="";
        }
            //Password
        if(!isset($password1) || $password1 == "" || !isset($password2)  ||$password2 == "")
        {
            $error.= "You Must enter Your Password.<br/>";
        }
        elseif (strcmp($password1,$password2)<>0) 
        {
            $error .= "Submitted password and confirm password should be the same .<br/>";
        }
        if($error == "")
        {
            if(insert_salesperson($email_address,$password1,$fName,$lName,$phone, SALES)){
                $message="You have Successfully register the sales person";
                $email_address = ""; 
                $fName = ""; 
                $lName = ""; 
                $phone = ""; 
            }
            else{
                $error="There is something wrong with the insert ";
            }
        

        }
        else{
            $error.="<br/>Please Try Again";

        }
        $message.= $error;
    }
 
?>

<h3>
    <?php
        echo  $message;

    ?>
</h3>

<?php
    $user_form = array(
        array(
            "type"=>"text",
            "name" => "inputFName",
            "value" =>$fName,
            "label" =>"First name"
        ),
        array(
            "type"=>"text",
            "name" => "inputLName",
            "value" =>$lName,
            "label" =>"Last Name"
        ),
        array(
            "type"=>"email",
            "name" => "inputEmail",
            "value" =>$email_address,
            "label" =>"Email Address"
        ),
        array(
            "type"=>"password",
            "name" => "inputPassword1",
            "value" =>$password1,
            "label" =>"Password"
        ),
        array(
            "type"=>"password",
            "name" => "inputPassword2",
            "value" =>$password2,
            "label" =>"Confirm Password"
        ),
        array(
            "type"=>"text",
            "name" => "inputPhone",
            "value" =>$phone,
            "label" =>"Phone Number"
        ),
        array(
            "type"=>"submit",
            "name" => "",
            "value" =>"",
            "label" =>"Register"
        ),
        array(
            "type"=>"reset",
            "name" => "",
            "value" =>"",
            "label" =>"Clear"
        )
        
    );

    display_form($user_form);

    
        


?>

<?php
include "./includes/footer.php";
?> 