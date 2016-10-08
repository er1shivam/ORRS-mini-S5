<?php require_once("resource/session.php") ?>
<?php

session_destroy();
header("Location: index.php");
?>