<?php
require_once '../library/connect.php';

ini_set('display_errors', 1);
error_reporting(~0);

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
    $strSQL               = "SELECT * FROM mod_erp_branch WHERE name_branch LIKE '%" . $strKeyword_name_fast . "%' 
                                                          OR code_branch LIKE '%" . $strKeyword_name_fast . "%'
                                                          OR phone LIKE '%" . $strKeyword_name_fast . "%'";
}elseif (isset($_POST['name_branch'])) {
        if($_POST['type_branch']==''){
          $strKeyword_name = $_POST["name_branch"];
          $strKeyword_code = $_POST["code_branch"];
          $strKeyword_phone  = $_POST["phone_branch"];
          $strSQL          = "SELECT * FROM mod_erp_branch WHERE name_branch LIKE '%" . $strKeyword_name . "%'
                                     AND code_branch                         LIKE '%" . $strKeyword_code . "%'
                                     AND phone                               LIKE '%" . $strKeyword_phone . "%'";
        }else{
          $strKeyword_name = $_POST["name_branch"];
          $strKeyword_code = $_POST["code_branch"];
          $strKeyword_phone  = $_POST["phone_branch"];
          $strKeyword_type = $_POST["type_branch"];
          $strSQL          = "SELECT * FROM mod_erp_branch WHERE name_branch LIKE '%" . $strKeyword_name . "%'
                                       AND code_branch                         LIKE '%" . $strKeyword_code . "%'
                                       AND phone                               LIKE '%" . $strKeyword_phone . "%'
                                       AND type                                =     '" . $strKeyword_type . "'";
        }
    
} else {
    $strSQL = "SELECT * FROM mod_erp_branch";
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


$i= $row_start;;
      $num=0;
$objQuery = mysqli_query($objConnect,$strSQL) or die (mysqli_error());
$row_objresult = mysqli_num_rows($objQuery);
while($objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC))
      {
        $str_image = 'SELECT * FROM mod_erp_branch_image WHERE id_branch = "'.$objResult['id_branch'].'"';
        $query_image = mysqli_query($objConnect,$str_image);
        $num_image = mysqli_num_rows($query_image);
        $result_image = mysqli_fetch_array($query_image);
        if($num_image>0){
          $image = '../../uploads/branch/'.$result_image['name_image'];
        }else{
          $image = 'img/upload.jpg';
        }

        $num++;
        $i++;
$output .='<div class="box-manage-product">
            <div class="image-product-attachment cr-image" data-id="'.$objResult['id_branch'].'">
              <img src="'.$image.'">
              <div class="discard overlay-image'.$objResult['id_branch'].'" >
                 <i class="fa fa-times-circle icon-del" id="icon-del'.$objResult['id_branch'].'"></i>
              </div>
            </div>
            <div class="text-detail" align="center">
           <h4><div id="test" style="width:100%;height:20px;display:block;overflow:hidden;white-space:nowrap;text-overflow: ellipsis; text-align:center;">
                  '. $objResult['name_branch'].'</div></h4>
            </div>
            <p>'. $objResult['code_branch'].'</p>
            <p>'. $objResult['phone'].'</p>
            <p>'.$objResult['province'].' '.$objResult['amphoe'].'</p>
              ';
if($objResult['type']=='0'){
  $output .= '<p>สาขาใหญ่</p>';
}else{
  $output .= '<p>สาขาย่อย</p>';
}
           
$output.='  
            <div class="contain-control">
              <button type="button" class="btn btn-default delete-branch" data-id="'.$objResult['id_branch'].'"><i class="glyphicon glyphicon-trash"></i></button>

              <button type="button" class="edit-branch btn btn-default btn-edit" id="" data-id="'. $objResult['id_branch'].'"><i class="fa fa-edit"></i></button> 
              <input type="checkbox" class="crck_w'.$objResult['id_branch'].'" name="Chk[]" value="'.$objResult['id_branch'].'" id="crck'.$num.'" style="display:none;">
            </div>
          </div>';
 }
        // $page_query = "SELECT * FROM product LIMIT $start_from , $record_per_page";       
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
        if($num_rows > 0){
          $output .='
                    <div class="row">
                      <div class="col-sm-5">
                        <font size="3">บทความที่ '.$start.' ถึง '.$row_end.' จากทั้งหมด '.$num_rows.'</font>
                      </div>
                      <div class="col-sm-7">
                        <div class="btn-group" style="float:right; background-color:white;">
                          <button type="button" class="btn btn-paginate previous btn-button pagination_link_w" id='.$prev_page.' '.$active_prev.' 
                          data-n-fast="' . $strKeyword_name_fast . '"
                          data-n="' . $strKeyword_name . '"
                          data-c="' . $strKeyword_code . '"
                          data-ca="' . $strKeyword_phone . '"
                          data-s="' . $strKeyword_type . '"
                          data-sort="' . $strKeyword_sort . '">ก่อนหน้า</button>';
        for($a=1; $a<=$num_pages;$a++)
                {
                  if($a == $page ){
                    $class = "page-active";
                  }
                  else{
                    $class ="";
                  }
        $output .= '       <button type="button" class="btn btn-paginate btn-button pagination_link_w '.$class.'" id='.$a.' 
                              data-n-fast="' . $strKeyword_name_fast . '"
                              data-n="' . $strKeyword_name . '"
                              data-c="' . $strKeyword_code . '"
                              data-ca="' . $strKeyword_phone . '"
                              data-s="' . $strKeyword_type . '"
                              data-sort="' . $strKeyword_sort . '">' . $a . '</button>';
        }
  $output .='              <button type="button" class="btn btn-paginate next btn-button pagination_link_w" id='.$next_page.' '.@$active_next.' 
                              data-n-fast="' . $strKeyword_name_fast . '"
                              data-n="' . $strKeyword_name . '"
                              data-c="' . $strKeyword_code . '"
                              data-ca="' . $strKeyword_phone . '"
                              data-s="' . $strKeyword_type . '"
                              data-sort="' . $strKeyword_sort . '">ถัดไป</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              '; 
        }else{
          $output .='ไม่มีข้อมูล';
        }   
echo $output;

?>