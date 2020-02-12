<?php
include('../connection/db.php');

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Endeavor Sign_Up</title>
  </head>
  <body>

          <nav class="navbar navbar-dark bg-dark shadow animated--grow-in">
            <a class="navbar-brand" href="../index.php">Endeavor</a>
        </nav>
        <div class="container-fluid" style="background-image:url(../images/conference-room-768441_1920.jpg);background-size:cover;background-repeat:no-repeat;background-attachment:fixed;min-height:100%;padding:50px;" align="center">
        <br>
        <br>
        <div align="center" class="container">
        <div align="left" class="col-8">
       
        <font color = "white">
        <div class="card" style = "background:rgba(0,0,0,0.5)">
            <div class="card-body">
        <h1 align="center">Sign Up</h1>
					<p align="center">Please fill in the details to continue</p>
                    <br>
                    <br>
            <form action="datasignup.php" method="POST">
                 <?php if (isset($_SESSION['message'])) { ?>
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
            
                        <div class="form-group">
                            <label for="username">Roll Number</label>
                            <input type="txt" class="form-control" id="username" aria-describedby="esernameHelp" placeholder="Enter username" name = "username" required>
                            
                        </div>
                        <div class="form-group">
                            <label for="username">First Name</label>
                            <input type="txt" class="form-control" id="firstname" aria-describedby="esernameHelp" placeholder="Enter First Name" name = "firstname" required>
                            
                        </div>
                        <div class="form-group">
                            <label for="username">Middle Name</label>
                            <input type="txt" class="form-control" id="middlename" aria-describedby="esernameHelp" placeholder="Enter Middle Name" name = "middlename">
                            
                        </div>
                        <div class="form-group">
                            <label for="username">Last Name</label>
                            <input type="txt" class="form-control" id="lastname" aria-describedby="esernameHelp" placeholder="Enter Last Name" name = "lastname" required>
                            
                        </div>
                        <div class="form-group">
                            <label for="email">Email Id</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter Email Id" name = "email" required>
                            
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password" name = "password" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm-password" placeholder="Confirm Password" name = "confirm-password" required>
                        </div>
                        
                        <br>
                        <div align="center">
                            <button type="reset" class="btn btn-danger">Cancel</button>
                            <input type="submit" class="btn btn-success" value="Sign Up" name="submit">
       
                        </div>
                        <br>
                            <p align="center">Already an account? <a href="signin.php">Sign In</a> here.</p>
                            <br>
                    </form>
                    
            </div>
        </div>
    </div>
   </div> 
   <br>
   <br>
   <br>
   <?php include_once("../includes/footer.php"); ?>
