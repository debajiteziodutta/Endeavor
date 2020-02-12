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
      echo"<script>window.location.href = '../../additional/home.php'</script>";
      }
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        //print "$id";
        $query= "SELECT * from heritage WHERE hid = $id";
        $result= mysqli_query($conn, $query);
        $rows= mysqli_fetch_assoc($result);
        $content= $rows['contents'];
       
    }

    if(isset($_POST['update']))
    {
     //$id = $_GET['id'];
      $contents= $_POST['contents'];
     
      //echo $details;
      $query="UPDATE `heritage` SET `contents` = '$contents'  WHERE `hid` = $id";
      $result= mysqli_query($conn, $query);
      //echo $query;
      if($result)
      {
        //print "successfully updated";
        $_SESSION['message_head'] = 'Great!';
        $_SESSION['message'] = 'Details Updated Successfully.';
        $_SESSION['message_type'] = 'success';
        //header("location:trdisplay.php?id=none&toggle=0");
        echo"<script>window.location.href = 'hrdisplay.php'</script>";
      }
      else
      {
        //print "problem uploading file";
        $_SESSION['message_head'] = 'Ohh no!';
        $_SESSION['message'] = 'Update process failed! Try again.';
        $_SESSION['message_type'] = 'danger';
        //header("location: trdisplay.php?id=none&toggle=0");
        echo"<script>window.location.href = 'hrdisplay.php'</script>";
      }
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
    <label for="exampleFormControlTextarea1">Contents:</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="contents" placeholder="notes"><?php echo $content;?></textarea>
  </div>
  <br>
  <br>
  <div align="right">
    <a role="button" class="btn btn-primary" href="hrdisplay.php" name="back">Go Back</a>
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
      
?>
