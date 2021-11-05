<?php include 'header.php'?>
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
			<!--/ End Header -->
		
			<!-- Breadcrumbs -->
			<section class="breadcrumbs overlay bg-image" style="background-image: url(../uploads/mod_central_information/<?=$pic_header['value']?>)">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<!-- Bread Title -->
							<div class="bread-title">
								<h2>ข่าวสาร<!--Our Team--></h2>
							</div>
							<!-- Bread List -->
							<ul class="bread-list">
								<li><a href="./?index=st"><i class="fa fa-home"></i>หน้าแรก<!--Home--></a></li>
								<li class="active"><a href="news.php"><i class="fa fa-clone"></i> ข่าวสาร <!--Our Team--></a></li>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<!--/ End Breadcrumbs -->
			
			<!-- Blog Archive -->
			<section class="blogs archive list section">
				<div class="container">
					<div class="row">
<?php
	$sql = "SELECT * FROM article WHERE id_catagory = '9' AND `delete_datetime` is null ORDER BY id_article DESC";			  
	$result = mysqli_query($objConnect,$sql);
	while ($data = mysqli_fetch_array($result,MYSQLI_BOTH))
		{
			//echo $data['id'].$data['name']."<hr>";
		
?>
						<div class="col-12">
							<!-- Single Blog -->
							<div class="single-blog">
								<div class="blog-head">
									<a href="./newsdetail.php?id=<?=$data['id_article'];?>"><img src="../uploads/mod_article/<?=$data['image'];?>" width="425" height="297" alt="#"></a>
								</div>
								<div class="blog-bottom">
									<h4><a href="./newsdetail.php?id=<?=$data['id_article'];?>"><?=$data['name_article'];?></a></h4>
									<p><?=$data['text'];?></p>
									<ul class="blog-meta">
										<li><i class="fa fa-calendar"></i>
											<?php
													$date_ads = DateThai($data['create_datetime']);
											?>
											<?=$date_ads?></li>
									</ul>
								</div>
							</div>
							<!--/ End Single Blog -->
						</div> 
					<?php } ?> 	  
					</div>
					<!--<div class="row">
						<div class="col-12">
							<!-- Pagination -->
							<!--<div class="pagination-main">
								<ul class="pagination">
									<li class="prev"><a href="#"><i class="fa fa-angle-double-left"></i></a></li>
									<li><a href="#">1</a></li>
									<li class="active"><a href="#">2</a></li>
									<li><a href="#">3</a></li>
									<li><a href="#">4</a></li>
									<li class="next"><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
								</ul>
							</div>
							<!--/ End Pagination -->
						<!--</div>
					</div>-->
				</div>
			</section>
			<!--/ End Blog Archive -->
			
			
			<!-- Footer -->
			<?php include 'footer.php'?>
			<!--/ End footer -->
			
			<!-- Jquery JS -->
			<?php include 'footer_credit.php'?>
			<!--/ End footer -->
		</div>
    </body>
</html>