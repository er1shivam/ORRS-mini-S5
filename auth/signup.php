<?php require_once("resource/Database.php"); //db connection ?>
<?php

    if(isset($_POST['submit'])){

        $form_errors = array(); //error validation

        $required_fields = array('email', 'username', 'password');

        foreach($required_fields as $fields){
            if(!isset($_POST[$fields]) || $_POST[$fields] == NULL){
                $form_errors[] = $fields;
            }
        }

        if (empty($form_errors)) {
            // if empty process data
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            
        
            $hashed_password = md5($password);

            try{
                $sqlInsert =  "INSERT INTO users (email, username, password, datejoined) ";
                $sqlInsert .= "VALUES (:email, :username, :password, now())";

                $statement = $db->prepare($sqlInsert);
                $statement->execute(array(':email' => $email, ':username' => $username, ':password' => $hashed_password));

                if($statement -> rowCount() == 1){
                    $result = "<p ><h1 style='padding: 20px; color: green;'>Registration succesful</h1></p>";
                }
            }catch (PDOException $ex){
                    $result = "<p style='padding: 20px; color: red;'><h1>Error occured " . $ex->getMessage() . " </h1></p>";
            }
    }
    else{
        $result  = "<p style='color: red;'> There were " . count($form_errors) ;
        $result .= " errors in the form <br/>"; 

        $result .= "<ul style='color: red;\'>";

        foreach ($form_errors as $error) {
            $result .= "<li> {$error} " . " can't be blank " ." </li>";
        }

        $result .= "</ul> </p>";
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