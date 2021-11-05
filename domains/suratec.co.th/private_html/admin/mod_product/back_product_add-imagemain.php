<?php 
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
require_once '../library/connect.php';
date_default_timezone_set("Asia/Bangkok");
$date = date("Y-m-d");
if(isset($_POST['nbr_files'])){
	for($i = 0; $i < $_POST['nbr_files']; $i++) { // Loop through each file
		$str_chk = "SELECT id_product,name_image FROM product_image WHERE id_product = '".$_POST['id_product']."'";
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
			$target = "../../uploads/product/".$name;
			$newname = $name;

			if(file_exists($target)){
				$oldname = pathinfo($name, PATHINFO_FILENAME);
				$ext = pathinfo($name, PATHINFO_EXTENSION);
				$newname = $oldname;
				do{
					$r = rand(1000,9999);
					$newname = $oldname."-".$r.".$ext";
					$target = "../../uploads/product/".$newname;
				}while (file_exists($target)); 
			}
			// if(copy($_FILES["files"]["tmp_name"][$i],"image_product/thumbnail/".$_FILES["files"]["name"][$i]))
			if(copy($_FILES["files".$i]["tmp_name"],$target))
			{
				$id_image = setMD5();
				// echo "Copy/Upload Complete<br>";
				$strSQL = "INSERT INTO product_image";
				$strSQL .= "(id_image,name_image,date_image,size_image,id_product,active)";
				$strSQL .= "VALUES ";
				$strSQL .= "('$id_image',".$newname."','".$date."','".$_FILES["files".$i]["size"]."','".$_POST['id_product']."','".$active."')";
				$objQuery = mysqli_query($objConnect,$strSQL);
				// if($objQuery){
				// 	echo "Insert record complete<br>";
				// }else{
				// 	echo "Insert error!<br>".$strSQL;
				// }	
			}else{
				echo "error";
			}
		}
	}
	$str_ac = "SELECT name_image FROM product_image WHERE active = 'active' AND id_product = '".$_POST['id_product']."'";
	$query_ac = mysqli_query($objConnect,$str_ac);
	$result_ac = mysqli_fetch_array($query_ac);
	echo $result_ac['name_image'];
}
else
{
	for($i=0;$i<count($_FILES["files"]["name"]);$i++)
	{
		$str_chk = "SELECT name_image FROM product_image WHERE id_product = '".$_POST['id_product']."'";
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
			$target = "../../uploads/product/".$name;
			$newname = $name;

			if(file_exists($target)){
				$oldname = pathinfo($name, PATHINFO_FILENAME);
				$ext = pathinfo($name, PATHINFO_EXTENSION);
				$newname = $oldname;
				do{
					$r = rand(1000,9999);
					$newname = $oldname."-".$r.".$ext";
					$target = "../../uploads/product/".$newname;
				}while (file_exists($target)); 
			}
			// if(copy($_FILES["files"]["tmp_name"][$i],"image_product/thumbnail/".$_FILES["files"]["name"][$i]))
			if(copy($_FILES["files"]["tmp_name"][$i],$target))
			{
				$id_image = setMD5();
				// echo "Copy/Upload Complete<br>";
				$strSQL = "INSERT INTO product_image";
				$strSQL .= "(id_image,name_image,date_image,size_image,id_product,active)";
				$strSQL .= "VALUES ";
				$strSQL .= "('$id_image','".$newname."','".$date."','".$_FILES["files"]["size"][$i]."','".$_POST['id_product']."','".$active."')";
				$objQuery = mysqli_query($objConnect,$strSQL);
				// if($objQuery){
				// 	echo "Insert record complete<br>";
				// }else{
				// 	echo "Insert error!<br>".$strSQL;
				// }	
			}else{
				echo "error";
			}
		}
	}
	$str_ac = "SELECT * FROM product_image WHERE active = 'active' AND id_product = '".$_POST['id_product']."'";
	$query_ac = mysqli_query($objConnect,$str_ac);
	$result_ac = mysqli_fetch_array($query_ac);
	echo $result_ac['name_image'];
}
?>