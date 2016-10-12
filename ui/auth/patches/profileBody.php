<?php 
include_once('resource/Database.php');
require_once('resource/utilities.php');

if((isset($_SESSION['id']) || isset($_GET['user_identity'])) && !isset($_POST['updateProfileBtn'])){
    if(isset($_GET['user_identity'])){
        $url_encoded_id = $_GET['user_identity'];
        $decode_id = base64_decode($url_encoded_id);
        $user_id_array = explode("encodeuserid", $decode_id);
        $id = $user_id_array[1];
    }else{
        $id = $_SESSION['id'];
    }
    // to list the profile details on profile page
    $sqlQuery = "SELECT * FROM users WHERE id = :id";
    $statement = $db->prepare($sqlQuery);
    $statement->execute(array(':id' => $id));

    while($rs = $statement->fetch()){
        $username = $rs['username'];
        $email = $rs['email'];
        $date_joined = strftime("%b %d, %Y", strtotime($rs["datejoined"]));
    }
    
    $user_pic = "uploads/".$username.".jpg";
    $default = "uploads/default.jpg";
    // to set profile pic called in profile.php
    if(file_exists($user_pic)){
        $profile_pic = $user_pic;
    }else{
        $profile_pic = $default;
    }

    $encode_id = base64_encode("encodeuserid{$id}");
}else if(isset($_POST['updateProfileBtn'])){
    //array to store errors
    $form_errors = array();

    $required_fields = array('email', 'username');
    //check errors and store the merge all errors
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    $fields_to_check_length = array('username' => 4);
    $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));
    
    isset($_FILES['avatar']['name']) ? $avatar = $_FILES['avatar']['name'] : $avatar = null;
    if($avatar !=null){
        $form_errors = array_merge($form_errors, isValidImage($avatar));
    }
    //collect data

    $email = $_POST['email'];
    $username = $_POST['username'];
    $hidden_id = $_POST['hidden_id'];
    
    if(empty($form_errors)){
        try{
            //update user profile details
            $sqlUpdate = "UPDATE users SET username =:username, email =:email WHERE id =:id";
            $statement = $db->prepare($sqlUpdate);
            $statement->execute(array(':username' => $username, ':email' => $email, ':id' => $hidden_id));

            if($statement->rowCount() == 1){
                $result = "<script type=\"text/javascript\">
                swal(\"Updated!\",\"Profile Update Successfully.\",\"success\"); </script>";
            }else{
                $result = "<script type=\"text/javascript\">
                swal(\"Nothing happened\",\"You have not made any changes.\"); </script>";
            }

        }catch(PDOException $ex){
            $result = flashMessage("An error occured in :". $ex->getMessage());
        }

    }
    else{
        if(count($form_errors) == 1){
             $result  = flashMessage("There was one error in the form <br/>");
        }
        else{
        $result  = flashMessage("There were " . count($form_errors). " errors in the form <br />");
        }
    }
}  