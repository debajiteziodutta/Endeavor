<?php
include('../connection/db.php');
if(isset($_SESSION['email'])){
    unset($_SESSION['email']); 
    session_destroy();
    $_SESSION['message'] = 'Successfully Sign Out';
    $_SESSION['message_type'] = 'danger';
    header("location:/minorproject/index.php");
}else{
    //header("location:/minorproject/admin");
}
?>