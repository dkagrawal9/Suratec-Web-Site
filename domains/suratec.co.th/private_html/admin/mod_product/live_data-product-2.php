<?php
require_once '../library/connect.php';

ini_set('display_errors' , 1);
error_reporting(~0);
//send fast
$strKeyword = null;
$strKeyword_date_fast = null;
$strKeyword_name_fast = null;
//send detail
$strKeyword_name = null;
$strKeyword_code = null;
$strKeyword_cat = null;
$strKeyword_stat = null;
$strKeyword_date = null;
//sort
$strKeyword_sort = null;

if (isset($_POST["cat"]) && $_POST["cat"] != '') {
	$strKeyword = $_POST["cat"];
	$strSQL = "SELECT * FROM product WHERE id_catagory LIKE '%" . $strKeyword . "%' ";
} elseif (isset($_POST['name']) && $_POST['name'] != '') {
	$strKeyword_name_fast = $_POST["name"];
	$strSQL = "SELECT * FROM product WHERE name_product LIKE '%" . $strKeyword_name_fast . "%' ";
} elseif (isset($_POST['date_p_fast']) && $_POST['date_p_fast'] != '') {
	$strKeyword_date_fast = $_POST["date_p_fast"];
	$date_cut = explode('/' , $strKeyword_date_fast);
	$start_date = $date_cut[0];
	$end_date = $date_cut[1];
	$strSQL = "SELECT * FROM product WHERE DATE(date_edit) BETWEEN '" . $start_date . "' AND '" . $end_date . "' ";
} elseif (isset($_POST['name_d']) && $_POST['name_d'] != '') {
	if ($_POST['date_d'] == '') {
		$strKeyword_name = $_POST["name_d"];
		$strKeyword_code = $_POST["code_d"];
		$strKeyword_cat = $_POST["cat_d"];
		$strKeyword_stat = $_POST["status_d"];
		$strSQL = "SELECT product.*,product_attribute.* FROM product LEFT JOIN product_attribute ON product.id_product = product_attribute.id_product      
                                    WHERE product.name_product      LIKE '%" . $strKeyword_name . "%'  
                                    AND product_attribute.SKU_attr  LIKE '%" . $strKeyword_code . "%' 
                                    AND product.id_catagory         LIKE '%" . $strKeyword_cat . "%' 
                                    AND product.status_product_sale LIKE '%" . $strKeyword_stat . "%' GROUP BY product.id_product";
	} else {
		$date_cut = explode('/' , $_POST['date_d']);
		$start_date = $date_cut[0];
		$end_date = $date_cut[1];
		$strKeyword_name = $_POST["name_d"];
		$strKeyword_code = $_POST["code_d"];
		$strKeyword_cat = $_POST["cat_d"];
		$strKeyword_stat = $_POST["status_d"];
		$strKeyword_date = $_POST["date_d"];
		$strSQL = "SELECT product.*,product_attribute.* FROM product LEFT JOIN product_attribute ON product.id_product = product_attribute.id_product 
                                     WHERE product.name_product LIKE '%" . $strKeyword_name . "%' 
                                     AND product_attribute.SKU_attr    LIKE '%" . $strKeyword_code . "%' 
                                     AND product.id_catagory           LIKE '%" . $strKeyword_cat . "%' 
                                     AND product.status_product_sale   LIKE '%" . $strKeyword_stat . "%' 
                                     AND DATE(date_edit)               BETWEEN '" . $start_date . "' AND '" . $end_date . "' GROUP BY product.id_product";
	}
} elseif (isset($_POST['code_d']) && $_POST['code_d'] != '') {
	$strKeyword_code = $_POST["code_d"];
	$strSQL = "SELECT product.*,product_attribute.* FROM product LEFT JOIN product_attribute ON product.id_product = product_attribute.id_product WHERE product_attribute.SKU_attr LIKE '%$strKeyword_code%' GROUP BY product.id_product";
} else {
	$strSQL = "SELECT product.*,product_attribute.* FROM product LEFT JOIN product_attribute ON product.id_product = product_attribute.id_product GROUP BY product.id_product";
}
// if(isset($_GET["cat"]))
// {
//   $strKeyword = $_GET["cat"];
// }

$objQuery = mysqli_query($objConnect , $strSQL);

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
		$strSQL .= " ORDER BY product_attribute.price_attr ASC LIMIT $row_start, $per_page";
	} elseif ($_POST['sort'] == 'p1') {
		$strSQL .= " ORDER BY product_attribute.price_attr DESC LIMIT $row_start, $per_page";
	} elseif ($_POST['sort'] == 'd') {
		$strSQL .= " ORDER BY date_edit ASC LIMIT $row_start, $per_page";
	} elseif ($_POST['sort'] == 'd1') {
		$strSQL .= " ORDER BY date_edit DESC LIMIT $row_start, $per_page";
	}
} else {
	$strSQL .= " ORDER BY level_product LIMIT $row_start, $per_page";
}
$output = '';
@$output .= '<div style="overflow-x:auto;" align="center">
            <!--  <div class="overlay wait-table" style="display:none; margin-top:-21px; margin-left:15px; margin-right:15px; z-index:55">
                <div class="loader" style>
                  <div class="loader-inner ball-grid-pulse">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                  </div>
                </div>
              </div> -->
              <input class="ClickCheckAll_w" type="checkbox" name="CheckAll_w" id="CheckAll_w" value="Y" onClick="ClickCheckAll_w(this);" style="display:none;">';


$i = $row_start;;
$num = 0;
$objQuery = mysqli_query($objConnect , $strSQL) or die (mysqli_error());
$row_objresult = mysqli_num_rows($objQuery);
while ( $objResult = mysqli_fetch_array($objQuery , MYSQLI_ASSOC) ) {
	@$status = explode("," , $objResult['status_product']);
	// @$cut_cat = explode(",", $objResult['id_catagory']);
	// if(!in_array(@$cat, @$cut_cat)) continue;


	$str = "SELECT * FROM product_image WHERE active = 'active' AND id_product = '" . $objResult['id_product'] . "'";
	$query = mysqli_query($objConnect , $str);
	$row = mysqli_num_rows($query);
	$result = mysqli_fetch_array($query);
	if ($row > 0) {
		$image = "../../uploads/product/" . $result['name_image'];
	} else {
		$image = "../img/suit.jpg";
	}

	$str = "SELECT * FROM product_attribute WHERE id_product = '" . $objResult['id_product'] . "' ";
	$query = mysqli_query($objConnect , $str);
	$result = mysqli_fetch_array($query);
	$price = number_format($result['price_attr']) . " บาท*";

	$cutcat = explode("," , $objResult['id_catagory']);

	$strCat = "SELECT * FROM product_catagory";
	$queryCat = mysqli_query($objConnect , $strCat);
	$num++;
	$i++;
	$output .= '<div class="box-manage-product">
            <div class="image-product-attachment cr-image" data-id="' . $objResult['id_product'] . '">
              <img src="' . $image . '">
              <div class="discard overlay-image' . $objResult['id_product'] . '" >
                 <i class="fa fa-times-circle icon-del" id="icon-del' . $objResult['id_product'] . '"></i>
              </div>
            </div>
            <div class="text-detail">
            <h4><div id="test" style="width:180px;height:20px;display:block;overflow:hidden;white-space:nowrap;text-overflow: ellipsis;">
                  ' . $objResult['name_product'] . '</div></h4>
            </div>
            <div class="text-product">
              <p>ราคา : ' . $price . '</p>';
	if (in_array('สินค้าใหม่' , $status)) {
		$output .= '<small class="label pull-left bg-green">new</small>';
	}
	if (in_array('สินค้ายอดนิยม' , $status)) {
		$output .= '<small class="label pull-left bg-red">hot</small>';
	}
	if (in_array('สินค้าแนะนำ' , $status)) {
		$output .= '<small class="label pull-left bg-blue">recom</small>';
	}
	if (in_array('สินค้าลดราคา' , $status)) {
		$output .= '<small class="label pull-left bg-gray">dis</small>';
	}
	if (in_array('สินค้าพรีออเดอร์' , $status)) {
		$output .= '<small class="label pull-left bg-orange">pre</small>';
	}
	$output .= '  </div>
            <div class="contain-control">
              <button type="button" class="btn btn-default delete-product" data-id="' . $objResult['id_product'] . '"><i class="glyphicon glyphicon-trash"></i></button>

              <button type="button" class="btn btn-default" data-id="' . $objResult['id_product'] . '" data-toggle="modal" data-target="#modal-image-product' . $objResult['id_product'] . '">
                <i class="glyphicon glyphicon-zoom-in"></i>
              </button>

              <button type="button" class="edit-product btn btn-default btn-edit" id="" data-id="' . $objResult['id_product'] . '"><i class="fa fa-edit"></i></button> 
              <input type="checkbox" class="crck_w' . $objResult['id_product'] . '" name="Chk[]" value="' . $objResult['id_product'] . '" id="crck' . $num . '" style="display:none;">
            </div>
            <div class="status_transport">';
	if ($objResult['status_product_sale'] == 'มีจำหน่าย') {
		$output .= '   <img src="../img/box.png" width="15" height="15">';
	} elseif ($objResult['status_product_sale'] == 'เร็วๆนี้') {
		$output .= '   <img src="../img/box-soon.png" width="15" height="15">';
	} elseif ($objResult['status_product_sale'] == 'สินค้าหมด') {
		$output .= '   <img src="../img/box-out.png" width="15" height="15">';
	} else {
		$output .= '   <img src="../img/box-close.png" width="15" height="15">';
	}
	if ($objResult['status_ready'] == 1) {
		$output .= '    <img src="../img/shipped.png" width="24" height="24" style="margin:0;">';
	} else {
		$output .= '    <img src="../img/shipped-cut.png" width="24" height="24" style="margin:0;">';
	}
	$output .= ' <input type="text" class="level_product" style="float:right; width: 25px; border: 1px solid #ccc; text-align: center; border-radius: 4px; height: 25px;" value="' . $objResult['level_product'] . '" data-id="' . $objResult['id_product'] . '" onkeypress="return isNumber(event)" />
            </div>
          </div>';
	//------------------------------------------------------------------------------------modal view image----------------------------------------------------------------------------------
	$output .= '<div class="modal fade" id="modal-image-product' . $objResult['id_product'] . '">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
            <div class="pull-left">My Gallery Title</div>
            <button type="button" class="close" data-dismiss="modal" title="Close"> <span class="glyphicon glyphicon-remove"></span></button>
            </div>
            <div class="modal-body">';
	$str_active = "SELECT * FROM product_image WHERE active ='active' AND id_product = '" . $objResult['id_product'] . "'";
	$query_active = mysqli_query($objConnect , $str_active);
	$result_active = mysqli_fetch_array($query_active);
	$src = "../../uploads/product/" . $result_active['name_image'];
	$output .= '<!--CAROUSEL CODE GOES HERE-->
            <!--begin carousel-->
                <div id="myGallery' . $objResult['id_product'] . '" class="carousel slide" data-interval="false">
                <div class="carousel-inner">
                <div class="item active"> <img src="' . $src . '" alt="item0">
                <div class="carousel-caption">
                <!--<h3>Heading 3</h3>
                <p>Slide 0  description.</p>-->
                </div>
                </div>';
	$str_image = "SELECT * FROM product_image WHERE active = '' AND id_product = '" . $objResult['id_product'] . "'";
	$query_image = mysqli_query($objConnect , $str_image);
	while ( $result_image = mysqli_fetch_array($query_image) ) {
		$output .= '    <div class="item"> <img src="../../uploads/product/' . $result_image['name_image'] . '" alt="item1">
                <div class="carousel-caption">
                <!--<h3>Heading 3</h3>
                <p>Slide 1 description.</p>-->
                </div>
                </div>';
	}
	$output .= '    <!--end carousel-inner--></div>
                <!--Begin Previous and Next buttons-->
                <a class="left carousel-control" href="#myGallery' . $objResult['id_product'] . '" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#myGallery' . $objResult['id_product'] . '" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span></a>
                <!--end carousel--></div>
            <!--end modal-body--></div>
            <div class="modal-footer">
            <div class="pull-left">
            <small></small>
            </div>
            <button class="btn-sm close" type="button" data-dismiss="modal">Close</button>
            <!--end modal-footer--></div>
            <!--end modal-content--></div>
            <!--end modal-dialoge--></div>
            <!--end myModal-->></div>';
}
// $page_query = "SELECT * FROM product LIMIT $start_from , $record_per_page";
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
$output .= ' </div>
                <input type="hidden" name="hdnCount_w" value="' . $num . '">
                <div style="margin-bottom:20px;">';
if ($row_objresult == 0) {
	$output .= '      
                  <div class="box-footer" style="margin-top:-21px; padding:0;">
                      <div class="col-md-12" align="center" style="background-color:white; padding:2px;">
                        <h3 style="color:gray; margin-bottom:-9px;">Oops! ไม่พบข้อมูลที่คุณค้นหา</h3>
                        <a href="front-add.php" class="view_add">
                          <font style="font-size:122px; color:#ddd; padding-left:25px; "><i class="fa fa-edit"></i></font>
                          <h5 style="color:gray; margin-top:-31px;">เพิ่มสินค้าเดี๋ยวนี้</h3>
                        </a>
                      </div>
                  </div>';
}
$output .= '       <div class="box-footer" style="">';
if ($num_rows > 0) {
	$output .= '
                    <div class="row">
                      <div class="col-sm-5">
                        <font size="3">บทความที่ ' . $start . ' ถึง ' . $row_end . ' จากทั้งหมด ' . $num_rows . '</font>
                      </div>
                      <div class="col-sm-7">
                        <div class="btn-group" style="float:right; background-color:white;">
                          <button type="button" class="btn btn-paginate previous btn-button pagination_link_w" id=' . $prev_page . ' ' . $active_prev . ' data-ser="' . $strKeyword . '">ก่อนหน้า</button>';
	for ($a = 1; $a <= $num_pages; $a++) {
		if ($a == $page) {
			$class = "page-active";
		} else {
			$class = "";
		}
		$output .= '       <button type="button" class="btn btn-paginate btn-button pagination_link_w ' . $class . '" id=' . $a . ' 
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
	$output .= '              <button type="button" class="btn btn-paginate next btn-button pagination_link_w" id=' . $next_page . ' ' . @$active_next . ' data-ser="' . $strKeyword . '">ถัดไป</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              ';
} else {
	$output .= 'ไม่มีข้อมูล';
}
echo $output;

?>