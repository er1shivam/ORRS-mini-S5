<?php
  //define("DB_SERVER","localhost");
  define("DB_USER","orrs");
  define("DB_PASS","orrs_login"); 
 // define("DB_NAME","register");
  $dsn = 'mysql:host=localhost; dbname=orrs';

  try{
    //create instance of PDO class
    $db = new PDO($dsn, DB_USER , DB_PASS);
    
    //set pdo error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
    // echo "connected to the register database";
  }catch(PDOException $ex){
    echo "connection failed" . $ex->getMessage();
  }


  ?>