<?php
require_once '../library/connect.php';
header('Content-Type: application/json');


	$str = "SELECT * FROM mod_order where  id_order = '".$q."'

";

// 	$resultArray = array();
// 	$query = mysqli_query($objConnect,$str);
// 	while($result = mysqli_fetch_array($query,MYSQLI_ASSOC)){
// 		array_push($resultArray, $result);
// 	}
// 	echo json_encode(['data'=> $resultArray]);
?>