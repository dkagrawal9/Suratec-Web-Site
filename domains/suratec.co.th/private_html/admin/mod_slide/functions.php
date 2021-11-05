<?php
session_start();
require_once '../library/connect.php';

if (isset($_POST['_method'])) {
	if($_POST['_method']=='CREATE'){
	CREATE();
	exit;
	}elseif($_POST['_method']=='edit'){
	edit();
	exit;
	}elseif ($_POST['_method'] == 'Multivisible') {
    delmulti();
    exit;
	}

}else{
	if($_GET['_method']=='disabled'){
		del();
		exit;
	}
}


function CREATE(){
global $objConnect;
global $date;	



	$strSQL = "INSERT INTO `slide_catagory`(`id_slide_catagory`, `name`, `name_en`, `action_datetime`) VALUES (null,'".$_POST['name_th']."','".$_POST['name_en']."','".$date."')";
	
	$objQuery = mysqli_query($objConnect,$strSQL);
	header('Content-Type: application/json');
	if($objQuery){
		echo json_encode(array('status' => '0','message'=> "Add done".$strSQL));
		// echo "Add done.[".$strSQL."]";
	}
	else{
		echo json_encode(array('status' => '1','message'=> "Error Add".$strSQL));
		//echo "Error Add [".$strSQL."]";
	}

	mysqli_close($objConnect);
}

function edit(){
global $objConnect;
global $date;
	$str = "UPDATE slide_catagory SET";
	$str .= " name = '".$_POST['name_th_edit']."' ";
	$str .= ",name_en = '".$_POST['name_en_edit']."' ";
	$str .= ",action_datetime = '".$date."' ";
	$str .= "WHERE id_slide_catagory = '".$_POST['id']."'" ;
	$query = mysqli_query($objConnect,$str);
	header('Content-Type: application/json');
	if($query){
		echo json_encode(array('status' => '0','message'=> "Add done".$str));
		// echo "Add done.[".$strSQL."]";
	}
	else{
		echo json_encode(array('status' => '1','message'=> "Error Add".$str));
		//echo "Error Add [".$strSQL."]";
	}

}
function del(){
	global $objConnect;
	global $date;
	header('Content-Type: application/json');
	
	
	$str = "UPDATE status SET `delete_datetime`= '".$date."' WHERE status_id = '".$_GET['id']."'";
	$query = mysqli_query($objConnect,$str);;
	if($query){
		echo json_encode(array('status' => '0','message'=> $str));
	}else{
		echo json_encode(array('status' => '1','message'=> $str));
	}
}
function delmulti()
{
 
     global $objConnect;
     global $date;
     header('Content-Type: application/json');

    for ($i = 0; $i < count($_POST["Chk"]); $i++) {
        $str = "UPDATE status SET delete_datetime = '$date' WHERE status_id = '" . $_POST["Chk"][$i] . "'";
        $query = mysqli_query($objConnect, $str);
       
    }
     if($query){
		echo json_encode(array('status' => '0','message'=> $str));
	}else{
		echo json_encode(array('status' => '1','message'=> $str));
	}
}



function setMD5(){

	$passuniq = uniqid();
	$passmd5 = md5($passuniq);

	$sumlenght = strlen($passmd5);#num passmd5

	$letter_pre = chr(rand(97,122));#set char for prefix

	$letter_post = chr(rand(97,122));#set char for postfix

	$letter_mid = chr(rand(97,122));#set char for middle string

	$num_rand = rand(0,$sumlenght);#random for cut passmd5

	$cut_pre = substr($passmd5,0,$num_rand);#cutmd5 start 0 stop $numrand
	$setmid = $cut_pre.$letter_mid;#set pre string + char middle

	$cut_post = substr($passmd5,$num_rand, $sumlenght+1);

	$set_modify_md5 = $letter_pre.$setmid.$cut_post.$letter_post;
	return $set_modify_md5;
}
?>