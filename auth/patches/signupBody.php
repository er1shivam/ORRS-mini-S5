<?php require_once("resource/Database.php"); //db connection ?>
<?php require_once("resource/utilities.php"); ?>
<?php
    $form_errors = array();
    if(isset($_POST['submit'])){

        $required_fields = array('email', 'username', 'password');
        //check empty fields and merge the error msg
        $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

        //check min length
        $fields_to_check_length = array('username' => 4, 'password' => 6);
        $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));//fnctncall

        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(checkDuplicateEmails($email, $db)){
            $result = flashMessage("Email is already registered");
        }    
        else if(checkDuplicateUsername($username, $db)){
            $result = flashMessage("Username is already taken");
        }
        else if(empty($form_errors)) {
            // if empty, process data
            
            $hashed_password = md5($password);
            try{
                $sqlInsert =  "INSERT INTO users (email, username, password, datejoined) ";
                $sqlInsert .= "VALUES (:email, :username, :password, now())";

                $statement = $db->prepare($sqlInsert);
                $statement->execute(array(':email' => $email, ':username' => $username, ':password' => $hashed_password));

                if($statement -> rowCount() == 1){
                    $result = "<script type=\"text/javascript\"> 
                    swal({   
                         title: \"Congrats $username !\", 
                        type:'success',  
                        text: \"Registration successful.\",
                        confirmButtonText: \"Thank you!\",    
                        
                        });
                        </script>";
                //$result = flashMessage("Registration succesful" ,"pass");
                }
            }catch (PDOException $ex){
                    $result = flashMessage("Error occured : " . $ex->getMessage() );
            }
    }
    else{
        if(count($form_errors) == 1){
             $result  = flashMessage("There was one error in the form <br/>");
        }
        else{
        $result  = flashMessage("There were " . count($form_errors). " errors in the form <br />");
        }
    }
}

?>