<?php
    include("../../connection/db.php");
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
        echo $id;

        $query = "DELETE from heritage WHERE hid = $id";
        mysqli_query($conn, $query);
        
        //echo "deleted successfully";
        $_SESSION['message_head'] = 'Done!';
        $_SESSION['message'] = 'Record Deleted.';
        $_SESSION['message_type'] = 'danger';
        echo"<script>window.location.href = 'hrdisplay.php'</script>";
    }
    else
    {
        $_SESSION['message_head'] = 'Warning!';
        $_SESSION['message'] = 'Problem in deleting.';
        $_SESSION['message_type'] ='warning';
        echo"<script>window.location.href = 'hrdisplay.php'</script>";
    }
}
?>