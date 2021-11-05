<?php
require_once '../library/connect.php';
require_once '../library/functions.php';
checkAdminUser($objConnect);


if($_GET['do']=='select_Add_icon' && isset($_GET['do'])){
    select_Add_icon();

    exit;
}
if($_GET['do']=='select_table_icon' && isset($_GET['do'])){
  select_table_icon();

  exit;
}
if($_GET['do']=='select_edit_icon' && isset($_GET['do'])){
  select_edit_icon();

  exit;
}

?>
<?php
function select_table_icon(){ 

$button_edit  = $_POST["button_edit"];
$button_del  = $_POST["button_del"];
$button_open   = $_POST["button_open"];
$input_read   = $_POST["input_read"];
global $objConnect; 


 $strSQL = "SELECT * FROM `mod_footer` WHERE `del_flg` ='0'";
$query = mysqli_query($objConnect,$strSQL);



?>

 <table class="table" id="table_icon" >
                                <thead>
                                    <tr>
                                        
                                        <th>
                                            ไอคอน
                                        </th>
                                        <th>
                                            ชื่อ
                                        </th>
                                        <th>
                                            ส่วนเชื่อมโยง
                                        </th>
                                        <th>
                                            การจัดการ
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

<?php    
while ($result = mysqli_fetch_array($query)) {
    ?>


                              <tr>
                                <td>
                                  <?php  
                                  if ($result["icon"]=='') {
                                    $icon_image = "img/no_image.png";
                                  }else{
                                    $icon_image = "../../uploads/mod_manage_links/".$result["icon"] ;
                                  }
                                  ?>
                                  <img style="width: 30px; height: 30px" src="<?php echo $icon_image ?>"  >
                                
                                </td>
                                <td><?php echo $result["name"] ?></td>
                                <td ><?php echo $result["linked"] ?></td>
                                <td>
                   
                    
                    <button style="background-color: white; <?php echo $button_edit ?>" type="button" class="edit-catagory btn btn-default" id="btnEdit_icon" data-id="<?php echo $result['id_footer'] ?>"  >
                        <i class="fa fa-edit"></i>
                    </button>
                     
                    <!--  <button style="background-color: white;" type="button" class="btnshow-catagory btn btn-default" id="btnshow_icon" data-id="<?php echo $result['item_id'] ?>" >
                       <i class="fa fa-fw fa-eye"></i>
                    </button> -->
                    <button style="background-color: white; <?php echo $button_del ?>" type="button" class="edit-catagory btn btn-default" id="btndel_one_icon" data-id="<?php echo $result['id_footer'] ?>"  >
                      <i class="fa fa-fw fa-trash"></i>
                    </button>
                                </td>
                              </tr> 
<?php 
} ?>
                                 
                                </tbody>
                            </table>                         


<?php } 




function select_edit_icon(){  
  global $objConnect;
$button_edit  = $_POST["button_edit"];
$button_del  = $_POST["button_del"];
$button_open   = $_POST["button_open"];
$input_read   = $_POST["input_read"];
    $str1 = "SELECT * FROM `mod_footer` WHERE `id_footer` = '".$_POST["id_edit"]."'";
    $query1 = mysqli_query($objConnect,$str1);
    
    while($result1 = mysqli_fetch_array($query1)){
?>
     <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="box box-warning">
            <div class="box-header with-border">
               
                <h3 class="box-title"><?=lang('แก้ไขส่วนเชื่อมโยง','Edit Link')?></h3>
                <div align="right">
                                 <button type="button" class="btn btn-success"  id="btnsend_reset_add" style="<?php echo $button_open ?>"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่ม </button>
                                </div>
            </div>
            <div class="box-body" >
                <div class="form-horizontal">
                    <div class="box-body">
                    <div class="col-md-12" >
                    <!-- Start box warning for ADD system -->
                  
                    
 <form id="frmedit" enctype="multipart/form-data">
<input type="hidden" name="_method" value="edit_icon">
<input type="hidden" name="id_icon" value="<?php echo $_POST["id_edit"] ?>">
<!--  <input type="hidden" name="id_icon" id="id_icon" value="<?php echo $_GET["id"]  ?>"> -->
<!-- start form -->

<!-- start form -->

   <!--     $strSQL = "SELECT * FROM `icon_item` WHERE `del_flg` ='0' AND `item_id`='".$_GET["id"]."'";     -->  
   <?php  
                                  if ($result1["icon"]=='') {
                                    $icon_image = "img/no_image.png";
                                  }else{
                                    $icon_image = "../../uploads/mod_manage_links/".$result1["icon"] ;
                                  }
                                  
                                  ?>        
              
 <div class="box box-warning box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">รายละเอียด</h3>
                                </div>
                                <div class="box-body" >
                                    <div class="form-horizontal">
                                        <form id="frmData1">

                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ชื่อ</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="name_edit" id="name_edit" required value="<?php echo $result1["name"]?> "> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ลิงค์</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="link_edit" id="link_edit" required value="<?php echo $result1["linked"]?> "> 
                                                </div>
                                            </div>
                                                
                                            <div class="form-group">
                                     <label for="" class="col-sm-3 control-label"><?=lang('รูปไอคอน','รูปไอคอน')?></label>
                                    <div class="col-sm-8">
                                    <div class="col-sm-1" style="width: 150px; padding-bottom: 10px;">
                                        <img style="width: 30px; height: 30px;" id='img-upload' src="<?php echo $icon_image ?>" />
                                    </div>
                                     <div class="col-sm-7" style="width: 150px; padding-bottom: 10px;">
                                         <div class="input-group">
                                    
                                        <input type="text" class="form-control" readonly>
                                        <span class="input-group-btn">
                                            <span class="btn btn-default btn-file" style="background-color: white !important;">
                                              <i class="glyphicon glyphicon-folder-open"></i><input type="file" accept="image/*" id="imgInp" name="pic"  OnChange="Preview(this)">
                                              <input type="hidden" accept="" id="" name="pic_ed" value="<?php echo $result1['icon'] ?>">
                                            </span>
                                        </span>


                                    </div>
                                    
                                    </div>
                                    <div class="col-sm-12">
                                      คำแนะนำ: กรุณาเพิ่มไฟล์ขนาด 64x64 (พิกเซล)
                                    </div>
                                   
                                </div> 
                            </div>
                                            
                                    </div>
                                </div>
                            </div>
                         
                   
                   <!-- end form -->

                    
               
                    
               
                  
                </div></form>
          <div class="box-footer" align="center">
                    <button class="btn  btn-success" id="btnsend_reset_add"><i class="fa fa-arrow-left" aria-hidden="true"></i> <?=lang('ยกเลิก','Cancel')?></button> <button class="btn  btn-success" id="btnsend-edit"> <i class="fa fa-floppy-o" aria-hidden="true"></i> <?=lang('บันทึก','Save')?></button></div> 
           </div>
             </div>
         </div>
    </div>
</div></div></div>

<script type="text/javascript">
  function Preview(ele) {
            // $('#img-upload').attr('src', ele.value);
                if (ele.files && ele.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#img-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(ele.files[0]);
              
            }
        }
        
        </script>
<script type="text/javascript">



</script>
<?php } }



