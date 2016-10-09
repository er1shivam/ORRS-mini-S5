<?php $page_title = "Forgot password page"; ?>
<?php require_once("patches/header.php"); ?>
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
<div class="container">
   <div class="row">
    <div class="col-md-6">
        <h2 >Reset password here</h2><hr>
        <br/>
        <?php if(isset($result)) echo $result; ?>
        <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
            <form action="" method="post">
            <div class="form-group">
                <label for="email1">Email</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Email id">
            </div>
            <div class="form-group">
                <label for="username1">New  Password</label>
                <input type="password" class="form-control" name="new_password" id="exampleInputEmail1" placeholder="New password">
            </div>
            <div class="form-group">
                <label for="Password1">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" id="exampleInputPassword1" placeholder="Confirm Password">
            </div>
            <p><a href="index.php">Back</a> </p>
            <button type="submit" name="reset_btn" class="btn btn-primary pull-right">Reset password</button>
        </form>
    </div>
    </div>
</div>







</body>
</html>