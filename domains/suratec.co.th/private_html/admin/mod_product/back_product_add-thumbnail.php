<?php 
session_start();
require_once '../library/connect.php';
date_default_timezone_set("Asia/Bangkok");
$date = date("Y-m-d");

if(isset($_POST['nbr_files'])){
	for($i = 0; $i < $_POST['nbr_files']; $i++) { // Loop through each file
		$str_chk = "SELECT name_thumb FROM product_image_thumb WHERE user_id = '".$_SESSION['user_member']."'";
		$query_chk = mysqli_query($objConnect,$str_chk);
		$row_chk = mysqli_num_rows($query_chk);
		if($row_chk>0){
			$active = "";
		}else{
			if($i == 0){
				$active = "active";
			}else{
				$active = "";
			}
		}
		if($_FILES["files".$i]["name"] != "")
		{
			$namefile = $_FILES["files".$i]["name"];
			$sur = strrchr($namefile, "."); //ตัดนามสกุลไฟล์เก็บไว้
			$name = "P-".(Date("dmy").rand('1000','9999').$sur); //ผมตั้งเป็น วันที่_เวลา.นามสกุล
			$target = "../../uploads/product/thumbnail/".$name;
			$newname = $name;

			if(file_exists($target)){
				$oldname = pathinfo($name, PATHINFO_FILENAME);
				$ext = pathinfo($name, PATHINFO_EXTENSION);
				$newname = $oldname;
				do{
					$r = rand(1000,9999);
					$newname = $oldname."-".$r.".$ext";
					$target = "../../uploads/product/thumbnail/".$newname;
				}while (file_exists($target)); 
			}
			// if(copy($_FILES["files"]["tmp_name"][$i],"image_product/thumbnail/".$_FILES["files"]["name"][$i]))
			if(copy($_FILES["files".$i]["tmp_name"],$target))
			{
				// echo "Copy/Upload Complete<br>";
				$strSQL = "INSERT INTO product_image_thumb";
				$strSQL .= "(name_thumb,date_thumb,size_thumb,active,user_id)";
				$strSQL .= "VALUES ";
				$strSQL .= "('".$newname."','".$date."','".$_FILES["files".$i]["size"]."','".$active."','".$_SESSION['user_member']."')";
				$objQuery = mysqli_query($objConnect,$strSQL);
				// if($objQuery){
				// 	echo "Insert record complete<br>";
				// }else{
				// 	echo "Insert error!<br>";
				// }	
			}else{
				echo "error";
			}
		}
	}
	$str_ac = "SELECT name_thumb FROM product_image_thumb WHERE active = 'active' AND user_id = '".$_SESSION['user_member']."'";
	$query_ac = mysqli_query($objConnect,$str_ac);
	$result_ac = mysqli_fetch_array($query_ac);
	echo $result_ac['name_thumb'];
}
else
{
	for($i=0;$i<count($_FILES["files"]["name"]);$i++)
	{
		$str_chk = "SELECT name_thumb FROM product_image_thumb WHERE user_id = '".$_SESSION['user_member']."'";
		$query_chk = mysqli_query($objConnect,$str_chk);
		$row_chk = mysqli_num_rows($query_chk);
		if($row_chk>0){
			$active = "";
		}else{
			if($i == 0){
				$active = "active";
			}else{
				$active = "";
			}
		}
		if($_FILES["files"]["name"][$i] != "")
		{
			$namefile = $_FILES["files"]["name"][$i];
			$sur = strrchr($namefile, "."); //ตัดนามสกุลไฟล์เก็บไว้
			$name = "P-".(Date("dmy").rand('1000','9999').$sur); //ผมตั้งเป็น วันที่_เวลา.นามสกุล
			$target = "../../uploads/product/thumbnail/".$name;
			$newname = $name;

			if(file_exists($target)){
				$oldname = pathinfo($name, PATHINFO_FILENAME);
				$ext = pathinfo($name, PATHINFO_EXTENSION);
				$newname = $oldname;
				do{
					$r = rand(1000,9999);
					$newname = $oldname."-".$r.".$ext";
					$target = "../../uploads/product/thumbnail/".$newname;
				}while (file_exists($target)); 
			}
			// if(copy($_FILES["files"]["tmp_name"][$i],"image_product/thumbnail/".$_FILES["files"]["name"][$i]))
			if(copy($_FILES["files"]["tmp_name"][$i],$target))
			{
				// echo "Copy/Upload Complete<br>";
				$strSQL = "INSERT INTO product_image_thumb";
				$strSQL .= "(name_thumb,date_thumb,size_thumb,active,user_id)";
				$strSQL .= "VALUES ";
				$strSQL .= "('".$newname."','".$date."','".$_FILES["files"]["size"][$i]."','".$active."','".$_SESSION['user_member']."')";
				$objQuery = mysqli_query($objConnect,$strSQL);
				// if($objQuery){
				// 	echo "Insert record complete<br>";
				// }else{
				// 	echo "Insert error!<br>";
				// }	
			}else{
				echo "error";
			}
		}
	}
	$str_ac = "SELECT name_thumb FROM product_image_thumb WHERE active = 'active' AND user_id = '".$_SESSION['user_member']."'";
	$query_ac = mysqli_query($objConnect,$str_ac);
	$result_ac = mysqli_fetch_array($query_ac);
	echo $result_ac['name_thumb'];
}
?>