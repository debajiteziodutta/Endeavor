<?php
include("../../connection/db.php");
include_once("../../includes/ad_header.php");
head("q",0);

if(!isset($_SESSION['email'])){
    echo"<script>window.location.href = '/minorproject/index.php'</script>";
}else{
    $email = $_SESSION['email'];
    $query = "SELECT * FROM `signup` WHERE `email` = '$email' AND `status` = 1";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) == 0){
        echo"<script>window.location.href = '../../additional/home.php'</script>";
    }
    if(isset($_GET['id'])){
        $val = base64_decode($_GET["id"]);
    }
    if($val == "none"){
        $query = "SELECT * FROM `signup`,`dept` WHERE `signup`.`dept` = `dept`.`dept_id` AND `signup`.`ignored_message` = 'null' AND `signup`.`status` IN (2,3)";
        $result= mysqli_query($conn, $query); 
    }else{
        $query = "SELECT * FROM `signup`,`dept` WHERE `signup`.`dept` = `dept`.`dept_id` AND `signup`.`ignored_message` = 'null' AND `signup`.`dept` = '$val' AND `signup`.`status` IN (2,3)";
        $result= mysqli_query($conn, $query); 
    }
    ?>
<br>
<br>
<div class="container">
  <div class ="row">
    <div class ="col-9">
      <h3>Request details for all Students</h3>
    </div>
    <div align="right" class="col">
        <select name = "Search4"  class="form-control" id = "select" onchange = "select()">
        <?php $none = base64_encode('none')?>
                <option 
                <?php 
                if($val == $none){
                echo "selected";
                }
                ?> value = <?php echo $none;?>>ALL</option>
                <?php
                $query1 = "SELECT * FROM `dept` ";
                $result1= mysqli_query($conn, $query1); 
                while ($rows =  mysqli_fetch_array($result1)){
                ?>
                <option  value = "<?php echo base64_encode($rows['dept_id']);?>"
                <?php 
                if($val == $rows['dept_id']){
                echo "selected";
                }
                ?>> <?php echo $rows['dept_name']?></option>
               <?php
              }
              ?>
        </select>
        <script>
        function select(){
          var e = document.getElementById("select");
          var val = e.options[e.selectedIndex].value;
          window.location.href = "show_req.php?id="+val
        }
        </script>
    </div>    
  </div>
</div>
<br>
    <br>
    <?php if (isset($_SESSION['message'])) { ?>
      <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message']?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php 
    unset($_SESSION['message']); 
    unset($_SESSION['message_type']);  
    } ?>
    <br>
    <?php
    while($rows= mysqli_fetch_assoc($result)){
        $no_sem = $rows['no_sem'];
    ?>
        <br>
        <div class="card">
            <div class="card-body">
                <b><?php echo $rows['name']; ?></b><br>
                <?php echo $rows['rollno']; ?><br>
                <?php echo $rows['dept']; ?><br>
                <?php echo $rows['dob']; ?><br>
                <?php echo $rows['gender']; ?><br>
                <?php
                $lenm = null;
                $lenf = null;
                if(!empty($rows['sem_marks'])){
                    $marks = explode("/", $rows['sem_marks']);
                    $lenm = count($marks);
                }
                if(!empty($rows['sem_file'])){
                    $file = explode("/", $rows['sem_file']);
                    $lenf = count($file);
                }
                ?>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                            <tr align = "center">
                                <th scope="col">Class</th>
                                <th scope="col">Marks</th>
                                <th scope="col">Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr align = "center">
                                <th scope="row">10(x)</th>
                                <td> 
                                <?php
                                if(!empty($rows['marks10'])){
                                 echo $rows['marks10']; 
                                }else{
                                    echo "N/A";
                                }
                                ?>
                                <td>
                                <?php
                                if(!empty($rows['file10'])){
                                ?>
                                <a download = "<?php echo $rows['file10'];?>" href = "/minorproject/additional/profile/<?php echo $rows['file10'];?>" class="btn btn-primary"> Download </a><?php echo $rows['file10'];?> 
                                <?php
                                }else{
                                    echo "N/A";
                                }
                                ?>
                                </td>
                            </tr>
                            <tr align = "center">
                                <th scope="row">12(xii)</th>
                                <td> 
                                <?php
                                if(!empty($rows['marks12'])){
                                echo $rows['marks12'];
                                }else{
                                    echo "N/A";
                                }
                                ?>
                                </td>
                                <td>
                                <?php
                                if(!empty($rows['file12'])){
                                ?>
                                <a download = "<?php echo $rows['file12'];?>" href = "/minorproject/additional/profile/<?php echo $rows['file12'];?>" class="btn btn-primary"> Download </a><?php echo $rows['file12'];?>
                                <?php
                                }else{
                                    echo "N/A";
                                }
                                ?>
                                </td>
                            </tr>
                            <tr align = "center">
                                <th scope="row">Deploma</th>
                                <td>
                                <?php
                                if(!empty($rows['deploma_marks'])){
                                echo $rows['deploma_marks']; 
                                }else{
                                    echo "N/A";
                                }
                                ?>
                                </td>
                                <td>
                                <?php
                                if(!empty($rows['deploma_file'])){
                                ?>
                                <a download = "<?php echo $rows['deploma_file'];?>" href = "/minorproject/additional/profile/<?php echo $rows['deploma_file'];?>" class="btn btn-primary"> Download </a><?php echo $rows['deploma_file'];?>
                                <?php
                                }else{
                                    echo "N/A";
                                }
                                ?>
                                </td>
                            </tr>
                            <?php
                            for($i = 1 ;$i<=$no_sem; $i++){
                                $mk = null;
                                $fi = null;
                                if($i <= $lenm){ $mk = $marks[$i-1]; }
                                if($i <= $lenf){ $fi = $file[$i-1]; }
                            ?>
                            <tr align = "center">
                                <th scope="row"><?php echo $i." sem"?></th>
                                <td>
                                <?php
                                if(!empty($mk)){
                                echo $mk;
                                }else{
                                    echo "N/A";
                                }
                                ?>
                                </td>
                                <td>
                                <?php
                                if(!empty($fi)){
                                ?>
                                <a download = "<?php echo $fi;?>" href = "/minorproject/additional/profile/<?php echo $fi;?>" class="btn btn-primary"> Download </a> <?php echo $fi;?>
                                <?php
                                }else{
                                    echo "N/A";
                                }
                                ?>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div align="right">
                    <a role="button" class="btn btn-success" href="decision.php?sid=<?php echo $rows['id']?>" name="selected">Selected</a>
                    <a role="button" class="btn btn-warning" href="decision.php?iid=<?php echo $rows['id']?>" name="selected">Ignored</a>
                    <a role="button" class="btn btn-danger" href="decision.php?rid=<?php echo $rows['id']?>" name="rejected">Rejected</a>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <br>
    <br>
    <br>
    <?php
}
include_once("../../includes/ad_footer.php"); 
?>