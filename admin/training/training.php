<?php 
include("../../connection/db.php");
include_once("../../includes/ad_header.php"); 
head("T",1);
if(!isset($_SESSION['email'])){
  echo"<script>window.location.href = '/minorproject/index.php'</script>";
}else{
  $email = $_SESSION['email'];
  $query = "SELECT * FROM `signup` WHERE `email` = '$email' AND `status` = 1";
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result) == 0){
  echo"<script>window.location.href = '../../additional/home.php'</script>";
  }
?>

<br>
<br>
<div class="container">
  <div class ="row">
    <div class ="col-8">
      <h3>Training Module</h3>
    </div>
  </div>
</div>

<br>
<br>
<form action="uploads.php" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleFormControlSelect1">Select Department</label>
    <select required class="form-control" id="selectdepartment" name="department" >
      <option value = "" disabled selected>__Select__</option>
      <?php
       $query1 = "SELECT * FROM `dept` ";
       $result1= mysqli_query($conn, $query1); 
       while ($row =  mysqli_fetch_array($result1)){
      ?>
        <option value = <?php echo $row['dept_id']?>> <?php echo $row['dept_name']?> </option>
      <?php
      }
      ?>
    </select>
  </div>
  <?php
  $query1 = "SELECT * FROM `dept` ";
  $result1= mysqli_query($conn, $query1); 
  while ($row =  mysqli_fetch_array($result1)){
  ?>
  <div class="items" id="<?php echo $row['dept_id']?>" style="display:none">
    <label for="selectdepartment">Select Semester</label>
    <select class="form-control" id="selectdepartment" name="sem">
      <option value = "" disabled selected>__Select _Sem__</option>
      <?php
      $dept_id = $row['dept_id'];
      $query2 = "SELECT * FROM `dept` WHERE `dept_id` = $dept_id";
      $result2= mysqli_query($conn, $query2); 
      $row1 =  mysqli_fetch_array($result2);
      for($k = 1; $k<= $row1['no_sem']; $k++){
      ?>
      <option value = <?php echo $k?>> <?php echo $k.sup($k)." Semister";?> </option>
      <?php
      }
      ?>
    </select>
  </div>
  <?php
  }
  ?>
  <br>
  <div class="form-group">
    <label for="exampleInputEmail1">Company Name</label>
    <input type="text" class="form-control" name="companyname1" aria-describedby="companyname" placeholder="company name" required>
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Training On</label>
    <input type="text" class="form-control" name="traningtopic1" aria-describedby="companyname" placeholder="Training Topic" required>
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Prerequisites</label>
    <input type="text" class="form-control" name="prerequisites" aria-describedby="companyname" placeholder="prerequisites for training">
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Training details (pdf upload here)</label>
    <input type="file" name="file">
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Last Date for application</label>
    <input type="date" class="form-control" name="last_apply_date" aria-describedby="companyname" required>
    
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Starting Date</label>
    <input type="date" class="form-control" name="startdate" aria-describedby="companyname" required>
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Tenure of Training </label>
    <input type="number" class="form-control" name="trainingtime" aria-describedby="companyname" placeholder="training time period">
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Contact details of Company</label>
    <input type="text" class="form-control" name="companycontact" aria-describedby="companyname" placeholder="contact delaits">
    
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Notes (if any)</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"name="notes" placeholder="notes"></textarea>
  </div>
  <div align="right">
    <button type="submit" class="btn btn-primary" value="Upload" name = "upload">Submit</button>
  </div>
</form>
<br>
<br>


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
<script>
	$(function() {
    $('#selectdepartment').change(function(){
        $('.items').hide();
        $('#' + $(this).val()).show();
    });
});
</script>