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
								<h2>รถเข็น<?//=$lang['MENU_ABOUT_US'];?><!--About Us--></h2>
							</div>
							<!-- Bread List -->
							<ul class="bread-list">
								<li><a href="./?index=st"><i class="fa fa-home"></i><?=$lang['MENU_HOME'];?><!--Home--></a></li>
								<li class="active"><a href="about_us.php?about_us=st"><i class="fa fa-clone"></i>รถเข็น<?//=$lang['MENU_ABOUT_US'];?><!--About Us--></a></li>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<!--/ End Breadcrumbs -->
			
			<!-- Shopping Cart -->
			<section class="shopping-cart section">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<!-- Shopping Summery -->
							<table class="table shopping-summery">
								<thead>
									<tr>
										<th>No</th>
										<th>Product</th>
										<th>Description</th>
										<th class="text-center">price</th>
										<th class="text-center">Qty</th>
										<th class="text-center">Total</th> 
										<th class="text-center"><i class="fa fa-trash-o"></i></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="number" data-title="No">01</td>
										<td class="product" data-title="Product"><a href="#"><img src="images/product/product-1.jpg" alt="Product"></a></td>
										<td class="product-des" data-title="Description">
											<p class="product-name"><a href="#">Women navy blue</a></p>
											<small><a href="#">Color : blue</a></small><br>
											<small><a href="#">Size : M</a></small>
										</td>
										<td class="price" data-title="Price"><span>$101.88</span></td>
										<td class="qty" data-title="Qty"><input class="form-control" type="text" value="2"></td>
										<td class="total-amount" data-title="Total"><span>$101.88</span></td>
										<td class="action" data-title="Remove"><a href="#"><i class="fa fa-remove"></i></a></td>
									</tr>
									<tr>
										<td class="number" data-title="No">02</td>
										<td class="product" data-title="Product"><a href="#"><img src="images/product/product-3.jpg" alt="Product"></a></td>
										<td class="product-des" data-title="Description">
											<p class="product-name"><a href="#">Black & White T-shirt</a></p>
											<small><a href="#">Color : White, Black</a></small><br>
											<small><a href="#">Size : M</a></small>
										</td>
										<td class="price" data-title="Price"><span>$88.50</span></td>
										<td class="qty" data-title="Qty"><input class="form-control input-sm" type="text" value="3"></td>
										<td class="total-amount" data-title="Total"><span>$88.50</span></td>
										<td class="action" data-title="Remove"><a href="#"><i class="fa fa-remove"></i></a></td>
									</tr>
									<tr>
										<td class="number" data-title="No">03</td>
										<td class="product" data-title="Product"><a href="#"><img src="images/product/product-7.jpg" alt="Product"></a></td>
										<td class="product-des" data-title="Description">
											<p class="product-name"><a href="#">Digital watch</a></p>
											<small><a href="#">Color : Blue, White</a></small><br>
											<small><a href="#">Size : M</a></small>
										</td>
										<td class="price" data-title="Price"><span>$150.00</span></td>
										<td class="qty" data-title="Qty"><input class="form-control input-sm" type="text" value="1"></td>
										<td class="total-amount" data-title="Total"><span>$150.00</span></td>
										<td class="action" data-title="Remove"><a href="#"><i class="fa fa-remove"></i></a></td>
									</tr>
								</tbody>
							</table>
							<!--/ End Shopping Summery -->
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<!-- Shopping Button -->
							<div class="shopping-button">
								<div class="row">
									<div class="col-lg-7 col-md-7 col-12 text-left">
										<button class="btn continue animate">Continue shopping</button>
									</div>
									<div class="col-lg-5 col-md-5 col-12 text-right">
										<button class="btn update animate">Update Cart</button>
										<button class="btn clear animate">Clear Cart</button>
									</div>
								</div>
							</div>
							<!--/ End Shopping Button -->
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="cart-information">
								<div class="row">
									<div class="col-lg-8 col-md-4 col-12">
										<!-- Cart Total -->
										<div class="single-info cart-total">
											<h4>Discount Code</h4>
											<!-- Discount -->
											<div class="single-info discount-main">
												<form action="#" class="discount-form">
													<div class="form-group">
														<input type="text" class="form-control" id="discount-coupon" placeholder="Apply Coupon"/>
														<button type="submit" class="btn animate">Submit</button>
													</div>
												</form>
											</div>
											<!--/ End Discount -->
										</div>
										<!--/ End Cart  Total -->
									</div>
									<div class="col-lg-4 col-md-4 col-12">
										<!-- Cart Total -->
										<div class="single-info cart-total">
											<h4>Shopping Cart Total</h4>
											<div class="total-amount">
												<p>Sub Total: <span>$340.38</span></p>
												<p>Grand Total: <span>$340.38</span></p>
											</div>
											<button class="btn animate">Proceed to checkout</button>
										</div>
										<!--/ End Cart  Total -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--/ End Shopping Cart -->
			
			<!-- Footer -->
			<?php include 'footer.php'?>
			<!--/ End footer -->
			<?php include 'footer_credit.php'?>	
		</div>
    </body>
</html>