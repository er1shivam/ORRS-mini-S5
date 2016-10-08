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
            $result = "<p style='padding:20px; border: 1px solid gray; color: red;'> New password and confirm password does not match</p>";
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
                    $result = "<p style='padding:20px; border: 1px solid gray; color: green;'> Password Reset Successful</p>";
                }
                else{
                    $result = "<p style='padding:20px; border: 1px solid gray; color: red;'> The email address provided
                                does not exist,please try with a  different email again or signup</p>";
                }
            }catch (PDOException $ex){
                $result = "<p style='padding:20px; border: 1px solid gray; color: red;'> An error occurred: ". $ex->getMessage() . "</p>";
            }
        }
    }
    else{
        if(count($form_errors) == 1){
            $result = "<p style='color: red;'> There was 1 error in the form<br>";
        }else{
            $result = "<p style='color: red;'> There were " .count($form_errors). " errors in the form <br>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Password Reset Page</title>
</head>
<body>
<h2>O R R S </h2><hr>

<h3>Password Reset Form</h3>

<?php if(isset($result)) echo $result; ?>
<?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
<form method="post" action="">
    <table>
        <tr><td>Email:</td> <td><input type="email" value="" name="email"></td></tr>
        <tr><td>New Password:</td> <td><input type="password" value="" name="new_password"></td></tr>
        <tr><td>Confirm Password:</td> <td><input type="password" value="" name="confirm_password"></td></tr>
        <tr><td></td><td><input style="float: right;" type="submit" name="reset_btn" value="Reset Password"></td></tr>
    </table>
</form>
<p><a href="index.php">Back</a> </p>
</body>
</html>