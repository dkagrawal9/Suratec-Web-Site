<?php
  require_once '../admin/library/connect.php';

  $sql = "SELECT * FROM article WHERE id_catagory = '8' AND `delete_datetime` is null AND `id_article` = '".$_GET['id']."'";
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
?><head>
<meta charset="utf-8">
        <meta property="og:url"           content="https://www.suratec.co.th/home/articledetail.php?id=<?=$_GET['id']?>" />
        <meta property="og:type"          content="website" />
		<meta property="og:title"         content='<?=$resultnews['name_article'];?>'  />
		<meta property="og:description"   content='<?=$resultnews['text'];?>'  />
        <meta property="og:image"         content="https://www.suratec.co.th/uploads/mod_article/<?=$resultnews['image'];?>" />

</head>

<?php 
include 'header.php';

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
								<h2>รายละเอียดบทความ<!--Our Team--></h2>
							</div>
							<!-- Bread List -->
							<ul class="bread-list">
								<li><a href="./?index=st"><i class="fa fa-home"></i>หน้าแรก<!--Home--></a></li>
								<li class="active"><a href="articledetail.php?id=<?=$resultnews['id_article'];?>"><i class="fa fa-clone"></i> รายละเอียดบทความ <!--Our Team--></a></li>
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
											<h1><a href="articledetail.php?id=<?=$resultnews['id_article'];?>"><?=$resultnews['name_article'];?></a></h1>
											<ul class="blog-meta">
												<?php
													$date_ads = DateThai($resultnews['create_datetime']);
												?>
												<li><i class="fa fa-calendar"></i><?=$date_ads;?></li>
												
												<!--<li><a href="#"><i class="fa fa-comments"></i>30 Comments</a></li>
												<li><a href="#"><i class="fa fa-tags"></i>Creative, Agency</a></li>-->
											</ul>
											<p><?=$resultnews['text'];?></p>
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
														<li class="connect">แบ่งปันบทความ:</li>
														<div id="fb-root"></div>
	<div class="fb-share-button" data-href="https://www.suratec.co.th/home/articledetail.php?id=<?=$_GET['id']?>" data-layout="button_count" data-size="small"><a target="_blank" 
href="https://www.facebook.com/sharer/sharer.php?u=https://www.suratec.co.th/home/articledetail.php?id=<?=$_GET['id']?>&amp;src=sdkpreparse" 
class="fb-xfbml-parse-ignore">แชร์
</a></div>
														<?php //while($res_icon = mysqli_fetch_array($query_icon)){  ?>
										<!--<li><a href="<?//=$res_icon['linked']?>" style="border: 0px solid #fff"><img src="../uploads/mod_manage_links/<?//=$res_icon['icon']?>" alt="" width="30" style="border-radius: 20%;"></a></li>-->
										<?php // } ?>
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
								<div class="col-12">
									<!-- Blog Comments -->
									<div class="blog-comments">
										<div class="bottom-title">
<?php
	$sqlcom = "SELECT * FROM article_opinion WHERE `id_article` = '".$resultnews['id_article']."' AND `delete_datetime` is null ORDER BY `article_opinion`.`id` DESC";
	$resultcom = mysqli_query($objConnect,$sqlcom);
	while ($comnews = mysqli_fetch_array($resultcom,MYSQLI_BOTH))
		{
		$rows = $resultcom->num_rows;
		}
?>
											<h2><?=$rows?> ความคิดเห็น <!--(2)--></h2>
										</div>
										<div class="comments-body">
											<!-- Single Comments -->
<?php
	$sqlcom = "SELECT * FROM article_opinion WHERE `id_article` = '".$resultnews['id_article']."' AND `delete_datetime` is null ORDER BY `article_opinion`.`id` DESC";
	$resultcom = mysqli_query($objConnect,$sqlcom);
	while ($comnews = mysqli_fetch_array($resultcom,MYSQLI_BOTH))
		{
		$rows = $resultcom->num_rows;
?>
											<div class="single-comments">
												<div class="main">
													<div class="head">
														<img src="
																  <?php
                                        $imgcom = $comnews['img_path'];
                                        
                                        if($imgcom == null)
                                        {  
                                            echo "../img/bg-img/25.jpg";
                                        }
                                        else
                                        {
                                            echo "../uploads/mod_comnews/$imgcom";
                                        }

                                    ?>
									" alt="#"/>
													</div>
												<?php
													$date_ads = DateThai($comnews['date_action']);
												?>
													<div class="body">
														<h4>
															<?php
																$namecom = $comnews['update_by'];
																$namecomno = 'ไม่ได้ระบุ';
																if($namecom == null)
																{  
																	echo "<span>$namecomno</span>";
																}
																else
																{
																	echo "$namecom";
																}
															?>
														</h4>
														<span class="meta"><!--<i class="fa fa-clock-o"></i>10:32am,--><i class="fa fa-calendar"></i><?=$date_ads?></span>
														<p><?=$comnews['message'];?></p>
														<!--<a href="#" class="reply">Replay</a>-->
													</div>
												</div>
											</div>
											<?php } ?>
											<!--/ End Single Comments -->										
										</div>
									</div>
									<!--/ End Blog Comments -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--/ End Blog Archive -->
			    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v4.0"></script>
			<!-- Footer -->
			<?php include 'footer.php'?>
			<!--/ End footer -->
			
			<!-- Jquery JS -->
			<?php include 'footer_credit.php'?>	

		</div>