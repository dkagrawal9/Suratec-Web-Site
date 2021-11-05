<?php

require_once '../admin/library/connect.php';
require_once '../admin/library/config.php';

?>
  <?php 
                      $id = explode(',',$_GET['id_product']);
					  //echo $id[0];			  
                      $data = "'".$id[0]."'";
                
                      for($i=1; count($id) > $i;$i++){
                        $data .=  ","."'".$id[$i]."'"; 
                      }
                
                      $qtyproduct = 0;
                      $priceall = 0;

					                        $strSQL = "   SELECT *,count(K.qty1) as qty FROM ( 
                SELECT product.*,product_image.name_image , 1 as qty1 FROM product LEFT JOIN product_image ON product.id_product = product_image.id_product 
                where product.delete_datetime is null and  product.id_product in('$id[0]') ";/*  */

      if (count($id) > 1) {
        for ($i=1; count($id) > $i;$i++) {

            $strSQL .="   
      
               
                UNION ALL 
                SELECT product.* , 1 as qty1,product_image.name_image  FROM product LEFT JOIN product_image ON product.id_product = product_image.id_product 
                where product.delete_datetime is null and  product.id_product in('$id[$i]')
                
                
                   
                 
                   ";
        }
    }


      



$strSQL .= "
                ) AS K
            GROUP BY K.id_product

            ";
                                $objQuery = mysqli_query($objConnect,$strSQL);
                               // var_dump($strSQL);
                                
	                
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

