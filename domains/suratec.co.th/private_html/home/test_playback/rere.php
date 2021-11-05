<?php

  $id = $_GET['rid'];

  require_once '../admin/library/connect.php';
  header('Content-Type: application/json');
  date_default_timezone_set("Asia/Bangkok");
  $date = date("Y-m-d H:i:s");

/*$sqlpro = "SELECT   *,mod_customer.telephone AS telephone ,mod_customer.id_customer AS id_customer, mod_customer.fname AS fname, mod_customer.lname AS lname FROM  mod_customer 
LEFT JOIN  tbl_member ON mod_customer.id_customer = tbl_member.id_data_role
LEFT JOIN  mod_customer_address ON mod_customer_address.id_customer = mod_customer.id_customer
WHERE  mod_customer.id_customer = '$id' ";

 //echo $sqlpro;

$queryPro = mysqli_query($objConnect, $sqlpro);
$resultPro = mysqli_fetch_array($queryPro);
*/

/*header('Location: ./');
exit();*/

	$sql = "INSERT INTO game (id, id_customer) 
    VALUES ('','$rid')";
    print $sql;
	$query = mysqli_query($objConnect, $sql);

if ($query) {
echo  json_encode(array('code' => 200, 'message' => $sql));
} else {
echo  json_encode(array('code' => 404, 'message' => $sql));
}
?>