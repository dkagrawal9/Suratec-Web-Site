<?php
require_once '../library/connect.php';
header('Content-Type: application/json');
$str = "";
	$str .= "SELECT
    CONCAT(
        mod_customer.fname,
        ' ',
        mod_customer.lname
    ) AS name_cus,
    mod_customer.telephone,
	mod_customer.staff_id,
    mod_customer.email,
    mod_customer.id_customer,
    CASE `type` WHEN '1' THEN 'การแพทย์' WHEN '2' THEN 'การกีฬา'
END AS type_cus,
tbl_member.user_member
FROM
    `mod_customer`
LEFT JOIN tbl_member ON tbl_member.id_data_role = mod_customer.id_customer
WHERE
    `delete_datetime` IS NULL OR delete_datetime IS NULL";
if (isset($_GET["key_search"]) && $_GET["key_search"] != '') {
    $str .= "  AND mod_customer.`fname` LIKE '%".$_GET["key_search"]."%' OR mod_customer.`lname`  LIKE '%".$_GET["key_search"]."%' OR tbl_member.user_member  LIKE '%".$_GET["key_search"]."%'";
}
	$resultArray = array();
	$query = mysqli_query($objConnect,$str);
	while($result = mysqli_fetch_array($query,MYSQLI_ASSOC)){
		array_push($resultArray, $result);
	}
	echo json_encode(['data'=> $resultArray]);
?>