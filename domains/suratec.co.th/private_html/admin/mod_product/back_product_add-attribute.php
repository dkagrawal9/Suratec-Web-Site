<?php 

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

function checkSum($code_length){
	$code = str_split($code_length);

    $sum1 = $code[1] + $code[3] + $code[5] ;
    $sum2 = 3 * ($code[0] + $code[2] + $code[4] + $code[6]);

    $checksum_value = $sum1 + $sum2;
    $checksum_digit = 10 - ($checksum_value % 10);
    if ($checksum_digit == 10) $checksum_digit = 0;

    return $checksum_digit;
}

require_once '../library/connect.php';
date_default_timezone_set("Asia/Bangkok");
	$date = date("Y-m-d");
	echo $_GET['id'];


// if(isset($_POST['option_attr'])){
if(isset($_GET['tab_mullti']) && $_GET['tab_mullti'] !='0' ){
	echo "mull";
	for($i=0;$i<count($_POST["option_attr"]);$i++){

		$str_max = "SELECT orderby,barcode FROM product_attribute ORDER BY orderby DESC LIMIT 1";
		$query_max = mysqli_query($objConnect,$str_max);
		$result_max = mysqli_fetch_array($query_max);
		$num_max = mysqli_num_rows($query_max);
		if($num_max==0){
			//work
			$barcode = date('y').'00001';
		}else{
			$year   = substr($result_max['barcode'],0,2);
			$nums   = substr($result_max['barcode'],2,5);
			$code   = intval($nums);

			if($year==date('y')){
				$gencode 	 = $code+1;
				$length 	 = 5;
				$gencode_int = str_pad($gencode, $length, "0", STR_PAD_LEFT); 
				//work
				$barcode = $year.$gencode_int;
			}else{
				//work
				$barcode  = date('y').'00001';
			}
		}

		$barcode = $barcode.checksum($barcode);

		if($_POST['price'][$i]==''){
			$price = 0;
		}else{
			$price = $_POST['price'][$i];
		}

		if($_POST['normal'][$i]==''){
			$normal = 0;
		}else{
			$normal = $_POST['normal'][$i];
		}

		

		$id_attr = setMD5();
		$id_real_attr = $id_attr;
$date1 = date("Y-m-d H:i:s");
	echo	$str = "INSERT INTO `product_attribute` (`id_attr`, `attribute_name`, `option_name`, `price_attr`, `price_n_attr`, `stock_attr`, `weight_attr`, `SKU_attr`, `barcode`, `show_attr`, `orderby`, `id_product`, `create_datetime`, `delete_datetime`, `update_datetime`) VALUES ('$id_attr', '".$_POST['attr_head'][$i]."', '".$_POST['option_attr'][$i]."', '$price', '$normal', '0', '".$_POST['weight'][$i]."', '".$_POST['SKU'][$i]."', NULL, '1', NULL, '".$_GET['id']."', '$date', NULL, NULL)";
		$query = mysqli_query($objConnect,$str);



		if($query){
				$id_stock = setMD5();
				$strST = "INSERT INTO product_stock_branch";
				$strST .= "(sum_stock,order_stock,balance_stock,id_product, `id_product_attr`,id_branch)";
				$strST .= " VALUES ";
				$strST .= "('0','0','0','".$_GET['id']."','".$id_real_attr."','".$_GET['id_branch']."')";
				$query_stock = mysqli_query($objConnect,$strST);
		}


		if($_FILES["attr_file"]["name"][$i] != "")
		{
			$namefile = $_FILES["attr_file"]["name"][$i];
			$sur = strrchr($namefile, "."); //ตัดนามสกุลไฟล์เก็บไว้
			$name = "P-A-".(Date("dmy").rand('1000','9999').$sur); //ผมตั้งเป็น วันที่_เวลา.นามสกุล
			$target = "../../uploads/product_attribute/".$name;
			$newname = $name;

			if(file_exists($target)){
				$oldname = pathinfo($name, PATHINFO_FILENAME);
				$ext = pathinfo($name, PATHINFO_EXTENSION);
				$newname = $oldname;
				do{
					$r = rand(1000,9999);
					$newname = $oldname."-".$r.".$ext";
					$target = "../../uploads/product_attribute/".$newname;
				}while (file_exists($target)); 
			}
			// if(copy($_FILES["files"]["tmp_name"][$i],"image_product/thumbnail/".$_FILES["files"]["name"][$i]))
			if(copy($_FILES["attr_file"]["tmp_name"][$i],$target))
			{	
				$id_image = setMD5();
				// echo "Copy/Upload Complete<br>";
				$strSQL = "INSERT INTO product_image_attr";
				$strSQL .= "(id_image,name_image,date_image,size_image,id_attr)";
				$strSQL .= "VALUES ";
				$strSQL .= "('$id_image','".$newname."','".$date."','".$_FILES["attr_file"]["size"][$i]."','".$id_real_attr."')";
				$objQuery = mysqli_query($objConnect,$strSQL);
				if($objQuery){
					echo "Insert record complete<br>";
				}else{
					echo "Insert error!<br>";
				}	
			}else{
				echo "error";
			}
		}

		if($query){
			echo $str;
		}else{
			echo "ERROR ".$str;
		}
	}
}else{
echo "one";
		$str_max = "SELECT orderby,barcode FROM product_attribute ORDER BY orderby DESC LIMIT 1";
		$query_max = mysqli_query($objConnect,$str_max);
		$result_max = mysqli_fetch_array($query_max);
		$num_max = mysqli_num_rows($query_max);
		if($num_max==0){
			//work
			$barcode = date('y').'00001';
		}else{
			$year   = substr($result_max['barcode'],0,2);
			$nums   = substr($result_max['barcode'],2,5);
			$code   = intval($nums);

			if($year==date('y')){
				$gencode 	 = $code+1;
				$length 	 = 5;
				$gencode_int = str_pad($gencode, $length, "0", STR_PAD_LEFT); 
				//work
				$barcode = $year.$gencode_int;
			}else{
				//work
				$barcode  = date('y').'00001';
			}
		}

		$barcode = $barcode.checksum($barcode);

		$id_attr = setMD5();
		$id_real_attr = $id_attr;
		 $str = "INSERT INTO `product_attribute` (`id_attr`, `attribute_name`, `option_name`, `price_attr`, `price_n_attr`, `stock_attr`, `weight_attr`, `SKU_attr`, `barcode`, `show_attr`, `orderby`, `id_product`, `create_datetime`, `delete_datetime`, `update_datetime`) VALUES ('$id_attr', '', '', '', '', '0', '', '".$_GET['SKU_1']."', NULL, '1', NULL, '".$_GET['id']."', '$date', NULL, NULL)";
		 $query = mysqli_query($objConnect,$str);


		 if($query){
		 	$id_stock = setMD5();
		 	$strST = "INSERT INTO product_stock_branch";
		 	$strST .= "(sum_stock,order_stock,balance_stock,id_product, `id_product_attr`,id_branch)";
		 	$strST .= " VALUES ";
		 	$strST .= "('0','0','0','".$_GET['id']."','".$id_real_attr."','".$_GET['id_branch']."')";
		 	$query_stock = mysqli_query($objConnect,$strST);
		 }

}
?>

