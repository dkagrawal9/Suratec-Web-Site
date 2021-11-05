<?php
// header('Content-Type: application/json');
require_once '../library/connect.php';
if(isset($_POST['name_head'])){
	$sql = "INSERT INTO product_attribute_head";
	$sql .= "(name_attr_head,name_attr_head_show,name_attr_head_show_en)";
	$sql .= "VALUES('".$_POST['name_head']."','".$_POST['name_head_th']."','".$_POST['name_head_en']."')";
	$query = mysqli_query($objConnect,$sql);
	if($query){
		echo "complete";
	}else{
		echo "Error";
	}

	$id_attr_head = mysqli_insert_id($objConnect);

	for($i=0;$i<count($_POST['name_attr_th']);$i++){
		if($_POST['name_attr_th'][$i]=='' && $_POST['name_attr_en'][$i]==''){
			continue;
		}
		$sql_sub = "INSERT INTO product_attribute_sub";
		$sql_sub .= "(name_attr_sub,name_attr_sub_en,id_attr_head)";
		$sql_sub .= "VALUES('".$_POST['name_attr_th'][$i]."','".$_POST['name_attr_en'][$i]."','".$id_attr_head."')";
		$query_sub = mysqli_query($objConnect,$sql_sub);
		if($query_sub){
			echo "complete";
		}else{
			echo "Error";
		}
	}

}else{
	$sql = "INSERT INTO product_attribute_head";
	$sql .= "(name_attr_head_show)";
	$sql .= "VALUES('".$_POST['head']."')";
	$query = mysqli_query($objConnect,$sql);

	$id_product = mysqli_insert_id($objConnect);

	$cut_text = explode(",", $_POST['text']);
	$count = count($cut_text);
	for($i=0;$i<$count;$i++){
		$sql_sub = "INSERT INTO product_attribute_sub";
		$sql_sub .= "(name_attr_sub,id_attr_head)";
		$sql_sub .= "VALUES('".$cut_text[$i]."','".$id_product."')";
		$query_sub = mysqli_query($objConnect,$sql_sub);
	}
	echo json_encode(array('status' => $id_product ,'message'=> 'Okay'));
}
?>