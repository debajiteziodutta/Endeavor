<?php 
include("../../connection/db.php");
include_once("../../includes/ad_header.php");
head("h",2);
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

      <h3>Previous Placement details for all Departments</h3>
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
        <div align = "right">
          <a class="btn btn-success" href="edit.php?id=<?php print $row['hid']?>" role="button">Edit</a>
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
                <a class="btn btn-danger" href="deleteh.php?id=<?php print $row['hid']?>" role="button">Yes, Delete</a>
               
             </div>
            </div>
          </div>
        </div>
        
        
      
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

<?php 

include_once("../../includes/ad_footer.php"); 

?>