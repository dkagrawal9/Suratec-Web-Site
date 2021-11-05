<?php
require_once '../library/connect.php';
ini_set('display_errors', 1);
error_reporting(~0);

session_start();

$task_view = explode(",",$_SESSION['task_view']);
$task_authen = explode(",",$_SESSION['task_authen']);
if($_SESSION['permission']!='Super_admin' && isset($_COOKIE['id_system'])){
  if(($key = array_search($_COOKIE['id_system'],$task_view)) !== false){ 
    if($task_authen[$key]==1){
      $button_del_s = 'display:none';
      $button_open = '';
      $button_del = '';
      $button_edit = '';
      $input_read = '';
    }elseif($task_authen[$key]==2){
      $button_del_s = 'display:none';
      $button_open = '';
      $button_del = 'display:none';
      $button_edit = '';
      $input_read = '';
    }elseif($task_authen[$key]==3){
      $button_del_s = 'display:none';
      $button_open = 'display:none';
      $button_del = 'display:none';
      $button_edit = 'display:none';
      $input_read = 'readonly';
    }
  }else{
    $button_del_s = 'display:none';
    $button_open = 'display:none';
    $button_del = 'display:none';
    $button_edit = 'display:none';
    $input_read = 'readonly';
  }
}else{
  $button_del_s = '';
  $button_open = '';
  $button_del = '';
  $button_edit = '';
  $input_read = '';
}

if($_SESSION['permission']!='Super_admin'){
  $null_del = 'AND delete_datetime IS NULL';
}else{
  $null_del = '';
}

//send fast
$strKeyword_name_fast = null;
//send detail
$strKeyword_name = null;
$strKeyword_code = null;
$strKeyword_phone = null;
$strKeyword_type = null;
//sort
$strKeyword_sort = null;

if (isset($_POST['name']) && $_POST['name'] != '') {
    $strKeyword_name_fast = $_POST["name"];
    $strSQL               = "SELECT * FROM mod_erp_branch WHERE delete_datetime IS NULL 
                                                          AND name_branch LIKE '%" . $strKeyword_name_fast . "%' 
                                                          OR code_branch LIKE '%" . $strKeyword_name_fast . "%'
                                                          OR phone LIKE '%" . $strKeyword_name_fast . "%'";
}elseif (isset($_POST['name_branch'])) {
        if($_POST['type_branch']==''){
          $strKeyword_name = $_POST["name_branch"];
          $strKeyword_code = $_POST["code_branch"];
          $strKeyword_phone  = $_POST["phone_branch"];
          $strSQL          = "SELECT * FROM mod_erp_branch  WHERE delete_datetime IS NULL 
                                                            AND name_branch LIKE '%" . $strKeyword_name . "%'
                                                            AND code_branch                         LIKE '%" . $strKeyword_code . "%'
                                                            AND phone                               LIKE '%" . $strKeyword_phone . "%'";
        }else{
          $strKeyword_name = $_POST["name_branch"];
          $strKeyword_code = $_POST["code_branch"];
          $strKeyword_phone  = $_POST["phone_branch"];
          $strKeyword_type = $_POST["type_branch"];
          $strSQL          = "SELECT * FROM mod_erp_branch  WHERE delete_datetime IS NULL 
                                                            AND name_branch LIKE '%" . $strKeyword_name . "%'
                                                            AND code_branch                         LIKE '%" . $strKeyword_code . "%'
                                                            AND phone                               LIKE '%" . $strKeyword_phone . "%'
                                                            AND type                                =     '" . $strKeyword_type . "'";
        }
    
} else {
    $strSQL = "SELECT * FROM mod_erp_branch WHERE delete_datetime IS NULL";
}
// if(isset($_GET["cat"]))
// {
//   $strKeyword = $_GET["cat"];
// }

$objQuery = mysqli_query($objConnect, $strSQL);

$num_rows = mysqli_num_rows($objQuery);

$per_page = 50;
$page     = 1;

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
        $strSQL .= " ORDER BY name_branch ASC LIMIT $row_start, $per_page";
    } elseif ($_POST['sort'] == 'n1') {
        $strSQL .= " ORDER BY name_branch DESC LIMIT $row_start, $per_page";
    } elseif ($_POST['sort'] == 's') {
        $strSQL .= " ORDER BY code_branch DESC LIMIT $row_start, $per_page";
    } elseif ($_POST['sort'] == 's1') {
        $strSQL .= " ORDER BY code_branch ASC LIMIT $row_start, $per_page";
    } elseif ($_POST['sort'] == 'c') {
        $strSQL .= " ORDER BY type ASC LIMIT $row_start, $per_page";
    } elseif ($_POST['sort'] == 'c1') {
        $strSQL .= " ORDER BY type DESC LIMIT $row_start, $per_page";
    }
} else {
    $strSQL .= " ORDER BY type LIMIT $row_start, $per_page";
}
$objQuery      = mysqli_query($objConnect, $strSQL) or die(mysqli_error());
$row_objresult = mysqli_num_rows($objQuery);
$output        = '';

$output .= ' <div style="overflow-x:auto;">
  <form id="frm_table"  method="post">
 <input type="hidden" name="form" value="soft-delmulti">
            <table class="">
              <thead>';
if ($row_objresult != 0) {
    $output .= '
                    <tr>';
    if($button_edit==''){
      $output .= '
                      <th style="text-align: center; min-width:50px; width:50px;"><input class="ClickCheckAll" type="checkbox" name="CheckAll" id="CheckAll" value="Y" onClick="ClickCheckAll(this);"></th>';
        }
      $output .= '
                      <th colspan="2" style="width:20px;">ทั้งหมด</th>
                      <th style="text-align:center">รหัสร้านค้า</th>
                      <th style="text-align:center">ชื่อร้านค้า</th>
                      <th style="text-align:center">เบอร์โทรศัพท์</th>
                      <th style="text-align:center">ประเภท</th>';
    if($button_edit==''){
      $output .= '
                      <th style="text-align:center">ควบคุม</th>';
    }

    $output .= '
                    </tr>';
}
$output .= '
                  </thead>
                  <tbody>
        ';
$i   = $row_start;
$num = 0;
while ($objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC)) {

    $str    = "SELECT * FROM mod_erp_branch_image WHERE id_branch = '".$objResult['id_branch']."'";
    $query  = mysqli_query($objConnect, $str);
    $row    = mysqli_num_rows($query);
    $result = mysqli_fetch_array($query);
    if ($row > 0) {
        $image = "../../uploads/branch/" . $result['name_image'];
    } else {
        $image = "../img/suit.jpg";
    }


    $num++;
    $i++;
    $output .= '<tr>';
    if($button_edit==''){
      $output .= '
              <td style="text-align: center;">
                  <input type="checkbox" class="checkbox_remove" name="Chk[]" id="Chk' . $num . '" value="' . $objResult['id_branch'] . '">
              </td>';
      }
      $output.= '
               <td width="3%" style="text-align:center;">
                ' . $i . '
              </td>

              <td style="width:20px; min-width:100px; text-align:center;">
                <div class="image-product-list">
                  <img src="' . $image . '">
                </div>
              </td>
              <td style="text-align:center; width:17%; min-width:100px;">
                  ' . $objResult['code_branch'] .'<br>';
          
    $output .= '</td>';
 
    $output .= '
              <td style="text-align:center; width:17%; min-width:100px;">';
    $output .= '
                ' . $objResult['name_branch'] .' 
              </td>
              <td style="text-align: center; width:17%; min-width:100px;">
                ' . $objResult['phone'] .' 
              </td>';

    if($objResult['type']==0){
      $type = 'ร้านใหญ่';
    }else{
      $type = 'ร้านย่อย';
    }

    $output .= '
              <td style="text-align: center; width:17%; min-width:100px;">
                ' . $type .' 
              </td> ';

if($button_edit==''){
    $output .= '

              <td style="text-align: center; width:17%; min-width:100px;">
                <div class="btn-group">';
    if($button_edit==''){
      $output .= '
                    <button style="background-color: white;" type="button" class="edit-branch btn btn-default" id="" data-id="' . $objResult['id_branch'] . '">
                        <i class="fa fa-edit"></i>
                    </button>';
    }

    if($button_del==''){
      $output .= '
                    <button style="background-color: white;" type="button" class="soft-del-branch btn btn-default" id="" data-id="' . $objResult['id_branch'] . '" data-id1="soft-del">
                        <i class="fa fa-trash"></i>
                    </button>';
    }

    // if($button_del_s==''){
    //   $output .= '
    //                 <button type="button" class="btn btn-default delete-branch" data-id="' . $objResult['id_branch'] . '"><i class="fa fa-remove"></i></button>';
    // }

    $output .= '
                </div>
              </td>';
}
    $output .= '
            </tr>
        ';

}
// $page_query = "SELECT * FROM mod_member";
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
                  <div class="row">
                    <div class="col-md-12" align="center">
                      <h3 style="color:gray; margin-bottom:-10px;">Oops! ไม่พบข้อมูลที่คุณค้นหา</h3>
                      <a href="front-add.php" class="view_add">
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
          </from>
          </div>
          <input type="hidden" name="hdnCount" value="' . $num . '">

        <div class="box-footer">';
if ($num_rows > 0) {
    $output .= '
          <div class="row">
            <div class="col-sm-5">
              <font size="3">รายชื่อที่ ' . $start . ' ถึง ' . $row_end . ' จากทั้งหมด ' . $num_rows . '</font>
            </div>
            <div class="col-sm-7">
              <div class="btn-group" style="float:right; background-color:white;">
                <button type="button" class="btn btn-paginate previous btn-button pagination_link" id=' . $prev_page . ' ' . $active_prev . '
                  data-n-fast="' . $strKeyword_name_fast . '"
                  data-n="' . $strKeyword_name . '"
                  data-c="' . $strKeyword_code . '"
                  data-ca="' . $strKeyword_phone . '"
                  data-s="' . $strKeyword_type . '"
                  data-sort="' . $strKeyword_sort . '">ก่อนหน้า</button>';

    for($a=1; $a<=$num_pages;$a++){
        if ($a == $page) {
            $class = "page-active";
        } else {
            $class = "";
        }
        $output .= '<button type="button" class="btn btn-paginate btn-button pagination_link ' . $class . '" id=' . $a . '
                              data-n-fast="' . $strKeyword_name_fast . '"
                              data-n="' . $strKeyword_name . '"
                              data-c="' . $strKeyword_code . '"
                              data-ca="' . $strKeyword_phone . '"
                              data-s="' . $strKeyword_type . '"
                              data-sort="' . $strKeyword_sort . '">' . $a . '</button>';
    }
    $output .= '<button type="button" class="btn btn-paginate next btn-button pagination_link" id=' . $next_page . ' ' . @$active_next . '
                  data-n-fast="' . $strKeyword_name_fast . '"
                  data-n="' . $strKeyword_name . '"
                  data-c="' . $strKeyword_code . '"
                  data-ca="' . $strKeyword_phone . '"
                  data-s="' . $strKeyword_type . '"
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
