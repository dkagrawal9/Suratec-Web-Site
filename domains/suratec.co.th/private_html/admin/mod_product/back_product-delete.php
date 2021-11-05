<?php
	require_once '../library/connect.php';
global $date;
	// $str_check = "SELECT * FROM orders_detail";
	// $query_check = mysqli_query($objConnect,$str_check);
	// while($result_check = mysqli_fetch_array($query_check)){
	// $cut = explode("-",$result_check['productID']);
	// if($_POST['id_del_product']==$cut[0]){
	// 	echo "exist";
	// 	exit;
	// 	}
	// }

	$str_attr = "SELECT * FROM product_attribute WHERE id_product = '".$_POST["id_del_product"]."'";
	$objQuery_attr = mysqli_query($objConnect,$str_attr);
	while($objResult_attr = mysqli_fetch_array($objQuery_attr)){
		// $strSQL_image = "SELECT * FROM product_image_attr WHERE id_attr = '".$objResult_attr["id_attr"]."'";
		// $objQuery_image = mysqli_query($objConnect,$strSQL_image);
		// while($objResult_image = mysqli_fetch_array($objQuery_image)){
		// $file = iconv("utf-8","tis-620",$objResult_image["name_image"]);
		// 	if($file != ""){
		// 		if(unlink("../../uploads/product/".$file)){
		// 			// DELETE  image_attr
		// 			$strSQL = "DELETE FROM product_image_attr WHERE id_attr = '".$objResult_attr["id_attr"]."' ";
		// 			$objQuery = mysqli_query($objConnect,$strSQL);
		// 				if($objQuery){
		// 					echo "Delete product_image complete [".$strSQL."]";
		// 				}else{
		// 					echo "error [".$strSQL."]";			
		// 				}
		// 			echo "Delete image_attr complete";
		// 		}
		// 	}
		// }

		$str_del_stock = "DELETE FROM product_stock WHERE id_product = '".$objResult_attr["id_attr"]."'";
		$query_del_stock = mysqli_query($objConnect,$str_del_stock);
		if($query_del_stock){
			echo 'SUCCESS'.$str_del_stock;
		}else{
			echo 'ERROR'.$str_del_stock;
		}
	}

	// DELETE image product
	// $strSQL = "SELECT * FROM product_image WHERE id_product = '".$_POST["id_del_product"]."'";
	// $objQuery = mysqli_query($objConnect,$strSQL);
	// while($objResult = mysqli_fetch_array($objQuery)){
	// $file = iconv("utf-8","tis-620",$objResult["name_image"]);
	// 	if($file != ""){
	// 		if(unlink("../../uploads/product/".$file)){
	// 			echo "Delete image complete";
	// 		}
	// 	}
	// }
	// DELETE record product_image
	// $strSQL = "DELETE FROM product_image WHERE id_product = '".$_POST["id_del_product"]."' ";
	// $objQuery = mysqli_query($objConnect,$strSQL);
	// 	if($objQuery){
	// 		echo "Delete product_image complete [".$strSQL."]";
	// 	}else{
	// 		echo "error [".$strSQL."]";			
	// 	}
	// DELETE record product_attribute
	$strSQL = "UPDATE `product_attribute` SET  `delete_datetime` = '$date' WHERE id_product = '".$_POST["id_del_product"]."' ";
	$objQuery = mysqli_query($objConnect,$strSQL);
		if($objQuery){
			echo "Delete product_attribute complete [".$strSQL."]";
		}else{
			echo "error [".$strSQL."]";			
		}

	// DELETE record product
	$strSQL = "UPDATE `product` SET `delete_datetime` ='$date' WHERE id_product = '".$_POST["id_del_product"]."' ";
	$objQuery = mysqli_query($objConnect,$strSQL);
		if($objQuery){
			echo "Delete Article complete [".$strSQL."]";
		}else{
			echo "error [".$strSQL."]";			
		}

?>