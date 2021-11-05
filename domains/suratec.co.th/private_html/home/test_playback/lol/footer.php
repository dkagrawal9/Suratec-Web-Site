<?php
$sql_icon = "SELECT * FROM mod_footer  WHERE del_flg = 0 ";
$query_icon = mysqli_query($objConnect, $sql_icon);

$sql11 = "SELECT `id_page`, `name_page`, `name_en_page` , `text` , `text_en` FROM `freedom_page` WHERE `id_page` = '11'";
$query11 = mysqli_query($objConnect,$sql11);
$result11 = mysqli_fetch_array($query11);

$sql12 = "SELECT `id_page`, `name_page`, `name_en_page` , `text` , `text_en` FROM `freedom_page` WHERE `id_page` = '12'";
$query12 = mysqli_query($objConnect,$sql12);
$result12 = mysqli_fetch_array($query12);

$sql13 = "SELECT `id_page`, `name_page`, `name_en_page` , `text` , `text_en` FROM `freedom_page` WHERE `id_page` = '13'";
$query13 = mysqli_query($objConnect,$sql13);
$result13 = mysqli_fetch_array($query13);

$sql14 = "SELECT `id_page`, `name_page`, `name_en_page` , `text` , `text_en` FROM `freedom_page` WHERE `id_page` = '14'";
$query14 = mysqli_query($objConnect,$sql14);
$result14 = mysqli_fetch_array($query14);
?>
<!-- Footer -->
			<footer class="footer">
				<div class="footer-top">
					<div class="container">
						<div class="row">
							<div class="col-lg-3 col-md-6 col-12">
								<!-- About Widget -->
								<div class="single-widget address" style="margin-top: 10px;"><!--../uploads/mod_central_information/<?//=$pic_logo['value']?>-->
									<img src="../images/SURATEC_White_text.png" width="110px;" height="50px;" alt="logo" style="margin-bottom: 5px;">
									<h2 style="padding-bottom: 0px;"><?=$lang['MENU_contact_us']?><!--Contact Us--></h2>
									<ul class="list">
										<li><i class="icofont icofont-phone"></i> 
											<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $tel['value'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $tel['value'];
													echo $name_text_en;
												 }
												?>
											</li>
										<li><i class="icofont icofont-ui-email"></i> 
											<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $email['value'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $email['value'];
													echo $name_text_en;
												 }
												?>
										</li>
										<li><i class="icofont icofont-location-arrow"></i> 
											<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $address['value'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $address['value'];
													echo $name_text_en;
												 }
												?>
										</li>
										<li><i class="icofont icofont-shopping-cart"></i> Mon - Fri : 
											<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $timeopen['value'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $timeopen['value'];
													echo $name_text_en;
												 }
												?>
											       Closed</li>
									</ul>
								</div>
								<!--/ End About Widget -->
							</div>	
							<div class="col-lg-3 col-md-6 col-12">
								<!-- Links Widget -->
								<div class="single-widget links" style="margin-top: 10px;">
									<h2><?=$lang['MENU_Policy'];?><!--Policy--></h2>
									<ul class="list">
										<li><a href="terms_of_use.php?terms_of_use=st"><i class="fa fa-caret-right"></i>
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
											</a></li>
										<li><a href="privacy_policy.php?privacy_policy=st"><i class="fa fa-caret-right"></i>
												<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $result12['name_page'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $result12['name_en_page'];
													echo $name_text_en;
												 }
												?>
											</a></li>
										<li><a href="data_protection_policy.php?data_protection_policy=st"><i class="fa fa-caret-right"></i>
												<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $result13['name_page'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $result13['name_en_page'];
													echo $name_text_en;
												 }
												?>
											</a></li>
										<li><a href="refund_policy.php?refund_policy=st"><i class="fa fa-caret-right"></i>
												<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $result14['name_page'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $result14['name_en_page'];
													echo $name_text_en;
												 }
												?>
											</a></li>
									</ul>
								</div>
								<!--/ End Links Widget -->
							</div>
							<div class="col-lg-3 col-md-6 col-12">
								<!-- Posts Widget -->
								<div class="single-widget posts" style="margin-top: 10px;">
									<h2><?=$lang['MENU_Article']?> <?=$lang['MENU_News']?><!--News article--></h2>
									<ul>
										<li><a href="./article.php"><img src="../images/seo-article-icon.png" alt="#"><?=$lang['MENU_Article']?><!--Article--></a></li>
										<li><a href="./news.php"><img src="../images/news_logo.png" alt="#"><?=$lang['MENU_News']?><!--News--></a></li>
									</ul>
								</div>
								<!--/ End Posts Widget -->
							</div>
							<div class="col-lg-3 col-md-6 col-12">
								<!-- Address Widget -->
								<div class="single-widget about" style="margin-top: 10px;">
									<h2><?=$lang['MENU_ABOUT_US'];?><!--About Us--></h2>
									<ul class="list">
										<li><?=$titel['value']?></li>
									</ul>
									<ul class="social">
										<?php while($res_icon = mysqli_fetch_array($query_icon)){  ?>
										<li><a href="<?=$res_icon['linked']?>" style="border: 0px solid #fff"><img src="../uploads/mod_manage_links/<?=$res_icon['icon']?>" alt="" width="30" style="border-radius: 20%;"></a></li>
										<?php  } ?>
									</ul>
								</div>
								<!--/ End Address Widget -->
							</div>	
						</div>
					</div>
				</div>
<!--/ End footer -->