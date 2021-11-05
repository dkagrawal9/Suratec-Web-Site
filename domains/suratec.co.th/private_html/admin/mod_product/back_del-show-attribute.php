<?php
require_once '../library/connect.php';
if(isset($_POST['Chk'])){
	for($i=0;$i<count($_POST['Chk']);$i++){
		$str = 'DELETE FROM product_attribute_head WHERE id_attr_head = "'.$_POST['Chk'][$i].'"';
		$query = mysqli_query($objConnect,$str);
	}
}else{
	$str = 'DELETE FROM product_attribute_head WHERE id_attr_head = "'.$_POST['id'].'"';
	$query = mysqli_query($objConnect,$str);
}

?>