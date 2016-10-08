<?php $page_title = "Signup page"; ?>
<?php require_once("patches/header.php"); ?>
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
<div class="container">
   <div class="row">
    <div class="col-md-6">
        <h2 >Register here</h2><hr>
        <br/>
        <?php if(isset($result)) echo $result; ?>
        <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
            <form action="" method="post">
            <div class="form-group">
                <label for="email1">Email</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Email id">
            </div>
            <div class="form-group">
                <label for="username1">Username</label>
                <input type="text" class="form-control" name="username" id="exampleInputEmail1" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="Password1">Password</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button type="submit" name="submit" class="btn btn-primary pull-right">Submit</button>
        </form>
    </div>
    </div>
</div>


<?php require_once("patches/footer.php"); ?>