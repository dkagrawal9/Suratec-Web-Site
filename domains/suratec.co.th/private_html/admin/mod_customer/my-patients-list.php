<?php
require_once '../library/connect.php';
header('Content-Type: application/json');

if(!isset($_SESSION)) {
	session_start();
}


$sqlMember = "SELECT id_data_role FROM tbl_member WHERE id_member = '".$_SESSION['user_member']."'";
$member = $objConnect->query($sqlMember)->fetch_object();


$str = "";
	$str .= "SELECT
    CONCAT(
        mod_customer.fname,
        ' ',
        mod_customer.lname
    ) AS name_cus,
	mod_customer.assigned_dr,
    mod_customer.telephone,
    mod_customer.email,
    mod_customer.id_customer,
    CASE `type` WHEN '1' THEN 'การแพทย์' WHEN '2' THEN 'การกีฬา' WHEN '3' THEN 'เบาหวาน' END AS type_cus,
		tbl_member.user_member
		FROM `mod_customer`
		INNER JOIN tbl_member ON tbl_member.id_data_role = mod_customer.id_customer
		WHERE mod_customer.assigned_dr = '$member->id_data_role' AND `delete_datetime` IS NULL";

if (isset($_GET["key_search"]) && $_GET["key_search"] != '') {
    $str .= "  AND mod_customer.`fname` LIKE '%".$_GET["key_search"]."%' OR mod_customer.`lname`  LIKE '%".$_GET["key_search"]."%' OR tbl_member.user_member  LIKE '%".$_GET["key_search"]."%'";
}


	$resultArray = array();
	$query = mysqli_query($objConnect,$str);
	while($result = mysqli_fetch_array($query,MYSQLI_ASSOC)){
		$result['name_cus'] = "<a href='/admin/mod_employee/patient-profile.php?id=".$result['id_customer']."' target='_blank'>".$result['name_cus']."</a>";
		array_push($resultArray, $result);
	}
	echo json_encode(['data'=> $resultArray]);
?>
