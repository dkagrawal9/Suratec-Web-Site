<?php include 'header.php' ?>
<?php
	$sqlproduct = "SELECT `id_page`, `name_page` , `name_en_page` , `text` , `text_en` FROM `freedom_page` WHERE `id_page` = '3'";
    $queryproduct = mysqli_query($objConnect,$sqlproduct);
    $resultproduct = mysqli_fetch_array($queryproduct);

	$sqlservice = "SELECT `id_page`, `name_page` , `name_en_page` , `text` , `text_en` FROM `freedom_page` WHERE `id_page` = '4'";
    $queryservice = mysqli_query($objConnect,$sqlservice);
    $resultservice = mysqli_fetch_array($queryservice);

	$sqlwaystoserive = "SELECT `id_page`, `name_page` , `name_en_page` , `text` , `text_en` FROM `freedom_page` WHERE `id_page` = '5'";
    $querywaystoserive = mysqli_query($objConnect,$sqlwaystoserive);
    $resultwaystoserive = mysqli_fetch_array($querywaystoserive);
?>
<?php include_once 'common.php'; ?>
			<!-- Breadcrumbs -->
			<section class="breadcrumbs overlay bg-image" style="background-image: url(../uploads/mod_central_information/<?=$pic_header['value']?>)">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<!-- Bread Title -->
							<div class="bread-title">
								<h2><?=$lang['MENU_PRODUCT_AND_SERVICE'];?><!--Product And Service--></h2>
							</div>
							<!-- Bread List -->
							<ul class="bread-list">
								<li><a href="./?index=st"><i class="fa fa-home"></i><?=$lang['MENU_HOME'];?><!--Home--></a></li>
								<li class="active"><a href="product_and_service.php?product_and_service=st"><i class="fa fa-clone"></i><?=$lang['MENU_PRODUCT_AND_SERVICE'];?><!--Product And Service--></a></li>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<!--/ End Breadcrumbs -->
			
			<!-- Services -->
			<section class="services single section" style="padding: 30px 0 10px; background: #f8f8f8">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<!-- Single Service -->
							<div class="single-service">
								<?php
							$sqlimg = "SELECT * FROM images WHERE `id_category` = '6'";	 
							$resultimg = mysqli_query($objConnect,$sqlimg);
							while ($img = mysqli_fetch_array($resultimg,MYSQLI_BOTH))
								{

								?>
								<div class="image">
									<img src="../uploads/mod_image/<?=$img['name_image']?>" style="border-radius: 5px;" alt="#">
								</div>
						  <?php } ?>
								<!-- Services -->
			<!--/ End Services -->
							</div>
							<!--/ End Single Service -->
						</div>
					</div>
				</div>
			</section>
			<!--/ End Services -->
<!-- Services -->
			<section class="services archive section" style="padding: 40px 0 60px;">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="section-title" style="margin-bottom: 5px;">
								<h2></h2>
							</div>
						</div> 
					</div> 
					<div class="row">
						<div class="col-lg-12 col-md-6 col-12">
							<!-- Single Service -->
							<div class="single-service">
								<i class="icon front icofont icofont-boot-alt-1"></i>
								<i class="icon back icofont icofont-boot-alt-1"></i>
								<h4><a href="#">
												<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $resultproduct['name_page'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $resultproduct['name_en_page'];
													echo $name_text_en;
												 }
												?>
									</a></h4>
								<p>
												<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $resultproduct['text'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $resultproduct['text_en'];
													echo $name_text_en;
												 }
												?>
								</p>
							</div>
							<!--/ End Single Service -->
						</div>
						<div class="col-lg-12 col-md-6 col-12">
							<!-- Single Service -->
							<div class="single-service">
								<i class="icon front icofont icofont-military"></i>
								<i class="icon back icofont icofont-military"></i>
								<h4><a href="#">
												<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $resultservice['name_page'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $resultservice['name_en_page'];
													echo $name_text_en;
												 }
												?>
									</a></h4>
								<p>
												<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $resultservice['text'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $resultservice['text_en'];
													echo $name_text_en;
												 }
												?>
								</p>
							</div>
							<!--/ End Single Service -->
						</div>
						<div class="col-lg-12 col-md-6 col-12">
							<!-- Single Service -->
							<div class="single-service">
								<i class="icon front fa fa-users"></i>
								<i class="icon back fa fa-users"></i>
								<h4><a href="#">
												<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $resultwaystoserive['name_page'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $resultwaystoserive['name_en_page'];
													echo $name_text_en;
												 }
												?>
									</a></h4>
								<p>
												<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $resultwaystoserive['text'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $resultwaystoserive['text_en'];
													echo $name_text_en;
												 }
												?>
								</p>
							</div>
							<!--/ End Single Service -->
						</div>
					</div>
				</div>
			</section>
			<!--/ End Services -->
			
			<!-- Footer -->
			<?php include 'footer.php'?>
			<!--/ End footer -->
			
			<!-- Jquery JS -->
			<?php include 'footer_credit.php'?>

		</div>
    </body>
</html>