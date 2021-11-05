<?php 
	require_once '../library/connect.php';
	$id = $_POST["id"];
	//-------------------------------------SET "" ---------------------------------
	$str = "UPDATE product_image_thumb SET active =''";
	$query = mysqli_query($objConnect,$str);
	//------------------------------------SET active-------------------------------
	$str = "UPDATE product_image_thumb SET active ='active' WHERE id_thumb = $id";
	$query = mysqli_query($objConnect,$str);
	if($query){
		echo "complete".$str;
	}else{
		echo "not complete".$str;
	}
?>