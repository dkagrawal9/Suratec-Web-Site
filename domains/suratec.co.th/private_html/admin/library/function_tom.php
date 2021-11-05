<?php
if (!isset($_SESSION)) {
    session_start();
}

function check_active_navbar ($query_page , $this_page ){ //เทียบค่า ที่ query ว่าเท่ากับ คงที่มั้ย return active
    if($query_page === $this_page){
        return " active ";
    }
}
function check_index_zero($index){ //เทียบค่า ที่ query ว่าเท่ากับ คงที่มั้ย return active
    if($index === 0){
        return " active ";
    }
}
function check_active_navbar_content($namefile_current){ //เทียบค่า ที่ query ว่าเท่ากับ คงที่มั้ย return active
    if($namefile_current == "contact"){
        return " active ";
    }else{
        return "";
    }
    
}
function check_active_navbar_index($namefile_current){ //เทียบค่า ที่ query ว่าเท่ากับ คงที่มั้ย return active
    if ($namefile_current == "index"){
        return " active ";
    }else{
        return "";
    }
}
function get_id_link_youtube($link_youtube){ //ตัด link youtube เอาแต่ id
    $arr_youtube_sub = array();
    $arr_youtube = explode("=" , $link_youtube);
    if(count($arr_youtube)>2){
        $arr_youtube_sub  = explode("&", $arr_youtube[1]);
    }else{
        array_push($arr_youtube_sub , $arr_youtube[1] );
    }
    return  $arr_youtube_sub[0];
}



function go_back_page(){
    echo '<script>window.history.back();</script>';
}
function query_main($sql,$objConnect){
    $objQuery = mysqli_query($objConnect,$sql) or die (mysqli_error());
    $objResult = mysqli_fetch_array($objQuery);
    return $objResult ;  
}
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}


//        <div class="col-md-4">
//
//                <div class="d-flex text-local ml-auto">
/*                    <button class="btn btn-default lang  <?=check_cookie_active($_COOKIE['lang'], "en")?> "*/
//                        data-id="en"><img src="images/EN.png" width="30" height="20" alt="">
//                        <span class="sub-country">EN</span>
//                    </button>
/*                    <button class="btn btn-default lang <?=check_cookie_active($_COOKIE['lang'], "ch") ?>  "*/
//                        data-id="ch"><img src="images/ZH.png" width="30" height="20" alt="">
//                        <span class="sub-country">ZH</span>
//                    </button>
/*                    <button class="btn btn-default lang <?=check_cookie_active($_COOKIE['lang'], "th")  ?> "*/
//                        data-id="th"> <img src="images/TH.png" width="30" height="20" alt="">
//                        <span class="sub-country">TH</span>
//                    </button>
//
//
//                    <!--                    <img src="images/TH.png" width="30" height="20" alt="">-->
//                    <!--                    <span class="sub-country">TH</span>-->
//                </div>
//            </div>



//$(document).ready(function(){$(document).on("click",".lang",function(n){var o=$(this).attr("data-id");setCookie("lang",o),location.reload()})});

function check_cookie_active ($cookie , $lang){ //เทียบค่า ที่ query ว่าเท่ากับ คงที่มั้ย return active
    echo $cookie ;
    if($lang == "th"){
        if ($cookie == "th" ){
            return " btn-primary ";
        }else{
            return "";
        }
    }else if ($lang == "en"){
        if ($cookie == "en"){
            return " btn-primary ";
        }else{
            return "";
        }
    }else if ($lang == "ch"){
        if ($cookie == "ch"){
            return " btn-primary ";
        }else{
            return "";
        }
    }
return "";
}
function setCookieEmpty($cookie_name , $cookie_value){
    if(!isset($_COOKIE[$cookie_name]) ) {
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
    }
}






//
//// ถ้าผู้ใช้ต้องการ login
//if (isset($_POST['username'])) {
//    doLogin($objConnect);
//} elseif (isset($_POST['username_admin'])){
//    doCreatetbl($objConnect);
//}
//
//
//
//function checkAdminUser($objConnect)
//{
//    // ถ้าไม่มีการกำหนดค่า session id ก็จะ Redirect ไปยังหน้า Login อีกครั้ง
//    if (!isset($_SESSION["user_id"])) {
//        header('Location: ../login.php');
//        exit;
//    } else {
//        $str = "SELECT * FROM tbl_member WHERE id_member = '".$_SESSION['user_member']."' AND data_role != 'mod_customer'";
//        $query = mysqli_query($objConnect, $str);
//        $result = mysqli_fetch_array($query);
//
//        if($_SESSION["user_id"]!=$result['member_session_update']){
//            header('Location: ../login.php');
//            exit();
//        }
//
//    }
//    // ถ้าผู้ใช้ต้องการ logout
//    if (isset($_GET['logout'])) {
//        doLogout($objConnect);
//    }
//
//}
//
//
//
//
//
//function doCreatetbl($objConnect){
//    header('Content-Type: application/json');
//
//        $cmd = "CREATE TABLE IF NOT EXISTS `tbl_member`(
//                `id_member` varchar(35) NOT NULL,
//                `user_member` varchar(100) NOT NULL,
//                `pass_member` varchar(100) NOT NULL,
//                `member_regdate` datetime NOT NULL,
//                `member_last_login` datetime NOT NULL,
//                `member_last_logout` datetime NOT NULL,
//                `member_session_update` varchar(130) NOT NULL,
//                `data_role` varchar(30) NOT NULL,
//                `permission` varchar(30) NOT NULL,
//                `del_time` datetime DEFAULT NULL,
//                `id_data_role` varchar(35) NOT NULL,
//                PRIMARY KEY (`id_member`)
//              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
//        $query_testt = mysqli_query($objConnect,$cmd);
//
//        $cmd = "CREATE TABLE IF NOT EXISTS froala_uploads(
//                 `id_uploads` int(11) NOT NULL AUTO_INCREMENT,
//                  `name_uploads` varchar(100) NOT NULL,
//                  `link_uploads` varchar(100) NOT NULL,
//                  `img_path` varchar(100) NOT NULL,
//                  PRIMARY KEY (`id_uploads`)
//                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
//        $query_testt = mysqli_query($objConnect,$cmd);
//
//         $cmd = "CREATE TABLE IF NOT EXISTS link_local(
//                `id_link` int(11) NOT NULL AUTO_INCREMENT,
//                `name` varchar(50) NOT NULL,
//                `table` varchar(100) NOT NULL,
//                `link` varchar(50) NOT NULL,
//                PRIMARY KEY (`id_link`)
//                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
//       $query_testt = mysqli_query($objConnect,$cmd);
//
//        $cmd = "CREATE TABLE IF NOT EXISTS system(
//                 `id_system` int(11) NOT NULL AUTO_INCREMENT,
//                  `name_system` varchar(100) NOT NULL,
//                  `name_system_en` varchar(100) NOT NULL,
//                  `link_system` varchar(100) NOT NULL,
//                  `type` int(11) NOT NULL,
//                  `groups` int(11) NOT NULL,
//                  `sort` int(11) NOT NULL,
//                  `level` varchar(100) NOT NULL,
//                  `icon` varchar(100) NOT NULL,
//                  `date_add` date NOT NULL,
//                  `date_update` date NOT NULL,
//                  PRIMARY KEY (`id_system`)
//                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
//        $query_testt = mysqli_query($objConnect,$cmd);
//
//        $id_member = setMD5();
//        $username = $_POST['username_admin'];
//        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
//        $cmd = "INSERT INTO `tbl_member` (
//        `id_member`,
//        `user_member`,
//        `pass_member`,
//        `member_regdate`,
//        `member_last_login`,
//        `member_last_logout`,
//        `member_session_update`,
//        `data_role`,
//        `permission`,
//        `del_time`,
//        `id_data_role`) VALUES
//        ('$id_member', '$username',
//            '$password',
//            NOW(),
//            '0000-00-00 00:00:00',
//            '0000-00-00 00:00:00',
//            '',
//            'Super_admin',
//            'Super_admin',
//            NULL,
//            '');";
//        $query_test =mysqli_query($objConnect,$cmd);
//        doLogin($objConnect);
//}
//
//
//function doLogin($objConnect)
//{
//    header('Content-Type: application/json');
//    if(isset($_POST['username_admin'])){
//        $username = $_POST['username_admin'];
//    }else{
//        $username = $_POST["username"];
//    }
//    $password = $_POST["password"];
//    // require 'config.php';
//    $str = "SELECT * FROM tbl_member WHERE user_member = '".$username."'";
//    $query = mysqli_query($objConnect, $str);
//    $result = mysqli_fetch_array($query);
//    $row = mysqli_num_rows($query);
//    if(!$result) {
//        echo json_encode(array('status' => '0','message'=> 'Error login data!'));
//    }
//    else
//    {
//        $hash = $result['pass_member'];
//        if(password_verify($password,$hash)){
//            if(isset($_POST['username_admin'])){
//                $_SESSION["user_id"] = session_id();
//                $_SESSION["user_member"] = $result['id_member'];
//                $_SESSION['permission'] = 'Super_admin';
//                $_SESSION['task_view'] = '';
//                $_SESSION['task_authen'] = '';
//            }else{
//                $str_employee = 'SELECT * FROM mod_employee WHERE id_employee = "'.$result['id_data_role'].'"';
//                $query_employee = mysqli_query($objConnect,$str_employee);
//                $_SESSION["user_id"] = session_id();
//                $_SESSION["user_member"] = $result['id_member'];
//                if($query_employee){
//                    if($result['permission']=='Super_admin'){
//                        $_SESSION['permission'] = 'Super_admin';
//                        $_SESSION['task_view'] = '';
//                        $_SESSION['task_authen'] = '';
//
//                    }else{
//                        $fetch_employee = mysqli_fetch_array($query_employee);
//                        $_SESSION['permission'] = 'user';
//                        $_SESSION["task_view"] = $fetch_employee ["task_view"];
//                        $_SESSION["task_authen"] = $fetch_employee ["task_authen"];
//
//                    }
//                }else{
//                    $_SESSION['permission'] = 'Super_admin';
//                    $_SESSION['task_view'] = '';
//                    $_SESSION['task_authen'] = '';
//                }
//            }
//
//            $sql = "UPDATE tbl_member
//                    SET member_last_login = NOW()
//                        ,member_session_update = '".$_SESSION['user_id']."'
//                    WHERE id_member = '{$result['id_member']}'";
//            mysqli_query($objConnect, $sql);
//
//
//
//            echo json_encode(array('status' => '1','message'=> $_SESSION['permission']));
//        }else{
//            echo json_encode(array('status' => '0','message'=> $password));
//        }
//    }
//    mysqli_close($objConnect);
//}
//
//
//
//function doLogout($objConnect)
//{
//    if (isset($_SESSION['user_id'])) {
//         echo $_GET['logout'];
//        //*** Update Status
//        $sql = "UPDATE tbl_member SET member_session_update = '' WHERE id_member = '".$_SESSION["user_id"]."' ";
//        $query = mysqli_query($objConnect,$sql);
//        if($query){
//            echo "complete".$sql;
//            unset($_SESSION['user_id'],$_SESSION['permission'],$_SESSION['user_member'],$_SESSION['task_view'],$_SESSION['task_authen'],$_SESSION['id_customer']);
//          //ล้างค่าออกจากตัวแปร $_SESSION
//        }else{
//            echo "error".$sql;
//        }
//    }
//
//    //กลับไปยังหน้าล็อกอินอีกครั้ง
//    if(isset($_GET['logout'])=='logout'){
//
//        unset($_SESSION['user_id'],$_SESSION['permission'],$_SESSION['user_member'],$_SESSION['task_view'],$_SESSION['task_authen'],$_SESSION['id_customer']);
//        header('Location: ../index.php');
//        exit;
//    }
//
//}
//
//function doLogout_new($objConnect)
//{
//        unset($_SESSION['user_id'],$_SESSION['permission'],$_SESSION['user_member'],$_SESSION['task_view'],$_SESSION['task_authen'],$_SESSION['id_customer']);
//}
