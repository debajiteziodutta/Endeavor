<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

  <style>
    #loading{
    width: 50px;
    height: 50px;
    border: 5px solid #ccc;
    border-top-color:#3131d2;
    border-left-color: rgba(0,0,0,0);
    border-right-color: rgba(0,0,0,0);
    border-bottom-color: green;
    border-radius: 100%;
    position: fixed;
    left:0;
    right:0;
    top:0;
    bottom:0;
    margin:auto;
    z-index:20;
    animation: round 2s linear infinite;
  }
  @keyframes round{
    from{transform: rotate(0deg)}
    to{transform: rotate(360deg)}
  }
/* Style all font awesome icons */
.fa {
  padding: 20px;
  font-size: 12px;
  width: 45px;
  text-align: center;
  text-decoration: none;
}

/* Add a hover effect if you want */


/* Set a specific color for each brand */

/* Facebook */
.fa-facebook {
  color: #003366;
}
/* Instagram */
.fa-instagram {
  color: #990000;
}

/* LinkedIn */
.fa-linkedin {
  color: #006699;
}

</style>
  <script>
  function hideloader(){
    document.getElementById("loading").style.display = "none";
  }
  </script>
  <?php
  if(isset($_POST['signout'])){
    unset($_SESSION['email']); 
    session_destroy();
    $_SESSION['message'] = 'Successfully Sign Out';
    $_SESSION['message_type'] = 'danger';
    header("location:/minorproject/index.php");
  }
  if(isset( $_SESSION['email'])){
  $email = $_SESSION['email'];
  $query = "SELECT * FROM `signup` WHERE `email` = '$email' AND `status` = 1";
  $result0 = mysqli_query($conn, $query);
  $row0 = mysqli_fetch_array($result0);
  }
  ?>
  <!doctype html>
  <html lang="en">
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      
      <link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  
      <title>Endeavor</title>

    </head>
    <body onload = "hideloader();">
    <div id="loading"></div>    
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow animated--grow-in">
        <a class="navbar-brand" href="../index.php">Endeavor</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            
            
            
            <li class="nav-item">
              <a class="nav-link" href="../additional/heritage.php">Our Placements</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Activities
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="/minorproject/additional/placement_details.php">Placement</a>
                <a class="dropdown-item" href="/minorproject/additional/training_details.php">Traning</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/minorproject/additional/testimonials.php">Feedback</a>
              </div>
            </li>
           
            
            <?php
            if(isset( $_SESSION['email'])){
              if($row0['status'] == 1){
              ?>
              <li class="nav-item">
                <a class="nav-link" href="/minorproject/admin">Back To Admin</a>
              </li>
              <?php
              }
              else
              {
                ?>
                 <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Profile
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <div align='center'>
                      <a class="dropdown-item" href="/minorproject/additional/profile.php">Your Profile</a>
                    </div>
                    <div class="dropdown-divider"></div>
                      <div align='center'>
                        <form class="form-inline my-2 my-lg-0" action = "" method = "POST">
                          <button class="btn btn-outline-success my-2 my-sm-0 dropdown-item" type="submit" name = "signout">Sign Out</button>
                        </form>
                      </div>                
                  </div>
                </li>
               
                <?php
              }
            }
            ?>
          </ul>
         
         
          
          
        </div>
      </nav>
      <div style = "background-color:#F8F9FC">
      <div class="container" style = "min-height: 100%;">