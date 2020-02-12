<?php
date_default_timezone_set('Asia/Kolkata');
include('../connection/db.php');
if(!isset($_SESSION['email'])){
    echo"<script>window.location.href = '/minorproject/index.php'</script>";
}else{
    if(isset($_POST['add_profile'])){
        $flag = 0;
        $email = $_SESSION['email'];
        $query = "SELECT * FROM `signup`,`dept` WHERE `signup`.`email` = '$email' AND `signup`.`dept` = `dept`.`dept_id` AND `signup`.`status` <> 4";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        $roll = $row['rollno'];
        $name = $row['name'];
        $no_sem = $row['no_sem'];
        $filelist = array();
        if ($handle = opendir("profile")) {
            while ($entry = readdir($handle)) {
                $filelist[] = $entry;
                }
            closedir($handle);
        }
        if($row['status'] == 2){
            $status = 2;
            $q1 = "SELECT * FROM `signup`,`dept` WHERE `signup`.`email` = '$email' AND `signup`.`dept` = `dept`.`dept_id` AND `signup`.`status` <> 4";
            $r1 = mysqli_query($conn, $q1);
            $row1 =  mysqli_fetch_array($r1);
            $dob_file = $row['dobfile'];
            $file_10 = $row['file10'];
            $file_12 = $row['file12'];
            if(!empty($_FILES['dob_file']['tmp_name'])){
                $file = $_FILES['dob_file']['name'];
                $ext = pathinfo($file,PATHINFO_EXTENSION);
                $dob_file = "DOB_".$roll.'.'.$ext;
                if(in_array($dob_file,$filelist)){
                    unlink("profile/".$dob_file);
                }
                move_uploaded_file($_FILES['dob_file']['tmp_name'],"profile/".$dob_file);
            }
            if(!empty($_FILES['10th_file']['tmp_name'])){
                $file = $_FILES['10th_file']['name'];
                echo $file;
                $ext = pathinfo($file,PATHINFO_EXTENSION);
                $file_10 = "10th_".$roll.'.'.$ext;
                if(in_array($file_10,$filelist)){
                    unlink("profile/".$file_10);
                }
                move_uploaded_file($_FILES['10th_file']['tmp_name'],"profile/".$file_10);
            }
            if(!empty($_FILES['12th_file']['tmp_name'])){
                $file = $_FILES['12th_file']['name'];
                $ext = pathinfo($file,PATHINFO_EXTENSION);
                $file_12 = "12th_".$roll.'.'.$ext;
                if(in_array($file_12,$filelist)){
                    unlink("profile/".$file_12);
                }
                move_uploaded_file($_FILES['12th_file']['tmp_name'],"profile/".$file_12);
            }
            $dob = null;
            $gen = null;
            if(isset($_POST['d_o_b'])){
                $dob  = $_POST['d_o_b'];
            }
            if(isset($_POST['gen'])){
                $gen = $_POST['gen'];
            }
            
            $marks_10 = $_POST['10th'];
            $marks_12 = $_POST['12th'];
            $q = "UPDATE `signup` SET `dob`='$dob',`dobfile`='$dob_file',`gender`='$gen',`marks10`='$marks_10',`file10`='$file_10',`marks12`='$marks_12',`file12`='$file_12',`ignored_message` = 'null' WHERE `email` = '$email' AND `status` = 2";
            echo $q;
            $r = mysqli_query($conn, $q);
            if($r){
                $flag = 1;
            }
        }
        if($row['status'] == 0){
            $status = 3;
        }
        if($row['status'] == 3){
            $status = 3;
        }
        
        $str_marks = null;
        $str_file = null;
        $temp_file = $row['sem_file'];
        $temp_marks = $row['sem_marks'];
        for($i=1;$i <= $no_sem;$i++){
            $btn_name = "file".$i; 
            if(!empty($_FILES[$btn_name]['tmp_name'])){
                $file = $_FILES[$btn_name]['name'];
                $ext = pathinfo($file,PATHINFO_EXTENSION);
                $sup = sup($i);
                $upload_file = $i.$sup."_".$roll.'.'.$ext;
                if(in_array($upload_file,$filelist)){
                unlink("profile/".$upload_file);
                }
            }
        }
        $file_dep  = $row['deploma_file'];
        $marks_dep = $_POST['depaloma'];
        if(!empty($_FILES['depaloma_file']['tmp_name'])){
            $file = $_FILES['depaloma_file']['name'];
            $ext = pathinfo($file,PATHINFO_EXTENSION);
            $file_dep = "dep_".$roll.'.'.$ext;
            $marks_dep = $_POST['depaloma'];
            if(in_array($file_dep,$filelist)){
                unlink("profile/".$file_dep);
            }
            move_uploaded_file($_FILES['depaloma_file']['tmp_name'],"profile/".$file_dep);
        }
        $array_file1 = explode("/",$temp_file);
        for($i=1;$i <= $no_sem;$i++){
            $btn_name = "file".$i;
            if(!empty($_FILES[$btn_name]['tmp_name'])){
                $file = $_FILES[$btn_name]['name'];
                $ext = pathinfo($file,PATHINFO_EXTENSION);
                $sup = sup($i);
                $upload_file = $i.$sup."_".$roll.'.'.$ext;
                $array_file[$i-1] = $upload_file;
                move_uploaded_file($_FILES[$btn_name]['tmp_name'],"profile/".$upload_file);
            }elseif(!empty($array_file1[$i-1])){
                $array_file[$i-1] = $array_file1[$i-1];
            }else{
                $array_file[$i-1] = "";
            }
        }
        $str_file = implode("/",$array_file);
        echo $str_file;
        $array_marks1 =  explode("/",$temp_marks);
        for($i=1;$i <= $no_sem;$i++){
            $field = "sem".$i ;
            if(isset($_POST[$field])){
                $data = $_POST[$field];
                $array_marks[$i-1] = $data;
            }
            elseif(!empty($array_marks1[$i-1])){
                $array_marks[$i-1] = $array_marks1[$i-1];
            }else{
                $array_marks[$i-1] = "";
            }
        }
        $str_marks = implode("/",$array_marks);
        print_r($array_marks);
        $q22 = "UPDATE `signup` SET `deploma_marks`='$marks_dep',`deploma_file`='$file_dep',`sem_marks`='$str_marks',`sem_file`='$str_file', `status` = '$status',`ignored_message` = 'null' WHERE `email` = '$email'";
        $r22 = mysqli_query($conn, $q22);
        echo $q22;
        if($flag == 1 || $r22){
            $_SESSION['message1'] = 'Details Insert Successfully.';
            $_SESSION['message_type1'] = 'success';
            header('location:profile.php');
        }elseif($flag == 0){
            $_SESSION['message1'] = 'Details Not Insert Successfully.';
            $_SESSION['message_type1'] = 'danger';
            header('location:profile.php');
        }else{
            $_SESSION['message1'] = 'Details Not Insert Successfully.';
            $_SESSION['message_type1'] = 'danger';
            header('location:profile.php');
        }

    }
    
}
function sup($i){
    $sup=array("st","nd","rd","th");
    if($i <= 3){
        return $sup[$i-1];
    }else{
        return $sup[3];
    }
}
?>