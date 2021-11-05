<?php include 'header.php'
?>
<?php
$sql = "SELECT * FROM slide
LEFT JOIN slide_image ON  slide.id_slide = slide_image.id_slide
ORDER BY slide.level ASC ";
$query = mysqli_query($objConnect, $sql);

	$sqloffice = "SELECT `id_page`, `name_page`, `text`, `text_en` FROM `freedom_page` WHERE `id_page` = '2'";
    $queryoffice = mysqli_query($objConnect,$sqloffice);
    $resultoffice = mysqli_fetch_array($queryoffice);

	$sqltexteffect = "SELECT `id_page`, `name_page`, `text` , `text_en` FROM `freedom_page` WHERE `id_page` = '10'";
    $querytexteffect = mysqli_query($objConnect,$sqltexteffect);
    $resulttexteffect = mysqli_fetch_array($querytexteffect);

  $sqlart = "SELECT * FROM article WHERE id_catagory = '8' AND `delete_datetime` is null ORDER BY id_article DESC LIMIT 1";
  $queryart = mysqli_query($objConnect, $sqlart);
  $resultart = mysqli_fetch_array($queryart);

?>
<?php
function DateThai($strDate) {
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("j", strtotime($strDate));
        $strMonthCut = Array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
    }
?>
<?php include_once 'common.php'; ?>
			<!-- Hero Area -->
			<section class="hero-area">
				<div class="hero-slider">
					<?php $i_silde = 1 ;while ( $res_slide = mysqli_fetch_array($query) ) 
						{ ?>
					<!-- Single Slider -->
					<div class="single-slider" style="background-image:url('../uploads/slide/<?=$res_slide['name_image'] ?>')">
						<div class="container">
							<div class="row">
								<div class="col-lg-7 offset-lg-5 col-12">
									<div class="slider-text align-right">
										<div class="text-inner text-right">
											<span class="short">
												<?php
												if($lang_file == 'lang.th.php'){
													$name_sl = $res_slide['name_slide'];
													echo $name_sl;
												}
												 else{
													 $name_sl_en = $res_slide['name_slide_en'];
													echo $name_sl_en;
												 }
												?></span>
											<p>
												<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $res_slide['text'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $res_slide['text_en'];
													echo $name_text_en;
												 }
												?>
											</p>
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--/ End Single Slider -->
					<?php } ?>
				</div>
			</section>
			<!--/ End Hero Area -->

			<!-- Services -->
			<section class="services section">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="section-title">
								<h2><?=$lang['MENU_office'];?></h2>
							</div>
						</div> 
					</div>
					<div class="row">
												<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $resultoffice['text'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $resultoffice['text_en'];
													echo $name_text_en;
												 }
												?>
						
					</div>	
				</div>
			</section>
			<!--/ End Services -->
			
			<!-- Start CTA -->
			<section class="call-to-action overlay dzsparallaxer auto-init height-is-based-on-content use-loading mode-scroll out-of-bootstrap" data-options='{ direction: "normal"}'>
				<?php
							$sqlimg = "SELECT * FROM images WHERE `id_category` = '9' ORDER BY `date_action` DESC LIMIT 1";	 
							$resultimg = mysqli_query($objConnect,$sqlimg);
							while ($img = mysqli_fetch_array($resultimg,MYSQLI_BOTH))
								{

								?>
				<div class="overlay divimage dzsparallaxer--target bg-image" style="width: 100%; height: 150%; background-image: url(../uploads/mod_image/<?=$img['name_image']?>)"></div>
				<?php } ?>
				<div class="call-to-main">
					<div id="particles-js"></div>
					<div class="container">
						<div class="row">
							<div class="col-lg-10 offset-lg-1 col-12">
								<div class="text-inner">
									<div class="call-text">
										<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $resulttexteffect['text'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $resulttexteffect['text_en'];
													echo $name_text_en;
												 }
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--/ End CTA -->
			
			<!-- CountDown -->
			<section class="countdown section" style="padding-bottom: 10px;">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="section-title">
								<h2><?=$lang['MENU_Customer_reviews'];?></h2>
							</div>
						</div> 
					</div> 
				</div>	
				<!--/ End Counter -->
			</section>
			<!--/ End CountDown -->
			
			<!-- Testimonials -->
			<section class="testimonials" style="black">
				<!-- Testimonial Video -->
				<?php
							$sqlimg = "SELECT * FROM images WHERE `id_category` = '10' ORDER BY `date_action` DESC LIMIT 1";	 
							$resultimg = mysqli_query($objConnect,$sqlimg);
							while ($img = mysqli_fetch_array($resultimg,MYSQLI_BOTH))
								{

								?>
				<div class="t-video">
			    	<img src="../uploads/mod_image/<?=$img['name_image']?>" width="100%" height="100%" alt=""/>
				</div>
				<?php } ?>
				<!--/ End Testimonial Video -->
			  <div class="container">
					<div class="row">
						<div class="col-lg-6 col-12">
							<!-- News Blog -->
							<div class="blogs" style="margin-bottom: 10px;">	
								<!-- Blog Slider -->
								<div class="blog-slider">
									<!-- Single Slider -->
<?php
	$sqlnew = "SELECT * FROM article WHERE id_catagory = '8' AND `delete_datetime` is null ORDER BY id_article DESC LIMIT 3";
	$resultnew = mysqli_query($objConnect,$sqlnew);
	while ($new = mysqli_fetch_array($resultnew,MYSQLI_BOTH))
		{
?>
									<div class="single-blog">
										<div class="blog-head">
											<!--<div class="date">15<span>Jun</span></div>-->
											<a href="./articledetail.php?id=<?=$new['id_article'];?>"><img src="../uploads/mod_article/<?=$new['image'];?>" style="600" height="300" alt="#"></a>
										</div>
										<div class="blog-bottom">
											<h4><a href="./articledetail.php?id=<?=$new['id_article'];?>">
												<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $new['name_article'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $new['name_article_en'];
													echo $name_text_en;
												 }
												?>
												</a></h4>
											<p>
												<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $new['text'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $new['text_en'];
													echo $name_text_en;
												 }
												?>
											</p>
											<ul class="blog-meta">
												<?php
													$date_ads = DateThai($new['create_datetime']);
												?>
												<li><i class="fa fa-calendar"></i><?=$date_ads;?></li>
												
												<!--<li><a href="#"><i class="fa fa-comments"></i>30 Comments</a></li>
												<li><a href="#"><i class="fa fa-tags"></i>Creative, Agency</a></li>-->
											</ul>
											<ul class="blog-meta">
												<li class="author">
													<img src="<?php
                                        $imgcom = $news['create_by'];
                                        
                                        if($imgcom == null)
                                        {  
                                            echo "../img/bg-img/25.jpg";
                                        }
                                        else
                                        {
                                            echo "../img/bg-img/25.jpg";
                                        }

                                    ?>" alt="#"><span>By: <!--<a href="#">-->ไม่ได้ระบุ<!--</a>--></span></li>
												<li><a href="./articledetail.php?id=<?=$new['id_article'];?>">
													<i class="fa fa-comments"></i>
<?php
	$sqlcom = "SELECT * FROM article_opinion WHERE `id_article` = '".$new['id_article']."' AND `delete_datetime` is null ORDER BY `article_opinion`.`id` DESC";
	$resultcom = mysqli_query($objConnect,$sqlcom);
	while ($comart = mysqli_fetch_array($resultcom,MYSQLI_BOTH))
		{
		
?>
													<?php } ?>
													ความคิดเห็น</a></li>
												<!--<li><i class="fa fa-share-alt"></i>840 Share</li>-->
											</ul>
										</div>
									</div>
									<?php } ?>
									<!--/ End Single Slider -->
								</div>
								<!--/ End Blog Slider -->
							</div> 
							<!--/ End News Blog -->
						</div>
					</div>
				</div>
			</section>
			<!--/ End Testimonials -->

<!-- CountDown -->
			<section class="countdown section" style="padding-bottom: 10px;">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="section-title">
								<h2><?=$lang['MENU_News'];?> <?=$lang['MENU_And'];?> <?=$lang['MENU_Frequently_Asked_Questions'];?></h2>
							</div>
						</div> 
					</div> 
				</div>	
				<!--/ End Counter -->
			</section>
			<!--/ End CountDown -->
			
			<!-- Blog & Faqs -->
			<section class="multi-section section">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-12">
							<!-- News Blog -->
							<div class="blogs">
								<div class="section-title text-left">
									<h2><?=$lang['MENU_News'];?></h2>
								</div>
								<!-- Blog Slider -->
								<div class="blog-slider">
									<!-- Single Slider -->
<?php
	$sqlnew = "SELECT * FROM article WHERE id_catagory = '9' AND `delete_datetime` is null ORDER BY id_article DESC LIMIT 3";
	$resultnew = mysqli_query($objConnect,$sqlnew);
	while ($new = mysqli_fetch_array($resultnew,MYSQLI_BOTH))
		{
?>
									<div class="single-blog">
										<div class="blog-head">
											<!--<div class="date">15<span>Jun</span></div>-->
											<a href="./newsdetail.php?id=<?=$new['id_article'];?>"><img src="../uploads/mod_article/<?=$new['image'];?>" style="600" height="300" alt="#"></a>
										</div>
										<div class="blog-bottom">
											<h4><a href="./newsdetail.php?id=<?=$new['id_article'];?>">
												<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $new['name_article'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $new['name_article_en'];
													echo $name_text_en;
												 }
												?>
												</a></h4>
											<p>
												<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $new['text'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $new['text_en'];
													echo $name_text_en;
												 }
												?>
											</p>
											<ul class="blog-meta">
												<?php
													$date_ads = DateThai($new['create_datetime']);
												?>
												<li><i class="fa fa-calendar"></i><?=$date_ads;?></li>
												
												<!--<li><a href="#"><i class="fa fa-comments"></i>30 Comments</a></li>
												<li><a href="#"><i class="fa fa-tags"></i>Creative, Agency</a></li>-->
											</ul>
											<ul class="blog-meta">
												<li class="author">
													<img src="<?php
                                        $imgcom = $news['create_by'];
                                        
                                        if($imgcom == null)
                                        {  
                                            echo "../img/bg-img/25.jpg";
                                        }
                                        else
                                        {
                                            echo "../img/bg-img/25.jpg";
                                        }

                                    ?>" alt="#"><span>By: <!--<a href="#">-->ไม่ได้ระบุ<!--</a>--></span></li>
												<!--<li><a href="#"><i class="fa fa-comments"></i>592 Comments</a></li>
												<li><i class="fa fa-share-alt"></i>840 Share</li>-->
											</ul>
										</div>
									</div>
									<?php } ?>
									<!--/ End Single Slider -->
								</div>
								<!--/ End Blog Slider -->
							</div> 
							<!--/ End News Blog -->
						</div> 
						<div class="col-lg-6 col-12">
							<div class="faqs-main">
								<div class="section-title text-left">
									<h2><?=$lang['MENU_Frequently_Asked_Questions'];?></h2>
								</div>
								<!-- Faqs Area -->
								<div class="faq-area">
<?php
	$sqlq = "SELECT `id`, `question`, `answer` FROM `faq` WHERE `del_flg` = '0' ORDER BY `order` ASC LIMIT 5";
	$resultq = mysqli_query($objConnect,$sqlq);
	while ($q = mysqli_fetch_array($resultq,MYSQLI_BOTH))
		{
?>
									<div id="accordion-one"  role="tablist">
										<!-- Single Faq -->
										<div class="single-faq active">
											<div class="faq-heading" role="tab" id="faq<?=$q['id'];?>">
											  <h4 class="faq-title">
												<a data-toggle="collapse" href="#<?=$q['id'];?>" aria-expanded="true" aria-controls="<?=$q['id'];?>"><i class="fa fa-question-circle-o"></i>Q : 
												<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $q['question'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $q['question'];
													echo $name_text_en;
												 }
												?>
												  </a>
											  </h4>
											</div>
											<div id="<?=$q['id'];?>" class="collapse show" role="tabpanel" aria-labelledby="faq<?=$q['id'];?>" data-parent="#accordion-one">
											  <div class="faq-body">
												<p>A : 
												<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $q['answer'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $q['answer'];
													echo $name_text_en;
												 }
												?>
												</p>
											  </div>
											</div>
										</div>
										<!--/ End Single Faq -->
									</div>
									<?php } ?>
								</div>
								<!--/ End Faqs Area -->
							</div> 
						</div> 
					</div> 
				</div>
			</section>
			<!--/ End Blog & Faqs -->
			
<?php include 'footer.php'?>
<?php include 'footer_credit.php'?>
			<!-- Particles JS -->
			<script src="../js/particles.min.js"></script>
			<script src="../js/particle-active.js"></script>
		</div>
    </body>
</html>