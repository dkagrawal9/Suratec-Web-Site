<?php
require_once '../library/connect.php';
session_start();
	if(isset($_POST['_method'])){
		
		if($_POST['_method']=='CREATE_icon'){
			CREATE_icon();
			exit;
		}
		else if($_POST['_method']=='edit_icon'){
 		 edit_icon();
 		 exit;
		}

	}else{
		
		 if($_GET['_method']=='btndel_one_icon'){
 		 btndel_one_icon();
 		 exit;
		}
	}


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





	function CREATE_icon(){
		header('Content-Type: application/json');
		global $objConnect;
		global $date;
		$id=setMD5();
if( file_exists("../../uploads/mod_manage_links") )
{

}
else
{ 
mkdir("../../uploads/mod_manage_links");
}
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
     echo json_encode(array('status' => '3', 'message' => "File does not meet the validation."));
    exit();
  }

       $pic_tmpe=$_FILES['pic']['tmp_name'];
       $pic_name=$_FILES['pic']['name'];
       // $pic_size=$_FILES['pic']['size'][$i];
       $ext1e=explode(".",$pic_name);
       $exte=end($ext1e);
         if($exte=="jpg" or $exte=="jpeg" or $exte=="png" or $exte=="gif") {  
          copy($pic_tmpe,"../../uploads/mod_manage_links/".$pic_name);

 }
 if (isset($pic_name) && $pic_name!='') {

$sur = strrchr($pic_name, ".");
$photo = $pic_name;
$id = "icon-".(Date("dmy").rand('1000','9999')); //สมมตินะ
$folder="../../uploads/mod_manage_links";//ที่อยู่โฟลเดอร์ที่จะเปลี่ยนชื่อ และไม่มีเครื่องหมาสแลชต่อท้าย
$ext = explode('.',$photo);
$ext = end($ext);

 (rename($folder.'/'.$photo, $folder.'/'.$id.'.'.$ext))?"สำเร็จ":"ผิดพลาด";

 $date=date("Y-m-d H:i:s");

$nameimg = $id.'.'.$ext;
}else{
$nameimg = '';	
}


		

		$str = "INSERT INTO `mod_footer`(`id_footer`,name,  `linked`, `icon`, `del_flg`) VALUES (null,'".$_POST["name_add"]."','".$_POST["link_add"]."','".$nameimg."','0')";
		$query = mysqli_query($objConnect,$str);

		if($query){
			echo json_encode(array('status' => '1', 'message' => $str));
		}else{
			echo json_encode(array('status' => '0', 'message' => $str));
		}


	}


		function edit_icon(){
			header('Content-Type: application/json');
		global $objConnect;
		global $date;

if( file_exists("../../uploads/mod_manage_links") )
{

}
else
{ 
mkdir("../../uploads/mod_manage_links");
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
    echo json_encode(array('status' => '3', 'message' => "File does not meet the validation."));
    exit();
    // throw new \Exception("File does not meet the validation.");
  }	else{

       $pic_tmpe=$_FILES['pic']['tmp_name'];
       $pic_name=$_FILES['pic']['name'];
       // $pic_size=$_FILES['pic']['size'][$i];
       $ext1e=explode(".",$pic_name);
       $exte=end($ext1e);
         if($exte=="jpg" or $exte=="jpeg" or $exte=="png" or $exte=="gif") {  
          copy($pic_tmpe,"../../uploads/mod_manage_links/".$pic_name);

 }
 if (isset($pic_name) && $pic_name!='') {

$sur = strrchr($pic_name, ".");
$photo = $pic_name;
$id = "P-".(Date("dmy").rand('1000','9999')); //สมมตินะ
$folder="../../uploads/mod_manage_links";//ที่อยู่โฟลเดอร์ที่จะเปลี่ยนชื่อ และไม่มีเครื่องหมาสแลชต่อท้าย
$ext = explode('.',$photo);
$ext = end($ext);

 (rename($folder.'/'.$photo, $folder.'/'.$id.'.'.$ext))?"สำเร็จ":"ผิดพลาด";

 $date=date("Y-m-d H:i:s");

$nameimg = $id.'.'.$ext;
}else{
$nameimg = $_POST["pic_ed"];	
}

	}
}else{
	$nameimg = $_POST["pic_ed"];	
}

if ($nameimg == $_POST["pic_ed"]) {
	$str = "UPDATE `mod_footer` SET `name`='".$_POST["name_edit"]."',`linked`='".$_POST["link_edit"]."',`icon`='".$nameimg."' WHERE `id_footer`=	'".$_POST["id_icon"]."'";
		$query = mysqli_query($objConnect,$str);

		if($query){
			$id_customer = mysqli_insert_id($objConnect);
			echo json_encode(array('status' => '1', 'message' => $str));
		}else{
			echo json_encode(array('status' => '0', 'message' => $str));
		}
}else{
	if (!in_array(strtolower($mimeType), $allowedMimeTypes) || !in_array(strtolower($extension), $allowedExts)) {
   
    // throw new \Exception("File does not meet the validation.");
  }	else{

	$str = "UPDATE `mod_footer` SET `name`='".$_POST["name_edit"]."',`linked`='".$_POST["link_edit"]."',`icon`='".$nameimg."' WHERE `id_footer`=	'".$_POST["id_icon"]."'";
		$query = mysqli_query($objConnect,$str);

		if($query){
			$id_customer = mysqli_insert_id($objConnect);
			echo json_encode(array('status' => '1', 'message' => $str));
		}else{
			echo json_encode(array('status' => '0', 'message' => $str));
		}
}
 



	


	}
}


function btndel_one_icon() {
	header('Content-Type: application/json');
	global $objConnect;
		global $date;

		$str = "UPDATE `mod_footer` SET`del_flg`= '1' WHERE `id_footer`= '".$_GET["id_edit"]."'";
		$query = mysqli_query($objConnect,$str);

		if($query){
			$id_customer = mysqli_insert_id($objConnect);
			echo json_encode(array('status' => '0', 'message' => $str));
		}else{
			echo json_encode(array('status' => '1', 'message' => $str));
		}
}


?>