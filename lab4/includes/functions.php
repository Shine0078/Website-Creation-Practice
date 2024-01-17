  <!--Name: Samuel Abraham
 * Date: December 09, 2023
 * Description: This contains the funcion where they all are defined

-->  
<?php
$file = "Lab4.php";
$date = " December 09 ,2023";
$title = "Lab4";
$desc = "This contains the funcion where they all are defined";
$banner = "Web Development Course - Lab 4";




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
        echo '<input value="'.$element['value'].'" type="'.$element['type'].'" name="'.$element['name'].'" id="'.$element['name'].'" class="form-control" placeholder = "'.$element['label'].'"  autofocus>';
    }
        elseif($elements['type']=='select'){
            if((isset($_SESSION['user']['type'])&&
            ($_SESSION['user']['type']==ADMIN)))
            {
                echo'<select name="'.$elements['name'].'"id="'.$elements['name'].
                '"class="form-control">';
                $result=user_type_select(AGENT);
                echo '<option value="-1">Select sales person</option>';
                for($i = 0; $i < pg_num_rows($result); $i++)
                {
                    $user = pg_fetch_assoc($result,$i);
                    echo '<option value='.$user["id"].'>'.$user["firstname"].''.$user["lastname"].': '.$user["emailaddress"].'</option>';
                }
                echo '</select>';
            }
        }
        else if($elements['type'] == "file"){
            echo '<label for="'.$elements['name'].'" class"sr-only">'.$elements['label'].'</label>';
            echo '<input type ="'.$elements['type'].'"name="'.$elements['name'].'"id="'.$elements['name'].
            '"class="form-control" placeholder="'.$elements['label'].'">';
        }
        elseif($element['type']== "submit"|| $element['type'] == "reset"){
            echo '<button class="btn btn-lg btn-primary btn-block" type="'.
            $element['type'].'">' .$element['label'].'</button>';
        }
    }
}    
        
    
    echo "</form>";

    

    // Display table headers using the provided field names
function display_table($fields, $records, $count, $page)
{
    echo '<div>';
    echo '<table class="table table-striped">';
    echo '<thead>';
    echo '<tr>';
    foreach ($fields as $key => $value) {
            echo '<th>' .$value.'</th>';
    }
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        for($i = 0; $i < count($clientSelectAll);$i++){

            echo '<tr>';
    
            foreach($clientSelectAll[$i] as $key1 => $value1){
                if($key1=='logo_path'){
                    echo '<td> <img src = "'.$value1.'" alt="NO LOGO available" width="30"></td>';
    
                }else{
                    echo '<td>'.$value1.'</td>';
                }
                }
                echo '</tr>';
            }
    
    
            echo '</tbody>';
            echo '</table>';
            echo '<nav aria-label = "page navigation example">';
            echo '<ul class = "pagination">';
            echo '<li class = "page-item"><a class = "page-link" href="#">Previous</a></li>';
            for($i = 0; $i < $agent_count/RECORDS; $i++){
                echo '<li class ="page-item"<a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.($i+1).'">'.($i+1).'</a></li>';
            }
    
            
            echo '<li class="page-item"><a class="page-link" href="#">Next</a></li>';
            echo '</ul>';
            echo '</nav>';
            echo '</div>';
        }
    
    



    


?>




