<?php 
include("../connection/db.php");
if(!isset($_SESSION['email'])){
  echo"<script>window.location.href = '/minorproject/index.php'</script>";
}else{
    include_once("../includes/header.php");

if(isset($_GET['id']))
$val = $_GET["id"];
?>
<br>
    <?php if (isset($_SESSION['message'])) { ?>
      <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
      <h4 class="alert-heading"><?= $_SESSION['message_head'] ?></h4>
        <?= $_SESSION['message']?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php  unset($_SESSION['message']); 
    unset($_SESSION['message_type']);
    unset($_SESSION['message_head']);  
   } 
    $value = "0";
    ?>
<br>

      <h2><i class="fa fa-line-chart" aria-hidden="true" style= 'color: black'></i> Previous Placement details for all Departments</h2>
<br>
<?php


$query1= "SELECT * from heritage";
$result1= mysqli_query($conn, $query1); 
if(mysqli_num_rows($result1) == 0 ){
?>
  <h1> NO DATA AVAILABLE </h1>
<?php
}
else
{
  $i= 1;
  while($row= mysqli_fetch_assoc($result1))
  {

?>
<br>
<br>
<br>
  <div>
    <div class="card shadow p-3">
      <div class="card-body">
    
      <h5 class="card-title">
              
        <div class="form-group">
        <b>Contents:</b>
        <br>
        <div class="form-group">
          <p><small class="text-muted">Posted as on : <?php print $row['time_stamp']; ?></small></p>
        </div>
        
          <p><?php print  $row['contents']; ?></p>
        </div>
        <br>
        <br>
        
       
      </div>
  </div>
</div>


<?php 

  $i = $i + 1;
  //echo $i;
    }  
  }

}
?>
<div style='padding:8%'></div>
<?php
include_once("../includes/footer.php"); 

?>