<?php $page_title = "Forgot password page"; ?>
<?php require_once("patches/header.php"); ?>
<?php require_once("patches/forgotPassBody.php"); ?>
<div class="container">
   <div class="row">
    <div class="col-md-6">
        <h2 >Reset password here</h2><hr>
        <br/>
       <div>
        <?php if(isset($result)) echo $result; ?>
        <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
        </div>
            <form action="" method="post">
            <div class="form-group">
                <label for="email1">Email</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Email id">
            </div>
            <div class="form-group">
                <label for="username1">New  Password</label>
                <input type="password" class="form-control" name="new_password" id="exampleInputEmail1" placeholder="New password">
            </div>
            <div class="form-group">
                <label for="Password1">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" id="exampleInputPassword1" placeholder="Confirm Password">
            </div>
            <p><a href="index.php">Back</a> </p>
            <button type="submit" name="reset_btn" class="btn btn-primary pull-right">Reset password</button>
        </form>
    </div>
    </div>
</div>

</body>
</html>