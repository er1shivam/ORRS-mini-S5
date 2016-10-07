<?php
//check if the user left the text-box empty 
function check_empty_fields($required_fields_array){
    // initialise an array to store errors
    $form_errors = array();
    foreach($required_fields_array as $fields){
            if(!isset($_POST[$fields]) || $_POST[$fields] == NULL){
                $form_errors[] = $fields . " can't be empty" ;
            }
        }

        return $form_errors;
}

// check min lengths of fields passed
function check_min_length($fields_to_check_length){
    $form_errors = array();

    foreach($fields_to_check_length as $fields => $minimum_length_req) {
        if(strlen(trim($_POST[$fields])) < $minimum_length_req){
            $form_errors[] = $fields . " is too short, must be {$minimum_length_req} characters long";
        }
    }
    return $form_errors;
}


function show_errors($form_errors_array){
    $errors = "<p><ul style='color: red;'>";

        foreach ($form_errors_array as $the_error) {
            $errors .= "<li> {$the_error} </li>";
        }

        $errors .= "</ul> </p>";
        
        return $errors;

}