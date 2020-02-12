<?php
date_default_timezone_set('Asia/Kolkata');
include('../connection/db.php');
if(!isset($_SESSION['email'])){
  echo"<script>window.location.href = '/minorproject/index.php'</script>";
}else{
$today = date("Y-m-d");
$query = "SELECT * FROM `placement`,`dept` WHERE `placement`.`dept` = `dept`.`dept_id` AND `placement`.`last_apply_date` >= '$today' ORDER BY `placement`.`created_at` DESC ";
$result2 = mysqli_query($conn, $query);
$query = "SELECT * FROM `training`,`dept` WHERE `training`.`department` = `dept`.`dept_id` AND `training`.`last_apply_date` >= '$today' ORDER BY `training`.`created_at` DESC ";
$result1 = mysqli_query($conn, $query);
?>
<link rel="stylesheet" href="../package/css/swiper.min.css">
    
    <!-- Demo styles -->
<style>
      html, body {
        position: relative;
        height: 100%;
      }
      body {
        background: #eee;
        font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
        font-size: 15px;
        color:#000;
        margin: 0;
        padding: 0;
      }
      .swiper-container {
        width: 100%;
        height: 70%;
        background: #000;
      }
      .swiper-slide {
        font-size: 18px;
        color:#000;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        padding: 40px 60px;
      }
      .parallax-bg {
        position: absolute;
        left: 0;
        top: 0;
        width: 130%;
        height: 100%;
        -webkit-background-size: cover;
        background-size: cover;
        background-position: center;
      }
      .swiper-slide .title {
        font-size: 41px;
        font-weight: 300;
      }
      .swiper-slide .subtitle {
        font-size: 21px;
      }
      .swiper-slide .text {
        font-size: 20px;
        max-width: 60%;
        line-height: 1.3;
      }
.quote {
  font-family: Georgia, serif;
  font-size: 14px;
}

.curly-quotes:before, .curly-quotes:after {
  display: inline-block;
  vertical-align: top;
  height: 30px;
  line-height: 48px;
  font-size: 50px;
  opacity: 0.5;
}

.curly-quotes:before {
  content: '\201C';
  margin-right: 4px;
  margin-left: -8px;
  margin-bottom:-10px;
  /*margin-top:-10px;*/
}

.curly-quotes:after {
  content: '\201D';
  margin-left: 4px;
  margin-right: -8px;
  /*margin-top:10px;*/
}

.quote-by {
  display: block;
  padding-right: 10px;
  text-align: right;
  font-size: 13px;
  font-style: italic;
  color: yellow;
}
</style>
<?php include_once("../includes/header.php"); ?>

    <div style='padding:3%'>
    </div>
    
    <h1>HOME</h1>
    <br>
    <h3><i class="fa fa-line-chart" aria-hidden="true" style= 'color: black'></i> Our Placements:</h3>
    <br>
    <br>
    <?php
      $q1 = "SELECT * FROM `heritage` ORDER BY `time_stamp` DESC";
      $r1 = mysqli_query($conn, $q1);
    ?>
      <a href = "/minorproject/additional/heritage.php" style = "text-decoration: none;"> 
      <div class="swiper-container">
          <div class="parallax-bg" style="background-image:url(../images/bg1.jpg)" data-swiper-parallax="-23%"></div>
          <div class="swiper-wrapper">
          <?php
          $i = 1;
          while($row = mysqli_fetch_array($r1)){
          ?>
            <div class="swiper-slide" style = "text-align:center;">
             <br>
              <div class="subtitle" data-swiper-parallax="-200">
              
              <figure class="quote">
              <blockquote class="curly-quotes" >
              <p class="text-break"><font size='5'><?php echo $row['contents'];?></font></p>
              </blockquote>
              </div>
          </div>
          <?php
          $i = $i+1;
          }
          ?>
          </div>
          <!-- Add Pagination -->
          <div class="swiper-pagination swiper-pagination-white"></div>
          <!-- Add Navigation -->
          <div class="swiper-button-prev swiper-button-white"></div>
          <div class="swiper-button-next swiper-button-white"></div>
        </div>
        </a>

        <?php
        if(mysqli_num_rows($result2)>=1){
          ?>
            <div style='padding:8%'>
            </div>
         <div class ="col-8">
              <h3>Activities:</h3>
            </div>
            <br>
            <br>
        <div id = "dd" class="card bg-light mb-3" style="padding:20px">
        <div class="container">
       
          <div class ="row">
            <div class ="col-8">
            <h3><i class="fa fa-graduation-cap" aria-hidden="true" style='color: black'></i> Placement</h3>

            </div>
            <div align = "right"  class="col">
            <?php
            if(mysqli_num_rows($result2)>3){
                echo"<p><a href='placement_details.php' class='btn btn-primary'><b>View All >></b></a></p>";
            }
            ?>
            </div>
          </div>
        </div>
        <div  class = "card-deck">
        <?php
        
         for($i = 0;$i<3;++$i)
        {
            $rows = mysqli_fetch_array($result2);
            if(!empty($rows)){
        echo "<div class='card text-center shadow p-3'>";
                //<img src="..." class="card-img-top" alt="...">
            echo"<div class='card-body'>";
                echo"<h5 class='card-title'><p align = 'left'><b>company name :</b> ".$rows['company_name']."</h5>";
                echo"<p align = 'left'><b>company arriving date :</b>".$rows['arriving_date']."<br>";
                echo"<b>eligibity criteria :</b>".$rows['eligibity_criteria']."<br>";
                echo"<b>only for :</b> ".$rows['dept_name']."<br>";
                echo"</p>";
                ?><a href="placement_show.php?id=<?php echo base64_encode($rows['id']);?>"<?php print"class='btn btn-primary'>Get details</a>";
            echo"</div>";
        echo"</div>";
            }
            else{
                break;
            }
        }
        ?>
    </div>
    </div>
    <?php
    }
    ?>
    <!--Training-->
    <br>
        
        <br>
        <?php
        if(mysqli_num_rows($result1)>=1){
          ?>
        <br>
        <div id = "dd" class="card bg-light mb-3" style="padding:20px">
        <div class="container">
          <div class ="row">
            <div class ="col-8">
              <h3><i class="fa fa-wrench" aria-hidden="true" style='color: black'></i> Training</h3>
            </div>
            <div align = "right" class="col">
            <?php
              if(mysqli_num_rows($result1)>3){
                  echo"<p><a href='training_details.php' class='btn btn-primary'><b>View All >></b></a></p>";
              }
              ?>
            </div>
          </div>
        </div>
        <div  class = "card-deck">
        <?php
        
         for($i = 0;$i<3;++$i)
        {
            $rows = mysqli_fetch_array($result1);
            if(!empty($rows)){
        echo "<div class='card text-center shadow p-3'>";
                //<img src="..." class="card-img-top" alt="...">
            echo"<div class='card-body'>";
                echo"<h5 class='card-title'><p align = 'left'><b>company name :</b> ".$rows['Company_name']."</h5>";
                echo"<p align = 'left'><b>company arriving date :</b>".$rows['Starting_date']."<br>";
                echo"<b>Prerequisites For Training :</b>".$rows['Prerequisites']."<br>";
                echo"<b>only for :</b> ".$rows['dept_name']."<br>";
                echo"</p>";
                ?><a href="training_show.php?id=<?php echo base64_encode($rows['tid']);?>"<?php print"class='btn btn-primary'>Get details</a>";
            echo"</div>";
        echo"</div>";
            }
            else{
                break;
            }

        }
        ?>
    </div>
    </div>
    <?php
    }
    ?>
    <div style='padding:8%'>
    </div>
      <h3><i class="fa fa-comments-o" aria-hidden="true" style= 'color: black'></i> What people are talking about us</h3>
    <br>
<?php
$query = "SELECT * FROM `feedbcak`, `signup` WHERE `signup`.`id` = `feedbcak`.`u_id` ORDER BY `feedbcak`.`date_time` DESC";
$result = mysqli_query($conn, $query);

?>
<a href = "/minorproject/additional/testimonials.php" style = "text-decoration: none;"> 
<div class="swiper-container">
    <div class="parallax-bg" style="background-image:url(../images/yellow-and-and-blue-colored-pencils-1762851.jpg)" data-swiper-parallax="-23%"></div>
    <div class="swiper-wrapper">
    <?php
    $i = 1;
    while($row = mysqli_fetch_array($result)){
    ?>
      <div class="swiper-slide">
        <div class="title" data-swiper-parallax="-300"><?php echo $row['name'];?><font size = "5"><sub><?php echo " ".$row['date_time'];?></sub></font></div>
        <br>
        <br>
        <div class="text" data-swiper-parallax="-100">
        <figure class="quote">
        <blockquote class="curly-quotes">
        <p class="text-break"><font size='4'><?php echo $row['message'];?></font></p>
        </blockquote>
        <figcaption class="quote-by">— <?php echo $row['email'];?></figcaption>
        </figure>
        </div>
    </div>
    <?php
    $i = $i + 1;
    }
    ?>
    </div>
    
    <!-- Add Pagination -->
    <div class="swiper-pagination swiper-pagination-white"></div>
    <!-- Add Navigation -->
    <div class="swiper-button-prev swiper-button-white"></div>
    <div class="swiper-button-next swiper-button-white"></div>
  </div>
  </a>
  <!-- Swiper JS -->
  <script src="../package/js/swiper.min.js"></script>

  <!-- Initialize Swiper -->
        <br>
  <?php
}
?>     
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js" integrity="sha256-lPE3wjN2a7ABWHbGz7+MKBJaykyzqCbU96BJWjio86U=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TimelineMax.min.js" integrity="sha256-fIkQKQryItPqpaWZbtwG25Jp2p5ujqo/NwJrfqAB+Qk=" crossorigin="anonymous"></script>
 <script>
     var swiper = new Swiper('.swiper-container', {
      slidesPerView: 1,
      loop: true,
      speed: 1500,
      parallax: true,
      spaceBetween: 30,
      centeredSlides: false,
      autoplay: {
        delay: 5000,
        disableOnInteraction: true,
      },
      pagination: {
        el: '.swiper-pagination',
        dynamicBullets: true,
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  </script>
    <div style='padding:5%'>
    </div>
<?php include_once("../includes/footer.php") ?>
