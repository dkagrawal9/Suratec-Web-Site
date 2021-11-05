<?php 
  require_once '../admin/library/connect.php';
  require_once '../admin/library/functions.php';
  checkMemUser($objConnect);
?>
<?php include 'header.php' ?>
<link rel="stylesheet" media="all" type="text/css" href="jquerydatepicker/jquery-ui.css" />
<link rel="stylesheet" media="all" type="text/css" href="jquerydatepicker/jquery-ui-timepicker-addon.css" />
<?php
	$date_start =  date("Y-m-d");
?>
<?php

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

//$id = $_SESSION['id_customer'];
$id_customer = $_SESSION['id_customer'];

$sqlpro = "SELECT   *,mod_customer.telephone AS telephone ,mod_customer.id_customer AS id_customer, mod_customer.fname AS fname, mod_customer.lname AS lname FROM  mod_customer 
LEFT JOIN tbl_member ON mod_customer.id_customer = tbl_member.id_data_role
LEFT JOIN  mod_customer_address ON mod_customer_address.id_customer = mod_customer.id_customer
WHERE  mod_customer.id_customer = '$id_customer' ";

 //echo $sqlpro;

$queryPro = mysqli_query($objConnect, $sqlpro);
$resultPro = mysqli_fetch_array($queryPro);




?>
<?php include_once 'common.php'; ?>



	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="../admin/plugins/sweetalert2/dist/sweetalert2.min.css">
	    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="../admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="table.css">
  <link rel="stylesheet" href="./js/range-slider.min.css" />
<script>
  var isPaused = false;
  var time = 0;
  var firstTimePlay = true;
  var sliderValLeft = 0;
  var sliderValRight = 0;
  var setleft;
  var setRight;
  var interval_left = 1000;
  var interval_right = 1000;
  var inputRange;
  var sliderValue;

</script>
			<!--/ End Header -->
<style>
	.swal2-popup{
		font-size: 1rem;
	}
</style>
			<!-- Breadcrumbs -->
			<section class="breadcrumbs overlay bg-image" style="background-image: url(../uploads/mod_central_information/<?=$pic_header['value']?>)">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<!-- Bread Title -->
							<div class="bread-title">
								<h2><?php echo $lang['MENU_data_playback_system'] ?><!--Profile--></h2>
							</div>
							<!-- Bread List -->
							<ul class="bread-list" style="z-index: 0 !important;">
								<li><a href="../home/?index=st"><i class="fa fa-home"></i><?=$lang['MENU_HOME']?><!--Home--></a></li>
								<li class="active"><a href="playback_sport.php?playback_sport=st"><i class="fa fa-clone"></i><?php echo $lang['MENU_data_playback_system'] ?><!--Profile--></a></li>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<!--/ End Breadcrumbs -->
			
			<!-- Services -->
		  <section class="services single section">
				<div class="container">
					<div class="row">
						
						<div class="col-lg-2 col-12">
							<!-- Service Sidebar -->
							<div class="services-sidebar">	
								<!-- Service Category -->
								<div class="single-sidebar category">
									<h2><?php echo $lang['MENU_category_Service'] ?></h2>
									<ul>
										<li class="active" ><a onclick="newPressure_Map()" id="pressure_map_btn"><img src="../../img/bg-img/foot.png" style="display: initial;">&nbsp; <?php echo $lang['MENU_Pressure_Map'] ?></a></li>  
                    <li><a onclick="newGait_Analysis()"><img style="display: initial;" src="../../img/bg-img/line-chart.png">&nbsp; <?php echo $lang['MENU_Gait_Analysis'] ?></a></li>    
                    <li><a onclick="newBalance_Board()" ><img style="display: initial;" src="../../img/bg-img/dot-and-circle.png">&nbsp; <?php echo $lang['MENU_Balance_Board'] ?></a></li>     
                    <li><a onclick="newDasboard()" ><img style="display: initial;" src="../../img/bg-img/ui.png">&nbsp; <?php echo $lang['MENU_Dasboard'] ?></a></li>    	
									</ul>
								</div>
								<!--/ End Service Category -->
							</div>
							<!--/ End Service Sidebar -->
						</div>
<style>
  .insideWrapper {
      width:100%;
      height:100%;
      position:relative;
  }
  .coveredImage {
/*
      width:100%;
      height:100%;
*/
      position:absolute;
      top:0px;
      left:0px;
      max-height: 95% !important;
      border: solid 0px !important;
      -moz-box-shadow: 0px 0px 0px ; /* Old Firefox */
      box-shadow: 0px 0px 0px ;
  }
  .coveringCanvas {
      width:100%;
      height:100%;
      position:absolute;
      top:0px;
      left:0px;
  }
	.inpt_date{
	height: 35 !important;
    font-size: 14px;
    width: 100%;
	}
	.but_lr{
    font-size: 14px;
  }
  

@media only screen and (width: 375px )  {
  #itemleft {
    width: 85.75px !important;
    height: 267px !important;
  }
  #itemright {
    width: 85.75px !important;
    height: 267px !important;
  }
  #myCanvas_r {
    width: 150px !important;
    height: 150px !important;
  }
  .coveredImage {
    width: 85.75px !important;
    height: 257px !important;
  }
  
}

@media only screen and (width: 667px) {
  #itemleft {
    width: 95px !important;
    height: 300px !important;
   /* margin: 1px;*/
  }
  #itemright {
    width: 95px !important;
    height: 300px !important;
  }
  #myCanvas_r {
    width: 180px !important;
    height: 180px !important;
  }
  .coveredImage {
    width: 95px !important;
    height: 290px !important;
  }
  #persent_right{
    text-align: left !important;
  }
  #persent_left{
    text-align: left !important;
  }
 
}

@media only screen and (width: 414px) {
  #itemleft {
    width: 90px !important;
    height: 280px !important;
  }
  #itemright {
    width: 90px !important;
    height: 280px !important;
  }
  #myCanvas_r {
    width: 150px !important;
    height: 150px !important;
  }
  .coveredImage {
    max-height: 94% !important;
  }
}
@media only screen and (width: 768px) {
  #itemleft {
    width: 95px !important;
    height: 300px !important;
    margin: 1px;
  }
  #itemright {
    width: 95px !important;
    height: 300px !important;
  }
  #myCanvas_r {
    width: 180px !important;
    height: 180px !important;
  }
  .coveredImage {
    max-height: 94% !important;
  }
  #persent_right{
    text-align: left !important;
  }
  #persent_left{
    text-align: left !important;
  }
 
}

@media only screen and (width: 736px) {
  #itemleft {
    width: 95px !important;
    height: 300px !important;
    
  }
  #itemright {
    width: 95px !important;
    height: 300px !important;
  }
  #myCanvas_r {
    width: 180px !important;
    height: 180px !important;
  }
  .coveredImage {
    width: 95px !important;
    height: 289px !important;
  }
  #persent_right{
    text-align: left !important;
  }
  #persent_left{
    text-align: left !important;
  }
 
}
@media only screen and (width: 320px) {
  #itemleft {
    width: 72px !important;
    height: 226px !important;
    margin: 1px;
  }
  #itemright {
    width: 72px !important;
    height: 226px !important;

  }
  #myCanvas_r {
    width: 120px !important;
    height: 130px !important;
  }
  .coveredImage {
    max-height: 94% !important;
  }
 
}

@media only screen and (width: 411px) {
  #itemleft {
    width: 86px !important;
    height: 267px !important;

  }
  #itemright {
    width: 86px !important;
    height: 267px !important;

  }
  #myCanvas_r {
    width: 120px !important;
    height: 120px !important;
  }
  .coveredImage {
    /*max-height: 94% !important;*/
    width: 86px !important;
    height: 257px !important;
  }
 
}
@media only screen and (width: 731px) {
  #itemleft {
    width: 115px !important;
    height: 291px !important;

  }
  #itemright {
    width: 115px !important;
    height: 291px !important;

  }
  #myCanvas_r {
    width: 120px !important;
    height: 120px !important;
  }
  .coveredImage {
    /*max-height: 94% !important;*/
    width: 115px !important;
    height: 280px !important;
  }
 
}
@media only screen and (width: 823px) {
  #itemleft {
    width: 115px !important;
    height: 291px  !important;

  }
  #itemright {
    width: 115px !important;
    height: 291px  !important;

  }
  #myCanvas_r {
    width: 140px !important;
    height: 140px !important;
  }
  .coveredImage {
    /*max-height: 94% !important;*/
    width: 115px !important;
    height: 280px !important;
  }
 
}

@media only screen and (width: 812px) {
  #itemleft {
    width: 100px !important;
    height: 291px  !important;

  }
  #itemright {
    width: 100px !important;
    height: 291px  !important;

  }
  #myCanvas_r {
    width: 140px !important;
    height: 140px !important;
  }
  .coveredImage {
    /*max-height: 94% !important;*/
    width: 100px !important;
    height: 280px !important;
  }
  #persent_right{
    text-align: left !important;
  }
  #persent_left{
    text-align: left !important;
  }
 
}

@media only screen and (width: 1024px) {
  #itemleft {
    width: 126px !important;
    height: 397px !important;
    margin: 1px;

  }
  #itemright {
    width: 126px !important;
    height: 397px !important;
    margin: 1px;

  }
  #myCanvas_r {
    width: 300px !important;
    height: 300px !important;
  }
  .coveredImage {
    max-height: 94% !important;
  }
  #persent_right{
    text-align: left !important;
  }
  #persent_left{
    text-align: left !important;
  }
 
}


@media only screen and (width: 1366px) {
  #itemleft {
    width: 126px !important;
    height: 400px !important;


  }
  #itemright {
    width: 125px !important;
    height: 400px !important;
    padding-left: 1px !important;
  
  }
  #myCanvas_r {
    width: 270px !important;
    height: 270px !important;
  }
  .coveredImage {
    width: 126px !important;
    height: 390px !important;
  }
  #persent_right{
    text-align: left !important;
  }
  #persent_left{
    text-align: left !important;
  }
 
}

@media only screen and (width: 360px) {
  #itemleft {
    width: 83px !important;
    height: 258px !important;


  }
  #itemright {
    width: 82px !important;
    height: 258px !important;
    margin-right: 1px;


  }
  #myCanvas_r {
    width: 120px !important;
    height: 120px !important;
  }
  .coveredImage {
    max-height: 94% !important;
  }
 
}

@media only screen and (width: 640px) {
  #itemleft {
    width: 86px !important;
    height: 273px !important;
    margin: 1px;
  }
  #itemright {
    width: 86px !important;
    height: 273px !important;

  }
  #myCanvas_r {
    width: 150px !important;
    height: 150px !important;
  }
  .coveredImage {
    max-height: 94% !important;
  }
 
}

@media only screen and (width: 568px) {
  #itemleft {
    width: 90px !important;
    height: 250px !important;

  }
  #itemright {
    width: 90px !important;
    height: 250px !important;

  }
  #myCanvas_r {
    width: 120px !important;
    height: 120px !important;
  }
  .coveredImage {
    /*max-height: 94% !important;*/
    width: 90px !important;
    height: 240px !important;
  }
 
}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
    background: #00efb8 !important;
  }
  .ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active {
    background: #ffffff !important;
    border: solid 1px #00efb8 !important;
  }
</style>

<?php
if (isset($_GET['id_customer'])) {
      $id_customer = $_GET['id_customer'];
    }else{
      $id_customer = $_SESSION['id_customer'];
    }

    if (isset($_POST['playback_type'])) {
      $playback_type = $_POST['playback_type'];
    }else{
      $playback_type = '';
    }

    if (isset($_POST['datetimepicker'])) {
      $datetimepicker = $_POST['datetimepicker'];
    }else{
      $datetimepicker = '';
    }

    if (isset($_POST['playback_time'])) {
      $playback_time = $_POST['playback_time'];
    }else{
      $playback_time = '';
    }

    if (isset($_POST['status_play'])) {
      $status_play = $_POST['status_play'];
    }else{
      $status_play = '';
    }
?>
					  <div class="col-lg-2 col-12" style="text-align: right;">
						  <p style="text-align: left;"><?php echo $lang['MENU_date'] ?></p>
						  <div class="col-md-12">
                                     <div class="form-group">
                                                 <div class="col-sm-12">
                                                    <div class='input-group date col-md-12'>
                                                        <SELECT class="form-control" name="playback_type" style="display: none;" id='playback_type' onchange="playback_time_func()">
                                                            <option value="0"><?php echo $lang['MENU_type'] ?> Playback</option>
                                                            <option value="1" selected><?php echo $lang['MENU_Medical'] ?></option>
                                                            <option value="2"><?php echo $lang['MENU_Sports'] ?></option>
                                                        </SELECT>
                                                            
                                                    </div>
                                                 </div>
										 		 <div class="">
                                                    <div class='' >
                                                        <input type='text' class="form-control" name="datetimepicker" id='datetimepicker' autocomplete="off" placeholder="<?php echo $lang['MENU_date'] ?>" onchange="playback_time_func()" value="<?php echo $datetimepicker ?>"/>
                                                    </div>
                                                 </div><br>
                                                 <div class="">
                                                    <div class='' >
                                                        <SELECT class="form-control" name="playback_time" id="playback_time">
                                                            <option value="0"><?php echo $lang['MENU_Time']  ?> Playback</option>
                                                        </SELECT>
                                                            
                                                    </div>
                                                 </div><br>

                                                 <!-- <div class="">-->
                                                 <p style="text-align: left;margin-left:-12px"><?php echo $lang['MENU_speed'] ?></p>
                                                    <div class='' >
                                                      <div>                                                     
                                                        <SELECT class="form-control" name="playback_speed" id="playback_speed">
                                                            <option value="1">1x</option>
                                                            <option value="2">2x</option>
                                                            <option value="3">3x</option>
                                                            <option value="4">4x</option>
                                                        </SELECT>
                                                            
                                                    </div>
                                                 </div><br>	
                                                  <!-- <div class="col-sm-3">
                                                   
                                <button onclick="function_play()" type="button" class="btn btn-primary search_date" id="search_date"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;<?php echo $lang['MENU_Play'] ?></button>&nbsp;&nbsp;&nbsp;
                                                  </div> -->
                                            </div>
                                        </div>
						  
						  <div id="show_data"></div>

             
						  <?php 
	

					 		
						  ?>


					  </div>
            <!-- กราฟ -->
           
        

<div class="card col-md-8" style="overflow: auto; border: 0px !important;">
  <div class="row no-gutters">
    <div class="col-lg-3 col-md-6 col-3"   >
      <img src="../images/foot_left.png" style="max-width: 160;background: #000000;" class="coveredImage" id="coveredImage_right">
        <canvas class="itemleft" id="itemleft" width="160" height="500" ></canvas>
        
    </div>
    <div class="col-lg-6 col-md-6 col-6">
        <div class="col-lg-12 col-12" style="text-align: center;">
                    <canvas id="myCanvas_r" width="285" height="285" style="border:1px solid #d3d3d3;"></canvas>
                  </div>
                 
                    <div class=" col-lg-12 col-12 row" style="text-align: center;padding: 0px;margin: 0px;">
                  <table class="table" width="100%">
                    <tr style="background: #20c997;  ">
                      <th style="padding: 5px;" class="text-center" ><?=$lang['MENU_Balance_score']?> </th>
                      <th style="padding: 5px;" class="text-center" >Time in Zone</th>
                      <th style="padding: 5px;" class="text-center" ><?=$lang['MENU_Balance']?></th>
                    </tr>
                    <tr>
                      <td><p id="p_right"> 0  </p></td>
                      <td><p id="p_time"> 0 s </p></td>
                      <td><p id="p_text_right"> - </p></td>
                    </tr>
                  </table>
               

                  </div>
    </div>
    <div class="col-lg-3 col-md-6 col-3">
      <img src="../images/foot_right.png" style="max-width: 160; background: #000000;" class="coveredImage" id="coveredImage_left">
        <canvas class="itemright" id="itemright" width="160" height="500"></canvas>
        
    </div>
    <div class="col-lg-3 col-md-6 col-3" align="center"><div class="col-md-12" id="persent_left"></div></div>
    <div class="col-lg-6 col-md-6 col-6"> 
      <img src="../img/icons/play-button.png" id="play_btn"  />
      
      <div id="js-example-change-value">
        <input id="range_slider" type="range" min="0" value="0" data-rangeSlider style="display: none;">
        <output></output>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-3" align="center"><div class="col-md-12" id="persent_right"></div></div>
  </div>
</div>
<!-- กราฟ -->


					 
						<div class="col-lg-5 col-12">
							
							<div class="col-lg-12 col-12">
                <div class="row" style="text-align: center;" id="mycan_l" >
                  <div class="col-lg-1 col-12"> 
                  </div>
                  <div class="col-lg-11 col-12" style="display: none;">
                    <canvas id="myCanvas_l" width="285" height="285" style="border:1px solid #d3d3d3;" ></canvas>
                  </div>
                </div><br>
                <br>

                 
          </div>			
				</div>
			</section>
			<!--/ End Services -->
<input type="hidden" name="id_customer" id="id_customer" value="<?php echo $id_customer ?>">
<input type="hidden" name="get_time" id="get_time" value="<?php echo $playback_time ?>">
<input type="hidden" name="status_play" id="status_play" value="<?php echo $status_play?>">
        <form id="form-del">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="id_customer" value id="form-del-cus">
        </form>
        <div class="control-sidebar-bg"></div>
			<!-- Footer -->
			<?php include 'footer.php'?>
			<!--/ End footer -->
			<?php include 'footer_credit.php'?>
	<script src="../admin/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- bootstrap datepicker -->
   <script type="text/javascript" src="jquerydatepicker/jquery-ui.min.js"></script>
    <!-- date-range-picker -->
    <script src="../admin/bower_components/moment/min/moment-with-locales.min.js"></script>
    <!-- <script src="js/front-manage-attr.js"></script> -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="../admin/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>					
					
					
</body>
</html>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script src="../admin/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
<!-- bootstrap datepicker -->

<script type="text/javascript" src="js/jquery.redirect.js"></script>


<script src="https://d3js.org/d3.v4.min.js"></script>
<script src="https://d3js.org/d3-hsv.v0.1.min.js"></script>
<script src="https://d3js.org/d3-contour.v1.min.js"></script>
<script src="kign.js"></script>

<?php

$sql_date = "SELECT DATE_FORMAT(`action`, '%Y-%m-%d') AS date_action FROM `surasole` WHERE `id_customer` = '".$id_customer."' GROUP BY DATE_FORMAT(`action`, '%Y-%m-%d') ";
$invalid_date = array();
$query_date = mysqli_query($objConnect, $sql_date);
while ($result_date = mysqli_fetch_array($query_date)) {
  // เอาเฉพาะส่วนวันที่ เช่น 2013-04-22
  $date_part = substr($result_date['date_action'], 0, 10);
  // แยกส่วนวันที่ด้วยเครื่องหมาย -
  // โดยให้เดือน และวัน ไปอยู่ในตัวแปร $month และ $day
  list($year, $month, $day) = explode('-', $date_part);
  // เพิ่มวันที่เข้าไป โดยแปลงเลขที่มี 0 นำหน้า ให้กลับเป็นเลขปกติด้วย (int)
  // เช่น '04' จะกลายเป็น 4
  $invalid_date[] = $year . '-' .$month . '-' . $day;
}
?>
<script>

// แปลง $invalid_date ให้เป็น JSON
// เช่น $invalid_date = array('4-22');
// ก็จะได้ JSON ["4-22"]
var invalidDate = <?php echo json_encode($invalid_date); ?>;
//console.log(invalidDate)
function beforeShowDay(date) {
  // ทำวันที่ที่ Datepicker ส่งมา ให้อยู่ในรูปแบบเดียวกันกับที่ส่งออกมาจาก PHP
  

   var date = new Date(date),
    mnth = ("0" + (date.getMonth() + 1)).slice(-2),
    day = ("0" + date.getDate()).slice(-2);
  var searchDate = date.getFullYear() + '-' +mnth + '-' + day;
  // indexOf() จะให้ค่า -1 หากไม่มีค่าที่ตรวจสอบอยู่ใน Array
  //console.log(invalidDate.indexOf(searchDate))
  //console.log(searchDate)
  if (invalidDate.indexOf(searchDate) === -1) {
    // บอก Datepicker ว่า วันที่นี้สามารถเลือกได้
    //console.log('false')
    return [false, "", ""];
  }
  // นอกนั้นเลือกไม่ได้ เพราะเป็นวันที่ที่มีอยู่ใน Array invalidDate
  //console.log('true')
  return [true, "", ""];
}
$("#datetimepicker").datepicker({
  beforeShowDay: beforeShowDay,
  dateFormat: 'yy-mm-dd',
changeMonth: true,
changeYear: true
});


</script>
<script>	

function htmlDecode(input){
  var e = document.createElement('textarea');
  e.innerHTML = input;
  // handle case of empty input
  return e.childNodes.length === 0 ? "" : e.childNodes[0].nodeValue;
}

var x = "Total Width: " + screen.width;
console.log(x)
	  	  
    const left_x = [
      3, 7, 3, 3,
      5, 7, 5, 7,
      3, 5, 7, 5,
      7, 5, 7, 7,
      3, 5, 7, 5,
      7, 3, 5, 7
    ]
    const axis_y = [
      3, 3, 5, 7,
      7, 7, 11, 11,
      13, 13, 13, 15,
      15, 17, 17, 19,
      21, 21, 21, 23,
      23, 24, 24, 24
    ]
    const right_x = [
      1.5, 5.5, 5.5, 1.5,
      3.5, 5.5, 1.5, 3.5,
      1.5, 3.5, 5.5, 1.5,
      3.5, 1.5, 3.5, 1.5,
      1.5, 3.5, 5.5, 1.5,
      3.5, 1.5, 3.5, 5.5
    ]

    const n = 8, m = 24;

    function findLeftContourArray(lsensor) {
      const dataleft = [
        1, lsensor[0], 0, lsensor[1],
        0, lsensor[2], 0, 0,
        lsensor[3], 0, 0, 0,
        0, 0, 0, 0,
        0, lsensor[4], 0, 0,
        0, 0, 0, 0
      ]
      var variogram = kriging.train(
        dataleft,
        left_x,
        axis_y,
        'exponential',
        0,
        100)
      var lvalues = new Array(8 * 24)
      for (let j = 0.5, k = 0; j < m; ++j) {
        for (let i = 0.5; i < n; ++i, ++k) {
          lvalues[k] = kriging.predict(i, j, variogram);
          lvalues[k] = lvalues[k] > 0 ? lvalues[k] : 0;
        }
      }
      return lvalues
    }
	  
	function findRightContourArray(rsensor) {
    const dataright = [
      rsensor[0], 0, 0, rsensor[1],
      0, rsensor[2], 0, 0,
      0, 0, rsensor[3], 0,
      0, 0, 0, 0,
      0, rsensor[4], 0, 0,
      0, 0, 0, 1
    ]
    var variogram = kriging.train(
      dataright,
      right_x,
      axis_y,
      'exponential',
      0,
      100)
    var rvalues = new Array(8 * 24)
    for (let j = 0.5, k = 0; j < m; ++j) {
      for (let i = 0.5; i < n; ++i, ++k) {
        rvalues[k] = kriging.predict(i, j, variogram);
        rvalues[k] = rvalues[k] > 0 ? rvalues[k] : 0;
      }
    }
    return rvalues;
  }  
	  
    var values = findLeftContourArray([
      Math.floor(Math.random() * 600),
      Math.floor(Math.random() * 600),
      Math.floor(Math.random() * 600),
      Math.floor(Math.random() * 600),
      Math.floor(Math.random() * 600)
    ])
	
	var valuesright = findRightContourArray([
      Math.floor(Math.random() * 600),
      Math.floor(Math.random() * 600),
      Math.floor(Math.random() * 600),
      Math.floor(Math.random() * 600),
      Math.floor(Math.random() * 600),	
    ])

    function getColor(t) {
      document.getElementById("coveredImage_left").style.background = "rgba(0, 0, 0, 0)";
      document.getElementById("coveredImage_right").style.background = "rgba(0, 0, 0, 0)";
      // var img = document.getElementById("coveredImage_left");
      //       var width = img.clientWidth;
      //       var height = img.clientHeight;
      //       console.log("d"+width+"ส"+height);
      //       document.getElementById("itemleft").style.height = height+"px";
      //       document.getElementById("itemright").style.height = height+"px";

      //       document.getElementById("itemleft").style.width = width+"px";
      //       document.getElementById("itemright").style.width = width+"px";


        t = Math.max(0, Math.min(1, t));
        return "rgb("
          + Math.max(0, Math.min(255, Math.round(34.61 + t * (1172.33 - t * (10793.56 - t * (33300.12 - t * (38394.49 - t * 14825.05))))))) + ", "
          + Math.max(0, Math.min(255, Math.round(23.31 + t * (557.33 + t * (1225.33 - t * (3574.96 - t * (1073.77 + t * 707.56))))))) + ", "
          + Math.max(0, Math.min(255, Math.round(27.2 + t * (3211.1 - t * (15327.97 - t * (27814 - t * (22569.18 - t * 6838.66)))))))
          + ")";
    }

    var canvas = document.getElementById("itemleft"),
      context = canvas.getContext("2d"),	
      color = d3.scaleSequential(getColor).domain(d3.extent(d3.range(0, 600, 50))),
      pathleft = d3.geoPath(null, context),
      thresholds = d3.range(0, 600, 50),
      contours = d3.contours().size([8, 24]);
	  
	 var canvasr = document.getElementById("itemright"),
      contextr = canvasr.getContext("2d"),	
      colorr = d3.scaleSequential(getColor).domain(d3.extent(d3.range(0, 600, 50))),
      pathr = d3.geoPath(null, contextr),
      thresholds = d3.range(0, 600, 50),
      contoursr = d3.contours().size([8, 24]);
	  
      context.scale(20, 20);
      context.translate(0, 0);
	  
	  contextr.scale(20, 20);
      contextr.translate(0, 0);  

	     
    function fill(geometry) {
      context.beginPath();
      pathleft(geometry);
      context.fillStyle = color(geometry.value);
      context.fill();
    }

    function value(x, y) {
      return Math.sin(x + y) * Math.sin(x - y);
    }
	  
	function fillr(geometry) {
      contextr.beginPath();
      pathr(geometry);
      contextr.fillStyle = colorr(geometry.value);
      contextr.fill();
    }

    function value(x, y) {
      return Math.sin(x + y) * Math.sin(x - y);
    }   
 

  </script>

<!-- Load d3.js -->
<script src="https://d3js.org/d3.v4.js"></script>
<!-- Color scale -->
<script src="https://d3js.org/d3-scale-chromatic.v1.min.js"></script>
<script>
  function ppp_left(y1,y2){
      var canvas_b = document.getElementById('myCanvas_l');
      var context_b = canvas_b.getContext('2d');
      var centerX_b = canvas_b.width / 2;
      var centerY_b = canvas_b.height / 2;
      var radius_b = 70;



context_b.fillStyle = "#fff";
context_b.beginPath();
context_b.setLineDash([0]); 
context_b.arc(142.5, 142.5, 126.75, 0, Math.PI*2, false);
  
context_b.closePath();
context_b.lineWidth = 1;
context_b.strokeStyle = '#999';
context_b.fill();
context_b.stroke(); 
  
context_b.fillStyle = "#fff";
context_b.beginPath();
context_b.setLineDash([8]); 
context_b.arc(142.5, 142.5, 103, 0, Math.PI*2, false);
  
context_b.closePath();
context_b.lineWidth = 1;
context_b.strokeStyle = '#999';   
context_b.fill();
context_b.stroke();   
  
context_b.fillStyle = "#fff";
context_b.beginPath();
context_b.setLineDash([0]); 
context_b.arc(142.5, 142.5, 79.25, 0, Math.PI*2, false);
  
context_b.closePath();
context_b.lineWidth = 1;
context_b.strokeStyle = '#999';   
context_b.fill();
context_b.stroke();
  
context_b.fillStyle = "#fff";
context_b.beginPath();
context_b.setLineDash([8]); 
context_b.arc(142.5, 142.5, 55.5, 0, Math.PI*2, false);

context_b.closePath();
context_b.lineWidth = 1;
context_b.strokeStyle = '#999';   
context_b.fill();
context_b.stroke(); 
  
context_b.fillStyle = "#fff";
context_b.beginPath();
context_b.setLineDash([0]); 
context_b.arc(142.5, 142.5, 31.75, 0, Math.PI*2, false);
context_b.moveTo(142.5, 0);
context_b.lineTo(142.5, 285);
context_b.moveTo(285, 142.5);
context_b.lineTo(0, 142.5);   
context_b.closePath();
context_b.lineWidth = 1;
context_b.strokeStyle = '#999';   
context_b.fill();
context_b.stroke(); 
  
context_b.fillStyle = "yellow";
context_b.beginPath();
context_b.arc(y1,y2, 8, 0, Math.PI*2, false);
context_b.closePath();
context_b.lineWidth = 1;
context_b.strokeStyle = '#999';   
context_b.fill();
context_b.stroke();  
} 
</script>

<script>
  function ppp_right(y1,y2){
      var canvas_r = document.getElementById('myCanvas_r');
      var context_r= canvas_r.getContext('2d');
      var centerX_r = canvas_r.width / 2;     
    var centerY_r = canvas_r.height / 2;
      var radius_r = 70;



context_r.fillStyle = "#fff";
context_r.beginPath();
context_r.setLineDash([0]); 
context_r.arc(142.5, 142.5, 126.75, 0, Math.PI*2, false);
  
context_r.closePath();
context_r.lineWidth = 1;
context_r.strokeStyle = '#999';
context_r.fill();
context_r.stroke(); 
  
context_r.fillStyle = "#fff";
context_r.beginPath();
context_r.setLineDash([8]); 
context_r.arc(142.5, 142.5, 103, 0, Math.PI*2, false);
  
context_r.closePath();
context_r.lineWidth = 1;
context_r.strokeStyle = '#999';   
context_r.fill();
context_r.stroke();   
  
context_r.fillStyle = "#fff";
context_r.beginPath();
context_r.setLineDash([0]); 
context_r.arc(142.5, 142.5, 79.25, 0, Math.PI*2, false);
  
context_r.closePath();
context_r.lineWidth = 1;
context_r.strokeStyle = '#999';   
context_r.fill();
context_r.stroke();
  
context_r.fillStyle = "#fff";
context_r.beginPath();
context_r.setLineDash([8]); 
context_r.arc(142.5, 142.5, 55.5, 0, Math.PI*2, false);

context_r.closePath();
context_r.lineWidth = 1;
context_r.strokeStyle = '#999';   
context_r.fill();
context_r.stroke(); 
  
context_r.fillStyle = "#fff";
context_r.beginPath();
context_r.setLineDash([0]); 
context_r.arc(142.5, 142.5, 31.75, 0, Math.PI*2, false);
context_r.moveTo(142.5, 0);
context_r.lineTo(142.5, 285);
context_r.moveTo(285, 142.5);
context_r.lineTo(0, 142.5);   
context_r.closePath();
context_r.lineWidth = 1;
context_r.strokeStyle = '#999';   
context_r.fill();
context_r.stroke();


//  var yellow = [142.5,170.5];
  
//  for (var i = 0; i < yellow.length; i++) {   
 




// }


  context_r.fillStyle = "yellow";
context_r.beginPath();

context_r.arc(y1,y2, 8, 0, Math.PI*2, false);
 
context_r.closePath();
context_r.lineWidth = 1;
context_r.strokeStyle = '#999';   
context_r.fill();
context_r.stroke(); 
}

// context_r.fillStyle = "white";
// context_r.beginPath();

// context_r.arc(142.5,142.5, 8, 0, Math.PI*2, false);
 
// context_r.closePath(); 



</script>


<script type="text/javascript">
function myStopFunction() {

  if(typeof(setleft) != "undefined" && setleft !== null) {
  clearInterval(setleft);
  clearInterval(setright);
  }

}
 $(document).on('click','#pressure_map_btn',function(){
 
   
 
            })



  // $(function () {
    

          
  //           $('#datetimepicker').datepicker({
  //      todayBtn: "linked",
  //      language: "th",
  //      autoclose: true,
  //      todayHighlight: true,
  //      format: 'yyyy-mm-dd'
       
  //  });
  //       });

function playback_time_func(){
  id_customer =  $("#id_customer").val();  
  playback_type =  $("#playback_type").val();  
  datetimepicker =  $("#datetimepicker").val();
  get_time =  $("#get_time").val();
  console.log(playback_type,id_customer,datetimepicker, "time", get_time)  
if (id_customer != '' && playback_type != '0' && datetimepicker!= '') {
   $.ajax({   
            url:'test_time.php?id_customer='+id_customer, 
            method:'POST',  
            data:{id_customer:id_customer, playback_type:playback_type, datetimepicker:datetimepicker,get_time:get_time},  
                success:function(data_){  
                   console.log(data_);
               
                $("#playback_time").html(htmlDecode(data_)); 

                status_play =  $("#status_play").val();  
if (status_play=='1') {
  search_date();
}

                }, 

                   
           });
}
 
} 


// function showContent () {

//   $("#show_data").html(''); 
//   var playbackTime =  $("#playback_time").val(); 
//   var playbackLeftRight = playbackTime.split("/");
//   var playbackTimeArrLeft,  = playbackLeftRight[0].split("***");
//   varplayback_time_arr_right = playback_left_right[1].split("***");
// }

var speed = 1;
$(document).on("change", "#playback_speed", function(){
  speed = $(this).val();
});


 function search_date(){
  $("#show_data").html(''); 
  playback_time =  $("#playback_time").val(); 


   
    playback_left_right = playback_time.split("/");

     playback_time_arr_left = playback_left_right[0].split("***");
     playback_time_arr = playback_left_right[0].split("***");
     

     playback_time_arr_right = playback_left_right[1].split("***");
     playback_time_arr = playback_left_right[1].split("***");
     
    // console.log(playback_time_arr_left)
    // console.log(playback_time_arr_right)
     sum_val_senser_left_total = 0;
     for (var q = 0; q < playback_time_arr_left.length; q++) {
       val_senser_left_arr = playback_time_arr_left[q].split(",")
       sum_val_senser_left_total += parseInt(val_senser_left_arr[0])+parseInt(val_senser_left_arr[1])+parseInt(val_senser_left_arr[2])+parseInt(val_senser_left_arr[3])+parseInt(val_senser_left_arr[4]);
       sum_val_senser_left_total1 = parseInt(val_senser_left_arr[0])+parseInt(val_senser_left_arr[1])+parseInt(val_senser_left_arr[2])+parseInt(val_senser_left_arr[3])+parseInt(val_senser_left_arr[4]);
     }
    
     sum_val_senser_right_total = 0;
     for (var w = 0; w < playback_time_arr_right.length; w++) {
       val_senser_right_arr = playback_time_arr_right[w].split(",")
       sum_val_senser_right_total += parseInt(val_senser_right_arr[0])+parseInt(val_senser_right_arr[1])+parseInt(val_senser_right_arr[2])+parseInt(val_senser_right_arr[3])+parseInt(val_senser_right_arr[4]);
       sum_val_senser_right_total1 = parseInt(val_senser_right_arr[0])+parseInt(val_senser_right_arr[1])+parseInt(val_senser_right_arr[2])+parseInt(val_senser_right_arr[3])+parseInt(val_senser_right_arr[4]);
     }
     sum_sense = sum_val_senser_left_total1 + sum_val_senser_right_total1 ;
     inputRange = document.getElementById("range_slider");
    //  inputRange.addEventListener('input', sliderChange); 

    //  function sliderChange(){
    //    sliderVal = this.value;
    //  }
    //  console.log('data',playback_time_arr_left)
    //  console.log('data',)
    

     var attributes = {
  
    };
  // update attributes
  $('#range_slider').attr(attributes);

  // pass updated attributes to rangeslider.js
 
  $('#range_slider')[0].rangeSlider.update({min: 0,
    max: playback_time_arr_left[playback_time_arr_left.length-1].split(',')[5],
    step: 1});
   
  
  //////ซ้าย/////
  ileft=sliderValLeft?sliderValLeft:0;
  sliderValLeft = 0;
  xy_right_total=0;
  sum_val_senser_left=0;
    
  setleft = setInterval(setLeftFoot, interval_left/speed);                      
//////ซ้าย/////

//////ขวา/////
iright=sliderValRight?sliderValRight:0;;
sliderValRight = 0;
sum_val_senser_right=0;
// xy_right_total = 0;

  setright = setInterval(setRightFoot, interval_right/speed);  
   
//////ขวา/////

}

function setLeftFoot(){
  if(!isPaused) {
    // ileft = inputRange.value;
    console.log("ileft", ileft);
  // console.log("range", inputRange.value ,"sliderValue", sliderValue);  
    data_test = playback_time_arr_left[ileft];
    data_test2 = data_test.split(",");
    console.log("data_test2", );
    data_test3=[];
    
    for (var i = 0; i < data_test2.length; i++) {
      // console.log(data_test3);
      data_test3.push(parseInt(data_test2[i]));
    }
    // console.log(data_test3);
    // console.log(data_test2.length/4);
    $("#p_time").html(data_test3[5]+' s'); 

    console.log("changeevent");
    inputRange.value = data_test3[5];
    inputRange.dispatchEvent(new Event('change'));
  
    balance_Y  = ((data_test3[0]+data_test3[1]+data_test3[2]) / 3) - data_test3[4]
    balance_X = data_test3[2] - data_test3[1] 
    y = (balance_Y / 850) * 142.5
    x = (balance_X / 850) * 142.5
    x1 = x+142.5
    y1 = y+142.5


    xy_left = ((142.5 - x1) * (142.5 - x1) + (142.5 - y1) * (142.5 - y1))
    xy_left_1 = Math.sqrt(xy_left)
    xy_right_total = xy_left_1 + xy_right_total;
    xy_left_total1=xy_right_total/(ileft+1)

    var data_test1 = [0,0,0,0,364];

    values = findLeftContourArray(   
      data_test3
    )

    // console.log("speed", speed);
    ileft = sliderValLeft?sliderValLeft:ileft+1
    sliderValLeft = 0;  
    sum_val_senser_left = data_test3[0]+data_test3[1]+data_test3[2]+data_test3[3]+data_test3[4];
    playback_time_left_num = playback_time_arr_left.length
    persent_left = (sum_val_senser_left / sum_sense ) * 100;
    if (ileft==playback_time_arr_left.length) {
      isPaused = true;
      firstTimePlay = true;
      clearInterval(setleft)
      $('#play_btn').attr('src',isPaused? '../img/icons/play-button.png':'../img/icons/pause.png');

      $('#persent_left').html(persent_left.toFixed( 2 )+"%");
    }else{

      isPaused = false;

      $('#persent_left').html(persent_left.toFixed( 2 )+"%");
      $("#play_btn").attr('src', isPaused? '../img/icons/play-button.png':'../img/icons/pause.png');
    }

    contours
      .thresholds (d3.range(0, 600, 50))
      (values)
      .forEach(fill);

    if( interval_left !== (speed*1000)){
      clearInterval(setleft)
      if(!isPaused){
        setleft = setInterval(setLeftFoot, interval_left/speed);
      }  
    } 
  }

}

function setRightFoot(){
  if(!isPaused) {
    console.log("iright", iright);
      data_testright = playback_time_arr_right[iright];
      data_test2right = data_testright.split(",");
      data_test3right=[];
      for (var i = 0; i < data_test2right.length; i++) {
        data_test3right.push(parseInt(data_test2right[i]));
      }

      balance_Y_right  = ((data_test3right[0]+data_test3right[1]+data_test3right[2]) / 3) - data_test3right[4]
      balance_X_right = data_test3right[2] - data_test3right[1] 
      y_right = (balance_Y_right / 850) * 142.5
      x_right = (balance_X_right / 850) * 142.5
      x1_right = x_right+142.5
      y1_right = y_right+142.5
      xx= (x1 + x1_right) / 2
      yy =(y1 + y1_right ) /2
      ppp_right(xx,yy)
      //console.log(x1_right+','+y1_right)

      xy_right = ((142.5 - x1_right) * (142.5 - x1_right) + (142.5 - y1_right) * (142.5 - y1_right))
      xy_right_1 = Math.sqrt(xy_right)

      xy_sqrt = (xy_left_1+xy_right_1) / 2
      if (xy_sqrt<=57  ) {
        $("#p_text_right").html('ดี')
      }else if (xy_sqrt>57 && xy_sqrt<=228){
        $("#p_text_right").html('ปานกลาง')
      //p_text_right
      }else{
        $("#p_text_right").html('พอใช้')
      }
      xy_right_total = xy_right_1 + xy_right_total;

      xy_right_total1=xy_right_total/ ((iright+1) +(ileft+1))

      $("#p_right").html(xy_right_total1.toFixed(2)); 

      valuesright = findRightContourArray(data_test3right)
      iright = sliderValRight?sliderValRight: iright+1;
      sliderValRight = 0;
      sum_val_senser_right = data_test3right[0]+data_test3right[1]+data_test3right[2]+data_test3right[3]+data_test3right[4];
    //console.log("รวมที่แสดง = "+sum_val_senser_right)
      playback_time_right_num = playback_time_arr_right.length
      persent_right = (sum_val_senser_right / sum_sense ) * 100;

      if (iright==playback_time_arr_right.length) {
        isPaused = true;
        firstTimePlay = true;
        clearInterval(setright)
        $('#persent_right').html(persent_right.toFixed( 2 )+"%");
        $('#play_btn').attr('src',isPaused? '../img/icons/play-button.png':'../img/icons/pause.png');

      }else{
        isPaused = false;
        $('#persent_right').html(persent_right.toFixed( 2 )+"%");
        $('#play_btn').attr('src',isPaused? '../img/icons/play-button.png':'../img/icons/pause.png');

      }

      contoursr
        .thresholds(d3.range(0, 600, 50))
        (valuesright)
        .forEach(fillr);

      if( interval_right !== (speed*1000)){
        clearInterval(setright)
        if(!isPaused){
          setright = setInterval(setRightFoot, interval_right/speed);
        }  
      }
  }
}

    

function newPressure_Map() {
  id_customer =  $("#id_customer").val();  
  playback_type =  $("#playback_type").val();  
  datetimepicker =  $("#datetimepicker").val();  
  playback_time =  $("#playback_time").val();  
  $.redirect("playback_phy.php?id_customer="+id_customer, {playback_type: playback_type, datetimepicker: datetimepicker, playback_time: playback_time}, "POST", ""); 
}

function newGait_Analysis() {
  id_customer =  $("#id_customer").val();  
  playback_type =  $("#playback_type").val();  
  datetimepicker =  $("#datetimepicker").val();  
  playback_time =  $("#playback_time").val();  
  $.redirect("playback_phy_GA.php?id_customer="+id_customer, {playback_type: playback_type, datetimepicker: datetimepicker, playback_time: playback_time}, "POST", ""); 
}
function newBalance_Board() {
  id_customer =  $("#id_customer").val();  
  playback_type =  $("#playback_type").val();  
  datetimepicker =  $("#datetimepicker").val();  
  playback_time =  $("#playback_time").val();  
  $.redirect("playback_phy_BB.php?id_customer="+id_customer, {playback_type: playback_type, datetimepicker: datetimepicker, playback_time: playback_time}, "POST", ""); 
}
function newDasboard() {
  id_customer =  $("#id_customer").val();  
  playback_type =  $("#playback_type").val();  
  datetimepicker =  $("#datetimepicker").val();  
  playback_time =  $("#playback_time").val();  
  $.redirect("playback_phy_DB.php?id_customer="+id_customer, {playback_type: playback_type, datetimepicker: datetimepicker, playback_time: playback_time}, "POST", ""); 
}


function function_play() {
  id_customer =  $("#id_customer").val();  
  playback_type =  $("#playback_type").val();  
  datetimepicker =  $("#datetimepicker").val();  
  playback_time =  $("#playback_time").val();  
  $.redirect("playback_phy.php?id_customer="+id_customer, {playback_type: playback_type, datetimepicker: datetimepicker, playback_time: playback_time, status_play: '1'}, "POST", ""); 
 
 
}





</script>

<script  type="text/javascript" src="./js/range-slider.min.js"></script>
<script>
    (function () {

      isPaused =  $("#status_play").val()==1?false : true;  
      firstTimePlay =  $("#status_play").val()==1?false : true;  
        var selector = '[data-rangeSlider]',
            elements = document.querySelectorAll(selector);
        
        // Example functionality to demonstrate a value feedback
        function valueOutput(element) {          
            var value = element.value,
                output = element.parentNode.getElementsByTagName('output')[0];
            output.innerHTML = value;
            sliderValue = value;
        }

        for (var i = elements.length - 1; i >= 0; i--) {
            valueOutput(elements[i]);
        }

        Array.prototype.slice.call(document.querySelectorAll('input[type="range"]')).forEach(function (el) {
            el.addEventListener('input', function (e) {
                valueOutput(e.target);
            }, false);
        });    
        // Basic rangeSlider initialization
        rangeSlider.create(elements, {
            
            // Callback function
            onInit: function () {
            },

            // Callback function
            onSlideStart: function (value, percent,  position) {
                console.info('onSlideStart', 'value: ' + value, 'percent: ' + percent, 'position: ' + position);
            },

            // Callback function
            onSlide: function (value, percent,  position) {
                // inputRange.value = value;
                              
                clearInterval(setleft);
                clearInterval(setright);
                
                var leftVal = playback_time_arr_left.length/playback_time_arr_left[playback_time_arr_left.length-1].split(',')[5];
                var rightVal = playback_time_arr_right.length/playback_time_arr_right[playback_time_arr_right.length-1].split(',')[5];
                ileft = Math.floor(leftVal * value);
                iright = Math.floor(rightVal * value);
                
                sliderValLeft = Math.floor(leftVal * value);
                sliderValRight = Math.floor(rightVal * value);
                
                setleft = setInterval(setLeftFoot, interval_left/speed);
                setright = setInterval(setRightFoot, interval_right/speed);
                
                console.log('onSlide', 'value: ' + value, 'percent: ' + percent, 'position: ' + position);               
            },

            // Callback function
            onSlideEnd: function (value, percent,  position) {
                console.warn('onSlideEnd', 'value: ' + value, 'percent: ' + percent, 'position: ' + position);
            }
        });

        playback_time_func();

        $('#range_slider').show();
        // $('#play_btn').src = isPaused? '../img/icons/play-button.png':'../img/icons/pause.png';

        
    })();

    //with jquery
$('#play_btn').on('click', function(e) {
  e.preventDefault();
  
  if(isPaused && firstTimePlay) {
    function_play();
  }
  isPaused = !isPaused;
  firstTimePlay = false;

  $("#play_btn").attr('src', isPaused? '../img/icons/play-button.png':'../img/icons/pause.png');
  
});

$("#playback_time").on('change', function(e) {
  isPaused = true;
  firstTimePlay = true;
  $('#play_btn').attr('src',isPaused? '../img/icons/play-button.png':'../img/icons/pause.png');
  $('#range_slider')[0].rangeSlider.update({min: 0, value: 0});
})


</script>



</body>
</html>