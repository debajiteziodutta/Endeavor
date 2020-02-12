<?php
date_default_timezone_set('Asia/Kolkata');
include('../connection/db.php');
if(!isset($_SESSION['email'])){
    echo"<script>window.location.href = '/minorproject/index.php'</script>";
}else{
$email = $_SESSION['email'];
$query = "SELECT * FROM `signup`,`dept` WHERE `signup`.`email` = '$email' AND `signup`.`dept` = `dept`.`dept_id` AND `signup`.`status` <> 4";
$result = mysqli_query($conn, $query);
$row1 = mysqli_fetch_array($result);
$roll = $row1['rollno'];
$name = $row1['name'];
$no_sem = $row1['no_sem'];
if($row1['status'] == 0){
    if($row1['ignored_message'] != "null"){
        $message = $row1['ignored_message'];
        $type = 'warning';
    }
    $icon = "<i class='fa fa-check-circle' style='color:green;font-size:50px' aria-hidden='true'></i>";
    $icon_sub = "<small><b>Your Already Account verified by Admin</b></small>";
    $option = "disabled";
}elseif($row1['status'] == 2 ){
    if($row1['ignored_message'] != "null"){
        $message = $row1['ignored_message'];
        $type = 'warning';
    }
    $icon = "<i class='fa fa-exclamation-triangle' style='color:orange;font-size:50px' aria-hidden='true'></i>";
    $icon_sub = "<small><b>Account will be valid only after verified by Admin</b></small>";
    $option = "enabled";
}elseif($row1['status'] == 3){
    if($row1['ignored_message'] != "null"){
        $message = $row1['ignored_message'];
        $type = 'warning';
    }
    $icon = "<i class='fa fa-exclamation-triangle' style='color:orange;font-size:50px' aria-hidden='true'></i>";
    $icon_sub = "<small><b>Account will be valid only after verified by Admin</b></small>";
    $option = "disabled";
}
?>
<link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<?php include_once('../includes/header.php'); ?>
<br>
<br>
<h3><?php echo $icon; ?>&nbsp;&nbsp;&nbsp;<?php echo $name ?></h3>
<?php echo $icon_sub; ?>
<br>
<br>
<?php
if(isset($message)){
?>
<div class="alert alert-<?= $type?> alert-dismissible fade show" role="alert">
<?= $message?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php
}
?>
<br>
<?php 
    if (isset($_SESSION['message1'])) { ?>
        <div class="alert alert-<?= $_SESSION['message_type1']?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message1']?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
    }
    unset($_SESSION['message1']); 
    unset($_SESSION['message_type1']); 
    ?>
<br>
<div id = "mm">
</div>
<form action = "add_profile.php" method = "POST" enctype="multipart/form-data">
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="inputbirth">Date of Birth:</label>
            <input type="date" class="form-control" id="inputbirth"  value="<?php echo $row1['dob']; ?>" aria-describedby="emailHelp" placeholder="" name = "d_o_b" <?php echo $option;?> required >
        </div>
        <?php
        if(!empty($row1['dobfile'])){?>
            <div class="form-group col-md-4">
            <label for="fileToUpload">Chose D-O-B File here:</label>
            <input type="file" id = "file" name = "dob_file"<?php echo $option; ?>> <?php echo $row1['dobfile']; ?>
            <small id="emailHelp" class="form-text text-muted">Clear scan of Hard Document is Mandetory.</small>
            </div>
        <?php
        }
        else{
        ?>
            <div class="form-group col-md-4">
            <label for="fileToUpload">Chose D-O-B File here:</label>
            <input type="file" id = "file" name = "dob_file"<?php echo $option; ?> required> <?php echo $row1['dobfile']; ?>
            <small id="emailHelp" class="form-text text-muted">Clear scan of Hard Document is Mandetory.</small>
            </div>
        <?php
        }
        ?>
        <div class="form-group col-md-4">
            <label for="inputState">Select Gender</label>
            <select id="inputState" class="form-control" name = "gen" <?php echo $option; ?> required>
                <option value = "">Choose...</option>
                <option value = "Mail" <?php if($row1['gender'] == "Mail"){echo "selected";}?>>Male</option>
                <option value = "Female" <?php if($row1['gender'] == "Female"){echo "selected";}?>>Female</option>
                <option value = "Others" <?php if($row1['gender'] == "Others"){echo "selected";}?>>Others</option>
            </select>
        </div>
    </div>
    <br>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="exampleInputEmail1">10<sup>th</sup> Marks:</label>
            <input type="text" class="form-control" value= "<?php echo $row1['marks10'];?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter % of marks" name = "10th" <?php echo $option; ?> required>
        </div>
        <?php
        if(!empty($row1['file10'])){?>
        <div class="form-group col-md-6">
            <label for="fileToUpload">Chose 10<sup>th</sup> Marks File here:</label></br>
            <input type="file" name = "10th_file" <?php echo $option; ?>><?php echo $row1['file10']; ?>
            <small id="emailHelp" class="form-text text-muted">Clear scan of Hard Document is Mandetory.</small>
        </div>
        <?php
        }
        else{
        ?>
         <div class="form-group col-md-6">
            <label for="fileToUpload">Chose 10<sup>th</sup> Marks File here:</label></br>
            <input type="file" name = "10th_file" <?php echo $option; ?> required><?php echo $row1['file10']; ?>
            <small id="emailHelp" class="form-text text-muted">Clear scan of Hard Document is Mandetory.</small>
        </div>
        <?php
        }
        ?>
    </div>
    <br>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="exampleInputEmail1">12<sup>th</sup> Marks:</label>
            <input type="text" class="form-control" value= "<?php echo $row1['marks12'];?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter % of marks" name = "12th" <?php echo $option; ?> required>
        </div>
        <?php
        if(!empty($row1['file12'])){?>
        <div class="form-group col-md-6">
            <label for="fileToUpload">Chose 12<sup>th</sup>Marks File here:</label><br>
            <input type="file" name = "12th_file" <?php echo $option; ?>><?php echo $row1['file12']; ?>
            <small id="emailHelp" class="form-text text-muted">Clear scan of Hard Document is Mandetory.</small>
        </div>
        <?php
        }
        else{
        ?>
        <div class="form-group col-md-6">
            <label for="fileToUpload">Chose 12<sup>th</sup>Marks File here:</label><br>
            <input type="file" name = "12th_file" <?php echo $option; ?> required><?php echo $row1['file12']; ?>
            <small id="emailHelp" class="form-text text-muted">Clear scan of Hard Document is Mandetory.</small>
        </div>
        <?php
        }
        ?>
    </div>
    <br>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="exampleInputEmail1">Deploma Marks:</label>
            <input type="text" class="form-control" value= "<?php echo $row1['deploma_marks'];?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter % of marks" name = "depaloma">
        </div>
        <div class="form-group col-md-6">
            <label for="fileToUpload">Select Deploma Marks File here:</label><br>
            <input type="file" name = "depaloma_file"><?php echo $row1['deploma_file']; ?>
            <small id="emailHelp" class="form-text text-muted">Clear scan of Hard Document is Mandetory.</small>
        </div>
    </div>
    <br>
    <?php
    $lenm = null;
    $lenf = null;
    if(!empty($row1['sem_marks'])){
        $marks = explode("/", $row1['sem_marks']);
        $lenm = count($marks);
    }
    if(!empty($row1['sem_file'])){
        $file = explode("/", $row1['sem_file']);
        $lenf = count($file);
    }
    for($i = 1 ;$i<=$no_sem; $i++){
    $sup = sup($i);
    $mk = null;
    $fi = null;
    if($i <= $lenm){ $mk = $marks[$i-1]; }
    if($i <= $lenf){ $fi = $file[$i-1]; }
    ?>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="exampleInputEmail1"><?php echo $i; ?><sup><?php echo $sup; ?></sup> Semester SGPA:</label>
            <input type="text" class="form-control" value= "<?php echo $mk;?>" id="exampleInputEmail" aria-describedby="emailHelp" name = "sem<?php echo $i; ?>" placeholder="Enter % of marks">
            <small id="emailHelp" class="form-text text-muted">Don't enter <b>%</b> sign.</small>
        </div>
        <div class="form-group col-md-6">
            <label for="fileToUpload">Select <?php echo $i; ?><sup><?php echo $sup; ?></sup> Semester Marks File here:</label><br>
            <input type ="file" name = "file<?php echo $i; ?>"><?php echo $fi; ?>
            <small id="emailHelp" class="form-text text-muted">Clear scan of Hard Document is Mandetory.</small>
        </div>
    </div>
    <br>
    <?php
    }
    ?>
    <br>
    <div align="right">
        <button type="submit" class="btn btn-primary" name = "add_profile" onclick = "required()">Update </button>
        <br>
    <small>10<sup>th</sup> and 12<sup>th</sup> marks cannot be altered once profile is verfied by Admin. For any other assisstence in editorial purpose, contact Admin.</small>
    </div>
</form>
<script type="text/javascript">
    function required(){
        var file_value = "<?php echo $file_value?>;" 
        document.getElementById('mm').innerHTML = file_value
        if(document.getElementById('').value.length && file_value == "mm"){
            document.getElementById('').required = true;
        }else{
            document.getElementById('').required = false;
        }
    }
</script>
<?php
include_once('../includes/footer.php');
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

