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
if(isset($_POST['upload'])){
    $file= (string)$_FILES['file']['name'];
        //print $upload_file;
        $filelist = array();
        if ($handle = opendir("uploads")) {
            while ($entry = readdir($handle)){
                    $filelist[] = $entry ;
            }
            closedir($handle);
        }
    if(!in_array($file,$filelist)){
        move_uploaded_file($_FILES['file']['tmp_name'], "uploads/".$_FILES['file']['name']);
        $department= $_POST['department'];
        $company= $_POST['companyname1'];
        $ttopic= $_POST['traningtopic1']; 
        $prerequisites= $_POST['prerequisites'];
        $startdate= $_POST['startdate'];
        $applydate = $_POST['last_apply_date'];
        $tenure= $_POST['trainingtime'];
        $companycontact= $_POST['companycontact'];
        $sem = $_POST['sem'];
        $notes= $_POST['notes'];

        //print "$department";
        $query = "INSERT INTO training(`department`, `sem`, `Company_name`, `training_topic`, `Prerequisites`, `training_details`, `Starting_date`,`last_apply_date`, `tenure`, `details_of_company`, `notes`) VALUES ('$department','$sem','$company','$ttopic','$prerequisites','$file','$startdate','$applydate','$tenure','$companycontact','$notes')"; 
        $result= mysqli_query($conn, $query);

        if($result)
        {
            //print "success";
            $_SESSION['message_head'] = 'Well done!';
            $_SESSION['message'] = 'Details successfully added to records.';
            $_SESSION['message_type'] = 'success';
            header("location: trdisplay.php?id=".base64_encode('none')."&toggle=0");
        }

        else{
            //print "failure";
            $_SESSION['message_head'] = 'Oops!';
            $_SESSION['message'] = 'Process failed! Try again.';
            $_SESSION['message_type'] = 'danger';
            header("location: trdisplay.php?id=".base64_encode('none')."&toggle=0");
        }
    }
    else{
        $_SESSION['message_head']= 'Ohh no!';
        $_SESSION['message'] = 'Insert another file or rename it ...';
        $_SESSION['message_type'] = 'danger';
        header("location: trdisplay.php?id=".base64_encode('none')."&toggle=0");
    }
}
else{
    $_SESSION['message_head'] = 'Ohh no!';
    $_SESSION['message'] = 'you not open it.';
    $_SESSION['message_type'] = 'danger';
    header("location: trdisplay.php?id=".base64_encode('none')."&toggle=0");
}
}
 ?>