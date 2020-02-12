<?php 
include_once('../../connection/db.php');
include_once("../../includes/ad_header.php"); 
head("q",1);
if(!isset($_SESSION['email'])){
  //header("Location: ../../additional/signin.php");
  echo "<script>window.location.href = '/minorproject/index.php';</script>";
}else{
$email = $_SESSION['email'];
$query = "SELECT * FROM `signup` WHERE `email` = '$email' AND `status` = 1";
$result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result) == 0){
  echo "<script>window.location.href = '../../additional/home.php';</script>";
  }
?>

          <!-- Page Heading -->
        <div align = center>
            <h1 class="h3 mb-4 text-gray-800" style="padding-top:20%">Hi there!</h1>
            <br>
            <p><h4>Select from the side contents and lets Get Started</h4></p>
            
        </div>  
        <?php
       }
include_once("../../includes/ad_footer.php"); ?>
 
