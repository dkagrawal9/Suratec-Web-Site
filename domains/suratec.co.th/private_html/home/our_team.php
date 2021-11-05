<?php include 'header.php'
?>
<?php include_once 'common.php'; ?>
			<!-- Breadcrumbs -->
			<section class="breadcrumbs overlay bg-image" style="background-image: url(../uploads/mod_central_information/<?=$pic_header['value']?>)">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<!-- Bread Title -->
							<div class="bread-title">
								<h2><?=$lang['MENU_our_team'];?><!--Our Team--></h2>
							</div>
							<!-- Bread List -->
							<ul class="bread-list">
								<li><a href="./?index=st"><i class="fa fa-home"></i><?=$lang['MENU_HOME'];?><!--Home--></a></li>
								<li class="active"><a href="our_team.php?our_team=st"><i class="fa fa-clone"></i><?=$lang['MENU_our_team'];?><!--Our Team--></a></li>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<!--/ End Breadcrumbs -->

			<!-- Team -->
			<section class="team section" style="padding: 70px 0 50px;">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="section-title">
								<h2><?=$lang['MENU_Team'];?></h2>
							</div>
						</div> 
					</div> 
					<div class="row">
						<?php
							$sqldirector = "SELECT img_drirect,img_name,name,position,name_en,position_en,order_no FROM mod_team WHERE delete_date IS NULL ORDER BY order_no ASC";
							$resultdirector = mysqli_query($objConnect,$sqldirector);
							while ($director = mysqli_fetch_array($resultdirector,MYSQLI_BOTH))
								{
						?>
						<div class="col-lg-3 col-md-6 col-12">
							<!-- Single Team -->
							<div class="team-main">
								<!-- Team Front -->
								<div class="single-team front">
									<div class="team-head">
										<img src="<?php
                                        $imgcom = $director['img_name'];
										$img_drirect = $director['img_drirect'];
                                        
                                        if($imgcom == null)
                                        {  
                                            echo "../images/470x495.jpg";
                                        }
                                        else
                                        {
                                            echo $img_drirect.'/'.$imgcom;
                                        }

                                    ?>" width="285" height="285" alt="#">
									</div>
								</div>
								<!--/ End Team Front -->
								<!-- Team Back -->
								<div class="single-team back">
									<div class="team-bottom">
										<h4><span style="color: aliceblue;">
												<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $director['position'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $director['position_en'];
													echo $name_text_en;
												 }
												?>
											</span>
												<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $director['name'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $director['name_en'];
													echo $name_text_en;
												 }
												?> 
												<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $director['surname'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $director['surname'];
													echo $name_text_en;
												 }
												?>
											  </h4>
									</div>
									<!--<ul class="social">
										<li><a href="#"><i class="icofont icofont-social-twitter"></i></a></li>
										<li><a href="#"><i class="icofont icofont-social-linkedin"></i></a></li>
										<li><a href="#"><i class="icofont icofont-social-dribbble"></i></a></li>
									</ul>-->
									<!--<a href="#" class="btn animate">Visit Website</a>-->
								</div>
								<!--/ End Team Back -->
							</div>
							<!--/ End Single Team -->
						</div>
						<?php } ?>
					</div>
				</div>
			</section>

			<!--/ End Team -->
			
			<!-- Footer -->
			<?php include 'footer.php'?>
			<!--/ End footer -->
			<?php include 'footer_credit.php'?>	
		</div>
    </body>
</html>