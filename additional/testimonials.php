<?php
include('../connection/db.php');
if(!isset($_SESSION['email'])){
  echo"<script>window.location.href = '/minorproject/index.php'</script>";
}else{
    include_once("../includes/header.php");
?>
<br>
<br>
<?php
if (isset($_SESSION['message'])) { ?>
    <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['message'];?>
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
    <div class="card">
      <div class="card-body">
        <form class="was-validated" action = "add_feedback.php" method = "POST">
            <div class="mb-3">
                <label for="validationTextarea"><h4><i class="fa fa-commenting-o" aria-hidden="true" style= 'color: black'></i> Feedback</h4></label>
                <br>
                <textarea class="form-control" id="validationTextarea" rows = "10" placeholder="Add feedback here..." name = "message" required></textarea>
            </div>
            <br>
            <br>
            <div align="right">
                <button type="submit" class="btn btn-primary" name = "submit_feedback">Submit Feedback</button>
                <br>
                <br>
                <p><small class="text-muted">Your feedback must be in 20 words</small></p>
            </div>
        </from>
      </div>
    </div>
    <div style='padding:5%'>
    </div>
    <?php
    

    $query = "SELECT * FROM `feedbcak`, `signup` WHERE `signup`.`id` = `feedbcak`.`u_id` ORDER BY `feedbcak`.`date_time` DESC";
    $result = mysqli_query($conn, $query);  
while($row = mysqli_fetch_array($result)){
?>
<div class="alert alert-light  shadow p-3 mb-5 bg-white rounded" role="alert" data-delay="10">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  <b><?php echo $row['name'];?> <sub> <?php echo $row['date_time'];?> </sub><br></b>
  <p class="text-break"><?php echo $row['message'];?></p>
</div>
<?php
}
?>
<div style='padding:8%'>
    </div>

<?php
include_once("../includes/footer.php");
}
?>