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
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
<style type="text/css">
  /*.img{
    width: 443px*/
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
        จัดการข้อมูลส่วนกลาง
      </h1>
      <ol class="breadcrumb">
        <li><a href="../page_home/index.php"></i> <?=lang('แดชบอร์ด','Dashboard')?></a></li>
        
        <li class="active">จัดการข้อมูลส่วนกลาง</li>
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
                <h4 class="modal-title"><i class="fa fa-warning">&nbsp;&nbsp;</i><?=lang('เสร็จสิ้น','Success')?></h4>
              </div>
              <div class="modal-body">
                <center><h4><?=lang('บันทึกข้อมูลส่วนกลางเรียบร้อยแล้ว','')?></h4></center>
              </div>
              <div class="modal-footer">
                <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?=lang('เพิ่มเนื้อหาต่อ..','Add more content ..')?></button> -->
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
                      <?php 
 $arr_setting =['name_company','titel','heading','mate_description','open_groph_titel','open_groph_description','name_company_en','titel_en','heading_en','mate_description_en','open_groph_titel_en','open_groph_description_en','toe_touch','porttial_weight','ful_weight','pic_logo','pic_header', 'merchantid','googlelogintoken','facebooklogintoken'];
for ($i=0; $i < count($arr_setting) ; $i++) { 
           $strSQL = "SELECT * FROM `contact` WHERE `setting` ='".$arr_setting[$i]."'";
           $objQuery = mysqli_query($objConnect,$strSQL) or die (mysqli_error());
           $objResult = mysqli_fetch_array($objQuery);
           $data_value[$i] = $objResult["value"];
           $data_id[$i] = $objResult["id"];
  
}      
?> 
<input type="hidden" name="name_setting" value="name_company,titel,heading,mate_description,open_groph_titel,open_groph_description,name_company_en,titel_en,heading_en,mate_description_en,open_groph_titel_en,open_groph_description_en,toe_touch,porttial_weight,ful_weight,pic_logo,pic_header,merchantid,googlelogintoken,facebooklogintoken">
                <div class="col-lg-12 col-md-12 col-sm-12" >
                    <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="box box-success box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">จัดการข้อมูลส่วนกลาง</h3>
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
                        <label for="" class="control-label">ชื่อบริษัท</label>
                      
                          <input type="text" class="form-control " id="name_company" name="name_company"   placeholder="ชื่อบริษัท TH" value="<?php echo $data_value[0] ?>">
                        
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">Titel</label>
                     
                          <input type="text" class="form-control " id="titel" name="titel"   placeholder="Titel TH" value="<?php echo $data_value[1] ?>">
                        
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">Heading</label>
                      
                          <input type="text" class="form-control " id="heading" name="heading"   placeholder="Heading TH" value="<?php echo $data_value[2] ?>">
                        
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">Mate description</label>
                       
                          <input type="text" class="form-control " id="mate_description" name="mate_description"   placeholder="Mate description TH" value="<?php echo $data_value[3] ?>">
                        
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">open groph titel</label>
                      
                          <input type="text" class="form-control " id="open_groph_titel" name="open_groph_titel"   placeholder="open groph titel TH" value="<?php echo $data_value[4] ?>">
                        
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">open groph description</label>
                      
                          <input type="text" class="form-control " id="open_groph_description" name="open_groph_description"   placeholder="open groph description TH" value="<?php echo $data_value[5] ?>">
                        
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">Merchant ID</label>
                      
                          <input type="text" class="form-control " id="merchantid" name="merchantid"   placeholder="Merchant ID" value="<?php echo $data_value[17] ?>">
                        
                    </div>


                    <div class="form-group">
                        <label for="" class="control-label">Facebook Longin Token</label>
                      
                          <input type="text" class="form-control " id="facebooklogintoken" name="facebooklogintoken"   placeholder="Merchant ID" value="<?php echo $data_value[19] ?>">
                        
                    </div>


                    <div class="form-group">
                        <label for="" class="control-label">Google Longin Token (client)</label>
                      
                          <input type="text" class="form-control " id="googlelogintoken" name="googlelogintoken"   placeholder="Merchant ID" value="<?php echo $data_value[18] ?>">
                        
                    </div>
                  
                </div>
                <div class="tab-pane" id="english">
                                      <div class="form-group">
                        <label for="" class="control-label">ชื่อบริษัท</label>
                     
                          <input type="text" class="form-control " id="name_company_en" name="name_company_en"   placeholder="ชื่อบริษัท EN" value="<?php echo $data_value[6] ?>">
                        
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">Titel</label>
                      
                          <input type="text" class="form-control " id="titel_en" name="titel_en"   placeholder="Titel EN" value="<?php echo $data_value[7] ?>">
                        
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">Heading</label>
                      
                          <input type="text" class="form-control " id="heading_en" name="heading_en"   placeholder="Heading EN" value="<?php echo $data_value[8] ?>">
                        
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">Mate description</label>
                      
                          <input type="text" class="form-control " id="mate_description_en" name="mate_description_en"   placeholder="Mate description EN" value="<?php echo $data_value[9] ?>">
                        
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">open groph titel</label>
                      
                          <input type="text" class="form-control " id="open_groph_titel_en" name="open_groph_titel_en"   placeholder="open groph titel EN" value="<?php echo $data_value[10] ?>">
                        
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">open groph description</label>
                      
                          <input type="text" class="form-control " id="open_groph_description_en" name="open_groph_description_en"   placeholder="open groph description EN" value="<?php echo $data_value[11] ?>">
                        
                    </div>
                     
                </div>
              </div>
            </div>

            <div class="box-body" >
                               
               <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="box box-success box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Walking Training</h3>
                                </div>
                                <div class="box-body" >
                    <div class="form-group">
                        <label for="" class="col-md-3 control-label">Toe touch</label>
                        <div class="col-md-6">
                          <input type="number" class="form-control " id="toe_touch" name="toe_touch" value="<?php echo $data_value[12] ?>"> 
                        </div>% BW ที่ fore foot
                       
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-3 control-label">Porttial weight</label>
                        <div class="col-md-6">
                          <input type="number" class="form-control " id="porttial_weight" name="porttial_weight" value="<?php echo $data_value[13] ?>"> 
                        </div>% BW ที่ fore foot + Mid heel
                      
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-3 control-label">Ful weight</label>
                        <div class="col-md-6">
                          <input type="number" class="form-control " id="ful_weight" name="ful_weight" value="<?php echo $data_value[14] ?>"> 
                        </div>% BW ที่ fore foot
                       
                    </div>
                                </div>
                            </div>
            </div>
                  
                </div>
           
              
              </div>
            </div>
            


                 <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="box box-success box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">รูปภาพหน้าปก</h3>
                                </div>
                                <div class="box-body" >
                                   <div class="input-group">
                                            <span class="input-group-btn">
                                                <span class="btn btn-default btn-file">
                                                    โลโก้ <input type="file" id="imgInp0" accept="image/jpeg,image/png" name="pic0" OnChange="Preview1(this)">
                                                </span>
                                            </span>
                                        <input type="text" class="form-control" name="pic_logo" value="<?php echo $data_value[15] ?>"  readonly>

                                    </div>
                                    <?php 
                                    if ($data_value[15]!='') {
                                      $img = "../../uploads/mod_central_information/".$data_value[15];
                                    }else{
                                      $img = "";
                                    }
                                    if ($data_value[16]!='') {
                                      $img1 = "../../uploads/mod_central_information/".$data_value[16];
                                    }else{
                                      $img1 = "";
                                    }
                                    ?>

                                     <img id='img-upload' class="img-responsive" src="<?php echo $img ?>" />
<br>
                                     <div class="input-group">
                                            <span class="input-group-btn">
                                                <span class="btn btn-default btn-file">
                                                    รูปภาพบน header <input type="file" id="imgInp2" accept="image/jpeg,image/png" name="pic2" OnChange="Preview(this)">
                                                </span>
                                            </span>
                                        <input type="text" class="form-control" name="pic_header" value="<?php echo $data_value[16] ?>"   readonly>

                                    </div>
                                     <img id='img-upload2' class="img-responsive" src="<?php echo $img1 ?>" />
                                     <input type="hidden" name="pic_logo_ed" value="<?php echo $data_value[15] ?>">
                                     <input type="hidden" name="pic_header_ed" value="<?php echo $data_value[16] ?>">

                               
                 
                   
                  
                </div>
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
                  <center><img src="../img/warning.png" width="60" height="60"><h5><?=lang('การเคลียร์หน้าจะเป็นการล้างหน้าจอรวมถึงเนื้อหาจะถูกล้างไปด้วย','Clearing the add page will clear the screen including  content will be cleared as well.')?></h5></center>
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
 function Preview(ele) {
            // $('#img-upload2').attr('src', ele.value);
                if (ele.files && ele.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#img-upload2').attr('src', e.target.result);
                }

                reader.readAsDataURL(ele.files[0]);
              
            }
        }
         function Preview1(ele) {
            // $('#img-upload2').attr('src', ele.value);
                if (ele.files && ele.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#img-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(ele.files[0]);
              
            }
        }
      $(document).ready(function(){
       
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
                      // $('#img-upload').attr('src', 'img/upload.jpg');
                  },
              });
          });
        $(document).on('click', '#btnYes', function (){
          location.href = "front-manage.php";
        })
      });
       
      //----------------------------------------------Check length for open button save---------------------------------------------------------
      checklength();
      function checklength() {
        var input = document.getElementById("name_company") ;

                if(input.value.length > 0)
                {
                  document.getElementById("btnSendAdd").disabled = false;
                }else{
                  document.getElementById("btnSendAdd").disabled = true;
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
 $(document).on('change', '#name_company', function (){
    // var topic = $('#name_company').val();
    // $('#name_company_en').val(topic); 
    checklength();
    
 })
 // $(document).on('change', '#titel', function (){
 //    var titel = $('#titel').val();
 //    $('#titel_en').val(titel); 
    
 // })
 // $(document).on('change', '#description', function (){
 //    var description = $('#description').val();
 //    $('#description_en').val(description); 
    
 // })
 // $(document).on('change', '#editor', function (){
 //    var editor = $('#editor').val();
 //    $('#editor_en').val(editor); 
    
 // })

</script>
</body>
</html>
