<?php require_once("resource/session.php"); //db connection ?>
<?php require_once("resource/utilities.php"); //db connection ?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php if(isset($page_title)) echo $page_title; ?></title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <script src="js/sweetalert.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="../../ui/index.html">ORRS</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav"><i class="hide"><?php echo guard(); ?></i>
            <li><a href="index.php">Home</a></li>
            <?php if(isset($_SESSION['username'])): ?>
              <li><a href="profile.php">My Profile</a></li>
              <li><a href="logout.php">Logout </a></li>
              <?php else: ?>
              <li><a href="login.php">Login </a>
              <li><a href="signup.php">Sign up</a>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
              <?php endif ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>