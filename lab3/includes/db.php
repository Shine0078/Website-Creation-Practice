<?php
$conn=db_connect();
// Create a database connection function
function db_connect() {
    return pg_connect("host=".DB_HOST." port=".DB_PORT." dbname=".DATABASE." user=".DB_ADMIN." password=".DB_PASSWORD);
}


$stmt = pg_prepare($conn, "user_retrieve", "SELECT * FROM users WHERE emailaddress= $1");
function user_select($email_address) {
    global $conn;
    $user =false;
        
    $results = pg_execute($conn, 'user_retrieve', array($email_address));
    if(pg_num_rows($results)==1){
        $user = pg_fetch_assoc($results,0);
    }
        return $user;
        
    }


function user_authenticate($email_address,$password) {
        $user = user_select($email_address);
        //global $conn;
        if ($user && password_verify($password , $user['password'])){
            return $user;
        }
        else{
            return false;
        }
    }

    
    
// user_update_login_time
$stmt1 = pg_prepare($conn, 'user_update_login_time', 'UPDATE users SET LastLoggedIn=$1 WHERE EmailAddress=$2');

// Function to update the LastLoggedIn time for a user


// In db.php, declare prepared statement to insert new record
$insert_user = pg_prepare($conn, 'insert_user', 'INSERT INTO users (EmailAddress, Password, FirstName, LastName, CreatedTime, phoneExtension, UserType) VALUES ($1, $2, $3, $4, $5, $6, $7)');


// Declare a function to insert a new user 
function insert_salesperson($email_address, $password1, $fName, $lName, $phone, $userType){
    global $conn;
    $now = date("Y-m-d G:i:s");
    return pg_execute($conn, 'insert_user', array($email_address, password_hash($password1, PASSWORD_BCRYPT), $fName, $lName,$now, $phone, $userType));
}

// client_select
$stmt1 = pg_prepare($conn, 'client_retrieve', 'SELECT * FROM clients WHERE emailAddress= $1');



// Declare prepared statement to insert new record
$insert_client = pg_prepare(
    $conn,
    'insert_client',
    'INSERT INTO clients(EmailAddress, FirstName, LastName, PhoneNumber, Extension, Sales_id) VALUES ($1, $2, $3, $4, $5, $6)'
);

// Function to insert a new client
function insert_client($email_address, $fName, $lName, $phone, $extension, $sales_id) {
    global $conn;
    return pg_execute($conn, 'insert_client', array($email_address, $fName, $lName, $phone, $extension, $sales_id));
}
// user_type_select
$user_type_select = pg_prepare($conn, "user_type_select", 'SELECT * FROM users WHERE UserType=$1');
function user_type_select($type){
    global $conn;
    $result = pg_execute($conn, 'user_type_select', array($type));
    return pg_fetch_all($result);
}


$clients_select_all = pg_prepare(
    $conn,
    "clients_select_all",
    'SELECT Id, EmailAddress, FirstName, LastName, PhoneNumber, Extension, Picture_path, Sales_id FROM clients'
);
function clients_select_all() {
    global $conn;

    $query = "SELECT * FROM clients";
    $result = pg_query($conn, $query);

    if ($result) {
        $clients = pg_fetch_all($result);
        return $clients;
    } else {
        return false;
    }
}

// Declare a prepared statement to insert a new call record
$insert_call = pg_prepare($conn, 'insert_call', 'INSERT INTO calls (time_of_call, client_id, notes) VALUES ($1, $2, $3)');



// Declare a function to insert new user
function insert_call($time_of_call, $client_id, $notes){
    global $conn;
    return pg_execute($conn, 'insert_call', array($time_of_call, $client_id, $notes));
}

// Make sure to close the database connection when you're done
function db_close() {
global $conn;
pg_close($conn);
}   
        
    
?>
    



