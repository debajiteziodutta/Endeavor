<?php 
include('../connection/db.php');
if(!isset($_SESSION['email'])){
  echo"<script>window.location.href = '/minorproject/index.php'</script>";
}else{
$email = $_SESSION['email'];
$flag = false;
$id = base64_decode($_REQUEST['id']);
$query = "SELECT * FROM `placement`,`dept` WHERE `placement`.`dept` = `dept`.`dept_id` AND `placement`.`id`= '$id'";
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
<h2>Placement Details:</h2>
<br>
<br>
<div class="card">
  <div class="card-header">
    <?php echo $rows['company_name'];?>
  </div>
  <div class="card-body">
    <blockquote class="blockquote mb-0">
      <b>Department:</b>
      <p><?php echo $rows['dept_name'];?><br><br>
      <b>Semester:</b><br>
      <?php echo $rows['sem'].sup($rows['sem']);?><br><br>
      <b>Company Name:</b><br>
      <?php echo $rows['company_name'];?><br><br>
      <b>Date of Drive:</b><br>
      <?php echo $rows['arriving_date'];?><br><br>
      <b>Eligibity Criteria:</b><br>
      <?php echo $rows['eligibity_criteria'];?><br><br>
      <b>Vacancy:</b><br>
      <?php echo $rows['vacancy'];?><br><br>
      <b>Job Profile:</b><br>
      <?php echo $rows['job_role'];?><br><br>
      <b>Company contact details:</b><br>
      <?php echo $rows['contact_details'];?><br><br>
      <b>Active Backlog preference:</b><br>
      <?php echo $rows['active_backlog'];?><br><br>
      <b>Note:</b><br>
      <?php echo $rows['notes'];?><br><br>
      <?php
      $file = $rows['pdf_name'];
      $rounds = explode("/", $rows['Round_name']);
      $duration = explode("/", $rows['Round_duration']);
      $len = 0;
      $len = count($rounds);
      if($rounds[0] != NULL){
      ?>
        <table class="table table-borderless table-sm">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">Rounds</th>
              <th scope="col">Duration</th>
            </tr>
          </thead>
          <?php
          for($i=0;$i<$len;$i++){
          echo"<tbody>";
            echo"<tr>";
            ?>
            <th scope='row'><?php echo $i+1 ?></th>
            <?php
              echo"<td> $rounds[$i] </td>";
              echo"<td> $duration[$i] </td>";
            echo"</tr>";
          echo"</tbody>";
          }?>
        </table>
      <?php
      }
      if(!empty($file)){
      ?>
        <br> 
        <a download = "<?php echo $file?>" href = "../admin/placement/pdf/<?php echo $file?>" class="btn btn-primary"> Download </a> <?php echo $rows['pdf_name'];?>
        </p>
      <?php
      }
      if($std_sem == $tr_sem && $flag){
      ?>
        <div align = "right">
          <a class="btn btn-success" href="apply.php?id=<?php print $id ?>" role="button">Apply</a>
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
<div style='padding:5%'>
</div>
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