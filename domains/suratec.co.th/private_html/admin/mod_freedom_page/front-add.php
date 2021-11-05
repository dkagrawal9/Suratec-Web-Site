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
   <link rel="shortcut icon" type="image/png" href="../img/favicon.png"/>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
 
</head>
<body class="hold-transition skin-blue sidebar-mini fixed" onload="startTime()">
<div class="wrapper">

 
  <?php require_once '../template/nav_menu.php'; ?>
  <?php require_once '../library/permission.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        เพิ่มหน้าเสริม
      </h1>
      <ol class="breadcrumb">
        <li><a href="../page_home/index.php"></i> <?=lang('แดชบอร์ด','Dashboard')?></a></li>
        <li><a href="front-manage.php"></i> จัดการหน้าเสริม</a></li>
        <li class="active">เพิ่มหน้าเสริม</li>
      </ol>
    </section>
    <section class="content">
    <!-- Main content -->
      <!-- /.box -->
      <div class="alert alert-success alert-dismissible" id="result_add_cat" style="display: none;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <div id="loader_add_cat">
          <h4><i class="fa fa-circle-o-notch fa-spin"></i></h4>
          กำลังเพิ่ม...
        </div>
        <div id="success_add_cat">
          <h4><i class="icon fa fa-check"></i> สำเร็จ!</h4>
          เพิ่มเรียบร้อยแล้ว.
        </div>
      </div>

      <div class="alert alert-success alert-dismissible" id="result_add" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <div id="loader_add">
              <h4><i class="fa fa-circle-o-notch fa-spin"></i></h4>
              กำลังเพิ่ม...
            </div>
            <div id="success_add">
              <h4><i class="icon fa fa-check"></i> สำเร็จ!</h4>
              เพิ่มเรียบร้อยแล้ว.
            </div>
          </div>

      <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-warning">&nbsp;&nbsp;</i><?=lang('เสร็จสิ้น','Success')?></h4>
              </div>
              <div class="modal-body">
                <center><h4><?=lang('เพิ่มเพิ่มหน้าเสริมเรียบร้อยแล้ว คุณจะไปหน้าจัดการเพิ่มหน้าเสริมหรือไม่','Added article successfully Will you go to the article management page?')?></h4></center>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?=lang('เพิ่มเนื้อหาต่อ..','Add more content ..')?></button>
                <button type="button" class="btn btn-primary" id="btnYes"><?=lang('ยืนยัน','Confirm')?></button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

     
        <div class="row">
                 <form action="back_article-add.php" method="post" enctype="multipart/form-data" id="frmADD" class="upload-form-add">
                <div class="col-lg-12 col-md-12 col-sm-12" >
                    <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="box box-success box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">เพิ่มหน้าเสริม</h3>
                                </div>
                                <div class="box-body" >
                               
                 
                    <div class="input-group">
                    <span class="input-group-addon">ลิงค์</span>
                    <input type="text" class="form-control " id="link_freedom_page" name="link_freedom_page" onkeyup="checklength()" >
                  </div>
                  <input type="hidden" name="id_link" value="3">
                  
                </div>
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
                        <label for="" class="control-label">ชื่อหน้าภาษาไทย</label>
                      
                          <input type="text" class="form-control " id="name_th" name="name_th"   placeholder="ชื่อหน้าภาษาไทย">
                        
                    </div>
                  <input type="hidden" name="id_link" value="3">
                  <div id="editor" style="margin-top: 10px;">
                    <textarea class='edit' name="editor" style="margin-top: 20px;"></textarea>
                  </div>
                </div>
                <div class="tab-pane" id="english">
                  <div class="form-group">
                        <label for="" class=" control-label">ชื่อหน้าภาษาอังกฤษ</label>
                        
                          <input type="text" class="form-control " id="name_en" name="name_en"    placeholder="ชื่อหน้าภาษาอังกฤษ" >
                       
                    </div>
                  <input type="hidden" name="id_link" value="3">
                  <div id="editor" style="margin-top: 10px;">
                    <textarea class="edit"  name="editor_en" style="margin-top: 20px;"></textarea> 
                  </div>
                </div>
              </div>
            </div>
                <!-- <div class="tab-pane" id="english">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-header"></i></span>
                    <input type="text" class="form-control " id="article_name_en" name="article_name_en" placeholder=" <?=lang('ภาษาอังกฤษ','English')?>" onkeyup="checklength()">
                  </div>
                  <input type="hidden" name="id_link" value="3">
                  <div id="editor" style="margin-top: 10px;">
                    <textarea class="edit"  name="editor_en" style="margin-top: 20px;"></textarea> 
                  </div>
                </div> -->
              </div>
            </div>
            </div>
            <!-- /.box -->

          </div>
          <!-- /.col (left) -->
         
        <!-- /.row -->
        <div class="boxsave" style="<?php echo $button_open ?>">
          <button type="button" class="btn btn-success pull-right btnSendAdd" id="btnSendAdd" disabled style="transition: 0.4s; margin-left: 5px;"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;<?=lang('บันทึก','Save')?></button>
          <button type="button" class="btn btn-default pull-right btnSendClear" id="btnSendClear"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;<?=lang('เคลียร์','Clear')?></button>
      </div>
        <!-- /.box --> 
      </form>
<input type="hidden" name="per_button_edit" id="per_button_edit" value="<?php echo $button_edit ?>">
<input type="hidden" name="per_button_del" id="per_button_del" value="<?php echo $button_del ?>">
<input type="hidden" name="per_button_open" id="per_button_open" value="<?php echo $button_open ?>">
<input type="hidden" name="per_input_read" id="per_input_read" value="<?php echo $input_read ?>">
      <!-- /.form send to DB-->
      <div class="modal fade" id="modal-default-image">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-warning">&nbsp;&nbsp;</i><?=lang('คำเตือน','Warning')?></h4>
              </div>
              <div class="modal-body">
                <div id="image">
                  <center><img src="../img/warning.png" width="60" height="60"><h4><?=lang('กรูณาเลือกรูปภาพ','Please select the picture.')?></h4></center>
                </div>
                <div id="checkbox">
                  <center><img src="../img/warning.png" width="60" height="60"><h4><?=lang('กรูณาเลือกหมวดหมู่บทความ','Please select the article category.')?></h4>
                    <?=lang('ในกรณีไม่มีหมวดหมู่ที่ต้องการสามารถเพิ่มหมวดหมู่ที่ปุ่ม เพิ่มหมวดหมู่','In the absence of the desired category, can add a category to the button. Add category')?></center>
                </div>
                <div id="clearbox">
                  <center><img src="../img/warning.png" width="60" height="60"><h4><?=lang('การเคลียร์หน้าเพิ่มบทความจะเป็นการล้างหน้าจอรวมถึงภาพ/หมวดหมู่/เนื้อหาจะถูกล้างไปด้วย','Clearing the add page will clear the screen including images / categories / content will be cleared as well.')?></h4></center>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-block btn-primary" data-dismiss="modal"><?=lang('ฉันเข้าใจแล้ว','Understood')?></button>
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
                <h4 class="modal-title"><i class="fa fa-warning">&nbsp;&nbsp;</i><?=lang('คำเตือน','Warning')?></h4>
              </div>
              <div class="modal-body">
                <div id="clearbox">
                  <center><img src="../img/warning.png" width="60" height="60"><h5><?=lang('การเคลียร์หน้าเพิ่มหน้าเสริมจะเป็นการล้างหน้าจอรวมถึงเนื้อหาจะถูกล้างไปด้วย','Clearing the add page will clear the screen including  content will be cleared as well.')?></h5></center>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?=lang('ยกเลิกการเคลียร์','Cancel')?></button>
                <button type="button" class="btn btn-primary btnSendClearBox" data-dismiss="modal"><?=lang('ฉันเข้าใจแล้ว','Understood')?></button>
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
<script>
      $(function() {
          $('.edit').froalaEditor({
            language: 'ar',
            heightMin: 300,
            heightMax: 400,
            imageUploadURL:"froala_upload_image.php",
            imageUploadParam:"fileName",
            imageManagerLoadMethod:"GET",
            imageManagerLoadURL:"page_froala/page_froala/select.php",
            imageManagerDeleteURL:"froala_delete_image.php",
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
           });
      });
      $(document).ready(function(){
        //---------------------------------------fetch_data_category-------------------------------------------------------------------------
        // function fetch_data_cat()  
        //   {  
        //       $.ajax({  
        //           url:"select_cat-fa.php",  
        //           method:"POST",  
        //           success:function(data){  
        //       $('#catagory').html(data);  
        //           }  
        //       });  
        //   }  
        //   fetch_data_cat();
        //---------------------------------------clear form----------------------------------------------------------------------------------
        $(document).on('click', '.btnSendClear', function() {
            $('#modal-default-clearbox').modal('show');
        });
        $(document).on('click', '.btnSendClearBox', function() {
            document.getElementById('frmADD').reset();
            $('#img-upload').attr('src', 'img/upload.jpg');
            document.getElementById("btnSendAdd").disabled = true;
        });
        //------------------------------------------------------------ADD Catagory-----------------------------------------------------------
        $(document).on('click', '.btnSendAddCat', function(){ 
          var name = $("#name_cat").val();
              $.ajax({
                  beforeSend: function() {
                    // setting a timeout
                    $('#result_add_cat').show();
                    $('#success_add_cat').hide();
                    $('#loader_add_cat').show();
                  },
                  complete: function() {
                      $('#loader_add_cat').hide();
                      $('#success_add_cat').show();  
                      setTimeout(function(){$("#result_add_cat").hide(0)}, 10000);
                  },
                   type: "POST",
                   url: "back_catagory-add.php",
                   data: 'name='+name,
                   success: function(data) {
                   fetch_data_cat();
                  },
              });
         });
        //--------------------------------------------------------check box for validation--------------------------------------------------
        $(document).on('click', '.css_data_item', function(){  // เมื่อคลิก checkbox  ใดๆ  
            if($(this).prop("checked")==true){ // ตรวจสอบ property  การ ของ   
                var indexObj=$(this).index(".css_data_item"); //   
                $(".css_data_item").not(":eq("+indexObj+")").prop( "checked", false ); // ยกเลิกการคลิก รายการอื่น  
            }  
        });
     //------------------------------------------------------------ADD article--------------------------------------------------------------
        $(document).on('click', '.btnSendAdd', function(){ 
          var formData = new FormData($('.upload-form-add')[0]);
             // var checkfilearticle = $(".checkfilearticle")[0].files.length;
            //  if(checkfilearticle === 0){
            //       $('#modal-default-image').modal('show');
            //       $('#image').show();
            //       $('#checkbox').hide();
            //       $('#clearbox').hide();
            //      return false;
            //  }
            //  if($(".css_data_item:checked").length==0){ // ถ้าไม่มีการเลือก checkbox ใดๆ เลย  
            //        $('#modal-default-image').modal('show'); 
            //        $('#image').hide();
            //        $('#clearbox').hide();
            //        $('#checkbox').show(); 
            //       return false;     
            // }  
              $.ajax({
                  beforeSend: function() {
                    // setting a timeout
                    $('#result_add').show();
                    $('#success_add').hide();
                    $('#loader_add').show();
                  },
                  complete: function() {
                      $('#loader_add').hide();
                      $('#success_add').show();  
                      setTimeout(function(){$("#result_add").hide(0)}, 10000);
                      $('#modal-default').modal('show');

                  },
                   type: "POST",
                   url: "back_article-add.php",
                   data: formData,
                   processData: false,
                   contentType: false,
                   success: function(data) {
                    // alert(data);
                      document.getElementById('frmADD').reset();
                      $('#img-upload').attr('src', 'img/upload.jpg');
                  },
              });
          });
        $(document).on('click', '#btnYes', function (){
          location.href = "front-manage.php";
        })
      });
       //---------------------------------------Show add form category toggle--------------------------------------------------------------------
      $(function(){          
        $(".show-add").click(function(){
            $("#add-cat").toggle();
        });    
      });  
      //----------------------------------------------Check length for open button save---------------------------------------------------------
      function checklength() {
        var input = document.getElementById("link_freedom_page") ;
                if(input.value.length > 0)
                {
                  document.getElementById("btnSendAdd").disabled = false;
                }else{
                  document.getElementById("btnSendAdd").disabled = true;
                }
        }
        //----------------------------------------------Check length for open button save(forcategory)------------------------------------------
        function checklengthcat() {
        var input = document.getElementById("name_cat") ;
                if(input.value.length > 0)
                {
                  document.getElementById("btnSendAddCat").disabled = false;

                }else{
                  document.getElementById("btnSendAddCat").disabled = true;
                }
        }
        //----------------------------------------------------Set time realtime------------------------------------------------------------------
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
            if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
            return i;
        }
</script>
</body>
</html>
