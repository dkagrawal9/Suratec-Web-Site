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
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.7.0/c3.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="../admin/plugins/sweetalert2/dist/sweetalert2.min.css">
	    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="../admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="table.css">
<link rel="stylesheet" href="../admin/plugins/sweetalert2/dist/sweetalert2.min.css">
    <script src="../admin/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
			<!--/ End Header -->
	<style>
	.swal2-popup{
		font-size: 1rem;
	}
</style> 
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
                    <li class="active"><a onclick="newGait_Analysis()"><i class="fa fa-handshake-o"></i> Gait Analysis</a></li>    
                    <li><a onclick="newBalance_Board()" ><i class="fa fa-gavel"></i> Balance Board</a></li>     
                    <li><a onclick="newDasboard()" ><i class="fa fa-globe"></i> Dasboard</a></li> 					
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
                                                            <option value="0">ประเภท Playback</option>
                                                            <option value="1">การแพทย์</option>
                                                            <option value="2" selected>การกีฬา</option>
                                                        </SELECT>  
                                                    </div>
                                                 </div>
                                                
                                                <div class="col-sm-3">
                                                    <div class='input-group date col-md-12' >
                                                        <input type='text' class="form-control" name="datetimepicker" id='datetimepicker' autocomplete="off" placeholder="วันที่" onchange="playback_time_func()" value="<?php echo $datetimepicker ?>"/>
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                    </div>
                                                 </div>

                                                 <div class="col-sm-3">
                                                    <div class='input-group date col-md-12' >
                                                        <SELECT class="form-control" name="playback_time" id='playback_time'>
                                                            <option value="0">เวลา Playback</option>
                                                        </SELECT>
                                                            
                                                    </div>
                                                 </div>
                                                 
                                                  <div class="col-sm-3">
                                                   
                                <button onclick=" function_play()" type="button" class="btn btn-primary search_date" id="search_date"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;<?=lang('เล่น', 'Play')?></button>&nbsp;&nbsp;&nbsp;
                                                  </div>
                                        </div>
								</div>
								<div class="col-md-12" style="padding-top: 20px;">
									<div class="row">
			
						<div class="col-lg-6 col-12">				
<!-- Create a div where the graph will take place -->
						<i class="fa fa-info-circle" style="color: #0998CC"></i> เท้าซ้าย<!--Insoles left-->
							<div id="chart_left"></div>
						</div>	
						<div class="col-lg-6 col-12">
<!-- Create a div where the graph will take place -->
						<i class="fa fa-info-circle" style="color: #0998CC"></i> เท้าขวา<!--Insoles right-->
						<div id="chart_right"></div>
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
    <script src="../admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- date-range-picker -->
    <script src="../admin/bower_components/moment/min/moment-with-locales.min.js"></script>
    <!-- <script src="js/front-manage-attr.js"></script> -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="../admin/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>					
					
					
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



 function search_date(){
  $("#show_data").html(''); 
  playback_time =  $("#playback_time").val(); 

playback_left_right = playback_time.split("/");

playback_time_arr_left = playback_left_right[0].split("***");
playback_time_arr_right = playback_left_right[1].split("***");
// console.log(playback_time_arr_left)
// console.log(playback_time_arr_left.length)

 
  //////ซ้าย/////
  ileft=0;
  xy_left_total=0;

         var setleft = setInterval(function (t) {
          // console.log(playback_time_arr_left.length)
          // console.log(playback_time_arr_right[ileft])

           data_test = playback_time_arr_left[ileft];
           data_test2 = data_test.split(",");
           data_test3=[];
         
           for (var i = 0; i < data_test2.length; i++) {
             data_test3.push(parseInt(data_test2[i]));
           }
Fweight = (data_test3[0]+data_test3[1]+data_test3[2]) / 3
Mweight = data_test3[3]
Hweight = data_test3[4]
Sumweight = (Fweight + Mweight + Hweight ) / 3
// console.log('ppp:'+Fweight+','+Mweight+','+Hweight+','+Sumweight)
chart_add_data_left(Fweight,Mweight,Hweight,Sumweight)

      
    ileft++
    if (ileft==playback_time_arr_left.length) {
      clearInterval(setleft)
    }

    
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
Fweight = (data_test3right[0]+data_test3right[1]+data_test3right[2]) / 3
Mweight = data_test3right[3]
Hweight = data_test3right[4]
Sumweight = (Fweight + Mweight + Hweight ) / 3
// console.log('ppp:'+Fweight+','+Mweight+','+Hweight+','+Sumweight)
chart_add_data_right(Fweight,Mweight,Hweight,Sumweight)

 
iright++
    if (iright==playback_time_arr_right.length) {
      clearInterval(setright)
    }

    }, 1000)       
//////ขวา/////


// })
}

 function myStopFunction() {

  if(typeof(setleft) != "undefined" && setleft !== null) {
  clearInterval(setleft);
  //clearInterval(setright);
  }

}

  date_chart_left = [
            ['Min-foot'],
            ['ForeFoot'],
            ['Heel'],
            ['Enter Foot']
          ]
function chart_add_data_left(Mweight,Fweight,Hweight,Sumweight){
 

   date_chart_left[0].push(Mweight);
   date_chart_left[1].push(Fweight);
   date_chart_left[2].push(Hweight);
   date_chart_left[3].push(Sumweight);
   // console.log(date_chart_left)
 var chart_left = c3.generate({
  bindto: '#chart_left',
        data: {
          columns: date_chart_left,
          type: 'spline', // กำหนดรูปแบบ เป็น barChart 
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
          show: true,


        },
      });
}



date_chart_right = [
            ['Min-foot'],
            ['ForeFoot'],
            ['Heel'],
            ['Enter Foot']
          ]
          width_chart = 340
function chart_add_data_right(Mweight,Fweight,Hweight,Sumweight){
 width_chart = width_chart+5

   date_chart_right[0].push(Mweight);
   date_chart_right[1].push(Fweight);
   date_chart_right[2].push(Hweight);
   date_chart_right[3].push(Sumweight);
   // console.log(date_chart_right)
 var chart_right = c3.generate({
   bindto: '#chart_right',
 
        data: {
          columns: date_chart_right,
          type: 'spline', // กำหนดรูปแบบ เป็น barChart 
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
          show: true,
          type: "scroll",
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
  $.redirect("playback_sport_GA.php?id_customer="+id_customer, {playback_type: playback_type, datetimepicker: datetimepicker, playback_time: playback_time, status_play: '1'}, "POST", ""); 
}



playback_time_func();
</script>