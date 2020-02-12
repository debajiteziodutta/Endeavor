<?php 
include("../../connection/db.php");
include_once("../../includes/ad_header.php"); 
head("h",1);
if(!isset($_SESSION['email'])){
  echo"<script>window.location.href = '/minorproject/index.php'</script>";
}else{
  $email = $_SESSION['email'];
  $query = "SELECT * FROM `signup` WHERE `email` = '$email' AND `status` = 1";
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result) == 0){
  echo"<script>window.location.href = '../../additional/home.php'</script>";
  }

  if(isset($_POST['upload']))
  {
    $contents = $_POST['notes'];
    $q = "INSERT INTO `heritage` (`contents`) VALUES ('$contents')";
    $r = mysqli_query($conn, $q);
    
    if($r)
    {
      echo"<script>window.location.href = 'hrdisplay.php'</script>";
    }else{
      echo"not submit";
    }
  }
?>

<br>
<br>
<h3>Add about Pevious Placements</h3>
<br>
<br>
<form action='' method='POST'>
  <div class="form-group">
    <label for="exampleInputEmail1">Start Writing</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"name="notes" placeholder="Write a brief note here."></textarea>
  </div>
  <div align="right">
    <button type="submit" class="btn btn-primary" value="Upload" name = "upload">Upload</button>
  </div>
</form>
<br>
<br>
<?php 
}
include_once("../../includes/ad_footer.php"); 

?>