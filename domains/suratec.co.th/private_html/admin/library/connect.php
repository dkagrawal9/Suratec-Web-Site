<?php
	require_once 'config.php';
	
	$objConnect = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
	mysqli_set_charset($objConnect, "utf8");
	date_default_timezone_set("Asia/Bangkok");
	//*** Reject user not online
?>
