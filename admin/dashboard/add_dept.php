<?php 
include_once('../../connection/db.php');
include_once("../../includes/ad_header.php"); 
head("q",0);
if(!isset($_SESSION['email'])){
  echo"<script>window.location.href = '/minorproject/index.php'</script>";
}else{
$email = $_SESSION['email'];
$query = "SELECT * FROM `signup` WHERE `email` = '$email' AND `status` = 1";
$result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result) == 0){
  echo "<script>window.location.href = '../../additional/home.php';</script>";
  }
$no = "";
$name = "";
$sem_no = "";
$boll = false;
$flag = false;
if(isset($_POST["submit"])){
  $no = $_POST['dept_no'];
  $name = $_POST['dept_name'];
  $sem = $_POST['no_sem'];
  $dq = "SELECT * FROM `dept`";
  $dr = mysqli_query($conn, $dq);
  while($r= mysqli_fetch_assoc($dr))
  {
    $nno = $r['dept_no'];
    $nname = $r['dept_name'];
    if($no == $nno || $name == $nname){
      $flag = true;
    }
  }
  
  if($flag == false){
    $deptiq = "INSERT INTO `dept`(`dept_no`, `dept_name` ,`no_sem`) VALUES ('$no','$name', '$sem')";
    $deptir = mysqli_query($conn, $deptiq);
    if($deptir){
      $_SESSION['message1'] = 'Successfully Submit';
      $_SESSION['message_type1'] = 'success';
      echo "<script>window.location.assign('add_dept.php')</script>";
    }else{
      $_SESSION['message1'] = 'Ohhh Not Submit';
      $_SESSION['message_type1'] = 'danger';
      echo "<script>window.location.assign('add_dept.php')</script>";
    }
  }else{
    $_SESSION['message1'] = 'Department name or Departmrnt number All ready exist';
    $_SESSION['message_type1'] = 'warning';
    echo "<script>window.location.assign('add_dept.php')</script>";
  }
}
if(isset($_GET["edit"])){
  $id = $_GET["edit"];
  $deptiuq = "SELECT * FROM `dept` WHERE `dept_id` = $id";
  $deptiur = mysqli_query($conn, $deptiuq);
  $rowsu= mysqli_fetch_assoc($deptiur);
  $no = $rowsu['dept_no'];
  $name = $rowsu['dept_name'];
  $sem_no = $rowsu['no_sem'];
  $boll = true;
}
if(isset($_POST['update'])){
  $nno = $_POST['dept_no'];
  $nameu = $_POST['dept_name'];
  $sem_no = $_POST['no_sem'];
  $dq = "SELECT * FROM `dept` WHERE `dept_id` <> '$id' ";
  $dr = mysqli_query($conn, $dq);
  while($r= mysqli_fetch_assoc($dr))
  {
    $tno = $r['dept_no'];
    $tname = $r['dept_name'];
    if($nno == $tno || $nameu == $tname){
      $flag = true;
    }
  }
  if($flag == false){
    $deptuq = "UPDATE `dept` SET `dept_no`='$nno',`dept_name`='$nameu', `no_sem` = '$sem_no' WHERE `dept_id` = $id";
    $deptur = mysqli_query($conn, $deptuq);
    $boll = false;
    $no = "";
    $name = "";
    $sem_no = "";
    if($deptur){
      $_SESSION['message1'] = 'Successfully Update';
      $_SESSION['message_type1'] = 'success';
      echo "<script>window.location.assign('add_dept.php')</script>";
    }else{
      $_SESSION['message1'] = 'Ohhh Not Updated';
      $_SESSION['message_type1'] = 'danger';
      echo "<script>window.location.assign('add_dept.php')</script>";
    }
  }else{
    $_SESSION['message1'] = 'Department name or Departmrnt number All ready exist';
    $_SESSION['message_type1'] = 'warning';
    echo "<script>window.location.assign('add_dept.php')</script>";
  }
}
if(isset($_GET['delete'])){
  $idd = $_GET['delete'];
  $dq = "DELETE FROM `dept` WHERE `dept_id` = '$idd'";
  $dq1 = "DELETE FROM `placement` WHERE `dept` = '$idd'";
  $dr1 = $dr = mysqli_query($conn, $dq1);
  $dq2 = "DELETE FROM `training` WHERE `department` = '$idd'";
  $dr2 = $dr = mysqli_query($conn, $dq2);
  $dr = mysqli_query($conn, $dq);
  $dap = "DELETE FROM `apply_placement` WHERE `place_id` = '$idd'";
  $dapr = mysqli_query($conn, $dap);;
  $dat = "DELETE FROM `apply_training` WHERE `tr_id` = '$idd'";
  $datr = mysqli_query($conn, $dat);;
  if($dr && $dr1 && $dr2 && $dapr && $datr){
    $_SESSION['message1'] = 'Successfully Delete';
    $_SESSION['message_type1'] = 'danger';
    echo "<script>window.location.assign('add_dept.php')</script>";
  }else{
    $_SESSION['message1'] = 'Ohhh Not Deleted';
    $_SESSION['message_type1'] = 'danger';
    echo "<script>window.location.assign('add_dept.php')</script>";
  }
}
?>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<br>
<br>
<br>
    <?php if (isset($_SESSION['message1'])) { ?>
      <div class="alert alert-<?= $_SESSION['message_type1']?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message1']?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php 
    } ?>
<br>
<div class="card">
  <div class="card-body">
    <form action = "" method = "POST">
      <div class="form-row">
        <div class="col">
        <label>Department no.</label>
          <input type="text" class="form-control" name = "dept_no" value = "<?php echo $no;?>" id = "no" placeholder="Enter Dept. no." required>
        </div>
        <div class="col">
          <label>Department name</label>
          <input type="text" class="form-control" name = "dept_name" value = "<?php echo $name;?>" id = "name" placeholder="Enter Dept. name" required>
        </div>
        <div class="col">
          <label>Number Of Semester in Dept.</label>
          <input type="text" class="form-control" name = "no_sem" value = "<?php echo $sem_no;?>" id = "name" placeholder="Enter no. of Sem." required>
        </div>
      </div>
      <br>
      <div align="right">
      <?php
      if($boll == true){?>
        <button type="submit" name ="update" class="btn btn-primary">Update</button>
      <?php
      }else{
      ?>
        <button type="submit" name ="submit" class="btn btn-primary">Submit</button>
      <?php
      }
      ?>
      </div>
    </form>
  </div>
</div>
<br>
<br>
<div class="card">
  <div class="card-body">
  <table class="table table-borderless table-hover">
    <thead>
      <tr align="center">
        <th scope="col">Department number</th>
        <th scope="col">Department name</th>
        <th scope="col">Number Of Semester</th>
        <th valign = "middle" colspan = "2">Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $deptq = "SELECT * FROM `dept`";
    $deptr = mysqli_query($conn, $deptq);
    $i = 1;
    while($rows= mysqli_fetch_assoc($deptr) ){
    ?>
      <tr align="center">
        <td><?php echo $rows['dept_no'];?></td>
        <td><?php echo $rows['dept_name'];?></td>
        <td><?php echo $rows['no_sem'];?></td>
        <td><a  class="btn btn-success" href = "add_dept.php?edit=<?php echo $rows['dept_id'];?>"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a></td>
        <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="<?php echo "#exampleModal".$i; ?>"><i class="fa fa-trash" aria-hidden="true"></i> </button></td>
      </tr>
      
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
            <b>Are you sure to delete it?<b><br>
            Delete all the related data with this department...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <a class="btn btn-danger" href="add_dept.php?delete=<?php print $rows['dept_id']?>" role="button">Yes, Delete</a>
          </div>
        </div>
      </div>
    </div>
    <?php
    $i = $i+1;
    }
    ?>
    </tbody>
  </table>
  </div>
</div>
<br>
<br>
<?php
    }
include_once("../../includes/ad_footer.php"); ?>