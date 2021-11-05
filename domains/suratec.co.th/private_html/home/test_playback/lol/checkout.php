<?php 
  require_once '../admin/library/connect.php';
  require_once '../admin/library/functions.php';
  checkMemUser($objConnect);
?>
<?php include 'header.php';
?>
			<!--/ End Header -->

<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

$id = $_SESSION['id_customer'];

$sqlpro = "SELECT   *,mod_customer.telephone AS telephone ,mod_customer.id_customer AS id_customer, mod_customer.fname AS fname, mod_customer.lname AS lname FROM  mod_customer 
LEFT JOIN  tbl_member ON mod_customer.id_customer = tbl_member.id_data_role
LEFT JOIN  mod_customer_address ON mod_customer_address.id_customer = mod_customer.id_customer
WHERE  mod_customer.id_customer = '$id' ";

 //echo $sqlpro;

$queryPro = mysqli_query($objConnect, $sqlpro);
$resultPro = mysqli_fetch_array($queryPro);

// var_dump($_SESSION);


?>
    <link rel="stylesheet" href="../admin/plugins/sweetalert2/dist/sweetalert2.min.css">
    <script src="../admin/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
<style>
	.swal2-popup{
		font-size: 1rem;
	}
</style>
	  
			<!-- Breadcrumbs -->
			<section class="breadcrumbs overlay bg-image" style="background-image: url(../uploads/mod_central_information/<?=$pic_header['value']?>)">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<!-- Bread Title -->
							<div class="bread-title">
								<h2>จ่ายเงิน<?//=$lang['MENU_ABOUT_US'];?><!--About Us--></h2>
							</div>
							<!-- Bread List -->
							<ul class="bread-list">
								<li><a href="./?index=st"><i class="fa fa-home"></i><?=$lang['MENU_HOME'];?><!--Home--></a></li>
								<li class="active"><a href="about_us.php?about_us=st"><i class="fa fa-clone"></i>จ่ายเงิน<?//=$lang['MENU_ABOUT_US'];?><!--About Us--></a></li>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<!--/ End Breadcrumbs -->
			
			<!-- About Us -->
			<section class="shop checkout section">
				<div class="container">
					<!-- Form -->
				<form id="checkout_form" class="form" method="post" action="https://www.thaiepay.com/epaylink/payment.aspx">
				<input type="hidden" name="_method" value="ADD_SHOPPING">	
				<input type="hidden"  name="id" class="form-control"  value = "<?=$resultPro['id_customer']?>" placeholder=""  >
					<div class="row"> 
						<div class="col-lg-7 col-12">
							<div class="checkout-form">
								<h2>ข้อมูลการเรียกเก็บเงิน<!--Billing Information--></h2>
									<div class="row">
										<div class="col-lg-6 col-md-6 col-12">
											<div class="form-group">
												<label>ชื่อ<!--First Name --><span>*</span></label>
												<input type="text" name="fname" id="fname" value="<?=$resultPro['fname']?>" required="required">
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-12">
											<div class="form-group">
												<label>นามสกุล<!--Last Name--> <span>*</span></label>
												<input type="text" value="<?=$resultPro['lname']?>" name="lname" id="lname" required="required">
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label>ที่อยู่<!--Street Address--> <span>*</span></label>
												<input type="text" name="address" id="address" value="<?=$resultPro['address']?>" required="required">
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-12">
											<div class="form-group">
												<label>ตำบล <span>*</span></label>
												<input type="text" name="district" id="district" value="<?=$resultPro['district']?>" required="required">
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-12">
											<div class="form-group">
												<label>อำเภอ <span>*</span></label>
												<input type="text" name="amphur" id="amphur" value="<?=$resultPro['amphur']?>" required="required">
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-12">
											<div class="form-group">
												<label>จังหวัด<!--State/Province--> <span>*</span></label>
												<input type="text" name="province" id="province" value="<?=$resultPro['province']?>" required="required">
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-12">
											<div class="form-group">
												<label>รหัสไปรษณีย์<!--Postal Code--> <span>*</span></label>
												<input type="text" name="postalcode" id="postalcode" value="<?=$resultPro['postalcode']?>" required="required">
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label>อีเมล<!--Email--> <span>*</span></label>
												<input type="text" name="email" id="email" value="<?=$resultPro['email']?>" required="required" onblur="CHECK_EMAIL()">
												<div class="col-md-12" id="email_alert" >
											<small id="a_email"  style="color: #fafafa;"></small>
											</div>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label>โทรศัพท์<!--Phone--> <span>*</span></label>
												<input type="text" name="telephone" id="telephone" value="<?=$resultPro['telephone']?>" required="required">
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label>หมายเหตุการสั่งซื้อ<!--Order Notes <span>*</span>--></label>
												<textarea name="notes" id="notes" placeholder="รายละเอียด"></textarea>
											</div>
										</div>
									</div>
									<input type="text" name="refno" value="00001">
 <input type="text" name="merchantid" value="25216909">
 <input type="text" name="customeremail" value="123@gmail.com">
 <input type="text" name="productdetail" value="Testing Product">
 <input type="text" name="total" value="400">
 <input type="text" name="lang" value="TH">
 <input type="text" name="cc" value="00">
 <input type="text" name="postbackurl" value="http://localhost/suratec_m/home/rere.php?customeremail=123@gmail.com?refno=00001">
 <input type="text" name="returnurl" value="http://localhost/suratec_m/home/rere.php?customeremail=123@gmail.com?refno=00001">

<!--<form method="post" action="https://www.thaiepay.com/epaylink/payment.aspx">
 <input type="text" name="refno" value="00001">
 <input type="text" name="merchantid" value="25216909">
 <input type="text" name="customeremail" value="123@gmail.com">
 <input type="text" name="productdetail" value="Testing Product">
 <input type="text" name="total" value="400">
 <input type="text" name="lang" value="TH">
 <input type="text" name="cc" value="00">
 <input type="text" name="postbackurl" value="http://localhost/suratec_m/home/rere.php?customeremail=123@gmail.com?refno=00001">
 <input type="text" name="returnurl" value="http://localhost/suratec_m/home/">	
 <br>
 <input type="submit" name="Submit" value="Comfirm Order">
</form>-->
							</div>
						</div>
						<div class="col-lg-5">
							<div class="order-details">
								<!-- Order Widget -->
								<div class="single-widget order">
									<h2>สรุปคำสั่งซื้อ<!--Order Summery--></h2>
									<table class="table">
										<thead>
											<tr>
												<th class="cart-product-name">สินค้า<!--Product--></th>
												<th class="cart-product-total">รวม<!--Total--></th>
											</tr>
										</thead>
										<tbody>
											<tr class="cart_item">
											  <td class="cart-product-name">Women navy blue<strong class="product-quantity"> × 1</strong></td>
											  <td class="cart-product-total"><span class="amount">$50.94</span></td>  
											</tr>
											<tr class="cart_item">
											  <td class="cart-product-name">Black & White T-shirt<strong class="product-quantity"> × 1</strong></td>
											  <td class="cart-product-total"><span class="amount">$29.50</span></td>  
											</tr>
										</tbody>
										<tfoot>
											<tr class="cart-subtotal">
												<th>ยอดรวมรถเข็น<!--Cart Subtotal--></th>
												<td><span class="amount">$80.44</span></td>
											</tr>
											<tr class="order-total">
												<th>ยอดสั่งซื้อทั้งหมด<!--Order Total--></th>
												<td><strong><span class="amount">$80.44</span></strong></td>
											</tr>
										</tfoot>
									</table>
								</div>
								<!--/ End Order Widget -->
								<!-- Payment Widget -->
								<div class="single-widget payment">
									<h2>วิธีการชำระเงิน<!--Payment Method--></h2>
									<!-- Faqs Area -->
									<div class="payment-method">
										<div id="payment-option"  role="tablist">
											<!-- Single Method -->
											<div class="single-method active">
												<div class="payment-heading" role="tab" id="payment1">
												  <h4 class="payment-title">
													<a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-bank"></i>Thaiepay <!--Direct bank transfer--></a>
												  </h4>
												</div>
												<div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="payment1" data-parent="#payment-option">
												  <div class="payment-text">
													<p>ใช้เวลาน้อย.</p>
												  </div>
												</div>
											</div>
											<!--/ End Single Method -->
										</div>
									</div>
									<!--/ End Payment Method -->
									<button class="btn animate" name="confirm_btn" id="confirm_btn">สั่งซื้อ<!--Place order--></button>
								</div>
								<!--/ End Payment Widget -->
							</div>
						</div>
					</div>
				</form>
				<!--/ End Form -->
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
<script src="asset/jquery.thailand.js/dependencies/JQL.min.js"></script>
<script src="asset/jquery.thailand.js/dependencies/typeahead.bundle.js"></script>
<script src="asset/jquery.thailand.js/dependencies/zip.js/zip.js"></script>
<script src="asset/jquery.thailand.js/dependencies/zip.js/inflate.js"></script>
<script src="asset/jquery.thailand.js/dependencies/zip.js/z-worker.js"></script>

<script src="asset/jquery.thailand.js/jquery.Thailand.js"></script>
<link href="asset/jquery.thailand.js/jquery.Thailand.min.css" rel="stylesheet">
<script>
	
$(function () {
        $.Thailand({
            $district: $('#district'), // input ของตำบล
            $amphoe: $('#amphur'), // input ของอำเภอ
            $province: $('#province'), // input ของจังหวัด
            $zipcode: $('#postalcode'), // input ของรหัสไปรษณีย์
        });
    });	
	
// CHECK_EMAIL
// $( '#email' ).keyup(function() {
  function CHECK_EMAIL(){ 
  var email = 'not';
  email = $('#email').val();
   if(email === ''){
     email = 'not';
   }

  var emailFilter=/^.+@.+\..{2,3}$/;
  var str = email;
  var st_mail = null;
    if (!(emailFilter.test(str))) { 
        st_mail = false;
    }else{
        st_mail = true;
    }

                        $.ajax({
                        success: function(response) {
                          //console.log('email : ',email);
                          
                          if( st_mail == false && email != 'not' ){ 
                              console.log('st_mail : ',st_mail);
                            $("#email").attr("style" , "border-color: #ffc107; border-width: 2px; background-color: #ffc10745;");
                            $("#email_alert").attr("style" , "border-radius: 2px; background-color: #ffc107; transition: 0.5s; display:inline-block;");
                            document.getElementById("a_email").innerHTML = "<i style='color:#333;' class='fa fa-exclamation-triangle'></i> รูปแบบ E-Mail ไม่ถูกต้อง"; 
                            document.getElementById('confirm_btn').disabled = true; 
                            $("#a_email").attr("style" , "color: #333;");
                          }
                          else if(email != 'not' &&  st_mail == true){
                            $("#email").attr("style" , "border-color: #28a745; border-width: 2px; background-color: #28a74585;");
                            $("#email_alert").attr("style" , "border-radius: 2px; background-color: #1c8c36; transition: 0.5s; display:inline-block;");
                            document.getElementById("a_email").innerHTML = "<i style='color:#fafafa;' class='fa fa-check-circle'></i>  E-Mail นี้สามารถใช้ได้ "; 
                            $("#a_email").attr("style" , "color: #fafafa;");
                         
                              setTimeout(function() {
                              $("#email").attr("style" ,"");
                              $("#email_alert").attr("style" , "transition: 0.5s; display:none;");
                              }, 3000);
                              document.getElementById('confirm_btn').disabled = false;   
                          }
                        }
                        });
// });
  }
</script>

<script>
$(document).on('click', '#confirm_btn', function(event) {
  var formData = new FormData($('#register_form')[0]);

  if($("#fname").val() != ""
  && $("#lname").val() != ""     
  && $("#email").val() != ""
  && $("#address").val() != ""
  && $("#district").val() != ""
  && $("#amphur").val() != ""	 
  && $("#province").val() != ""
  && $("#postalcode").val() != ""
  && $("#telephone").val() != "")
  {
// ------------------------------------------------------------------------

// -------------------------------------------------------------------------
  }else{
    swal('คำเตือน!','กรุณากรอกข้อมูลให้ครบถ้วน.','warning');

                    if($("#fname").val() == ""){
                        $("#fname").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
                        setTimeout(function() {
                            $("#fname").attr("style" , "");
                        }, 5000);
                    }
                    if($("#lname").val() == ""){
                        $("#lname").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
                        setTimeout(function() {
                            $("#lname").attr("style" , "");
                        }, 5000);
                    }
                    if($("#email").val() == ""){
                        $("#email").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
                        setTimeout(function() {
                            $("#email").attr("style" , "");
                        }, 5000);
                    }
                    if($("#address").val() == ""){
                        $("#address").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
                        setTimeout(function() {
                            $("#address").attr("style" , "");
                        }, 5000);
                    }
	  				if($("#district").val() == ""){
                        $("#district").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
                        setTimeout(function() {
                            $("#district").attr("style" , "");
                        }, 5000);
                    }
	  				if($("#amphur").val() == ""){
                        $("#amphur").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
                        setTimeout(function() {
                            $("#amphur").attr("style" , "");
                        }, 5000);
                    }
	  				if($("#province").val() == ""){
                        $("#province").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
                        setTimeout(function() {
                            $("#province").attr("style" , "");
                        }, 5000);
                    }
                    if($("#postalcode").val() == ""){
                        $("#postalcode").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
                        setTimeout(function() {
                            $("#postalcode").attr("style" , "");
                        }, 5000);
                    }
	  				if($("#telephone").val() == ""){
                        $("#telephone").attr("style" , "border-color: red; border-width: 1px; background-color: #ff000038;");
                        setTimeout(function() {
                            $("#telephone").attr("style" , "");
                        }, 5000);
                    }
  				}
            });
</script>