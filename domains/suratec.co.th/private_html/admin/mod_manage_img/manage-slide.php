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
    <link href="../page_froala/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <!--Css table -->
    <link rel="stylesheet" href="css/table-slide.css">
    <!-- css upload file -->
    <link rel="stylesheet" type="text/css" href="components/up_pre/style.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <link rel="shortcut icon" type="image/png" href="../img/favicon.png"/>
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
  <!--Css loader -->
  <!-- sweet alert -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
 <!--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css.map"> -->
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            //---------------------------------------fetch Slide for refresh ajax-----------------------------------------------
            function fetch_data_slide(page) {
                var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
                $.ajax({
                    url: "select_table-slide.php",
                    method: "POST",
                    data: {page: page,button_edit:button_edit,button_del:button_del},
                    success: function (data) {
                        $('#live_data-slide').html(data);
                    }
                });
            }

            fetch_data_slide();
            //--------------------------------------------pagination link ajax-------------------------------------------------
            $(document).on('click', '.pagination_link', function () {
                var page = $(this).attr("id");
                fetch_data_slide(page);
                document.getElementById('MultiDelete').disabled = true;
            });

             $(document).on('change', '#slide_catagory_search', function()
        {
              var id = $(this).val();
              var button_edit = $('#per_button_edit').val();
              var button_del = $('#per_button_del').val();
                $.ajax({
                    url: "select_table-slide.php",
                    method: "POST",
                    data: {button_edit:button_edit,button_del:button_del,id:id},
                    success: function (data) {
                        $('#live_data-slide').html(data);
                    }
                });
          });
            //------------------------------------------btn send clear---------------------------------------------------------
            $(document).on('click', '.btnSendClear', function () {
                $('#modal-default-clearbox').modal('show');
            });
            $(document).on('click', '.btnSendClearBox', function () {
                document.getElementById('frmADD').reset();
                $('#img-upload').attr('src', 'components/up_pre/upload.jpg');
                // document.getElementById("btnSendClear").disabled = true;
                document.getElementById("btnSendAdd").disabled = true;
            });
            //---------------------------------------ADD and check value type=file---------------------------------------------
            $(document).on('click', '.btnSendAdd', function () {
                var formData = new FormData($('.upload-form-add')[0]);
                var checkfileslide = $("#imgInp")[0].files.length;
                var name = $("#name");
                // var slide_catagory = $("#slide_catagory");
                if (checkfileslide === 0) {
                    $('#modal-default-image').modal('show');
                    return false;
                }
                if (name == '') {
                    $('#modal-default-name').modal('show');
                    return false;
                }
                // if (slide_catagory == '0') {
                //     $('#modal-default-slide_catagory').modal('show');
                //     return false;
                // }
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
                        $('#img-upload').attr('src', 'components/up_pre/upload.jpg');
                        setTimeout(function () {
                            $("#result_add").hide(0)
                        }, 10000);
                        // document.getElementById("btnSendAdd").disabled = true;
                    },
                    type: "POST",
                    url: "back_slide-add.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        fetch_data_slide();
                        // alert(data);
                        document.getElementById("frmADD").reset();

                    },
                });
            });
$("#modal_showdetail").on('hidden.bs.modal', function () {
    $(this).data('bs.modal', null);
    var formData = new FormData($('.upload-form')[0]);
           var name_image = $('#name_image').val();
            document.getElementById("frmEDIT").reset();  
            $('#img').attr('src', name_image); 
             // location.reload();
             window.location='manage-slide.php';  
  });
            //-------------------------------Edit Slide show modal alert before send value to EDIT------------------------------------------
            $(document).on('click', '.edit-slide', function () {
                var name_slide = $(this).attr('data-name');
                var name_slide_en = $(this).attr('data-name-en');
                var id_slide = $(this).attr('data-id');
                var content_slide = $(this).attr('data-content');
                var content_slide_en = $(this).attr('data-content-en');
                var name_image = $(this).attr('data-name-image')
                document.getElementById("frmEDIT").reset();
                $("#blah").attr("src", "../../uploads/slide/" + name_image);
                $('#name_slide').val(name_slide);
                $('#name_slide_en').val(name_slide_en);
                $('#id_slide').val(id_slide);
                $('#content_slide').val(content_slide);
                $('#content_slide_en').val(content_slide_en);
                $('#modal-edit-slide').modal('show');
            });
            $(document).on('click', '.test', function () {
                $(".img-upload-modal").removeAttr("style");

            });

            



            //----------------------------------------------------EDIT passing Modal---------------------------------------------------------
            $(document).on('click', '.btnSendEdit', function () {
                var formData = new FormData($('.upload-form')[0]);
                $.ajax({
                    beforeSend: function () {
                        // setting a timeout
                        $('#result').show();
                        $('#success_edit').hide();
                        $('#loader_edit').show();
                        $('#modal-edit-slide').modal('hide');
                    },
                    complete: function () {
                        $('#loader_edit').hide();
                        $('#success_edit').show();
                        setTimeout(function () {
                            $("#result").hide(0)
                        }, 10000);
                    },
                    type: "POST",
                    url: "back_slide-edit.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                          console.log(data);
                          // $('#modal_showdetail').hide();
                          // $('#modal_showdetail').modal('hide');


                     // // alert('แก้ไขเรียบร้อยแล้ว');
                     // saw('สำเร็จ','แก้ไขเรียบร้อยแล้ว','success')

                    fetch_data_slide(); 
                    document.getElementById("frmEDIT").reset();  
                   // $('#frmEDIT').load('t1.php').fadeIn("slow"); 
                // window.location='manage-slide.php';  
                        // alert(data);
                        // fetch_data_slide();
                        // document.getElementById("frmEDIT").reset();
                    },
                });
            });

            //-------------------------------UPDATE LEVEL-------------------------------------------------------------------------------------
            $(document).on('change', '.level_slide', function () {
                var level = $(this).val();
                var id = $(this).attr('data-id');
                var id_level = level + '-' + id;
                $.ajax({
                    beforeSend: function () {
                        // setting a timeout
                        $('#result_level').show();
                        $('#success_level').hide();
                        $('#loader_level').show();
                        $("#result_level_warning").hide();
                    },
                    type: 'POST',
                    url: 'ajaxDatalevel-slide.php',
                    data: {level : level,id : id },
                    success: function (data) {
                        if (data == "none") {
                            $('#result_level').hide();
                            $("#result_level_warning").fadeIn("slow");
                            setTimeout(function () {
                                $("#result_level_warning").hide(0)
                            }, 10000);
                        } else {
                            $('#loader_level').hide();
                            $('#success_level').show();
                            setTimeout(function () {
                                $("#result_level").hide(0)
                            }, 10000);
                        }
                        fetch_data_slide();
                    },
                });
            });
            //-------------------------------Delete Slide show modal alert before send value to delete-----------------------------------------
            $(document).on('click', '.delete-slide', function () {
                var id = $(this).attr('data-id');

                $('#id_del_slide').val(id);
                $('#modal-delete-slide').modal('show');
            });
            $(document).on('click', '.btnSendDel', function () {
                $.ajax({
                    beforeSend: function () {
                        // setting a timeout
                        $('#result_del').show();
                        $('#success_del').hide();
                        $('#loader_del').show();
                        $('#modal-delete-slide').modal('hide');
                    },
                    complete: function () {
                        $('#loader_del').hide();
                        $('#success_del').show();
                        setTimeout(function () {
                            $("#result_del").hide(0)
                        }, 10000);
                    },
                    type: "POST",
                    url: 'back_slide-delete.php',
                    data: $("#frmDEL").serialize(),
                    success: function (data) {
                        fetch_data_slide();
                    },

                });
            });

            //---------------------------------------Alert Mmodal for notification of delete multiple------------------------------------------
            var formClick;
            $(document).on('submit', '#frmMain', function () {
                formClick = $(this);
                $('#modal-default').modal('show');
                return false;
            });
            $(document).on('click', '#btnYes', function () {
                $.ajax({
                    beforeSend: function () {
                        // setting a timeout
                        $('#result_del').show();
                        $('#success_del').hide();
                        $('#loader_del').show();
                        $('#modal-default').modal('hide');
                    },
                    complete: function (argument) {
                        $('#loader_del').hide();
                        $('#success_del').show();
                        setTimeout(function () {
                            $("#result_del").hide(0)
                        }, 10000);
                        document.getElementById('MultiDelete').disabled = true;
                    },
                    type: "POST",
                    url: "back_slide-deletemulti.php",
                    data: $("#frmMain").serialize(),
                    success: function (data) {
                        // alert("Update Successfull!");
                        fetch_data_slide();
                    },
                });
            });
        });

        //-----------------------------------------------Check for num level------------------------------------------------------------------------
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

        function checklength() {
        var input = document.getElementById("name") ;
                if(input.value.length > 0)
                {
                   // var value = input.value;
                   // input.value = value.slice(0,10);
                    document.getElementById("btnSendAdd").disabled = false;
                    //alert(value) ;

                }else{
                  document.getElementById("btnSendAdd").disabled = true;
                  //alert("value = 0");
                }
        }

        //-----------------------------------------------Check All Check and addclass remove---------------------------------------------------------
        function ClickCheckAll(vol) {
            var i = 1;
            for (i = 1; i <= document.frmMain.hdnCount.value; i++) {
                if (vol.checked == true) {
                    eval("document.frmMain.Chk" + i + ".checked=true");
                    $("tr").addClass("remove-item");
                    document.getElementById('MultiDelete').disabled = false;
                } else {
                    eval("document.frmMain.Chk" + i + ".checked=false");
                    document.getElementById('MultiDelete').disabled = true;
                    $("tr").removeClass("remove-item");
                }
            }
        }

        //-----------------------------------------------ddclass remove-----------------------------------------------------------------------------
        $(document).on('click', '.checkbox_remove', function () {
            if ($(this).is(":checked")) {
                $(this).parents('tr').addClass("remove-item");
                document.getElementById('MultiDelete').disabled = false;
            } else {
                $(this).parents('tr').removeClass("remove-item");
                document.getElementById('MultiDelete').disabled = true;
            }
        });

        //-----------------------------------------------------Set time onload realtime-------------------------------------------------------
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
        .btn-paginate {
            background-color: white;
            border-color: #bcbcbc;
            transition: 0.6s;
        }

        .btn-paginate:hover {
            background-color: #bcbcbc;
            color: white;
        }

        .page-active {
            background-color: #bcbcbc;
            color: white;
        }

        .remove-item {
            background-color: #fff6f6 !important;
            transition: 0.4s;
            color: red;
            animation: Blink 0.6s linear !important;
        }

        .remove-item:hover {
            background-color: #F5F5F5 !important;
            transition: 0.4s;
            color: red;
        }
        @media screen and (min-width:479px){  /* 0px - 479px */
 .modal-content{
width: 1000px;
 }
}
    </style>
</head>
<body class="hold-transition skin-blue fixed sidebar-mini" onload="startTime();">
<div class="wrapper fixed">
    <?php require_once '../template/nav_menu.php'; ?>
    <?php require_once '../library/permission.php'; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                จัดการสไลด์
            </h1>
            <ol class="breadcrumb">
                <li><a href="../index.php"></i>แดชบอร์ด</a></li>
                <li class="active">จัดการสไลด์</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!--  <div class="box box-primary">
               <div class="box-header with-border">
                 <h3 class="box-title">คำแนะนำในการใช้งาน</h3>

                 <div class="box-tools pull-right">
                   <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                 </div>
               </div>
               <div class="box-body">
                 <div style="padding-left: 10px;">
                   <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารเพิ่มเมนูได้ไม่จำกัดจำนวน<br>
                   <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถเพิ่มเมนูย่อยได้โดยคลิกไอคอน + เพิ่มเมนูย่อย หลังเมนูหลักที่ต้องการ สามารถเพิ่มได้ 1 ระดับ ไม่จำกัดจำนวนเมนู<br>
                   <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถแก้ไข/ลบ เมนูได้โดยคลิกไอคอนหลังเมนูที่ต้องการ<br>
                   <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถดูตัวอย่างการแสดงผลเมนู บนหน้าเว็บไซต์ได้โดยคลิกไอคอน ดูตัวอย่าง<br>
                   <i class="fa fa-caret-right"></i>&nbsp;&nbsp;สามารถเปลี่ยนแปลงลำดับของเมนู โดยกำหนดตัวเลขลำดับหลังชื่อเมนู<br>
                   <i class="fa fa-caret-right"></i>&nbsp;&nbsp;หากต้องการลบเมนู มากกว่า 1 เมนู พร้อมกัน สามารถคลิกเครื่องหมายถูกหน้าชื่อเมนูที่ต้องการลบ และคลิกไอคอน ลบข้อมูลที่เลือก<br>
                   <i class="fa fa-caret-right"></i>&nbsp;&nbsp;กรณีที่มีการลบข้อมูล ระบบจะขึ้นข้อความแจ้งเตือน เพื่อยืนยันการลบ หากทำการยืนยันเรียบร้อยแล้ว จะไม่สามารถกู้คืนข้อมูลได้<br>
                 </div>
               </div>
             </div> -->
            <!-- /.box -->

            <!-- <div class="alert alert-success alert-dismissible" id="result" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <div id="loader_edit">
                    <h4><i class="fa fa-circle-o-notch fa-spin"></i></h4>
                    กำลังแก้ไข...
                </div>
                <div id="success_edit">
                    <h4><i class="icon fa fa-check"></i> สำเร็จ!</h4>
                    แก้ไขเรียบร้อยแล้ว.
                </div>
            </div> -->

            <div class="alert alert-success alert-dismissible" id="result_level" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <div id="loader_level">
                    <h4><i class="fa fa-circle-o-notch fa-spin"></i></h4>
                    กำลังแก้ไข...
                </div>
                <div id="success_level">
                    <h4><i class="icon fa fa-check"></i> สำเร็จ!</h4>
                    บันทึกการเปลี่ยน Level เรียบร้อยแล้ว.
                </div>
            </div>

            <div class="alert alert-warning alert-dismissible" id="result_level_warning" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <div id="success_level">
                    <h4><i class="icon fa fa-warning"></i> ไม่สำเร็จ!</h4>
                    กรุณาเปลี่ยนเป็น Level ในจำนวนที่มีเท่านั้น.
                </div>
            </div>

            <div class="alert alert-success alert-dismissible" id="result_del" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <div id="loader_del">
                    <h4><i class="fa fa-circle-o-notch fa-spin"></i></h4>
                    กำลังลบ...
                </div>
                <div id="success_del">
                    <h4><i class="icon fa fa-check"></i> สำเร็จ!</h4>
                    ลบสำเร็จแล้ว.
                </div>
            </div>

            <div class="alert alert-success alert-dismissible" id="result_add" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <div id="loader_add">
                    <h4><i class="fa fa-circle-o-notch fa-spin"></i></h4>
                    กำลังบันทึก...
                </div>
                <div id="success_add">
                    <h4><i class="icon fa fa-check"></i> สำเร็จ!</h4>
                    บันทึกเรียบร้อยแล้ว.
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                             <div class="col-md-4" style="padding: 20px">
                            <h3 class="box-title">รายการสไลด์</h3>
                        </div>

                            
                        </div>
                        <div class="box-body" style="padding: 0px;">
                            <form id="frmMain" name="frmMain" method="post" action="">
                                <div id="live_data-slide"></div>
                        </div>
                        <!--/.box-body -->
                        <!--  <div class="box-footer">
                           <div class="pull-right hidden-xs">
                               <b>Version</b> 2.4.0
                           </div>
                           <strong>Copyright &copy; 2018 <a href="">Meeting Creative</a>.</strong> All rights
                           reserved.
                         </div> -->
                    </div>
                    <!-- /.box -->
                </div>
                 <input type="hidden" name="per_button_edit" id="per_button_edit" value="<?php echo $button_edit ?>">
           <input type="hidden" name="per_button_del" id="per_button_del" value="<?php echo $button_del ?>">
                <div class="boxsave" style="<?php echo $button_del; ?>">
                    <button type="submit" class="delmulti-menu btn btn-danger" style="transition: 0.4s; <?php echo $button_del; ?>" id="MultiDelete" disabled><i class="fa fa-remove"></i> ลบรายการทั้งหมด</button>
                </div>
                </form>
                <!-- /.col left-->
                <div class="col-md-4"  style="<?php echo $button_open ?>">
                    <form  id="frmADD" name="frmADD" method="post" enctype="multipart/form-data" class="upload-form-add">
                        
                        <div class="box box-success">

                            <div class="box-header with-border">
                                <h3 class="box-title">เพิ่มสไลด์</h3>
                            </div>

                            <div class="box-body">
                                 
                        
                         <div class="col-md-12" style="padding: 20px">
                            <label class="col-md-2">หัวข้อ</label>      
                        <div class="col-md-7">
                          <div class="box-detail-em">
                               
                              <select  class="form-control selectpicker" id="image_category" name="image_category" data-show-subtext="true" data-live-search="true">
                                <option value="0">หัวข้อ</option>
<?php
$str = "SELECT `id_catagory`,`name_catagory` FROM `image_category`";
$query = mysqli_query($objConnect,$str);
while ( $result = mysqli_fetch_array($query)) {
?>
                                <option value="<?php echo $result["id_catagory"] ?>"><?php echo $result["name_catagory"] ?></option>
<?php } ?>
                              </select>
                          </div>  

                        </div>
                         <div class="col-md-3">
                            <button type="button" name="add_type_btn" id="add_type_btn" class="btn btn-success  pull-right"  ><i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มหัวข้อ</button>
                         </div>
                        </div>
                        <br><br>
                                <div style="width: 150px; padding-bottom: 10px;">
                                    <img id='img-upload' src="components/up_pre/upload.jpg"/>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" readonly>
                                    <span class="input-group-btn">
                            <span class="btn btn-default btn-file" style="background-color: white !important;">
                                <i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;&nbsp;เลือกรูปภาพ <input type="file" accept="image/*" id="imgInp" name="image_slide">
                            </span>
                        </span>

                                </div>
                                <br>
                         <!-- <p>*รูปภาพควรมีขนาดประมาณ 1287 X 483 Pixels (กว้าง X สูง )</p> -->
                                <!--  <input type="file" name="image_slide" id="checkfileslide"> -->
                            </div>
                                   
                            </form>
                            <div class="box-footer">
                                <button type="button" class="btn btn-info btnSendAdd pull-right" id="btnSendAdd" style="transition: 0.4s;" >
                                    <i class="fa fa-check"></i>&nbsp;บันทึก
                                </button>
                                <button type="button" class="btn btn-warning btnSendClear pull-right" style="margin-right: 5px;">
                                    <i class="fa fa-remove"></i>&nbsp;เคลียร์
                                </button>
                    
                </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
               
            <!-- /.box -->
    </div>
    <!-- /.col (right) -->
</div>
<!-- /.row -->
   <div class="modal fade" id="modal_showdetail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <!-- load from file !-->
    </div>
  </div>
</div>
<div class="modal fade" id="modal-edit-slide">
    <div class="modal-dialog">
    
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-delete-slide">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-warning">&nbsp;&nbsp;</i>คำเตือน</h4>
            </div>
            <div class="modal-body">
                <form action="" id="frmDEL" name="frmDEL" method="post">
                    <input type="hidden" name="id_del_slide" id="id_del_slide">
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
                <button type="button" class="btn btn-primary" id="btnYes">ยืนยัน</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="modal fade" id="modal-default-image">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-warning">&nbsp;&nbsp;</i>คำเตือน</h4>
            </div>
            <div class="modal-body">
                <center><img src="../img/warning.png" width="60" height="60"><h4>กรุณาเลือกรูปภาพ</h4></center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-block btn-primary" data-dismiss="modal">ฉันเข้าใจแล้ว</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-default-name">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-warning">&nbsp;&nbsp;</i>คำเตือน</h4>
            </div>
            <div class="modal-body">
                <center><img src="../img/warning.png" width="60" height="60"><h4>กรุณาใส่ชื่อสไลด์</h4></center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-block btn-primary" data-dismiss="modal">ฉันเข้าใจแล้ว</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-default-slide_catagory">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-warning">&nbsp;&nbsp;</i>คำเตือน</h4>
            </div>
            <div class="modal-body">
                <center><img src="../img/warning.png" width="60" height="60"><h4>กรุณาเลือกหมวดหมู่</h4></center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-block btn-primary" data-dismiss="modal">ฉันเข้าใจแล้ว</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="modal fade" id="modal-default-clearbox">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-warning">&nbsp;&nbsp;</i>คำเตือน</h4>
            </div>
            <div class="modal-body">
                <div id="clearbox">
                    <center><img src="../img/warning.png" width="60" height="60"><h5>การเคลียร์หน้าเพิ่มสไลด์จะเป็นการล้างหน้าจอรวมถึงภาพและเนื้อหาจะถูกล้างไปด้วย</h5></center>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิกการเคลียร์</button>
                <button type="button" class="btn btn-primary btnSendClearBox" data-dismiss="modal">ฉันเข้าใจแล้ว</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</section>
<!-- ./section -->

    <div class="modal  modal fade " id="modal_add"  >
  <div class="modal-dialog">
    <div class="modal-content" >
      <!-- Modal Header -->
      <div class="modal-header" >
        <h4 class="modal-title"><div id="modal_id_order"></div></h4>
        <label for="">จัดการหัวข้อ</label>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

<div id="add_data">
    
</div>
      <!-- Modal footer -->                              
    </div>
  </div>
</div>
</aside>
<input type="hidden" name="per_button_edit" id="per_button_edit" value="<?php echo $button_edit ?>">
<input type="hidden" name="per_button_del" id="per_button_del" value="<?php echo $button_del ?>">
<input type="hidden" name="per_button_open" id="per_button_open" value="<?php echo $button_open ?>">
<input type="hidden" name="per_input_read" id="per_input_read" value="<?php echo $input_read ?>">
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
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
<script src="components/up_pre/js.js"></script>
<!-- PACE -->
<script src="../bower_components/PACE/pace.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>


    <script type="text/javascript">
         $(document).on('click', '.btnSendno', function(){
           var formData = new FormData($('.upload-form')[0]);
           var name_image = $('#name_image').val();
            document.getElementById("frmEDIT").reset();  
            $('#img').attr('src', name_image); 
             // location.reload();
             window.location='manage-slide.php';  

        });

             $(document).on('click', '#add_type_btn', function(event){ 
       var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
    $.ajax({   
            url:'select_type.php', 
            method:'POST',  
            data:{_method:'manage_type',button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},  
            //dataType:"json", 
          
                success:function(data){  
                    //console.log(response.data[0]['path_slip']);
               

              
                   $("#add_data").html(data); 
                   $("#modal_add").modal('show'); 
                }, 

                   
           });  


});

               $(document).on('click', '#add_type', function () {
           var formData = new FormData($('#frm_add_type')[0]);
           
            swal({
            title: "ยืนยัน?",
            text: "ยืนยันการบันทึก",
            type: "info",
            showCancelButton: true,
            cancelButtonText: "ยกเลิก",
            confirmButtonClass: "btn-primary",
            confirmButtonText: "ยืนยัน",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
            }, function () {
            $.ajax({
              type: "POST",
              url: "functions.php",
              data: $("#frm_add_type").serialize(),
              success: function(data) { 
                  // $('.num_').html('');
                   //alert(data.status);
                    if(data.status==0){
                      swal("สำเร็จ", "บันทึกเรียบร้อย", "success");
                    }else{
                      swal("Error", "เกิดปัญหากับระบบ", "warning");
                    }
                          var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
    $.ajax({   
            url:'select_type.php', 
            method:'POST',  
            data:{_method:'manage_type',button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},  
            //dataType:"json", 
          
                success:function(data){  
                    //console.log(response.data[0]['path_slip']);
               

              
                   $("#add_data").html(data); 
                   $("#modal_add").modal('show'); 
                }, 

                   
           });  
                    
                  
              },
           });
        });
      });

           $(document).on('click', '#btnEdit_icon', function(){ 
  var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
            $("#div_add_type").hide();
            $("#div_edit_type").show();
            var id = $(this).attr('data-id');
             var id_icon_type = $(this).attr('data-id1');
                $.ajax({
                type: "POST",
                    url:"select_type.php?_method=select_edit_type",  
                   data: {id_edit:id,id_icon_type:id_icon_type,button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},
                   
                    success: function(data) {
                     //alert(data);
                     console.log(data);
                     $('#div_edit_type').html(data); 
                     $("#div_add_type").hide();
               
                      
                  },
                    error: function (error) {
                        
                    }
            });

            
        }) 
  $(document).on('click', '#edit_type', function () {
           var formData = new FormData($('#frm_edit_type')[0]);
           
            swal({
            title: "ยืนยัน?",
            text: "ยืนยันการแก้ไข?",
            type: "info",
            showCancelButton: true,
            cancelButtonText: "ยกเลิก",
            confirmButtonClass: "btn-primary",
            confirmButtonText: "ยืนยัน",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
            }, function () {
            $.ajax({
              type: "POST",
              url: "functions.php",
              data: $("#frm_edit_type").serialize(),
              success: function(data) { 
                  // $('.num_').html('');
                   //alert(data.status);
                    if(data.status==0){
                      swal("สำเร็จ", "แก้ไขเรียบร้อย", "success");
                    }else{
                      swal("Error", "เกิดปัญหากับระบบ", "warning");
                    }
                          var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
    $.ajax({   
            url:'select_type.php', 
            method:'POST',  
            data:{_method:'manage_type',button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},  
            //dataType:"json", 
          
                success:function(data){  
                    //console.log(response.data[0]['path_slip']);
               

              
                   $("#add_data").html(data); 
                   $("#modal_add").modal('show'); 
                }, 

                   
           });  
                    
              },
           });
        });
      });
  $(document).on('click', '#btnsend_reset_add', function(){ 

            $("#div_add_type").show();
            $("#div_edit_type").hide();
        

            
        })
   $(document).on('click', '.delete-type', function(){  
            var id = $(this).attr('data-id'); 
            var _method = 'del_type';
            swal({
            title: "ยืนยัน?",
            text: "ยืนยันการลบ?",
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
                url:'functions.php',
                data: {id:id,
                       _method:_method},             
                success:function(data){
                  // alert(data.status);
                  if (data.status=='0') {
                    swal("สำเร็จ", "ลบเรียบร้อยแล้ว", "success");
                  }else{
                      swal("ไม่สำเร็จ", "เกิดปัญหากับระบบ", "warning");
                  }
                  
                      var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
    $.ajax({   
            url:'select_type.php', 
            method:'POST',  
            data:{_method:'manage_type',button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},  
            //dataType:"json", 
          
                success:function(data){  
                    //console.log(response.data[0]['path_slip']);
               

              
                   $("#add_data").html(data); 
                   $("#modal_add").modal('show'); 
                }, 

                   
           });  
                 
                },
                  
            }); 
         });
      });

   $("#modal_add").on('hidden.bs.modal', function () {
    location.reload();
  });
    </script>

</body>
</html>
