<?php

 require_once '../admin/library/connect.php';
 require_once '../admin/library/config.php';

$id = explode(',', $_GET['id_product']);
  //var_dump($id);
  $data = "'".$id[0]."'";
 // var_dump(count($id));
  if (count($id) > 1) {
      for ($i=1; count($id) > $i;$i++) {
          $data .= ","."'".$id[$i]."'";
            //var_dump($data);
      }
  }
 
  $qtyproduct = 0;
  $priceall = 0;
                     
  $strSQL ="  SELECT * , 1 as qty FROM `product` LEFT JOIN product_image ON product.id_product = product_image.id_product 
   			  where product.delete_datetime is null and  product.id_product in($data)   ";
            $objQuery = mysqli_query($objConnect, $strSQL);
          //  var_dump($strSQL);
          if (isset($objQuery)) {
              ?>

<section class="shopping-cart section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Shopping Summery -->
				<div style="overflow-x:auto;">
                <table class="table shopping-summery">
                    <thead>
                        <tr>
                            <th>pic</th>
                            <th>Product</th>
                            <th >price</th>
                            <th >Qty</th>
                            <th >Total</th> 
                            <th ><i class="fa fa-trash-o"></i></th>
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
                      } ?>


    	<tr>
         	<td class="product">
             <img src="../uploads/product/<?= $img_mi ?>"  height="42" width="42">    
        	</td>
         	<td style="text-align: left;">
           <?= lang($objResult['name_product'], $objResult['name_product_en']) ?>
          </td>	
          <td style="text-align: left;">
          ฿ <?= number_format($objResult['tmp_price'], 2) ?>
          </td>
          <td style="text-align: left;">
          <?= $objResult['qty'] ?>
          </td>

          <td style="text-align: left;">
          ฿ <?= number_format($objResult['tmp_price']*$objResult['qty'], 2) ?>
          </td>
		
          <td style="width: 70px;" >
              <button type="button" style="width: 30px;
    height: 30px;
    padding: 1px 1px;
    font-size: 14px;" onclick="deleteproduct('<?= $objResult['id_product']; ?>')" class="btn btn-warning btn-circle btn-lg"><i class="fa fa-times"></i> </button>
          </td>
</tr>

<?php
$qtyproduct = $qtyproduct+$objResult['qty'];
$priceall = $priceall+ ($objResult['tmp_price']*$objResult['qty']);
} ?>
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td style="text-align: left;" ><?= $qtyproduct; ?></td>
    <td style="text-align: left;"  >฿ <?= number_format($priceall, 2); ?></td>
    <td></td>
</tr>
                    </tbody>
                </table>
				</div>
                <!--/ End Shopping Summery -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Shopping Button -->
                <div class="shopping-button">
                    <div class="row">
                        <div class="col-lg-7 col-md-7 col-12 text-left">

                        </div>
                        <div class="col-lg-5 col-md-5 col-12 text-right">
                            <a href="shop-list.php?shop_m=st" class="btn update animate">เพิ่มสินค้า</a>
                            <!--<button class="btn clear animate">Clear Cart</button>-->
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
                                <!--<h4>Discount Code</h4>
                                <!-- Discount -->
                               <!--<div class="single-info discount-main">
                                    <form action="#" class="discount-form">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="discount-coupon" placeholder="Apply Coupon"/>
                                            <button type="submit" class="btn animate">Submit</button>
                                        </div>
                                    </form>
                                </div>-->
                                <!--/ End Discount -->
                            </div>
                            <!--/ End Cart  Total -->
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <!-- Cart Total -->
                            <div class="single-info cart-total">
                                <h4>ยอดรวมรถเข็น</h4>
                                <div class="total-amount">
                                    <p>Sub Total: <span>฿ <?= number_format($priceall, 2); ?></span></p>
                                    <!--<p>Grand Total: <span><?php //echo "฿ " . $total_price; ?></span></p>-->
                                </div>
<?php
$payment_url = "shop-list.php?shop_m=st";
              if ($qtyproduct > 0) {
                  $payment_url = "checkout.php";
              } ?>
                                <a href="<?= $payment_url; ?>" class="btn animate">ดำเนินการสั่งซื้อ</a>

                            </div>
                            <!--/ End Cart  Total -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>	
<?php
  }
?>