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
        <center><h2>Enter Train no to search</h2></center>  
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
                        <label for="ex1">Train no</label>
                        <input type="text" class="form-control" name="train_no" />
                    </div>
                </div>
            </div>
            <br/>
            <br/>
            <div class="col-md-9">
                <center>
                    <input type="submit" name="searchtno" class="btn btn-info" value="Search Train"> </center>
            </div>
    </div>
    </form>
    </div>
    <br/>
    <br/>

    <?php
    $form_errors = array();
    if(isset($_POST['searchtno'])){

        $required_fields = array('train_no');
        //check empty fields and merge the error msg
        $form_errors = array_merge($form_errors, check_empty_fields($required_fields));
         if(empty($form_errors)) {
            // if empty, process data
    try{
        $sqlInsert =  "SELECT * FROM trains_info WHERE train_no = :tno";
        $statement = $db->prepare($sqlInsert);
        $statement->execute(array(':tno' => $_POST['train_no']));

                while($row = $statement->fetch()){
                $tr_no = $row['train_no'];
                $tr_nm = $row['train_name'];
                $tr_tp = $row['type'];
                $tr_src = $row['s_station_id'];
                $tr_dest = $row['d_station_id'];
                $tr_sl = $row['sl'];
                $tr3_ac = $row['thirdtier'];
                $tr2_ac = $row['secondtier'];
                $tr1_ac = $row['firsttier'];

                $sst_nm = getstname($db,$tr_src);
                $dst_nm = getstname($db,$tr_dest);     
                  
                  echo "<div class=\"row\">
                  <div class=\"col-md-6\">
                    <table class=\"table\">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Train no</th>
                            <th>Train name</th>
                            <th>Type</th>
                            <th>Source</th>
                            <th>Destination</th>
                            <th>Sleeper</th>
                            <th>Third tier</th>
                            <th>Second tier</th>
                            <th>First Tier</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th scope=\"row\">1</th>
                            <td>$tr_no</td>
                            <td>$tr_nm</td>
                            <td>$tr_tp</td>
                            <td>$sst_nm</td>
                            <td>$dst_nm</td>
                            <td>$tr_sl</td>
                            <td>$tr3_ac</td>
                            <td>$tr2_ac</td>
                            <td>$tr1_ac</td>
                            </tr>
                        </tbody>
                    </table>
                  ";
                //$result = flashMessage("Registration succesful" ,"pass");
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