<?php

 require_once '../admin/library/connect.php';
 require_once '../admin/library/config.php';

 $page = $_REQUEST['page'];
 $search = $_REQUEST['search'];

 $searchall = $_REQUEST['searchall'];

if ($searchall == "") {
    $searchall = "";
} else {
    $searchall = "and name_product like  '%".$searchall."%'";
}

 $searchgroup = $_REQUEST['searchgroup'];

if ($searchgroup == 0) {
    $searchgroup = "";
} else {
    $searchgroup =  "and id_catagory in (".$searchgroup.")";
}

 if ($search == 0) {
     $sqlcheck =  '';
 } elseif ($search == 1) {
     $sqlcheck =  'ORDER BY name_product DESC';
 } elseif ($search == 2) {
     $sqlcheck =  'ORDER BY tmp_price ASC';
 } elseif ($search == 3) {
     $sqlcheck =  'ORDER BY tmp_price DESC';
 } elseif ($search == 4) {
     $sqlcheck =  'ORDER BY name_product ASC';
 } elseif ($search == 5) {
     $sqlcheck =  'ORDER BY name_product DESC';
 }

?>
<div class="row">
<?php


$perpage = 12;
if (isset($_REQUEST["page"])) {
    $page = $_REQUEST["page"];
} else {
    $page = 1;
}

$start = ($page - 1) * $perpage;

 $strSQL = "SELECT * FROM `product` LEFT JOIN product_image ON product.id_product = product_image.id_product 
   where product.delete_datetime is null $searchgroup $sqlcheck $sqlcheck LIMIT $start,$perpage  ";
 $objQuery = mysqli_query($objConnect,$strSQL); /*suggest_flg = '1'*/
  $rows = $objQuery->num_rows;
                //echo $rows;
                if ($rows !== 0) {
                } else {
                    echo '<span class="mb-5 text-center"><i class="icofont icofont-info-circle icofont-2x" style="color: #00A9E8;"></i> &nbsp;ไม่พบข้อมูล</span>';
                }
//  echo 'aaa'.$strSQL;
 while ($objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC)) {
?>
								<div class="col-12">
                                    <!-- Single Product -->
                                    <div class="single-product">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-12">
                                                <!-- Product Head -->
                                                <div class="product-head overlay">
                                                    <img src="../uploads/product/<?= $objResult['name_image'] ?>" alt="#" width="340px;" height="200px;">
                                                    <!--<div class="product-overlay">
                                                        <a href="#" class="btn wishlist" title="add to Wishlist"><i class="fa fa-heart"></i></a>
                                                        <a href="shop-single.html" class="btn view"><i class="fa fa-link"></i></a>
                                                    </div>-->
                                                </div>
                                                <!--/ End Product Head -->
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-12">
                                                <!-- Product Meta -->
                                                <div class="product-meta">
                                                    <div class="price">
                                                        <p>฿ <span><?= $objResult['tmp_price'] ?></span></p><br>
                                                    </div>
                                                    <h4><a href="#"><?= $objResult['name_product'] ?></a></h4>                
                                                    <p><?= $objResult['detail_product'] ?></p>
													<?php $i=1; ?>
                                                    <button onclick="add_Cart('<?=$objResult['id_product']; ?>','<?=$objResult['tmp_price']; ?>','<?=$objResult['tmp_price']; ?>');" type="submit" class="btn"><i class="fa fa-shopping-basket"></i>เพิ่มใส่ตะกร้า<!--Add to cart--></button>
                                                </div>
                                                <!--/ End Product Meta -->
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ End Single Product -->
                                </div>
<?php
 }

 $perpage = 12;
 if (isset($_GET['page'])) {
     $page = $_GET['page'];
 } else {
     $page = 12;
 }

 $strSQL = "SELECT * FROM `product` LEFT JOIN product_image ON product.id_product = product_image.id_product 
   where product.delete_datetime is null  ";
$objQuery = mysqli_query($objConnect,$strSQL);
$total_record = mysqli_num_rows($objQuery);
$total_page = ceil($total_record / $perpage);


$numpage = 1;
$num = 0;
$num =  $total_page;


 if ($page == 1) {
     $count = $page;
 } else {
     $count = $page-1;
 }


 if (isset($_GET['page'])) {
     $pagecheck = $pagecheck = $_GET['page'];
     ;
 } else {
     $pagecheck = '1';
 }
//echo $count . "++" . $num;

?>

</div>




	
<div class="row">
                        <div class="col-12">
                            <!-- Pagination -->
                            <div class="pagination-main">
                                <ul class="pagination" style="text-align: center;">
                                    <li <?php  if ($count <= 1) {
    echo 'class="page-item disabled"';
} else {
    echo 'class="page-item"';
} ?> class="prev"><a style="padding-top: 13px;" onclick="searchpage(<?php echo '1' ?>);"><i class="fa fa-angle-double-left"></i></a></li>
									 <?php for ($i=$count;$i<=$num;$i++) {    ?>
                                    <li class="<?php if ($page == $i) {
    echo 'active';
} else {
    echo '';
} ?> "><a <?php if ($page == $i) {
    echo 'class="page-link"';
} else {
    echo 'class="page-link"';
} ?> onclick="searchpage(<?php echo $i ?>);" style="padding-top: 0px;"><?php echo $i; ?></a></li>
				 <?php
                } ?>
                <li <?php  if ($count <= 1) {
                    echo 'class="page-item disabled"';
                } else {
                    echo 'class="page-item"';
                } ?>><a style="padding-top: 13px;" onclick="searchpage(<?php echo $total_page ?>);"><i class="fa fa-angle-double-right"></i></a></li>
                                </ul>
                            </div>
                            <!--/ End Pagination -->
                        </div>
                    </div>	


                  
    
                                       
                           