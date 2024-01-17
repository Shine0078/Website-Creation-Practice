<?php
    function write_to_log($activity,$status, $email_address){
        $today = date("Ymd");
        $now = date("Y-m-d G:i:s");
        $handle = fopen("./log/".$today."_log.txt","a");

        fwrite($handle,$activity." ".$status."  at " . $now.". User ".$email_address." ".$activity.".\n");
        fclose($handle);
    }
    function display_form($arrayForm){
        echo '<form class="form-signin" action="'. $_SERVER['PHP_SELF'].'" method="POST">';
        echo '<h1 class="h3 mb-3 font-weight-normal">Please Enter The Following</h1>';
    
        foreach($arrayForm as $element){

            if ($element['type']== "text"|| $element['type'] == "email"||
                $element['type']== "password"|| $element['type']== "phone"){
                // change

                echo  '<label for="'.$element['name'].'" class="sr-only">'.$element['label'].'</label>';
                echo '<input value="'.$element['value'].'" type="'.$element['type'].'" name="'.
                $element['name'].'" id="'.$element['name'].'" class="form-control" placeholder = "'
                .$eleemnt['label'].'"  autofocus>';

        }
        elseif($element['type']== "submit"|| $element['type'] == "reset"){
            echo '<button class="btn btn-lg btn-primary btn-block" type="'.
            $element['type'].'">' .$element['label'].'</button>';
        }
    }
        
    
    echo "</form>";
}

?>




