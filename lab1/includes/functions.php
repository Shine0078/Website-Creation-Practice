<?php
    function write_to_log($activity,$status, $email_address){
        $today = date("Ymd");
        $now = date("Y-m-d G:i:s");
        $handle = fopen("./log/".$today."_log.txt","a");

        fwrite($handle,$activity." ".$status."  at " . $now.". User ".$email_address." ".$activity.".\n");
        fclose();
    }


?>