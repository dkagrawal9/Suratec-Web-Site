<?php
session_start();

      $button_del_s = 'display:none';
      $button_open = '';
      $button_del = '';
      $button_edit = '';
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

require_once '../library/connect.php';

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
                            WHERE $sql_type
                             mod_employee.username   LIKE '%" .$strKeyword_name_fast. "%' 
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
$objQuery      = mysqli_query($objConnect, $strSQL) or die(mysqli_error());

$row_objresult = mysqli_num_rows($objQuery);


$button_edit  = $_POST["button_edit"];
$button_del  = $_POST["button_del"];
$button_open   = $_POST["button_open"];
$input_read   = $_POST["input_read"];

$output        = '';
$output .= ' <div style="overflow-x:auto;">
            <table class="">
              <thead>';
if ($row_objresult != 0) {
    $output .= '
                    <tr>
                      <th style="text-align: center; min-width:50px; width:50px;"><input class="ClickCheckAll" type="checkbox" name="CheckAll" id="CheckAll" value="Y" onClick="ClickCheckAll(this);"></th>
                      <th colspan="2">รูปภาพ</th>
                      <th style="text-align:center;">ลำดับ</th>
                      <th style="text-align:center;">ชื่อ-นามสกุล</th>
                      <th style="text-align:center;">ประเภท</th>
                      <th style="text-align:center;">ชื่อผู้ใช้งาน</th>
                      <th style="text-align:center;">ตำแหน่ง</th>
                      
                      
                      <th style="text-align:center;">ควบคุม</th>
                    </tr>';
}
$output .= '
                  </thead>
                  <tbody>
        ';





$i   = $row_start;
$num = 0;
while ($objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC)) {

    $str    = "SELECT * FROM mod_employee_image WHERE id_employee = '".$objResult['id_employee']."'";
    $query  = mysqli_query($objConnect, $str);
    $row    = mysqli_num_rows($query);
    $result = mysqli_fetch_array($query);

    if ($row > 0) {
        $image = "../../uploads/employee/" . $result['name_image'];
    } else {
        $image = "img/no_image.png";
    }

    if($objResult['id_employee']==$result_member['id_data_role']){
      $border_td = 'border-top:1px orange solid;';
      $border_tr = 'border-bottom:1px solid orange;';
    }else{
      $border_td ='';
      $border_tr = '';
    }




    $num++;
    $i++;
    $output .= '<tr style="'.$border_tr.'">
              <td style="text-align: center; '.$border_td.'" >
                  <input type="checkbox" class="checkbox_remove" name="Chk[]" id="Chk' . $num . '" value="' . $objResult['id_employee'] . '">
              </td>

               <td width="3%" style="'.$border_td.'">
                ' . $i . '
              </td> ';

  $output .= ' <td style="width:10px; '.$border_td.'">
                <div class="image-employee-list">
                  <img src="' . $image . '">
                </div>
              </td>';
              
    
  $output .= ' <td style="width:20px; '.$border_td.' ">
            <div class="image-employee-list">
                <input  class="form-control w-auto"  type="number" id="order_no'.$i.'" name="order_no'.$i.'"  value="'.$objResult['order_no'].'"  onfocusout="order_number('.$i.',\''.$objResult['id_employee'].'\');"   >   
                </div>
              </td>';          

  
  //             $str_branch    = "SELECT * FROM mod_employee  
  //                             LEFT JOIN mod_erp_branch on mod_erp_branch.id_branch = mod_employee.id_branch";
  //             $query_branch  = mysqli_query($objConnect, $str_branch);
  //             $result_branch = mysqli_fetch_array($query_branch);   
                  
  // $output .= '
  //             <td style="text-align: center; '.$border_td.' background-color: #00c0ef66;" >
  //             <label  >' . $result_branch['name_branch'] .'</label>
  //             </td>
  //             ';             

  // $output .= ' <td style="width:10px; '.$border_td.'">
  //               <div class="image-employee-list">
  //                 <img src="' . $image . '">
  //               </div>
  //             </td>';    

  $output .= '            <td style="text-align:center; '.$border_td.'">
                <div id="test" >
                  ' . $objResult['username'] .'  ' . $objResult['surname'] . '<br>
                </div>';
          
    $output .= '</td>';

     $str    = "SELECT role.role_name FROM `mod_employee`
LEFT JOIN role ON role.role_id=mod_employee.role_id WHERE mod_employee.id_employee = '".$objResult['id_employee']."'";
    $query  = mysqli_query($objConnect, $str);
    $row    = mysqli_num_rows($query);
    $result = mysqli_fetch_array($query);
 if( $result['role_name'] != null){
                $output .= '
                <td style="text-align: center; '.$border_td.' background-color: #fafafa;" >
                ' . $result['role_name'] . '
                </td>
                '; 
              }else{
                $output .= '
                <td style="text-align: center; '.$border_td.' background-color: #cecece;" >
                <label  > ไม่มีประเภท. </label  >
                </td>
                ';  
              }
    $output .= '
              <td style="text-align:center; '.$border_td.'  background-color: #fafafa;">';
    $str_role    = "SELECT * FROM tbl_member WHERE id_data_role = '".$objResult['id_employee']."' AND data_role = 'mod_employee'";
    $query_role  = mysqli_query($objConnect, $str_role);
    $result_role = mysqli_fetch_array($query_role);
    $output .= '
    <label  > ' . $result_role['user_member'] .' </label  >
              </td>
              <td style="text-align: center; '.$border_td.' ">
                ' . $objResult['position'] .' 
              </td>';

              
               
                    


              // if($objResult['approver']==1){

              //   $output .= '
              //   <td style="text-align: center; '.$border_td.' background-color: #00a65a;   border-radius: 2px;" >
              //   <label  style="color:#fafafa;" ><i class="fa fa-check-circle fa-2x"></i></label>
              //   </td>
              //   ';
              
              // }else{
              
              //   $output .= '
              //   <td style="text-align: center; '.$border_td.' background-color: #dd4b39;" >
              //   <label  ><i class="fa fa-times-circle  fa-2x"></i></label>
              //   </td>
              //   ';
              
              // }

               


    $output .= '<td style="text-align: center; '.$border_td.' width: 150px; min-width:150px">
                <div class="btn-group">';

    //$output .= '<button type="button" class="btn btn-info " data-id="' . $objResult['id_employee'] . '" style="'.$button_del.'">POS</button>';            

    if($button_edit==''){
      $output .= '
            <button style=" '.$button_edit.'" type="button" class="edit-em btn btn-warning" id="" data-id="' . $objResult['id_employee'] . '" >
                  <i class="fa fa-edit"></i>
            </button>';
    }

    if($button_del==''){
      if($result_role['del_time']==null){
          $output .= '<button type="button" class="btn btn-danger disabled-em" data-id="' . $objResult['id_employee'] . '" style="'.$button_edit.'"><i class="fa fa-trash"></i></button>';
      }else{
          $output .= '<button type="button" class="btn btn-default enabled-em" data-id="' . $objResult['id_employee'] . '" style="'.$button_edit.'"><i class="fa fa-eye-slash text-yellow"></i></button>';
      }
    }

    if($button_del_s==''){
         $output .= '<button type="button" class="btn btn-default delete-em" data-id="' . $objResult['id_employee'] . '" style="'.$button_del.'"><i class="fa fa-close"></i></button>';
    }
    $output .= '
                   
                </div>
              </td>

            </tr>
        ';

}
// $page_query = "SELECT * FROM mod_employee";
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
                        <font style="font-size:122px; color:#ddd; padding-left:25px;"><i class="fa fa-user-plus"></i></font>
                        <h5 style="color:gray; margin-top:-30px;">เพิ่มพนักงานใหม่</h3>
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
