
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
     $sql_team = "SELECT image_category.name_catagory,image_category.id_catagory, images.id_image,images.name_image,images.level FROM `images` LEFT JOIN image_category ON image_category.id_catagory = images.id_category 

WHERE images.id_image = '$get_id'";
 $query_team = mysqli_query($objConnect, $sql_team);
 $i = 1 ;
 while ($result_ream = mysqli_fetch_array($query_team)) {
   $id_catagory =$result_ream["id_catagory"];
   $id_image =$result_ream["id_image"];
   $name_image =$result_ream["name_image"];
   
  if ($name_image = '') {
    $name_image = 'components/up_pre/upload.jpg';
  }else{
    $name_image = '../../uploads/mod_image/'.$result_ream["name_image"];
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
                    <input type="hidden" name="id_image" id="id_image" value="<?php echo $id_image ?>">
                    
                           <div class="col-md-12" style="padding: 20px">
                            <label class="col-md-3">หัวข้อ</label>      
                        <div class="col-md-9">
                          <div class="box-detail-em">
                               
                              <select  class="form-control selectpicker" id="image_category_edit" name="image_category_edit" data-show-subtext="true" data-live-search="true">
                                <option value="0">หัวข้อ</option>
<?php
$str = "SELECT `id_catagory`,`name_catagory` FROM `image_category`";
$query = mysqli_query($objConnect,$str);
while ( $result = mysqli_fetch_array($query)) {
?>
                                <option value="<?php echo $result["id_catagory"] ?>" 
<?php
  if ($result["id_catagory"]==$id_catagory) {
     echo "selected";
   } 
?>
                                  ><?php echo $result["name_catagory"] ?></option>
<?php } ?>
                              </select>
                          </div>  

                        </div>
                         
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
                       <!--  <p>*รูปภาพควรมีขนาดประมาณ 1287 X 483 Pixels (กว้าง X สูง )</p> -->
                
                    <!-- !end of nav bar custom -->
                </div>
                <!--/.modal-body-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btnSendno" data-dismiss="modal">
                        ยกเลิก
                    </button>
                    <button type="button" class="btn btn-primary btnSendEdit" id="btnSendEdit" >
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
        $('#image_category_edit').selectpicker();

        //  function checklength_edit() {
        // var input = document.getElementById("name_edit") ;
        //         if(input.value.length > 0)
        //         {
        //            // var value = input.value;
        //            // input.value = value.slice(0,10);
        //             document.getElementById("btnSendEdit").disabled = false;
        //             //alert(value) ;

        //         }else{
        //           document.getElementById("btnSendEdit").disabled = true;
        //           //alert("value = 0");
        //         }
        // }
checklength_edit();
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>