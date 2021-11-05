<?php include 'header.php'
?>
<?php
	$sqlaboutus = "SELECT `id_page`, `name_page`, `name_en_page` , `text` , `text_en` FROM `freedom_page` WHERE `id_page` = '6'";
    $queryaboutus = mysqli_query($objConnect,$sqlaboutus);
    $resultaboutus = mysqli_fetch_array($queryaboutus);
	
	$sqlMission = "SELECT `id_page`, `name_page`, `name_en_page` , `text` , `text_en` FROM `freedom_page` WHERE `id_page` = '7'";
    $queryMission = mysqli_query($objConnect,$sqlMission);
    $resultMission = mysqli_fetch_array($queryMission);

	$sqlstory = "SELECT `id_page`, `name_page`, `name_en_page` , `text` , `text_en` FROM `freedom_page` WHERE `id_page` = '8'";
    $querystory = mysqli_query($objConnect,$sqlstory);
    $resultstory = mysqli_fetch_array($querystory);

	$sqlaward = "SELECT `id_page`, `name_page`, `name_en_page` , `text` , `text_en` FROM `freedom_page` WHERE `id_page` = '9'";
    $queryaward = mysqli_query($objConnect,$sqlaward);
    $resultaward = mysqli_fetch_array($queryaward);
?>
<?php include_once 'common.php'; ?>
			<!-- Breadcrumbs -->
			<section class="breadcrumbs overlay bg-image" style="background-image: url(../uploads/mod_central_information/<?=$pic_header['value']?>)">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<!-- Bread Title -->
							<div class="bread-title">
								<h2><?=$lang['MENU_ABOUT_US'];?><!--About Us--></h2>
							</div>
							<!-- Bread List -->
							<ul class="bread-list">
								<li><a href="./?index=st"><i class="fa fa-home"></i><?=$lang['MENU_HOME'];?><!--Home--></a></li>
								<li class="active"><a href="about_us.php?about_us=st"><i class="fa fa-clone"></i><?=$lang['MENU_ABOUT_US'];?><!--About Us--></a></li>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<!--/ End Breadcrumbs -->

		<!-- About Us -->
			<section id="about-us" class="about-us section" style="padding: 70px 0 30px;">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="section-title">
								<h2></h2>
							</div>
						</div> 
					</div>
					<div class="row"> 
						<div class="col-lg-6 col-12">
							<!-- About Gallery -->
							<div class="about-gallery">
						<?php
							$sqlimg = "SELECT * FROM images WHERE `id_category` = '7'";	 
							$resultimg = mysqli_query($objConnect,$sqlimg);
							while ($img = mysqli_fetch_array($resultimg,MYSQLI_BOTH))
								{

						?>
								<div class="single-gallery">
									<img src="../uploads/mod_image/<?=$img['name_image']?>" alt="#">
									<!--./uploads/mod_image/<?//=$img['name_image']?>-->
								</div>
						<?php } ?>		
								<!--<div class="single-gallery">
									<img src="http://via.placeholder.com/900x600" alt="#">
								</div>-->
							</div>
							<!--/ End About Gallery -->
						</div>
						<div class="col-lg-6 col-12">
							<div class="about-main">
								<div class="tab-main">
									<div class="nav-main">
										<!-- Tab Nav -->
										<ul class="nav nav-tabs" id="myTab" role="tablist">
											<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab1" role="tab"><i class="fa fa-pencil"></i>
												<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $resultaboutus['name_page'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $resultaboutus['name_en_page'];
													echo $name_text_en;
												 }
												?>
												</a></li>
											<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab2" role="tab" ><i class="fa fa-bank"></i>
												<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $resultMission['name_page'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $resultMission['name_en_page'];
													echo $name_text_en;
												 }
												?>
												</a></li>
											<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab3" role="tab" ><i class="fa fa-globe "></i>
												<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $resultstory['name_page'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $resultstory['name_en_page'];
													echo $name_text_en;
												 }
												?>
												</a></li>
											<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab4" role="tab"><i class="fa fa-trophy"></i>
												<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $resultaward['name_page'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $resultaward['name_en_page'];
													echo $name_text_en;
												 }
												?>
												</a></li>
										</ul>
										<!--/ End Tab Nav -->
									</div>
									<div class="tab-content" id="myTabContent">
										<!-- Tab One -->
										<div class="tab-pane fade show active" id="tab1" role="tabpanel">
											<div class="text-content">
												<p>
												<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $resultaboutus['text'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $resultaboutus['text_en'];
													echo $name_text_en;
												 }
												?>
												</p>
											</div>
										</div>
										<!--/ End Tab One -->
										<!-- Tab Two -->
										<div class="tab-pane fade" id="tab2" role="tabpanel">
											<div class="text-content">
												<p>
												<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $resultMission['text'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $resultMission['text_en'];
													echo $name_text_en;
												 }
												?>
												</p>
											</div>
										</div>
										<!--/ End Tab Two -->
										<!-- Tab Two -->
										<div class="tab-pane fade" id="tab3" role="tabpanel">
											<div class="text-content">
												<p>
												<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $resultstory['text'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $resultstory['text_en'];
													echo $name_text_en;
												 }
												?>
												</p>
											</div>
										</div>
										<!--/ End Tab Two -->
										<!-- Tab Two -->
										<div class="tab-pane fade" id="tab4" role="tabpanel">
											<div class="text-content">
												<p>
												<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $resultaward['text'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $resultaward['text_en'];
													echo $name_text_en;
												 }
												?>
												</p>
											</div>
										</div>
										<!--/ End Tab Two -->
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="skills-circle">
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--/ End About Us -->
			
			<!-- Footer -->
			<?php include 'footer.php'?>
			<!--/ End footer -->
			<?php include 'footer_credit.php'?>	
		</div>
    </body>
</html>