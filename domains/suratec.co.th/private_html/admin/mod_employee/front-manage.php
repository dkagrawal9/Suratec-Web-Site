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
      <link rel="shortcut icon" type="image/png" href="../img/favicon.png"/>
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
  <link rel="stylesheet" href="css/table-employee.css">
  <!--Css loader -->
  <!-- sweet alert -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
 <!--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css.map"> -->
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
  @media screen and (min-width: 799px) { 
            body { 
                white-space:normal; 
                overflow-x: auto;
            }
        }
  </style>
  <style type="text/css">             
@media screen and (min-width:479px){  /* 0px - 479px */
 .modal-content{
width: 1000px;
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
        จัดการพนักงาน
      </h1>
      <ol class="breadcrumb">
        <li><a href="../page_home/index.php"></i> แดชบอร์ด</a></li>
        <li class="active">จัดการพนักงาน</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          
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
                      <input type="text" name="name_em" id="name_em" class="form-control" style="border-radius: 5px;" placeholder="ชื่อพนักงาน">                    
                  </div>
                  <div class="col-md-4" style="padding-bottom: 5px; padding: 3px;">
                      <input type="text" name="sur_em" id="sur_em" class="form-control" style="border-radius: 5px;" placeholder="นามสกุล">                    
                  </div>
                  <div class="col-md-4" style="padding-bottom: 5px; padding: 3px;">
                      <input type="text" name="code_id_em" id="code_id_em" class="form-control" style="border-radius: 5px;" placeholder="บัตรประจำตัวประชาขน">
                  </div>
                   <div class="col-md-4" style="padding-bottom: 5px; padding: 3px;">
                      <input type="date" name="birthday" id="birthday" class="form-control">
                  </div>
                   <div class="col-md-4" style="padding-bottom: 5px; padding: 3px;">
                      <input type="text" name="posi_em" id="posi_em" class="form-control" style="border-radius: 5px;" placeholder="ตำแหน่ง">
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
              <input type="text" id="name_employee" name="q" class="form-control" placeholder="Search All Text in database.." style="height: 43px;">
              <span class="input-group-btn">
                <button name="search" class="btn btn-flat" style="height: 43px;"><i class="fa fa-search" ></i>
                  <input type="checkbox" name="" id="find-ck-2" style="display: none;">
                </button>
              </span>
            </div>
          </div>
        </div>
        <div class="row">
          
        </div>
        <div class="box box-primary" id="detail_list-employee">
          <div class="box-header with-border">
            <h3 class="box-title">รายชื่อพนักงาน</h3>
          </div>
            <div class="btn-group">

              <span class="btn sort-employee n"  data-id="n"  data-c="n1" style="border-right: 1px solid #ddd; border-left: 1px solid #ddd;"><i class="fa fa-sort-alpha-desc"></i> ชื่อ</span>
              <span class="btn sort-employee n1" data-id="n1" data-c="n"  style="border-right: 1px solid #ddd; border-left: 1px solid #ddd; display: none; margin-left: 0.2px;"><i class="fa fa-sort-alpha-asc"></i> ชื่อ</span>

              <span class="btn sort-employee s"  data-id="s"  data-c="s1" style="border-right: 1px solid #ddd;"><i class="fa fa-sort-alpha-desc"></i> นามสกุล</span>
              <span class="btn sort-employee s1" data-id="s1" data-c="s"  style="border-right: 1px solid #ddd; display: none;"><i class="fa fa-sort-alpha-asc"></i> นามสกุล</span>

              <span class="btn sort-employee u"  data-id="u"  data-c="u1" style="border-right: 1px solid #ddd;"><i class="fa fa-sort-alpha-desc"></i> ชื่อผู้ใช้งาน</span>
              <span class="btn sort-employee u1" data-id="u1" data-c="u"  style="border-right: 1px solid #ddd; display: none;"><i class="fa fa-sort-alpha-asc"></i> ชื่อผู้ใช้งาน</span>

              <span class="btn sort-employee p"  data-id="p"  data-c="p1" style="border-right: 1px solid #ddd;"><i class="fa fa-sort-alpha-desc"></i> ตำแหน่ง</span>
              <span class="btn sort-employee p1" data-id="p1" data-c="p"  style="border-right: 1px solid #ddd; display: none;"><i class="fa fa-sort-alpha-asc"></i> ตำแหน่ง</span>
            </div>
            <label onclick="ClickCheckAll_W();" id="checkall_w" style="display: none; margin: 0 !important;">
                <input id="checkall"  type="checkbox" name="transport" value="1" >
                เลือกทั้งหมด
              </label>
            <a href="#" class="changed_format" data-id="1" style="font-size: 18px;">
              <i class="fa fa-th pull-right" style=" cursor: pointer;"></i>
            </a>
            <a href="#" class="changed_format" data-id="2" style="font-size: 18px;">
              <i class="fa fa-th-list pull-right" style=" cursor: pointer;"></i>
            </a>
              <button type="button" name="add_quotation_btn" id="add_quotation_btn" class="btn btn-success  pull-right"  ><i class="fa fa-plus-circle" aria-hidden="true"></i> จัดการประเภทผู้ใช้งาน</button>
<?php 
  if($button_open==''){
?>
            <button type="button" class="btn btn-success  pull-right" onclick="javascript:location.href='front-add.php'" style="margin-right: 10px; <?php echo $button_open ?> "><i class="fa fa-plus"></i>&nbsp;&nbsp;เพิ่มพนักงาน</button>
<?php
  }
?>            
          
              
   
          </div>
          <div class="box-body" style="padding: 0;">
            <form action="" name="frmMain" id="frmMain" method="post">
              <input type="hidden" name="form" value="Multivisible">
              <input type="hidden" name="change" id="changeMulti">
              <div id="live_em-list"></div> 
    <!--           <div class="boxsave" id="box-del-list">

<?php 
      if($button_del_s==''){
?>
                <button type="button" class="delmulti-menu btn btn-danger" style="transition: 0.4s; <?php echo $button_del; ?>" id="MultiDelete" disabled data-id="Delete"><i class="fa fa-remove"></i> ลบรายการที่เลือก <span class="num_"></span></button>
<?php } 
      if($button_del==''){
?>
                <button type="button" class="delmulti-menu btn btn-warning" style="transition: 0.4s; <?php echo $button_edit; ?>" id="MultiDisabled" disabled data-id="Disabled"><i class="fa fa-trash"></i> ยุติบทบาทพนักงานที่เลือก <span class="num_"></span></button>
<?php } ?>                

<?php 
      if($button_del_s==''){
?>
                <button type="button" class="delmulti-menu btn btn-info" style="transition: 0.4s; <?php echo $button_edit; ?>" id="MultiEnabled" disabled data-id="Enabled"><i class="fa fa-eye"></i> ยกเลิกการยุติบทบาทพนักงานที่เลือก <span class="num_"></span></button>
<?php } ?>
              </div> -->  
            </form>
       
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

       </div>
        </div>
      </div>
    </div>
      <!-- /.box --> 
    </section>
    <div class="modal  modal fade " id="modal_add"  >
  <div class="modal-dialog">
    <div class="modal-content" >
      <!-- Modal Header -->
      <div class="modal-header" >
        <h4 class="modal-title"><div id="modal_id_order"></div></h4>
        <label for="">จัดการประเภทผู้ใช้งาน</label>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

<div id="add_data">
    
</div>
      <!-- Modal footer -->                              
    </div>
  </div>
</div>
<input type="hidden" name="per_button_edit" id="per_button_edit" value="<?php echo $button_edit ?>">
<input type="hidden" name="per_button_del" id="per_button_del" value="<?php echo $button_del ?>">
<input type="hidden" name="per_button_open" id="per_button_open" value="<?php echo $button_open ?>">
<input type="hidden" name="per_input_read" id="per_input_read" value="<?php echo $input_read ?>">
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      
<script type="text/javascript">
  $(document).ajaxStart(function () {
    Pace.restart()
  })

   $(document).ready(function(){
    // sort employee
    $(document).on('click', '.sort-employee', function(){
        var sort = $(this).attr('data-id');
        var ch = $(this).attr('data-c');
        $('.sort-employee').removeClass('sort-active');
        $(this).hide();
        $('.'+ch).show();
        $('.'+ch).addClass('sort-active');
        var name_em   = $('#name_em').val();
        var sur_em   = $('#sur_em').val();
        var code_id_em   = $('#code_id_em').val();
        var birthday = $('#birthday').val();
        var posi_em   = $('#posi_em').val();
        var authen_em   = $('#authen_em').val();
        // alert(sort+name_em+code_id_em+code_em+birthday+posi_em);
        if($('#find-ck-1').is(':checked')){
          fetch_data_employee_widged(name_em,sur_em,code_id_em,birthday,posi_em,authen_em,sort);      //ใช้ฟังชั่นร่วมกับ ค้นหา detail
          fetch_data_employee_list(name_em,sur_em,code_id_em,birthday,posi_em,authen_em,sort); //ใช้ฟังชั่นร่วมกับ ค้นหา detail
        }else if($('#find-ck-2').is(':checked')){
          var name_f        = $('#name_employee').val();
          fetch_data_employee_find_fast(name_f,sort);      //ใช้ฟังชั่นร่วมกับ ค้นหา detail
          fetch_data_employee_find_fast_list(name_f,sort); //ใช้ฟังชั่นร่วมกับ ค้นหา detail
        }else{
          fetch_data_employee_sort(sort);
          fetch_data_employee_sort2(sort);
        }
    });

    $(document).on('click', '#add_quotation_btn', function(event){ 
       var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
    $.ajax({   
            url:'select_type.php', 
            method:'POST',  
            data:{_method:'manage_type',button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},  
            //dataType:"json", 
          
                success:function(data){  
                    //console.log(response.data[0]['path_slip']);
               

              
                   $("#add_data").html(data); 
                   $("#modal_add").modal('show'); 
                }, 

                   
           });  


});
 
 

    //fetch sort
     function fetch_data_employee_sort(sort)  
          {  
          var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
              $.ajax({  
                  url:"select_em-widget.php",  
                  method:"POST",  
                  data:{sort:sort,button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},
                  success:function(data){  
                  $('#live_em-widget').html(data);  
                  }  
              });  
          }  
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
                  }  
              });  
          }  
    //fetch sort
     function fetch_data_employee_find_fast(name_f,sort)  
          {
          var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();  
              $.ajax({  
                  url:"select_em-widget.php",  
                  method:"POST",  
                  data:{name:name_f,
                        sort:sort,button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},
                  success:function(data){  
                  $('#live_em-widget').html(data);  
                  }  
              });  
          }  
        function fetch_data_employee_find_fast_list(name_f,sort)  
          {
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
                  }  
              });  
          }  
    //fetch sort with find fast
    //-------------------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------start find detail---------------------------------------------------------
        $(document).on('click', '#send_find-detail', function(){
          var name_em   = $('#name_em').val();
          var sur_em   = $('#sur_em').val();
          var code_id_em   = $('#code_id_em').val();
          var birthday = $('#birthday').val();
          var posi_em   = $('#posi_em').val();

          if(name_em==''&& code_id_em =='' && birthday =='' && posi_em =='' && sur_em ==''){  
            $( "#find-ck-1" ).prop( "checked", false );
            $('#validate-send-find').show();
              setTimeout(function(){ 
              $('#validate-send-find').fadeOut(500); }, 4000);
            return false;
          }
          $( "#find-ck-1" ).prop( "checked", true );
          $('#find-ck-2').prop('checked',false);
          fetch_data_employee_widged(name_em,sur_em,code_id_em,birthday,posi_em);
          fetch_data_employee_list(name_em,sur_em,code_id_em,birthday,posi_em);

        });
        function fetch_data_employee_widged(name_em,sur_em,code_id_em,birthday,posi_em,authen_em,sort)  
          {  
          var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();  
              $.ajax({  
                  url:"select_em-widget.php",  
                  method:"POST",  
                  data:{name_em:name_em,
                        sur_em:sur_em,
                        code_id_em:code_id_em,
                        birthday:birthday,
                        posi_em:posi_em,
                        sort:sort},
                  success:function(data){  
                  $('#live_em-widget').html(data);  
                  }  
              });  
          }  
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
                  }  
              });  
          } 
        //------------------------------------------------------------------------claer form send----------------------------------------------------------
        $(document).on('click', '#send_find-clear', function(){
          $('#find-ck-1').prop('checked',false);
          $('#name_em').val('');
          $('#sur_em').val('');
          $('#code_id_em').val('');
          $('#birthday').val('');
          $('#posi_em').val('');
          $("select#authen_em").prop('selectedIndex', 0);

          $('#daterange-btn span').html('<i class="fa fa-calendar"></i> วันที่แก้ไขล่าสุด');
        })
        //------------------------------------------------------------------------fetch all----------------------------------------------------------------
        $(document).on('click', '#send_find-all', function(){
          $('#find-ck-1').prop('checked',false);
          $('#find-ck-2').prop('checked',false);
          fetch_data_employee();
          fetch_data_employee2();
        })
        //-------------------------------------------------------------------------------------------------------------------------------------------------- 

        //------------------------------------------------------------------------start find fast-----------------------------------------------------------
        //-------------------------------------------------------------------------find name-----------------------------------------------------------------
        $(document).on('keyup', '#name_employee', function()
        {
              var id = $(this).val();
              if (id == '') {
                $('#find-ck-2').prop('checked',false);
                fetch_data_employee_name();
                fetch_data_employee_name_list();
              }else{
                $('#find-ck-2').prop('checked',true);
                $('#find-ck-1').prop('checked',false);
                fetch_data_employee_name(id);
                fetch_data_employee_name_list(id);
              }
          });
        function fetch_data_employee_name(name)  
          {  
              $.ajax({  
                  url:"select_em-widget.php",  
                  method:"POST",  
                  data:{name:name},
                  success:function(data){  
                  $('#live_em-widget').html(data);  
                  }  
              });  
          }  
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
                  $('#live_em-list').html(data);  
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
                  }  
              });  
          }  
          fetch_data_employee();
          function fetch_data_employee2(page,name_f,name,code,surname,code_id,date,sort)  
          {  
              $.ajax({ 
                  url:"select_em-widget.php",  
                  method:"POST",  
                  data:{page:page,
                        name:name_f,
                        name_em:name,
                        sur_em:surname,
                        code_id_em:code,
                        birthday:code_id,
                        posi_em:date,
                        sort:sort},
                  success:function(data){  
              $('#live_em-widget').html(data);  
                  }  
              });  
          }  
          fetch_data_employee2();
          //------------------------------------------------------------pagination link-----------------------------------------------------------
          $(document).on('click', '.pagination_link', function(){
            var page = $(this).attr("id");
            var name_f = $(this).attr("data-n-fast");
            var name = $(this).attr('data-n');
            var code = $(this).attr('data-c');
            var surname = $(this).attr('data-surname');
            var posi_em = $(this).attr('data-posi');
            var code_id = $(this).attr('data-codeid');
            var date = $(this).attr('data-d');
            var sort = $(this).attr('data-sort');

            fetch_data_employee(page,name_f,name,code,surname,posi_em,code_id,date,sort);
            document.getElementById('MultiDelete').disabled = true;
          });
          $(document).on('click', '.pagination_link_w', function(){
            var page = $(this).attr("id");
            var name_f = $(this).attr("data-n-fast");
            var name = $(this).attr('data-n');
            var code = $(this).attr('data-c');
            var surname = $(this).attr('data-surname');
            var code_id = $(this).attr('data-codeid');
            var date = $(this).attr('data-d');
            var sort = $(this).attr('data-sort');
            fetch_data_employee2(page,name_f,name,code,surname,code_id,date,sort);
            document.getElementById('MultiDelete').disabled = true;
          });

        //-------------------------------Delete article show modal alert before send value to delete----------------------------------------------



        $(document).on('click', '.delete-em', function(){  
            var id = $(this).attr('data-id'); 
            var form = 'del';
            swal({
            title: "ยืนยัน?",
            text: "คุณแน่ใจหรือจะลบพนักงาน",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "ยกเลิก",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "ยืนยัน",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
            }, function () {
            $.ajax({     
                type:"POST",
                url:'functions.php',
                data: {id:id,
                       form:form},             
                success:function(data){
                  // alert(data.status);
                    swal("สำเร็จ", "ลบพนักงานเรียบร้อยแล้ว", "success");
                
                  fetch_data_employee(); 
                  fetch_data_employee2();
                },
            }); 
         });
      });



        $(document).on('click', '.disabled-em', function(){  
            var id = $(this).attr('data-id'); 
            var form = 'disabled';
            swal({
            title: "ยืนยัน?",
            text: "คุณแน่ใจหรือจะยุติบทบาทพนักงาน",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "ยกเลิก",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "ยืนยัน",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
            }, function () {
            $.ajax({     
                type:"POST",
                url:'functions.php',
                data: {id:id,
                       form:form},             
                success:function(data){
                    if(data.status==0){
                      swal("สำเร็จ", "ยุติบทบาทพนักงานเรียบร้อย", "success");
                    }else{
                      swal("Error", "ไม่สามารถยุติบทบาทพนักงานคนนี้ได้", "warning");
                    }
                    fetch_data_employee(); 
                    fetch_data_employee2();
                },
            }); 
         });
      });

         $(document).on('click', '.enabled-em', function(){  
            var id = $(this).attr('data-id'); 
            var form = 'enabled';
            swal({
            title: "ยืนยัน?",
            text: "คุณแน่ใจหรือจะยกเลิกการยุติบทบาทพนักงาน",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "ยกเลิก",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "ยืนยัน",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
            }, function () {
            $.ajax({     
                type:"POST",
                url:'functions.php',
                data: {id:id,
                       form:form},             
                success:function(data){
                    if(data.status==0){
                      swal("สำเร็จ", "ยกเลิกการยุติบทบาทพนักงานเรียบร้อย", "success");
                    }else{
                      swal("Error", "ไม่สามารถยกเลิกยุติบทบาทพนักงานคนนี้ได้", "warning");
                    }
                    fetch_data_employee(); 
                    fetch_data_employee2();
                },
            }); 
         });
      });
        //---------------------------------------Alert Mmodal for notification of delete multiple---------------------------------------------------
        var formClick;
        $(document).on('click', '#MultiDelete', function () {
            formClick = $(this);
            var change = $(this).attr('data-id');
            $('#changeMulti').val(change);
            swal({
            title: "ยืนยัน?",
            text: "คุณแน่ใจหรือจะลบพนักงานที่เลือก",
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
                  $('.num_').html('');
                  if(data.status==0){
                    swal("สำเร็จ", "ลบพนักงานที่เลือกเรียบร้อยแล้ว", "success");
                  }else{
                    swal("Error", "ไม่สามารถลบพนักงานที่เลือกได้", "warning");
                  }
                  document.getElementById('MultiDelete').disabled = true;
                  document.getElementById('MultiEnabled').disabled = true;
                  document.getElementById('MultiDisabled').disabled = true;
                  fetch_data_employee(); 
                  fetch_data_employee2();
              },
           });
        });
      });
      $(document).on('click', '#MultiDisabled', function () {
            formClick = $(this);
            var change = $(this).attr('data-id');
            $('#changeMulti').val(change);
            swal({
            title: "ยืนยัน?",
            text: "คุณแน่ใจหรือจะยุติบทบาทพนักงาน",
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
                  $('.num_').html('');
                // alert(data);
                  if(data.status==0){
                    swal("สำเร็จ", "ยุติบทบาทพนักงานเรียบร้อย", "success");
                  }else{
                    swal("Error", "ไม่สามารถยุติบทบาทพนักงานคนนี้ได้", "warning");
                  }
                  fetch_data_employee(); 
                  fetch_data_employee2();
                  document.getElementById('MultiDelete').disabled = true;
                  document.getElementById('MultiEnabled').disabled = true;
                  document.getElementById('MultiDisabled').disabled = true;
              },
           });
        });
      });
      $(document).on('click', '#MultiEnabled', function () {
            formClick = $(this);
            var change = $(this).attr('data-id');
            $('#changeMulti').val(change);
            swal({
            title: "ยืนยัน?",
            text: "คุณแน่ใจหรือจะยกเลิกยุติบทบาทพนักงาน",
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
                  $('.num_').html('');
                  // alert(data);
                    if(data.status==0){
                      swal("สำเร็จ", "ยกเลิกการยุติบทบาทพนักงานเรียบร้อย", "success");
                    }else{
                      swal("Error", "ไม่สามารถยกเลิกยุติบทบาทพนักงานคนนี้ได้", "warning");
                    }
                    fetch_data_employee(); 
                    fetch_data_employee2();
                    document.getElementById('MultiDelete').disabled = true;
                    document.getElementById('MultiEnabled').disabled = true;
                    document.getElementById('MultiDisabled').disabled = true;
              },
           });
        });
      });
        //---------------------------------------Alert Mmodal for notification of delete multiple widget---------------------------------------------------
        var formClick;
       $(document).on('click', '#MultiDelete_w', function () {
            formClick = $(this);
            var change = $(this).attr('data-id');
            $('#changeMulti_w').val(change);
            swal({
            title: "ยืนยัน?",
            text: "คุณแน่ใจหรือจะลบพนักงานที่เลือก",
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
                $('.num_').html('');
                  if(data.status==0){
                    swal("สำเร็จ", "ลบพนักงานที่เลือกเรียบร้อยแล้ว", "success");
                  }else{
                    swal("Error", "ไม่สามารถลบพนักงานที่เลือกได้", "warning");
                  }
                  document.getElementById('MultiDelete_w').disabled = true;
                  document.getElementById('MultiEnabled_w').disabled = true;
                  document.getElementById('MultiDisabled_w').disabled = true;
                  fetch_data_employee(); 
                  fetch_data_employee2();
              },
           });
        });
      });
            $(document).on('click', '#MultiDisabled_w', function () {
            formClick = $(this);
            var change = $(this).attr('data-id');
            $('#changeMulti_w').val(change);
            swal({
            title: "ยืนยัน?",
            text: "คุณแน่ใจหรือจะยุติบทบาทพนักงาน",
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
                  $('.num_').html('');
                // alert(data);
                  if(data.status==0){
                    swal("สำเร็จ", "ยุติบทบาทพนักงานเรียบร้อย", "success");
                  }else{
                    swal("Error", "ไม่สามารถยุติบทบาทพนักงานคนนี้ได้", "warning");
                  }
                  fetch_data_employee(); 
                  fetch_data_employee2();
                  document.getElementById('MultiDelete_w').disabled = true;
                  document.getElementById('MultiEnabled_w').disabled = true;
                  document.getElementById('MultiDisabled_w').disabled = true;
                  $('#checkall').prop('checked',false);
              },
           });
        });
      });

      $(document).on('click', '#MultiEnabled_w', function () {
            formClick = $(this);
            var change = $(this).attr('data-id');
            $('#changeMulti_w').val(change);
            swal({
            title: "ยืนยัน?",
            text: "คุณแน่ใจหรือจะยกเลิกยุติบทบาทพนักงาน",
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
                  $('.num_').html('');
                  // alert(data);
                    if(data.status==0){
                      swal("สำเร็จ", "ยกเลิกการยุติบทบาทพนักงานเรียบร้อย", "success");
                    }else{
                      swal("Error", "ไม่สามารถยกเลิกยุติบทบาทพนักงานคนนี้ได้", "warning");
                    }
                    fetch_data_employee(); 
                    fetch_data_employee2();
                    document.getElementById('MultiDelete_w').disabled = true;
                    document.getElementById('MultiEnabled_w').disabled = true;
                    document.getElementById('MultiDisabled_w').disabled = true;
                    $('#checkall').prop('checked',false);
              },
           });
        });
      });
        //---------------------------------------Send value to edit ---------------------------------------------------------------------------------
        $(document).on('click', '.edit-em', function(){
            var id = $(this).attr('data-id'); 
            location.href = "front-edit.php?id="+id;
        });
        $(document).on('click', '.changed_format', function(){
           var id =$(this).attr('data-id');
           if(id ==1){
            $('#detail_widget-employee').show();
            $('#live_em-list').hide();
            $('#changed_for_list').hide();
            $('#changed_for_widget').show();

            $('#checkall_w').show();
           }else{
            $('#live_em-list').show();
            $('#detail_widget-employee').hide();
            $('#changed_for_list').show();
            $('#changed_for_widget').hide();

            $('#checkall_w').hide();
           }
        });
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
                              url:"back_edit-employeemath.php",  
                              method:"POST",  
                              data:{id:id},
                              success:function(data){  
                                 swal("สำเร็จ", "ลบสินค้าทั้งหมดเรียบร้อยแล้ว", "success");
                                 document.getElementById('MultiDelete').disabled = true;
                                fetch_data_employee();
                                fetch_data_employee2();
                              }  
                          });  
                      });
           
        });
        //-------------------------------------------------------------------------------------------------------------------------------------------------- 

          $(document).on('change', '.level_employee', function(){
            var level = $(this).val();
            var id = $(this).attr('data-id');
            var id_level = level+'-'+id;
            $.ajax({
                // complete: function() { 
                //     swal("สำเร็จ", "เรียบร้อยแล้ว", "success");
                //     fetch_data_employee2();
                // },
                type:'POST',
                url:'ajaxDatalevel.php',
                data:'id_level='+id_level,               
                success:function(html){
                  fetch_data_employee2();
                  fetch_data_employee();
                },  
            }); 
        });
    });
        function ClickCheckAll_W(){
         var i=1;
          for(i=1;i<=document.frmMain_w.hdnCount_w.value;i++){
            $('.num_w').html('[ '+i+' ]');
            if($('#checkall').is(":checked")){
             eval("document.frmMain_w.crck"+i+".checked=true");
              $(".discard").addClass("overlay-cover-del"); 
              $(".icon-del").show();
            <?php if($button_del_s==''){ ?>
                document.getElementById('MultiDelete_w').disabled = false; 
            <?php } ?>

            <?php if($button_del==''){ ?>
                document.getElementById('MultiDisabled_w').disabled = false;  
            <?php } ?>

            <?php if($button_del_s==''){ ?>
                document.getElementById('MultiEnabled_w').disabled = false; 
            <?php } ?>    

            }else{

              $('.num_w').html('');
              eval("document.frmMain_w.crck"+i+".checked=false");
              $(".icon-del").hide();
            <?php if($button_del_s==''){ ?>
                document.getElementById('MultiDelete_w').disabled = true;
            <?php } ?>

            <?php if($button_del==''){ ?>
                document.getElementById('MultiDisabled_w').disabled = true;
            <?php } ?>

            <?php if($button_del_s==''){ ?>
                document.getElementById('MultiEnabled_w').disabled = true;
            <?php } ?>
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
            $('.num_').html('[ '+i+' ]');
            if(vol.checked == true)
            {
              eval("document.frmMain.Chk"+i+".checked=true");
              $("tr").addClass("remove-item"); 
    <?php if($button_del_s==''){ ?>
              document.getElementById('MultiDelete').disabled = false; 
    <?php } ?>

    <?php if($button_del==''){ ?>
              document.getElementById('MultiDisabled').disabled = false; 
    <?php } ?>

    <?php if($button_del_s==''){ ?> 
              document.getElementById('MultiEnabled').disabled = false;   
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
              document.getElementById('MultiDisabled').disabled = true;
    <?php } ?>

    <?php if($button_del_s==''){ ?>
              document.getElementById('MultiEnabled').disabled = true;
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
              document.getElementById('MultiDisabled').disabled = false; 
    <?php } ?>

    <?php if($button_del_s==''){ ?> 
              document.getElementById('MultiEnabled').disabled = false;   
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
              document.getElementById('MultiDisabled').disabled = true;
    <?php } ?>

    <?php if($button_del_s==''){ ?>
              document.getElementById('MultiEnabled').disabled = true;
    <?php } ?>
              }
              
          }
        });
        //---------------------------------------------------Add Class---------------------------------------------------------------------------------
        $(document).on('click', '.cr-image', function(){ 
          var i =0; 
          var id = $(this).attr('data-id');
          if($('.crck_w'+id).is(":checked")){
             $('.crck_w'+id).prop('checked', false);
             $('.overlay-image'+id).removeClass('overlay-cover-del');
             $('#icon-del'+id).hide();
              if($('.discard').hasClass('overlay-cover-del')){
            <?php if($button_del_s==''){ ?>
                document.getElementById('MultiDelete_w').disabled = false; 
            <?php } ?>

            <?php if($button_del==''){ ?>
                document.getElementById('MultiDisabled_w').disabled = false;  
            <?php } ?>

            <?php if($button_del_s==''){ ?>
                document.getElementById('MultiEnabled_w').disabled = false; 
            <?php } ?>

              }else{

            <?php if($button_del_s==''){ ?>
                document.getElementById('MultiDelete_w').disabled = true;
            <?php } ?>

            <?php if($button_del==''){ ?>
                document.getElementById('MultiDisabled_w').disabled = true;
            <?php } ?>

            <?php if($button_del_s==''){ ?>
                document.getElementById('MultiEnabled_w').disabled = true;
            <?php } ?>
                $('.overlay-cover-del').each(function() {
                  i++;       
                }); 
                $('.num_w').html('[ '+i+' ]'); 
              }
           }else{
              $('.overlay-image'+id).addClass('overlay-cover-del');
              $('#icon-del'+id).show();
              $('.crck_w'+id).prop('checked', true);
            <?php if($button_del_s==''){ ?>
                document.getElementById('MultiDelete_w').disabled = false; 
            <?php } ?>

            <?php if($button_del==''){ ?>
                document.getElementById('MultiDisabled_w').disabled = false;  
            <?php } ?>

            <?php if($button_del_s==''){ ?>
                document.getElementById('MultiEnabled_w').disabled = false; 
            <?php } ?>
              $('.overlay-cover-del').each(function() {
                i++;       
              }); 
              $('.num_w').html('[ '+i+' ]'); 
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

  $(document).on('click', '#add_type', function () {
           var formData = new FormData($('#frm_add_type')[0]);
           
            swal({
            title: "ยืนยัน?",
            text: "ยืนยันการบันทึก",
            type: "info",
            showCancelButton: true,
            cancelButtonText: "ยกเลิก",
            confirmButtonClass: "btn-primary",
            confirmButtonText: "ยืนยัน",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
            }, function () {
            $.ajax({
              type: "POST",
              url: "functions.php",
              data: $("#frm_add_type").serialize(),
              success: function(data) { 
                  // $('.num_').html('');
                   //alert(data.status);
                    if(data.status==0){
                      swal("สำเร็จ", "บันทึกเรียบร้อย", "success");
                    }else{
                      swal("Error", "เกิดปัญหากับระบบ", "warning");
                    }
                          var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
    $.ajax({   
            url:'select_type.php', 
            method:'POST',  
            data:{_method:'manage_type',button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},  
            //dataType:"json", 
          
                success:function(data){  
                    //console.log(response.data[0]['path_slip']);
               

              
                   $("#add_data").html(data); 
                   $("#modal_add").modal('show'); 
                }, 

                   
           });  
                    
                    // fetch_data_employee(); 
                    // fetch_data_employee2();
                    // document.getElementById('MultiDelete').disabled = true;
                    // document.getElementById('MultiEnabled').disabled = true;
                    // document.getElementById('MultiDisabled').disabled = true;
              },
           });
        });
      });





   $(document).on('click', '#edit_type', function () {
           var formData = new FormData($('#frm_edit_type')[0]);
           
            swal({
            title: "ยืนยัน?",
            text: "ยืนยันการแก้ไข?",
            type: "info",
            showCancelButton: true,
            cancelButtonText: "ยกเลิก",
            confirmButtonClass: "btn-primary",
            confirmButtonText: "ยืนยัน",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
            }, function () {
            $.ajax({
              type: "POST",
              url: "functions.php",
              data: $("#frm_edit_type").serialize(),
              success: function(data) { 
                  // $('.num_').html('');
                   //alert(data.status);
                    if(data.status==0){
                      swal("สำเร็จ", "แก้ไขเรียบร้อย", "success");
                    }else{
                      swal("Error", "เกิดปัญหากับระบบ", "warning");
                    }
                          var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
    $.ajax({   
            url:'select_type.php', 
            method:'POST',  
            data:{_method:'manage_type',button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},  
            //dataType:"json", 
          
                success:function(data){  
                    //console.log(response.data[0]['path_slip']);
               

              
                   $("#add_data").html(data); 
                   $("#modal_add").modal('show'); 
                }, 

                   
           });  
                    // fetch_data_employee2();
                    // document.getElementById('MultiDelete').disabled = true;
                    // document.getElementById('MultiEnabled').disabled = true;
                    // document.getElementById('MultiDisabled').disabled = true;
              },
           });
        });
      });


       $(document).on('click', '#btnEdit_icon', function(){ 
  var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
            $("#div_add_type").hide();
            $("#div_edit_type").show();
            var id = $(this).attr('data-id');
             var id_icon_type = $(this).attr('data-id1');
                $.ajax({
                type: "POST",
                    url:"select_type.php?_method=select_edit_type",  
                   data: {id_edit:id,id_icon_type:id_icon_type,button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},
                   
                    success: function(data) {
                     //alert(data);
                     console.log(data);
                     $('#div_edit_type').html(data); 
                     $("#div_add_type").hide();
               
                      
                  },
                    error: function (error) {
                        
                    }
            });

            
        }) 
        $(document).on('click', '#btnsend_reset_add', function(){ 

            $("#div_add_type").show();
            $("#div_edit_type").hide();
        

            
        })

               $(document).on('click', '#btn_show_type', function(){ 
  var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
            $("#div_add_type").hide();
            $("#div_edit_type").show();
            var id = $(this).attr('data-id');
             var id_icon_type = $(this).attr('data-id1');
                $.ajax({
                type: "POST",
                    url:"select_type.php?_method=select_show_type",  
                   data: {id_edit:id,id_icon_type:id_icon_type,button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},
                   
                    success: function(data) {
                     //alert(data);
                     console.log(data);
                     $('#div_edit_type').html(data); 
                     $("#div_add_type").hide();
               
                      
                  },
                    error: function (error) {
                        
                    }
            });

            
        }) 

          $(document).on('click', '.delete-type', function(){  
            var id = $(this).attr('data-id'); 
            var form = 'del_type';
            swal({
            title: "ยืนยัน?",
            text: "ยืนยันการลบ?",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "ยกเลิก",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "ยืนยัน",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
            }, function () {
            $.ajax({     
                type:"POST",
                url:'functions.php',
                data: {id:id,
                       form:form},             
                success:function(data){
                  // alert(data.status);
                  if (data.status=='0') {
                    swal("สำเร็จ", "ลบเรียบร้อยแล้ว", "success");
                  }else{
                      swal("ไม่สำเร็จ", "เกิดปัญหากับระบบ", "warning");
                  }
                  
                      var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
    $.ajax({   
            url:'select_type.php', 
            method:'POST',  
            data:{_method:'manage_type',button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},  
            //dataType:"json", 
          
                success:function(data){  
                    //console.log(response.data[0]['path_slip']);
               

              
                   $("#add_data").html(data); 
                   $("#modal_add").modal('show'); 
                }, 

                   
           });  
                 
                },
                  
            }); 
         });
      });

               function fetch_data_type()  
          {  
              $.ajax({  
                  url:"select_type.php",  
                  method:"POST",  
                   data:{_method:'manage_type',button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},  
            //dataType:"json", 
          
                success:function(data){  
                    //console.log(response.data[0]['path_slip']);
               

              
                   $("#add_data").html(data); 
                   $("#modal_add").modal('show'); 
                }, 

              });  
          }
          
          
          function order_number(i,id){

            var order = document.getElementById('order_no'+i).value;
            var id =  id;
            // alert(order);
                    $.ajax({   
                    url:'functions.php', 
                    method:'POST',  
                    data:{_method:'order',id:id,order:order},  
                    //dataType:"json", 
                  
                        success:function(data){  
                          //  console.log(data);
                      

                      
                          // $("#add_data").html(data); 
                          // $("#modal_add").modal('show'); 
                        }, 

                          
                  });  


          }
</script>
</body>
</html>
