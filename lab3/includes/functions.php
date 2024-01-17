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
                .$element['label'].'"  autofocus>';

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
    
    // Check if $fields is an array and not empty before creating table headers
    if (is_array($fields) && !empty($fields)) {
        foreach ($fields as $key => $value) {
            echo '<th scope="col">' . $value . '</th>';
        }
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        
        // Check if $records is an array and not empty before looping through it
        if (is_array($records) && !empty($records)) {
            foreach ($records as $record) {
                echo '<tr>';
                
                // Check if $record is an array before iterating through its values
            if (is_array($record)) {
                foreach ($record as $value) {
                    echo '<td>' . $value . '</td>';
                    }
            } else 
            {
                echo '<td colspan="' . count($fields) . '">Invalid record format</td>';
            }
                
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="' . count($fields) . '">No Data</td></tr>';
        }
        
        
    } else {
        echo 'Invalid fields format';
    }

     
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
     
     
        echo '<nav aria-label="Pagination Navigation">';
        echo '<ul class="pagination">';
        echo '<li class="page-item">';
        echo '<a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . (($page > 1) ? --$page : $page) . '" >Previous</a>';
        echo '</li>';
        if ($records != 0) {
            $totalPages = ceil($count / $records); // Calculate the total number of pages
        
            // Iterate through the pages using a for loop
            for ($i = 0; $i < $totalPages; $i++) {
                echo '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . ($i + 1) . '">' . ($i + 1) . '</a></li>';
            }
        } else {
            echo "Error: Division by zero. Cannot divide by zero.";
        }
     
        echo '<li class="page-item">';
        // Check if $records is greater than zero before performing pagination
// Ensure $records is set to a valid non-zero value before attempting pagination
        if ($records > 0) {
            $totalPages = ceil($count / $records);
            if ($totalPages > 1) {
                if ($page < $totalPages) {
                    echo '<a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . ($page + 1) . '">Next</a>';
                }
            } else 
            {
                echo 'Pagination not required. Total pages are 1 or fewer.';
            }
        } else {
            echo 'Cannot paginate. Records per page is zero or not properly set.';
        }

    


        echo '</li>';
        echo '</ul>';
        echo '</nav>';
        echo '</div>';
    }




    


?>




