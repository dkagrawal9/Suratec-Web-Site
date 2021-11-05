<?php
	require_once '../library/connect.php';
	date_default_timezone_set("Asia/Bangkok");

	$pass = password_hash($_POST['member-pass'],PASSWORD_DEFAULT);

	$date_regdate = date("Y-m-d H:i:s");
	$strSQL = "INSERT INTO mod_member";
	// $strSQL .= "(user_member
	// 			,pass_member
	// 			,username
	// 			,surname
	// 			,username_en
	// 			,surname_en
	// 			,birthday
	// 			,position
	// 			,position_en
	// 			,detail_member
	// 			,detail_member_en
	// 			,email
	// 			,user_city
	// 			,user_state
	// 			,user_district
	// 			,detail_city
	// 			,tel
	// 			,user_regdate
	// 			,user_last_login
	// 			,user_last_logout
	// 			,user_session_update
	// 			,status
	// 			,data_role)";
	// $strSQL .= "VALUES ";
	// $strSQL .= "('".$_POST['member-user']."'
	// 			,'".$_POST['member-pass']."'
	// 			,'".$_POST['member-name']."'
	// 			,'".$_POST['member-sur']."'
	// 			,'".$_POST['member-name-en']."'
	// 			,'".$_POST['member-sur-en']."'
	// 			,'".$_POST['member-date']."'
	// 			,'".$_POST['member-opti']."'
	// 			,'".$_POST['member-opti-en']."'
	// 			,'".$_POST['detail-member']."'
	// 			,'".$_POST['detail-member-en']."'
	// 			,'".$_POST['member-email']."'
	// 			,'".$_POST['member-city']."'
	// 			,'".$_POST['member-state']."'
	// 			,'".$_POST['member-district']."'
	// 			,'".$_POST['detail-city']."'
	// 			,'".$_POST['tel']."'
	// 			,'".$date_regdate."'
	// 			,'0000-00-00 00:00:00'
	// 			,'0000-00-00 00:00:00'
	// 			,'0000-00-00 00:00:00'
	// 			,'0'
	// 			,'".$_POST['authen']."'
	// 			)";
	$strSQL .= "(user_member,pass_member,username,surname,username_en,surname_en,birthday,position,position_en,detail_member,detail_member_en,email,user_regdate,user_last_login,user_last_logout,user_session_update,status,data_role)";
	$strSQL .= "VALUES ";
	$strSQL .= "('".$_POST['member-user']."','".$pass."','".$_POST['member-name']."','".$_POST['member-sur']."','".$_POST['member-name-en']."','".$_POST['member-sur-en']."','".$_POST['member-date']."','".$_POST['member-opti']."','".$_POST['member-opti-en']."','".$_POST['member-detail']."','".$_POST['member-detail-en']."','".$_POST['member-email']."','".$date_regdate."','0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','0','".$_POST['authen']."')";
	$objQuery = mysqli_query($objConnect,$strSQL);
	if($objQuery){
		echo "Add done.[".$strSQL."]";
		// header("Refresh: 0; url=manage-menu.php");
	}
	else{
		echo "Error Add [".$strSQL."]";
	}
	$id_member = mysqli_insert_id($objConnect);

	$namefile = $_FILES["image_member"]["name"];
	$sur = strrchr($namefile, "."); //ตัดนามสกุลไฟล์เก็บไว้
	$name = "AR-".(Date("dmy").rand('1000','9999').$sur); //ผมตั้งเป็น วันที่_เวลา.นามสกุล
	$target = "../../uploads/member/".$name;
	$newname = $name;

	if(file_exists($target)){
		$oldname = pathinfo($name, PATHINFO_FILENAME);
		$ext = pathinfo($name, PATHINFO_EXTENSION);
		$newname = $oldname;
		do{
			$r = rand(1000,9999);
			$newname = $oldname."-".$r.".$ext";
			$target = "../../uploads/member/".$newname;
		}while (file_exists($target)); 
	}
	
	if(copy($_FILES["image_member"]["tmp_name"],iconv('UTF-8','windows-874',"../../uploads/member/".$newname)))
	{
		echo "Copy/Upload Complete<br>";

	$size = $_FILES['image_member']['size'];
	$strSQL = "INSERT INTO mod_member_image";
	$strSQL .= "(name_image,size,date_image,id_member)";
	$strSQL .= "VALUES ";
	$strSQL .= "('$newname','$size','$date_regdate','$id_member')";
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
mysqli_close($objConnect);
// header("Refresh: 0; url=front-add.php");
?>