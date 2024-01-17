<!--Name: Samuel Abraham
 * Date: December 09, 2023
 * Description: This file contains the database scripts, and defining the functions ,which
  is used for the website creation and for this lab.
-->
<?php
$file = "Lab4.php";
$date = " December 09 ,2023";
$title = "Lab4";
$desc = "This file contains the database scripts, and defining the functions ,which
is used for the website creation and for this lab.";
$banner = "Web Development Course - Lab 4";




$conn=db_connect();
// Create a database connection function
function db_connect() {
    return pg_connect("host=".DB_HOST." port=".DB_PORT." dbname=".DATABASE." user=".DB_ADMIN." password=".DB_PASSWORD);
}
// Statement 1 & 2 for SQL input for retrieving data From the Database
$stmt1 = pg_prepare($conn,'user_retrieve', 'SELECT * FROM users WHERE emailAddress=$1');
$stat2 = pg_prepare($conn, 'last_access_update', 'UPDATE users SET LastLoggedIn = $1 WHERE emailAddress = $2');


function user_select($email_address) {
    global $conn;
    $user =false;
    $results = pg_execute($conn, 'user_retrieve', array($email_address));
    if(pg_num_rows($results)==1){
        $user = pg_fetch_assoc($results,0);
    }
        return $user;
        
    }

// Functiuon to Authenticate that the user exists or not
function user_authenticate($email_address) {
    global $conn;
    $results = pg_execute($conn,'user_retrieve',array($email_address));
    if(pg_num_rows($results)==1){
        return true;
    }
    else{
         false;
    }
 }


 $user_insert= pg_prepare($conn,"user_insert","INSERT INTO users(EmailAddress, Password, FirstName, LastName, CreatedTime, LastLoggedIn, UserType)"."VALUES ($1,$2,$3,$4,$5,$6,'a')");

// Declare a function to insert a new user 
function insert_user($email_address, $password1, $fName, $lName, $phone, $userType){
    global $conn;
    $now = date("Y-m-d G:i:s");
    return pg_execute($conn, 'user_insert', array($email_address, password_hash($password1, PASSWORD_BCRYPT), $fName, $lName, $phone, $userType));
}

// user_type_select
$user_type_select = pg_prepare($conn,"user_type_select","SELECT * FROM users WHERE TYPE=$1");
function user_type_select($usertype){
    global $conn;
    return pg_execute($conn,"user_type_select",array($usertype));
}


// Declare prepared statement to insert new record
$client_insert = pg_prepare($conn, "client_insert","INSERT INTO clients(EmailAddress,FirstName,LastName,PhoneNumber,Extension,logo_path,Sales_id)"."VALUES($1,$2,$3,$4,$5,$6,$7)");

// Function to insert a new client
function insert_client($email_address,$fName,$lName,$phone,$extension,$logo_path,$sales_Id) {
    global $conn;
    return pg_execute($conn, 'client_insert', array($email_address,$fName,$lName,$phone,$extension,$logo_path,$sales_Id));
}

$client_id_select = pg_prepare($conn, "client_id_select", "SELECT * FROM clients");
function client_id_select($id){
    global $conn;
    return pg_execute($conn,"client_id_select",array($id));
}
$client_select_all = pg_prepare($conn , "client_select_all", "SELECT * FROM clients");

function client_select_all($page) {
    global $conn;
    if ($_SESSION['user']['type'] == 's') {
        $result = pg_execute($conn, "client_select_all", array());
        $count = pg_num_rows($result);
        $arr = array();
        $start_index = ($page - 1) * RECORDS;
        $end_index = min($count, $page * RECORDS);
        for ($i = $start_index; $i < $end_index; $i++) {
            array_push($arr, pg_fetch_assoc($result, $i));
        }
        return $arr;
    }
    // Handle the case where the user type is not 's'
    return array();
}
  
$sales_select_all = pg_prepare($conn , "sales_select_all", "SELECT ID,EmailAddress,FirstName,LastName FROM users");

function aa($page){
    global $conn;
    if($_SESSION['user']['type']=='s')
    $result = pg_execute($conn,"sales_select_all",array());

    $count = pg_num_rows($result);
    $arr = array();
    for($i = ($page-1) *RECORDS;$i<$count && $i <$page*RECORDS; $i++){
        array_push($arr,pg_fetch_assoc($result,$i));
    }
    return $arr;
}

function client_count(){
    global $conn;
    if($_SESSION['user']['type'] == 's')
        $result = pg_execute($conn,"client_select_all",array());
    return pg_num_rows($result);
}

$sales_id_select = pg_prepare($conn, "sales_id_select", "SELECT * FROM users");
function sales_id_select($id){
        global $conn;
        return pg_execute($conn,"sales_id_select",array($id));
}
    
function sales_count(){
        global $conn;
        if($_SESSION['user']['type'] == 's')
            $result = pg_execute($conn,"sales_select_all",array());
        return pg_num_rows($result);
}

// Make sure to close the database connection when you're done
function db_close() {
global $conn;
pg_close($conn);
}   
        
    
?>
    



