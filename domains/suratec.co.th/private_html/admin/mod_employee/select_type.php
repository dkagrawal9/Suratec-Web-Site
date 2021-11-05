<?php
 require_once '../library/connect.php';    
if(isset($_POST['_method'])){
		if($_POST['_method']=='manage_type'){
			manage_type();
			exit;
		}elseif($_POST['_method']=='edit'){
			edit();
			exit;
		}
	}else{
		if($_GET['_method']=='select_edit_type'){
			select_edit_type();
			exit;
		}
		if($_GET['_method']=='select_show_type'){
			select_show_type();
			exit;
		}
	}

	function manage_type(){
			global $objConnect;
			global $date;
$button_edit  = $_POST["button_edit"];
$button_del  = $_POST["button_del"];
$button_open   = $_POST["button_open"];
$input_read   = $_POST["input_read"];

 
 // header('Content-Type: application/json');
  ?>
 <div class="modal-body">

        
         
                    <div class="row">
                    	<div class="col-md-6" id="div_edit_type" style="display: none;">

                    	</div>
                        <div class="col-md-6" id="div_add_type">
                        	<form action="" method="post" id="frm_add_type">
          <input type="hidden" name="form" id="form" value="CREATE_type">
                            <div class="box box-success box-solid">
                                 <div class="box-header with-border">
                                    <h3 class="box-title">เพิ่ม</h3>
                                </div>
                                <div class="box-body" >
                                    <div class="form-horizontal">
                                        <div class="box-body">
                                            
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ประเภทผู้ใช้งาน</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control"  name="name" id="name">
                                                </div>
                                            </div>
                                              <div class="form-group" >
                                                <table>
                                                	<thead>
                                                		<th>ฟังก์ชั่นการทำงาน</th>
                                                		<th>สิทธ์การใช้งาน</th>
                                                	</thead>
                                                	<tbody>
    <?php
      $str = "SELECT `id_system`,`name_system` FROM `system` WHERE 1";
$i=0;
	$query = mysqli_query($objConnect,$str);
	while ($result = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
		
    ?>
                                                		<tr>
                                                			<td><?php echo $result["name_system"] ?></td>
                                                			<td><input type="checkbox" class="checkbox_remove1 minimal-red" name="Chk<?php echo $i ?>" id="Chk1" value="<?php echo $result["id_system"] ?>"></td>
                                                		</tr>
    <?php $i++; } ?>
                                                	</tbody>
                                                </table>
                                            </div>
                                           
                                         </div>
                                    </div>
                                    <div class="col-sm-12" align="right">
                           	<button  type="button" name="add_type" id="add_type" class="btn btn-info    confirm_btn"  ><i class="fa fa-check-square-o" aria-hidden="true"></i> บันทึก </button>
                           </div>
                                
                                </div>
                            </div>
                        </div>
                    </form>


                             <div class="col-md-6">
                            <div class="box box-primary box-solid">
                                 <div class="box-header with-border">
                                    <h3 class="box-title">รายการประเภทผู้ใช้งาน</h3>
                                </div>
                                <div class="box-body" >
                                    <div class="form-horizontal">
                                        <div class="box-body">
                                            
                                            
                                              <div class="form-group" style="overflow: auto;">
                                                <table class="table" id="table_type">
                                                	<thead>
                                                		<th>ชื่อประเภท</th>
                                                		<th>ควบคุม</th>
                                                	</thead>
                                                	<tbody>
    <?php
      $str = "SELECT `role_id`,`role_name` FROM `role` WHERE 1";

	$query = mysqli_query($objConnect,$str);
	while ($result = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
		
    ?>
                                                		<tr>
                                                			<td><?php echo $result["role_name"] ?></td>
                                                			<td>

<button style="<?php echo $button_edit ?>" type="button" class="btn btn-warning" id="btnEdit_icon" data-id="<?php echo $result["role_id"] ?>"  >
                        <i class="fa fa-edit"></i>
 </button>

 <button style="<?php echo $input_read ?>" type="button" class="btn btn-info" id="btn_show_type" data-id="<?php echo $result["role_id"] ?>"  >
                        <i class="fa fa-fw fa-eye"></i>
 </button>

<button type="button" style="<?php echo $button_del ?> "  class="delete-type btn btn-danger" data-id= "<?php echo $result["role_id"] ?>"><i class="fa fa-fw fa-trash"></i></button>

                                                			</td>
                                                		</tr>
    <?php } ?>
                                                	</tbody>
                                                </table>
                                            </div>
                                           
                                         </div>
                                    </div>
                                </div>
                                                        
                               
                            </div>
                        </div>
                    </div> 




<!-- Modal body -->
<br>&nbsp;&nbsp;&nbsp;&nbsp;<br>
      </div>
     <div class="modal-footer"  >
              
     
           
            <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
          
      <!-- <button type="button" class="btn btn-success  add_number_parcel_btn" name="" id="">บันทึก</button> -->
        
      </div>
       <script type="text/javascript">
         $('#table_type').DataTable();
      </script>
  <?php    }

  function select_edit_type(){  
  global $objConnect;
$button_edit  = $_POST["button_edit"];
$button_del  = $_POST["button_del"];
$button_open   = $_POST["button_open"];
$input_read   = $_POST["input_read"];
    $str1 = "SELECT * FROM `role` WHERE `role_id` = '".$_POST["id_edit"]."'";
    $query1 = mysqli_query($objConnect,$str1);
    $result1 = mysqli_fetch_array($query1);
?>
<form action="" method="post" id="frm_edit_type">
          <input type="hidden" name="form" id="form" value="edit_type">

                            <div class="box box-warning box-solid">
                                 <div class="box-header with-border">
                                    <h3 class="box-title">แก้ไข</h3>
                                </div>
                                <div class="box-body" >
                                    <div class="form-horizontal">
                                        <div class="box-body">
                                            
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ประเภทผู้ใช้งาน</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control"  name="name" id="name" value="<?php echo $result1["role_name"] ?>">
                                                    <input type="hidden" class="form-control"  name="role_id" id="role_id" value="<?php echo $result1["role_id"] ?>">
                                                </div>
                                            </div>
                                              <div class="form-group" >
                                                <table>
                                                	<thead>
                                                		<th>ฟังก์ชั่นการทำงาน</th>
                                                		<th>สิทธ์การใช้งาน</th>
                                                	</thead>
                                                	<tbody>
    <?php
    
	$rest = substr($result1["task_view"], 0, -1); 
	$arr_task_view = explode(",", $rest); 

	$rest1 = substr($result1["task_authen"], 0, -1); 
	$arr_task_authen = explode(",", $rest1); 

    $str = "SELECT `id_system`,`name_system` FROM `system` WHERE 1 ORDER BY id_system ASC";
$x=0;
	$query = mysqli_query($objConnect,$str);
	while ($result = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
		
    ?>
                                                		<tr>
                                                			<td><?php echo $result["name_system"] ?></td>
                                                			<td><input type="checkbox" class="checkbox_remove1 minimal-red" name="Chk<?php echo $x ?>" id="Chk1" value="<?php echo $result["id_system"] ?>"
                                                				<?php 
                                                				for ($i=0; $i < count($arr_task_authen); $i++) { 
                                                					if ($result["id_system"]==$arr_task_view[$i] && $arr_task_authen[$i]=='1') {
                                                						echo "checked";
                                                					}
                                                				}
                                                				 ?>
                                                				>
                                                			</td>
                                                		</tr>
    <?php $x++; } ?>
                                                	</tbody>
                                                </table>
                                                
                                            </div>
                                           
                                         </div>
<div class="col-sm-12" align="right">
    
    <button type="button" class="btn btn-warning"  id="btnsend_reset_add" ><i class="fa fa-fw fa-arrow-circle-left" ></i> ยกเลิก </button>

    <button  type="button" name="edit_type" id="edit_type" class="btn btn-info "  ><i class="fa fa-check-square-o" aria-hidden="true"></i> บันทึก </button>
</div>
                                    </div>
                                </div>
                                                        
                               
                            </div>
                        </form>
                    


  <?php
}
 function select_show_type(){  
  global $objConnect;
$button_edit  = $_POST["button_edit"];
$button_del  = $_POST["button_del"];
$button_open   = $_POST["button_open"];
$input_read   = $_POST["input_read"];
    $str1 = "SELECT * FROM `role` WHERE `role_id` = '".$_POST["id_edit"]."'";
    $query1 = mysqli_query($objConnect,$str1);
    $result1 = mysqli_fetch_array($query1);
?>
<form action="" method="post" id="frm_edit_type">
          <input type="hidden" name="form" id="form" value="edit_type">

                            <div class="box box-info box-solid">
                                 <div class="box-header with-border">
                                    <h3 class="box-title">รายละเอียด</h3>
                                </div>
                                <div class="box-body" >
                                    <div class="form-horizontal">
                                        <div class="box-body">
                                            
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ประเภทผู้ใช้งาน</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control"  name="name" id="name" value="<?php echo $result1["role_name"] ?>" disabled  >
                                                    <input type="hidden" class="form-control"  name="role_id" id="role_id" value="<?php echo $result1["role_id"] ?>">
                                                </div>
                                            </div>
                                              <div class="form-group" >
                                                <table>
                                                	<thead>
                                                		<th>ฟังก์ชั่นการทำงาน</th>
                                                		<th>สิทธ์การใช้งาน</th>
                                                	</thead>
                                                	<tbody>
     <?php
    
	$rest = substr($result1["task_view"], 0, -1); 
	$arr_task_view = explode(",", $rest); 

	$rest1 = substr($result1["task_authen"], 0, -1); 
	$arr_task_authen = explode(",", $rest1); 

    $str = "SELECT `id_system`,`name_system` FROM `system` WHERE 1 ORDER BY id_system ASC";
$i=0;
	$query = mysqli_query($objConnect,$str);
	while ($result = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
		
    ?>
                                                		<tr>
                                                			<td><?php echo $result["name_system"] ?></td>
                                                			<td><input disabled  type="checkbox" class="checkbox_remove1 minimal-red" name="Chk<?php echo $i ?>" id="Chk1" value="<?php echo $result["id_system"] ?>"
                                                				<?php 
                                                				for ($i=0; $i < count($arr_task_authen); $i++) { 
                                                					if ($result["id_system"]==$arr_task_view[$i] && $arr_task_authen[$i]=='1') {
                                                						echo "checked";
                                                					}
                                                				}
                                                				 ?>
                                                				>
                                                			</td>
                                                		</tr>
    <?php $i++; } ?>
                                                	</tbody>
                                                </table>
                                                
                                            </div>
                                           
                                         </div>
<div class="col-sm-12" align="right">
    
    <button type="button" class="btn btn-default"  id="btnsend_reset_add" ><i class="fa fa-fw fa-arrow-circle-left" ></i> ปิด </button>

   <!--  <button  type="button" name="edit_type" id="edit_type" class="btn btn-info "  ><i class="fa fa-check-square-o" aria-hidden="true"></i> บันทึก </button> -->
</div>
                                    </div>
                                </div>
                                                        
                               
                            </div>
                        </form>
                    


  <?php
}
	?>