<?php
// header('Content-Type: application/json');
require_once '../library/connect.php';
	$str = "UPDATE product_attribute_head SET";
	$str .= " name_attr_head = '".$_POST['name_head']."'";
	$str .= " ,name_attr_head_show = '".$_POST['name_head_th']."'";
	$str .= " ,name_attr_head_show_en = '".$_POST['name_head_en']."'";
	$str .= "WHERE id_attr_head = '".$_POST['id_attr']."'";
	$query = mysqli_query($objConnect,$str);
	if($query){
		echo "complete".$str;
	}else{
		echo "error".$str;
	}

	if($_POST['edit_delete']!=''){
		$str_del = "DELETE FROM `product_attribute_sub` WHERE id_attr_sub IN (".$_POST['edit_delete'].")";
		$query_del = mysqli_query($objConnect,$str_del);
		if($query_del){
			echo 'com';
		}else{
			echo 'err';
		}
	}
	
	if(isset($_POST['name_attr_th'])){
		for($i=0;$i<count($_POST['name_attr_th']);$i++){
			if($_POST['name_attr_th'][$i]=='' && $_POST['name_attr_en'][$i]==''){
				continue;
			}
			$sql_up = "UPDATE product_attribute_sub SET";
			$sql_up .= " name_attr_sub = '".$_POST['name_attr_th'][$i]."'";
			$sql_up .= ",name_attr_sub_en = '".$_POST['name_attr_en'][$i]."'";
			$sql_up .= "WHERE id_attr_sub = '".$_POST['id_attr_sub'][$i]."'";
			$query_up = mysqli_query($objConnect,$sql_up);
			if($query_up){
				echo "complete";
			}else{
				echo "Error";
			}
		}
	}

	if(isset($_POST['name_attr_th_inclease'])){
		for($i=0;$i<count($_POST['name_attr_th_inclease']);$i++){
			if($_POST['name_attr_th_inclease'][$i]=='' && $_POST['name_attr_en_inclease'][$i]==''){
				continue;
			}
			$sql_sub = "INSERT INTO product_attribute_sub";
			$sql_sub .= "(name_attr_sub,name_attr_sub_en,id_attr_head)";
			$sql_sub .= "VALUES('".$_POST['name_attr_th_inclease'][$i]."','".$_POST['name_attr_en_inclease'][$i]."','".$_POST['id_attr']."')";
			$query_sub = mysqli_query($objConnect,$sql_sub);
			if($query_sub){
				echo "complete";
			}else{
				echo "Error";
			}
		}
	}
?>