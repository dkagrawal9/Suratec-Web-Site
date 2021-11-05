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
                     
  $strSQL = "   SELECT *,count(K.qty1) as qty FROM ( 
                SELECT product.*,product_image.name_image , product_image.name_image as qty1 FROM product LEFT JOIN product_image ON product.id_product = product_image.id_product 
                where product.delete_datetime is null and  product.id_product in('$id[0]') 
            ";
      
      if (count($id) > 1) {
        for ($i=1; count($id) > $i;$i++) {

            $strSQL .="   

                UNION ALL 
                SELECT product.* , product_image.name_image as qty1,product_image.name_image FROM product LEFT JOIN product_image ON product.id_product = product_image.id_product 
                where product.delete_datetime is null and  product.id_product in('$id[$i]')

                   ";
        }
    }

$strSQL .= "
                ) AS K
            GROUP BY K.id_product
            ";

            $objQuery = mysqli_query($objConnect, $strSQL);
          if (isset($objQuery)) {
              ?>
<script src="../js/manage.js"></script>
<?php
                  while ($objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC)) {
                      $img_mi = $objResult['name_image'];
                      if ($img_mi == null) {
                          $img_mi =  "../images/favicon.png";
                      } else {
                          $img_mi =  "../uploads/product/".$img_mi;
                      } ?>
<li>
	<!--<a onclick="deleteproduct('<?= $objResult['id_product']; ?>')" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>-->
	<a class="cart-img" href="#"><img src="<?= $img_mi ?>" alt=""></a>
	<h4><a href="#"><?= lang($objResult['name_product'], $objResult['name_product_en']) ?></a></h4>
	<p class="quantity"><?= $objResult['qty'] ?>x - <span class="amount">฿<?= number_format($objResult['tmp_price'], 2) ?></span></p>
</li>
	
<?php
  }
		  }
?>