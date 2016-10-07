<?php require_once("resource/Database.php"); //db connection ?>

<?php
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $mobile = $_POST['mobileno'];
    
    try{
        $sqlInsert =  "INSERT INTO users (email, username, password, mobileno, datejoied) ";
        $sqlInsert .= "VALUES (:email, :username, :password, :mobileno, now())";



    }catch(){


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
        <h2 >Register</h2><hr>
        <br/>


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
            <td>Mobile no :</td>
            <td><input type="text" maxlength="10" name="mobileno" placeholder="Enter your mobileno"/><td/></tr><br/>        
        <tr>
            <td colspan="2" ><input style="float: right;" name="submit" type="submit" value="Let's Signup" /></td>
        </tr>
    </form>
    </div>
    </div>
</div>
</body>
</html>