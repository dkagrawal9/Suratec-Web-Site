<?php
require_once '../library/connect.php';
require_once '../library/functions.php';
checkAdminUser($objConnect);

$title = 'Customer Address Management';

$str = "SELECT * FROM mod_customer WHERE id_customer = '".$_GET['id']."'";
$query = mysqli_query($objConnect,$str);
$result = mysqli_fetch_array($query);
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
    <link rel="stylesheet" href="../plugins/sweetalert2/dist/sweetalert2.min.css">
    <!-- <link rel="stylesheet" href="css/app.css"> -->
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="js/jquery.Thailand.min.css">
    <style type="text/css">
        .btn-sm{
            margin-right: 5px;
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
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <!-- Start box warning for ADD system -->
                    <div class="box box-primary callout-primary-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Address <?php echo $result['fname']; ?></h3>
                        </div>

                        <div class="box-body">
                            <table class="table" id="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ชื่อ</th>
                                        <th>นามสกุล</th>
                                        <th>เบอร์โทร</th>
                                        <th>รูปแบบ</th>
                                        <th style="width: 250px;">Control</th>
                                    </tr>
                                </thead>

                                <tbody id="tablebody">

                                </tbody>

                            </table>

                        </div>

                    </div>
                </div>
        <div class="boxsave">
            <button type="button" class="btn btn-primary pull-right btnSendAdd" id="open-add" style="transition: 0.4s; margin-left: 5px;"><i class="fa fa-clone"></i>&nbsp;New Address</button>
            <button type="button" class="btn btn-default pull-right " id="btnSendClear" style="margin-left: 5px;" onClick="javascript:location.href='front-manage.php'">
            <i class="fa fa-list"></i>&nbsp;Customer List
        </button>
        </div>

                <!-- New address -->
                <div class="modal fade" id="modal-default">
                    <form id="form-add">
                        <input type="hidden" name="_method" value="CREATE_ADDRESS">
                        <input type="hidden" name="id_customer" value="<?php echo $_GET['id'] ?>">
                        <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title"><i class="fa fa-clone">&nbsp;&nbsp;</i>New</h4>
                                    </div>
                                    <div class="modal-body">
                                       <div class="form-horizontal">
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ชื่อ</label>

                                                <div class="col-sm-8">
                                                    <input type="email" class="form-control" name="fname-address">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">นามสกุล</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="lname-address">
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ที่อยู่</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="address">
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ตำบล</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control " id="district" name="district" placeholder="ตำบล">
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">อำเภอ</label>

                                                <div class="col-sm-8">
                                                   <input type="text" class="form-control " id="amphor" name="amphur" placeholder="อำเภอ">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">จังหวัด</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control " id="province" name="province" placeholder="จังหวัด">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">รหัสไปรษณีย์</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control " id="zipcode" name="postalcode" placeholder="รหัสไปรษณีย์">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">เบอร์โทร</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control"  name="telephone">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="btnSend-new">New</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </form>
                    </div>
                    <!-- /.modal -->

                     <!-- Edit address -->
                    <div class="modal fade" id="modal-default-edit">
                    <form id="form-edit">
                        <input type="hidden" name="_method" value="PATCH_ADDRESS">
                        <input type="hidden" name="id_address" value="" id="form-edit-address">
                        <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title"><i class="fa fa-clone">&nbsp;&nbsp;</i>แก้ไขที่อยุ่</h4>
                                    </div>
                                    <div class="modal-body">
                                       <div class="form-horizontal">
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ชื่อ</label>

                                                <div class="col-sm-8">
                                                    <input type="email" class="form-control" name="fname-address" id="fname-address">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">นามสกุล</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="lname-address" id="lname-address">
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ที่อยู่</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="address" id="address-address">
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ตำบล</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control " id="district-address" name="district" placeholder="ตำบล">
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">อำเภอ</label>

                                                <div class="col-sm-8">
                                                   <input type="text" class="form-control " id="amphur-address" name="amphur" placeholder="อำเภอ">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">จังหวัด</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control " id="province-address" name="province" placeholder="จังหวัด">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">รหัสไปรษณีย์</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control " id="zipcode-address" name="postalcode" placeholder="รหัสไปรษณีย์">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">เบอร์โทร</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control"  name="telephone" id="telephone-address">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="btnSend-edit">Save</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </form>
                    </div>
                    <!-- /.modal -->
                    <form id="form-del">
                        <input type="hidden" name="_method" value="DELETE_ADDRESS">
                        <input type="hidden" name="" id="default">
                        <input type="hidden" name="id_address" value id="form-del-address">
                    </form>

                    <form id="form-default">
                        <input type="hidden" name="_method" value="PATCH_ADDRESS_DEFAULT">
                        <input type="hidden" name="id_address" value id="form-def-address">
                        <input type="hidden" name="id_customer" value id="form-def-address-customer">
                    </form>
        </section>

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
    <script src="../bower_components/PACE/pace.min.js"></script>
    <script src="js/timer.js"></script>
    <script src="js/jquery.Thailand.min.js"></script>
    <script src="js/JQL.min.js"></script>
    <script src="js/typeahead.bundle.js"></script>
    <script src="js/zip.js"></script>
    <!-- PACE -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="../plugins/sweetalert2/dist/sweetalert2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $.Thailand({
                $district: $('#district'), // input ของตำบล
                $amphoe: $('#amphor'), // input ของอำเภอ
                $province: $('#province'), // input ของจังหวัด
                $zipcode: $('#zipcode'), // input ของรหัสไปรษณีย
            });
            $.Thailand({
                $district: $('#district-address'), // input ของตำบล
                $amphoe: $('#amphur-address'), // input ของอำเภอ
                $province: $('#province-address'), // input ของจังหวัด
                $zipcode: $('#zipcode-address'), // input ของรหัสไปรษณีย               
            });
            var data = '';

            var id_customer = '<?php echo $result['id_customer'] ?>';
            $(document).ajaxStart(function () {
                Pace.restart()
            });

             var table = $('#table').DataTable( {
                "ajax": 'select_address.php?id='+id_customer,
                "iDisplayLength" : 50,
                "columns": [
                    { "data": "id_address" , className : "text-center" },
                    { "data": "fname" },
                    { "data": "lname" },
                    { "data": "telephone" },
                    { "data": "status" },
                    { "defaultContent": "" +
                        "<button class='btn btn-warning btn-sm edit'>แก้ไข</button>" +
                        "<button class='btn btn-danger btn-sm delete'>ลบที่อยู่</button>" +
                        // "<button class='btn btn-success btn-sm status'>ตั้งเป็นที่อยู่เริ่มต้น</button>" +
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

            } );

            $('#open-add').click(function(event) {
                $('#modal-default').modal('show');
            });

            $(document).on('click', '.edit', function(event) {
                data = table.row( $(this).parents('tr') ).data();
                $('#form-edit-address').val(data.id_address);
                $('#fname-address').val(data.fname);
                $('#lname-address').val(data.lname);
                $('#address-address').val(data.address);
                $('#district-address').val(data.district);
                $('#amphur-address').val(data.amphur);
                $('#province-address').val(data.province);
                $('#telephone-address').val(data.telephone);
                $('#zipcode-address').val(data.postalcode);
                console.log(data);
                $('#modal-default-edit').modal('show');
            });
               

            $(document).on('click', '#btnSend-new', function(event) {
                var formData = new FormData($('#form-add')[0]);
                swal({
                      title: 'ยืนยัน?',
                      text: "คุณยืนยันจะสร้างที่อยู่นี้ใช่หรือไม่?",
                      type: 'info',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'ใช่ ยืนยัน',
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
                            swal('สำเร็จ','สร้างที่อยู่สำเร็จแล้ว','success')
                            document.getElementById('form-add').reset();
                            table.ajax.reload();
                            $('#modal-default').modal('hide');
                            },
                        });   
                    }
                })
            });

            $(document).on('click', '#btnSend-edit', function(event) {
                var formData = new FormData($('#form-edit')[0]);
                swal({
                      title: 'ยืนยัน?',
                      text: "คุณยืนยันจะแก้ไขที่อยู่นี้ใช่หรือไม่?",
                      type: 'info',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'ใช่ ยืนยัน',
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
                            swal('สำเร็จ','แก้ไขข้อมูลเรียบร้อยแล้ว','success')
                            document.getElementById('form-edit').reset();
                            table.ajax.reload();
                            $('#modal-default-edit').modal('hide');
                            },
                        });   
                    }
                })
            });

            $(document).on('click', '.delete', function(event) {
                data = table.row( $(this).parents('tr') ).data();
                if(data.status=='default'){
                    swal('คำเตือน','ไม่สามารถลบที่อยู่ ค่าเริ่มต้นได้.','warning');
                    return false;
                }
                $('#form-del-address').val(data.id_address);
                var formData = new FormData($('#form-del')[0]);
                swal({
                      title: 'ยืนยัน?',
                      text: "คุณยืนยันจะลบที่อยู่นี้หรือไม่?",
                      type: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'ใช่ ยืนยัน',
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
                            swal('สำเร็จ','ลบที่อยู่สำเร็จแล้ว.','success')
                            document.getElementById('form-edit').reset();
                            table.ajax.reload();
                            },
                        });   
                    }
                })
            });

            $(document).on('click', '.status', function(event) {
                data = table.row( $(this).parents('tr') ).data();
                $('#form-def-address').val(data.id_address);
                $('#form-def-address-customer').val('<?php echo $_GET['id']; ?>');
                if(data.status=='default'){
                    swal('คำเตือน','เป็นที่อยู่เริ่มต้นอยู่แล้ว','warning');
                    return false;
                }
                var formData = new FormData($('#form-default')[0]);
                swal({
                      title: 'ยืนยัน',
                      text: "คุณยืนยันจะตั้งเป็นที่อยู่เริ่มต้นหรือไม่?",
                      type: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'ใช่ ยืนยัน',
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
                            swal('สำเร็จ','ตั้งค่าที่อยู่นี้เป็นค่าเริ่มต้นแล้ว.','success')
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
