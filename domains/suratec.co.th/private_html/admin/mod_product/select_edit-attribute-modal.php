<?php 
require_once '../library/connect.php';
$id = $_POST['id'];

$str =  'SELECT * FROM product_attribute_head WHERE id_attr_head = "'.$id.'"';
$query = mysqli_query($objConnect,$str);
$result = mysqli_fetch_array($query);
$output = '';
$output .= '
      <input type="hidden" value="'.$id. '" name="id_attr">
      <div class="modal-body">
        <h4 style="color: gray;"><i class="fa fa-pencil"></i> ชื่อคุณลักษณะ</h4>
        <div class="row alert-massage" style="padding-left: 22.5px; display:none;" id="alert-inclease-edit">
          <div class="col-xs-12">
            <div class="callout callout-warning" style="opacity: 0.8">
              <p><i class="icon fa fa-warning"></i> กรุณากรอกชื่อคุณลักษณะ</p>
            </div>
          </div>
        </div>
        <div class="row" style="padding-left: 22.5px;">
          <div class="col-lg-6">
            <div class="input-group">
              <span class="input-group-addon" style="background-color: #ddd;">
                <img class="flag-lang" src="../img/th-fl.png" width="22" height="15">
              </span>
              <input type="text" class="form-control" placeholder="ภาษาไทยที่ใช้แสดง" name="name_head_th" id="" value="' .$result['name_attr_head_show']. '" id="check_th_head_edit">
              <!-- /btn-group -->
            </div>
          </div>
          <div class="col-lg-6">
            <div class="input-group">
              <span class="input-group-addon" style="background-color: #ddd;">
                <img class="flag-lang" src="../img/en-fl.jpg" width="22" height="15">
              </span>
              <input type="text" class="form-control" placeholder="ภาษาอังกฤษที่ใช้แสดง" name="name_head_en" id="" value="' .$result['name_attr_head_show_en'].'">
              <!-- /btn-group -->
            </div>
          </div>
        </div>
        <div class="row" style="padding-left: 22.5px; margin-top: 10px;">
          <div class="col-lg-6">
            
              <textarea class="form-control" placeholder="คำอธิบายคุณลักษณะ" name="name_head" id="">'.$result['name_attr_head'].'</textarea>
              <!-- /btn-group -->
          
          </div>
        </div>
      </div>';
$output .= '
      <div class="box-footer" style="padding: 15px;">
        <h4 style="color: gray;"><i class="fa fa-pencil"></i> ตัวเลือกคุณลักษณะ</h4>
        <div class="row inclease_attr_show_edit" style="padding-left: 22.5px;">';
$str_sub = 'SELECT * FROM product_attribute_sub WHERE id_attr_head = "'.$id.'"';
$query_sub = mysqli_query($objConnect,$str_sub);
$i = 0;
while($result_sub=mysqli_fetch_array($query_sub)){
  $output .= '
          <div class="form-group num_s_edit num_ss_edit'.$i.'">
            <div style="position: relative; color: gray; margin-left: -7px;">
              <span style="cursor:pointer;" class="del_attr_temp_edit" data-id="'.$i.'" data-idattr="'.$result_sub['id_attr_sub']. '"><i class="fa fa-remove"></i></span>
            </div>
            <div class="col-lg-6" style="margin-top:-15px;">
              <div class="input-group" style="margin-bottom:10px;">
                <span class="input-group-addon">
                  <img class="flag-lang" src="../img/th-fl.png" width="22" height="15">
                </span>
                <input type="text" class="form-control" placeholder="ภาษาไทย" name="name_attr_th[]" id="" value="' .$result_sub['name_attr_sub'].'">
                <input type="hidden" name="id_attr_sub[]" value="'.$result_sub['id_attr_sub']. '">
                <!-- /btn-group -->
              </div>
            </div>
            <div class="col-lg-6" style="margin-top:-15px;">
              <div class="input-group" style="margin-bottom:10px;">
                <span class="input-group-addon">
                  <img class="flag-lang" src="../img/en-fl.jpg" width="22" height="15">
                </span>
                <input type="text" class="form-control" placeholder="ภาษาอังกฤษ" name="name_attr_en[]" id="" value="' .$result_sub['name_attr_sub_en'].'">
                <!-- /btn-group -->
              </div>
            </div>
          </div>
        ';
$i++;
}
$output .= '
        </div>
        <input type="hidden" name="edit_delete" value="" id="edit_delete">  
        <span class="btn btn-success" id="inclease_attr_edit" style="margin-left: 22.5px; margin-top: 10px;"><i class="fa fa-plus"></i> เพิ่มตัวเลือก</span>

';

echo $output;

?>