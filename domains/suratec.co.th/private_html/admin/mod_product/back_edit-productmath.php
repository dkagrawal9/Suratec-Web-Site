<?php
	require_once '../library/connect.php';
	date_default_timezone_set("Asia/Bangkok");
	$math_cut = explode("-", $_POST['id']);
	if($math_cut[2]==1){
		$str_fetch = "SELECT * FROM product where id_product = '".$math_cut[0]."'";
		$query_fetch = mysqli_query($objConnect,$str_fetch);
		$result_fetch = mysqli_fetch_array($query_fetch);

		$str = "UPDATE product SET ";
		$str .= " math = ''";
		$str .= " WHERE id_product = '".$result_fetch['math']."'";
		$query = mysqli_query($objConnect,$str);
		if ($query){
			echo "complete".$str.'<br>';
		}else{
			echo "error".$str;
		}

		$str = "UPDATE product SET ";
		$str .= " math = '0'";
		$str .= " WHERE id_product = '".$math_cut[1]."'";
		$query = mysqli_query($objConnect,$str);
		if ($query){
			echo "complete".$str.'<br>';
		}else{
			echo "error".$str;
		}

		$str = "UPDATE product SET ";
		$str .= " math = '".$math_cut[1]."'";
		$str .= " WHERE id_product = '".$math_cut[0]."'";
		$query = mysqli_query($objConnect,$str);
		if ($query){
			echo "complete".$str.'<br>';
		}else{
			echo "error".$str;
		}
	}else{
		$str_fetch = "SELECT * FROM product where id_product = '".$math_cut[0]."'";
		$query_fetch = mysqli_query($objConnect,$str_fetch);
		$result_fetch = mysqli_fetch_array($query_fetch);

		$str = "UPDATE product SET ";
		$str .= " math = ''";
		$str .= " WHERE id_product = '".$result_fetch['math']."'";
		$query = mysqli_query($objConnect,$str);
		if ($query){
			echo "complete".$str.'<br>';
		}else{
			echo "error".$str;
		}

		$str = "UPDATE product SET ";
		$str .= " math = ''";
		$str .= " WHERE id_product= '".$math_cut[0]."'";
		$query = mysqli_query($objConnect,$str);
		if ($query){
			echo "complete".$str.'<br>';
		}else{
			echo "error".$str;
		}

		// $str = "UPDATE product SET ";
		// $str .= " math = ''";
		// $str .= " WHERE id_product = '".$math_cut[0]."'";
		// $query = mysqli_query($objConnect,$str);
		// if ($query){
		// 	echo "complete";
		// }else{
		// 	echo "error".$str;
		// }
	}
?>