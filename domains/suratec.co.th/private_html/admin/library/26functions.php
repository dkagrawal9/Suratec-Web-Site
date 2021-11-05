<?php
session_start();
require 'connect.php';

// ถ้าผู้ใช้ต้องการ login
if (isset($_POST['username'])) {
    doLogin($objConnect);
} elseif (isset($_POST['username_admin'])){
    doCreatetbl($objConnect);
}

function checkAdminUser($objConnect)
{
    // ถ้าไม่มีการกำหนดค่า session id ก็จะ Redirect ไปยังหน้า Login อีกครั้ง
    if (!isset($_SESSION["user_id"])) {
        header('Location: ../login.php');
        exit;
    } else {
        $str = "SELECT * FROM tbl_member WHERE id_member = '".$_SESSION['user_member']."' AND data_role != 'mod_customer'";
        $query = mysqli_query($objConnect, $str);
        $result = mysqli_fetch_array($query);

        if($_SESSION["user_id"]!=$result['member_session_update']){
            header('Location: ../login.php');
            exit();
        }

    }
    // ถ้าผู้ใช้ต้องการ logout
    if (isset($_GET['logout'])) {
        doLogout($objConnect);
    }

}

function checkMemUser($objConnect)
{
    // ถ้าไม่มีการกำหนดค่า session id ก็จะ Redirect ไปยังหน้า Login อีกครั้ง
    if (!isset($_SESSION["id_customer"])) {
        header('Location: Signin_Signup.php?Signin_Signup=st');
        exit;
    } else {

    }
}

function doCreatetbl($objConnect){  
    header('Content-Type: application/json');
    
        $cmd = "CREATE TABLE IF NOT EXISTS `tbl_member`(
                `id_member` varchar(35) NOT NULL,
                `user_member` varchar(100) NOT NULL,
                `pass_member` varchar(100) NOT NULL,
                `member_regdate` datetime NOT NULL,
                `member_last_login` datetime NOT NULL,
                `member_last_logout` datetime NOT NULL,
                `member_session_update` varchar(130) NOT NULL,
                `data_role` varchar(30) NOT NULL,
                `permission` varchar(30) NOT NULL,
                `del_time` datetime DEFAULT NULL,
                `id_data_role` varchar(35) NOT NULL,
                PRIMARY KEY (`id_member`)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $query_testt = mysqli_query($objConnect,$cmd);

        $cmd = "CREATE TABLE IF NOT EXISTS froala_uploads(
                 `id_uploads` int(11) NOT NULL AUTO_INCREMENT,
                  `name_uploads` varchar(100) NOT NULL,
                  `link_uploads` varchar(100) NOT NULL,
                  `img_path` varchar(100) NOT NULL,
                  PRIMARY KEY (`id_uploads`)  
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $query_testt = mysqli_query($objConnect,$cmd);

         $cmd = "CREATE TABLE IF NOT EXISTS link_local(
                `id_link` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(50) NOT NULL,
                `table` varchar(100) NOT NULL,
                `link` varchar(50) NOT NULL,
                PRIMARY KEY (`id_link`)  
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
       $query_testt = mysqli_query($objConnect,$cmd);

        $cmd = "CREATE TABLE IF NOT EXISTS system(
                 `id_system` int(11) NOT NULL AUTO_INCREMENT,
                  `name_system` varchar(100) NOT NULL,
                  `name_system_en` varchar(100) NOT NULL,
                  `link_system` varchar(100) NOT NULL,
                  `type` int(11) NOT NULL,
                  `groups` int(11) NOT NULL,
                  `sort` int(11) NOT NULL,
                  `level` varchar(100) NOT NULL,
                  `icon` varchar(100) NOT NULL,
                  `date_add` date NOT NULL,
                  `date_update` date NOT NULL,
                  PRIMARY KEY (`id_system`)  
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $query_testt = mysqli_query($objConnect,$cmd);

        $id_member = setMD5();
        $username = $_POST['username_admin'];
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $cmd = "INSERT INTO `tbl_member` (
        `id_member`, 
        `user_member`, 
        `pass_member`, 
        `member_regdate`, 
        `member_last_login`, 
        `member_last_logout`, 
        `member_session_update`, 
        `data_role`, 
        `permission`, 
        `del_time`, 
        `id_data_role`) VALUES
        ('$id_member', '$username', 
            '$password', 
            NOW(), 
            '0000-00-00 00:00:00', 
            '0000-00-00 00:00:00', 
            '', 
            'Super_admin', 
            'Super_admin', 
            NULL, 
            '');";
        $query_test =mysqli_query($objConnect,$cmd);
        doLogin($objConnect);
}


function doLogin($objConnect)
{
    header('Content-Type: application/json');
    if(isset($_POST['username_admin'])){
        $username = $_POST['username_admin'];
    }else{
        $username = $_POST["username"];
    }
    $password = $_POST["password"];
    // require 'config.php';
    $str = "SELECT * FROM tbl_member WHERE user_member = '".$username."'";
    $query = mysqli_query($objConnect, $str);
    $result = mysqli_fetch_array($query);
    $row = mysqli_num_rows($query);
    if(!$result) {
        echo json_encode(array('status' => '0','message'=> 'Error login data!'));
    }
    else
    {
        $hash = $result['pass_member'];
        if(password_verify($password,$hash)){
            if(isset($_POST['username_admin'])){
                $_SESSION["user_id"] = session_id();
                $_SESSION["user_member"] = $result['id_member'];
                $_SESSION['permission'] = 'Super_admin';
                $_SESSION['task_view'] = '';
                $_SESSION['task_authen'] = '';
                
            }else{
                $str_employee = 'SELECT * FROM mod_employee WHERE id_employee = "'.$result['id_data_role'].'"';
                $query_employee = mysqli_query($objConnect,$str_employee);
                $_SESSION["user_id"] = session_id();
                $_SESSION["user_member"] = $result['id_member'];
                $_SESSION["id_employee"] = $result['id_data_role'];

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
            }

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
    mysqli_close($objConnect);
}

/*
    Logout a user admin
*/
function doLogout($objConnect)
{
    if (isset($_SESSION['user_id'])) {
        //*** Update Status
        $sql = "UPDATE tbl_member SET status = '0', member_session_update = '0000-00-00 00:00:00' WHERE id_member = '".$_SESSION["user_id"]."' ";
        $query = mysqli_query($objConnect,$sql);
          //ล้างค่าออกจากตัวแปร $_SESSION
    }

    //กลับไปยังหน้าล็อกอินอีกครั้ง  
    if($_GET['logout']=='main'){
        unset($_SESSION['user_id'],$_SESSION['permission'],$_SESSION['user_member'],$_SESSION["role_id"]);
        header('Location: ../../home/Signin_Signup.php?Signin_Signup=st');
        exit;
    } 
}

function checkmember($objConnect)
{
    // ถ้าไม่มีการกำหนดค่า session id ก็จะ Redirect ไปยังหน้า Login อีกครั้ง
    if (!isset($_SESSION["id_customer"])) {
        header('Location: Signin_Signup.php');
        exit;
    } else {
        
        }
 }


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

?>