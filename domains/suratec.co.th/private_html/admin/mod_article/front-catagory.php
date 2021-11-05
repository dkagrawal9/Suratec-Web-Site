<?php 
  require_once '../library/connect.php';
  require_once '../library/functions.php';
  checkAdminUser($objConnect);

  $title = lang('จัดการหมวดหมู่บทความ','Catagory Management');
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
    <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- css table article -->
  <link rel="stylesheet" href="css/table-article.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style>
    .remove-item{
      background-color: #fff6f6 !important;
      transition: 0.4s; 
      color: red;
    }
    .remove-item:hover{
      background-color: #F5F5F5 !important;
      transition: 0.4s; 
      color: red;
    }
</style>
</head>
<body class="hold-transition skin-blue fixed sidebar-mini" onload="startTime();">
<div class="wrapper">
 <?php require_once '../template/nav_menu.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>  
       <?=$title?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../page_home/index.php"><?=lang('แดชบอร์ด','Dashboard')?></a></li>
        <li><a href="front-add.php"><?=lang('เพิ่มบทความ','Add articles')?></a></li>
        <li class="active"><?=$title?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
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

           <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><?=lang('หมวดหมู่บทความ','Catagory')?></h3><button type="button" class="btn btn-success pull-right btnSendAdd btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?=lang('เพิ่มหมวดหมู่','Add Catary')?></button>
            </div>
            <div class="box-body" style="padding: 0;">
              <form action="" name="frmMain" id="frmMain" method="post">
                <div id="catagory"></div>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.box-row -->
      <div class="boxsave">
            <button type="submit" class="delmulti-menu btn btn-danger" style="transition: 0.4s;" id="MultiDelete" disabled><i class="fa fa-remove"></i>
              <?=lang('ลบรายการทั้งหมด','Delete All')?>  <span class="num_"></span></button>
            </form>
      </div>
      <!-- /.box --> 
      <div class="modal fade" id="modal-delete-catagory">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-warning">&nbsp;&nbsp;</i><?=lang('คำเตือน','Warning')?></h4>
              </div>
              <div class="modal-body">
                <form action="" id="frmDEL" name="frmDEL" method="post">
                <input type="hidden" name="id_del_catagory" id="id_del_catagory">
                <center><img src="../img/close.png" width="60" height="60"><h4><?=lang('ยืนยันการลบหรือไม่','Confirm deletion?')?></h4></center>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?=lang('ยกเลิก','Cancel')?></button>
                <button type="button" class="btn btn-primary btnSendDel"><?=lang('ยืนยัน','Confirm')?></button>
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
                <h4 class="modal-title"><i class="fa fa-warning">&nbsp;&nbsp;</i><?=lang('คำเตือน','Warning')?></h4>
              </div>
              <div class="modal-body">
                <center><img src="../img/close.png" width="60" height="60"><h4><?=lang('ยืนยันการลบรายการที่เลือกหรือไม่','Confirm the deletion of the selected item or not.')?></h4></center>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?=lang('ยกเลิก','Cancel')?></button>
                <button type="button" class="btn btn-primary btnSendDelCat"><?=lang('ยืนยัน','Confirm')?></button>
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
                <h4 class="modal-title"><?=lang('เพิ่มหมวดหมู่','Add Catagory')?></h4>
              </div>
              <div class="nav-tabs-custom" style="box-shadow: none;">
                <ul class="nav nav-tabs">
                  <li class="active">
                    <a href="#thai" data-toggle="tab" aria-expanded="true">
                      <img class="flag-lang" src="../img/th-fl.png" width="22" height="15">
                      <?=lang('ภาษาไทย','Thai')?>
                    </a>
                  </li>
                  <li>
                    <a href="#english" data-toggle="tab" aria-expanded="false">
                      <img class="flag-lang" src="../img/en-fl.jpg" width="22" height="15">
                     <?=lang('ภาษาอังกฤษ','English')?>
                    </a>
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="thai">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-header"></i></span>
                      <input type="text" class="form-control" placeholder="<?=lang('ภาษาไทย','Thai')?>" name="name" id="name_cat" onkeyup="checklength()">
                    </div>
                    <input type="hidden" name="id_link" value="3">
                  </div>
                  <div class="tab-pane" id="english">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-header"></i></span>
                      <input type="text" class="form-control" placeholder="<?=lang('ภาษาอังกฤษ','English')?>" name="name_en" id="name_cat_en" onkeyup="checklength()">
                    </div>
                    <input type="hidden" name="id_link" value="3">
                  </div>
                </div>
                <input type="hidden" name="id_article" id="id_article" value="<?php echo $objResult["id_article"]; ?>" >
              </div>
              <div class="box-footer">
                <button type="button" class="btn btn-info btnSendAddCat pull-right" id="btnYes" disabled><i class="fa fa-check"></i>&nbsp;<?=lang('บันทึก','Save')?></button>
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
                <h4 class="modal-title"><?=lang('แก้ไขหมวดหมู่','Edit Catagory')?></h4>
              </div>
              <div class="nav-tabs-custom" style="box-shadow: none;">
              <ul class="nav nav-tabs">
                <li class="active">
                  <a href="#thai_edit" data-toggle="tab" aria-expanded="true">
                    <img class="flag-lang" src="../img/th-fl.png" width="22" height="15">
                    <?=lang('ภาษาไทย','Thai')?>
                  </a>
                </li>
                <li>
                  <a href="#english_edit" data-toggle="tab" aria-expanded="false">
                    <img class="flag-lang" src="../img/en-fl.jpg" width="22" height="15">
                    <?=lang('ภาษาอังกฤษ','English')?>
                  </a>
                </li>
              </ul>
              <form action="" name="frmEDIT" id="frmEDIT" method="post">
              <div class="tab-content" style="padding: 10px;">
                <div class="tab-pane active" id="thai_edit">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-header"></i></span>
                    <input type="text" class="form-control" placeholder="<?=lang('ภาษาไทย','Thai')?>" name="name" id="name_edit-cat" onkeyup="checklength()">
                  </div>
                  <input type="hidden" name="id_link" value="3">
                </div>
                <div class="tab-pane" id="english_edit">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-header"></i></span>
                    <input type="text" class="form-control" placeholder="<?=lang('ภาษาอังกฤษ','English')?>" name="name_en" id="name_edit-cat-en" onkeyup="checklength()">
                  </div>
                  <input type="hidden" name="id_link" value="3">
                </div>
              </div>
              <input type="hidden" name="id" id="id">
               </form>
            </div>
            <div class="box-footer">
              <button type="button" class="btn btn-info btnSendUpdateCat pull-right" id="btnYes-modal"><i class="fa fa-check"></i>&nbsp;<?=lang('บันทึก','Save')?></button>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </section>
  </aside>
  <!-- /.control-sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
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
  <script type="text/javascript">
    $(document).ready(function(){
        //------------------------------------------------------------fetch data category-------------------------------------------------------
        function fetch_data_catagory()  
          {  
              $.ajax({  
                  url:"select_cat-front.php",  
                  method:"POST",  
                  success:function(data){  
              $('#catagory').html(data);  
                  }  
              });  
          }  
          fetch_data_catagory();
        $(document).on('click', '.btnSendAdd', function(){
          $('#modal-default-add').modal('show');
        });
        //------------------------------------------------------------ADD Catagory--------------------------------------------------------------
        $(document).on('click', '.btnSendAddCat', function(){ 
          var name = $("#name_cat").val();
          var name_en = $('#name_cat_en').val();

              $.ajax({
                  beforeSend: function() {
                    // setting a timeout
                    $('#result_add_cat').show();
                    $('#success_add_cat').hide();
                    $('#loader_add_cat').show();
                    $('#modal-default-add').modal('hide');
                  },
                  complete: function() {
                      $('#loader_add_cat').hide();
                      $('#success_add_cat').show();  
                      setTimeout(function(){$("#result_add_cat").hide(0)}, 10000);
                      $("#name_cat").val('');
                  },
                   type: "POST",
                   url: "back_catagory-add.php",
                   data: {name:name,name_en:name_en},
                   success: function(data) {
                    // alert(data);
                      fetch_data_catagory();
                      $("#name_cat").val('');
                      $('#name_cat_en').val('');
                  },
              });
         });
        //------------------------------------------------------------Update Catagory passing modal-----------------------------------------------
        $(document).on('click', '.edit-catagory', function(){ 
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            var name_en = $(this).attr('data-name-en');

            $("#id").val(id);
            $("#name_edit-cat").val(name);
            $("#name_edit-cat-en").val(name_en);
            $("#modal-default-edit").modal('show');
          
         });
        $(document).on('click', '.btnSendUpdateCat', function(){
            $.ajax({
                beforeSend: function() {
                    $('#result_update').show();
                    $('#success_update').hide();
                    $('#loader_update').show();
                    $('#modal-default-edit').modal('hide');
                },
                complete: function() {
                    $('#loader_update').hide();
                    $('#success_update').show();
                    setTimeout(function(){$("#result_update").hide(0)}, 10000);  
                },
                type:"POST",
                url:'back_catagory-edit.php',
                data: $("#frmEDIT").serialize(),             
                success:function(data){
                  // alert(data);
                  fetch_data_catagory(); 
                },
            }); 
        });
        //-------------------------------Delete category show modal alert before send value to delete-----------------------------------------------
        $(document).on('click', '.delete-catagory', function(){  
            var id = $(this).attr('data-id'); 

            $('#id_del_catagory').val(id);
            $('#modal-delete-catagory').modal('show');
        });
        $(document).on('click', '.btnSendDel', function(){
            $.ajax({
                beforeSend: function() {
                    // setting a timeout
                    $('#result_del').show();
                    $('#success_del').hide();
                    $('#loader_del').show();
                    $('#modal-delete-catagory').modal('hide');
                },
                complete: function() {
                    $('#loader_del').hide();
                    $('#success_del').show();
                    setTimeout(function(){$("#result_del").hide(0)}, 10000);  
                },
                type:"POST",
                url:'back_catagory-delete.php',
                data: $("#frmDEL").serialize(),             
                success:function(data){
                  fetch_data_catagory(); 
                },
                
            }); 
        });
        //---------------------------------------Alert modal for notification of delete multiple--------------------------------------------------
        var formClick;
        $(document).on('submit', '#frmMain', function () {
            formClick = $(this);
            $('#modal-default').modal('show');
            return false;
        });
        $(document).on('click', '.btnSendDelCat', function () {
          $.ajax({
             beforeSend: function() {
             // setting a timeout
                  $('#result_del').show();
                  $('#success_del').hide();
                  $('#loader_del').show();
                  $('#modal-default').modal('hide');
              },
              complete: function(argument) {
                  $('#loader_del').hide();
                  $('#success_del').show();
                  setTimeout(function(){$("#result_del").hide(0)}, 10000); 
                  document.getElementById('MultiDelete').disabled = true;
              },
              type: "POST",
              url: "back_catagory-deletemulti.php",
              data: $("#frmMain").serialize(),
              success: function(data) {
                  fetch_data_catagory();
              },
           });
        });
      });
      //----------------------------------------------Check length for open button save-------------------------------------------------------------
      function checklength() {
      var input = document.getElementById("name_cat") ;
            if(input.value.length > 0)
            {
                document.getElementById("btnYes").disabled = false;

            }else{
              document.getElementById("btnYes").disabled = true;
            }
      }
      //----------------------------------------------Check length for open button save(modal-edit)--------------------------------------------------
      function checklengthmodal() {
      var input = document.getElementById("name_edit-cat") ;
            if(input.value.length > 0)
            {
                document.getElementById("btnYes-modal").disabled = false;
            }else{
              document.getElementById("btnYes-modal").disabled = true;
            }
      }
       //----------------------------------------------Click Check all------------------------------------------------------------------------------
        function ClickCheckAll(vol)
        {
        
          var i=1;
          for(i=1;i<=document.frmMain.hdnCount.value;i++){
            $('.num_').html('[ '+i+' ]');
            if(vol.checked == true){
              eval("document.frmMain.Chk"+i+".checked=true");
              $(".show-tr").addClass("remove-item"); 
              document.getElementById('MultiDelete').disabled = false;
            }else{
              $('.num_').html('');
              eval("document.frmMain.Chk"+i+".checked=false");
              document.getElementById('MultiDelete').disabled = true;
              $(".show-tr").removeClass("remove-item");
            }
          }
        }
        //---------------------------------------------------Add Class---------------------------------------------------------------------------------
        $(document).on('click', '.checkbox_remove', function(){ 
          var i =0; 
          if($(this).is(":checked")) 
          {
              $(this).parents('.show-tr').addClass("remove-item");
              $('#MultiDelete').prop('disabled',false);
              $('.remove-item').each(function() {
                i++;       
              });
              $('.num_').html('[ '+i+' ]');
          } 
          else 
          {
              $(this).parents('.show-tr').removeClass("remove-item");
              $('.remove-item').each(function() {
                i++;       
              });
              $('.num_').html('[ '+i+' ]');
              if(!$('input.checkbox_remove').is(':checked')){
                $('#MultiDelete').prop('disabled',true);
                $('#CheckAll').prop('checked', false);
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
          if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
          return i;
      }
</script>
</body>

</html>
