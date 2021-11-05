<?php
if( file_exists("../../uploads/froala_slide") )
{
  if( file_exists("../../uploads/froala_slide/file") )
{

}
else
{ 
mkdir("../../uploads/froala_slide/file");
}
}
else
{ 
mkdir("../../uploads/froala_slide");
if( file_exists("../../uploads/froala_slide/file") )
{

}
else
{ 
mkdir("../../uploads/froala_slide/file");
}
}
try {
  // File Route.
  $fileRoute = "../../uploads/froala_slide/file/";

  // Create file route if not file route.
  if(!is_dir($fileRoute)){
    mkdir($fileRoute);
  }

  $fieldname = $_FILES['fileName']['name'];

  // Get filename.
  $filename = explode(".", $_FILES['fileName']['name']);

  // Validate uploaded files.
  // Do not use $_FILES["file"]["type"] as it can be easily forged.
  $finfo = finfo_open(FILEINFO_MIME_TYPE);

  // Get temp file name.
  $tmpName = $_FILES['fileName']['tmp_name'];

  // Get mime type.
  $mimeType = finfo_file($finfo, $tmpName);

  // Get extension. You must include fileinfo PHP extension.
  $extension = end($filename);

  // Allowed extensions.
  $allowedExts = array("txt", "pdf", "doc", "docx", "xls", "xlt", "xla", "xlsx", "ppt", "pot","pps","ppa","pptx"); 
  
     
  // Allowed mime types.
  $allowedMimeTypes = array("text/plain", "application/msword", "application/x-pdf", "application/pdf", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.ms-excel", "application/vnd.ms-excel", "application/vnd.ms-powerpoint", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet","application/vnd.openxmlformats-officedocument.presentationml.presentation");

  // Validate image.
  if (!in_array(strtolower($mimeType), $allowedMimeTypes) || !in_array(strtolower($extension), $allowedExts)) {
    throw new \Exception("File does not meet the validation.");
   
  }

  // Generate new random name.
  $name = sha1(microtime()) . "." . $extension;
  $fullNamePath = $fileRoute . $name;

  // Check server protocol and load resources accordingly.
  if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] != "off") {
    $protocol = "https://";
  } else {
    $protocol = "http://";
  }

  // Save file in the uploads folder.
  move_uploaded_file($tmpName, $fullNamePath);

  // Generate response.
  $response = new \StdClass;
  $response->link = $fullNamePath;

  // Send response.
  echo stripslashes(json_encode($response));

} catch (Exception $e) {
   // Send error response.
   echo $e->getMessage();
   http_response_code(404);
}
?>