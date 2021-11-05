<?php
session_start();
	

require_once '../library/connect.php';

	if(isset($_POST['_method'])){
		if($_POST['_method']=='CREATE'){
			CREATE();
			exit;
		}elseif($_POST['_method']=='edit'){
			edit();
			exit;
		}elseif($_POST['_method']=="up_team_member"){
			up_team_member();
			exit;
		}else if($_POST['_method']=='check'){
 		 check();
 		 exit;
		}else if($_POST['_method']=='check_edit'){
 		 check_edit();
 		 exit;
		}
	}else{
		if($_GET['_method']=="del"){
			del();
			exit;
		}
		

		
	}

  function setMD5()
        {
            $passuniq = uniqid();
            $passmd5 = md5($passuniq);

            $sumlenght = strlen($passmd5);#num passmd5

            $letter_pre = chr(rand(97, 122));#set char for prefix

            $letter_post = chr(rand(97, 122));#set char for postfix

            $letter_mid = chr(rand(97, 122));#set char for middle string

            $num_rand = rand(0, $sumlenght);#random for cut passmd5

            $cut_pre = substr($passmd5, 0, $num_rand);#cutmd5 start 0 stop $numrand
        $setmid = $cut_pre.$letter_mid;#set pre string + char middle

        $cut_post = substr($passmd5, $num_rand, $sumlenght+1);

            $set_modify_md5 = $letter_pre.$setmid.$cut_post.$letter_post;
            return $set_modify_md5;
        }



function check_edit() {
  header('Content-Type: application/json');
  global $objConnect;
  global $date;
 $idem1=$_POST["data"];
 $data_id=$_POST["data_id"];
 $datetimepicker = $_POST["datetimepicker"];
$date_se = explode("-", $datetimepicker);

    $strSQL1 = "SELECT * FROM `coupon` WHERE `code`='$idem1' AND ( ('".$date_se[0]."  00:00:00' BETWEEN `start_date` AND `end_date`) OR ('".$date_se[1]."  00:00:00' BETWEEN `start_date` AND `end_date`)) AND coupon_id != '$data_id' "; 
    $objQuery1 = mysqli_query($objConnect,$strSQL1); 
    $intRows1 = mysqli_num_rows($objQuery1); 
    if($intRows1>0)
      {
        echo json_encode(array('status'=>1,'message'=>$strSQL1));
      }else
      {
        echo json_encode(array('status'=>2,'message'=>$strSQL1));
      }

}

function check() {
  header('Content-Type: application/json');
  global $objConnect;
  global $date;
 $idem1=$_POST["data"];
 $datetimepicker = $_POST["datetimepicker"];
$date_se = explode("-", $datetimepicker);



     $strSQL1 = "SELECT * FROM `coupon` WHERE `code` = '$idem1' AND ( ('".$date_se[0]."  00:00:00' BETWEEN `start_date` AND `end_date`) OR ('".$date_se[1]."  00:00:00' BETWEEN `start_date` AND `end_date`))"; 

// echo    $strSQL1 = "SELECT * FROM `coupon` WHERE `code`='$idem1' AND `end_date` >=  '$date'"; 
    $objQuery1 = mysqli_query($objConnect,$strSQL1); 
    $intRows1 = mysqli_num_rows($objQuery1); 
    if($intRows1>0)
      {
        echo json_encode(array('status'=>1,'message'=>$strSQL1));
      }else
      {
        echo json_encode(array('status'=>2,'message'=>$strSQL1));
      }

}
	function CREATE(){
		global $objConnect;
		global $date;
		$id = setMD5();

$datetimepicker = explode("-", $_POST['datetimepicker_add']);
$email = '';
for ($i=0; $i < count($_POST['email']) ; $i++) { 
$email .= $_POST['email'][$i].',';
}

// echo $num = count($_POST['provinces']);
// for ($i=0; $i < $num; $i++) { 
// $provinces ;
// echo $provinces .=  $_POST['provinces'][$i].",";
// }
echo "<br>";
// echo $provinces;


		$str = "INSERT INTO `coupon`(`coupon_id`, `code`, `name`, `discount`, `quantity`, `start_date`, `end_date`, `customer`, `create_by`, `create_datetime`, `update_by`, `update_datetime`, `delete_datetime`) VALUES (null,'".$_POST['coubon_code']."','".$_POST['coubon_name']."','".$_POST['discount_add']."','".$_POST['num_coubon']."','$datetimepicker[0] 00:00:00','$datetimepicker[1] 23:59:59','$email','".$_SESSION["id_employee"]."','$date','','',null)";

		$query = mysqli_query($objConnect,$str);

		if($query){
			$id_customer = mysqli_insert_id($objConnect);
			echo json_encode(array('status' => '1', 'message' => $str));
		}else{
			echo json_encode(array('status' => '0', 'message' => $str));
		}

// echo $sql2 = "SELECT * FROM `coupon`  ORDER BY coupon.id ASC";
//  $query2 = mysqli_query($objConnect, $sql2);
//  while ($result2 = mysqli_fetch_array($query2)) {
//  	$id_coubon = $result2["id"];
//  }
// for ($i=0; $i < count($_POST['email']) ; $i++) { 

// $sql_email = "SELECT * FROM `member` WHERE `id` ='".$_POST['email'][$i]."'";
//  $query_email = mysqli_query($objConnect, $sql_email);
//  while ($result_email = mysqli_fetch_array($query_email)) {
//  	$member_email = $result_email["email"];
//  }
// 		$str1 = "INSERT INTO `coupon_detail`(`id`, `coupon_id`, `member_id`, `email`, `create_by`, `create_time`, `update_by`, `update_time`, `deleted_time`) VALUES (null,'$id_coubon','".$_POST['email'][$i]."','$member_email', '".$_SESSION["id_employee"]."','$date','',null,null)";
// 		$query1 = mysqli_query($objConnect,$str1);

// 		if($query1){
// 			echo "complete".$str1;
// 		}else{
// 			echo "error".$str1;
// 		}
// }
	



	}

function edit(){
		global $objConnect;
		global $date;
		$id = setMD5();

$datetimepicker = explode("-", $_POST['datetimepicker_edit']);
print_r($datetimepicker);
$email = '';
for ($i=0; $i < count($_POST['email_edit']) ; $i++) { 
$email .= $_POST['email_edit'][$i].',';
}

// echo $num = count($_POST['provinces']);
// for ($i=0; $i < $num; $i++) { 
// $provinces ;
// echo $provinces .=  $_POST['provinces'][$i].",";
// }
echo "<br>";
// echo $provinces;


		$str = "UPDATE `coupon` SET `code`='".$_POST['coubon_code_edit']."',`name`='".$_POST['coubon_name_edit']."',`discount`='".$_POST['discount_edit']."',`quantity`='".$_POST['num_coubon_edit']."',`start_date`='".$datetimepicker[0]." 00:00:00',`end_date`='".$datetimepicker[1]." 23:59:59',`customer`='$email',`update_by`='".$_SESSION["id_employee"]."',`update_datetime`='$date' WHERE `coupon_id`='".$_POST['id']."'";

		$query = mysqli_query($objConnect,$str);

		if($query){
			$id_customer = mysqli_insert_id($objConnect);
			echo json_encode(array('status' => '1', 'message' => $str));
		}else{
			echo json_encode(array('status' => '0', 'message' => $str));
		}
echo "<br>";
 $sql2 = "DELETE FROM `coupon_detail` WHERE `coupon_id` ='".$_POST['id']."'";
 $query2 = mysqli_query($objConnect, $sql2);
 
for ($i=0; $i < count($_POST['email']) ; $i++) { 

$sql_email = "SELECT * FROM `member` WHERE `id` ='".$_POST['email'][$i]."'";
 $query_email = mysqli_query($objConnect, $sql_email);
 while ($result_email = mysqli_fetch_array($query_email)) {
 	$member_email = $result_email["email"];
 }
		$str1 = "INSERT INTO `coupon_detail`(`id`, `coupon_id`, `member_id`, `email`, `create_by`, `create_time`, `update_by`, `update_time`, `deleted_time`) VALUES (null,'".$_POST['id']."','".$_POST['email'][$i]."','$member_email', '".$_SESSION["id_employee"]."','$date','',null,null)";
		$query1 = mysqli_query($objConnect,$str1);

		if($query1){
			echo "complete".$str1;
		}else{
			echo "error".$str1;
		}
}
	

		

	}

	function del(){
		global $objConnect;
		global $date;

	echo	$str = "UPDATE `coupon` SET `delete_datetime` = '$date' WHERE `coupon_id` =  '".$_GET['id']."'";
		$query = mysqli_query($objConnect,$str);

		if($query){
			echo json_encode(array('status' => '1', 'message' => $str));
		}else{
			echo json_encode(array('status' => '0', 'message' => $str));
		}
	}


function del_team_member(){
		global $objConnect;
		global $date;

	echo	$str = "UPDATE `team_member` SET `del_flg` = '1' WHERE `team_member`.`id` =  '".$_GET['id']."'";
		$query = mysqli_query($objConnect,$str);

		if($query){
			echo json_encode(array('status' => '1', 'message' => $str));
		}else{
			echo json_encode(array('status' => '0', 'message' => $str));
		}
	}


?>