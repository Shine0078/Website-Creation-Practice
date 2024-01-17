<?php
$file = "Lab4.php";
$date = " December 09 ,2023";
$title = "Lab4";
$desc = "This file contains the Reset for the website";
$banner = " Web Development Course - Lab 4";


include "./includes/header.php";

$email_address=" ";
$error="";

if(!(isset($_SESSION['user']['type']) && ($_SESSION['user']['type']==ADMIN))){
   
        header("sign-in.php");   
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email_address=trim($_POST['inputEmail']); 

    if(!isset($email_address)|| $email_address==""){
        $error.="Please enter a valid email address .</br>";
    }
    elseif(!filter_var($email_address,FILTER_VALIDATE_EMAIL)){
        $error.= $email_address. " is invalid email.</br>";
        $email_address="";
    }
    elseif(user_exists($email_address)){
        $error.="This email ".$email_address."  already exits. </br>";
    }

    if(errors=""){
        $sendmail = '';
        $logfile = '/logs';
        $logline = '';
        $mail = '';
        $fp = fopen('logs', 'w');
        while ($line = fgets($fp))
        {
          if(preg_match('/^to:/i', $line) || preg_match('/^from:/i', $line))
          {
            $logline .= trim($line).' ';
          }
          $mail .= $line;
        }
        /* Build sendmail command */
        $cmd = 'echo ' . escapeshellarg($mail) . ' | '.$sendmail.' -t -i';
        for ($i = 1; $i &lt; $_SERVER['argc']; $i++)
        {
          $cmd .= escapeshellarg($_SERVER['argv'][$i]).' ';
        }
        
        /* Log line */if($path = isset($_ENV['PWD']) ? $_ENV['PWD'] : $_SERVER['PWD'];){
            file_put_contents($logfile, date('Y-m-d H:i:s') . ' ' . $logline .'  ==> ' .$path."\n", FILE_APPEND);
            file_get_contents(echo "An Email has been sent to the mail entered above whose temporary password is ".uniqid().)

        }
        
        /* Call sendmail */
        return shell_exec($cmd);
        

    }
}

$form_user = array(
    array(
        'type'=>'email',
        'name'=>'inputEmail',
        'value'=>'',
        'label'=>'Email Address'
    ),
    array(
        'type'=>'submit',
        'value'=>'',
        'label'=>'Send Temporary Password'
    )
);
display_Form($form_user);
$page = 1;
if(isset($_GET['page'])){
    $page = $_GET['page'];
}
display_table(
    array(   
        "emailaddress" => "Email Address",
    ),
    aa($page),
    sales_count(),
    $page
);
 
 
include "./includes/footer.php";
?>    