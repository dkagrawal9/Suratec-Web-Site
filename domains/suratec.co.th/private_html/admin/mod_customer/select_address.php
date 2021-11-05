<?php
require_once '../library/connect.php';
header('Content-Type: application/json');

	$str = "SELECT * FROM mod_customer_address WHERE id_customer = '".$_GET['id']."' AND (delete_datetime IS NULL OR delete_datetime ='0000-00-00 00:00:00') ";

	$resultArray = array();
	$query = mysqli_query($objConnect,$str);
	while($result = mysqli_fetch_array($query,MYSQLI_ASSOC)){
		array_push($resultArray, $result);
	}
	echo json_encode(['data'=> $resultArray]);
?>