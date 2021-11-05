<?php 

	// function setMD5(){

	// 	$passuniq = uniqid();
	// 	$passmd5 = md5($passuniq);

	// 	$sumlenght = strlen($passmd5);#num passmd5

	// 	$letter_pre = chr(rand(97,122));#set char for prefix

	// 	$letter_post = chr(rand(97,122));#set char for postfix

	// 	$letter_mid = chr(rand(97,122));#set char for middle string

	// 	$num_rand = rand(0,$sumlenght);#random for cut passmd5

	// 	$cut_pre = substr($passmd5,0,$num_rand);#cutmd5 start 0 stop $numrand
	// 	$setmid = $cut_pre.$letter_mid;#set pre string + char middle

	// 	$cut_post = substr($passmd5,$num_rand, $sumlenght+1);

	// 	$set_modify_md5 = $letter_pre.$setmid.$cut_post.$letter_post;
	// 	return $set_modify_md5;
	// }

	require_once '../library/connect.php';
	date_default_timezone_set("Asia/Bangkok");
	$date = date("Y-m-j H:i:s");

	$cat = explode(",",$_POST['id_catagory']);
	$numcat = count($cat)-1;
	for($i=0;$i<$numcat;$i++){
		$str = "SELECT * FROM product_catagory WHERE id_catagory = '".$cat[$i]."'";
		$query = mysqli_query($objConnect,$str);
		$result = mysqli_fetch_array($query);

		if($result['level']=='3'){
			if(!in_array($result['group_sub'], $cat)){
				$_POST['id_catagory'] .= $result['group_sub'].",";
			}
			$str2 = "SELECT * FROM product_catagory WHERE id_catagory = '".$result['group_sub']."'";
			$query2 = mysqli_query($objConnect,$str2);
			$result2 = mysqli_fetch_array($query2);

			if(!in_array($result2['group_sub'], $cat)){
				$_POST['id_catagory'] .= $result2['group_sub'].",";
			}

		}elseif($result['level']=='2'){
			$str2 = "SELECT * FROM product_catagory WHERE id_catagory = '".$cat[$i]."'";
			$query2 = mysqli_query($objConnect,$str2);
			$result2 = mysqli_fetch_array($query2);

			if(!in_array($result2['group_sub'], $cat)){
				$_POST['id_catagory'] .= $result2['group_sub'].",";
			}
		}
	}


		$strSQL = "UPDATE product SET";
		$strSQL .= " name_product = '".$_POST["product_name"]."' ";
		$strSQL .= " ,name_product_en = '".$_POST["product_name_en"]."' ";
		$strSQL .= " ,name_product_ch = '".$_POST["product_name_ch"]."' ";
		$strSQL .= " ,detail_product = '".$_POST["input_editor"]."' ";
		$strSQL .= " ,detail_product_en = '".$_POST["input_editor_en"]."' ";
		$strSQL .= " ,detail_product_ch = '".$_POST["input_editor_ch"]."' ";
		$strSQL .= " ,id_catagory = '".$_POST["id_catagory"]."' ";
		$strSQL .= " ,status_product = '".$_POST["sign_status"]."' ";
		$strSQL .= " ,status_ready = '".$_POST["sign_ready"]."' ";
		$strSQL .= " ,date_edit = '$date' ";
		$strSQL .= " ,sku = '".$_POST['SKU']."' ";
		$strSQL .= " ,tmp_price = '".$_POST['price']."'";
		$strSQL .= " ,weight = '".$_POST['weight']."'";
		$strSQL .= " ,cost = '".$_POST['normal']."'";
		$strSQL .= " ,id_branch = '".$_POST['id_branch']."'";
		$strSQL .= " ,review_product = '".$_POST['editor_re']."'";
		$strSQL .= " ,review_product_en = '".$_POST['editor_en_re']."'";
		$strSQL .= " ,review_product_ch = '".$_POST['editor_ch_re']."'";
		$strSQL .= "WHERE id_product = '".$_POST['id_product']."' ";
		$objQuery = mysqli_query($objConnect,$strSQL);
		// if($objQuery){
		// 	echo "SUCCESS".$strSQL;
		// }else{
		// 	echo "ERROR".$strSQL;
		// }
		//Delete record product_stock
		// $strSQL_stock = "DELETE FROM product_stock WHERE id_product ='".$_POST['id_product']."' ";
		// $query_stock = mysqli_query($objConnect,$strSQL_del);

	echo $_POST['id_product'];
?>

