<?php $page_title = "Login page"; ?>
<?php require_once("patches/header.php"); ?>
<?php require_once("patches/loginBody.php"); ?>
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
                <input name="remember" value="yes" type="checkbox"> Remember me
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