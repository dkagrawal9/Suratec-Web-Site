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
    <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
   <!-- daterange picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
     <!-- Pace style -->
  <link rel="stylesheet" href="../plugins/pace/pace.min.css">
  <!--Css table -->
  <link rel="stylesheet" href="css/table-branch.css">
  <!--Css loader -->
  <!-- sweet alert -->
<link rel="stylesheet" href="../plugins/sweetalert2/dist/sweetalert2.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <style>
       .btn-paginate{
         background-color: white;
         border-color: #bcbcbc;
         transition: 0.6s;
       }
       .btn-paginate:hover{
         background-color: #bcbcbc;
         color: white;
       }
       .page-active
       {
         background-color: #bcbcbc;
         color: white;
       }

       .remove-item{
          background-color: #fff6f6 !important;
          transition: 0.4s; 
          color: red;
        }
        .remove-item:hover{
          background-color: #F5F5F5 !important;
          transition: 0.4s; 
          color: red;
        }
        .sweet-alert .sa-icon{
        margin-bottom: 35px;
        }
        .box-manage-product {
          box-shadow: 0 4px 8px 0 rgba(0,0,0,0.1);
          transition: 0.3s;
          float: left;
          background-color: white;
          max-width: 200px;
          height:320px;
          margin: auto;
          margin-bottom: 20px;
          margin-right: 15px;
          text-align: center;
        }
        .box-manage-product:hover {
          box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }

        .box-manage-title {
          color: grey;
          font-size: 18px;
        }
        .contain-control{
          border-top: 1px solid #d8d8d8;
          padding: 5px;
          height: 45px;
          margin:auto;
          /*height: 47px;
          background-color: rgba(0,0,0,.03);*/
        }
        .status_transport{
          padding-top: 2px;
          padding-right: 5px;
          height: 30px;
          background-color: #f9f9f9;
        }
        .status_transport label{
          float: right;
        }
        .status_transport img{
          margin:5px;
          float: left;
        }
        .contain-control .btn{
          border-radius: 0;
          float: right;
        }
        .contain-control .btn-edit{
          border-radius: 0;
          float: left;
        }
        .text-product{
          text-align: left;
          font-size: 16px;
          padding: 5px;
          padding-left: 5px;
          border-top: 1px solid #d8d8d8;
          margin:auto;
          height: 55px;
        }
        .text-product p{
          margin:0;
        }
        small{
          margin-right: 2px;
        }
        .text-detail{
          text-align: left;
          padding-left: 5px;
          /*height: 50px;*/
        }
        .image-product-attachment{
          font-size:0px; 
          width:200px; 
          height:130px; 
          position:relative;
          /*border-bottom:1px solid #d8d8d8;*/
        }
        /*-------------------------------------------list table*/
        .image-product-list{
         /* text-align: center;*/
          font-size:0px; 
          height:70px; 
          position:relative;
          /*border-bottom:1px solid #d8d8d8;*/
        }
        .image-product-list img{
          width:auto; 
          height:auto; 
          max-width:100%; 
          max-height:100%; 
          cursor: pointer;
        }
        /*------------------------------------------------------*/
        .image-product-attachment img{
          width:auto; 
          height:auto; 
          max-width:100%; 
          max-height:100%; 
          cursor: pointer;
        }
        .overlay-cover-del {
          position: absolute;
          width: 100%;
          height: 100%;
          top:0;
          left:0;
          background-color: rgb(255,255,255,0.7);
          cursor: pointer;
         /* transition: 0.5s;*/
        }
        .icon-del{
          display: none;
          position: absolute;
          top: 80%;
          left: 85%;
          font-size: 40px;
          color: #dd4b39;
          transform: translate(-50%,-50%);
          -ms-transform: translate(-50%,-50%);
        }
        .view_add i{
          transition: 0.3s;
        }
        .view_add i:hover{
          font-size: 130px;
        }
        .checkbox {
          margin:0;
        }
        .checkbox label{
          border:none;
        }
        .checkbox label:hover{
          border:none;
        }
        .checkbox label .toggle{
          margin-left: -20px;
          margin-right: 5px;
          width: 100px !important;
        }
        .changed_format i:hover{
          color: black !important;
        }
        .changed_format i{
          transition: 0.5s !important;
        }
        .sort-branch{
          transition: 0.4s;
          border-radius: 0;
        }
        .sort-branch:hover{
          background-color: #f6f8fa;
        }
        .sort-active{
          background-color: #ddd !important;
        }
       /* .show-calendar{
          left: 0 !important;
          right: auto !important;
        }*/
  @media screen and (min-width: 799px) { 
            body { 
                white-space:normal; 
                overflow-x: auto;
            }
        }
  </style>
</head>
<body class="hold-transition skin-blue fixed sidebar-mini " onload="startTime()">
<div class="wrapper">
   <?php require_once '../template/nav_menu.php'; ?>
   <?php require_once '../library/permission.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        จัดการร้านค้า
      </h1>
      <ol class="breadcrumb">
        <li><a href="../page_home/index.php"></i> แดชบอร์ด</a></li>
        <li class="active">จัดการร้านค้า</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
         <!--  <div class="box box-warning collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">คำแนะนำในการใช้งาน</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
              </div>
            </div>
              <div class="box-body">
                <div style="padding-left: 10px;">
                <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถแก้ไข/ลบ สินค้าได้โดยคลิกไอคอนใต้หัวข้อสินค้าที่ต้องการ<br>
                <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถดูตัวอย่างการแสดงผลสินค้าบนหน้าเว็บไซต์ ได้โดยคลิกไอคอน ดูตัวอย่าง<br> 
                <i class="fa fa-caret-right"></i>&nbsp;&nbsp;หากต้องการลบสินค้า มากกว่า 1 สิค้าพร้อมกัน สามารถคลิกเครื่องหมายถูกหน้าหัวข้อสินค้าที่ต้องการลบ และคลิกไอคอน ลบข้อมูลที่เลือก<br>
                <i class="fa fa-caret-right"></i>&nbsp;&nbsp;กรณีที่มีการลบข้อมูล ระบบจะขึ้นข้อความแจ้งเตือน เพื่อยืนยันการลบ หากทำการยืนยันเรียบร้อยแล้ว จะไม่สามารถกู้คืนข้อมูลได้<br>
                <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถเปิด/ปิด การแสดงผลสินค้าได้โดยคลิกไอคอนรูปตา สีเทา คือปิดการแสดงผล สีน้ำเงิน คือเปิดการแสดงผล<br>
                <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถเลือกปักหมุดสินค้าที่สำคัญ ไว้บนสุดของการแสดงผลสินค้าทั้งหมดได้ <br>
                <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถดูวันที่แก้ไขสินค้าล่าสุดได้<br>
                <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถเลือกดูแสดงผลสินค้าได้ทั้งแบบคอลัมน์ และแบบแถว <br>
                <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถค้นหาสินค้าได้โดยใส่ชื่อหัวข้อสินค้าช่องค้นหา หรือเลือกหมวดหมู่ในการค้นหาได้<br>
                </div>
              </div>
          </div> -->
          <!-- /.box -->


        <div class="row">
          <div class="col-md-6">
            <div class="box box-info collapsed-box box-solid">
              <div class="box-header">
                <h3 class="box-title">ค้นหาอย่างละเอียด</h3><span id="validate-send-find" style="color: orange; display: none;"> *คุณยังไม่ได้กรอกรายละเอียด</span>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                </div>
              </div>
              <div class="box-body">
                  <div class="col-md-4" style="padding-bottom: 5px; padding: 3px;">
                      <input type="text" name="name_branch" id="name_branch" class="form-control" style="border-radius: 5px;" placeholder="ชื่อร้านค้า">                    
                  </div>
                  <div class="col-md-4" style="padding-bottom: 5px; padding: 3px;">
                      <input type="text" name="code_branch" id="code_branch" class="form-control" style="border-radius: 5px;" placeholder="รหัสร้านค้า">                    
                  </div>
                  <div class="col-md-4" style="padding-bottom: 5px; padding: 3px;">
                      <input type="text" name="phone_branch" id="phone_branch" class="form-control" style="border-radius: 5px;" placeholder="เบอร์โทรศัพท์">
                  </div>
                  <div class="col-md-4" style="padding-bottom: 5px; padding: 3px;">
                    <select class="form-control" id="type_branch" style="border-radius: 5px;" name="type_branch">
                      <option value="">
                        ประเภท
                      </option>
                      <option value="0">
                       ร้านค้าใหญ่
                      </option>
                      <option value="1">
                       ร้านค้าย่อย
                      </option>
                    </select>
                  </div>
                  <div class="col-md-4" style="padding-bottom: 5px; padding: 3px;" align="">
                    <div class="btn-group" style="width: 100%">
                      <button class="btn btn-primary" id="send_find-detail" style="width: 40%;"><i class="fa fa-search"></i> ค้นหา</button>
                      <button class="btn btn-default" id="send_find-clear" style="width: 30%; padding-left: 2px; padding-right: 2px;">เคลียร์</button>
                      <button class="btn btn-default" id="send_find-all" style="width: 30%; padding-left: 2px; padding-right: 2px;">ทั้งหมด</button>
                      <input type="checkbox" name="" id="find-ck-1" style="display: none;">
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="input-group">
              <input type="text" id="name_f" name="q" class="form-control" placeholder="Search All Text in database.." style="height: 43px;">
              <span class="input-group-btn">
                <button name="search" class="btn btn-flat" style="height: 43px;"><i class="fa fa-search"></i>
                  <input type="checkbox" name="" id="find-ck-2" style="display: none;">
                </button>
              </span>
            </div>
          </div>
        </div>
        <div class="row">
          
        </div>
        <div class="box box-primary" id="detail_list-product">
          <div class="box-header with-border">
            <h3 class="box-title">รายชื่อร้านค้า</h3>
            <div class="btn-group">

              <span class="btn sort-branch n"  data-id="n"  data-c="n1" style="border-right: 1px solid #ddd; border-left: 1px solid #ddd;"><i class="fa fa-sort-alpha-desc"></i> ชื่อ</span>
              <span class="btn sort-branch n1" data-id="n1" data-c="n"  style="border-right: 1px solid #ddd; border-left: 1px solid #ddd; display: none; margin-left: 0.2px;"><i class="fa fa-sort-alpha-asc"></i> ชื่อ</span>

              <span class="btn sort-branch s"  data-id="s"  data-c="s1" style="border-right: 1px solid #ddd; display: none;"><i class="fa fa-sort-alpha-desc"></i> รหัส</span>
              <span class="btn sort-branch s1" data-id="s1" data-c="s"  style="border-right: 1px solid #ddd; "><i class="fa fa-sort-alpha-asc"></i> รหัส</span>

              <span class="btn sort-branch c"  data-id="c"  data-c="c1" style="border-right: 1px solid #ddd; display: none;" ><i class="fa fa-sort-numeric-asc"></i> ประเภท</span>
              <span class="btn sort-branch c1" data-id="c1" data-c="c"  style="border-right: 1px solid #ddd; "><i class="fa fa-sort-numeric-desc"></i> ประเภท</span>

            </div>
            <label onclick="checkall();" id="checkall_w" style="display: none; margin: 0 !important;">
                <input id="checkall"  type="checkbox" name="transport" value="1" >
                เลือกทั้งหมด
              </label>
           <!--  <a href="#" class="changed_format" data-id="1" style="font-size: 18px;">
              <i class="fa fa-th pull-right" style=" cursor: pointer;"></i>
            </a>
            <a href="#" class="changed_format" data-id="2" style="font-size: 18px;">
              <i class="fa fa-th-list pull-right" style=" cursor: pointer;"></i>
            </a> -->
    <?php if($button_open == ''){ ?>
            <button type="button" class="btn btn-success btn-sm pull-right" onclick="javascript:location.href='front-add.php'" style="margin-right: 10px;  "><i class="fa fa-plus"></i>&nbsp;&nbsp;เพิ่มร้านค้า</button>
    <?php } ?>
     <?php if($button_open == ''){ ?>
            <a  href="import_csv.php"   data-toggle="modal" data-target="#modal_showdetail" style="margin-right: 10px;  ">
            <button type="button" class="btn btn-success btn-sm pull-right" id="btnSendAdd"  style="margin-right: 10px;  "><i class="fa fa-clone"></i>&nbsp;นำเข้าไฟล์ CSV</button></a>
    <?php } ?>
          </div>
          <div class="box-body" style="padding: 0;">
            <form id="frm_table"  method="post">
 <input type="hidden" name="form" value="soft-delmulti">
              <div id="live_em-list"></div> 
              <div class="boxsave" id="box-del-list">
    <?php //if($button_del_s==''){?>
               <!--  <button type="button" class="delmulti-menu btn btn-danger" style="transition: 0.4s;" id="MultiDelete" disabled><i class="fa fa-remove"></i> ลบรายการทั้งหมด</button> -->
    <?php //} ?>

    <?php if($button_del==''){?>
                <button type="button" class="delmulti-menu btn btn-warning" style="transition: 0.4s;" id="MultiDelete-soft" disabled><i class="fa fa-trash"></i> ลบรายการทั้งหมด</button>
    <?php } ?>
              </div>  
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row" id="detail_widget-product" style="display: none;">
      <div class="col-md-12">
        <div>
          <form action="" name="frmMain_w" id="frmMain_w" method="post">
          <input type="hidden" name="form" value="delmulti" id="frmMain-w-delmulti">
          <div id="live_em-widget"></div>
          <div class="boxsave" id="box-del-widget" style="z-index: 56;">
              <button type="button" class="delmulti-menu btn btn-danger" style="transition: 0.4s;" id="MultiDelete_w" disabled><i class="fa fa-remove"></i> ลบรายการทั้งหมด</button>

              <button type="button" class="delmulti-menu btn btn-warning" style="transition: 0.4s;" id="MultiDelete_w-soft" disabled><i class="fa fa-trash"></i> ลบรายการทั้งหมด</button>
          </div>
          </form>
          
        </div>
      </div>
    </div>
      <!-- /.box --> 
    </section>
  </aside>
  <form action="" id="frmDEL" name="frmDEL" method="post">
      <input type="hidden" name="form" value="del" id="form_del">
      <input type="hidden" name="id_del_branch" id="id_del_branch">
  </form>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<div class="modal fade" id="modal_showdetail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <!-- load from file !-->
    </div>
  </div>
</div> 
<!-- ./wrapper -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script> -->
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- date-range-picker -->
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="../bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- PACE -->
<script src="../bower_components/PACE/pace.min.js"></script>
<script src="../plugins/sweetalert2/dist/sweetalert2.min.js"></script>

<script type="text/javascript">
  $(document).ajaxStart(function () {
    Pace.restart()
  })

   $(document).ready(function(){
    // sort product
    $(document).on('click', '.sort-branch', function(){
        var sort = $(this).attr('data-id');
        var ch = $(this).attr('data-c');
        $('.sort-branch').removeClass('sort-active');
        $(this).hide();
        $('.'+ch).show();
        $('.'+ch).addClass('sort-active');
        var name_branch   = $('#name_branch').val();
        var phone_branch   = $('#phone_branch').val();
        var code_branch   = $('#code_branch').val();
        var type_branch  = $('#type_branch').val();
        if($('#find-ck-1').is(':checked')){
          fetch_data_branch_widged(name_branch,phone_branch,code_branch,type_branch,sort);      //ใช้ฟังชั่นร่วมกับ ค้นหา detail
          fetch_data_branch_list(name_branch,phone_branch,code_branch,type_branch,sort); //ใช้ฟังชั่นร่วมกับ ค้นหา detail
        }else if($('#find-ck-2').is(':checked')){
          var name_f        = $('#name_f').val();
          fetch_data_branch_find_fast(name_f,sort);      //ใช้ฟังชั่นร่วมกับ ค้นหา detail
          fetch_data_branch_find_fast_list(name_f,sort); //ใช้ฟังชั่นร่วมกับ ค้นหา detail
        }else{
          fetch_data_branch_sort(sort);
          fetch_data_branch_sort2(sort);
        }
    });
    //fetch sort
     function fetch_data_branch_sort(sort)  
          {  
              $.ajax({  
                  url:"select_br-widget.php",  
                  method:"POST",  
                  data:{sort:sort},
                  success:function(data){  
                  $('#live_em-widget').html(data);  
                  }  
              });  
          }  
        function fetch_data_branch_sort2(sort)  
          {  
              $.ajax({  
                  url:"select_br-list.php",  
                  method:"POST",  
                  data:{sort:sort},
                  success:function(data){  
                  $('#live_em-list').html(data);  
                  }  
              });  
          }  
    //fetch sort
     function fetch_data_branch_find_fast(name_f,sort)  
          {  
              $.ajax({  
                  url:"select_br-widget.php",  
                  method:"POST",  
                  data:{name:name_f,
                        sort:sort},
                  success:function(data){  
                  $('#live_em-widget').html(data);  
                  }  
              });  
          }  
        function fetch_data_branch_find_fast_list(name_f,sort)  
          {  
              $.ajax({  
                  url:"select_br-list.php",  
                  method:"POST",  
                  data:{name:name_f,
                        sort:sort},
                  success:function(data){  
                  $('#live_em-list').html(data);  
                  }  
              });  
          }  
    //fetch sort with find fast
    //-------------------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------start find detail---------------------------------------------------------
        $(document).on('click', '#send_find-detail', function(){
          var name_branch     = $('#name_branch').val();
          var code_branch     = $('#code_branch').val();
          var phone_branch    = $('#phone_branch').val();
          var type_branch     = $('#type_branch').val();
          alert(code_branch)
          if(name_branch==''&& code_branch =='' && phone_branch=='' && type_branch ==''){  

            $( "#find-ck-1" ).prop( "checked", false );
            $('#validate-send-find').show();
              setTimeout(function(){ 
              $('#validate-send-find').fadeOut(500); }, 4000);
            return false;
          }
          $( "#find-ck-1" ).prop( "checked", true );
          $('#find-ck-2').prop('checked',false);
          fetch_data_branch_widged(name_branch,code_branch,phone_branch,type_branch);
          fetch_data_branch_list(name_branch,code_branch,phone_branch,type_branch);

        });
        function fetch_data_branch_widged(name_branch,code_branch,phone_branch,type_branch,sort)  
          {  
              $.ajax({  
                  url:"select_br-widget.php",  
                  method:"POST",  
                  data:{name_branch:name_branch,
                        phone_branch:phone_branch,
                        code_branch:code_branch,
                        type_branch:type_branch,
                        sort:sort,
                      },
                  success:function(data){  
                  $('#live_em-widget').html(data);  
                  }  
              });  
          }  
        function fetch_data_branch_list(name_branch,code_branch,phone_branch,type_branch,sort)  
          {  
              $.ajax({  
                  url:"select_br-list.php",  
                  method:"POST",  
                  data:{name_branch:name_branch,
                        phone_branch:phone_branch,
                        code_branch:code_branch,
                        type_branch:type_branch,
                        sort:sort,
                      },
                  success:function(data){  
                    alert(code_branch)
                  $('#live_em-list').html(data);  
                  }  
              });  
          } 
        //------------------------------------------------------------------------claer form send----------------------------------------------------------
        $(document).on('click', '#send_find-clear', function(){
          $('#find-ck-1').prop('checked',false);
          $('#name_branch').val('');
          $('#phone_branch').val('');
          $('#code_branch').val('');
          $('#type_branch').val('');
          $('#phone_branch').val('');
          $("select#authen_em").prop('selectedIndex', 0);

          $('#daterange-btn span').html('<i class="fa fa-calendar"></i> วันที่แก้ไขล่าสุด');
        })
        //------------------------------------------------------------------------fetch all----------------------------------------------------------------
        $(document).on('click', '#send_find-all', function(){
          $('#find-ck-1').prop('checked',false);
          $('#find-ck-2').prop('checked',false);
          fetch_data_branch();
          fetch_data_branch2();
        })
        //-------------------------------------------------------------------------------------------------------------------------------------------------- 

        //------------------------------------------------------------------------start find fast-----------------------------------------------------------
        //-------------------------------------------------------------------------find name-----------------------------------------------------------------
        $(document).on('keyup', '#name_f', function()
        {
              var id = $(this).val();
              if (id == '') {
                $('#find-ck-2').prop('checked',false);
                fetch_data_branch_name();
                fetch_data_branch_name_list();
              }else{
                $('#find-ck-2').prop('checked',true);
                $('#find-ck-1').prop('checked',false);
                fetch_data_branch_name(id);
                fetch_data_branch_name_list(id);
              }
          });
        function fetch_data_branch_name(name)  
          {  
              $.ajax({  
                  url:"select_br-widget.php",  
                  method:"POST",  
                  data:{name:name},
                  success:function(data){  
                  $('#live_em-widget').html(data);  
                  }  
              });  
          }  
        function fetch_data_branch_name_list(name)  
          {  
              $.ajax({  
                  url:"select_br-list.php",  
                  method:"POST",  
                  data:{name:name},
                  success:function(data){  
                  $('#live_em-list').html(data);  
                  }  
              });  
          }  



          //------------------------------------------------------------fetch data member-------------------------------------------------------
          function fetch_data_branch(page,name_f,name_branch,code_branch,phone_branch,type_branch,sort)  
          {  
              $.ajax({  
                  url:"select_br-list.php",  
                  method:"POST",  
                  data:{page:page,
                        name:name_f,
                        name_branch:name_branch,
                        code_branch:code_branch,
                        phone_branch:phone_branch,
                        type_branch:type_branch,
                        sort:sort},
                  success:function(data){  
              $('#live_em-list').html(data);  
                  }  
              });  
          }  
          fetch_data_branch();
          // function fetch_data_branch2(page,name_f,name_branch,code_branch,phone_branch,type_branch,sort)  
          // {  
          //     $.ajax({ 
          //         url:"select_br-widget.php",  
          //         method:"POST",  
          //         data:{page:page,
          //               name:name_f,
          //               name_branch:name_branch,
          //               code_branch:code_branch,
          //               phone_branch:phone_branch,
          //               type_branch:type_branch,
          //               sort:sort},
          //         success:function(data){  
          //     $('#live_em-widget').html(data);  
          //         }  
          //     });  
          // }  
          // fetch_data_branch2();
          //------------------------------------------------------------pagination link-----------------------------------------------------------
          $(document).on('click', '.pagination_link', function(){
            var page = $(this).attr("id");
            var name_f = $(this).attr("data-n-fast");
            var name_branch = $(this).attr('data-n');
            var code_branch = $(this).attr('data-c');
            var phone_branch = $(this).attr('data-ca');
            var type_branch = $(this).attr('data-s');
            var sort = $(this).attr('data-sort');
            fetch_data_branch(page,name_f,name_branch,code_branch,phone_branch,type_branch,sort);
            document.getElementById('MultiDelete').disabled = true;
          });
          $(document).on('click', '.pagination_link_w', function(){
            var page = $(this).attr("id");
            var name_f = $(this).attr("data-n-fast");
            var name_branch = $(this).attr('data-n');
            var code_branch = $(this).attr('data-c');
            var phone_branch = $(this).attr('data-ca');
            var type_branch = $(this).attr('data-s');
            var sort = $(this).attr('data-sort');
            fetch_data_branch2(page,name_f,name_branch,code_branch,phone_branch,type_branch,sort);
            document.getElementById('MultiDelete').disabled = true;
          });

        //-------------------------------Delete article show modal alert before send value to delete----------------------------------------------



        $(document).on('click', '.delete-branch', function(){  
            var id = $(this).attr('data-id'); 
            $('#form_del').val('del');
            $('#id_del_branch').val(id);;
            swal({
            title: "ยืนยัน?",
            text: "คุณแน่ใจหรือจะลบร้านค้านี้",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "ยกเลิก",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "ยืนยัน",
            closeOnConfirm: true,
            showLoaderOnConfirm: true
            }, function () {
            $.ajax({     
                type:"POST",
                url:'functions.php',
                data: $("#frmDEL").serialize(),             
                success:function(data){
                  alert(data);
                    if(data == 'exist'){
                      swal("ไม่สามารถลบได้", "ไม่สามารถลบสินค้าชิ้นนี้ได้ เนื่องจากมีออร์เดอร์อยู่", "warning");
                      return false;
                    }else{
                      swal("สำเร็จ", "ลบสินค้าเรียบร้อยแล้ว", "success");
                    }
                    fetch_data_branch(); 
                    fetch_data_branch2();
                },
            }); 
         });
      });

$(document).on('click', '.soft-del-branch', function(){
      
    var id = $(this).attr('data-id');
    var _method = $(this).attr('data-id1');
    
      
        swal({
            title: 'ยืนยัน?',
            text: "คุณแน่ใจหรือจะลบร้านค้าที่เลือก?",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน!',
            showLoaderOnConfirm: true,
            preConfirm: function () {
            return new Promise(function (resolve) {
            $.ajax({
            type: "POST",
            url: "functions.php?_method="+_method+"&&id="+id,
            data: {id:id,_method:_method}, 
            processData: false,
            contentType: false
                  })

// in case of successfully understood ajax response
            .done(function (myAjaxJsonResponse) {
            console.log(myAjaxJsonResponse);
           // alert(myAjaxJsonResponse);
          
  swal({
            title: 'สำเร็จ',
            text: "ลบร้านค้าที่เลือกเรียบร้อยแล้ว",
            type: 'success',
      
            confirmButtonColor: '#3085d6',
          
            confirmButtonText: 'ยืนยัน!',
            showLoaderOnConfirm: true,
            preConfirm: function () {
            return new Promise(function (resolve) {
          
             
         swal(window.location.href='front-manage.php')
            //location.reload();
           
            .fail(function (erordata) {
// คือไม่สำรเ็จ
            console.log(erordata);
            swal('ไม่สำเร็จ', 'เกิดปัญหากับระบบ', 'error');
            })
          })
        },    
      })
            })
            .fail(function (erordata) {
// คือไม่สำรเ็จ
            console.log(erordata);
            swal('ไม่สำเร็จ', 'เกิดปัญหากับระบบ', 'error');
            })
          })
        },    
      })
        
      
    });

        $(document).on('click', '.soft-del-branch1', function(){  
            var id = $(this).attr('data-id'); 
            $('#form_del').val('soft-del');
            $('#id_del_branch').val(id);;
            swal({
            title: "ยืนยัน?",
            text: "คุณแน่ใจหรือจะลบร้านค้านี้",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "ยกเลิก",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "ยืนยัน",
            closeOnConfirm: true,
            showLoaderOnConfirm: true
            }, function () {
            // $.ajax({     
            //     type:"POST",
            //     url:'functions.php',
            //     data: $("#frmDEL").serialize(),             
            //     success:function(data){
            //       console.log(data);
            //         if(data == 'exist'){
            //           swal("ไม่สามารถลบได้", "ไม่สามารถลบสินค้าชิ้นนี้ได้ เนื่องจากมีออร์เดอร์อยู่", "warning");
            //           return false;
            //         }else{
            //           swal("สำเร็จ", "ลบสินค้าเรียบร้อยแล้ว", "success");
            //         }
            //         fetch_data_branch(); 
            //         fetch_data_branch2();
            //     },
            // }); 
             $.ajax({
             
                type: "POST",
                url: "functions.php",
                data: {id:id,form:'soft-del'}, 
                processData: false,
                contentType: false,
                success: function (data) {
                    fetch_data_branch(); 
                    fetch_data_branch2();
                },
            });

         });
      });
        //---------------------------------------Alert Mmodal for notification of delete multiple---------------------------------------------------
        var formClick;
    
        $(document).on('click', '#MultiDelete', function () {
            formClick = $(this);
            $('#frmMain-delmulti').val('delmulti');
            swal({
            title: "ยืนยัน?",
            text: "คุณแน่ใจหรือจะลบร้านค้าที่เลือก",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "ยกเลิก",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "ยืนยัน",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
            }, function () {
            $.ajax({
              type: "POST",
              url: "functions.php",
              data: $("#frmMain").serialize(),
              success: function(data) { 
                alert(data);
                  swal("สำเร็จ", "ลบร้านค้าที่เลือกเรียบร้อยแล้ว", "success");


      <?php if($button_del==''){?>
                  document.getElementById('MultiDelete-soft').disabled = true;
      <?php } ?>
                  fetch_data_branch(); 
                  fetch_data_branch2();
              },
           });
        });
      });

var formClick;
     $(document).on('click','#MultiDelete-soft',function(event) {
          //var formData = new FormData($('#f_save_up_repair_H02')[0]);
         var formData = new FormData($('#frm_table')[0]);
           
          swal({
            title: 'ยืนยัน?',
            text: "ยืนยันการลบหรือไม่?",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน!',
            showLoaderOnConfirm: true,
            preConfirm: function () {
            return new Promise(function (resolve) {
            $.ajax({
            type: "POST",
            url: "functions.php",
            data: formData,
            processData: false,
            contentType: false
                  })

// in case of successfully understood ajax response
            .done(function (myAjaxJsonResponse) {
            console.log(myAjaxJsonResponse);
  swal({
            title: 'สำเร็จ',
            text: "ลบเรียบร้อยแล้ว?",
            type: 'success',
      
            confirmButtonColor: '#3085d6',
          
            confirmButtonText: 'ยืนยัน!',
            showLoaderOnConfirm: true,
//             preConfirm: function () {
//             return new Promise(function (resolve) {
          
//              //alert(resolve);
//          swal(window.location.href='front-add.php')
//             //location.reload();
           
//             .fail(function (erordata) {
// // คือไม่สำรเ็จ
//             console.log(erordata);
//             swal('ไม่สำเร็จ', 'เกิดปัญหากับระบบ', 'error');
//             })
//           })
//         },    
      })
            })
            .fail(function (erordata) {
// คือไม่สำรเ็จ
            console.log(erordata);
            swal('ไม่สำเร็จ', 'เกิดปัญหากับระบบ', 'error');
            })
            location.reload();
          })
        },    
      })
    });
        $(document).on('click', '#MultiDelete-soft1', function () {
            formClick = $(this);
            $('#frmMain-delmulti').val('soft-delmulti');
            swal({
            title: "ยืนยัน?",
            text: "คุณแน่ใจหรือจะลบร้านค้าที่เลือก"+formClick,
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "ยกเลิก",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "ยืนยัน",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
            }, function () {
            $.ajax({
              type: "POST",
              url: "functions.php",
              data: $("#frmMain").serialize(),
              success: function(data) { 
                alert(data);
                  swal("สำเร็จ", "ลบร้านค้าที่เลือกเรียบร้อยแล้ว", "success");
      <?php if($button_del_s==''){?>
                  document.getElementById('MultiDelete').disabled = true;
      <?php } ?>             

      <?php if($button_del==''){?>
                  document.getElementById('MultiDelete-soft').disabled = true;
      <?php } ?> 
                  fetch_data_branch(); 
                  fetch_data_branch2();
              },
           });
        });
      });

        var formClick;
        $(document).on('click', '#MultiDelete_w', function () {
            formClick = $(this);
            $('#frmMain-w-delmulti').val('delmulti');
            swal({
            title: "ยืนยัน?",
            text: "คุณแน่ใจหรือจะลบร้านค้าเลือก",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "ยกเลิก",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "ยืนยัน",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
            }, function () {
            $.ajax({
              type: "POST",
              url: "functions.php",
              data: $("#frmMain_w").serialize(),
              success: function(data) { 
                alert(data);
                  swal("สำเร็จ", "ลบร้านค้าที่เลือกเรียบร้อยแล้ว", "success");
                  document.getElementById('MultiDelete').disabled = true;
                  fetch_data_branch(); 
                  fetch_data_branch2();
              },
           });
        });
      });

        $(document).on('click', '#MultiDelete_w-soft', function () {
            formClick = $(this);
            $('#frmMain-w-delmulti').val('soft-delmulti');
            swal({
            title: "ยืนยัน?",
            text: "คุณแน่ใจหรือจะลบร้านค้าเลือก",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "ยกเลิก",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "ยืนยัน",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
            }, function () {
            $.ajax({
              type: "POST",
              url: "functions.php",
              data: $("#frmMain_w").serialize(),
              success: function(data) { 
                alert(data);
                  swal("สำเร็จ", "ลบร้านค้าที่เลือกเรียบร้อยแล้ว", "success");
                  document.getElementById('MultiDelete').disabled = true;
                  fetch_data_branch(); 
                  fetch_data_branch2();
              },
           });
        });
      });
        //---------------------------------------Send value to edit ---------------------------------------------------------------------------------
        $(document).on('click', '.edit-branch', function(){
            var id = $(this).attr('data-id'); 
            location.href = "front-edit.php?id="+id;
        });
        // $(document).on('click', '.changed_format', function(){
        //    var id =$(this).attr('data-id');
        //    if(id ==1){
        //     $('#detail_widget-product').show();
        //     $('#live_em-list').hide();
        //     $('#changed_for_list').hide();
        //     $('#changed_for_widget').show();
        //     $('#MultiDelete_w').show();
        //     $('#MultiDelete').hide();
        //     $('#checkall_w').show();
        //    }else{
        //     $('#live_em-list').show();
        //     $('#detail_widget-product').hide();
        //     $('#changed_for_list').show();
        //     $('#changed_for_widget').hide();
        //     $('#MultiDelete').show();
        //     $('#MultiDelete_w').hide();
        //     $('#checkall_w').hide();
        //    }
        // });
         $(document).on('change', '.changed_math', function(){
          var id = $(this).val();
          // alert(id);
           swal({
                          title: "ยืนยัน?",
                          text: "ยืนยันการจับคู่สินค้า",
                          type: "info",
                          showCancelButton: true,
                          cancelButtonText: "ยกเลิก",
                          confirmButtonText: "ยืนยัน",
                          closeOnConfirm: false,
                          showLoaderOnConfirm: true
                        }, function () {
                        $.ajax({  
                              url:"back_edit-productmath.php",  
                              method:"POST",  
                              data:{id:id},
                              success:function(data){  
                                 swal("สำเร็จ", "ลบสินค้าทั้งหมดเรียบร้อยแล้ว", "success");
                                 document.getElementById('MultiDelete').disabled = true;
                                fetch_data_branch();
                                fetch_data_branch2();
                              }  
                          });  
                      });
           
        });
        //-------------------------------------------------------------------------------------------------------------------------------------------------- 

          $(document).on('change', '.level_product', function(){
            var level = $(this).val();
            var id = $(this).attr('data-id');
            var id_level = level+'-'+id;
            $.ajax({
                // complete: function() { 
                //     swal("สำเร็จ", "เรียบร้อยแล้ว", "success");
                //     fetch_data_branch2();
                // },
                type:'POST',
                url:'ajaxDatalevel.php',
                data:'id_level='+id_level,               
                success:function(html){
                  fetch_data_branch2();
                  fetch_data_branch();
                },  
            }); 
        });
    });
        function checkall(){
         var i=1;
          for(i=1;i<=document.frmMain_w.hdnCount_w.value;i++){
            if($('#checkall').is(":checked")){
             eval("document.frmMain_w.crck"+i+".checked=true");
              $(".discard").addClass("overlay-cover-del"); 
              $(".icon-del").show();
              // document.getElementById('MultiDelete_w').disabled = false;  
              document.getElementById('MultiDelete_w-soft').disabled = false;           
            }else{
              eval("document.frmMain_w.crck"+i+".checked=false");
              $(".icon-del").hide();
              // document.getElementById('MultiDelete_w').disabled = true;
              document.getElementById('MultiDelete_w-soft').disabled = true;
              $(".discard").removeClass("overlay-cover-del"); 
            }
          }
        }
        //----------------------------------------------Click Check all------------------------------------------------------------------------------
        function ClickCheckAll(vol)
        {
        
          var i=1;
          for(i=1;i<=document.frmMain.hdnCount.value;i++)
          {
            if(vol.checked == true)
            {
              eval("document.frmMain.Chk"+i+".checked=true");
              $("tr").addClass("remove-item"); 
    <?php if($button_del_s==''){?>
              document.getElementById('MultiDelete').disabled = false;
    <?php } ?>   

    <?php if($button_del==''){?>
              document.getElementById('MultiDelete-soft').disabled = false;
    <?php } ?>
            }
            else
            {
              eval("document.frmMain.Chk"+i+".checked=false");
    <?php if($button_del_s==''){?>
              document.getElementById('MultiDelete').disabled = true;
    <?php } ?>   

    <?php if($button_del==''){?>
              document.getElementById('MultiDelete-soft').disabled = true;
    <?php } ?>
              $("tr").removeClass("remove-item");
            }
          }
        }
        //----------------------------------------------Click Check all widget------------------------------------------------------------------------------
        function ClickCheckAll_w(vol)
        {
          var i=1;
          for(i=1;i<=document.frmMain_w.hdnCount_w.value;i++)
          {
            if(vol.checked == true)
            {
              eval("document.frmMain_w.crck"+i+".checked=true");
              $(".discard").addClass("overlay-cover-del"); 
              $(".icon-del").show();
        <?php if($button_del_s==''){?>
              document.getElementById('MultiDelete_w').disabled = false;
        <?php } ?>   

        <?php if($button_del==''){?>
              document.getElementById('MultiDelete_w-soft').disabled = false;
        <?php } ?>             
            }
            else
            {
              eval("document.frmMain_w.crck"+i+".checked=false");
              $(".icon-del").hide();
              document.getElementById('MultiDelete_w').disabled = true;
              document.getElementById('MultiDelete_w-soft').disabled = true;
              $(".discard").removeClass("overlay-cover-del");
            }
          }
        }
        //---------------------------------------------------Add Class---------------------------------------------------------------------------------
        $(document).on('click', '.checkbox_remove', function(){ 
          if($(this).is(":checked")) 
          {
              $(this).parents('tr').addClass("remove-item");
              // document.getElementById('MultiDelete').disabled = false;
              document.getElementById('MultiDelete-soft').disabled = false;
          } 
          else 
          {
              $(this).parents('tr').removeClass("remove-item");
              if($('input.checkbox_remove').is(':checked')){
              }else{
                // document.getElementById('MultiDelete').disabled = true;
                document.getElementById('MultiDelete-soft').disabled = true;
              }
              
          }
        });
        //---------------------------------------------------Add Class---------------------------------------------------------------------------------
        $(document).on('click', '.cr-image', function(){ 
          var id = $(this).attr('data-id');
          if($('.crck_w'+id).is(":checked")){
             $('.crck_w'+id).prop('checked', false);
             $('.overlay-image'+id).removeClass('overlay-cover-del');
             $('#icon-del'+id).hide();
              if($('.discard').hasClass('overlay-cover-del')){
                document.getElementById('MultiDelete_w').disabled = false;
                document.getElementById('MultiDelete_w-soft').disabled = false;
              }else{
                document.getElementById('MultiDelete_w').disabled = true;
                document.getElementById('MultiDelete_w-soft').disabled = true;
              }
           }else{
             $('.overlay-image'+id).addClass('overlay-cover-del');
             $('#icon-del'+id).show();
             $('.crck_w'+id).prop('checked', true);
             document.getElementById('MultiDelete_w').disabled = false;
             document.getElementById('MultiDelete_w-soft').disabled = false;
           }        
        });
        //----------------------------------------------------Set time realtime------------------------------------------------------------------------
      function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
          }
        return true;
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
</script>
</body>
</html>
