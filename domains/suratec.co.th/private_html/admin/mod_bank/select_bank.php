<?php
require_once '../library/connect.php';
header('Content-Type: application/json');

	$str = "SELECT * FROM mod_bank WHERE delete_datetime IS NULL";

	$resultArray = array();
	$query = mysqli_query($objConnect,$str);
	while($result = mysqli_fetch_array($query,MYSQLI_ASSOC)){
		array_push($resultArray, $result);
	}
	echo json_encode(['data'=> $resultArray]);
?>