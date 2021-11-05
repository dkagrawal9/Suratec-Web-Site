<?php
require_once '../library/connect.php';

ini_set('display_errors' , 1);
error_reporting(~0);
//send fast
$button_edit  = $_POST["button_edit"];
$button_del  = $_POST["button_del"];
$button_open   = $_POST["button_open"];
$input_read   = $_POST["input_read"];


$strKeyword = null;
$strKeyword_date_fast = null;
$strKeyword_name_fast = null;
//send detail
$strKeyword_name = null;
$strKeyword_code = null;
$strKeyword_cat = null;
$strKeyword_stat = null; //delete already
$strKeyword_date = null;
//sort
$strKeyword_sort = null;

if (isset($_POST["cat"]) && $_POST["cat"] != '') {
	$strKeyword = $_POST["cat"];
	$strSQL = "SELECT * FROM product WHERE id_catagory LIKE '%" . $strKeyword . "%' ";
	$strSQL .= " AND `delete_datetime` IS NULL";
} elseif (isset($_POST['name']) && $_POST['name'] != '') {
	$strKeyword_name_fast = $_POST["name"];
	$strSQL = "SELECT * FROM product WHERE name_product LIKE '%" . $strKeyword_name_fast . "%' or tmp_price LIKE '%" . $strKeyword_name_fast . "%'";
	$strSQL .= " AND `delete_datetime` IS NULL";
 } 

 //elseif (isset($_POST['date_p_fast']) && $_POST['date_p_fast'] != '') {
// 	$strKeyword_date_fast = $_POST["date_p_fast"];
// 	$date_cut = explode('/' , $strKeyword_date_fast);
// 	$start_date = $date_cut[0];
// 	$end_date = $date_cut[1];
// echo	$strSQL = "SELECT * FROM product WHERE DATE(date_edit) BETWEEN '" . $start_date . "' AND '" . $end_date . "' ";
// } elseif (isset($_POST['name_d']) && $_POST['name_d'] != '') {
// 	if ($_POST['date_d'] == '') {
// 		$strKeyword_name = $_POST["name_d"];
// 		$strKeyword_code = $_POST["code_d"];
// 		$strKeyword_cat = $_POST["cat_d"];
// 	echo	$strSQL = "SELECT product.*,product_attribute.* FROM product LEFT JOIN product_attribute ON product.id_product = product_attribute.id_product      
//                                     WHERE product.name_product      LIKE '%" . $strKeyword_name . "%'  
//                                     AND product_attribute.SKU_attr  LIKE '%" . $strKeyword_code . "%' 
//                                     AND product.id_catagory         LIKE '%" . $strKeyword_cat . "%' ";
// 	// } else {
	// 	$date_cut = explode('/' , $_POST['date_d']);
	// 	$start_date = $date_cut[0];
	// 	$end_date = $date_cut[1];
	// 	$strKeyword_name = $_POST["name_d"];
	// 	$strKeyword_code = $_POST["code_d"];
	// 	$strKeyword_cat = $_POST["cat_d"];
	// 	$strKeyword_date = $_POST["date_d"];
	// echo	$strSQL = "SELECT product.*,product_attribute.* FROM product LEFT JOIN product_attribute ON product.id_product = product_attribute.id_product 
 //                                     WHERE product.name_product LIKE '%" . $strKeyword_name . "%' 
 //                                     AND product_attribute.SKU_attr    LIKE '%" . $strKeyword_code . "%' 
 //                                     AND product.id_catagory           LIKE '%" . $strKeyword_cat . "%' 
 //                                     AND DATE(date_edit)               BETWEEN '" . $start_date . "' AND '" . $end_date . "' GROUP BY product.id_product";
	// }
// } elseif (isset($_POST['code_d']) && $_POST['code_d'] != '') {
// 	$strKeyword_code = $_POST["code_d"];
// echo	$strSQL = "SELECT product.*,product_attribute.* FROM product LEFT JOIN product_attribute ON product.id_product = product_attribute.id_product WHERE product_attribute.SKU_attr LIKE '%$strKeyword_code%'  GROUP BY product.id_product";
//}
 else {

	$strSQL = "SELECT * FROM product ";
	$strSQL .= " WHERE `delete_datetime` IS NULL";
}
if(isset($_GET["cat"]))
{
  $strKeyword = $_GET["cat"];
}

$objQuery = mysqli_query($objConnect , $strSQL);
// if($objQuery){
//   echo $strSQL;
// }else{
//   echo $strSQL;
// }
$num_rows = mysqli_num_rows($objQuery);

$per_page = 50;
$page = 1;

if (isset($_POST["page"])) {
	$page = $_POST["page"];
}

$prev_page = $page - 1;
$next_page = $page + 1;

$row_start = (($per_page * $page) - $per_page);
if ($num_rows <= $per_page) {
	$num_pages = 1;
} else if (($num_rows % $per_page) == 0) {
	$num_pages = ($num_rows / $per_page);
} else {
	$num_pages = ($num_rows / $per_page) + 1;
	$num_pages = (int) $num_pages;
}
$row_end = $per_page * $page;
if ($row_end > $num_rows) {
	$row_end = $num_rows;
}
// ORDER BY--------------------------------------------------------
if (isset($_POST['sort']) && $_POST['sort'] != '') {
	$strKeyword_sort = $_POST['sort'];
	// set POST
	if ($_POST['sort'] == 'n') {
		$strSQL .= " ORDER BY product.name_product ASC LIMIT $row_start, $per_page";
	} elseif ($_POST['sort'] == 'n1') {
		$strSQL .= " ORDER BY product.name_product DESC LIMIT $row_start, $per_page";
	} elseif ($_POST['sort'] == 'l') {
		$strSQL .= " ORDER BY product.level_product DESC LIMIT $row_start, $per_page";
	} elseif ($_POST['sort'] == 'l1') {
		$strSQL .= " ORDER BY product.level_product ASC LIMIT $row_start, $per_page";
	} elseif ($_POST['sort'] == 'p') {
		$strSQL .= " ORDER BY product.tmp_price ASC LIMIT $row_start, $per_page";
	} elseif ($_POST['sort'] == 'p1') {
		$strSQL .= " ORDER BY product.tmp_price DESC LIMIT $row_start, $per_page";
	} elseif ($_POST['sort'] == 'd') {
		$strSQL .= " ORDER BY product.date_edit ASC LIMIT $row_start, $per_page";
	} elseif ($_POST['sort'] == 'd1') {
		$strSQL .= " ORDER BY product.date_edit DESC LIMIT $row_start, $per_page";
	}
} else {
	$strSQL .= " ORDER BY level_product LIMIT $row_start, $per_page";
}
// echo $strSQL;
$objQuery = mysqli_query($objConnect , $strSQL) or die(mysqli_error($objConnect));

$row_objresult = mysqli_num_rows($objQuery);
$output = '';
$output .= ' <div style="overflow-x:auto;">
            <table class="table-product">
              <thead>';
if ($row_objresult != 0) {
	$output .= '
                    <tr>
                      <th style="text-align: center; min-width:50px; width:50px;"><input class="ClickCheckAll" type="checkbox" name="CheckAll" id="CheckAll" value="Y" onClick="ClickCheckAll(this);"></th>
                      <th width="20%">สาขา</th>
                      <th width="10%">ภาพสินค้า</th>
                      <th width="20%">ชื่อ</th>
                    <!-- <th width="20%">สินค้าจับคู่</th> -->
                      <th style="text-align: center; min-width:100px; width:60px;">ราคา</th>
                    <!--  <th style="text-align: center; min-width:100px; width:60px;">ลำดับ</th>-->
                    <!--  <th style="text-align: center; min-width:100px; width:150px;">แก้ไขล่าสุด</th>-->
                      <th style="text-align: center; min-width:100px; width:150px;">ควบคุม</th>
                    </tr>';
}
$output .= '
                  </thead>
                  <tbody>
        ';
$i = $row_start;
$num = 0;
while ( $objResult = mysqli_fetch_array($objQuery , MYSQLI_ASSOC) ) {

	$status = explode("," , $objResult['status_product']);
	// $cut_cat = explode(",", $objResult['id_catagory']);
	// if(!in_array($cat, $cut_cat)) continue;

	$str = "SELECT * FROM product_image WHERE active = 'active' AND id_product = '" . $objResult['id_product'] . "' LIMIT 1";
	$query = mysqli_query($objConnect , $str);
	$row = mysqli_num_rows($query);
	$result = mysqli_fetch_array($query);

	if ($row > 0) {
		$image = "../../uploads/product/" . $result['name_image'];
	} else {
		$image = "img/noimage.png";
	}
	$str_branch = "SELECT * FROM `mod_erp_branch` WHERE `id_branch`= '" . $objResult['id_branch'] . "' LIMIT 1";
	$query_branch = mysqli_query($objConnect , $str_branch);
	$row_branch = mysqli_num_rows($query_branch);
	$result_branch = mysqli_fetch_array($query_branch);

	if ($row_branch > 0) {
		$result_branch =  $result_branch['name_branch'];
	} else {
		$result_branch = '';
	}

	$cutcat = explode("," , $objResult['id_catagory']);

	$strCat = "SELECT * FROM product_catagory";
	$queryCat = mysqli_query($objConnect , $strCat);

	$str = "SELECT * FROM product_attribute WHERE id_product = '" . $objResult['id_product'] . "'";
	$query = mysqli_query($objConnect , $str);
	$result = mysqli_fetch_array($query);
	$price_n = number_format($result['price_n_attr']);
	$price = number_format($result['price_attr']);


	$time = strtotime($objResult['date_edit']);
	$date = date("j F Y H:i:s" , $time);

	$num++;
	$i++;
	$output .= '<tr>
              <td style="text-align: center;">
                  <input type="checkbox" class="checkbox_remove" name="Chk[]" id="Chk' . $num . '" value="' . $objResult['id_product'] . '">

              </td>

               <td >
                ' . $result_branch . '
              </td>

              <td>
                <div class="image-product-list">
                  <img src="' . $image . '">
                </div>
              </td>
              <td>

                <div id="test" >
                  ' . $objResult['name_product'] . '<br>
                </div>
            <div style="float:right; margin-top:-7px;">';
            //ฟิกขนาดแสดงข้อความที่เหลือให้อ่านต่อเป็น... <div id="test" style="width:150px;height:20px;display:block;overflow:hidden;white-space:nowrap;text-overflow: ellipsis;">
	// if ($objResult['status_product_sale'] == 'มีจำหน่าย') {
	// 	$output .= '   <img src="../img/box.png" width="15" height="15" style="margin-right:2px;">';
	// } elseif ($objResult['status_product_sale'] == 'เร็วๆนี้') {
	// 	$output .= '   <img src="../img/box-soon.png" width="15" height="15" style="margin-right:2px;">';
	// } elseif ($objResult['status_product_sale'] == 'สินค้าหมด') {
	// 	$output .= '   <img src="../img/box-out.png" width="15" height="15" style="margin-right:2px;">';
	// } else {
	// 	$output .= '   <img src="../img/box-close.png" width="15" height="15" style="margin-right:2px;">';
	// }
	// if ($objResult['status_ready'] == 1) {
	// 	$output .= '    <img src="../img/shipped.png" width="24" height="24" style="margin:0;">';
	// } else {
	// 	$output .= '    <img src="../img/shipped-cut.png" width="24" height="24" style="margin:0;">';
	// }
	$output .= '</div>';
	// if (in_array('สินค้าใหม่' , $status)) {
	// 	$output .= '<small class="label pull-left bg-green">new</small>';
	// }
	// if (in_array('สินค้ายอดนิยม' , $status)) {
	// 	$output .= '<small class="label pull-left bg-red">hot</small>';
	// }
	// if (in_array('สินค้าแนะนำ' , $status)) {
	// 	$output .= '<small class="label pull-left bg-blue">recom</small>';
	// }
	// if (in_array('สินค้าลดราคา' , $status)) {
	// 	$output .= '<small class="label pull-left bg-gray">dis</small>';
	// }
	// if (in_array('สินค้าพรีออเดอร์' , $status)) {
	// 	$output .= '<small class="label pull-left bg-orange">pre</small>';
	// }
	$output .= '</td>';
              // <td style="text-align:center;">
              
	//              if($objResult['differ']=='1' || $objResult['differ']=='4'){

	//              }else{
	// $output .= '
	//              <select class="form-control changed_math">';
	//              if($objResult['math']!=''){
	// $output .= ' <option value="0">--เลือกรูปแบบ--</option>
	//             <option value="'.$objResult['id_product'].'-0-0">ยกเลิกการจับคู่</option>';
	//             }else{
	// $output .= ' <option value="0">--ยังไม่ได้จับคู่สินค้า--</option>';
	//             }
	//                $str_math = "SELECT * FROM product WHERE differ = '1' AND math = '' ";
	//                $query_math = mysqli_query($objConnect,$str_math);
	//                $ckn=0;
	//                while($result_math = mysqli_fetch_array($query_math)){
	//                 $ckn++;
	//                 $output .= '<option value="'.$objResult['id_product'].'-'.$result_math['id_product'].'-1">'.$result_math['name_product'].'</option>';
	//                }
	//             }
	// $output .= '
	//              </select>
	//             </td>
	$output .= '
              <td style="text-align:center;">';
	if (!$price_n == 0) {
		$output .= '';
	}
// <strike><font style="font-size:12px; color:gray;">' . $price_n . '</font></strike><br>
// 	 <b><font style="color:gray;">' . $price . '</font></b><br> 
	$output .= '' . $objResult['tmp_price'] . '
              
              </td>
             <!--  <td style="text-align: center;">
              <input type="text" class="level_product" style="width: 30px; border: 1px solid #ccc; text-align: center; border-radius: 4px; height: 30px;" value="' . $objResult['level_product'] . '" data-id="' . $objResult['id_product'] . '" onkeypress="return isNumber(event)" />
              </td> -->

             <!--  <td style="text-align: center;">
                  <font style="font-size:12px; color:gray;">' . $date . '</font>
              </td>-->

              <td style="text-align: center;">
                <div class="btn-group">
                <button style="background-color: white;'.$input_read.'" type="button" class="show-product btn btn-default" id="" data-id="' . $objResult['id_product'] . '">
                        <i class="fa fa-fw fa-eye"></i></button>

                    <button style="background-color: white; '.$button_edit.'" type="button" class="edit-product btn btn-default" id="" data-id="' . $objResult['id_product'] . '">
                        <i class="fa fa-edit"></i></button>
                        

                    <button style="'.$button_del.'" type="button" class="btn btn-default delete-product" data-id="' . $objResult['id_product'] . '"><i class="fa fa-remove"></i></button>
                </div> 
              
              </td>

            </tr>
        ';

}
// $page_query = "SELECT * FROM product";
// $page_result = mysqli_query($objConnect,$page_query);
// $total_records = mysqli_num_rows($page_result);
// $total_pages = ceil($total_records/$record_per_page);
$start = $row_start + 1;

if (@$prev_page == 0) {
	$active_prev = "Disabled";
} else {
	$active_prev = '';
}
if (@$row_end == $num_rows) {
	$active_next = "Disabled";
} else {
	$active_next = '';
}
if ($row_objresult == 0) {
	$output .= '<tr>
                <td colspan="9" bgcolor="white">
                  <div class="row" style="'.$button_open.'">
                    <div class="col-md-12" align="center">
                      <h3 style="color:gray; margin-bottom:-10px;">Oops! ไม่พบข้อมูลที่คุณค้นหา</h3>
                      <a  href="front-add.php" class="view_add">
                        <font style="font-size:122px; color:#ddd; padding-left:25px;"><i class="fa fa-edit"></i></font>
                        <h5 style="color:gray; margin-top:-30px;">เพิ่มสินค้าเดี๋ยวนี้</h3>
                      </a>
                    </div>
                  </div>
                </td>
              </tr>';
}
$output .= '</tbody>
          </table>
          </div>
          <input type="hidden" name="hdnCount" value="' . $num . '">

        <div class="box-footer">';
if ($num_rows > 0) {
	$output .= '
          <div class="row">
            <div class="col-sm-5">
              <font size="3">สินค้าที่ ' . $start . ' ถึง ' . $row_end . ' จากทั้งหมด ' . $num_rows . '</font>
            </div>
            <div class="col-sm-7">
              <div class="btn-group" style="float:right; background-color:white;">
                <button type="button" class="btn btn-paginate previous btn-button pagination_link" id=' . $prev_page . ' ' . $active_prev . '
                  data-ser="' . $strKeyword . '"
                  data-d-fast="' . $strKeyword_date_fast . '"
                  data-n-fast="' . $strKeyword_name_fast . '"
                  data-n="' . $strKeyword_name . '"
                  data-c="' . $strKeyword_code . '"
                  data-ca="' . $strKeyword_cat . '"
                  data-s="' . $strKeyword_stat . '"
                  data-d="' . $strKeyword_date . '"
                  data-sort="' . $strKeyword_sort . '">ก่อนหน้า</button>';

	for ($a = 1; $a <= $num_pages; $a++) {
		if ($a == $page) {
			$class = "page-active";
		} else {
			$class = "";
		}
		$output .= '<button type="button" class="btn btn-paginate btn-button pagination_link ' . $class . '" id=' . $a . '
                              data-ser="' . $strKeyword . '"
                              data-d-fast="' . $strKeyword_date_fast . '"
                              data-n-fast="' . $strKeyword_name_fast . '"
                              data-n="' . $strKeyword_name . '"
                              data-c="' . $strKeyword_code . '"
                              data-ca="' . $strKeyword_cat . '"
                              data-s="' . $strKeyword_stat . '"
                              data-d="' . $strKeyword_date . '"
                              data-sort="' . $strKeyword_sort . '">' . $a . '</button>';
	}
	$output .= '<button type="button" class="btn btn-paginate next btn-button pagination_link" id=' . $next_page . ' ' . @$active_next . '
                  data-ser="' . $strKeyword . '"
                  data-d-fast="' . $strKeyword_date_fast . '"
                  data-n-fast="' . $strKeyword_name_fast . '"
                  data-n="' . $strKeyword_name . '"
                  data-c="' . $strKeyword_code . '"
                  data-ca="' . $strKeyword_cat . '"
                  data-s="' . $strKeyword_stat . '"
                  data-d="' . $strKeyword_date . '"
                  data-sort="' . $strKeyword_sort . '">ถัดไป</button>
              </div>
            </div>
          </div>
        </div>';
} else {
	$output .= 'ไม่มีข้อมูล';
}
echo $output
?>


<!--
<div align="center">
<div class="btn-group">';

for($a=1; $a<=$total_pages;$a++)
{
  $output .= '<button type="button" class="btn btn-default btn-flat pagination_link" id='.$a.'>'.$a.'</button>';
}
$output .='</div></div></div>';
echo $output;-->
<!-----------------------------------------------------------------for dev in future  -->
<!-- <td style="text-align: center;">
                  <input type="text" class="level_slide" style="width: 30px; border: 1px solid #ccc; text-align: center; border-radius: 4px; height: 30px;" value="'.$objResult["level"].'" data-id="'.$objResult['id_article'].'" onkeypress="return isNumber(event)" />
              </td>

    <th style="text-align: center;">ลำดับ</th>
