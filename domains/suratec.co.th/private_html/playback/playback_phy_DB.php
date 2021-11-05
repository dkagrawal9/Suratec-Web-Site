<?php 
  require_once '../admin/library/connect.php';
  require_once '../admin/library/functions.php';
  checkMemUser($objConnect);
?>
<?php include 'header.php';
?>
<?php

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

$id = $_SESSION['id_customer'];

$sqlpro = "SELECT   *,mod_customer.telephone AS telephone ,mod_customer.id_customer AS id_customer, mod_customer.fname AS fname, mod_customer.lname AS lname FROM  mod_customer 
LEFT JOIN tbl_member ON mod_customer.id_customer = tbl_member.id_data_role
LEFT JOIN  mod_customer_address ON mod_customer_address.id_customer = mod_customer.id_customer
WHERE  mod_customer.id_customer = '$id' ";

 //echo $sqlpro;

$queryPro = mysqli_query($objConnect, $sqlpro);
$resultPro = mysqli_fetch_array($queryPro);

// var_dump($_SESSION);

$sex = $resultPro["sex"];
$height = $resultPro["height"];
//var_dump($id);

$sql = 'SELECT `id`,`action`,`left_sensor1`,`left_sensor2`,`left_sensor3`,`left_sensor4`,`left_sensor5`,`right_sensor1`,`right_sensor2`,`right_sensor3`,`right_sensor4`,`right_sensor5`,`id_customer` FROM `surasole` WHERE `id_customer` = "'.$id.'" ORDER BY `action` ASC';
	$query = mysqli_query($objConnect,$sql);
//	$result = mysqli_fetch_array($query);
	$num = mysqli_num_rows($query);
//	if($num>0){
//		echo json_encode(array('status' => '1', 'message' => $result));
//	}else{
//		echo json_encode(array('status' => '0', 'message' => $sql));
//	}


?>

<?php
$sqldaily_data = 'SELECT `action`, `blood_sugar_levels`, `food_breakfast`, `food_lunch`, `food_dinner`, `hours_sleep`, `id_customer` FROM `daily_data` WHERE `id_customer`= "'.$id.'" ORDER BY `action` ASC';
	$querydaily_data = mysqli_query($objConnect,$sqldaily_data);
	$resultdaily_data = mysqli_fetch_array($querydaily_data);

//var_dump($querydaily_data);
?>
						  <?php 
							  $result = mysqli_fetch_array($query);
							  $left_1=$result['left_sensor1'];
							  $left_2=$result['left_sensor2'];
							  $left_3=$result['left_sensor3'];
							  $left_4=$result['left_sensor4'];
							  $left_5=$result['left_sensor5'];
						  ?>

<style>
    .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
    background: #00efb8 !important;
  }
  .ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active {
    background: #ffffff !important;
    border: solid 1px #00efb8 !important;
  }

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
  }
  .coveringCanvas {
      width:100%;
      height:100%;
      position:absolute;
      top:0px;
      left:0px;
  }
	.outright{
		left:0px;
	}
  .nice-select {
    width: 100% !important;
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

<?php include_once 'common.php'; ?>
  <link rel="stylesheet" media="all" type="text/css" href="jquerydatepicker/jquery-ui.css" />
    <link rel="stylesheet" media="all" type="text/css" href="jquerydatepicker/jquery-ui-timepicker-addon.css" />
<link rel="stylesheet" href="../admin/plugins/sweetalert2/dist/sweetalert2.min.css">
    <script src="../admin/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
			<!--/ End Header -->
			
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
						
						<div class="col-lg-3 col-12">
							<!-- Service Sidebar -->
							<div class="services-sidebar">	
								<!-- Service Category -->
								<div class="single-sidebar category">
									<h2><?php echo $lang['MENU_category_Service'] ?></h2>
									<ul>
										<li><a onclick="newPressure_Map()" id="pressure_map_btn"><img src="../../img/bg-img/foot.png" style="display: initial;">&nbsp; <?php echo $lang['MENU_Pressure_Map'] ?></a></li>  
                    <li><a onclick="newGait_Analysis()"><img style="display: initial;" src="../../img/bg-img/line-chart.png">&nbsp; <?php echo $lang['MENU_Gait_Analysis'] ?></a></li>    
                    <li><a onclick="newBalance_Board()" ><img style="display: initial;" src="../../img/bg-img/dot-and-circle.png">&nbsp; <?php echo $lang['MENU_Balance_Board'] ?></a></li>     
                    <li class="active" ><a onclick="newDasboard()" ><img style="display: initial;" src="../../img/bg-img/ui.png">&nbsp; <?php echo $lang['MENU_Dasboard'] ?></a></li>   					
									</ul>
								</div>
								<!--/ End Service Category -->
							</div>
							<!--/ End Service Sidebar -->
						</div>
						<div class="col-lg-9 col-12 row">

                               <div class="col-md-12">
                                     <div class="form-group">
                                             
                                                 
                                                 <input type="hidden" name="playback_type" id='playback_type' value="1">
                                                <!--  <input type="hidden" name="id_customer" id="id_customer" value="<?php echo $id  ?>"> -->
                                                
                                                <div class="col-sm-12" style="margin-top: 10px;" >
                                                    <div class='input-group date col-md-12' >
                                                     
                                                        <input type='text'  class="form-control" name="datetimepicker" id='datetimepicker' autocomplete="off" placeholder="<?php echo $lang['MENU_date'] ?>" onchange="post_location()" value="<?php echo $datetimepicker ?>"/>
                                                            <span class="input-group-addon">
																<i class="fa fa-calendar"></i>
                                                            </span>
                                                    </div>
                                                 </div>

                                                 <div class="col-sm-3" style="display: none;">
                                                    <div class='input-group date col-md-12' >
                                                        <SELECT class="form-control" name="playback_time" id='playback_time'>
                                                            <option value="0"><?php echo $lang['MENU_Time']  ?> Playback</option>
                                                        </SELECT>
                                                            
                                                    </div>
                                                 </div>
                                                 
                                                  <div class="col-sm-3" style="display: none;">
                                                   
                                <button onclick=" myStopFunction()" type="button" class="btn btn-primary search_date" id="search_date"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;<?php echo $lang['MENU_Play'] ?></button>&nbsp;&nbsp;&nbsp;
                                

                            
                           
                                                  </div>
                                                
                                            </div>
                                        </div>
<div class="col-md-12 row"> 
<div class="col-md-6">

          <div class="col-md-12" style="border-radius: 25px;margin-bottom: 10px;display: none;" align="center">
          <div style="border-top-right-radius: 25px;border-top-left-radius: 25px;background: #1bbc9b;padding: 10px;border-top: solid 1px #000000;border-left: solid 1px #000000;border-right: solid 1px #000000;color: #ffffff;">
            Peak Pessure
          </div>
          <div style="border-bottom-right-radius: 25px;border-bottom-left-radius: 25px;border-bottom: solid 1px;border-left: solid 1px;border-right: solid 1px; padding: 10px;">
            <div class="form-group">
                  <select id="zone_option" onchange="change_zone()" class="form-control" >
                    <option value="Zone">Zone&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                    <option value="0">Toe</option>
                    <option value="1">Medial Metatarsal </option>
                    <option value="2">Lateral Metatarsal</option>
                    <option value="3">Medial Midfoot</option>
                    <option value="4">Heel</option>
                  </select> 
                  
              </div>
            <span id="val_kps">0 KPS</span>
          </div>
        </div>
        <div class="col-md-12" style="border-radius: 25px;margin-bottom: 10px;display: none;" align="center">
          <div style="border-top-right-radius: 25px;border-top-left-radius: 25px;background: #1bbc9b;padding: 10px;border-top: solid 1px #000000;border-left: solid 1px #000000;border-right: solid 1px #000000;color: #ffffff;">
            Peak Pressure <?php echo $lang['MENU_Over_specified'] ?>
          </div>
          <div style="border-bottom-right-radius: 25px;border-bottom-left-radius: 25px;border-bottom: solid 1px;border-left: solid 1px;border-right: solid 1px; padding: 10px;">
            <a style="color: #000000"  id="btn_open"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $lang['MENU_Details'] ?></a>
          </div>
        </div>

        <!-- ///*************///////////////// -->
        <div class="fancybox-container fancybox-is-open fancybox-can-drag" role="dialog" tabindex="-1" id="MENU_Over_specified" style="transition-duration: 366ms;display: none;">
          <div class="fancybox-bg"></div>
            <div class="fancybox-inner">
             

            <div class="fancybox-stage">
              <div class="fancybox-slide fancybox-slide--image fancybox-slide--current fancybox-slide--complete" style="">
                <div class="fancybox-image-wrap" style="transform: translate(25%,15%); width: 60%; height: 70%;">
                  

                  


                <style type="text/css">
                  .table_popup td, .table_popup th {
    padding: .75rem;
    vertical-align: top;
    
}
                </style>
                <div class="fancybox-image" style="border: #fff0;">
                  <button style="right: 0px;position: absolute; padding-top: 5px;padding-bottom: 5px;padding-right: 10px;padding-left: 10px; border-radius: 50px;" id="btn_close"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
                  <table class="table_popup " width="90%"  style=" background: #ccc;border-radius: 25px; margin: 20px;" >
                  <thead>
    <tr>
      <th width="30%" style="color: #ffffff;border-right: 1px solid #ffffff;background-color: #1bbc9b;border-top-left-radius: 25px; ">Date Time</th>
      <th width="40%" style="color: #ffffff;border-right: 1px solid #ffffff;background-color: #1bbc9b;">Zone</th>
      <th width="30%" style="color: #ffffff;background-color: #1bbc9b;border-top-right-radius: 25px;">Peak Pressure</th>
    </tr>
                  </thead>
  <tbody id="playback_time_table">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
</div>

                </div>
              </div>
              
            <div class="fancybox-caption-wrap">
              <div class="fancybox-caption">
                
              </div>
            </div>
          </div>
      </div>
    </div>

    <div class="fancybox-container fancybox-is-open fancybox-can-drag" role="dialog" tabindex="-1" id="fancybox-container-1" style="transition-duration: 366ms;display: none;">
      <div class="fancybox-bg"></div>
      <div class="fancybox-inner">
        <div class="fancybox-toolbar1" style="display: block;"><button data-fancybox-play="" class="fancybox-button fancybox-button--play" title="Start slideshow" style=""></button><button data-fancybox-fullscreen="" class="fancybox-button fancybox-button--fullscreen" title="Full screen"></button><button data-fancybox-thumbs="" class="fancybox-button fancybox-button--thumbs" title="Thumbnails" style=""></button><button data-fancybox-close="" class="fancybox-button fancybox-button--close" title="Close"></button></div>
        <div class="fancybox-stage">
          <div class="fancybox-slide fancybox-slide--image fancybox-slide--current fancybox-slide--complete" style="">
            <div class="fancybox-image-wrap" style="transform: translate(270px, 84px); width: 700px; height: 800px;">
              <img class="fancybox-image" src="http://via.placeholder.com/700x800">
            </div>
          </div>
        </div>
        <div class="fancybox-caption-wrap"><div class="fancybox-caption"></div></div>
      </div>
    </div>
        <!-- ///*************///////////////// -->

          <div class="col-md-12" style="border-radius: 25px;margin-bottom: 10px;display: none;" align="center">
          <div style="border-top-right-radius: 25px;border-top-left-radius: 25px;background: #1bbc9b;padding: 10px;border-top: solid 1px #000000;border-left: solid 1px #000000;border-right: solid 1px #000000;color: #ffffff;">
            Peak Pressure <?php echo $lang['MENU_Summary_combination'] ?>
          </div>
          <div style="border-bottom-right-radius: 25px;border-bottom-left-radius: 25px;border-bottom: solid 1px;border-left: solid 1px;border-right: solid 1px; padding: 10px;">
            <a style="color: #000000"  id="btn_open_lr"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $lang['MENU_Details'] ?></a>
          </div>
        </div>

        <!-- ///*************///////////////// -->
        <div class="fancybox-container fancybox-is-open fancybox-can-drag" role="dialog" tabindex="-1" id="MENU_Summary_combination" style="transition-duration: 366ms;display: none;">
          <div class="fancybox-bg"></div>
            <div class="fancybox-inner">
            <div class="fancybox-stage">
              <div class="fancybox-slide fancybox-slide--image fancybox-slide--current fancybox-slide--complete" style="">

                <div class="fancybox-image-wrap" style="transform: translate(25%,15%); width: 60%; height: 70%;">
                  <div class="fancybox-image" style="border: #fff0;">
                  <button style="float: right; padding-top: 5px;padding-bottom: 5px;padding-right: 10px;padding-left: 10px; border-radius: 50px;" id="btn_close_lr"><i class="fa fa-times-circle" aria-hidden="true"></i></button>


                <style type="text/css">
                  .table_popup td, .table_popup th {
    padding: .75rem;
    vertical-align: top;
    
}
                </style>
                  <table class="table_popup " width="90%"  style=" background: #ccc;border-radius: 25px; margin: 20px;" >
                  <thead>
    <tr>
      <th style="color: #ffffff; border-right: 1px solid #ffffff;background-color: #1bbc9b;border-top-left-radius: 25px; ">Zone</th>
      <th style="color: #ffffff; border-right: 1px solid #ffffff;background-color: #1bbc9b;">AVG</th>
      <th style="color: #ffffff; background-color: #1bbc9b;border-top-right-radius: 25px;">Max</th>
    </tr>
                  </thead>



  <tbody>
    <tr>
      <td>Toe</td>
      <td><p id="p_toe_avg"></p></td>
      <td><p id="p_toe_max"></p></td>
    </tr>
    <tr>
      <td>Medial Metatarsal</td>
      <td><p id="p_medial_metatarsal_avg"></p></td>
      <td><p id="p_medial_metatarsal_max"></p></td>
    </tr>
    <tr>
      <td>Lateral Metatarsal</td>
      <td><p id="p_lateral_metatarsal_avg"></p></td>
      <td><p id="p_lateral_metatarsal_max"></p></td>
    </tr>
    <tr>
      <td>Medial Midfoot</td>
      <td><p id="p_medial_midfoot_avg"></p></td>
      <td><p id="p_medial_midfoot_max"></p></td>
    </tr>
    <tr>
      <td>Heel</td>
      <td><p id="p_heal_avg"></p></td>
      <td><p id="p_heal_max"></p></td>
    </tr>
  </tbody>
</table>
</div>
                </div>
              </div>
              
            <div class="fancybox-caption-wrap">
              <div class="fancybox-caption">
                
              </div>
            </div>
          </div>
      </div>
    </div>

    <div class="fancybox-container fancybox-is-open fancybox-can-drag" role="dialog" tabindex="-1" id="fancybox-container-1" style="transition-duration: 366ms;display: none;">
      <div class="fancybox-bg"></div>
      <div class="fancybox-inner">
        <div class="fancybox-toolbar1" style="display: block;"><button data-fancybox-play="" class="fancybox-button fancybox-button--play" title="Start slideshow" style=""></button><button data-fancybox-fullscreen="" class="fancybox-button fancybox-button--fullscreen" title="Full screen"></button><button data-fancybox-thumbs="" class="fancybox-button fancybox-button--thumbs" title="Thumbnails" style=""></button><button data-fancybox-close="" class="fancybox-button fancybox-button--close" title="Close"></button></div>
        <div class="fancybox-stage">
          <div class="fancybox-slide fancybox-slide--image fancybox-slide--current fancybox-slide--complete" style="">
            <div class="fancybox-image-wrap" style="transform: translate(270px, 84px); width: 700px; height: 800px;">
              <img class="fancybox-image" src="http://via.placeholder.com/700x800">
            </div>
          </div>
        </div>
        <div class="fancybox-caption-wrap"><div class="fancybox-caption"></div></div>
      </div>
    </div>
        <!-- ///*************///////////////// -->

            
            
            </div>
            <div class="col-md-12" align="center">
      <div class="col-md-6 row" style="" >

        <div class="col-md-6" style="border-radius: 25px; margin-bottom: 10px;" align="center">
          <div style="border-top-right-radius: 25px;border-top-left-radius: 25px;background: #1bbc9b;padding: 10px;border-top: solid 1px #000000;border-left: solid 1px #000000;border-right: solid 1px #000000;color: #ffffff;">
            Duration
          </div>
          <div style="border-bottom-right-radius: 25px;border-bottom-left-radius: 25px;border-bottom: solid 1px;border-left: solid 1px;border-right: solid 1px; padding: 10px;">
            <span id="span_duration">0</span>
          </div>
        </div>

        <div class="col-md-6" style="border-radius: 25px; margin-bottom: 10px;" align="center">
          <div style="border-top-right-radius: 25px;border-top-left-radius: 25px;background: #1bbc9b;padding: 10px;border-top: solid 1px #000000;border-left: solid 1px #000000;border-right: solid 1px #000000;color: #ffffff;">
            Pace
          </div>
          <div style="border-bottom-right-radius: 25px;border-bottom-left-radius: 25px;border-bottom: solid 1px;border-left: solid 1px;border-right: solid 1px; padding: 10px;">
            <span id="span_pace">0 min/km.</span>
          </div>
        </div>

        <div class="col-md-6" style="border-radius: 25px;margin-bottom: 10px;" align="center">
          <div style="border-top-right-radius: 25px;border-top-left-radius: 25px;background: #1bbc9b;padding: 10px;border-top: solid 1px #000000;border-left: solid 1px #000000;border-right: solid 1px #000000;color: #ffffff;">
            Distance
          </div>
          <div style="border-bottom-right-radius: 25px;border-bottom-left-radius: 25px;border-bottom: solid 1px;border-left: solid 1px;border-right: solid 1px; padding: 10px;">
            <span id="span_distance">0 km.</span>
          </div>
        </div>

        <div class="col-md-6" style="border-radius: 25px;margin-bottom: 10px;" align="center">
          <div style="border-top-right-radius: 25px;border-top-left-radius: 25px;background: #1bbc9b;padding: 10px;border-top: solid 1px #000000;border-left: solid 1px #000000;border-right: solid 1px #000000;color: #ffffff;">
            Total Steps
          </div>
          <div style="border-bottom-right-radius: 25px;border-bottom-left-radius: 25px;border-bottom: solid 1px;border-left: solid 1px;border-right: solid 1px; padding: 10px;">
            <span id="span_total_steps">0</span>
          </div>
        </div>

        
<div class="col-md-12" align="center">
        <div class="col-md-6" style="border-radius: 25px;margin-bottom: 10px;" align="center">
          <div style="border-top-right-radius: 25px;border-top-left-radius: 25px;background: #1bbc9b;padding: 10px;border-top: solid 1px #000000;border-left: solid 1px #000000;border-right: solid 1px #000000;color: #ffffff;">
            CG Swing
          </div>
          <div style="border-bottom-right-radius: 25px;border-bottom-left-radius: 25px;border-bottom: solid 1px;border-left: solid 1px;border-right: solid 1px; padding: 10px;">
            <span id="span_CG_Swing">0</span>
          </div>
        </div>
</div>
        

      <div class="col-md-12" style="border-radius: 25px;margin-bottom: 10px;" align="center">
          <div style="border-top-right-radius: 25px;border-top-left-radius: 25px;background: #1bbc9b;padding: 10px;border-top: solid 1px #000000;border-left: solid 1px #000000;border-right: solid 1px #000000;color: #ffffff;">
            Peak Pressure <?php echo $lang['MENU_Summary_combination'] ?>
          </div>
          <div style="border-bottom-right-radius: 25px;border-bottom-left-radius: 25px;border-bottom: solid 1px;border-left: solid 1px;border-right: solid 1px; padding: 10px;">
            <div class="col-md-6">

        <ul style="width: 100%">
          
            <li>
              <a  id="peak_pressure_btn" class="row" >
                <div style="border-top-left-radius: 5px;border-bottom-left-radius: 5px;background: #1bbc9b;padding: 10px;border-top: solid 1px #000000;border-left: solid 1px #000000;border-bottom: solid 1px #000000;color: #ffffff; width: 30%; height: 40%;">
            <img src="../images/mountain.png" style="display: initial;background:#1bbc9b; width: 50%;height: 50%;">
          </div>
          <div style="border-top-right-radius: 5px;border-bottom-right-radius: 5px;background: #ffffff;padding: 10px;border-top: solid 1px #000000;border-bottom: solid 1px #000000;border-right: solid 1px #000000;color: #000000; width: 70%; height: 40%;">
             peak pressure
          </div>
               
              </a>
            </li> 

            <li>
        <a  id="peak_average_btn" class="row">
          <div style="border-top-left-radius: 5px;border-bottom-left-radius: 5px;background: #1bbc9b;padding: 10px;border-top: solid 1px #000000;border-left: solid 1px #000000;border-bottom: solid 1px #000000;color: #ffffff; width: 30%; height: 40%;">
            <img src="../images/volunteer.png" style="display: initial;background:#1bbc9b;width: 50%;height: 50%; " >
          </div>
          <div style="border-top-right-radius: 5px;border-bottom-right-radius: 5px;background: #ffffff;padding: 10px;border-top: solid 1px #000000;border-bott