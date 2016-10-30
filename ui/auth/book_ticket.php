<?php
ob_start();
require_once("resource/Database.php"); //db db ?>
<?php require_once("resource/utilities.php"); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
<?php $page_title = "ORRS"; ?>
<?php require_once("patches/header.php"); ?>
 <?php if(!isset($_SESSION['username'])): ?>
 
<div class="container">
    <div class="flag">
        <h1>O R R S</h1>
    <p> You are currently not sign in <br/>
    <a href="adminlogin.php">Login here
    </p>
    </div>
</div>

<?php else: ?>
<div>
        <?php if(isset($result)) echo $result; ?>
        <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
</div>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="admin/style.css">
    <link rel="stylesheet" href="admin/main.css">
    <title>Users Page</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <br/>
            <div class="col-md-3">
                <div class="clearfix"> </div>
            </div>
            <div class="col-md-6">
                <div class="jumbotron">
                    <h2>Users Area</h2> </div>
            </div>
        </div>
        <div class="col-md-9">
            <center>
                <h1>Enter Details To Book train</h1></center>
        </div>
        <br/>
        <form  method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="col-xs-6">
                        <label for="ex1">Train No.</label>
                        <input class="form-control" name="trainno" id="ex1" type="text" required> </div>
                </div>
                <div class="col-md-6">
                    <div class="col-xs-6">
                        <label for="ex2">Train class</label>
                        <input class="form-control" name="tp" placeholder="SL" id="ex2" type="text"> </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-6">
                    <div class="col-xs-6">
                        <label for="ex1">Boarding Station</label>
                        <input class="form-control" name="source" id="ex1" type="text" required> </div>
                </div>
                <div class="col-md-6">
                    <div class="col-xs-6">
                        <label for="ex2">Reservation upto</label>
                        <input class="form-control" id="ex2" name="destination" type="text"> </div>
                </div>
            </div>
            <div class="row">
                <br/>
                <div class="col-md-6">
                    <div class="col-xs-6">
                        <label for="ex1">No of seats</label>
                        <input placeholder="5" name="seat" class="form-control" id="ex1" type="number" required> </div>
                </div>
                <div class="col-md-6">
                    <div class="col-xs-6">
                        <label for="ex2">Date of journey</label>
                        <input class="form-control" id="ex2" name="journey_date" type="date"> </div>
                </div>
            </div>
            <div class="row">
                <br/>
                <div class="col-md-6">
                    <div class="col-xs-6">
                        <label for="ex1">Passenger Name</label>
                        <input placeholder="" class="form-control" id="ex1" name="Name" type="text"> </div>
                </div>
                <div class="col-md-6">
                    <div class="col-xs-6">
                        <label for="ex2">Passenger Age</label>
                        <input placeholder="18" class="form-control" name="age" id="ex2" type="text" required> </div>
                </div>
            </div>
            <br/>
            <br/>
            <div class="col-md-9">
                <center>
                    <input type="submit" name="submit" class="btn btn-info" value="Book Ticket"> </center>
            </div>
    </div>
    </form>
    </div>

<?php
if(isset($_POST['submit'])){

$Trainno=($_POST["trainno"]);
$tp=($_POST["tp"]);
$Name=($_POST["Name"]);
$age=($_POST["age"]);
//$sex=($_POST["sex"]);
$seat=($_POST["seat"]);
$source=($_POST["source"]);
$destination=($_POST["destination"]);


    $sqlInsert1 =  "SELECT {$tp} FROM trainseat";
        $statement1 = $db->prepare($sqlInsert1);
        $statement1->execute();


        if($row=$statement1->fetch()){
        $ts=$row[$tp];
        }

        $seat=($_POST["seat"]);
        if ($ts < $seat){
            echo "seats not available";
            exit();
        }
        else{
        $ts= $ts-$seat;
 //echo $seat;

        $q =  "UPDATE trains_info set {$tp}='$ts' WHERE train_no= '$Trainno'";
        $statement2 = $db->prepare($q);
        $statement2->execute();
        $usnm = $_SESSION['username'];
        
$sqlInsert =  "INSERT INTO ticket (trainno, username, Name, age, seat, source,destination) ";
        $sqlInsert .= "VALUES (:tno,:usnm,:name,:age, :seat, :source, :destination)";
        $statement = $db->prepare($sqlInsert);
        $statement->execute(array(':tno' => $Trainno,':usnm' => $usnm, ':name' => $Name,':age' => $age, ':seat' => $seat, ':source' => $source, ':destination' => $destination));
        

 if($statement -> rowCount() == 1){
        $que = "SELECT ticketid FROM ticket WHERE NAME = :nm";
        $statement3 = $db->prepare($que);
        $statement3->execute(array(':nm' => $Name));

      $_SESSION['tktid'] ='';
        $id = '';
        if($row = $statement3->fetch()){
         $id = $row['ticketid'];
         $_SESSION['tktid'] = $id;   
        }
        $text = "NOTE this UNIQUE ID NO " . $id;
        $result = "<script type=\"text/javascript\"> 
                    swal({   
                         title: \"Congrats Your ticket booked!\", 
                        type:'success',
                        timer: 2000,  
                        text: \" $text \",
                        confirmButtonText: \"Thank you!\",
                        });
                        setTimeout(function(){
                            window.location.href = 'ticket.php'; 
                            }, 2000);
                        </script>";
        echo $result;
        
 }

        }

        
}

?>
<?php endif ?>

<?php require_once("patches/footer.php"); ?>