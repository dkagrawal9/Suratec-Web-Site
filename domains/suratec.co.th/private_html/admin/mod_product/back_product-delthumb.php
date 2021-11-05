<?php
	require_once '../library/connect.php';
	$strSQL = "SELECT * FROM product_image_thumb WHERE id_thumb = '".$_POST["id"]."'";
	$objQuery = mysqli_query($objConnect,$strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	$file = iconv("utf-8","tis-620",$objResult["name_thumb"]);

	if(unlink("../../uploads/product/thumbnail/".$file)){
		// echo "Delete image complete";
	}else{
		echo "false ...";
	}
	$strSQL = "DELETE FROM product_image_thumb WHERE id_thumb =".$_POST['id'];
	$strQuery = mysqli_query($objConnect,$strSQL);

	// if($strQuery){
	// 	echo "complete  ...".$strSQL;
	// }else{
	// 	echo "error ...".$strSQL;
	// }

	$strSQL = "SELECT * FROM product_image_thumb";
	$query = mysqli_query($objConnect,$strSQL);
	$row = mysqli_num_rows($query);
	if($row>0){
		while($result = mysqli_fetch_array($query)){
			$num .= $result['id_thumb']."-";
			$active_to .= $result['active']."-";
		}
		$active_cut = explode("-", $active_to);
		if(!in_array("active", $active_cut)){
			$cut_num = explode("-", $num);
			$str_ac = "UPDATE product_image_thumb SET";
			$str_ac .= " active = 'active' ";
			$str_ac .= "WHERE id_thumb = ".$cut_num[0]." ";
			$query_ac = mysqli_query($objConnect,$str_ac);
			// if($query_ac){
			// 	echo "commplete".$str_ac;
			// }else{
			// 	echo "eror".$str_ac;
			// }
		}
	}
$str_ac = "SELECT name_thumb FROM product_image_thumb WHERE active = 'active'";
$query_ac = mysqli_query($objConnect,$str_ac);
$result_ac = mysqli_fetch_array($query_ac);
echo $result_ac['name_thumb'];
?>