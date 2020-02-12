<?php 
include('../connection/db.php');
if(!empty($_SESSION['email'])){
    $email = $_SESSION['email'];
    $query = "SELECT * FROM `signup` WHERE `email` = '$email' AND `status` = 1";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    if($email == $row['email']){
        header("location:/minorproject/admin/dashboard/blank.php");
    }else{
        header("location:/minorproject/additional/home.php");
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--men-1979261_1920-->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Endeavor Sign_Ip</title>
  </head>
  <body>
    <nav class="navbar navbar-dark bg-dark shadow animated--grow-in">
        <a class="navbar-brand" href="../index.php">Endeavor</a>
    </nav>
    <div class="container-fluid" style="background-image:url(../images/woman-801872_1920.jpg);background-size:cover;background-repeat:no-repeat;background-attachment:fixed;min-height:100%;padding:50px;" align="center">
    <br>
    <br>
    <br>
    
<div align="center" class="container">
    <div align="left" class="col-8">
    <font color = "white">
    <div class="card" style = "background:rgba(0,0,0,0.5)">
        <div class="card-body">
        <?php 
        if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message']?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
        }
        unset($_SESSION['message']); 
        unset($_SESSION['message_type']); 
        ?>
        <h1 align="center">Welcome Back!</h1>
        <p align="center">Please Sign In to continue</p>
        <br>
        <br>
        <form action="chk_signin.php" method="POST" class="was-validated">
            <div class="form-group">
            <p align = "left">
                <label for="username">Email Address</label>
                <input class="form-control" type="email" id="username" aria-describedby="emailHelp" placeholder="Enter username" name = "email" required>
            </div>                       
            <div class="form-group">
            <p align = "left">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password" name = "pass" required>
            </div>                                                  
            <!--<div class="form-group form-check">
            <p align = "left">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" disabled>
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>  -->                 
            <br>
            <div align="center">
                <button type="reset" class="btn btn-danger">Cancel</button>
                <button type="submit" class="btn btn-success" name = "signin">Sign In</button>
            </div>
            <br>
            <p align="center">Not having an account? <a href="signup.php">Sign Up</a> here.</p>
            <br>
        </form>
        <br>
        </div>
    </div>
    </div>
</div>    
<br>
<br>
<?php include_once("../includes/footer.php") 
?>