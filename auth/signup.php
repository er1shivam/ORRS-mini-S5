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
                    $result = flashMessage("Registration succesful" ,"pass");
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
        $result  = flashMessage("There was" . count($form_errors). " in the form <br />");
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Register Page</title>
</head>
<body>
<div class="container">
   <div class="row">
    <div class="col-md-6">
        <h2 >Register here</h2><hr>
        <br/>
<?php if(isset($result)) echo $result; ?>
<?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
    <form action="" method="post">
    <table>
        <tr>
            <td>Email :</td>
            <td><input type="email" name="email" placeholder="Enter your email"/><td/></tr><br/>
        <tr>
            <td>Username :</td>
            <td><input type="text" name="username" placeholder="Enter your username"/><td/></tr><br/>
        <tr>
            <td>Password :</td> 
            <td><input type="password" name="password" placeholder="Enter password"/></td></tr><br/>
        <tr>
      <tr>
            <td colspan="2" ><input style="float: right;" name="submit" type="submit" value="Let's Signup" /></td>
        </tr>
    </form>
    </div>
    </div>
</div>
</body>
</html>