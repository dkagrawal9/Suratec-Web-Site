<?php
require_once '../library/connect.php';
require_once '../library/functions.php';
checkAdminUser($objConnect);


$appSql = "SELECT id_data_role FROM tbl_member WHERE id_member = '".$_SESSION['user_member']."'";

$result = $objConnect->query($appSql)->fetch_object();
$id_employee = $result->id_data_role;


$title = 'จัดการสมาชิก';
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
    <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <link rel="shortcut icon" type="image/png" href="../img/favicon.png"/>
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <!-- Pace style -->
    <link rel="stylesheet" href="../plugins/pace/pace.min.css">
    <!--Css table -->
    <link rel="stylesheet" href="css/app.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../plugins/sweetalert2/dist/sweetalert2.min.css">

</head>
    <style type="text/css">
        .btn-sm{
            margin-right: 5px;
        }
    </style>
    <style type="text/css">             
@media screen and (max-width:1500px) {  /* 0px - 479px */
 #div_table{
overflow: auto;
 }
}
</style>
<body class="hold-transition skin-blue fixed sidebar-mini " onload="startTime()">
<div class="wrapper">
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
                <li><a href="../page_home/index.php"></i> Dashboard</a></li>
                <li class="active"><?=$title?></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <!-- Start box warning for ADD system -->
                    <div class="box box-primary callout-primary-box">
                     

                        <div class="box-body">
                            <div class="row">
                                  <!--  <div class="col-md-6">
                                             <input  type="text" id="key_search" name="key_search" class="form-control" placeholder="กรอกชื่อ หรือ Username" >
                                            
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <button type="button"  id="search" value="Search"
                                                class="btn btn-info " ><i class="fa fa-search" aria-hidden="true"></i> ค้นหา</button>
                                                <button type="button"  id="searchall" value="searchall"
                                                class="btn btn-info " ><i class="fa fa-search" aria-hidden="true"></i> ค้นหา ทั้งหมด</button>
                                        </div> -->
                                        <div class="col-md-12">
                                              <button type="button" name="add_quotation_btn" id="add_quotation_btn" class="btn btn-success  pull-right" btn-lg btn-block ><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มสมาชิก</button>
                                        </div>

                            </div>
                            <br><br>
                            
                            <div id="div_table">
                            <table class="table" id="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ชื่อ-นามสกุล</th>
                                        <th>Username</th>
                                        <th>ประเภทสมาชิก</th>
                                        <th>อีเมลล์</th>
                                        <th>เบอร์โทร</th>
										<!--<th>ผู้ดูแล</th>-->
                                        <th>ควบคุม</th>
                                    </tr>
                                </thead>
                                <tbody id="Customers-table">
                                
                                </tbody>
                            </table>
                            </div>

                        </div>
                    </div>
                </div>

<!-- Modal add -->
<div class="modal  modal fade" id="modal_add">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"><div id="modal_id_order"></div></h4>
        <label for="">เพิ่มสมาชิก</label>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

<div id="add_data">
    
</div>
      <!-- Modal footer -->                              
    </div>
  </div>
</div>

<div class="modal  modal fade" id="modal_edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"><div id="modal_id_order"></div></h4>
        <label for="">แก้ไขสมาชิก</label>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

<div id="edit_data">
    
</div>
      <!-- Modal footer -->                              
    </div>
  </div>
</div>

<div class="modal  modal fade" id="modal_show">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"><div id="modal_id_order"></div></h4>
        <label for="">รายละเอียดสมาชิก</label>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

<div id="show_data">
    
</div>
      <!-- Modal footer -->                              
    </div>
  </div>
</div>
        </section>
<input type="hidden" name="per_button_edit" id="per_button_edit" value="<?php echo $button_edit ?>">
<input type="hidden" name="per_button_del" id="per_button_del" value="<?php echo $button_del ?>">
<input type="hidden" name="per_button_open" id="per_button_open" value="<?php echo $button_open ?>">
<input type="hidden" name="per_input_read" id="per_input_read" value="<?php echo $input_read ?>">
       
        <form id="form-del">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="id_customer" value id="form-del-cus">
        </form>
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap datepicker -->
    <script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- SlimScroll -->
    <script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- date-range-picker -->
    <script src="../bower_components/moment/min/moment-with-locales.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- PACE -->
    <script src="../bower_components/PACE/pace.min.js"></script>
    <!-- <script src="js/front-manage-attr.js"></script> -->
    <script src="js/timer.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="../plugins/sweetalert2/dist/sweetalert2.min.js"></script>

    <script type="text/javascript">
      const id_employee = '<?php echo $id_employee?>';
      var table;
        $(document).ready(function(){


            $(document).ajaxStart(function () {
                Pace.restart()
            });

          var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
          table = $('#table').DataTable( {

                "ajax": 'select_customer.php',
                "iDisplayLength" : 50,
                "columns": [
                    { "data": "id_customer" , className : "text-center",
                     render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    } },
                    { "data": "name_cus" },
                    { "data": "user_member" },
                    { "data": "type_cus" },
                    { "data": "email" },
                    { "data": "telephone" },
					/*{ "data": "telephone" },*/
                    {
                    "data": function (data, type, dataToSet) {
                            let action = '';
                            action = "<button style='"+input_read+"' class='btn btn-primary btn-sm show-cus'><i class='fa fa-fw fa-eye'></i></button>" +
                                    "<button style='"+button_edit+"' class='btn btn-warning btn-sm edit-cus' ><i class='fa fa-fw fa-pencil'></i></button>"+
                                    "<button style='"+button_del+"' class='btn btn-danger btn-sm del-cus'><i class='fa fa-fw fa-trash'></i></button>" +
                                    "<button style='"+input_read+"' class='btn btn-info btn-sm playback-cus'>playback</button>" +
                                    "<button class='btn btn-primary btn-sm cust-chat'><i class='fa fa-comments'></i></button>";
                            if (!data.assigned_dr) {

                                action += "<button class='btn btn-success btn-sm add-patient' title='Add patient to my list'><i class='fa fa-user-plus'></i></button>";
                            }
                            console.log(data.assigned_dr)

                            return action;
                        }
                    }
                ],
                    "language": {
                    "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
                    "zeroRecords": "ไม่พบข้อมูล",
                    "info": "กำลังแสดงหน้าที่ _PAGE_ จาก _PAGES_",
                    "infoEmpty": "ไม่พข้อมูล",
                    "infoFiltered": "(จากทั้งหมด _MAX_)"
                    }

            });

            $(document).on('click','.show-cus',function(){
                data = table.row( $(this).parents('tr') ).data();
                // location.href = 'front-show.php?id='+data.id_customer;
                $.ajax({   
            url:'functions.php?id='+data.id_customer, 
            method:'POST',  
            data:{_method:'show_customer'},  
            //dataType:"json", 
          
                success:function(data){  
                    //console.log(response.data[0]['path_slip']);
               

              
                $("#show_data").html(data); 
                   $("#modal_show").modal('show'); 
                }, 

                   
           });  
            })

            $(document).on('click','.playback-cus',function(){
              localStorage.setItem('chappal_key',''); 
                data = table.row( $(this).parents('tr') ).data();
                location.href = '../mod_playback/playback.php?id_customer='+data.id_customer;
            })
            $(document).on('click','.cust-chat',function(){
                data = table.row( $(this).parents('tr') ).data();
                const href = '/channel/chat.php?channel=' + id_employee + '-' + data.id_customer;
                window.open(href,'_blank');
            })            
            $(document).on('click','.add-patient',function(){
                data = table.row( $(this).parents('tr') ).data();
                const id_customer = data.id_customer;

                
                // Ajax call to cancel an appointment
                $.ajax({
                    method: "POST",
                    url: "add-patient-my-list.php",
                    data: {id_customer}
                }).done(function(res) {
                    if (res.status === 200) {
                        table.ajax.reload();
                        swal.fire({
                            title: "Patient!!!",
                            text: res.message,
                            type: "success"
                        }).then(function() {});
                    }else if (res.status === 401) {
                        swal.fire({
                            title: "Patient!!!",
                            text: res.message,
                            type: "error"
                        }).then(function() {});
                    }
                }).fail(function(err) {
                    console.error('error...',err);
                }).always(function() {
                    // always called
                }); 
                
            })            
            // $(document).on('click','.edit-cus',function(){
            //     data = table.row( $(this).parents('tr') ).data();
            //     location.href = 'front-edit.php?id='+data.id_customer;
            // })
              $(document).on('click','.add-address',function(){
                data = table.row( $(this).parents('tr') ).data();
                location.href = 'front-address-manage.php?id='+data.id_customer;
            })
                $(document).on('click','.sub-cus',function(){
                data = table.row( $(this).parents('tr') ).data();
                location.href = 'front-sub-manage.php?id='+data.id_customer;
            })


    
         $(document).on('click','#repassword',function(){
          $('.re_password').slideToggle();
        });
  
$(document).on('click','.edit-cus',function(){
    // var id_order = $(this).attr("id");
    // var rid = $(this).attr("data-id"); 
    // var btn = $(this).attr("data-id1"); 
    data = table.row( $(this).parents('tr') ).data();
                // location.href = 'front-edit.php?id='+data.id_customer;
   

    $.ajax({   
            url:'functions.php?id='+data.id_customer, 
            method:'POST',  
            data:{_method:'edit_customer'},  
            //dataType:"json", 
          
                success:function(data){  
                    //console.log(response.data[0]['path_slip']);
               

              
                $("#edit_data").html(data); 
                   $("#modal_edit").modal('show'); 
                }, 

                   
           });  


});
    
            $(document).on('click', '.del-cus', function(event) {
               data = table.row( $(this).parents('tr') ).data();
                $('#form-del-cus').val(data.id_customer);
                console.log(data.id_customer);
                var formData = new FormData($('#form-del')[0]);
                swal({
                      title: 'ยืนยัน?',
                      text: "คุณแน่ใจหรือไม่ว่าต้องการลบสมาชิก?",
                      type: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'ใช่, ยืนยัน!',
                      showLoaderOnConfirm: true
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                        type: "POST",
                        url: "functions.php",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            console.log(data);
                            swal('สำเร็จ','ลบสมาชิกเรียบร้อยแล้ว.','success')
                            table.ajax.reload();
                            },
                        });
                    }   
                })
            });

           
        });

 $(document).on('click', '#confirm_btn_edit', function(){
        var formData = new FormData($('#edit_frm')[0]);
    var password = $('#password').val();
  var password1 = $('#password1').val();
  var x = document.getElementById("password");
  var x1 = document.getElementById("password1");
 
  if (password =='' || password1 == '') {
  }else{
  if (x.value == x1.value ){
   username_edit.value = username_edit.value.toLowerCase();
   
  }else{
    
     swal('warning','รหัสผ่านไม่ตรงกัน.','error')
    username.value = username.value.toLowerCase();
    document.getElementById('password').value="";
    document.getElementById('password1').value="";
    return false   
  }
  }

    var username = $('#username_edit').val();
          var id_member = $('#id_member').val();
          var _method = 'doCheckuser_edit';
          
             $.ajax({  
                url:"functions.php?id_member="+id_member,  
                method:"POST",  
                data: {username:username,
                       _method:_method},
                success:function(data){
                // alert(data);  
                if(data.status==0){
                  swal('warning','username นี้มีผู้ใช้งานแล้ว.','error')
                  return false 
                }else{
                  
                }
              }  
            });
        

       

        swal({
            title: 'ยืนยัน?',
            text: "ยืนยันการแก้ไข?",
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
            text: "แก้ไขเรียบร้อย",
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
    });

 $(document).on('click', '#confirm_btn', function(){
        var formData = new FormData($('#confirm_frm')[0]);

var x = document.getElementById("password");
  var x1 = document.getElementById("password1");
  if (x.value == x1.value ){
   username.value = username.value.toLowerCase();
   
  }else{
    
     swal('warning','รหัสผ่านไม่ตรงกัน.','error')
    username.value = username.value.toLowerCase();
    document.getElementById('password').value="";
    document.getElementById('password1').value="";
    return false   
  }

  // var username = $('#username_edit').val();
          
          var _method = 'doCheckuser';
          
             $.ajax({  
                url:"functions.php",  
                method:"POST",  
                data: {username:username.value,
                       _method:_method},
                success:function(data){
                // alert(data);  
                if(data.status==0){
                  swal('warning','username นี้มีผู้ใช้งานแล้ว.','error')
                  return false 
                }else{
                  
                }
              }  
            });

        swal({
            title: 'ยืนยัน?',
            text: "ยืนยันการบันทึก?",
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
            text: "บันทึกเรียบร้อย",
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
    });
$(document).on('click', '#add_quotation_btn', function(event){ 
    // var id_order = $(this).attr("id");
    // var rid = $(this).attr("data-id"); 
    // var btn = $(this).attr("data-id1"); 
    
   

    $.ajax({   
            url:'functions.php', 
            method:'POST',  
            data:{_method:'add_customer'},  
            //dataType:"json", 
          
                success:function(data){  
                    //console.log(response.data[0]['path_slip']);
               

              
                $("#add_data").html(data); 
                   $("#modal_add").modal('show'); 
                }, 

                   
           });  


});

// set_value();
// function set_value() {
// document.getElementById('password').value="mm";
// document.getElementById('password1').value="mm";
// document.getElementById('username').value="mm ";
// }
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
function check_tel(ele)
  {
  var vchar = String.fromCharCode(event.keyCode);
  if ((vchar<'0' || vchar>'9') ) return false;
  ele.onKeyPress=vchar;
  }
         $(document).on('keyup', '.username', function(){
          var username = $(this).val();
          var _method = 'doCheckuser';
          
             $.ajax({  
                beforeSend:function(){
                  $('.spin-check').show();
                  $('.success-check').hide();
                  $('.wrong-check').hide();
                },
                complete:function(){
                  $('.spin-check').hide();
                },
                url:"functions.php",  
                method:"POST",  
                data: {username:username,
                       _method:_method},
                success:function(data){
                // alert(data);  
                if(data.status==0){
                  $('#employee-user-text').removeClass('warning-text-check-b2');
                  $('#employee-user-text').hide();
                  $('.wrong-check').show();
                  $('.success-check').hide();
                }else{
                  $('#employee-user-text').removeClass('warning-text-check-b2');
                  $('.success-check').show();
                  $('.wrong-check').hide();
                  $('#employee-user-text').hide(); 
                }
              }  
            });
        

          var i =0;
          $('.warning-text-check-b2').each(function(){
            i++;            
          });

          if(i==0){
            $('#next-authen').prop('disabled',false);
          }else{
            $('#next-authen').prop('disabled',true);
          }
        }); 

$(document).on('keyup', '.username_edit', function(){
          var username = $(this).val();
          var id_member = $('#id_member').val();
          var _method = 'doCheckuser_edit';
          
             $.ajax({  
                beforeSend:function(){
                  $('.spin-check').show();
                  $('.success-check').hide();
                  $('.wrong-check').hide();
                },
                complete:function(){
                  $('.spin-check').hide();
                },
                url:"functions.php?id_member="+id_member,  
                method:"POST",  
                data: {username:username,
                       _method:_method},
                success:function(data){
                // alert(data);  
                if(data.status==0){
                  $('#employee-user-text_edit').removeClass('warning-text-check-b2');
                  $('#employee-user-text_edit').hide();
                  $('.wrong-check').show();
                  $('.success-check').hide();
                }else{
                  $('#employee-user-text_edit').removeClass('warning-text-check-b2');
                  $('.success-check').show();
                  $('.wrong-check').hide();
                  $('#employee-user-text_edit').hide(); 
                }
              }  
            });
        

          var i =0;
          $('.warning-text-check-b2').each(function(){
            i++;            
          });

          if(i==0){
            $('#next-authen').prop('disabled',false);
          }else{
            $('#next-authen').prop('disabled',true);
          }
        }); 

    </script>
</body>
</html>
