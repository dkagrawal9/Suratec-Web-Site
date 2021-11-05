<?php 
require_once 'library/connect.php';
require_once 'library/functions.php';
if (!isset($_SESSION["user_id"])) {
    header('Location: login.php');
    exit;
}else{
	header('Location: page_home/index.php');
}


?>