<?php 
include('../../connection/db.php');
include_once("../../includes/ad_header.php");
head("p",1);
if(!isset($_SESSION['email'])){
  echo"<script>window.location.href = '/minorproject/index.php'</script>";
}else{
$email = $_SESSION['email'];
$query = "SELECT * FROM `signup` WHERE `email` = '$email' AND `status` = 1";
$result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result) == 0){
  echo "<script>window.location.href = '../../additional/home.php';</script>";
  }
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
    <?php 
    unset($_SESSION['message']); 
    unset($_SESSION['message_type']);  
    unset($_SESSION['message_head']);
    } ?>
<br>
<div class="container">
  <div class ="row">
    <div class ="col-8">
      <h3>Placement Module</h3>
    </div>
  </div>
</div>
<br>
<br>
<form action="placement_uploads.php" method="POST" enctype="multipart/form-data">

<?php
$query1 = "SELECT * FROM `dept` ";
$result1= mysqli_query($conn, $query1); 
?>
<div class="form-group" id = "boses">
  <label for="check">Select Department</label><br>
<?php
$i=1;
while ($row =  mysqli_fetch_array($result1)){
?>
  <div class="custom-control custom-checkbox custom-control-inline options" id = "check">
    <input class="custom-control-input" type="checkbox" id="option-<?php echo $i ?>" name = "dept[]" value="<?php echo $row['dept_id']?>" required />
    <label class="custom-control-label" for="option-<?php echo $i ?>"><?php echo $row['dept_name']?></label>
    <div class = "max_tickets">
      &nbsp;
      <label for="selectdepartment">Select Semester</label>
      <select class="form-control" id="selectdepartment" name="sem<?php echo $i?>">
        <option value = "" disabled selected>__Select _Sem__</option>
        <?php
        $dept_id = $row['dept_id'];
        $query2 = "SELECT * FROM `dept` WHERE `dept_id` = $dept_id";
        $result2= mysqli_query($conn, $query2); 
        $row1 =  mysqli_fetch_array($result2);
        for($k = 1; $k<= $row1['no_sem']; $k++){
        ?>
        <option value = <?php echo $k?>> <?php echo $k.sup($k)." Semester"?> </option>
        <?php
        }
        ?>
      </select>
    </div>
  </div>
  
  <?php
  $i = $i +1;
}
?> 
</div>

  <div class="form-group">
    <label for="exampleInputEmail1">Company Name</label>
    <input type="text" name = "company_name" class="form-control" id="companyname1" aria-describedby="companyname" placeholder="company name" required >
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Last Date for Application</label>
    <input type="date" name = "last_apply_date" class="form-control" id="traningtopic1" aria-describedby="companyname" placeholder="date" required >
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">company arriving date</label>
    <input type="date" name = "arriving_date" class="form-control" id="traningtopic1" aria-describedby="companyname" placeholder="date" required >
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">eligibity criteria</label>
    <input type="text" name = "eligibity_criteria" class="form-control" id="prerequisites" aria-describedby="companyname" placeholder="eligibity criteria for placement"required>
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">vacancy</label>
    <input type="text" name = "vacancy" class="form-control" id="prerequisites" aria-describedby="companyname" placeholder="no. of vacancy">
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">job role </label>
    <input type="text" name = "jobrole" class="form-control" id="prerequisites" aria-describedby="companyname" placeholder="job role ">
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Placement details (pdf upload here)</label>
    <input type="file" name="file" accept = "appllication/pdf">
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Contact details of Company</label>
    <input type="text" name = "contact" class="form-control" id="companycontact" aria-describedby="companyname" placeholder="contact delaits" required>
  </div>
  <div class="custom-control custom-radio custom-control-inline">
    <input type="radio" id="customRadioInline1" name="backlog" class="custom-control-input" value="Yes" required>
    <label class="custom-control-label" for="customRadioInline1">active backlog preferable</label>
  </div>
  <div class="custom-control custom-radio custom-control-inline">
    <input type="radio" id="customRadioInline2" name="backlog" class="custom-control-input" value="No" required>
    <label class="custom-control-label" for="customRadioInline2">If active backlog not preferable</label>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Notes (if any)</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"name="notes" placeholder="notes"></textarea>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Copy and paste the application like here:</label>
    <input type="text" name = "link" class="form-control" id="prerequisites" aria-describedby="companyname" placeholder="Enter the Link Here" required>
    
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">number of round </label>
    <select class="form-control" id="optionselector" name = "round">
    <option>__SELECT__</option>
      <?php
      for($i =1;$i<=4;$i++){
        echo"<option value = '".$i."'>".$i."</option>";
      }
      ?>
    </select>
  </div>
  <?php
  for($i = 1;$i<=4;$i++){
    $k = 1;
    ?>
    <div class="items" id="<?php echo $i?>" style="display:none">
          <?php
          for($j = 1;$j<=$i;$j++){
            ?>
            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo "Round ".$k." name";?></label>
            <input type="text" name = "<?php echo "Round".$i."".$j;?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter round name">
            </div>
            <div class="form-group">
            <label for="exampleInputEmail2"><?php echo "Round ".$k." duration";?></label>
            <input type="text" name = "<?php echo "duration".$i."".$j;?>" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" placeholder="Enter round duration">
            </div>
            <?php
            $k = $k+1;
          }
          ?>
    </div>
    <?php
    }
    ?>
  <div align="right">
  <button type="submit" name ="submit" class="btn btn-primary">Submit</button>
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
    $('#optionselector').change(function(){
        $('.items').hide();
        $('#' + $(this).val()).show();
    });
});
$(function(){
  var rcbx = $('.options :checkbox[required]');
  rcbx.change(function(){
    if(rcbx.is(':checked')) {
      rcbx.removeAttr('required');
    }else{
      rcbx.attr('required' , 'required');
    }
  });
});
$(function(){
  $('input.custom-control-input').change(function(){
    if($(this).is(':checked')) $(this).parent().children('div.max_tickets').show();
    else $(this).parent().children('div.max_tickets').hide();
  }).change();
});
</script>
