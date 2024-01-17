<?php
// Include your header and session management code here

$title = "Calls Registration";
$name = "Samuel Abraham";
$file = "calls.php";
$date = "8/9/2023";

include "./includes/header.php";



$clientName = "";
$callTime = "";
$message = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $clientName = trim($_POST["inputClientName"]);
    $callTime = trim($_POST["inputCallTime"]);

    // Validate the form fields
    if (!isset($clientName) || $clientName == "") {
        $error .= "You must enter the client's name.<br/>";
    }

    if (!isset($callTime) || $callTime == "") {
        $error .= "You must enter the call time.<br/>";
    }

    if ($error == "") {
        // Insert the call record into the database
        if (insert_call($clientName, $callTime, $_SESSION['user_id'])) {
            $message = "Call record created successfully.";
            $clientName = "";
            $callTime = "";
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
        "name" => "inputClientName",
        "value" => $clientName,
        "label" => "Client's Name"
    ),
    array(
        "type" => "text",
        "name" => "inputCallTime",
        "value" => $callTime,
        "label" => "Call Time"
    ),
    array(
        "type" => "submit",
        "name" => "",
        "value" => "",
        "label" => "Create Call Record"
    ),
    array(
        "type" => "reset",
        "name" => "",
        "value" => "",
        "label" => "Clear"
    )
);

display_form($user_form);

$page = 1;
$records = "2"; // Fetch records based on the page
$count = "3";
 
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
 
display_table(
    array(
        "Id" => "ID",
        "EmailAddress" => "Email Address",
        "FirstName" => "First Name",
        "LastName" => "Last Name",
        "PhoneNumber" => "Phone Number",
        "Extension" => "Extension"
        
    ),
    
    $records , // Fetch records based on the page
    $count ,
    $page
);


?>
<?php
include "./includes/footer.php";
?>
