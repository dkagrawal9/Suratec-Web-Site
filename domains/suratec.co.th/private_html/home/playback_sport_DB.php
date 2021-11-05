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

?>
<?php include_once 'common.php'; ?>
<link rel="stylesheet" href="../admin/plugins/sweetalert2/dist/sweetalert2.min.css">
<link rel="stylesheet" href="../bootstrap-datepicker/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="table.css">
    <script src="../admin/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
<style>
	.tablle_{
		border-top: 1px solid;
		border-bottom: 1px solid;
		background-color: #cccccc;
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
			<!--/ End Header -->
	  
			<!-- Breadcrumbs -->
			<section class="breadcrumbs overlay bg-image" style="background-image: url(../uploads/mod_central_information/<?=$pic_header['value']?>)">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<!-- Bread Title -->
							<div class="bread-title">
								<h2><?=$lang['MENU_Playback_S']?><!--Profile--></h2>
							</div>
							<!-- Bread List -->
							<ul class="bread-list" style="z-index: 0 !important;">
								<li><a href="./?index=st"><i class="fa fa-home"></i><?=$lang['MENU_HOME']?><!--Home--></a></li>
								<li class="active"><a href="playback_sport.php?playback_sport=st"><i class="fa fa-clone"></i><?=$lang['MENU_Playback_S']?><!--Profile--></a></li>
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
									<h2>หมวดหมู่บริการ</h2>
									<ul>
										<li><a onclick="newPressure_Map()" id="pressure_map_btn"><i class="fa fa-list"></i> Pressure Map</a></li>  
                    <li><a onclick="newGait_Analysis()"><i class="fa fa-handshake-o"></i> Gait Analysis</a></li>    
                    <li><a onclick="newBalance_Board()" ><i class="fa fa-gavel"></i> Balance Board</a></li>     
                    <li class="active" ><a onclick="newDasboard()" ><i class="fa fa-globe"></i> Dasboard</a></li> 				
									</ul>
								</div>
								<!--/ End Service Category -->
							</div>
							<!--/ End Service Sidebar -->
						</div>
						<div class="col-lg-9 col-12 row">

                               <div class="col-md-12">
                                     <div class="form-group">
                                             
                                                 
                                                 <input type="hidden" name="playback_type" id='playback_type' value="2">
                                                 <!-- <input type="hidden" name="id_customer" id="id_customer" value="<?php echo $id  ?>"> -->
                                                
                                                <div class="col-sm-12">
                                                    <div class='input-group date col-md-12' >
                                                        <input type='text' class="form-control" name="datetimepicker" id='datetimepicker' autocomplete="off" placeholder="วันที่" onchange="playback_time_func()" value="<?php echo $datetimepicker ?>"/>
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                    </div>
                                                 </div>

                                                 <div class="col-sm-3" style="display: none;">
                                                    <div class='input-group date col-md-12' >
                                                        <SELECT class="form-control" name="playback_time" id='playback_time'>
                                                            <option value="0">เวลา Playback</option>
                                                        </SELECT>
                                                            
                                                    </div>
                                                 </div>
                                                 
                                                  <div class="col-sm-3" style="display: none;">
                                                   
                                <button onclick=" myStopFunction()" type="button" class="btn btn-primary search_date" id="search_date"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;<?=lang('Play', 'Play')?></button>&nbsp;&nbsp;&nbsp;
                                

                            
                           
                                                  </div>
                                                
                                            </div>
                                        </div>

<div class="col-md-12 row"> 
<div class="col-md-6">
<br>
              <span>สรุป Peak Pressure  รวม ซ้าย-ขวา (%)</span>
                <div style="overflow-x:auto;">
                <table class="table" border="1">
                  <thead>
    <tr>
      <th width="50%" style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">Zone</th>
      <th width="25%" style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">AVG</th>
      <th width="25%" style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">Max</th>
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
            <div class="col-md-6" style="padding-left: 30px;" ><br><br>
              <div class="row" style="text-align: center;">
                <div class="col-lg-1 col-12"> 
                </div>
                <div class="col-lg-5 col-12" style="background: #cccccc; border-top: 1px solid; border-left: 1px solid; border-right: 1px solid;">
                  <span>Duration</span>
                </div>
                <div class="col-lg-1 col-12"> 
                </div>
                <div class="col-lg-5 col-12" style="background: #cccccc; border-top: 1px solid; border-left: 1px solid; border-right: 1px solid;">
                  <span>Pace</span>
                </div>
              </div>
              <div class="row" style="text-align: center;">
                <div class="col-lg-1 col-12"> 
                </div>
                <div class="col-lg-5 " style="border-bottom: 1px solid; border-left: 1px solid; border-right: 1px solid;">
                  <span id="span_duration">0</span>
                </div>
                <div class="col-lg-1 col-12"> 
                </div>
                <div class="col-lg-5 col-12" style="border-bottom: 1px solid; border-left: 1px solid; border-right: 1px solid;">
                  <span id="span_pace">0 min/km.</span>
                </div>
              </div><br>
              <div class="row" style="text-align: center;">
                <div class="col-lg-1 col-12"> 
                </div>
                <div class="col-lg-5 col-12" style="background: #cccccc; border-top: 1px solid; border-left: 1px solid; border-right: 1px solid;">
                  <span>Distance</span>
                </div>
                <div class="col-lg-1 col-12"> 
                </div>
                <div class="col-lg-5 col-12" style="background: #cccccc; border-top: 1px solid; border-left: 1px solid; border-right: 1px solid;">
                  <span>Total Steps</span>
                </div>
              </div>
              <div class="row" style="text-align: center;">
                <div class="col-lg-1">  
                </div>
                <div class="col-lg-5" style="border-bottom: 1px solid; border-left: 1px solid; border-right: 1px solid;">
                  <span id="span_distance">0 km.</span>
                </div>
                <div class="col-lg-1">  
                </div>
                <div class="col-lg-5" style="border-bottom: 1px solid; border-left: 1px solid; border-right: 1px solid;">
                  <span id="span_total_steps">0</span>
                </div>
              </div><br>
     
              <div class="row" style="text-align: center;">
                <div class="col-lg-1">  
                </div>
                <div class="col-lg-5" style="background: #cccccc; border-top: 1px solid; border-left: 1px solid; border-right: 1px solid;">
                  <span>Peak Pessure</span>
                </div>
                <div class="col-lg-1">  
                </div>
                <div class="col-lg-5" style="background: #cccccc; border-top: 1px solid; border-left: 1px solid; border-right: 1px solid;">
                  <span>CG Swing</span>
                </div>
              </div>
              <div class="row" style="text-align: center;">
                <div class="col-lg-1">  
                </div>
                <div class="col-lg-5" style="border-bottom: 1px solid; border-left: 1px solid; border-right: 1px solid;" >
                  <select id="zone_option" onchange="change_zone()" class="form-control">
                    <option value="Zone">Zone&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                    <option value="0">Toe</option>
                    <option value="1">Medial Metatarsal </option>
                    <option value="2">Lateral Metatarsal</option>
                    <option value="3">Medial Midfoot</option>
                    <option value="4">Heel</option>
                  </select> <br>
                  <span id="val_kps">0 KPS</span>
                </div>
                <div class="col-lg-1">  
                </div>
                <div class="col-lg-5" style="border-bottom: 1px solid; border-left: 1px solid; border-right: 1px solid;">
                  <span id="span_CG_Swing">0</span>
                </div>
              </div>
            </div>
</div>

<div class="col-md-12 row">

<div class="col-md-6">
<br>
              <span>สรุป Peak Pressure ซ้าย (%)</span>
                <div style="overflow-x:auto;">
                <table class="table" border="1">
                  <thead>
    <tr>
      <th width="50%" style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">Zone</th>
      <th width="25%" style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">AVG</th>
      <th width="25%" style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">Max</th>
    </tr>
                  </thead>
  <tbody>
    <tr>
      <td>Toe</td>
      <td><p id="p_toe_avg_left"></p></td>
      <td><p id="p_toe_max_left"></p></td>
    </tr>
    <tr>
      <td>Medial Metatarsal</td>
      <td><p id="p_medial_metatarsal_avg_left"></p></td>
      <td><p id="p_medial_metatarsal_max_left"></p></td>
    </tr>
    <tr>
      <td>Lateral Metatarsal</td>
      <td><p id="p_lateral_metatarsal_avg_left"></p></td>
      <td><p id="p_lateral_metatarsal_max_left"></p></td>
    </tr>
    <tr>
      <td>Medial Midfoot</td>
      <td><p id="p_medial_midfoot_avg_left"></p></td>
      <td><p id="p_medial_midfoot_max_left"></p></td>
    </tr>
    <tr>
      <td>Heel</td>
      <td><p id="p_heal_avg_left"></p></td>
      <td><p id="p_heal_max_left"></p></td>
    </tr>
  </tbody>
</table>
              </div>
            
</div>

<div class="col-md-6">
<br>
              <span>สรุป Peak Pressure ขวา (%)</span>
                <div style="overflow-x:auto;">
                <table class="table" border="1">
                  <thead>
    <tr>
      <th width="50%" style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">Zone</th>
      <th width="25%" style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">AVG</th>
      <th width="25%" style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">Max</th>
    </tr>
                  </thead>
  <tbody>
    <tr>
      <td>Toe</td>
      <td><p id="p_toe_avg_right"></p></td>
      <td><p id="p_toe_max_right"></p></td>
    </tr>
    <tr>
      <td>Medial Metatarsal</td>
      <td><p id="p_medial_metatarsal_avg_right"></p></td>
      <td><p id="p_medial_metatarsal_max_right"></p></td>
    </tr>
    <tr>
      <td>Lateral Metatarsal</td>
      <td><p id="p_lateral_metatarsal_avg_right"></p></td>
      <td><p id="p_lateral_metatarsal_max_right"></p></td>
    </tr>
    <tr>
      <td>Medial Midfoot</td>
      <td><p id="p_medial_midfoot_avg_right"></p></td>
      <td><p id="p_medial_midfoot_max_right"></p></td>
    </tr>
    <tr>
      <td>Heel</td>
      <td><p id="p_heal_avg_right"></p></td>
      <td><p id="p_heal_max_right"></p></td>
    </tr>
  </tbody>
</table>
              </div>
            
</div>

</div>

    <div class="col-md-12">
              
              <span>Peak Pressure เกินกว่าที่กำหนด</span>
              <div style="overflow-x:auto;">
                <table class="table" border="1">
                  <thead>
    <tr>
      <th width="30%" style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">Date Time</th>
      <th width="20%" style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">Zone</th>
      <th width="50%" style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">Peak Pressure</th>
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
<input type="hidden" name="toe_kps" id="toe_kps">
<input type="hidden" name="medial_metatarsal_kps" id="medial_metatarsal_kps">
<input type="hidden" name="lateral_metatarsal_kps" id="lateral_metatarsal_kps">
<input type="hidden" name="medial_midfoot_kps" id="medial_midfoot_kps">
<input type="hidden" name="heal_kps" id="heal_kps">

<input type="hidden" name="sex" id="sex" value="<?php echo $sex ?>">
<input type="hidden" name="height" id="height" value="<?php echo $height ?>">
 <input type="hidden" name="id_customer" id="id_customer" value="<?php echo $id_customer ?>">
<input type="hidden" name="get_time" id="get_time" value="<?php echo $playback_time ?>">
<input type="hidden" name="status_play" id="status_play" value="<?php echo $status_play?>">

			</section>
			<!--/ End Services -->

			
			<!-- Footer -->
			<?php include 'footer.php'?>
			<!--/ End footer -->
			<?php include 'footer_credit.php'?>	
		</div>
    </body>
</html>

<script src="../bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="js/jquery.redirect.js"></script>

<script type="text/javascript">
	
$(function () {
     $('#datetimepicker').datepicker({
       todayBtn: "linked",
       language: "it",
       autoclose: true,
       todayHighlight: true,
       format: 'yyyy-mm-dd'
       
   });
});


function playback_time_func(){
  id_customer =  $("#id_customer").val();  
  playback_type =  $("#playback_type").val();  
  datetimepicker =  $("#datetimepicker").val();
  get_time =  $("#get_time").val();
  console.log(id_customer+'...'+playback_type+'...'+datetimepicker)  
if (id_customer != '' && playback_type != '0' && datetimepicker!= '') {
   $.ajax({   
            url:'select_duration_dasboard.php?id_customer='+id_customer, 
            method:'POST',  
            data:{id_customer:id_customer, playback_type:playback_type, datetimepicker:datetimepicker,get_time:get_time},  
                success:function(data){  
                    console.log(data.duration_num);
                   if (data.status == '0') {
               retData=data.retData
                $("#playback_time").html(data.option); 
                $("#playback_time_table").html(data.table); 
ms = data.duration_num
if (ms=='0') {
  curtime="0:00:00";
}else{
curhr = Math.floor(ms/3600);
curmin=Math.floor(ms/60)%60;
cursec=ms%60

      if(curhr < 10){
                curhr = "0"+curhr;
            }
            if(curmin < 10 ){
                curmin = "0"+curmin;
            }
            if(cursec < 10 ){
                cursec = "0"+cursec;
            }
           
                curtime=+curhr+":"+curmin+":"+cursec;
}


                $("#span_duration").html(curtime); 
                conclude_peak_pressure(retData)
                duration_peak_pressure(retData)
                total_stepe(retData,ms)
                conclude_peak_pressure_leftright(retData)
                }else{
$("#playback_time_table").html(data.table); 
$("#span_duration").html("0:00:00"); 
//conclude_peak_pressure(retData)
$("#span_CG_Swing").html('0'); 
$("#p_toe_max").html('0'); 
$("#p_toe_avg").html('0'); 
$("#p_medial_metatarsal_max").html('0'); 
$("#p_medial_metatarsal_avg").html('0'); 
$("#p_lateral_metatarsal_max").html('0'); 
$("#p_lateral_metatarsal_avg").html('0'); 
$("#p_medial_midfoot_max").html('0'); 
$("#p_medial_midfoot_avg").html('0'); 
$("#p_heal_max").html('0'); 
$("#p_heal_avg").html('0'); 
$("#toe_kps").val('0'); 
$("#medial_metatarsal_kps").val('0'); 
$("#lateral_metatarsal_kps").val('0'); 
$("#medial_midfoot_kps").val('0'); 
$("#heal_kps").val('0'); 
//total_stepe(retData,ms)
$("#span_total_steps").html('0'); 
$("#span_distance").html('0 km.'); 
$("#span_pace").html('0 min/km.');
//conclude_peak_pressure_leftright(retData)
$("#p_toe_max_left").html('0'); 
$("#p_toe_avg_left").html('0');
$("#p_toe_max_right").html('0'); 
$("#p_toe_avg_right").html('0'); 
$("#p_medial_metatarsal_max_left").html('0'); 
$("#p_medial_metatarsal_avg_left").html('0'); 
$("#p_medial_metatarsal_max_right").html('0'); 
$("#p_medial_metatarsal_avg_right").html('0'); 
$("#p_lateral_metatarsal_max_left").html('0'); 
$("#p_lateral_metatarsal_avg_left").html('0'); 
$("#p_lateral_metatarsal_max_right").html('0'); 
$("#p_lateral_metatarsal_avg_right").html('0'); 
$("#p_medial_midfoot_max_left").html('0'); 
$("#p_medial_midfoot_avg_left").html('0'); 
$("#p_medial_midfoot_max_right").html('0'); 
$("#p_medial_midfoot_avg_right").html('0');
$("#p_heal_max_left").html('0'); 
$("#p_heal_avg_left").html('0'); 
$("#p_heal_max_right").html('0'); 
$("#p_heal_avg_right").html('0');

                }
                }, 

                   
           });
}
 
} 



function total_stepe(retData,ms){
total_stepe=0
  for (var i = 0; i < retData.length; i++) {
    for (var c = 0; c <  retData[i].left.length; c++) {

                //toe
                    sensor_left = parseInt(retData[i].left[c][0]) + parseInt(retData[i].left[c][1]) + parseInt(retData[i].left[c][2]) + parseInt(retData[i].left[c][3]) +parseInt(retData[i].left[c][4])

                    sensor_right = parseInt(retData[i].right[c][0]) + parseInt(retData[i].right[c][1]) + parseInt(retData[i].right[c][2]) + parseInt(retData[i].right[c][3]) +parseInt(retData[i].right[c][4])

                   if(sensor_left >= sensor_right) {
                    total_sensor = sensor_left -  sensor_right
                   }else{
                    total_sensor = sensor_right - sensor_left 
                   }
                    
                   if (total_sensor >= 1000) {
                    total_stepe++
                   }
                   //console.log('total_sensor'+c+'=='+total_sensor)


       

    }



                 
                }



  //console.log('total_stepe =='+total_stepe)
$("#span_total_steps").html(total_stepe); 

sex = $("#sex").val(); 
height = $("#height").val(); 
if (sex == '0') {
  distance = parseInt(height) * 0.415 * total_stepe
}else{
  distance = parseInt(height) * 0.413 * total_stepe
}
distance_km = distance/100000
$("#span_distance").html(distance_km.toFixed(2)+' km.'); 
if (ms=='0') {
  pace = 0
}else{
  pace = (ms / 60) / (distance / 1000)
}

$("#span_pace").html(pace.toFixed(2)+' min/km.'); 
}


function duration_peak_pressure(retData){
max_sensor_total=[]
  for (var i = 0; i < retData.length; i++) {


                //toe
                sensor0=0
                max_sensor0_total = []

                //Medial Metatarsal
                sensor3=0
                max_sensor3_total = []

                //Lateral Metatarsal
                sensor1=0
                max_sensor1_total = []

                //Medial Midfoot
                sensor2=0
                max_sensor2_total = []

                //Heal
                sensor4=0
                max_sensor4_total = []

    for (var c = 0; c <  retData[i].left.length; c++) {

                //toe
                    sensor0 += parseInt(retData[i].left[c][0])
                    max_sensor0_total.push(parseInt(retData[i].left[c][0]));
                    sensor0 += parseInt(retData[i].right[c][0])
                    max_sensor0_total.push(parseInt(retData[i].right[c][0]));

                    //Medial Metatarsal
                    sensor3 += parseInt(retData[i].left[c][3])
                    max_sensor3_total.push(parseInt(retData[i].left[c][3]));
                    sensor3 += parseInt(retData[i].right[c][3])
                    max_sensor3_total.push(parseInt(retData[i].right[c][3]));

                    //Lateral Metatarsal
                    sensor1 += parseInt(retData[i].left[c][1])
                    max_sensor1_total.push(parseInt(retData[i].left[c][1]));
                    sensor1 += parseInt(retData[i].right[c][1])
                    max_sensor1_total.push(parseInt(retData[i].right[c][1]));

                    //Medial Midfoot
                    sensor2 += parseInt(retData[i].left[c][2])
                    max_sensor2_total.push(parseInt(retData[i].left[c][2]));
                    sensor2 += parseInt(retData[i].right[c][2])
                    max_sensor2_total.push(parseInt(retData[i].right[c][2]));

                    //Heal
                    sensor4 += parseInt(retData[i].left[c][4])
                    max_sensor4_total.push(parseInt(retData[i].left[c][4]));
                    sensor4 += parseInt(retData[i].right[c][4])
                    max_sensor4_total.push(parseInt(retData[i].right[c][4]));

    }

//toe
max_sensor0 = Math.max.apply(Math, max_sensor0_total)  

//Medial Metatarsal
max_sensor3 = Math.max.apply(Math, max_sensor3_total)  

//Lateral Metatarsal
max_sensor1 = Math.max.apply(Math, max_sensor1_total)  

//Medial Midfoot
max_sensor2 = Math.max.apply(Math, max_sensor2_total)  

//Heal
max_sensor4 = Math.max.apply(Math, max_sensor4_total)  


max_sensor_total.push({
  toe : parseInt(max_sensor0),
  Medial_Metatarsal : parseInt(max_sensor3),
  Lateral_Metatarsal : parseInt(max_sensor1),
  Medial_Midfoot : parseInt(max_sensor2),
  Heal : parseInt(max_sensor4)});
                 
                }

for (var y = 0; y < max_sensor_total.length; y++) {
  let arr = Object.values(max_sensor_total[y]);
  let max = Math.max(...arr);
  //console.log(arr)
  zone = ''
  for (var q = 0; q < arr.length; q++) {
    //console.log(arr[q] +'==='+ max)
    
    if(arr[q] === max) {
          // console.log(q)
           if (q===0) {
             zone = 'Toe,'
           }else if (q===1) {
             zone += 'Medial Metatarsal,'
           }else if (q===2) {
             zone += 'Lateral Metatarsal,'
           }else if (q===3) {
             zone += 'Medial Midfoot,'
           }else if (q===4) {
             zone += 'Heel,'
           }
 
           
           
        }
 
  }
$("#td_duration_zone"+y).html(zone.substr(0, zone.length-1)); 
$("#td_duration_pp"+y).html(max.toFixed(2));
 
}


// console.log(max)
// console.log(max_sensor_total[0])
  

}

function conclude_peak_pressure_leftright(retData){

 // left_sensor_i = 0;

                //toe
                sensor0_left=0
                max_sensor0_total_left = []

                sensor0_right=0
                max_sensor0_total_right = []

                //Medial Metatarsal
                sensor3_left=0
                max_sensor3_total_left = []

                sensor3_right=0
                max_sensor3_total_right = []

                //Lateral Metatarsal
                sensor1_left=0
                max_sensor1_total_left = []

                sensor1_right=0
                max_sensor1_total_right = []

                //Medial Midfoot
                sensor2_left=0
                max_sensor2_total_left = []

                sensor2_right=0
                max_sensor2_total_right = []

                //Heal
                sensor4_left=0
                max_sensor4_total_left = []

                sensor4_right=0
                max_sensor4_total_right = []

               

                for (var i = 0; i < retData.length; i++) {
                  // console.log( retData.length);
                  // console.log( retData[i].left);
                  for (var c = 0; c <  retData[i].left.length; c++) {
                    //console.log(retData[i].left[c]);
                    //console.log(retData[i].right[c]);

                    //toe
                    sensor0_left += parseInt(retData[i].left[c][0])
                    max_sensor0_total_left.push(parseInt(retData[i].left[c][0]));
                    sensor0_right += parseInt(retData[i].right[c][0])
                    max_sensor0_total_right.push(parseInt(retData[i].right[c][0]));

                    //Medial Metatarsal
                    sensor3_left += parseInt(retData[i].left[c][3])
                    max_sensor3_total_left.push(parseInt(retData[i].left[c][3]));
                    sensor3_right += parseInt(retData[i].right[c][3])
                    max_sensor3_total_right.push(parseInt(retData[i].right[c][3]));

                    //Lateral Metatarsal
                    sensor1_left += parseInt(retData[i].left[c][1])
                    max_sensor1_total_left.push(parseInt(retData[i].left[c][1]));
                    sensor1_right += parseInt(retData[i].right[c][1])
                    max_sensor1_total_right.push(parseInt(retData[i].right[c][1]));

                    //Medial Midfoot
                    sensor2_left += parseInt(retData[i].left[c][2])
                    max_sensor2_total_left.push(parseInt(retData[i].left[c][2]));
                    sensor2_right += parseInt(retData[i].right[c][2])
                    max_sensor2_total_right.push(parseInt(retData[i].right[c][2]));

                    //Heal
                    sensor4_left += parseInt(retData[i].left[c][4])
                    max_sensor4_total_left.push(parseInt(retData[i].left[c][4]));
                    sensor4_right += parseInt(retData[i].right[c][4])
                    max_sensor4_total_right.push(parseInt(retData[i].right[c][4]));

                
                
                  }

}

//toe
max_sensor0_left = Math.max.apply(Math, max_sensor0_total_left)  
length_data_left = max_sensor0_total_left.length
avg_sensor0_left = sensor0_left / length_data_left ;
$("#p_toe_max_left").html(max_sensor0_left); 
$("#p_toe_avg_left").html(avg_sensor0_left.toFixed(2)); 

max_sensor0_right = Math.max.apply(Math, max_sensor0_total_right)  
length_data_right = max_sensor0_total_right.length
avg_sensor0_right = sensor0_right / length_data_right ;
$("#p_toe_max_right").html(max_sensor0_right); 
$("#p_toe_avg_right").html(avg_sensor0_right.toFixed(2)); 


//Medial Metatarsal
max_sensor3_left = Math.max.apply(Math, max_sensor3_total_left)  
length_data_left = max_sensor3_total_left.length
avg_sensor3_left = sensor3_left / length_data_left ;
$("#p_medial_metatarsal_max_left").html(max_sensor3_left); 
$("#p_medial_metatarsal_avg_left").html(avg_sensor3_left.toFixed(2)); 

max_sensor3_right = Math.max.apply(Math, max_sensor3_total_right)  
length_data_right = max_sensor3_total_right.length
avg_sensor3_right = sensor3_right / length_data_right ;
$("#p_medial_metatarsal_max_right").html(max_sensor3_right); 
$("#p_medial_metatarsal_avg_right").html(avg_sensor3_right.toFixed(2)); 

//Lateral Metatarsal
max_sensor1_left = Math.max.apply(Math, max_sensor1_total_left)  
length_data_left = max_sensor1_total_left.length
avg_sensor1_left = sensor1_left / length_data_left;
$("#p_lateral_metatarsal_max_left").html(max_sensor1_left); 
$("#p_lateral_metatarsal_avg_left").html(avg_sensor1_left.toFixed(2)); 

max_sensor1_right = Math.max.apply(Math, max_sensor1_total_right)  
length_data_right = max_sensor1_total_right.length
avg_sensor1_right = sensor1_right / length_data_right ;
$("#p_lateral_metatarsal_max_right").html(max_sensor1_right); 
$("#p_lateral_metatarsal_avg_right").html(avg_sensor1_right.toFixed(2)); 


//Medial Midfoot
max_sensor2_left = Math.max.apply(Math, max_sensor2_total_left)  
length_data_left = max_sensor2_total_left.length
avg_sensor2_left = sensor2_left / length_data_left ;
$("#p_medial_midfoot_max_left").html(max_sensor2_left); 
$("#p_medial_midfoot_avg_left").html(avg_sensor2_left.toFixed(2)); 

max_sensor2_right = Math.max.apply(Math, max_sensor2_total_right)  
length_data_right = max_sensor2_total_right.length
avg_sensor2_right = sensor2_right / length_data_right ;
$("#p_medial_midfoot_max_right").html(max_sensor2_right); 
$("#p_medial_midfoot_avg_right").html(avg_sensor2_right.toFixed(2)); 


//Heal
max_sensor4_left = Math.max.apply(Math, max_sensor4_total_left)  
length_data_left = max_sensor4_total_left.length
avg_sensor4_left = sensor4_left / length_data_left ;
$("#p_heal_max_left").html(max_sensor4_left); 
$("#p_heal_avg_left").html(avg_sensor4_left.toFixed(2)); 

max_sensor4_right = Math.max.apply(Math, max_sensor4_total_right)  
length_data_right = max_sensor4_total_right.length
avg_sensor4_right = sensor4_right / length_data_right ;
$("#p_heal_max_right").html(max_sensor4_right); 
$("#p_heal_avg_right").html(avg_sensor4_right.toFixed(2));






}


function conclude_peak_pressure(retData){

 // left_sensor_i = 0;

                //toe
                sensor0=0
                max_sensor0_total = []

                //Medial Metatarsal
                sensor3=0
                max_sensor3_total = []

                //Lateral Metatarsal
                sensor1=0
                max_sensor1_total = []

                //Medial Midfoot
                sensor2=0
                max_sensor2_total = []

                //Heal
                sensor4=0
                max_sensor4_total = []

                //CG Swing
                xy_right_total = 0;

                for (var i = 0; i < retData.length; i++) {
                  // console.log( retData.length);
                  // console.log( retData[i].left);
                  for (var c = 0; c <  retData[i].left.length; c++) {
                    //console.log(retData[i].left[c]);
                    //console.log(retData[i].right[c]);

                    //toe
                    sensor0 += parseInt(retData[i].left[c][0])
                    max_sensor0_total.push(parseInt(retData[i].left[c][0]));
                    sensor0 += parseInt(retData[i].right[c][0])
                    max_sensor0_total.push(parseInt(retData[i].right[c][0]));

                    //Medial Metatarsal
                    sensor3 += parseInt(retData[i].left[c][3])
                    max_sensor3_total.push(parseInt(retData[i].left[c][3]));
                    sensor3 += parseInt(retData[i].right[c][3])
                    max_sensor3_total.push(parseInt(retData[i].right[c][3]));

                    //Lateral Metatarsal
                    sensor1 += parseInt(retData[i].left[c][1])
                    max_sensor1_total.push(parseInt(retData[i].left[c][1]));
                    sensor1 += parseInt(retData[i].right[c][1])
                    max_sensor1_total.push(parseInt(retData[i].right[c][1]));

                    //Medial Midfoot
                    sensor2 += parseInt(retData[i].left[c][2])
                    max_sensor2_total.push(parseInt(retData[i].left[c][2]));
                    sensor2 += parseInt(retData[i].right[c][2])
                    max_sensor2_total.push(parseInt(retData[i].right[c][2]));

                    //Heal
                    sensor4 += parseInt(retData[i].left[c][4])
                    max_sensor4_total.push(parseInt(retData[i].left[c][4]));
                    sensor4 += parseInt(retData[i].right[c][4])
                    max_sensor4_total.push(parseInt(retData[i].right[c][4]));

                    //CG Swing  xy_right_total = 0;

                    balance_Y  = ((parseInt(retData[i].left[c][0])+parseInt(retData[i].left[c][1])+parseInt(retData[i].left[c][2])) / 3) - parseInt(retData[i].left[c][4])
                    balance_X = parseInt(retData[i].left[c][2]) - parseInt(retData[i].left[c][3])
                    y = (balance_Y / 850) * 142.5
                    x = (balance_X / 850) * 142.5
                    x1 = x+142.5
                    y1 = y+142.5
                    xy_left = ((142.5 - x1) * (142.5 - x1) + (142.5 - y1) * (142.5 - y1))
                    xy_left_1 = Math.sqrt(xy_left)

                    balance_Y_right  = ((parseInt(retData[i].right[c][0])+parseInt(retData[i].right[c][1])+parseInt(retData[i].right[c][2])) / 3) - parseInt(retData[i].right[c][4])
                    balance_X_right = parseInt(retData[i].right[c][2]) - parseInt(retData[i].right[c][3])
                    y_right = (balance_Y_right / 850) * 142.5
                    x_right = (balance_X_right / 850) * 142.5
                    x1_right = x_right+142.5
                    y1_right = y_right+142.5
                    xx= (x1 + x1_right) / 2
                    yy =(y1 + y1_right ) /2
                    xy_right = ((142.5 - x1_right) * (142.5 - x1_right) + (142.5 - y1_right) * (142.5 - y1_right))
                    xy_right_1 = Math.sqrt(xy_right)

                    xy_sqrt = (xy_left_1+xy_right_1) / 2
                    //console.log('xy_sqrt='+xy_sqrt)
                    xy_right_total = xy_sqrt + xy_right_total;
                    xy_right_total1=xy_right_total/c
                    $("#span_CG_Swing").html(xy_right_total1.toFixed(2)); 


                    

                
                  }

}
// console.log(max_sensor0_total.length)
// console.log(left_sensor0+'/'+left_sensor0_i +'='+left_sensor0/left_sensor0_i)

//toe
max_sensor0 = Math.max.apply(Math, max_sensor0_total)  
length_data = max_sensor0_total.length
avg_sensor0 = sensor0 / length_data ;
$("#p_toe_max").html(max_sensor0); 
$("#p_toe_avg").html(avg_sensor0.toFixed(2)); 


//Medial Metatarsal
max_sensor3 = Math.max.apply(Math, max_sensor3_total)  
length_data = max_sensor3_total.length
avg_sensor3 = sensor3 / length_data ;
$("#p_medial_metatarsal_max").html(max_sensor3); 
$("#p_medial_metatarsal_avg").html(avg_sensor3.toFixed(2)); 


//Lateral Metatarsal
max_sensor1 = Math.max.apply(Math, max_sensor1_total)  
length_data = max_sensor1_total.length
avg_sensor1 = sensor1 / length_data ;
$("#p_lateral_metatarsal_max").html(max_sensor1); 
$("#p_lateral_metatarsal_avg").html(avg_sensor1.toFixed(2)); 


//Medial Midfoot
max_sensor2 = Math.max.apply(Math, max_sensor2_total)  
length_data = max_sensor2_total.length
avg_sensor2 = sensor2 / length_data ;
$("#p_medial_midfoot_max").html(max_sensor2); 
$("#p_medial_midfoot_avg").html(avg_sensor2.toFixed(2)); 


//Heal
max_sensor4 = Math.max.apply(Math, max_sensor4_total)  
length_data = max_sensor4_total.length
avg_sensor4 = sensor4 / length_data ;
$("#p_heal_max").html(max_sensor4); 
$("#p_heal_avg").html(avg_sensor4.toFixed(2)); 

//kps
toe_kps =  ((5.6 * 10 ** -4) * Math.exp(parseInt(max_sensor0_total) / 53.36) + 6.72) / 0.796
medial_metatarsal_kps =  ((5.6 * 10 ** -4) * Math.exp(parseInt(max_sensor3_total) / 53.36) + 6.72) / 0.796
lateral_metatarsal_kps =  ((5.6 * 10 ** -4) * Math.exp(parseInt(max_sensor1_total) / 53.36) + 6.72) / 0.796
medial_midfoot_kps =  ((5.6 * 10 ** -4) * Math.exp(parseInt(max_sensor2_total) / 53.36) + 6.72) / 0.796
heal_kps =  ((5.6 * 10 ** -4) * Math.exp(parseInt(max_sensor4_total) / 53.36) + 6.72) / 0.796

//console.log(toe_kps)
$("#toe_kps").val(toe_kps.toFixed(2)); 
$("#medial_metatarsal_kps").val(medial_metatarsal_kps.toFixed(2)); 
$("#lateral_metatarsal_kps").val(lateral_metatarsal_kps.toFixed(2)); 
$("#medial_midfoot_kps").val(medial_midfoot_kps.toFixed(2)); 
$("#heal_kps").val(heal_kps.toFixed(2)); 




}



function change_zone(){
zone_option = $("#zone_option").val(); 
//console.log(zone_option)
if (zone_option=='0') {
  $("#val_kps").html(toe_kps.toFixed(2)+' KPS'); 
}else if (zone_option=='1') {
  $("#val_kps").html(medial_metatarsal_kps.toFixed(2)+' KPS'); 
}else if (zone_option=='2') {
  $("#val_kps").html(lateral_metatarsal_kps.toFixed(2)+' KPS'); 
}else if (zone_option=='3') {
  $("#val_kps").html(medial_midfoot_kps.toFixed(2)+' KPS'); 
}else if (zone_option=='4') {
  $("#val_kps").html(heal_kps.toFixed(2)+' KPS'); 
}else{
  $("#val_kps").html('0 KPS'); 
}
}



 $(document).on('click','#search_date',function(){
  $("#show_data").html(''); 
  playback_time =  $("#playback_time").val(); 


    // var playback_time_arr = [playback_time];
    // console.log(playback_time_arr) 
playback_left_right = playback_time.split("/");

playback_time_arr_left = playback_left_right[0].split("***");
     playback_time_arr = playback_left_right[0].split("***");
     // fruits = [];
     // for (var i = 0; i < playback_time_arr.length; i++) {
     //   playback_time_arr1 = playback_time_arr[i].split(",");
     //   var playback_time_arr2 = [playback_time_arr1];
       
     //   fruits.push(playback_time_arr2);
     // }
     // console.log(playback_time_arr) 


     playback_time_arr_right = playback_left_right[1].split("***");
     playback_time_arr = playback_left_right[1].split("***");
     // fruits = [];
     // for (var i = 0; i < playback_time_arr.length; i++) {
     //   playback_time_arr1 = playback_time_arr[i].split(",");
     //   var playback_time_arr2 = [playback_time_arr1];
       
     //   fruits.push(playback_time_arr2);
     // }
     // console.log(playback_time_arr_left.length)
     // console.log(playback_time_arr_right)

//for (var i = 0; i < playback_time_arr_left.length; i++) {
  //////ซ้าย/////
  ileft=0;
  xy_left_total=0;

         var setleft = setInterval(function (t) {
          // console.log(playback_time_arr_left.length)
          // console.log(playback_time_arr_right[ileft])
          $("#p_time").html(ileft+' s'); 



           data_test = playback_time_arr_left[ileft];
           data_test2 = data_test.split(",");
           data_test3=[];
           //data_test3=parseInt(data_test2[0])
           for (var i = 0; i < data_test2.length; i++) {
             // data_test3[]=println(data_test2[1])
             data_test3.push(parseInt(data_test2[i]));
           }

        balance_Y  = ((data_test3[0]+data_test3[1]+data_test3[2]) / 3) - data_test3[4]
        balance_X = data_test3[2] - data_test3[1] 
        y = (balance_Y / 850) * 142.5
        x = (balance_X / 850) * 142.5
        x1 = x+142.5
        y1 = y+142.5
        //ppp_left(x1,y1)
        //console.log(x1+','+y1)

xy_left = ((142.5 - x1) * (142.5 - x1) + (142.5 - y1) * (142.5 - y1))
xy_left_1 = Math.sqrt(xy_left)
// console.log('รูทซ้าย'+xy_left_1)
// if (xy_left_1<=28.5  ) {
//   $("#p_text_left").html('ดี')
// }else if (xy_left_1>28.5 && xy_left_1<=114){
//   $("#p_text_left").html('ปานกลาง')
// }else{
//   $("#p_text_left").html('พอใช้')
// }
xy_left_total = xy_left_1 + xy_left_total;
xy_left_total1=xy_left_total/(ileft+1)
        $("#p_left").html(xy_left_total.toFixed(2)); 
         // console.log(data_test3)

          var data_test1 = [0,0,0,0,364];
          // console.log(data_test1)
    values = findLeftContourArray(   
      data_test3
    )

      
    ileft++
    if (ileft==playback_time_arr_left.length) {
      clearInterval(setleft)
    }

      contours
        .thresholds (d3.range(0, 600, 50))
        (values)
        .forEach(fill);
  }, 1000)
//////ซ้าย/////

//////ขวา/////
iright=0;
xy_right_total = 0;
  var setright = setInterval(function (ttr) {
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
       // console.log(x1_right+','+y1_right)

        xy_right = ((142.5 - x1_right) * (142.5 - x1_right) + (142.5 - y1_right) * (142.5 - y1_right))
xy_right_1 = Math.sqrt(xy_right)
// console.log('รูทขวา'+xy_right_1)
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
// console.log('xy_right_total='+xy_right_1+'+'+xy_right_total)
// console.log(xy_right_total)
xy_right_total1=xy_right_total/(iright+1)
// console.log(xy_right_total1)
        $("#p_right").html(xy_right_total1.toFixed(2)); 

      valuesright = findRightContourArray(
        data_test3right
      )
iright++
    if (iright==playback_time_arr_right.length) {
      clearInterval(setright)
    }

      contoursr
        .thresholds(d3.range(0, 600, 50))
        (valuesright)
        .forEach(fillr);
    }, 1000)       
//////ขวา/////
// }        
//for (var i = 0; i < playback_time_arr_left.length; i++) {
       // $.ajax({   
       //      url:'select_playback_sport.php?id_customer='+id_customer, 
       //      method:'POST',  
       //      data:{fruits:fruits,playback_time_arr_left:playback_time_arr_left,playback_time_arr_right:playback_time_arr_right},  
       //          success:function(data){  
       //              //console.log(response.data[0]['path_slip']);
               
       //          $("#show_data").html(data); 
               
       //          }, 

                   
       //     });

// if (i==5) {
//   clearInterval(setleft);
//   clearInterval(setright);
// }
  //    }

})

</script>
  
<script type="text/javascript">
  function conclude_peak_pressure_test(retData){
  
  left_sensor_i = 0;

                //toe
                left_sensor0=0
                max_left_sensor0_total = []
                right_sensor0=0
                max_right_sensor0_total = []

                //Medial Metatarsal
                left_sensor3=0
                max_left_sensor3_total = []

                //Lateral Metatarsal
                left_sensor1=0
                max_left_sensor1_total = []

                //Medial Midfoot
                left_sensor2=0
                max_left_sensor2_total = []

                //Heal
                left_sensor4=0
                max_left_sensor4_total = []

                for (var i = 0; i < retData.length; i++) {
                  // console.log( retData.length);
                  // console.log( retData[i].left);
                  for (var c = 0; c <  retData[i].left.length; c++) {
                    // console.log(retData[i].left[c]);
                    left_sensor0 += parseInt(retData[i].left[c][0])
                    max_left_sensor0_total.push(parseInt(retData[i].left[c][0]));

                    // console.log(retData[i].right[c]);
                    right_sensor0 += parseInt(retData[i].right[c][0])
                    max_right_sensor0_total.push(parseInt(retData[i].right[c][0]));

                    left_sensor_i++;
                  }

                  // for (var c = 0; c <  retData[i].right.length; c++) {
                  //   console.log(retData[i].right[c]);
                  //   left_sensor0 += parseInt(retData[i].right[c][0])
               
                   
                  //   max_left_sensor0_total.push(parseInt(retData[i].right[c][0]));

                  //   left_sensor_i++;
                  // }
                  
                }
 max_left_sensor0 = Math.max.apply(Math, max_left_sensor0_total) 
 max_right_sensor0 = Math.max.apply(Math, max_left_sensor0_total) 

// console.log(max_left_sensor0_total)
// console.log(max_left_sensor0)
//                 console.log(left_sensor0+'/'+left_sensor0_i +'='+left_sensor0/
// left_sensor0_i)

// $("#p_toe_max").html(data.option); 
// $("#p_toe_avg").html(data.table); 

}

function newPressure_Map() {
  id_customer =  $("#id_customer").val();  
  playback_type =  $("#playback_type").val();  
  datetimepicker =  $("#datetimepicker").val();  
  playback_time =  $("#playback_time").val();  
  $.redirect("playback_sport.php?id_customer="+id_customer, {playback_type: playback_type, datetimepicker: datetimepicker, playback_time: playback_time}, "POST", ""); 
}

function newGait_Analysis() {
  id_customer =  $("#id_customer").val();  
  playback_type =  $("#playback_type").val();  
  datetimepicker =  $("#datetimepicker").val();  
  playback_time =  $("#playback_time").val();  
  $.redirect("playback_sport_GA.php?id_customer="+id_customer, {playback_type: playback_type, datetimepicker: datetimepicker, playback_time: playback_time}, "POST", ""); 
}
function newBalance_Board() {
  id_customer =  $("#id_customer").val();  
  playback_type =  $("#playback_type").val();  
  datetimepicker =  $("#datetimepicker").val();  
  playback_time =  $("#playback_time").val();  
  $.redirect("playback_sport_BB.php?id_customer="+id_customer, {playback_type: playback_type, datetimepicker: datetimepicker, playback_time: playback_time}, "POST", ""); 
}
function newDasboard() {
  id_customer =  $("#id_customer").val();  
  playback_type =  $("#playback_type").val();  
  datetimepicker =  $("#datetimepicker").val();  
  playback_time =  $("#playback_time").val();  
  $.redirect("playback_sport_DB.php?id_customer="+id_customer, {playback_type: playback_type, datetimepicker: datetimepicker, playback_time: playback_time}, "POST", ""); 
}


function function_play() {
  id_customer =  $("#id_customer").val();  
  playback_type =  $("#playback_type").val();  
  datetimepicker =  $("#datetimepicker").val();  
  playback_time =  $("#playback_time").val();  
  $.redirect("playback_sport_DB.php?id_customer="+id_customer, {playback_type: playback_type, datetimepicker: datetimepicker, playback_time: playback_time, status_play: '1'}, "POST", ""); 
}



playback_time_func();
</script>