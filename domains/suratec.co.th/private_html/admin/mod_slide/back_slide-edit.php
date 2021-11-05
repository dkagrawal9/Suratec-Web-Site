<?php 
	require_once '../library/connect.php';


	$strSQL = "UPDATE slide SET";
	$strSQL .= " name_slide = '".$_POST["name_edit"]."' ";
	$strSQL .= " ,name_slide_en = '".$_POST["name_en_edit"]."' ";
	$strSQL .= " ,text = '".$_POST["content_slide"]."' ";
	$strSQL .= " ,text_en = '".$_POST["content_slide_en"]."' ";
	$strSQL .= " ,text_en = '".$_POST["content_slide_en"]."' ";
	// $strSQL .= " ,`id_slide_catagory` = '".$_POST["slide_catagory_edit"]."' ";
	$strSQL .= "WHERE id_slide = '".$_POST['id_slide']."' ";
	$objQuery = mysqli_query($objConnect,$strSQL);
	if($objQuery){
		echo "save done.<br>";
		echo $_FILES['image_slide']['name'];
	}
	else{
		echo "save error [".$strSQL."]";
	}
	//
	if(empty($_FILES['image_slide']['name'])){
		echo "image is not change";
	}else{
		$strSQL = "SELECT name_image FROM slide_image WHERE id_slide = '".$_POST["id_slide"]."'";
		$objQuery = mysqli_query($objConnect,$strSQL);
		$objResult = mysqli_fetch_array($objQuery);
		echo $file = iconv("utf-8","tis-620",$objResult["name_image"]);

			$namefile = $_FILES["image_slide"]["name"];
			$sur = strrchr($namefile, "."); //ตัดนามสกุลไฟล์เก็บไว้
			$name = "P-".(Date("dmy").rand(1000,9999).$sur); //ผมตั้งเป็น วันที่_เวลา.นามสกุล
			$target = "../../uploads/slide/".$name;
			$newname = $name;

			if(file_exists($target)){
				$oldname = pathinfo($name, PATHINFO_FILENAME);
				$ext = pathinfo($name, PATHINFO_EXTENSION);
				$newname = $oldname;
				do{
					$r = rand(1000,9999);
					$newname = $oldname."-".$r.".$ext";
					$target = "../../uploads/slide/".$newname;
				}while (file_exists($target)); 
			}

			if(copy($_FILES["image_slide"]["tmp_name"],$target)){
				echo "upload complete<br>";
			}
			// copy($_FILES["image_slide"]["tmp_name"],"image-slide/".$_FILES["image_slide"]["name"]);
		if(unlink("../../uploads/slide/".$file)){
			echo "Delete old image complete<br>";
			echo "change image Complete<br>";
			$strSQL = "UPDATE slide_image SET";
			$strSQL .= " name_image = '".$newname."' ";
			$strSQL .= " ,size = '".$_FILES["image_slide"]["size"]."' ";
			$strSQL .= "WHERE id_slide= '".$_POST['id_slide']."' ";
			$objQuery = mysqli_query($objConnect,$strSQL);
			if ($objQuery) {
				echo "Update Name ,Size and Date in mysql Complete.";
			}else{
				echo "Update Error.";
			}
		}else{
			echo "Can not delete your image ".$filename;
		}
	}
	// header('Refresh: 0; url=manage-menu.php');
?>