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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <!-- Ionicons -->
    <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <!--Css table ใช้ของ เมนู -->
    <link rel="stylesheet" href="css/table-article.css">
    <!-- upload template css-->
    <link rel="stylesheet" type="text/css" href="css/up_pre.css">

    <!-- Include external CSS. -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">
    <!-- Include Editor style. -->
    <link href="../page_froala/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css">
    <link href="../page_froala/css/froala_style.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="select/dist/css/bootstrap-select.css">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- address thailande -->
    <link rel="stylesheet" href="js/jquery.Thailand.min.css">
</head>
<style type="text/css">
    .box-detail-em {
        padding: 10px;
        text-align: left;
    }

    .box-detail-em > div > .input-group-addon {
        background-color: #ddd;
    }

    .box-login {
        width: 100%;
    }

    .box-box-center {
        max-width: 400px;
        margin-top: 45px;
    }

    .box-box-center > .box-detail-em > p {
        font-weight: bold;
        margin-bottom: 3px;
        text-align: left;
    }

    .box-box-center > .box-detail-em > label {
        margin-bottom: 0;
    }

    .warning-text-check {
        color: orange;
    }

    .warning-text-check-b2 {
        color: orange;
    }

    .authen-active {
        cursor: pointer;
    }

    .active-authen {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .authen {
        display: none;
    }

    .Authentication > div > span {
        border-radius: 0;
    }

    .Authentication > div {
        padding: 0;
        margin-bottom: 5px;
        transition: 0.4s
    }
</style>
<body class="hold-transition skin-blue sidebar-mini fixed" onload="startTime()">
<div class="wrapper">

    <?php require_once '../template/nav_menu.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                แก้ไขร้านค้า
            </h1>
            <ol class="breadcrumb">
                <li><a href="../page_home/index.php"></i> แดชบอร์ด</a></li>
                <li><a href="front-manage.php"></i> ร้านค้า</a></li>
                <li class="active"><a href="#">แก้ไขร้านค้า</a></li>
            </ol>
        </section>
        <section class="content">
            <!-- Main content -->
            <!-- SELECT2 EXAMPLE -->
            <!-- <div class="box box-warning collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">คำแนะนำการใช้งาน</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div style="padding-left: 10px;">
                        <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถเพิ่ม/แก้ไข เนื้อหารายละเอียดของบทความได้ทั้งข้อความตัวอักษร รูปภาพ และวีดีโอ<br>
                        <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถเลือกหมวดหมู่บทความได้โดยคลิกเครื่องหมายถูก หน้าหมวดหมู่ที่ต้องการ สามารถเลือกได้ 1 หมวดหมู่ <br>
                        <i class="fa fa-caret-right"></i>&nbsp;&nbsp;กรณีที่ยังไม่มีการสร้างหมวดหมู่ สามารถเพิ่มหมวดหมู่จากหน้าเพิ่มบทความได้ทันที<br>
                        <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถใส่ภาพหน้าปกของบทความได้ รูปภาพควรมีขนาดไม่เกิน 500KB แนะนำขนาด 800x600 pixels รองรับไฟล์ .jpg, .gif, .png<br>
                    </div>
                </div>
            </div> -->
            <!-- /.box -->
            <div class="alert alert-success alert-dismissible" id="result_add_cat" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <div id="loader_add_cat">
                    <h4><i class="fa fa-circle-o-notch fa-spin"></i></h4>
                    Inserting...
                </div>
                <div id="success_add_cat">
                    <h4><i class="icon fa fa-check"></i> Increase!</h4>
                    Increase Catagory successful.
                </div>
            </div>

            <div class="alert alert-success alert-dismissible" id="result_add" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <div id="loader_add">
                    <h4><i class="fa fa-circle-o-notch fa-spin"></i></h4>
                    Inserting...
                </div>
                <div id="success_add">
                    <h4><i class="icon fa fa-check"></i> Increase!</h4>
                    Increase data successful.
                </div>
            </div>

            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><i class="fa fa-warning">&nbsp;&nbsp;</i>เสร็จสิ้น</h4>
                        </div>
                        <div class="modal-body">
                            <center><h4>แก้ไขบทความเรียบร้อยแล้ว คุณจะไปหน้าจัดการบทความหรือไม่</h4></center>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">แก้ไขเนื้อหาต่อ..</button>
                            <button type="button" class="btn btn-primary" id="btnYes">ยืนยัน</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            <?php
            $str = 'SELECT * FROM mod_erp_branch WHERE id_branch = "' . $_GET['id'] . '"';
            $query = mysqli_query($objConnect, $str);
            $result = mysqli_fetch_array($query);
            // echo password_hash('A123',PASSWORD_DEFAULT);
            ?>
            <form action="" method="post" enctype="multipart/form-data" id="frmEDIT" class="upload-form-add">
                <input type="hidden" name="form" value="edit">
                <input type="hidden" name="id" value="<?php echo $result['id_branch']; ?>">
                <div class="box box-info box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">ข้อมูล</h3>
                    </div>
                    <div class="row" style="padding: 20px;">
                        <div class="col-lg-12" style="margin-top: 10px;">
                            <div class="row">
                                <div class="col-md-3">
                                    <div style="width: 100%; padding-bottom: 10px;" align="center">
                                        <?php
                                        $str_image = 'SELECT * FROM mod_erp_branch_image WHERE id_branch = "' . $_GET['id'] . '"';
                                        $query_image = mysqli_query($objConnect, $str_image);
                                        $num_image = mysqli_num_rows($query_image);
                                        $result_image = mysqli_fetch_array($query_image);
                                        if ($num_image > 0) {
                                            $image = '../../uploads/branch/' . $result_image['name_image'];
                                        } else {
                                            $image = 'img/upload.jpg';
                                        }
                                        ?>
                                        <img id='img-upload' src="<?php echo $image ?>" style="cursor: pointer;"/>
                                    </div>
                                    <div class="input-group" style="width: 100%">
                                        <input type="text" class="form-control" readonly>
                                        <span class="input-group-btn" style="display: none;">
                                <span class="btn btn-default btn-file" style="background-color: white !important;">
                                  <i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;&nbsp;เลือกรูปภาพ <input type="file" name="image_branch" accept="image/*" id="imgInp" class="checkfilemember">
                                </span>
                              </span>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="box-detail-em">
                                                ชื่อร้านค้า
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
                                                    <input type="text" class="form-control " id="name_branch" name="name_branch" placeholder="ชื่อร้านค้า" value="<?php echo $result['name_branch'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="box-detail-em">
                                                ที่อยู่
                                                <textarea class="form-control " id="address" name="address" placeholder="ที่อยู่"><?php echo $result['address']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="box-detail-em">
                                                รหัสร้านค้า
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-qrcode"></i></span>
                                                    <input type="text" class="form-control " id="code_branch" name="code_branch" placeholder="รหัสร้านค้า" value="<?php echo $result['code_branch'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="box-detail-em">
                                                ตำบล
                                                <div class="input-group" style="width: 100%">
                                                    <input type="text" class="form-control " id="district" name="district" placeholder="ตำบล" value="<?php echo $result['district']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="box-detail-em">
                                                รหัสสาขา
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-qrcode"></i></span>
                                                    <input type="text" class="form-control " id="no_branch" name="no_branch" placeholder="รหัสสาขา" value="<?php echo $result['no_branch']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="box-detail-em">
                                                อำเภอ
                                                <div class="input-group" style="width: 100%">
                                                    <input type="text" class="form-control " id="amphoe" name="amphoe" placeholder="อำเภอ" value="<?php echo $result['amphoe']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="box-detail-em">
                                                Email
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                                    <input type="text" class="form-control " id="email" name="email" placeholder="Email" value="<?php echo $result['email'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="box-detail-em">
                                                จังหวัด
                                                <div class="input-group" style="width: 100%">
                                                    <input type="text" class="form-control " id="province" name="province" placeholder="จังหวัด" value="<?php echo $result['province']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="box-detail-em">
                                                โทรศัพท์
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                                    <input type="text" class="form-control " id="phone" name="phone" placeholder="หมายเลขโทรศัพท์ 044-471444, 091-00221177" value="<?php echo $result['phone'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="box-detail-em">
                                                รหัสไปรษณีย์
                                                <div class="input-group" style="width: 100%">
                                                    <input type="text" name="zipcode" class="form-control" id="zipcode" placeholder="รหัสไปรณีย์" value="<?php echo $result['zipcode']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="box-detail-em">
                                                ประเภท
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                                    <?php if ($result['type'] == 0) {
                                                        $selected0 = 'selected';
                                                        $selected1 = '';
                                                    } else {
                                                        $selected0 = '';
                                                        $selected1 = 'selected';
                                                    } ?>
                                                    <select class="form-control" name="type">
                                                        <option value="0" <?php echo $selected0; ?>>
                                                            ร้านค้าใหญ่
                                                        </option>
                                                        <option value="1" <?php echo $selected1; ?>>
                                                            ร้านค้าย่อย
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="box-detail-em">
                                                เลขประจำตัวผู้เสียภาษี
                                                <div class="input-group" style="width: 100%">
                                                    <input type="text" name="taxid" class="form-control" id="taxid" placeholder="เลขประจำตัวผู้เสียภาษี" value="<?php echo $result['tax']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
    </div>
</div>
<!-- /.box -->

</div>
<!-- /.col (left) -->
</div>
<!-- /.row -->
</form>
<div class="boxsave">
    <button type="button" class="btn btn-info pull-right btnSendEDIT" id="btnSendEDIT" style="transition: 0.4s; margin-left: 5px;"><i class="fa fa-check"></i>&nbsp;บันทึก</button>
    <button type="button" class="btn btn-warning pull-right btnSendClear" id="btnSendClear"><i class="fa fa-remove"></i>&nbsp;เคลียร์</button>
</div>
<!-- /.box -->

<!-- /.form send to DB-->
<!-- /.modal -->
<div class="modal fade" id="modal-alert">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-warning">&nbsp;&nbsp;</i>คำเตือน</h4>
            </div>
            <div class="modal-body">
                <div id="clearbox">
                    <h4>กรุณากรอกชื่อร้านค้า</h4>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">ฉันเข้าใจแล้ว</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</section>
<!-- /.content -->
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- Include external JS libs. -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>
<!-- Include JS files. -->
<script type="text/javascript" src="../page_froala/js/froala_editor.pkgd.min.js"></script>

<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- upload js-->
<script src="js/up_pre.js"></script>
<!-- thailand -->
<script src="js/jquery.Thailand.min.js"></script>
<script src="js/JQL.min.js"></script>
<script src="js/typeahead.bundle.js"></script>
<script src="js/zip.js"></script>
<script src="select/dist/js/bootstrap-select.js"></script>
<script>
    $(document).ready(function () {
        $.Thailand({
            $district: $('#district'), // input ของตำบล
            $amphoe: $('#amphoe'), // input ของอำเภอ
            $province: $('#province'), // input ของจังหวัด
            $zipcode: $('#zipcode'), // input ของรหัสไปรษณีย์
        });


        $(document).on('click', '#img-upload', function () {
            $('.btn-file :file').trigger('click');
        })

        //---------------------------------------clear form----------------------------------------------------------------------------------
        $(document).on('click', '.btnSendClear', function () {
            document.getElementById('frmADD').reset();
            $('#img-upload').attr('src', 'img/upload.jpg');
            $('#name-ex').html('');
            $('#sur-ex').html('');
            $('#code-ex').html('');
            $('#posi-ex').html('');
        });
        //------------------------------------------------------------ADD article--------------------------------------------------------------
        $(document).on('click', '.btnSendEDIT', function () {
            if ($('#name_branch').val() == '') {
                $('#modal-alert').modal('show');
                return false;
            }
            var formData = new FormData($('.upload-form-add')[0]);
            $.ajax({
                beforeSend: function () {
                    // setting a timeout
                    $('#result_add').show();
                    $('#success_add').hide();
                    $('#loader_add').show();
                },
                complete: function () {
                    $('#loader_add').hide();
                    $('#success_add').show();
                    setTimeout(function () {
                        $("#result_add").hide(0)
                    }, 10000);
                    $('#modal-default').modal('show');

                },
                type: "POST",
                url: "functions.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    //alert(data);
                },
            });
        });

        $(document).on('click', '#btnYes', function () {
            location.href = "front-manage.php";
        })
    });

    //------------------------------------------------------------------------------------------------------validation--------------
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
        if (i < 10) {
            i = "0" + i
        }
        ;  // add zero in front of numbers < 10
        return i;
    }

    //----------------------------------------------Check isnumber-----------------------------------------------------------------
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>
</body>
</html>
