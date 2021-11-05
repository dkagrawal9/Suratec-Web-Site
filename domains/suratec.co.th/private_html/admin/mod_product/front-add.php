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
  <link href="css/bootstrap-toggle.min.css" rel="stylesheet"> 
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../plugins/iCheck/all.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">

   <!-- Select2 -->
  <link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- upload template css-->
  <link rel="stylesheet" type="text/css" href="components/up_pre/style.css">
  <!-- Pace style -->
  <link rel="stylesheet" href="../plugins/pace/pace.min.css">
  <!--sweet alert -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css.map"> -->
  <!-- Include external CSS. -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">
  <!-- Include Editor style. -->
  <link href="../page_froala/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css">
  <link href="../page_froala/css/froala_style.min.css" rel="stylesheet" type="text/css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" type="text/css" href="css/modal_view.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

  <style type="text/css">
    .header-attribute td{
      padding: 3px;
      border:1px solid #ddd;
    }
    .header-attribute th{
      padding: 8px;
      /*border:1px solid white;*/
      background-color: #ddd;
    }
    .control-label{
      padding-top: 7px;
      text-align: right;
      padding-right: 0px;
    }
    .normal-product{
      margin-bottom: 13px;
    }
    .overlay-allpage{
      position: fixed;
      width: 100%;
      height: 100%;
      top:0;
      left:0;
      background-color: rgba(0,0,0,0.7);
      cursor: pointer;
      z-index: 999999;
    }
     /* transition: 0.5s;
    }*/
    .hidden-xy{
      overflow: hidden;
    }
    .overlay-allpage>.fa{
      position: absolute;
      color: white;
      top:50%;
      left:50%;
      font-size: 60px;
      margin-top: -35px;
      margin-left: -35px;
      z-index: 999999;
    }
    .text-image .fa{
      font-size: 40px;
    }
    .form-group{
      margin-bottom: 5px;
    }
    .btn-default.active{
      border:none;
    }
    .btn-primary.active{
      border:none;
    }
    .btn-success{
      background-color: #5cb85c;
      border: none;
    }
    .btn-warning{
      border:none;
    }
    .style{
      background-color: #e6e6e6;
       border:1px solid #b5b5b5;
      transition: 0.4s;
    }
    .style:hover{
      background-color: #f7f7f7;
      border:1px solid #b5b5b5;
      /*color: white;*/
    }
    .style:focus{
      color: white;
    }
    .check-active-ready{
      background-color:#4cad40 !important;
      border-color:#4cad40 !important; 
      color:white !important;
    }
    .check-active-ready:hover{
      background-color: white !important;
      border-color: #4cad40 !important;
      color: #4cad40 !important;
    }
    .check-active-soon{
      background-color:#FDA323 !important;
      border-color:#FDA323 !important;
      color:white !important;
    }
    .check-active-soon:hover{
      background-color: white !important;
      border-color: #FDA323 !important;
      color: #FDA323 !important;
    }
    .check-active-out{
      background-color:#FD6F3B !important;
      border-color:#FD6F3B !important;
      color:white !important;
    }
    .check-active-out:hover{
      background-color: white !important;
      border-color: #FD6F3B !important;
      color: #FD6F3B !important;
    }
    .check-active-des{
      background-color:#EFA694 !important;
      border-color: #EFA694 !important;
      color:white !important;
    }
    .check-active-des:hover{
      background-color: white !important;
      border-color:#EFA694 !important;
      color: #EFA694 !important;
    }
    .sweet-alert .sa-icon{
      margin-bottom: 35px;
    }
    .sps{
      border:1px solid;
      border-color: #ddd;
      border-radius: 4px;
      width: 100%;
      max-height: 100%;
      padding-top: 10px;
      padding-bottom: 10px;
      cursor: pointer;
      transition: 0.4s
    }
    .sps:hover{
      border:1px solid #399bf2;
      box-shadow:0px 0px 5px 0px #16B1F0;
    }
    .check_suit{
      display: none;
    }
    .active_ssp{
      border-color: #399bf2 !important;
      color: #399bf2 !important;
       box-shadow:0px 0px 5px 0px #16B1F0;
    }
           /* width */
    .text-cat::-webkit-scrollbar {
        width: 5px;
    }

    /* Track */
    .text-cat::-webkit-scrollbar-track {
        border-radius: 10px;
        background: #f1f1f1; 
    }
     
    /* Handle */
    .text-cat::-webkit-scrollbar-thumb {
        border-radius: 10px;
        background: #888; 
    }

    /* Handle on hover */
    .text-cat::-webkit-scrollbar-thumb:hover {
        background: #555; 
    }
    .bg-option{
        background-color: #ddd;
        color:white;
    }
    .bg-option1{
        background-color: grey;
        color:white;
    }
    .bootstrap-tagsinput{
      border:none;
      box-shadow: none;
    }
    .drop_area{
      transition: 0.4s;
    }
  </style>
  </head>
  <body class="hold-transition skin-blue sidebar-mini fixed" onload="startTime()">
  <div class="wrapper">

  <?php require_once '../template/nav_menu.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <h1>
        เพิ่มสินค้าใหม่
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../index.php"></i> แดชบอร์ด</a></li>
        <li><a href="front-manage.php"></i> การจัดการสินค้า</a></li>
        <li class="active">เพิ่มสินค้าใหม่</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
      <!-- <div class="box box-warning collapsed-box" >
        <div class="box-header with-border">
          <h3 class="box-title">คำแนะนำการใช้งาน</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div style="padding-left: 10px;">
            <i class="fa fa-caret-right"></i>&nbsp;&nbsp;การเพิ่มสินค้า ควรสร้างหมวดหมู่สินค้าก่อน เพื่อจัดกลุ่มสินค้าในเว็บไซต์ เช่น ขายเสื้อยืดคอวี ควรมีการสร้างหมวดหมู่ เสื้อผ้าแฟชั่นผู้หญิง เอาไว้ก่อนเพิ่มสินค้า<br>
            <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถสร้างหมวดหมู่สินค้าเร่งด่วนได้ที่ หมวดหมู่สินค้า และคลิกปุ่ม เพิ่ม และกรอกชื่อหมวดหมู่สินค้าตามต้องการ<br>  
            <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถเพิ่มยี่ห้อสินค้าใหม่ได้ที่ ยี่ห้อสินค้า และคลิกปุ่ม เพิ่ม และกรอกชื่อหมวดหมู่สินค้าตามต้องการ หรือเลือกยี่ห้อเดิมที่มีอยู่ได้เลย<br> 
            <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถใส่รายละเอียดสินค้าเพิ่มเติม เช่น รหัสสินค้า , แท็กของสินค้าได้ เป็นต้น<br>
            <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถตั้งค่าสิทธิการเข้าดูข้อมูลสินค้า เฉพาะสมาชิกได้<br>
            <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถเลือกป้ายสถานะให้สินค้าได้หลายแบบ เช่น สินค้าใหม่ , สินค้ายอดนิยม , สินค้าแนะนำ และสินค้าลดราคา เป็นต้น<br>
            <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถตั้งเวลาเปิด - ปิดการแสดงผลของสินค้าได้ โดยเลือกสถานะ เปิด และกำหนดวันที่แสดงผล และหมดอายุ<br>
            <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถตั้งค่า คะแนนสะสม ของสินค้า กรณีที่ลูกค้าสั่งซื้อสินค้าดังกล่าว จะได้รับคะแนนสะสมตามที่คุณตั้งค่าไว้<br> 
            <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถกำหนดให้หน้ารายละเอียดสินค้า แสดงสินค้าที่เกี่ยวข้องจาก สินค้าที่อยู่ในหมวดหมู่เดียวกัน , สินค้าที่มี Tags เดียวกัน หรือกำหนดสินค้าที่จะแสดงได้เอง<br>
            <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถใส่รูปภาพสินค้าได้มากกว่า 1 รูป ขนาดรูปภาพไม่ควรเกิน 500KB รองรับไฟล์นามสกุล .jpg, .gif, .png<br> 
            <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถกำหนดราคาสินค้าได้หลายรูปแบบ ราคาขาย , ราคาปกติ , ระบุราคาแบบข้อความ<br>
            <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถกำหนด จำนวนสินค้าคงเหลือ หรือสต็อกสินค้าได้<br>
            <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถเพิ่มน้ำหนักสินค้าหน่วยเป็นกรัมได้<br>
            <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถกำหนดจำนวนสั่งซื้อขั้นต่ำต่อสินค้าชิ้นนี้ได้<br>
          </div>
        </div>
      </div> -->

      <div class="row">
          <div class="col-md-6">
                         <div class="row"  id="texts">
          <div class="col-md-12">
            <div class="box box-info">
              <div class="box-header">
                <h3 class="box-title">รายละเอียดสินค้า</h3>
              </div>
              <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active">
                  <a href="#thai" data-toggle="tab" aria-expanded="0">
                    <img class="flag-lang" src="../img/th-fl.png" width="22" height="15">
                    ภาษาไทย
                  </a>
                </li>
                <li>
                  <a href="#english" data-toggle="tab" aria-expanded="1">
                    <img class="flag-lang" src="../img/en-fl.jpg" width="22" height="15">
                    ภาษาอังกฤษ
                  </a>
                </li>
                <li>
                  <a href="#chlish" data-toggle="tab" aria-expanded="2">
                    <img class="flag-lang" src="../img/ZH.png" width="22" height="15">
                    ภาษาจีน
                  </a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="thai">
                   <div class="box-body">
                <div class="input-group" style="margin-bottom: 0;">
                  <span class="input-group-addon"><i class="fa fa-header"></i></span>
                  <input type="text" class="form-control" id="name_product" name="name_product" placeholder="ชื่อสินค้า" onkeyup="checklength()">
                </div>
              </div>
   
   
                  <div id="editor" style="margin-top: 10px;">
                    <textarea class='edit' name="editor" id="input-editor" style="margin-top: 20px;"></textarea>
                  </div>
                </div>
                <div class="tab-pane" id="english">
                  <div class="box-body">
                <div class="input-group" style="margin-bottom: 0;">
                  <span class="input-group-addon"><i class="fa fa-header"></i></span>
                  <input type="text" class="form-control" id="product_name_en" name="product_name_en" placeholder="ชื่อสินค้า" >
                </div>
              </div>
              
                  <div id="editor" style="margin-top: 10px;">
                    <textarea class="edit"  name="editor_en"  id="input-editor_en" style="margin-top: 20px;"></textarea> 
                  </div>
                </div>
                <div class="tab-pane" id="chlish">
                   <div class="box-body">
                <div class="input-group" style="margin-bottom: 0;">
                  <span class="input-group-addon"><i class="fa fa-header"></i></span>
                  <input type="text" class="form-control" id="product_name_ch" name="product_name_ch" placeholder="ชื่อสินค้า" >
                </div>
              </div>
                  <div id="editor" style="margin-top: 10px;">
                    <textarea class="edit"  name="editor_ch"  id="input-editor_ch" style="margin-top: 20px;"></textarea> 
                  </div>
                </div>
              </div>
            </div>
            </div>
            <!-- /.box -->

          </div>
          <!-- /.col (left) -->
         
          <!-- /.col (right) -->
        </div>
         <div class="row"  id="texts">
          <div class="col-md-12">
            <div class="box box-info">
              <div class="box-header">
                <h3 class="box-title">รีวิวสินค้า</h3>
              </div>
              <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active">
                  <a href="#thai_re" data-toggle="tab" aria-expanded="0">
                    <img class="flag-lang" src="../img/th-fl.png" width="22" height="15">
                    ภาษาไทย
                  </a>
                </li>
                <li>
                  <a href="#english_re" data-toggle="tab" aria-expanded="1">
                    <img class="flag-lang" src="../img/en-fl.jpg" width="22" height="15">
                    ภาษาอังกฤษ
                  </a>
                </li>
                <li>
                  <a href="#chlish_re" data-toggle="tab" aria-expanded="2">
                    <img class="flag-lang" src="../img/ZH.png" width="22" height="15">
                    ภาษาจีน
                  </a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="thai_re">
                   <div class="box-body">
                <div class="input-group" style="margin-bottom: 0;">
                  
                </div>
              </div>
   
   
                  <div id="editor" style="margin-top: 10px;">
                    <textarea class='edit' name="editor_re" id="input-editor_re" style="margin-top: 20px;"></textarea>
                  </div>
                </div>
                <div class="tab-pane" id="english_re">
                  <div class="box-body">
                <div class="input-group" style="margin-bottom: 0;">
                  
                </div>
              </div>
              
                  <div id="editor" style="margin-top: 10px;">
                    <textarea class="edit"  name="editor_en_re"  id="input-editor_en_re" style="margin-top: 20px;"></textarea> 
                  </div>
                </div>
                <div class="tab-pane" id="chlish_re">
                   <div class="box-body">
                <div class="input-group" style="margin-bottom: 0;">
                 
                </div>
              </div>
                  <div id="editor" style="margin-top: 10px;">
                    <textarea class="edit"  name="editor_ch_re"  id="input-editor_ch_re" style="margin-top: 20px;"></textarea> 
                  </div>
                </div>
              </div>
            </div>
            </div>
            <!-- /.box -->

          </div>
          <!-- /.col (left) -->
         
          <!-- /.col (right) -->
        </div>
          <div class="box box-default">
              <div class="box-header">
                <h3 class="box-title">รูปภาพสินค้า</h3>
              </div>
              <div class="box-body drop_area" style="z-index:3;min-height: 200px; border-radius: 0px;border: 1px solid rgb(218, 223, 227); background: transparent; margin:10px; padding: 0; " align="center">
                <div class="drop_image" style="cursor: pointer; min-height: 200px;">
                  <i class="fa fa-cloud-upload" style="font-size: 5em; margin-top: 45px; color: gray"></i>
                  <h3 style="margin-top: -5px; color: gray">Drop file here</h3>
                  <!-- <div class="browse">
                    click here to browse
                  </div> -->
                </div>
                <div id="live-thumb" style="padding-left: 10px; padding-right: 10px;z-index:5;"></div>
              </div>
              <div class="progress progress-xxs" style="margin:10px; margin-top: -10px;">
                        <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%; background-color: #3c8dbc;">0%</div>
                </div>
              <div id="check_upload" class="overlay" style="display: none;">
                <i class="fa fa-spinner fa-spin" style="color:#228896;"></i>
              </div>
              <div class="box-footer" style="border-top: none;">
                <form class="upload-form-add-thumbnail"  method="post" enctype="multipart/form-data" id="frmADD_thumbnail">
                <div class="input-group">
                    <span class="input-group-btn">
                      <span class="btn btn-default btn-file remove" style="background-color: #ff4e4e !important; color:white; display: none;">
                        <i class="glyphicon glyphicon-trash"></i>&nbsp;&nbsp;ลบทั้งหมด 
                      </span>
                      <span class="btn btn-default btn-file" style="background-color: white !important;">
                        <i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;&nbsp;เลือกรูปภาพ 
                        <input type="file" name="files[]" method="post" entype="multipart/form-data" multiple class="upload-form-add-thumbnail checkfile" id="files">
                      </span>
                    </span>
                    <span style="float: right; padding-top: 15px;"><b>คำแนะนำ: </b>คลิกที่ภาพเพื่อเลือกเป็นภาพหน้าปกสินค้า</span>
                  </div>
                </form>
              </div>
            </div>

            <!-- /.box -->
           
            
          </div>

          <!-- /.col (left) -->
          <div class="col-md-6" >

            <div class="box box-default">
   <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">รายละเอียดสินค้า</h3>
                        </div>
                        <div class="box-body" align="right">
                            <div id="printableTable">
                               <!-- <div class="box-body">
                                        <label class="col-sm-2 control-label">ชื่อสินค้า</label>
                                        <div class='col-sm-10' id='datetimepicker'>
                                            <input type='text' class="form-control"  name="name_product" id="name_product" onkeyup="checklength()">
                                        </div>
                                </div> -->
                                <div class="box-body">
                                        <label class="col-sm-2 control-label">SKU</label>
                                        <div class='col-sm-10' id='datetimepicker'>
                                            <input type='text' class="form-control"  name="SKU" id="SKU">
                                        </div>
                                </div>
                                <div class="box-body">
                                        <label class="col-sm-2 control-label">ราคาขาย</label>
                                        <div class='col-sm-10' id='datetimepicker'>
                                            <input type='number' class="form-control"  name="selling_price" id="selling_price">
                                        </div>
                                </div>
                                <div class="box-body">
                                        <label class="col-sm-2 control-label">ราคาทุน</label>
                                        <div class='col-sm-10' id='datetimepicker'>
                                            <input type='number' class="form-control"  name="capital_cost" id="capital_cost">
                                        </div>
                                </div>
                                <div class="box-body">
                                        <label class="col-sm-2 control-label">น้ำหนักสินค้า(g)</label>
                                        <div class='col-sm-10' id='datetimepicker'>
                                            <input type='number' class="form-control"  name="weight" id="weight">
                                        </div>
                                </div>
                                <div class="box-body">
                                        <label class="col-sm-2 control-label">ร้านค้า</label>
                                        <div class='col-sm-10' id='datetimepicker'>
  <?php   $strSQL = "SELECT * FROM `mod_erp_branch` WHERE `delete_datetime` is null";
          $objQuery = mysqli_query($objConnect,$strSQL);
          ?>
                                            <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="id_branch" id="id_branch"> 
                                              <option value="0">เลือกสาขา</option>
          <?php 
              while($objResult = mysqli_fetch_array($objQuery)){

          ?>
                                              <option value="<?php echo $objResult["id_branch"] ?>"><?php echo $objResult["name_branch"] ?> </option>
          <?php } ?>
                                            </select>
                                        </div>
                                </div>
                            </div>


                        </div>
                        <div class="box-header with-border">
                            <h3 class="box-title">สถานะสินค้า</h3>
                        </div>
                        <div class="box-body" >
                         <div id="printableTable">
                               <div class="checkbox" style="width: 100%; padding-left:10px; padding-bottom: 10px;">
                      <div class="pull-right">
                        <small class="label pull-left bg-option new" style="margin-left: -51px; margin-top: 5px;">new</small>
                        <label class="sign_status2">
                          <input id="sign_status2" data-toggle="toggle" type="checkbox" name="sign_product[]" value="สินค้าใหม่" data-size="small" >
                        </label>
                      </div>
                          สินค้าใหม่<br>
                  </div>
                  <div class="checkbox" style="width: 100%; padding-left:10px; padding-bottom: 10px;">
                      <div class="pull-right">
                        <small class="label pull-left bg-option hot" style="margin-left: -47px; margin-top: 5px;">hot</small>
                        <label class="sign_status3">
                          <input id="sign_status3" data-toggle="toggle" type="checkbox" name="sign_product[]" value="สินค้ายอดนิยม" data-size="small" >
                        </label>
                      </div>
                        สินค้ายอดนิยม<br>
                  </div>
                  <div class="checkbox" style="width: 100%; padding-left:10px; padding-bottom: 10px;">
                      <div class="pull-right">
                        <label class="sign_status5">
                          <input id="sign_ready" data-toggle="toggle" type="checkbox" name="sign_ready" value="1" data-size="small" >
                        </label>
                      </div>
                        แสดงสินค้า<br>
                  </div>
                         </div>
                        </div>
                         <div class="box-header with-border">
                            <h3 class="box-title">หมวดหมู่</h3>
                        </div>
                        <div class="box-body" >
                         <div id="printableTable">
                            <div class="box-body text-cat" style="padding-left: 20px; padding-right: 20px; max-height: 250px; overflow: auto;">
                              <div id="catagory" style=""></div>
                            </div>
                        </div>
                        </div>


             
            </div>

                        <div style="display: none;">
<input type="radio" name="tab_ch" id="tab_ch1" checked="checked">
<input type="radio" name="tab_ch" id="tab_ch2">                  
                        </div>

                                      <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active">
                  <a href="#thai_attr" data-toggle="tab" aria-expanded="0" id="tab_1">
                   
                    สินค้ามีแบบเดียว
                  </a>
                </li>
                <li>
                  <a href="#english_attr" data-toggle="tab" aria-expanded="1" id="tab_mullti">
                   
                    สินค้ามีหลายรูปแบบ
                  </a>
                </li>
                
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="thai_attr">
                   <div class="box-body">
                <div class="input-group" style="margin-bottom: 0;">
                  
                </div>
              </div>
                  <div class="box-body">
                                  <label class="col-sm-2 control-label"><?=lang('SKU','SKU ')?></label>
                                    <div class='col-sm-9' id='datetimepicker'>
                                      <input class="form-control sku_auto" type="text" name="SKU_1" id="SKU_1" />
                                    </div>
                                    
                                </div>
                </div>
                <div class="tab-pane" id="english_attr">
                  <div class="box-body">
    <div class="box-header with-border">
                <div class="col-md-6" align="left">
                    <h3 class="box-title">คุณลักษณะสินค้า</h3>
                </div>
                <div class="col-md-6" align="right">
                   <!--  <a  href="product_features.php"   data-toggle="modal" data-target="#modal_showdetail">
                        <button type="button" class="btn btn-success"  ><i class="fa fa-plus"></i> เพิ่มคุณลักษณะ</button>
                    </a> -->
                </div>
                <div class="col-md-12" align="left"><br></div>
                <div class="col-md-12" align="left">
                   <div class="tab-pane objective" id="objective"> 
                    <div style="margin-bottom: 10px; margin-top: -9.5px;">
                    <table width="100%" class="header-attribute" style="border:1px solid #ddd;">
                      <thead>
                        <tr style="font-weight: bold;">
                          <th style="min-width: 50px; width: 10%" align="center">
                            เปิดใช้งาน 
                          </th>
                          <th style="min-width: 75px; width: 30%">
                            คุณลักษณะ
                          </th>
                          <th>
                            Option
                          </th>
                        </tr>
                      </thead>
                      <tbody class="show-attribute">
<?php
$str = "SELECT * FROM product_attribute_head";
$query = mysqli_query($objConnect,$str);
$num_head = 0;
while($result=mysqli_fetch_array($query)){
  $num_head++;
  $text_sub = '';
  $str_sub = "SELECT * FROM product_attribute_sub WHERE id_attr_head = '".$result['id_attr_head']."'";
  $query_sub = mysqli_query($objConnect,$str_sub);
  $num_sub = mysqli_num_rows($query_sub);
  $i=0;
  while($result_sub=mysqli_fetch_array($query_sub)){
  $i++;
    if($num_sub-$i == 0){
      $text_sub .= $result_sub['name_attr_sub']; 
    }else{
      $text_sub .= $result_sub['name_attr_sub'].',';
    }
  }
?>                      
                        <tr>
                          <td align="center">
<?php
  echo '<input type="checkbox" name="" value="'.$text_sub.'" data-idhead="'.$result['id_attr_head'].'" data-attr="'.$result['name_attr_head'].'" class="smtp_changes'.$num_head.' variants_change variants_num_check'.$num_head.'">';
?>
                          </td>
                          <td>
<?php
   echo '<span>'.$result['name_attr_head_show'].'</span>';
?>  
                          </td>
                          <td>
                           <input type="text" value="<?php echo $text_sub; ?>" data-role="tagsinput" data-idhead="<?php echo $result['id_attr_head'] ?>" id="tags" data-smtp="<?php echo $num_head; ?>" class="tagss form-control" style="border:none;">
                          </td>                         
<?php
}
?>   
                    </tbody>
                    <tbody class="inclease-attribute">
                      <tr>
                            <td align="center">
                              <button class="btn btn-success btn-sm add-row">เพิ่ม</button>
                            </td>
                            <td>
                              <input type="text" value="" id="attribute_head"  class="form-control" style="border:none;" placeholder="ชื่อคุณลักษณะ">
                            </td>
                            <td>
                              <input type="text" value="" id="attribute_text" data-role="tagsinput" data-smtp="" class="form-control" style="border:none;" placeholder="คุณลักษณะ">
                            </td>
                          </tr>
                    </tbody>
                    </table>        
                    </div>       
                      <form method="post" id="frm_attribute">
                      <div class="sticky-table empty">
                            <div class="table-product table-responsive">
                                <table id="table-multiple-variant" class="table table-hover table-list">
                                    <thead class="show-data">
                                    <tr style="background-color: #ddd">
                                        <th style="width: 60px; border-bottom: none;"></th>
                                        <th style="width: 100px; min-width: 100px; border-bottom: none;">Options</th>
                                        <th style="border-bottom: none;">ราคาขาย</th>
                                        <th style="border-bottom: none;">ราคาทุน</th>
                                        <th style="border-bottom: none;">SKU</th>
                                        <!-- <th style="border-bottom: none;">Stock</th> -->
                                        <th style="width: 100px; border-bottom: none;">น้ำหนัก</th>
                                        <th style="width: 80px; max-width: 80px; border-bottom: none;">แสดงผล</th>
                                    </tr>
                                    </thead>

                                    <tbody class="dev-product-variant-render" id="dev-product-variant-render" style="display: none; ">
                                    </tbody>

                                    <tbody class="empty-message " style="border:none;">
                                    <tr>
                                        <td colspan="10" class="text-center" style="background-color: white !important;">
                                            <div style="font-size: 18px; color: gray;">กรุณาเลือกลักษณะของสินค้าที่ต้องการเพิ่มข้อมูล</div>
                                            <div class="fa fa-edit fa-3x" style="font-size: 70px; color: #ddd;"></div>
                                        </td>
                                    </tr>
                                    </tbody>

                                </table>
                                
                            </div>
                        </div>
                      </form>
                             
                    </div>

                </div>   </div>
              </div>
              
                  
                </div>
             
              </div>
            </div>

              
            </div>
             <!-- <div class="box-body">
                <div class="input-group" style="margin-bottom: 0;">
                  <span class="input-group-addon"><i class="fa fa-header"></i></span>
                  <input type="text" class="form-control" id="product_name" name="product_name" placeholder="ชื่อสินค้า" onkeyup="checklength()">
                </div>
              </div> -->
         <!--    <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">คำอธิบายเกี่ยวกับสินค้า</h3>
              </div>
              <div class="box-body">
                <div id="editor" style="margin-top: 10px;">
                  <textarea id='edit' name="editor" style="margin-top: 20px;"></textarea>
                </div>
              </div>
            </div> -->

            <!-- /.box -->
            
            <!--  -->
         

           <div class="modal fade" id="modal_showdetail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <!-- load from file !-->
    </div>
  </div>
</div>  
            </div>
          
          <!-- /.col (right) -->
        <!-- /.col -->
        </div>
        <!-- /.row -->
     
        <div class="boxsave">
          <button type="button" class="btn btn-success pull-right btnSendAdd" id="btnSendAdd" style="transition: 0.4s; margin-left: 5px;" disabled><i class="fa fa-check"></i>&nbsp;บันทึก</button>
          <button type="button" class="btn btn-danger pull-right btnSendClear" id="btnSendClear" style="border:1px solid #e08e0b;"><i class="fa fa-remove"></i>&nbsp;ยกเลิก</button>
      </div>
  <div class="control-sidebar-bg"></div>
</div>

<!-- <div id="fb-root"></div> -->
<!-- <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js#xfbml=1&version=v2.12&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script> -->

<!-- Your customer chat code -->
<!-- <div class="fb-customerchat"
  attribution=setup_tool
  page_id="232841613757021"
  theme_color="#0084ff">
</div> -->
<!-- ./wrapper -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<!-- Include external JS libs. -->
<!-- <script src="../bower_components/jquery/dist/jquery.min.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>
<!-- Include JS files. -->
<script type="text/javascript" src="../page_froala/js/froala_editor.pkgd.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- iCheck 1.0.1 -->
<!-- PACE -->
<script src="../bower_components/PACE/pace.min.js"></script>
<script src="components/bootstrap-toggle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" crossorigin="anonymous"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.1/handlebars.min.js"></script> -->
<!-- Load Facebook SDK for JavaScript -->
<!-- <script type="text/javascript">
   $(document).ready(function() {
        function fetch_data() {
            $.ajax({
                url: "back_front_add.php?do=select",
                method: "POST",
                success: function(data) {
                    console.log(data);
                    $('#html').html(data);
                    $('#table1').dataTable();
                }
            });
        }
fetch_data();
    });
</script> -->
<script type="text/javascript">
  $("#modal_showdetail").on('hidden.bs.modal', function () {
    $(this).data('bs.modal', null);
  });
  $("#modal_showdetail").on('hidden.bs.modal', function () {
    $(this).data('bs.modal', null);
  });
</script>
<script>
    $(document).ajaxStart(function () {
        Pace.restart()
    })
  $('[data-toggle="tooltip"]').tooltip({
            animated: 'fade',
            placement: 'top',
            html: true
  });
    $(function() {
      $('.select2').select2()
          $('.edit').froalaEditor({
            language: 'ar',
            heightMin: 300,
            heightMax: 400,
            imageUploadURL:"../page_froala/upload.php",
            imageUploadParam:"fileName",
            imageManagerLoadMethod:"GET",
            imageManagerLoadURL:"../page_froala/select.php",
            imageManagerDeleteURL:"../page_froala/delete.php",
            imageManagerDeleteMethod:"POST",
            // video
            videoUploadURL: '../page_froala/upload.php',
            videoUploadParam: 'fileName',
            videoUploadMethod: 'POST',
            videoMaxSize: 50 * 1024 * 1024,
            videoAllowedTypes: ['mp4', 'webm', 'jpg', 'ogg'],

            fileUploadURL: '../page_froala/upload.php',
            fileUploadParam: 'fileName',
            fileUploadMethod: 'POST',
            fileMaxSize: 20 * 1024 * 1024,
            fileAllowedTypes: ['*'],
          }).on('froalaEditor.image.uploaded', function (e, editor, response) {
            console.log(response);
          }).on('froalaEditor.imageManager.beforeDeleteImage', function (e, editor, $img) {
            console.log($img);
            alert($img);
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
  //iCheck for checkbox and radio inputs
 $(".show-add").click(function(){
    $("#add-cat").toggle();
 });  
});
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
//-------------------------------------------------------------------------------------------------------------------------------------- 
$(document).ready(function(){
  //------------------------------------------------------------------------------------------------------------------------------------------------------
  function fetch_data_del()  {  
    $.ajax({  
      url:"select_data_DeleteAll.php",  
      method:"POST",  
      success:function(data){  
        $(".remove").hide();
        $('#img-preview').attr('src', '../img/suit.jpg');
        // alert(data);
      }  
    });  
  }  
  fetch_data_del();
  //------------------------------------------------------------------------------------------------------------------------------------------------------
  
  function fetch_thumb(){
    $.ajax({
      url: "select_data_thumb.php",
      method: "POST",
      success:function(data){
        $("#live-thumb").html(data);
      }
    });
  }
  //------------------------------------------------------------------------------------------------------------------------------------------------------
  function fetch_data_cat()  {  
    $.ajax({  
      url:"select_cat.php",  
      method:"POST",  
      success:function(data){  
        $('#catagory').html(data);  
      }  
    });  
  }  
  fetch_data_cat();
  //------------------------------------------------------------------------------------------------------------------------------------------------------
  function fetch_data_cat_live_add()  {  
    $.ajax({  
      url:"select_cat-page-add.php",  
      method:"POST",  
      success:function(data){  
        $('#live-selected-catagory').html(data);  
      }  
    });  
  }  
  fetch_data_cat_live_add();
  //------------------------------------------------------------------------------------------------------------------------------------------------------
  function fetch_btnremove(){
    $.ajax({
      url: "select_data_exists.php",
      method: "POST",
      success:function(data){
        if(data.status == 1){
          $(".remove").show();
        }else{
          $(".remove").hide();
        }
      }
    });
  }
  fetch_btnremove();

  $(document).on('click', '.sign_status1', function(){
    if($('#sign_status1').is(':checked')){
      $('.recom').removeClass('bg-option');
      $('.recom').addClass('bg-blue');
    }else{
      $('.recom').addClass('bg-option');
      $('.recom').removeClass('bg-blue');
    }
  });
  $(document).on('click', '.sign_status2', function(){
    if($('#sign_status2').is(':checked')){
      $('.new').removeClass('bg-option');
      $('.new').addClass('bg-green');
      $('#new_option').show();
      $('#new_auto').hide();
    }else{
      $('.new').addClass('bg-option');
      $('.new').removeClass('bg-green');
      $('#new_option').hide();
      $('#new_auto').show();
    }
  });
  $(document).on('click', '.sign_status3', function(){
    if($('#sign_status3').is(':checked')){
      $('.hot').removeClass('bg-option');
      $('.hot').addClass('bg-red');
      $('#hot_option').show();
      $('#hot_auto').hide();
    }else{
      $('.hot').addClass('bg-option');
      $('.hot').removeClass('bg-red');
      $('#hot_option').hide();
      $('#hot_auto').show();
    }
  });
  //--------------------------------------------------------------------------------add catagory----------------------------
  $(document).on('click', '.btnSendAddCat', function(){ 
    var name = $("#name_cat").val();
    var id_catagory = $('#sub_catagory').val();
      $.ajax({
        beforeSend: function() {
        // setting a timeout
          $('#loader_cat').show();
          $('#success_cat').hide();
        },
        complete: function() {
         $('#loader_cat').hide();
         $('#success_cat').show();
         fetch_data_cat_live_add();
        },
        type: "POST",
        url: "back_catagory-add.php",
        data: {name:name,sub_catagory:id_catagory},
        success: function(data) {
        fetch_data_cat();
        $('#name_cat').val('');
        },
      });
   });
  $(document).on('click', '.btnSendDeleteAll', function(){
    $.ajax({
        beforeSend: function() {
          $("#check-exists").show();
        },
        complete: function() {
          $("#modal-exists").modal('hide');
          $('#img-preview').attr('src', '../img/suit.jpg');
        },
        url:'select_data_DeleteAll.php',              
          success:function(data){
          fetch_btnremove();
          fetch_thumb();
        },  
    })
  })
  $(".normal").on('click', function(){
      // alert('normal');
      document.getElementById('tab1').checked = true;
  });
  $(".objective").on('click', function(){
      // alert('objective');
      document.getElementById('tab2').checked = true;
  });
  //------------------------------------------------------------------remove image all--------------------------------------------------
  $(document).on('click', '.remove', function(){
    $.ajax({
        beforeSend: function() {
                   $("#check_upload").show();
                },
                complete: function() {
                   $("#check_upload").hide();
                   $('#img-preview').attr('src', '../img/suit.jpg');
                },
                url:'select_data_DeleteAll.php',              
                success:function(data){
                  fetch_thumb();
                  fetch_btnremove();
                },  
    });
  });
  //---------------------------------------------------------------------drop area----------------
  $('.drop_area').on('dragenter', function (e) {
    e.preventDefault();
    e.stopPropagation();
  })
  $(".drop_area").on('dragover', function (e){
    e.preventDefault();
    e.stopPropagation();
  });

  $(".drop_area").on('drop', function (e){
    if (e.originalEvent.dataTransfer) {
      $('.progress-bar').attr('style', 'width: 0%').attr('aria-valuenow', '0').text('0%'); // Bootstrap progress bar at 0%
      if (e.originalEvent.dataTransfer.files.length) { // Check if we have files
        e.preventDefault();
        e.stopPropagation();
        // Launch the upload function
        upload(e.originalEvent.dataTransfer.files); // Access the dropped files with e.originalEvent.dataTransfer.files
      }
    }
   });

  function upload(files){ // upload function
    var fd = new FormData(); // Create a FormData object
    for (var i = 0; i < files.length; i++) { // Loop all files
      fd.append('files' + i, files[i]); // Create an append() method, one for each file dropped
    }
    fd.append('nbr_files', i); // The last append is the number of files
    
    $.ajax({ // JQuery Ajax
      beforeSend: function() {
        $('.progress').addClass('active');
      },
      type: 'POST',
      url: "back_product_add-thumbnail.php", // URL to the PHP file which will insert new value in the database
      data: fd, // We send the data string
      processData: false,
      contentType: false,
      success: function(data) {
        $('#img-preview').attr('src', '../../uploads/product/thumbnail/'+data);
        fetch_thumb(); //--------------refresh image area
        fetch_btnremove(); //----------refresh btn remove
        document.getElementById('frmADD_thumbnail').reset();//------------------refresh box // Display images thumbnail as result
        $('.progress-bar').attr('style', 'width: 100%').attr('aria-valuenow', '100').text('100%');
        $('.progress').removeClass('active'); // Progress bar at 100% when finish
      },
      xhrFields: { //
        onprogress: function (e) {
          if (e.lengthComputable) {
            var pourc = e.loaded / e.total * 100;
            $('.progress-bar').attr('style', 'width: ' + pourc + '%').attr('aria-valuenow', pourc).text(pourc + '%');
          }
        }
      },
    });
  }
  //----------------------------------------------------------------------------------------------

  //------------------------------------------------when your click drop_area---------------------
  $(document).on('click','.drop_image', function(){
    $('#files').trigger('click');
  });
  $(document).on('change', '#files', function(){
    var formData = new FormData($('.upload-form-add-thumbnail')[0]);
    // alert('555');
    $.ajax({
             beforeSend: function() {
              $("#check_upload").show();
              $('.progress-bar').attr('style', 'width: 0%').attr('aria-valuenow', '0').text('0%'); // Bootstrap progress bar at 0%
              },
              complete: function() {
              $("#check_upload").hide();
                },
              method: "POST",
              url: "back_product_add-thumbnail.php",
              data: formData,
              cache: false,
              contentType: false,
              processData: false,
              success: function(data) {
                $('.progress-bar').attr('style', 'width: 100%').attr('aria-valuenow', '100').text('100%');
                $('#img-preview').attr('src', '../../uploads/product/thumbnail/'+data);
                fetch_thumb(); //--------------refresh image area
                fetch_btnremove(); //----------refresh btn remove
                document.getElementById('frmADD_thumbnail').reset();//------------------refresh box
            },
            xhrFields: { //
            onprogress: function (e) {
              if (e.lengthComputable) {
                var pourc = e.loaded / e.total * 100;
                $('.progress-bar').attr('style', 'width: ' + pourc + '%').attr('aria-valuenow', pourc).text(pourc + '%');
              }
            }
          },
        });
  });
  $(document).on('click', '.check_cat', function(){
    var level = $(this).attr('data-lev');
    var id = $(this).val();
    var id_t = $(this).attr('data-top');
    if(level ==2){
      if($('.check_top2'+id).is(':checked')){
         $('.check_top1'+id_t).prop('checked', true);
      }else{
         $('.check_top3-ex2'+id).prop('checked', false);
      }
    }else if(level==3){
      if($('.check_top3'+id).is(':checked')){
        $('.check_top2'+id_t).prop('checked', true);
        var id_t2 = $('.check_top2'+id_t).attr('data-top');
        $('.check_top1'+id_t2).prop('checked', true);
      }else{
        
      }
    }else{
       if(!$('.check_top1'+id).is(':checked')){
         // alert(id);
        $('.check_top3-ex1'+id).prop('checked', false);
        $('.check_top2-ex1'+id).prop('checked', false);
       }
    }
  });

  $(document).on('change', '#transport', function(){
    if($('#transport').is(':checked')){
      $('#description_cut').hide();
    }else{
      $('#description_cut').show();
    }
  });

$(document).on('click', '.btnSendClear', function(){
  location.reload();
  })
function inputClear(){
            $('#name_product').val('');
            $('#product_name_ch').val('');
            $('#product_name_ch').val('');
            $('#SKU').val('');
            $('#selling_price').val('');
            $('#capital_cost').val('');
            $('#weight').val('');
            $('#id_branch').val('');
            $('#input-editor').val('');
            $('#input-editor_en').val('');
            $('#input-editor_ch').val('');
           // $("frm_attribute")[0].reset();
            //$("frm_attribute")[0].reset();
            location.reload();
        }
  //--------------------------------------------------------------------Add product----------------------------------------------------
 $(document).on('click', '.btnSendAdd', function(){
    var product_name = $('#name_product').val();
     var product_name_en = $('#product_name_en').val();
      var product_name_ch = $('#product_name_ch').val();
    var SKU = $('#SKU').val();
    var selling_price = $('#selling_price').val();
    var capital_cost = $('#capital_cost').val();
    var weight = $('#weight').val();
    var id_branch = $('#id_branch').val();

    var input_editor = $('#input-editor').val();
    var input_editor_en = $('#input-editor_en').val();
    var input_editor_ch = $('#input-editor_ch').val();

    var editor_ch_re = $('#input-editor_ch_re').val();
    var editor_en_re = $('#input-editor_en_re').val();
    var editor_re = $('#input-editor_re').val();
    

    var tab_mullti  = 0;
    if($('#tab_ch2').is(":checked")){
        tab_mullti = 1;
      }

    if($('#tab2').is(':checked')){
      var tab = "1";
      var a_price = $('.a_price').val();
      var a_price_normal = $('.a_price_normal').val();
      var a_color = $('.a_color').val();
      var a_size = $('.a_size').val();
      if(a_size == "" && a_color == ""){
        swal("คำเตือน", "คุณยังไม่ได้ไส่แบบสินค้า กรุณาใส่สีหรือขนาดและราคาเพื่อแจำแนกแบบสินค้า", "warning")
        return false;
      }
    }else{
      var tab = "0";
      if(SKU == ""){
        swal("คำเตือน", "คุณยังไม่ได้ไส่SKU", "warning")
        return false;
      }
       if(selling_price == ""){
        swal("คำเตือน", "คุณยังไม่ได้ไส่ราคาขาย", "warning")
        return false;
      }
       if(capital_cost == ""){
        swal("คำเตือน", "คุณยังไม่ได้ไส่ราคาทุน", "warning")
        return false;
      }
      /* if(weight == ""){
        swal("คำเตือน", "คุณยังไม่ได้ไส่น้ำหนัก", "warning")
        return false;
      }*/
       if(id_branch == "0"){
        swal("คำเตือน", "คุณยังไม่ได้เลือกสาขา", "warning")
        return false;
      }
    }

    if($(".check_cat:checked").length==0){ // ถ้าไม่มีการเลือก checkbox ใดๆ เลย  
        swal("คำเตือน", "คุณยังไม่ได้เลือกหมวดหมู่สินค้า", "warning")
        return false;
    }
   // if(!$('.discard').hasClass('overlay-cover')){
   //      swal({
   //        title: "ไม่มีรูปภาพ",
   //        text: "คุณยังไม่ได้เลือกรูปภาพสินค้า",
   //        imageUrl: '../img/noimage.png'
   //      });
   //      return false;
   //  }
    //---------------------------------------------------for id_catagory
    var count_cat = $('#count_cat').val();
    var id_catagory = '';
    for(var i=1;i<=count_cat;i++){
      if($('#id_product-catagory' + i).is(":checked")){
        var catagory_value = $('#id_product-catagory'+i).val();
        id_catagory += catagory_value+',';
      }
    }
    // alert(id_catagory);
    // alert(id_catagory);
    //---------------------------------------------------for id_status
    // var count_cat = $('#count_status').val();
    var sign_status = '';
    for(var i=1;i<=3;i++){
      if($('#sign_status' + i).is(":checked")){
        var sign_status_value = $('#sign_status'+i).val();
        sign_status += sign_status_value+',';
      }
    }
     // alert(sign_status);
    // alert(status);
    //----------------------------------------------------send value
    // var status = '';
    // for(var i=1;i<=5;i++){
    //   if($('#status' + i).is(":checked")){
    //     var status_value = $('#status'+i).val();   
    //   }
    // }
    // alert(status_value);
    //----------------------------------------------------send value
    var sign_ready  = 0;
    if($('#sign_ready').is(":checked")){
        sign_ready = 1;
      }
     swal({
      title: "ยืนยัน?",
      text: "ยืนยันการเพิ่มสินค้า",
      type: "info",
      showCancelButton: true,
      cancelButtonText: "ยกเลิก",
      confirmButtonText: "ยืนยัน",
      closeOnConfirm: false,
      showLoaderOnConfirm: true
    }, function () {
      $.ajax({
            type: "POST",
            url: "back_product_add.php",
            data: {
                   product_name: product_name,
                   product_name_en :product_name_en,
                   product_name_ch :product_name_ch,
                   SKU: SKU,
                   selling_price: selling_price,
                   capital_cost: capital_cost,
                   weight:weight,
                   id_catagory: id_catagory,
                   sign_status: sign_status,
                   id_branch: id_branch,
                   sign_ready: sign_ready,
                   input_editor: input_editor,
                   input_editor_en: input_editor_en,
                   input_editor_ch: input_editor_ch,
                   tab: tab,
                   editor_ch_re:editor_ch_re,
                   editor_en_re:editor_en_re,
                   editor_re:editor_re

                
                   // price_min:price_min,
                   // number_min:number_min,
                   // tran: transport,
                  },
                  success: function(data) {
                   //alert(data);
                   //inputClear();
                     
                  var id = data;
                  var SKU_1 = $('#SKU_1').val();
                  var formData = new FormData($('#frm_attribute')[0]);
                  
                      $.ajax({
                        complete: function() {
                          swal({
                              title: "บันทึกสำเร็จ",
                              text: "ไปหน้าจัดการสินค้าหรือไม่?",
                              type: "success",
                              showCancelButton: true,
                              confirmButtonClass: "btn-info",
                              cancelButtonText: "เพิ่มสินค้าต่อ",
                              confirmButtonText: "ไปหน้าจัดการ",
                              closeOnConfirm: false
                            },
                          
                            function(result){
                              if (result==true) {
                             window.location.href = 'front-manage.php';
                           }if (result==false) {
                            location.reload();
                           }
                            });
                        },
                        method: "POST",
                        url: "back_product_add-attribute.php?id="+id+"&&SKU_1="+SKU_1+"&&tab_mullti="+tab_mullti+"&&id_branch="+id_branch,
                        //+"&&SKU_1="+SKU_1+"&&tab_mullti="+tab_mullti
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(test) {
                          console.log(test);
                           //alert(test);
                        },
                      });
                  
                      $.ajax({
                        complete: function() {
                          swal({
                              title: "บันทึกสำเร็จ",
                              text: "ไปหน้าจัดการสินค้าหรือไม่?",
                              type: "success",
                              showCancelButton: true,
                              confirmButtonClass: "btn-info",
                              cancelButtonText: "เพิ่มสินค้าต่อ",
                              confirmButtonText: "ไปหน้าจัดการ",
                              closeOnConfirm: false
                            },
                            function(){
                              window.location.href = 'front-manage.php';
                            });
                        },
                        method: "POST",
                        url: "back_product_add-attribute.php?id="+id,
                        data: {
                                price: price,
                                normal: normal,
                                SKU: SKU,
                                stock: stock,
                                weight: weight
                             },
                        success: function(test) {
                         // alert(test);
                        },
                      });
              
              fetch_thumb();
            },
        });
    });
  });
  $(document).on('click', '.del-thumb', function(){
    var id = $(this).attr('data-id');
    $.ajax({
        type:"POST",
        url:'back_product-delthumb.php',
        data: 'id='+id,             
        success:function(data){
          if($('#active'+id).is(":checked")){
            $('#img-preview').attr('src', '../../uploads/product/thumbnail/'+data);
          }
          if(data==''){
            $('#img-preview').attr('src', '../img/suit.jpg');
          }
          // alert(data);
          fetch_thumb(); 
          fetch_btnremove();
          },
        });
  });
  $('body').on('click','.image-preview',function(){
    var id = $(this).attr('data-id');
    var name = $(this).attr('data-name');
    $('#img-preview').attr('src', '../../uploads/product/thumbnail/'+name);
    $('.discard').removeClass('overlay-cover');
    $('.text-image').hide();
    // $('.text'+id).fadeIn('slow');
    $('.text'+id).show();
    $('.overlay-image'+id).show();
    $('.overlay-image'+id).addClass('overlay-cover');
    document.getElementById('active'+id).checked = true;
    $.ajax({
        beforeSend: function() {
        $("#check_active"+id).show();
        $("#check_active_true"+id).hide();
        },
        complete: function() {
        $("#check_active"+id).hide();
        $("#check_active_true"+id).show();
        },
        type:"POST",
        url:'back_product-updateactive.php',
        data: 'id='+id,             
        success:function(data){
          // alert(data);
          fetch_thumb(); 
          fetch_btnremove();
          },
        });
  })   
  $(document).on('click', '.del-attribute', function(){
    var id = $(this).attr('data-id');
    document.getElementById('chk'+id).checked = true;
    try {
      var table = document.getElementById('table-attribute');
      var rowCount = table.rows.length;
      for(var i=0; i<rowCount; i++) {
        var row = table.rows[i];
        var chkbox = row.cells[3].childNodes[0];
        if(null != chkbox && true == chkbox.checked) {
          table.deleteRow(i);
          rowCount--;
          i--;
        }


      }
      }catch(e) {
        alert(e);
      }
  });
//----------------------------------------------------add tr-----------------------------------------------------------------------
$(document).on('click','.add-row',function(){
  var attribute_text = $('#attribute_text').val();
  var attribute_head = $('#attribute_head').val();
  $.ajax({
      url: "back_add-show-attribute.php",
      method: "POST",
      data: {head:attribute_head,
             text:attribute_text},
      success:function(data){
        i=1;
        //--------------------------------------------------------------นับ จำนวน-------------------------------------------------
        $('.variants_change').each(function(){
          i++;
        });
        //--------------------------------------------------------------นับ จำนวน-------------------------------------------------
        var markup ='';
        markup += "<tr>";
        markup += '<td align="center"><input type="checkbox" name="" value="'+attribute_text+'" data-idhead="'+data.status+'" data-attr="'+attribute_head+'" class="smtp_changes'+i+' variants_change variants_num_check'+i+'">';
        markup += '<td>'+attribute_head+'</td>';
        markup += '<td><input type="text" value="'+attribute_text+'" data-idhead="'+data.status+'" id="tags" data-role="tagsinput" data-smtp="'+i+'" class="tagss form-control" style="border:none;"></td></tr>';
       
        $(".show-attribute").append(markup);
        $('#attribute_text').val('');
        $('#attribute_head').val('');
        $('#attribute_text').tagsinput('removeAll');
        $.getScript("https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js");
      }
  });
});

$(document).on('click', '.check_value', function(){
  var i = $(this).attr('data-id');
  if($(this).is(':checked')){
    $('#option_check_hidden'+i).val('1');
  }else{
    $('#option_check_hidden'+i).val('0');
  }
});
//---------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------tag it-----------------------------------------------------------------------
   $(document).on('change','.tagss',function(){
      var i = $(this).attr('data-smtp');
      var val_smtp = $(this).val();
      $('.smtp_changes'+i).val(val_smtp);
      if(val_smtp==''){
          $('.smtp_changes'+i).prop("disabled", true);
          $('.smtp_changes'+i).prop("checked", false);
        }else{
          $('.smtp_changes'+i).prop("disabled", false);
          $('.smtp_changes'+i).prop('checked', true);
        }
        var cook = '';
        var array_push ='';
        var text_id ='';
        $('.variants_change').each(function() {
            if($(this).is(":checked")){
              var id_attr_head = $(this).attr('data-idhead');
              text_id += id_attr_head+',';
              var text_push = $(this).val();
              array_push += text_push+'||';
            }
          });
          $('.id_attr_head').val(text_id);
          var array_cut_head = array_push.split("||");
          // alert(array_cut_head.length)

          if($('.variants_change').is(':checked')){
            var sum = 1;
            var allArrays = [];
            for(var i =0;i< array_cut_head.length-1;i++){ // ตัดออกมา เหลือ 2
              var num = array_cut_head[i].split(',');
              var text_for_push = '';
              for(var a =0; a< num.length;a++){
                if(a==num.length-1){
                  text_for_push += num[a]+',';
                }else{
                  text_for_push += num[a]+',-';
                }
                
              }             
               // num = ตัด , ออกจะได้ จะได้เป็นอาเรย์
              var cut_text_for_push = text_for_push.split('-');
              allArrays.push(cut_text_for_push);         // num[i] คือ อาเรย์ที่ จะเก็บค่าข้างใน
              x = num.length;
              sum *= x;
            }
            // var allArrays = new Array(['a', 'b'], ['c', 'z'], ['d', 'e', 'f']);

            function getPermutation(array, prefix) {
                prefix = prefix || '';
                if (!array.length) {
                    return prefix;
                }

                var result = array[0].reduce(function (result, value) {
                    return result.concat(getPermutation(array.slice(1), prefix + value));
                }, []);
                return result;
            }

              var r = getPermutation(allArrays);
              console.log(allArrays);
              // return false;        // alert(sum);
              for(var a=0;a<sum;a++){      
                // if(num-a == 1){
                  cook += '<tr>';
                  cook +=   '<td><label>';
                  cook +=     '<img src="https://www.igetweb.com/themes_v2/assets/img/default-img.png" ';
                  cook +=     'class="variant-img'+a+' item-list-img default-img" style="width:40px; cursor:pointer;">';  
                  cook +=     '<input type="file" class="image_upload" data-id="'+a+'" style="display:none;" name="attr_file[]"></label>';                                             
                  cook +=   '</td>';
                  cook +=   '<td>';
                  var text_label = r[a].split(',');
                  var val_text =''
                  for(var i=0;i< text_label.length-1;i++){
                    if(i==text_label.length-2){
                      val_text +=text_label[i];
                    }else{
                      val_text +=text_label[i]+'/';
                    }
                  cook += '<small class="label pull-left bg-option1" style="margin-right: 5px; margin-bottom:5px;">'+text_label[i]+'</small>';
                  }
                  cook += '<input type="hidden" value="'+val_text+'" name="option_attr[]" >';
                  cook += '<input type="hidden" name="attr_head[]" value="" class="id_attr_head">';
                  cook +=   '</td>';
                  cook +=   '<td>';
                  cook +=      '<div class="input-group input-group-sm">';
                  cook +=         '<input type="text" name="price[]" value="" class="form-control" >';
                  cook +=           '<span class="input-group-addon" style="padding:5px;">THB</span>';
                  cook +=      '</div>';                                                                                                                            
                  cook +=   '</td>';
                  cook +=   '<td>';
                  cook +=      '<div class="input-group input-group-sm">';
                  cook +=         '<input type="text" name="normal[]" value="" class="form-control" >';
                  cook +=           '<span class="input-group-addon" style="padding:5px;">THB</span>';
                  cook +=      '</div>';    
                  cook +=   '</td>';
                  cook +=   '<td>';
                  cook +=      '<input type="text" class="form-control input-sm" name="SKU[]">';
                  cook +=   '</td>';
                  cook +=   '<td>';
                  cook +=      '<input name="stock[]" type="text" class="form-control input-sm" style="max-width:45px; padding-left:0; padding-right:0;">';
                  cook +=   '</td>';
                  cook +=   '<td>';
                  cook +=      '<div class="input-group input-group-sm">';
                  cook +=         '<input name="weight[]" type="text" name="" value="" class="form-control" >';
                  cook +=           '<span class="input-group-addon" style="padding:5px;">g</span>';
                  cook +=      '</div>';    
                  cook +=   '</td>';
                  cook +=   '<td style="text-align:center; width:60px; max-width:60px;">';
                  cook +=      '<input name="" type="checkbox" checked="check" value="1" data-id="'+a+'" class="check_value">';
                  cook +=      '<input name="show[]" type="checkbox" checked id="option_check_hidden'+a+'" value="1" hidden>';
                  cook +=   '</td>';
                }
                $('.dev-product-variant-render').show();
                $('.empty-message').hide();
                $('.dev-product-variant-render').html(cook);  
              }else{
                 $('.dev-product-variant-render').hide();
                 $('.empty-message').show();
              }
            $('.id_attr_head').val(text_id);
          
    });
//---------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------!!tag it---------------------------------------------------------------------

//----------------------------------------------------generate variants------------------------------------------------------------
  $(document).on('click','.variants_change', function(){
    var cook = '';
    var array_push ='';
    var text_id ='';
    $('.variants_change').each(function() {
        if($(this).is(":checked")){
          var id_attr_head = $(this).attr('data-idhead');
          text_id += id_attr_head+',';
          var text_push = $(this).val();
          array_push += text_push+'||';
        }
      });
      var array_cut_head = array_push.split("||");
      // alert(array_cut_head.length)

      if($('.variants_change').is(':checked')){
        var sum = 1;
        var allArrays = [];
        for(var i =0;i< array_cut_head.length-1;i++){ // ตัดออกมา เหลือ 2
          var num = array_cut_head[i].split(',');
          var text_for_push = '';
          for(var a =0; a< num.length;a++){
            if(a==num.length-1){
              text_for_push += num[a]+',';
            }else{
              text_for_push += num[a]+',-';
            }
            
          }             
           // num = ตัด , ออกจะได้ จะได้เป็นอาเรย์
          var cut_text_for_push = text_for_push.split('-');
          allArrays.push(cut_text_for_push);         // num[i] คือ อาเรย์ที่ จะเก็บค่าข้างใน
          x = num.length;
          sum *= x;
        }
        // var allArrays = new Array(['a', 'b'], ['c', 'z'], ['d', 'e', 'f']);

        function getPermutation(array, prefix) {
            prefix = prefix || '';
            if (!array.length) {
                return prefix;
            }

            var result = array[0].reduce(function (result, value) {
                return result.concat(getPermutation(array.slice(1), prefix + value));
            }, []);
            return result;
        }

          var r = getPermutation(allArrays);
          console.log(allArrays);
          // return false;        // alert(sum);
          for(var a=0;a<sum;a++){      
            // if(num-a == 1){
              cook += '<tr>';
              cook +=   '<td><label>';
              cook +=     '<img src="https://www.igetweb.com/themes_v2/assets/img/default-img.png" ';
              cook +=     'class="variant-img'+a+' item-list-img default-img" style="width:40px; cursor:pointer;">';  
              cook +=     '<input type="file" class="image_upload" data-id="'+a+'" style="display:none;" name="attr_file[]"></label>';                                  
              cook +=   '</td>';
              cook +=   '<td>';
              var text_label = r[a].split(',');
              var val_text =''
              for(var i=0;i< text_label.length-1;i++){
                if(i==text_label.length-2){
                  val_text +=text_label[i];
                }else{
                  val_text +=text_label[i]+'/';
                }
              cook += '<small class="label pull-left bg-option1" style="margin-right: 5px; margin-bottom:5px;">'+text_label[i]+'</small>';
              }
              cook += '<input type="hidden" value="'+val_text+'" name="option_attr[]">';
              cook += '<input type="hidden" name="attr_head[]" value="" class="id_attr_head">';
              cook +=   '</td>';
              cook +=   '<td>';
              cook +=      '<div class="input-group input-group-sm">';
              cook +=         '<input type="text" name="price[]" value="" class="form-control" >';
              cook +=           '<span class="input-group-addon" style="padding:5px;">THB</span>';
              cook +=      '</div>';                                                                                                                            
              cook +=   '</td>';
              cook +=   '<td>';
              cook +=      '<div class="input-group input-group-sm">';
              cook +=         '<input type="text" name="normal[]" value="" class="form-control" >';
              cook +=           '<span class="input-group-addon" style="padding:5px;">THB</span>';
              cook +=      '</div>';    
              cook +=   '</td>';
              cook +=   '<td>';
              cook +=      '<input type="text" class="form-control input-sm" name="SKU[]">';
              cook +=   '</td>';
              // cook +=   '<td>';
              // cook +=      '<input type="text" name="stock[]" class="form-control input-sm" style="max-width:45px; padding-left:0; padding-right:0;">';
              // cook +=   '</td>';
              cook +=   '<td>';
              cook +=      '<div class="input-group input-group-sm">';
              cook +=         '<input type="text" name="weight[]" value="" class="form-control" >';
              cook +=           '<span class="input-group-addon" style="padding:5px;">g</span>';
              cook +=      '</div>';    
              cook +=   '</td>';
              cook +=   '<td style="text-align:center; width:60px; max-width:60px;">';
              cook +=      '<input name="" type="checkbox" checked="check" value="1" data-id="'+a+'" class="check_value">';
              cook +=      '<input name="show[]" type="checkbox" checked id="option_check_hidden'+a+'" value="1" hidden>';
              cook +=   '</td>';
            }
            $('.dev-product-variant-render').show();
            $('.empty-message').hide();
            $('.dev-product-variant-render').html(cook);  
          }else{
             $('.dev-product-variant-render').hide();
             $('.empty-message').show();
          }
          $('.id_attr_head').val(text_id);
    
    });
  $(document).on('change','.image_upload',function(){
    var i = $(this).attr('data-id');
        readURL_upload(this,i);
    });    
}); 
//---------------------------------------------------- preview image----------------------------------
function readURL_upload(input,i) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.variant-img'+i).attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
//----------------------------------------------------------------------------------------------------
// Open the Modal
// function openModal() {
//   document.getElementById('myModal').style.display = "block";
// }

// // Close the Modal
// function closeModal() {
//   document.getElementById('myModal').style.display = "none";
// }

// var slideIndex = 1;
// showSlides(slideIndex);

// // Next/previous controls
// function plusSlides(n) {
//   showSlides(slideIndex += n);
// }

// // Thumbnail image controls
// function currentSlide(n) {
//   showSlides(slideIndex = n);
// }

// function showSlides(n) {
//   var i;
//   var slides = document.getElementsByClassName("mySlides");
//   var dots = document.getElementsByClassName("demo");
//   var captionText = document.getElementById("caption");
//   if (n > slides.length) {slideIndex = 1}
//   if (n < 1) {slideIndex = slides.length}
//   for (i = 0; i < slides.length; i++) {
//     slides[i].style.display = "none";
//   }
//   for (i = 0; i < dots.length; i++) {
//     dots[i].className = dots[i].className.replace(" active", "");
//   }
//   slides[slideIndex-1].style.display = "block";
//   dots[slideIndex-1].className += " active";
//   captionText.innerHTML = dots[slideIndex-1].alt;
// }
function isNumber_n(evt) {
  evt = (evt) ? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      return false;
  }
    return true;
}
function isNumber_s(evt) {
  evt = (evt) ? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      return false;
  }
    return true;
}
// function Example(){
//   alert('555');
// }
function formatMoney_n(inum){ 
     // ฟังก์ชันสำหรับแปลงค่าตัวเลขให้อยู่ในรูปแบบ เงิน
    var s_inum=new String(inum.replace(/,/g, ""));
    if(s_inum != ""){
      $('#normal_price').show();
    }else{
      $('#normal_price').hide();
    }

    var num2=s_inum.split(".");
    var n_inum="";  
    if(num2[0]!=undefined){
        var l_inum=num2[0].length;  
        for(i=0;i<l_inum;i++){  
            if(parseInt(l_inum-i)%3==0){  
                if(i==0){  
                    n_inum+=s_inum.charAt(i);         
                }else{  
                    n_inum+=","+s_inum.charAt(i);         
                }     
            }else{  
                n_inum+=s_inum.charAt(i);  
            }  
        }  
    }else{
        n_inum=inum;
    }
    if(num2[1]!=undefined){
        n_inum+="."+num2[1];
    }
    $('#variant_price_normal').val(n_inum);
    $('#price_n').html(n_inum);
}
function formatMoney_s(inum){  // ฟังก์ชันสำหรับแปลงค่าตัวเลขให้อยู่ในรูปแบบ เงิน
    var s_inum=new String(inum.replace(/,/g, ""));
    var num2=s_inum.split(".");
    var n_inum="";  
    if(num2[0]!=undefined){
        var l_inum=num2[0].length;  
        for(i=0;i<l_inum;i++){  
            if(parseInt(l_inum-i)%3==0){  
                if(i==0){  
                    n_inum+=s_inum.charAt(i);         
                }else{  
                    n_inum+=","+s_inum.charAt(i);         
                }     
            }else{  
                n_inum+=s_inum.charAt(i);  
            }  
        }  
    }else{
        n_inum=inum;
    }
    if(num2[1]!=undefined){
        n_inum+="."+num2[1];
    }
    $('#variant_price').val(n_inum);
    $('#price_s').html(n_inum);
}
function show_text(val){
  var price = new String(val)
  if(price != ""){
      $("#price_text").show();
    }else{
      $('#price_text').hide();
    }
 $("#price_text").html(price);
}


function tickChk_status(i,a,b,c,active){
  $(".style").removeClass('check-active-'+a);
  $(".style").removeClass('check-active-'+b);
  $(".style").removeClass('check-active-'+c);
  $("#tickChk_status"+i).addClass('check-active-'+active);
  document.getElementById('status'+i).checked = true;
}
function checklength() {
  var input = document.getElementById("name_product") ;
    if(input.value.length > 0)
    {
      document.getElementById("btnSendAdd").disabled = false;
    }else{
    document.getElementById("btnSendAdd").disabled = true;
    }
}
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


   $("#tab_1").on('click', function(){
      document.getElementById('tab_ch1').checked = true;
  });
  $("#tab_mullti").on('click', function(){
      document.getElementById('tab_ch2').checked = true;
  });
         
</script>
</body>
</html>