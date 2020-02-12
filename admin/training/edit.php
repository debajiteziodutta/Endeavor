<?php
    include("../../connection/db.php");
    include_once("../../includes/ad_header.php");
    head("T",2);
    if(!isset($_SESSION['email'])){
      echo"<script>window.location.href = '/minorproject/index.php'</script>";
    }else{
      $email = $_SESSION['email'];
      $query = "SELECT * FROM `signup` WHERE `email` = '$email' AND `status` = 1";
      $result = mysqli_query($conn, $query);
      if(mysqli_num_rows($result) == 0){
      echo"<script>window.location.href = ' ../../additional/home.php'</script>";
      }
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        //print "$id";
        $query= "SELECT * from training WHERE tid = $id";
        $result= mysqli_query($conn, $query);
        $rows= mysqli_fetch_assoc($result);
        $department= $rows['department'];
        $sem = $rows['sem'];
        $company= $rows["Company_name"];
        $topic= $rows["training_topic"];
        $pre= $rows["Prerequisites"];
        $details= $rows["training_details"]; 
        $applydate = $rows['last_apply_date'];
        $date= $rows["Starting_date"];
        $tenure= $rows["tenure"];
        $comcontact= $rows["details_of_company"];
        $notes= $rows["notes"];
    }

    if(isset($_POST['update']))
    {
      $flag = 0;
      $filelist = array();
      if ($handle = opendir("uploads")) {
          while ($entry = readdir($handle)){
                  $filelist[] = $entry ;
          }
          closedir($handle);
      }
      $pdf1 = $_FILES['file']['name'];
      if(!empty($pdf1)){
        if(!in_array($pdf1,$filelist)){
          unlink("uploads/$details");
          move_uploaded_file($_FILES['file']['tmp_name'], "uploads/".$_FILES['file']['name']);
          $details= $pdf1;
          $flag = 1;
          }else{
            $flag = 0;
          }
      }
    if(empty($pdf1) || $flag != 0 || $flag == 1){
     //$id = $_GET['id'];
      $department= $_POST['department'];
      $company= $_POST["companyname1"];
      $sem = $_POST["sem1"];
      $topic= $_POST["traningtopic1"];
      $pre= $_POST["prerequisites"];
      $date= $_POST["startdate"];
      $applydate = $_POST['last_apply_date'];
      $tenure= $_POST["trainingtime"];
      $comcontact= $_POST["companycontact"];
      $notes= $_POST["notes"];
      //echo $details;
      $query="UPDATE `training` SET `department`= '$department',`sem` = '$sem',`Company_name`= '$company',`training_topic`= '$topic',`Prerequisites`= '$pre',`training_details`= '$details',`Starting_date`= '$date',`last_apply_date` = '$applydate',`tenure`= $tenure,`details_of_company`= '$comcontact',`notes`= '$notes' WHERE `tid` = $id";
      $result= mysqli_query($conn, $query);
      //echo $query;
      if($result)
      {
        //print "successfully updated";
        $_SESSION['message_head'] = 'Great!';
        $_SESSION['message'] = 'Details Updated Successfully.';
        $_SESSION['message_type'] = 'success';
        //header("location:trdisplay.php?id=none&toggle=0");
        echo"<script>window.location.href = 'trdisplay.php?id=".base64_encode('none')."&toggle=0'</script>";
      }
      else
      {
        //print "problem uploading file";
        $_SESSION['message_head'] = 'Ohh no!';
        $_SESSION['message'] = 'Update process failed! Try again.';
        $_SESSION['message_type'] = 'danger';
        //header("location: trdisplay.php?id=none&toggle=0");
        echo"<script>window.location.href = 'trdisplay.php?id=".base64_encode('none')."&toggle=0'</script>";
      }
    }else{
      $_SESSION['message_head']= 'Ohh no!';
      $_SESSION['message'] = 'Insert another file or rename it ...';
      $_SESSION['message_type'] = 'danger';
      //header("location: trdisplay.php?id=none&toggle=0");
      echo"<script>window.location.href = 'trdisplay.php?id=".base64_encode('none')."&toggle=0'</script>";
    }
      
    }

    

?>
<br>
<br>
<h3>Edit Here</h3>
<br>
<div class="card">
  <div class="card-body">
<form action="" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleFormControlSelect1">Select department</label>
    <select class="form-control" id="selectdepartment" name="department">
      <?php
       $query1 = "SELECT * FROM `dept` ";
       $result1= mysqli_query($conn, $query1); 
       while ($row =  mysqli_fetch_array($result1)){
      ?>
      <option value="<?php echo $row['dept_id']?>"
      <?php
        if($department == $row['dept_id']){
          echo "selected";
        }
      ?>><?php echo $row['dept_name']?></option>
      <?php
       }
      ?>
    </select>
  </div>

  <div class="items">
    <label for="selectdepartment">Select Semester</label>
    <select class="form-control" id="selectdepartment" name="sem1">
      <?php
      $query2 = "SELECT * FROM `dept` WHERE `dept_id` = $department";
      $result2= mysqli_query($conn, $query2); 
      $row1 =  mysqli_fetch_array($result2);
      for($k = 1; $k<= $row1['no_sem']; $k++){
      ?>
      <option value = <?php echo $k?>
      <?php
      if($sem == $k){
          echo "selected";
        }
      ?>> <?php echo $k.sup($k)." Semister";?> </option>
      <?php
      }
      ?>
    </select>
  </div>
  <br>
 
  <div class="form-group">
    <label for="exampleInputEmail1">Company Name</label>
    <input type="text" class="form-control" name="companyname1" value="<?php echo "$company"; ?>" placeholder="company name">
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Training On</label>
    <input type="text" class="form-control" name="traningtopic1" value="<?php echo "$topic"; ?>" placeholder="Training Topic">
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Prerequisites</label>
    <input type="text" class="form-control" name="prerequisites" value="<?php echo "$pre"; ?>" placeholder="prerequisites for training">
    
  </div>
  <div class="form-group">
  Current PDF <b><?php echo $details; ?><label for="exampleInputEmail1"></b> If you want to new Placement details (pdf upload here)</label>
    <input type="file" name="file">
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Last date for application</label>
    <input type="date" class="form-control" name="last_apply_date" value="<?php echo "$date"; ?>">
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Starting Date</label>
    <input type="date" class="form-control" name="startdate" value="<?php echo "$date"; ?>">
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Tenure of Training </label>
    <input type="number" class="form-control" name="trainingtime" value="<?php echo "$tenure" ;  ?>" placeholder="training time period">
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Contact details of Company</label>
    <input type="text" class="form-control" name="companycontact" value="<?php echo "$comcontact";  ?>" placeholder="contact delaits">
    
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Notes (if any)</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="notes" placeholder="notes"><?php echo $notes;?></textarea>
  </div>
  <br>
  <br>
  <div align="right">
    <a role="button" class="btn btn-primary" href="trdisplay.php?id=<?php echo base64_encode('none');?>&toggle=0" name="back">Go Back</a>
    <button type="reset" class="btn btn-secondary" name="reset">Reset</button>
    <button type="submit" class="btn btn-success" value="Upload" name="update">Update</button>
  </div>
</form>
</div>
</div>
<br>
<br>
<br>
<br>

<?php
include_once("../../includes/ad_footer.php");
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
