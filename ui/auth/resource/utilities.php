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
    $inactive = 60 * 15;
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

function isValidImage($file){
    $form_errors = array(); //array to store errors
    $part = explode(".",$file); //storing the string seperated by .
    $extension = end($part); // string the last part that is the extension

    //check extension_loaded
    switch(strtolower($extension)){
        case 'jpg' :
        case 'gif' :
        case 'png' :
        case 'bmp' :
        case 'jpeg' :

        return $form_errors;
    }

    $form_errors[] = "." . $extension . " is not a valid image format" ;
    return $form_errors;

}

function getstationid($db){
    $st_id = "SELECT station_id FROM train_route";     
    $statement = $db->prepare($st_id);
    $statement->execute();
    while($row = $statement->fetch()){
    $id[] = $row['station_id'];
}
return $id;
}
function getstationname($db){
    $st_nm = "SELECT station_name FROM train_route"; 
    $statement = $db->prepare($st_nm);
    $statement->execute();
    while($row = $statement->fetch()){
        $nm[] = $row['station_name'];
    }
return $nm;
}
function getstname($db,$stid){
    $st_nm = "SELECT station_name FROM train_route WHERE station_id = :stid"; 
    $statement = $db->prepare($st_nm);
    $statement->execute(array(':stid' => $stid));
    while($row = $statement->fetch()){
        $nm = $row['station_name'];
    }
return $nm;
}


function gettrainname($db){
    $nm = array();
    $st_nm = "SELECT train_name FROM trains_info"; //check if user exist in database
    $statement = $db->prepare($st_nm);
    $statement->execute();
    while($row = $statement->fetch()){
        $nm[] = $row['train_name'];
    }
return $nm;
}
function gettrainno($db){
    $nm = array();
    $st_nm = "SELECT train_no FROM trains_info"; //check if user exist in database
    $statement = $db->prepare($st_nm);
    $statement->execute();
    while($row = $statement->fetch()){
        $nm[] = $row['train_no'];
    }
return $nm;
}




?>