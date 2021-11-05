<?php 
require_once '../library/connect.php';
function change_image(){
	include '../library/connect.php';
	$strSQL = "SELECT img,id_catagory FROM product_catagory WHERE id_catagory = '".$_POST["id_modal"]."'";
	$objQuery = mysqli_query($objConnect,$strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	$file = iconv("utf-8","tis-620",$objResult["img"]);
	echo $_FILES["image_catagory"]["name"];
	echo $_FILES["image_catagory"]["tmp_name"];

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
		echo "upload complete<br>";
	}

	if($file != ''){
		if(unlink("../../uploads/category/".$file)){
			echo "complete";
		}else{
			echo "Can not delete your image ".$filename;
		}
	}
	return $newname;
}
//! end funtion change image........................................................................

if(isset($_POST['id_modal']))
{
	if(empty($_POST['cat_']))
	{
		if(empty($_FILES["image_catagory"]["name"])){
			echo "image is not change";
			$str = "UPDATE product_catagory SET ";
			$str .= " name_catagory ='".$_POST['name']."' ";
			$str .= " ,name_catagory_en ='".$_POST['name_en']."' ";
			// $str .= " ,icon = '".$_POST['icon']."'";
			$str .= "WHERE id_catagory = '".$_POST['id_modal']."' ";
			$query = mysqli_query($objConnect,$str);
			if($query){
				echo "complete".$str;
			}else{
				echo "error".$str;
			}
			echo 'ค่าว่างน่ะ';
			exit;
		}else{
			$newname = change_image();
			$str = "UPDATE product_catagory SET ";
			$str .= " name_catagory ='".$_POST['name']."' ";
			$str .= " ,name_catagory_en ='".$_POST['name_en']."' ";
			$str .= " ,img ='".$newname."' ";
			// $str .= " ,icon = '".$_POST['icon']."'";
			$str .= "WHERE id_catagory = '".$_POST['id_modal']."' ";
			$query = mysqli_query($objConnect,$str);
			if($query){
				echo "complete".$str;
			}else{
				echo "error".$str;
			}
			echo 'ค่าว่างน่ะ';
			exit;
		}
	}
	else
	{
		$cut = explode("-",$_POST['cat_']);// 0 เปลี่ยนซับ 1 คือเลขที่จะเปลี่ยน
		if($cut[0] =='0'){
			$group = "";
			$level = "1";

			$str1 = "SELECT * from product_catagory WHERE id_catagory = '".$cut[2]."'";
			$query1 = mysqli_query($objConnect,$str1);
			$result1 = mysqli_fetch_array($query1);

			$str2 = "SELECT * from product_catagory WHERE group_sub = '".$result1['id_catagory']."'";
			$query2 = mysqli_query($objConnect,$str2);
			while($result2 = mysqli_fetch_array($query2)){
				echo $result2['name_catagory'];
				$str = "UPDATE product_catagory SET ";
				$str .= " level ='2' ";//-----------------------------------จาก3 มาเป็น2
				$str .= "WHERE id_catagory = '".$result2['id_catagory']."' ";
				$query = mysqli_query($objConnect,$str);
					if($query){
						echo "complete".$str.'test = '.$cut[2]."<br>";
					}else{
						echo "error".$str."<br>";
					}
			}

		}
		elseif($cut[0] == 1)
		{
			$level = '2';
			$group = $cut[1];

			$str1 = "SELECT * from product_catagory WHERE id_catagory = '".$cut[2]."'";
			$query1 = mysqli_query($objConnect,$str1);
			$result1 = mysqli_fetch_array($query1);

			$str2 = "SELECT * from product_catagory WHERE group_sub = '".$result1['id_catagory']."'";
			$query2 = mysqli_query($objConnect,$str2);
			while($result2 = mysqli_fetch_array($query2)){
				echo $result2['name_catagory'];
				$str = "UPDATE product_catagory SET ";
				$str .= " level ='3' ";
				$str .= "WHERE id_catagory = '".$result2['id_catagory']."' ";
				$query = mysqli_query($objConnect,$str);
					if($query){
						echo "complete".$str."<br>";
					}else{
						echo "error".$str."<br>";
					}
			$str3 = "DELETE FROM product_catagory WHERE level ='3' AND group_sub = '".$result2['id_catagory']."'";
			$query3 = mysqli_query($objConnect,$str3);
				if($query3){
					echo "DEL 3".$str3."<br>";
				}else{
					echo "ERR 3".$str3."<br>";
				}
			}

		}
		else
		{
			$level = '3';
			$group = $cut[1];

			$str1 = "SELECT * from product_catagory WHERE id_catagory = '".$cut[2]."'";
			$query1 = mysqli_query($objConnect,$str1);
			$result1 = mysqli_fetch_array($query1);

			$str2 = "SELECT * from product_catagory WHERE group_sub = '".$result1['id_catagory']."'";
			$query2 = mysqli_query($objConnect,$str2);
			while($result2 = mysqli_fetch_array($query2)){
				if($result2['level']==3)
				{
					$str = "DELETE FROM product_catagory WHERE level ='3' AND group_sub = '".$result2['group_sub']."'";
					$query = mysqli_query($objConnect,$str);
					echo $str;
				}
				else
				{
					$str2 = "SELECT * from product_catagory WHERE group_sub = '".$result1['id_catagory']."'";
					$query2 = mysqli_query($objConnect,$str2);
					while($result2 = mysqli_fetch_array($query2)){
						$str = "DELETE FROM product_catagory WHERE level ='2' AND group_sub = '".$result2['group_sub']."'";
						$query = mysqli_query($objConnect,$str);
						echo $str;

						$str3 = "DELETE FROM product_catagory WHERE level ='3' AND group_sub = '".$result2['id_catagory']."'";
						$query3 = mysqli_query($objConnect,$str3);
						if($query3)
						{
							echo "DEL 3".$str3."<br>";
						}
						else
						{
							echo "ERR 3".$str3."<br>";
						}
					}
				}
			}
		}
		//-----------------------------------------------------------------เปลี่ยน ตัวหลักที่ส่งเข้ามา-----------------------------////////////////////////////
		$str = "UPDATE product_catagory SET ";
		$str .= " group_sub ='".$group."' ";
		$str .= " ,level ='".$level."' ";
		$str .= " ,name_catagory ='".$_POST['name']."' ";
		$str .= " ,name_catagory_en ='".$_POST['name_en']."' ";
		$str .= "WHERE id_catagory = '".$cut[2]."' ";
		$query = mysqli_query($objConnect,$str);
		if($query)
		{
			echo "complete".$str;
		}
		else
		{
			echo "error".$str;
		}
	}
}
//_____________________________________________________________________________________________________________________________________________________________
//_____________________________________________________________________________________________________________________________________________________________
//_____________________________________________________________________________________________________________________________________________________________
elseif(isset($_POST['id_id']))
{
	$cut = explode("-",$_POST['id_id']);// 0 เปลี่ยนซับ 1 คือเลขที่จะเปลี่ยน
	if($cut[0] =='0'){
		$group = "";
		$level = "1";

		$str1 = "SELECT * from product_catagory WHERE id_catagory = '".$cut[2]."'";
		$query1 = mysqli_query($objConnect,$str1);
		$result1 = mysqli_fetch_array($query1);

		$str2 = "SELECT * from product_catagory WHERE group_sub = '".$result1['id_catagory']."'";
		$query2 = mysqli_query($objConnect,$str2);
		while($result2 = mysqli_fetch_array($query2)){
			echo $result2['name_catagory'];
			$str = "UPDATE product_catagory SET ";
			$str .= " level ='2' ";//-----------------------------------จาก3 มาเป็น2
			$str .= "WHERE id_catagory = '".$result2['id_catagory']."' ";
			$query = mysqli_query($objConnect,$str);
				if($query){
					echo "complete".$str.'test = '.$cut[2]."<br>";
				}else{
					echo "error".$str."<br>";
				}
		}

	}elseif($cut[0] == 1){
		$level = '2';
		$group = $cut[1];

		$str1 = "SELECT * from product_catagory WHERE id_catagory = '".$cut[2]."'";
		$query1 = mysqli_query($objConnect,$str1);
		$result1 = mysqli_fetch_array($query1);

		$str2 = "SELECT * from product_catagory WHERE group_sub = '".$result1['id_catagory']."'";
		$query2 = mysqli_query($objConnect,$str2);
		while($result2 = mysqli_fetch_array($query2)){
			echo $result2['name_catagory'];
			$str = "UPDATE product_catagory SET ";
			$str .= " level ='3' ";
			$str .= "WHERE id_catagory = '".$result2['id_catagory']."' ";
			$query = mysqli_query($objConnect,$str);
				if($query){
					echo "complete".$str."<br>";
				}else{
					echo "error".$str."<br>";
				}
		$str3 = "DELETE FROM product_catagory WHERE level ='3' AND group_sub = '".$result2['id_catagory']."'";
		$query3 = mysqli_query($objConnect,$str3);
			if($query3){
				echo "DEL 3".$str3."<br>";
			}else{
				echo "ERR 3".$str3."<br>";
			}
		}

	}else{
		$level = '3';
		$group = $cut[1];

		$str1 = "SELECT * from product_catagory WHERE id_catagory = '".$cut[2]."'";
		$query1 = mysqli_query($objConnect,$str1);
		$result1 = mysqli_fetch_array($query1);

		$str2 = "SELECT * from product_catagory WHERE group_sub = '".$result1['id_catagory']."'";
		$query2 = mysqli_query($objConnect,$str2);
		while($result2 = mysqli_fetch_array($query2)){
			if($result2['level']==3){
				$str = "DELETE FROM product_catagory WHERE level ='3' AND group_sub = '".$result2['group_sub']."'";
				$query = mysqli_query($objConnect,$str);
				echo $str;
			}else{
				$str2 = "SELECT * from product_catagory WHERE group_sub = '".$result1['id_catagory']."'";
				$query2 = mysqli_query($objConnect,$str2);
				while($result2 = mysqli_fetch_array($query2)){
					$str = "DELETE FROM product_catagory WHERE level ='2' AND group_sub = '".$result2['group_sub']."'";
					$query = mysqli_query($objConnect,$str);
					echo $str;

					$str3 = "DELETE FROM product_catagory WHERE level ='3' AND group_sub = '".$result2['id_catagory']."'";
					$query3 = mysqli_query($objConnect,$str3);
					if($query3){
						echo "DEL 3".$str3."<br>";
					}else{
						echo "ERR 3".$str3."<br>";
					}
				}
			}
			// $str = "DELETE FROM product_catagory WHERE level ='3' AND group_sub = '".$result2['id_catagory']."'";
			// $query = mysqli_query($objConnect,$str);
			// if($query){
			// 	echo "DEL 2".$str."<br>";
			// }else{
			// 	echo "DEL 2".$str."<br>";
			// }
		}
	}
	//-----------------------------------------------------------------เปลี่ยน ตัวหลักที่ส่งเข้ามา-----------------------------////////////////////////////
	$str = "UPDATE product_catagory SET ";
	$str .= " group_sub ='".$group."' ";
	$str .= " ,level ='".$level."' ";
	$str .= "WHERE id_catagory = '".$cut[2]."' ";
	$query = mysqli_query($objConnect,$str);
		if($query){
			echo "complete".$str;
		}else{
			echo "error".$str;
		}

}
elseif (isset($_POST['id_catagory'])) 
{
	$str = "UPDATE product_catagory SET ";
	$str .= " icon ='".$_POST['icon']."' ";
	$str .= "WHERE id_catagory = '".$_POST['id_catagory']."' ";
	$query = mysqli_query($objConnect,$str);
		if($query){
			echo "complete".$str;
		}else{
			echo "error".$str;
		}
}
else
{
		$cut = explode("-",$_POST['id']);
		if($cut[2]=='en'){
			$str = "UPDATE product_catagory SET ";
			$str .= " name_catagory_en ='".$cut[0]."' ";
			$str .= "WHERE id_catagory = '".$cut[1]."' ";
			$query = mysqli_query($objConnect,$str);
			if($query){
				echo "complete".$str;
			}else{
				echo "error".$str;
			}
		}else{
			$str = "UPDATE product_catagory SET ";
			$str .= " name_catagory ='".$cut[0]."' ";
			$str .= "WHERE id_catagory = '".$cut[1]."' ";
			$query = mysqli_query($objConnect,$str);
			if($query){
				echo "complete".$str;
			}else{
				echo "error".$str;
			}
		}
}
?>