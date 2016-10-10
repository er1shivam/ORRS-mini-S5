<?php $page_title = "ORRS"; ?>
<?php require_once("patches/header.php"); ?>

    <div class="container">


      <div class="flag">
        <h1>O R R S</h1>
        <p class="lead">This is a online railway reservation system in PHP .<br>
         Right now i am working on user interface</p>


        <?php if(!isset($_SESSION['username'])): ?>
        <p> You are currently not sign in <a href="login.php">Login </a>Not yet a member?
            <a href="signup.php">Sign up</a>
        </p>
        <?php else: ?>
        <p>
             You are logged in as <?php echo $_SESSION['username']; ?><a href="logout.php">log out </a>
        </p>
        <?php endif ?>
      </div>      
    </div>

<?php require_once("patches/footer.php"); ?>