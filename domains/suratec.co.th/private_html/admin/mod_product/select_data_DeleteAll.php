<?php
	session_start();
	require_once '../library/connect.php';

	$str = "SELECT * from product_image_thumb WHERE user_id = '".$_SESSION['user_member']."'";
	$query = mysqli_query($objConnect,$str);
	$rows = mysqli_num_rows($query);
	while($result = mysqli_fetch_array($query)){
		$file = iconv("utf-8","tis-620",$result["name_thumb"]);
		if(unlink("../../uploads/product/thumbnail/".$file)){
			echo "Delete image complete";
		}
	}

	$str = "DELETE from product_image_thumb WHERE user_id = '".$_SESSION['user_member']."'";
	$query = mysqli_query($objConnect,$str);
	if($query){
		echo "complete";
	}else{
		echo "error".$queryall;
	}
?>