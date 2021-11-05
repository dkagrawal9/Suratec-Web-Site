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
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
    <!-- daterange picker -->
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
    <link rel="shortcut icon" type="image/png" href="../img/favicon.png"/>
  

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
                จัดการส่วนเชื่อมโยง
            </h1>
            <ol class="breadcrumb">
                <li><a href="../page_home/index.php"> Dashboard</a></li>
                <li class="active">จัดการส่วนเชื่อมโยง</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content" ng-app="NewCustomer" ng-controller="AddUserFormController">
            <!-- SELECT2 EXAMPLE -->
<!-- start form -->


 
        <div class="row" >
        <div class="col-md-6" id='div_edit' style='display:none;'>
       <!--  <div id="div_edit"> -->

        </div>     

              <div class="col-lg-6 col-md-6 col-sm-6" id="div_add" style="<?php echo $button_open ?>">
               
        <div class="box box-success" >
            <div class="box-header with-border">
               
                <h3 class="box-title"><?=lang('เพิ่มส่วนเชื่อมโยง','Add Links')?></h3>
            </div>
            <div class="box-body" >
                <div class="form-horizontal">
                    <div class="box-body">
                    <div class="col-md-12" >
                    <!-- Start box warning for ADD system -->
                  
                    
 <form id="frmADD" enctype="multipart/form-data">
<input type="hidden" name="_method" value="CREATE_icon">
<input type="hidden" name="id_icon" id="id_icon" value="<?php echo $_GET["id"]  ?>">
<!-- start form -->

   <!--     $strSQL = "SELECT * FROM `icon_item` WHERE `del_flg` ='0' AND `item_id`='".$_GET["id"]."'";     -->          
   <?php

//    $strSQL = "SELECT * FROM `mod_footer` WHERE `del_flg` ='0'";
// $query = mysqli_query($objConnect,$strSQL);
// $result = mysqli_fetch_array($query);
?>             
 <div class="box box-success box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">รายละเอียด</h3>
                                </div>
                                <div class="box-body" >
                                    <div class="form-horizontal">
                                        <form id="frmData1">
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ชื่อ</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="name_add" id="name_add" required> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ลิงค์</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="link_add" id="link_add" required> 
                                                </div>
                                            </div>
                                           
                                            <div class="form-group">
                                     <label for="" class="col-sm-3 control-label"><?=lang('ไอคอน','Icon')?></label>
                                    <div class="col-sm-8">
                                    <div class="col-sm-1" style="width: 150px; padding-bottom: 10px;">
                                        <img style="width: 30px; height: 30px;" id='img-upload' src="img/upload.jpg" />
                                    </div>
                                     <div class="col-sm-7" style="width: 150px; padding-bottom: 10px;">
                                         <div class="input-group">
                                    
                                        <input type="text" class="form-control" readonly>
                                        <span class="input-group-btn">
                                            <span class="btn btn-default btn-file" style="background-color: white !important;">
                                              <i class="glyphicon glyphicon-folder-open"></i><input type="file" accept="image/*" id="imgInp" name="pic" onchange="Preview(this)">
                                            </span>
                                        </span>

                                    </div>
                                    </div>
                                   <div class="col-sm-12">
                                      คำแนะนำ: กรุณาเพิ่มไฟล์ขนาด 64x64 (พิกเซล)
                                    </div> 
                                </div>

                            </div>
                                            
                                    </div>
                                </div>
                            </div>
                         

                    
               
                  
                </div></form>

          <div class="box-footer" align="center">
                    <button class="btn  btn-default" id="btnsend-reset"> <i class="fa fa-refresh" aria-hidden="true"></i> <?=lang('รีเซ็ท','Reset')?></button> <button class="btn  btn-success" style="<?php echo $button_open ?>" id="btnsend-add"> <i class="fa fa-floppy-o" aria-hidden="true"></i> <?=lang('บันทึก','Save')?></button></div> 
                </div>

             </div>

         </div>

    </div>

</div>
 <div class="col-lg-6 col-md-6 col-sm-6">
 <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="box box-success">
            <div class="box-header with-border">
               
                <h3 class="box-title"><?=lang('จัดการส่วนเชื่อมโยง','Manage links')?></h3>
            </div>
             <div class="box-body" >
                <div class="form-horizontal">
                    <div class="box-body">
                    <div class="col-md-12" >
                        <div id="table_point"></div>
                    </div>
                </div></div></div>

                    <style type="text/css">             
@media screen and (max-width:479px) {  /* 0px - 479px */
 #table_point{
overflow: auto;
 }
}
</style>
                </div></div></div></div></div></div>


<?php
//require_once 'front-show.php';
?>
          

                
<!-- <div class="boxsave" style="<?php echo $button_del_s ?>"> 
          <div class="col-md-3">
            <button class="btn btn-danger" id="delmull">ลบทั้งหมดที่เลือก</button>
          </div>
          
      </div> -->
    </section>
   <input type="hidden" name="per_button_edit" id="per_button_edit" value="<?php echo $button_edit ?>">
<input type="hidden" name="per_button_del" id="per_button_del" value="<?php echo $button_del ?>">
<input type="hidden" name="per_button_open" id="per_button_open" value="<?php echo $button_open ?>">
<input type="hidden" name="per_input_read" id="per_input_read" value="<?php echo $input_read ?>"> 
     <div class="modal fade" id="modal_showdetail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <!-- load from file !-->
    </div>
  </div>
</div> 
<!--  -->
<!-- ./wrapper -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- date-range-picker -->
<script src="../bower_components/moment/min/moment-with-locales.min.js"></script>

<!-- PACE -->
<script src="../bower_components/PACE/pace.min.js"></script>
<script src="js/timer.js"></script>
<script src="../plugins/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
  

<script type="text/javascript">
        function Preview(ele) {
            
                if (ele.files && ele.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#img-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(ele.files[0]);
              
            }
        }
         
        </script>
<script type="text/javascript">
     $(document).on('click', '#btnsend_reset_add', function(){ 

            $("#div_add").show();
            $("#div_edit").hide();
        

            
        })

//    function check_id(){
//       var product_code = $('#product_code').val();
//       $.ajax({
//         url: "functions.php",
//         type:"POST",
//         data:{data:product_code,_method:"check"},
//         success:function(data){
//           console.log(data);
//           if(data.status==1) {
//             alert("รหัสพนักงานซ้ำ  กรุณากรอกใหม่");
//             document.getElementById('product_code').value="";
//             document.getElementById("product_code").focus();

//           }          
//           else{
           
//           } 
//         }
//       })
// }

   $(document).on('click', '#btnshow', function(){ 
  var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
            $("#div_add").hide();
            $("#div_edit").show();
            var id = $(this).attr('data-id');
           

            
                
                $.ajax({
                type: "POST",
                    url:"select_table.php?do=select_show",  
                   data: {id_edit:id,button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},
                   
                    success: function(data) {
                     //alert(data);
                     console.log(data);
                     $('#div_edit').html(data); 
                     
                     $("#div_add").hide();
                      //document.getElementById('frmADD').reset();
                     
                        //fetch_data();

                       
                      
                  },
                    error: function (error) {
                        
                    }
            });

            
        }) 

     $(document).on('click', '#btnEdit_icon', function(){ 
  var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
            $("#div_add").hide();
            $("#div_edit").show();
            var id = $(this).attr('data-id');
             var id_icon_type = $(this).attr('data-id1');
           

            
                
                $.ajax({
                type: "POST",
                    url:"select_table.php?do=select_edit_icon",  
                   data: {id_edit:id,id_icon_type:id_icon_type,button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},
                   
                    success: function(data) {
                     //alert(data);
                     console.log(data);
                     $('#div_edit').html(data); 
                     
                     $("#div_add").hide();
                      //document.getElementById('frmADD').reset();
                     
                        //fetch_data();

                       
                      
                  },
                    error: function (error) {
                        
                    }
            });

            
        }) 
       $(document).on('click', '#btnsend-reset', function(){ 
    document.getElementById('frmADD').reset();
     $('#img-upload').attr('src', 'img/upload.jpg');

 })
     //sweet alert confirm บันทึก การเปลี่ยนสถานะซ่อมH02
          
        $(document).on('click','#btnsend-add',function(event) {
          //var formData = new FormData($('#f_save_up_repair_H02')[0]);
         var formData = new FormData($('#frmADD')[0]);
                var link_add = $('#link_add').val();
                var id_icon = $('#id_icon').val();
                var name_add = $('#name_add').val();
          
                
       if(name_add == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่ชื่อ", "warning")
        return false;
      }        
      if(link_add == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่ลิงค์", "warning")
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
            if (myAjaxJsonResponse.status=='1') {
  swal({
            title: 'สำเร็จ',
            text: "บันทึกเรียบร้อยแล้ว?",
            type: 'success',
      
            confirmButtonColor: '#3085d6',
          
            confirmButtonText: 'ยืนยัน!',
            showLoaderOnConfirm: true,
            preConfirm: function () {
            fetch_data_slide();
            document.getElementById('frmADD').reset();
     $('#img-upload').attr('src', 'img/upload.jpg');
        },    
      })
}else if (myAjaxJsonResponse.status=='3') {
  swal('ไม่สำเร็จ', 'กรุณาอัพโหลดไฟล์ jpg  jpeg  png  gif เท่านั้น', 'error');
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

         
$(document).on('click', '#btnsend-reset', function(){ 
    document.getElementById('frmedit').reset();
 })

        $(document).on('click','#btnsend-edit',function(event) {
          //var formData = new FormData($('#f_save_up_repair_H02')[0]);
         var formData = new FormData($('#frmedit')[0]);
                      var link_edit = $('#link_edit').val();
                      var name_edit = $('#name_edit').val();
                
       
                
       if(name_edit == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่ชื่อ", "warning")
        return false;
      }        
      if(link_edit == ""){
        swal("คำเตือน", "คุณยังไม่ได้ใส่ลิงค์", "warning")
        return false;
      }
        
          swal({
            title: 'ยืนยัน?',
            text: "ยืนยันการแก้ไขหรือไม่?",
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
            if (myAjaxJsonResponse.status=='1') {
  swal({
            title: 'สำเร็จ',
            text: "แก้ไขเรียบร้อยแล้ว?",
            type: 'success',
      
            confirmButtonColor: '#3085d6',
          
            confirmButtonText: 'ยืนยัน!',
            showLoaderOnConfirm: true,
            preConfirm: function () {
              fetch_data_slide();
    
        },    
      })
}else if (myAjaxJsonResponse.status=='3') {
  swal('ไม่สำเร็จ', 'กรุณาอัพโหลดไฟล์ jpg  jpeg  png  gif เท่านั้น', 'error');
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

         $(document).on('click','#btndel_one_icon',function(event) {
        var id = $(this).attr('data-id');
         var id_icon_type = $(this).attr('data-id1');
         
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
            url: "functions.php?_method=btndel_one_icon&id_edit="+id,
          
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
           fetch_data_slide();
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

  
        //---------------------------------------fetch Slide for refresh ajax-----------------------------------------------
        function fetch_data_slide(page)  
          {  
             var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
             var id_icon = $('#id_icon').val();
              $.ajax({  
                  url:"select_table.php?do=select_table_icon",  
                  method:"POST",  
                  // data:{page:page},
                  data:{id_icon:id_icon,button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},
                  success:function(data){  
              $('#table_point').html(data);  
              $('#table_icon').DataTable({scrollX: "330px"});
                  }  
              });  
          }  
          fetch_data_slide();
        
</script>
<script type="text/javascript">
      function chk_all() {
    var x = document.getElementsByTagName("input");
    for (i = 0; i < x.length; i++) {
      if (x[i].type == "checkbox") {
        x[i].checked = true;
      }
    }
    $("#check_all").hide();
    $("#uncheck_all").show();

  }

  function unchk_all() {
    var x = document.getElementsByTagName("input");
    for (i = 0; i < x.length; i++) {
      if (x[i].type == "checkbox") {
        x[i].checked = false;
      }
    }
    $("#uncheck_all").hide();
    $("#check_all").show();
  }
</script>

</body>
</html>
