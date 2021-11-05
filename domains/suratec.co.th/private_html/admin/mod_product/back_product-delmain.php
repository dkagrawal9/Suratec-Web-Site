<?php
	require_once '../library/connect.php';
	$strSQL = "SELECT * FROM product_image WHERE id_image = '".$_POST["id"]."'";
	$objQuery = mysqli_query($objConnect,$strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	$file = iconv("utf-8","tis-620",$objResult["name_image"]);
	$product = $objResult['id_product'];

	if(unlink("../../uploads/product/".$file)){
		// echo "Delete image complete";
	}else{
		echo "false ...";
	}
	$strSQL = "DELETE FROM product_image WHERE id_image = '".$_POST['id']."'";
	$strQuery = mysqli_query($objConnect,$strSQL);

	$strSQL = "SELECT * FROM product_image WHERE id_product = '".$product."'";
	$query = mysqli_query($objConnect,$strSQL);
	$row = mysqli_num_rows($query);
	$num = '';
	$active_to = '';
	if($row>0){
		while($result = mysqli_fetch_array($query)){
			$num .= $result['id_image']."-";
			$active_to .= $result['active']."-";
		}
		$active_cut = explode("-", $active_to);
		if(!in_array("active", $active_cut)){
			$cut_num = explode("-", $num);
			$str_ac = "UPDATE product_image SET";
			$str_ac .= " active = 'active' ";
			$str_ac .= "WHERE id_image = '".$cut_num[0]."' ";
			$query_ac = mysqli_query($objConnect,$str_ac);
		}
	}
$str_ac = "SELECT name_image FROM product_image WHERE active = 'active' AND id_product = '".$product."'";
$query_ac = mysqli_query($objConnect,$str_ac);
$result_ac = mysqli_fetch_array($query_ac);
echo $result_ac['name_image'];
?>