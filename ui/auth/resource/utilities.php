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
//list and return errors
function show_errors($form_errors_array){
    $errors = "<p><ul style='color: red;'>";

        foreach ($form_errors_array as $the_error) {
            $errors .= "<li> {$the_error} </li>";
        }

        $errors .= "</ul> </p>";
        
        return $errors;

}

function validate_username($user_cred){
   global $user_error;
    if (!ctype_alnum($user_cred)) {
   $form_errors[] = " username invalid";
    }
    return $form_errors;
}
//error message 
function flashMessage($message, $status ="fail"){
    if( $status === "pass"){
        //success msg
        $data ="<div class=\"alert alert-success \">{$message}";
    }else{
        //fail msg
        $data = "<div class=\"alert alert-danger \">{$message}";
    }
    return $data;
}
function redirectTo($page){
    header("Location: {$page}.php");
}
// check duplicates
function checkDuplicateEmails($value,$db){
        try{
                $sqlQuery = "SELECT email FROM users WHERE email=:email";
                $statement = $db->prepare($sqlQuery);
                $statement->execute(array(':email' => $value));

            if($row = $statement->fetch()){
                // duplicate entered
                return true;
            }
            return false;
        }catch(PDOException $ex){

        }

}

function checkDuplicateUsername($value,$db){
        try{
                $sqlQuery = "SELECT username FROM users WHERE username=:username";
                $statement = $db->prepare($sqlQuery);
                $statement->execute(array(':username' => $value));

            if($row = $statement->fetch()){
                // duplicate entered
                return true;
            }
            return false;
        }catch(PDOException $ex){

        }

}

function signout(){
    unset($_SESSION['username']);
    unset($_SESSION['id']);


   // if(isset($_COOKIE[]))    
    session_destroy();
}

function guard(){

    $isValid = true;
    $inactive = 10 * 1;
    $fingerprint = md5( $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);

    if((isset($_SESSION['fingerprint']) && $_SESSION['fingerprint'] != $fingerprint)){
        $isValid = false;
        signout();
    }else if((isset($_SESSION['last_active']) && (time() - $_SESSION['last_active']) > $inactive) && $_SESSION['username']){
        $isValid = false;
        signout();
    }else{
        $_SESSION['last_active'] = time();
    }
    return $isValid;

}




?>