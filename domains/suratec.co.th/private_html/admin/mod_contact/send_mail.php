<?php
var_dump($_POST);




$emailto=$_POST['email_data'];; //อีเมล์ผู้รับ<br>
$subject=$_POST['subject_data']; //หัวข้อ<br>
$header.= "Content-type: text/html; charset=utf-8\n";

$header.="from: ".$_POST['name_to_reply']." : ".$_POST['email_to_reply']; //ชื่อและอีเมลผู้ส่ง<br>

$messages.= "<h1>www.Bookoins.com</h1>"; //ข้อความ<br>
$messages.= "<hr>"; //ข้อความ<br>
$messages.= "<h3>User : ".$_POST['name_to_data']."</h3><br>"; //ข้อความ<br>

$messages.= "<h3>หัวข้อ : ".$_POST['subject_data']."</h3>"; //ข้อความ<br>
$messages.= "<h3>ข้อความ</h3>"; //ข้อความ<br>

$messages.= "<h4>".$_POST['message_data']."</h4>"; //ข้อความ<br>
$messages.= "<hr>"; //ข้อความ<br>

$messages.= "<h3>การตอบกลับ</h3><br>"; //ข้อความ<br>
$messages.= "<h4>".$_POST['mass_to_reply']."</h4><br>"; //ข้อความ<br>
$messages.= "By : ".$_POST['name_to_reply']."<br>"; //ข้อความ<br>
$send_mail = mail($emailto,$subject,$messages,$header);
// if(!$send_mail)
// {
// echo"ยังไม่สามารถส่งเมลล์ได้ในขณะนี้";
// }
// else
// {
// echo "ส่งเมลล์สำเร็จ";
// }


if($send_mail) {
    header('Content-Type: application/json');
    echo json_encode(array('status'=> '1', 'message'=> $str));
}
else {
    header('Content-Type: application/json');
    echo json_encode(array('status'=> '0', 'message'=> $str));
}

?>



