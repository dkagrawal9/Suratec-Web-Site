<?php 
	require_once '../library/connect.php';
	$cutid = explode("-", $_POST["id"]);
	$id = $cutid[0];
	$set = $cutid[1]; 
	//-------------------------------------SET "" ---------------------------------
	$str = "UPDATE product_image SET active ='' WHERE id_product = '$set'";
	$query = mysqli_query($objConnect,$str);
	//------------------------------------SET active-------------------------------
	$str = "UPDATE product_image SET active ='active' WHERE id_image = '$id'";
	$query = mysqli_query($objConnect,$str);
	if($query){
		echo "complete".$str;
	}else{
		echo "not complete".$str;
	}
?>