<?php
require_once '../library/connect.php';
session_start();
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


	
	date_default_timezone_set("Asia/Bangkok");
	$date = date('Y-m-d H:i:s');

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

	$id_product = setMD5();
	$id_real_product = $id_product;

if (isset($_SESSION['employee'])) {
	$employee = $_SESSION['employee'];
}else {
	$employee = "";
}

		$strSQL = "INSERT INTO `product`(`id_product`, `id_branch`, `name_product`, `name_product_en`, `name_product_ch`, `detail_product`, `detail_product_en`, `detail_product_ch`, `date_add`, `date_edit`, `status_product`, `status_product_sale`, `status_ready`, `id_catagory`, `view`, `level_product`, `id_brand`, `delete_datetime`, `promotion`, `tmp_price`, `number_min`, `price_min`, `sold_weight`, `sku`, `barcode`, `cost`, `alert_expire`, `alert_date`, `show_flg`, `weight`, `unit_id`, `created_id`, `updated_id`,`review_product`, `review_product_en`, `review_product_ch`) VALUES ('$id_product','".$_POST['id_branch']."','".$_POST['product_name']."','".$_POST['product_name_en']."','".$_POST['product_name_ch']."','".$_POST['input_editor']."','".$_POST['input_editor_en']."','".$_POST['input_editor_ch']."','$date',null,'".$_POST['sign_status']."','','".$_POST['sign_ready']."','".$_POST['id_catagory']."','','','',null,'','".$_POST['selling_price']."','','','','".$_POST['SKU']."','','".$_POST['capital_cost']."','','','','".$_POST['weight']."','','".$employee."','','".$_POST['editor_re']."','".$_POST['editor_en_re']."','".$_POST['editor_ch_re']."')";
		$objQuery = mysqli_query($objConnect,$strSQL);
		// if($objQuery){
		// 	echo 'SUCCESS'.$strSQL;
		// }else{
		// 	echo 'ERROR'.$strSQL;
		// }

	$strSQL = "SELECT * FROM product_image_thumb";
	$strQuery = mysqli_query($objConnect,$strSQL);
	while($objResult = mysqli_fetch_array($strQuery)){	

		$namefile = $objResult['name_thumb'];
		$sur = strrchr($namefile, "."); //ตัดนามสกุลไฟล์เก็บไว้
		$name = $objResult['name_thumb']; //ผมตั้งเป็น วันที่_เวลา.นามสกุล
		$target = "../../uploads/product/".$name;
		$newname = $name;

		if(file_exists($target)){
			$oldname = pathinfo($name, PATHINFO_FILENAME);
			$ext = pathinfo($name, PATHINFO_EXTENSION);
			$newname = $oldname;
			do{
				$r = rand(1000,9999);
				$newname = $oldname."-".$r.".$ext";
				$target = "../../uploads/product/".$newname;
			}while (file_exists($target)); 
		}

		if(copy("../../uploads/product/thumbnail/".$namefile,$target)){

			$id_image = setMD5();
			$strSQL = "INSERT INTO product_image";
			$strSQL .= "(id_image,name_image,size_image,date_image,id_product,active)";
			$strSQL .= "VALUES ";
			$strSQL .= "('$id_image','".$newname."','".$objResult['size_thumb']."','".$objResult['date_thumb']."','".$id_real_product."','".$objResult['active']."')";
			$objQuery = mysqli_query($objConnect,$strSQL);
			// if($objQuery){
			// }else{
			// 	echo 'error'.$strSQL;
			// }

			$file = iconv("utf-8","tis-620",$objResult["name_thumb"]);
			unlink("../../uploads/product/thumbnail/".$file);
		}
	}
	$str = "DELETE FROM product_image_thumb";
	$query = mysqli_query($objConnect,$str);
	echo $id_product;


?>