<?php
require_once '../admin/library/connect.php';
header('Content-Type: application/json');

    if(!isset($_SESSION)) {
        session_start();
    }

	$str = "SELECT * FROM mod_order WHERE `id_customer` = '".$_SESSION['id_customer']."' ";

	$resultArray = array();
	$query = mysqli_query($objConnect,$str);
	while($result = mysqli_fetch_array($query,MYSQLI_ASSOC)){
		array_push($resultArray, $result);
	}
	echo json_encode(['data'=> $resultArray]);
	
?>
