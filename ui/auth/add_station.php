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
<?php require_once("patches/addstationlogic.php"); ?>
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

<div class="row">
<div class="col-md-2"></div>
<div class="col-md-6 pull-center">
    <div class="jumbotron">
        <center><h2>Enter Station Details To Add</h2></center>  
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
                        <label for="ex1">Station Id</label>
                        <input name="station_id" class="form-control" id="ex1" type="text"> </div>
                </div>
                <div class="col-md-6">
                    <div class="col-xs-6">
                        <label for="ex2">Station Name</label>
                        <input name="station_name" class="form-control" id="ex2" type="text"> </div>
                </div>
            </div>
            <br/>
               <div class="col-md-9">
                <center>
                    <input type="submit" name="addstation" class="btn btn-info" value="Add Station To Database"> </center>
            </div>
    </div>
    </form>
    </div>
<div class="table">
  <table class="table">
  <tr>
    <tr>
    <!--th>Train id</th-->
<th>Station name</th> 
<th>sourcestid</th>&nbsp; &nbsp;

<hr/> 
<?php
 $sqlInsert1 =  "SELECT *FROM train_route";
        $statement1 = $db->prepare($sqlInsert1);
        $statement1->execute();



while($row=$statement1->fetch())
{  
    ?>
    <tr class="alt">
  <td><?php echo $row['station_id']; ?></td>
    <td><?php echo $row['station_name']; ?></td>
</tr>
</div>
<?php 
}
?>




<?php endif ?>

<?php require_once("patches/footer.php"); ?>