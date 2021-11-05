<?php
require_once '../library/connect.php';
require_once '../library/functions.php';
checkAdminUser($objConnect);

$title = 'จัดการคูปอง';
?>
<style type="text/css">             
@media screen and (max-width:1300px){  /* 0px - 479px */
 #table_point{
overflow: auto;
 }
}
</style>
<style type="text/css">
   .select2-container--default .select2-selection--multiple .select2-selection__choice {

    background-color: #00c0ef !important;
    border: 1px solid #aaa;
    border-radius: 4px;
    cursor: default;
    float: left;
    margin-right: 5px;
    margin-top: 5px;
    padding: 0 5px;
}
</style>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo TITLE; ?></title>
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
      <link rel="shortcut icon" type="image/png" href="../img/favicon.png"/>
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" type="text/css" href="css/up_pre.css">
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <!-- Pace style -->
    <link rel="stylesheet" href="../plugins/pace/pace.min.css">
    <!--Css table -->
    <link rel="stylesheet" href="css/app.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="../plugins/sweetalert2/dist/sweetalert2.min.css">
     <!-- address thailande -->
   <!--  <link rel="stylesheet" href="js/jquery.Thailand.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <style type="text/css">
    /*.swal2-popup {
        font-size: 1.5rem !important;
    }*/
        .nopad {
        padding-left: 0 !important;
        padding-right: 0 !important;
        }
        /*image gallery*/
        .image-checkbox {
            cursor: pointer;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            border: 4px solid transparent;
            margin-bottom: 0;
            outline: 0;
        }
        .image-checkbox input[type="checkbox"] {
            display: none;
        }

        .image-checkbox-checked {
            border-color: #4783B0;
        }
        .image-checkbox .fa {
          position: absolute;
          color: #4A79A3;
          background-color: #fff;
          padding: 10px;
          top: 0;
          right: 0;
        }
        .image-checkbox-checked .fa {
          display: block !important;
        }
    </style>

</head>
<body class="hold-transition skin-blue fixed sidebar-mini " onload="startTime()">
<div class="wrapper" >
    <?php require_once '../template/nav_menu.php'; ?>
    <?php require_once '../library/permission.php'; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?=$title?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="../page_home/index.php"> Dashboard</a></li>
              <!--   <li><a href="front-manage.php"> การจัดการลูกค้า</a></li> -->
                <li class="active"><?=$title?></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content" ng-app="NewCustomer" ng-controller="AddUserFormController">
            <!-- SELECT2 EXAMPLE -->
<!-- start form -->
<form id="upload-form-add" enctype="multipart/form-data">
<input type="hidden" name="_method" value="CREATE">
<!-- start form -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12" >
                    <!-- Start box warning for ADD system -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-info box-solid">
                                 <div class="box-header with-border">
                                    <div class="col-md-12">
                                      <!--   <h3 class="box-title">รายการคูปอง</h3> -->
                                    </div>
                                    <div class="col-md-10">
                                     <div class="form-group">
                                                <label for="" class="col-md-1 control-label">ช่วงวันที่</label>

                                                <div class="col-sm-5">
                                                    <div class='input-group date col-md-12' >
                                                        <input type='text' class="form-control" name="datetimepicker" id='datetimepicker' autocomplete="off" />
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-calendar"></span>
                                                            </span>
                                                    </div>
                                                 </div>
                                                 <div class="col-sm-2">
                                                    <div class='input-group date col-md-12' >
                                                        <input type='text' class="form-control" name="key_search" id='key_search' placeholder="ค้นหา"  />
                                                            
                                                    </div>
                                                 </div>
                                                  <div class="col-sm-4">
                                                   
                                <button type="button" class="btn btn-primary search_date" id="search_date"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;<?=lang('ค้นหา', 'Search')?></button>&nbsp;&nbsp;&nbsp;
                                <button type="button" class="btn btn-primary search_full" id="search_full"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp;<?=lang('ทั้งหมด', 'Full')?></button>
                            
                           
                                                  </div>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-1" align="right">
                            
                    <a style="<?php echo $button_open  ?>"   class="btn btn-success "   data-toggle="modal" data-target="#modal_add_coupon">
                        <i class="fa fa-fw fa-plus-circle"></i>&nbsp;<?=lang('เพิ่มคูปอง', 'Add Coupon')?>
                    </a>
                    
                   
                           
                        </div>
                                </div>
                                <div class="box-body" >
                                   
                                    <div class="form-horizontal">
                                        <div id="table_point"></div>
                                    </div>
                                </div>
                           
                            
                               
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
            <!-- Start box warning for ADD system -->
                   
                </div>
              
            </div>
<!-- end form -->
</form>
<!-- end form -->

    </section>
      <div class="modal fade" id="modal_showdetail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <!-- load from file !-->
    </div>
  </div>
</div>
<!-- modal_edit -->
<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <!-- load from file !-->
    </div>
  </div>
</div>
<!-- จบ modal_edit -->

<div class="modal fade" id="modal_add_coupon" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
         
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="box box-success box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">ข้อมูลคูปอง</h3>
                                </div>
                                <div class="box-body" >
                                    <div class="form-horizontal">
<form class="upload-form-add-thumbnail"  method="post" enctype="multipart/form-data" id="frm_CREATE">
                                            <input type="hidden" name="_method" value="CREATE">
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ชื่อคูปอง</label>

                                                <div class="col-sm-8">
                                                    <input type="text" name="coubon_name" class="form-control" id="coubon_name" autocomplete="off"  >
                                         
                                                   
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">Code Coupon</label>

                                                <div class="col-sm-8">
                                                    <input type="text" name="coubon_code" class="form-control" id="coubon_code" autocomplete="off"  >
                                         
                                                   
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ส่วนลด (%)</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="discount_add" id="discount_add" onkeypress="return check_tel(event)">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">จำนวนคูปอง</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control"  name="num_coubon" id="num_coubon" onkeypress="return check_tel(event)">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">วันที่เริ่มต้น - วันที่สิ้นสุด</label>

                                                <div class="col-sm-8">
                                                    <div class='input-group date col-md-12' >
                                                        <input type='text' class="form-control" name="datetimepicker_add" id='datetimepicker_add'/>
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-calendar"></span>
                                                            </span>
                                                    </div>
                                                 </div>
                                                
                                            </div>
                                            
                                           
                                             

                                             
                                             <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">รายการอีเมลล์</label>

                                                <div class="col-sm-8">
                                                    <select class="form-control " multiple  name="email[]" id="email" style="width: 250px" >
                                                         <?php
    $str = "SELECT mod_customer.id_customer, mod_customer.email FROM `mod_customer` WHERE `delete_datetime` IS null";
    $query = mysqli_query($objConnect,$str);
    while($result = mysqli_fetch_array($query)){
        ?>
        <option value="<?php echo $result["id_customer"] ?>"><?php echo $result["email"] ?></option>
        <?PHP } ?>
                                                    </select>
                                                     
                                                </div>
                                            </div>
                                           
                                             
                                            <div id="div_val">
                                                
                                            </div>
    <input type="hidden" name="id_employee" id="id_employee"  value="">
    <input type="hidden" name="name_em" id="name_em"  value="">  
                                           
                              <!-- end form -->
</form>      
                                    </div>
                                    <div class = "modal-footer">
           
        <button type="button" class="btn btn-success pull-right btnSendAdd" id="btnSendAdd" style="transition: 0.4s; margin-left: 5px;<?php echo $button_open  ?>"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;บันทึก</button>
            <button type = "button" class = "btn btn-default" data-dismiss = "modal">
               ปิด
            </button>
         </div>
                                </div>
                            </div>
                        </div>
        
           
            <!-- Start box warning for ADD system -->
                
                </div>
            </div>


    <!-- load from file !-->
    </div>
  </div>



</div>

</div>

<div class="control-sidebar-bg"></div>
</div>
<input type="hidden" name="per_button_edit" id="per_button_edit" value="<?php echo $button_edit ?>">
<input type="hidden" name="per_button_del" id="per_button_del" value="<?php echo $button_del ?>">
<input type="hidden" name="per_button_open" id="per_button_open" value="<?php echo $button_open ?>">
<input type="hidden" name="per_input_read" id="per_input_read" value="<?php echo $input_read ?>">
<!-- ./wrapper -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script> -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>



<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- date-range-picker -->
<script src="../bower_components/moment/min/moment-with-locales.min.js"></script>

<!-- thailand -->
<!-- <script src="js/jquery.Thailand.min.js"></script>
<script src="js/JQL.min.js"></script>
<script src="js/typeahead.bundle.js"></script>
<script src="js/zip.js"></script> -->
<!-- PACE -->
<script src="../bower_components/PACE/pace.min.js"></script>
<script src="js/timer.js"></script>
<!-- <script src="js/timer.js"></script> -->

<link rel="stylesheet" href="css/ui-bootstrap-csp.css">
<!-- <script src="js/sweetalert2.all.min.js"></script> -->
<script src="js/up_pre.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script src="../plugins/sweetalert2/dist/sweetalert2.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script>
//                function check_id(){
//       var coubon_code = $('#coubon_code').val();
//       $.ajax({
//         url: "functions.php",
//         type:"POST",
//         data:{data:coubon_code,_method:"check"},
//         success:function(data){
//           console.log(data);
//           if(data.status==1) {
//             alert("Coupon Code ซ้ำและยังไม่หมดอายุการใช้งาน  กรุณากรอกใหม่");
//             document.getElementById('coubon_code').value="";
//             document.getElementById("coubon_code").focus();

//           }          
//           else{
           
//           } 
//         }
//       })
// }
        $(function () {
            $('#search').on('click',function () {
                var drp = $('#datetimepicker_add').data('daterangepicker');

                openWindowWithPost('download-report.php',$('#datetimepicker_add').val());
            });

            function openWindowWithPost(url, date) {
                var form = document.createElement("form");
                form.target = "_blank";
                form.method = "POST";
                form.action = url;
                form.style.display = "none";

                var input = document.createElement("input");
                input.type = "hidden";
                input.name = "date";
                input.value = date;
                form.appendChild(input);




                document.body.appendChild(form);
                form.submit();
                document.body.removeChild(form);
            }

            moment.locale('th');
            $('#datetimepicker_add').daterangepicker({
                "locale": {
                    "format": "YYYY/MM/DD"
                },
                alwaysShowCalendars: true,
                startDate: moment().startOf('month'),
                endDate: moment().endOf('month'),
                autoApply : true,
                ranges: {
                    'วันนี้': [moment(), moment()],
                    'เมื่อวาน': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'พรุ่งนี้': [moment().add(1, 'days'), moment().add(1, 'days')],
                    '7 วันก่อน': [moment().subtract(6, 'days'), moment()],
                    '7 วันถัดไป': [moment().add(6, 'days'), moment().add(6, 'days')],
                    '30 วันก่อน': [moment().subtract(29, 'days'), moment()],
                    '30 วันถัดไป': [moment().add(29, 'days'), moment().add(29, 'days')],
                    'เดือนนี้': [moment().startOf('month'), moment().endOf('month')],
                    'เดือนที่ผ่านมา': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    'เดือนถัดไป': [ moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')]
                }
            });
        });
    </script>
<script type="text/javascript">
    $('#email').select2();
</script>


<script type="text/javascript">

    //------------------------------------------------------------ADD Customer--------------------------------------------------------------
       


    $(document).on('click', '#btnSendAdd', function(){
        var formData = new FormData($('#frm_CREATE')[0]);

    coubon_code = $('#coubon_code').val();
    num_credit = $('#num_credit').val();
    datetimepicker = $('#datetimepicker_add').val();
    num_coubon = $('#num_coubon').val();
    price = $('#price').val();
    coubon_name = $('#coubon_name').val();
  

    if(coubon_code == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่ coubon code", "warning")
        return false;
      }
    if(coubon_name == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่ชื่อคูปอง", "warning")
        return false;
      }
    if(discount_add == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่ส่วนลด", "warning")
        return false;
      }

    if(datetimepicker == ''){
        swal("คำเตือน", "คุณยังไม่ได้เลือกวันที่เริ่มต้น-วันที่สิ้นสุด", "warning")
        return false;
      }
    if(num_coubon == ''){
        swal("คำเตือน", "คุณยังไม่ได้ใส่จำนวนคูปอง", "warning")
        return false;
      }
    


      $.ajax({
        url: "functions.php",
        type:"POST",
        data:{data:coubon_code,_method:"check",datetimepicker:datetimepicker},
        success:function(data){
          console.log(data);
          if(data.status==1) {
            // alert("Code Coupon นี้มีการใช้งานในช่วงระยะเวลาที่เลือกแล้ว  กรุณากรอกใหม่");
             swal("คำเตือน", "Code Coupon นี้มีการใช้งานในช่วงระยะเวลาที่เลือกแล้ว  กรุณากรอกใหม่", "warning")
        return false;
            document.getElementById('coubon_code').value="";
            document.getElementById("coubon_code").focus();

          }          
          else{
           
          

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
            $.ajax({
            type: "POST",
            url: "mail_to.php",
            data: formData,
            processData: false,
            contentType: false
                  })
  swal({
            title: 'สำเร็จ',
            text: "บันทึกเรียบร้อยแล้ว?",
            type: 'success',
      
            confirmButtonColor: '#3085d6',
          
            confirmButtonText: 'ยืนยัน!',
            showLoaderOnConfirm: true,
            preConfirm: function () {
            return new Promise(function (resolve) {
            //console.log(erordata);
            // alert('resolve');
            
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
        } 
        }
      })
    });


</script>
<script type="text/javascript">
    $(document).ready(function(){
})
        //---------------------------------------fetch Slide for refresh ajax-----------------------------------------------

        function fetch_data_slide(page)  
          {  
             var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
              $.ajax({  
                  url:"select_table.php?do=select_table",  
                  method:"POST",  
                  data:{button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},
                  success:function(data){  
              $('#table_point').html(data); 
               $('#table_team').DataTable(); 
                  }  
              });  
          }  
          fetch_data_slide();
        
  
  $(document).on('click','#search_date',function(event) {
     var datetimepicker = $('#datetimepicker').val();
     var key_search = $('#key_search').val();
      var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
     
     $.ajax({  
                  url:"select_table.php?do=select_table",  
                  method:"POST",  
                   data:{key_search:key_search,datetimepicker:datetimepicker,button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},
                  success:function(data){  
              $('#table_point').html(data);  
               $('#table_team').DataTable();
                  }  
              });  
  })
   $(document).on('click','#search_full',function(event) {
     var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
   $.ajax({  
                  url:"select_table.php?do=select_table",  
                  method:"POST",  
                   data:{button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},
                  success:function(data){  
              $('#table_point').html(data);  
               $('#table_team').DataTable();
                  }  
              });  
          
  })

    $(document).on('click', '#delete_team', function(){
    var id = $(this).attr('data-id');
   
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
            url: "functions.php?_method=del&id="+id,

             data: {id:id},
           
            processData: false,
            contentType: false
                  })

// in case of successfully understood ajax response
            .done(function (myAjaxJsonResponse) {
            console.log(myAjaxJsonResponse);
            //alert(myAjaxJsonResponse);
  swal({
            title: 'สำเร็จ',
            text: "ลบเรียบร้อยแล้ว?",
            type: 'success',
      
            confirmButtonColor: '#3085d6',
          
            confirmButtonText: 'ยืนยัน!',
            showLoaderOnConfirm: true,

//             preConfirm: function () {
//             return new Promise(function (resolve) {
          
//             // alert('การบันทึก');
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
  fetch_data_slide();
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
</script>
<script>
              
        $(function () {
            $('#search').on('click',function () {
                var drp = $('#datetimepicker').data('daterangepicker');

                openWindowWithPost('download-report.php',$('#datetimepicker').val());
            });

            function openWindowWithPost(url, date) {
                var form = document.createElement("form");
                form.target = "_blank";
                form.method = "POST";
                form.action = url;
                form.style.display = "none";

                var input = document.createElement("input");
                input.type = "hidden";
                input.name = "date";
                input.value = date;
                form.appendChild(input);




                document.body.appendChild(form);
                form.submit();
                document.body.removeChild(form);
            }

            moment.locale('th');
            $('#datetimepicker').daterangepicker({
                "locale": {
                    "format": "YYYY/MM/DD"
                },
                alwaysShowCalendars: true,
                startDate: moment().startOf('month'),
                endDate: moment().endOf('month'),
                autoApply : true,
                ranges: {
                    'วันนี้': [moment(), moment()],
                    'เมื่อวาน': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'พรุ่งนี้': [moment().add(1, 'days'), moment().add(1, 'days')],
                    '7 วันก่อน': [moment().subtract(6, 'days'), moment()],
                    '7 วันถัดไป': [moment().add(6, 'days'), moment().add(6, 'days')],
                    '30 วันก่อน': [moment().subtract(29, 'days'), moment()],
                    '30 วันถัดไป': [moment().add(29, 'days'), moment().add(29, 'days')],
                    'เดือนนี้': [moment().startOf('month'), moment().endOf('month')],
                    'เดือนที่ผ่านมา': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    'เดือนถัดไป': [ moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')]
                }
            });
        });
    </script>
<script type="text/javascript">

     $(function(){
     
    // เมื่อเปลี่ยนค่าของ select id เท่ากับ list1
     $("select#head_team").change(function(){  
         // ส่งค่า ตัวแปร list1 มีค่าเท่ากับค่าที่เลือก ส่งแบบ get ไปที่ไฟล์ data_for_list2.php
         $.get("functions.php?_method=head_team",{
             head_team:$(this).val()
         },function(data){ // คืนค่ากลับมา
            //alert(data);
                $("select#em_team").html(data);  // นำค่าที่ได้ไปใส่ใน select id เท่ากับ list2      
                $("select#em_team").trigger("change"); // อัพเดท list2 เพื่อให้ list2 ทำงานสำหรับรีเซ็ตค่า
         });
    });

      // เมื่อเปลี่ยนค่าของ select id เท่ากับ list1
     $("select#geographies").change(function(){  
         // ส่งค่า ตัวแปร list1 มีค่าเท่ากับค่าที่เลือก ส่งแบบ get ไปที่ไฟล์ data_for_list2.php
         $.get("functions.php?_method=geographies",{
             geographies:$(this).val()
         },function(data){ // คืนค่ากลับมา
            //alert(data);
                $("select#aria_geo").html(data);  // นำค่าที่ได้ไปใส่ใน select id เท่ากับ list2      
                $("select#aria_geo").trigger("change"); // อัพเดท list2 เพื่อให้ list2 ทำงานสำหรับรีเซ็ตค่า
         });
    });
// เมื่อเปลี่ยนค่าของ select id เท่ากับ list1
     $("select#aria_geo").change(function(){  
         // ส่งค่า ตัวแปร list1 มีค่าเท่ากับค่าที่เลือก ส่งแบบ get ไปที่ไฟล์ data_for_list2.php
         $.get("test1.php?_method=aria_geo",{
             aria_geo:$(this).val()
         },function(data){ // คืนค่ากลับมา
            //alert(data);
                $("select#provinces").html(data);  // นำค่าที่ได้ไปใส่ใน select id เท่ากับ list2      
                $("select#provinces").trigger("change"); // อัพเดท list2 เพื่อให้ list2 ทำงานสำหรับรีเซ็ตค่า
         });
    });

     

      $("select#em_team").change(function(){  
            // 
         
 
         // ส่งค่า ตัวแปร list1 มีค่าเท่ากับค่าที่เลือก ส่งแบบ get ไปที่ไฟล์ data_for_list2.php
         $.get("functions.php?_method=em_team",{
             em_team:$(this).val()
         },function(data){ // คืนค่ากลับมา
           // alert(data.name);
    
               document.getElementById('id_employee').value=data.id_employee;
               document.getElementById('name_em').value=data.name;
         });
       
    });

    

 });
  $("#modal_showdetail").on('hidden.bs.modal', function () {
    $(this).data('bs.modal', null);
  });
  $("#modal_add_coupon").on('hidden.bs.modal', function () {
    $(this).data('bs.modal', null);
     document.getElementById('frm_CREATE').reset();
    
      $("#email").val("").trigger("change");
    $("#email").trigger("change");
  });
</script>
<script type="text/javascript">
function check_tel(ele)
  {
  var vchar = String.fromCharCode(event.keyCode);
  if ((vchar<'0' || vchar>'9') ) return false;
  ele.onKeyPress=vchar;
  }
  function check_pass() {
    
  var username = document.getElementById("username");
  var x = document.getElementById("password");
  var x1 = document.getElementById("password1");
  if (x.value == x1.value ){
   username.value = username.value.toLowerCase();
   
  }else{
    alert("รหัสผ่านไม่ตรงกัน");
    username.value = username.value.toLowerCase();
    document.getElementById('password').value="";
    document.getElementById('password1').value="";
   
  }
 
}
// function check_pass()
//   {
//   password = $('#password').val();
//   password1 = $('#password1').val();
  
  

//   //$('#password1').val("รหัสผ่านไม่ตรงกัน");
//   }

function edit_row(r){
 var i = r.parentNode.parentNode.rowIndex;
 // count_rows = table.getElementsByTagName("tr").length;
  //fname_add_edit = tbody.getElementById("fname_add"+[i]).value();

    id_employee = $('#id_employee'+i).val();
    name_em = $('#name_em'+i).val();
  
    //tp = $('#tp'+i).val();

 $('#id_employee_edit').val(id_employee);
 $('#name_em_edit').val(name_em);
 $('#address_edit').val(address);
 $('#district_edit').val(district);
 $('#amphor_edit').val(amphor);
 $('#province_edit').val(province);
 $('#zipcode_edit').val(zipcode);
 $('#tp_edit').val(tp);
 $('#index_i').val(i);
            // show modal
 $('#myModal').modal('show')

        };

function del_row(r){
  var data = {
  sum_total_price: $('#numsum').val(),
    sum_total_cost: $('#total_cost').val(),
  } ;
     var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("myTable").deleteRow(i);

                 result1 = parseInt(data.sum_total_cost);

                document.getElementById('total_cost').value=result1-1;
}

function change_data() {

    var table = document.getElementById("myTable");
    fname_add = $('#fname_add_edit').val();
    lname_add = $('#lname_add_edit').val();
    address = $('#address_edit').val();
    district = $('#district_edit').val();
    amphor = $('#amphur_edit').val();
    province = $('#province_edit').val();
    zipcode = $('#zipcode_edit').val();
    tp = $('#tp_edit').val();
    index_i = $('#index_i').val();


 var data = {
  sum_total_cost: $('#total_cost').val(),
  } ;
                

    
    // if(fname_add == ""){
    //     swal("คำเตือน", "คุณยังไม่ได้ใส่ชื่อ", "warning")
    //     return false;
    //   }
    //   if(lname_add == ""){
    //     swal("คำเตือน", "คุณยังไม่ได้ใส่นามสกุล", "warning")
    //     return false;
    //   }
    // if(address == ""){
    //     swal("คำเตือน", "คุณยังไม่ได้ใส่ที่อยู่", "warning")
    //     return false;
    //   }
    // if(district == ""){
    //     swal("คำเตือน", "คุณยังไม่ได้ใส่ตำบล", "warning")
    //     return false;
    //   }
    // if(amphor == ""){
    //     swal("คำเตือน", "คุณยังไม่ได้ใส่อำเภอ", "warning")
    //     return false;
    //   }
    // if(province == ""){
    //     swal("คำเตือน", "คุณยังไม่ได้ใส่จังหวัด", "warning")
    //     return false;
    //   }
    // if(zipcode == ""){
    //     swal("คำเตือน", "คุณยังไม่ได้ใส่รหัสไปรษณีย์", "warning")
    //     return false;
    //   }
    // if(tp == ""){
    //     swal("คำเตือน", "คุณยังไม่ได้ใส่เบอร์โทร", "warning")
    //     return false;
    //   }

 document.getElementById("myTable").deleteRow(index_i);
    count_rows = table.getElementsByTagName("tr").length;

    var row = table.insertRow(count_rows);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
 
 
    cell1.innerHTML = fname_add+' '+lname_add;
    cell2.innerHTML = address+' '+district;
    cell3.innerHTML = amphor+' '+province+' '+zipcode;
    cell4.innerHTML = tp
    
    cell5.innerHTML = "<button style='background-color: white;' type='button' class='edit-catagory btn btn-default' onclick='del_row(this)'> <i class='fa fa-fw fa-trash'></i></button> <button style='background-color: white;' type='button' class='edit-catagory btn btn-default' onclick='edit_row(this)'> <i class='fa fa-edit'></i></button> ";

    cell6.innerHTML = "<input class='form-control ' TYPE=\'hidden\'  name='fname_add[]' id=\'fname_add"+index_i+"\' value=\'"+fname_add+"\'> <input class='form-control ' TYPE=\'hidden\'  name='lname_add[]' id=\'lname_add"+index_i+"\''  value=\'"+lname_add+"\'> <input class='form-control ' TYPE=\'hidden\'  name='address[]' id=\'address"+index_i+"\' value=\'"+address+"\'><input class='form-control ' TYPE=\'hidden\'  name='district[]' id=\'district"+index_i+"\' value=\'"+district+"\'><input class='form-control ' TYPE=\'hidden\'  name='amphor[]' id=\'amphor"+index_i+"\' value=\'"+amphor+"\'><input class='form-control ' TYPE=\'hidden\'  name='province[]' id=\'province"+index_i+"\' value=\'"+province+"\'><input class='form-control ' TYPE=\'hidden\'  name='zipcode[]' id=\'zipcode"+index_i+"\' value=\'"+zipcode+"\'><input class='form-control ' TYPE=\'hidden\'  name='tp[]' id=\'tp"+index_i+"\' value=\'"+tp+"\'>";
    
   

           $('#myModal').modal('hide');     
                
    }
function add_row() {
 
    var table = document.getElementById("myTable");
    id_employee = $('#id_employee').val();
    name_em = $('#name_em').val();
    total_cost = $('#total_cost').val();
   


 var data = {
  sum_total_cost: $('#total_cost').val(),
  } ;
                
    if(total_cost > 0){
        for (var i = 1; i <= total_cost; i++) {
            
       
         id_employee_i = $('#id_employee'+i).val();
        if(id_employee == id_employee_i){
        swal("คำเตือน", "มีลูกทีมคนนี้แล้ว", "warning")
        return false;
      } }
      }
    
    if(id_employee == ""){
        swal("คำเตือน", "คุณยังไม่ได้เลือกลูกทีม", "warning")
        return false;
      }
   
     

    count_rows = table.getElementsByTagName("tr").length;

    var row = table.insertRow(count_rows);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
 
 
    cell1.innerHTML = count_rows;
    cell2.innerHTML = name_em;

    cell3.innerHTML = "<button style='background-color: white;' type='button' class='edit-catagory btn btn-default' onclick='del_row(this)'> <i class='fa fa-fw fa-trash'></i></button>  ";

    cell4.innerHTML = "<input class='form-control ' TYPE=\'hidden\'  name='id_employee[]' id=\'id_employee"+count_rows+"\' value=\'"+id_employee+"\'> <input class='form-control ' TYPE=\'hidden\'  name='name_em[]' id=\'name_em"+count_rows+"\''  value=\'"+name_em+"\'> ";
    
   

                 result1 = parseInt(data.sum_total_cost);
                document.getElementById('total_cost').value=result1+1;
                inputClear();
}



         function inputClear(){
            $('#fname_add').val('');
            $('#lname_add').val('');
            $('#address').val('');
            $('#district').val('');
            $('#amphor').val('');
            $('#province').val('');
            $('#zipcode').val('');
            $('#tp').val('');
        }

</script>
<script type="text/javascript">

    //------------------------------------------------------------ADD Customer--------------------------------------------------------------
       





</script>

</body>
</html>
