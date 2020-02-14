<?php
//testing1 file 2 
//testing 2 file 2 on github webpage
include('../connection/db.php');
if(!isset($_SESSION['email'])){
  header("Location: signin.php");
}else{
    include_once("../includes/header.php");
    if(isset($_POST['submit_feedback'])){
        $message = $_POST['message'];
        $email = $_SESSION['email'];
        $size_word = explode(' ', $message);
        $word = sizeof($size_word);
        if($word <= 100){
            $q1 = "SELECT * FROM `signup` WHERE `email` = '$email'";
            $e1 = mysqli_query($conn,$q1);
            $r1 = mysqli_fetch_array($e1);
            $u_id = $r1['id'];
            $q2 = "INSERT INTO `feedbcak`(`u_id`,`message`) VALUES ($u_id,'$message')";
            $e2 = mysqli_query($conn,$q2);;
            if($e2){
                $_SESSION['message'] = 'Successfully Submitted';
                $_SESSION['message_type'] = 'success';
                echo"<script>window.location.href = 'testimonials.php'</script>";
            }else{
                $_SESSION['message'] = 'Ohhh no! Not Submitted';
                $_SESSION['message_type'] = 'danger';
                echo"<script>window.location.href = 'testimonials.php'</script>";
            }
        }else{
            $_SESSION['message'] = 'Your feedback must be in 20 words';
            $_SESSION['message_type'] = 'warning';
            echo"<script>window.location.href = 'testimonials.php'</script>";
        }
    }
}
?>
