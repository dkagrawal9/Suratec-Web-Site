<?php

try {
  // File Route.
  $fileRoute1 = "../../uploads/mod_freedom_page/";

  // Create file route if not file route.
  if(!is_dir($fileRoute1)){
    mkdir($fileRoute1);
  }
   $fileRoute = "../../uploads/mod_freedom_page/file/";

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
  $allowedExts = array("txt", "pdf", "doc");

  // Allowed mime types.
  $allowedMimeTypes = array("text/plain", "application/msword", "application/x-pdf", "application/pdf");

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