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
								<h2><?=$lang['MENU_Shop'];?><!--About Us--></h2>
							</div>
							<!-- Bread List -->
							<ul class="bread-list">
								<li><a href="./?index=st"><i class="fa fa-home"></i><?=$lang['MENU_HOME'];?><!--Home--></a></li>
								<li class="active"><a href="about_us.php?about_us=st"><i class="fa fa-clone"></i><?=$lang['MENU_Shop'];?><!--About Us--></a></li>
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
		<div class="row" >
			<div class="col-12">
				<!-- Shop Top -->
				<div class="shop-top">
					<div class="shop-shorter">
						<div class="single-shorter" >
						
							<select class="form-control" id="inputGroupSelect00" onchange="search()" name="location">
								<option value="0"><?=$lang['MENU_category'];?></option>
					<?php
			
					$strSQL = "SELECT  id_catagory,`name_catagory`, `name_catagory_en`, `created_id`,
					`created_at`, `updated_id`,
					`updated_at`, `deleted_at` 
					FROM `product_catagory` 
					WHERE product_catagory.deleted_at is NULL";
					$objQuery = mysqli_query($objConnect,$strSQL);
					while ($objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC)) {
						?>
					<option value="<?php echo $objResult['id_catagory'] ?>"><?php
													if($lang_file == 'lang.th.php'){
														$name_text = $objResult['name_catagory'];
														echo $name_text;
													}
													 else{
														 $name_text_en = $objResult['name_catagory_en'];
														echo $name_text_en;
													 }
													?></option>
					<?php
					}
					?>
			
							</select>
						</div>
		
						<!-- <div class="single-shorter"> -->
						<!-- </div> -->
					
						<div class="single-shorter">
							
					<select class="form-control" id="inputGroupSelect01" onchange="search()" name="location" style="padding-top: 100px;">
					
						<option value="0" selected><?=$lang['MENU_search2'];?></option>
						<option value="1"><?=$lang['MENU_search3'];?></option>
						<option value="2"><?=$lang['MENU_search4'];?></option>
						<option value="3"><?=$lang['MENU_search5'];?></option>
						<option value="4"><?=$lang['MENU_search6'];?></option>
						<option value="5"><?=$lang['MENU_search7'];?></option>
					</select>
		
				
						
						</div>
		
		
						<div>
							<input  type="text" class="form-control"   id="inputGroupSelect02"  onkeyup="search()"  placeholder="<?=$lang['MENU_search'];?>" aria-describedby="basic-addon2">
						
						</div>
							
							
						
		
				
					
					</div>
		
				
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