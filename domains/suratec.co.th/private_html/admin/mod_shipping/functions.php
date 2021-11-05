<?php
require_once '../library/connect.php';

	if(isset($_POST['_method'])){
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
	}

	function CREATE(){
		global $objConnect;
		global $date;


		$str = "INSERT INTO mod_shipping (name_shipping,price,create_datetime,update_datetime)VALUES ('".$_POST['name_shipping']."','".$_POST['price']."','$date','$date')";
		$query = mysqli_query($objConnect,$str);

		if($query){
			$id_shipping = mysqli_insert_id($objConnect);
			echo json_encode(array('status' => '1', 'message' => $str));
		}else{
			echo json_encode(array('status' => '0', 'message' => $str));
		}

	}


	function PATCH(){
		global $objConnect;
		global $date;
			$str = "UPDATE mod_shipping SET ";
			$str .= " name_shipping = '".$_POST['name_shipping']."'";
			$str .= " ,price = '".$_POST['price']."'";
			$str .= " ,update_datetime = '$date'";
			$str .= " WHERE id_shipping = '".$_POST['id_shipping']."'";
			$query = mysqli_query($objConnect,$str);
			if($query){
				echo "complete".$str;
			}else{
				echo "error".$str;
			}
	}

	function DELETE(){
		global $objConnect;
		global $date;

		$str = "UPDATE mod_shipping SET delete_datetime = '$date' WHERE id_shipping = '".$_POST['id_shipping']."'";
		$query = mysqli_query($objConnect,$str);

		if($query){
			echo json_encode(array('status' => '1', 'message' => $str));
		}else{
			echo json_encode(array('status' => '0', 'message' => $str));
		}
	}

?>