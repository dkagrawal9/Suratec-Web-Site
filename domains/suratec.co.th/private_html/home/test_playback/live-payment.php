<?php
require_once '../admin/library/connect.php';
require_once '../admin/library/config.php';
function contact_usc($val) {
    global $objConnect;

    $str = "SELECT * FROM contact WHERE id = '" . $val . "'";
    $query = mysqli_query($objConnect, $str);
    $result = mysqli_fetch_array($query);

    if ($result['value'] != '') {
        return $result;
    } else {
        return false;
    }
}

$merchantid = contact_usc(33);

?>
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
<script src="asset/jquery.thailand.js/dependencies/JQL.min.js"></script>
<script src="asset/jquery.thailand.js/dependencies/typeahead.bundle.js"></script>
<script src="asset/jquery.thailand.js/dependencies/zip.js/zip.js"></script>
<script src="asset/jquery.thailand.js/dependencies/zip.js/inflate.js"></script>
<script src="asset/jquery.thailand.js/dependencies/zip.js/z-worker.js"></script>

<script src="asset/jquery.thailand.js/jquery.Thailand.js"></script>
<link href="asset/jquery.thailand.js/jquery.Thailand.min.css" rel="stylesheet">

<section class="shop checkout section">
				<div class="container">
					<!-- Form -->
				<form id="checkout_form" class="form" method="POST" action="https://www.thaiepay.com/epaylink/payment.aspx" >
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
												<input type="text" name="fname" id="fname" value="<?=$resultPro['fname']?>" required="required" oninput="myFunctionex()">
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
										<!--<div class="col-12">
											<div class="form-group">
												<label>หมายเหตุการสั่งซื้อ<!--Order Notes <span>*</span></label>-->
												<!--<textarea name="notes" id="notes" placeholder="รายละเอียด"></textarea>
											</div>
										</div>-->
									</div>
								<!--<p>ชื่อ : <font id="name-ex"></font><br></p>-->

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
									<div id="live-paymentsd">
				<?php 
                      $id = explode(',',$_GET['id_product']);
					  //print_r($id);
					   //var_dump($id);
                      $data = "'".$id[0]."'";
                
                      for($i=1; count($id) > $i;$i++){
                        $data .=  ","."'".$id[$i]."'"; 
                      }
					   
                      $qtyproduct = 0;
                      $priceall = 0;

				$strSQL = "   SELECT *,count(K.qty1) as qty FROM ( 
                SELECT product.*,product_image.name_image , product_image.name_image as qty1 FROM product LEFT JOIN product_image ON product.id_product = product_image.id_product 
                where product.delete_datetime is null and  product.id_product in('$id[0]') ";/*  */

      if (count($id) > 1) {
        for ($i=1; count($id) > $i;$i++) {

            $strSQL .="   
      
               
                UNION ALL 
                SELECT product.* , product_image.name_image as qty1,product_image.name_image  FROM product LEFT JOIN product_image ON product.id_product = product_image.id_product 
                where product.delete_datetime is null and  product.id_product in('$id[$i]')

                   ";
        }
    }

$strSQL .= "
                ) AS K
            GROUP BY K.id_product

            ";
                                $objQuery = mysqli_query($objConnect,$strSQL);
                                //var_dump($strSQL);
                                
	                
                                ?>
									<table class="table">
										<thead>
											<tr>
												<th class="cart-product-pic" width="20%">รูป<!--Product--></th>
												<th class="cart-product-name" width="55%">สินค้า<!--Product--></th>
												<th class="cart-product-total" width="25%">รวม<!--Total--></th>
											</tr>
										</thead>
										<tbody>
											<?php
											while ($objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC)) {

                                      $img_mi = $objResult['name_image'];
									  if ($img_mi == null) {
										  $img_mi =  "../images/favicon.png";
									  } else {
										  $img_mi =  $img_mi;
									  } 
											?>
											<tr class="cart_item">
											  <td class="cart-product-pic">
											  <img src="../uploads/product/<?= $img_mi ?>"  height="42" width="42">
											  </td>	  
											  <td class="cart-product-name"><?= lang($objResult['name_product'], $objResult['name_product_en']) ?><strong class="product-quantity"> × <?= $objResult['qty'] ?></strong></td>
											  <td class="cart-product-total"><span class="amount">฿ <?= number_format($objResult['tmp_price'], 2) ?></span></td>  
											</tr>
											<?php
					 $qtyproduct = $qtyproduct+$objResult['qty'];
					 $priceall = $priceall+ ($objResult['tmp_price']*$objResult['qty']);
                	}
                ?>
										</tbody>
										<tfoot>
											<!--<tr class="cart-subtotal">
												<th></th>
												<th>ยอดรวมรถเข็น<!--Cart Subtotal--></th>
												<!--<td><span class="amount">$80.44</span></td>
											</tr>-->
											<tr class="order-total">
												<th></th>
												<th>ยอดสั่งซื้อทั้งหมด<!--Order Total--></th>
												<td><strong><span class="amount">฿ <?= number_format($priceall, 2); ?></span></strong></td>
											</tr>
										</tfoot>
									</table>
							<!-- Payment Widget -->
										
									</div>
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
<?php 
  $date = date("Y-m-d H:i:sa");
  $date_no_y = date("Y");
  $date_no_m = date("m");
  $date_no_d = date("d");	
  $ram = rand(0,99999);
	
$sum_date = $date_no_y.$ram;
?>
 <input type="hidden" name="refno" value="<?=$sum_date?>">
 <input type="hidden" name="merchantid" value="<?=$merchantid['value']?>">
 <input type="hidden" name="customeremail" value="<?=$resultPro['email']?>">
 <input type="hidden" name="productdetail" value="Product">
 <input type="hidden" name="total" value="<?=$priceall?>">
 <input type="hidden" name="lang" value="TH">
 <input type="hidden" name="cc" value="00">
 <input type="hidden" name="postbackurl" value="https://www.suratec.co.th/home/rere.php">
 <input type="hidden" name="returnurl" value="https://www.suratec.co.th/">
				</form>
				<!--<button class="btn btn-primary animate" name="confirm_btn" id="confirm_btn">สั่งซื้อ<!--Place order</button>-->
				<!--/ End Form -->
				</div>
			</section>
			<!-- Jquery JS -->
			<script src="../js/jquery.min.js"></script>
			<script src="../js/jquery-migrate.min.js"></script>
			<script src="../js/jquery-ui.min.js"></script>
			<!-- Bootstrap JS -->
			<script src="../js/popper.min.js"></script>
			<script src="../js/bootstrap.min.js"></script>
			<!-- Modernizer JS -->
			<script src="../js/modernizr.min.js"></script>
			<!-- Particles JS -->
			<script src="../js/particles.min.js"></script>
			<!-- Theme Plugins JS -->
			<script src="../js/theme-plugins.js"></script>
			<!-- Main JS -->
			<script src="../js/main.js"></script>
<script>
$(function () {
        $.Thailand({
            $district: $('#district'), // input ของตำบล
            $amphoe: $('#amphur'), // input ของอำเภอ
            $province: $('#province'), // input ของจังหวัด
            $zipcode: $('#postalcode'), // input ของรหัสไปรษณีย์
        });
    });	
</script>