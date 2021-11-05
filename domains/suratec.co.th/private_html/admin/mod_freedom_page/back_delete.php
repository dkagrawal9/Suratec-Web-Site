<?php
	require_once '../library/connect.php';
	// $strSQL = "SELECT * FROM slide_image WHERE id_slide = '".$_POST["id_del_slide"]."'";
	// $objQuery = mysqli_query($objConnect,$strSQL);
	// $objResult = mysqli_fetch_array($objQuery);
	// $file = iconv("utf-8","tis-620",$objResult["name_image"]);
	// if(unlink("../../uploads/slide/".$file)){
	// 	echo "Delete image complete";
	// }
	
	$strSQL = "DELETE FROM `freedom_page` WHERE `id_page` = '".$_POST["id_del_article"]."'";
	$objQuery = mysqli_query($objConnect,$strSQL);
	if($objQuery){
		echo "Delete in mysql.";
	}
	else{
		echo "error in mysql [".$strSQL."]";
	}
	mysqli_close($objConnect);
	// header('Refresh: 0; url=manage-slide.php');
?>
