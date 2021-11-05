<?php
session_start();
require_once '../library/connect.php';

      $button_del_s = 'display:none';
      $button_open = 'display:none';
      $button_del = 'display:none';
      $button_edit = 'display:none';
      $input_read = 'readonly';


$task_view = explode(",",$_SESSION['task_view']);
$task_authen = explode(",",$_SESSION['task_authen']);
if($_SESSION['permission']!='Super_admin'){
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
  $null_del = 'AND tbl_member.del_time IS NULL';
}else{
  $null_del = '';
}

$str_member = "SELECT * FROM tbl_member WHERE id_member = '".$_SESSION['user_id']."'";
$query_member = mysqli_query($objConnect,$str_member);
$result_member = mysqli_fetch_array($query_member);

ini_set('display_errors', 1);
error_reporting(~0);
//send fast
$strKeyword_name_fast = null;
//send detail
$strKeyword_name = null;
$strKeyword_code = null;
$strKeyword_sur  = null;
$strKeyword_code_id = null;
$strKeyword_birthday = null;
$strKeyword_posi = null;
$strKeyword_authen = null;
//sort
$strKeyword_sort = null;

$sql_type = "";
if (isset($_SESSION["role_id"]) && $_SESSION["role_id"] != '') {
  $sql_type = " mod_employee.role_id = '".$_SESSION["role_id"]."' AND ";
}

if (isset($_POST['name']) && $_POST['name'] != '') {
    $strKeyword_name_fast = $_POST["name"];
    $strSQL              = "SELECT mod_employee.*, tbl_member.*  
                            FROM mod_employee
                            LEFT JOIN tbl_member ON mod_employee.id_employee = tbl_member.id_data_role
                            WHERE $sql_type mod_employee.username   LIKE '%" .$strKeyword_name_fast. "%' 
                            OR mod_employee.surname       LIKE '%" .$strKeyword_name_fast. "%'
                            OR mod_employee.username_en   LIKE '%" .$strKeyword_name_fast. "%'
                            OR mod_employee.surname_en    LIKE '%" .$strKeyword_name_fast. "%'
                            OR mod_employee.position      LIKE '%" .$strKeyword_name_fast. "%'
                            OR mod_employee.position_en   LIKE '%" .$strKeyword_name_fast. "%'
                            OR mod_employee.code_id       LIKE '%" .$strKeyword_name_fast. "%'
                            OR mod_employee.email         LIKE '%" .$strKeyword_name_fast. "%'
                            OR mod_employee.tel           LIKE '%" .$strKeyword_name_fast. "%'
                            OR tbl_member.user_member     LIKE '%" .$strKeyword_name_fast. "%'
                            OR tbl_member.permission      LIKE '%" .$strKeyword_name_fast. "%'
                            $null_del
                            ";#ไปตรวจสอบที่ php แทน                                                   
}elseif (isset($_POST['name_em'])) {
        $strKeyword_name = $_POST["name_em"];
        $strKeyword_sur  = $_POST["sur_em"];
        $strKeyword_birthday = $_POST["birthday"];
        $strKeyword_posi     = $_POST["posi_em"];
        $strKeyword_code_id = $_POST['code_id_em'];
        $strSQL          = "SELECT mod_employee.*, tbl_member.*  
                            FROM mod_employee
                            LEFT JOIN tbl_member ON mod_employee.id_employee = tbl_member.id_data_role
                            WHERE $sql_type mod_employee.username   LIKE '%" .$strKeyword_name. "%'
                            AND mod_employee.surname       LIKE '%" .$strKeyword_sur. "%'
                            AND mod_employee.code_id      LIKE '%" .$strKeyword_code_id. "%'
                            AND mod_employee.birthday     LIKE '%" .$strKeyword_birthday. "%'
                            AND mod_employee.position     LIKE '%" .$strKeyword_posi. "%'
                            $null_del
                            ";
    
} else {
    $strSQL = "SELECT mod_employee.*, tbl_member.* FROM mod_employee,tbl_member WHERE $sql_type mod_employee.id_employee = tbl_member.id_data_role $null_del";
}

  // if(isset($_GET["cat"]))
  // {
  //   $strKeyword = $_GET["cat"];
  // }

$objQuery = mysqli_query($objConnect,$strSQL);

$num_rows = mysqli_num_rows($objQuery);

$per_page = 50;
$page  = 1;



if(isset($_POST["page"]))
{
  $page = $_POST["page"];
}

  $prev_page = $page-1;
  $next_page = $page+1;

  $row_start = (($per_page*$page)-$per_page);
  if($num_rows<=$per_page)
  {
    $num_pages =1;
  }
  else if(($num_rows % $per_page)==0)
  {
    $num_pages =($num_rows/$per_page) ;
  }
  else
  {
    $num_pages =($num_rows/$per_page)+1;
    $num_pages = (int)$num_pages;
  }
  $row_end = $per_page * $page;
  if($row_end > $num_rows)
  {
    $row_end = $num_rows;
  }
if (isset($_POST['sort']) && $_POST['sort'] != '') {
    $strKeyword_sort = $_POST['sort'];
    // set POST
    if ($_POST['sort'] == 'n') {
        $strSQL .= " ORDER BY username ASC LIMIT $row_start, $per_page";
    } elseif ($_POST['sort'] == 'n1') {
        $strSQL .= " ORDER BY username DESC LIMIT $row_start, $per_page";
    } elseif ($_POST['sort'] == 's') {
        $strSQL .= " ORDER BY surname DESC LIMIT $row_start, $per_page";
    } elseif ($_POST['sort'] == 's1') {
        $strSQL .= " ORDER BY surname ASC LIMIT $row_start, $per_page";
    } elseif ($_POST['sort'] == 'u') {
        $strSQL .= " ORDER BY user_member ASC LIMIT $row_start, $per_page";
    } elseif ($_POST['sort'] == 'u1') {
        $strSQL .= " ORDER BY user_member DESC LIMIT $row_start, $per_page";
    } elseif ($_POST['sort'] == 'p') {
        $strSQL .= " ORDER BY position ASC LIMIT $row_start, $per_page";
    } elseif ($_POST['sort'] == 'p1') {
        $strSQL .= " ORDER BY position DESC LIMIT $row_start, $per_page";
    } 
} else {
    $strSQL .= " ORDER BY id_employee LIMIT $row_start, $per_page";
}
$output = '';
$output .= '<div style="overflow-x:auto;" align="center">
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


$i= $row_start;;
      $num=0;
$objQuery = mysqli_query($objConnect,$strSQL) or die (mysqli_error());
$row_objresult = mysqli_num_rows($objQuery);
while($objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC))
      {
        $str    = "SELECT * FROM mod_employee_image WHERE id_employee = '".$objResult['id_employee']."'";
        $query  = mysqli_query($objConnect, $str);
        $row    = mysqli_num_rows($query);
        $result = mysqli_fetch_array($query);

        if ($row > 0) {
          $image = "../../uploads/employee/" . $result['name_image'];
        } else {
            $image = "img/no_image.png";
        }

        $num++;
        $i++;

  $output .='<div class="box-manage-employee">
            <div class="image-employee-attachment cr-image" data-id="'.$objResult['id_employee'].'">
              <img src="'.$image.'">
              <div class="discard overlay-image'.$objResult['id_employee'].'" >
                 <i class="fa fa-check icon-del" id="icon-del'.$objResult['id_employee'].'"></i>
              </div>
            </div>
            <div class="text-detail" align="center">
            <h4><div id="test" style="width:100%;height:20px;display:block;overflow:hidden;white-space:nowrap;text-overflow: ellipsis; text-align:center;">
                  '. $objResult['username'].' '.$objResult['surname'].'</div></h4>
            </div>
            <p>'. $objResult['position'].'</p>
            <p>'. $objResult['tel'].'</p>
            <div class="contain-control">';

    if($button_del_s==''){
      $output .= '<button type="button" class="btn btn-default delete-em" data-id="'.$objResult['id_employee'].'" style="'.$button_del.'"><i class="glyphicon glyphicon-trash"></i></button>';
    }
    
    if($button_edit==''){          
      $str_role    = "SELECT * FROM tbl_member WHERE id_data_role = '".$objResult['id_employee']."' AND data_role = 'mod_employee'";
      $query_role  = mysqli_query($objConnect, $str_role);
      $result_role = mysqli_fetch_array($query_role);
      if($result_role['del_time']==null){
          $output .= '<button type="button" class="btn btn-default disabled-em" data-id="' . $objResult['id_employee'] . '" style="'.$button_edit.'"><i class="fa fa-trash"></i></button>';
      }else{
          $output .= '<button type="button" class="btn btn-default enabled-em" data-id="' . $objResult['id_employee'] . '" style="'.$button_edit.'"><i class="fa fa-eye-slash text-yellow"></i></button>';
      }
    }

    if($button_del==''){
    $output .= '

              <button type="button" class="pull-left edit-employee btn btn-default edit-em" id="" data-id="'. $objResult['id_employee'].'" style="'.$button_edit.'"><i class="fa fa-edit"></i></button> 
              <input type="checkbox" class="crck_w'.$objResult['id_employee'].'" name="Chk[]" value="'.$objResult['id_employee'].'" id="crck'.$num.'" style="display:none;">';
    }
    $output .= '
            </div>
            
          </div>';
 }
        // $page_query = "SELECT * FROM employee LIMIT $start_from , $record_per_page";       
        // $page_result = mysqli_query($objConnect,$page_query);
        // $total_records = mysqli_num_rows($page_result);
        // $total_pages = ceil($total_records/$record_per_page);

       $start = $row_start+1;

        if(@$prev_page == 0){
          $active_prev = "Disabled";
        }else{
          $active_prev = '';
        }
        if(@$row_end == $num_rows){
          $active_next = "Disabled";
        }else{
          $active_next = '';
        }
$output .=' </div>
                <input type="hidden" name="hdnCount_w" value="'.$num.'">
                <div style="margin-bottom:20px;">';
if($row_objresult==0){
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
$output.= '       <div class="box-footer" style="">';
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
                  data-surname="'.$strKeyword_sur.'"
                  data-posi = "'.$strKeyword_posi.'"
                  data-s="' . $strKeyword_code_id . '"
                  data-d="' . $strKeyword_birthday . '"
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
                              data-surname="'.$strKeyword_sur.'"
                              data-posi = "'.$strKeyword_posi.'"
                              data-s="' . $strKeyword_code_id . '"
                              data-d="' . $strKeyword_birthday . '"
                              data-sort="' . $strKeyword_sort . '">' . $a . '</button>';
    }
    $output .= '<button type="button" class="btn btn-paginate next btn-button pagination_link" id=' . $next_page . ' ' . @$active_next . '
                  data-n-fast="' . $strKeyword_name_fast . '"
                  data-n="' . $strKeyword_name . '"
                  data-c="' . $strKeyword_code . '"
                  data-surname="'.$strKeyword_sur.'"
                  data-posi = "'.$strKeyword_posi.'"
                  data-codeid="' . $strKeyword_code_id . '"
                  data-d="' . $strKeyword_birthday . '"
                  data-authen="' . $strKeyword_authen . '"
                  data-sort="' . $strKeyword_sort . '">ถัดไป</button>
              </div>
            </div>
          </div>
        </div><br><br><br>';
} else {
    $output .= 'ไม่มีข้อมูล';
}
echo $output
?>