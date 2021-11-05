<?php
require_once '../library/connect.php';
date_default_timezone_set("Asia/Bangkok");
$date = date("Y-m-d");

if( file_exists("../../uploads/slide") ){

}else{ 
mkdir("../../uploads/slide");
}

$strSQL = "SELECT level FROM slide";
$objQuery = mysqli_query($objConnect, $strSQL);
$objResult = mysqli_num_rows($objQuery);
$before = '';
if ($objResult = 0) {
    $level = 1;
} else {
    while ( $objResult = mysqli_fetch_array($objQuery) ) {
        $item = $objResult['level'];
        $before .= $item . ".";
    }
    $aftercut = explode(".", $before);
    $after = max($aftercut);
    $level = $after + 1;
}

//$image = $_FILES['image']['name'];
$strSQL = "INSERT INTO slide";
$strSQL .= "(name_slide,name_slide_en,text,text_en,date,level)";
$strSQL .= "VALUES ";
$strSQL .= "('" . $_POST['name'] . "','" . $_POST['name_en'] . "','" . $_POST['content_slide'] . "','" . $_POST['content_slide_en'] . "','$date','$level')";
$objQuery = mysqli_query($objConnect, $strSQL);

if ($objQuery) {
    echo "Add main done.[" . $strSQL . "]";
    // header("Refresh: 0; url=manage-menu.php");
} else {
    echo "Error Add [" . $strSQL . "]";
}
$id_slide = mysqli_insert_id($objConnect);


$namefile = $_FILES["image_slide"]["name"];
$sur = strrchr($namefile, "."); //ตัดนามสกุลไฟล์เก็บไว้
$name = "SL-" . (Date("dmy") . $sur); //ผมตั้งเป็น วันที่_เวลา.นามสกุล
$target = "../../uploads/slide/" . $name;
$newname = $name;

if (file_exists($target)) {
    $oldname = pathinfo($name, PATHINFO_FILENAME);
    $ext = pathinfo($name, PATHINFO_EXTENSION);
    $newname = $oldname;
    do {
        $r = uniqid();
        $newname = $oldname . "-" . $r . ".$ext";
        $target = "../../uploads/slide/" . $newname;
    } while ( file_exists($target) );
}

if (copy($_FILES["image_slide"]["tmp_name"], $target)) // if(copy($_FILES["image_slide"]["tmp_name"],"image-slide/".$_FILES["image_slide"]["name"]))
{
    echo "Copy/Upload Complete<br>";

    $size = $_FILES['image_slide']['size'];
    $strSQL = "INSERT INTO slide_image";
    $strSQL .= "(name_image,size,date,id_slide)";
    $strSQL .= "VALUES ";
    $strSQL .= "('$newname','$size','$date','$id_slide')";
    $objQuery = mysqli_query($objConnect, $strSQL);
} else {
    echo "Copy/upload error<br>";
}

if ($objQuery) {
    echo "Add done.";
} else {
    echo "Error Add [" . $strSQL . "]";
}
mysqli_close($objConnect);
header("Refresh: 0; url=manage-slide.php");
?>