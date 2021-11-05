<?php include_once 'common.php'; ?>
<?php
	  require_once '../admin/library/connect.php';

  $sql = "SELECT * FROM article WHERE id_catagory = '9' AND `delete_datetime` is null AND `id_article` = '".$_GET['id']."'";
  $query = mysqli_query($objConnect, $sql);
  $resultnews = mysqli_fetch_array($query);
?>
<?php
$sql_icon = "SELECT * FROM mod_footer  WHERE del_flg = 0 ";
$query_icon = mysqli_query($objConnect, $sql_icon);
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

  function DateEng($strDate)
 {
     $strYear = date("Y", strtotime($strDate));
     $strMonth = date("n", strtotime($strDate));
     $strDay = date("j", strtotime($strDate));
     $strMonthCut = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
     $strMonthThai = $strMonthCut[$strMonth];
     return "$strDay $strMonthThai $strYear";
 }

?><head>
<meta charset="utf-8">
        <meta property="og:url"           content="https://www.suratec.co.th/home/newsdetail.php?id=<?=$_GET['id']?>" />
        <meta property="og:type"          content="website" />
		<meta property="og:title"         content='<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $resultnews['name_article'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $resultnews['name_article_en'];
													echo $name_text_en;
												 }
												?>'  />
		<meta property="og:description"   content='<?php
												if($lang_file == 'lang.th.php'){
													$name_text = $resultnews['text'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $resultnews['text_en'];
													echo $name_text_en;
												 }
												?>'  />
        <meta property="og:image"         content="https://www.suratec.co.th/uploads/mod_article/<?=$resultnews['image'];?>" />
	
</head>
<?php include 'header.php';

	$pageURL = 'http';

if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
	
    $pageURL .= "s";
}

$pageURL .= "://";

if ($_SERVER["SERVER_PORT"] != "80") {
    $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	
} else {
    $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
}

?>

			<!-- Breadcrumbs -->
			

<section class="breadcrumbs overlay bg-image" style="background-image: url(../uploads/mod_central_information/<?=$pic_header['value']?>)">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<!-- Bread Title -->
							<div class="bread-title">
								<h2><?=$lang['MENU_news_details'];?><!--Our Team--></h2>
							</div>
							<!-- Bread List -->
							<ul class="bread-list">
								<li><a href="./?index=st"><i class="fa fa-home"></i><?=$lang['MENU_HOME'];?><!--Home--></a></li>
								<li class="active"><a href="newsdetail.php?id=<?=$resultnews['id_article'];?>"><i class="fa fa-clone"></i> <?=$lang['MENU_news_details'];?> <!--Our Team--></a></li>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<!--/ End Breadcrumbs -->
			
			<!-- Blog Archive -->
			<section class="blogs archive single section">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-12">
							<div class="row">
								<div class="col-12">
									<!-- Single blog -->
									<div class="single-blog">
										<div class="blog-head">
											<center><img src="../uploads/mod_article/<?=$resultnews['image'];?>" width="540" height="350" alt="#" style ="border-radius: 5%;"></center>
										</div>
										<div class="blog-description">
											<h1><a href="newsdetail.php?id=<?=$resultnews['id_article'];?>"><?php
												if($lang_file == 'lang.th.php'){
													$name_text = $resultnews['name_article'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $resultnews['name_article_en'];
													echo $name_text_en;
												 }
												?></a></h1>
											<ul class="blog-meta">
												<?php
												if($lang_file == 'lang.th.php'){
													$date_ads = DateThai($resultnews['create_datetime']);
												}
												 else{
													$date_ads = DateEng($resultnews['create_datetime']);
												 }
												?>
												<li><i class="fa fa-calendar"></i><?=$date_ads;?></li>
												
												<!--<li><a href="#"><i class="fa fa-comments"></i>30 Comments</a></li>
												<li><a href="#"><i class="fa fa-tags"></i>Creative, Agency</a></li>-->
											</ul>
											<p><?php
												if($lang_file == 'lang.th.php'){
													$name_text = $resultnews['text'];
													echo $name_text;
												}
												 else{
													 $name_text_en = $resultnews['text_en'];
													echo $name_text_en;
												 }
												?></p>
										</div>
										<div class="bottom-info">
											<div class="row">
												<div class="col-lg-7 col-md-7 col-12">
													<div class="tags">
														<ul>
															<!--<li class="tag-title">Tags:</li>
															<li><a href="#">Creative</a></li>
															<li><a href="#">Modern</a></li>
															<li><a href="#">Gallery</a></li>
															<li><a href="#">Animation</a></li>-->
														</ul>
													</div>
												</div>
												<div class="col-lg-5 col-md-5 col-12">
													<ul class="social">
														<li class="connect"><?=$lang['MENU_s_a'];?></li>
														<div id="fb-root"></div>
														<div class="fb-share-button" data-href="https://www.suratec.co.th/home/newsdetail.php?id=<?=$_GET['id'];?>" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.suratec.co.th/home/newsdetail.php?id=<?=$_GET['id'];?>src=sdkpreparse" class="fb-xfbml-parse-ignore"><?=$lang['MENU_share'];?></a></div>
														<?php// while($res_icon = mysqli_fetch_array($query_icon)){  ?>
										<!--<li><a href="<?//=$res_icon['linked']?>" style="border: 0px solid #fff"><img src="../uploads/mod_manage_links/<?//=$res_icon['icon']?>" alt="" width="30" style="border-radius: 20%;"></a></li>-->
										<?php//  } ?>
														<li><a onClick="window.open('https://www.facebook.com/sharer.php?u=<?php echo $pageURL ?>','','width=600,height=600');"><img src="../images/facebook.png" width="30" style="border-radius: 20%;"></a></li>
														<li><a onClick="window.open('https://lineit.line.me/share/ui?url=<?php echo $pageURL ?>','','width=600,height=600');"><img src="../images/line.png" width="30" style="border-radius: 20%;"></a></li>
														<li><a onClick="window.open('https://www.instagram.com/?url=<?php echo $pageURL ?>','','width=600,height=600');"><img src="../images/instargram.png" width="30" style="border-radius: 20%;"></a></li>
														<li><a onClick="window.open('https://twitter.com/share?url=<?php echo $pageURL ?>','','width=600,height=600');"><img src="../images/twitter.png" width="30" style="border-radius: 20%;"></a></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<!--/ End Single blog -->
								</div> 
								<!--<div class="col-12">
									<!-- Blog Comments -->
									<!--<div class="blog-comments">
										<div class="bottom-title">
											<h2>ความคิดเห็น (23)</h2>
										</div>
										<div class="comments-body">
											<!-- Single Comments -->
											<!--<div class="single-comments">
												<div class="main">
													<div class="head">
														<img src="images/author1.jpg" alt="#"/>
													</div>
													<div class="body">
														<h4>Stephen Cristian</h4>
														<span class="meta">Posted at<i class="fa fa-clock-o"></i>10:32am,<i class="fa fa-calendar"></i>25 July, 2018</span>
														<p>Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas</p>
														<a href="#" class="reply">Replay</a>
													</div>
												</div>
												<!-- Comment Reply -->
												<!--<div class="comment-list">
													<div class="head">
														<img src="images/author2.jpg" alt="#"/>
													</div>
													<div class="body">
														<h4>Marry Jonael</h4>
														<span class="meta">Posted at<i class="fa fa-clock-o"></i>05:30pm,<i class="fa fa-calendar"></i>25 July, 2018</span>
														<p>Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas</p>
														<a href="#" class="reply">Replay</a>
													</div>
												</div>
												<!--/ End Comment Reply -->
											<!--</div>
											<!--/ End Single Comments -->
											<!-- Single Comments -->
											<!--<div class="single-comments">
												<div class="main">
													<div class="head">
														<img src="images/author3.jpg" alt="#"/>
													</div>
													<div class="body">
														<h4>Tranel Force</h4>
														<span class="meta">Posted at<i class="fa fa-clock-o"></i>07:18am,<i class="fa fa-calendar"></i>20 July, 2018</span>
														<p>Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas</p>
														<a href="#" class="reply">Replay</a>
													</div>
												</div>
											</div>		
											<!--/ End Single Comments -->											
										<!--</div>
									</div>
									<!--/ End Blog Comments -->
								<!--</div>-->
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--/ End Blog Archive -->
			<script async defer crossorigin="anonymous" src="https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v5.0&appId=453905265206335&autoLogAppEvents=1"></script>
			<!-- Footer -->
			<?php include 'footer.php'?>
			<!--/ End footer -->
			
			<!-- Jquery JS -->
			<?php include 'footer_credit.php'?>	
		</div>
    </body>
</html>