<script src="components/up_pre/js.js"></script>
<!-- <script src="js/select/dist/js/bootstrap-select.js"></script> -->
<?php
require_once '../library/connect.php';
$id = $_POST['id'];

$strSQL = "SELECT * FROM product_catagory WHERE id_catagory = ".$id;
$Query = mysqli_query($objConnect,$strSQL) or die (mysqli_error());
$Result = mysqli_fetch_array($Query);
$name = $Result['name_catagory'];
$name_en = $Result['name_catagory_en'];
$id_menu = $Result['id_catagory'];
$level = $Result['level'];
$group_sub = $Result['group_sub'];

$check_menu1 = "checked";
$check_menu2 = "";
$display = "display: none;";

@$cutlink = explode("-",$Result['id_link']);
@$id_link = @$cutlink[0];
@$id_link_sub = @$cutlink[1];
@$output = '';
@$output .= '
            <input type="hidden" name="id_modal" id="id" value="'.$id.'">
            <input type="hidden" name="level_modal" id="id" value="'.$level. '">
              <div>
                <div class="nav-tabs-custom" style="box-shadow:none; margin-bottom:0px;">
                  
                  <div class="tab-content" style="padding: 5px 15px 5px 15px; margin-top: 5px;">
                    <div class="tab-pane active" id="thai_modal">
                      <label>ชื่อหมวดหมู่</label>
                      <input type="text" class="form-control" placeholder="ภาษาไทย" name="name" id="name_modal" required="required" value="' .$name.'" onkeyup="checklengthEdit()">
                    </div>
                    <div class="tab-pane" id="english_modal">
                      <input type="text" class="form-control" placeholder="ภาษาอังกฤษ" name="name_en" id="txtEN"  required="required" value="'.$name_en.'" onkeyup="checklengthEdit()">
                    </div>
                  </div>
                </div>
              </div>
              <p id="validation_modal_name" style="padding: 5px; padding-top:2px; color:orange; display: none;">กรุณาใส่ชื่อหัวข้อเมนู</p>
              <div style="padding: 5px; text-align: center;">   
                <div class="row">
                  <div class="col-md-6">
                  </div>
                  <div class="col-md-6">
                  </div>
                </div>
              </div>
              ';
              if($level == '1'){
                $dsbl = 'disabled';
                $sltd = 'selected';
              }else{
                $dsbl = '';
                $sltd = '';
              }
$output .= '                  
            <div style="padding: 5px 15px 5px 15px; margin-top: 5px;">    
              <label>จัดไว้ใต้หมวดหมู่</label>
            </div>
            <div style="padding: 0 15px 5px 15px;"> 
            <select id="lunch" name="cat_" class="selectpicker form-control show-tick" data-live-search="true">
            <!-- <select class="form-control" name="cat_" style="border:1px solid #f4f4f4;"> -->
              <option value="0-0-'.$Result['id_catagory'].'" '.$dsbl.' '.$sltd.'>จัดเป็นหมวดหมู่หลัก</option>';

              $Choice1 = "SELECT * FROM product_catagory WHERE level = '1'";
              $queryChoice1 = mysqli_query($objConnect,$Choice1);          
              while ($resultChoice1 = mysqli_fetch_array($queryChoice1)) {
                if($level == '1'){
                  if($resultChoice1['id_catagory'] == $Result['id_catagory']){
                    $disabled = "disabled";
                    $select = '';
                  }else{
                    $select = '';
                    $disabled = "";
                  }
                }elseif($level =='2'){
                  if($resultChoice1['id_catagory'] == $Result['group_sub']){
                    $select = 'selected';
                    $disabled = "disabled";
                  }else{
                    $select = '';
                    $disabled = "";
                  }
                }else{
                  $select = '';
                  $disabled = '';
                }
              $output .= '<option value="1-'.$resultChoice1['id_catagory'].'-'.$Result['id_catagory'].'" '.$select.' '.$disabled.' data-id="'.$resultChoice1['level'].'">'.$resultChoice1['name_catagory'].'</option>';

                  $Choice2 = "SELECT * FROM product_catagory WHERE level = '2' AND group_sub = '".$resultChoice1['id_catagory']."'";
                  $queryChoice2 = mysqli_query($objConnect,$Choice2);          
                  while ($resultChoice2 = mysqli_fetch_array($queryChoice2)) {
                  if($level == '1'){
                    if($resultChoice2['group_sub'] == $Result['id_catagory']){
                      $disabled = "disabled";
                      $select = '';
                    }else{
                      $select = '';
                      $disabled = "";
                    }
                  }elseif($level =='2'){
                    if($resultChoice2['id_catagory'] == $Result['id_catagory']){
                      $select = '';
                      $disabled = "disabled";
                    }else{
                      $select = '';
                      $disabled = "";
                    }
                  }elseif($level == '3'){
                    if($resultChoice2['id_catagory'] == $Result['group_sub']){
                      $select = 'selected';
                      $disabled = "disabled";
                    }else{
                      $select = '';
                      $disabled = "";
                    }   
                  }else{
                    $disabled = '';
                    $select = '';
                  }
                  $output .= '<option value="2-'.$resultChoice2['id_catagory'].'-'.$Result['id_catagory'].'" '.$select.' '.$disabled.' data-id="'.$resultChoice2['level'].'">- '.$resultChoice2['name_catagory'].'</option>';

                      $Choice3 = "SELECT * FROM product_catagory WHERE level = '3' AND group_sub = '".$resultChoice2['id_catagory']."'";
                      $queryChoice3 = mysqli_query($objConnect,$Choice3);          
                      while ($resultChoice3 = mysqli_fetch_array($queryChoice3)) {
                      $output .= '<option disabled>&nbsp;&nbsp;- '.$resultChoice3['name_catagory'].'</option>';
                      }
                  }

              }

$output .= ' </select>
</div>
                  <div class="row" style="padding: 5px 15px 5px 15px; margin-top: 5px;">
                    <div class="col-md-12">
                      <label>รูปภาพหมวดหมู่</label>
                      <div style="width: 250px; padding-bottom: 10px;">';
if($Result['img']==''){
$output .= '
                        <img style="width: 250px" id="blah" src="components/up_pre/upload.jpg" />';
}else{
$output .= '            <img style="width: 250px" id="blah" src="../../uploads/category/'.$Result['img'].'" />';
}

$output .= '
                      </div>
                      <div class="input-group">
                        <input type="text" class="form-control" readonly>
                          <span class="input-group-btn">
                              <span class="btn btn-default btn-file" style="background-color: white !important;">
                                  <i class="glyphicon glyphicon-folder-open"></i><input type="file" accept="image/*" id="file_edit" class="file_edit" onchange="readURL(this);" name="image_catagory">
                              </span>
                          </span>
                      </div>
                      <br>
                                                <p>*รูปภาพควรมีขนาดประมาณ 150 X 150 Pixels (กว้าง X สูง)</p>
                    </div>

                    <!-- <div class="col-md-4" style="">
                      <label>เลือกไอคอน</label>
                      <div style="width: 100%; padding: 27px; border:1px solid #ddd" align="center" >';
if($Result['icon']==''){
$output .= '            <a style="font-size: 70px; color: #ddd; cursor: pointer;" id="change-icon-edit" class="ch-icon-edit"><i class="fa fa-plus"></i></a>';
}else{
$output .= '            <a style="font-size: 70px; color: #ddd; cursor: pointer;" id="change-icon-edit" class="ch-icon-edit">'.$Result['icon'].'</a>';
}
$output .= '
                        <input type="hidden" name="icon" value="'.htmlspecialchars($Result['icon']).'" id="change-icon-value-edit" class="form-control">
                      </div> -->
                      <!-- <div class="input-group" style="margin-top:10px;">
                          <span class="input-group-btn">
                              <span class="btn btn-default ch-icon-edit" style="background-color: white !important; width: 100%">
                                  Choose Icon
                              </span>
                          </span>
                      </div> -->
                    </div>
                  </div>
                  <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    ยกเลิก
                </button>
                <button type="button" name="btnSendEdit" id="btnSendEdit" class="btn btn-info btnSendEdit">
                    <i class="fa fa-check"></i>&nbsp;บันทึก
                </button>
            </div>';
echo $output;
?>

<script type="text/javascript">
 $(document).ready(function(){
      $('#lunch').selectpicker({
        liveSearch: true,
        maxOptions: 1
      });
    });
</script>