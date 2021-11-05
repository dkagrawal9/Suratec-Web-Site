<?php
require_once '../library/connect.php';

	if(isset($_POST['_method'])){
		if($_POST['_method']=='CREATE'){
			CREATE();
			exit;
		}elseif($_POST['_method']=='edit'){
			edit();
			exit;
		}elseif($_POST['_method']=='DELETE'){
			DELETE();
			exit;
		}elseif($_POST['_method']=='add_customer'){
      		add_customer();
    		exit;
   	}elseif($_POST['_method']=='edit_customer'){
      		edit_customer();
    		exit;
   	}elseif($_POST['_method']=='show_customer'){
      		show_customer();
    		exit;
   	}elseif($_POST['_method']=='doCheckuser'){
          doCheckuser();
        exit;
    }elseif($_POST['_method']=='doCheckuser_edit'){
          doCheckuser_edit();
        exit;
    }
	}




function doCheckuser_edit(){
  global $objConnect;
    global $date;
  header('Content-Type: application/json');
  $str = "SELECT id_member,user_member FROM tbl_member WHERE user_member = '".$_POST['username']."'  AND tbl_member.id_member !='".$_GET['id_member']."'";
  $query = mysqli_query($objConnect,$str);
  $num_row = mysqli_num_rows($query);
  $fetch = mysqli_fetch_array($query);
  if($num_row>0){
    echo json_encode(array('status' => '0','message'=> $str));
  }else{
    echo json_encode(array('status' => '1','message'=> $str));
  }
}


function doCheckuser(){
  global $objConnect;
    global $date;
  header('Content-Type: application/json');
  $str = "SELECT id_member,user_member FROM tbl_member WHERE user_member = '".$_POST['username']."'";
  $query = mysqli_query($objConnect,$str);
  $num_row = mysqli_num_rows($query);
  $fetch = mysqli_fetch_array($query);
  if($num_row>0){
    echo json_encode(array('status' => '0','message'=> $str));
  }else{
    echo json_encode(array('status' => '1','message'=> $str));
  }
}

function show_customer(){
   global $objConnect;
		global $date;
 // header('Content-Type: application/json');
  $str = "SELECT
  	mod_customer.fname,
  	mod_customer.lname,
    mod_customer.telephone,
    mod_customer.email,
    mod_customer.id_customer,
    mod_customer.type AS type_cus,
	tbl_member.user_member,
	tbl_member.id_member
FROM
    `mod_customer`
LEFT JOIN tbl_member ON tbl_member.id_data_role = mod_customer.id_customer
WHERE
    mod_customer.id_customer = '".$_GET["id"]."'";

	$query = mysqli_query($objConnect,$str);
	$result = mysqli_fetch_array($query,MYSQLI_ASSOC);
  ?>
 <div class="modal-body">

        <form action="" method="post" id="edit_frm">
          <input type="hidden" name="_method" id="_method" value="edit">
          <input type="hidden" name="id_customer" id="id_customer" value="<?php echo $result["id_customer"]?>">
          <input type="hidden" name="id_member" id="id_member" value="<?php echo $result["id_member"]?>">
         
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-info box-solid">
                                 <div class="box-header with-border">
                                    <h3 class="box-title">ข้อมูลส่วนตัว</h3>
                                </div>
                                <div class="box-body" >
                                    <div class="form-horizontal">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ประเภทสมาชิก</label>
<?php
if ($result["type_cus"]==1) {
	$action_code1 = true;
	$action_code2 = false;
}elseif ($result["type_cus"]==2) {
	$action_code2 = true;
	$action_code1 = false;
}
?>
                                                <div class="col-sm-8" align="center">
                                                    <input type="radio"  name="type_cus" id="type_cus" value="1" <?php echo $action_code1 == true ? 'checked="checked"' : ''?> disabled/> การแพทย์
                                                    &nbsp;&nbsp;&nbsp;
                                                    <input type="radio"  name="type_cus" id="type_cus" value="2" <?php echo $action_code2 == true ? 'checked="checked"' : ''?> disabled/> การกีฬา
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ชื่อ</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control"  name="fname" id="fname" value="<?php echo $result["fname"]?>" disabled/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">นามสกุล</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $result["lname"]?>" disabled/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">E-mail</label>

                                                <div class="col-sm-8">
                                                    <input type="email" class="form-control"  name="emails" id="emails" value="<?php echo $result["email"]?>" disabled/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">เบอร์โทร</label>

                                                <div class="col-sm-8">
                                                   <input type="text" class="form-control" maxlength="10"  name="tel" id="tel" value="<?php echo $result["telephone"]?>" OnKeyPress="return check_tel(this)" disabled/>

                                                </div>
                                            </div>
                                             
                                         </div>
                                    </div>
                                </div>
                                <div class="box-header with-border">
                                    <h3 class="box-title">ข้อมูลการเข้าสู่ระบบ</h3>
                                </div>
                                <div class="box-body" >
                                    <div class="form-horizontal">
                                        <div class="box-body">
                                            
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ชื่อผู้ใช้งาน</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="username" id="username" placeholder="ชื่อผู้ใช้งาน" value="<?php echo $result["user_member"]?>" disabled/>
                                                    
                                                </div>
                                            </div>
<!--                                             <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">รหัสผ่าน</label>

                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="รหัสผ่าน" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ยืนยันรหัสผ่าน</label>

                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" name="password1" id="password1" placeholder="ยืนยันรหัสผ่าน" value="">
                                                </div>
                                            </div> -->
                                         </div>
                                    </div>
                                </div>
                            
                               
                            </div>
                        </div>
                        
                    </div> 



</form>
<!-- Modal body -->
<br>&nbsp;&nbsp;&nbsp;&nbsp;<br>
      </div>
     <div class="modal-footer"  >
              
     
<!--              <button  type="button" name="confirm_btn_edit" id="confirm_btn_edit" class="btn btn-info   confirm_btn_edit"  ><i class="fa fa-check-square-o" aria-hidden="true"></i> บันทึก </button>   -->   
            <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
          
    
        
      </div>
  <?php    }
function edit_customer(){
   global $objConnect;
		global $date;
 // header('Content-Type: application/json');
  $str = "SELECT
  	mod_customer.fname,
  	mod_customer.lname,
    mod_customer.telephone,
    mod_customer.email,
    mod_customer.id_customer,
    mod_customer.type AS type_cus,
	tbl_member.user_member,
	tbl_member.id_member
FROM
    `mod_customer`
LEFT JOIN tbl_member ON tbl_member.id_data_role = mod_customer.id_customer
WHERE
    mod_customer.id_customer = '".$_GET["id"]."'";

	$query = mysqli_query($objConnect,$str);
	$result = mysqli_fetch_array($query,MYSQLI_ASSOC);
  ?>
 <div class="modal-body">

        <form action="" method="post" id="edit_frm">
          <input type="hidden" name="_method" id="_method" value="edit">
          <input type="hidden" name="id_customer" id="id_customer" value="<?php echo $result["id_customer"]?>">
          <input type="hidden" name="id_member" id="id_member" value="<?php echo $result["id_member"]?>">
         
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-warning box-solid">
                                 <div class="box-header with-border">
                                    <h3 class="box-title">ข้อมูลส่วนตัว</h3>
                                </div>
                                <div class="box-body" >
                                    <div class="form-horizontal">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ประเภทสมาชิก</label>
<?php
if ($result["type_cus"]==1) {
	$action_code1 = true;
	$action_code2 = false;
}elseif ($result["type_cus"]==2) {
	$action_code2 = true;
	$action_code1 = false;
}
?>
                                                <div class="col-sm-8" align="center">
                                                    <input type="radio"  name="type_cus" id="type_cus" value="1" <?php echo $action_code1 == true ? 'checked="checked"' : ''?>> การแพทย์
                                                    &nbsp;&nbsp;&nbsp;
                                                    <input type="radio"  name="type_cus" id="type_cus" value="2" <?php echo $action_code2 == true ? 'checked="checked"' : ''?>> การกีฬา
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ชื่อ</label>

                                                <div class="col-sm-8">
                                                    <input type="email" class="form-control"  name="fname" id="fname" value="<?php echo $result["fname"]?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">นามสกุล</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $result["lname"]?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">E-mail</label>

                                                <div class="col-sm-8">
                                                    <input type="email" class="form-control"  name="emails" id="emails" value="<?php echo $result["email"]?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">เบอร์โทร</label>

                                                <div class="col-sm-8">
                                                   <input type="text" class="form-control" maxlength="10"  name="tel" id="tel" value="<?php echo $result["telephone"]?>" OnKeyPress="return check_tel(this)">

                                                </div>
                                            </div>
                                             
                                         </div>
                                    </div>
                                </div>
                                <div class="box-header with-border">
                                    <h3 class="box-title">ข้อมูลการเข้าสู่ระบบ</h3>
                                </div>
                                <div class="box-body" >
                                    <div class="form-horizontal">
                                        <div class="box-body">
                                            
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ชื่อผู้ใช้งาน</label>

                                                <div class="col-sm-8">
                                                  <p class="col-sm-12" >  <font class="warning-text-check-b2" id="employee-user-text_edit"></font>
                                        <i class="fa fa-spinner fa-spin spin-check" style="position:absolute; margin-left: 10px; color: green !important; display: none; "></i>
                                        <i class="fa fa-check success-check" style="position:absolute;margin-left: 10px; color: green !important; display: none;"> username นี้สามารถใช้งานได้</i> 
                                        <i class="fa fa-times-circle wrong-check" style="position:absolute; margin-left: 10px; color: orange !important; display: none;"> username นี้มีผู้ใช้งานแล้ว.</i></p><br>
                                                    <input type="text" class="form-control username_edit" name="username" id="username_edit" placeholder="ชื่อผู้ใช้งาน" value="<?php echo $result["user_member"]?>">
                                                    
                                                </div>
                                            </div>
                                             <div class="form-group">
                                               

                                                <div class="col-sm-12">
                                                    <button class="btn btn-success" id="repassword" >เปลี่ยนรหัสผ่าน</button>
                                                  <!--   <input type="button" name="btn" id="btn" value="Show" onclick='toggle()' /> -->
                                                </div>
                                            </div>
                                             <div style="display: none;" id="re_password" class="re_password">
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">รหัสผ่าน</label>

                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="รหัสผ่าน" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ยืนยันรหัสผ่าน</label>

                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" name="password1" id="password1" placeholder="ยืนยันรหัสผ่าน" value="">
                                                </div>
                                            </div>
                                          </div>
                                         </div>
                                    </div>
                                </div>
                            
                               
                            </div>
                        </div>
                        
                    </div> 



</form>
<!-- Modal body -->
<br>&nbsp;&nbsp;&nbsp;&nbsp;<br>
      </div>
     <div class="modal-footer"  >
              
     
             <button  type="button" name="confirm_btn_edit" id="confirm_btn_edit" class="btn btn-info   confirm_btn_edit"  ><i class="fa fa-check-square-o" aria-hidden="true"></i> บันทึก </button>     
            <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
          
      <!-- <button type="button" class="btn btn-success  add_number_parcel_btn" name="" id="">บันทึก</button> -->
        
      </div>
      
  <?php    }
function add_customer(){
  require_once '../library/connect.php';    
 // header('Content-Type: application/json');
  ?>
 <div class="modal-body">

        <form action="" method="post" id="confirm_frm">
          <input type="hidden" name="_method" id="_method" value="CREATE">
         
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-success box-solid">
                                 <div class="box-header with-border">
                                    <h3 class="box-title">ข้อมูลส่วนตัว</h3>
                                </div>
                                <div class="box-body" >
                                    <div class="form-horizontal">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ประเภทสมาชิก</label>

                                                <div class="col-sm-8" align="center">
                                                    <input type="radio"  name="type_cus" id="type_cus" value="1"> การแพทย์
                                                    &nbsp;&nbsp;&nbsp;
                                                    <input type="radio"  name="type_cus" id="type_cus" value="2"> การกีฬา
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ชื่อ</label>

                                                <div class="col-sm-8">
                                                    <input type="email" class="form-control"  name="fname" id="fname">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">นามสกุล</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="lname" id="lname">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">E-mail</label>

                                                <div class="col-sm-8">
                                                    <input type="email" class="form-control"  name="emails" id="emails">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">เบอร์โทร</label>

                                                <div class="col-sm-8">
                                                    <!-- <input type="text" class="form-control"  name="telephone" id="telephone" OnKeyPress="return check_tel(this)" autocomplete="off" required> -->
                                                    <input name="tel" type="text" class="form-control" id="tel" value="" size="20" maxlength="10" autocomplete="off"  OnKeyPress="return check_tel(this)" />
                                                </div>
                                            </div>
                                             <!-- <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">เลขประจำตัวผู้เสียภาษี</label>

                                                <div class="col-sm-8">
                                                    <input type="text" maxlength="13" class="form-control"  name="Tax_ID" id="Tax_ID" OnKeyPress="return check_tel(this)">
                                                </div>
                                            </div> -->
                                         </div>
                                    </div>
                                </div>
                                <div class="box-header with-border">
                                    <h3 class="box-title">ข้อมูลการเข้าสู่ระบบ</h3>
                                </div>
                                <div class="box-body" >
                                    <div class="form-horizontal">
                                        <div class="box-body">
                                            
                                            <div class="form-group">
                                               
                                               
                                         <label for="" class="col-sm-3 control-label">ชื่อผู้ใช้งาน</label>

                                                <div class="col-sm-8">
                                                   <p class="col-sm-12" >  <font class="warning-text-check-b2" id="employee-user-text"></font>
                                        <i class="fa fa-spinner fa-spin spin-check" style="position:absolute; margin-left: 10px; color: green !important; display: none; "></i>
                                        <i class="fa fa-check success-check" style="position:absolute;margin-left: 10px; color: green !important; display: none;"> username นี้สามารถใช้งานได้</i> 
                                        <i class="fa fa-times-circle wrong-check" style="position:absolute; margin-left: 10px; color: orange !important; display: none;"> username นี้มีผู้ใช้งานแล้ว.</i></p><br>
                                                    <input type="text" class="form-control username" name="username" id="username" placeholder="ชื่อผู้ใช้งาน" >
                                                    
                                                </div>
                                              
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">รหัสผ่าน</label>

                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="รหัสผ่าน">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">ยืนยันรหัสผ่าน</label>

                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" name="password1" id="password1" placeholder="ยืนยันรหัสผ่าน" >
                                                </div>
                                            </div>
                                         </div>
                                    </div>
                                </div>
                            
                               
                            </div>
                        </div>
                        
                    </div> 



</form>
<!-- Modal body -->
<br>&nbsp;&nbsp;&nbsp;&nbsp;<br>
      </div>
     <div class="modal-footer"  >
              
     
             <button  type="button" name="id_order" id="confirm_btn" class="btn btn-info   confirm_btn"  ><i class="fa fa-check-square-o" aria-hidden="true"></i> บันทึก </button>     
            <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
          
      <!-- <button type="button" class="btn btn-success  add_number_parcel_btn" name="" id="">บันทึก</button> -->
        
      </div>
  <?php    }
	function CREATE(){
		global $objConnect;
		global $date;
		$id = setMD5();

		

		$id_customer = setMD5();
		$id_extends = $id_customer;
		$pass = password_hash($_POST['password'],PASSWORD_DEFAULT);



		$str = "INSERT INTO `mod_customer`(`id_customer`, `fname`, `lname`, `telephone`,  `create_datetime`,  `email`, `type`) VALUES ('".$id."','".$_POST['fname']."','".$_POST['lname']."','".$_POST['tel']."','".$date."','".$_POST['emails']."','".$_POST['type_cus']."')";
		$query = mysqli_query($objConnect,$str);

		if($query){
			$id_customer = mysqli_insert_id($objConnect);
			echo json_encode(array('status' => '1', 'message' => $str));
		}else{
			echo json_encode(array('status' => '0', 'message' => $str));
		}

		$id_member = setMD5();



		$strSQL_member = "INSERT INTO `tbl_member`(`id_member`, `user_member`, `pass_member`, `member_regdate`, `member_last_login`, `member_last_logout`, `member_session_update`, `data_role`, `permission`, `del_time`, `id_data_role`) VALUES ('$id_member','".$_POST['username']."','$pass','$date','','','','mod_customer','',null,'$id')";
		$memberquery = mysqli_query($objConnect,$strSQL_member);
		if($memberquery){
			echo "Add member.[".$strSQL_member."]";
		}else{
			echo "ERR member.[".$strSQL_member."]";
		}
		// $str_tbl = "INSERT INTO tbl_member"

	}






	function edit(){
		global $objConnect;
		global $date;

  $str_cus = "UPDATE `mod_customer` SET `fname` = '".$_POST['fname']."', `lname` = '".$_POST['lname']."', `telephone` = '".$_POST['tel']."', `update_datetime` = '$date', `email` = '".$_POST['emails']."',type = '".$_POST['type_cus']."' WHERE `mod_customer`.`id_customer` = '".$_POST['id_customer']."'";
		$query = mysqli_query($objConnect,$str_cus);


if ($_POST['password']!='') {
	$pass = password_hash($_POST['password'],PASSWORD_DEFAULT);
	echo $str_tbl = "UPDATE `tbl_member` SET `user_member` = '".$_POST['username']."', `pass_member` = '$pass' WHERE `tbl_member`.`id_member` = '".$_POST['id_member']."'";
		$query = mysqli_query($objConnect,$str_tbl);	

		}	else{

	$str_tbl = "UPDATE `tbl_member` SET `user_member` = '".$_POST['username']."' WHERE `tbl_member`.`id_member` = '".$_POST['id_member']."'";
	$query = mysqli_query($objConnect,$str_tbl);

		}	


	

	}

	function DELETE(){
		global $objConnect;
		global $date;
		$str = "UPDATE `mod_customer` SET `delete_datetime` = '".$date."' WHERE `mod_customer`.`id_customer` = '".$_POST['id_customer']."'";
		$query = mysqli_query($objConnect,$str);

		if($query){
			echo json_encode(array('status' => '1', 'message' => $str));
		}else{
			echo json_encode(array('status' => '0', 'message' => $str));
		}
	}

	

        function setMD5()
        {
            $passuniq = uniqid();
            $passmd5 = md5($passuniq);

            $sumlenght = strlen($passmd5);#num passmd5

            $letter_pre = chr(rand(97, 122));#set char for prefix

            $letter_post = chr(rand(97, 122));#set char for postfix

            $letter_mid = chr(rand(97, 122));#set char for middle string

            $num_rand = rand(0, $sumlenght);#random for cut passmd5

            $cut_pre = substr($passmd5, 0, $num_rand);#cutmd5 start 0 stop $numrand
        $setmid = $cut_pre.$letter_mid;#set pre string + char middle

        $cut_post = substr($passmd5, $num_rand, $sumlenght+1);

            $set_modify_md5 = $letter_pre.$setmid.$cut_post.$letter_post;
            return $set_modify_md5;
        }
    
?>