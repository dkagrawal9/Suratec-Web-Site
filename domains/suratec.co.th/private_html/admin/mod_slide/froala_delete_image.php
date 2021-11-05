<?php 
    // print_r($_POST);
    $fieldname = $_POST['src'];
    unlink($fieldname) or die("Couldn't delete file");
?>