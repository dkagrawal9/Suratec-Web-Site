<?php
session_start();
	 require_once '../library/connect.php';
	date_default_timezone_set("Asia/Bangkok");
	 global $objConnect;
	 global $date;
	
	$id =setMD5();

	if( file_exists("../../uploads/mod_article") )
{

}
else
{ 
mkdir("../../uploads/mod_article");
}
 
if ($_FILES['pic']['name']!='') {
 $fieldname = $_FILES['pic']['name'];
  $filename = explode(".", $_FILES['pic']['name']);
  $tmpName = $_FILES['pic']['tmp_name'];
  $finfo = finfo_open(FILEINFO_MIME_TYPE);
  // Get mime type.
  $mimeType = finfo_file($finfo, $tmpName);

  // Get extension. You must include fileinfo PHP extension.
  $extension = end($filename);

  // Allowed extensions.
  $allowedExts = array("gif", "jpeg", "jpg", "png", "svg", "blob");

  // Allowed mime types.
  $allowedMimeTypes = array("image/gif", "image/jpeg", "image/pjpeg", "image/x-png", "image/png", "image/svg+xml");

  // Validate image.
  if (!in_array(strtolower($mimeType), $allowedMimeTypes) || !in_array(strtolower($extension), $allowedExts)) {
    echo 'none';
    exit();
    // throw new \Exception("File does not meet the validation.");
  } else{

       $pic_tmpe=$_FILES['pic']['tmp_name'];
       $pic_name=$_FILES['pic']['name'];
       // $pic_size=$_FILES['pic']['size'][$i];
       $ext1e=explode(".",$pic_name);
       $exte=end($ext1e);
         if($exte=="jpg" or $exte=="jpeg" or $exte=="png" or $exte=="gif") {  
          copy($pic_tmpe,"../../uploads/mod_article/".$pic_name);

 }
 if (isset($pic_name) && $pic_name!='') {

$sur = strrchr($pic_name, ".");
$photo = $pic_name;
$id = "P-".(Date("dmy").rand('1000','9999')); //สมมตินะ
$folder="../../uploads/mod_article";//ที่อยู่โฟลเดอร์ที่จะเปลี่ยนชื่อ และไม่มีเครื่องหมาสแลชต่อท้าย
$ext = explode('.',$photo);
$ext = end($ext);

 (rename($folder.'/'.$photo, $folder.'/'.$id.'.'.$ext))?"สำเร็จ":"ผิดพลาด";

 $date=date("Y-m-d H:i:s");

 $nameimg = $id.'.'.$ext;


}
else{
$nameimg = '';    
}

    }
}else{
    $nameimg = '';    
}



	$strSQL = "INSERT INTO `article`( `name_article`,  `text`, `text_en`, `image`,  `title_tag`, `description_tag`, `keywords_tag`, `create_by`, `create_datetime`,id_catagory) VALUES ('".$_POST['topic']."','".$_POST['editor']."','".$_POST['editor_en']."','".$nameimg."','".$_POST['titel']."','".$_POST['description']."','".$_POST['keywords_tag']."','".$_SESSION["id_employee"]."','".$date."','".$_POST['id_article-catagory']."')";
	
	$objQuery = mysqli_query($objConnect,$strSQL);
	if($objQuery){
		echo "Add done.[".$strSQL."]";
		// header("Refresh: 0; url=manage-menu.php");
	}
	else{
		echo "Error Add [".$strSQL."]";
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