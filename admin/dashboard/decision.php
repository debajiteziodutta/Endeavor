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
    $none = base64_encode('none');
    if(isset($_GET['sid'])){
        $id = $_GET['sid'];
        $query = "UPDATE `signup` SET `status` = 0 , `ignored_message` = 'null' WHERE `id` = '$id'";
        $result =  mysqli_query($conn, $query);
        if($result){
            $_SESSION['message'] = 'Selected Successfully';
            $_SESSION['message_type'] = 'success';
            echo"<script>window.location.href = 'show_req.php?id=".$none."'</script>";
        }else{
            $_SESSION['message'] = 'Not Selected';
            $_SESSION['message_type'] = 'warning';
            echo"<script>window.location.href = 'show_req.php?id=".$none."'</script>";
        }
    }elseif(isset($_GET['rid'])){
        $id = $_GET['rid'];
        $query = "UPDATE `signup` SET `status`= 4 , `ignored_message` = 'null' WHERE `id` = '$id'";
        $result =  mysqli_query($conn, $query);
        if($result){
            $_SESSION['message'] = 'Successfully Rejected';
            $_SESSION['message_type'] = 'danger';
            echo"<script>window.location.href = 'show_req.php?id=".$none."'</script>";
        }else{
            $_SESSION['message'] = 'Not Rejected';
            $_SESSION['message_type'] = 'warning';
            echo"<script>window.location.href = 'show_req.php?id=".$none."'</script>";
        }
    }elseif(isset($_GET['iid'])){
        $id = $_GET['iid'];
        $query = "UPDATE `signup` SET `ignored_message`='Please fill correct information' WHERE `id` = $id";
        $result =  mysqli_query($conn, $query);
        if($result){
            $_SESSION['message'] = 'Successfully Ignored';
            $_SESSION['message_type'] = 'warning';
            echo"<script>window.location.href = 'show_req.php?id=".$none."'</script>";
        }else{
            $_SESSION['message'] = 'Not Ignored';
            $_SESSION['message_type'] = 'warning';
            echo"<script>window.location.href = 'show_req.php?id=".$none."'</script>";
        }
    }

}
?>