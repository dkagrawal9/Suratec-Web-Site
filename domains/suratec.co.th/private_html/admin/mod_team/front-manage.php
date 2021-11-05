<?php
require_once '../library/connect.php';
require_once '../library/functions.php';
checkAdminUser($objConnect);

$title = 'จัดการทีม';
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
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <!-- Pace style -->
    <link rel="stylesheet" href="../plugins/pace/pace.min.css">
    <!--Css table -->
    <link rel="stylesheet" href="css/app.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" type="text/css" href="css/up_pre.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../plugins/sweetalert2/dist/sweetalert2.min.css">
    <style type="text/css">
        .btn-sm{
            margin-right: 5px;
        }

        @media (min-width: 768px)
        {
            .modal-dialog-add-product {
                width: 800px;
                margin: 30px auto;
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
                <div class="col-md-4">
                        
                    <!-- Start box warning for ADD system -->
                        <div class="box box-primary callout-primary-box">
                            <div class="box-header with-border">
                                <h3 class="box-title">เพิ่มทีม</h3>
                            </div>

                            <div class="box-body">
                                <form id="upload-form-add" enctype="multipart/form-data" class="upload-form-add">
                                    <input type="hidden" name="_method" value="CREATE">
<div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active">
                  <a href="#thai" data-toggle="tab" aria-expanded="true">
                    <img class="flag-lang" src="../img/th-fl.png" width="22" height="15">
                    ภาษาไทย
                  </a>
                </li>
                <li>
                  <a href="#english" data-toggle="tab" aria-expanded="false">
                    <img class="flag-lang" src="../img/en-fl.jpg" width="22" height="15">
                    ภาษาอังกฤษ
                  </a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="thai">
                  <div class="form-group">
                                    <label>ชื่อ</label>
                                    <input type="text" name="name" class="form-control" placeholder="ชื่อภาษาไทย">
                                </div>
                                 <div class="form-group">
                                    <label>ตำแหน่ง</label>
                                    <input type="text" name="position" class="form-control" placeholder="ตำแหน่งภาษาไทย">
                                </div>
                    
                </div>
                <div class="tab-pane" id="english">
                  <div class="form-group">
                                    <label>ชื่อ</label>
                                    <input type="text" name="name_en" class="form-control" placeholder="ชื่อภาษาอังกฤษ">
                                </div>
                                 <div class="form-group">
                                    <label>ตำแหน่ง</label>
                                    <input type="text" name="position_en" class="form-control" placeholder="ตำแหน่งภาษาอังกฤษ">
                                </div>
                </div>
              </div>
            </div>
                                

                                <div class="form-group">
                                    <label>ลำดับ</label>
                                    <input type="number" name="order_no" class="form-control" placeholder="ลำดับ">
                                </div>
                           
                            
                                 <div class="form-group">
                                    <label>รูปภาพ</label>
                                    <div style="width: 150px; padding-bottom: 10px;">
                                        <img id='img-upload' src="img/upload.jpg" />
                                    </div>
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly>
                                        <span class="input-group-btn">
                                            <span class="btn btn-default btn-file" style="background-color: white !important;">
                                              <i class="glyphicon glyphicon-folder-open"></i><input type="file" accept="image/*" id="imgInp" name="image">
                                            </span>
                                        </span>
                                    </div>
                                </div> 
                            </form>   
                            </div>
                            <div class="box-footer">
                                <button class="btn btn-info" id="save">บันทึก</button>
                            </div>
                        </div>
                </div>


                <div class="col-md-8">
                    <!-- Start box warning for ADD system -->
                    <div class="box box-primary callout-primary-box">
                        <div class="box-body">
                            <table class="table" id="table">
                                <thead>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            รูปภาพ
                                        </th>
                                        <th>
                                            ชื่อ
                                        </th>
                                        <th>
                                            ตำแหน่ง
                                        </th>
                                        <th>
                                            ลำดับ
                                        </th>
                                        <th>
                                            วันที่สร้าง
                                        </th>
                                        <th>
                                            ควบคุม
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </section>
                     <div class="modal fade" id="modal-default-edit">
                        <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title"><i class="fa fa-clone">&nbsp;&nbsp;</i>แก้ไข</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form id="upload-form-edit" enctype="multipart/form-data" class="upload-form-edit">
                                            <input type="hidden" name="team_id" id="team_id">
                                            <input type="hidden" name="_method" value="PATCH">
<div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active">
                  <a href="#thai_edit" data-toggle="tab" aria-expanded="true">
                    <img class="flag-lang" src="../img/th-fl.png" width="22" height="15">
                    ภาษาไทย
                  </a>
                </li>
                <li>
                  <a href="#english_edit" data-toggle="tab" aria-expanded="false">
                    <img class="flag-lang" src="../img/en-fl.jpg" width="22" height="15">
                    ภาษาอังกฤษ
                  </a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="thai_edit">
                  <div class="form-group">
                                            <label>ชื่อ</label>
                                            <input type="text" name="name" class="form-control" placeholder="ชื่อภาษาไทย" id="name_edit">
                                        </div>
                                        <div class="form-group">
                                            <label>ตำแหน่ง</label>
                                            <input type="text" name="position" class="form-control" placeholder="ตำแหน่งภาษาไทย" id="position_edit">
                                        </div>
                    
                </div>
                <div class="tab-pane" id="english_edit">
                  <div class="form-group">
                                    <label>ชื่อ</label>
                                    <input type="text" name="name_en" id="name_en_edit" class="form-control" placeholder="ชื่อภาษาอังกฤษ">
                                </div>
                                 <div class="form-group">
                                    <label>ตำแหน่ง</label>
                                    <input type="text" name="position_en" id="position_en_edit" class="form-control" placeholder="ตำแหน่งภาษาอังกฤษ">
                                </div>
                </div>
              </div>
            </div>
                                        
                                        <div class="form-group">
                                            <label>ลำดับ</label>
                                            <input type="number" name="order_no" class="form-control" placeholder="ลำดับ" id="order_edit">
                                        </div>
                                     
                                     
                                         <div class="form-group">
                                            <label>รูปภาพ</label>
                                            <div style="width: 150px; padding-bottom: 10px;">
                                                <img id='blah' src="img/upload.jpg" style="width: 150px;" />
                                            </div>
                                            <div class="input-group">
                                                <input type="text" class="form-control" readonly>
                                                <span class="input-group-btn">
                                                    <span class="btn btn-default btn-file" style="background-color: white !important;">
                                                      <i class="glyphicon glyphicon-folder-open"></i>
                                                      <input type="file" accept="image/*" id="imgInp" name="image-edit" onchange="readURL(this);">
                                                    </span>
                                                </span>
                                            </div>
                                        </div> 
                                    </form>   
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">ยกเลิก</button>
                                        <button type="button" class="btn btn-primary" id="btnsend-edit">บันทึก</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->

                        <div class="modal fade" id="modal-default-add-product">
                            <div class="modal-dialog modal-dialog-add-product">
                                <div class="modal-content">
                                    <div class="modal-header">
                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title"><i class="fa fa-clone">&nbsp;&nbsp;</i>นำสินค้าเข้าธนาคาร</h4>
                                    </div>
                                    <div class="modal-body">
                                        <table id="table-add-product" class="table">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <input type="checkbox" name="">
                                                    </th>
                                                    <th>
                                                        รูปภาพ
                                                    </th>
                                                    <th style="width: 150px;">
                                                        ชื่อสินค้า
                                                    </th>
                                                    <th>
                                                        ควบคุม
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">ยกเลิก</button>
                                        <button type="button" class="btn btn-primary" id="btnsend-add-product">บันทึก</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    <form id="form-del">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="team_id" value="" id="id_team_del">
                    </form>
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
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- PACE -->
    <!-- bootstrap datepicker -->
    <script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- bootstrap color picker -->
    <script src="../bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="../bower_components/PACE/pace.min.js"></script>
    <script src="js/timer.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="../plugins/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="up_pre/js.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
             var img = '';
             var table = $('#table').DataTable( {
                "ajax": 'select_team.php',
                "iDisplayLength" : 50,
                "columns": [
                    { "data": "team_id" , className : "text-center",
                     render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    } },
                    { "data": "img" ,
                    render: function(data) {
                        if(data==''){
                            img = 'img/upload.jpg';
                        }else{
                            img = data;
                        }
                        return '<img width="70" height="70" src="'+img+'">'
                      } },
                    { "data": "name" },
                    { "data": "position" },
                    { "data": "order_no" },
                    { "data": "create_date" },
                    { "defaultContent": "" +
                        "<button class='btn btn-warning btn-sm edit-team'>แก้ไข</button>" +
                        "<button class='btn btn-danger btn-sm del-pro'>ลบ</button>" +

                        ""
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

             var data = '';

            $(document).on('click','.add-product',function(event){
                data = table.row( $(this).parents('tr') ).data();
                location.href = 'front-manage-product.php?id='+data.team_id;
            })

            $(document).on('click', '.edit-team', function(event) {
                data = table.row( $(this).parents('tr') ).data();
                $('#team_id').val(data.team_id);
                $('#name_edit').val(data.name);
                $('#position_edit').val(data.position);
                $('#name_en_edit').val(data.name_en);
                $('#position_en_edit').val(data.position_en);
                $('#order_edit').val(data.order_no);
                if(data.img_path==''){
                    img = 'img/upload.jpg';
                }else{
                    img = '../../uploads/mod_team/'+data.img_name;
                }
                $('#blah').attr('src',img);
                // $('#name_edit').val(data.name_bank)
                console.log(data);
                $('#modal-default-edit').modal('show');
            });
               

            //Date range picker with time picker
            $('#reservationtime').daterangepicker({ 
                  startDate: new Date(),
                  showDropdowns: true,
                  timePicker: true,
                  timePicker24Hour: true,
                  timePickerIncrement: 10,
                  autoUpdateInput: true,
                  locale: {
                    format: 'YYYY-MM-DD HH:mm'
                  },
            })

             $('#reservationtime2').daterangepicker({ 
                  startDate: new Date(),
                  showDropdowns: true,
                  timePicker: true,
                  timePicker24Hour: true,
                  timePickerIncrement: 10,
                  autoUpdateInput: true,
                  locale: {
                    format: 'YYYY-MM-DD HH:mm'
                  },
            })


            var data = '';
            $('#save').click(function(event) {
                var formData = new FormData($('#upload-form-add')[0]);
                swal({
                  title: 'ยืนยัน?',
                  text: "คุณยืนยันจะเพิ่มทีมหรือไม่?",
                  type: 'info',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'ยืนยัน!',
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
                            swal('สำเร็จ','เพิ่มทีม.','success')
                            document.getElementById('upload-form-add').reset();
                            $('#img-upload').attr('src', 'img/upload.jpg');
                            table.ajax.reload();  
                            },
                        });
                    }   
                })
            });

            $('#btnsend-edit').click(function(event) {
                var formData = new FormData($('#upload-form-edit')[0]);
                swal({
                  title: 'ยืนยัน?',
                  text: "คุณยืนยันจะแก้ไขทีมหรือไม่?",
                  type: 'info',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'ยืนยัน!',
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
                            swal('สำเร็จ','แก้ไขทีมสำเร็จ.','success')
                            $('#modal-default-edit').modal('hide');
                            $('#blah').attr('src', 'img/upload.jpg');
                            table.ajax.reload();  
                            },
                        });
                    }      
                })
            });

                $(document).on('click','.del-pro',function(event) {
                var data = table.row( $(this).parents('tr') ).data();
                $('#id_team_del').val(data.team_id);
                swal({
                  title: 'ยืนยัน?',
                  text: "คุณยืนยันจะลบทีมหรือไม่?",
                  type: 'info',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'ยืนยัน!',
                  showLoaderOnConfirm: true
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "POST",
                            url: "functions.php",
                            data: $('#form-del').serialize(),
                            success: function(data) {
                            console.log(data);
                            swal('สำเร็จ','ลบทีมสำเร็จ.','success')
                            table.ajax.reload();  
                            },
                        });
                    }      
                })
            });
        })

    </script>
</body>
</html>
