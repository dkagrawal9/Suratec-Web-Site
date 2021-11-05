<?php 
  require_once '../library/connect.php';
  require_once '../library/functions.php';
  checkAdminUser($objConnect);

  $title = "จัดการหน้าเสริม";
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
   <link rel="shortcut icon" type="image/png" href="../img/favicon.png"/>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
    <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!--Css table -->
  <link rel="stylesheet" href="css/table-article.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <style>
       .btn-paginate{
         background-color: white;
         border-color: #bcbcbc;
         transition: 0.6s;
       }
       .btn-paginate:hover{
         background-color: #bcbcbc;
         color: white;
       }
       .page-active
       {
         background-color: #bcbcbc;
         color: white;
       }

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
<body class="hold-transition skin-blue fixed sidebar-mini" onload="startTime()">
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
        <li><a href="../../index.php"></i><?=lang('แดชบอร์ด','Dashboard')?></a></li>
        <li class="active"><?=$title?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
<input type="hidden" name="per_button_edit" id="per_button_edit" value="<?php echo $button_edit ?>">
<input type="hidden" name="per_button_del" id="per_button_del" value="<?php echo $button_del ?>">
<input type="hidden" name="per_button_open" id="per_button_open" value="<?php echo $button_open ?>">
<input type="hidden" name="per_input_read" id="per_input_read" value="<?php echo $input_read ?>">
          <div class="alert alert-success alert-dismissible" id="result_level" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <div id="loader_level">
              <h4><i class="fa fa-circle-o-notch fa-spin"></i></h4>
              กำลังแก้ไข...
            </div>
            <div id="success_level">
              <h4><i class="icon fa fa-check"></i> สำเร็จ!</h4>
              แก้ไขเรียบร้อยแล้ว.
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
            ลบเรียบร้อยแล้ว.
          </div>
        </div>

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
                <button type="button" class="btn btn-primary" id="btnYes"><?=lang('ยืนยัน','Confirm')?></button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal fade" id="modal-delete-article">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-warning">&nbsp;&nbsp;</i><?=lang('คำเตือน','Warning')?></h4>
              </div>
              <div class="modal-body">
                <form action="" id="frmDEL" name="frmDEL" method="post">
                <input type="hidden" name="id_del_article" id="id_del_article">
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

           <div class="box box-info">
            <!-- <div class="box-header with-border">
              <h3 class="box-title">จัดการหน้าเสริม</h3><button type="button" class="btn btn-success btn-sm pull-right" onclick="javascript:location.href='front-add.php'"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?=lang('เพิ่มหน้าเสริม','Add Article')?></button>
            </div> -->
             <div class="panel-body">
                        <form id="frm_search">
                           
                            <div class="form-group" >
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="key_word" id="key_word" placeholder="<?=lang('ค้นหา', 'Search')?>">
                                </div>
                            </div>
                        </form>
                        <div class="col-md-3">
                            <div class="btn-group" role="group" aria-label="">
                                <button type="button" class="btn btn-primary search" id="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;<?=lang('ค้นหา', 'Search')?></button>
                                <button type="button" class="btn btn-default search_full" id="search_full"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp;<?=lang('ทั้งหมด', 'Full')?></button>
                            </div>
                        </div>
                        <div class="col-md-3" align="right">
                            <div class="btn-group" role="group" aria-label="">
                              <a href="front-add.php" class="btn btn-success "><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;<?=lang('เพิ่ม', 'Add')?></a>
                                
                               
                            </div>
                        </div>
                    </div>
            <div class="box-body" style="padding: 0;">

              <form action="" name="frmMain" id="frmMain" method="post">
              <div id="live_data-article"></div>
            
            
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- <div class="boxsave">
            <button type="submit" class="delmulti-menu btn btn-danger" style="transition: 0.4s;" id="MultiDelete" disabled><i class="fa fa-remove"></i>
              <?=lang('ลบรายการทั้งหมด','Delete All')?> <span class="num_"></span></button>
      </div> -->
      </form>
      <!-- /.box --> 
    </section>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
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
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>

<script type="text/javascript">
   $(document).on('click', '#search', function(){
   
      var key_word = $('#key_word').val();
       var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
     $.ajax({  
                  url:"select_mn-front.php",  
                  method:"POST",  
                  data:{key_word:key_word,button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},
                  success:function(data){  
              $('#live_data-article').html(data);  
                  }  
              });  
  })
   $(document).on('click','#search_full',function() {
    var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
              $.ajax({  
                  url:"select_mn-front.php",  
                  method:"POST",  
                  data:{button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},
                  success:function(data){  
              $('#live_data-article').html(data);  
               $('#key_word').val(''); 
                  }  
              });  
          
  })
</script>
  <script type="text/javascript">

          
    $(document).ready(function(){
          //------------------------------------------------------------fetch data article-------------------------------------------------------
          function fetch_data_article(page)  
          {  
             var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
              $.ajax({  
                  url:"select_mn-front.php",  
                  method:"POST",  
                  data:{page:page,button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},
                  success:function(data){  
              $('#live_data-article').html(data);  
                  }  
              });  
          }  
          fetch_data_article();
          //------------------------------------------------------------pagination link-----------------------------------------------------------
          $(document).on('click', '.pagination_link', function(){
            var page = $(this).attr("id");
            fetch_data_article(page);
            document.getElementById('MultiDelete').disabled = true;
          });

        //-------------------------------Delete article show modal alert before send value to delete----------------------------------------------
        $(document).on('click', '.delete-article', function(){  
            var id = $(this).attr('data-id'); 

            $('#id_del_article').val(id);
            $('#modal-delete-article').modal('show');
        });
        $(document).on('click', '.btnSendDel', function(){
            $.ajax({
                beforeSend: function() {
                    // setting a timeout
                    $('#result_del').show();
                    $('#success_del').hide();
                    $('#loader_del').show();
                    $('#modal-delete-article').modal('hide');
                },
                complete: function() {
                    $('#loader_del').hide();
                    $('#success_del').show();
                    setTimeout(function(){$("#result_del").hide(0)}, 10000);  
                },
                type:"POST",
                url:'back_delete.php',
                data: $("#frmDEL").serialize(),             
                success:function(data){
                    // alert(data);
                    fetch_data_article(); 
                },
                
            }); 
        });
        //---------------------------------------Alert Mmodal for notification of delete multiple---------------------------------------------------
        var formClick;
        $(document).on('submit', '#frmMain', function () {
         formClick = $(this);
          $('#modal-default').modal('show');
          return false;
        });
        $(document).on('click', '#btnYes', function () {
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
              url: "back_article-deletemulti.php",
              data: $("#frmMain").serialize(),
              success: function(data) { 
                  fetch_data_article();
              },
           });
        });
        //---------------------------------------Send value to edit ---------------------------------------------------------------------------------
        $(document).on('click', '.edit-article', function(){
            var id = $(this).attr('data-id'); 
            location.href = "front-edit.php?id="+id;
        });
    });
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
