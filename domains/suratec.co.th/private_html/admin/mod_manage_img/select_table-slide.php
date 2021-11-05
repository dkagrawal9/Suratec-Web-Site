<?php
require_once '../library/connect.php';

$button_edit  = $_POST["button_edit"];
$button_del  = $_POST["button_del"];

$record_per_page = 5;
$page = '';
$output = '';
if (isset($_POST["page"])) {
    $page = $_POST["page"];
} else {
    $page = 1;
}

$start_from = ($page - 1) * $record_per_page;

$output = '';
$strSQL = '';
 $strSQL .= "SELECT image_category.name_catagory, images.id_image,images.name_image,images.level FROM `images` LEFT JOIN image_category ON image_category.id_catagory = images.id_category ORDER BY images.level";
// if (isset($_POST["id"]) && $_POST["id"] != '0') {
//    $strSQL .= " WHERE slide.id_slide_catagory= '".$_POST["id"]."' ";
// }


$objQuery = mysqli_query($objConnect, $strSQL) or die (mysqli_error());
$output .= '
              <div style="overflow-x:auto;">
              <table align="center">
                  <thead>
                    <tr>
                      <th style="text-align: center; min-width: 50px; width:50px;"><input class="ClickCheckAll" type="checkbox" name="CheckAll" id="CheckAll" value="Y" onClick="ClickCheckAll(this);"></th>
                      <th colspan="2" style="text-align: center;">รูปภาพ</th>
                      <th style="text-align: center; min-width: 100px; width:150px;">หัวข้อ</th>
                      <th style="text-align: center;">ลำดับ</th>
                      <th style="text-align: center; min-width: 100px; width:150px;">ควบคุม</th>
                    </tr>
                  </thead>
                  <tbody>
                  ';
$i = $start_from;
$start = $start_from + 1;
$num = 0;
while ( $objResult = mysqli_fetch_array($objQuery) ) {
    $num++;
    $i++;
    $output .= '          
                    <tr>
                      <td style="text-align: center;">
                        <input type="checkbox" class="checkbox_remove minimal-red" name="Chk[]" id="Chk' . $num . '" value="' . $objResult['id_image'] . '">
                      </td>
                      <td width="3%">
                        ' . $i . '
                      </td>
                      <td  style=" width: 5%;">
                        <img width="200" height="60" src="../../uploads/mod_image/' . $objResult['name_image'] . '">
                      </td>
                     
                    
                      <td style="text-align: center;">
                       <strong>' . "หัวข้อ :</strong>" . $objResult['name_catagory'] . '<br>
                      </td>
                      
                      <td style="text-align: center;">
                      <input type="text" class="level_slide" style="width: 30px; border: 1px solid #ccc; text-align: center; border-radius: 4px; height: 30px;" value="' . $objResult["level"] . '" data-id="' . $objResult['id_image'] . '" onkeypress="return isNumber(event)" />
                      </td>
                      <td style="text-align: center;">
                        <div class="btn-group">
                          <a  href="t1.php?id_da='. $objResult['id_image'].'" style="'.$button_edit.'"  data-toggle="modal" data-target="#modal_showdetail">
                    <button style="background-color: white;" type="button" class="show-product btn btn-default" id="" data-id="'. $objResult['id_image'].'">
                         <i class="fa fa-edit"></i></button>
                    </a>
                          <button type="button" style="'.$button_del.' " class="delete-slide btn btn-default" data-id= "' . $objResult["id_image"] . '">
                                    <i class="fa fa-remove"></i>
                          </button>
                        </div>
                      </td>
                    </tr>';
}

// <button style="background-color: white;" type="button" class="edit-slide btn btn-default" id=""
//                                   data-name="' . $objResult['name_slide'] . '" 
//                                   data-name-en="' . $objResult['name_slide_en'] . '" 
//                                   data-id="' . $objResult['id_slide'] . '"
//                                   data-name-image="' . $objResult['name_image'] . '"
//                                   data-content="' . $objResult['text'] . '"
//                                   data-content-en="' . $objResult['text_en'] . '"
//                                   >
//                                   <i class="fa fa-edit"></i>
//                           </button>
 $page_query = "";                         
$page_query .= "SELECT image_category.name_catagory, images.id_image,images.name_image,images.level FROM `images` LEFT JOIN image_category ON image_category.id_catagory = images.id_category ORDER BY images.level";

// if (isset($_POST["id"]) && $_POST["id"] != '0') {
//    $page_query .= " WHERE slide.id_slide_catagory= '".$_POST["id"]."' ";
// }
$page_result = mysqli_query($objConnect, $page_query);
$total_records = mysqli_num_rows($page_result);
$total_pages = ceil($total_records / $record_per_page);

$Prev_Page = $page - 1;
$Next_Page = $page + 1;

if ($Prev_Page == 0) {
    $active_prev = "Disabled";
}else{
  $active_prev = "";
}
if ($page == $total_pages) {
    $active_next = "Disabled";
}

$output .= '</tbody>
        </table> 
        </div>
        <input type="hidden" name="hdnCount" value="' . $num . '">
        <div class="box-footer">';
if ($total_records > 0) {
    $output .= '  <div class="row">
                        <div class="col-sm-5">
                          <font size="3">สไล้ด์ที่ ' . $start . ' ถึง ' . $i . ' จากทั้งหมด ' . $total_records . '</font>
                        </div>
                        <div class="col-sm-7">
                          <div class="btn-group" style="float:right; background-color:white;">
                            <button type="button" class="btn btn-paginate previous btn-button pagination_link" id=' . $Prev_Page . ' ' . $active_prev . '>ก่อนหน้า</button>';
    for ($a = 1; $a <= $total_pages; $a++) {
        if ($a == $page) {
            $class = "page-active";
        } else {
            $class = "";
        }
        $output .= '<button type="button" class="btn btn-paginate btn-button pagination_link ' . $class . '" id=' . $a . '>' . $a . '</button>';
    }
    $output .= '       <button type="button" class="btn btn-paginate next btn-button pagination_link" id=' . $Next_Page . ' ' . @$active_next . '>ถัดไป</button>
                          </div>
                        </div>
                      </div>
                    </div>';
} else {
    $output .= 'ไม่มีข้อมูล';
}
echo $output
?>