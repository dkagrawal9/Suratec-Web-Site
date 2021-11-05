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
  <title>MCtive | Product</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link href="css/bootstrap-toggle.min.css" rel="stylesheet"> 
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="components/select/dist/css/bootstrap-select.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../plugins/iCheck/all.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css.map">
  <!-- Include external CSS. -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" type="text/css" href="css/modal_view.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">

  <style type="text/css">
    .header-attribute td{
      padding: 3px;
      border:1px solid #ddd;
    }
    .header-attribute th{
      padding: 8px;
      /*border:1px solid white;*/
      /*background-color: #ddd;*/
      background:#fcfcfc;
    }
    .control-label{
      padding-top: 7px;
      text-align: right;
      padding-right: 0px;
    }
    .normal-product{
      margin-bottom: 13px;
    }
/*    .table-attribute th,td{
      padding: 5px;
    }*/
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
    /*table tr,td{
      vertical-align: top;
      height: 50px;
      border-bottom:1px solid #efefef;
    }*/
    .form-group{
      margin-bottom: 5px;
    }
    .btn-default.active{
      border:none;
    }
  /*  .btn-default:hover{
      border:none;
    }*/
    .btn-primary.active{
      border:none;
    }
/*    .btn-primary:hover{
      border:none;
    }*/
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
    .remove-item{
      transition: 0.4s;
      background-color: #fff4f4;
    }
    .bootstrap-tagsinput{
      background-color: transparent;
    }
    tr:hover{
      background-color: #fcfcfc;
    }
    .attr_change{
      margin-top: 10px;
    }
    .overlay{
      position: absolute;
      width: 100%;
      height: 100%;
      top:0;
      left:0;
      background-color: rgba(255,255,255,0.7);
      cursor: pointer;
      z-index: 40;
    }
    .tag span{
      display: none;
    }
    .bootstrap-tagsinput input{
      display: none;
    }
    .border_check{
      border-color: orange;
    }
/*    .browse {
      margin: 10px 32%;
      color: white;
      padding: 8px 16px;
      border-radius: 5px;
      background: #09f;
    }*/
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
        เพิ่มสินค้า
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../index.php"></i> แดชบอร์ด</a></li>
        <li class="active">เพิ่มสินค้า</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-warning collapsed-box" >
        <div class="box-header with-border">
          <h3 class="box-title">คำแนะนำการใช้งาน</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
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
        <!-- /.box-body -->
      </div>
      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title">จัดการคุณลักษณะ
          </select></h3>
        </div>
        <form action="" name="frmMain" id="frmMain" method="post">
        <div class="box-body select_attribute" style="padding: 0;">
          
        </div>
      </div>
      <div class="boxsave">
            <button type="button" class="delmulti-menu btn btn-danger" style="transition: 0.4s;" id="MultiDelete" disabled><i class="fa fa-remove"></i> ลบรายการที่เลือก <span class="num_"></span></button>
            <!-- <button type="button" class="editmulti-menu btn btn-info" style="transition: 0.4s;" id="MultiEdit" disabled><i class="fa fa-edit"></i> แก้ไขรายการที่เลือก <span class="num_"></span></button> -->
            <button type="button" class="btn btn-success" style="transition: 0.4s;" id="Add-attribute"><i class="fa fa-plus"></i> เพิ่มคุณลักษณะ </button>
            </form>
      </div>

      <div class="col-md-8">
          <div style="margin-bottom: 5px;">
            <div class="row">
              <div class="col-md-5">
                <div class="input-group">
                  <span class="input-group-btn">
                    <button class="btn btn-default show-widget" style="font-size: 18px; margin-right: 5px; border-radius: 0"><i class="fa fa-th pull-right" style="margin: 0;"></i></button>
                    <button class="btn btn-default show-list" style="font-size: 18px; margin-right: 5px;"><i class="fa fa-th-list pull-right" style="margin: 0;"></i></button>
                  </span>
                  <input type="text" name="q" class="form-control" placeholder="Search..." id="search-jquery">
                  <span class="input-group-btn">
                    <button name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="box box-default list_catagory" style="display: none;">
            <div class="box-header">
              <h3 class="box-title">หมวดหมู่สินค้าทางร้าน</h3>
            </div>
            <div class="box-body" style="padding: 0;">
               <form action="" name="frmMain" id="frmMain" method="post">
                <div id="catagory"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <div class="widget_catagory">
              <form action="" name="frmMain" id="frmMain" method="post">
                <div id="catagory-widget"></div>
          </div>
          <!-- /.box -->
        </div>

  <div class="control-sidebar-bg"></div>
</div>
<div class="modal fade" id="modal-default-add">
  <div class="modal-dialog">
    <div class="modal-content">
      <div id="check_upload" class="overlay overlay-add" style="display: none;">
      </div>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">เพิ่มคุณลักษณะ</h4>
      </div>
<form id="frm_attribute" method="post">
      <div class="modal-body">       
        <h4 style="color: gray;"><i class="fa fa-pencil"></i> ชื่อคุณลักษณะ</h4>
        <div class="row alert-massage" style="padding-left: 22.5px; display: none;" id="alert-inclease">
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
              <input type="text" class="form-control" placeholder="ภาษาไทยที่ใช้แสดง" name="name_head_th" id="check_th_head">
              <!-- /btn-group -->
            </div>
          </div>
          <div class="col-lg-6">
            <div class="input-group">
              <span class="input-group-addon" style="background-color: #ddd;">
                <img class="flag-lang" src="../img/en-fl.jpg" width="22" height="15">
              </span>
              <input type="text" class="form-control" placeholder="ภาษาอังกฤษที่ใช้แสดง" name="name_head_en" id="">
              <!-- /btn-group -->
            </div>
          </div>
        </div>
        <div class="row" style="padding-left: 22.5px; margin-top: 10px;">
          <div class="col-lg-6">
              <textarea class="form-control" placeholder="คำอธิบายคุณลักษณะ" name="name_head" id=""></textarea>
              <!-- /btn-group -->
          </div>
        </div>
      </div>
      <div class="box-footer" style="padding: 15px;">
        <h4 style="color: gray;"><i class="fa fa-pencil"></i> ตัวเลือกคุณลักษณะ</h4>
        <div class="row inclease_attr_show" style="padding-left: 22.5px;">
          <div class="form-group">
            <div class="col-lg-6">
              <div class="input-group" style="margin-bottom:10px;">
                <span class="input-group-addon">
                  <img class="flag-lang" src="../img/th-fl.png" width="22" height="15">
                </span>
                <input type="text" class="form-control" placeholder="ภาษาไทย" name="name_attr_th[]" id="">
                <!-- /btn-group -->
              </div>
            </div>
            <div class="col-lg-6">
              <div class="input-group" style="margin-bottom:10px;">
                <span class="input-group-addon">
                  <img class="flag-lang" src="../img/en-fl.jpg" width="22" height="15">
                </span>
                <input type="text" class="form-control" placeholder="ภาษาอังกฤษ" name="name_attr_en[]" id="" >
                <!-- /btn-group -->
              </div>
            </div>
          </div>
        </div>
        <span class="btn btn-success" id="inclease_attr" style="margin-left: 22.5px; margin-top: 10px;"><i class="fa fa-plus"></i> เพิ่มตัวเลือก</span>
      </div>
</form>
      <div class="box-footer">
        <button class="btn btn-info pull-right btn-send-add">
          <i class="fa fa-spinner fa-spin" id="loader-hide" style="color: white; display: none;"></i> 
          <i class="fa fa-check" id="loader-show"></i> 
          บันทึก
        </button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- change icon -->
        <div class="modal" id="modal-ch-icon">
          <div class="modal-dialog modal-chicon">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                  aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">เลือกไอคอน</h4>
              </div>
              <div class="modal-body" style="padding: 0;">
                <input type="hidden" name="" id="id_catagory" class="form-control">
<?php require_once 'select-icon.php'; ?>
              </div>
              <!--/.modal-body-->
            </div><!-- /.modal-content -->
          </div>
        </div>

         <div class="modal" id="modal-ch-icon-edit">
          <div class="modal-dialog modal-chicon">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                  aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">เลือกไอคอน</h4>
              </div>
              <div class="modal-body">
<?php require_once 'select-icon-edit.php'; ?>
              </div>
              <!--/.modal-body-->
            </div><!-- /.modal-content -->
          </div>
        </div>
<!-- /.modal -->
<div class="modal fade" id="modal-default-edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div id="check_upload" class="overlay overlay-edit"  style="display: none;">
      </div>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-edit"></i> แก้ไขคุณลักษณะ</h4>
      </div>
<form id="frm_attribute_edit" method="post">
      <div id="live_edit-attribute-modal">       
      </div>
</form>
      <div class="box-footer">
          <button class="btn btn-info pull-right btn-send-edit">
            <i class="fa fa-spinner fa-spin" id="loader-hide-edit" style="color: white; display: none;"></i> 
            <i class="fa fa-check" id="loader-show-edit"></i> บันทึก</button>
        </div>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<!-- ./wrapper -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script src="components/select/dist/js/bootstrap-select.js"></script>
<script>
  $(document).ready(function () {

     //------------------------------------------------------------fetch data category-------------------------------------------------------
        function fetch_data_catagory()  
          {  
              $.ajax({  
                  url:"select_cat-front.php",  
                  method:"POST",  
                  success:function(data){  
              $('#catagory').html(data);  
                  }  
              });  
          }  
          
          fetch_data_catagory();
          //------------------------------------------------------------fetch data category-------------------------------------------------------
        function fetch_data_catagory_widget()  
          {  
              $.ajax({  
                  url:"select_cat-front-widget.php",  
                  method:"POST",  
                  success:function(data){  
              $('#catagory-widget').html(data);  
                  }  
              });  
          }  
          fetch_data_catagory_widget();

          //---------------------------------------fetch add menu for refresh ajax---------------------------------------------------------------
          function fetch_add()  
          {  
              $.ajax({  
                  url:"select_add-catagory.php",  
                  method:"POST",  
                  success:function(data){  
              $('#live-add').html(data);  
                  }  
              });  
          } 
          fetch_add();
          //---------------------------------------fetch add menu for refresh ajax---------------------------------------------------------------
          function fetch_cat_add()  
          {  
              $.ajax({  
                  url:"select_cat-fetch-add.php",  
                  method:"POST",  
                  success:function(data){  
                    $('#live_cat-add').html(data);    
                  }  
              });  
          } 

          $(document).on('click', '.open-sub', function () {
              var id = $(this).attr('data-id');
            $('.box-tr'+id).slideToggle();
          });


    $('.sidebar-menu').tree();
    //----------------------------------------------------add tr-----------------------------------------------------------------------
    $(document).on('click','#Add-attribute', function(){
      $('#modal-default-add').modal('show');
    });
    $(document).on('click','.edit-row', function(){
      var id = $(this).attr('data-id');
      $.ajax({
          url: "select_edit-attribute-modal.php",
          method: "POST",
          data: {id:id},
          success:function(data){
            $('#live_edit-attribute-modal').html(data);
            $('#modal-default-edit').modal('show');
          }
       });
      
    });
    $(document).on('click','.add-row',function(){
      var attribute_text = $('#attribute_text').val();
      var attribute_head = $('#attribute_head').val();
      var attribute_head_show = $('#attribute_head_show').val();
      $.ajax({
          url: "back_add-show-attribute.php",
          method: "POST",
          data: {head:attribute_head,
                 text:attribute_text,
                 head_show:attribute_head_show},
          success:function(data){
            fetch_data_attribute();
            $('#attribute_text').val('');
            $('#attribute_head').val('');
            $('#attribute_text').tagsinput('removeAll');
          }
       });
    });

    $(document).on('click','#inclease_attr',function(){
      var i=0;
      $('.num_s').each(function() {
        i++;
      });
      var markup = '';
      markup += '     <div class="form-group num_s num_ss'+i+'" >';
      markup += '      <div style="position: relative; color: gray; margin-left: -7px;">';
      markup += '        <span style="cursor:pointer;" class="del_attr_temp" data-id="'+i+'"><i class="fa fa-remove"></i></span>';
      markup += '      </div>';
      markup += '      <div class="col-lg-6" style="margin-top:-15px;">';
      markup += '        <div class="input-group" style="margin-bottom:10px;">';
      markup += '          <span class="input-group-addon">';
      markup += '            <img class="flag-lang" src="../img/th-fl.png" width="22" height="15">';
      markup += '          </span>';
      markup += '          <input type="text" class="form-control" placeholder="ภาษาไทย" name="name_attr_th[]" id="" >';
      markup += '          <!-- /btn-group -->';
      markup += '        </div>';
      markup += '      </div>';
      markup += '      <div class="col-lg-6" style="margin-top:-15px;">';
      markup += '        <div class="input-group" style="margin-bottom:10px;">';
      markup += '          <span class="input-group-addon">';
      markup += '            <img class="flag-lang" src="../img/en-fl.jpg" width="22" height="15">';
      markup += '          </span>';
      markup += '          <input type="text" class="form-control" placeholder="ภาษาอังกฤษ" name="name_attr_en[]" id="">';
      markup += '          <!-- /btn-group -->';
      markup += '        </div>';
      markup += '      </div>';
      markup += '    </div>';
      $('.inclease_attr_show').append(markup);
    });

    $(document).on('click','#inclease_attr_edit',function(){
      var i=0;
      $('.num_s_edit').each(function() {
        i++;
      });
      var markup = '';
      markup += '     <div class="form-group num_s num_ss'+i+'" >';
      markup += '      <div style="position: relative; color: gray; margin-left: -7px;">';
      markup += '        <span style="cursor:pointer;" class="del_attr_temp" data-id="'+i+'"><i class="fa fa-remove"></i></span>';
      markup += '      </div>';
      markup += '      <div class="col-lg-6" style="margin-top:-15px;">';
      markup += '        <div class="input-group" style="margin-bottom:10px;">';
      markup += '          <span class="input-group-addon">';
      markup += '            <img class="flag-lang" src="../img/th-fl.png" width="22" height="15">';
      markup += '          </span>';
      markup += '          <input type="text" class="form-control" placeholder="ภาษาไทย" name="name_attr_th_inclease[]" id="" >';
      markup += '          <!-- /btn-group -->';
      markup += '        </div>';
      markup += '      </div>';
      markup += '      <div class="col-lg-6" style="margin-top:-15px;">';
      markup += '        <div class="input-group" style="margin-bottom:10px;">';
      markup += '          <span class="input-group-addon">';
      markup += '            <img class="flag-lang" src="../img/en-fl.jpg" width="22" height="15">';
      markup += '          </span>';
      markup += '          <input type="text" class="form-control" placeholder="ภาษาอังกฤษ" name="name_attr_en_inclease[]" id="">';
      markup += '          <!-- /btn-group -->';
      markup += '        </div>';
      markup += '      </div>';
      markup += '    </div>';
      $('.inclease_attr_show_edit').append(markup);
    });



    $(document).on('click', '.btn-send-add', function(){
       var formData = new FormData($('#frm_attribute')[0]);
       if($('#check_th_head').val()==''){
        $('#alert-inclease').fadeIn();
        $('#check_th_head').addClass('border_check');
        return false;
       }
      $.ajax({
        beforeSend:function(){
          $('.overlay-add').show();
          $('#loader-hide').show();
          $('#loader-show').hide();
        },
        complete: function() {
          $('.overlay-add').hide();
          $('#loader-hide').hide();
          $('#loader-show').show();
          $('#alert-inclease').hide();
          $('#check_th_head').removeClass('border_check');
          $('#modal-default-add').modal('hide');
          swal("สำเร็จ", "เพิ่มคุณลักษณะเรียบร้อยแล้ว", "success");
          $('#frm_attribute')[0].reset();
          $('.num_s').remove();
        },
        method: "POST",
        url: "back_add-show-attribute.php",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(test) {
          fetch_data_attribute();
          // alert(test);
        },
      });
    });

     $(document).on('click', '.btn-send-edit', function(){
       var formData = new FormData($('#frm_attribute_edit')[0]);
      $.ajax({
        beforeSend:function(){
          $('.overlay-edit').show();
          $('#loader-hide-edit').show();
          $('#loader-show-edit').hide();
        },
        complete: function() {
          $('.overlay-edit').hide();
          $('#loader-hide-edit').hide();
          $('#loader-show-edit').show();
          $('#modal-default-edit').modal('hide');
          swal("สำเร็จ", "แก้ไขคุณลักษณะเรียบร้อยแล้ว", "success");
          $('#frm_attribute')[0].reset();
          $('.num_s').remove();
        },
        method: "POST",
        url: "back_edit-show-attribute.php",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(test) {
          // alert(test);
          fetch_data_attribute();
        },
      });
    });

    $(document).on('click', '.del_attr_temp',function(){
      var i = $(this).attr('data-id');
      $('.num_ss'+i).remove();
    });

    $(document).on('click', '.del_attr_temp_edit',function(){
      var i = $(this).attr('data-id');
      var id_sub = $(this).attr('data-idattr');
      var old_sub = $('#edit_delete').val();
      if(old_sub!=''){
        old_sub += ',';
      }else{
        old_sub ='';
      }
      $('#edit_delete').val(old_sub+id_sub);
      $('.num_ss_edit'+i).remove();
    });

    $(document).on('change','.tagss',function(){
      var i = $(this).attr('data-smtp');
      var val_smtp = $(this).val();
      var id_head = $(this).attr('data-idhead');
      $('.smtp_changes'+i).val(val_smtp);
    });

    $(document).on('click','.del-row', function(){
      var id = $(this).attr('data-id');
      swal({
        title: "ยืนยัน?",
        text: "ยืนยันการลบคุณลักษณะ",
        type: "info",
        showCancelButton: true,
        cancelButtonText: "ยกเลิก",
        confirmButtonText: "ยืนยัน",
        confirmButtonClass: "btn-info",
        closeOnConfirm: false,
        showLoaderOnConfirm: true
      }, function () {
        $.ajax({
          complete:function(){
            swal("สำเร็จ", "ลบคุณลักษณะเรียบร้อยแล้ว", "success");
          },
          url: "back_del-show-attribute.php",
          method: "POST",
          data: {id:id},
          success:function(data){
          fetch_data_attribute();
          }
        });
      });
    });

    //---------------------------------------Alert modal for notification of delete multiple--------------------------------------------------
    $(document).on('click', '#MultiDelete', function () {
        swal({
          title: "ยืนยัน?",
          text: "คุณแน่ใจหรือจะลบคุณลักษณะที่เลือก",
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "ยกเลิก",
          confirmButtonClass: "btn-danger",
          confirmButtonText: "ยืนยัน",
          closeOnConfirm: false,
          showLoaderOnConfirm: true
          }, function () {
          $.ajax({
          complete: function() {
            swal("สำเร็จ", "ลบคุณลักษณะเรียบร้อยแล้ว", "success");
          },
          type: "POST",
          url: "back_del-show-attribute.php",
          data: $("#frmMain").serialize(),
          success: function(data) {
            fetch_data_attribute();
          },
        });
      });
    });
  });
  function fetch_data_attribute(){  
    $.ajax({  
      url:"select_show-attribute.php",  
      method:"POST",  
      success:function(data){  
      // $.getScript("https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js");
      $('.select_attribute').html(data);  
      }  
    });  
  }       
  fetch_data_attribute();
  //----------------------------------------------Click Check all--------------------------------------------------------------------------------
  function ClickCheckAll(vol){
    var i=1;
    for(i=1;i<=document.frmMain.hdnCount.value;i++){
      $('.num_').html('[ '+i+' ]');
      if(vol.checked == true){
        eval("document.frmMain.Chk"+i+".checked=true");
        $(".show-tr").addClass("remove-item"); 
        $('#MultiDelete').prop('disabled',false);
        $('#MultiEdit').prop('disabled',false);
      }else{
        $('.num_').html('');
        eval("document.frmMain.Chk"+i+".checked=false");
        $('#MultiDelete').prop('disabled',true);
        $('#MultiEdit').prop('disabled',true);
        $(".show-tr").removeClass("remove-item");
      }
    }
  }
  //---------------------------------------------------Add Class---------------------------------------------------------------------------------
  $(document).on('click', '.checkbox_remove', function(){
    var i =0; 
    if($(this).is(":checked")) {
      $(this).parents('.show-tr').addClass("remove-item");
      $('#MultiDelete').prop('disabled',false);
      $('#MultiEdit').prop('disabled',false);
      $('.remove-item').each(function() {
        i++;       
      });
      $('.num_').html('[ '+i+' ]');
    }else{
      $(this).parents('.show-tr').removeClass("remove-item");
      $('.remove-item').each(function() {
        i++;       
      });
      $('.num_').html('[ '+i+' ]');
      if($('input.checkbox_remove').is(':checked')){
      }else{
        $('#MultiDelete').prop('disabled',true);
        $('#MultiEdit').prop('disabled',true);
      }
    }
  });
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
