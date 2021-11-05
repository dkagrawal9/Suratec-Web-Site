<?php
	 require_once '../library/connect.php';
	date_default_timezone_set("Asia/Bangkok");
	 global $objConnect;
	 global $date;
	
		if( file_exists("../../uploads/mod_central_information") )
{

}
else
{ 
mkdir("../../uploads/mod_central_information");
}
 
if ($_FILES['pic0']['name']!='') {
 $fieldname = $_FILES['pic0']['name'];
  $filename = explode(".", $_FILES['pic2']['name']);
  $tmpName = $_FILES['pic0']['tmp_name'];
  $finfo = finfo_open(FILEINFO_MIME_TYPE);
  // Get mime type.
  $mimeType = finfo_file($finfo, $tmpName);

  // Get extension. You must include fileinfo PHP extension.
  $extension = end($filename);

  // Allowed extensions.
  $allowedExts = array("gif", "jpeg", "jpg", "png", "svg", "blob");

  // Allowed mime types.
  $allowedMimeTypes = array("image/gif", "image/jpeg", "image/pjpeg", "image/x-png", "image/png", "image/svg+xml");



       $pic_tmpe=$_FILES['pic0']['tmp_name'];
       $pic_name=$_FILES['pic0']['name'];
       // $pic_size=$_FILES['pic']['size'][$i];
       $ext1e=explode(".",$pic_name);
       $exte=end($ext1e);
         if($exte=="jpg" or $exte=="jpeg" or $exte=="png" or $exte=="gif") {  
          copy($pic_tmpe,"../../uploads/mod_central_information/".$pic_name);

 }
 if (isset($pic_name) && $pic_name!='') {

$sur = strrchr($pic_name, ".");
$photo = $pic_name;
$id = "P-".(Date("dmy").rand('1000','9999')); //สมมตินะ
$folder="../../uploads/mod_central_information";//ที่อยู่โฟลเดอร์ที่จะเปลี่ยนชื่อ และไม่มีเครื่องหมาสแลชต่อท้าย
$ext = explode('.',$photo);
$ext = end($ext);

 (rename($folder.'/'.$photo, $folder.'/'.$id.'.'.$ext))?"สำเร็จ":"ผิดพลาด";

 $date=date("Y-m-d H:i:s");

 $nameimg = $id.'.'.$ext;
unlink("../../uploads/mod_central_information/".$_POST["pic_logo_ed"]);

}
else{
$nameimg = $_POST["pic_logo_ed"];    
}

 
}else{
    $nameimg = $_POST["pic_logo_ed"]; 
}

/////////////////////////////////////
	
 
if ($_FILES['pic2']['name']!='') {
 $fieldname1 = $_FILES['pic2']['name'];
  $filename1 = explode(".", $_FILES['pic2']['name']);
  $tmpName1 = $_FILES['pic2']['tmp_name'];
  $finfo1 = finfo_open(FILEINFO_MIME_TYPE);
  // Get mime type.
  $mimeType1 = finfo_file($finfo1, $tmpName1);

  // Get extension. You must include fileinfo PHP extension.
  $extension1 = end($filename1);

  // Allowed extensions.
  $allowedExts1 = array("gif", "jpeg", "jpg", "png", "svg", "blob");

  // Allowed mime types.
  $allowedMimeTypes1 = array("image/gif", "image/jpeg", "image/pjpeg", "image/x-png", "image/png", "image/svg+xml");

  // Validate image.
  if (!in_array(strtolower($mimeType1), $allowedMimeTypes1) || !in_array(strtolower($extension1), $allowedExts1)) {
    echo 'none';
    exit();
    // throw new \Exception("File does not meet the validation.");
  } else{

       $pic_tmpe1=$_FILES['pic2']['tmp_name'];
       $pic_name1=$_FILES['pic2']['name'];
       // $pic_size=$_FILES['pic']['size'][$i];
       $ext1e1=explode(".",$pic_name1);
       $exte1=end($ext1e1);
         if($exte1=="jpg" or $exte1=="jpeg" or $exte1=="png" or $exte1=="gif") {  
          copy($pic_tmpe1,"../../uploads/mod_central_information/".$pic_name1);

 }
 if (isset($pic_name1) && $pic_name1!='') {

$sur1 = strrchr($pic_name1, ".");
$photo1 = $pic_name1;
$id1 = "P-".(Date("dmy").rand('1000','9999')); //สมมตินะ
$folder1="../../uploads/mod_central_information";//ที่อยู่โฟลเดอร์ที่จะเปลี่ยนชื่อ และไม่มีเครื่องหมาสแลชต่อท้าย
$ext1 = explode('.',$photo1);
$ext1 = end($ext1);

 (rename($folder1.'/'.$photo1, $folder1.'/'.$id1.'.'.$ext1))?"สำเร็จ":"ผิดพลาด";

 $date1=date("Y-m-d H:i:s");

 $nameimg1 = $id1.'.'.$ext1;
unlink("../../uploads/mod_central_information/".$_POST["pic_header_ed"]);

}
else{
$nameimg1 = $_POST["pic_header_ed"];    
}

    }
}else{
    $nameimg1 = $_POST["pic_header_ed"]; 
}
//////////////////////////////////////
	$name_setting = explode(",", $_POST['name_setting']);
	//$id_setting = explode(",", $_POST['id_setting']);
	//print_r($name_setting);


	for ($i=0; $i < count($name_setting) ; $i++) { 
if ($name_setting[$i]=='pic_logo' ) {
	$name_value = $nameimg;
}elseif ($name_setting[$i]=='pic_header') {
	$name_value = $nameimg1;
}else{
	$name_value = $_POST[$name_setting[$i]];
}
// if ($name_setting[$i]=='pic_header') {
// 	$name_value = $nameimg1;
// }else{
// 	$name_value = $_POST[$name_setting[$i]];
// }
echo $name_value;
echo "<br>";

	 $strSQL = "SELECT * FROM `contact` WHERE `setting` ='".$name_setting[$i]."'";
           $objQuery = mysqli_query($objConnect,$strSQL) or die (mysqli_error());
           $objResult = mysqli_fetch_array($objQuery);
	
	if (isset($objResult['setting']) && $objResult['setting'] != '' ) {
		$strSQL = "UPDATE `contact` SET `value` = '".$name_value."', `edit_datetime` = '$date'  WHERE `contact`.`setting` = '".$name_setting[$i]."'";
		$objQuery = mysqli_query($objConnect,$strSQL);
	}else{
	$strSQL = "INSERT INTO `contact`(`id`, `setting`, `value`, `edit_datetime`)";
	$strSQL .= "VALUES ";
	$strSQL .= "(null,'".$name_setting[$i]."','".$name_value."','$date')";
	$objQuery = mysqli_query($objConnect,$strSQL);
	}

	}
	
	
	if($objQuery){
		echo "done.[".$strSQL."]";
		// header("Refresh: 0; url=manage-menu.php");
	}
	else{
		echo "Error  [".$strSQL."]";
	}

	

mysqli_close($objConnect);
// header("Refresh: 0; url=front-add.php");

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
?>