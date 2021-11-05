<?php
require_once '../library/connect.php';
global $objConnect;
global $date;

$strSQL = "UPDATE article SET";
  $strSQL .= " delete_datetime = '".$date."' ";
	$strSQL .= "WHERE id_article = '".$_POST['id_del_article']."' ";
	$objQuery = mysqli_query($objConnect,$strSQL);
	if($objQuery){
		echo "save done.<br> [".$strSQL."]";
		
	}
	else{
		echo "save error [".$strSQL."]";
	}
?>
