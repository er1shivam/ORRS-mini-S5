<?php
ob_start();
require_once("resource/Database.php"); //db connection ?>
<?php require_once("resource/utilities.php"); ?>
<?php $page_title = "Login page"; ?>
<?php require_once("patches/header.php"); ?>
<?php
    
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
                    redirectTo('index');
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

?>
<div class="container">
   <div class="row">
    <div class="col-md-6">
        <h2 >Login Form</h2><hr>
        <br/>
        <div>
        <?php if(isset($result)) echo $result; ?>
        <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>

        </div>
        

        <form action="" method="post">
            <div class="form-group">
                <label for="username1">Username</label>
                <input type="text" class="form-control" name="username" id="exampleInputEmail1" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="Password1">Password</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
            </div>
           
            <div class="checkbox">
                <label>
                <input type="checkbox"> Remember me
                </label>
            </div>
             <a href="forgot_password.php" >Forgot password</a>
            <button type="submit" name="login" class="btn btn-primary pull-right">Submit</button>
        </form>


  </div>
 </div>
</div>

<?php require_once("patches/footer.php");
 ob_end_flush();
 ?>