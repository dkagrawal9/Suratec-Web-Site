<?php 

    require_once '../admin/library/connect.php';
    require_once '../admin/library/functions.php';
    header('Content-Type: application/json');

    if(!isset($_SESSION)) {
        session_start();
    }

    $id = setMD5();
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $detail = $_POST['detail'];

    $sql = "INSERT INTO `mod_contact`(`id_mail`, `name`, `email`, `tel`, `subject`, `message`, `send_datetime`, `status`) VALUES ('".$id."','".$name."','".$email."','".$phone."','".$subject."','".$detail."','".$date."','')";
    $query = mysqli_multi_query($objConnect, $sql);

    if($query) {
        $contact = array('status'=> '200', 'sql'=> $sql);
    }
    else {
        $contact = array('status'=> '404', 'sql'=> $sql);
    }
        
    echo json_encode(['contact' => $contact]);

?>