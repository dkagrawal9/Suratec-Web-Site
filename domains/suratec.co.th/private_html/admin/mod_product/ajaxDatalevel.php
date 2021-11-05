<?php
require_once '../library/connect.php';

$str = explode("-", $_POST["id_level"]);
$level = $str['0'];
$id = $str['1'];

    $strSQL = "UPDATE product SET";
    $strSQL .= " level_product = '$level' ";
    $strSQL .= "WHERE id_product = '$id' ";
    //Fetch all state data
    mysqli_query($objConnect,$strSQL);
    
    //Count total number of rows
    // $rowCount = mysqli_num_rows($query);
    
    // //State option list
    // if($rowCount > 0){
        
    //     while($row = mysqli_fetch_array($query)){ 
    //         echo '<option value="'.$row['id_catagory'].'">'.$row['name_catagory'].'</option>';
    //     }
    // }else{
    //     echo '<option value="">article not available</option>';
    // }

?>