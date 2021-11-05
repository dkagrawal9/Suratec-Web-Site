<?php
require_once '../library/connect.php';
require_once '../library/functions.php';
checkAdminUser($objConnect);

$title = 'จัดการขนส่ง';
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../plugins/sweetalert2/dist/sweetalert2.min.css">

</head>
    <style type="text/css">
        .btn-sm{
            margin-right: 5px;
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
                            <table class="table" id="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ชื่อขนส่ง</th>
                                        <th>ราคา</th>
                                        <th>วันที่สร้าง</th>
                                        <th>Control</th>
                                    </tr>
                                </thead>
                                <tbody id="Customers-table">
                                
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
<div class="boxsave">
            <button type="button" class="btn btn-primary pull-right btnSendAdd" id="btnSendAdd" style="transition: 0.4s; margin-left: 5px;"><i class="fa fa-clone"></i>&nbsp; สร้างหัวข้อใหม่</button>
        </div>
        </section>
              <!-- New address -->
                <div class="modal fade" id="modal-default">
                        <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title"><i class="fa fa-clone">&nbsp;&nbsp;</i>สร้างใหม่</h4>
                                    </div>
                                    <div class="modal-body">
                                       <div class="form-horizontal">
                                        <form id="form-add">
                                            <input type="hidden" name="_method" value="CREATE">
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ชื่อขนส่ง</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="name_shipping">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ราคา</label>

                                                <div class="col-sm-8">
                                                    <input type="number" name="price" class="form-control">
                                                </div>
                                            </div> 
                                            </form> 
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                            <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">ยกเลิก</button>
                                        <button type="button" class="btn btn-primary" id="btnSend-new">สร้าง</button>
                                    </div>
                        
                    </div>
                    <!-- /.modal -->
                </div>
            </div>


            <div class="modal fade" id="modal-default-edit">
                        <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title"><i class="fa fa-clone">&nbsp;&nbsp;</i>แก้ไข</h4>
                                    </div>
                                    <div class="modal-body">
                                       <div class="form-horizontal">
                                        <form id="form-edit">
                                            <input type="hidden" name="_method" value="PATCH">
                                             <input type="hidden" name="id_shipping" value="" id="id_shipping">
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ชื่อขนส่ง</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="name_shipping" id="name_shipping">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ราคา</label>

                                                <div class="col-sm-8">
                                                    <input type="number" name="price" class="form-control" id="price">
                                                </div>
                                            </div> 
                                            </form> 
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                            <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">ยกเลิก</button>
                                        <button type="button" class="btn btn-primary" id="btnSend-edit">อัพเดต</button>
                                    </div>
                        
                    </div>
                    <!-- /.modal -->
                </div>
            </div>

        
        <form id="form-del">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="id_shipping" value id="form-del-cus">
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
        $(document).ready(function(){


            $(document).ajaxStart(function () {
                Pace.restart()
            });

            var table = $('#table').DataTable( {
                "ajax": 'select_ship.php',
                "iDisplayLength" : 50,
                "columns": [
                    { "data": "id_shipping" , className : "text-center",
                     render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    } },
                    { "data": "name_shipping" },
                    { "data": "price" },
                    { "data": "create_datetime" },
                    { "defaultContent": "" +
                        "<button class='btn btn-warning btn-sm edit-cus'>แก้ไข</button>" +
                        "<button class='btn btn-danger btn-sm del-cus'>ลบ</button>" +
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

            // $(document).on('click','.edit-cus',function(){
            //     data = table.row( $(this).parents('tr') ).data();
            //     location.href = 'front-edit.php?id='+data.id_customer;
            // })

            $(document).on('click','.btnSendAdd',function(){
                data = table.row( $(this).parents('tr') ).data();
                $('#modal-default').modal('show');
            })

            $(document).on('click','.edit-cus',function(){
                data = table.row( $(this).parents('tr') ).data();
                $('#id_shipping').val(data.id_shipping);
                $('#name_shipping').val(data.name_shipping);
                $('#price').val(data.price);
                $('#modal-default-edit').modal('show');
            })

            $(document).on('click', '#btnSend-edit', function(event) {
                 $.ajax({
                        type: "POST",
                        url: "functions.php",
                        data: $('#form-edit').serialize(),
                        success: function(data) {
                            console.log(data);
                            swal('สำเร็จ','บันทึกสำเร็จแล้ว.','success')
                            table.ajax.reload();
                            $('#modal-default-edit').modal('hide');
                            },
                        });
            });

             $(document).on('click','#btnSend-new',function(){
                $.ajax({
                        type: "POST",
                        url: "functions.php",
                        data: $('#form-add').serialize(),
                        success: function(data) {
                            console.log(data);
                            swal('สำเร็จ','สร้างสำเร็จแล้ว.','success')
                            table.ajax.reload();
                            $('#modal-default').modal('hide');
                            },
                        });
            })
    
            $(document).on('click', '.del-cus', function(event) {
               data = table.row( $(this).parents('tr') ).data();
                $('#form-del-cus').val(data.id_shipping);
                console.log(data.id_customer);
                var formData = new FormData($('#form-del')[0]);
                swal({
                      title: 'Are you sure?',
                      text: "Are you need to delete address?",
                      type: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Yes, delete it!',
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
                            swal('Complete','delete complete.','success')
                            table.ajax.reload();
                            },
                        });
                    }   
                })
            });

           
        });
    </script>
</body>
</html>
