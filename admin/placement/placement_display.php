<?php 
include("../../connection/db.php");  
include_once("../../includes/ad_header.php");
head("p",2);
if(!isset($_SESSION['email'])){
  echo"<script>window.location.href = '/minorproject/index.php'</script>";
}else{
$email = $_SESSION['email'];
$query = "SELECT * FROM `signup` WHERE `email` = '$email' AND `status` = 1";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) == 0){
echo"<script>window.location.href = ' ../../additional/home.php'</script>";
}
date_default_timezone_set('Asia/Kolkata');
$today = date("y-m-d"); 
$val = null;
if(isset($_GET['toggle']) && $_GET['toggle']==1){
$toggle=1;
}else{
  $toggle=0; 
}
if(isset($_GET['id']))
$val = base64_decode($_GET["id"]);
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
    <?php unset($_SESSION['message']); 
          unset($_SESSION['message_type']);
          unset($_SESSION['message_head']);
  } ?>
<br>
<div class="container">
  <div class ="row">
    <div class ="col-6">
      <h3>Placement details for all Departments</h3>
    </div>
    <div align="right" class="col">
        <select name = "Search4"  class="form-control" id = "select" onchange = "select()">
        <?php $none = base64_encode('none')?>
                <option 
                <?php 
                if($val == $none){
                echo "selected";
                }
                ?> value = <?php echo $none;?>>ALL</option>
                <?php
                $query1 = "SELECT * FROM `dept` ";
                $result1= mysqli_query($conn, $query1); 
                while ($row =  mysqli_fetch_array($result1)){
                ?>
                <option  value = "<?php echo base64_encode($row['dept_name']);?>"
                <?php 
                if($val == $row['dept_name']){
                echo "selected";
                }
                ?>> <?php echo $row['dept_name']?></option>
               <?php
              }
              ?>
        </select>
        <script>
        function select(){
          var toggle = "<?php echo $toggle ?>";
          var e = document.getElementById("select");
          var val = e.options[e.selectedIndex].value;
          window.location.href = "placement_display?id="+val+"&toggle="+toggle;
        }
        </script>
    </div>
    <div align="right" class="col">
    <?php
    if($toggle == 0){
      echo"<a class='btn btn-primary' href='placement_display.php?id=".base64_encode($val)."&toggle=1'>See Backdated</a>";
    }else{
      echo"<a class='btn btn-primary' href='placement_display.php?id=".base64_encode($val)."&toggle=0'>See All</a>";
    }
    ?>  
    </div>
    
  </div>
</div>
<br>
<?php


if($toggle == 1 && $val != "none"){
     $query1 = "SELECT * FROM `placement` , `dept` WHERE `placement`.`dept` = `dept`.`dept_id` AND`placement`.`last_apply_date` < '$today' AND `dept`.`dept_name` = '$val' ORDER BY `placement`.`created_at` DESC ";
}
elseif($toggle == 0 && $val != "none"){
    $query1 = "SELECT * FROM `placement`,`dept` WHERE `placement`.`dept` = `dept`.`dept_id` AND `dept`.`dept_name` = '$val' ORDER BY `created_at` DESC ";
}
elseif($toggle == 1 && $val == "none"){
  $query1 = "SELECT * FROM `placement`,`dept` WHERE `placement`.`dept` = `dept`.`dept_id` AND `placement`.`last_apply_date` < '$today' ORDER BY `created_at` DESC ";
}
else{
  $query1 = "SELECT * FROM `placement`,`dept` WHERE `placement`.`dept` = `dept`.`dept_id` ORDER BY `placement`.`created_at` DESC ";
}
$result1= mysqli_query($conn, $query1); 
if(mysqli_num_rows($result1) == 0 ){
  ?>
    <h1> NO DATA AVAILABLE </h1>
  <?php
  }
  else{
$i = 1;
while($row =  mysqli_fetch_array($result1)){
if(strtotime($row['last_apply_date']) < strtotime($today)){
 
?>
<br>
<?php
  ?>
  <div>
    <div class="card shadow p-3 border-danger">
      <div class="card-body text-danger">
      
      <h5 class="card-title"><div class="form-group">
          <b>Eligible Deparments:</b>
          <br>
          <h5><b><?php print $row['dept_name']; ?></b></h5>
        </div></h5>
        <br>
        <div class="form-group">
          <b>Semister:</b>
          <p><?php print  $row['sem']; ?><sup><?php echo sup($row['sem'])?></sup><sub>Sem</sub></p>
        </div>
        <div class="form-group">
          <b>Company Name:</b>
          <p><?php print  $row['company_name']; ?></p>
        </div>
        <div class="form-group">
          <b>Last Date of Application:</b>
          <p><?php print  $row['last_apply_date']; ?></p>
        </div>
        <div class="form-group">
          <b>Date of Drive:</b>
          <p><?php print  $row['arriving_date']; ?></p>
        </div>
        <div class="form-group">
          <b>Eligibility Criteria:</b>
          <p><?php print  $row['eligibity_criteria']; ?></p>
        </div>
        <div class="form-group">
          <b>Vacancy:</b>
          <p><?php print  $row['vacancy']; ?></p>
        </div>
        <div class="form-group">
          <b>Job Profile:</b>
          <p><?php print  $row['job_role']; ?></p>
        </div>
        <?php
        if(!empty($row['pdf_name'])){
          ?>
        <div class="form-group">
          <b>More details are here within, download file to read:</b> 
          <p><?php print  $row['pdf_name']; ?></p>
        </div>
        <?php
        }
         if(!empty($row['contact_details'])){
          ?>
        <div class="form-group">
          <b>Contact details:</b>
          <p><?php print  $row['contact_details']; ?></p>
        </div>
        <?php
         }
         ?>
        <div class="form-group">
          <b>Active Backlog allowance:</b>
          <p><?php print  $row['active_backlog']; ?></p>
        </div>
        <?php
         if(!empty($row['notes'])){
          ?>
        <div class="form-group">
          <b>Note:</b>
          <p><?php print  $row['notes']; ?></p>
        </div>
        <?php
         }
         ?>
        <?php
      $rounds = explode("/", $row['Round_name']);
      $duration = explode("/", $row['Round_duration']);
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
          echo"<div class='form-group'>";
            echo"<td> $rounds[$i] </td>";
            echo"<td> $duration[$i] </td>";
          echo"</div>";
          echo"</tr>";
        echo"</tbody>";
        }?>
      </table>

        <?php
        }
        ?>     
        <br>
        <br>
        <div align = "right">
          <a class="btn btn-success" href="edit.php?id=<?php print $row['id']?>" role="button">Edit</a>
          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="<?php echo "#exampleModal".$i; ?>">Delete </button>
        </div>
        <div class="modal fade" id="<?php echo "exampleModal".$i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Are you sure to delete it?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" href="delete.php?id=<?php print $row['id']?>" role="button">Yes, Delete</a>
               
             </div>
            </div>
          </div>
        </div>
        <br>
    </div>
  </div>
</div>
<br>
<?php 

  $i = $i + 1;
  //echo $i;
 
}
else{
  ?>
<br>

  <div>
    <div class="card shadow p-3">
      <div class="card-body">
    
      <h5 class="card-title"><div class="form-group">
          <b>Eligible Deparments:</b>
          <br>
          <h5><b><?php print  $row['dept_name']; ?></b></h5>
        </div></h5>
        <br>
        <div class="form-group">
          <b>Semister:</b>
          <p><?php print  $row['sem']; ?><sup><?php echo sup($row['sem'])?></sup><sub>Sem</sub></p>
        </div>
        <div class="form-group">
          <b>Company Name:</b>
          <p><?php print  $row['company_name']; ?></p>
        </div>
        <div class="form-group">
          <b>Last Date of Application:</b>
          <p><?php print  $row['last_apply_date']; ?></p>
        </div>
        <div class="form-group">
          <b>Date of Drive:</b>
          <p><?php print  $row['arriving_date']; ?></p>
        </div>
        
        <div class="form-group">
          <b>Eligibility Criteria:</b>
          <p><?php print  $row['eligibity_criteria']; ?></p>
        </div>
        <div class="form-group">
          <b>Vacancy:</b>
          <p><?php print  $row['vacancy']; ?></p>
        </div>
        <div class="form-group">
          <b>Job Profile:</b>
          <p><?php print  $row['job_role']; ?></p>
        </div>
        <?php
        if(!empty($row['pdf_name'])){
          ?>
        <div class="form-group">
          <b>More details are here within, download file to read:</b> 
          <p><?php print  $row['pdf_name']; ?></p>
        </div>
        <?php
        }
         if(!empty($row['contact_details'])){
          ?>
        <div class="form-group">
          <b>Contact details:</b>
          <p><?php print  $row['contact_details']; ?></p>
        </div>
        <?php
         }
         ?>
        <div class="form-group">
          <b>Active Backlog allowance:</b>
          <p><?php print  $row['active_backlog']; ?></p>
        </div>
        <?php
         if(!empty($row['notes'])){
          ?>
        <div class="form-group">
          <b>Note:</b>
          <p><?php print  $row['notes']; ?></p>
        </div>
        <?php
         }
         ?>
        <?php
      $rounds = explode("/", $row['Round_name']);
      $duration = explode("/", $row['Round_duration']);
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
?>     
        <br>
        <br>
        <div align = "right">
          <a class="btn btn-success" href="edit.php?id=<?php print $row['id']?>" role="button">Edit</a>
          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="<?php echo "#exampleModal".$i; ?>">Delete </button>
        </div>
        <div class="modal fade" id="<?php echo "exampleModal".$i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Are you sure to delete it?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" href="delete.php?id=<?php print $row['id']?>" role="button">Yes, Delete</a>
               
             </div>
            </div>
          </div>
        </div>
        
        
        <br>
    </div>
  </div>
</div>
<br>
<?php 

  $i = $i + 1;
  //echo $i;
} 

}
}
 ?>
<?php include_once("../../includes/ad_footer.php"); 
}
function sup($i){
  $sup=array("st","nd","rd","th");
  if($i <= 3){
      return $sup[$i-1];
  }else{
      return $sup[3];
  }
}
?>