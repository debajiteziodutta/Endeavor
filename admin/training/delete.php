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

        $query = "SELECT * FROM training WHERE `tid` = $id";
        $result = mysqli_query($conn, $query);
        $data =  mysqli_fetch_array($result);
        $filelist = array();
        if ($handle = opendir("uploads")) {
            while ($entry = readdir($handle)) {
                    $filelist[] = $entry;
                }
            closedir($handle);
        }
        if(in_array($data['training_details'],$filelist)){
                unlink("uploads/".$data['training_details']);
        }

        $query = "DELETE from training WHERE tid = $id";
        mysqli_query($conn, $query);
        $query = "DELETE FROM `apply_training` WHERE tr_id = $id";
        mysqli_query($conn, $query);
        //echo "deleted successfully";
        $_SESSION['message_head'] = 'Done!';
        $_SESSION['message'] = 'Record Deleted.';
        $_SESSION['message_type'] = 'danger';
        header("location: trdisplay.php?id=".base64_encode('none')."&toggle=0");
    }
    else
    {
        $_SESSION['message_head'] = 'Warning!';
        $_SESSION['message'] = 'Problem in deleting.';
        $_SESSION['message_type'] ='warning';
        header("location: trdisplay.php?id=".base64_encode('none')."&toggle=0");
    }
}
?>