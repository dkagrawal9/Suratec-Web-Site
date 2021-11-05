<?php
require_once '../library/connect.php';

if($_POST['_method']=='CREATE'){
	CREATE();
	exit;
}elseif($_POST['_method']=='PATCH'){
	PATCH();
	exit;
}elseif($_POST['_method']=='DELETE'){
	DELETE();
	exit;
}	


function CREATE(){
	global $objConnect;
	global $date;

	$sql = '';
	$query = mysqli_query($objConnect,$sql);

	if($query){
		echo json_encode(array('status' => '1', 'message' => $sql));
	}else{
		echo json_encode(array('status' => '0', 'message' => $sql));
	}
}

function PATCH(){
	global $objConnect;
	global $date;

	$sql = '';
	$query = mysqli_query($objConnect,$sql);

	if($query){
		echo json_encode(array('status' => '1', 'message' => $sql));
	}else{
		echo json_encode(array('status' => '0', 'message' => $sql));
	}
}

function DELETE(){
	global $objConnect;
	global $date;

	$sql = 'DELETE FROM mod_contact WHERE id_mail = "'.$_POST['id_mail'].'"';
	$query = mysqli_query($objConnect,$sql);

	if($query){
		echo json_encode(array('status' => '1', 'message' => $sql));
	}else{
		echo json_encode(array('status' => '0', 'message' => $sql));
	}
}

?>