<?php 
require_once '../library/connect.php';

$str_check = "SELECT * FROM orders_detail";
$query_check = mysqli_query($objConnect,$str_check);
while($result_check = mysqli_fetch_array($query_check)){
	$cut = explode("-",$result_check['productID']);
	if($_POST['id']==$cut[1]){
		echo "exist";
		exit;
	}
}

$str_m = "INSERT INTO bin_attr SELECT * FROM product_attribute WHERE id_attr =".$_POST['id'];
$query_m = mysqli_query($objConnect,$str_m);
if($query_m){
	echo "complete";
}else{
	echo "ERROR MOVE".$str;
}
//---------------------------------------------------------------------------------------------
$str_d = "DELETE FROM product_attribute WHERE id_attr =".$_POST['id'];
$query_d = mysqli_query($objConnect,$str_d);
if($query_d){
	echo "complete";
}else{
	echo "ERROR DEL".$str;
}
//--------------------------------------------------------------------------------------------

?>