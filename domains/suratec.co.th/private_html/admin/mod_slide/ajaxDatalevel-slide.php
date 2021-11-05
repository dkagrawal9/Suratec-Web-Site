<?php
require_once '../library/connect.php';

// $str = explode("-", $_POST["id_level"]);
// $level = $str['0'];
// $id = $str['1'];

//  $strSQL1 = "SELECT * FROM slide WHERE id_slide = '".$_POST["id"]."'";
// $strQuery1 = mysqli_query($objConnect,$strSQL1);
// while($objResult1 = mysqli_fetch_array($strQuery1)){
//             $level = $objResult1['level'];
           
// }
// if (isset($level)&&$level != '') {
//  $strSQL = "SELECT * FROM slide WHERE level = '".$_POST["level"]."'";
// $strQuery = mysqli_query($objConnect,$strSQL);
// while($objResult = mysqli_fetch_array($strQuery)){
//             $id_slide = $objResult['id_slide'];
           
// }
// $aftercut = explode("-", $before);
// if(in_array($level,$aftercut)){
//     echo "none";
// }else{
if (isset($_POST["id"]) && $_POST["id"] != '') {
	

    $strSQL1 = "UPDATE slide SET";
    $strSQL1 .= " level = '".$_POST["level"]."' ";
    $strSQL1 .= "WHERE id_slide = '".$_POST["id"]."' ";
    //Fetch all state data
    mysqli_query($objConnect,$strSQL1);

    // $strSQL = "UPDATE slide SET";
    // $strSQL .= " level = '".$_POST["level"]."' ";
    // $strSQL .= "WHERE id_slide = '".$_POST["id"]."' ";
    //Fetch all state data
    // mysqli_query($objConnect,$strSQL);
 }else{
 	echo "none";
 }

?>