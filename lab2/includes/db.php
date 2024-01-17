<?php

// Create a database connection function
function db_connect() {
    return pg_connect("host=".DB_HOST." port=".DB_PORT." dbname=".DATABASE." user=".DB_ADMIN." password=".DB_PASSWORD);
}
$conn=db_connect();


function user_select($email_address) {
        global $conn;
        $user =false;
        $stmt = pg_prepare($conn, "user_retrieve", "SELECT * FROM users WHERE emailaddress= $1");
        $results = pg_execute($conn, 'user_retrieve', array($email_address));
        if(pg_num_rows($results)==1)
        {
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

    
    
$insert_user = pg_prepare($conn, 'insert_user', "INSERT INTO users (EmailAddress, Password, FirstName, LastName, CreatedTime, phoneExtension, UserType) VALUES ($1, $2, $3, $4, $5, $6, $7)");
function insert_salesperson($email_address,$password1,$fName,$lName,$phone,$usertype){
    global $conn;
    $now = date("Y-m-d G:i:s");
    return pg_execute($conn, 'insert_user', array($email_address, password_hash($password1, PASSWORD_BCRYPT), $fName, $lName, $now, $phone, $usertype));

    } 

        
    

    
    
    
        
        
    
?>
    



