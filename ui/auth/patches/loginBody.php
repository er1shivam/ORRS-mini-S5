<?php
ob_start();
require_once("resource/Database.php"); //db connection ?>
<?php require_once("resource/utilities.php"); ?>

<?php
    if(isset($_SESSION['username'])){
       echo $welcome = "<script type=\"text/javascript\"> swal({   
                        title: \"Signed in!\",
                        text: \"You are already signed in. \",   
                        timer: 2000,   
                        showConfirmButton: false 
                        });
                        setTimeout(function(){
                            window.location.href = 'index.php'; 
                            }, 2000); 

                        </script>";
    }
    else
    {
        if(isset($_POST['login'])){
         $form_errors = array(); // create a array to store the errors
        //validate
        $required_fields = array('username', 'password');
        $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

        if(empty($form_errors)){
            $user = $_POST['username'];
            $password = $_POST['password'];
            $sqlQuery = "SELECT * FROM users WHERE username = :username "; //check if user exist in database
            $statement = $db->prepare($sqlQuery);
            $statement->execute(array(':username' => $user));

            if($row = $statement->fetch()){
                $id = $row['id'];
                $hashed_password = $row['password'];
                $username = $row['username'];
                if(md5($password) == $hashed_password){ //check if credential is right
                    $_SESSION['id'] = $id;
                    $_SESSION['username'] = $username;

                    // REMOTE_ADDR AND HTTP_USER_AGENT ARE USED TO GET USER IP AND BROWSER/MACHINE 
                    // DETAILS.THIS IS USED TO IDENTIFY USER AND LOGOUT IF THEY ARE INACTIVE
                    // HTTP_USER_AGENT IS STRING GENERATED BY BROWSER AND SENT TO SERVER
                    $fingerprint = md5( $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
                    $_SESSION['last_active'] = time();
                    $_SESSION['fingerprint'] = $fingerprint;


                    echo $welcome = "<script type=\"text/javascript\"> swal({   
                        title: \"Welcome back $username !\", 
                        type:'success',  
                        text: \"You're being logged in.\",   
                        timer: 2000,   
                        showConfirmButton: false 
                        });
                        setTimeout(function(){
                            window.location.href = 'index.php'; 
                            }, 2000); 

                        </script>";
                   // redirectTo('index');
                }else{
                    $result = flashMessage("Invalid username or password <br />");
                }
            
            }else{
                $result = flashMessage("Incorrect username");
            }
        }else{
            if(count($form_errors) == 1){
                $result = flashMessage("There was 1 error in the form <br />");
            }else{
                $result = flashMessage("There were ".count($form_errors)." errors in the form <br />");
            }
        }
    }
    }
?>