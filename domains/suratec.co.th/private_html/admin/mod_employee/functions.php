<?php


if($_POST['form']=='check_user_ex'){
	doCheckuser();
	exit;
}elseif($_POST['form']=='add'){
	doAddemployee();
	exit;
}elseif($_POST['form']=='edit'){
	doEdit();
	exit;
}elseif($_POST['form']=='disabled'){
	doDisabled();
	exit;
}elseif($_POST['form']=='enabled'){
	doenabled();
	exit;
}elseif($_POST['form']=='Multivisible'){
	doMultivisible();
	exit;
}elseif($_POST['form']=='del'){
	doDel();
	exit;
}elseif($_POST['form']=='delmul'){
	doDelmul();
	exit;
}elseif($_POST['form']=='CREATE_type'){
	CREATE_type();
	exit;
}elseif($_POST['form']=='edit_type'){
	edit_type();
	exit;
}elseif($_POST['form']=='del_type'){
	del_type();
	exit;
}elseif($_POST['_method']=='order'){
	order_number();
	exit;
}



function doCheckuser(){
	require_once '../library/connect.php';
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

function doDisabled(){
	require_once '../library/connect.php';
	header('Content-Type: application/json');
	date_default_timezone_set("Asia/Bangkok");
	$date_regdate = date("Y-m-d H:i:s");
	
	$str = "UPDATE tbl_member SET del_time = '".$date_regdate."' WHERE id_data_role = '".$_POST['id']."'";
	$query = mysqli_query($objConnect,$str);;
	if($query){
		echo json_encode(array('status' => '0','message'=> $str));
	}else{
		echo json_encode(array('status' => '1','message'=> $str));
	}
}

function doenabled(){
	require_once '../library/connect.php';
	header('Content-Type: application/json');
	date_default_timezone_set("Asia/Bangkok");
	$date_regdate = date("Y-m-d H:i:s");
	
	$str = "UPDATE tbl_member SET del_time = NULL WHERE id_data_role = '".$_POST['id']."' ";
	$query = mysqli_query($objConnect,$str);;
	if($query){
		echo json_encode(array('status' => '0','message'=> $str));
	}else{
		echo json_encode(array('status' => '1','message'=> $str));
	}
}

function doMultivisible(){
	require_once '../library/connect.php';
	header('Content-Type: application/json');
	date_default_timezone_set("Asia/Bangkok");
	$date_regdate = date("Y-m-d H:i:s");
		
	if($_POST['change']=='Disabled'){
		for($i=0;$i<count($_POST["Chk"]);$i++){	
			$strSQL = "UPDATE tbl_member SET del_time = '".$date_regdate."' WHERE id_data_role = '".$_POST["Chk"][$i]."' ";
			$objQuery = mysqli_query($objConnect,$strSQL);
		}
			echo json_encode(array('status' => '0','message'=> $strSQL));
	}elseif($_POST['change']=='Enabled'){
		for($i=0;$i<count($_POST["Chk"]);$i++){	
			$strSQL = "UPDATE tbl_member SET del_time = NULL WHERE id_data_role = '".$_POST["Chk"][$i]."' ";
			$objQuery = mysqli_query($objConnect,$strSQL);
		}
			echo json_encode(array('status' => '0','message'=> $strSQL));
	}else{
		for($i=0;$i<count($_POST["Chk"]);$i++){	
			$strSQL = "SELECT * FROM mod_employee_image WHERE id_employee = '".$_POST["Chk"][$i]."'";
			$objQuery = mysqli_query($objConnect,$strSQL);
			$objResult = mysqli_fetch_array($objQuery);
			$numrow = mysqli_num_rows($objQuery);
			if($numrow>0){
				$file = iconv("utf-8","tis-620",$objResult["name_image"]);
					if(unlink("../../uploads/employee/".$file)){
				}
			}

			$str_del_member = "DELETE FROM tbl_member WHERE id_data_role = '".$_POST["Chk"][$i]."' AND data_role = 'mod_employee'";
			$query_del_member = mysqli_query($objConnect,$str_del_member);

			$strSQL = "DELETE FROM mod_employee WHERE id_employee = '".$_POST["Chk"][$i]."' ";
			$objQuery = mysqli_query($objConnect,$strSQL);
		}
		echo json_encode(array('status' => '0','message'=> $strSQL));
	}
}

function doAddemployee(){
	$all_gen = '';
	$all_sys = '';
	$all_authen = '';
	$all_authen_s = '';

if( file_exists("../../uploads/employee") )
{

}
else
{ 
mkdir("../../uploads/employee");
}
	
//var_dump($_POST);

	for($i=1;$i<=$_POST['count_general'];$i++){
		$cut_gd = explode(",",$_POST['general'.$i]);
		if($cut_gd[0]==0){
			continue;
		}else{
			if($i==$_POST['count_general']){
				$all_gen .= $cut_gd[1];
				$all_authen .= $cut_gd[0];
			}else{
				$all_gen .= $cut_gd[1].',';
				$all_authen .= $cut_gd[0].',';
			}
		}
	}


	for($i=1;$i<=$_POST['count_system'];$i++){
		$cut_dg = explode(",",$_POST['system'.$i]);
		if($cut_dg[0]==0){
			continue;
		}else{
			if($i==$_POST['count_system']){
				$all_sys .= $cut_dg[1];
				$all_authen_s .= $cut_dg[0];
			}else{
				$all_sys .= $cut_dg[1].',';
				$all_authen_s .= $cut_dg[0].',';
			}
		}
	}

	// for($i=1;$i<=$_POST['count_pos'];$i++){
	// 	$cut_dg = explode(",",$_POST['pos'.$i]);
	// 	if($cut_dg[0]==0){
	// 		continue;
	// 	}else{
	// 		if($i==$_POST['count_pos']){
	// 			$all_pos .= $cut_dg[1];
	// 			$all_authen_p .= $cut_dg[0];
	// 		}else{
	// 			$all_pos .= $cut_dg[1].',';
	// 			$all_authen_p .= $cut_dg[0].',';
	// 		}
	// 	}
	// }


	echo $task_view = $all_gen.','.$all_sys;
	echo $task_authen = $all_authen.','.$all_authen_s;

	require_once '../library/connect.php';
	date_default_timezone_set("Asia/Bangkok");

	$id_employee = setMD5();
	$id_extends = $id_employee;
	$pass = password_hash($_POST['employee-pass'],PASSWORD_DEFAULT);

	$date_regdate = date("Y-m-d H:i:s");

	$strSQL = "INSERT INTO mod_employee";
	$strSQL .= "(id_employee,username,surname,username_en,surname_en,birthday,position,position_en,code_id,detail_employee,detail_employee_en,email,tel,task_view,task_authen,`role_id`,approver,address,district,amphures,province,zip_code)";
	$strSQL .= "VALUES ";
	$strSQL .= "('".$id_employee."','".$_POST['employee-name']."','".$_POST['employee-sur']."','".$_POST['employee-name-en']."','".$_POST['employee-sur-en']."','".$_POST['employee-date']."','".$_POST['employee-opti']."','".$_POST['employee-opti-en']."','".$_POST['employee-code']."','','','".$_POST['employee-email']."'
	,'".$_POST['tel']."','".$task_view."','".$task_authen."','".$_POST['role']."'
	,'' ,'".$_POST['address']."' ,'".$_POST['district']."' ,'".$_POST['amphures']."' ,'".$_POST['province']."' ,'".$_POST['zip_code']."')";
	$objQuery = mysqli_query($objConnect,$strSQL);
	if($objQuery){
		echo "Add done.[".$strSQL."]";

		$id_member = setMD5();

		$strSQL_member = "INSERT INTO tbl_member";
		$strSQL_member .= "(id_member,user_member,pass_member,member_regdate,member_last_login,member_last_logout,member_session_update,data_role,id_data_role)";
		$strSQL_member .= "VALUES";
		$strSQL_member .= "('".$id_member."','".$_POST['employee-user']."','".$pass."','".$date_regdate."','0000-00-00 00:00:00','0000-00-00 00:00:00','','mod_employee','".$id_extends."')";
		$memberquery = mysqli_query($objConnect,$strSQL_member);
		if($memberquery){
			echo "Add member.[".$strSQL_member."]";
		}else{
			echo "ERR member.[".$strSQL_member."]";
		}

	}
	else{
		echo "Error Add [".$strSQL."]";
	}

	if($_FILES['image_employee']['name']!=''){
		$namefile = $_FILES["image_employee"]["name"];
		$sur = strrchr($namefile, "."); //ตัดนามสกุลไฟล์เก็บไว้
		$name = "EM-".(Date("dmy").rand('1000','9999').$sur); //ผมตั้งเป็น วันที่_เวลา.นามสกุล
		$target = "../../uploads/employee/".$name;
		$newname = $name;

		if(file_exists($target)){
			$oldname = pathinfo($name, PATHINFO_FILENAME);
			$ext = pathinfo($name, PATHINFO_EXTENSION);
			$newname = $oldname;
			do{
				$r = rand(1000,9999);
				$newname = $oldname."-".$r.".$ext";
				$target = "../../uploads/employee/".$newname;
			}while (file_exists($target)); 
		}
		
		if(copy($_FILES["image_employee"]["tmp_name"],iconv('UTF-8','windows-874',"../../uploads/employee/".$newname)))
		{
			echo "Copy/Upload Complete<br>";

		$size = $_FILES['image_employee']['size'];
		$strSQL = "INSERT INTO mod_employee_image";
		$strSQL .= "(name_image,size,date_image,id_employee)";
		$strSQL .= "VALUES ";
		$strSQL .= "('$newname','$size','$date_regdate','$id_extends')";
		$objQuery = mysqli_query($objConnect,$strSQL);
		}else{
			echo "Copy/upload error<br>";
		}
		if($objQuery){
			echo "Add done.[".$strSQL."]";
		}
		else{
			echo "Error Add [".$strSQL."]";
		}
	}
	mysqli_close($objConnect);
}

function doEdit(){
	require_once '../library/connect.php';
	date_default_timezone_set("Asia/Bangkok");
	$date_regdate = date("Y-m-d H:i:s");



	$all_gen = '';
	$all_sys = '';
	$all_authen = '';
	$all_authen_s = '';
	for($i=1;$i<=$_POST['count_general'];$i++){
		$cut_gd = explode(",",$_POST['general'.$i]);
		if($cut_gd[0]==0){
			continue;
		}else{
			if($i==$_POST['count_general']){
				$all_gen .= $cut_gd[1];
				$all_authen .= $cut_gd[0];
			}else{
				$all_gen .= $cut_gd[1].',';
				$all_authen .= $cut_gd[0].',';
			}
		}
	}


	for($i=1;$i<=$_POST['count_system'];$i++){
		$cut_dg = explode(",",$_POST['system'.$i]);
		if($cut_dg[0]==0){
			continue;
		}else{
			if($i==$_POST['count_system']){
				$all_sys .= $cut_dg[1];
				$all_authen_s .= $cut_dg[0];
			}else{
				$all_sys .= $cut_dg[1].',';
				$all_authen_s .= $cut_dg[0].',';
			}
		}
	}


	// for($i=1;$i<=$_POST['count_pos'];$i++){
	// 	$cut_dg = explode(",",$_POST['pos'.$i]);
	// 	if($cut_dg[0]==0){
	// 		continue;
	// 	}else{
	// 		if($i==$_POST['count_pos']){
	// 			$all_pos .= $cut_dg[1];
	// 			$all_authen_p .= $cut_dg[0];
	// 		}else{
	// 			$all_pos .= $cut_dg[1].',';
	// 			$all_authen_p .= $cut_dg[0].',';
	// 		}
	// 	}
	// }


	echo $task_view = $all_gen.','.$all_sys;
	echo $task_authen = $all_authen.','.$all_authen_s;




	$str = "UPDATE mod_employee SET";
	$str .= " username = '".$_POST['employee-name']."' ";
	$str .= ",surname = '".$_POST['employee-sur']."' ";
	$str .= ",username_en = '".$_POST['employee-name-en']."' ";
	$str .= ",surname_en = '".$_POST['employee-sur-en']."' "; 
	$str .= ",birthday = '".$_POST['employee-date']."' "; 
	$str .= ",position = '".$_POST['employee-opti']."' "; 
	$str .= ",position_en = '".$_POST['employee-opti-en']."' ";
	$str .= ",code_id = '".$_POST['employee-code']."' ";
	// $str .= ",detail_employee = '".$_POST['employee-detail']."' "; 
	// $str .= ",detail_employee_en = '".$_POST['employee-detail-en']."' "; 
	$str .= ",email = '".$_POST['employee-email']."' ";
	$str .= ",tel = '".$_POST['tel']."' "; 
	$str .= ",task_view = '".$task_view."' "; 
	$str .= ",task_authen = '".$task_authen."'";
	// $str .= ",approver = '".$_POST['approver']."'";
	$str .= ",role_id = '".$_POST['role']."'";
	$str .= ",address = '".$_POST['address']."'";
	$str .= ",district = '".$_POST['district']."'";
	$str .= ",amphures = '".$_POST['amphures']."'";
	$str .= ",province = '".$_POST['province']."'";
	$str .= ",zip_code = '".$_POST['zip_code']."'";

	$str .= "WHERE id_employee = '".$_POST['id']."'" ;

	echo $str;

	$query = mysqli_query($objConnect,$str);


	if($_POST['employee-pass']!==''){
		$pass = password_hash($_POST['employee-pass'],PASSWORD_DEFAULT);
	}else{	
	  	$str_member = "SELECT * FROM tbl_member WHERE id_data_role = '".$_POST['id']."' AND data_role = 'mod_employee'";
	  	$query_member = mysqli_query($objConnect,$str_member);
	  	$result_member = mysqli_fetch_array($query_member);

	  	$pass = $result_member['pass_member'];
	}

	if($query){
		echo 'complete';

		if($_FILES['image_employee']['name']!=''){

			$str_check_image = "SELECT * FROM mod_employee_image WHERE id_employee = '".$_POST['id']."'";
			$query_check_image = mysqli_query($objConnect,$str_check_image);
			$num_check_image = mysqli_num_rows($query_check_image);
			if($num_check_image > 0){
				$result_check_image = mysqli_fetch_array($query_check_image);
				$image_em = iconv("utf-8","tis-620",$result_check_image["name_image"]);
				if(unlink("../../uploads/employee/".$image_em)){
					echo "Delete old image complete<br>";

					$namefile = $_FILES["image_employee"]["name"];
					$sur = strrchr($namefile, "."); //ตัดนามสกุลไฟล์เก็บไว้
					$name = "EM-".(Date("dmy").rand('1000','9999').$sur); //ผมตั้งเป็น วันที่_เวลา.นามสกุล
					$target = "../../uploads/employee/".$name;
					$newname = $name;

					if(file_exists($target)){
						$oldname = pathinfo($name, PATHINFO_FILENAME);
						$ext = pathinfo($name, PATHINFO_EXTENSION);
						$newname = $oldname;
						do{
							$r = rand(1000,9999);
							$newname = $oldname."-".$r.".$ext";
							$target = "../../uploads/employee/".$newname;
						}while (file_exists($target)); 
					}
					
					if(copy($_FILES["image_employee"]["tmp_name"],iconv('UTF-8','windows-874',"../../uploads/employee/".$newname))){
						echo "Copy/Upload Complete<br>";

						$size = $_FILES['image_employee']['size'];
						$strSQL = "UPDATE mod_employee_image SET";
						$strSQL .= " name_image = '".$newname."' ";
						$strSQL .= ",size = '".$size."' "; 
						$strSQL .= ",date_image = '".$date_regdate."' "; 
						$strSQL .= "WHERE id_employee = '".$_POST['id']."'" ;
						$objQuery = mysqli_query($objConnect,$strSQL);
					}else{
						echo "Copy/upload error<br>";
					}
					
					if($objQuery){
						echo "Add done.[".$strSQL."]";
					}else{
						echo "Error Add [".$strSQL."]";
					}
				}
			}else{
				$namefile = $_FILES["image_employee"]["name"];
				$sur = strrchr($namefile, "."); //ตัดนามสกุลไฟล์เก็บไว้
				$name = "EM-".(Date("dmy").rand('1000','9999').$sur); //ผมตั้งเป็น วันที่_เวลา.นามสกุล
				$target = "../../uploads/employee/".$name;
				$newname = $name;

				if(file_exists($target)){
					$oldname = pathinfo($name, PATHINFO_FILENAME);
					$ext = pathinfo($name, PATHINFO_EXTENSION);
					$newname = $oldname;
					do{
						$r = rand(1000,9999);
						$newname = $oldname."-".$r.".$ext";
						$target = "../../uploads/employee/".$newname;
					}while (file_exists($target)); 
				}
				
				if(copy($_FILES["image_employee"]["tmp_name"],iconv('UTF-8','windows-874',"../../uploads/employee/".$newname)))
				{
					echo "Copy/Upload Complete<br>";

				$size = $_FILES['image_employee']['size'];
				$strSQL = "INSERT INTO mod_employee_image";
				$strSQL .= "(name_image,size,date_image,id_employee)";
				$strSQL .= "VALUES ";
				$strSQL .= "('$newname','$size','$date_regdate','".$_POST['id']."')";
				$objQuery = mysqli_query($objConnect,$strSQL);
				}else{
					echo "Copy/upload error<br>";
				}
				if($objQuery){
					echo "Add done.[".$strSQL."]";
				}
				else{
					echo "Error Add [".$strSQL."]";
				}
			}
		}

		$str_member_u = "UPDATE tbl_member SET";
		$str_member_u .= " user_member = '".$_POST['employee-user']."' ";
		$str_member_u .= ",pass_member = '".$pass."' ";
		$str_member_u .= "WHERE id_data_role = '".$_POST['id']."' AND data_role = 'mod_employee'";
		$query_member_u = mysqli_query($objConnect,$str_member_u);
		if($query_member_u){
			//echo 'complete'.$str_member_u;
		}else{
			echo 'error'.$str_member_u;
		}
	}else{
			echo 'error'.$str;
		}
}

function doDel(){
	 require_once '../library/connect.php';
	 header('Content-Type: application/json');
		$strSQL = "SELECT * FROM mod_employee_image WHERE id_employee = '".$_POST["id"]."'";
		$objQuery = mysqli_query($objConnect,$strSQL);
		$objResult = mysqli_fetch_array($objQuery);
		$numrow = mysqli_num_rows($objQuery);
		if($numrow>0){
			$file = iconv("utf-8","tis-620",$objResult["name_image"]);
			if(unlink("../../uploads/employee/".$file)){
			}
		}

		$str_del_member = "DELETE FROM tbl_member WHERE id_data_role = '".$_POST['id']."' AND data_role = 'mod_employee'";
		$query_del_member = mysqli_query($objConnect,$str_del_member);

		$strSQL = "DELETE FROM mod_employee WHERE id_employee = '".$_POST["id"]."' ";
		$objQuery = mysqli_query($objConnect,$strSQL);
		if($objQuery){
			echo json_encode(array('status' => '0','message'=> $strSQL));
		}else{
			echo json_encode(array('status' => '1','message'=> $strSQL));
		}
}


function setMD5(){

	$passuniq = uniqid();
	$passmd5 = md5($passuniq);

	$sumlenght = strlen($passmd5);#num passmd5

	$letter_pre = chr(rand(97,122));#set char for prefix

	$letter_post = chr(rand(97,122));#set char for postfix

	$letter_mid = chr(rand(97,122));#set char for middle string

	$num_rand = rand(0,$sumlenght);#random for cut passmd5

	$cut_pre = substr($passmd5,0,$num_rand);#cutmd5 start 0 stop $numrand
	$setmid = $cut_pre.$letter_mid;#set pre string + char middle

	$cut_post = substr($passmd5,$num_rand, $sumlenght+1);

	$set_modify_md5 = $letter_pre.$setmid.$cut_post.$letter_post;
	return $set_modify_md5;
}

function CREATE_type(){
	 require_once '../library/connect.php';
	 header('Content-Type: application/json');
	$id = setMD5();
	$task_view = "";
	$task_authen = "";

	 $str = "SELECT `id_system`,`name_system` FROM `system` WHERE 1";

	$query = mysqli_query($objConnect,$str);
	$i=0;
	while ($result = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
		
		if (isset($_POST["Chk".$i]) && $_POST["Chk".$i]==$result["id_system"]) {
			
			$task_authen .=  '1,';
		}else{
		
			$task_authen .=  '0,';
		}
		
	$task_view .=  $result["id_system"].',';
$i++; }


	
	$sql = "INSERT INTO `role`(`role_id`, `role_name`, `task_view`, `task_authen`) VALUES ('".$id."','".$_POST["name"]."','".$task_view."','".$task_authen."')";
	
	$objQuery = mysqli_query($objConnect,$sql);
		if($objQuery){
			echo json_encode(array('status' => '0','message'=> $sql));
		}else{
			echo json_encode(array('status' => '1','message'=> $sql));
		}
}

function edit_type(){
	 require_once '../library/connect.php';
	 header('Content-Type: application/json');
	
	$task_view = "";
	$task_authen = "";

	 $str = "SELECT `id_system`,`name_system` FROM `system` WHERE 1";

	$query = mysqli_query($objConnect,$str);
	$i=0;
	while ($result = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
		
		if (isset($_POST["Chk".$i]) && $_POST["Chk".$i]==$result["id_system"]) {
			
			$task_authen .=  '1,';
		}else{
		
			$task_authen .=  '0,';
		}
		
	$task_view .=  $result["id_system"].',';
$i++; }



	
	$sql = "UPDATE `role` SET `role_name`='".$_POST["name"]."',`task_view`='".$task_view."',`task_authen`='".$task_authen."' WHERE `role_id`='".$_POST["role_id"]."'";
	
	$objQuery = mysqli_query($objConnect,$sql);
		if($objQuery){
			echo json_encode(array('status' => '0','message'=> $sql));
		}else{
			echo json_encode(array('status' => '1','message'=> $sql));
		}
}

function del_type(){
	 require_once '../library/connect.php';
	 header('Content-Type: application/json');
	
	
	$sql = "DELETE FROM `role` WHERE `role_id`='".$_POST["id"]."'";
	
	$objQuery = mysqli_query($objConnect,$sql);
		if($objQuery){
			echo json_encode(array('status' => '0','message'=> $sql));
		}else{
			echo json_encode(array('status' => '1','message'=> $sql));
		}
}

function order_number(){
	require_once '../library/connect.php';


	$id = $_POST['id'];
	$order = $_POST['order'];

	$sql = "UPDATE `mod_employee` SET `order_no`='".$_POST["order"]."' WHERE `id_employee`='".$_POST["id"]."'";
	
	$objQuery = mysqli_query($objConnect,$sql);
		if($objQuery){
			echo json_encode(array('status' => '0','message'=> $objConnect));
		}else{
			echo json_encode(array('status' => '1','message'=> $objConnect));
		}


	

}


?>