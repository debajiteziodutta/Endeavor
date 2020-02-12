<?php
include('../connection/db.php');
if(isset($_POST['feedback'])){
    $message = $_POST['message'];
    if(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
    }else{
        $email = "";
    }
    $query = "INSERT INTO `feedbcak`(`email`, `message`) VALUES ('$email','$message')";
    $result = mysqli_query($conn, $query);
    //header("location:javascript://history.go(-1)");
    header('location:' . $_SERVER['HTTP_REFERER']);
    exit;
}
?>