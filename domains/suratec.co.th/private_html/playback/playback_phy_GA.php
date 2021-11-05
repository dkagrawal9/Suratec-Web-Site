<?php 
  require_once '../admin/library/connect.php';
  require_once '../admin/library/functions.php';
  checkMemUser($objConnect);
?>
<?php include 'header.php'
?>
<?php

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 



$id_customer = $_SESSION['id_customer'];

$sqlpro = "SELECT   *,mod_customer.telephone AS telephone ,mod_customer.id_customer AS id_customer, mod_customer.fname AS fname, mod_customer.lname AS lname FROM  mod_customer 
LEFT JOIN tbl_member ON mod_customer.id_customer = tbl_member.id_data_role
LEFT JOIN  mod_customer_address ON mod_customer_address.id_customer = mod_customer.id_customer
WHERE  mod_customer.id_customer = '$id_customer' ";

 //echo $sqlpro;

$queryPro = mysqli_query($objConnect, $sqlpro);
$resultPro = mysqli_fetch_array($queryPro);

// var_dump($_SESSION);


?>
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

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.7.0/c3.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="./js/apex/apexcharts.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  <script src="./js/apex/apexcharts.min.js"></script>

	<link rel="stylesheet" href="../admin/plugins/sweetalert2/dist/sweetalert2.min.css">
	    <!-- bootstrap datepicker -->
  
	<link rel="stylesheet" href="table.css">
<link rel="stylesheet" href="../admin/plugins/sweetalert2/dist/sweetalert2.min.css">
    <script src="../admin/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
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
</script>			<!--/ End Header -->
	<style>
	.swal2-popup{
		font-size: 1rem;
	}

  .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
    background: #00efb8 !important;
  }
  .ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active {
    background: #ffffff !important;
    border: solid 1px #00efb8 !important;
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
							<ul class="bread-list" style="position: unset;">
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
                    <li class="active"><a onclick="newGait_Analysis()"><img style="display: initial;" src="../../img/bg-img/line-chart.png">&nbsp; <?php echo $lang['MENU_Gait_Analysis'] ?></a></li>    
                    <li><a onclick="newBalance_Board()" ><img style="display: initial;" src="../../img/bg-img/dot-and-circle.png">&nbsp; <?php echo $lang['MENU_Balance_Board'] ?></a></li>     
                    <li><a onclick="newDasboard()" ><img style="display: initial;" src="../../img/bg-img/ui.png">&nbsp; <?php echo $lang['MENU_Dasboard'] ?></a></li> 
									</ul>
								</div>
								<!--/ End Service Category -->
							</div>
							<!--/ End Service Sidebar -->
						</div>
						<div class="col-lg-9 col-12">
						<div class="col-md-12">

							<div class="row">
                                                 <div class="col-sm-0">
                                                    <div class='input-group date col-md-12'>
                                                        <SELECT class="form-control" name="playback_type" style="display: none;" id='playback_type' onchange="playback_time_func()">
                                                            <option value="0"><?php echo $lang['MENU_type'] ?> Playback</option>
                                                            <option value="1" selected><?php echo $lang['MENU_Medical'] ?></option>
                                                            <option value="2"><?php echo $lang['MENU_Sports'] ?></option>
                                                        </SELECT>  
                                                    </div>
                                                 </div>
                                                
                                                <div class="col-sm-3">
                                                    <div class='input-group date col-md-12' >
                                                        <input type='text' class="form-control" name="datetimepicker" id='datetimepicker' autocomplete="off" placeholder="<?php echo $lang['MENU_date'] ?>" onchange="playback_time_func()" value="<?php echo $datetimepicker ?>"/>
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                    </div>
                                                 </div>

                                                 <div class="col-sm-3">
                                                    <div class='input-group date col-md-12' >
                                                        <SELECT class="form-control" name="playback_time" id='playback_time'>
                                                            <option value="0"><?php echo $lang['MENU_Time']  ?> Playback</option>
                                                        </SELECT>
                                                            
                                                    </div>
                                                 </div>
                                                 
                                                  <div class="col-sm-3">
                                                   <p style="text-align: left;margin-top:-24px"><?php echo $lang['MENU_speed'] ?></p>
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
                                <!-- <button onclick="function_play()" type="button" class="btn btn-primary search_date" id="search_date">
                                  <span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;<?php echo $lang['MENU_Play'] ?>
                                </button>&nbsp;&nbsp;&nbsp; -->
                                                  </div>
                                        </div>
								</div>
								<div class="col-md-12" style="padding-top: 20px;">
									<div class="row">
			
						<!-- <div class="col-lg-6 col-12" align="center">				 -->
<!-- Create a div where the graph will take place -->
						<!-- <i class="fa fa-info-circle" style="color: #0998CC"></i> <?php echo $lang['MENU_Left_foot'] ?>Insoles left -->
							<!-- <div id="chart_left"></div>
						</div>	 -->
						<!-- <div class="col-lg-6 col-12" align="center"> -->
<!-- Create a div where the graph will take place -->
						<!-- <i class="fa fa-info-circle" style="color: #0998CC"></i> <?php echo $lang['MENU_right_foot'] ?>Insoles right -->
						<!-- <div id="chart_right"></div>
							</div> -->
                  </div>
                  
                  <div class="row">
                  <div class="col-lg-6 col-12" align="center">				
<!-- Create a div where the graph will take place -->
						<i class="fa fa-info-circle" style="color: #0998CC"></i> <?php echo $lang['MENU_Left_foot'] ?><!--Insoles left-->
							<div id="chart_left2"></div>
						</div>	
						<div class="col-lg-6 col-12" align="center">
<!-- Create a div where the graph will take place -->
						<i class="fa fa-info-circle" style="color: #0998CC"></i> <?php echo $lang['MENU_right_foot'] ?><!--Insoles right-->
						<div id="chart_right2"></div>
							</div>
                  </div>
                  
                  <div class="row">
          <div class="col-lg-6 col-md-6 col-6 offset-md-3 mt-4"> 
             <img src="../img/icons/play-button.png" id="play_btn"  />
      
      <div id="js-example-change-value">
    <input id="range_slider" type="range" min="0" value="0" data-rangeSlider style="display: none;">
    <output></output>
</div>
</div>
  </div>
								</div>
							</div>
						</div>
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
		</div>
    </body>
</html>

<script src="../admin/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- bootstrap datepicker -->
    <script type="text/javascript" src="jquerydatepicker/jquery-ui.min.js"></script>
    <!-- date-range-picker -->
    <script src="../admin/bower_components/moment/min/moment-with-locales.min.js"></script>
    <!-- <script src="js/front-manage-attr.js"></script> -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="../admin/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
    			
					
					
</body>
</html>
<script src="//cdnjs.cloudflare.com/ajax/libs/d3/3.5.6/d3.min.js"></script>
<script src="//d3js.org/d3.v3.min.js"></script>
<script src="https://d3js.org/d3.v4.min.js"></script>
<script src="https://d3js.org/d3-hsv.v0.1.min.js"></script>
<script src="https://d3js.org/d3-contour.v1.min.js"></script>
<script src="kign.js"></script>
<!-- Load d3.js -->
<script src="https://d3js.org/d3.v4.js"></script>

<!-- Color scale -->
<script src="https://d3js.org/d3-scale-chromatic.v1.min.js"></script>

<script src="//d3js.org/d3.v3.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/c3/0.4.16/c3.js"></script>
<script type="text/javascript" src="js/jquery.redirect.js"></script>

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
<script type="text/javascript">

date_chart_left_apex = [[], [], [], [], []];
date_chart_right_apex = [[], [], [], [], []];
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
//  console.log(playback_type)  
if (id_customer != '' && playback_type != '0' && datetimepicker!= '') {
   $.ajax({   
            url:'test_time.php?id_customer='+id_customer, 
            method:'POST',  
            data:{id_customer:id_customer, playback_type:playback_type, datetimepicker:datetimepicker,get_time:get_time},  
                success:function(data){  
                   // console.log(data);
               
                $("#playback_time").html(data); 

                status_play =  $("#status_play").val();  
                if (status_play=='1') {
                  search_date();
                }

                }, 

                   
           });
}
 
}


  var margin = {top: 10, right: 10, bottom: 80, left: 15},
    width = 460 - margin.left - margin.right,
    height = 400 - margin.top - margin.bottom;

// append the svg object to the body of the page
// var svg = d3.select("#my_datavizleft")
//   .append("svg")
//     .attr("width", width + margin.left + margin.right)
//     .attr("height", height + margin.top + margin.bottom)
//     .append("g")
//     .attr("transform",
//           "translate(" + margin.left + "," + margin.top + ")");
  
// //Read the data
// d3.csv("https://raw.githubusercontent.com/holtzy/data_to_viz/master/Example_dataset/3_TwoNumOrdered_comma.csv",

//   // When reading the csv, I must format variables:
//   function(d){
//     return { date : d3.timeParse("%Y-%m-%d")(d.date), value : d.value }
//   },

//   // Now I can use this dataset:
//   function(data) {

//     // Add X axis --> it is a date format
//     var x = d3.scaleTime()
//       .domain(d3.extent(data, function(d) { return d.date; }))
//       .range([ 0, width ]);
//     svg.append("g")
//       .attr("transform", "translate(0," + height + ")")
//       .call(d3.axisBottom(x));

//     // Add Y axis
//     var y = d3.scaleLinear()
//       .domain([0, d3.max(data, function(d) { return +d.value; })])
//       .range([ height, 0 ]);
//     svg.append("g")
//       .call(d3.axisLeft(y));

//     // Add the area
//     svg.append("path")
//       .datum(data)
//       .attr("fill", "#cce5df")
//       .attr("stroke", "#69b3a2")
//       .attr("stroke-width", 1.5)
//       .attr("d", d3.area()
//         .x(function(d) { return x(d.date) })
//         .y0(y(0))
//         .y1(function(d) { return y(d.value) })
//         )
  
  /////////////////////////////////////////////////////////////////////Left//////////////////////////////////////////////
// })
  
// var svg2 = d3.select("#my_datavizright")
// .append("svg")
//     .attr("width", width + margin.left + margin.right)
//     .attr("height", height + margin.top + margin.bottom)
//     .append("g")
//     .attr("transform",
//           "translate(" + margin.left + "," + margin.top + ")");
  
//   //Read the data
// d3.csv("data_ga.json",

//     // When reading the csv, I must format variables:
//   function(d1){
    
//    // console.log(d)
//     return { date : d3.timeParse("%Y-%m-%d")(d1.date), value : d1.value }
//   },

//     // Now I can use this dataset:
//   function(data) {
//  console.log(data)
// // data =[
// // {date: "2020-02-21 15.25.01", value: "777.51"},
// // {date: "2020-02-21 15.25.02", value: "747.06"},
// // {date: "2020-02-21 15.25.03", value: "748.61"},
// // {date: "2020-02-21 15.25.04", value: "766.6"},
// // {date: "2020-02-21 15.25.05", value: "760.58"}
// // ]
// //console.log(data)
//     // Add X axis --> it is a date format
//     var x = d3.scaleTime()
//       .domain(d3.extent(data, function(d) { return d.date; }))
//       .range([ 0, width ]);
//     svg2.append("g")
//       .attr("transform", "translate(0," + height + ")")
//       .call(d3.axisBottom(x));

//     // Add Y axis
//     var y = d3.scaleLinear()
//       .domain([0, d3.max(data, function(d) { return +d.value; })])
//       .range([ height, 0 ]);
//     svg2.append("g")
//       .call(d3.axisLeft(y));

//     // Add the area
//     svg2.append("path")
//       .datum(data)
//       .attr("fill", "#cce5df")
//       .attr("stroke", "#69b3a2")
//       .attr("stroke-width", 1.5)
//       .attr("d", d3.area()
//         .x(function(d) { return x(d.date) })
//         .y0(y(0))
//         .y1(function(d) { return y(d.value) })
//         )

//   /////////////////////////////////////////////////////////////////////Right//////////////////////////////////////////////
// })


var speed = 1;
$(document).on("change", "#playback_speed", function(){
  speed = $(this).val();
});

 function search_date(){
  $("#show_data").html(''); 
  playback_time =  $("#playback_time").val(); 

  playback_left_right = playback_time.split("/");

  playback_time_arr_left = playback_left_right[0].split("***");
  playback_time_arr_right = playback_left_right[1].split("***");
  // console.log(playback_time_arr_left)
  // console.log(playback_time_arr_left.length)

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

  $('#range_slider')[0].rangeSlider.update({min: 0,
    max: playback_time_arr_left[playback_time_arr_left.length-1].split(',')[5],
  step: 1});
  //////ซ้าย/////
  // ileft=0;
  // xy_left_total=0;
  ileft=sliderValLeft?sliderValLeft:0;
  xy_right_total=0;
  sum_val_senser_left=0;
  sliderValLeft = 0;

  setleft = setInterval(setLeftGait, interval_left/speed);
//////ซ้าย/////

//////ขวา/////
  // iright=0;
  // xy_right_total = 0;
  iright=sliderValRight?sliderValRight:0;;
  sliderValRight = 0;
  sum_val_senser_right=0;
    
  setright = setInterval(setRightGait, interval_right/speed);      
//////ขวา/////

}

function setLeftGait(){
  if(!isPaused) {
    data_test = playback_time_arr_left[ileft];
    data_test2 = data_test.split(",");
    data_test3=[];
  
    for (var i = 0; i < data_test2.length; i++) {
      data_test3.push(parseInt(data_test2[i]));
    }    

    Fweight = (data_test3[1]+data_test3[2]) / 2
    Mweight = data_test3[3]
    Hweight = data_test3[4]
    Sumweight = (Fweight + Mweight + Hweight ) / 3
    data_time = data_test3[5]
    
    inputRange.value = data_test3[5];
    inputRange.dispatchEvent(new Event('change'));
    
    ileft = sliderValLeft?sliderValLeft:ileft+1
    sliderValLeft = 0;
    sum_val_senser_left = data_test3[0]+data_test3[1]+data_test3[2]+data_test3[3]+data_test3[4];
    playback_time_left_num = playback_time_arr_left.length
    // persent_left = (sum_val_senser_left / sum_sense ) * 100;
    if (ileft==playback_time_arr_left.length) {
      isPaused = true;
      firstTimePlay = true;
      clearInterval(setleft)
      $('#play_btn').attr('src',isPaused? '../img/icons/play-button.png':'../img/icons/pause.png');

      // $('#persent_left').html(persent_left.toFixed( 2 )+"%");
    }else{

      isPaused = false;

      // $('#persent_left').html(persent_left.toFixed( 2 )+"%");
      $("#play_btn").attr('src', isPaused? '../img/icons/play-button.png':'../img/icons/pause.png');
    }
    chart_add_data_left_apex(Fweight,Mweight,Hweight,Sumweight,data_time)

      
    if( interval_left !== (speed*1000)){
      clearInterval(setleft)
      if(!isPaused){
        console.log("interval_left/speed", interval_left/speed);
        setleft = setInterval(setLeftGait, interval_left/speed);
      }  
    } 

  }
}

function setRightGait(){
  if(!isPaused) {
    data_testright = playback_time_arr_right[iright];
    data_test2right = data_testright.split(",");
    data_test3right=[];
    for (var i = 0; i < data_test2right.length; i++) {
      data_test3right.push(parseInt(data_test2right[i]));
    }
    Fweight = (data_test3right[1]+data_test3right[2]) / 2
    Mweight = data_test3right[3]
    Hweight = data_test3right[4]
    Sumweight = (Fweight + Mweight + Hweight ) / 3
    data_time = data_test3right[5]
    
    iright = sliderValRight?sliderValRight: iright+1;
    sliderValRight = 0
    sum_val_senser_right = data_test3right[0]+data_test3right[1]+data_test3right[2]+data_test3right[3]+data_test3right[4];
  //console.log("รวมที่แสดง = "+sum_val_senser_right)
    playback_time_right_num = playback_time_arr_right.length
    // persent_right = (sum_val_senser_right / sum_sense ) * 100;

    if (iright==playback_time_arr_right.length) {
      isPaused = true;
      firstTimePlay = true;
      clearInterval(setright)
      // $('#persent_right').html(persent_right.toFixed( 2 )+"%");
      $('#play_btn').attr('src',isPaused? '../img/icons/play-button.png':'../img/icons/pause.png');

    }else{
      isPaused = false;
      // $('#persent_right').html(persent_right.toFixed( 2 )+"%");
      $('#play_btn').attr('src',isPaused? '../img/icons/play-button.png':'../img/icons/pause.png');

    }

    chart_add_data_right_apex(Fweight,Mweight,Hweight,Sumweight,data_time)

    if( interval_right !== (speed*1000)){
      clearInterval(setright)
      if(!isPaused){
        setright = setInterval(setRightGait, interval_right/speed);
      }  
    }
  } 
}

 function myStopFunction() {

  if(typeof(setleft) != "undefined" && setleft !== null) {
  clearInterval(setleft);
  //clearInterval(setright);
  }

}
  date_time_chart_left = ['x']
  date_chart_left = [

            ['<?php echo $lang['MENU_fore_foot'] ?>'],
            ['<?php echo $lang['MENU_mid_foot'] ?>'],
            ['<?php echo $lang['MENU_heel'] ?>'],
            ['<?php echo $lang['MENU_entire'] ?>'],
            ['times']
          ]
function chart_add_data_left(Fweight,Mweight,Hweight,Sumweight,data_time){
 
   date_chart_left[0].push(Fweight);
   date_chart_left[1].push(Mweight);
   date_chart_left[2].push(Hweight);
   date_chart_left[3].push(Sumweight);
   date_chart_left[4].push(format_Time(data_time));
    // console.log("date_chart_left", date_chart_left)

 var chart_left = c3.generate({
  bindto: '#chart_left',
       
        data: {
          x: 'times',
          xFormat: '%S', // how the date is parsed
          columns: date_chart_left
        },
        color:{
              pattern: ["#FF0000", "#00CC00", "#000000", "#0000CC"],//สามารถระบุ Code สี ที่ต้องการได้
        },
        zoom: {
          enabled: true
        },
        point: {
          show: false
        },
        subchart: {
          show: false,


        },
        axis: {
      y: {
        label: { // ADD
          text: '<?php echo $lang['MENU_pressure'] ?>',
          position: 'outer-middle'
        }
      },
      x: {
        label: { // ADD
          text: '<?php echo $lang['MENU_time_s'] ?>',
          position: 'outer-middle'
        },
        type: 'timeseries',
        tick: {
                format: '%S' // how the date is displayed
            },
      
      },
    },
      });
}



date_chart_right = [
             ['<?php echo $lang['MENU_fore_foot'] ?>'],
            ['<?php echo $lang['MENU_mid_foot'] ?>'],
            ['<?php echo $lang['MENU_heel'] ?>'],
            ['<?php echo $lang['MENU_entire'] ?>'],
            ['times']
          ]
          width_chart = 340
function chart_add_data_right(Fweight,Mweight,Hweight,Sumweight,data_time){
 width_chart = width_chart+5

   date_chart_right[0].push(Fweight);
   date_chart_right[1].push(Mweight);
   date_chart_right[2].push(Hweight);
   date_chart_right[3].push(Sumweight);
   date_chart_right[4].push(format_Time(data_time));
  //  console.log(date_chart_right)
 var chart_right = c3.generate({
   bindto: '#chart_right',
 
        // data: {
        //   columns: date_chart_right,
        //   type: 'spline', // กำหนดรูปแบบ เป็น barChart 
        // },
        data: {
          x: 'times',
          xFormat: '%S', // how the date is parsed
          columns: date_chart_right
        },
        color:{
              pattern: ["#FF0000", "#00CC00", "#000000", "#0000CC"],//สามารถระบุ Code สี ที่ต้องการได้
        },
        zoom: {
          enabled: true,
          type: "scroll",
        },
        point: {
          show: false
        },
        subchart: {
          show: false,
          type: "scroll",
        },
        axis: {
      y: {
        label: { // ADD
          text: '<?php echo $lang['MENU_pressure'] ?>',
          position: 'outer-middle'
        }
      },
      x: {
        label: { // ADD
          text: '<?php echo $lang['MENU_time_s'] ?>',
          position: 'outer-middle'
        },
        type: 'timeseries',
        tick: {
                format: '%S' // how the date is displayed
            },
      },
    },
        // size: {
        //   width: width_chart
        // }

      });




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
  $.redirect("playback_phy_GA.php?id_customer="+id_customer, {playback_type: playback_type, datetimepicker: datetimepicker, playback_time: playback_time, status_play: '1'}, "POST", ""); 
}


// chart_add_data_left(0,0,0,0,0);
// chart_add_data_right(0,0,0,0,0);
chart_add_data_left_apex(0, 0, 0, 0, 0);
chart_add_data_right_apex(0, 0, 0, 0, 0);

    now_seconds = 0;
    now_minutes = 0;
    now_hours = 0;
function format_Time(data_time) {

    
    now_minutes = 0;
    now_hours = 0;

   now_seconds = parseInt(data_time);

   if (now_seconds==60) {
    now_seconds=0;
    now_minutes = now_minutes+1
   }

   if (now_minutes==60) {
    now_minutes=0;
    now_hours = now_hours+1
   }

    var h = now_hours;
    var m = now_minutes;
    var s = now_seconds;
    h = checkTime(h);
    m = checkTime(m);
    s = checkTime(s);
  time =  s+ "s";
  return time


}

function checkTime(i) {
    if (i < 10) {
        i = "0" + i
    }; // add zero in front of numbers < 10
    return i;
}


var count = 0;
function chart_add_data_left_apex(Fweight,Mweight,Hweight,Sumweight,data_time){
  count = count + 1;
  
  date_chart_left_apex[0].push(Fweight.toFixed(2));
  date_chart_left_apex[1].push(Mweight.toFixed(2));
  date_chart_left_apex[2].push(Hweight.toFixed(2));
  date_chart_left_apex[3].push(Sumweight.toFixed(2));
  date_chart_left_apex[4].push(format_Time(data_time));
  // console.log("apex", date_chart_left_apex)

  optionsLeft = {
        series: [{
          name: '<?php echo $lang['MENU_fore_foot'] ?>',
          data: date_chart_left_apex[0]
        }, {
          name: '<?php echo $lang['MENU_mid_foot'] ?>',
          data: date_chart_left_apex[1]
        },
        {
          name: '<?php echo $lang['MENU_heel'] ?>',
          data: date_chart_left_apex[2]
        },
        {
          name: '<?php echo $lang['MENU_entire'] ?>',
          data: date_chart_left_apex[3]
        },
      ],
      chart: {
        height: 350,
        type: 'area'
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth'
      },        
      xaxis: {
        categories: date_chart_left_apex[4],
        format: '%S',
        title: { // ADD
          text: '<?php echo $lang['MENU_time_s'] ?>',          
        },
        type: 'timeseries',      
      },
      yaxis: {
        title: { // ADD
          text: '<?php echo $lang['MENU_pressure'] ?>',          
        }
      },
      tooltip: {
          x: {
            format: '%S'
          },
        },
    };
        
    if(count > 1){
      chart_left_apex.updateSeries([{
        name: '<?php echo $lang['MENU_fore_foot'] ?>',
          data: date_chart_left_apex[0]
        }, {
          name: '<?php echo $lang['MENU_mid_foot'] ?>',
          data: date_chart_left_apex[1]
        },
        {
          name: '<?php echo $lang['MENU_heel'] ?>',
          data: date_chart_left_apex[2]
        },
        {
          name: '<?php echo $lang['MENU_entire'] ?>',
          data: date_chart_left_apex[3]
        },
        // {
        //   name: 'times',
        //   data: [format_Time(data_time)]
        // },
      ]);

      chart_left_apex.updateOptions({
        chart: {
          height: 350,
          type: 'area'
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth'
        },        
        xaxis: {
          categories: date_chart_left_apex[4],
          format: '%S',
          title: { // ADD
            text: '<?php echo $lang['MENU_time_s'] ?>',
          },
          type: 'timeseries',
          axisTicks: {
            show: true// how the date is displayed
          },      
        },
        yaxis: {
          title: { // ADD
            text: '<?php echo $lang['MENU_pressure'] ?>',
          }
        },
        tooltip: {
          x: {
            format: '%S'
          },
        },
      })

    }else{
      chart_left_apex = new ApexCharts(document.querySelector("#chart_left2"), optionsLeft);
      chart_left_apex.render();    
    }  
}

var right_count = 0;
function chart_add_data_right_apex(Fweight,Mweight,Hweight,Sumweight,data_time){
  right_count = right_count + 1;
  
  date_chart_right_apex[0].push(Fweight.toFixed(2));
  date_chart_right_apex[1].push(Mweight.toFixed(2));
  date_chart_right_apex[2].push(Hweight.toFixed(2));
  date_chart_right_apex[3].push(Sumweight.toFixed(2));
  date_chart_right_apex[4].push(format_Time(data_time));
  // console.log("apex", date_chart_right_apex)

  optionsRight = {
        series: [{
          name: '<?php echo $lang['MENU_fore_foot'] ?>',
          data: date_chart_right_apex[0]
        }, {
          name: '<?php echo $lang['MENU_mid_foot'] ?>',
          data: date_chart_right_apex[1]
        },
        {
          name: '<?php echo $lang['MENU_heel'] ?>',
          data: date_chart_right_apex[2]
        },
        {
          name: '<?php echo $lang['MENU_entire'] ?>',
          data: date_chart_right_apex[3]
        },
      ],
      chart: {
        height: 350,
        type: 'area'
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth'
      },        
      xaxis: {
        categories: date_chart_right_apex[4],
        format: '%S',
        title: { // ADD
          text: '<?php echo $lang['MENU_time_s'] ?>',          
        },
        type: 'timeseries',     
      },
      yaxis: {
        title: { // ADD
          text: '<?php echo $lang['MENU_pressure'] ?>',          
        }
      },
      tooltip: {
          x: {
            format: '%S'
          },
        },
    };
        
    if(right_count > 1){
      chart_right_apex.updateSeries([{
        name: '<?php echo $lang['MENU_fore_foot'] ?>',
          data: date_chart_right_apex[0]
        }, {
          name: '<?php echo $lang['MENU_mid_foot'] ?>',
          data: date_chart_right_apex[1]
        },
        {
          name: '<?php echo $lang['MENU_heel'] ?>',
          data: date_chart_right_apex[2]
        },
        {
          name: '<?php echo $lang['MENU_entire'] ?>',
          data: date_chart_right_apex[3]
        },
      ]);

      chart_right_apex.updateOptions({
        chart: {
          height: 350,
          type: 'area'
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth'
        },        
        xaxis: {
          categories: date_chart_right_apex[4],
          format: '%S',
          title: { // ADD
            text: '<?php echo $lang['MENU_time_s'] ?>',
          },
          type: 'timeseries',   
        },
        yaxis: {
          title: { // ADD
            text: '<?php echo $lang['MENU_pressure'] ?>',
          }
        },
        tooltip: {
          x: {
            format: '%S'
          },
        },
      })

    }else{
      chart_right_apex = new ApexCharts(document.querySelector("#chart_right2"), optionsRight);
      chart_right_apex.render();    
    }  
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
              clearInterval(setleft);
              clearInterval(setright);
              
              var leftVal = playback_time_arr_left.length/playback_time_arr_left[playback_time_arr_left.length-1].split(',')[5];
              var rightVal = playback_time_arr_right.length/playback_time_arr_right[playback_time_arr_right.length-1].split(',')[5];
              ileft = Math.floor(leftVal * value);
              iright = Math.floor(rightVal * value);
              
              sliderValLeft = Math.floor(leftVal * value);
              sliderValRight = Math.floor(rightVal * value);
              
              setleft = setInterval(setLeftGait, interval_left/speed);
              setright = setInterval(setRightGait, interval_right/speed);
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