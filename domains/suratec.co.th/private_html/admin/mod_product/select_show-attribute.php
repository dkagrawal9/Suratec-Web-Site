<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" crossorigin="anonymous"></script> -->
<?php

$button_edit  = $_POST["button_edit"];
$button_del  = $_POST["button_del"];
$button_open   = $_POST["button_open"];
$input_read   = $_POST["input_read"];

$output ='';
$output .= '
<table width="100%" class="header-attribute" style="border:1px solid #ddd;">
                      <thead>
                        <tr style="font-weight: bold;">
                          <th style="min-width:20px; width:30px;">
                            <input class="ClickCheckAll" type="checkbox" name="CheckAll" id="CheckAll" value="Y" onClick="ClickCheckAll(this);">
                          </th>
                          <th style="min-width: 200px; width: 200px;">
                            ชื่อคุณลักษณะที่ใช้แสดง
                          </th>
                          <th style="min-width: 200px; width: 250px;">
                            ชื่อคุณลักษณะ/อธิบายคุณลักษณะ
                          </th>
                          <th>
                            Option
                          </th>
                          <th>
                            ควบคุม
                          </th>
                        </tr>
                      </thead>
                      <tbody class="show-attribute">';
require_once '../library/connect.php';
$str = "SELECT * FROM product_attribute_head";
$query = mysqli_query($objConnect,$str);
$num_head = 0;
$i = 0;
$a= 0;
$numhead=0;
while($result=mysqli_fetch_array($query)){
  $a++;
  $numhead++;
  $text_sub = '';
  $id_sub = '';
  $str_sub = "SELECT * FROM product_attribute_sub WHERE id_attr_head = '".$result['id_attr_head']."'";
  $query_sub = mysqli_query($objConnect,$str_sub);
  $num_sub = mysqli_num_rows($query_sub);
  $i=0;
  
$output .= '                  
                        <tr class="show-tr">
                          <td align="center">
                            <input type="checkbox" name="Chk[]" id="Chk'.$a.'" value="'.$result['id_attr_head'].'"
                                                                               data-id=""                                                                              
                                                                               class="checkbox_remove variants_change variants_num_check'.$num_head.'">
                          </td>
                          <td style="padding-left: 15px;">
                          
                          <input type="text" name="attr_head_show[]" value="'.$result['name_attr_head_show'].'" class="form-control attr_head_show'.$numhead.'" style="border:none; background:transparent;" readonly>
                          </td>
                          <td style="padding-left: 15px;">
                          <input type="text" name="attr_head[]" value="'.$result['name_attr_head'].'" class="form-control attr_head'.$numhead.'" style="border:none; background:transparent;" readonly>
                          </td>
                          <td>';
  while($result_sub=mysqli_fetch_array($query_sub)){
  $i++;
  $output .= '<span class="tag label label-info" style="margin-right:5px;">'
    .$result_sub['name_attr_sub']. 
  '</span>';
 
  }
  $output .='                          
                          </td> 
                          <td style="width:120px; min-width:120px;">
                            <div style="width: 100%" align="center">
                              <div class="btn-group">
                              <!--<span class="btn btn-info btn-sm" data-check="single" data-id="'.$numhead.'"><i class="fa fa-check"></i> บันทึก</span>-->
                              <span style=" '.$button_edit.'" class="btn btn-default btn-sm edit-row" data-check="single" data-id="'.$result['id_attr_head'].'"><i class="fa fa-edit"></i> แก้ไข</span>
                              <span class="btn btn-default btn-sm del-row" data-id="'.$result['id_attr_head'].'" style="background-color: white; '.$button_del.'"><i class="fa fa-remove"></i></span>
                              </div>
                            </div>
                          </td>';                     

}
$output .= '
                    </tbody>
                   <!-- <tbody class="inclease-attribute">
                      <tr>
                            <td>
                            </td>
                            <td align="center">
                             <input type="text" value="" id="attribute_head_show"  class="form-control" style="border:none;" placeholder="ชื่อคุณลักษณะที่ใช้แสดง">
                            </td>
                            <td>
                              <input type="text" value="" id="attribute_head"  class="form-control" style="border:none;" placeholder="อธิบายคุณลักษณะ">
                            </td>
                            <td>
                              <input type="text" value="" id="attribute_text" data-role="tagsinput" data-smtp="" class="form-control" style="border:none;" placeholder="คุณลักษณะ">
                            </td>
                            <td align="center" style="padding-left: 15px; padding-right: 15px;">
                              <span class="btn btn-success btn-sm add-row btn-block">เพิ่ม</span>
                            </td>
                          </tr>
                    </tbody>-->
                    </table>
                    <input type="hidden" name="hdnCount" value="'.$a.'">';        
echo $output;
?>

