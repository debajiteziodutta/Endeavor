<?php
// testing 1
include('connection/db.php');
if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];
    $query = "SELECT * FROM `signup` WHERE `email` = '$email' AND `status` = 1";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) == 1){
        header("Location: admin/index.php");
    }
    $query = "SELECT * FROM `signup` WHERE `email` = '$email' AND `status` = 0";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) == 1){
        header("Location: additional/home.php");
    }
}
include_once("includes/header1.php");
?>

<div class="container-fluid" style="background-image:url(images/books-1281581_1920.jpg);background-size:cover;background-repeat:no-repeat;background-attachment:fixed;min-height:100%;" align="center">
<div style = "padding:25%;">
  <a href="additional/signin.php" class="btn btn-primary btn-lg btn-block btns" role="button" aria-pressed="true">Get Started</a>
</div>
</div>
<div class="container-fluid">
<div class="row">
    <div class="col-sm" align="center" style="padding-top:170px;padding-bottom:150px">
     <h3>We have changed the way of thinking.</h3>
    </div>
    <div class="col-sm" style="padding-top:50px;padding-bottom:50px" align="center">
     <img src="images/thought-2123971_1920.jpg" alt="image 1" height="400px" width="600px" />
    </div>
  </div>
</div>

<div class="container-fluid" style="background-color:#4E73Df;">
<div class="row">
    <div class="col-sm" align="center" style="padding-top:50px;padding-bottom:50px">
   <img src="images/laptop-3196481_1920.jpg" alt="image 1" height="400px" width="600px" />
    </div>
    <div class="col-sm" align="right" style="padding-top:170px;padding-bottom:150px;color:white">
	   <h3>Making your college Placement and Training commune more visible.</h3>
    </div>
  </div>
</div>

<div class="container-fluid">
<div class="row">
    <div class="col-sm" align="left" style="padding-top:170px;padding-bottom:100px;">
      <h3>Now every information on upcoming drives will on your fingertips.
      Apply and get hired as you choose.</h3>
    </div>
    <div class="col-sm" align="center" style="padding-top:50px;padding-bottom:50px;">
     <img src="images/business-3167295_1920.jpg" alt="image 1" height="400px" width="600px" />
    </div>
  </div>
</div>

<div class="container-fluid" style="background-color:#4E73Df;">
<div class="row">
    <div class="col-sm" align="center" style="padding-top:50px;padding-bottom:50px">
   <img src="images/computer-3368242_1920.jpg" alt="image 1" height="400px" width="600px" />
    </div>
    <div class="col-sm" align="right" style="padding-top:170px;padding-bottom:150px;color:white">
      <h3>Get hassle free application experience for your training at your college.</h3> 
    </div>
  </div>
</div>

<div class="container-fluid">
<div class="row">
    <div class="col-sm" align="left" style="padding-top:170px;padding-bottom:100px;">
     <h3>The journey is ahead. Are you ready to Get Started... </h3>
    </div>
    <div class="col-sm" align="center" style="padding-top:50px;padding-bottom:50px;">
     <img src="images/business-3224643_1920.jpg" alt="image 1" height="400px" width="600px" />
    </div>
  </div>
</div>

<div class="container-fluid" style="background-image:url(images/team-3373638_1920.jpg);background-size:cover;background-repeat:no-repeat;background-attachment:fixed;min-height:100%;padding:200px;" align="center">

  <div class="row">
    <div class="col">
      
    </div>
    <div class="col-5">
      <a href="additional/signin.php" class="btn btn-primary btn-lg" role="button" aria-pressed="true">Let's Go</a>
    </div>
    <div class="col">
      
    </div>
  </div>

</div>
<?php
include_once("includes/footer.php"); 
?>
