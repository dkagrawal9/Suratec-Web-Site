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


                     // // alert('??????????????????????????????????????????????????????');
                     // saw('??????????????????','??????????????????????????????????????????????????????','success')

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
                ?????????????????????????????????
            </h1>
            <ol class="breadcrumb">
                <li><a href="../index.php"></i>????????????????????????</a></li>
                <li class="active">?????????????????????????????????</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!--  <div class="box box-primary">
               <div class="box-header with-border">
                 <h3 class="box-title">??????????????????????????????????????????????????????</h3>

                 <div class="box-tools pull-right">
                   <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                 </div>
               </div>
               <div class="box-body">
                 <div style="padding-left: 10px;">
                   <i class="fa fa-caret-right"></i>&nbsp;&nbsp;??????????????????????????????????????????????????????????????????????????????????????????<br>
                   <i class="fa fa-caret-right"></i>&nbsp;&nbsp;?????????????????????????????????????????????????????????????????????????????????????????????????????? + ??????????????????????????????????????? ?????????????????????????????????????????????????????????????????? ?????????????????????????????????????????? 1 ??????????????? ???????????????????????????????????????????????????<br>
                   <i class="fa fa-caret-right"></i>&nbsp;&nbsp;?????????????????????????????????/?????? ???????????????????????????????????????????????????????????????????????????????????????????????????????????????<br>
                   <i class="fa fa-caret-right"></i>&nbsp;&nbsp;??????????????????????????????????????????????????????????????????????????????????????? ??????????????????????????????????????????????????????????????????????????????????????? ??????????????????????????????<br>
                   <i class="fa fa-caret-right"></i>&nbsp;&nbsp;??????????????????????????????????????????????????????????????????????????????????????? ?????????????????????????????????????????????????????????????????????????????????????????????<br>
                   <i class="fa fa-caret-right"></i>&nbsp;&nbsp;???????????????????????????????????????????????? ????????????????????? 1 ???????????? ???????????????????????? ???????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????? ???????????????????????????????????? ????????????????????????????????????????????????<br>
                   <i class="fa fa-caret-right"></i>&nbsp;&nbsp;???????????????????????????????????????????????????????????? ?????????????????????????????????????????????????????????????????????????????? ???????????????????????????????????????????????? ????????????????????????????????????????????????????????????????????????????????? ??????????????????????????????????????????????????????????????????????????????<br>
                 </div>
               </div>
             </div> -->
            <!-- /.box -->

            <!-- <div class="alert alert-success alert-dismissible" id="result" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <div id="loader_edit">
                    <h4><i class="fa fa-circle-o-notch fa-spin"></i></h4>
                    ??????????????????????????????...
                </div>
                <div id="success_edit">
                    <h4><i class="icon fa fa-check"></i> ??????????????????!</h4>
                    ??????????????????????????????????????????????????????.
                </div>
            </div> -->

            <div class="alert alert-success alert-dismissible" id="result_level" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <div id="loader_level">
                    <h4><i class="fa fa-circle-o-notch fa-spin"></i></h4>
                    ??????????????????????????????...
                </div>
                <div id="success_level">
                    <h4><i class="icon fa fa-check"></i> ??????????????????!</h4>
                    ???????????????????????????????????????????????? Level ???????????????????????????????????????.
                </div>
            </div>

            <div class="alert alert-warning alert-dismissible" id="result_level_warning" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <div id="success_level">
                    <h4><i class="icon fa fa-warning"></i> ???????????????????????????!</h4>
                    ???????????????????????????????????????????????? Level ????????????????????????????????????????????????????????????.
                </div>
            </div>

            <div class="alert alert-success alert-dismissible" id="result_del" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <div id="loader_del">
                    <h4><i class="fa fa-circle-o-notch fa-spin"></i></h4>
                    ?????????????????????...
                </div>
                <div id="success_del">
                    <h4><i class="icon fa fa-check"></i> ??????????????????!</h4>
                    ????????????????????????????????????.
                </div>
            </div>

            <div class="alert alert-success alert-dismissible" id="result_add" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <div id="loader_add">
                    <h4><i class="fa fa-circle-o-notch fa-spin"></i></h4>
                    ?????????????????????????????????...
                </div>
                <div id="success_add">
                    <h4><i class="icon fa fa-check"></i> ??????????????????!</h4>
                    ?????????????????????????????????????????????????????????.
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                             <div class="col-md-4" style="padding: 20px">
                            <h3 class="box-title">?????????????????????????????????</h3>
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
                    <button type="submit" class="delmulti-menu btn btn-danger" style="transition: 0.4s; <?php echo $button_del; ?>" id="MultiDelete" disabled><i class="fa fa-remove"></i> ?????????????????????????????????????????????</button>
                </div>
                </form>
                <!-- /.col left-->
                <div class="col-md-4"  style="<?php  ?>">
                    <form  id="frmADD" name="frmADD" method="post" enctype="multipart/form-data" class="upload-form-add">
                        
                        <div class="box box-success">

                            <div class="box-header with-border">
                                <h3 class="box-title">??????????????????????????????</h3>
                            </div>

                            <div class="box-body">
                                 
                        
                         <div class="col-md-12" style="padding: 20px">
                        
                        </div>
                        <br><br>
                                <div style="width: 150px; padding-bottom: 10px;">
                                    <img id='img-upload' src="components/up_pre/upload.jpg"/>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" readonly>
                                    <span class="input-group-btn">
                            <span class="btn btn-default btn-file" style="background-color: white !important;">
                                <i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;&nbsp;????????????????????????????????? <input type="file" accept="image/*" id="imgInp" name="image_slide">
                            </span>
                        </span>

                                </div>
                                <br>
                         <p>*??????????????????????????????????????????????????????????????? 1287 X 483 Pixels (??????????????? X ????????? )</p>
                                <!--  <input type="file" name="image_slide" id="checkfileslide"> -->
                            </div>
                                                        <div class="nav-tabs-custom" style="box-shadow: none;">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#thai" data-toggle="tab" aria-expanded="true">
                                            <img class="flag-lang" src="../img/th-fl.png" width="22" height="15">
                                            ?????????????????????
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#english" data-toggle="tab" aria-expanded="false">
                                            <img class="flag-lang" src="../img/en-fl.jpg" width="22" height="15">
                                            ??????????????????????????????
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="thai">
                                        <div class="input-group">
                                            <span class="input-group-addon">??????????????????????????????</span>
                                            <input type="" name="name" class="form-control" placeholder="?????????????????????????????? TH" id="name" onkeyup="checklength();">
                                        </div>
                                        <div style="padding: 10px 0px 7px 0px;">
                                            <label>?????????????????????</label>
                                            <textarea class="form-control edit" rows="5" style="resize: none;" name="content_slide" placeholder="????????????????????? ??????????????????????????????????????????????????????????????????????????????????????????????????????......"></textarea>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="english">
                                        <!-- <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-header"></i></span>
                                            <input type="" name="head_slide_en" class="form-control" placeholder="?????????????????? ??????????????????????????????" id="txt" onkeyup="checklength();">
                                        </div> -->
                                        <div class="input-group">
                                            <span class="input-group-addon">??????????????????????????????</span>
                                            <input type="" name="name_en" class="form-control" placeholder="?????????????????????????????? EN" id="name_en" onkeyup="checklength();">
                                        </div>
                                        <div style="padding: 10px 0px 7px 0px;">
                                            <label>?????????????????????</label>
                                            <textarea class="form-control edit" rows="5" style="resize: none;" name="content_slide_en" placeholder="???????????????????????????????????? ????????????????????????????????????????????????????????????????????????????????????????????????......"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                            <div class="box-footer">
                                <button type="button" class="btn btn-info btnSendAdd pull-right" id="btnSendAdd" style="transition: 0.4s;" disabled="false">
                                    <i class="fa fa-check"></i>&nbsp;??????????????????
                                </button>
                                <button type="button" class="btn btn-warning btnSendClear pull-right" style="margin-right: 5px;">
                                    <i class="fa fa-remove"></i>&nbsp;?????????????????????
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
                <h4 class="modal-title"><i class="fa fa-warning">&nbsp;&nbsp;</i>?????????????????????</h4>
            </div>
            <div class="modal-body">
                <form action="" id="frmDEL" name="frmDEL" method="post">
                    <input type="hidden" name="id_del_slide" id="id_del_slide">
                    <center><img src="../img/close.png" width="60" height="60"><h4>??????????????????????????????????????????????????????</h4></center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">??????????????????</button>
                <button type="button" class="btn btn-primary btnSendDel">??????????????????</button>
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
                <h4 class="modal-title"><i class="fa fa-warning">&nbsp;&nbsp;</i>?????????????????????</h4>
            </div>
            <div class="modal-body">
                <center><img src="../img/close.png" width="60" height="60"><h4>????????????????????????????????????????????????????????????????????????????????????????????????</h4></center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">??????????????????</button>
                <button type="button" class="btn btn-primary" id="btnYes">??????????????????</button>
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
                <h4 class="modal-title"><i class="fa fa-warning">&nbsp;&nbsp;</i>?????????????????????</h4>
            </div>
            <div class="modal-body">
                <center><img src="../img/warning.png" width="60" height="60"><h4>????????????????????????????????????????????????</h4></center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-block btn-primary" data-dismiss="modal">???????????????????????????????????????</button>
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
                <h4 class="modal-title"><i class="fa fa-warning">&nbsp;&nbsp;</i>?????????????????????</h4>
            </div>
            <div class="modal-body">
                <center><img src="../img/warning.png" width="60" height="60"><h4>???????????????????????????????????????????????????</h4></center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-block btn-primary" data-dismiss="modal">???????????????????????????????????????</button>
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
                <h4 class="modal-title"><i class="fa fa-warning">&nbsp;&nbsp;</i>?????????????????????</h4>
            </div>
            <div class="modal-body">
                <center><img src="../img/warning.png" width="60" height="60"><h4>??????????????????????????????????????????????????????</h4></center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-block btn-primary" data-dismiss="modal">???????????????????????????????????????</button>
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
                <h4 class="modal-title"><i class="fa fa-warning">&nbsp;&nbsp;</i>?????????????????????</h4>
            </div>
            <div class="modal-body">
                <div id="clearbox">
                    <center><img src="../img/warning.png" width="60" height="60"><h5>???????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????</h5></center>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">????????????????????????????????????????????????</button>
                <button type="button" class="btn btn-primary btnSendClearBox" data-dismiss="modal">???????????????????????????????????????</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</section>
<!-- ./section -->
</aside>
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
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- send data to modal -->
<script src="js/modal.js"></script>
<script src="components/up_pre/js.js"></script>
<!-- Slimscroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="../page_froala/js/froala_editor.pkgd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<script>
      $(function() {
          $('.edit').froalaEditor({
            language: 'ar',
            heightMin: 300,
            heightMax: 400,
            imageUploadURL:"froala_upload.php",
            imageUploadParam:"fileName",
            imageManagerLoadMethod:"GET",
            imageManagerLoadURL:"../page_froala/select.php",
            imageManagerDeleteURL:"../page_froala/delete.php",
            imageManagerDeleteMethod:"POST",
            // video
            videoUploadURL: 'froala_upload_video.php',
            videoUploadParam: 'fileName',
            videoUploadMethod: 'POST',
            videoMaxSize: 50 * 1024 * 1024,
            videoAllowedTypes: ['mp4', 'webm', 'jpg', 'ogg'],

            fileUploadURL: 'froala_upload_file.php',
            fileUploadParam: 'fileName',
            fileUploadMethod: 'POST',
            fileMaxSize: 20 * 1024 * 1024,
            fileAllowedTypes: ['*'],
          }).on('froalaEditor.image.uploaded', function (e, editor, response) {
            console.log(response);
          }).on('froalaEditor.imageManager.beforeDeleteImage', function (e, editor, $img) {
            console.log($img);
          }).on('froalaEditor.imageManager.imageDeleted', function (e, editor, res) {
            console.log(res);
          }).on('froalaEditor.video.beforeUpload', function (e, editor, videos) {
            console.log("beforeUpload");
          }).on('froalaEditor.video.uploaded', function (e, editor, response) {
            console.log("uploaded");
          }).on('froalaEditor.video.inserted', function (e, editor, $img, response) {
            console.log("inserted");
          }).on('froalaEditor.video.replaced', function (e, editor, $img, response) {
            console.log("replaced");
          }).on('froalaEditor.video.error', function (e, editor, error, response) {
            console.log("error");
          }).on('froalaEditor.file.beforeUpload', function (e, editor, files) {
            console.log("beforeUpload");
          }).on('froalaEditor.file.uploaded', function (e, editor, response) {
            console.log("uploaded");
          }).on('froalaEditor.file.inserted', function (e, editor, $file, response) {
            console.log("inserted");
          }).on('froalaEditor.file.error', function (e, editor, error, response) {
            console.log("error");
           }).on('froalaEditor.image.removed', function (e, editor, $img) {

        $.ajax({

                // Request method.
                method: "POST",
                // Request URL.
                url: "froala_delete_image.php",
                // Request params.
                data: {
                    src: $img.attr('src')
                }

            })

            .done(function (data) {
                console.log($img)
            })
            .fail(function () {
                console.log('image delete problem')
            })
    });
      });
    </script>
    <script type="text/javascript">
         $(document).on('click', '.btnSendno', function(){
           var formData = new FormData($('.upload-form')[0]);
           var name_image = $('#name_image').val();
            document.getElementById("frmEDIT").reset();  
            $('#img').attr('src', name_image); 
             // location.reload();
             window.location='manage-slide.php';  

        });
    </script>

</body>
</html>
