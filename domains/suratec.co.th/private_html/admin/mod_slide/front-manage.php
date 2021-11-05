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
  <title><?php echo TITLE; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  

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
<link rel="shortcut icon" type="image/png" href="../img/favicon.png"/>
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="../plugins/sweetalert2/dist/sweetalert2.min.css">
     <!-- address thailande -->
   <!--  <link rel="stylesheet" href="js/jquery.Thailand.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

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
        .box-manage-employee {
          box-shadow: 0 4px 8px 0 rgba(0,0,0,0.1);
          transition: 0.3s;
          float: left;
          background-color: white;
          max-width: 200px;
          height:300px;
          margin: auto;
          margin-bottom: 20px;
          margin-right: 15px;
          text-align: center;
        }
        .box-manage-employee:hover {
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
        .text-employee{
          text-align: left;
          font-size: 16px;
          padding: 5px;
          padding-left: 5px;
          border-top: 1px solid #d8d8d8;
          margin:auto;
          height: 55px;
        }
        .text-employee p{
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
        .image-employee-attachment{
          font-size:0px; 
          width:200px; 
          height:150px; 
          position:relative;
          /*border-bottom:1px solid #d8d8d8;*/
        }
        /*-------------------------------------------list table*/
        .image-employee-list{
          text-align: center;
          font-size:0px; 
          width:70px; 
          height:50px; 
          position:relative;
          /*border-bottom:1px solid #d8d8d8;*/
        }
        .image-employee-list img{
          width:auto; 
          height:auto; 
          max-width:100%; 
          max-height:100%; 
          cursor: pointer;
        }
        /*------------------------------------------------------*/
        .image-employee-attachment img{
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
        .sort-employee{
          transition: 0.4s;
          border-radius: 0;
        }
        .sort-employee:hover{
          background-color: #f6f8fa;
        }
        .sort-active{
          background-color: #ddd !important;
        }
@media screen and (max-width:479px){  /* 0px - 479px */
 #live_em-list{
overflow: auto;
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
        หมวดหมู่สไลด์
      </h1>
      <ol class="breadcrumb">
        <li><a href="../page_home/index.php"></i> แดชบอร์ด</a></li>
        <li class="active">หมวดหมู่สไลด์</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          
          <!-- /.box -->


        <!-- <div class="row">
         
          <div class="col-md-6">
            <div class="input-group">
              <input type="text" id="name_employee" name="q" class="form-control" placeholder="Search All Text in database.." style="height: 43px;">
              <span class="input-group-btn">
                <button name="search" class="btn btn-flat" style="height: 43px;"><i class="fa fa-search" ></i>
                  <input type="checkbox" name="" id="find-ck-2" style="display: none;">
                </button>
              </span>
            </div>
          </div>
        </div> -->
        <div class="row">
          
        </div>
        <div class="col-md-6">
            <div class="col-lg-12 col-md-12 col-sm-12" style="<?php echo $button_open  ?>">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="box box-success box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">เพิ่มหมวดหมู่สไลด์</h3>
                                </div>
                                <div class="box-body" >
                                    <div class="form-horizontal">
<form class="upload-form-add-thumbnail"  method="post" enctype="multipart/form-data" id="upload-form-add">
                                            <input type="hidden" name="_method" value="CREATE">
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ชื่อหมวดหมู่สไลด์</label>

                                                <div class="col-sm-8">
                                                    <input type="text" name="name_th" class="form-control" id="name_th" autocomplete="off"  >
                                         
                                                   
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ชื่ออังกฤษ EN</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="name_en" id="name_en">
                                                </div>
                                            </div>
                                     </form>        
                                    </div>
                                    <button type="button" class="btn btn-success pull-right btnSendAdd" id="btnSendAdd" style="transition: 0.4s; margin-left: 5px;"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;บันทึก</button>
                                    <button type="button" class="btn btn-default pull-right btnSendClear" style="border:1px  margin-left: 5px;" onclick="javascript:location.reload(); ">
            <i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;รีเซ็ท
        </button>
                                </div>
                            </div>
                        </div>
        
           
            <!-- Start box warning for ADD system -->
                
                </div>
        </div>
        <div class="col-md-6">
        <div class="box box-primary" id="detail_list-employee">
          <div class="box-header with-border">
           
            <div class="btn-group">

            <label onclick="ClickCheckAll_W();" id="checkall_w" style="display: none; margin: 0 !important;">
                <input id="checkall"  type="checkbox" name="transport" value="1" >
                เลือกทั้งหมด
              </label>
           
<?php 
  if($button_open==''){
?>
          <!--   <button type="button" class="btn btn-success btn-sm pull-right" onclick="javascript:location.href='front-add.php'" style="margin-right: 10px; <?php echo $button_open ?> "><i class="fa fa-plus"></i>&nbsp;&nbsp;เพิ่มพนักงาน</button> -->
<?php
  }
?>
          </div>
          <div class="box-body" style="padding: 0;">
            <form action="" name="frmMain" id="frmMain" method="post">
              <input type="hidden" name="_method" value="Multivisible">
              <input type="hidden" name="change" id="changeMulti">
              <div class="input-group">
              <input type="text" id="name_employee" name="search_key" class="form-control" placeholder="กรอกชื่อไทย TH หรือ ชื่ออังกฤษ EN ของหมวดหมู่สไลด์" style="height: 43px;">
              <span class="input-group-btn">
                <button name="search" class="btn btn-flat" style="height: 43px;"><i class="fa fa-search" ></i>
                  <input type="checkbox" name="" id="find-ck-2" style="display: none;">
                </button>
              </span>
            </div>
            <br>

              <div id="live_em-list">

                
              </div>
             
        
            </form>
          </div>
        </div>
      </div>
      </div>
    </div>
    <div class="row" id="detail_widget-employee" style="display: none;">
      <div class="col-md-12">
        <div>
          <form action="" name="frmMain_w" id="frmMain_w" method="post">
            <input type="hidden" name="form" value="Multivisible">
            <input type="hidden" name="change" id="changeMulti_w">
          <div id="live_em-widget"></div>
          <div class="boxsave" id="box-del-widget" style="z-index: 56;">
<?php 
      if($button_del_s==''){
?>
              <button type="button" class="delmulti-menu btn btn-danger" style="transition: 0.4s; <?php echo $button_del; ?>" id="MultiDelete_w" disabled data-id="Delete"><i class="fa fa-remove"></i> ลบรายการที่เลือก <span class="num_w"></span></button>
<?php } 
      if($button_del==''){
?>
              <button type="button" class="delmulti-menu btn btn-warning" style="transition: 0.4s; <?php echo $button_edit; ?>" id="MultiDisabled_w" disabled data-id="Disabled"><i class="fa fa-eye-slash"></i> ยุติบทบาทพนักงานที่เลือก <span class="num_w"></span></button>
<?php 
     }
?>
<?php
      if($button_del_s==''){
?>
              <button type="button" class="delmulti-menu btn btn-info" style="transition: 0.4s; <?php echo $button_edit; ?>" id="MultiEnabled_w" disabled data-id="Enabled"><i class="fa fa-eye"></i> ยกเลิกการยุติบทบาทพนักงานที่เลือก <span class="num_w"></span></button>
<?php
    }
?>
          </div>
          </form>
          
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

         
    
            </div>


    <!-- load from file !-->
    </div>
  </div>

    <input type="hidden" name="per_button_edit" id="per_button_edit" value="<?php echo $button_edit ?>">
<input type="hidden" name="per_button_del" id="per_button_del" value="<?php echo $button_del ?>">
<input type="hidden" name="per_button_open" id="per_button_open" value="<?php echo $button_open ?>">
<input type="hidden" name="per_input_read" id="per_input_read" value="<?php echo $input_read ?>">
      <!-- /.box --> 
    </section>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- date-range-picker -->
<script src="../bower_components/moment/min/moment-with-locales.min.js"></script>
<script src="../bower_components/PACE/pace.min.js"></script>
<!-- <script src="js/timer.js"></script> -->

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script src="../plugins/sweetalert2/dist/sweetalert2.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">
  $(document).ajaxStart(function () {
    Pace.restart()
  })

   $(document).ready(function(){


    //fetch sort
    
        function fetch_data_employee_sort2(sort)  
          {  
             var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
              $.ajax({  
                  url:"select_em-list.php",  
                  method:"POST",  
                  data:{sort:sort,button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},
                  success:function(data){  
                  $('#live_em-list').html(data); 
                  $('#table_status').DataTable({
                    "bFilter": false
                  });
                  }  
              });  
          }  
    //fetch sort
  
        function fetch_data_employee_find_fast_list(name_f,sort)  
          {  
             var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
             var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
              $.ajax({  
                  url:"select_em-list.php",  
                  method:"POST",  
                  data:{name:name_f,
                        sort:sort,button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},
                  success:function(data){  
                  $('#live_em-list').html(data);  
                  $('#table_status').DataTable({
                    "bFilter": false
                  });
                  }  
              });  
          }  
    //fetch sort with find fast
    //-------------------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------start find detail---------------------------------------------------------
    $("#modal_edit").on('hidden.bs.modal', function () {
    $(this).data('bs.modal', null);
  });

     $(document).on('click', '#btnSendedit', function(){
      
        var formData = new FormData($('#frm_edit')[0]);
    id = $('#id').val();
    name_en_edit = $('#name_en_edit').val();
    name_en_edit = $('#name_en_edit').val();
    
  if(name_en_edit == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่ชื่อไทย TH", "warning")
        return false;
      }
    if(name_en_edit == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่ชื่ออังกฤษ EN", "warning")
        return false;
      }
    
      
        swal({
            title: 'ยืนยัน?',
            text: "ยืนยันบันทึกการแก้ไขหรือไม่?",
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
           // alert(myAjaxJsonResponse);
           if (myAjaxJsonResponse.status=='0') {
         
  swal({
            title: 'สำเร็จ',
            text: "บันทึกการแก้ไขเรียบร้อยแล้ว?",
            type: 'success',
      
            confirmButtonColor: '#3085d6',
          
            confirmButtonText: 'ยืนยัน!',
            showLoaderOnConfirm: true,
            preConfirm: function () {
            fetch_data_employee_list();
         

        },    
      })
}else{
  swal('ไม่สำเร็จ', 'เกิดปัญหากับระบบ', 'error');
}
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
        $(document).on('click', '#btnSendAdd', function(){
        var formData = new FormData($('#upload-form-add')[0]);

    name_th = $('#name_th').val();
    name_en = $('#name_en').val();
  

    if(name_th == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่ชื่อไทย TH", "warning")
        return false;
      }
    if(name_en == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่ชื่ออังกฤษ EN", "warning")
        return false;
      }
    
    

     
           
          

        swal({
            title: 'ยืนยัน?',
            text: "ยืนยันการบันทึกหรือไม่?",
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
            if (myAjaxJsonResponse.status=='0') {
           
  swal({
            title: 'สำเร็จ',
            text: "บันทึกเรียบร้อยแล้ว?",
            type: 'success',
      
            confirmButtonColor: '#3085d6',
          
            confirmButtonText: 'ยืนยัน!',
            showLoaderOnConfirm: true,
            preConfirm: function () {
         fetch_data_employee_list();
         $('#name_en').val('');
         $('#name_th').val('');

        },    
      })
}else{
  swal('ไม่สำเร็จ', 'เกิดปัญหากับระบบ', 'error');
}
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
 
        
        function fetch_data_employee_list(name_em,sur_em,code_id_em,birthday,posi_em,authen_em,sort)  
          {  
             var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
              $.ajax({  
                  url:"select_em-list.php",  
                  method:"POST",  
                  data:{name_em:name_em,
                        sur_em:sur_em,
                        code_id_em:code_id_em,
                        birthday:birthday,
                        posi_em:posi_em,
                        sort:sort,button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},
                  success:function(data){  
                  $('#live_em-list').html(data);  
                  $('#table_status').DataTable({
                    "bFilter": false
                  });
                  }  
              });  
          } 
       
        $(document).on('keyup', '#name_employee', function()
        {
              var id = $(this).val();
              if (id == '') {
                $('#find-ck-2').prop('checked',false);

                fetch_data_employee_name_list();
              }else{
                $('#find-ck-2').prop('checked',true);
                $('#find-ck-1').prop('checked',false);
               
                fetch_data_employee_name_list(id);
              }
          });
        
        function fetch_data_employee_name_list(name)  
          {  
             var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
              $.ajax({  
                  url:"select_em-list.php",  
                  method:"POST",  
                  data:{name:name,button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},
                  success:function(data){ 
                  // alert(name); 
                  $('#live_em-list').html(data);  
                  $('#table_status').DataTable({
                    "bFilter": false
                  }); 
                  }  
              });  
          }  



          //------------------------------------------------------------fetch data employee-------------------------------------------------------
          function fetch_data_employee(page,name_f,name,code,surname,posi_em,code_id,date,sort)  
          {  
             var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
              $.ajax({  
                  url:"select_em-list.php",  
                  method:"POST",  
                  data:{page:page,
                        name:name_f,
                        name_em:name,
                        sur_em:surname,
                        code_id_em:code,
                        birthday:date,
                        posi_em:posi_em,
                        sort:sort,button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},
                  success:function(data){  
              $('#live_em-list').html(data); 
              $('#table_status').DataTable({
                    "bFilter": false
                  }); 
                  }  
              });  
          }  
          fetch_data_employee();
         
         
    

        //-------------------------------Delete article show modal alert before send value to delete----------------------------------------------



    
 $(document).on('click', '.disabled-em', function(){
    var id = $(this).attr('data-id');
    var _method = 'disabled';
   
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
            url: "functions.php?_method=disabled&id="+id,

             data: {id:id},
           
            processData: false,
            contentType: false
                  })

// in case of successfully understood ajax response
            .done(function (myAjaxJsonResponse) {
            console.log(myAjaxJsonResponse);
            //alert(myAjaxJsonResponse);
            if (myAjaxJsonResponse.status=='0') {
  swal({
            title: 'สำเร็จ',
            text: "ลบเรียบร้อยแล้ว?",
            type: 'success',
      
            confirmButtonColor: '#3085d6',
          
            confirmButtonText: 'ยืนยัน!',
            showLoaderOnConfirm: true,

            preConfirm: function () {
     fetch_data_employee(); 
    
        },    
      })
 }else{
  swal('ไม่สำเร็จ', 'เกิดปัญหากับระบบ', 'error');
 }
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
       

        
        //---------------------------------------Alert Mmodal for notification of delete multiple---------------------------------------------------
        var formClick;

        $(document).on('click','#MultiDelete',function(event) {
          //var formData = new FormData($('#f_save_up_repair_H02')[0]);
         var formData = new FormData($('#frmMain')[0]);
           
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
            if (myAjaxJsonResponse.status=='0') {
               swal({
            title: 'สำเร็จ',
            text: "ลบเรียบร้อยแล้ว?",
            type: 'success',
      
            confirmButtonColor: '#3085d6',
          
            confirmButtonText: 'ยืนยัน!',
            showLoaderOnConfirm: true,
            preConfirm: function () {
              fetch_data_employee(); 
              
        },    
      })
            }else{
              swal('ไม่สำเร็จ', 'เกิดปัญหากับระบบ', 'error');
            }
 
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

       
  
   
    });
       
        //----------------------------------------------Click Check all------------------------------------------------------------------------------
        function ClickCheckAll(vol)
        {
        
          var i=1;
          for(i=1;i<=document.frmMain.hdnCount.value;i++)
          {
            $('.num_').html('[ '+i+' ]');
            if(vol.checked == true)
            {
              eval("document.frmMain.Chk"+i+".checked=true");
              $("tr").addClass("remove-item"); 
    <?php if($button_del_s==''){ ?>
              document.getElementById('MultiDelete').disabled = false; 
    <?php } ?>

    <?php if($button_del==''){ ?>
              // document.getElementById('MultiDisabled').disabled = false; 
    <?php } ?>

    <?php if($button_del_s==''){ ?> 
              // document.getElementById('MultiEnabled').disabled = false;   
    <?php } ?>
            }
            else
            {
              $('.num_').html('');
              eval("document.frmMain.Chk"+i+".checked=false");
    <?php if($button_del_s==''){ ?>
              document.getElementById('MultiDelete').disabled = true;
    <?php } ?>

    <?php if($button_del==''){ ?>
              // document.getElementById('MultiDisabled').disabled = true;
    <?php } ?>

    <?php if($button_del_s==''){ ?>
              // document.getElementById('MultiEnabled').disabled = true;
    <?php } ?>
              $("tr").removeClass("remove-item");
            }
          }
        }
        //---------------------------------------------------Add Class---------------------------------------------------------------------------------
        $(document).on('click', '.checkbox_remove', function(){ 
          var i =0; 
          if($(this).is(":checked")) 
          {
              $(this).parents('tr').addClass("remove-item");
    <?php if($button_del_s==''){ ?>
              document.getElementById('MultiDelete').disabled = false; 
    <?php } ?>

    <?php if($button_del==''){ ?>
              // document.getElementById('MultiDisabled').disabled = false; 
    <?php } ?>

    <?php if($button_del_s==''){ ?> 
              // document.getElementById('MultiEnabled').disabled = false;   
    <?php } ?>
              $('.remove-item').each(function() {
                i++;       
              }); 
              $('.num_').html('[ '+i+' ]'); 
          } 
          else 
          {
              $(this).parents('tr').removeClass("remove-item");
              $('.remove-item').each(function() {
                i++;       
              });
              $('.num_').html('[ '+i+' ]');
              if($('input.checkbox_remove').is(':checked')){
              }else{
    <?php if($button_del_s==''){ ?>
              document.getElementById('MultiDelete').disabled = true;
    <?php } ?>

    <?php if($button_del==''){ ?>
              // document.getElementById('MultiDisabled').disabled = true;
    <?php } ?>

    <?php if($button_del_s==''){ ?>
              // document.getElementById('MultiEnabled').disabled = true;
    <?php } ?>
              }
              
          }
        });
        //---------------------------------------------------Add Class---------------------------------------------------------------------------------
   
        //----------------------------------------------------Set time realtime------------------------------------------------------------------------
   
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
