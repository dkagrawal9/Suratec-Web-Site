<?php
	session_start();
	header('Content-Type: application/json');
	require_once '../library/connect.php';

	$str = "SELECT * from product_image_thumb WHERE user_id = '".$_SESSION['user_member']."'";
	$query = mysqli_query($objConnect,$str);

	$rows = mysqli_num_rows($query);
	if($rows > 0){
		echo json_encode(array('status' => '1','message'=> 'overflow'));
	}else{
		echo json_encode(array('status' => '0','message'=> 'overflow'));
	}
?>