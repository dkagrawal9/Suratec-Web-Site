<?php

include('../../../back_check-login.php');
if (!isset($_SESSION["user_id"])) {
    header('Location: ../../../login.php');
    exit;
}
checkAdminUser();

use Admin\Connection;

// url /design.php?id=

require_once ('vendor/autoload.php');
//include ('tcpdf/tcpdf.php');

define('IMAGE_2D','image/2d' );
define('IMAGE_1D', 'image/1d' );

if(!isset($_GET['id'])){
    multi();
}else{

    single();
}

function single(){
    include ('../../Connect/Connection.php');

    $id = filter_input(INPUT_GET , 'id',FILTER_VALIDATE_INT);
    $cmd = "SELECT * FROM employees LEFT JOIN employee_record ON employees.id = employee_record.employees_id WHERE employees.id=?";

    $db = Connection::connect();


    $stmt = $db->prepare($cmd);
    $stmt->bind_param('i',$id);

    if($stmt->execute()){
        if($rows = $stmt->get_result()->fetch_assoc()){
            $create = new \Card\Create($id,"/admin".$rows['image_path'],$rows['fullname_th'],$rows['card_id'],$rows['postion']);
            $create->Single();
        }
    }
}

function multi(){
    include ('../../Connect/Connection.php');
    $cmd = "SELECT * FROM employees LEFT JOIN employee_record ON employees.id = employee_record.employees_id";

    $db = Connection::connect();
    $result = $db->query($cmd);
    $data = array();
    while($rows = $result->fetch_assoc()){
        $create = new \Card\Create($rows['id'],"/admin".$rows['image_path'],$rows['fullname_th'],$rows['card_id'],$rows['postion']);
        array_push($data,$create);
    }

    $create = new \Card\Create();

    $create->All($data);
}


?>