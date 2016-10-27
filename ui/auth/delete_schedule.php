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
<?php require_once("patches/deleteschedulelogic.php"); ?>

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
                    <center><h2>Select Train Details To Delete its schedule</h2></center>  
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
                    <input type="submit" name="deleteschedule" class="btn btn-info" value="Delete Schedule From Database"> </center>
            </div>
    </div>
    </form>
    </div>

<?php endif ?>

<?php require_once("patches/footer.php"); ?>