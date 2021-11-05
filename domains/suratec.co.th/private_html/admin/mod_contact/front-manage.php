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
    <link rel="stylesheet" href="css/app.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

</head>
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
                <?php echo lang('การติดต่อสอบถาม','Contact'); ?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="../page_home/index.php"></i><?=lang('แดชบอร์ด','Dashboard')?></a></li>
                <li class="active"><?php echo lang('การติดต่อสอบถาม','Contact'); ?></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">


                <div class="col-lg-12 col-md-12 col-sm-12">
                    <!-- Start box warning for ADD system -->
                    <div class="box box-primary callout-primary-box">
                        <div class="box-header with-border">
                          <fieldset style="border: solid 3px #00BFFF ;padding-left: 20px; padding-right: 20px; padding-bottom: 20px">  
                    <legend style="width: auto; ">ค้นหา</legend>

                               <div class="col-md-12">
                                     <div class="form-group">
                                               
                                                 <div class="col-sm-3">
                                                    <div class='input-group date col-md-12' >
                                                        <input type='text' class="form-control" name="key_search" id='key_search' placeholder="ค้นหา"  />
                                                            
                                                    </div>
                                                 </div>
                                                 <div class="col-sm-3">
                                                    <div class='input-group date col-md-12' >
                                                        <SELECT class="form-control" name="status_search" id='status_search'>
                                                            <option value="***">เลือกสถานะ</option>
                                                            <option value="0">รอดำเนิดการ</option>
                                                            <option value="1">ตอบกลับแล้ว</option>
                                                        </SELECT>
                                                            
                                                    </div>
                                                 </div>
                                                
                                                <div class="col-sm-3">
                                                    <div class='input-group date col-md-12' >
                                                        <input type='text' class="form-control" name="datetimepicker" id='datetimepicker' autocomplete="off" />
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-calendar"></span>
                                                            </span>
                                                    </div>
                                                 </div>
                                                  <div class="col-sm-3">
                                                   
                                <button type="button" class="btn btn-primary search_date" id="search_date"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;<?=lang('ค้นหา', 'Search')?></button>&nbsp;&nbsp;&nbsp;
                                <button type="button" class="btn btn-primary search_full" id="search_full"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp;<?=lang('ทั้งหมด', 'Full')?></button>
                            
                           
                                                  </div>
                                                
                                            </div>
                                        </div>
                                        </fieldset>

                        </div>

                        <div class="box-body" id="div_table">
                            <table class="table table-striped table-bordered" id="table">
                                <thead>
                                    <tr>
                                        <th><?=lang('วันที่','Date')?></th>
                                        <th><?=lang('ผู้ติดต่อ','Communicant')?></th>
                                        <th><?=lang('เบอร์โทร','Number Phone')?></th>
                                        <th><?=lang('อีเมลล์','E-mail')?></th>
                                        <th><?=lang('เรื่อง','Subject')?></th>
                                        <th><?=lang('สถานะ','Status')?></th>
                                        <th><?=lang('ควบคุม','Control')?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

        </section>

        <form id="frmDel">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="id_mail" id="id_mail">
        </form>
        <div class="control-sidebar-bg"></div>
    </div>

    <!-- mail Modal -->
<div class="modal fade" id="modal_mail" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><?php echo lang('ตอบกลับการติดต่อ','Reply to contact'); ?></h3>
                
                <br>

                <label><div id="name_to"></div></label><br>
                <label><div id="email"></div></label><br>
                <label><div id="tel"></div></label><br>
                <label><div id="package_number"></div></label><br>
                <label>หมายเหตุ</label><br><div id="description" style="max-height: 100px; overflow: auto;"></div><br>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
      
<form action="" method="post" id="send_mail_form">

<input type="hidden" name="email_data" id="email_data">
<input type="hidden" name="name_to_data" id="name_to_data">
<input type="hidden" name="subject_data" id="subject_data">
<input type="hidden" name="message_data" id="message_data">
<input type="hidden" name="tel" id="tel">
<input type="hidden" name="id" id="id">

<div class="form-group">
  <label for="">ชื่อผู้ติดต่อ : </label>
  <input type="text" name="name_to_reply" id="name_to_reply"  value="<?php echo from_e_mail ?>" readonly class="form-control" placeholder="" aria-describedby="helpId">
</div>
<div class="form-group">
  <label for="">E-mail : </label>
  <input type="text" name="email_to_reply" id="email_to_reply" value="<?php echo e_mail ?>" readonly class="form-control" placeholder="" aria-describedby="helpId">
</div>
<!-- <div class="form-group">
  <label for="">หัวข้อ : </label>
  <input type="text" name="sub_to_reply" id="sub_to_reply" class="form-control" placeholder="" aria-describedby="helpId"  required>
</div> -->
<!-- <div class="form-group">
  <label for="">ช่องทางติดต่อ : </label>
  <input type="radio" name="contact_tel_mail" name="contact_tel_mail" value="1" checked="checked"> โทรศัทพ์
  <input type="radio" name="contact_tel_mail" name="contact_tel_mail" value="0"> E-mail
</div> -->
<div class="form-group">
  <label for="">รายละเอียด : </label>
  <textarea name="mass_to_reply" cols="30" rows="5" class="form-control" wrap="virtual" id="mass_to_reply"  required></textarea>
</div>


</form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSendAdd">Send to...</button>
            </div>
        </div>
    </div>
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
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- PACE -->
    <script src="../bower_components/PACE/pace.min.js"></script>
    <script src="js/timer.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script src="../plugins/sweetalert2/dist/sweetalert2.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function(){
          
     // function reload_table(){


     //        var table = $('#table').DataTable( {
     //            "ajax": 'select-contact.php',
     //            "iDisplayLength" : 10,
     //            "columns": [
     //                { "data": "send_datetime" },
     //                { "data": "name" },
     //                { "data": "tel" },
     //                { "data": "email" },
     //                { "data": "subject" },
                    
     //                { "data": function (data, type, dataToSet) {
     //                    if(data.status ==0){
     //                        return "<small class='label bg-orange' style='font-size:12px;'><?=lang('รอดำเนินการ','Pending...')?></small>";
     //                    }else{
     //                        return "<small class='label bg-green' style='font-size:12px;'><?=lang('ตอบกลับแล้ว','Replied')?></small>";
     //                    }
     //                } },
     //                { "data": function (data, type, dataToSet) {
     //                    return "" +
     //                    "<div class='btn-group'>" +
     //                    "<button class='btn btn-default btn-sm read' data-id='"+data.id_mail+"'><i class='fa fa-eye'></i></button>" +
     //                    "<button class='btn btn-default btn-sm reply' data-id='"+data.email+"' message='"+data.message+"' subject='"+data.subject+"' name_to='"+data.name+"' tel='"+data.tel+"' id_mail='"+data.id_mail+"'  data-toggle='tooltip' data-container='body' data-original-title='Reply'><i class='fa fa-reply'></i></button>" +

     //                    // "<button class='btn btn-default btn-sm del'><i class='fa fa-trash'></i></button>" +
     //                    "</div>"
     //                } }
     //            ],
     //                "language": {
     //                "lengthMenu": "<?=lang('แสดง','Show')?> _MENU_ <?=lang('แถวต่อหน้า','Row per page')?>",
     //                "zeroRecords": "<?=lang('ไม่พบข้อมูล','data not found ')?>",
     //                "info": "<?=lang('กำลังแสดงหน้าที่','Show')?> _PAGE_ <?=lang('จาก','Total')?> _PAGES_",
     //                "infoEmpty": "<?=lang('ไม่พข้อมูล','Control')?>",
     //                "infoFiltered": "(<?=lang('จากทั้งหมด','Control')?> _MAX_)"
     //                }
     //        });
     //        }   
            $(document).on('click', '.reply', function(event) {
                //var email = $(this).attr('data-id');
                var email = $(this).attr('data-id');
                var message = $(this).attr('message');
                var subject = $(this).attr('subject');
                var name_to = $(this).attr('name_to');
                var tel = $(this).attr('tel');
                var id = $(this).attr('id_mail');

                console.log(email);
                console.log(message);
                console.log(subject);

                $("#email").html("E-mail : "+email);
                $("#name_to").html("User : "+name_to);
                $("#tel").html("เบอร์โทรศัทพ์ : "+tel);
                $("#package_number").html("หมายเลขพัสดุ : "+subject);
                $("#description").html(""+message);
                 

                $("#email_data").val(email); 
                $("#name_to_data").val(name_to); 
                $("#subject_data").val(subject); 
                $("#message_data").val(message); 
                $("#tel_to_reply").val(tel); 
                $("#id").val(id);


                $('#modal_mail').modal('show');
               // location.href = 'mailto:'+email;
            });
$("#modal_mail").on('hidden.bs.modal', function () {
    $("#mass_to_reply").val(''); 
  });
            $(document).on('click', '.read', function(event) {
                var id = $(this).attr('data-id');
                location.href = 'read.php?id='+id;
            });
            $(document).on('click','.del',function(event) {
                var data = table.row( $(this).parents('tr') ).data();
                $('#id_mail').val(data.id_mail);
                swal({
                  title: '<?=lang('ยืนยัน?','Confirm?')?>',
                  text: "<?=lang('คุณยืนยันจะลบข้อความนี้หรือไม่','Do you confirm to delete this message?')?>?",
                  type: 'info',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: '<?=lang('ยืนยัน','Confirm')?>',
                  showLoaderOnConfirm: true,
                  preConfirm: function () {
                        return new Promise(function (resolve) {
                        $.ajax({
                            type: "POST",
                            url: "functions.php",
                            data: $('#frmDel').serialize(),
                         })
                      // in case of successfully understood ajax response
                        .done(function (myAjaxJsonResponse) {
                            console.log(myAjaxJsonResponse);
                            swal('<?=lang('สำเร็จ','Success')?>','<?=lang('ลบสำเร็จ','Delete Success')?>','success')
                            table.ajax.reload();  
                           })
                        .fail(function (erordata) {
                          console.log(erordata);
                          swal('<?=lang('ไม่สำเร็จ','Not Success')?>', '<?=lang('เกิดปัญหากับระบบ','There is a problem with the system.')?>', 'error');
                        })

                    })
                  },    
                })
            });



        });
        
var data = '';
$('#btnSendAdd').click(function (event) {

if($("#sub_to_reply").val() == "" || $("#mass_to_reply").val() == "" ){
    swal('คำเตือน!','กรุณากรอกข้อมูล','warning')
                    if($("#sub_to_reply").val() == ""){
                        $("#sub_to_reply").attr("style" , "border-color: red; border-width: 1px;");
                        setTimeout(function() {
                            $("#sub_to_reply").attr("style" , "");
                        }, 5000);
                    }
                    if($("#mass_to_reply").val() == ""){
                        $("#mass_to_reply").attr("style" , "border-color: red; border-width: 1px;");
                        setTimeout(function() {
                            $("#mass_to_reply").attr("style" , "");
                        }, 5000);
                    }
}else{
var formData = new FormData($('#send_mail_form')[0]);

        swal({
            title: 'ยืนยัน?',
            text: "ยืนยันการตอบกลับ",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน!',
            showLoaderOnConfirm: true
        }).then((result) => {
           if (result.value) {
                //console.log(result.value);
                $.ajax({
                    type: "POST",
                    url: "mail_to.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                         console.log(data.status);
                        //  if(data.status==1){
                        swal('สำเร็จ',
                            'การตอบกลับสำเร็จ',
                            'success'
                        ).then((value) => {
                            // window.location = 'front-add.php?values=' + $('#sale_id').val();
                            window.location = '';
                        }); 
                  //  }                         
                    },
                });
            }
        })
     }

})
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
   $(document).on('click','#search_date',function(event) {
     var datetimepicker = $('#datetimepicker').val();
     var key_search = $('#key_search').val();
     var status_search = $('#status_search').val();
      var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
     
     $.ajax({  
                  url:"select_table.php?do=select_table",  
                  method:"POST",  
                   data:{status_search,status_search,key_search:key_search,datetimepicker:datetimepicker,button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},
                  success:function(data){  
              $('#div_table').html(data);  
              $('#table').DataTable();
                  }  
              });  
  })
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
              $('#div_table').html(data); 
               $('#table').DataTable(); 
                  }  
              });  
          }  
          fetch_data_slide();

           $(document).on('click','#search_full',function(event) {
      fetch_data_slide();
          
  })
    </script>
</body>
</html>
