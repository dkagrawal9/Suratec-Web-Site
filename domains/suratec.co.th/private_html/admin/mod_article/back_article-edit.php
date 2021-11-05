<?php 
	 require_once '../library/connect.php';
	  global $objConnect;
	 global $date;

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
unlink("../../uploads/mod_article/".$_POST["pic_edit"]);

}
else{
$nameimg = $_POST["pic_edit"];    
}

    }
}else{
    $nameimg = $_POST["pic_edit"]; 
}
// else{
// 	$nameimg = $_POST["pic_edit"];
// }
	
	$strSQL = "UPDATE article SET";
	$strSQL .= " name_article = '".$_POST["topic"]."' ";
	$strSQL .= " ,text = '".$_POST["editor"]."' ";
	$strSQL .= " ,text_en = '".$_POST["editor_en"]."' ";
	$strSQL .= " ,image = '".$nameimg."' ";
	$strSQL .= " ,title_tag = '".$_POST['titel']."' ";
	$strSQL .= " ,description_tag = '".$_POST["description"]."' ";
  $strSQL .= " ,keywords_tag = '".$_POST["keywords_tag"]."' ";
  $strSQL .= " ,update_datetime = '".$date."' ";
	$strSQL .= "WHERE id_article = '".$_POST['id_article']."' ";
	$objQuery = mysqli_query($objConnect,$strSQL);
	if($objQuery){
		echo "save done.<br> [".$strSQL."]";
		
	}
	else{
		echo "save error [".$strSQL."]";
	}
	//
	
	
?>