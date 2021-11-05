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
			$path = '../../uploads/mod_team/';
			if(!is_dir($path)){
				mkdir($path,0777);
			}

			$namefile = $_FILES["image"]["name"];
			$sur = strrchr($namefile, "."); //ตัดนามสกุลไฟล์เก็บไว้
			$name = "BK-".(Date("dmy").rand('1000','9999').$sur); //ผมตั้งเป็น วันที่_เวลา.นามสกุล
			$target = "../../uploads/mod_team/".$name;
			$newname = $name;

			if(file_exists($target)){
				$oldname = pathinfo($name, PATHINFO_FILENAME);
				$ext = pathinfo($name, PATHINFO_EXTENSION);
				$newname = $oldname;
				do{
					$r = rand(1000,9999);
					$newname = $oldname."-".$r.".$ext";
					$target = "../../uploads/mod_team/".$newname;
				}while (file_exists($target)); 
			}
			
			if(copy($_FILES["image"]["tmp_name"],iconv('UTF-8','windows-874',"../../uploads/mod_team/".$newname))){
				echo "Copy/Upload Complete<br>";
			}else{
				echo "Copy/upload error<br>";
			}
			
			$image_path = $newname;

		}else{
			$image_path = '';
		}


		$sql = "INSERT INTO mod_team (name,position,order_no,img_drirect,img_name,create_date,name_en,position_en) VALUES('".$_POST['name']."','".$_POST['position']."','".$_POST['order_no']."','../../uploads/mod_team/','$image_path','$date','".$_POST['name_en']."','".$_POST['position_en']."')";
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

	$sql = "SELECT * FROM mod_team WHERE team_id = '".$_POST['team_id']."'";
	$query = mysqli_query($objConnect,$sql);
	$result = mysqli_fetch_array($query);

		if($_FILES['image-edit']['name']!=''){
			$path = '../../uploads/mod_team/';
			if(!is_dir($path)){
				mkdir($path,0777);
			}

			$namefile = $_FILES["image-edit"]["name"];
			$sur = strrchr($namefile, "."); //ตัดนามสกุลไฟล์เก็บไว้
			$name = "PR-".(Date("dmy").rand('1000','9999').$sur); //ผมตั้งเป็น วันที่_เวลา.นามสกุล
			$target = "../../uploads/mod_team/".$name;
			$newname = $name;

			if(file_exists($target)){
				$oldname = pathinfo($name, PATHINFO_FILENAME);
				$ext = pathinfo($name, PATHINFO_EXTENSION);
				$newname = $oldname;
				do{
					$r = rand(1000,9999);
					$newname = $oldname."-".$r.".$ext";
					$target = "../../uploads/mod_team/".$newname;
				}while (file_exists($target)); 
			}
			
			if(copy($_FILES["image-edit"]["tmp_name"],iconv('UTF-8','windows-874',"../../uploads/mod_team/".$newname))){
				echo "Copy/Upload Complete<br>";
			}else{
				echo "Copy/upload error<br>";
			}

			if($result['img_name']!=''){
				unlink('../../uploads/mod_team/'.$result['img_name']);
				$image_path = $newname;
			}else{
				$image_path = $newname;
			}
		}else{
			$image_path = $result['img_name'];
		}


	$sql = 'UPDATE mod_team SET name = "'.$_POST['name'].'", position = "'.$_POST['position'].'",name_en = "'.$_POST['name_en'].'", position_en = "'.$_POST['position_en'].'", order_no = "'.$_POST['order_no'].'", update_date = "'.$date.'", img_name = "'.$image_path.'" WHERE team_id = "'.$_POST['team_id'].'"  ';
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

	$sql = "UPDATE mod_team SET delete_date = '".$date."' WHERE team_id = '".$_POST['team_id']."' ";
	$query = mysqli_query($objConnect,$sql);

	if($query){
		echo json_encode(array('status' => '1', 'message' => $sql));
	}else{
		echo json_encode(array('status' => '0', 'message' => $sql));
	}
}

?>