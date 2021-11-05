<?php 
  require_once '../library/connect.php';
  require_once '../library/functions.php';
  checkAdminUser($objConnect);

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=TITLE?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
    <!-- Ionicons -->
    <link rel="shortcut icon" type="image/png" href="../img/favicon.png"/>
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!--Css table ใช้ของ เมนู -->
  <link rel="stylesheet" href="css/table-article.css">
  <!-- upload template css-->
  <link rel="stylesheet" type="text/css" href="css/up_pre.css">

  <!-- Include external CSS. -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">
  <!-- Include Editor style. -->
  <link href="../page_froala/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css">
  <link href="../page_froala/css/froala_style.min.css" rel="stylesheet" type="text/css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
 
</head>
<style>
.onoffswitch {
    position: relative; width: 90px; float: left;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
}
.onoffswitch-checkbox {
    display: none;
}
.onoffswitch-label {
    display: block; overflow: hidden; cursor: pointer;
    border: 2px solid #999999; border-radius: 20px;
}
.onoffswitch-inner {
    display: block; width: 200%; margin-left: -100%;
    transition: margin 0.3s ease-in 0s;
}
.onoffswitch-inner:before, .onoffswitch-inner:after {
    display: block; float: left; width: 50%; height: 30px; padding: 0; line-height: 30px;
    font-size: 14px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
    box-sizing: border-box;
}
.onoffswitch-inner:before {
    content: "ON";
    value: '1';
    padding-left: 10px;
    background-color: #52E252; color: #FFFFFF;
}
.onoffswitch-inner:after {
    content: "OFF";
    value: '0';
    padding-right: 10px;
    background-color: #CD1039; color: #999999;
    text-align: right;
}
.onoffswitch-switch {
    display: block; width: 18px; height: 20px; margin: 6px;
    background: #FFFFFF;
    position: absolute; top: 0; bottom: 0;
    right: 56px;
    border: 2px solid #999999; border-radius: 20px;
    transition: all 0.3s ease-in 0s; 
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
    margin-left: 0;
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
    right: 0px; 
}
</style>
<body class="hold-transition skin-blue sidebar-mini fixed" >
<div class="wrapper">

 
  <?php require_once '../template/nav_menu.php'; ?>
  <?php require_once '../library/permission.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        จัดการส่วนกลาง
      </h1>
      <ol class="breadcrumb">
        <li><a href="../page_home/index.php"></i> <?=lang('แดชบอร์ด','Dashboard')?></a></li>
        <!-- <li><a href="front-manage.php"></i> เพิ่มหน้าเสริม</a></li> -->
        <li class="active">จัดการส่วนกลาง</li>
      </ol>
    </section>
    <section class="content">
    <!-- Main content -->
      <!-- /.box -->
      <div class="alert alert-success alert-dismissible" id="result_add_cat" style="display: none;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <div id="loader_add_cat">
          <h4><i class="fa fa-circle-o-notch fa-spin"></i></h4>
          Inserting...
        </div>
        <div id="success_add_cat">
          <h4><i class="icon fa fa-check"></i> Increase!</h4>
          Increase Catagory successful.
        </div>
      </div>

      <div class="alert alert-success alert-dismissible" id="result_add" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <div id="loader_add">
              <h4><i class="fa fa-circle-o-notch fa-spin"></i></h4>
              Inserting...
            </div>
            <div id="success_add">
              <h4><i class="icon fa fa-check"></i> Increase!</h4>
              Increase data successful.
            </div>
          </div>

    <!--   <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-warning">&nbsp;&nbsp;</i><?=lang('เสร็จสิ้น','Success')?></h4>
              </div>
              <div class="modal-body">
                <center><h4><?=lang('เพิ่มเพิ่มหน้าแรกรียบร้อยแล้ว ','Added article successfully ')?></h4></center>
              </div>
               <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?=lang('เพิ่มเนื้อหาต่อ..','Add more content ..')?></button>
                <button type="button" class="btn btn-primary" id="btnYes"><?=lang('ยืนยัน','Confirm')?></button>
              </div> 
            </div>
           
          </div>
         
        </div> -->
        <!-- /.modal -->
<?php 
$arr_setting =['payment_term','minimum_payment','dislocation','amount_not_over','receipt_width','receipt_length','qr_level','qr_size','web_status','web_reason','web_head_th','address_th','editor','web_head_en','address_en','editor_en','address_lable_width','address_lable_length','max_time'];
for ($i=0; $i < count($arr_setting) ; $i++) { 
           $strSQL = "SELECT * FROM `contact` WHERE `setting` ='".$arr_setting[$i]."'";
           $objQuery = mysqli_query($objConnect,$strSQL) or die (mysqli_error());
           $objResult = mysqli_fetch_array($objQuery);
           $data_value[$i] = $objResult["value"];
           $data_id[$i] = $objResult["id"];
  
}
           // $strSQL0 = "SELECT * FROM `contact` WHERE `setting` ='Web_head'";
           // $objQuery0 = mysqli_query($objConnect,$strSQL0) or die (mysqli_error());
           // $objResult0 = mysqli_fetch_array($objQuery0);
           // $Web_head0 = $objResult["value"];

           // $strSQL1 = "SELECT * FROM `contact` WHERE `setting` ='Secondary_word'";
           // $objQuery1 = mysqli_query($objConnect,$strSQL1) or die (mysqli_error());
           // $objResult1 = mysqli_fetch_array($objQuery1);
           // $Secondary_word = $objResult1["value"];

           // $strSQL2 = "SELECT * FROM `contact` WHERE `setting` ='Description'";
           // $objQuery2 = mysqli_query($objConnect,$strSQL2) or die (mysqli_error());
           // $objResult2 = mysqli_fetch_array($objQuery2);
           // $Description = $objResult2["value"];
       
?>
       <div class="row">
                 <form  method="post" enctype="multipart/form-data" id="upload-form-add" class="upload-form-add">
                  
                  <input type="hidden" name="name_setting" value="payment_term,minimum_payment,dislocation,amount_not_over,receipt_width,receipt_length,qr_level,qr_size,web_status,web_reason,web_head_th,address_th,editor,web_head_en,address_en,editor_en,address_lable_width,address_lable_length,max_time">

                  <input type="hidden" name="id_setting" value="payment_term_id,minimum_payment_id,dislocation_id,amount_not_over_id,receipt_width_id,receipt_length_id,qr_level_id,qr_size_id,web_status_id,web_reason_id,web_head_id_th,address_id_th,editor_id_th,web_head_id_en,address_id_en,editor_id_en,address_lable_width_id,address_lable_length_id,max_time_id">

                <div class=" col-md-6 " >
                    <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="box box-success box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">รายละเอียด</h3>
                                </div>
                                <div class="box-body" >
                                    <div class="form-horizontal">
                  <fieldset style="border: solid 3px #FF5675 ;padding-left: 20px; padding-right: 20px; padding-bottom: 20px">  
                    <legend style="width: auto; ">เงื่อนไขการชำระเงิน</legend>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">ระยะเวลาชำระเงิน (วัน)</label>
                        <div class="col-sm-9"> 
                          <input type="hidden" class="form-control " id="payment_term_id" name="payment_term_id"   value="<?php echo $data_id[0] ?>">
                          <input type="number" class="form-control " id="payment_term" name="payment_term"   value="<?php echo $data_value[0] ?>" >
                        </div>
                    </div>

                  <div class="form-group">
                        <label for="" class="col-sm-3 control-label">การชำระเงินขั้นต่ำ (%)</label>
                        <div class="col-sm-9">
                          <input type="hidden" class="form-control " id="minimum_payment_id" name="minimum_payment_id"   value="<?php echo $data_id[1] ?>">
                          <input type="number" class="form-control " id="minimum_payment" name="minimum_payment"   value="<?php echo $data_value[1] ?>" >
                        </div>
                  </div>

                </fieldset>
<br>
                <fieldset style="border: solid 3px #41CDCD ;padding-left: 20px; padding-right: 20px; padding-bottom: 20px">  
                    <legend style="width: auto; ">เงื่อนไขการเก็บเงินปลายทาง</legend>

                  <div class="form-group">
                        <label for="" class="col-sm-3 control-label">ความคลาดเคลื่อน (%)</label>
                        <div class="col-sm-9">
                          <input type="hidden" class="form-control " id="dislocation_id" name="dislocation_id"   value="<?php echo $data_id[2] ?>">
                          <input type="number" class="form-control " id="dislocation" name="dislocation"   value="<?php echo $data_value[2] ?>" >
                        </div>
                    </div>

                </fieldset>
<br>
                <fieldset style="border: solid 3px #FFC314 ;padding-left: 20px; padding-right: 20px; padding-bottom: 20px">  
                    <legend style="width: auto; ">เงื่อนไขการชดเชยความเสียหาย</legend>

                  <div class="form-group">
                        <label for="" class="col-sm-3 control-label">จำนวนเงินไม่เกิน</label>
                        <div class="col-sm-9">
                          <input type="hidden" class="form-control " id="amount_not_over_id" name="amount_not_over_id"   value="<?php echo $data_id[3] ?>">
                          <input type="number" class="form-control " id="amount_not_over" name="amount_not_over"   value="<?php echo $data_value[3] ?>" >
                        </div>
                    </div>

                </fieldset>
<br>
                <fieldset style="border: solid 3px #8572EE ;padding-left: 20px; padding-right: 20px; padding-bottom: 20px">  
                    <legend style="width: auto; ">ขนาด</legend>

                  <div class="form-group">
                        <label for="" class="col-sm-2 control-label">ใบเสร็จ</label>
                        <label for="" class="col-sm-2 control-label">กว้าง (มม.)</label>
                        <div class="col-sm-3">
                          <input type="hidden" class="form-control " id="receipt_width_id" name="receipt_width_id"   value="<?php echo $data_id[4] ?>">
                          <input type="number" class="form-control " id="receipt_width" name="receipt_width"   value="<?php echo $data_value[4] ?>" >
                        </div>
                        <label for="" class="col-sm-2 control-label">ยาว (มม.)</label>
                        <div class="col-sm-3">
                          <input type="hidden" class="form-control " id="receipt_length_id" name="receipt_length_id"   value="<?php echo $data_id[5] ?>">
                          <input type="number" class="form-control " id="receipt_length" name="receipt_length"   value="<?php echo $data_value[5] ?>" >
                        </div>
                    </div>

                  <div class="form-group">
                        <label for="" class="col-sm-2 control-label">QR Code</label>
                        <label for="" class="col-sm-2 control-label">Level</label>
                        <div class="col-sm-3">
                          <input type="hidden" class="form-control " id="qr_level_id" name="qr_level_id"   value="<?php echo $data_id[6] ?>">
                          <select name="qr_level" id="qr_level" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                            <option <?php  if ('L'==$data_value[6]) {
                                echo "selected";
                              } ?> value="L">L</option>
                            <option <?php  if ('M'==$data_value[6]) {
                                echo "selected";
                              } ?> value="M">M</option>
                            <option <?php  if ('Q'==$data_value[6]) {
                                echo "selected";
                              } ?> value="Q">Q</option>
                            <option <?php  if ('H'==$data_value[6]) {
                                echo "selected";
                              } ?> value="H">H</option>
                          </select>
                        </div>
                        <label for="" class="col-sm-2 control-label">Size</label>
                        <div class="col-sm-3">
                          <input type="hidden" class="form-control " id="qr_size_id" name="qr_size_id"   value="<?php echo $data_id[7] ?>">
                          <select name="qr_size" id="qr_size" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                            <?php
                            for ($i=1; $i <=10 ; $i++) { ?>
                              <option 
                              <?php
                              if ($i==$data_value[7]) {
                                echo "selected";
                              }
                              ?>
                               value='<?php echo $i ?>'><?php echo $i ?></option>
                            <?php }
                            ?>
                            
                          </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">ขนาดพิมพ์ address lable</label>
                        <label for="" class="col-sm-2 control-label">กว้าง (มม.)</label>
                        <div class="col-sm-3">
                          <input type="hidden" class="form-control " id="address_lable_width_id" name="address_lable_width_id"   value="<?php echo $data_id[16] ?>">
                          <input type="number" class="form-control " id="address_lable_width" name="address_lable_width"   value="<?php echo $data_value[16] ?>" >
                        </div>
                        <label for="" class="col-sm-2 control-label">ยาว (มม.)</label>
                        <div class="col-sm-3">
                          <input type="hidden" class="form-control " id="address_lable_length_id" name="address_lable_length_id"   value="<?php echo $data_id[17] ?>">
                          <input type="number" class="form-control " id="address_lable_length" name="address_lable_length"   value="<?php echo $data_value[17] ?>" >
                        </div>
                    </div>

                </fieldset>

<br>
                <fieldset style="border: solid 3px #0A82FF ;padding-left: 20px; padding-right: 20px; padding-bottom: 20px">  
                    <legend style="width: auto; ">การเปิด - ปิดเว็ปไซต์</legend>

                  <div class="form-group">
                        <label for="" class="col-sm-3 control-label">สถานะ</label>
                        <div class="col-sm-9">
                          <input type="hidden" class="form-control " id="web_status_id" name="web_status_id"   value="<?php echo $data_id[8] ?>">
<div class="onoffswitch">
 <input type="checkbox" name="web_status" class="onoffswitch-checkbox" id="myonoffswitch" <?php echo $data_value[8] == 'on' ? 'checked="checked"' : ''?>
   >
      <label class="onoffswitch-label" for="myonoffswitch">
         <span class="onoffswitch-inner"></span>
         <span class="onoffswitch-switch"></span>
      </label>
</div>
                     </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">เหตุผล</label>
                        <div class="col-sm-9">
                          <input type="hidden" class="form-control " id="web_reason_id" name="web_reason_id"   value="<?php echo $data_id[9] ?>">
                          <textarea class="form-control " id="web_reason" name="web_reason"><?php echo $data_value[9] ?></textarea>
                        </div>
                    </div>

                </fieldset>
<br>
<fieldset style="border: solid 3px #96A5FF ;padding-left: 20px; padding-right: 20px; padding-bottom: 20px">  
                    <legend style="width: auto; ">ระยะเวลาการส่ง</legend>

                  
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">ระยะเวลาไม่เกิน (วัน)</label>
                        <div class="col-sm-9">
                          <input type="hidden" class="form-control " id="max_time_id" name="max_time_id"   value="<?php echo $data_id[18] ?>">
                          <input type="text" class="form-control " id="max_time" name="max_time"   value="<?php echo $data_value[18] ?>">
                        </div>
                    </div>

                </fieldset>
                  

</div></div></div></div></div>
 <div class=" col-md-6 " >
  <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="box box-success box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">ข้อมูลหน้าติดต่อเรา</h3>
                                </div>
                                <div class="box-body" >
                                    <div class="form-horizontal">
                    
                                      
                 
                  <div class="form-group">
                    <br>
                                                


                                                <div class="col-sm-12">
                                                  <!-- <input type="hidden" class="form-control " id="description_id" name="description_id"   value="<?php echo $objResult2["id"] ?>"> -->
                                                       <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active">
                  <a href="#thai" data-toggle="tab" aria-expanded="true">
                    <img class="flag-lang" src="../img/th-fl.png" width="22" height="15">
                    ภาษาไทย
                  </a>
                </li>
                <li>
                  <a href="#english" data-toggle="tab" aria-expanded="false">
                    <img class="flag-lang" src="../img/en-fl.jpg" width="22" height="15">
                    ภาษาอังกฤษ
                  </a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="thai">
                  <div class="form-group">
                        <label for="" class="col-sm-3 control-label">หัวเว็บไซต์</label>
                        <div class="col-sm-9">
                          <input type="hidden" class="form-control " id="web_head_id_th" name="web_head_id_th"   value="<?php echo $data_id[10] ?>">
                          <input type="text" class="form-control " id="web_head_th" name="web_head_th"  value="<?php echo $data_value[10] ?>" placeholder="หัวเว็บไซต์ภาษาไทย">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">ที่อยู่</label>
                        <div class="col-sm-9">
                          <input type="hidden" class="form-control " id="address_id_th" name="address_id_th"   value="<?php echo $data_id[11] ?>">
                          <input type="text" class="form-control " id="address_th" name="address_th"  value="<?php echo $data_value[11] ?>" placeholder="ที่อยู่ภาษาไทย">
                        </div>
                    </div>
                    <input type="hidden" class="form-control " id="editor_id_th" name="editor_id_th"   value="<?php echo $data_id[12] ?>">
                  <input type="hidden" name="id_link" value="3">
                  <div id="editor" style="margin-top: 10px;">
                    <textarea class='edit' name="editor" style="margin-top: 20px;"><?php echo $data_value[12] ?></textarea>
                  </div>
                </div>
                <div class="tab-pane" id="english">
                  <div class="form-group">
                        <label for="" class="col-sm-3 control-label">หัวเว็บไซต์</label>
                        <div class="col-sm-9">
                          <input type="hidden" class="form-control " id="web_head_id_en" name="web_head_id_en"   value="<?php echo $data_id[13] ?>">
                          <input type="text" class="form-control " id="web_head_en" name="web_head_en"   value="<?php echo $data_value[13] ?>" placeholder="หัวเว็บไซต์ภาษาอังกฤษ" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">ที่อยู่</label>
                        <div class="col-sm-9">
                          <input type="hidden" class="form-control " id="address_id_en" name="address_id_en"   value="<?php echo $data_id[14] ?>">
                          <input type="text" class="form-control " id="address_en" name="address_en"  value="<?php echo $data_value[14] ?>" placeholder="ที่อยู่ภาษาอังกฤษ">
                        </div>
                    </div>
                    <input type="hidden" class="form-control " id="editor_id_en" name="editor_id_en"   value="<?php echo $data_id[15] ?>">
                  <input type="hidden" name="id_link" value="3">
                  <div id="editor" style="margin-top: 10px;">
                    <textarea class="edit"  name="editor_en" style="margin-top: 20px;"><?php echo $data_value[15] ?></textarea> 
                  </div>
                </div>
              </div>
            </div>
                                         
                                                   
                                                </div>
                                            </div>
                  

</div></div></div></div>
 </div>
</form></div>


        
        <!-- /.row -->
        <div class="boxsave" style="<?php echo $button_open ?>">
          <button type="button" class="btn btn-success pull-right btnSendAdd" id="btnSendAdd"  style="transition: 0.4s; margin-left: 5px;"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;<?=lang('บันทึก','Save')?></button>
          <button type="button" class="btn btn-default pull-right btnSendClear" id="btnSendClear"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;<?=lang('เคลียร์','Clear')?></button>
      </div>
        <!-- /.box --> 
    
<input type="hidden" name="per_button_edit" id="per_button_edit" value="<?php echo $button_edit ?>">
<input type="hidden" name="per_button_del" id="per_button_del" value="<?php echo $button_del ?>">
<input type="hidden" name="per_button_open" id="per_button_open" value="<?php echo $button_open ?>">
<input type="hidden" name="per_input_read" id="per_input_read" value="<?php echo $input_read ?>">
      <!-- /.form send to DB-->
      <div class="modal fade" id="modal-default-image">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-warning">&nbsp;&nbsp;</i><?=lang('คำเตือน','Warning')?></h4>
              </div>
              <div class="modal-body">
                <div id="image">
                  <center><img src="../img/warning.png" width="60" height="60"><h4><?=lang('กรูณาเลือกรูปภาพ','Please select the picture.')?></h4></center>
                </div>
                <div id="checkbox">
                  <center><img src="../img/warning.png" width="60" height="60"><h4><?=lang('กรูณาเลือกหมวดหมู่บทความ','Please select the article category.')?></h4>
                    <?=lang('ในกรณีไม่มีหมวดหมู่ที่ต้องการสามารถเพิ่มหมวดหมู่ที่ปุ่ม เพิ่มหมวดหมู่','In the absence of the desired category, can add a category to the button. Add category')?></center>
                </div>
                <div id="clearbox">
                  <center><img src="../img/warning.png" width="60" height="60"><h4><?=lang('การเคลียร์หน้าเพิ่มบทความจะเป็นการล้างหน้าจอรวมถึงภาพ/หมวดหมู่/เนื้อหาจะถูกล้างไปด้วย','Clearing the add page will clear the screen including images / categories / content will be cleared as well.')?></h4></center>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-block btn-primary" data-dismiss="modal"><?=lang('ฉันเข้าใจแล้ว','Understood')?></button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <div class="modal fade" id="modal-default-clearbox">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-warning">&nbsp;&nbsp;</i><?=lang('คำเตือน','Warning')?></h4>
              </div>
              <div class="modal-body">
                <div id="clearbox">
                  <center><img src="../img/warning.png" width="60" height="60"><h5><?=lang('การเคลียร์หน้าเพิ่มหน้าแรกจะเป็นการล้างหน้าจอรวมถึงเนื้อหาจะถูกล้างไปด้วย','Clearing the add page will clear the screen including  content will be cleared as well.')?></h5></center>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?=lang('ยกเลิกการเคลียร์','Cancel')?></button>
                <button type="button" class="btn btn-primary btnSendClearBox" data-dismiss="modal"><?=lang('ฉันเข้าใจแล้ว','Understood')?></button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </section>
    <!-- /.content -->
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- Include external JS libs. -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>
<!-- Include JS files. -->
<script type="text/javascript" src="../page_froala/js/froala_editor.pkgd.min.js"></script>
  
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<!-- upload js-->
<script src="js/up_pre.js"></script>
<script>
      $(function() {
          $('.edit').froalaEditor({
            language: 'ar',
            heightMin: 300,
            heightMax: 400,
            imageUploadURL:"froala_upload_image.php",
            imageUploadParam:"fileName",
            imageManagerLoadMethod:"GET",
            imageManagerLoadURL:"../page_froala/select.php",
            imageManagerDeleteURL:"froala_delete_image.php",
            imageManagerDeleteMethod:"POST",
            // video
            videoUploadURL: 'froala_upload_video.php',
            videoUploadParam: 'fileName',
            videoUploadMethod: 'POST',
            videoMaxSize: 50 * 1024 * 1024,
            videoAllowedTypes: ['mp4', 'webm', 'jpg', 'ogg'],

            fileUploadURL: 'froala_upload_file.php',
            fileUploadParam: 'fileName',
            fileUploadMethod: 'POST',
            fileMaxSize: 20 * 1024 * 1024,
            fileAllowedTypes: ['*'],
          }).on('froalaEditor.image.uploaded', function (e, editor, response) {
            console.log(response);
          }).on('froalaEditor.imageManager.beforeDeleteImage', function (e, editor, $img) {
            console.log($img);
          }).on('froalaEditor.imageManager.imageDeleted', function (e, editor, res) {
            console.log(res);
          }).on('froalaEditor.video.beforeUpload', function (e, editor, videos) {
            console.log("beforeUpload");
          }).on('froalaEditor.video.uploaded', function (e, editor, response) {
            console.log("uploaded");
          }).on('froalaEditor.video.inserted', function (e, editor, $img, response) {
            console.log("inserted");
          }).on('froalaEditor.video.replaced', function (e, editor, $img, response) {
            console.log("replaced");
          }).on('froalaEditor.video.error', function (e, editor, error, response) {
            console.log("error");
          }).on('froalaEditor.file.beforeUpload', function (e, editor, files) {
            console.log("beforeUpload");
          }).on('froalaEditor.file.uploaded', function (e, editor, response) {
            console.log("uploaded");
          }).on('froalaEditor.file.inserted', function (e, editor, $file, response) {
            console.log("inserted");
          }).on('froalaEditor.file.error', function (e, editor, error, response) {
            console.log("error");
           });
      });
      $(document).ready(function(){
        //---------------------------------------fetch_data_category-------------------------------------------------------------------------
        // function fetch_data_cat()  
        //   {  
        //       $.ajax({  
        //           url:"select_cat-fa.php",  
        //           method:"POST",  
        //           success:function(data){  
        //       $('#catagory').html(data);  
        //           }  
        //       });  
        //   }  
        //   fetch_data_cat();
        //---------------------------------------clear form----------------------------------------------------------------------------------
        $(document).on('click', '.btnSendClear', function() {
            $('#modal-default-clearbox').modal('show');
        });
        $(document).on('click', '.btnSendClearBox', function() {
            document.getElementById('frmADD').reset();
            $('#img-upload').attr('src', 'img/upload.jpg');
            document.getElementById("btnSendAdd").disabled = true;
        });
        //------------------------------------------------------------ADD Catagory-----------------------------------------------------------
        $(document).on('click', '.btnSendAddCat', function(){ 
          var name = $("#name_cat").val();
              $.ajax({
                  beforeSend: function() {
                    // setting a timeout
                    $('#result_add_cat').show();
                    $('#success_add_cat').hide();
                    $('#loader_add_cat').show();
                  },
                  complete: function() {
                      $('#loader_add_cat').hide();
                      $('#success_add_cat').show();  
                      setTimeout(function(){$("#result_add_cat").hide(0)}, 10000);
                  },
                   type: "POST",
                   url: "back_catagory-add.php",
                   data: 'name='+name,
                   success: function(data) {
                   fetch_data_cat();
                  },
              });
         });
        //--------------------------------------------------------check box for validation--------------------------------------------------
        $(document).on('click', '.css_data_item', function(){  // เมื่อคลิก checkbox  ใดๆ  
            if($(this).prop("checked")==true){ // ตรวจสอบ property  การ ของ   
                var indexObj=$(this).index(".css_data_item"); //   
                $(".css_data_item").not(":eq("+indexObj+")").prop( "checked", false ); // ยกเลิกการคลิก รายการอื่น  
            }  
        });
     //------------------------------------------------------------ADD article--------------------------------------------------------------
//       $(document).on('click', '#btnSendAdd', function(){
//         var formData = new FormData($('#upload-form-add')[0]);

//     name_th = $('#name_th').val();
//     name_en = $('#name_en').val();
  

//     if(name_th == ""){
//         swal("คำเตือน", "คุณยังไม่ได้ใส่ชื่อไทย TH", "warning")
//         return false;
//       }
//     if(name_en == ""){
//         swal("คำเตือน", "คุณยังไม่ได้ใส่ชื่ออังกฤษ EN", "warning")
//         return false;
//       }
    
//         swal({
//             title: 'ยืนยัน?',
//             text: "ยืนยันการบันทึกหรือไม่?",
//             type: 'info',
//             showCancelButton: true,
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             confirmButtonText: 'ยืนยัน!',
//             showLoaderOnConfirm: true,
//             preConfirm: function () {
//             return new Promise(function (resolve) {
//             $.ajax({
//             type: "POST",
//             url: "back_article-add.php",
//             data: formData,
//             processData: false,
//             contentType: false
//                   })

// // in case of successfully understood ajax response
//             .done(function (myAjaxJsonResponse) {
//             console.log(myAjaxJsonResponse);
//             if (myAjaxJsonResponse.status=='0') {
           
//   swal({
//             title: 'สำเร็จ',
//             text: "บันทึกเรียบร้อยแล้ว?",
//             type: 'success',
      
//             confirmButtonColor: '#3085d6',
          
//             confirmButtonText: 'ยืนยัน!',
//             showLoaderOnConfirm: true,
//             preConfirm: function () {
//          fetch_data_employee_list();
//          $('#name_en').val('');
//          $('#name_th').val('');

//         },    
//       })
// }else{
//   swal('ไม่สำเร็จ', 'เกิดปัญหากับระบบ', 'error');
// }
//             })
//             .fail(function (erordata) {
// // คือไม่สำรเ็จ
//             console.log(erordata);
//             swal('ไม่สำเร็จ', 'เกิดปัญหากับระบบ', 'error');
//             })
//           })
//         },    
//       })
        
       
//     });
      
        $(document).on('click', '.btnSendAdd', function(){ 
          var formData = new FormData($('.upload-form-add')[0]);
             // var checkfilearticle = $(".checkfilearticle")[0].files.length;
            //  if(checkfilearticle === 0){
            //       $('#modal-default-image').modal('show');
            //       $('#image').show();
            //       $('#checkbox').hide();
            //       $('#clearbox').hide();
            //      return false;
            //  }
            //  if($(".css_data_item:checked").length==0){ // ถ้าไม่มีการเลือก checkbox ใดๆ เลย  
            //        $('#modal-default-image').modal('show'); 
            //        $('#image').hide();
            //        $('#clearbox').hide();
            //        $('#checkbox').show(); 
            //       return false;     
            // }  
              $.ajax({
                  beforeSend: function() {
                    // setting a timeout
                    $('#result_add').show();
                    $('#success_add').hide();
                    $('#loader_add').show();
                  },
                  complete: function() {
                      $('#loader_add').hide();
                      $('#success_add').show();  
                      setTimeout(function(){$("#result_add").hide(0)}, 10000);
                      $('#modal-default').modal('show');

                  },
                   type: "POST",
                   url: "back_article-add.php",
                   data: formData,
                   processData: false,
                   contentType: false,
                   success: function(data) {
                    console.log(data);
                    // alert(data);
                      // document.getElementById('frmADD').reset();
                      // $('#img-upload').attr('src', 'img/upload.jpg');
                  },
              });
          });
        $(document).on('click', '#btnYes', function (){
          location.href = "front-manage.php";
        })
      });
       //---------------------------------------Show add form category toggle--------------------------------------------------------------------
      $(function(){          
        $(".show-add").click(function(){
            $("#add-cat").toggle();
        });    
      });  
      //----------------------------------------------Check length for open button save---------------------------------------------------------
      function checklength() {
        var input = document.getElementById("name") ;
                if(input.value.length > 0)
                {
                  document.getElementById("btnSendAdd").disabled = false;
                }else{
                  document.getElementById("btnSendAdd").disabled = true;
                }
        }
        //----------------------------------------------Check length for open button save(forcategory)------------------------------------------
        function checklengthcat() {
        var input = document.getElementById("name_cat") ;
                if(input.value.length > 0)
                {
                  document.getElementById("btnSendAddCat").disabled = false;

                }else{
                  document.getElementById("btnSendAddCat").disabled = true;
                }
        }
        //----------------------------------------------------Set time realtime------------------------------------------------------------------
        function startTime() {
          var today = new Date();
          var h = today.getHours();
          var m = today.getMinutes();
          var s = today.getSeconds();
          m = checkTime(m);
          s = checkTime(s);
          document.getElementById('realtime').innerHTML =
          h + ":" + m + ":" + s;
          var t = setTimeout(startTime, 500);
        }
        function checkTime(i) {
            if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
            return i;
        }
</script>
</body>
</html>
