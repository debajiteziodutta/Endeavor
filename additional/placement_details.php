<?php
date_default_timezone_set('Asia/Kolkata');
include('../connection/db.php');
if(!isset($_SESSION['email'])){
    echo"<script>window.location.href = '/minorproject/index.php'</script>";
}else{
$today = date("y-m-d");
$query = "SELECT * FROM `placement`,`dept` WHERE `placement`.`dept` = `dept`.`dept_id` AND `placement`.`last_apply_date`>= '$today' ORDER BY `placement`.`created_at` DESC ";
$result = mysqli_query($conn, $query);
include_once("../includes/header.php"); ?>
<br>
<br>
<h2><i class="fa fa-graduation-cap" aria-hidden="true" style='color: black'></i> Placements:</h2>
<br>
<br>
<?php
while( $rows = mysqli_fetch_array($result))
    {
    ?>
    <div class="card">
        <div class="card-header">
        <?php
            echo"<h5 class='card-title'><p align = 'left'><b>company name :</b> ".$rows['company_name']."</h5>";
        ?>
        </div>
        <div class="card-body">
        <blockquote class="blockquote mb-0">
        <?php
            echo"<p align = 'left'><b>Date of Drive: &nbsp;</b>".$rows['arriving_date']."<br>";
            echo"<b>Eligibity Criteria: &nbsp;</b>".$rows['eligibity_criteria']."<br>";
            echo"<b>only for: &nbsp;</b> ".$rows['dept_name']."<br>"; 
            echo"<b>For the: &nbsp;</b> ".$rows['sem'].sup($rows['sem'])." Semester<br>"; 
            echo"</p>";
        ?><a href="placement_show.php?id=<?php echo base64_encode($rows['id']);?>"<?php print"class='btn btn-primary'>Get details</a>";
        ?>

        </blockquote>
        </div>
        </div>
        <br>
    <?php
       }
       ?>
    <?php
    $query = "SELECT * FROM `placement`,`dept` WHERE `placement`.`dept` = `dept`.`dept_id` AND `placement`.`last_apply_date`< '$today' ORDER BY `placement`.`created_at` DESC ";
    
    $result = mysqli_query($conn, $query);
    while( $rows = mysqli_fetch_array($result))
    {
    ?>
    <div class="card border-danger">
        <div class="card-header">
            <?php
                echo"<h5 class='card-title'><p align = 'left'><b>company name :</b> ".$rows['company_name']."</h5>";
            ?>
        </div>
        <div class="card-body text-danger">
            <blockquote class="blockquote mb-0">
        <?php
            echo"<p align = 'left'><b>Date of Drive: &nbsp;</b>".$rows['arriving_date']."<br>";
            echo"<b>Eligibity Criteria: &nbsp;</b>".$rows['eligibity_criteria']."<br>";
            echo"<b>only for: &nbsp;</b> ".$rows['dept_name']."<br>"; 
            echo"<b>For the: &nbsp;</b> ".$rows['sem'].sup($rows['sem'])." Semester<br>"; 
            echo"</p>";
        ?>
            </blockquote>
        </div>
        </div>
        <br>
    <?php
       }
       ?>
    
<?php include_once("../includes/footer.php");
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