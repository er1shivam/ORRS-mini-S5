<?php require_once("resource/session.php"); //db connection ?>


<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Homepage</title>
</head>
<body>
<h2>O R R S</h2><hr>

<?php if(!isset($_SESSION['username'])): ?>
<p> You are currently not sign in <a href="login.php">Login</a>Not yet a member?
<a href="signup.php">Sign up</a>
</p>
<?php else: ?>
<p>
You are logged in as <?php echo $_SESSION['username']; ?><a href="logout.php">log out </a> </p>
<?php endif ?>


</body>
</html>