<?php
session_start();

require_once '../library/connect.php';

 
$button_edit  = $_POST["button_edit"];
$button_del  = $_POST["button_del"];
$button_open   = $_POST["button_open"];
$input_read   = $_POST["input_read"];

$output        = '';
$output .= ' 
            <table class="table" id="table_status">
              <thead>';

    $output .= '
                    <tr>
                      <!--<th style="text-align: center; min-width:50px; width:50px;"><input class="ClickCheckAll" type="checkbox" name="CheckAll" id="CheckAll" value="Y" onClick="ClickCheckAll(this);"></th>-->
                      <th style="text-align:center;">ลำดับ</th>
                      <th style="text-align:center;">ชื่อไทย TH</th>
                      <th style="text-align:center;">ชื่ออังกฤษ EN</th>
                      <th style="text-align:center;">ควบคุม</th>
                    </tr>';

$output .= '
                  </thead>
                  <tbody>
        ';




$num=0;
$strSQL = "";
 $strSQL .= "SELECT * FROM `slide_catagory` ";
 if (isset($_POST["name"]) && $_POST["name"] != '' ) {
    $strSQL .= " WHERE  `name` LIKE '%".$_POST["name"]."%' OR `name_en` LIKE '%".$_POST["name"]."%'";
 }
 //echo $strSQL;
$objQuery = mysqli_query($objConnect, $strSQL);
$row_objresult = mysqli_num_rows($objQuery);
// if ($row_objresult > 0) {
while ($objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC)) {
$num++;
    

    // $output .= '<tr >
    //           <td style="text-align: center;" >
    //           <input type="checkbox" class="checkbox_remove" name="Chk[]" id="Chk' . $num . '" value="' . $objResult['id_slide_catagory'] . '">
                  
    //           </td> ';

  $output .= '            <td style="text-align:center;">
                <div id="test" >
                  ' . $num .'
                </div>';
          
    $output .= '</td>';
 
    $output .= '
              <td style="text-align:center;   background-color: #fafafa;">
               ' . $objResult['name'] .'
              </td>
              <td style="text-align:center;   background-color: #fafafa;">
               ' . $objResult['name_en'] .'
              </td>';

    $output .= '<td style="text-align: center;  width: 150px; min-width:150px">
                <div class="btn-group">';

               

    if($button_edit==''){
      $output .= '
       <a  style=" '.$button_edit.'" class=" btn btn-warning"  href="front-edit.php?id='.$objResult['id_slide_catagory'].'&select=do"  data-toggle="modal" data-target="#modal_edit"  >
 <i class="fa fa-edit"></i>
           
            </a>
       ';
    }

    // if($button_del==''){
     
    //       $output .= '<button type="button" class="btn btn-danger disabled-em" data-id="' . $objResult['id_slide_catagory'] . '" style="'.$button_edit.'"><i class="fa fa-trash"></i></button>';
      
    // }

   
    $output .= '
                   
                </div>
              </td>

            </tr>
        ';

}
 // }

// if ($row_objresult == 0) {
//     $output .= '<tr>
//                 <td colspan="9" bgcolor="white">
//                   <div class="row">
//                     <div class="col-md-12" align="center">
//                       <h3 style="color:gray; margin-bottom:-10px;">Oops! ไม่พบข้อมูลที่คุณค้นหา</h3>
//                       <a href="front-add.php" class="view_add">
//                         <font style="font-size:122px; color:#ddd; padding-left:25px;"><i class="fa fa-user-plus"></i></font>
//                         <h5 style="color:gray; margin-top:-30px;">เพิ่มพนักงานใหม่</h3>
//                       </a>
//                     </div>
//                   </div>
//                 </td>
//               </tr>';
// }
$output .= '</tbody>
          </table>
          <input type="hidden" name="hdnCount" value="' . $num . '">
          </div>';
       

       
echo $output
?>


