<?php
	require_once '../library/connect.php';
	date_default_timezone_set("Asia/Bangkok");
	$date = date("Y-m-d");
	$strSQL = "INSERT INTO article_catagory";
	$strSQL .= "(name_catagory,name_catagory_en,date_catagory)";
	$strSQL .= "VALUES ";
	$strSQL .= "('".$_POST['name']."','".$_POST['name_en']."','".$date."')";
	$objQuery = mysqli_query($objConnect,$strSQL);
	if($objQuery){
		echo "complete".$strSQL;
	}else{
		echo "not complete".$strSQL;
	}
?>