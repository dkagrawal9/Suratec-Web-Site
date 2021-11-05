<?php 
	 require_once '../library/connect.php';
	  global $objConnect;
	 global $date;
	$strSQL = "UPDATE page SET";
	$strSQL .= " name = '".$_POST["name"]."' ";
	$strSQL .= " ,data = '".$_POST["editor"]."' ";
	$strSQL .= " ,url = '".$_POST["link"]."' ";
	$strSQL .= " ,update_time = '$date' ";
	$strSQL .= "WHERE id = '".$_POST['id']."' ";
	$objQuery = mysqli_query($objConnect,$strSQL);
	if($objQuery){
		echo "save done.<br> [".$strSQL."]";
		
	}
	else{
		echo "save error [".$strSQL."]";
	}
	//
	
	
?>