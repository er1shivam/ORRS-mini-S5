<?php
ob_start();
require_once("resource/Database.php"); //db connection ?>
<?php require_once("resource/utilities.php"); ?>
<?php $page_title = "ORRS"; ?>
<?php require_once("patches/header.php"); ?>
<?php require_once("patches/addtrainlogic.php"); ?>
 <?php if(!isset($_SESSION['username'])): ?>
<div class="container">
    <div class="flag">
        <h1>O R R S</h1>
    <p> You are currently not sign in as ADMIN <br/>
    <a href="adminlogin.php">Login here
    </p>
    </div>
</div>

<?php else: ?>
<div>
        <?php if(isset($result)) echo $result; ?>
        <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
</div>
<?php    
$id = getstationid($db);
$nm = getstationname($db);
?>

<div class="row">
<div class="col-md-2"></div>
<div class="col-md-6 pull-center">
    <div class="jumbotron">
        <center><h2>Enter Train Details To Add</h2></center>  
    </div>
</div>
</div>
        <div class="col-md-9">
        
        </div>
        <br/>
        <form action="" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="col-xs-6">
                        <label for="ex1">Train Name</label>
                        <input name="train_name" class="form-control" id="ex1" type="text"> </div>
                </div>
                <div class="col-md-6">
                    <div class="col-xs-6">
                        <label for="ex2">Train Number</label>
                        <input name="train_no" class="form-control" id="ex2" type="text"> </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-6">
                    <div class="col-xs-6">
                        <label for="ex1">Source</label>
                        <select class="form-control" id="ex1" name="s_station_id">
                       <?php    
                       for($i=0; $i < sizeof($id); $i++)
                           {
                              echo "<option value="."\"".$id[$i]."\">".$nm[$i]."</option><br/>";
                           }
                        ?>
                        </select> </div>
                </div>
                <div class="col-md-6">
                    <div class="col-xs-6">
                        <label for="ex2">Destination</label>
                         <select class="form-control" id="ex1" name="d_station_id">
                       <?php    
                       for($i=0; $i < sizeof($id); $i++)
                           {
                              echo "<option value="."\"".$id[$i]."\">".$nm[$i]."</option><br/>";
                           }
                        ?>
                        </select> </div>
                </div>
            </div>
            <div class="row">
                <br/>
                <div class="col-md-6">
                    <div class="col-xs-6">
                        <label for="ex1">Train Timing</label>
                        <input placeholder="add in train_schedule" class="form-control" id="ex1" type="text" disabled> </div>
                </div>
                <div class="col-md-6">
                    <div class="col-xs-6 form-group">
                        <label for="ex2">Train Type</label><br/> 
                        <select class="form-control" name="type">
                            <option value="SF">Superfast</option>
                            <option value="EX">Express</option>
                        </select>
                        
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="col-xs-6">
                        <label for="ex1">No of seats in SL</label>
                        <input placeholder="50" name="sl1" class="form-control" id="ex1" type="number"> </div>
                </div>
                <div class="col-md-6">
                    <div class="col-xs-6 form-group">
                        <label for="ex2">No of seats in AC</label><br/> 
                        <input placeholder="50" name="ac1" class="form-control" id="ex1" type="number"> </div>

                        
                        </div>
                </div>
            </div>
            <br/>
            <br/>
            <div class="col-md-9">
                <center>
                    <input type="submit" name="submit" class="btn btn-info" value="Add Train To Database"> </center>
            </div>
    </div>
    </form>
    </div>






<?php endif ?>

<?php require_once("patches/footer.php"); ?>