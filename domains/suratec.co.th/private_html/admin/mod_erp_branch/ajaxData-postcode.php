<?php
require_once '../library/connect.php';
if($_POST['id']==''){
	exit;
}
$id = explode("-", $_POST['id']);
$str = "SELECT * FROM amphur WHERE AMPHUR_ID = '".$id[1]."'";
$query = mysqli_query($objConnect,$str);
$result = mysqli_fetch_array($query);
echo $result['POSTCODE'];
?>