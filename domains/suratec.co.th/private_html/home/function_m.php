<?php
session_start();
// require_once '../admin/library/functions.php';
function setMD5()
{

    $passuniq = uniqid();
    $passmd5 = md5($passuniq);

    $sumlenght = strlen($passmd5); #num passmd5
    $letter_pre = chr(rand(97, 122)); #set char for prefix
    $letter_post = chr(rand(97, 122)); #set char for postfix
    $letter_mid = chr(rand(97, 122)); #set char for middle string
    $num_rand = rand(0, $sumlenght); #random for cut passmd5
    $cut_pre = substr($passmd5, 0, $num_rand); #cutmd5 start 0 stop $numrand
    $setmid = $cut_pre . $letter_mid; #set pre string + char middle
    $cut_post = substr($passmd5, $num_rand, $sumlenght + 1);

    $set_modify_md5 = $letter_pre . $setmid . $cut_post . $letter_post;
    return $set_modify_md5;
}

if (isset($_POST['_method']))
{

    //register.php
    if ($_POST['_method'] == 'SELECT_TEX')
    {
        SELECT_TEX();
        exit;
    }
    elseif ($_POST['_method'] == 'ADD_SHOPPING')
    {
        ADD_SHOPPING();
        exit;
    }
    elseif ($_POST['_method'] == 'SELECT_SOLE')
    {
        SELECT_SOLE();
        exit;
    }
    elseif ($_POST['_method'] == 'SELECT_SOLE_Daily')
    {
        SELECT_SOLE_Daily();
        exit;
    }
    elseif ($_POST['_method'] == 'ADD_CUTTOMER')
    {
        ADD_CUTTOMER();
        exit;
    }
    elseif ($_POST['_method'] == 'CHECK_USER')
    {
        CHECK_USER();
        exit;
    }
    elseif ($_POST['_method'] == 'CHECK_EMAIL')
    {
        CHECK_EMAIL();
        exit;
    }
    elseif ($_POST['_method'] == 'facebook_login')
    {
        facebook_login();
    }
    elseif ($_POST['_method'] == 'google_login')
    {
        google_login();
    }
    elseif ($_POST['_method'] == 'json_all')
    {
        json_all();
    }
    elseif ($_POST['_method'] == 'ADD_EDIT_CUTTOMER')
    {
        ADD_EDIT_CUTTOMER();
    }
    elseif ($_POST['_method'] == 'CHACK_NEW_PASS')
    {
        CHACK_NEW_PASS();
    }
    elseif ($_POST['_method'] == 'CREATE_COMMENTNEWS')
    {
        CREATE_COMMENTNEWS();
    }
    elseif ($_POST['_method'] == 'CREATE_COMMENTARTICLE')
    {
        CREATE_COMMENTARTICLE();
        exit;
    }
}

if (isset($_POST['ac']))
{
    if ($_GET['ac'] == 'true')
    {
        SELECT_CENTER();
    }
}

function SELECT_SOLE()
{
    require_once '../admin/library/connect.php';
    header('Content-Type: application/json');
    date_default_timezone_set("Asia/Bangkok");

    $sql = 'SELECT `id`,`action`,`left_sensor1`,`left_sensor2`,`left_sensor3`,`left_sensor4`,`left_sensor5`,`right_sensor1`,`right_sensor2`,`right_sensor3`,`right_sensor4`,`right_sensor5`,`id_customer` FROM `surasole` WHERE `id_customer` = "' . $_POST['id'] . '" ORDER BY `action` DESC';

    $query = mysqli_query($objConnect, $sql);
    $result = mysqli_fetch_array($query);
    $num = mysqli_num_rows($query);

    if ($num > 0)
    {
        echo json_encode(array(
            'status' => '1',
            'message' => $result
        ));
    }
    else
    {
        echo json_encode(array(
            'status' => '0',
            'message' => $sql
        ));
    }
}

function facebook_login()
{
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
    if (isset($row))
    {
        if ($query)
        {
            echo json_encode(array(
                'code' => 200,
                'message' => $sql
            ));
        }
        else
        {
            echo json_encode(array(
                'code' => 404,
                'message' => $sql
            ));
        }
    }
    else
    {

        $sql = "INSERT INTO mod_customer  (id_customer, fname, lname, birthday,img_path,email,id_facebook,img_path,fname) 
    VALUES ('" . $id_cust . "','" . $first_name . "','" . $last_name . "','" . $birthday . "','" . $pic . "','" . $fbEmail . "','" . $fbID . "','nopic.png','" . $fbEmail . "')";
        print $sql;
        $query = mysqli_query($objConnect, $sql);

        if ($query)
        {
            echo json_encode(array(
                'code' => 200,
                'message' => $sql
            ));
        }
        else
        {
            echo json_encode(array(
                'code' => 404,
                'message' => $sql
            ));
        }

    }

}

function google_login()
{
    require_once '../admin/library/connect.php';
    header('Content-Type: application/json');
    date_default_timezone_set("Asia/Bangkok");

    $ggEmail = $_POST['ggEmail'];
    $ggID = $_POST['Id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $birthday = $_POST['birthday'];
    $pic = $_POST['pic'];
    // session_start();
    //$id_employee = $_SESSION['id_employee'];
    $id_cust = setMD5();

    $sql_type = "SELECT id_google FROM mod_customer 
WHERE id_google = '$ggID'";
    $query = mysqli_query($objConnect, $sql_type);
    $row = mysqli_fetch_array($query);

    // $premium_id = $row['sku'];
    if (isset($row))
    {
        if ($query)
        {
            echo json_encode(array(
                'code' => 200,
                'message' => $ggID
            ));
        }
        else
        {
            echo json_encode(array(
                'code' => 404,
                'message' => $sql_type
            ));
        }
    }
    else
    {

        $sql = "INSERT INTO mod_customer  (id_customer, fname, lname, birthday,img_path,email,id_google,img_path,fname) 
    VALUES ('" . $id_cust . "','" . $first_name . "','" . $last_name . "','" . $birthday . "','" . $pic . "','" . $ggEmail . "','" . $ggID . "','nopic.png','" . $ggEmail . "')";
        print $sql;
        $query = mysqli_query($objConnect, $sql);

        if ($query)
        {
            echo json_encode(array(
                'code' => 200,
                'message' => $ggID
            ));
        }
        else
        {
            echo json_encode(array(
                'code' => 404,
                'message' => $sql
            ));
        }

    }

}

function ADD_SHOPPING()
{

    require_once '../admin/library/connect.php';
    // require_once '../admin/library/functions.php';
    header('Content-Type: application/json');
    date_default_timezone_set("Asia/Bangkok");

    $date = date("Y-m-d H:i:s");

    $id = $_POST['data'];
    $id_customer = $_POST['id'];
    $refno = $_POST['refno'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    $address = $_POST['address'];
    $district = $_POST['district'];
    $amphur = $_POST['amphur'];
    $province = $_POST['province'];
    $postalcode = $_POST['postalcode'];

    $address_to = $_POST['address_to'];
    $district_to = $_POST['district_to'];
    $amphoe_to = $_POST['amphoe_to'];
    $province_to = $_POST['province_to'];
    $zipcode_to = $_POST['zipcode_to'];

    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $total = $_POST['total'];

    $id = explode(',', $id);

    if ($id[0] != '')
    {

        $data = "'" . $id[0] . "'";
        $i = 1;
    }
    else
    {
        $data = "'" . $id[1] . "'";
        $i = 2;
    }

    for ($j = $i;count($id) > $j;$j++)
    {
        $data .= "," . "'" . $id[$j] . "'";
    }

    //	                  $data = "'".$id[0]."'";
    //
    //                      for($i=1; count($id) > $i;$i++){
    //                        $data .=  ","."'".$id[$i]."'";
    //                      }
    $sql = 'SELECT * FROM mod_customer_address WHERE id_customer = "' . $id_customer . '" and status = "1" ';
    $query = mysqli_query($objConnect, $sql);
    $num = mysqli_num_rows($query);
    if ($num > 0)
    {

        $str = "UPDATE mod_customer_address SET ";
        $str .= " fname = '" . $fname . "'";
        $str .= " ,lname = '" . $lname . "'";
        $str .= " ,address = '" . $address . "'";
        $str .= " ,district = '" . $district . "'";
        $str .= " ,amphur = '" . $amphur . "'";
        $str .= " ,province = '" . $province . "'";
        $str .= " ,postalcode = '" . $postalcode . "'";
        $str .= " ,telephone = '" . $telephone . "'";
        $str .= " ,update_datetime = '" . $date . "'";
        $str .= "  WHERE id_customer = '" . $id_customer . "'";
        $query = mysqli_query($objConnect, $str);

        $str1 = "UPDATE mod_customer SET ";
        $str1 .= " fname = '" . $fname . "'";
        $str1 .= " ,lname = '" . $lname . "'";
        $str1 .= " ,telephone = '" . $telephone . "'";
        $str1 .= " ,email = '" . $email . "'";
        $str1 .= " ,update_datetime = '" . $date . "'";
        $str1 .= "  WHERE id_customer = '" . $id_customer . "'";
        $query1 = mysqli_query($objConnect, $str1);

    }
    else
    {
        $str = "INSERT INTO mod_customer_address (`fname`, `lname`, `address`, `district`, `amphur`, `province`, `postalcode`, `telephone`, `create_datetime`, `id_customer`,`id_address`)
      VALUES('$fname','$lname','$address','$district','$amphur','$province','$postalcode','$telephone','$date','$id_customer','')";
        $query = mysqli_query($objConnect, $str);

        $str1 = "UPDATE mod_customer SET ";
        $str1 .= " fname = '" . $fname . "'";
        $str1 .= " ,lname = '" . $lname . "'";
        $str1 .= " ,telephone = '" . $telephone . "'";
        $str1 .= " ,email = '" . $email . "'";
        $str1 .= " ,update_datetime = '" . $date . "'";
        $str1 .= "  WHERE id_customer = '" . $id_customer . "'";
        $query1 = mysqli_query($objConnect, $str1);
    }

    $sql = 'SELECT * FROM mod_customer_address WHERE id_customer = "' . $id_customer . '" and status = "2" ';
    $query = mysqli_query($objConnect, $sql);
    $num = mysqli_num_rows($query);
    if ($num > 0)
    {

        $str = "UPDATE mod_customer_address SET ";
        $str .= " fname = '" . $fname . "'";
        $str .= " ,lname = '" . $lname . "'";
        $str .= " ,address = '" . $address_to . "'";
        $str .= " ,district = '" . $district_to . "'";
        $str .= " ,amphur = '" . $amphoe_to . "'";
        $str .= " ,province = '" . $province_to . "'";
        $str .= " ,postalcode = '" . $zipcode_to . "'";
        $str .= " ,telephone = '" . $telephone . "'";
        $str .= " ,update_datetime = '" . $date . "'";
        $str .= "  WHERE id_customer = '" . $id_customer . "'";
        $query = mysqli_query($objConnect, $str);

        $str1 = "UPDATE mod_customer SET ";
        $str1 .= " fname = '" . $fname . "'";
        $str1 .= " ,lname = '" . $lname . "'";
        $str1 .= " ,telephone = '" . $telephone . "'";
        $str1 .= " ,email = '" . $email . "'";
        $str1 .= " ,update_datetime = '" . $date . "'";
        $str1 .= "  WHERE id_customer = '" . $id_customer . "'";
        $query1 = mysqli_query($objConnect, $str1);

    }
    else
    {
        $str = "INSERT INTO mod_customer_address (`fname`, `lname`, `address`, `district`, `amphur`, `province`, `postalcode`, `telephone`, `create_datetime`, `id_customer`,`id_address`)
      VALUES('$fname','$lname','$address_to','$district_to','$amphoe_to','$province_to','$zipcode_to','$telephone','$date','$id_customer','')";
        $query = mysqli_query($objConnect, $str);

        $str1 = "UPDATE mod_customer SET ";
        $str1 .= " fname = '" . $fname . "'";
        $str1 .= " ,lname = '" . $lname . "'";
        $str1 .= " ,telephone = '" . $telephone . "'";
        $str1 .= " ,email = '" . $email . "'";
        $str1 .= " ,update_datetime = '" . $date . "'";
        $str1 .= "  WHERE id_customer = '" . $id_customer . "'";
        $query1 = mysqli_query($objConnect, $str1);
    }

    $sql_se_c = 'SELECT * FROM mod_customer_address WHERE id_customer = "' . $id_customer . '" and status = "2" ';
    $query_se_c = mysqli_query($objConnect, $sql_se_c);
    $result_se_c = mysqli_fetch_array($query_se_c);

    $str_order = "INSERT INTO mod_order (`id_order`,`order_datetime`,`id_customer`,`id_address`,`text_address`,`id_shipping`,`payment`,`status`,`priceall`,`doc_no`)
      VALUES('BL$refno','$date','$id_customer','" . $result_se_c['id_address'] . "','$address $district_to $amphoe_to $province_to $zipcode_to $telephone','1','2','complete spending','$total','$refno')";
    $query_order = mysqli_multi_query($objConnect, $str_order);

    $_SESSION['refid'] = 'BL' . $refno;

    $sql_io = "INSERT INTO mod_order_item (`id_order`, `id_product`, `qty`, `price`, `subtotal`) ";

    $sqlselect = "SELECT   product.id_product 
    FROM product   where product.id_product in($data)";
    $query = mysqli_query($objConnect, $sqlselect);
    $i = 0;
    while ($objResult = mysqli_fetch_array($query, MYSQLI_ASSOC))
    {

        $qtydata = $_POST["qty"][$i];

        if ($i == 0)
        {

            $sql_io .= "SELECT * FROM  (   SELECT 'BL$refno' AS id_order , product.id_product ,  " . $qtydata . " as qty,  product.tmp_price,   (" . $qtydata . "* product.tmp_price) AS subtotal
          FROM product 
          where product.id_product in('$id[$i]')";

        }
        else
        {

            $sql_io .= "UNION ALL SELECT 'BL$refno' AS id_order , product.id_product ,  " . $qtydata . " as qty,  product.tmp_price,   (" . $qtydata . "* product.tmp_price) AS subtotal
          FROM product 
          where product.id_product in('$id[$i]')";

        }

        $i++;

    }
    $sql_io .= ") AS k";

    $query_io = mysqli_multi_query($objConnect, $sql_io);

    //	echo $sql_io;
    if ($query_order)
    {
        echo json_encode(array(
            'status' => '1',
            'message' => $sql_io
        ));
    }
    else
    {
        echo json_encode(array(
            'status' => '0',
            'message' => "ERROR: "
        ));
    }

}

function ADD_CUTTOMER()
{
    require_once '../admin/library/connect.php';
    // require_once '../admin/library/functions.php';
    header('Content-Type: application/json');
    date_default_timezone_set("Asia/Bangkok");

    $id_customer = setMD5();
    $id_member = setMD5();
    $currantDate = date('Y-m-d H:i:s');
    $dob = date('0000-00-00');

    $user = $_POST['user'];
    $email = $_POST['email'];
    $types = $_POST['types'];
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $conPass = $_POST['conPass'];

    $date = date("Y-m-d H:i:s");

    $str = "INSERT INTO mod_customer (id_customer,email,create_datetime,type,img_path,fname,lname,telephone,code,birthday,sex,update_datetime,discount )

        VALUES ('$id_customer','$email','$date','$types','nopic.png','$user','','','','$dob','0','$currantDate','0')";

    $query = mysqli_query($objConnect, $str);

    $str_a = "INSERT INTO mod_customer_address (address,district,amphur,province,postalcode,`status`,create_datetime,update_datetime,id_customer)

        VALUES ('','','','','','1','$date','$date','$id_customer')";

    $query_a = mysqli_query($objConnect, $str_a);

    $str_a2 = "INSERT INTO mod_customer_address (address,district,amphur,province,postalcode,`status`,create_datetime,update_datetime,id_customer)

        VALUES ('','','','','','2','$date','$date','$id_customer')";

    $query_a2 = mysqli_query($objConnect, $str_a2);
    $str_a3 = "INSERT INTO surasole (id,action,id_customer)
        VALUES ('',date('Y-m-d H:i:s'),'$id_customer')";

    $query_a3 = mysqli_query($objConnect, $str_a3);
    //  var_dump($objConnect->error);
    

    if ($query)
    {

        $strSQL3 = "INSERT INTO tbl_member (id_member, user_member, pass_member, member_regdate,id_data_role,data_role,permission,member_session_update,member_last_login) VALUES ('$id_member','$user','$pass','$date','$id_customer','mod_customer','','$id_member','$currantDate')";
        $objQuery3 = mysqli_query($objConnect, $strSQL3);

        echo json_encode(array(
            'status' => '1',
            'message' => "SUCCESS NEW RECORD. "
        ));
    }
    else
    {
        echo json_encode(array(
            'status' => '0',
            'message' => "ERROR: " . $str
        ));
    }

}

function CHECK_USER()
{
    require_once '../admin/library/connect.php';
    // require_once '../admin/library/functions.php';
    header('Content-Type: application/json');

    $sql = 'SELECT * FROM tbl_member WHERE user_member = "' . $_POST['user'] . '" ';
    $query = mysqli_query($objConnect, $sql);
    $num = mysqli_num_rows($query);
    if ($num > 0)
    {
        echo json_encode(array(
            'status' => '1',
            'message' => $sql
        ));
    }
    else
    {
        echo json_encode(array(
            'status' => '0',
            'message' => $sql
        ));
    }
}

function CHECK_EMAIL()
{
    require_once '../admin/library/connect.php';
    // require_once '../admin/library/functions.php';
    header('Content-Type: application/json');

    $sql = 'SELECT * FROM mod_customer WHERE email = "' . $_POST['email'] . '" ';
    $query = mysqli_query($objConnect, $sql);
    $num = mysqli_num_rows($query);
    if ($num > 0)
    {
        echo json_encode(array(
            'status' => '1',
            'message' => $sql
        ));
    }
    else
    {
        echo json_encode(array(
            'status' => '0',
            'message' => $sql
        ));
    }
}

function ADD_EDIT_CUTTOMER()
{
    require_once '../admin/library/connect.php';
    header('Content-Type: application/json');
    date_default_timezone_set("Asia/Bangkok");

    $id_customer = $_POST['id'];;
    $email = $_POST['email'];
    $user = $_POST['edit_user'];
    $pass = $_POST['newpass'];
    $pass_og = $_POST['pass_og'];

    /*add*/
    $address = $_POST['address'];
    $district = $_POST['district'];
    $amphoe = $_POST['amphoe'];
    $province = $_POST['province'];
    $zipcode = $_POST['zipcode'];

    /*add_to*/
    $address_to = $_POST['address_to'];
    $district_to = $_POST['district_to'];
    $amphoe_to = $_POST['amphoe_to'];
    $province_to = $_POST['province_to'];
    $zipcode_to = $_POST['zipcode_to'];

    if ($pass == "")
    {
        $pass = $pass_og;
    }
    else
    {
        $pass = password_hash($_POST['newpass'], PASSWORD_DEFAULT);
    }

    $conpass = $_POST['conpass'];

    $sql = "SELECT * FROM mod_customer WHERE id_customer = '" . $id_customer . "'";
    $query = mysqli_query($objConnect, $sql);
    $result = mysqli_fetch_array($query);

    if ($_FILES['image']['name'] != '')
    {
        // $path = '../uploads/customer';
        $path = '/home/srt/domains/api1.suratec.co.th/private_html/pic';
        if (!is_dir($path))
        {
            mkdir($path, 0777);
        }

        $namefile = $_FILES["image"]["name"];
        $sur = strrchr($namefile, "."); //ตัดนามสกุลไฟล์เก็บไว้
        $name = "CS-" . (Date("dmy") . rand('1000', '9999') . $sur); //ผมตั้งเป็น วันที่_เวลา.นามสกุล
        // $target = "../uploads/customer/".$name;
        $target = "/home/srt/domains/api1.suratec.co.th/private_html/pic/" . $name;
        $newname = $name;

        if (file_exists($target))
        {
            $oldname = pathinfo($name, PATHINFO_FILENAME);
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            $newname = $oldname;
            do
            {
                $r = rand(1000, 9999);
                $newname = $oldname . "-" . $r . ".$ext";
                // $target = "../uploads/customer/".$newname;
                $target = "/home/srt/domains/api1.suratec.co.th/private_html/pic/" . $newname;
            }
            while (file_exists($target));
        }

        // if(copy($_FILES["image"]["tmp_name"],iconv('UTF-8','windows-874',"../uploads/customer/".$newname))){
        if (copy($_FILES["image"]["tmp_name"], iconv('UTF-8', 'windows-874', "/home/srt/domains/api1.suratec.co.th/private_html/pic/" . $newname)))
        {
            // echo "Copy/Upload Complete<br>";
            
        }
        else
        {
            // echo "Copy/upload error<br>";
            
        }

        if ($result['img_path'] != '')
        {
            // unlink('../uploads/customer/'.$result['img_path']);
            unlink('/home/srt/domains/api1.suratec.co.th/private_html/pic' . $result['img_path']);
            $image_path = $newname;
        }
        else
        {
            $image_path = $newname;
        }
    }
    else
    {
        $image_path = $result['img_path'];
    }

    $str = "UPDATE mod_customer SET ";
    $str .= "  fname = '" . $_POST['fname'] . "'";
    $str .= " ,lname = '" . $_POST['lname'] . "'";
    // $str .= " ,code = '".$_POST['code']."'";
    // $str .= " ,birthday = '".$_POST['birthday']."'";
    // $str .= " ,sex = '".$_POST['sex']."'";
    $str .= " ,update_datetime = '" . $date . "'";
    $str .= " ,email = '" . $_POST['email'] . "'";
    $str .= " ,type = '" . $_POST['types'] . "'";
    // $str .= " ,nickname = '".$_POST['nickname']."'";
    $str .= " ,telephone = '" . $_POST['tel'] . "'";
    // $str .= " ,address = '".$_POST['address']."'";
    //$str .= " ,postcode = '".$_POST['postcode']."'";
    //$str .= " ,state = '".$_POST['state']."'";
    // $str .= " ,suburb = '".$_POST['suburb']."'";
    $str .= " ,img_path = '" . $image_path . "'";
    $str .= "  WHERE id_customer = '" . $id_customer . "'";
    $query = mysqli_query($objConnect, $str);

    $str = "UPDATE mod_customer_address SET ";
    $str .= "  fname = '" . $_POST['fname'] . "'";
    $str .= " ,lname = '" . $_POST['lname'] . "'";
    $str .= " ,address = '" . $_POST['address'] . "'";
    $str .= " ,district = '" . $_POST['district'] . "'";
    $str .= " ,amphur = '" . $_POST['amphoe'] . "'";
    $str .= " ,province = '" . $_POST['province'] . "'";
    $str .= " ,postalcode = '" . $_POST['zipcode'] . "'";
    $str .= " ,telephone = '" . $_POST['tel'] . "'";
    $str .= " ,update_datetime = '" . $date . "'";
    $str .= "  WHERE id_customer = '" . $id_customer . "' and status = '1' ";
    $query = mysqli_query($objConnect, $str);

    $str = "UPDATE mod_customer_address SET ";
    $str .= "  fname = '" . $_POST['fname'] . "'";
    $str .= " ,lname = '" . $_POST['lname'] . "'";
    $str .= " ,address = '" . $_POST['address_to'] . "'";
    $str .= " ,district = '" . $_POST['district_to'] . "'";
    $str .= " ,amphur = '" . $_POST['amphoe_to'] . "'";
    $str .= " ,province = '" . $_POST['province_to'] . "'";
    $str .= " ,postalcode = '" . $_POST['zipcode_to'] . "'";
    $str .= " ,telephone = '" . $_POST['tel'] . "'";
    $str .= " ,update_datetime = '" . $date . "'";
    $str .= "  WHERE id_customer = '" . $id_customer . "' and status = '2' ";
    $query = mysqli_query($objConnect, $str);

    // echo $str;
    if ($query)
    {

        $strSQL3 = "UPDATE tbl_member SET
        user_member = '$user'
        ,pass_member = '$pass'
        ,member_regdate = '$date'
        WHERE id_data_role = '$id_customer'";
        $objQuery3 = mysqli_query($objConnect, $strSQL3);

        echo json_encode(array(
            'status' => '1',
            'message' => $str
        ));
    }
    else
    {
        echo json_encode(array(
            'status' => '0',
            'message' => $str
        ));
    }

}

function CHACK_NEW_PASS()
{

    require_once '../admin/library/connect.php';
    header('Content-Type: application/json');
    date_default_timezone_set("Asia/Bangkok");

    if (isset($_POST["username"]) && isset($_POST["password"]))
    {
        $username = $_POST["username"];
        $password = $_POST["password"];
        // require 'config.php';
        $str = "SELECT * FROM tbl_member
		LEFT JOIN mod_customer
		ON tbl_member.id_data_role = mod_customer.id_customer
		WHERE mod_customer.email = '$username'";
        $query = mysqli_query($objConnect, $str);
        $result = mysqli_fetch_array($query);
        $row = mysqli_num_rows($query);
        if (!$result)
        {
            echo json_encode(array(
                'status' => '0',
                'message' => 'Error login data!' + $str
            ));
        }
        else
        {

            if ($result['data_role'] == 'mod_customer')
            { // ไปหน้าบ้าน
                $hash = $result['pass_member'];
                if (password_verify($password, $hash))
                {
                    $str_customer = 'SELECT * FROM mod_customer WHERE id_customer = "' . $result['id_data_role'] . '"';
                    $query_customer = mysqli_query($objConnect, $str_customer);
                    // $_SESSION["user_id"] = session_id();
                    // $_SESSION["user_member"] = $result['id_member'];
                    // $_SESSION["id_customer"] = $result['id_data_role'];
                    // $_SESSION['permission'] = 'customer';
                    // $_SESSION["task_view"] = '';
                    // $_SESSION["task_authen"] = '';
                    

                    echo json_encode(array(
                        'status' => '1',
                        'message' => $_SESSION['permission']
                    ));
                }
                else
                {
                    echo json_encode(array(
                        'status' => '0',
                        'message' => $password
                    ));
                }
            }
        }
        mysqli_close($objConnect);

    }

}

function CREATE_COMMENTNEWS()
{
    require_once '../admin/library/connect.php';
    header('Content-Type: application/json');
    date_default_timezone_set("Asia/Bangkok");

    $id_article = $_POST['id'];
    $date = date("Y-m-d H:i:s");

    $sql2 = "INSERT INTO article_opinion (id,id_article,message,ip,img_path,date_action) 
    VALUES('','$id_article','" . $_POST['messagenews'] . "','" . $_POST['cip'] . "','','" . $date . "')";
    $query2 = mysqli_query($objConnect, $sql2);

    if ($query2)
    {

        echo json_encode(array(
            'status' => '1',
            'message' => $sql2
        ));
    }
    else
    {
        echo json_encode(array(
            'status' => '0',
            'message' => $sql2
        ));
    }

}

function CREATE_COMMENTARTICLE()
{
    require_once '../admin/library/connect.php';
    header('Content-Type: application/json');
    date_default_timezone_set("Asia/Bangkok");

    $id_article = $_POST['id'];
    $date = date("Y-m-d H:i:s");

    $sql2 = "INSERT INTO article_opinion (id,id_article,message,ip,img_path,date_action) 
    VALUES('','$id_article','" . $_POST['message'] . "','" . $_POST['cip'] . "','','" . $date . "')";
    $query2 = mysqli_query($objConnect, $sql2);

    if ($query2)
    {

        echo json_encode(array(
            'status' => '1',
            'message' => $sql2
        ));
    }
    else
    {
        echo json_encode(array(
            'status' => '0',
            'message' => $sql2
        ));
    }

}

function json_all()
{

    require_once '../admin/library/connect.php';
    // require_once '../admin/library/functions.php';
    header('Content-Type: application/json');
    date_default_timezone_set("Asia/Bangkok");

    $datee = $_POST['datee'];
    $id_customer = $_POST['id_customer'];

    $sql = 'SELECT `id`,`action`,`duration`,`left_sensor1`,`left_sensor2`,`left_sensor3`,`left_sensor4`,`left_sensor5`,`right_sensor1`,`right_sensor2`,`right_sensor3`,`right_sensor4`,`right_sensor5`,`id_customer` FROM `surasole` WHERE `id_customer` = "' . $id_customer . '" AND DATE(`action`) = "' . $datee . '" ORDER BY `id` ASC';

    $query = mysqli_query($objConnect, $sql);
    $num = mysqli_num_rows($query);

    $count = 0;
    $action = 0;
    $duration = 0;
    $left_sensor = [];
    $right_sensor = [];
    $retData = [];
    $i = 0;

    $data = $query->fetch_all(MYSQLI_ASSOC);
    //var_dump($data);
    for ($i = 0;$i < count($data);$i++)
    {
        if ($i != 0)
        {
            if ($data[$i]['duration'] - $data[$i - 1]['duration'] >= 0)
            {
                $lsensor = [$data[$i]['left_sensor1'], $data[$i]['left_sensor2'], $data[$i]['left_sensor3'], $data[$i]['left_sensor4'], $data[$i]['left_sensor5']];
                $rsensor = [$data[$i]['right_sensor1'], $data[$i]['right_sensor2'], $data[$i]['right_sensor3'], $data[$i]['right_sensor4'], $data[$i]['right_sensor5']];
                array_push($left_sensor, $lsensor);
                array_push($right_sensor, $rsensor);
            }
            else
            {
                $retData[$count]['action'] = $data[$action]->action;
                $retData[$count]['duration'] = $data[$i - 1]->duration;
                $retData[$count]['left'] = $left_sensor;
                $retData[$count]['right'] = $right_sensor;
                $left_sensor = [];
                $right_sensor = [];
                $action = $i + 1;
                $count++;
            }
        }
        else
        {
            $lsensor = [$data[$i]['left_sensor1'], $data[$i]['left_sensor2'], $data[$i]['left_sensor3'], $data[$i]['left_sensor4'], $data[$i]['left_sensor5']];
            $rsensor = [$data[$i]['right_sensor1'], $data[$i]['right_sensor2'], $data[$i]['right_sensor3'], $data[$i]['right_sensor4'], $data[$i]['right_sensor5']];
            array_push($left_sensor, $lsensor);
            array_push($right_sensor, $rsensor);
        }
    }
    if ($count > 0 || $count == 0)
    {
        $retData[$count]['action'] = $data[$action]['action'];
        $retData[$count]['duration'] = $data[count($data) - 1]['duration'];
        $retData[$count]['left'] = $left_sensor;
        $retData[$count]['right'] = $right_sensor;
    }
    else
    {
        echo json_encode(array(
            'status' => 'ผิดพลาด'
        ));
    }
    /*if ($count > 0 || $count == 0) {
    $retData[$count]['action'] = $result['action'];
    $retData[$count]['duration'] = $result['duration'];
    $retData[$count]['left'] = $left_sensor;
    $retData[$count]['right'] = $right_sensor;
    $duration = $result['duration'];
    
    }*/

    //print_r($left_sensor);
    //print_r($right_sensor);
    //$results = [$duration,$datasum_left,$datasum_right];
    $results = array(
        'duration' => $duration,
        'left_sensor' => $left_sensor,
        'right_sensor' => $right_sensor,
        'number_all' => $num
    );
    echo json_encode($results);
    //					echo json_encode(array('status' => '1'));
       
}

?>
