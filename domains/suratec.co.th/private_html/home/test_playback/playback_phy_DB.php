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
</style>

<?php include_once 'common.php'; ?>
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
										<li><a href="playback_phy_BB.php"><i class="fa fa-gavel"></i>Balance Board</a></li>			
										<li class="active"><a href="playback_phy_DB.php"><i class="fa fa-globe"></i>Dasboard</a></li>						
									</ul>
								</div>
								<!--/ End Service Category -->
							</div>
							<!--/ End Service Sidebar -->
						</div>
						<div class="col-lg-5 col-12">
							<div class="row">
								<div class="col-lg-1">
								</div>
								<div class="col-lg-5" style="border: 1px solid; padding: 10px;">
									<h6><i class="icofont icofont-circled-left" style="color: cornflowerblue;"></i> ขาซ้าย</h6>
									<div class="row">
										<div class="col-lg-12">
<!--											<img src="../images/540x360.jpg" width="100%">-->
<div class="outsideWrapper">
    <div class="insideWrapper">
        <img src="../images/foot_left.png" style="max-width: 80;" class="coveredImage">
        <canvas class="itemleft" id="itemleft" width="460" height="250"></canvas>
    </div>
</div>
										</div>
									</div>
									<div class="row" style="text-align: center; padding: 10px;">
										<div class="col-lg-4" style="background-color: #ccc; border-right: 1px solid;">
											<strong><span>H</span></strong>
										</div>
										<div class="col-lg-4" style="background-color: #ccc; border-right: 1px solid;">
											<strong><span>M</span></strong>
										</div>
										<div class="col-lg-4" style="background-color: #ccc;">
											<strong><span>F</span></strong>
										</div>
									</div>
									<div class="row" style="text-align: center; padding: 10px; margin-top: -20px;">
										<div class="col-lg-4" style="border-right: 1px solid;">
											<span>75%</span>
										</div>
										<div class="col-lg-4" style="border-right: 1px solid;">
											<span>5%</span>
										</div>
										<div class="col-lg-4">
											<span>20%</span>
										</div>
									</div>
									<div class="row" style="padding: 10px;">
<!--									<img src="../images/pattern/bg-1.png" width="100%">-->
										<canvas id="myCanvas_l" width="185" height="185" style="border:1px solid #d3d3d3;"></canvas>
									</div>
									<div class="row" style="text-align: center; padding: 10px;">
										<div class="col-lg-12" style="background: #cccccc; border-top: 1px solid; border-left: 1px solid; border-right: 1px solid;">
											<strong><span>Balance score</span></strong>
										</div>
										<div class="col-lg-12" style="border-bottom: 1px solid; border-left: 1px solid; border-right: 1px solid;">
											<span>6</span>
										</div>
									</div>
								</div>
								<div class="col-lg-1">
								</div>
								<div class="col-lg-5" style="border: 1px solid; padding: 10px;">
									<h6><i class="icofont icofont-circled-right" style="color: cornflowerblue;"></i> ขาขวา</h6>
									<div class="row">
										<div class="col-lg-12">
<!--											<img src="../images/540x360.jpg" width="100%">-->
<div class="outright">											
<div class="outsideWrapper">
    <div class="insideWrapper">
        <img src="../images/foot_right.png" style="max-width: 80;" class="coveredImage">
        <canvas class="itemright" id="itemright" width="460" height="250"></canvas>
    </div>
</div>
</div>
											
										</div>
									</div>
									<div class="row" style="text-align: center; padding: 10px;">
										<div class="col-lg-4" style="background-color: #ccc; border-right: 1px solid;">
											<strong><span>H</span></strong>
										</div>
										<div class="col-lg-4" style="background-color: #ccc; border-right: 1px solid;">
											<strong><span>M</span></strong>
										</div>
										<div class="col-lg-4" style="background-color: #ccc;">
											<strong><span>F</span></strong>
										</div>
									</div>
									<div class="row" style="text-align: center; padding: 10px; margin-top: -20px;">
										<div class="col-lg-4" style="border-right: 1px solid;">
											<span>75%</span>
										</div>
										<div class="col-lg-4" style="border-right: 1px solid;">
											<span>5%</span>
										</div>
										<div class="col-lg-4">
											<span>20%</span>
										</div>
									</div>
									<div class="row" style="padding: 10px;">
<!--										<img src="../images/pattern/bg-1.png" width="100%">-->
										<canvas id="myCanvas_r" width="185" height="185" style="border:1px solid #d3d3d3;"></canvas>
									</div>
									<div class="row" style="text-align: center; padding: 10px;">
										<div class="col-lg-12" style="background: #cccccc; border-top: 1px solid; border-left: 1px solid; border-right: 1px solid;">
											<strong><span>Balance score</span></strong>
										</div>
										<div class="col-lg-12" style="border-bottom: 1px solid; border-left: 1px solid; border-right: 1px solid;">
											<span>6</span>
										</div>
									</div>
								</div>
							</div>	
						</div>
						<div class="col-lg-4 col-12">
							<div class="row" style="text-align: center;">
								<div class="col-lg-1">	
								</div>
								<div class="col-lg-5" style="background: #cccccc; border-top: 1px solid; border-left: 1px solid; border-right: 1px solid;">
									<span>Duration</span>
								</div>
								<div class="col-lg-1">	
								</div>
								<div class="col-lg-5" style="background: #cccccc; border-top: 1px solid; border-left: 1px solid; border-right: 1px solid;">
									<span>Pace</span>
								</div>
							</div>
							<div class="row" style="text-align: center;">
								<div class="col-lg-1">	
								</div>
								<div class="col-lg-5" style="border-bottom: 1px solid; border-left: 1px solid; border-right: 1px solid;">
									<span>1:10:20</span>
								</div>
								<div class="col-lg-1">	
								</div>
								<div class="col-lg-5" style="border-bottom: 1px solid; border-left: 1px solid; border-right: 1px solid;">
									<span>2 min/km.</span>
								</div>
							</div><br>
							<div class="row" style="text-align: center;">
								<div class="col-lg-1">	
								</div>
								<div class="col-lg-5" style="background: #cccccc; border-top: 1px solid; border-left: 1px solid; border-right: 1px solid;">
									<span>Distance</span>
								</div>
								<div class="col-lg-1">	
								</div>
								<div class="col-lg-5" style="background: #cccccc; border-top: 1px solid; border-left: 1px solid; border-right: 1px solid;">
									<span>Total Steps</span>
								</div>
							</div>
							<div class="row" style="text-align: center;">
								<div class="col-lg-1">	
								</div>
								<div class="col-lg-5" style="border-bottom: 1px solid; border-left: 1px solid; border-right: 1px solid;">
									<span>2 km.</span>
								</div>
								<div class="col-lg-1">	
								</div>
								<div class="col-lg-5" style="border-bottom: 1px solid; border-left: 1px solid; border-right: 1px solid;">
									<span>3</span>
								</div>
							</div><br>
							<div class="row" style="text-align: center;">
								<div class="col-lg-1">	
								</div>
								<div class="col-lg-5" style="background: #cccccc; border-top: 1px solid; border-left: 1px solid; border-right: 1px solid;">
									<span>Heart Rate</span>
								</div>
								<div class="col-lg-1">	
								</div>
								<div class="col-lg-5" style="background: #cccccc; border-top: 1px solid; border-left: 1px solid; border-right: 1px solid;">
									<span>Burned</span>
								</div>
							</div>
							<div class="row" style="text-align: center;">
								<div class="col-lg-1">	
								</div>
								<div class="col-lg-5" style="border-bottom: 1px solid; border-left: 1px solid; border-right: 1px solid;">
									<span>--</span>
								</div>
								<div class="col-lg-1">	
								</div>
								<div class="col-lg-5" style="border-bottom: 1px solid; border-left: 1px solid; border-right: 1px solid;">
									<span>130 cal</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<!--/ End Services -->

			
			<!-- Footer -->
			<?php include 'footer.php'?>
			<!--/ End footer -->
			<?php include 'footer_credit.php'?>	
		</div>
    </body>
</html>

<script src="https://d3js.org/d3.v4.min.js"></script>
<script src="https://d3js.org/d3-hsv.v0.1.min.js"></script>
<script src="https://d3js.org/d3-contour.v1.min.js"></script>
<script src="kign.js"></script>
<script>
	
//	<? //$num = mysqli_num_rows($query);?>
//						  <?php 
//	
//						for($i=1; $i<=$num; $i++)
//						  {
//							  $result = mysqli_fetch_array($query);
//							  $id=$result['left_sensor5'];
//							echo($id." ");
//						  }
//
//						  ?>
	
var leftvalue = 1;
var rightvalue = 1;	
	  	  
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

    const n = 4, m = 12;

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
      var lvalues = new Array(4 * 12)
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
    var rvalues = new Array(4 * 12)
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

    var canvas = document.getElementById("itemleft"),
      context = canvas.getContext("2d"),	
      color = d3.scaleSequential(getColor).domain(d3.extent(d3.range(0, 600, 50))),
      pathleft = d3.geoPath(null, context),
      thresholds = d3.range(0, 600, 50),
      contours = d3.contours().size([4, 12]);
	  
	 var canvasr = document.getElementById("itemright"),
      contextr = canvasr.getContext("2d"),	
      colorr = d3.scaleSequential(getColor).domain(d3.extent(d3.range(0, 600, 50))),
      pathr = d3.geoPath(null, contextr),
      thresholdsr = d3.range(0, 600, 50),
      contoursr = d3.contours().size([4, 12]);
	  
      context.scale(20, 20);
      context.translate(0, 0);
	  
	  contextr.scale(20, 20);
      contextr.translate(0, 0);  

    // d3.timer(function (t) {
    //   values = findLeftContourArray([
    //     Math.floor(Math.random() * 600),
    //     Math.floor(Math.random() * 600),
    //     Math.floor(Math.random() * 600),
    //     Math.floor(Math.random() * 600),
    //     Math.floor(Math.random() * 600)
    //   ])
    //   contours
    //     .thresholds(d3.range(0, 600, 50))
    //     (values)
    //     .forEach(fill);
    // }, 1000);
	
    setInterval(function (t) {
      values = findLeftContourArray([
		  	510,520,530,540,550
      ])
      contours
        .thresholds (d3.range(0, 600, 50))
        (values)
        .forEach(fill);
    }, 1000)
	    
	setInterval(function (ttr) {
      values = findRightContourArray([
//        Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600)
//		  600,600,600,600,600
		  510,520,530,540,550
      ])
      contoursr
        .thresholds(d3.range(0, 600, 50))
        (values)
        .forEach(fillr);
    }, 1000)
	     
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
      var canvas_b = document.getElementById('myCanvas_l');
      var context_b = canvas_b.getContext('2d');
      var centerX_b = canvas_b.width / 2;
      var centerY_b = canvas_b.height / 2;
      var radius_b = 70;

//      context_b.beginPath();
//      context_b.arc(142.5, 142.5, 6, 0, 2 * Math.PI, false);
//	  context_b.closePath();
//	  context_b.arc(142.5, 142.5, 16, 0, 2 * Math.PI, false);
////	  context_b.arc(142.5, 142.5, 46, 0, 2 * Math.PI, false);
////	  context_b.arc(142.5, 142.5, 66, 0, 2 * Math.PI, false);
////	  context_b.arc(142.5, 142.5, 66, 0, 2 * Math.PI, false);
////    context_b.fillStyle = 'yellow';
////    context_b.fill();
//      context_b.lineWidth = 1;
////      context.strokeStyle = '#003300';
//      context_b.stroke();	

context_b.fillStyle = "#fff";
context_b.beginPath();
context_b.setLineDash([0]);	
context_b.arc(92.5, 92.5, 81, 0, Math.PI*2, false);
	
context_b.closePath();
context_b.lineWidth = 1;
context_b.strokeStyle = '#999';
context_b.fill();
context_b.stroke();	
	
context_b.fillStyle = "#fff";
context_b.beginPath();
context_b.setLineDash([8]);	
context_b.arc(92.5, 92.5, 66, 0, Math.PI*2, false);
	
context_b.closePath();
context_b.lineWidth = 1;
context_b.strokeStyle = '#999';		
context_b.fill();
context_b.stroke();		
	
context_b.fillStyle = "#fff";
context_b.beginPath();
context_b.setLineDash([0]);	
context_b.arc(92.5, 92.5, 51, 0, Math.PI*2, false);
	
context_b.closePath();
context_b.lineWidth = 1;
context_b.strokeStyle = '#999';		
context_b.fill();
context_b.stroke();
	
context_b.fillStyle = "#fff";
context_b.beginPath();
context_b.setLineDash([8]);	
context_b.arc(92.5, 92.5, 36, 0, Math.PI*2, false);

context_b.closePath();
context_b.lineWidth = 1;
context_b.strokeStyle = '#999';		
context_b.fill();
context_b.stroke();	
	
context_b.fillStyle = "#fff";
context_b.beginPath();
context_b.setLineDash([0]);	
context_b.arc(92.5, 92.5, 21, 0, Math.PI*2, false);
context_b.moveTo(92.5, 0);
context_b.lineTo(92.5, 185);
context_b.moveTo(185, 92.5);
context_b.lineTo(0, 92.5);		
context_b.closePath();
context_b.lineWidth = 1;
context_b.strokeStyle = '#999';		
context_b.fill();
context_b.stroke();	
	
context_b.fillStyle = "yellow";
context_b.beginPath();
context_b.arc(92.5, 92.5, 6, 0, Math.PI*2, false);
context_b.closePath();
context_b.lineWidth = 1;
context_b.strokeStyle = '#999';		
context_b.fill();
context_b.stroke();		
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
      var canvas_r = document.getElementById('myCanvas_r');
      var context_r= canvas_r.getContext('2d');
      var centerX_r = canvas_r.width / 2;     
	  var centerY_r = canvas_r.height / 2;
      var radius_r = 70;

//      context_b.beginPath();
//      context_b.arc(142.5, 142.5, 6, 0, 2 * Math.PI, false);
//	  context_b.closePath();
//	  context_b.arc(142.5, 142.5, 16, 0, 2 * Math.PI, false);
////	  context_b.arc(142.5, 142.5, 46, 0, 2 * Math.PI, false);
////	  context_b.arc(142.5, 142.5, 66, 0, 2 * Math.PI, false);
////	  context_b.arc(142.5, 142.5, 66, 0, 2 * Math.PI, false);
////    context_b.fillStyle = 'yellow';
////    context_b.fill();
//      context_b.lineWidth = 1;
////      context.strokeStyle = '#003300';
//      context_b.stroke();	

context_r.fillStyle = "#fff";
context_r.beginPath();
context_r.setLineDash([0]);	


context_r.arc(92.5, 92.5, 81, 0, Math.PI*2, false);
	
context_r.closePath();
context_r.lineWidth = 1;
context_r.strokeStyle = '#999';
context_r.fill();
context_r.stroke();	
	
context_r.fillStyle = "#fff";
context_r.beginPath();
context_r.setLineDash([8]);	
context_r.arc(92.5, 92.5, 66, 0, Math.PI*2, false);
	
context_r.closePath();
context_r.lineWidth = 1;
context_r.strokeStyle = '#999';		
context_r.fill();
context_r.stroke();		
	
context_r.fillStyle = "#fff";
context_r.beginPath();
context_r.setLineDash([0]);	
context_r.arc(92.5, 92.5, 51, 0, Math.PI*2, false);
	
context_r.closePath();
context_r.lineWidth = 1;
context_r.strokeStyle = '#999';		
context_r.fill();
context_r.stroke();
	
context_r.fillStyle = "#fff";
context_r.beginPath();
context_r.setLineDash([8]);	
context_r.arc(92.5, 92.5, 36, 0, Math.PI*2, false);

context_r.closePath();
context_r.lineWidth = 1;
context_r.strokeStyle = '#999';		
context_r.fill();
context_r.stroke();	
	
context_r.fillStyle = "#fff";
context_r.beginPath();
context_r.setLineDash([0]);	
context_r.arc(92.5, 92.5, 21, 0, Math.PI*2, false);
context_r.moveTo(92.5, 0);
context_r.lineTo(92.5, 185);
context_r.moveTo(185, 92.5);
context_r.lineTo(0, 92.5);		
context_r.closePath();
context_r.lineWidth = 1;
context_r.strokeStyle = '#999';		
context_r.fill();
context_r.stroke();	
	
context_r.fillStyle = "yellow";
context_r.beginPath();
context_r.arc(92.5, 92.5, 6, 0, Math.PI*2, false);
context_r.closePath();
context_r.lineWidth = 1;
context_r.strokeStyle = '#999';		
context_r.fill();
context_r.stroke();		
</script>