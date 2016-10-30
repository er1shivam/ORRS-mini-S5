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
 <?php if(!isset($_SESSION['username'])): ?>
<div class="container">
    <div class="flag">
        <h1>O R R S</h1>
    <p> You are currently not sign in <br/>
    <a href="login.php">Login here
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
        <center><h2>Enter PNR no to search</h2></center>  
    </div>
</div>
</div>
        <div class="col-md-9">
        
        </div>
        <br/>
        <form action="" method="post">
            <br/>
            <div class="row">
                <div class="col-md-6">
                    <div class="col-xs-6 pull-right">
                        <label for="ex1">PNR NO</label>
                        <input type="text" class="form-control" name="tktid" />
                    </div>
                </div>
            </div>
            <br/>
            <br/>
            <div class="col-md-9">
                <center>
                    <input type="submit" name="submit" class="btn btn-info" value="Search Train"> </center>
            </div>
    </div>
    </form>
    </div>
    <br/>
    <br/>

<?php
if(isset($_POST['submit'])){
$tkid = $_POST['tktid'];
    
    ?>
<div class="table">
  <table class="table">
  <tr>
    <tr>
    <!--th>Train id</th-->
<th>TRAIN NO</th> 
<th> Name</th>
<th>SOURCE</th>&nbsp; &nbsp;
<th>DESTINATION </th>
<th>NO OF SEATS</th>
<hr/> 
<?php
 $sqlInsert1 =  "SELECT * FROM ticket WHERE ticketid = :tid";
        $statement1 = $db->prepare($sqlInsert1);
        $statement1->execute(array(':tid' => $tkid));
while($row=$statement1->fetch())
{  
    ?>
    <tr class="alt">
  <td><?php echo $row['trainno']; ?></td>
    <td><?php echo $row['Name']; ?></td>
    <td><?php echo $row['source']; ?></td>
    <td><?php echo $row['destination']; ?></td>
    <td><?php echo $row['seat']; ?></td>
</tr>
</div>
<?php 
}

}
?>







<?php endif ?>

<?php require_once("patches/footer.php"); ?>