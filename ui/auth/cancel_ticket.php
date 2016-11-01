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
                        <label for="ex1">Ticket Details</label>
                        <input type="text" class="form-control" name="ttid">
                        </div>
                </div>
            </div>
            <br/>
            <div class="col-md-9">
                <center>
                    <input type="submit" name="deleteticket" class="btn btn-info" value="Cancel Ticket"> </center>
            </div>
    </div>
    </form>
    </div>


<?php
    $form_errors = array();
    if(isset($_POST['deleteticket'])){
        $ticketid = $_POST['ttid'];
        $trno = '';
        $trtp = '';
        $nos = '';
        $nosp = '';
       if(empty($form_errors)) {
        try{
            $query1 =  "SELECT * FROM ticket WHERE ticketid= :tid";
            $statement1 = $db->prepare($query1);
            $statement1->execute(array(':tid' => $ticketid));

            if($row=$statement1->fetch()){
            $trno = $row['train_no'];
            $trtp = $row['type'];
            $nos = $row['seat'];
            }
        
            $sqldelete =  "DELETE FROM ticket WHERE ticketid = :tid";
            $statement = $db->prepare($sqldelete);
            $statement->execute(array(':tid' => $ticketid));

            if($statement -> rowCount() == 1){
            
            $query2 =  "SELECT * FROM trains_info WHERE train_no= :tno";
            $statement5 = $db->prepare($query2);
            $statement5->execute(array(':tno' => $trno));

            if($row=$statement5->fetch()){
            $nosp = $row[$trtp];
            }
            $nosp += $nos;
            $updatequery =  "UPDATE trains_info set {$trtp}='$nosp' WHERE train_no= :tno";
            $statement2 = $db->prepare($updatequery);
            $statement2->execute(array(':tno' => $trno));

                if($statement2 -> rowCount() == 1){
                    $result = "<script type=\"text/javascript\"> 
                    swal({   
                         title: \"Congrats !\", 
                        type:'success',  
                        text: \"Train Deleted.\",
                        confirmButtonText: \"Thank you!\",    
                        
                        });
                        </script>";
                //$result = flashMessage("Registration succesful" ,"pass");
                }
            }
            }catch (PDOException $ex){
                    $result = flashMessage("Error occured : " . $ex->getMessage() );
            }
    }
    else{
        if(count($form_errors) == 1){
             $result  = flashMessage("There was one error in the form <br/>");
        }
        else{
        $result  = flashMessage("There were " . count($form_errors). " errors in the form <br />");
        }
    }
    }
?>







<?php endif ?>

<?php require_once("patches/footer.php"); ?>