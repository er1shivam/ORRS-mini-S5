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
        <?php else: ?>
        <p>
            <h4> You are logged in as <strong><em><span id="red_font"><?php echo $_SESSION['username']; ?></span></em></strong></h4>
        </p>
        <?php endif ?>
      </div>      
    </div>
<?php if(isset($_SESSION['username'])): ?>
   <div class="row">
            <br/>
            <br/>
            <div class="col-md-6" ></div>
            <p>
                <table class="table">
                    <tr>
                        <td> <a href="train_search.html" class="btn btn-primary pull-right btn-lg active btn-custm" role="button"> Search Trains</a> </td>
                        <td> <a href="book_ticket.html" class="btn btn-primary btn-lg active btn-custm" role="button"> Book Tickets</a> </td>
                    </tr>
                    <br/>
                    <tr>
                        <td> <a href="cancel_ticket.html" class="btn btn-primary pull-right btn-lg active btn-custm" role="button"> Cancel Tickets</a> </td>
                        <td> <a href="booked_history.html" class="btn btn-primary btn-lg active btn-custm" role="button"> My Booked History</a> </td>

                    </tr>
                </table>
            </p>
        </div>

<?php endif ?>










<?php require_once("patches/footer.php"); ?>