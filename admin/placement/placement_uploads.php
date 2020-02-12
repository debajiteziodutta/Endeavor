<?php
include('../../connection/db.php');
if(!isset($_SESSION['email'])){
    echo"<script>window.location.href = '/minorproject/index.php'</script>";
  }else{
  $email = $_SESSION['email'];
  $query = "SELECT * FROM `signup` WHERE `email` = '$email' AND `status` = 1";
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result) == 0){
  echo"<script>window.location.href = '../../additional/home.php'</script>";
  }
if(isset($_POST['submit'])){
    //echo "bikash";
    $upload_file = (string)$_FILES['file']['name'];
    //print $upload_file;
    $filelist = array();
    if ($handle = opendir("pdf")) {
        while ($entry = readdir($handle)) {
                $filelist[] = $entry;
            }
        closedir($handle);
    }
    if(!in_array($upload_file,$filelist)){
    move_uploaded_file($_FILES['file']['tmp_name'],"pdf/".$_FILES['file']['name']);
    //$name = $_POST['dept'];

    /*for($i=0;$i < count($name);++$i){
        $dept .= $name[$i];
        if($i != count($name)-1){
            $dept .= " ";
        }
    }*/
    $company_name = $_POST['company_name'];
    $arriving_date = $_POST['arriving_date'];
    $eligibity_criteria = $_POST['eligibity_criteria'];
    $vacancy = $_POST['vacancy'];
    $jobrole = $_POST['jobrole'];
    $contact = $_POST['contact'];
    $backlog = $_POST['backlog'];
    $notes = $_POST['notes'];
    $applydate = $_POST['last_apply_date'];
    $link = $_POST['link'];

    
    $roundn = $_POST['round'];
        for($j=1;$j<=$roundn;++$j){
            $round[$roundn][$j] = $_POST['Round'.$roundn.$j];
            $duration[$roundn][$j] = $_POST['duration'.$roundn.$j];
        }
    /*echo "<pre>";
    print_r($round);
    echo "</pre>";
    echo "<pre>";
    print_r($duration);
    echo "</pre>";*/
    $str_round = null;
    $str_duration = null;
    for($j=1;$j<=$roundn;++$j){
        $str_round .= $round[$roundn][$j];
        if($j != $roundn){
        $str_round .='/';
        }
    }
    for($j=1;$j<=$roundn;++$j){
        $str_duration .= $duration[$roundn][$j];
        if($j != $roundn){
        $str_duration .='/';
        }
    }
    echo  $str_duration;
    echo  $str_round;
    $qd = "SELECT count(*) AS 'nodept'  FROM `dept`";
    $rd = mysqli_query($conn, $qd);
    $rd = mysqli_fetch_array($rd);
    $nodept = $rd['nodept'];
    //echo $$nodept;
    $sem1 = array();
    $j = 1;
    for($k = 1; $k <= $nodept; $k++){
        $name = 'sem'.$k;
        if(isset($_POST[$name])){
            $sem1[$j] = $_POST[$name];
            $j = $j+1;
        }
    }
    print_r($sem1);
    $dept = $_POST['dept'];
    for($i=0;$i < count($dept);++$i){
        $dept_name = $dept[$i];
        $sem = $sem1[$i+1];
        $query ="INSERT INTO `placement`(`dept`,`sem`,`company_name`, `arriving_date`,`last_apply_date`, `eligibity_criteria`, `vacancy`, `job_role`, `pdf_name`, `contact_details`, `active_backlog`, `Round_name`, `Round_duration`,`notes`,`link`) VALUES ('$dept_name','$sem','$company_name','$arriving_date','$applydate','$eligibity_criteria','$vacancy','$jobrole','$upload_file','$contact','$backlog','$str_round','$str_duration','$notes','$link')";
    
        echo $query;
        if(mysqli_query($conn, $query)){
                        //print "successfully updated";
                    $_SESSION['message_head'] = 'Great!';
                    $_SESSION['message'] = 'Details Insert Successfully.';
                    $_SESSION['message_type'] = 'success';
                    header("location: placement_display.php?id=".base64_encode('none')."&toggle=0");
        } 
        else{
                $_SESSION['message_head'] = 'Ohh no!';
                $_SESSION['message'] = 'Insert process failed! Try again.';
                $_SESSION['message_type'] = 'danger';
                header("location: placement_display.php?id=".base64_encode('none')."&toggle=0");
        }
    }
}
else{
    $_SESSION['message_head'] = 'Ohh no!';
    $_SESSION['message'] = 'Insert another file or rename it ...';
    $_SESSION['message_type'] = 'danger';
    header("location: placement_display.php?id=".base64_encode('none')."&toggle=0");
}
}else{
    $_SESSION['message_head'] = 'Ohh no!';
    $_SESSION['message'] = 'you not open this page.';
    $_SESSION['message_type'] = 'danger';
    header("location: placement_display.php?id=".base64_encode('none')."&toggle=0");
}
}
?>