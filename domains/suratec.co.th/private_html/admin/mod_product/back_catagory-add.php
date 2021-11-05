<?php
	require_once '../library/connect.php';
	date_default_timezone_set("Asia/Bangkok");
	$date = date("Y-m-d");

	// $icon = $_POST['icon'];
	$img_tmp = $_FILES["image_catagory"]["tmp_name"];
	$img_name = $_FILES["image_catagory"]['name'];

	if($img_tmp!=''){
		$namefile = $_FILES["image_catagory"]["name"];
		$sur = strrchr($namefile, "."); //ตัดนามสกุลไฟล์เก็บไว้
		$name = "C-".(Date("dmy").rand(1000,9999).$sur); //ผมตั้งเป็น วันที่_เวลา.นามสกุล
		$target = "../../uploads/category/".$name;
		$newname = $name;
				
		if(file_exists($target)){
			$oldname = pathinfo($name, PATHINFO_FILENAME);
			$ext = pathinfo($name, PATHINFO_EXTENSION);
			$newname = $oldname;
				do{
					$r = rand(1000,9999);
					$newname = $oldname."-".$r.".$ext";
					$target = "../../uploads/category/".$newname;
				}while (file_exists($target)); 
			}

		if(copy($_FILES["image_catagory"]["tmp_name"],$target))
		{
			echo "Copy/Upload Complete<br>";
		}
	}else{
		$newname = '';
	}

	$cut_post = explode("-",$_POST['sub_catagory']);

	if($_POST['sub_catagory'] ==0){
		$level = '1';
		$group = "";
	}elseif($cut_post[0] == 1){
		$level = '2';
		$group = $cut_post[1];
	}else{
		$level = '3';
		$group = $cut_post[1];
	}

	$strSQL = "INSERT INTO product_catagory";
	$strSQL .= "(name_catagory,name_catagory_en,date_catagory,level,group_sub,img)";
	$strSQL .= "VALUES ";
	$strSQL .= "('".$_POST['name']."','".$_POST['name_en']."','".$date."','".$level."','".$group."','".$newname."')";
	$objQuery = mysqli_query($objConnect,$strSQL);
	if($objQuery){
		echo "complete".$strSQL;
	}else{
		echo "not complete".$strSQL;
	}
?>