
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
    $filename = $_POST['filename'];
    
    $sql_customer = "SELECT * FROM `surapodo` WHERE `user_id`= '$user_id' and `file_name`= '$filename' ";
    
        $query_customer = mysqli_query($objConnect, $sql_customer);
        $result_customer = mysqli_fetch_array($query_customer);
        if ($query_customer && $query_customer->num_rows > 0) {
            echo 0;
            die;
        }
        echo 1;
        die;
    ?>