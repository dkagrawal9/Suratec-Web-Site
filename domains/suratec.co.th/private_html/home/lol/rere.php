<?php

$rid = $_GET['customeremail'];
$rid1 = $_GET['refno'];
echo $rid;
echo $rid1;

  require_once '../admin/library/connect.php';
  header('Content-Type: application/json');
  date_default_timezone_set("Asia/Bangkok");

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