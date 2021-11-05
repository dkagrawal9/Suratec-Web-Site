<?php
	 require_once '../library/connect.php';
	date_default_timezone_set("Asia/Bangkok");
	 global $objConnect;
	 global $date;
	
	$id =setMD5();
	$str = "INSERT INTO `link_local`(`id_link`, `name`, `table`, `link`) VALUES (null,'','freedom_page','".$_POST['link_freedom_page']."')";
	$obj = mysqli_query($objConnect,$str);

	$strSQL1 = "SELECT MAX(`id_link`) AS id_link FROM `link_local`";
	$objQuery1 = mysqli_query($objConnect,$strSQL1) or die (mysqli_error());
	$objResult1 = mysqli_fetch_array($objQuery1);

	$strSQL = "INSERT INTO `freedom_page` ";
	$strSQL .= "(`id_page`, `name_page`, `name_en_page`, `text`, `text_en`, `date`, `id_link`)";
	$strSQL .= "VALUES ";
	$strSQL .= "(null,'".$_POST['name_th']."','".$_POST['name_en']."','".$_POST['editor']."','".$_POST['editor_en']."','$date','".$objResult1['id_link']."')";
	$objQuery = mysqli_query($objConnect,$strSQL);
	if($objQuery){
		echo "Add done.[".$strSQL."]";
		// header("Refresh: 0; url=manage-menu.php");
	}
	else{
		echo "Error Add [".$strSQL."]";
	}
	

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