<?php
ob_start();
require_once("resource/Database.php"); //db connection ?>
<?php require_once("resource/utilities.php"); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
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
                        <input placeholder="50" name="sl" class="form-control" id="ex1" type="number"> </div>
                </div>
                <div class="col-md-6">
                    <div class="col-xs-6 form-group">
                        <label for="ex2">No of seats in 3AC</label><br/> 
                        <input placeholder="50" name="ac3" class="form-control" id="ex1" type="number"> </div>

                        
                        </div>
                </div>

                <div class="row">
                <div class="col-md-6">
                    <div class="col-xs-6">
                        <label for="ex1">No of seats in 2AC</label>
                        <input placeholder="50" name="ac2" class="form-control" id="ex1" type="number"> </div>
                </div>
                <div class="col-md-6">
                    <div class="col-xs-6 form-group">
                        <label for="ex2">No of seats in 1AC</label><br/> 
                        <input placeholder="50" name="ac1" class="form-control" id="ex1" type="number"> </div>

                        
                        </div>
                </div>
            </div>
           
            <br/>
            <br/>
            <div class="col-md-9">
                <center>
                    <input type="submit" name="submit" class="btn btn-info" value="Add Train To Database"> </center><br/> 
            </div>
    </div>
    </form>
    </div>

<div class="table">
  <table class="table">
  <tr>
    <tr>
    <!--th>Train id</th-->
<th>Train no.</th>
<th>Train name</th> 
<th>Source Station</th>&nbsp; &nbsp;
<th>Destination Station</th>
<hr/> 
<?php
 $sqlInsert1 =  "SELECT *FROM trains_info";
        $statement1 = $db->prepare($sqlInsert1);
        $statement1->execute();



while($row=$statement1->fetch())
{  
  $Trainno=$row['train_no'];
  $trainname=$row['train_name'];
  $source=$row['s_station_id'];
  $destination=$row['d_station_id'];


 ?>

    <tr class="alt">
    <!--td><?//php echo $row['trainid '];?></td-->
    <td><?php echo $Trainno ;?></td>
    <td><?php echo $trainname; ?></td>
    <td><?php echo getstname($db,$source) ;?></td>&nbsp;&nbsp;
    <td><?php echo getstname($db,$destination)?></td>&nbsp;

</tr>

</tr>
</div>
<?php 
}
?>



<?php endif ?>

<?php require_once("patches/footer.php"); ?>