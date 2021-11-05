<?php
	require_once '../library/connect.php';
	header('Content-Type: application/json');
	$str = "SELECT * from product_image WHERE id_product='".$_POST['id']."'";
	$query = mysqli_query($objConnect,$str);

	$rows = mysqli_num_rows($query);
	if($rows > 0){
		// echo "Yes";
		echo json_encode(array('status' => '1','message'=> 'overflow'));
	}else{
		// echo "No";
		echo json_encode(array('status' => '0','message'=> 'overflow'));
	}
?>