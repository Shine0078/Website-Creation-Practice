<?php
function db_connect() {
    return pg_connect ("host=".DB_HOST." port =" .DB_PORT.
    " dbname=".DATABASE."user=".DB_ADMIN.
    "password=".DB_PASSWORD);
  
}
$conn = db_connect();



?>
