<?php
session_start(); 
// require_once '../admin/library/functions.php';

    
function setMD5(){

  $passuniq = uniqid();
  $passmd5 = md5($passuniq);

  $sumlenght = strlen($passmd5);#num passmd5

  $letter_pre = chr(rand(97,122));#set char for prefix

  $letter_post = chr(rand(97,122));#set char for postfix

  $letter_mid = chr(rand(97,122));#set char for middle string

  $num_rand = rand(0,$sumlenght);#random for cut passmd5

  $cut_pre = substr($passmd5,0,$num_rand);#cutmd5 start 0 stop $numrand
  $setmid = $cut_pre.$letter_mid;#set pre string + char middle

  $cut_post = substr($passmd5,$num_rand, $sumlenght+1);

  $set_modify_md5 = $letter_pre.$setmid.$cut_post.$letter_post;
  return $set_modify_md5;
}



if(isset($_POST['_method'])){

  //register.php  
  if($_POST['_method']=='SELECT_TEX') {
    SELECT_TEX();
    exit;
  }



elseif($_POST['_method']=='ADD_CUTTOMER') {
    ADD_CUTTOMER();
    exit;
}elseif($_POST['_method']=='CHECK_USER') {
  CHECK_USER();
  exit;
}elseif($_POST['_method']=='CHECK_EMAIL') {
  CHECK_EMAIL();
  exit;
}elseif($_POST['_method']=='facebook_login'){
  facebook_login();
}elseif($_POST['_method']=='ADD_EDIT_CUTTOMER'){
  ADD_EDIT_CUTTOMER();
}elseif($_POST['_method']=='CHACK_NEW_PASS'){
  CHACK_NEW_PASS();
}elseif($_POST['_method']=='CREATE_COMMENTNEWS'){
  CREATE_COMMENTNEWS();
}elseif($_POST['_method']=='CREATE_COMMENTARTICLE'){
  CREATE_COMMENTARTICLE();
  exit;
}	



}

if(isset($_POST['ac'])){
  if($_GET['ac']=='true'){
    SELECT_CENTER();
  }
}





function facebook_login(){
  require_once '../admin/library/connect.php';
  header('Content-Type: application/json');
  date_default_timezone_set("Asia/Bangkok");

$fbEmail = $_POST['fbEmail'];
$fbID = $_POST['fbID'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$birthday = $_POST['birthday'];
$pic = $_POST['pic'];
// session_start();

//$id_employee = $_SESSION['id_employee'];

$id_cust = setMD5();


$sql_type = "SELECT id_facebook FROM mod_customer 
WHERE id_facebook = '$fbID'";
$query = mysqli_query($objConnect, $sql_type);
$row = mysqli_fetch_array($query);
    
// $premium_id = $row['sku'];



if(isset($row)){
    if ($query) {
        echo  json_encode(array('code' => 200, 'message' => $sql));
        } else {
        echo  json_encode(array('code' => 404, 'message' => $sql));
        }
}else{

    $sql = "INSERT INTO mod_customer  (id_customer, fname, lname, birthday,img_path,email,id_facebook) 
    VALUES ('".$id_cust."','".$first_name."','".$last_name."','".$birthday."','".$pic."','".$fbEmail."','".$fbID."')";
    print $sql;
$query = mysqli_query($objConnect, $sql);

if ($query) {
echo  json_encode(array('code' => 200, 'message' => $sql));
} else {
echo  json_encode(array('code' => 404, 'message' => $sql));
}

}

}


function ADD_CUTTOMER(){

require_once '../admin/library/connect.php';
// require_once '../admin/library/functions.php';
header('Content-Type: application/json');
date_default_timezone_set("Asia/Bangkok");

  
 $id_customer = setMD5();
 $id_member = setMD5();


$user = $_POST['user'];
$email = $_POST['email'];
$types = $_POST['types'];    
$pass = password_hash($_POST['pass'],PASSWORD_DEFAULT);
$conPass = $_POST['conPass'];

$date = date("Y-m-d H:i:sa");

		$str = "INSERT INTO mod_customer (id_customer,email,create_datetime,type)

        VALUES ('$id_customer','$email','$date','$types')";

      
    $query = mysqli_query($objConnect,$str);  
    //  var_dump($objConnect->error);


if($query){
  
$strSQL3 ="INSERT INTO tbl_member";
$strSQL3 .= "(`id_member`, `user_member`, `pass_member`, `member_regdate`,`id_data_role`,`data_role`)";
$strSQL3 .= "VALUES ";
$strSQL3 .= "('$id_member','$user','$pass','$date','$id_customer','mod_customer')";
$objQuery3 = mysqli_query($objConnect,$strSQL3);


  echo json_encode(array('status' => '1','message'=> "SUCCESS NEW RECORD. "));
}else{
  echo json_encode(array('status' => '0','message'=> "ERROR: ".$str));
}


}


function CHECK_USER(){
  require_once '../admin/library/connect.php';
  // require_once '../admin/library/functions.php';
  header('Content-Type: application/json');
 

	$sql = 'SELECT * FROM tbl_member WHERE user_member = "'.$_POST['user'].'" ';
	$query = mysqli_query($objConnect,$sql);
	$num = mysqli_num_rows($query);
	if($num>0){
		echo json_encode(array('status' => '1', 'message' => $sql));
	}else{
		echo json_encode(array('status' => '0', 'message' => $sql));
	}
}

function CHECK_EMAIL(){
  require_once '../admin/library/connect.php';
  // require_once '../admin/library/functions.php';
  header('Content-Type: application/json');
 

	$sql = 'SELECT * FROM mod_customer WHERE email = "'.$_POST['email'].'" ';
	$query = mysqli_query($objConnect,$sql);
	$num = mysqli_num_rows($query);
	if($num>0){
		echo json_encode(array('status' => '1', 'message' => $sql));
	}else{
		echo json_encode(array('status' => '0', 'message' => $sql));
	}
}



function  ADD_EDIT_CUTTOMER(){
require_once '../admin/library/connect.php';
header('Content-Type: application/json');
date_default_timezone_set("Asia/Bangkok");



$id_customer=$_POST['id'];;
$email = $_POST['email'];
$user = $_POST['edit_user'];
$pass = $_POST['newpass'];
$pass_og = $_POST['pass_og'];

if($pass == ""){
    $pass = $pass_og;  
} else {
    $pass = password_hash($_POST['newpass'],PASSWORD_DEFAULT);
}

$conpass = $_POST['conpass'];



$sql = "SELECT * FROM mod_customer WHERE id_customer = '".$id_customer."'";
    $query = mysqli_query($objConnect,$sql);
    $result = mysqli_fetch_array($query);

      if($_FILES['image']['name']!=''){
        $path = '../uploads/customer';
        if(!is_dir($path)){
          mkdir($path,0777);
        }

        $namefile = $_FILES["image"]["name"];
        $sur = strrchr($namefile, "."); //ตัดนามสกุลไฟล์เก็บไว้
        $name = "CS-".(Date("dmy").rand('1000','9999').$sur); //ผมตั้งเป็น วันที่_เวลา.นามสกุล
        $target = "../uploads/customer/".$name;
        $newname = $name;

        if(file_exists($target)){
          $oldname = pathinfo($name, PATHINFO_FILENAME);
          $ext = pathinfo($name, PATHINFO_EXTENSION);
          $newname = $oldname;
          do{
            $r = rand(1000,9999);
            $newname = $oldname."-".$r.".$ext";
            $target = "../uploads/customer/".$newname;
          }while (file_exists($target)); 
        }
        
        if(copy($_FILES["image"]["tmp_name"],iconv('UTF-8','windows-874',"../uploads/customer/".$newname))){
          // echo "Copy/Upload Complete<br>";
        }else{
          // echo "Copy/upload error<br>";
        }

        if($result['img_path']!=''){
          unlink('../uploads/customer/'.$result['img_path']);
          $image_path = $newname;
        }else{
          $image_path = $newname;
        }
      }else{
        $image_path = $result['img_path'];
      }

      $str = "UPDATE mod_customer SET ";
      $str .= "  fname = '".$_POST['fname']."'";
      $str .= " ,lname = '".$_POST['lname']."'";
      // $str .= " ,code = '".$_POST['code']."'";
      // $str .= " ,birthday = '".$_POST['birthday']."'";
      // $str .= " ,sex = '".$_POST['sex']."'";
      $str .= " ,update_datetime = '".$date."'";
      $str .= " ,email = '".$_POST['email']."'";
      $str .= " ,type = '".$_POST['types']."'";
      // $str .= " ,nickname = '".$_POST['nickname']."'";
      $str .= " ,telephone = '".$_POST['tel']."'";
      // $str .= " ,address = '".$_POST['address']."'";
      //$str .= " ,postcode = '".$_POST['postcode']."'";
      //$str .= " ,state = '".$_POST['state']."'";
     // $str .= " ,suburb = '".$_POST['suburb']."'";
      $str .= " ,img_path = '".$image_path."'";
      $str .= "  WHERE id_customer = '".$id_customer."'";
      $query = mysqli_query($objConnect,$str);

// echo $str;

      if($query){

        $strSQL3 = "UPDATE tbl_member SET
        user_member = '$user'
        ,pass_member = '$pass'
        ,member_regdate = '$date'
        WHERE id_data_role = '$id_customer'";
        $objQuery3 = mysqli_query($objConnect,$strSQL3);

       	echo json_encode(array('status' => '1', 'message' => $str));
      	}else{
		    echo json_encode(array('status' => '0', 'message' => $str));
      }

}

function CHACK_NEW_PASS(){

  require_once '../admin/library/connect.php';
  header('Content-Type: application/json');
  date_default_timezone_set("Asia/Bangkok");

	if(isset($_POST["username"]) && isset($_POST["password"]) ){
		$username = $_POST["username"];
		$password = $_POST["password"];
		// require 'config.php';
		$str = "SELECT * FROM tbl_member WHERE user_member = '".$username."' ";
		$query = mysqli_query($objConnect, $str);
		$result = mysqli_fetch_array($query);
		$row = mysqli_num_rows($query);
		if(!$result) {
			echo json_encode(array('status' => '0','message'=> 'Error login data!'));
		}else{

			if($result['data_role']=='mod_customer'){ // ไปหน้าบ้าน
				$hash = $result['pass_member'];
				if(password_verify($password,$hash)){
						$str_customer = 'SELECT * FROM mod_customer WHERE id_customer = "'.$result['id_data_role'].'"';
						$query_customer = mysqli_query($objConnect,$str_customer);
						// $_SESSION["user_id"] = session_id();
						// $_SESSION["user_member"] = $result['id_member'];
						// $_SESSION["id_customer"] = $result['id_data_role'];
						// $_SESSION['permission'] = 'customer';
						// $_SESSION["task_view"] = '';
						// $_SESSION["task_authen"] = '';


					echo json_encode(array('status' => '1','message'=> $_SESSION['permission']));
				}else{
					echo json_encode(array('status' => '0','message'=> $password));
				}
			}
		}
		mysqli_close($objConnect);

	}
  

}






function CREATE_COMMENTNEWS(){
  require_once '../admin/library/connect.php';
  header('Content-Type: application/json');
  date_default_timezone_set("Asia/Bangkok");
    
$id_article=$_POST['id'];
$date = date("Y-m-d H:i:s");	
    
    $sql2 = "INSERT INTO article_opinion (id,id_article,message,ip,img_path,date_action) 
    VALUES('','$id_article','".$_POST['messagenews']."','".$_POST['cip']."','','".$date."')";
    $query2 = mysqli_query($objConnect,$sql2);


		if($query2){
      
			echo json_encode(array('status' => '1', 'message' => $sql2));
		}else{
			echo json_encode(array('status' => '0', 'message' => $sql2));
		}

}

function CREATE_COMMENTARTICLE(){
  require_once '../admin/library/connect.php';
  header('Content-Type: application/json');
  date_default_timezone_set("Asia/Bangkok");
    
$id_article=$_POST['id'];
$date = date("Y-m-d H:i:s");	
    
    $sql2 = "INSERT INTO article_opinion (id,id_article,message,ip,img_path,date_action) 
    VALUES('','$id_article','".$_POST['message']."','".$_POST['cip']."','','".$date."')";
    $query2 = mysqli_query($objConnect,$sql2);


		if($query2){
      
			echo json_encode(array('status' => '1', 'message' => $sql2));
		}else{
			echo json_encode(array('status' => '0', 'message' => $sql2));
		}

}

 ?>

