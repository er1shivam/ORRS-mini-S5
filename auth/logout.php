<?php require_once("resource/session.php") ?>
<?php require_once("resource/utilities.php"); ?>
<?php
ob_start();
session_destroy();
redirectTo('index');




ob_end_flush();
?>