<?php 
	 require_once '../library/connect.php';
	  global $objConnect;
	 global $date;

	if( file_exists("../../uploads/mod_contract") )
{

}
else
{ 
mkdir("../../uploads/mod_contract");
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
          copy($pic_tmpe,"../../uploads/mod_contract/".$pic_name);

 }
 if (isset($pic_name) && $pic_name!='') {

$sur = strrchr($pic_name, ".");
$photo = $pic_name;
$id = "P-".(Date("dmy").rand('1000','9999')); //สมมตินะ
$folder="../../uploads/mod_contract";//ที่อยู่โฟลเดอร์ที่จะเปลี่ยนชื่อ และไม่มีเครื่องหมาสแลชต่อท้าย
$ext = explode('.',$photo);
$ext = end($ext);

 (rename($folder.'/'.$photo, $folder.'/'.$id.'.'.$ext))?"สำเร็จ":"ผิดพลาด";

 $date=date("Y-m-d H:i:s");

 $nameimg = $id.'.'.$ext;
unlink("../../uploads/mod_contract/".$_POST["pic_map"]);

}
else{
$nameimg = $_POST["pic_map"];    
}

    }
}else{
    $nameimg = $_POST["pic_map"]; 
}


$name_setting = explode(",", $_POST['name_setting']);
  


  for ($i=0; $i < count($name_setting) ; $i++) { 
if ($name_setting[$i]=='pic_map' ) {
  $name_value = $nameimg;
}else{
  $name_value = $_POST[$name_setting[$i]];
}

var_dump($_POST);

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
	
	
?>