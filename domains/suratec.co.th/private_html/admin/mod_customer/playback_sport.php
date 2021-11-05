<?php 
  require_once '../admin/library/connect.php';
  require_once '../admin/library/functions.php';
  checkMemUser($objConnect);
?>
<?php include 'header.php'
?>
<?php
	$date_start =  date("Y-m-d");
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

$sql = 'SELECT `id`,`action`,`duration`,`left_sensor1`,`left_sensor2`,`left_sensor3`,`left_sensor4`,`left_sensor5`,`right_sensor1`,`right_sensor2`,`right_sensor3`,`right_sensor4`,`right_sensor5`,`id_customer` FROM `surasole` WHERE `id_customer` = "'.$id.'" AND DATE(`action`) = "2020-02-19" ORDER BY `id` ASC';
	$query = mysqli_query($objConnect,$sql);
	$result = mysqli_fetch_array($query);
	$num = mysqli_num_rows($query);
//	if($num>0){
//		echo json_encode(array('status' => '1', 'message' => $result));
//	}else{
//		echo json_encode(array('status' => '0', 'message' => $sql));
//	}

	$count = 0;
   	$action = 0;
	$left_sensor = [];
	$right_sensor = [];
	$retData = [];
						for($i=1; $i<=$num; $i++)
						  {
							if ($i != 0) 
							{
							  $result = mysqli_fetch_array($query);
							  $left_1 = $result['left_sensor1'];
							  $left_2 = $result['left_sensor2'];
							  $left_3 = $result['left_sensor3'];
							  $left_4 = $result['left_sensor4'];
							  $left_5 = $result['left_sensor5'];
							$datasum_left = ($left_1.",".$left_2.",".$left_3.",".$left_4.",".$left_5);
							  $right_1 = $result['right_sensor1'];
							  $right_2 = $result['right_sensor2'];
							  $right_3 = $result['right_sensor3'];
							  $right_4 = $result['right_sensor4'];
							  $right_5 = $result['right_sensor5'];
							$datasum_right = ($right_1.",".$right_2.",".$right_3.",".$right_4.",".$right_5);	
							array_push($left_sensor,$datasum_left);
							array_push($right_sensor,$datasum_right);	
							}
							else
							{
							  $result = mysqli_fetch_array($query);
							  $left_1 = $result['left_sensor1'];
							  $left_2 = $result['left_sensor2'];
							  $left_3 = $result['left_sensor3'];
							  $left_4 = $result['left_sensor4'];
							  $left_5 = $result['left_sensor5'];
							$datasum_left = ($left_1.",".$left_2.",".$left_3.",".$left_4.",".$left_5);
							  $right_1 = $result['right_sensor1'];
							  $right_2 = $result['right_sensor2'];
							  $right_3 = $result['right_sensor3'];
							  $right_4 = $result['right_sensor4'];
							  $right_5 = $result['right_sensor5'];
							$datasum_right = ($right_1.",".$right_2.",".$right_3.",".$right_4.",".$right_5);	
							array_push($left_sensor,$datasum_left);
							array_push($right_sensor,$datasum_right);		
							}
						  }
						if($count > 0 || $count == 0)
						{
							$retData[$count]['action'] = $result['action'];
							$retData[$count]['duration'] = $result['duration'];
							$retData[$count]['left'] = $left_sensor;
							$retData[$count]['right'] = $right_sensor;
//
						}
					
//						echo $retData;

//            for ($i = 0; $i <= $num; $i++) {
//                if ($i != 0) {
//					if ($data[$i]->duration - $data[$i - 1]->duration >= 0) {
//                        $lsensor = [$data[$i]->left_sensor1, $data[$i]->left_sensor2, $data[$i]->left_sensor3, $data[$i]->left_sensor4, $data[$i]->left_sensor5];
//                        $rsensor = [$data[$i]->right_sensor1, $data[$i]->right_sensor2, $data[$i]->right_sensor3, $data[$i]->right_sensor4, $data[$i]->right_sensor5];
//                        array_push($left_sensor, $lsensor);
//                        array_push($right_sensor, $rsensor);
//                    } else {
//                        $retData[$count]['action'] = $data[$action]->action;
//                        $retData[$count]['duration'] = $data[$i - 1]->duration;
//                        $retData[$count]['left'] = $left_sensor;
//                        $retData[$count]['right'] = $right_sensor;
//                        $left_sensor = [];
//                        $right_sensor = [];
//                        $action = $i + 1;
//                        $count++;
//                    }
//					
//				}
//				
//			}


$sql_t = 'SELECT DISTINCT DATE_FORMAT(`action`,"%H:%i:%s") as action_time FROM surasole WHERE id_customer = "'.$id.'" AND DATE(`action`) = "2020-02-19" ORDER BY `id` DESC';
$query_t = mysqli_query($objConnect,$sql_t);
//$result_t = mysqli_fetch_array($query_t);
//	$result = mysqli_fetch_array($query);
//	$num = mysqli_num_rows($query);



?>
<?php include_once 'common.php'; ?>

						  <?php 
//							  $result = mysqli_fetch_array($query);
//							  $left_1=$result['left_sensor1'];
//							  $left_2=$result['left_sensor2'];
//							  $left_3=$result['left_sensor3'];
//							  $left_4=$result['left_sensor4'];
//							  $left_5=$result['left_sensor5'];
						  ?>

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
								<h2><?=$lang['MENU_Playback_S']?><!--Profile--></h2>
							</div>
							<!-- Bread List -->
							<ul class="bread-list">
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
										<li class="active"><a href="playback_sport.php"><i class="fa fa-list"></i>Pressure Map</a></li>			
										<li><a href="playback_sport_GA.php"><i class="fa fa-handshake-o"></i>Gait Analysis</a></li>			
										<li><a href="playback_sport_BB.php"><i class="fa fa-gavel"></i>Balance Board</a></li>			
										<li><a href="playback_sport_DB.php"><i class="fa fa-globe"></i>Dasboard</a></li>		
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
</style>
					  <div class="col-lg-2 col-12" style="text-align: right;">
						  <input type="hidden" class="form-control mb-30 inpt_date" name="id_customer" id="id_customer" value="<?=$id;?>" >
						  <p style="text-align: left;">วันที่</p>
						<?php //print_r($left_sensor) ?>
						<?php //print_r($right_sensor) ?> 
						  <p id="demo"></p>
						  <input type="date" class="form-control mb-30 inpt_date" name="datee" id="datee" value="" >
						  <span style="float: left; font: bold; font-size: 16px;">Pressure Map</span>
						  <br><br>
						  <?php 
	
//						for($i=1; $i<=$num; $i++)
//						  {
//							  $result = mysqli_fetch_array($query);
//							  $left_1=$result['left_sensor1'];
//							  $left_2=$result['left_sensor2'];
//							  $left_3=$result['left_sensor3'];
//							  $left_4=$result['left_sensor4'];
//							  $left_5=$result['left_sensor5'];
//							echo  $datasum = ($left_1.",".$left_2.",".$left_3.",".$left_4.",".$left_5." ");
//							
//						  }
					 		
						  ?>

<!--							<img src="../images/foot_left.png" >-->
<div class="outsideWrapper">
    <div class="insideWrapper">
        <img src="../images/foot_left.png" style="max-width: 160;" class="coveredImage">
        <canvas class="itemleft" id="itemleft" width="350" height="500"></canvas>
    </div>
</div>
					  </div>
					  <div class="col-lg-2 col-12" style="padding-top: 15px;"><br><br><br><br>
<!--							<svg class="itemright" width="460" height="780" stroke-width="0.5"></svg>-->
<div class="outsideWrapper">
    <div class="insideWrapper">
        <img src="../images/foot_right.png" style="max-width: 160;" class="coveredImage">
        <canvas class="itemright" id="itemright" width="350" height="500"></canvas>
    </div>
</div>
					  </div>
						<div class="col-lg-5 col-12">
							<p>รายการที่บันทึกไว้</p>
							<select id="timee" name="timee" class="inpt_date">
								<option value="">-- รายการ --</option>
								<?php  while ($result_t = mysqli_fetch_array($query_t, MYSQLI_ASSOC)) { ?>
								<option value="<?=$result_t['action_time'];?>" selected class="inpt_date">เวลา <?=$result_t['action_time'];?></option>
								<?php } ?>
							</select><br><br>
							<span style="float: left; font: bold; font-size: 16px;">Balance Board</span><br><br>
							<div class="col-lg-12 col-12">
								<div class="row" style="text-align: center;" id="mycan_l" hidden="">
									<div class="col-lg-1 col-12">	
									</div>
									<div class="col-lg-11 col-12">
										<canvas id="myCanvas_l" width="285" height="285" style="border:1px solid #d3d3d3;"></canvas>
									</div>
								</div><br>
								<div class="row" style="text-align: center;" id="mycan_r" >
									<div class="col-lg-1 col-12">	
									</div>
									<div class="col-lg-11 col-12">
										<canvas id="myCanvas_r" width="285" height="285" style="border:1px solid #d3d3d3;"></canvas>
									</div>
								</div><br>
							<div class="row" style="text-align: center; ">
								<div class="col-lg-1 col-12">	
									</div>
								<div class="col-lg-11 col-12">
									<span class="btn btn-success but_lr">ซ้าย</span>
									<span class="btn btn-success but_lr">ขวา</span>
								</div>
							</div><br>	
							<div class="row" style="text-align: center;">
								<div class="col-lg-1 col-12">	
								</div>
								<div class="col-lg-5 col-12" style="background: #cccccc; border-top: 1px solid; border-left: 1px solid; border-right: 1px solid;">
									<span>Balance Board</span>
								</div>
								<div class="col-lg-1">	
								</div>
								<div class="col-lg-5" style="background: #cccccc; border-top: 1px solid; border-left: 1px solid; border-right: 1px solid;">
									<span>Time in Zone</span>
								</div>
							</div>
							<div class="row" style="text-align: center;">
								<div class="col-lg-1">	
								</div>
								<div class="col-lg-5" style="border-bottom: 1px solid; border-left: 1px solid; border-right: 1px solid;">
									<span>0</span>
								</div>
								<div class="col-lg-1">	
								</div>
								<div class="col-lg-5" style="border-bottom: 1px solid; border-left: 1px solid; border-right: 1px solid;">
									<span>0 s</span>
								</div>
							</div><br>
								<div class="row">
								<div class="col-lg-1">
								</div> 
								<div class="col-lg-11" style="text-align: center;background-color: #e6e6e6; padding: 20px;">
									<span>การทรงตัว : พอใช้</span>
									<p>หมั่นฝึกฝนต่อไป เพื่อการทรงตัวที่ดียิ่งขึ้น</p>
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
//document.querySelector('#datee').onclick = function() { 
//    alert('lol'); 
//}	
	
//  $.get( "live-order.php?id_product=", function( data ) {
//  $( ".result" ).html( data );
//  swal.fire( "ทำการโหลด." );
//});	
	  	  
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
	$( '#datee' ).keyup(function() {
		
	var ileft = 0;
	var leftstop = <?=$num?>;
//	var data_l = 
//	var json_l = JSON.parse(data_l);
	<?php //$i = 0; ?>
	//var left1 = <?php// print_r($left_sensor[0])?>
	var datee = $('#datee').val();
	var id_customer = $('#id_customer').val();
	var time_l = $('#timee').val();	
		
	var strCount = id_customer;
	var strCount = datee;
	var numStr = strCount.length;
	
	$.ajax({
    url: "function_m.php",
    type: "post",
    data:{_method:'json_all',
		 datee:datee,
		 id_customer:id_customer 
		 },
    dataType: "json",
    success: function(data) {
//		console.log(data.left_sensor);
//		console.log(data.right_sensor);
		var setleft = setInterval(function (t) {
		values = findLeftContourArray([		
		  
		 // data.left_sensor[0]	
		  
//		  Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600)
		  <?php 
//							  $result = mysqli_fetch_array($query);
//							  $left_1=$result['left_sensor1'];
//							  $left_2=$result['left_sensor2'];
//							  $left_3=$result['left_sensor3'];
//							  $left_4=$result['left_sensor4'];
//							  $left_5=$result['left_sensor5'];
//							echo($left_1.",".$left_2.",".$left_3.",".$left_4.",".$left_5."");
			//print_r($left_sensor[$i]);$i++;//ค่าตัวแปรที่จะแสดงแรงกดของเท้า		

		  ?>
			
			

//	    document.open(),
//      document.write(ileft),
//      document.close()
      ])
	
//	 	alert(ileft)
		//console.log(ileft);
		 if(data.number_all === ileft){
			 clearInterval(setleft)
		 }
			
		ileft++
//		console.log(ileft);
      contours
        .thresholds (d3.range(0, 600, 50))
        (values)
        .forEach(fill);
	}, 1000)
		}
	});
	});
	
	
	$( '#datee' ).keyup(function() {
	var iright = 0;
	var rightstop = <?=$num?>;
	<?php $new_l = $ileft=0?>;
	var setright = setInterval(function (ttr) {
      valuesright = findRightContourArray([
//        Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600)
//		  600,600,600,600,600
		  	<?php 
//							  $result = mysqli_fetch_array($query);
//							  $right_1=$result['right_sensor1'];
//							  $right_2=$result['right_sensor2'];
//							  $right_3=$result['right_sensor3'];
//							  $right_4=$result['right_sensor4'];
//							  $right_5=$result['right_sensor5'];
//							echo($right_1.",".$right_2.",".$right_3.",".$right_4.",".$right_5."");
		  	?>
      ])
//	  console.log(iright)
		 if(rightstop === iright){
			 clearInterval(setright)
		 }
	  iright++	
      contoursr
        .thresholds(d3.range(0, 600, 50))
        (valuesright)
        .forEach(fillr);
    }, 1000)
	});
	     
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
 
//
//      const left_x = [
//        3, 7, 3, 3,
//        5, 7, 5, 7,
//        3, 5, 7, 5,
//        7, 5, 7, 7,
//        3, 5, 7, 5,
//        7, 3, 5, 7
//      ]
//      const axis_y = [
//        3, 3, 5, 7,
//        7, 7, 11, 11,
//        13, 13, 13, 15,
//        15, 17, 17, 19,
//        21, 21, 21, 23,
//        23, 24, 24, 24
//      ]
//      const right_x = [
//        1.5, 5.5, 5.5, 1.5,
//        3.5, 5.5, 1.5, 3.5,
//        1.5, 3.5, 5.5, 1.5,
//        3.5, 1.5, 3.5, 1.5,
//        1.5, 3.5, 5.5, 1.5,
//        3.5, 1.5, 3.5, 5.5
//      ]
//	  
//	  ////////////////////////////////////////////////ค่าจุดของเท้า//////////////////////
//
//      const n = 8, m = 24;
//
//      function getColor(t) {
//        t = Math.max(0, Math.min(1, t));
//        return "rgb("
//          + Math.max(0, Math.min(255, Math.round(34.61 + t * (1172.33 - t * (10793.56 - t * (33300.12 - t * (38394.49 - t * 14825.05))))))) + ", "
//          + Math.max(0, Math.min(255, Math.round(23.31 + t * (557.33 + t * (1225.33 - t * (3574.96 - t * (1073.77 + t * 707.56))))))) + ", "
//          + Math.max(0, Math.min(255, Math.round(27.2 + t * (3211.1 - t * (15327.97 - t * (27814 - t * (22569.18 - t * 6838.66)))))))
//          + ")";
//      }
//		///////////////////////////ค่าสีของรองเท้า///////////////////////
//
//      function findLeftContourArray(lsensor) {
//        const dataleft = [
//          1, lsensor[0], 0, lsensor[1],
//          0, lsensor[2], 0, 0,
//          lsensor[3], 0, 0, 0,
//          0, 0, 0, 0,
//          0, lsensor[4], 0, 0,
//          0, 0, 0, 0
//        ]
//        var variogram = kriging.train(
//          dataleft,
//          left_x,
//          axis_y,
//          'exponential',
//          0,
//          100)
//        var lvalues = new Array(8 * 24)
//        for (let j = 0.5, k = 0; j < m; ++j) {
//          for (let i = 0.5; i < n; ++i, ++k) {
//            lvalues[k] = kriging.predict(i, j, variogram);
//            lvalues[k] = lvalues[k] > 0 ? lvalues[k] : 0;
//          }
//        }
//        return lvalues
//      }
//		
//	////////////////////////////////////////////////Left///////////////////
//		
//	function findRightContourArray(rsensor) {
//    const dataright = [
//      rsensor[0], 0, 0, rsensor[1],
//      0, rsensor[2], 0, 0,
//      0, 0, rsensor[3], 0,
//      0, 0, 0, 0,
//      0, rsensor[4], 0, 0,
//      0, 0, 0, 1
//    ]
//    var variogram = kriging.train(
//      dataright,
//      right_x,
//      axis_y,
//      'exponential',
//      0,
//      100)
//    var rvalues = new Array(8 * 24)
//    for (let j = 0.5, k = 0; j < m; ++j) {
//      for (let i = 0.5; i < n; ++i, ++k) {
//        rvalues[k] = kriging.predict(i, j, variogram);
//        rvalues[k] = rvalues[k] > 0 ? rvalues[k] : 0;
//      }
//    }
//    return rvalues;
//  }	
//		
//	////////////////////////////////////////////////Right///////////////////	
//
//      const thresholds = d3.range(0, 600, 50)
//      const color = d3.scaleSequential(getColor).domain(d3.extent(thresholds))
//
//      var data = findLeftContourArray([
//        Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600),
//        Math.floor(Math.random() * 600)
//      ])
//
//      console.log(data)
//		
//	/////////////////////////////////////////////////////ขาซ้าย	
//
//      document.getElementById("itemleft").innerHTML += '<svg width="1000" height="1000" stroke="#fff" stroke-width="0.5"></svg>';
//
//      var svg = d3.select("svg"),
//        width = +svg.attr("width"),
//        height = +svg.attr("height");
//		
//		console.log(svg);
//
//      var i0 = d3.interpolateHsvLong(d3.hsv(120, 1, 0.65), d3.hsv(60, 1, 0.90)),
//        i1 = d3.interpolateHsvLong(d3.hsv(60, 1, 0.90), d3.hsv(0, 0, 0.95)),
//        interpolateTerrain = function (t) { return t < 0.5 ? i0(t * 2) : i1((t - 0.5) * 2); };
//
//      svg.selectAll("path")
//        .data(d3.contours()
//          .size([8, 24])
//          .thresholds(d3.range(0, 600, 50))
//          (data))
//        .enter().append("path")
//        .attr("d", d3.geoPath(d3.geoIdentity().scale(width / 24)))
//        .attr("fill", function (d) { return color(d.value); });
//		
////		var myimage = svg.append('image')
////		.attr('xlink:href', '../images/foot_left.png')
////		.attr('width', width)
////		.attr('height', height)
//	  	
//		/////////////////////////////////////////////////ขาขวา

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
context_b.arc(142.5, 142.5, 8, 0, Math.PI*2, false);
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
	
context_r.fillStyle = "yellow";
context_r.beginPath();
context_r.arc(142.5, 142.5, 8, 0, Math.PI*2, false);
context_r.closePath();
context_r.lineWidth = 1;
context_r.strokeStyle = '#999';		
context_r.fill();
context_r.stroke();		
</script>
