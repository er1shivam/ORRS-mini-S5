<!-- <?php require_once("resource/Database.php"); //db connection ?> -->

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Login Page</title>
</head>
<body>
<div class="container">
   <div class="row">
    <div class="col-md-6">
        <h2 >Login</h2><hr>
        <br/>
    <form action="" method="post" >
    <table>
    <tr>
    <td>Username :</td>
    <td><input type="text" name="username" placeholder="Enter your username"/><td/></tr><br/>
    <tr>
    <td>Password :</td> 
    <td><input type="password" name="password" placeholder="Enter password"/></td></tr><br/>
    <tr>
    <td colspan="2" ><input style="float: right;" type="submit" value="Click me to login" name="login" /></td>
    </tr>
    </form>
    </div>
    </div>
</div>
</body>
</html>