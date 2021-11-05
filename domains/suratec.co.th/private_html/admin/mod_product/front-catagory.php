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
    <title><?= TITLE ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="components/select/dist/css/bootstrap-select.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
    <!-- Pace style -->
    <link rel="stylesheet" href="../plugins/pace/pace.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
		 folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <!-- css table article -->
    <link rel="stylesheet" type="text/css" href="components/up_pre/style.css">
    <!--sweet alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css.map">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ajaxStart(function () {
            Pace.restart()
        })
        $(document).ready(function () {
            //------------------------------------------------------------fetch data category-------------------------------------------------------
            function fetch_data_catagory() {
                var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
                $.ajax({
                    url: "select_cat-front.php",
                    method: "POST",
                    data:{button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read },
                    success: function (data) {
                        $('#catagory').html(data);
                    }
                });
            }

            fetch_data_catagory();

            //------------------------------------------------------------fetch data category-------------------------------------------------------
            function fetch_data_catagory_widget() {
                $.ajax({
                    url: "select_cat-front-widget.php",
                    method: "POST",
                    success: function (data) {
                        $('#catagory-widget').html(data);
                    }
                });
            }

            fetch_data_catagory_widget();

            //---------------------------------------fetch add menu for refresh ajax---------------------------------------------------------------
            function fetch_add() {
                $.ajax({
                    url: "select_add-catagory.php",
                    method: "POST",
                    success: function (data) {
                        $('#live-add').html(data);
                    }
                });
            }

            fetch_add();

            //---------------------------------------fetch add menu for refresh ajax---------------------------------------------------------------
            function fetch_cat_add() {
                $.ajax({
                    url: "select_cat-fetch-add.php",
                    method: "POST",
                    success: function (data) {
                        $('#live_cat-add').html(data);
                    }
                });
            }

            fetch_cat_add();
            $(document).on('mouseenter', '.updateCat_en', function () {
                $(this).addClass('hover_input');
            }).on('mouseleave', '.updateCat_en', function () {
                $(this).removeClass('hover_input');
            });

            $(document).on('mouseenter', '.updateCat', function () {
                $(this).addClass('hover_input');
            }).on('mouseleave', '.updateCat', function () {
                $(this).removeClass('hover_input');
            });
            //------------------------------------------------------------------add catagory--------------------------------------------------------
            $(document).on('click', '.btnSendClear', function () {
                document.getElementById('reset-form').reset();
                $('#change-icon').html('<i class="fa fa-plus"></i>');
                $('#img-upload').attr('src', 'components/up_pre/upload.jpg');
            });
            $(document).on('click', '.ch-icon', function () {
                var id = $(this).attr('data-id');
                $('#id_catagory').val(id);
                $('#modal-ch-icon').modal('show');

            });
            $(document).on('click', '.change-icon', function () {
                var i = $(this).html();
                var id = $('#id_catagory').val();
                swal({
                    title: "ยืนยัน?",
                    text: "ยืนยันการเปลี่ยนไอคอน",
                    type: "info",
                    showCancelButton: true,
                    cancelButtonText: "ยกเลิก",
                    confirmButtonText: "ยืนยัน",
                    confirmButtonClass: "btn-info",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                }, function () {
                    $.ajax({
                        complete: function () {
                            swal("สำเร็จ", "เพิ่มหมวดหมู่เรียบร้อยแล้ว", "success");
                            $('#modal-ch-icon').modal('hide');
                        },
                        url: "back_catagory-edit.php",
                        method: "POST",
                        data: {id_catagory: id, icon: i},
                        success: function (data) {
                            fetch_data_catagory_widget();
                        }
                    });
                });


            });
            //-------------------------------------------------------------------modal edit icon----------------------------------------------------
            $(document).on('click', '.ch-icon-edit', function () {
                $('#modal-ch-icon-edit').modal('show');
            });
            $(document).on('click', '.change-icon-edit', function () {
                var i = $(this).html();
                $('#change-icon-edit').html(i);
                $('#change-icon-value-edit').val(i);
                $('#modal-ch-icon-edit').modal('hide');
            });

            //------------------------------------------------------------ADD Catagory--------------------------------------------------------------
            $(document).on('click', '.btnSendAdd', function () {
                var formData = new FormData($('.upload-form-add')[0]);
                // var name = $("#name_cat").val();
                // var name_en = $('#name_cat_en').val();
                // var sub = $("#sub_catagory").val();
                swal({
                    title: "ยืนยัน?",
                    text: "ยืนยันการเพิ่มหมวดหมู่",
                    type: "info",
                    showCancelButton: true,
                    cancelButtonText: "ยกเลิก",
                    confirmButtonText: "ยืนยัน",
                    confirmButtonClass: "btn-info",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                }, function () {
                    $.ajax({
                        complete: function () {
                            swal("สำเร็จ", "เพิ่มหมวดหมู่เรียบร้อยแล้ว", "success");
                        },
                        type: "POST",
                        url: "back_catagory-add.php",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            document.getElementById('reset-form').reset();
                            $('#change-icon').html('<i class="fa fa-plus"></i>');
                            $('#img-upload').attr('src', 'components/up_pre/upload.jpg');
                            fetch_cat_add();
                            fetch_data_catagory();
                            fetch_data_catagory_widget();
                        },
                    });
                });
            });
            //------------------------------------------------------------Update Catagory product with modal-----------------------------------------------
            $(document).on('click', '.btnSendEdit', function () {
                var formData = new FormData($('.upload-form-edit')[0]);
                swal({
                    title: "ยืนยัน?",
                    text: "ยืนยันการแก้ไขหมวดหมู่",
                    type: "info",
                    showCancelButton: true,
                    cancelButtonText: "ยกเลิก",
                    confirmButtonText: "ยืนยัน",
                    confirmButtonClass: "btn-info",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                }, function () {
                    $.ajax({
                        complete: function () {
                            swal("สำเร็จ", "แก้ไขหมวดหมู่เรียบร้อยแล้ว", "success");
                            $('#modal-edit-catagory').modal('hide');
                        },
                        type: "POST",
                        url: "back_catagory-edit.php",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            fetch_data_catagory_widget();
                            fetch_data_catagory();
                            fetch_add();
                        },
                    });
                });
            })
            //------------------------------------------------------------Update Catagory passing modal-----------------------------------------------
            $(document).on('change', '.updateCat', function () {
                var name = $(this).val();
                var id = $(this).attr('data-id');
                var id_name = name + '-' + id;
                swal({
                    title: "ยืนยัน?",
                    text: "ยืนยันการแก้ไขหมวดหมู่",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "ยกเลิก",
                    confirmButtonText: "ยืนยัน",
                    confirmButtonClass: "btn-warning",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                }, function () {
                    $.ajax({
                        complete: function () {
                            swal("สำเร็จ", "เรียบร้อยแล้ว", "success");
                            fetch_data_catagory();
                            fetch_add();
                        },
                        type: "POST",
                        url: 'back_catagory-edit.php',
                        data: {id: id_name},
                        success: function (data) {
                            alert(data);
                        },
                    });
                });
            });
            //------------------------------------------------------------Update Catagory passing modal-----------------------------------------------
            $(document).on('change', '.updateCat_en', function () {
                var name = $(this).val();
                var id = $(this).attr('data-id');
                var en = $(this).attr('data-en');
                var id_name = name + '-' + id + '-' + en;
                swal({
                    title: "ยืนยัน?",
                    text: "ยืนยันการแก้ไขหมวดหมู่",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "ยกเลิก",
                    confirmButtonText: "ยืนยัน",
                    confirmButtonClass: "btn-warning",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                }, function () {
                    $.ajax({
                        complete: function () {
                            swal("สำเร็จ", "เรียบร้อยแล้ว", "success");
                            fetch_data_catagory();
                            fetch_add();
                        },
                        type: "POST",
                        url: 'back_catagory-edit.php',
                        data: {id: id_name},
                        success: function (data) {
                            alert(data);
                        },
                    });
                });
            });
            //------------------------------------------------------------Update Catagory passing modal-----------------------------------------------
            $(document).on('change', '.updateCat_sub', function () {
                var id = $(this).val();
                // var level = $(this).find(':selected').data('id')
                // alert(id+"----"+level);
                swal({
                    title: "ยืนยัน?",
                    text: "ยืนยันการแก้ไขหมวดหมู่",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "ยกเลิก",
                    confirmButtonText: "ยืนยัน",
                    confirmButtonClass: "btn-warning",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                }, function () {
                    $.ajax({
                        complete: function () {
                            swal("สำเร็จ", "เรียบร้อยแล้ว", "success");
                            fetch_data_catagory();
                            fetch_add();
                        },
                        type: "POST",
                        url: 'back_catagory-edit.php',
                        data: {id_id: id},
                        success: function (data) {
                            alert(data);
                        },
                    });
                });
                fetch_data_catagory();
            });
            $(document).on('click', '.open-sub', function () {
                var id = $(this).attr('data-id');
                $('.box-tr' + id).slideToggle();
            });
            //---------------------------------------------------------send value to modal------------------------------------------------------
            $(document).on('click', '.edit-catagory', function () {
                // document.getElementById("btnSendEdit").disabled = false;
                var id = $(this).attr('data-id');
                $.ajax({
                    complete: function () {
                        $('#modal-edit-catagory').modal('show');
                    },
                    type: "POST",
                    url: "select_cat-modal-edit.php",
                    data: 'id=' + id,
                    success: function (data) {
                        // $.getScript("js/select/dist/js/bootstrap-select.js");
                        $('#live_modal-edit').html(data);
                    }
                });
            });
             $(document).on('click', '.show-catagory', function () {
                // document.getElementById("btnSendEdit").disabled = false;
                var id = $(this).attr('data-id');
                $.ajax({
                    complete: function () {
                        $('#modal-edit-catagory').modal('show');
                    },
                    type: "POST",
                    url: "select_cat-modal-show.php",
                    data: 'id=' + id,
                    success: function (data) {
                        // $.getScript("js/select/dist/js/bootstrap-select.js");
                        $('#live_modal-edit').html(data);
                    }
                });
            });
            //-------------------------------Delete category show modal alert before send value to delete-----------------------------------------------
            $(document).on('click', '.delete-catagory', function () {
                var id = $(this).attr('data-id');
                $('#id_del_catagory').val(id);
                swal({
                    title: "ยืนยัน?",
                    text: "คุณแน่ใจหรือจะลบหมวดหมู่นี้",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "ยกเลิก",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "ยืนยัน",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                }, function () {
                    $.ajax({
                        complete: function () {
                            swal("สำเร็จ", "ลบหมวดหมู่เรียบร้อยแล้ว", "success");
                            $('#MultiDelete').prop('disabled', true);
                            $('.num_').html('');
                        },
                        type: "POST",
                        url: 'back_catagory-delete.php',
                        data: {id: id},
                        success: function (data) {

                            fetch_data_catagory_widget();
                            fetch_data_catagory();
                            fetch_add();
                            fetch_cat_add();
                        },
                    });
                });
            });
            //---------------------------------------Alert modal for notification of delete multiple--------------------------------------------------
            $(document).on('click', '#MultiDelete', function () {
                swal({
                    title: "ยืนยัน?",
                    text: "คุณแน่ใจหรือจะลบหมวดหมู่ที่เลือก",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "ยกเลิก",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "ยืนยัน",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                }, function () {
                    $.ajax({
                        complete: function () {
                            swal("สำเร็จ", "ลบหมวดหมู่เรียบร้อยแล้ว", "success");
                            $('.num_').html('');
                            $('#MultiDelete').prop('disabled', true);
                        },
                        type: "POST",
                        url: "back_catagory-deletemulti.php",
                        data: $("#frmMain").serialize(),
                        success: function (data) {
                            fetch_data_catagory_widget();
                            fetch_data_catagory();
                            fetch_add();
                            fetch_cat_add();
                        },
                    });
                });
            });
            $(document).on('click', '.show-list', function () {
                $('.list_catagory').show();
                $('.widget_catagory').hide();
            });
            $(document).on('click', '.show-widget', function () {
                $('.checkbox_remove').prop('checked', false);
                $('tr').removeClass('remove-item');
                $('.delmulti-menu').prop("disabled", true);
                $('#CheckAll').prop('checked', false);
                $('.widget_catagory').show();
                $('.list_catagory').hide();
            });
            $("#search-jquery").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#table-search .show-tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });

                var filter = $(this).val(),
                    count = 0;

                // Loop through the comment list
                $('#catagory-widget .search-text-widget').each(function () {

                    $('.box-tr-show').show();
                    // If the list item does not contain the text phrase fade it out
                    if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                        $(this).hide();  // MY CHANGE

                        // Show the list item if the phrase matches and increase the count by 1
                    } else {
                        $(this).show(); // MY CHANGE
                        count++;
                    }
                });
            });
        });

        //----------------------------------------------Check length for open button save-------------------------------------------------------------
        function checklength() {
            var input = document.getElementById("name_cat");
            if (input.value.length > 0) {
                document.getElementById("btnSendAdd").disabled = false;

            } else {
                document.getElementById("btnSendAdd").disabled = true;
            }
        }

        //----------------------------------------------Check length for open button save(modal-edit)--------------------------------------------------
        function checklengthmodal() {
            var input = document.getElementById("name_edit-cat");
            if (input.value.length > 0) {
                document.getElementById("btnYes-modal").disabled = false;
            } else {
                document.getElementById("btnYes-modal").disabled = true;
            }
        }

        //----------------------------------------------Click Check all--------------------------------------------------------------------------------
        function ClickCheckAll(vol) {
            var i = 1;
            for (i = 1; i <= document.frmMain.hdnCount.value; i++) {
                $('.num_').html('[ ' + i + ' ]');
                if (vol.checked == true) {
                    eval("document.frmMain.Chk" + i + ".checked=true");
                    $(".show-tr").addClass("remove-item");
                    $('#MultiDelete').prop('disabled', false);
                } else {
                    $('.num_').html('');
                    eval("document.frmMain.Chk" + i + ".checked=false");
                    $('#MultiDelete').prop('disabled', true);
                    $(".show-tr").removeClass("remove-item");
                }
            }
        }

        //---------------------------------------------------Add Class---------------------------------------------------------------------------------
        $(document).on('click', '.checkbox_remove', function () {
            var i = 0;
            if ($(this).is(":checked")) {
                $(this).parents('tr').addClass("remove-item");
                document.getElementById('MultiDelete').disabled = false;
                $('.remove-item').each(function () {
                    i++;
                });
                $('.num_').html('[ ' + i + ' ]')
            } else {
                $(this).parents('tr').removeClass("remove-item");
                $('.remove-item').each(function () {
                    i++;
                });
                $('.num_').html('[ ' + i + ' ]');
                if ($('input.checkbox_remove').is(':checked')) {
                } else {
                    document.getElementById('MultiDelete').disabled = true;
                }
            }
        });

        //----------------------------------------------------Set time realtime------------------------------------------------------------------------
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

    </script>
    <style>
        .sweet-overlay {
            z-index: 1050;
        }

        @media (min-width: 768px) {
            .modal-chicon {
                width: 1200px;
                margin: 30px auto;
            }
        }

        .hover_input {
            background-color: white !important;
        }

        .remove-item {
            background-color: #fff6f6 !important;
            transition: 0.4s;
            color: red;
        }

        .remove-item:hover {
            background-color: #F5F5F5 !important;
            transition: 0.4s;
            color: red;
        }

        .sweet-alert .sa-icon {
            margin-bottom: 35px;
        }

        #share {
            opacity: 0.5;
            transform: rotate(90deg);
        }

        .bs-glyphicons {
            padding-left: 0;
            padding-bottom: 1px;
            margin-bottom: 20px;
            list-style: none;
            overflow: hidden;
        }

        .bs-glyphicons li {
            float: left;
            width: 25%;
            height: 115px;
            padding: 10px;
            margin: 0 -1px -1px 0;
            font-size: 12px;
            line-height: 1.4;
            text-align: center;
            border: 1px solid #ddd;
        }

        .bs-glyphicons .glyphicon {
            margin-top: 5px;
            margin-bottom: 10px;
            font-size: 24px;
        }

        .bs-glyphicons .glyphicon-class {
            display: block;
            text-align: center;
            word-wrap: break-word; /* Help out IE10+ with class names */
        }

        .bs-glyphicons li:hover {
            background-color: rgba(86, 61, 124, .1);
        }

        .btn-default {
            background-color: white !important;
        }

        @media (min-width: 768px) {
            .bs-glyphicons li {
                width: 12.5%;
            }
        }
    </style>
</head>
<body class="hold-transition skin-blue fixed sidebar-mini" onload="startTime()">
<div class="wrapper">
	<?php require_once '../template/nav_menu.php'; ?>
    <?php require_once '../library/permission.php'; ?>

    <input type="hidden" name="per_button_edit" id="per_button_edit" value="<?php echo $button_edit ?>">
           <input type="hidden" name="per_button_del" id="per_button_del" value="<?php echo $button_del ?>">
           <input type="hidden" name="per_button_open" id="per_button_open" value="<?php echo $button_open ?>">
            <input type="hidden" name="per_input_read" id="per_input_read" value="<?php echo $input_read ?>">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                จัดการหมวดหมู่สินค้า
            </h1>
            <ol class="breadcrumb">
                <li><a href="../../index.php">หน้าแรก</a></li>
                <li class="active">จัดการหมวดหมู่บทความ</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <!-- <div class="box box-warning collapsed-box">
					  <div class="box-header with-border">
						<h3 class="box-title">คำแนะนำในการใช้งาน</h3>

						<div class="box-tools pull-right">
						  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
						</div>
					  </div>

					  <div class="box-body">
						<div style="padding-left: 10px;">
						  <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถแก้ไข/ลบ บทความได้โดยคลิกไอคอนใต้หัวข้อบทความที่ต้องการ<br>
						  <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถดูตัวอย่างการแสดงผลบทความบนหน้าเว็บไซต์ ได้โดยคลิกไอคอน ดูตัวอย่าง<br>
						  <i class="fa fa-caret-right"></i>&nbsp;&nbsp;หากต้องการลบบทความ มากกว่า 1 บทความพร้อมกัน สามารถคลิกเครื่องหมายถูกหน้าหัวข้อบทความที่ต้องการลบ และคลิกไอคอน ลบข้อมูลที่เลือก<br>
						  <i class="fa fa-caret-right"></i>&nbsp;&nbsp;กรณีที่มีการลบข้อมูล ระบบจะขึ้นข้อความแจ้งเตือน เพื่อยืนยันการลบ หากทำการยืนยันเรียบร้อยแล้ว จะไม่สามารถกู้คืนข้อมูลได้<br>
						  <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถเปิด/ปิด การแสดงผลบทความได้โดยคลิกไอคอนรูปตา สีเทา คือปิดการแสดงผล สีน้ำเงิน คือเปิดการแสดงผล<br>
						  <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถเลือกปักหมุดบทความที่สำคัญ ไว้บนสุดของการแสดงผลบทความทั้งหมดได้ <br>
						  <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถดูวันที่แก้ไขบทความล่าสุดได้<br>
						  <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถเลือกดูแสดงผลบทความได้ทั้งแบบคอลัมน์ และแบบแถว <br>
						  <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถค้นหาบทความได้โดยใส่ชื่อหัวข้อบทความช่องค้นหา หรือเลือกหมวดหมู่ในการค้นหาได้<br>
						</div>
					  </div>

					</div> -->
                    <!-- /.box -->
                    <div class="alert alert-success alert-dismissible" id="result_add_cat" style="display: none;">
                        <button  type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <div id="loader_add_cat">
                            <h4><i class="fa fa-circle-o-notch fa-spin"></i></h4>
                            Inserting...
                        </div>
                        <div id="success_add_cat">
                            <h4><i class="icon fa fa-check"></i> Increase!</h4>
                            Increase Catagory successful.
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

                    <div class="alert alert-success alert-dismissible" id="result_update" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <div id="loader_update">
                            <h4><i class="fa fa-circle-o-notch fa-spin"></i></h4>
                            Updating...
                        </div>
                        <div id="success_update">
                            <h4><i class="icon fa fa-check"></i> Updated!</h4>
                            Update data successful.
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.box-row -->
            <div class="row">
                <div class="col-md-6" style="<?php echo $button_open ?>">
                    <div class="box box-info">
                        <div class="box-header">
                            <h3 class="box-title">เพิ่มหมวดหมู่</h3>
                        </div>
                        <div class="box-body" style="padding: 0;">
                            <form id="reset-form" class="upload-form-add">
                                <div class="box-body" style="padding:0;">
                                    <div class="form-group">
                                        <div>
                                            <div class="nav-tabs-custom" style="box-shadow: none; margin-bottom: 5px;">
                                               
                                                <div class="tab-content" style="padding: 5px 15px 5px 15px; margin-top: 5px;">
                                                    <div class="tab-pane active" id="thai">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-header"></i></span>
                                                            <input type="text" class="form-control" placeholder="ภาษาไทย" name="name" id="name_cat" onkeyup="checklength()">
                                                        </div>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <p id="validation_name" style="padding: 5px; padding-top:2px; color:orange; display: none;">ชื่อหมวดหมู่</p>

                                        <div id="product_catagory" style="padding: 5px 15px 5px 15px; margin-top: 5px;">
                                            <label>จัดเข้าหมวดหมู่</label>
                                            <div id="live_cat-add"></div>
                                            <!-- <select class="form-control" id="sub_catagory" name="sub_catagory"> -->


                                        </div>
                                        <div class="row" style="padding: 5px 15px 5px 15px; margin-top: 5px;">
                                            <!-- <div class="col-md-6" style="margin-top: 10px;">
											  <label>เลือกไอคอน</label>
												  <div style="width: 100%;border:1px solid #f9f9f9;" align="center">
													<a style="font-size:6.5vw; color: #b2b2b2; cursor: pointer;" id="change-icon" class="ch-icon"><i class="fa fa-plus"></i></a>
												  </div>
												<input type="hidden" name="icon" value="" id="change-icon-value" class="form-control" style="margin-bottom: 5px;">
											</div> -->
                                            <div class="col-md-12" style="margin-top: 10px">
                                                <label>รูปภาพหมวดหมู่</label>
                                                <div style="width: 150px; padding-bottom: 10px;">
                                                    <img style="width: 150px;" id='img-upload' src="components/up_pre/upload.jpg"/>
                                                </div>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" readonly>
                                                    <span class="input-group-btn">
                              <span class="btn btn-default btn-file" style="background-color: white !important;">
                                  <i class="glyphicon glyphicon-folder-open"></i><input type="file" accept="image/*" id="imgInp" name="image_catagory">
                              </span>
                          </span>
                                                </div>
                                                <br>
                                                <p>*รูปภาพควรมีขนาดประมาณ 150 X 150 Pixels (กว้าง X สูง)</p>
                                            </div>
                                        </div>
                                    </div>
                            </form>
                            <div class="box-footer">
                                <button type="button" class="btn btn-info btnSendAdd pull-right" id="btnSendAdd" style="margin-right: 5px; transition: 0.4s;" disabled>
                                    <i class="fa fa-check"></i>&nbsp;บันทึก
                                </button>
                                <button type="button" class="btn btn-warning btnSendClear pull-right" style="margin-right: 5px;">
                                    <i class="fa fa-remove"></i>&nbsp;เคลียร์
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div style="margin-bottom: 5px;">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="input-group">
                  <span class="input-group-btn">
                   <!--  <button class="btn btn-default show-widget" style="font-size: 18px; margin-right: 5px; border-radius: 0"><i class="fa fa-th pull-right" style="margin: 0;"></i></button> -->
                    <!-- <button class="btn btn-default show-list" style="font-size: 18px; margin-right: 5px;"><i class="fa fa-th-list pull-right" style="margin: 0;"></i></button> -->
                  </span>
                                <input type="text" name="q" class="form-control" placeholder="Search..." id="search-jquery">
                                <span class="input-group-btn">
                    <button name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                  </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box box-default list_catagory" >
                    <div class="box-header">
                        <h3 class="box-title">หมวดหมู่สินค้าทางร้าน</h3>
                    </div>
                    <div class="box-body" style="padding: 0;">
                        <form action="" name="frmMain" id="frmMain" method="post">
                            <div id="catagory"></div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- <div class="widget_catagory">
                    <form action="" name="frmMain" id="frmMain" method="post">
                        <div id="catagory-widget"></div>
                </div> -->
                <!-- /.box -->
            </div>
    </div>
    <div class="boxsave" style="<?php echo $button_del_s; ?>">
        <button type="button" class="delmulti-menu btn btn-danger" style="transition: 0.4s; <?php echo $button_del_s; ?>" id="MultiDelete" disabled><i class="fa fa-remove"></i> ลบรายการทั้งหมด <span class="num_"></span></button>
        </form>
    </div>
    <!-- /.box -->
    <div class="modal fade" id="modal-delete-catagory">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-warning">&nbsp;&nbsp;</i>คำเตือน</h4>
                </div>
                <div class="modal-body">
                    <form action="" id="frmDEL" name="frmDEL" method="post">
                        <input type="hidden" name="id_del_catagory" id="id_del_catagory">
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
                    <button type="button" class="btn btn-primary btnSendDelCat">ยืนยัน</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="modal-default-add">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">เพิ่มหมวดหมู่</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="กรุณาใส่ชื่อหมวดหมู่" name="name" id="name_cat" onkeyup="checklength()">
                        <!-- /btn-group -->
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-info btnSendAddCat" id="btnYes" disabled><i class="fa fa-check"></i>&nbsp;บันทึก</button>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="pull-right hidden-xs">
                        <b>Version</b> 0.0
                    </div>
                    <strong>Copyright &copy; 2018 <a href="">Meeting Creative Studio</a>.</strong> All rights
                    reserved.
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <div class="modal fade" id="modal-default-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">แก้ไขหมวดหมู่</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <form action="" name="frmEDIT" id="frmEDIT" method="post">
                            <input type="hidden" name="id" id="id">
                            <input type="text" class="form-control" name="name" id="name_edit-cat" onkeyup="checklengthmodal()">
                        </form>
                        <!-- /btn-group -->
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-info btnSendUpdateCat" id="btnYes-modal"><i class="fa fa-check"></i>&nbsp;บันทึก</button>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="pull-right hidden-xs">
                        <b>Version</b> 0.0
                    </div>
                    <strong>Copyright &copy; 2018 <a href="">Meeting Creative Studio</a>.</strong> All rights
                    reserved.
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    </section>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
		 immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<div class="modal" id="modal-edit-catagory">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">แก้ไขหมวหมู่</h4>
            </div>
            <div class="modal-body" style="padding:0;">
                <!-- Hidden Zone -->
                <form action="" name="frmEDIT" id="frmEDIT" method="post" class="upload-form-edit">
                    <div id="live_modal-edit">
                    </div>
                </form>
            </div>
            <!--/.modal-body-->
            <!--/.modal-footer-->
        </div><!-- /.modal-content -->
    </div>
</div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------ -->
<!-- change icon -->
<div class="modal" id="modal-ch-icon">
    <div class="modal-dialog modal-chicon">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">เลือกไอคอน</h4>
            </div>
            <div class="modal-body" style="padding: 0;">
                <input type="hidden" name="" id="id_catagory" class="form-control">
				<?php require_once 'select-icon.php'; ?>
            </div>
            <!--/.modal-body-->
        </div><!-- /.modal-content -->
    </div>
</div>

<div class="modal" id="modal-ch-icon-edit">
    <div class="modal-dialog modal-chicon">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">เลือกไอคอน</h4>
            </div>
            <div class="modal-body">
				<?php require_once 'select-icon-edit.php'; ?>
            </div>
            <!--/.modal-body-->
        </div><!-- /.modal-content -->
    </div>
</div>

<!-- ./wrapper -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script src="components/up_pre/js.js"></script>
<!-- PACE -->
<script src="../bower_components/PACE/pace.min.js"></script>
<script src="components/select/dist/js/bootstrap-select.js"></script>
</body>
</html>
