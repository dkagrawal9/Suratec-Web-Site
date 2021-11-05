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

//$id = $_SESSION['id_customer'];
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
								<h2><?=$lang['MENU_Playback_D']?><!--Profile--></h2>
							</div>
							<!-- Bread List -->
							<ul class="bread-list">
								<li><a href="./?index=st"><i class="fa fa-home"></i><?=$lang['MENU_HOME']?><!--Home--></a></li>
								<li class="active"><a href="playback_sport.php?playback_sport=st"><i class="fa fa-clone"></i><?=$lang['MENU_Playback_D']?><!--Profile--></a></li>
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
										<li><a href="playback_phy.php"><i class="fa fa-list"></i>Pressure Map</a></li>			
										<li><a href="playback_phy_GA.php"><i class="fa fa-handshake-o"></i>Gait Analysis</a></li>			
										<li class="active"><a href="playback_phy_BB.php"><i class="fa fa-gavel"></i>Balance Board</a></li>			
										<li><a href="playback_phy_DB.php"><i class="fa fa-globe"></i>Dasboard</a></li>						
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
                                                            <option value="1" selected>การแพทย์</option>
                                                            <option value="2">การกีฬา</option>
                                                        </SELECT>  
                                                    </div>
                                                 </div>
                                                
                                                <div class="col-sm-3">
                                                    <div class='input-group date col-md-12' >
                                                        <input type='text' class="form-control" name="datetimepicker" id='datetimepicker' autocomplete="off" placeholder="วันที่" onchange="playback_time_func()"/>
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
                                                   
                                <button onclick=" myStopFunction()" type="button" class="btn btn-primary search_date" id="search_date"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;<?=lang('เล่น', 'Play')?></button>&nbsp;&nbsp;&nbsp;
                                                  </div>
                                        </div>
								</div>
							<div class="col-md-12" style="padding-top: 20px;">
								<p style="text-align: center;">Time in Zone : <p id="p_time" style="text-align: center;"> 0 s </p></p>
							<div class="row" style="padding-top: 20px;">
					<div class="col-md-6">
					<H3 style="text-align: center; padding-bottom: 10px;">ซ้าย</H3>	
                    <div class="row" style="text-align: center;" id="mycan_l" >
                  <div class="col-md-12" align="center" style="align-items: center;">
                    <canvas id="myCanvas_l" width="285" height="285" style="border:1px solid #d3d3d3;"></canvas>
                  </div>
                </div>

                <div class="col-md-12" align="center" style="padding-top: 20px;">
                <table class="table" border="1">
                    <tr>
                      <th style="background: #cccccc;">Balance Board Left</th>
                      <th style="background: #cccccc;">การทรงตัวซ้าย</th>
                    </tr>
                    <tr>
                      <td width="50%"><p id="p_left"> 0  </p></td>
                      <td width="50%"><p id="p_text_left"> -  </p></td>
                    </tr>
                  </table>
                  </div>


                  </div>
				<div class="col-md-6">
					 <H3 style="text-align: center; padding-bottom: 10px;">ขวา</H3>
                    <div class="row" style="text-align: center;" id="mycan_r" >
                  <div class="col-md-12" align="center" style="align-items: center;">
                    <canvas id="myCanvas_r" width="285" height="285" style="border:1px solid #d3d3d3;"></canvas>
                  </div>

                  <div class="col-md-12" align="center" style="padding-top: 20px;">
                  <table class="table" border="1">
                    <tr>
          
                      <th style="background: #cccccc;">Balance Board Right</th>
                      <th style="background: #cccccc;">การทรงตัวขวา</th>
                    </tr>
                    <tr>
             
                      <td width="50%"><p id="p_right"> 0  </p></td>
                      <td width="50%"><p id="p_text_right"> - </p></td>
                    </tr>
                  </table>
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

<script src="https://d3js.org/d3.v4.min.js"></script>
<script src="https://d3js.org/d3-hsv.v0.1.min.js"></script>
<script src="https://d3js.org/d3-contour.v1.min.js"></script>
<script src="kign.js"></script>
<!-- Load d3.js -->
<script src="https://d3js.org/d3.v4.js"></script>

<!-- Color scale -->
<script src="https://d3js.org/d3-scale-chromatic.v1.min.js"></script>

<script src="http://d3js.org/d3.v3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.16/c3.js"></script>
<script>  

        
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
        t = Math.max(0, Math.min(1, t));
        return "rgb("
          + Math.max(0, Math.min(255, Math.round(34.61 + t * (1172.33 - t * (10793.56 - t * (33300.12 - t * (38394.49 - t * 14825.05))))))) + ", "
          + Math.max(0, Math.min(255, Math.round(23.31 + t * (557.33 + t * (1225.33 - t * (3574.96 - t * (1073.77 + t * 707.56))))))) + ", "
          + Math.max(0, Math.min(255, Math.round(27.2 + t * (3211.1 - t * (15327.97 - t * (27814 - t * (22569.18 - t * 6838.66)))))))
          + ")";
    }

//    var canvas = document.getElementById("itemleft"),
//      context = canvas.getContext("2d"),  
//      color = d3.scaleSequential(getColor).domain(d3.extent(d3.range(0, 600, 50))),
//      pathleft = d3.geoPath(null, context),
//      thresholds = d3.range(0, 600, 50),
//      contours = d3.contours().size([8, 24]);
//    
//   var canvasr = document.getElementById("itemright"),
//      contextr = canvasr.getContext("2d"),  
//      colorr = d3.scaleSequential(getColor).domain(d3.extent(d3.range(0, 600, 50))),
//      pathr = d3.geoPath(null, contextr),
//      thresholds = d3.range(0, 600, 50),
//      contoursr = d3.contours().size([8, 24]);
//    
//      context.scale(20, 20);
//      context.translate(0, 0);
//    
//    	contextr.scale(20, 20);
//      contextr.translate(0, 0);  



       
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
<!--
<script>
      var canvas2 = document.getElementById('myCanvas');
      var context2 = canvas.getContext('2d');
      var centerX2 = canvas.width / 2;
      var centerY2 = canvas.height / 2;
      var radius2 = 70;

      context2.beginPath();
      context2.arc(142.5, 142.5, 16, 0, 2 * Math.PI, false);
//      context2.fillStyle = 'yellow';
      context2.fill();
      context2.lineWidth = 1;
//      context2.strokeStyle = '#003300';
      context2.stroke();  
</script> -->


<!--balance r-->
<script>
  function ppp_right(y1,y2){
      var canvas_r = document.getElementById('myCanvas_r');
      var context_r= canvas_r.getContext('2d');
      var centerX_r = canvas_r.width / 2;     
    var centerY_r = canvas_r.height / 2;
      var radius_r = 70;

//      context_b.beginPath();
//      context_b.arc(142.5, 142.5, 6, 0, 2 * Math.PI, false);
//    context_b.closePath();
//    context_b.arc(142.5, 142.5, 16, 0, 2 * Math.PI, false);
////    context_b.arc(142.5, 142.5, 46, 0, 2 * Math.PI, false);
////    context_b.arc(142.5, 142.5, 66, 0, 2 * Math.PI, false);
////    context_b.arc(142.5, 142.5, 66, 0, 2 * Math.PI, false);
////    context_b.fillStyle = 'yellow';
////    context_b.fill();
//      context_b.lineWidth = 1;
////      context.strokeStyle = '#003300';
//      context_b.stroke(); 

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


<script>
 



  </script>

<!-- Load d3.js -->

<script>


</script>
<script type="text/javascript">
function myStopFunction() {

  if(typeof(setleft) != "undefined" && setleft !== null) {
  clearInterval(setleft);
  clearInterval(setright);
  }

}
 $(document).on('click','#pressure_map_btn',function(){
 
   
 // id_customer =  $("#id_customer").val();              
 //                $.ajax({   
 //            url:'select_playback_sport1.php?id_customer='+id_customer, 
 //            method:'POST',  
 //            data:{_method:'pressure_map'},  
 //                success:function(data){  
 //                    //console.log(response.data[0]['path_slip']);
               
 //                $("#show_data").html(data); 

 //                }, 

                   
 //           });  
            })



  $(function () {
    

            // $('#datetimepicker').datepicker({
               
            //       format:'Y-m-d'

                
             
            // });
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
//  console.log(playback_type)  
if (id_customer != '' && playback_type != '0' && datetimepicker!= '') {
   $.ajax({   
            url:'test_time.php?id_customer='+id_customer, 
            method:'POST',  
            data:{id_customer:id_customer, playback_type:playback_type, datetimepicker:datetimepicker},  
                success:function(data){  
                   // console.log(data);
               
                $("#playback_time").html(data); 

                }, 

                   
           });
}
 
} 

//  $(document).on('change','#playback_time',function(){
//     playback_time =  $("#playback_time").val();  
//     // var playback_time_arr = [playback_time];
//     // console.log(playback_time_arr) 
// playback_left_right = playback_time.split("/");
// playback_time_arr_left = playback_left_right[0].split("***");
//      playback_time_arr = playback_left_right[0].split("***");
//      fruits = [];
//      for (var i = 0; i < playback_time_arr.length; i++) {
//        playback_time_arr1 = playback_time_arr[i].split(",");
//        var playback_time_arr2 = [playback_time_arr1];
       
//        fruits.push(playback_time_arr2);
//      }
//      console.log(playback_time_arr) 


//      playback_time_arr_right = playback_left_right[1].split("***");
//      playback_time_arr = playback_left_right[1].split("***");
//      fruits = [];
//      for (var i = 0; i < playback_time_arr.length; i++) {
//        playback_time_arr1 = playback_time_arr[i].split(",");
//        var playback_time_arr2 = [playback_time_arr1];
       
//        fruits.push(playback_time_arr2);
//      }
//      console.log(playback_time_arr)

//        $.ajax({   
//             url:'select_playback_sport.php?id_customer='+id_customer, 
//             method:'POST',  
//             data:{fruits:fruits,playback_time_arr_left:playback_time_arr_left,playback_time_arr_right:playback_time_arr_right},  
//                 success:function(data){  
//                     //console.log(response.data[0]['path_slip']);
               
//                 $("#show_data").html(data); 

//                 }, 

                   
//            });
     
    
//   })


 $(document).on('click','#search_date',function(){
	
  if($("#playback_time").val() != "0"
	)
	 {	 
	 
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
          console.log(playback_time_arr_left.length)
          console.log(playback_time_arr_right[ileft])
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
        ppp_left(x1,y1)
        console.log(x1,y1)

xy_left = ((142.5 - x1) * (142.5 - x1) + (142.5 - y1) * (142.5 - y1))
xy_left_1 = Math.sqrt(xy_left)
if (xy_left_1<=28.5  ) {
  $("#p_text_left").html('ดี')
}else if (xy_left_1>28.5 && xy_left_1<=114){
  $("#p_text_left").html('ปานกลาง')
}else{
  $("#p_text_left").html('พอใช้')
}
xy_left_total = xy_left_1 + xy_left_total;
xy_left_total1=xy_left_total/(ileft+1)
        $("#p_left").html(xy_left_total.toFixed(2)); 
         console.log(data_test3)

          var data_test1 = [0,0,0,0,364];
          console.log(data_test1)
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
        ppp_right(x1_right,y1_right)
       console.log(x1_right+','+y1_right)

        xy_right = ((142.5 - x1_right) * (142.5 - x1_right) + (142.5 - y1_right) * (142.5 - y1_right))
xy_right_1 = Math.sqrt(xy_right)
console.log('รูท'+xy_right_1)
if (xy_right_1<=28.5  ) {
  $("#p_text_right").html('ดี')
}else if (xy_right_1>28.5 && xy_right_1<=114){
  $("#p_text_right").html('ปานกลาง')
//p_text_right
}else{
  $("#p_text_right").html('พอใช้')
}
xy_right_total = xy_right_1 + xy_right_total;
console.log('xy_right_total='+xy_right_1+'+'+xy_right_total)
console.log(xy_right_total)
xy_right_total1=xy_right_total/(iright+1)
console.log(xy_right_total1)
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
}else{
    swal('คำเตือน!','กรุณาเลือกข้อมูลให้ครบถ้วน.','warning');
  }
})

</script>