<?php 
  require_once '../library/connect.php';
  require_once '../library/functions.php';
  checkAdminUser($objConnect);

  $title = "ถาม - ตอบ";
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
    <!-- Ionicons -->
    <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
    <!-- daterange picker -->
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" type="text/css" href="css/up_pre.css">
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <!-- Pace style -->
    <link rel="stylesheet" href="../plugins/pace/pace.min.css">
    <!--Css table -->
    <link rel="stylesheet" href="css/app.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="../plugins/sweetalert2/dist/sweetalert2.min.css">
     <!-- address thailande -->
   <!--  <link rel="stylesheet" href="js/jquery.Thailand.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>      
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
          <link rel="stylesheet" href="css/ui-bootstrap-csp.css">
 
</head>
<style>        
            tr{cursor: pointer}
            
            .selected{background-color: #CCFFFF; }

            
    
        </style>
        <style type="text/css">             
@media screen  and (max-height:479px){  /* 0px - 479px */
 #div_table1{
overflow: auto;
 }
}
</style>
<body class="hold-transition skin-blue sidebar-mini fixed" onload="startTime()">
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
        <li><a href="../page_home/index.php"></i> <?=lang('แดชบอร์ด','Dashboard')?></a></li>
        <!-- <li><a href="front-manage.php"></i> เพิ่มหน้าเสริม</a></li> -->
        <li class="active"><?=$title?></li>
      </ol>
    </section>
    <section class="content">
    <!-- Main content -->
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

     <!--  <div class="alert alert-success alert-dismissible" id="result_add" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <div id="loader_add">
              <h4><i class="fa fa-circle-o-notch fa-spin"></i></h4>
              Inserting...
            </div>
            <div id="success_add">
              <h4><i class="icon fa fa-check"></i> Increase!</h4>
              Increase data successful.
            </div>
          </div> -->

      <!-- <div class="modal fade" id="modal-default">
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
           
          </div>
         
        </div> -->
        <!-- /.modal -->

       <div class="row">
              
                <div class="col-lg-12 col-md-12 col-sm-12" >
                    <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="box box-info box-solid">
                                <div class="box-header with-border">
                                  <div class="col-sm-6" align="left">
                                    <h3 class="box-title" ><?=$title?></h3>
                                  </div>
                                  <div class="col-sm-6" align="right">
                                    <button style="display: <?php echo $button_open ?>;" class="btn btn-success" onclick="add_row()"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มคำถาม</button>
                                  </div>
                                    
                                    
                                </div>
                                <div class="box-body" >
                                    <div class="form-horizontal">
                           
                  <div class="form-group"  >
                     <div class="col-sm-12"  id="div_table" >

                        
                     </div>
                  </div>
                  





</div></div></div></div></div></div>


        
        <!-- /.row -->
        <div class="boxsave" >
          <img onclick="upNdown('up');" src="img/arrow-up.png" style="width:  20px"><img onclick="upNdown('down');" src="img/arrow-down.png" style="width:  20px">
          <button style="<?php echo $button_open ?>" type="button" class="btn btn-success pull-right btnSendAdd" id="btnSendAdd"  style="transition: 0.4s; margin-left: 5px;"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;<?=lang('บันทึก','Save')?></button>
         <!--  <button type="button" class="btn btn-default pull-right btnSendClear" id="btnSendClear"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;<?=lang('เคลียร์','Clear')?></button> -->
      </div>
        <!-- /.box --> 
    
<input type="hidden" name="per_button_edit" id="per_button_edit" value="<?php echo $button_edit ?>">
<input type="hidden" name="per_button_del" id="per_button_del" value="<?php echo $button_del ?>">
<input type="hidden" name="per_button_open" id="per_button_open" value="<?php echo $button_open ?>">
<input type="hidden" name="per_input_read" id="per_input_read" value="<?php echo $input_read ?>">
      <!-- /.form send to DB-->
     
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
<!-- Bootstrap 3.3.7 -->
<!-- <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script> -->
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<script src="js/timer.js"></script>


<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- date-range-picker -->
<script src="../bower_components/moment/min/moment-with-locales.min.js"></script>

<!-- thailand -->
<!-- <script src="js/jquery.Thailand.min.js"></script>
<script src="js/JQL.min.js"></script>
<script src="js/typeahead.bundle.js"></script>
<script src="js/zip.js"></script> -->
<!-- PACE -->
<script src="../bower_components/PACE/pace.min.js"></script>


<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script src="../plugins/sweetalert2/dist/sweetalert2.min.js"></script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> -->
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
 
function add_row() {
  var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
    var table = document.getElementById("table");
    count_rows = table.getElementsByTagName("tr").length;
    var row = table.insertRow(count_rows);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);

    cell1.innerHTML = ""+count_rows+"<input type='hidden' name='id_faq[]' class='form-control' id='id_faq'"+count_rows+" autocomplete='off'  value='*'>";

    // cell2.innerHTML = "<textarea type='text' name='ask[]' class='form-control' id='ask'"+count_rows+" style='width: 100%''></textarea>";

    cell2.innerHTML = '<div class="input-group"><div class="input-group-addon"><img src="../img/th-fl.png" width="30" >                                </div><textarea type="text" name="ask[]" class="form-control" id="ask'+count_rows+'" style="width: 100%" rows="5"></textarea></div> <div class="input-group"> <div class="input-group-addon"><img src="../img/en-fl.jpg" width="30"> </div> <textarea type="text" name="ask_en[]" class="form-control" id="ask_en'+count_rows+'" style="width: 100%" rows="5"></textarea></div>';

    cell3.innerHTML = '<div class="input-group"><div class="input-group-addon"><img src="../img/th-fl.png" width="30" >                                </div><textarea type="text" name="answer[]" class="form-control" id="answer'+count_rows+'" style="width: 100%" rows="5"></textarea></div> <div class="input-group"> <div class="input-group-addon"><img src="../img/en-fl.jpg" width="30"> </div> <textarea type="text" name="answer_en[]" class="form-control" id="answer_en'+count_rows+'" style="width: 100%" rows="5"></textarea></div>';
    
    //cell3.innerHTML = "<textarea type='text' name='answer[]' class='form-control' id='answer'"+count_rows+" style='width: 100%''></textarea>";
    cell4.innerHTML = "<button style='background-color: white; display:"+button_del+"' type='button' class='edit-catagory btn btn-default' data-id='*' onclick='del_row(this)'> <i class='fa fa-fw fa-trash'></i></button>";

    getSelectedRow();
}


// function del_row(){
//     var table = document.getElementById("myTable");
//     count_rows = table.getElementsByTagName("tr").length;
//     document.getElementById("myTable").deleteRow(count_rows-1);
// }
function del_row(r){
  //if ($('#id_faq').val() != '*') {
    var i = r.parentNode.parentNode.rowIndex;
 
    id_faq = $('#id_faq'+i).val();
     // var id_faq = $(this).attr('data-id');
            

Swal.fire({
  title: 'คำเตื่อน ?',
  text: "คุณต้องการลบคำถาม - ตอบ นี้ !"+id_faq,
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'ใช่, ต้องการลบ !'
}).then((result) => {
  if (result.value) {
    $.ajax({
    method:'POST', 
    url:'function.php?id_faq='+id_faq, 
    data:{_method:'DEL'},  
    // processData: false,
    // contentType: false,
    success: function(data) {
    if(data.status==1){
    Swal.fire('สำเร็จ','ลบคำถาม - ตอบ เรียบร้อย','success').then(function(){ 
    window.location = "";

    })
 
    }
},
});
    var data = {
  sum_total_price: $('#numsum').val(),
    sum_total_cost: $('#total_cost').val(),
  } ;
     var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("table").deleteRow(i);
}
 

});

 // }
  //    else{
  //      var data = {
  // sum_total_price: $('#numsum').val(),
  //   sum_total_cost: $('#total_cost').val(),
  // } ;
  //    var i = r.parentNode.parentNode.rowIndex;
  //   document.getElementById("table").deleteRow(i);
  //    }
  


                //  result1 = parseInt(data.sum_total_cost);

                // document.getElementById('total_cost').value=result1-1;
    del_row1();           
}
function del_row1(){
  var table = document.getElementById("table");
                for(var i = 1; i < table.rows.length; i++)
                {
                    table.rows[i].onclick = function()
                    {
                        // clear the selected from the previous selected row
                        // the first time index is undefined
                        if(typeof index !== "undefined"){
                            //table.rows[index].classList.toggle("selected");
                        }
                       
                        index = this.rowIndex;
                        this.classList.toggle("selected");


                    };
                }
  }
</script>
        
        <script>
            
            // var index;  // variable to set the selected row index
            // function getSelectedRow()
            // {

            //     var table = document.getElementById("table");
            //     for(var i = 1; i < table.rows.length; i++)
            //     {
            //         table.rows[i].onclick = function()
            //         {
            //             // clear the selected from the previous selected row
            //             // the first time index is undefined
            //             if(typeof index !== "undefined"){
            //                 table.rows[index].classList.toggle("selected");
            //             }
                       
            //             index = this.rowIndex;
            //             this.classList.toggle("selected");


            //         };
            //     }
                    
            // }
  

            // getSelectedRow();
            
            
            // function upNdown(direction)
            // {
            //     var rows = document.getElementById("table").rows,
            //         parent = rows[index].parentNode;
            //      if(direction === "up")
            //      {
            //          if(index > 1){
            //             parent.insertBefore(rows[index],rows[index - 1]);
            //             // when the row go up the index will be equal to index - 1
            //             index--;
            //         }
            //      }
                 
            //      if(direction === "down")
            //      {
            //          if(index < rows.length -1){
            //             parent.insertBefore(rows[index + 1],rows[index]);
            //             // when the row go down the index will be equal to index + 1
            //             index++;
            //         }
            //      }
            // }

            
          //    $(document).on('click', '.btnSendAdd', function(){ 
          // var formData = new FormData($('.upload-form-add')[0]);
           
          //     $.ajax({
          //         beforeSend: function() {
          //           // setting a timeout
          //           $('#result_add').show();
          //           $('#success_add').hide();
          //           $('#loader_add').show();
          //         },
          //         complete: function() {
          //             $('#loader_add').hide();
          //             $('#success_add').show();  
          //             setTimeout(function(){$("#result_add").hide(0)}, 10000);
          //             $('#modal-default').modal('show');

          //         },
          //          type: "POST",
          //          url: "back_article-add.php",
          //          data: formData,
          //          processData: false,
          //          contentType: false,
          //          success: function(data) {
          //           console.log(data);
          //           // alert(data);
          //             // document.getElementById('upload-form-add').reset();
          //             $('#img-upload').attr('src', 'img/upload.jpg');
          //         },
          //     });
          // });

 $(document).ready(function(){
        //---------------------------------------fetch Slide for refresh ajax-----------------------------------------------
        function fetch_data_slide(page)  
          {  
             var button_edit = $('#per_button_edit').val();
          var button_del = $('#per_button_del').val();
          var button_open = $('#per_button_open').val();
          var input_read = $('#per_input_read').val();
             //var id_icon = $('#id_icon').val();
              $.ajax({  
                  url:"select_table.php?do=select_table_icon",  
                  method:"POST",  
                  // data:{page:page},
                  data:{button_edit:button_edit,button_del:button_del,button_open :button_open,input_read:input_read},
                  success:function(data){  
              $('#div_table').html(data);  
              //$('#table').DataTable();
              
                  }  
              });  
          }  
          fetch_data_slide();
       

          $(document).on('click', '.btnSendAdd', function(){ 
          var formData = new FormData($('.upload-form-add')[0]);
          
          swal({
            title: 'ยืนยัน?',
            text: "ยืนยันการบันทึกหรือไม่?",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน!',
            showLoaderOnConfirm: true,
            preConfirm: function () {
            return new Promise(function (resolve) {
            $.ajax({
            type: "POST",
            url: "back_article-add.php",
            data: formData,
            processData: false,
            contentType: false
                  })

// in case of successfully understood ajax response
            .done(function (myAjaxJsonResponse) {
            console.log(myAjaxJsonResponse);
  swal({
            title: 'สำเร็จ',
            text: "บันทึกเรียบร้อยแล้ว?",
            type: 'success',
      
            confirmButtonColor: '#3085d6',
          
            confirmButtonText: 'ยืนยัน!',
            showLoaderOnConfirm: true,
            
      })
  fetch_data_slide();
            })
            .fail(function (erordata) {
// คือไม่สำรเ็จ
            console.log(erordata);
            swal('ไม่สำเร็จ', 'เกิดปัญหากับระบบ', 'error');
            })

          }) 
        }, 

      })
         
    }); 
 })
        </script>

</body>
</html>
