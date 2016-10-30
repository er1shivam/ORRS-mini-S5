<?php $page_title = "ORRS"; ?>
<?php require_once("patches/header.php"); ?>

    <div class="container">


      <div class="flag">
        <h1>O R R S</h1>
        <p class="lead">Welcome to online railway reservation system .<br>
         </p>


        <?php if(!isset($_SESSION['username'])): ?>
        <p> You are currently not sign in <a href="login.php">Login </a>Not yet a member?
            <a href="signup.php">Sign up</a>
        </p>
        <?php else: 
        $ur = $_SESSION['username'];
        $ad = "admin";
        ?>
        <p>
            <h4> You are logged in as <strong><em><span id="red_font"><?php echo $_SESSION['username']; ?></span></em></strong></h4>
        </p>
      </div>      
    </div>
<?php if($ur === $ad): ?>
      <div class="row">
          <br/>
          <br/>
          <div class="col-md-6" ></div>
          <p>
              <table class="table">
                  <tr>
                      <td> <a href="add_train.php" class="btn btn-primary pull-right btn-lg active btn-custm" role="button"> Add Train</a> </td>
                      <td> <a href="delete_train.php" class="btn btn-primary btn-lg active btn-custm" role="button"> Delete Train</a> </td>
                  </tr>
                  <tr>
                      <td> <a href="add_station.php" class="btn btn-primary pull-right btn-lg active btn-custm" role="button"> Add Station</a> </td>
                      <td> <a href="delete_station.php" class="btn btn-primary btn-lg active btn-custm" role="button"> Delete Station</a> </td>
                  </tr>
                  <tr>
                      <td> <a href="add_schedule.php" class="btn btn-primary pull-right btn-lg active btn-custm" role="button"> Add Schedule</a> </td>
                      <td> <a href="delete_schedule.php" class="btn btn-primary btn-lg active btn-custm" role="button"> Delete Schedule</a> </td>
                  </tr>
                  <br/>
              </table>
           </p>
        </div>

<?php else: ?>
   <div class="row">
            <br/>
            <br/>
            <div class="col-md-6" ></div>
            <p>
                <table class="table">
                    <tr>
                        <td> <a href="train_search.php" class="btn btn-primary pull-right btn-lg active btn-custm" role="button"> Search Train by NO</a> </td>
                        <td> <a href="searchsrcdest.php" class="btn btn-primary btn-lg active btn-custm" role="button">Search Train by Src/Dest</a> </td>
                    </tr>
                    <br/>
                    <tr>
                        <td> <a href="book_ticket.php" class="btn btn-primary pull-right btn-lg active btn-custm" role="button"> Book Tickets</a> </td>
                        <td> <a href="cancel_ticket.php" class="btn btn-primary btn-lg active btn-custm" role="button"> Cancel Tickets</a> </td>
                    </tr>
                    <tr>
                <td> <a href="booked_history.php" class="btn btn-primary pull-right btn-lg active btn-custm" role="button"> My Booked History</a> </td>
                <td> <a href="check_pnr.php" class="btn btn-primary btn-lg active btn-custm" role="button"> CHECK PNR</a> </td>
               
                    </tr>
                </table>
            </p>
        </div>

<?php endif ?>
<?php endif ?>

<?php require_once("patches/footer.php"); ?>