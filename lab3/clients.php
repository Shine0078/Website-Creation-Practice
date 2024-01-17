<?php
// Include your header and session management code here

$title = "CLIENT REGISTRATION";
$name = "Samuel Abraham";
$file = "clients.php";
$date = "8/9/2023";

include "./includes/header.php";

$email_address = "";
$fName = "";
$lName = "";
$phone = "";
$extension="";
$message = "";
$error = "";
$Sales_id = '1002';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fName = trim($_POST["inputFName"]);
    $lName = trim($_POST["inputLName"]);
    $email_address = trim($_POST["inputEmail"]);
    $phone = trim($_POST["inputPhone"]);
    $extension=trim($_POST["inputExtension"]);
    

    // Validate the form fields
    if (!isset($fName) || $fName == "") {
        $error .= "You must enter your First Name.<br/>";
    }

    if (!isset($lName) || $lName == "") {
        $error .= "You must enter your Last Name.<br/>";
    }

    if (!isset($email_address) || $email_address  == "") {
        $error .= "You must enter your Email Address.<br/>";
    } elseif (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
        $error .= "<em>" . $email_address  . "</em> is not a valid email address";
        $email_address= "";
    } elseif (user_select($email_address)) {
        $error .= "This email (" .$email_address  . ") already exists.<br/>";
        $email_address= "";
    }

    if ($error == "") {
        // Insert the client record into the database
        if (insert_client($email_address, $fName, $lName, $phone, $extension, $Sales_id)) {
            $message = "Client registered successfully.";
            // Reset form fields after successful insertion
            $email_address = "";
            $fName = "";
            $lName = "";
            $phone = "";
            $extension = "";
            
        } else {
            $error = "There was an issue with the database insertion.";
        }
    } else {
        $error .= "<br/>Please try again.";
    }
    $message .= $error;
}

    
    

    
?>

<h3>
    <?php
    echo $message;
    ?>
</h3>

<?php
$user_form = array(
    array(
        "type" => "text",
        "name" => "inputFName",
        "value" => $fName,
        "label" => "First Name"
    ),
    array(
        "type" => "text",
        "name" => "inputLName",
        "value" => $lName,
        "label" => "Last Name"
    ),
    array(
        "type" => "email",
        "name" => "inputEmail",
        "value" => $email_address,
        "label" => "Email Address"
    ),
   
    array(
        "type" => "text",
        "name" => "inputPhone",
        "value" => $phone,
        "label" => "Phone Number"
    ),
    array(
        "type" => "text",
        "name" => "inputExtension",
        "value" => $extension,
        "label" => "Extension"
    ),
    array(
        "type" => "submit",
        "name" => "",
        "value" => "",
        "label" => "Register"
    ),
    array(
        "type" => "reset",
        "name" => "",
        "value" => "",
        "label" => "Clear"
    )
);
// Retrieve all clients from the database




    display_form($user_form);

$page = 1;
$records = "2"; // Fetch records based on the page
$count = "3";
 
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

$salesArray_form = array(
    array(
        "Id" => "ID",
        "EmailAddress" => "Email Address",
        "FirstName" => "First Name",
        "LastName" => "Last Name",
        "PhoneNumber" => "Phone Number",
        "Extension" => "Extension",
        "Picture_path" => "Picture",
        "Sales_id"  => "Sales Id"
    )
);

// Ensure that clients_select_all($page) and clients_count() return valid values or data

    display_table(
        array(
            "Id" => "ID",
            "EmailAddress" => "Email Address",
            "FirstName" => "First Name",
            "LastName" => "Last Name",
            "PhoneNumber" => "Phone Number",
            "Extension" => "Extension",
            "Picture_path" => "Picture",
            "Sales_id"  => "Sales Id"
        ),
        $records, // Pass the records array
        $count, // Pass the count of records
        $page
    );
    



include "./includes/footer.php";
?>
