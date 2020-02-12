<?php
date_default_timezone_set('Asia/Kolkata');
include('../connection/db.php');

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $password1 = md5($_POST['confirm-password']);
    $q="SELECT * FROM `signup` WHERE `signup`.`email`='$email' OR `signup`.`rollno`= '$username'";
    $re = mysqli_query($conn, $q);
    $rows = mysqli_num_rows($re);
    if($rows==0){
        if(!chk_pass($password,$password1)){
            $_SESSION['message'] = 'Password not match';
            $_SESSION['message_type'] = 'danger';
            header('Location: signup.php');
        }
        else{
            if(empty($middlename)){
                $name = $firstname." ".$lastname;
            }else{
                $name = $firstname." ".$middlename." ".$lastname;
            }
        
            $std = makautStdDatails($username);
        
            $dept = $std['dept'];
            $clg = $std['clg'];
            $dept_id = " ";
            $query ="SELECT * FROM dept WHERE dept_no ='$dept'";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_array($result)){
                if($dept == $row['dept_no']){
                    $no_sem = $row['no_sem'];
                    $dept_id = $row['dept_id'];
                    break;
                }
            } 
            print $dept;
            if($dept_id != " " && $clg == "334" ){
                $std_sem  = sem($std['year']);
                echo $std_sem;
                if($std_sem != null && $std_sem <= $no_sem){
                    $query = "INSERT INTO `signup`(`rollno`, `name`, `dept`, `email`, `password`) VALUES ('$username','$name','$dept_id','$email','$password')";
                    if(mysqli_query($conn, $query)){
                        $_SESSION['email'] = $email;
                        header('location:profile.php'); 
                    }else{
                        $_SESSION['message'] = 'Not createted';
                        $_SESSION['message_type'] = 'danger';
                        header('Location: signup.php');
                    }
                }else{
                    $_SESSION['message'] = 'Not allow to create an account';
                    $_SESSION['message_type'] = 'danger';
                    header('Location: signup.php');
                }
            }
            else{
                $_SESSION['message'] = 'Plese check user name ';
                $_SESSION['message_type'] = 'danger';
                header('Location: signup.php');
            }
        }
    }else{
        $_SESSION['message'] = 'already used this email or username';
        $_SESSION['message_type'] = 'danger';
        header('Location: signup.php');
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
function chk_pass($pass1,$pass2){
    if($pass1==$pass2){
        return true;
    }else{
        return false;
    }
}
?>