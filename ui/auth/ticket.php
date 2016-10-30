<?php
ob_start();
require_once("resource/Database.php"); //db db ?>
<?php require_once("resource/session.php"); //db connection ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="../css1/bootstrap.min.css">
</head>
<body>

<?php $tid = $_SESSION['tktid']; 

        $tmpnm = '';
        $tmpage = '';
        $tmpsrc = '';
        $tmpdest = '';
        $tmpnos = '';
        $tmpno = '';

        $que = "SELECT * FROM ticket WHERE ticketid = :nm";
        $statement3 = $db->prepare($que);
        $statement3->execute(array(':nm' => $tid));
        if($row = $statement3->fetch()){
          
        $tmpnm = $row['Name'];
        $tmpage = $row['age'];
        $tmpsrc = $row['source'];
        $tmpdest = $row['destination'];
        $tmpnos = $row['seat'];
        $tmpno = $row['trainno'];




        }





?>
<script>
function pripage() {
    window.print();
}
</script>
<div class="row" >

<div class="col-md-1"> </div>
<div class="col-md-3">
<img src="../../image/Indian_Railway.png" width="100" height = "100" >
<div class="col-md-9 pull-left">
<h4> INDIAN RAILWAYS </h4>
</div>
</div>
<p>
  <h2>TICKET DETAILS </h2>
    <br/>
</p>
<hr/>
<br/>
<br/>
<?php

echo "<div class=\"container\">
  <center><h3>
  <p>THIS IS AN AUTO-GERNERATED TICKET</p></h3><br/></center><br/>
  <br/> 
  <div class=\"col-md-4\">
  </div>
  <div class=\"col-md-6\"><table class=\"table\">
    <tbody>
      <tr>
        <td>NAME OF PASSENGER :</td>
        <td> $tmpnm</td>
      </tr>
      <tr>
        <td>AGE OF PASSENGER :</td>
        <td>$tmpage</td>
      </tr>
      <tr>
        <td>SOURCE :</td>
        <td>$tmpsrc</td>
        
      </tr>
      <tr>
        <td> DESTINATION :</td>
        <td>$tmpdest</td>
        
      </tr>
      <tr>
        <td>NO OF SEATS: </td>
        <td>$tmpnos</td>
        
      </tr>
      <tr>
        <td>TRAIN NO: </td>
        <td>$tmpno</td>
        
      </tr>
    </tbody>
  </table>
  </div> 
</div>
<br/>
<br/>
<center>
<button class=\"form-control\" onclick=\"pripage()\">Print this page</button></center>";
?>













</body>
</html>