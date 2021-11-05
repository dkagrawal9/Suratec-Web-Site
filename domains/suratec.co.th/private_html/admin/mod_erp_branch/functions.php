<?php
require_once '../library/connect.php';

if ($_POST['form'] == 'check_user_ex') {
    doCheckuser();
    exit;
} elseif ($_POST['form'] == 'add') {
    doAddbranch();
    exit;
} elseif ($_POST['form'] == 'edit') {
    doEdit();
    exit;
} elseif ($_POST['form'] == 'del') {
    doDel();
    exit;
} elseif ($_POST['form'] == 'delmulti') {
    doDelmul();
    exit;
} elseif ($_POST['_method'] == 'soft-del') {
    doSoftdel();
    exit;
} elseif ($_POST['form'] == 'soft-delmulti') {
    doSoftdelmulti();
    exit;
} elseif($_POST['_method']=='import_csv'){
            import_csv();
            exit;
        }
if ($_GET['_method'] == 'soft-del') {
    doSoftdel();
    exit;
}
if ($_GET['form'] == 'soft-delmulti') {
    doSoftdel();
    exit;
}


function setMD5()
{

    $passuniq = uniqid();
    $passmd5 = md5($passuniq);

    $sumlenght = strlen($passmd5);#num passmd5

    $letter_pre = chr(rand(97, 122));#set char for prefix

    $letter_post = chr(rand(97, 122));#set char for postfix

    $letter_mid = chr(rand(97, 122));#set char for middle string

    $num_rand = rand(0, $sumlenght);#random for cut passmd5

    $cut_pre = substr($passmd5, 0, $num_rand);#cutmd5 start 0 stop $numrand
    $setmid = $cut_pre . $letter_mid;#set pre string + char middle

    $cut_post = substr($passmd5, $num_rand, $sumlenght + 1);

    $set_modify_md5 = $letter_pre . $setmid . $cut_post . $letter_post;
    return $set_modify_md5;
}



function import_csv(){
        global $objConnect;
        global $date;



move_uploaded_file($_FILES["fileCSV"]["tmp_name"],$_FILES["fileCSV"]["name"]); // Copy/Upload CSV

// $objConnect = mysql_connect("localhost","root","root") or die("Error Connect to Database"); // Conect to MySQL
// $objDB = mysql_select_db("mydatabase");

$objCSV = fopen($_FILES["fileCSV"]["name"], "r");

while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {
    $id = setMD5();
    $strSQL = "INSERT INTO mod_erp_branch ";
    $strSQL .="(`id_branch`, `code_branch`, `no_branch`, `name_branch`, `province`, `amphoe`, `district`, `zipcode`, `address`) ";
    $strSQL .="VALUES ";
    $strSQL .="('$id','".$objArr[6]."','".$objArr[7]."','".$objArr[0]."' ";
    $strSQL .=",'".$objArr[4]."','".$objArr[3]."','".$objArr[2]."','".$objArr[5]."','".$objArr[1]."') ";
    echo $strSQL;
    $query = mysqli_query($objConnect,$strSQL);




}

fclose($objCSV);

echo "Upload & Import Done.";



        if($query){
            echo json_encode(array('status' => '1', 'message' => $strSQL));
        }else{
            echo json_encode(array('status' => '0', 'message' => $strSQL));
        }
    }   

function doSoftdel()
{

    require_once '../library/connect.php';
     global $objConnect;
    $str = "UPDATE mod_erp_branch SET delete_datetime = '$date' WHERE id_branch = '" . $_GET["id"] . "'";
    $query = mysqli_query($objConnect, $str);
    if ($query) {
        echo 'Complete' . $str;
    } else {
        echo 'error' . $str;
    }
}

function doSoftdelmulti()
{
    require_once '../library/connect.php';
     global $objConnect;
     global $date;
    for ($i = 0; $i < count($_POST["Chk"]); $i++) {
        $str = "UPDATE mod_erp_branch SET delete_datetime = '$date' WHERE id_branch = '" . $_POST["Chk"][$i] . "'";
        $query = mysqli_query($objConnect, $str);
        if ($query) {
         //   echo 'Complete' . $str;
        } else {
         ///   echo 'error' . $str;
        }
    }
}

function doAddbranch()
{
    require_once '../library/connect.php';
    date_default_timezone_set("Asia/Bangkok");
    global $objConnect;

    if (isset($_POST['amphur'])) {
        $amphur = $_POST['amphur'];
    } else {
        $amphur = '';
    }

    if (isset($_POST['district'])) {
        $district = $_POST['district'];
    } else {
        $district = '';
    }

    $id_branch = setMD5();
    $location = null;

    $date_regdate = date("Y-m-d H:i:s");
    $strSQL = "INSERT INTO mod_erp_branch";
    $strSQL .= "(id_branch,code_branch,no_branch,name_branch,province,amphoe,district,zipcode,address,location,phone,email,type,tax)";
    $strSQL .= "VALUES ";
    $strSQL .= "('" . $id_branch . "','" . $_POST['code_branch'] . "','" . $_POST['no_branch'] . "','" . $_POST['name_branch'] . "','" . $_POST['province'] . "','" . $_POST['amphoe'] . "','" . $_POST['district'] . "','" . $_POST['zipcode'] . "','" . $_POST['address'] . "','" . $location . "','" . $_POST['phone'] . "','" . $_POST['email'] . "','" . $_POST['type'] . "','" . $_POST['taxid'] . "')";
    $objQuery = mysqli_query($objConnect, $strSQL);
    if ($objQuery) {
     //   echo "Add done.[" . $strSQL . "]";
        // header("Refresh: 0; url=manage-menu.php");
    } else {
       
     //   echo "Error Add [" . $strSQL . "]";
    }


    if ($_FILES['image_branch']['name'] != '') {
        $namefile = $_FILES["image_branch"]["name"];
        $sur = strrchr($namefile, "."); //ตัดนามสกุลไฟล์เก็บไว้
        $name = "Branch-" . $_POST['name_branch'] . '-' . $_POST['code_branch'] . '-' . (Date("dmy") . rand('1000', '9999') . $sur); //ผมตั้งเป็น วันที่_เวลา.นามสกุล
        $target = "../../uploads/branch/" . $name;
        $newname = $name;

        if (file_exists($target)) {
            $oldname = pathinfo($name, PATHINFO_FILENAME);
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            $newname = $oldname;
            do {
                $r = rand(1000, 9999);
                $newname = $oldname . "-" . $r . ".$ext";
                $target = "../../uploads/branch/" . $newname;
            } while ( file_exists($target) );
        }

        if (copy($_FILES["image_branch"]["tmp_name"], iconv('UTF-8', 'windows-874', "../../uploads/branch/" . $newname))) {
            echo "Copy/Upload Complete<br>";

            $id_image = setMD5();
            $id_branch_image = $id_branch;
            $size = $_FILES['image_branch']['size'];
            $strSQL = "INSERT INTO mod_erp_branch_image";
            $strSQL .= "(id_image,name_image,size,date_image,id_branch)";
            $strSQL .= "VALUES ";
            $strSQL .= "('$id_image','$newname','$size','$date_regdate','$id_branch_image')";
            $objQuery = mysqli_query($objConnect, $strSQL);
        } else {
            echo "Copy/upload error<br>";
        }
        if ($objQuery) {
            echo "Add done.[" . $strSQL . "]";
        } else {
            echo "Error Add [" . $strSQL . "]";
        }
    }
    // mysqli_close($objConnect);
}

function doEdit()
{
    require_once '../library/connect.php';
    global $objConnect;
    date_default_timezone_set("Asia/Bangkok");
    $date_regdate = date("Y-m-d H:i:s");
    if ($_FILES['image_branch']['name'] != '') {

        $str_check_image = "SELECT * FROM mod_erp_branch_image WHERE id_branch = '" . $_POST['id'] . "'";
        $query_check_image = mysqli_query($objConnect, $str_check_image);
        $num_check_image = mysqli_num_rows($query_check_image);
        if ($num_check_image > 0) {
            $result_check_image = mysqli_fetch_array($query_check_image);
            $image_em = iconv("utf-8", "tis-620", $result_check_image["name_image"]);
            if (unlink("../../uploads/branch/" . $image_em)) {
                echo "Delete old image complete<br>";

                $namefile = $_FILES["image_branch"]["name"];
                $sur = strrchr($namefile, "."); //ตัดนามสกุลไฟล์เก็บไว้
                $name = "EM-" . (Date("dmy") . rand('1000', '9999') . $sur); //ผมตั้งเป็น วันที่_เวลา.นามสกุล
                $target = "../../uploads/branch/" . $name;
                $newname = $name;

                if (file_exists($target)) {
                    $oldname = pathinfo($name, PATHINFO_FILENAME);
                    $ext = pathinfo($name, PATHINFO_EXTENSION);
                    $newname = $oldname;
                    do {
                        $r = rand(1000, 9999);
                        $newname = $oldname . "-" . $r . ".$ext";
                        $target = "../../uploads/branch/" . $newname;
                    } while ( file_exists($target) );
                }

                if (copy($_FILES["image_branch"]["tmp_name"], iconv('UTF-8', 'windows-874', "../../uploads/branch/" . $newname))) {
                  //  echo "Copy/Upload Complete<br>";

                    $size = $_FILES['image_branch']['size'];
                    $strSQL = "UPDATE mod_erp_branch_image SET";
                    $strSQL .= " name_image = '" . $newname . "' ";
                    $strSQL .= ",size = '" . $size . "' ";
                    $strSQL .= ",date_image = '" . $date_regdate . "' ";
                    $strSQL .= "WHERE id_branch = '" . $_POST['id'] . "'";
                    $objQuery = mysqli_query($objConnect, $strSQL);
                } else {
                 //   echo "Copy/upload error<br>";
                }

                if ($objQuery) {
                 //   echo "Add done.[" . $strSQL . "]";
                } else {
                 //   echo "Error Add [" . $strSQL . "]";
                }
            }
        } else {
            $namefile = $_FILES["image_branch"]["name"];
            $sur = strrchr($namefile, "."); //ตัดนามสกุลไฟล์เก็บไว้
            $name = "EM-" . (Date("dmy") . rand('1000', '9999') . $sur); //ผมตั้งเป็น วันที่_เวลา.นามสกุล
            $target = "../../uploads/branch/" . $name;
            $newname = $name;

            if (file_exists($target)) {
                $oldname = pathinfo($name, PATHINFO_FILENAME);
                $ext = pathinfo($name, PATHINFO_EXTENSION);
                $newname = $oldname;
                do {
                    $r = rand(1000, 9999);
                    $newname = $oldname . "-" . $r . ".$ext";
                    $target = "../../uploads/branch/" . $newname;
                } while ( file_exists($target) );
            }

            if (copy($_FILES["image_branch"]["tmp_name"], iconv('UTF-8', 'windows-874', "../../uploads/branch/" . $newname))) {
              //  echo "Copy/Upload Complete<br>";

                $id_image = setMD5();
                $size = $_FILES['image_branch']['size'];
                $size = $_FILES['image_branch']['size'];
                $strSQL = "INSERT INTO mod_erp_branch_image";
                $strSQL .= "(id_image,name_image,size,date_image,id_branch)";
                $strSQL .= "VALUES ";
                $strSQL .= "('$id_image','$newname','$size','$date_regdate','" . $_POST['id'] . "')";
                $objQuery = mysqli_query($objConnect, $strSQL);
            } else {
              //  echo "Copy/upload error<br>";
            }
            if ($objQuery) {
             //   echo "Add done.[" . $strSQL . "]";
            } else {
               // echo "Error Add [" . $strSQL . "]";
            }
        }
    }

    $location = null;
    $str_member_u = "UPDATE mod_erp_branch SET";
    $str_member_u .= " code_branch = '" . $_POST['code_branch'] . "' ";
    $str_member_u .= ", no_branch = '" . $_POST['no_branch'] . "' ";
    $str_member_u .= ",name_branch = '" . $_POST['name_branch'] . "' ";
    $str_member_u .= ",province = '" . $_POST['province'] . "' ";
    $str_member_u .= ",amphoe= '" . $_POST['amphoe'] . "' ";
    $str_member_u .= ",district = '" . $_POST['district'] . "' ";
    $str_member_u .= ",zipcode = '" . $_POST['zipcode'] . "'";
    $str_member_u .= ",address = '" . $_POST['address'] . "'";
    $str_member_u .= ",location = '" . $location . "'";
    $str_member_u .= ",phone = '" . $_POST['phone'] . "'";
    $str_member_u .= ",email = '" . $_POST['email'] . "'";
    $str_member_u .= ",tax = '" . $_POST['taxid'] . "'";
    $str_member_u .= ",type = '" . $_POST['type'] . "'";
    $str_member_u .= "WHERE id_branch = '" . $_POST['id'] . "'";
    $query_member_u = mysqli_query($objConnect, $str_member_u);
    if ($query_member_u) {
     //   echo 'complete' . $str_member_u;
    } else {
       // echo 'error' . $str_member_u;
    }

}

function doDel()
{
    require_once '../library/connect.php';
     global $objConnect;

    $strSQL = "SELECT * FROM mod_erp_branch_image WHERE id_branch= '" . $_POST["id_del_branch"] . "'";
    $objQuery = mysqli_query($objConnect, $strSQL);
    $objResult = mysqli_fetch_array($objQuery);
    $numrow = mysqli_num_rows($objQuery);
    if ($numrow > 0) {
        $file = iconv("utf-8", "tis-620", $objResult["name_image"]);
        if (unlink("../../uploads/branch/" . $file)) {
        //    echo "Delete image complete";
        }
    }

    $strSQL = "DELETE FROM mod_erp_branch WHERE id_branch = '" . $_POST["id_del_branch"] . "' ";
    $objQuery = mysqli_query($objConnect, $strSQL);
    if ($objQuery) {
      //  echo "Delete branch complete [" . $strSQL . "]";
    } else {
      //  echo "error [" . $strSQL . "]";
    }
}

function doDelmul()
{
    require_once '../library/connect.php';
     global $objConnect;
    for ($i = 0; $i < count($_POST["Chk"]); $i++) {
        $strSQL = "SELECT * FROM mod_erp_branch_image WHERE id_branch = '" . $_POST["Chk"][$i] . "'";
        $objQuery = mysqli_query($objConnect, $strSQL);
        $objResult = mysqli_fetch_array($objQuery);
        $numrow = mysqli_num_rows($objQuery);
        if ($numrow > 0) {
            $file = iconv("utf-8", "tis-620", $objResult["name_image"]);
            if (unlink("../../uploads/branch/" . $file)) {
              //  echo "Delete image complete";
            }
        }

        $strSQL = "DELETE FROM mod_erp_branch WHERE id_branch = '" . $_POST["Chk"][$i] . "' ";
        $objQuery = mysqli_query($objConnect, $strSQL);
        if ($objQuery) {
           // echo "Delete branch complete";
        } else {
           // echo "error [" . $strSQL . "]";
        }
    }
  //  echo "Record Deleted.";
}



// for ($i = 0 ; $i < 10; $i++){
//    var_dump(str_crypt(md5(uniqid()) , incrementalHash()));
// }

// function str_crypt($str, $addchar , $prefix = 'h', $postfix = 'e'){
//     $size = str_word_count($str);

//     $rand = rand(1,$size);

//     $str = substr_replace($str , $addchar , $rand , 0);

//     return "{$prefix}{$str}{$postfix}";
// }

// function incrementalHash($len = 1){
//     $charset = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
//     $base = str_word_count($charset);
//     $result = $charset[rand(0,$base)];
//     return $result;
// }
?>