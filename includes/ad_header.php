<?php
function head($topic,$sub_topic){
?>
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
  </style>
  <script>
  function hideloader(){
    document.getElementById("loading").style.display = "none";
  }
  </script>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Endeavor</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top"  onload = "hideloader();">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="\minorproject\admin\dashboard\blank.php">
        <div class="sidebar-brand-icon rotate-n-15">
        </div>
        <div class="sidebar-brand-text mx-3">Contents</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Pages Collapse Menu -->
      <?php
      if($topic == "q"){
        ?>
          <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fa fa-graduation-cap"></i>
          <span>Placement</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Placement Activity:</h6>
            <a class="collapse-item " href="../placement/placement.php">Add Placement +</a>
            <a class="collapse-item" href="../placement/placement_display?id=<?php echo base64_encode('none');?>&toggle=0.php">Show Details</a>
            <a class="collapse-item" href="../placement/apply_show.php">Applied Candidates</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Training</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Training Activity:</h6>
            <a class="collapse-item" href="../training/training.php">Add Training +</a>
            <a class="collapse-item" href="../training/trdisplay.php?id=<?php echo base64_encode('none');?>&toggle=0">Show Details</a>
            <a class="collapse-item" href="../training/apply_show.php">Applied Candidates</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiesh" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fa fa-paper-plane" aria-hidden="true"></i>
          <span>Our Placements</span>
        </a>
        <div id="collapseUtilitiesh" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Previous Placement Data:</h6>
            <a class="collapse-item" href="../dashboard/heritage.php">Add +</a>
            <a class="collapse-item" href="../dashboard/hrdisplay.php">Show Details</a>
           
          </div>
        </div>
      </li>
        <?php
      }
      if($topic == "p"){
        ?>
        <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
          <span>Placement</span>
        </a>
        <?php
        if($sub_topic == 1){
      ?>
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Placement Activity:</h6>
            <a class="collapse-item active" href="../placement/placement.php">Add Placement +</a>
            <a class="collapse-item" href="../placement/placement_display?id=<?php echo base64_encode('none');?>&toggle=0.php">Show Details</a>
            <a class="collapse-item" href="../placement/apply_show.php">Applied Candidates</a>
          </div>
        </div>
      <?php
        }
      if($sub_topic == 2){
      ?>
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Placement Activity:</h6>
            <a class="collapse-item " href="../placement/placement.php">Add Placement +</a>
            <a class="collapse-item active" href="../placement/placement_display?id=<?php echo base64_encode('none');?>&toggle=0.php">Show Details</a>
            <a class="collapse-item" href="../placement/apply_show.php">Applied Candidates</a>
          </div>
        </div>
      <?php
        }
      if($sub_topic == 3){
      ?>
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Placement Activity:</h6>
            <a class="collapse-item " href="../placement/placement.php">Add Placement +</a>
            <a class="collapse-item " href="../placement/placement_display?id=<?php echo base64_encode('none');?>&toggle=0.php">Show Details</a>
            <a class="collapse-item active" href="../placement/apply_show.php">Applied Candidates</a>
          </div>
        </div>
      <?php
        }
      
      ?>
      </li>
      
      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Training</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Training Activity:</h6>
            <a class="collapse-item" href="../training/training.php">Add Training +</a>
            <a class="collapse-item" href="../training/trdisplay.php?id=<?php echo base64_encode('none');?>&toggle=0">Show Details</a>
            <a class="collapse-item" href="../training/apply_show.php">Applied Candidates</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiesh" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fa fa-paper-plane" aria-hidden="true"></i>
          <span>Our Placements</span>
        </a>
        <div id="collapseUtilitiesh" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Previous Placement Data:</h6>
            <a class="collapse-item" href="../dashboard/heritage.php">Add +</a>
            <a class="collapse-item" href="../dashboard/hrdisplay.php">Show Details</a>
           
          </div>
        </div>
      </li>
      <?php
      }
      ?>

      <!--training-->
      <?php
      if($topic == "T"){
        ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fa fa-graduation-cap"></i>
          <span>Placement</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Placement Activity:</h6>
            <a class="collapse-item " href="../placement/placement.php">Add Placement +</a>
            <a class="collapse-item" href="../placement/placement_display?id=<?php echo base64_encode('none');?>&toggle=0.php">Show Details</a>
            <a class="collapse-item" href="../placement/apply_show.php">Applied Candidates</a>
          </div>
        </div>
      </li>

        <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench" aria-hidden="true"></i>
          <span>Training</span>
        </a>
        <?php
        if($sub_topic == 1){
      ?>
        <div id="collapseUtilities" class="collapse show" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Training Activity:</h6>
            <a class="collapse-item active" href="../training/training.php">Add Training +</a>
            <a class="collapse-item" href="../training/trdisplay.php?id=<?php echo base64_encode('none');?>&toggle=0">Show Details</a>
            <a class="collapse-item" href="../training/apply_show.php">Applied Candidates</a>
          </div>
        </div>
      <?php
        }
      if($sub_topic == 2){
      ?>
        <div id="collapseUtilities" class="collapse  show" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Training Activity:</h6>
            <a class="collapse-item " href="../training/training.php">Add Training +</a>
            <a class="collapse-item active" href="../training/trdisplay.php?id=<?php echo base64_encode('none');?>&toggle=0">Show Details</a>
            <a class="collapse-item" href="../training/apply_show.php">Applied Candidates</a>
          </div>
        </div>
      <?php
        }
      if($sub_topic == 3){
      ?>
        <div id="collapseUtilities" class="collapse show" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Training Activity:</h6>
            <a class="collapse-item " href="../training/training.php">Add Training +</a>
            <a class="collapse-item" href="../training/trdisplay.php?id=<?php echo base64_encode('none');?>&toggle=0">Show Details</a>
            <a class="collapse-item active" href="../training/apply_show.php">Applied Candidates</a>
          </div>
        </div>
      <?php
        }
        ?>
        </li>
        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiesh" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fa fa-paper-plane" aria-hidden="true"></i>
          <span>Our Placements</span>
        </a>
        <div id="collapseUtilitiesh" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Previous Placement Data:</h6>
            <a class="collapse-item" href="../dashboard/heritage.php">Add +</a>
            <a class="collapse-item" href="../dashboard/hrdisplay.php">Show Details</a>
           
          </div>
        </div>
      </li>
        <?php
      }
      ?>
      <?php
      if($topic == "h"){
        ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fa fa-graduation-cap"></i>
          <span>Placement</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Placement Activity:</h6>
            <a class="collapse-item " href="../placement/placement.php">Add Placement +</a>
            <a class="collapse-item" href="../placement/placement_display?id=<?php echo base64_encode('none');?>&toggle=0.php">Show Details</a>
            <a class="collapse-item" href="../placement/apply_show.php">Applied Candidates</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Training</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Training Activity:</h6>
            <a class="collapse-item" href="../training/training.php">Add Training +</a>
            <a class="collapse-item" href="../training/trdisplay.php?id=<?php echo base64_encode('none');?>&toggle=0">Show Details</a>
            <a class="collapse-item" href="../training/apply_show.php">Applied Candidates</a>
          </div>
        </div>
      </li>
        <li class="nav-item active">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiesh" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fa fa-paper-plane" aria-hidden="true"></i>
              <span>Our Placements</span>
            </a>
            <?php
        if($sub_topic == 1){
          ?>
          <div id="collapseUtilitiesh" class="collapse show" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Previous Placement Data:</h6>
                <a class="collapse-item active" href="../dashboard/heritage.php">Add +</a>
                <a class="collapse-item" href="../dashboard/hrdisplay.php">Show Details</a>
              </div>
            </div>
          <?php
        }
        if($sub_topic == 2){
          ?>
         <div id="collapseUtilitiesh" class="collapse show" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Previous Placement Data:</h6>
                <a class="collapse-item " href="../dashboard/heritage.php">Add +</a>
                <a class="collapse-item active" href="../dashboard/hrdisplay.php">Show Details</a>
              </div>
            </div>
          
          <?php
        }
        ?>
        </li>
        <?php
      }
        ?>

      <!-- Nav Item - Utilities Collapse Menu -->
      <hr class="sidebar-divider my-0">
      <li class="nav-item">
        <a class="nav-link collapsed" href="/minorproject/additional/home.php">
         
          <span><i class="fa fa-home" aria-hidden="true"></i> Home</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="/minorproject/admin/dashboard/add_dept.php">
         <span><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Department</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="/minorproject/admin/dashboard/show_req.php?id=<?php echo base64_encode('none');?>">
         <span><i class="fa fa-share-square" aria-hidden="true"></i>Show Request</span>
        </a>
      </li>
      
      <!-------------------
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiesh" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fa fa-paper-plane" aria-hidden="true"></i>
          <span>Our Placements</span>
        </a>
        <div id="collapseUtilitiesh" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Previous Placement Data:</h6>
            <a class="collapse-item" href="../dashboard/heritage.php">Add +</a>
            <a class="collapse-item" href="../dashboard/hrdisplay.php">Show Details</a>
           
          </div>
        </div>
      </li>
    ------------------>
     
      
      <hr class="sidebar-divider my-0">
      <li class="nav-item">
        <a class="nav-link collapsed" href="/minorproject/additional/testimonials.php">
          
          <span><i class="fa fa-comments" aria-hidden="true"></i> Feedback</span>
        </a>
      </li>
      

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      
      <li class="nav-item">
        <a class="nav-link collapsed" href="/minorproject/additional/about.php">
          
          <span><i class="fa fa-id-badge" aria-hidden="true"></i> About Us</span>
        </a>
      </li>

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
<style>
.navbar-light{
padding: 20px;
background-color: white;
}
.navbar-light .navbar-brand {
    color: #fff;
}
.navbar-light .navbar-nav .nav-link {
    color: #fff;
}
.navbar-light .navbar-nav .nav-link:hover {
color:#555;
}
[type=submit]:not(:disabled), button:not(:disabled){
    color: #fff;
	border:1px solid #fff;
}
 button:not(:disabled):hover{
 background-color:#555;
 }
.btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show>.btn-primary.dropdown-toggle {
    color: #fff;
    background-color: #4E73DF;
    border-color:#4E73DF;
}
	  </style>
    <div id="loading"></div>   
      <nav class="navbar navbar-expand-lg navbar-light shadow animated--grow-in">
        <b><a style="color: Black" class="navbar-brand" href="/minorproject/additional/home.php">Endeavor</a></b>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            
          <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 text-Grey-900 "><b><font color="Grey">Admin</font></b></span>
                <!--<img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">-->
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
               <a class="dropdown-item" href="/minorproject/includes/ad_logout.php" >
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
            
          </ul>
          <!--<form class="form-inline my-2 my-lg-0">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Sign Out</button>
          </form>-->
        </div>
      </nav>
      <div class="container" style = "min-height: 100%;">
      <?php
      }
      ?>
