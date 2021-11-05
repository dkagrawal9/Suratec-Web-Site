<?php
 if(!isset($_SESSION)) 
 { 
     session_start(); 
 } 
require_once '../library/connect.php';
require_once '../library/functions.php';
checkAdminUser($objConnect);

$uploadDir = 'uploadcsv/'; 
$response = array( 
    'status' => 0, 
    'message' => 'Form submission failed, please try again.' 
); 

 
    // Get the submitted form data 
    $user_id = $_POST['user_id'];
    $left_arch_index = $_POST['left_arch_index'];
    $right_arch_index = $_POST['right_arch_index'];
    $left_fr_ratio = $_POST['left_fr_ratio'];
    $right_fr_ratio = $_POST['right_fr_ratio'];
    $left_foot_length = $_POST['left_foot_length'];
    $right_foot_length = $_POST['right_foot_length'];
    $left_foot_width = $_POST['left_foot_width'];
    $right_foot_width = $_POST['right_foot_width'];
    $left_foot_type = $_POST['left_foot_type'];
    $right_foot_type = $_POST['right_foot_type'];
    $left_peak_pressure = $_POST['left_peak_pressure'];
    $right_peak_pressure = $_POST['right_peak_pressure'];
    $left_peak_zone = $_POST['left_peak_zone'];
    $right_peak_zone = $_POST['right_peak_zone'];
    $upload_file_name = $_POST['upload_file_name'];
     
     
    // Check whether submitted data is not empty 
    if(!empty($user_id)){ 
         $sql =  $insert ="UPDATE `surapodo` SET `left_arch_index`='".$left_arch_index."',`right_arch_index`='".$right_arch_index."',`left_fr_ratio`='".$left_fr_ratio."',`right_fr_ratio`='".$right_fr_ratio."',`left_foot_length`='".$left_foot_length."',`right_foot_length`='".$right_foot_length."',`left_foot_width`='".$left_foot_width."',`right_foot_width`='".$right_foot_width."',`left_foot_type`='".$left_foot_type."',`right_foot_type`='".$right_foot_type."',`left_peak_pressure`='".$left_peak_pressure."',`right_peak_pressure`='".$right_peak_pressure."',`left_peak_zone`='".$left_peak_zone."',`right_peak_zone`='".$right_peak_zone."' WHERE upload_file_name='".$upload_file_name."' AND user_id='".$user_id."'"; 
        $query = mysqli_query($objConnect, $sql);                     
        $response['status']= 1;
        $response['status']= 'Data updated successfully';
        echo json_encode($response);
        
    }
?>