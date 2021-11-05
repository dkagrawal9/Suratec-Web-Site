<?php
	require_once '../library/connect.php';

	$str = "SELECT * from product_image WHERE id_product = '".$_POST['id']."'";
	$query = mysqli_query($objConnect,$str);
	$rows = mysqli_num_rows($query);
	while($result = mysqli_fetch_array($query)){
		$file = iconv("utf-8","tis-620",$result["name_image"]);
		if(unlink("../../uploads/product/".$file)){
			echo "Delete image complete";
		}
	}

	$str = "DELETE from product_image WHERE id_product = '".$_POST['id']."'";
	$query = mysqli_query($objConnect,$str);
	if($query){
		echo "complete";
	}else{
		echo "error".$queryall;
	}
?>