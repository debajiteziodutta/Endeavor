<?php
include('../connection/db.php');
if(isset($_POST['signin'])){
    $sataus = 0;
    $email = $_POST['email'];
    $pass = md5($_POST['pass']);
    
    $query = "SELECT * FROM `signup` WHERE `email`= '$email' AND `password` = '$pass' AND `status` <> 4";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
   
    if(isset($row['status'])){
        $sataus = $row['status'];
    }
    if($sataus == 1){
        if($pass == $row['password'] && $email == $row['email']){
            $_SESSION['email'] = $row['email'];
            header('location:../admin/dashboard/blank.php'); 
        }else{
            $_SESSION['message'] = 'email or username Not match';
            $_SESSION['message_type'] = 'danger';
            header('Location: signin.php');
        }
    }else{
    if(isset($row['rollno'])){
        $roll = $row['rollno'];
        $pass = $row['password'];
        $email = $row['email'];
    }
    $std = makautStdDatails ($roll);
    $dept = $std['dept'];
    echo $dept;
    $std_sem  = sem($std['year']);
    echo $std_sem;
    $query ="SELECT * FROM dept WHERE dept_no ='$dept'";
    $result = mysqli_query($conn, $query);
    $row1 = mysqli_fetch_array($result);
    $no_sem = $row1['no_sem'];
    if($dept == $row1['dept_no']){
        if($pass == $pass && $email == $email){
            if($std_sem != null && $std_sem <= $no_sem){
                if($row['status'] == 0 || $row['status'] == 2 || $row['status'] == 3){
                    $_SESSION['email'] = $email;
                        header('location:home.php'); 
                }else{
                    $_SESSION['message'] = 'Somthing Wrong ';
                    $_SESSION['message_type'] = 'danger';
                    header('Location: signin.php');
                }
            }else{
                $_SESSION['message'] = 'Invalid UserName';
                $_SESSION['message_type'] = 'danger';
                header('Location: signin.php');
            }
        }else{
            $_SESSION['message'] = 'email or username Not match ';
            $_SESSION['message_type'] = 'danger';
            header('Location: signin.php');
        }
    }else{
        $_SESSION['message'] = 'Department not Match';
        $_SESSION['message_type'] = 'danger';
        header('Location: signin.php');
    }
    print $_SESSION['message'];
}
}else{
    header("Location: signup.php");
}
function sem($year){
    $sem = null;
    $year = date("y")-$year;
    $month = date("m")-6;
    if($year == 0){
        $sem = 1;
    }
    elseif($year == 1){
        if($month<= 0 && $month>=-5){
            $sem = 2;
        }elseif($month>=1 && $month<=6){
            $sem = 3; 
        }
    }
    elseif($year == 2){
        if($month<= 0 && $month>=-5){
            $sem = 4; 
        }elseif($month>=1 && $month<=6){
            $sem = 5; 
        }
    }
    elseif($year == 3){
        if($month<= 0 && $month>=-5){
            $sem = 6; 
        }elseif($month>=1 && $month<=6){
            $sem = 7; 
        }
    }
    elseif($year == 4){
        if($month<= 0 && $month>=-5){
            $sem = 8; 
        }elseif($month>=1 && $month<=6){
            $sem = 9; 
        }
    }elseif($year == 5){
        if($month<= 0 && $month>=-5){
            $sem = 10; 
        }elseif($month>=1 && $month<=6){
            $sem = 11; 
        }
    }
   
   return $sem;
}
function makautStdDatails ($roll){
    $clg = substr($roll,0,3);
    $dept = substr($roll,3,3);
    $year = substr($roll,6,2);
    $sn = substr($roll,8,3);
    $student = array("clg" =>$clg,"dept" =>$dept,"year" =>$year,"no" =>$sn);
    return $student;
  }
?>