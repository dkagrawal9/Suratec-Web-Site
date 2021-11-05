<?php
require_once '../library/connect.php';
header('Content-Type: application/json');

	$str = "SELECT CONCAT(mod_customer.fname,' ',mod_customer.lname) AS name, mod_customer.telephone, mod_customer.email,mod_customer.id_customer  FROM `mod_customer` WHERE `delete_datetime` IS null OR delete_datetime='0000-00-00 00:00:00'";

	$resultArray = array();
	$query = mysqli_query($objConnect,$str);
	while($result = mysqli_fetch_array($query,MYSQLI_ASSOC)){
		array_push($resultArray, $result);
	}
	echo json_encode(['data'=> $resultArray]);
?>