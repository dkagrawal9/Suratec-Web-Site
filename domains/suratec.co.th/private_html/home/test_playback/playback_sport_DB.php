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


?>
<?php include_once 'common.php'; ?>
<link rel="stylesheet" href="../admin/plugins/sweetalert2/dist/sweetalert2.min.css">
<link rel="stylesheet" href="table.css">
    <script src="../admin/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
<style>
	.tablle_{
		border-top: 1px solid;
		border-bottom: 1px solid;
		background-color: #cccccc;
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
										<li><a href="playback_sport.php"><i class="fa fa-list"></i>Pressure Map</a></li>			
										<li><a href="playback_sport_GA.php"><i class="fa fa-handshake-o"></i>Gait Analysis</a></li>			
										<li><a href="playback_sport_BB.php"><i class="fa fa-gavel"></i>Balance Board</a></li>			
										<li class="active"><a href="playback_sport_DB.php"><i class="fa fa-globe"></i>Dasboard</a></li>						
									</ul>
								</div>
								<!--/ End Service Category -->
							</div>
							<!--/ End Service Sidebar -->
						</div>
						<div class="col-lg-5 col-12">
							<span>สรุป Peak Pressure (%)</span>
								<div style="overflow-x:auto;">
								<table class="table" border="1">
									<thead>
    <tr>
      <th width="50%" style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">Zone</th>
      <th width="25%" style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">การเดิน</th>
      <th width="25%" style="border-top: 1px solid;border-bottom: 1px solid;background-color: #cccccc;">การวิ่ง</th>
    </tr>
									</thead>
  <tbody>
    <tr>
      <td>Toe</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Lesser Toe</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Medial Metatarsal</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Lateral Metatarsal</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Medial Midfoot</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Lateral Midfoot</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Heal</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
							</div>
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
  <tbody>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
							</div>
						</div>
						<div class="col-lg-4 col-12"><br>
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
									<span>1:10:20</span>
								</div>
								<div class="col-lg-1 col-12">	
								</div>
								<div class="col-lg-5 col-12" style="border-bottom: 1px solid; border-left: 1px solid; border-right: 1px solid;">
									<span>2 min/km.</span>
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
								<div class="col-lg-5" style="border-bottom: 1px solid; border-left: 1px solid; border-right: 1px solid;">
									<select>
									  <option value="Zone">Zone&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
									  <option value="Toe">Toe</option>
									</select>	
									<span>45 KPS</span>
								</div>
								<div class="col-lg-1">	
								</div>
								<div class="col-lg-5" style="border-bottom: 1px solid; border-left: 1px solid; border-right: 1px solid;">
									<span>10</span>
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
