<?php
date_default_timezone_set('Asia/Kolkata');
$today = date("y-m-d");
include('../../connection/db.php');
if(!isset($_SESSION['email'])){
    header("Location: ../../additional/signup.php");
}else{
      $email = $_SESSION['email'];
      $query = "SELECT * FROM `signup` WHERE `email` = '$email' AND `status` = 1";
      $result = mysqli_query($conn, $query);
      if(mysqli_num_rows($result) == 0){
      header("Location: ../../additional/home.php");
      }
$delimiter = ",";
$filename = "Training_Apply_List".$today.".csv";
$query1 = "SELECT `rollno`,`name`, `dept`.`dept_name` AS 'std_dept',`Company_name`,`training_topic`,`email`,`details_of_company` FROM `apply_training`,`signup`,`training`,`dept` WHERE `signup`.`dept` = `dept`.`dept_id` AND `apply_training`.`std_id` = `signup`.`id` AND `apply_training`.`tr_id` = `training`.`tid`";
$result1= mysqli_query($conn, $query1); 
$f = fopen('php://memory','w');
$fields = array('Roll No','Name','Department','Company_name','Training topic','email','Company_contact');
fputcsv($f,$fields,$delimiter);
while($row =  mysqli_fetch_array($result1)){
    $linedata = array($row['rollno'],$row['name'],$row['std_dept'],$row['Company_name'],$row['training_topic'],$row['email'],$row['details_of_company']);
    fputcsv($f,$linedata,$delimiter);
}
fseek($f,0);
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="'.$filename.'";');
fpassthru($f);
}
?>
