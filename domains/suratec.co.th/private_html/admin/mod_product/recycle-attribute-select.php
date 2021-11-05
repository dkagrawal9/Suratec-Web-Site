<?php 
	require_once '../library/connect.php';
	$str = "SELECT * FROM bin_attr WHERE id_product =".$_POST['id'];
	$query = mysqli_query($objConnect,$str);
	$row = mysqli_num_rows($query);
	if($row > 0){
		$restore = "INSERT INTO product_attribute SELECT * FROM bin_attr WHERE id_product =".$_POST['id'];
		$query_re = mysqli_query($objConnect,$restore);
		if($query_re){
			$str_del = "DELETE FROM bin_attr WHERE id_product =".$_POST['id'];
			$query_del = mysqli_query($objConnect,$str_del);
		}
	}else{
		echo "NOT EXISTE.".$query_re;;
	}
?>