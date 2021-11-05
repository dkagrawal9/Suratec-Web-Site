<?php
	require_once '../library/connect.php';
	$strSQL = "UPDATE article_catagory SET";
	$strSQL .= " name_catagory = '".$_POST["name"]."' ";
	$strSQL .= ",name_catagory_en = '".$_POST["name_en"]."' ";
	$strSQL .= "WHERE id_catagory = '".$_POST['id']."' ";
	$objQuery = mysqli_query($objConnect,$strSQL);
	if($objQuery){
		echo "complete".$strSQL;
	}else{
		echo "not complete".$strSQL;
	}
?>