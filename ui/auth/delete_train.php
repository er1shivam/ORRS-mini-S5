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
<?php require_once("patches/deletetrainlogic.php"); ?>

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
$nm = gettrainname($db);
$no = gettrainno($db);
?>


        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-6 pull-center">
                <div class="jumbotron">
                    <center><h2>Enter Train Details To Delete</h2></center>  
                </div>
            </div>
            </div>
        <div class="col-md-9">
        
        </div>
        <br/>
        <form action="" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="col-xs-6 pull-right">
                        <label for="ex1">Train Name</label>
                        <select class="form-control" id="ex1" name="trainno">
                       <?php    
                       for($i=0; $i < sizeof($no); $i++)
                           {
                              echo "<option value="."\"".$no[$i]."\">".$nm[$i]."</option><br/>";
                           }
                        ?>
                        </select></div>
                </div>
            </div>
            <br/>
            <div class="col-md-9">
                <center>
                    <input type="submit" name="deletetrain" class="btn btn-info" value="Delete Train From Database"> </center>
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
<th>sourcestid</th>&nbsp; &nbsp;
<th>destinationstid</th>
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
    <td><?php echo $source ;?></td>&nbsp;&nbsp;
    <td><?php echo $destination;?></td>&nbsp;

</tr>

</tr>
</div>
<?php 
}
?>

<?php endif ?>

<?php require_once("patches/footer.php"); ?>