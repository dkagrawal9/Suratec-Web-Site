
 <?php
require_once '../library/connect.php';
require_once '../library/functions.php';
 //include "condb.php";

 $get_id = $_GET['id_da'];
?> 
<style>
alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
  opacity: 1;
  transition: opacity 0.6s;
  margin-bottom: 15px;
}
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
<link href="../page_froala/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css">          
 <?php
     $sql_team = "SELECT slide.name_slide,slide.name_slide_en,slide.text_en,slide.id_slide,slide.level ,slide_image.name_image, slide.text, slide.date 
FROM slide LEFT JOIN slide_image ON slide.id_slide = slide_image.id_slide 

WHERE slide.id_slide= '$get_id'";
 $query_team = mysqli_query($objConnect, $sql_team);
 $i = 1 ;
 while ($result_ream = mysqli_fetch_array($query_team)) {
   $name_slide =$result_ream["name_slide"];
   $name_slide_en =$result_ream["name_slide_en"];
   $text =$result_ream["text"];
   $text_en =$result_ream["text_en"];
   $name_image =$result_ream["name_image"];
   $id_slide =$result_ream["id_slide"];
   
  if ($name_image = '') {
    $name_image = 'components/up_pre/upload.jpg';
  }else{
    $name_image = '../../uploads/slide/'.$result_ream["name_image"];
  }

 }      
//   $query1 = "SELECT CONCAT(mod_employee.username,' ',mod_employee.surname) AS name FROM `team_member` 
// LEFT JOIN mod_employee ON mod_employee.id_employee=team_member.employee_id
// WHERE team_member.team_id='$get_id' AND team_member.del_flg = '0'"; 
//  $result1 = mysqli_query($objConnect, $query1);
?>
<div class="alert alert-success alert-dismissible" id="result" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <div id="loader_edit">
                    <h4><i class="fa fa-circle-o-notch fa-spin"></i></h4>
                    กำลังแก้ไข...
                </div>
                <div id="success_edit">
                    <h4><i class="icon fa fa-check"></i> สำเร็จ!</h4>
                    แก้ไขเรียบร้อยแล้ว.
                </div>
            </div>
  <form action="" method="post" name="frmEDIT" id="frmEDIT" enctype="multipart/form-data" class="upload-form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">แก้ไขสไลด์</h4>
                </div>
                <div class="modal-body">
                    <!-- Hidden Zone -->
                    <input type="hidden" name="id_slide" id="id_slide" value="<?php echo $id_slide ?>">
                    
                        <div class="col-md-12" style="padding: 20px">
                       
                        </div>
                        <br><br>
                        <div style="width: 200px; padding-bottom: 10px;">
                        <img  style="width: 200px" id="img" src="<?php echo $name_image ?>"/>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" readonly>
                        <span class="input-group-btn">
                    <span class="btn btn-default btn-file" style="background-color: white !important;">
                      <i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;&nbsp;เลือกรูปภาพ <input type='file' accept="image/*" onchange="Preview(this);" name="image_slide" id="file_edit" class="file_edit"/>
                    </span> 
                  </span>
                    </div>
                    <br>
                        <p>*รูปภาพควรมีขนาดประมาณ 1287 X 483 Pixels (กว้าง X สูง )</p>
                    <div class="nav-tabs-custom" style="box-shadow: none; margin-top: 10px;">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#thai_edit" data-toggle="tab" aria-expanded="true">
                                    <img class="flag-lang" src="../img/th-fl.png" width="22" height="15">
                                    ภาษาไทย
                                </a>
                            </li>
                            <li>
                                <a href="#english_edit" data-toggle="tab" aria-expanded="false">
                                    <img class="flag-lang" src="../img/th-fl.png" width="22" height="15">
                                    ภาษาอังกฤษ
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" style="padding: 0">
                            <div class="tab-pane active" id="thai_edit">
                                <!-- <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-header"></i></span>
                                    <input type="text" name="name_slide" id="name_slide" class="form-control" placeholder="หัวข้อสไลด์ ภาษาไทย" value="<?php echo  $name_slide ?>">
                                </div> -->
                                 <div class="input-group">
                                            <span class="input-group-addon">ชื่อหัวข้อ</span>
                                            <input type="text" name="name_edit" class="form-control" placeholder="ชื่อหัวข้อ" id="name_edit" onkeyup="checklength_edit();" value="<?php echo  $name_slide ?>">
                                        </div>
                                <div style="padding: 10px 0px 7px 0px;">
                                    <label>เนื้อหา</label>
                                    <textarea class="form-control edit" rows="5" style="resize: none;" name="content_slide" id="content_slide"><?php echo  $text ?></textarea>
                                </div>
                            </div>
                            <div class="tab-pane" id="english_edit">
                                <!-- <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-header"></i></span>
                                    <input type="text" name="name_slide_en" id="name_slide_en" class="form-control" placeholder="หัวข้อสไลด์ ภาษาอังกฤษ" value="<?php echo  $name_slide_en ?>" >
                                </div> -->
                                 <div class="input-group">
                                            <span class="input-group-addon">ชื่อหัวข้อ</span>
                                            <input type="text" name="name_en_edit" class="form-control" placeholder="ชื่อหัวข้อ" id="name_en_edit" onkeyup="checklength_edit();" value="<?php echo  $name_slide_en ?>">
                                        </div>
                                <div style="padding: 10px 0px 7px 0px;">
                                    <label>เนื้อหา</label>
                                    <textarea class="form-control edit" rows="5" style="resize: none;" name="content_slide_en" id="content_slide_en"><?php echo $text_en ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- !end of nav bar custom -->
                </div>
                <!--/.modal-body-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btnSendno" data-dismiss="modal">
                        ยกเลิก
                    </button>
                    <button type="button" class="btn btn-primary btnSendEdit" id="btnSendEdit" disabled="false">
                        <i class="fa fa-check"></i>&nbsp;บันทึก
                    </button>
                </div>
                <!--/.modal-footer-->
            </div>
            <!-- /.modal-content -->
        </form>
</div>
 <!-- <div class = "modal-footer">
            <button type = "button" class = "btn btn-default" data-dismiss = "modal">
               ปิด
            </button>
         </div> -->
</div>
</div>
</div>
<script type="text/javascript" src="../page_froala/js/froala_editor.pkgd.min.js"></script>
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
           })
    //       .on('froalaEditor.image.removed', function (e, editor, $img) {

    //     $.ajax({

    //             // Request method.
    //             method: "POST",
    //             // Request URL.
    //             url: "froala_delete_image.php",
    //             // Request params.
    //             data: {
    //                 src: $img.attr('src')
    //             }

    //         })

    //         .done(function (data) {
    //             console.log($img)
    //         })
    //         .fail(function () {
    //             console.log('image delete problem')
    //         })
    // })
          ;
      });
    </script>
    <script type="text/javascript">
      
        function Preview(ele) {
            $('#img').attr('src', ele.value);
                if (ele.files && ele.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#img').attr('src', e.target.result);
                }

                reader.readAsDataURL(ele.files[0]);
              
            }
        }
        $('#slide_catagory_edit').selectpicker();

         function checklength_edit() {
        var input = document.getElementById("name_edit") ;
                if(input.value.length > 0)
                {
                   // var value = input.value;
                   // input.value = value.slice(0,10);
                    document.getElementById("btnSendEdit").disabled = false;
                    //alert(value) ;

                }else{
                  document.getElementById("btnSendEdit").disabled = true;
                  //alert("value = 0");
                }
        }
checklength_edit();
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>