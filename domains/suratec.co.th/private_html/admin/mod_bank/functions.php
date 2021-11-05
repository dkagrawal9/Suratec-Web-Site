<?php
require_once '../library/connect.php';

if($_POST['_method']=='CREATE'){
	CREATE();
	exit;
}elseif($_POST['_method']=='PATCH'){
	PATCH();
	exit;
}elseif($_POST['_method']=='DELETE'){
	DELETE();
	exit;
}


function CREATE(){
	global $objConnect;
	global $date;

	if($_FILES['image']['name']!=''){
			$path = '../../uploads/bank';
			if(!is_dir($path)){
				mkdir($path,0777);
			}

			$namefile = $_FILES["image"]["name"];
			$sur = strrchr($namefile, "."); //ตัดนามสกุลไฟล์เก็บไว้
			$name = "BK-".(Date("dmy").rand('1000','9999').$sur); //ผมตั้งเป็น วันที่_เวลา.นามสกุล
			$target = "../../uploads/bank/".$name;
			$newname = $name;

			if(file_exists($target)){
				$oldname = pathinfo($name, PATHINFO_FILENAME);
				$ext = pathinfo($name, PATHINFO_EXTENSION);
				$newname = $oldname;
				do{
					$r = rand(1000,9999);
					$newname = $oldname."-".$r.".$ext";
					$target = "../../uploads/bank/".$newname;
				}while (file_exists($target)); 
			}
			
			if(copy($_FILES["image"]["tmp_name"],iconv('UTF-8','windows-874',"../../uploads/bank/".$newname))){
				echo "Copy/Upload Complete<br>";
			}else{
				echo "Copy/upload error<br>";
			}
			
			$image_path = $newname;

		}else{
			$image_path = '';
		}


		$sql = "INSERT INTO mod_bank (name_bank,branch,name_asset,code_asset,img_path,create_datetime,update_datetime) VALUES('".$_POST['name_bank']."','".$_POST['branch']."','".$_POST['name_asset']."','".$_POST['code_asset']."','$image_path','$date','$date')";
		$query = mysqli_query($objConnect,$sql);

		if($query){
			echo json_encode(array('status' => '1', 'message' => $sql));
		}else{
			echo json_encode(array('status' => '0', 'message' => $sql));
		}
	}

function PATCH(){
	global $objConnect;
	global $date;

	$sql = "SELECT * FROM mod_bank WHERE id_bank = '".$_POST['id_bank']."'";
	$query = mysqli_query($objConnect,$sql);
	$result = mysqli_fetch_array($query);

		if($_FILES['image-edit']['name']!=''){
			$path = '../../uploads/bank';
			if(!is_dir($path)){
				mkdir($path,0777);
			}

			$namefile = $_FILES["image-edit"]["name"];
			$sur = strrchr($namefile, "."); //ตัดนามสกุลไฟล์เก็บไว้
			$name = "PR-".(Date("dmy").rand('1000','9999').$sur); //ผมตั้งเป็น วันที่_เวลา.นามสกุล
			$target = "../../uploads/bank/".$name;
			$newname = $name;

			if(file_exists($target)){
				$oldname = pathinfo($name, PATHINFO_FILENAME);
				$ext = pathinfo($name, PATHINFO_EXTENSION);
				$newname = $oldname;
				do{
					$r = rand(1000,9999);
					$newname = $oldname."-".$r.".$ext";
					$target = "../../uploads/bank/".$newname;
				}while (file_exists($target)); 
			}
			
			if(copy($_FILES["image-edit"]["tmp_name"],iconv('UTF-8','windows-874',"../../uploads/bank/".$newname))){
				echo "Copy/Upload Complete<br>";
			}else{
				echo "Copy/upload error<br>";
			}

			if($result['img_path']!=''){
				unlink('../../uploads/bank/'.$result['img_path']);
				$image_path = $newname;
			}else{
				$image_path = $newname;
			}
		}else{
			$image_path = $result['img_path'];
		}


	$sql = 'UPDATE mod_bank SET name_bank = "'.$_POST['name_bank'].'", branch = "'.$_POST['branch'].'", name_asset = "'.$_POST['name_asset'].'",code_asset = "'.$_POST['code_asset'].'", update_datetime = "'.$date.'", img_path = "'.$image_path.'" WHERE id_bank = "'.$_POST['id_bank'].'"  ';
	$query = mysqli_query($objConnect,$sql);

	if($query){
		echo json_encode(array('status' => '1', 'message' => $sql));
	}else{
		echo json_encode(array('status' => '0', 'message' => $sql));
	}
}

function DELETE(){
	global $objConnect;
	global $date;

	$sql = "UPDATE mod_bank SET delete_datetime = '".$date."' WHERE id_bank = '".$_POST['id_bank']."' ";
	$query = mysqli_query($objConnect,$sql);

	if($query){
		echo json_encode(array('status' => '1', 'message' => $sql));
	}else{
		echo json_encode(array('status' => '0', 'message' => $sql));
	}
}

?>