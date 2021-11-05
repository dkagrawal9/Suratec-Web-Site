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
					<div class="row"> 
						<div class="col-lg-7 col-12">
							<div class="checkout-form">
								<h2>ข้อมูลการเรียกเก็บเงิน<!--Billing Information--></h2>
								<!-- Form -->
								<form class="form" method="post" action="#">
									<div class="row">
										<div class="col-lg-6 col-md-6 col-12">
											<div class="form-group">
												<label>ชื่อ<!--First Name --><span>*</span></label>
												<input type="text" name="name" required="required">
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-12">
											<div class="form-group">
												<label>นามสกุล<!--Last Name--> <span>*</span></label>
												<input type="text" name="name" required="required">
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label>ที่อยู่<!--Street Address--> <span>*</span></label>
												<input type="text" name="address" required="required">
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-12">
											<div class="form-group">
												<label>ตำบล <span>*</span></label>
												<input type="text" name="address" required="required">
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-12">
											<div class="form-group">
												<label>อำเภอ <span>*</span></label>
												<input type="text" name="address" required="required">
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-12">
											<div class="form-group">
												<label>จังหวัด<!--State/Province--> <span>*</span></label>
												<input type="text" name="post" required="required">
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-12">
											<div class="form-group">
												<label>รหัสไปรษณีย์<!--Postal Code--> <span>*</span></label>
												<input type="text" name="post" required="required">
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label>อีเมล<!--Email--> <span>*</span></label>
												<input type="text" name="email" required="required">
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label>โทรศัพท์<!--Phone--> <span>*</span></label>
												<input type="text" name="phone" required="required">
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label>หมายเหตุการสั่งซื้อ<!--Order Notes--> <span>*</span></label>
												<textarea name="address" placeholder="รายละเอียด" required="required"></textarea>
											</div>
										</div>
									</div>
								</form>
								<!--/ End Form -->

<form method="post" action="https://www.thaiepay.com/epaylink/payment.aspx">
 <input type="text" name="refno" value="00001">
 <input type="text" name="merchantid" value="25216909">
 <input type="text" name="customeremail" value="123@gmail.com">
 <input type="text" name="productdetail" value="Testing Product">
 <input type="text" name="total" value="400">
 <input type="text" name="lang" value="TH">
 <input type="text" name="cc" value="00">
 <input type="text" name="postbackurl" value="https://www.suratec.co.th/home/rere.php?customeremail=123@gmail.com?refno=00001">
 <input type="text" name="returnurl" value="https://www.suratec.co.th/home/">	
 <br>
 <input type="submit" name="Submit" value="Comfirm Order">
</form>
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
													<a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-bank"></i>Direct bank transfer</a>
												  </h4>
												</div>
												<div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="payment1" data-parent="#payment-option">
												  <div class="payment-text">
													<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
												  </div>
												</div>
											</div>
											<!--/ End Single Method -->
											<!-- Single Method -->
											<div class="single-method">
												<div class="payment-heading" role="tab" id="payment2">
												  <h4 class="payment-title">
													<a data-toggle="collapse" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"><i class="fa fa-check"></i>Cheque Payment</a>
												  </h4>
												</div>
												<div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="payment2" data-parent="#payment-option">
												  <div class="payment-text">
													<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
												  </div>
												</div>
											</div>
											<!--/ End Single Method -->
											<!-- Single Method -->
											<div class="single-method">
												<div class="payment-heading" role="tab" id="payment3">
												  <h4 class="payment-title">
													<a data-toggle="collapse" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree"><i class="fa fa-paypal"></i>Paypal</a>
												  </h4>
												</div>
												<div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="payment3" data-parent="#payment-option">
												  <div class="payment-text">
													<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
												  </div>
												</div>
											</div>
											<!--/ End Single Method -->
										</div>
									</div>
									<!--/ End Payment Method -->
									<button class="btn animate">สั่งซื้อ<!--Place order--></button>
								</div>
								<!--/ End Payment Widget -->
							</div>
						</div>
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