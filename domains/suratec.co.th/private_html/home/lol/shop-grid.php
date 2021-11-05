<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
if (isset($_GET['search'])) {
    $search = $_GET['search'];
} else {
    $search = 0;
};


if (isset($_GET['searchall'])) {
    $searchall = $_GET['searchall'];
} else {
    $searchall = '';
};


if (isset($_GET['searchgroup'])) {
    $searchgroup = $_GET['searchgroup'];
} else {
    $searchgroup = 0;
};

?>
<?php include 'header.php'
?>
			<!--/ End Header -->
	  
			<!-- Breadcrumbs -->
			<section class="breadcrumbs overlay bg-image" style="background-image: url(../uploads/mod_central_information/<?=$pic_header['value']?>)">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<!-- Bread Title -->
							<div class="bread-title">
								<h2>สินค้า<?//=$lang['MENU_ABOUT_US'];?><!--About Us--></h2>
							</div>
							<!-- Bread List -->
							<ul class="bread-list">
								<li><a href="./?index=st"><i class="fa fa-home"></i><?=$lang['MENU_HOME'];?><!--Home--></a></li>
								<li class="active"><a href="about_us.php?about_us=st"><i class="fa fa-clone"></i>สินค้า<?//=$lang['MENU_ABOUT_US'];?><!--About Us--></a></li>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<!--/ End Breadcrumbs -->
			
			<!-- About Us -->
	<section class="shop list section" style="padding: 40px 0 40px;">
    <div class="container">

	<div class="col-sm-12" style="margin-top: 15px; text-align: center;">
		<!--<h3 style="text-align: left;">	<?//= lang('ตัวกรอง', 'Filter') ?>	</h3>-->
	<div class="row">
         	<div class="col-md-3">
				<div class="col-md-12">
					<div class="form-group">
						<label for="location1">หมวดหมู่</label>
						<select class="form-control" id="inputGroupSelect00" onchange="search()" name="location">
							<option value="0"><?php echo lang('หมวดหมู่', 'Category') ?></option>
				<?php

                $strSQL = "SELECT  id_catagory,`name_catagory`, `name_catagory_en`, `created_id`,
				`created_at`, `updated_id`,
				`updated_at`, `deleted_at` 
				FROM `product_catagory` 
				WHERE product_catagory.deleted_at is NULL";
                $objQuery = mysqli_query($objConnect,$strSQL);
                while ($objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC)) {
                    ?>
				<option value="<?php echo $objResult['id_catagory'] ?>"><?php echo $objResult['name_catagory']; ?></option>
				<?php
                }
                ?>

						</select>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="input-group">
					<input type="text" id="inputGroupSelect02" class="form-control" onkeyup="search()"  placeholder="ค้นหา" aria-describedby="basic-addon2">
				
						<!-- <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span> -->
				
				</div>
			</div>
			<div class="col-md-4">
				<div class="col-md-12">
					<div class="form-group">
						<label for="location1">เรียงลำดับ</label>
						<select class="form-control" id="inputGroupSelect01" onchange="search()" name="location">
						
                            <option value="0" selected>จัดเรียงตาม...</option>
                            <option value="1">ล่าสุด</option>
                            <option value="2">ราคา (จากต่ำไปสูง)</option>
                            <option value="3">ราคา (จากสูงไปต่ำ)</option>
                            <option value="4">ชื่อจาก ก-ฮ</option>
                            <option value="5">ชื่อจาก ฮ-ก</option>
                        </select>
					</div>
				</div>
			</div>
			<div class="col-md-2">
										<!-- Shop Top -->
										<div class="shop-top">
											<ul class="view-mode">
												<li class="active"><a href="shop-grid.php?shop=st"><i class="fa fa-th-large" style="padding-top: 10px;"></i></a></li>
												<li><a href="shop-list.php?shop=st"><i class="fa fa-th-list" style="padding-top: 10px;"></i></a></li>
											</ul>
										</div>
										<!--/ End Shop Top -->
			</div>
		</div>
	</div>
		<div id="live_data-product-all_g" style="" align="center">
		
		</div>
		<div class="col-sm-12 pull-right" style="margin-top: 10px; padding-bottom: 10px;"   >
			<!--<button type="button" class="btn btn-success"><?//= lang('ดูทั้งหมด','VIEW ALL') ?></button>-->
		</div>
	</div>
</section>
			<!--/ End Shop -->
		
			<!-- Footer -->
			<?php include 'footer.php'?>
			<!--/ End footer -->
			<?php include 'footer_credit.php'?>	
		</div>
    </body>
</html>
<script>

$(function () {
        	<?php echo 'document.getElementById("inputGroupSelect02").value  = "'.$searchall .'"'; ?>;
			<?php echo 'document.getElementById("inputGroupSelect01").value  = ' . $search . ''; ?>;
			<?php echo 'document.getElementById("inputGroupSelect00").value  = ' . $searchgroup . ''; ?>;
			
				//////////////////

				var xmlhttp3 = new XMLHttpRequest();
                xmlhttp3.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("live_data-product-all_g").innerHTML = this.responseText;

                    }
                }
				xmlhttp3.open("GET", "live-data-product-all_g.php?&&searchall="+document.getElementById("inputGroupSelect02").value+"&&searchgroup="+ document.getElementById("inputGroupSelect00").value +"&&search=" + document.getElementById("inputGroupSelect01").value + "&&page=<?php echo $page  ?>", true);
                xmlhttp3.send();
            }
 );

 function search() {
           
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("live_data-product-all_g").innerHTML = this.responseText;

                    }
                }
                xmlhttp.open("GET", "live-data-product-search_g.php?&&searchall="+document.getElementById("inputGroupSelect02").value+"&&searchgroup="+ document.getElementById("inputGroupSelect00").value +"&&search=" + document.getElementById("inputGroupSelect01").value + "&&page=<?php echo $page  ?>", true);
                xmlhttp.send();
            }

function searchpage(page) {

                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("live_data-product-all_g").innerHTML = this.responseText;

                    }
                }
                xmlhttp.open("GET", "live-data-product-search_g.php?&&searchall="+document.getElementById("inputGroupSelect02").value+"&&searchgroup="+ document.getElementById("inputGroupSelect00").value +"&&search=" + document.getElementById("inputGroupSelect01").value + "&&page="+page, true);
                xmlhttp.send();
            }

	var slideIndex = 1;
	showDivs(slideIndex);
	
	function plusDivs(n) {
	  showDivs(slideIndex += n);
	}
	
	function showDivs(n) {
	  var i;
	  var x = document.getElementsByClassName("mySlides");
	  if (n > x.length) {slideIndex = 1}
	  if (n < 1) {slideIndex = x.length}
	  for (i = 0; i < x.length; i++) {
		x[i].style.display = "none";  
	  }
	//  x[slideIndex-1].style.display = "block";  
	}

	</script>