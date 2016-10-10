<?php
include_once 'resource/Database.php';
include_once 'resource/utilities.php';

if(isset($_POST['reset_btn'])){ //if reset
    
    $form_errors = array(); //array to store errors

    //Form validation
    $required_fields = array('email', 'new_password', 'confirm_password');

    // check empty field and put into error array
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    //check  minimum length
    $fields_to_check_length = array('new_password' => 6, 'confirm_password' => 6);
    $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

    //if error array is empty process form
    if(empty($form_errors)){
        //collect form data and store in variables
        $email = $_POST['email'];
        $password1 = $_POST['new_password'];
        $password2 = $_POST['confirm_password'];
        //confirm  both password 
        if($password1 != $password2){
            $result = flashMessage("New password and confirm password does not match");
        }else{
            try{
                //verify if email exist in the database
                $sqlQuery = "SELECT email FROM users WHERE email =:email";
                //use PDO prepare sanitize data
                $statement = $db->prepare($sqlQuery);
                //execute the query
                $statement->execute(array(':email' => $email));
                //check if record exist
                if($statement->rowCount() == 1){
                    //hash
                    $hashed_password = md5($password1);
                    $sqlUpdate = "UPDATE users SET password =:password WHERE email=:email"; //update
                    //use PDO prepare
                    $statement = $db->prepare($sqlUpdate);
                    //execute the statement
                    $statement->execute(array(':password' => $hashed_password, ':email' => $email));
                    $result = "<script type=\"text/javascript\"> 
                    swal({   
                         title: \"Updated!\", 
                        type:'success',  
                        text: \"Password Reset Successful\",
                        confirmButtonText: \"Thank you!\",    
                        
                        });
                        </script>";

                  //$result = "<p style='padding:20px; border: 1px solid gray; color: green;'> Password Reset Successful</p>";
                }
                else{
                    $result = "<script type=\"text/javascript\"> 
                    swal({   
                         title: \"OOPS!\", 
                        type:'error',  
                        text: \"Email doesn't exist. Please try with a different email.\",
                        confirmButtonText: \"Ok!\",    
                        
                        });
                        </script>";
                }
            }catch (PDOException $ex){
                $result = "<p style='padding:20px; border: 1px solid gray; color: red;'> An error occurred: ". $ex->getMessage() . "</p>";
            }
        }
    }
    else{
        if(count($form_errors) == 1){
            $result = flashMessage("There was 1 error in the form<br>");
        }else{
            $result = flashMessage("There were " .count($form_errors). " errors in the form <br>");
        }
    }
}
?>