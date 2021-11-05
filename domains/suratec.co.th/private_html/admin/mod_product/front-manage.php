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
  <link rel="stylesheet" href="css/table-product.css">
  <!--Css loader -->
  <!-- sweet alert -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css.map">
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
          height:300px;
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
          text-align: center;
          font-size:0px; 
          width:70px; 
          height:50px; 
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
        .sort-product{
          transition: 0.4s;
          border-radius: 0;
        }
        .sort-product:hover{
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
  <div class="overlay wait-table" style="display: none;">
    <div class="loader">
        <div class="loader-inner line-scale">
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
        </div>
      </div>
    </div>
<div class="wrapper">
   <?php require_once '../template/nav_menu.php'; ?>
   <?php require_once '../library/permission.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" >
      <h1>
        จัดการสินค้า
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../index.php"></i>แดชบอร์ด</a></li>
        <li class="active">จัดการสินค้า</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          
           <input type="hidden" name="per_button_edit" id="per_button_edit" value="<?php echo $button_edit ?>">
           <input type="hidden" name="per_button_del" id="per_button_del" value="<?php echo $button_del ?>">
           <input type="hidden" name="per_button_open" id="per_button_open" value="<?php echo $button_open ?>">
            <input type="hidden" name="per_input_read" id="per_input_read" value="<?php echo $input_read ?>">
        
          <!-- general form elements -->
       
          <!-- /.box -->

          <div class="alert alert-success alert-dismissible" id="result_level" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <div id="loader_level">
              <h4><i class="fa fa-circle-o-notch fa-spin"></i></h4>
              Updating...
            </div>
            <div id="success_level">
              <h4><i class="icon fa fa-check"></i> Updated!</h4>
              Update data successful.
            </div>
          </div>

        <div class="alert alert-success alert-dismissible" id="result_del" style="display: none;">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <div id="loader_del">
            <h4><i class="fa fa-circle-o-notch fa-spin"></i></h4>
            Deleting...
          </div>
          <div id="success_del">
            <h4><i class="icon fa fa-check"></i> Deleted!</h4>
            Delete data successful.
          </div>
        </div>

        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-warning">&nbsp;&nbsp;</i>คำเตือน</h4>
              </div>
              <div class="modal-body">
                <center><img src="../img/close.png" width="60" height="60"><h4>ยืนยันการลบรายการที่เลือกหรือไม่</h4></center>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-primary" id="btnYes">ยืนยัน</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal fade" id="modal-delete-product">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-warning">&nbsp;&nbsp;</i>คำเตือน</h4>
              </div>
              <div class="modal-body">
                <form action="" id="frmDEL" name="frmDEL" method="post">
                <input type="hidden" name="id_del_product" id="id_del_product">
                <center><img src="../img/close.png" width="60" height="60"><h4>ยืนยันการลบหรือไม่</h4></center>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-primary btnSendDel">ยืนยัน</button>
                </form>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
       
          <div class="col-md-6" >
            <div class="box box-danger">
              <div class="box-header">
                <h3 class="box-title">ค้นหา</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                </div>
              </div>
              <div class="box-body">
                <div class="col-md-6" style="padding-bottom: 5px;">
                  <div class="input-group">
                        <span class="input-group-addon">หมวดหมู่</span>
                        <select class="form-control" id="changed_dist_list">
                          <option value="">ทั้งหมด</option>
                          <?php 
                            $str_dist1 = "SELECT * FROM product_catagory WHERE level = '1' ";
                            $query_dist1 = mysqli_query($objConnect,$str_dist1);
                            while($result_dist1 = mysqli_fetch_array($query_dist1)){
                              ?><option value="<?php echo $result_dist1['id_catagory']; ?>"><?php echo $result_dist1['name_catagory'] ?></option>
                            <?php 
                              $str_dist2 = "SELECT * FROM product_catagory WHERE level = '2' AND group_sub = '".$result_dist1['id_catagory']."'";
                              $query_dist2 = mysqli_query($objConnect,$str_dist2);
                              while($result_dist2 = mysqli_fetch_array($query_dist2)){
                                ?><option value="<?php echo $result_dist2['id_catagory']; ?>">-<?php echo $result_dist2['name_catagory'] ?></option>
                              <?php 
                                $str_dist3 = "SELECT * FROM product_catagory WHERE level = '3' AND group_sub = '".$result_dist2['id_catagory']."'";
                                $query_dist3 = mysqli_query($objConnect,$str_dist3);
                                while($result_dist3 = mysqli_fetch_array($query_dist3)){
                                  ?><option value="<?php echo $result_dist3['id_catagory']; ?>">--<?php echo $result_dist3['name_catagory'] ?></option>
                                <?php 
                                }
                              }
                            }
                          ?>
                    </select>
                  </div>
                </div>
                
                <div class="col-md-6" style="padding-bottom: 5px;">
                  <input type="text" name="name" id="name_p" class="form-control" placeholder="กรอกข้อมูล เช่น ชื่อ  ราคา" value="">
                  <input type="checkbox" name="" id="find-ck-2" style="display: none;">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          
        </div>
        <div class="box box-primary" id="detail_list-product">
          <div class="box-header with-border">
            <h3 class="box-title">จัดการสินค้า</h3>
            <div class="btn-group">
              <span class="btn sort-product n"  data-id="n"  data-c="n1" style="border-right: 1px solid #ddd; border-left: 1px solid #ddd;"><i class="fa fa-sort-alpha-desc"></i> ชื่อ</span>
              <span class="btn sort-product n1" data-id="n1" data-c="n"  style="border-right: 1px solid #ddd; border-left: 1px solid #ddd; display: none; margin-left: 0.2px;"><i class="fa fa-sort-alpha-asc"></i> ชื่อ</span>
              <span class="btn sort-product p"  data-id="p"  data-c="p1" style="border-right: 1px solid #ddd;"><i class="fa fa-sort-amount-asc"></i> ราคา</span>
              <span class="btn sort-product p1" data-id="p1" data-c="p"  style="border-right: 1px solid #ddd; display: none;"><i class="fa fa-sort-amount-asc"></i> ราคา</span>
              <span class="btn sort-product l"  data-id="l"  data-c="l1" style="border-right: 1px solid #ddd;"><i class="fa fa-sort-numeric-asc"></i> ลำดับ</span>
              <span class="btn sort-product l1" data-id="l1" data-c="l"  style="border-right: 1px solid #ddd; display: none;"><i class="fa fa-sort-numeric-desc"></i> ลำดับ</span>
              <span class="btn sort-product d"  data-id="d"  data-c="d1" style="border-right: 1px solid #ddd;"><i class="fa fa-sort-desc"></i> วันที่</span>
              <span class="btn sort-product d1" data-id="d1" data-c="d"  style="border-right: 1px solid #ddd; display: none;"><i class="fa fa-sort-up"></i> วันที่</span>
            </div>
            <label onclick="checkall();" id="checkall_w" style="display: none; margin: 0 !important;">
                <input id="checkall"  type="checkbox" name="transport" value="1" >
                เลือกทั้งหมด
              </label>
            <!-- <a href="#" class="changed_format" data-id="1" style="font-size: 18px;">
              <i class="fa fa-th pull-right" style=" cursor: pointer;"></i>
            </a> -->
            <a href="#" class="changed_format" data-id="2" style="font-size: 18px;">
              <i class="fa fa-th-list pull-right" style=" cursor: pointer;"></i>
            </a>
            <button type="button" class="btn btn-success btn-sm pull-right" onclick="javascript:location.href='front-add.php'" style="margin-right: 10px; height: 20px; padding: 1px; padding-left: 5px; padding-right: 5px; <?php echo $button_open ?>"><i class="fa fa-plus"></i>&nbsp;&nbsp;เพิ่มสินค้า</button>
          </div>
          <div class="box-body" style="padding: 0;">
            <form action="" name="frmMain" id="frmMain" method="post">
              <div id="live_data-product"></div> 
              <div class="boxsave" id="box-del-list" style="<?php echo $button_del_s; ?>">
                <button type="button" class="delmulti-menu btn btn-danger" style="transition: 0.4s; <?php echo $button_del_s; ?>" id="MultiDelete" disabled><i class="fa fa-remove"></i> ลบรายการทั้งหมด</button>

               <!--  <button type="button" class="delmulti-menu btn btn-primary pull-right" style="transition: 0.4s; margin-left: 10px;" id="gen-qr-all"><i class="fa fa-qrcode"></i> 
                แปลงรายการทั้งหมด</button>
                <button type="button" class="delmulti-menu btn btn-info pull-right" style="transition: 0.4s;" id="gen-qr"><i class="fa fa fa-qrcode"></i> แปลงรายการที่เล่ือก</button> -->
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
          <div id="live_data-product-2"></div>
          <div class="boxsave" id="box-del-widget" style="z-index: 56; <?php echo $button_del_s; ?>">
              <button type="button" class="delmulti-menu btn btn-danger" style="transition: 0.4s; <?php echo $button_del_s; ?>" id="MultiDelete_w" disabled><i class="fa fa-remove"></i> ลบรายการทั้งหมด</button>
          </div>
          </form>
          
        </div>
      </div>
    </div>
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<script src="components/bootstrap-toggle.min.js"></script>
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

<script type="text/javascript">
  $(document).ajaxStart(function () {
    Pace.restart()
  })
    //-------------------------------------------------------------------form admin LTE---------------------------------------------------------
    $(function(){
      //Date range as a button
      $('#daterange-btn').daterangepicker(
        {
          ranges   : {
            'Today'       : [moment(), moment()],
            'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month'  : [moment().startOf('month'), moment().endOf('month')],
            'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate  : moment()
        },
        function (start, end) {
          $('#daterange-btn span').html('<font style="font-size:10px;">'+start.format('D MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY')+'</font>')
          var date = start.format('YYYY-MM-DD') + '/' + end.format('YYYY-MM-DD');
          $('#date_p_d').val(date)
        }
      )

       $('#daterange-btn-fast').daterangepicker(
        {
          ranges   : {
            'Today'       : [moment(), moment()],
            'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month'  : [moment().startOf('month'), moment().endOf('month')],
            'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate  : moment()
        },
        function (start, end) {
          $('#daterange-btn-fast span').html('<font style="font-size:10px;">'+start.format('D MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY')+'</font>')
          var date = start.format('YYYY-MM-DD') + '/' + end.format('YYYY-MM-DD');
          var date_fast =  $('#date_p_d-fast').val(date);
          $('#name_p').val('');
          $("select#changed_dist_list").prop('selectedIndex', 0);
          $('#find-ck-2').prop('checked',true);
          $('#find-ck-1').prop('checked',false);
          fetch_data_product_date(date);
          fetch_data_product_date_list(date);
        }
      )
    });
    //----------------------------------------------------------------------fetch date----------------------------------------------------------
     function fetch_data_product_date(date)  
          {  
              $.ajax({  
                  url:"live_data-product-2.php",  
                  method:"POST",  
                  data:{date_p_fast:date},
                  success:function(data){  
                  $('#live_data-product-2').html(data);  
                  }  
              });  
          }  
        function fetch_data_product_date_list(date)  
          {  
            var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
           
              $.ajax({  
                  url:"select_table-product.php",  
                  method:"POST",  
                  data:{date_p_fast:date,button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read },
                  success:function(data){  
                  $('#live_data-product').html(data);  
                  }  
              });  
          }  
    //-------------------------------------------------------------------------------------------------------------------------------------------
     //---------------------------------------------------------------!! form admin LTE----------------------------------------------------------
   $(document).ready(function(){
    // sort product
    $(document).on('click', '.sort-product', function(){
        var sort = $(this).attr('data-id');
        var ch = $(this).attr('data-c');
        $('.sort-product').removeClass('sort-active');
        $(this).hide();
        $('.'+ch).show();
        $('.'+ch).addClass('sort-active');
        var name_d   = $('#name_p_d').val();
        var code_d   = $('#code_p_d').val();
        var cat_d    = $('#cat_p_d').val();
        var date_d   = $('#date_p_d').val();
        // alert(sort+name_d+code_d+cat_d+status_d+date_d);
        if($('#find-ck-1').is(':checked')){
          fetch_data_product_detail(name_d,code_d,cat_d,date_d,sort);      //ใช้ฟังชั่นร่วมกับ ค้นหา detail
          fetch_data_product_detail_list(name_d,code_d,cat_d,date_d,sort); //ใช้ฟังชั่นร่วมกับ ค้นหา detail
        }else if($('#find-ck-2').is(':checked')){
          var name_f        = $('#name_p').val();
          var date_f   = $('#date_p_d-fast').val();
          var cat_f         = $('#changed_dist_list').val();
          fetch_data_product_find_fast(cat_f,name_f,date_f,sort);      //ใช้ฟังชั่นร่วมกับ ค้นหา detail
          fetch_data_product_find_fast_list(cat_f,name_f,date_f,sort); //ใช้ฟังชั่นร่วมกับ ค้นหา detail
        }else{
          fetch_data_product_sort(sort);
          fetch_data_product_sort2(sort);
        }
    });
    //fetch sort
     function fetch_data_product_sort(sort)  
          {  
              $.ajax({  
                  url:"live_data-product-2.php",  
                  method:"POST",  
                  data:{sort:sort},
                  success:function(data){  
                  $('#live_data-product-2').html(data);  
                  }  
              });  
          }  
        function fetch_data_product_sort2(sort)  
          {  
            var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
              $.ajax({  
                  url:"select_table-product.php",  
                  method:"POST",  
                  data:{sort:sort,button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},
                  success:function(data){  
                  $('#live_data-product').html(data);  
                  }  
              });  
          }  
    //fetch sort
     function fetch_data_product_find_fast(cat_f,name_f,date_f,sort)  
          {  
              $.ajax({  
                  url:"live_data-product-2.php",  
                  method:"POST",  
                  data:{cat:cat_f,
                        name:name_f,
                        date_p_fast:date_f,
                        sort:sort},
                  success:function(data){  
                  $('#live_data-product-2').html(data);  
                  }  
              });  
          }  
        function fetch_data_product_find_fast_list(cat_f,name_f,date_f,sort)  
          {  
            var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
              $.ajax({  
                  url:"select_table-product.php",  
                  method:"POST",  
                 data:{cat:cat_f,
                        name:name_f,
                        date_p_fast:date_f,
                        sort:sort,button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},
                  success:function(data){  
                  $('#live_data-product').html(data);  
                  }  
              });  
          }  
    //fetch sort with find fast
    //-------------------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------start find detail---------------------------------------------------------
        $(document).on('click', '#send_find-detail', function(){
          var name_d   = $('#name_p_d').val();
          var code_d   = $('#code_p_d').val();
          var cat_d    = $('#cat_p_d').val();
          var date_d   = $('#date_p_d').val();
          if(name_d==''&& code_d =='' && cat_d=='' && date_d ==''){  
            $( "#find-ck-1" ).prop( "checked", false );
            $('#validate-send-find').show();
              setTimeout(function(){ 
              $('#validate-send-find').fadeOut(500); }, 4000);
            return false;
          }
          $( "#find-ck-1" ).prop( "checked", true );
          $('#find-ck-2').prop('checked',false);
          fetch_data_product_detail(name_d,code_d,cat_d,date_d);
          fetch_data_product_detail_list(name_d,code_d,cat_d,date_d);

        });
        function fetch_data_product_detail(name_d,code_d,cat_d,date_d,sort)  
          {  
              $.ajax({  
                  url:"live_data-product-2.php",  
                  method:"POST",  
                  data:{name_d:name_d,
                        code_d:code_d,
                        cat_d:cat_d,
                        date_d:date_d,
                        sort:sort},
                  success:function(data){  
                  $('#live_data-product-2').html(data);  
                  }  
              });  
          }  
        function fetch_data_product_detail_list(name_d,code_d,cat_d,date_d,sort)  
          {  
            var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
              $.ajax({  
                  url:"select_table-product.php",  
                  method:"POST",  
                  data:{name_d:name_d,
                        code_d:code_d,
                        cat_d:cat_d,
                        date_d:date_d,
                        sort:sort
                      ,button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},
                  success:function(data){  
                  $('#live_data-product').html(data);  
                  }  
              });  
          } 
        //------------------------------------------------------------------------claer form send----------------------------------------------------------
        $(document).on('click', '#send_find-clear', function(){
          $('#find-ck-1').prop('checked',false);
          $('#name_p_d').val('');
          $('#code_p_d').val('');
          $("select#cat_p_d").prop('selectedIndex', 0);
          $("select#status_p_d").prop('selectedIndex', 0);
          $("#date_p_d").val('');

          $('#daterange-btn span').html('<i class="fa fa-calendar"></i> วันที่แก้ไขล่าสุด');
        })
        //------------------------------------------------------------------------fetch all----------------------------------------------------------------
        $(document).on('click', '#send_find-all', function(){
          $('#find-ck-1').prop('checked',false);
          $('#find-ck-2').prop('checked',false);
          fetch_data_product();
          fetch_data_product2();
        })
        //-------------------------------------------------------------------------------------------------------------------------------------------------- 

        //------------------------------------------------------------------------start find fast-----------------------------------------------------------
        //-------------------------------------------------------------------------find name-----------------------------------------------------------------
        $(document).on('keyup', '#name_p', function()
        {
              $("select#changed_dist_list").prop('selectedIndex', 0);
              $("#date_p_d-fast").val('');
              $('#daterange-btn-fast span').html('<i class="fa fa-calendar"></i> วันที่แก้ไขล่าสุด');
              var id = $(this).val();
              if (id == '') {
                $('#find-ck-2').prop('checked',false);
                fetch_data_product_name();
                fetch_data_product_name_list();
              }else{
                $('#find-ck-2').prop('checked',true);
                $('#find-ck-1').prop('checked',false);
                fetch_data_product_name(id);
                fetch_data_product_name_list(id);
              }
          });
        function fetch_data_product_name(name)  
          {  
              $.ajax({  
                  url:"live_data-product-2.php",  
                  method:"POST",  
                  data:{name:name},
                  success:function(data){  
                  $('#live_data-product-2').html(data);  
                  }  
              });  
          }  
        function fetch_data_product_name_list(name)  
          {  
             var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
              $.ajax({  
                  url:"select_table-product.php",  
                  method:"POST",  
                  data:{name:name,button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},
                  success:function(data){  
                  $('#live_data-product').html(data);  
                  }  
              });  
          }  
        //-------------------------------------------------------------------------change fast cat------------------------------------------------------------
        $(document).on('change', '#changed_dist_list', function(){
          $('#name_p').val('');
          $("#date_p_d-fast").val('');
          $('#daterange-btn-fast span').html('<i class="fa fa-calendar"></i> วันที่แก้ไขล่าสุด');
          var id = $(this).val();
          if (id == '') {
            $('#find-ck-2').prop('checked',false);
            fetch_data_product_cat();
            fetch_data_product_cat_list();
          }else{
            $('#find-ck-2').prop('checked',true);
            $('#find-ck-1').prop('checked',false);
            fetch_data_product_cat(id);
            fetch_data_product_cat_list(id);
          }
        });

        function fetch_data_product_cat(cat)  
          {  
              $.ajax({  
                  url:"live_data-product-2.php",  
                  method:"POST",  
                  data:{cat:cat},
                  success:function(data){  
                  $('#live_data-product-2').html(data);  
                  }  
              });  
          }  
        function fetch_data_product_cat_list(cat)  
          {  
             var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
              $.ajax({  
                  url:"select_table-product.php",  
                  method:"POST",  
                  data:{cat:cat,button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},
                  success:function(data){  
                  $('#live_data-product').html(data);  
                  }  
              });  
          }  
        //-------------------------------------------------------------------------!change fast cat------------------------------------------------------------
          //------------------------------------------------------------fetch data article-------------------------------------------------------
          function fetch_data_product(page,cat,date_f,name_f,name,code,cat_,date,sort)  
          {  
            var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
              $.ajax({  
                  url:"select_table-product.php",  
                  method:"POST",  
                  data:{page:page,
                        cat:cat,
                        date_p_fast:date_f,
                        name:name_f,
                        name_d:name,
                        code_d:code,
                        cat_d:cat_,

                        date_d:date,
                        sort:sort
                      ,button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},
                  success:function(data){  
              $('#live_data-product').html(data);  
                  }  
              });  
          }  
          fetch_data_product();
          function fetch_data_product2(page,cat,date_f,name_f,name,code,cat_,date,sort)  
          {  
              $.ajax({ 
                  url:"live_data-product-2.php",  
                  method:"POST",  
                  data:{page:page,
                        cat:cat,
                        date_p_fast:date_f,
                        name:name_f,
                        name_d:name,
                        code_d:code,
                        cat_d:cat_,
                        date_d:date,
                        sort:sort},
                  success:function(data){  
              $('#live_data-product-2').html(data);  
                  }  
              });  
          }  
          fetch_data_product2();
          //------------------------------------------------------------pagination link-----------------------------------------------------------
          $(document).on('click', '.pagination_link', function(){
            var page = $(this).attr("id");
            var cat = $(this).attr("data-ser");
            var date_f = $(this).attr("data-d-fast");
            var name_f = $(this).attr("data-n-fast");
            var name = $(this).attr('data-n');
            var code = $(this).attr('data-c');
            var cat_ = $(this).attr('data-ca');
            var stat = $(this).attr('data-s');
            var date = $(this).attr('data-d');
            var sort = $(this).attr('data-sort');
            fetch_data_product(page,cat,date_f,name_f,name,code,cat_,stat,date,sort);
            document.getElementById('MultiDelete').disabled = true;
          });
          $(document).on('click', '.pagination_link_w', function(){
            var page = $(this).attr("id");
            var cat = $(this).attr("data-ser");
            var date_f = $(this).attr("data-d-fast");
            var name_f = $(this).attr("data-n-fast");
            var name = $(this).attr('data-n');
            var code = $(this).attr('data-c');
            var cat_ = $(this).attr('data-ca');
            var stat = $(this).attr('data-s');
            var date = $(this).attr('data-d');
            var sort = $(this).attr('data-sort');
            fetch_data_product2(page,cat,date_f,name_f,name,code,cat_,stat,date,sort);
            document.getElementById('MultiDelete').disabled = true;
          });

        //-------------------------------Delete article show modal alert before send value to delete----------------------------------------------
        $(document).on('click', '.delete-product', function(){  
            var id = $(this).attr('data-id'); 
            $('#id_del_product').val(id);;
            swal({
            title: "ยืนยัน?",
            text: "คุณแน่ใจหรือจะลบสินค้าชิ้นนี้",
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
                url:'back_product-delete.php',
                data: $("#frmDEL").serialize(),             
                success:function(data){
                    // alert(data);
                    if(data == 'exist'){
                      swal("ไม่สามารถลบได้", "ไม่สามารถลบสินค้าชิ้นนี้ได้ เนื่องจากมีออร์เดอร์อยู่", "warning");
                      return false;
                    }else{
                      swal("สำเร็จ", "ลบสินค้าเรียบร้อยแล้ว", "success");
                    }
                    fetch_data_product(); 
                    fetch_data_product2();
                },
            }); 
         });
      });
        //---------------------------------------Alert Mmodal for notification of delete multiple---------------------------------------------------
        var formClick;
        $(document).on('click', '#MultiDelete', function () {
            formClick = $(this);
            swal({
            title: "ยืนยัน?",
            text: "คุณแน่ใจหรือจะลบสินค้าที่เลือก",
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
              url: "back_product-deletemulti.php",
              data: $("#frmMain").serialize(),
              success: function(data) { 
                  if(data.indexOf("exist")>0){
                      swal({
                      title: "ตำเตือน",
                      text: "สินค้าบางชิ้นไม่สามารถลบได้ เนื่องจากมีออร์เดอร์อยู่",
                      type: "warning",
                      showCancelButton: false,
                      cancelButtonText: "ยกเลิก",
                      confirmButtonClass: "btn-danger",
                      confirmButtonText: "ยืนยัน",
                      closeOnConfirm: false,
                      },function() {
                          swal("สำเร็จ", "ลบสินค้าทั้งหมดเรียบร้อยแล้ว", "success");
                          document.getElementById('MultiDelete').disabled = true;
                      });
                  }
                  else if(data.indexOf('exist')==0){
                    swal("ไม่สามารถลบได้", "ไม่สามารถลบสินค้าชิ้นนี้ได้ เนื่องจากมีออร์เดอร์อยู่", "warning");
                    document.getElementById('MultiDelete').disabled = true;
                  }else{
                     swal("สำเร็จ", "ลบสินค้าทั้งหมดเรียบร้อยแล้ว", "success");
                     document.getElementById('MultiDelete').disabled = true;
                  }
                  fetch_data_product(); 
                  fetch_data_product2();
              },
           });
        });
      });
        //---------------------------------------Alert Mmodal for notification of delete multiple widget---------------------------------------------------
        var formClick;
        $(document).on('click', '#MultiDelete_w', function () {
         formClick = $(this);
          swal({
            title: "ยืนยัน?",
            text: "คุณแน่ใจหรือจะลบสินค้าที่เลือก",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "ยกเลิก",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "ยืนยัน",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
            }, function () {
            $.ajax({
              // complete: function(argument) {
              //   swal("สำเร็จ", "ลบสินค้าทั้งหมดเรียบร้อยแล้ว", "success");
              //   document.getElementById('MultiDelete_w').disabled = true;
              // },
              type: "POST",
              url: "back_product-deletemulti.php",
              data: $("#frmMain_w").serialize(),
              success: function(data) { 
                  // alert(data);
                  if(data.indexOf("exist")>0){
                      swal({
                      title: "ตำเตือน",
                      text: "สินค้าบางชิ้นไม่สามารถลบได้ เนื่องจากมีออร์เดอร์อยู่",
                      type: "warning",
                      showCancelButton: false,
                      cancelButtonText: "ยกเลิก",
                      confirmButtonClass: "btn-danger",
                      confirmButtonText: "ยืนยัน",
                      closeOnConfirm: false,
                      },function() {
                          swal("สำเร็จ", "ลบสินค้าทั้งหมดเรียบร้อยแล้ว", "success");
                          document.getElementById('MultiDelete_w').disabled = true;
                        });
                  }
                  else if(data.indexOf('exist')==0){
                    swal("ไม่สามารถลบได้", "ไม่สามารถลบสินค้าชิ้นนี้ได้ เนื่องจากมีออร์เดอร์อยู่", "warning");
                    document.getElementById('MultiDelete_w').disabled = true;
                  }else{
                     swal("สำเร็จ", "ลบสินค้าทั้งหมดเรียบร้อยแล้ว", "success");
                     document.getElementById('MultiDelete_w').disabled = true;
                  }
                  fetch_data_product(); 
                  fetch_data_product2();
              },
           });
        });
      });
        //---------------------------------------Send value to edit ---------------------------------------------------------------------------------
        $(document).on('click', '.edit-product', function(){
            var id = $(this).attr('data-id'); 
            location.href = "front-edit.php?id="+id;
        });
        $(document).on('click', '.show-product', function(){
            var id = $(this).attr('data-id'); 
            location.href = "show_data_product.php?id="+id;
        });
        $(document).on('click', '.changed_format', function(){
           var id =$(this).attr('data-id');
           if(id ==1){
            $('#detail_widget-product').show();
            $('#live_data-product').hide();
            $('#changed_for_list').hide();
            $('#changed_for_widget').show();
            $('#MultiDelete_w').show();
            $('#MultiDelete').hide();
            $('#checkall_w').show();
           }else{
            $('#live_data-product').show();
            $('#detail_widget-product').hide();
            $('#changed_for_list').show();
            $('#changed_for_widget').hide();
            $('#MultiDelete').show();
            $('#MultiDelete_w').hide();
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
                              url:"back_edit-productmath.php",  
                              method:"POST",  
                              data:{id:id},
                              success:function(data){  
                                 swal("สำเร็จ", "ลบสินค้าทั้งหมดเรียบร้อยแล้ว", "success");
                                 document.getElementById('MultiDelete').disabled = true;
                                fetch_data_product();
                                fetch_data_product2();
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
                //     fetch_data_product2();
                // },
                type:'POST',
                url:'ajaxDatalevel.php',
                data:'id_level='+id_level,               
                success:function(html){
                  fetch_data_product2();
                  fetch_data_product();
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
              document.getElementById('MultiDelete_w').disabled = false;        
            }else{
              eval("document.frmMain_w.crck"+i+".checked=false");
              $(".icon-del").hide();
              document.getElementById('MultiDelete_w').disabled = true;
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
              document.getElementById('MultiDelete').disabled = false;
            }
            else
            {
              eval("document.frmMain.Chk"+i+".checked=false");
              document.getElementById('MultiDelete').disabled = true;
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
              document.getElementById('MultiDelete_w').disabled = false;
            }
            else
            {
              eval("document.frmMain_w.crck"+i+".checked=false");
              $(".icon-del").hide();
              document.getElementById('MultiDelete_w').disabled = true;
              $(".discard").removeClass("overlay-cover-del");
            }
          }
        }
        //---------------------------------------------------Add Class---------------------------------------------------------------------------------
        $(document).on('click', '.checkbox_remove', function(){ 
          if($(this).is(":checked")) 
          {
              $(this).parents('tr').addClass("remove-item");
              document.getElementById('MultiDelete').disabled = false;
          } 
          else 
          {
              $(this).parents('tr').removeClass("remove-item");
              if($('input.checkbox_remove').is(':checked')){
              }else{
                document.getElementById('MultiDelete').disabled = true;
              }
              
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
