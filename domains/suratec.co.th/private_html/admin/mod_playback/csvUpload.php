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
    $left_arch_index = 0;
    $right_arch_index = 0;
    $left_fr_ratio = 0;
    $right_fr_ratio = 0;
    $left_foot_length = 0;
    $right_foot_length = 0;
    $left_foot_width = 0;
    $right_foot_width = 0;
    $left_foot_type = 0;
    $right_foot_type = 0;
    $left_peak_pressure = 0;
    $right_peak_pressure = 0;
    $left_peak_zone = 0;
    $right_peak_zone = 0;
     
     
    // Check whether submitted data is not empty 
    if(!empty($user_id)){ 
        // Validate email 
            $uploadStatus = 1; 
            // Upload file 
            $uploadedFile = ''; 
            if(!empty($_FILES["upload_chappal_csv"]["name"])){ 
                 
                // File path config 
                $fileName = basename($_FILES["upload_chappal_csv"]["name"]); 
                $newfilename = date('His') .'_'.$fileName;
                $targetFilePath = $uploadDir.$newfilename;
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                 
                // Allow certain file formats 
                $allowTypes = array('csv'); 
                if(in_array($fileType, $allowTypes)){ 
                    // Upload file to the server 
                    if(move_uploaded_file($_FILES["upload_chappal_csv"]["tmp_name"], $targetFilePath)){ 
                        $uploadedFile = $fileName; 
                        $upload_file_name = $newfilename; 
                    }else{ 
                        $uploadStatus = 0; 
                        $response['message'] = 'Sorry, there was an error uploading your file.'; 
                    } 
                }else{ 
                    $uploadStatus = 0; 
                    $response['message'] = 'Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.'; 
                } 
            } 
             
            if($uploadStatus == 1){ 
                // Include the database config file 
              
                // Insert form data in the database 
                
            $sql ="INSERT INTO `surapodo`(`id`, `user_id`, `file_name`, `left_arch_index`, `right_arch_index`, `left_fr_ratio`, `right_fr_ratio`, `left_foot_length`, `right_foot_length`, `left_foot_width`, `right_foot_width`, `left_foot_type`, `right_foot_type`, `left_peak_pressure`, `right_peak_pressure`, `left_peak_zone`, `right_peak_zone`, `upload_file_name`) VALUES (null,'".$user_id."','".$uploadedFile."','".$left_arch_index."','".$right_arch_index."','".$left_fr_ratio."','".$right_fr_ratio."','".$left_foot_length."','".$right_foot_length."','".$left_foot_width."','".$right_foot_width."','".$left_foot_type."','".$right_foot_type."','".$left_peak_pressure."','".$right_peak_pressure."','".$left_peak_zone."','".$right_peak_zone."','".$upload_file_name."')"; 
            $query = mysqli_query($objConnect, $sql);
            $result = mysqli_fetch_array($query);      
            
            if($result){ 
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }else{
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }        
    }
?>