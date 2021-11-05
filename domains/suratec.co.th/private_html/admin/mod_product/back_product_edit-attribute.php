<?php 
require_once '../library/connect.php';
date_default_timezone_set("Asia/Bangkok");
$date = date("Y-m-d");
// echo $_POST['input_exist'];
// echo $_POST['input_render'];
//var_dump($_POST);
if(isset($_GET['tab_mullti']) && $_GET['tab_mullti'] !='0' ){
if(!isset($_POST['tab'])){
$count_option_attr_ex = count($_POST["option_attr_ex"]);
	if(isset($_POST['input_exist']) && $_POST['input_exist'] == '0'){

		for($i=0;$i<count($_POST["option_attr_ex"]);$i++){

			echo $_POST['show_ex'][$i];

			if($_POST['price_ex'][$i]==''){
				$price = 0;
			}else{
				$price = $_POST['price_ex'][$i];
			}


			if($_POST['normal_ex'][$i]==''){
				$normal = 0;
			}else{
				$normal = $_POST['normal_ex'][$i];
			}

			// if($_POST['stock_ex'][$i]==''){
			// 	$stock = 0;
			// }else{
			// 	$stock = $_POST['stock_ex'][$i];
			// }

			//-----------------------------------------------------------------------------------------------
			$str = "UPDATE product_attribute SET";
			$str .= " attribute_name = '".$_POST['attr_head_ex'][$i]."'";
			$str .= " ,option_name = '".$_POST['option_attr_ex'][$i]."'";
			$str .= " ,price_attr = '".$price."'";
			$str .= " ,price_n_attr = '".$normal."'";
			$str .= " ,weight_attr = '".$_POST['weight_ex'][$i]."'";
			$str .= " ,SKU_attr = '".$_POST['SKU_ex'][$i]."'";
			$str .= " ,show_attr = '".$_POST['show_ex'][$i]."'";
			$str .= "WHERE id_attr = '".$_POST['id_attr'][$i]."'";
			$query = mysqli_query($objConnect,$str);
			if($query){
				echo "complete1".$str;
			}else{
				echo "error".$str;
			}
			//-----------------------------------------------------------------------------------------------

			//----------------------------------update_stock-------------------------------------------------
			// $str_ud_st = "SELECT * FROM product_stock WHERE id_product = '".$_POST['id_attr'][$i]."'";
			// $query_ud_st = mysqli_query($objConnect,$str_ud_st);
			// $result_ud_st = mysqli_fetch_array($query_ud_st);
			// $order_stock = $result_ud_st['order_stock']; // order_stock
			// $sum_stock = $stock - $order_stock;// sum_stock

			// $update_stock = "UPDATE product_stock SET";
			// $update_stock .= " sum_stock = '".$stock."'";
			// $update_stock .= " ,order_stock = '".$order_stock."'";
			// $update_stock .= " ,balance_stock = '".$sum_stock."'";
			// $update_stock .= "WHERE id_product = '".$_POST['id_attr'][$i]."'";
			// $query_stock = mysqli_query($objConnect,$update_stock);
			//------------------------------------------------------------------------------------------------

			$id_attr = mysqli_insert_id($objConnect);

			if($_FILES["attr_file_ex"]["name"][$i] != "")
			{
				$str_image = "SELECT name_image,id_attr FROM product_image_attr WHERE id_attr = '".$_POST['id_attr'][$i]."'";
				$query_image = mysqli_query($objConnect,$str_image);
				$result_image = mysqli_fetch_array($query_image);
				$num_image = mysqli_num_rows($query_image);
				if($num_image>0){
					if($unlink = unlink("../../uploads/product_attribute/".$result_image['name_image'])){
						$namefile = $_FILES["attr_file_ex"]["name"][$i];
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
						if(copy($_FILES["attr_file_ex"]["tmp_name"][$i],$target))
						{
							// echo "Copy/Upload Complete<br>";
							$strSQL = "UPDATE product_image_attr SET";
							$strSQL .= " name_image = '".$newname."'";
							$strSQL .= " ,date_image = '".$date."'";
							$strSQL .= " ,size_image = '".$_FILES["attr_file_ex"]["size"][$i]."'";
							$strSQL .= " WHERE id_attr = '".$_POST['id_attr'][$i]."'";
							$objQuery = mysqli_query($objConnect,$strSQL);
							if($objQuery){
								echo "Insert record complete<br>";
							}else{
								echo "Insert error!<br>";
							}	
						}else{
							echo "error";
						}
					}else{
						echo "error unlink".$unlink;
					}
				}else{
					$namefile = $_FILES["attr_file_ex"]["name"][$i];
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
					if(copy($_FILES["attr_file_ex"]["tmp_name"][$i],$target))
					{
						$id_image = setMD5();
						// echo "Copy/Upload Complete<br>";
						$strSQL = "INSERT INTO product_image_attr";
						$strSQL .= "(id_image,name_image,date_image,size_image,id_attr)";
						$strSQL .= "VALUES ";
						$strSQL .= "('$id_image','".$newname."','".$date."','".$_FILES["attr_file_ex"]["size"][$i]."','".$_POST['id_attr'][$i]."')";
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
			}

			if($query){
				echo $str;
			}else{
				echo "ERROR ".$str;
			}
//ปิดลูป
		}
//ปิด if แก้ไข		
	}else{
		
		// ตรวนี้ตรวจสอบค่าที่เข้ามาก่อน ว่ามีค่าไม๊ ถ้าเป็นการย้ายมากจากสินค้าหลักจะเไม่มี
		if(isset($_POST['option_attr_ex'])){
			for($i=0;$i<count($_POST["option_attr_ex"]);$i++){
				echo $_POST['id_attr'][$i];

				$str_del_stock = "DELETE FROM `product_stock_branch` WHERE `id_product_attr`= '".$_POST['id_attr'][$i]."'";
				$query_del_stock = mysqli_query($objConnect,$str_del_stock);
				if($query_del_stock){
					echo 'SUCCESS'.$str_del_stock;
				}else{
					echo 'ERROR'.$str_del_stock;
				}

				$str_image = "SELECT name_image,id_attr FROM product_image_attr WHERE id_attr = '".$_POST['id_attr'][$i]."'";
				$query_image = mysqli_query($objConnect,$str_image);
				$result_image = mysqli_fetch_array($query_image);
				$num_image = mysqli_num_rows($query_image);
				if($num_image>0){
					if($unlink = unlink("../../uploads/product_attribute/".$result_image['name_image'])){
						$str_del = "DELETE FROM product_image_attr WHERE id_attr = '".$_POST['id_attr'][$i]."'";
						$query_del = mysqli_query($objConnect,$str_del);
						if($query_del){
							echo 'complete2'.$str_del;
						}else{
							echo 'error'.$str_del;
						}
					}
				}
			}
		}



		$str_del = "DELETE FROM product_attribute WHERE id_product = '".$_GET['id']."'";
		$query_del = mysqli_query($objConnect,$str_del);
		if($query_del){
			echo 'complete3'.$str_del;
		}else{
			echo 'error'.$str_del;
		}

		for($i=0;$i<count($_POST["option_attr"]);$i++){

			$str_max = "SELECT orderby,barcode FROM product_attribute ORDER BY orderby DESC LIMIT 1";
			$query_max = mysqli_query($objConnect,$str_max);
			$result_max = mysqli_fetch_array($query_max);
			$num_max = mysqli_num_rows($query_max);
			//assign barcode
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

			// if($_POST['stock'][$i]==''){
			// 	$stock = 0;
			// }else{
			// 	$stock = $_POST['stock'][$i];
			// }

			$id_attr = setMD5();
			$id_attr_image = $id_attr;
			$id_real_attr = $id_attr;
			
			

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
					$strSQL .= "('$id_image','".$newname."','".$date."','".$_FILES["attr_file"]["size"][$i]."','".$id_attr_image."')";
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

	//ปิด else	
	}
}else{

	$str_num_sum = "SELECT * FROM product_attribute WHERE id_product = '".$_GET['id']."'";
	$query_num_sum = mysqli_query($objConnect,$str_num_sum);
	$row_num_sum  = mysqli_num_rows($query_num_sum);

	if($row_num_sum>1){
		while($result_num_sum = mysqli_fetch_array($query_num_sum)){
			$str_del_stock = "DELETE FROM `product_stock_branch` WHERE `id_product_attr`= '".$result_num_sum['id_attr']."'";
			$query_del_stock = mysqli_query($objConnect,$str_del_stock);
			if($query_del_stock){
				echo 'SUCCESS'.$str_del_stock;
			}else{
				echo 'ERROR'.$str_del_stock;
			}

			$str_image = "SELECT name_image,id_attr FROM product_image_attr WHERE id_attr = '".$result_num_sum['id_attr']."'";
			$query_image = mysqli_query($objConnect,$str_image);
			$result_image = mysqli_fetch_array($query_image);
			$num_image = mysqli_num_rows($query_image);
			if($num_image>0){
				if($unlink = unlink("../../uploads/product_attribute/".$result_image['name_image'])){
					$str_del = "DELETE FROM product_image_attr WHERE id_attr = '".$result_num_sum['id_attr']."'";
					$query_del = mysqli_query($objConnect,$str_del);
					if($query_del){
						echo 'complete4'.$str_del;
					}else{
						echo 'error'.$str_del;
					}
				}
			}
		}

		$str_del = "DELETE FROM product_attribute WHERE id_product = '".$_GET['id']."'";
		$query_del = mysqli_query($objConnect,$str_del);
		if($query_del){
			echo 'complete5'.$str_del;
		}else{
			echo 'error'.$str_del;
		}

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
		$str = "INSERT INTO `product_attribute` (`id_attr`, `attribute_name`, `option_name`, `price_attr`, `price_n_attr`, `stock_attr`, `weight_attr`, `SKU_attr`, `barcode`, `show_attr`, `orderby`, `id_product`, `create_datetime`, `delete_datetime`, `update_datetime`) VALUES ('$id_attr', '".$_POST['attr_head'][$i]."', '".$_POST['option_attr'][$i]."', '$price', '$normal', '0', '".$_POST['weight'][$i]."', '".$_POST['SKU'][$i]."', NULL, '1', NULL, '".$_GET['id']."', '$date', NULL, NULL)";
		$query = mysqli_query($objConnect,$str);

		if($query){
			$id_stock = setMD5();
			$strST = "INSERT INTO product_stock_branch";
			$strST .= "(sum_stock,order_stock,balance_stock,id_product, `id_product_attr`,id_branch)";
			$strST .= " VALUES ";
			$strST .= " ('0','0','0','".$_GET['id']."','".$id_real_attr."','".$_GET['id_branch']."')";
			$query_stock = mysqli_query($objConnect,$strST);
		}
	}else{
	echo	$str = "UPDATE product_attribute SET";
		$str .= " price_attr = '".$_POST['price']."'";
		$str .= " ,price_n_attr = '".$_POST['normal']."'";
		$str .= " ,weight_attr = '".$_POST['weight']."'";
		$str .= " ,SKU_attr = '".$_POST['SKU']."'";
		$str .= " ,show_attr = '1'";
		$str .= "WHERE id_attr = '".$_POST['id_attr']."'";
		$query = mysqli_query($objConnect,$str);
		if($query){
			echo "complete6".$str;
		}else{
			echo "error".$str;
		}
		//-----------------------------------------------------------------------------------------------

		//----------------------------------update_stock-------------------------------------------------
		// $stock = $_POST['stock'];
	// 	$str_ud_st = "SELECT * FROM product_stock WHERE id_product = '".$_POST['id_attr']."'";
	// 	$query_ud_st = mysqli_query($objConnect,$str_ud_st);
	// 	$result_ud_st = mysqli_fetch_array($query_ud_st);
	// 	$order_stock = $result_ud_st['order_stock']; // order_stock
	// 	$sum_stock = $stock - $order_stock;// sum_stock

	// 	$update_stock = "UPDATE product_stock SET";
	// 	$update_stock .= " sum_stock = '".$stock."'";
	// 	$update_stock .= " ,order_stock = '".$order_stock."'";
	// 	$update_stock .= " ,balance_stock = '".$sum_stock."'";
	// 	$update_stock .= "WHERE id_product = '".$_POST['id_attr']."'";
	// 	$query_stock = mysqli_query($objConnect,$update_stock);
	 }
}
////SKU_1  อันเดียว
}else{
	if (isset($_SESSION['employee'])) {
		$employee=$_SESSION['employee'];
	}else{
		$employee='';
	}
	$id_attr = setMD5();


	$str_num_sum = "SELECT * FROM product_attribute WHERE id_product = '".$_GET['id']."'";
	$query_num_sum = mysqli_query($objConnect,$str_num_sum);
	$row_num_sum  = mysqli_num_rows($query_num_sum);

	if($row_num_sum>1){
		while($result_num_sum = mysqli_fetch_array($query_num_sum)){
			$str_del_stock = "DELETE FROM `product_stock_branch` WHERE `id_product_attr`= '".$result_num_sum['id_attr']."'";
			$query_del_stock = mysqli_query($objConnect,$str_del_stock);
			if($query_del_stock){
				echo 'SUCCESS'.$str_del_stock;
			}else{
				echo 'ERROR'.$str_del_stock;
			}

			$str_image = "SELECT name_image,id_attr FROM product_image_attr WHERE id_attr = '".$result_num_sum['id_attr']."'";
			$query_image = mysqli_query($objConnect,$str_image);
			$result_image = mysqli_fetch_array($query_image);
			$num_image = mysqli_num_rows($query_image);
			if($num_image>0){
				if($unlink = unlink("../../uploads/product_attribute/".$result_image['name_image'])){
					$str_del = "DELETE FROM product_image_attr WHERE id_attr = '".$result_num_sum['id_attr']."'";
					$query_del = mysqli_query($objConnect,$str_del);
					if($query_del){
						echo 'complete7'.$str_del;
					}else{
						echo 'error'.$str_del;
					}
				}
			}
		}

		$str_del = "DELETE FROM product_attribute WHERE id_product = '".$_GET['id']."'";
		$query_del = mysqli_query($objConnect,$str_del);
		if($query_del){
			echo 'complete8'.$str_del;
		}else{
			echo 'error'.$str_del;
		}


	

	$str = "INSERT INTO `product_attribute` (`id_attr`,  `SKU_attr`, `show_attr`, `id_product`, `create_datetime`,create_id) VALUES ('$id_attr',  '".$_GET['SKU_1']."',  '1', '".$_GET['id']."', '$date', '$employee')";

		 $query = mysqli_query($objConnect,$str);

	


	$strST = "INSERT INTO product_stock_branch
(sum_stock,order_stock,balance_stock,id_product, `id_product_attr`,id_branch)
VALUES
('0','0','0','".$_GET['id']."','".$id_real_attr."','".$_GET['id_branch']."')";
		 	$query_stock = mysqli_query($objConnect,$strST);


}
	 		//------------------------------------------------------------------------------------------------
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

	function checkSum($code_length){
		$code = str_split($code_length);

	    $sum1 = $code[1] + $code[3] + $code[5];
	    $sum2 = 3 * ($code[0] + $code[2] + $code[4] + $code[6]);

	    $checksum_value = $sum1 + $sum2;
	    $checksum_digit = 10 - ($checksum_value % 10);
	    if ($checksum_digit == 10) $checksum_digit = 0;

	    return $checksum_digit;
	}

// echo $_GET['id'];

// $str_select = "SELECT * FROM product_attribute WHERE id_product='".$_GET['id']."'";
// $query_select = mysqli_query($objConnect,$str_select);
// while($result_select = mysqli_fetch_array($query_select)){
// 	$num_select .= $result_select['id_attr'].',';
// }
// $cut_num = explode(",", $num_select);
// $count_select = count($cut_num);

// //--------------------------------------------------------------------Delete old attribute---------------------------------------------------------------------------------------------------------------------
// $str_d = "DELETE FROM product_attribute WHERE id_product =".$_GET['id'];
// $str_query = mysqli_query($objConnect,$str_d);
// //---------------------------------------------------------------------Add new attribute-----------------------------------------------------------------------------------------------------------------------
// for($i=0;$i<count($_POST["color"]);$i++){
// 	if($cut_num[$i]==''){
// 		$str = "INSERT INTO product_attribute";
// 		$str .= "(color,size,price_attr,price_n_attr,stock_attr,weight_attr,SKU_attr,DET_attr,DET_attr_en,id_product)";
// 		$str .= "VALUES ";
// 		$str .= "('".$_POST['color'][$i]."','".$_POST['size'][$i]."','".$_POST['price'][$i]."','".$_POST['normal'][$i]."','".$_POST['stock'][$i]."','".$_POST['weight'][$i]."','".$_POST['SKU'][$i]."','".$_POST['DET'][$i]."','".$_POST['DET_EN'][$i]."','".$_GET['id']."')";
// 		$query = mysqli_query($objConnect,$str);
// 		if($query){
// 			echo $str;
// 		}else{
// 			echo "ERROR ".$str;
// 		}
// 	}else{
// 		$str = "INSERT INTO product_attribute";
// 		$str .= "(id_attr,color,size,price_attr,price_n_attr,stock_attr,weight_attr,SKU_attr,DET_attr,DET_attr_en,id_product)";
// 		$str .= "VALUES ";
// 		$str .= "('".$cut_num[$i]."','".$_POST['color'][$i]."','".$_POST['size'][$i]."','".$_POST['price'][$i]."','".$_POST['normal'][$i]."','".$_POST['stock'][$i]."','".$_POST['weight'][$i]."','".$_POST['SKU'][$i]."','".$_POST['DET'][$i]."','".$_POST['DET_EN'][$i]."','".$_GET['id']."')";
// 		$query = mysqli_query($objConnect,$str);
// 		if($query){
// 			echo $str;
// 		}else{
// 			echo "ERROR ".$str;
// 		}
// 	}
// }
?>