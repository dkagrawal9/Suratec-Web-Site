<?php
// ob_start();
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

require_once '../../admin/library/connect.php';
date_default_timezone_set("Asia/Bangkok");
header('Content-Type: application/json');

if(isset($_POST['username']) || isset($_POST['id_fb']) ){
  require_once '../../admin/library/connect.php';
	doLogin($objConnect);
	exit;
}

if(isset($_POST['username']) || isset($_POST['id_gg']) ){
	require_once '../../admin/library/connect.php';
	  doLogin($objConnect);
	  exit;
  }

if(isset($_POST['action'])){
  require_once '../../admin/library/connect.php';
	doLogout_new($objConnect);
	exit;
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function checkUser($objConnect){
    // ถ้าไม่มีการกำหนดค่า session id ก็จะ Redirect ไปยังหน้า Login อีกครั้ง
        if(!isset($_SESSION["id_facebook"])){
            header('Location: ../index.php');
            exit();

        }else if(!isset($_SESSION["user_id"])){
                header('Location: ../index.php');
                exit();
        }
		else {
        $str = "SELECT * FROM tbl_member WHERE id_member = '".$_SESSION['user_member']."' AND data_role = 'mod_customer'";
        $query = mysqli_query($objConnect, $str);
        $result = mysqli_fetch_array($query);

        if($_SESSION["user_id"]!=$result['member_session_update']){
            header('Location: ../login.php');
            exit();
        }
			else if($_SESSION["id_facebook"]!=$result['member_session_update']){
            header('Location: ../login.php');
            exit();
        }
	}
}

function doLogout_new($objConnect)
{
        unset($_SESSION["id_facebook"],$_SESSION['user_id'],$_SESSION['permission'],$_SESSION['user_member'],$_SESSION['task_view'],$_SESSION['task_authen'],$_SESSION['id_customer']);
		/*header('Location: ../TH/./?index=st');*/
}




function doLogin($objConnect)
{
    header('Content-Type: application/json');

	if(isset($_POST["username"]) && isset($_POST["password"]) ){
		$username = $_POST["username"];
		$password = $_POST["password"];
		// require 'config.php';
		$str = "SELECT * FROM tbl_member
		LEFT JOIN mod_customer
		ON tbl_member.id_data_role = mod_customer.id_customer
		WHERE mod_customer.email = '$username'   ||  tbl_member.user_member = '".$username."' " ;
		$query = mysqli_query($objConnect, $str);
		$result = mysqli_fetch_array($query);
		$row = mysqli_num_rows($query);
		$hash = $result['pass_member'];
		if(!password_verify($password,$hash)) {
			echo json_encode(array('status' => '0','message'=> 'Error login data!'));
			die;
		}
		if(!$result) {
			echo json_encode(array('status' => '0','message'=> 'Error login data!'));
			die;
		}
		else
		{
			$_SESSION["parent_id"] = $result['parent_id'];
			if($result['data_role']!='mod_customer'){ //ไปหลังบ้าน
				$str_employee = 'SELECT * FROM mod_employee WHERE id_employee = "'.$result['id_data_role'].'"';
					$query_employee = mysqli_query($objConnect,$str_employee);
					$_SESSION["user_id"] = session_id();
					$_SESSION["user_member"] = $result['id_member'];
					if($query_employee){
						if($result['permission']=='Super_admin'){
							$_SESSION['permission'] = 'Super_admin';
							$_SESSION['task_view'] = '';
							$_SESSION['task_authen'] = '';
						}else{
							$fetch_employee = mysqli_fetch_array($query_employee);
							$_SESSION['permission'] = 'user';
							$_SESSION["task_view"] = $fetch_employee ["task_view"];
							$_SESSION["task_authen"] = $fetch_employee ["task_authen"];
							$_SESSION["role_id"] = $fetch_employee['role_id'];
						}
					}else{
						$_SESSION['permission'] = 'Super_admin';
						$_SESSION['task_view'] = '';
						$_SESSION['task_authen'] = '';
					}

				$sql = "UPDATE tbl_member
							SET member_last_login = NOW()
								,member_session_update = '".$_SESSION['user_id']."'
							WHERE id_member = '{$result['id_member']}'";
					mysqli_query($objConnect, $sql);

				echo json_encode(array('status' => '2','message'=> $_SESSION['user_id']));

			}else{ // ไปหน้าบ้าน
				$hash = $result['pass_member'];
				if(password_verify($password,$hash)){
						$str_customer = 'SELECT * FROM mod_customer WHERE id_customer = "'.$result['id_data_role'].'"';
						$query_customer = mysqli_query($objConnect,$str_customer);
						$_SESSION["user_id"] = session_id();
						$_SESSION["user_member"] = $result['id_member'];
						$_SESSION["id_customer"] = $result['id_data_role'];
						$_SESSION['permission'] = 'customer';
						$_SESSION["task_view"] = '';
						$_SESSION["task_authen"] = '';


					 $sql = "UPDATE tbl_member
					 		SET member_last_login = NOW()
					 			,member_session_update = '".$_SESSION['user_id']."'
					 		WHERE id_member = '{$result['id_member']}'";
					 mysqli_query($objConnect, $sql);

					

					echo json_encode(array('status' => '1','message'=> $_SESSION['permission']));
				}else{
					echo json_encode(array('status' => '0','message'=> $password));
				}
			}
		}
		mysqli_close($objConnect);


	}elseif(isset($_POST['id_fb']) ){

		$username = $_POST["username"];
		$password = $_POST["password"];
		$id_facebook = $_POST["id_fb"];
		// require 'config.php';

		$str = "SELECT * FROM mod_customer WHERE id_facebook = '".$id_facebook."' ";
		$query = mysqli_query($objConnect, $str);
		$result = mysqli_fetch_array($query);
		if(!$result) {
			echo json_encode(array('status' => '0','message'=> 'Error login data!'));
		}
		else
		{
						//$_SESSION["user_id"] = session_id();
						$_SESSION["id_facebook"] = $result['id_facebook'];
						$_SESSION["id_customer"] = $result['id_customer'];
						$_SESSION['permission'] = 'customer';
						$_SESSION["task_view"] = '';
						$_SESSION["task_authen"] = '';

					echo json_encode(array('status' => '1','message'=> $_SESSION['permission']));
				
			
		
		mysqli_close($objConnect);
		}


		//echo json_encode(array('status' => '1','message'=> "kuy"));
	}
	elseif(isset($_POST['id_gg']) ){

		$username = $_POST["username"];
		$password = $_POST["password"];
		$id_google = $_POST["id_gg"];
		// require 'config.php';

		$str = "SELECT * FROM mod_customer WHERE id_google = '".$id_google."' ";
		$query = mysqli_query($objConnect, $str);
		$result = mysqli_fetch_array($query);
		if(!$result) {
			echo json_encode(array('status' => '0','message'=> 'Error login data!'));
		}
		else
		{
						//$_SESSION["user_id"] = session_id();
						$_SESSION["id_google"] = $result['id_google'];
						$_SESSION["id_customer"] = $result['id_customer'];
						$_SESSION['permission'] = 'customer';
						$_SESSION["task_view"] = '';
						$_SESSION["task_authen"] = '';

					echo json_encode(array('status' => '1','message'=> $_SESSION['permission']));
				
			
		
		mysqli_close($objConnect);
		}


		//echo json_encode(array('status' => '1','message'=> "kuy"));
	}
    
}
// echo json_encode(array('status' => '1','message'=> "kuy"));
?>


