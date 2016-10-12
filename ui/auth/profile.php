<?php 
$page_title = "Profile page";
require_once("patches/header.php");
require_once("patches/profileBody.php"); 
?>

<div class="container">
    <div>
    <h1>Profile</h1>
    <?php if(!isset($_SESSION['username'])): ?>
    <p class="lead">You are not authorized to view this page <a href="login.php">Login</a>
    Not yet a member? <a href="signup.php">Signup</a></p>
    <?php else: ?>
        <section class="col col-lg-7">
        <div class="row col col-lg-3" style="margin-bottom: 10px;">
            <img src="<?php if(isset($profile_pic)) echo $profile_pic; ?>" class="img img-rounded" width="200" height="130">
        </div>

            <table class="table table-bordered table-condensed">
            <tr><th style="width: 20%;">Username:</th><td><?php if(isset($username)) echo $username; ?></td></tr>
            <tr><th>Email:</th><td><?php if(isset($email)) echo $email; ?></td></tr>
            <tr><th>Date joined: </th><td><?php if(isset($date_joined)) echo $date_joined; ?></td></tr>
            <tr><th></th><td><a class="pull-right" href="edit-profile.php?user_identity=<?php if(isset($encode_id)) echo $encode_id; ?>">
            <span class="glyphicon glyphicon-edit"></span>Edit profile</a></td></tr>
            </table>
         </section>
         <?php endif ?>
    </div>
</div>
<?php require_once 'patches/footer.php'; ?>