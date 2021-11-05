<?php include 'header.php' ?>
<?php
$sql11 = "SELECT `id_page`, `name_page`, `name_en_page` , `text` , `text_en` FROM `freedom_page` WHERE `id_page` = '11'";
$query11 = mysqli_query($objConnect,$sql11);
$result11 = mysqli_fetch_array($query11);
?>
<?php include_once 'common.php'; ?>
			<!-- Breadcrumbs -->
			<section class="breadcrumbs overlay bg-image" style="background-image: url(../uploads/mod_central_information/<?=$pic_header['value']?>)">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<!-- Bread Title -->
							<div class="bread-title">
								<h2><?php
												if($lang_file == 'lang.th.php'){
													$name_text = $result11['name_page'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $result11['name_en_page'];
													echo $name_text_en;
												 }
												?><!--Product And Service--></h2>
							</div>
							<!-- Bread List -->
							<ul class="bread-list">
								<li><a href="./?index=st"><i class="fa fa-home"></i><?=$lang['MENU_HOME'];?><!--Home--></a></li>
								<li class="active"><a href="terms_of_use.php?terms_of_use=st"><i class="fa fa-clone"></i><?php
												if($lang_file == 'lang.th.php'){
													$name_text = $result11['name_page'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $result11['name_en_page'];
													echo $name_text_en;
												 }
												?><!--Product And Service--></a></li>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<!--/ End Breadcrumbs -->
			
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
								<i class="icon front icofont icofont-ui-file"></i>
								<i class="icon back icofont icofont-ui-file"></i>
								<h4><a href="#">
												<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $result11['name_page'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $result11['name_en_page'];
													echo $name_text_en;
												 }
												?>
									</a></h4>
								<p>
												<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $result11['text'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $result11['text_en'];
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