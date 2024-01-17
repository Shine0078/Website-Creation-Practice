<?php

// Create a database connection function
function db_connect() {
    
    return pg_connect("host=".DB_HOST." port=".DB_PORT." dbname=".DATABASE." user=".DB_ADMIN." password=".DB_PASSWORD);
    }
    $conn=db_connect();
    $stmt1 = pg_prepare($conn, "use_retrieve", "SELECT * FROM users WHERE emailaddress= $1");

    
    
    
    
    function user_select($email_address) {
        global $conn;
        $user =false;
        $results = pg_execute($conn, 'user_retrieve', array($email_address));
        if(pg_num_assec($results)==1)
        {
            $user = pg_fetch_assoc($results,0);
    
        }
        return $user;
    }
    //$stmt1 = pg_prepare($conn, "use_update_login_time", "UPDATE users SET LastLoggedIn = $1 WHERE EmailAddress= $2");
    
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
    
    
    
        
        
    
?>
    

//$user_select = pg_prepare($conn."user_select", "SELECT * FROM users WHERE EmailAddress = $1" );

