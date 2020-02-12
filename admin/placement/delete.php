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
       
        $query = "SELECT * FROM placement WHERE `id` = $id";
        $result = mysqli_query($conn, $query);
        $data =  mysqli_fetch_array($result);
        $pdf = $data['pdf_name'];
        $dirq = "SELECT count(*) AS 'count' FROM `placement` WHERE `placement`.`pdf_name` = '$pdf'";
        $dirr = mysqli_query($conn, $dirq);
        $dird =  mysqli_fetch_array($dirr);
        $filelist = array();
        if($dird['count']==1){
            if ($handle = opendir("pdf")) {
                while ($entry = readdir($handle)) {
                        $filelist[] = $entry;
                    }
                closedir($handle);
            }
            if(in_array($data['pdf_name'],$filelist)){
                    unlink("pdf/".$data['pdf_name']);
            }
        }

        $query = "DELETE FROM placement WHERE id = $id";
        $delete = "DELETE FROM `apply_placement` WHERE `place_id` = $id";
        mysqli_query($conn, $delete);
        mysqli_query($conn, $query);
        //echo "deleted successfully";
        $_SESSION['message_head'] = 'Done!';
        $_SESSION['message'] = 'Record Deleted.';
        $_SESSION['message_type'] = 'danger';
        header("location: placement_display.php?id=".base64_encode('none')."&toggle=0");
    }
    else
    {
        $_SESSION['message_head'] = 'Warning!';
        $_SESSION['message'] = 'Problem in deleting.';
        $_SESSION['message_type'] = 'warning';
        header("location: placement_display.php?id=".base64_encode('none')."&toggle=0");
    }
}
?>