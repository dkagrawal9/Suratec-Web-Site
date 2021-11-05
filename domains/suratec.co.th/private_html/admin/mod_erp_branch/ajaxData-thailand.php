<?php
include('backoffice/pages/Connect/back_connectDB.php');
$id = explode("-", $_POST['id']);
$str = "SELECT * FROM province WHERE GEO_ID = '".$id[1]."'";
$query = mysqli_query($objConnect,$str);
	echo '<option value="">---เลือกจังหวัด---</option>';
while($result = mysqli_fetch_array($query)){
	echo '<option value='.$result['PROVINCE_CODE'].'-'.$result['PROVINCE_ID'].'-'.$result['PROVINCE_NAME'].'>'.$result['PROVINCE_NAME'].'</option>';
}
?>