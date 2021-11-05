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

$id = $_SESSION['id_customer'];

$sqlpro = "SELECT   *,mod_customer.telephone AS telephone ,mod_customer.id_customer AS id_customer, mod_customer.fname AS fname, mod_customer.lname AS lname FROM  mod_customer 
LEFT JOIN tbl_member ON mod_customer.id_customer = tbl_member.id_data_role
LEFT JOIN  mod_customer_address ON mod_customer_address.id_customer = mod_customer.id_customer
WHERE  mod_customer.id_customer = '$id' ";

 //echo $sqlpro;

$queryPro = mysqli_query($objConnect, $sqlpro);
$resultPro = mysqli_fetch_array($queryPro);

// var_dump($_SESSION);


?>
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
										<li class="active"><a href="playback_phy_BB.php"><i class="fa fa-gavel"></i>Balance Board</a></li>			
										<li><a href="playback_phy_DB.php"><i class="fa fa-globe"></i>Dasboard</a></li>						
									</ul>
								</div>
								<!--/ End Service Category -->
							</div>
							<!--/ End Service Sidebar -->
						</div>
						<div class="col-lg-1 col-12">
						</div>
						<div class="col-lg-3 col-12">
							<div class="row" style="text-align: center;" id="mycan_l">
								<canvas id="myCanvas_l" width="285" height="285" style="border:1px solid #d3d3d3;"></canvas>
							</div>
<br>
<div class="col-lg-12">
<div class="row">
<div class="col-lg-6">	
<table width="100%" border="1" cellspacing="0" cellpadding="0" style="text-align: center;">
  <tbody>
    <tr>
      <td style="background: #cccccc;">Time in zone</td>
    </tr>
    <tr>
      <td>0 s</td>
    </tr>
  </tbody>
</table>
</div>
<div class="col-lg-6">	
<table width="100%" border="1" cellspacing="0" cellpadding="0" style="text-align: center;">
  <tbody>
    <tr>
      <td style="background: #cccccc;">Score</td><!-- Balance  -->
    </tr>
    <tr>
      <td>0 </td>
    </tr>
  </tbody>
</table>
</div>	
</div>	
</div><br>
<div class="col-lg-12">
<div class="row">
<div class="col-lg-12">	
<table width="100%" border="1"style="text-align: center; border:#CCCCCC">
  <tbody>
    <tr>
		<td style="background: #cccccc;">การทรงตัว : พอใช้</td>
    </tr>
    <tr>
		<td style="padding: 7px;"><span style="font-size: 14px;">หมั่นฝึกฝนต่อไป เพื่อการทรงตัวที่ดียิ่งขึ้น</span></td>
    </tr>
  </tbody>
</table>
</div>	
</div>	
</div>		
						</div>
						<div class="col-lg-1 col-12">
						</div>	
						<div class="col-lg-3 col-12">
							<div class="row" style="text-align: center;" id="mycan_r" >
							<canvas id="myCanvas_r" width="285" height="285" style="border:1px solid #d3d3d3;"></canvas>
							</div>
<br>
<div class="col-lg-12">
<div class="row">
<div class="col-lg-6">	
<table width="100%" border="1" style="text-align: center;">
  <tbody>
    <tr>
      <td style="background: #cccccc;">Time in zone</td>
    </tr>
    <tr>
      <td>0 s</td>
    </tr>
  </tbody>
</table>
</div>
<div class="col-lg-6">	
<table width="100%" border="1" style="text-align: center;">
  <tbody>
    <tr>
      <td style="background: #cccccc;">Score</td><!-- Balance  -->
    </tr>
    <tr>
      <td>0 </td>
    </tr>
  </tbody>
</table>
</div>	
</div>	
</div>
<br>
<div class="col-lg-12">
<div class="row">
<div class="col-lg-12">	
<table width="100%" border="1"style="text-align: center; border:#CCCCCC">
  <tbody>
    <tr>
		<td style="background: #cccccc;">การทรงตัว : พอใช้</td>
    </tr>
    <tr>
		<td style="padding: 7px;"><span style="font-size: 14px;">หมั่นฝึกฝนต่อไป เพื่อการทรงตัวที่ดียิ่งขึ้น</span></td>
    </tr>
  </tbody>
</table>
</div>	
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