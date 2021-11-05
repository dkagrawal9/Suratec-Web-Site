<?php
require_once '../admin/library/connect.php';
header('Content-Type: application/json');
//$str = "";
//	$str .= "SELECT
//    CONCAT(
//        mod_customer.fname,
//        ' ',
//        mod_customer.lname
//    ) AS name_cus,
//    mod_customer.telephone,
//    mod_customer.email,
//    mod_customer.id_customer,
//    CASE `type` WHEN '1' THEN 'การแพทย์' WHEN '2' THEN 'การกีฬา' WHEN '3' THEN 'เบาหวาน'
//END AS type_cus,
//tbl_member.user_member
//
//FROM
//    `mod_customer`
//LEFT JOIN tbl_member ON tbl_member.id_data_role = mod_customer.id_customer
//
//WHERE
//    `delete_datetime` IS NULL OR delete_datetime IS NULL";
//if (isset($_GET["key_search"]) && $_GET["key_search"] != '') {
//    $str .= "  AND mod_customer.`fname` LIKE '%".$_GET["key_search"]."%' OR mod_customer.`lname`  LIKE '%".$_GET["key_search"]."%' OR tbl_member.user_member  LIKE '%".$_GET["key_search"]."%'";
//}
//	$resultArray = array();
//	$query = mysqli_query($objConnect,$str);
//	while($result = mysqli_fetch_array($query,MYSQLI_ASSOC)){
//		array_push($resultArray, $result);
//	}
//echo json_encode(['data'=> $resultArray]);	

$sql = 'SELECT `id`,`action`,`duration`,`left_sensor1`,`left_sensor2`,`left_sensor3`,`left_sensor4`,`left_sensor5`,`right_sensor1`,`right_sensor2`,`right_sensor3`,`right_sensor4`,`right_sensor5`,`id_customer` FROM `surasole` WHERE `id_customer` = "d49738a251a7ecb4a294bnb77946f204b1h" AND DATE(`action`) = "2020-02-19" ORDER BY `id` ASC';
	$query = mysqli_query($objConnect,$sql);
	$result = mysqli_fetch_array($query);
	$num = mysqli_num_rows($query);
//	if($num>0){
//		echo json_encode(array('status' => '1', 'message' => $result));
//	}else{
//		echo json_encode(array('status' => '0', 'message' => $sql));
//	}

	$count = 0;
   	$action = 0;
	$left_sensor = [];
	$right_sensor = [];
	$retData = [];
						for($i=1; $i<=$num; $i++)
						  {
							if ($i != 0) 
							{
							  $result = mysqli_fetch_array($query);
							  $left_1 = $result['left_sensor1'];
							  $left_2 = $result['left_sensor2'];
							  $left_3 = $result['left_sensor3'];
							  $left_4 = $result['left_sensor4'];
							  $left_5 = $result['left_sensor5'];
							$datasum_left = ("leftsensor1 :".$left_1.","."leftsensor2 :".$left_2.","."leftsensor3 :".$left_3.","."leftsensor4 :".$left_4.","."leftsensor5 :".$left_5);
							  $right_1 = $result['right_sensor1'];
							  $right_2 = $result['right_sensor2'];
							  $right_3 = $result['right_sensor3'];
							  $right_4 = $result['right_sensor4'];
							  $right_5 = $result['right_sensor5'];
							$datasum_right = ("rightsensor1 :".$right_1.","."rightsensor2 :".$right_2.","."rightsensor3 :".$right_3.","."rightsensor4 :".$right_4.","."rightsensor5 :".$right_5);	
							array_push($left_sensor,$datasum_left);
							array_push($right_sensor,$datasum_right);	
							}
							else
							{
							  $result = mysqli_fetch_array($query);
							  $left_1 = $result['left_sensor1'];
							  $left_2 = $result['left_sensor2'];
							  $left_3 = $result['left_sensor3'];
							  $left_4 = $result['left_sensor4'];
							  $left_5 = $result['left_sensor5'];
							$datasum_left = ("leftsensor1 :".$left_1.","."leftsensor2 :".$left_2.","."leftsensor3 :".$left_3.","."leftsensor4 :".$left_4.","."leftsensor5 :".$left_5);
							  $right_1 = $result['right_sensor1'];
							  $right_2 = $result['right_sensor2'];
							  $right_3 = $result['right_sensor3'];
							  $right_4 = $result['right_sensor4'];
							  $right_5 = $result['right_sensor5'];
							$datasum_right = ("rightsensor1 :".$right_1.","."rightsensor2 :".$right_2.","."rightsensor3 :".$right_3.","."rightsensor4 :".$right_4.","."rightsensor5 :".$right_5);	
							array_push($left_sensor,$datasum_left);
							array_push($right_sensor,$datasum_right);		
							}
						  }
						if($count > 0 || $count == 0)
						{
							$retData[$count]['action'] = $result['action'];
							$retData[$count]['duration'] = $result['duration'];
							$retData[$count]['left'] = $left_sensor;
							$retData[$count]['right'] = $right_sensor;
//
						}
//					print_r($left_sensor);
//					print_r($right_sensor);

					echo json_encode(['left'=> $left_sensor]);
?>
