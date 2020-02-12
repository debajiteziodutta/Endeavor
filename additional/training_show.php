<?php 
include('../connection/db.php');
if(!isset($_SESSION['email'])){
  echo"<script>window.location.href = '/minorproject/index.php'</script>";
}else{
$email = $_SESSION['email'];
$flag = false;
$id = base64_decode($_REQUEST['id']);
$query = "SELECT * FROM `training`,`dept` WHERE `training`.`department` = `dept`.`dept_id` AND `training`.`tid`= '$id'";
$result = mysqli_query($conn, $query);
$rows = mysqli_fetch_array($result);

$query = "SELECT * FROM `signup` WHERE `email` = '$email' AND `status` = 0";
$result = mysqli_query($conn, $query);
$num = mysqli_num_rows($result);
if($num == 1){
  $flag = true;
}
$rows1 = mysqli_fetch_array($result);
$std = makautStdDatails($rows1['rollno']);
$std_sem  = sem($std['year']);
$tr_sem = $rows['sem'];
include_once("../includes/header.php");

?>
<br>
<?php
if (isset($_SESSION['message'])) { ?>
  <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
    <?= $_SESSION['message']?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php
}
unset($_SESSION['message']); 
unset($_SESSION['message_type']); 
?>
<br>
<br>
<h2>Training Details:</h2>
<br>
<br>
<div class="card">
  <div class="card-header">
  <b>Department:</b> 
      <?php echo $rows['dept_name'];?><br><br>
  </div>
  <div class="card-body">
    <blockquote class="blockquote mb-0">
     
      <b>Semester:</b><br>
      <?php echo $rows['sem'].sup($rows['sem']);?><br><br>
      <b>Training Topic:</b><br>
      <?php echo $rows['training_topic'];?><br><br>
      <b>Company Name:</b><br>
      <?php echo $rows['Company_name'];?><br><br>
      <b>Last date of application:</b><br>
      <?php echo $rows['last_apply_date'];?><br><br>
      <b>Start Date:</b><br>
      <?php echo $rows['Starting_date'];?><br><br>
      <b>Prerequisites</b><br>
      <?php echo $rows['Prerequisites'];?><br><br>
      
      
      
      <b>Tenure:</b><br>
      <?php echo $rows['tenure'];?><br><br>
      <b>Company Details:</b><br>
      <?php echo $rows['details_of_company'];?><br><br>
      <b>Note:</b><br>
      <?php echo $rows['notes'];?><br><br>
      <?php
      $file = $rows['training_details'];
      if(!empty($file)){
      ?><br> 
       <a download = "<?php echo $file?>" href = "../admin/training/uploads/<?php echo $file?>" class="btn btn-primary"> Download </a> <?php echo $rows['training_details'];?>
      </p>
      <?php
      }
      if($std_sem == $tr_sem && $flag){
      ?>
        <div align = "right">
        <a class="btn btn-success" href="trapply.php?id=<?php print $id ?>" role="button">Apply</a>
        </div>
      <?php
      }else{
      ?>
        <div align = "right">
          <button type="button" class="btn btn-success" disabled>Apply</button>
        </div>
      <?php
      }
      ?>
    </blockquote>
  </div>
</div>
<br>
<div style='padding:5%'></div>
<?php include_once("../includes/footer.php"); 
}
function sup($i){
  $sup=array("st","nd","rd","th");
  if($i <= 3){
      return $sup[$i-1];
  }else{
      return $sup[3];
  }
}
function sem($year){
  $sem = null;
  $year = date("y")-$year;
  $month = date("m")-6;
  if($year == 0){
      $sem = 1;
  }
  elseif($year == 1){
      if($month<= 0 && $month>=-5){
          $sem = 2;
      }elseif($month>=1 && $month<=6){
          $sem = 3; 
      }
  }
  elseif($year == 2){
      if($month<= 0 && $month>=-5){
          $sem = 4; 
      }elseif($month>=1 && $month<=6){
          $sem = 5; 
      }
  }
  elseif($year == 3){
      if($month<= 0 && $month>=-5){
          $sem = 6; 
      }elseif($month>=1 && $month<=6){
          $sem = 7; 
      }
  }
  elseif($year == 4){
      if($month<= 0 && $month>=-5){
          $sem = 8; 
      }elseif($month>=1 && $month<=6){
          $sem = 9; 
      }
  }elseif($year == 5){
      if($month<= 0 && $month>=-5){
          $sem = 10; 
      }elseif($month>=1 && $month<=6){
          $sem = 11; 
      }
  }
 
 return $sem;
}

function makautStdDatails ($roll){
  $clg = substr($roll,0,3);
  $dept = substr($roll,3,3);
  $year = substr($roll,6,2);
  $sn = substr($roll,8,3);
  $student = array("clg" =>$clg,"dept" =>$dept,"year" =>$year,"no" =>$sn);
  return $student;
}
?>