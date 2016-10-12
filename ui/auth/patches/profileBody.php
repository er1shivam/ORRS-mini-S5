<?php 
include_once('resource/Database.php');
require_once('resource/utilities.php');

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];



    $sqlQuery = "SELECT * FROM users WHERE id = :id";
    $statement = $db->prepare($sqlQuery);
    $statement->execute(array(':id' => $id));

    while($rs = $statement->fetch()){
        $username = $rs['username'];
        $email = $rs['email'];
        $date_joined = strftime("%b %d, %Y", strtotime($rs["datejoined"]));
    }

    $encode_id = base64_encode("encodeuserid{$id}");

} 