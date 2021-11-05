<?php
	 require_once '../library/connect.php';
	date_default_timezone_set("Asia/Bangkok");
	
	 global $objConnect;
	 global $date;
	
	$id =setMD5();
	print_r($_POST['id_faq']);
	echo '<br>';
	$ii = 1;
	for ($i=0; $i < count($_POST['ask']); $i++) { 
	$strSQL1 = "SELECT MAX(`order`) AS max_order FROM `faq` WHERE `del_flg`='0'";	
	$objQuery1 = mysqli_query($objConnect,$strSQL1);
	$result = mysqli_fetch_array($objQuery1);
	$max_order = $result["max_order"]+1;
	
	if ($_POST['id_faq'][$i]=='*') {

	$strSQL = "INSERT INTO `faq`";
	$strSQL .= "(`id`, `question`, `answer`, `order`, `del_flg`, `question_en`, `answer_en`)";
	$strSQL .= "VALUES ";
	$strSQL .= "(null,'".$_POST['ask'][$i]."','".$_POST['answer'][$i]."','".$ii."','0','".$_POST['ask_en'][$i]."','".$_POST['answer_en'][$i]."')";
	$objQuery = mysqli_query($objConnect,$strSQL);
	if($objQuery){
		echo "Add done.[".$strSQL."]";
		// header("Refresh: 0; url=manage-menu.php");
	}
	else{
		echo "Error Add [".$strSQL."]";
	}
	}else{
	$strSQL = "UPDATE `faq` SET `question`='".$_POST['ask'][$i]."',`answer`='".$_POST['answer'][$i]."',`question_en`='".$_POST['ask_en'][$i]."',`answer_en`='".$_POST['answer_en'][$i]."',`order`='".$ii."',`del_flg`='0' WHERE `id`='".$_POST['id_faq'][$i]."'";
	
	$objQuery = mysqli_query($objConnect,$strSQL);
	if($objQuery){
		echo "Add done.[".$strSQL."]";
		// header("Refresh: 0; url=manage-menu.php");
	}
	else{
		echo "Error Add [".$strSQL."]";
	}
	}
	
	$ii++; }
	

mysqli_close($objConnect);
// header("Refresh: 0; url=front-add.php");

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