<?php
include("../../connection/db.php");
include_once("../../includes/ad_header.php");
head("p",2);
$flag = false;
if(!isset($_SESSION['email'])){
    echo"<script>window.location.href = '/minorproject/index.php'</script>";
}else{
    $email = $_SESSION['email'];
$query = "SELECT * FROM `signup` WHERE `email` = '$email' AND `status` = 1";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) == 0){
echo"<script>window.location.href = ' ../../additional/home.php'</script>";
}
if(isset($_GET['id']))
    {
        $id = $_GET['id'];
            //print "$id";
        $query= "SELECT * from placement WHERE id = $id";
        $result= mysqli_query($conn, $query);
        $rows= mysqli_fetch_assoc($result); 
        
        $department=$rows['dept'];
        $sem = $rows['sem'];
        $company= $rows["company_name"];
        $arriving_date = $rows['arriving_date'];
        $applydate = $rows['last_apply_date'];
        $eligibity_criteria = $rows['eligibity_criteria'];
        $vacancy =$rows['vacancy'];
        $jobrole = $rows['job_role'];
        $pdf = $rows['pdf_name'];
        $contact = $rows['contact_details'];
        $backlog = $rows['active_backlog'];
        $notes = $rows['notes'];
        $round = explode("/", $rows['Round_name']);
        $duration = explode("/", $rows['Round_duration']);
        $str_round =  $rows['Round_name'];
        $str_duration =  $rows['Round_duration'];
        $link =  $rows['link'];
        $len = 0;
        $len = count($round);
    }
if(isset($_POST['update']))
    {  $flag = 0;
        $filelist = array();
        if ($handle = opendir("pdf")) {
            while ($entry = readdir($handle)) {
                $filelist[] = $entry;
                }
            closedir($handle);
        }

        $pdf1 = $_FILES['file']['name'];
        if(!empty($pdf1)){
            if(!in_array($pdf1,$filelist)){
            unlink("pdf/$pdf");
            move_uploaded_file($_FILES['file']['tmp_name'],"pdf/".$_FILES['file']['name']);
            $pdf = $pdf1;
            $flag = 1;
            }else{
                $flag = 0;
            }
            }
        if(empty($pdf1) || $flag != 0 || $flag == 1){
        $dept = $_POST['department'];
        $company_name = $_POST['company_name'];
        $arriving_date = $_POST['arriving_date'];
        $applydate = $_POST['last_apply_date'];
        $eligibity_criteria = $_POST['eligibity_criteria'];
        $vacancy = $_POST['vacancy'];
        $jobrole = $_POST['jobrole'];
        $contact = $_POST['contact'];
        $backlog = $_POST['backlog'];
        $notes = $_POST['notes'];
        $link = $_POST['link'];
        $sem = $_POST['sem1'];
        $roundn = 0;
        $roundn = $_POST['round'];
        if($roundn != 0){
            for($j=1;$j<=$roundn;++$j){
                $round[$roundn][$j] = $_POST['Round'.$roundn.$j];
                $duration[$roundn][$j] = $_POST['duration'.$roundn.$j];
            }
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
        }
        print_r($dept);
        $query ="UPDATE `placement` SET  `dept` = '$dept', `sem` = '$sem', `company_name` = '$company_name', `arriving_date` = '$arriving_date',`last_apply_date` = '$applydate', `eligibity_criteria` = '$eligibity_criteria', `vacancy` = '$vacancy', `job_role` = '$jobrole', `pdf_name` = '$pdf',`contact_details` = '$contact' ,`active_backlog` = '$backlog' , `Round_name` = '$str_round', `Round_duration` = '$str_duration' , `notes` = '$notes',`link` = '$link' WHERE `id` = $id";
        $result = mysqli_query($conn, $query);
        if($result)
            {
                        //print "successfully updated";
                $_SESSION['message_head'] = 'Great!';
                $_SESSION['message'] = 'Details Updated Successfully.';
                $_SESSION['message_type'] = 'success';
                //header("location: placement_display.php?id=none&toggle=0");
                echo"<script>window.location.href = 'placement_display.php?id=".base64_encode('none')."&toggle=0'</script>";
            }
        else
            {
                        //print "problem uploading file";
                echo $query;
                $_SESSION['message_head'] = 'Ohh no!';
                $_SESSION['message'] = 'Update process failed! Try again.';
                $_SESSION['message_type'] = 'danger';
                echo"<script>window.location.href = 'placement_display.php?id=".base64_encode('none')."&toggle=0'</script>";
                //header("location: placement_display.php?id=none&toggle=0");
            }

        }else{
            $_SESSION['message_head'] = 'Ohh no!';
            $_SESSION['message'] = 'Insert another file or rename it ...';
            $_SESSION['message_type'] = 'danger';
            echo"<script>window.location.href = 'placement_display.php?id=".base64_encode('none')."&toggle=0'</script>";
            //header("location: placement_display.php?id=none&toggle=0");
            }
    }
    
?>
<br>
<br>
<h3>Edit Here</h3>
<br>
<div class="card">
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
            <label for="exampleFormControlSelect1">Select Department</label>
            <select class="form-control" id="selectdepartment" name="department">
              <?php
               $query1 = "SELECT * FROM `dept` ";
               $result1= mysqli_query($conn, $query1); 
               while ($row =  mysqli_fetch_array($result1)){
              ?>
              <option value="<?php echo $row['dept_id']?>"
              <?php
                if($department == $row['dept_id']){
                  echo "selected";
                }
              ?>
              ><?php echo $row['dept_name']?></option>
              <?php
               }
              ?>
            </select>
            </div>

            <div class="items">
                <label for="selectdepartment">Select Semester</label>
                <select class="form-control" id="selectdepartment" name="sem1">
                <?php
                $query2 = "SELECT * FROM `dept` WHERE `dept_id` = $department";
                $result2= mysqli_query($conn, $query2); 
                $row1 =  mysqli_fetch_array($result2);
                for($k = 1; $k<= $row1['no_sem']; $k++){
                ?>
                    <option value = <?php echo $k?>
                    <?php
                    if($sem == $k){
                        echo "selected";
                        }
                    ?>> <?php echo $k.sup($k)." Semister";?> </option>
                <?php
                }
                ?>
                </select>
            </div>
            <br>

            <div class="form-group">
                <label for="exampleInputEmail1">Company Name</label>
                <input type="text" name = "company_name"  value="<?php echo $company; ?>" class="form-control" id="companyname1" aria-describedby="companyname" placeholder="company name" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Last date of application</label>
                <input type="date" name = "last_apply_date"  value="<?php echo $applydate; ?>" class="form-control" id="traningtopic1" aria-describedby="companyname" placeholder="date" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">company arriving date</label>
                <input type="date" name = "arriving_date"  value="<?php echo $arriving_date; ?>" class="form-control" id="traningtopic1" aria-describedby="companyname" placeholder="date" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">eligibity criteria</label>
                <input type="text" name = "eligibity_criteria" value="<?php echo $eligibity_criteria;?>" class="form-control" id="prerequisites" aria-describedby="companyname" placeholder="eligibity criteria for placement"required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">vacancy</label>
                <input type="text" name = "vacancy" value="<?php echo $vacancy; ?>" class="form-control" id="prerequisites" aria-describedby="companyname" placeholder="no. of vacancy">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">job role </label>
                <input type="text" name = "jobrole" value="<?php echo $jobrole; ?>" class="form-control" id="prerequisites" aria-describedby="companyname" placeholder="job role ">
            </div>
            <div class="form-group">
                Current PDF <b><?php echo $pdf ; ?><label for="exampleInputEmail1"> </b> If you want to new Placement details (pdf upload here)</label>
                <input type="file" name="file" accept = "appllication/pdf">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Contact details of Company</label>
                <input type="text" name = "contact" value="<?php echo $contact; ?>" class="form-control" id="companycontact" aria-describedby="companyname" placeholder="contact delaits" required>
            </div>
            <?php
            if($backlog == "Yes"){
            ?>
            <div class="custom-control custom-radio custom-control-inline">
                <input class="custom-control-input" type="radio" name="backlog" id="inlineRadio1" value="Yes" checked required>
                <label class="custom-control-label" for="inlineRadio1">active backlog preferable  </label>
            </div>

            <div class="custom-control custom-radio custom-control-inline">
                <input class="custom-control-input" type="radio" name="backlog" id="inlineRadio2" value="No" required>
                <label class="custom-control-label" for="inlineRadio2">If active backlog not preferable  </label>
            </div>
            <?php
                }
                else
                {
            ?>
            <div class="custom-control custom-radio custom-control-inline">
                <input class="custom-control-input" type="radio" name="backlog" id="inlineRadio1" value="Yes" required>
                <label class="custom-control-label" for="inlineRadio1">active backlog preferable  </label>
            </div>
      
            <div class="custom-control custom-radio custom-control-inline">
                <input class="custom-control-input" type="radio" name="backlog" id="inlineRadio2" value="No" checked required>
                <label class="custom-control-label" for="inlineRadio2">If active backlog not preferable  </label>
            </div>
            <?php
                }
             ?>
             <div class="form-group">
                <label for="exampleFormControlTextarea1">Notes (if any)</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"name="notes" placeholder="notes"><?php echo $notes; ?></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Copy and paste the application like here:</label>
                <input type="text" name = "link" class="form-control"  value="<?php echo $link; ?>" id="prerequisites" aria-describedby="companyname" placeholder="Enter the Link Here">
                
            </div>
            <?php
            if($round[0] != NULL)
            {
            ?>
            Previous round's</br>
            <table class="table table-borderless table-sm">
            <thead>
                <tr>
                <th scope="col"></th> 
                <th scope="col">Rounds</th>
                <th scope="col">Duration</th>
                </tr>
                </thead>
                <?php
                for($i=0;$i<$len;$i++){
                echo"<tbody>";
                    echo"<tr>";
                    ?>
                    <th scope='row'><?php echo $i+1 ?></th>
                    <?php
                    echo"<td> $round[$i] </td>";
                    echo"<td> $duration[$i] </td>";
                    echo"</tr>";
                echo"</tbody>";
                }?>
            </table>
            <?php
            }else{
                ?>
               No information about rounds...</br>
                <?php
            }
            ?>
            If you want to new round's
            </br>
            
            <div class="form-group">
                <label for="exampleFormControlSelect1">number of round </label>
                <select class="form-control" id="optionselector" name = "round">
                <option>__SELECT__</option>
                <?php
                for($i =1;$i<=4;$i++){
                    echo"<option value = '".$i."'>".$i."</option>";
                }
                ?>
                </select>
            </div>
            <!--prob-->    
            <?php
            for($i = 1;$i<=4;$i++){
                $k = 1;
            ?>
            <div class="items" id="<?php echo $i?>" style="display:none">
            <?php
            for($j = 1;$j<=$i;$j++){
            ?>
                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo "Round ".$k." name";?></label>
                <input type="text" name = "<?php echo "Round".$i."".$j;?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter round name">
                </div>
                <div class="form-group">
                <label for="exampleInputEmail2"><?php echo "Round ".$k." duration";?></label>
                <input type="text" name = "<?php echo "duration".$i."".$j;?>" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" placeholder="Enter round duration">
                </div>
                <?php
                $k = $k+1;
                }
            ?>
            </div>
            <?php
            }
            ?>

            </br>
            <div align="right">
                <a role="button" class="btn btn-primary" href="placement_display.php?id=<?php echo base64_encode('none');?>&toggle=0" name="back">Go Back</a>
                <button type="reset" class="btn btn-secondary" name="reset">Reset</button>
                <button type="submit" class="btn btn-success" name="update">Update</button>
            </div>
        </form>
    </div>
</div>
<br>
<br>
<br>
<br>
<?php
include_once("../../includes/ad_footer.php");
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
<script>
  $(function() {
  $('#optionselector').change(function(){
      $('.items').hide();
      $('#' + $(this).val()).show();
  });

});
$(function(){
  var rcbx = $('.options :checkbox[required]');
  rcbx.change(function(){
    if(rcbx.is(':checked')) {
      rcbx.removeAttr('required');
    }else{
      rcbx.attr('required' , 'required');
    }
  });
});
</script>