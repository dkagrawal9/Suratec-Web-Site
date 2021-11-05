<?php
 require_once '../library/connect.php';
	date_default_timezone_set("Asia/Bangkok");
if(isset($_POST['_method'])){
		if($_POST['_method']=='DEL'){
			DEL();
			exit;
		}
}

function DEL(){
		global $objConnect;
		global $date;
		



	echo	$str = "UPDATE `faq` SET `del_flg` = '1' WHERE `faq`.`id` = '".$_GET["id_faq"]."'";
		$query = mysqli_query($objConnect,$str);

		if($query){
			$id_customer = mysqli_insert_id($objConnect);
			echo json_encode(array('status' => '1', 'message' => $str));
		}else{
			echo json_encode(array('status' => '0', 'message' => $str));
		}


	}
	




	 ?>