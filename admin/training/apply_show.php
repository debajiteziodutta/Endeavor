<?php 
include('../../connection/db.php');
include_once("../../includes/ad_header.php");
head("T",3);
if(!isset($_SESSION['email'])){
    echo"<script>window.location.href = '/minorproject/index.php'</script>";
}else{
      $email = $_SESSION['email'];
      $query = "SELECT * FROM `signup` WHERE `email` = '$email' AND `status` = 1";
      $result = mysqli_query($conn, $query);
      if(mysqli_num_rows($result) == 0){
      echo"<script>window.location.href = '../../additional/home.php'</script>";
      }
$query = "SELECT `rollno`,`name`, `dept`.`dept_name` AS 'std_dept',`Company_name`,`training_topic`,`email`,`details_of_company` FROM `apply_training`,`signup`,`training`,`dept` WHERE `signup`.`dept` = `dept`.`dept_id` AND `apply_training`.`std_id` = `signup`.`id` AND `apply_training`.`tr_id` = `training`.`tid`";
$result = mysqli_query($conn, $query);
?>
<br>
<br>
<h3> Applied Candidates </h3>
<br>
<?php 
if(mysqli_num_rows($result)>=1){
?>
    <div align = "right">
        <a class="btn btn-info" href="exal.php" role="button">Download exel file <i class="fa fa-download" aria-hidden="true"></i></a>
    </div>
<?php
}
else{
    ?>
    <div align = "right">
        <button type="button" class="btn btn-info" disabled>Download exel file <i class="fa fa-download" aria-hidden="true"></i></button>
    </div>
<?php
}
?>
<br>
<div class="table-responsive-md">
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Roll No</th>
            <th scope="col">Name</th>
            <th scope="col">Department</th>
            <th scope="col">Company name</th>
            <th scope="col">Training topic</th>
            <th scope="col">email</th>
            <th scope="col">Company_contact</th>
            </tr>
        </thead>
        <?php
        while($rows = mysqli_fetch_array($result)){
        ?>
            <tbody>
                <tr>
                <td scope="row"><?php echo $rows['rollno']?></th>
                <td><?php echo $rows['name']?></td>
                <td><?php echo $rows['std_dept']?></td>
                <td><?php echo $rows['Company_name']?></td>
                <td><?php echo $rows['training_topic']?></td>
                <td><?php echo $rows['email']?></td>
                <td><?php echo $rows['details_of_company']?></td>
               
                </tr>
            </tbody>
        <?php
        }
        ?>
    </table>
</div>
<?php
include_once("../../includes/ad_footer.php"); 
}
?>