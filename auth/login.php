<?php require_once("resource/Database.php"); //db connection ?>
<?php require_once("resource/utilities.php"); ?>
<?php $page_title = "ORRS"; ?>
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
        <h2 >Login</h2><hr>
        <br/>
        <?php if(isset($result)) echo $result; ?>
        <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
    <form action="" method="post" >
    <table>
        <tr>
        <td>Username :</td>
        <td><input type="text" name="username" placeholder="Enter your username"/><td/>
        </tr><br/>
        <tr>
        <td>Password :</td> 
        <td><input type="password" name="password" placeholder="Enter password"/></td>
        </tr><br/>
        <tr>
        <td style="padding-top: 20px;"> <a href="forgot_password.php" >Forgot password</td>
        <td style="padding-top: 20px;"><input style="float: right;" type="submit" value="Click me to login" name="login" /></td>
        </tr>
    </table>
    </form>
  </div>
 </div>
</div>

<?php require_once("patches/footer.php"); ?>