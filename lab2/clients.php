<?php
// Include your header and session management code here

$title = "CLIENT REGISTRATION";
$name = "Samuel Abraham";
$file = "clients.php";
$date = "8/9/2023";

include "./includes/header.php";

$email = "";
$fName = "";
$lName = "";
$phone = "";
$message = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fName = trim($_POST["inputFName"]);
    $lName = trim($_POST["inputLName"]);
    $email = trim($_POST["inputEmail"]);
    $phone = trim($_POST["inputPhone"]);

    // Validate the form fields
    if (!isset($fName) || $fName == "") {
        $error .= "You must enter your First Name.<br/>";
    }

    if (!isset($lName) || $lName == "") {
        $error .= "You must enter your Last Name.<br/>";
    }

    if (!isset($email) || $email == "") {
        $error .= "You must enter your Email Address.<br/>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error .= "<em>" . $email . "</em> is not a valid email address";
        $email = "";
    } elseif (user_select($email)) {
        $error .= "This email (" . $email . ") already exists.<br/>";
        $email = "";
    }

    if ($error == "") {
        // Insert the client record into the database
        if (insert_client($email, $fName, $lName, $phone, $_SESSION['user_id'])) {
            $message = "Client registered successfully.";
            $email = "";
            $fName = "";
            $lName = "";
            $phone = "";
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
        "value" => $email,
        "label" => "Email Address"
    ),
    array(
        "type" => "text",
        "name" => "inputPhone",
        "value" => $phone,
        "label" => "Phone Number"
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

display_form($user_form);
?>
<?php
include "./includes/footer.php";
?>
