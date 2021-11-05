<?php
require ('../vendor/autoload.php');

function detectRequestBody() {
    $entityBody = file_get_contents('php://input');
    return $entityBody;
}
header("Content-type: application/json; charset=utf-8");
if(isset($_GET['do'])){
    $do = filter_input(INPUT_GET,'do',FILTER_VALIDATE_INT);
    $group = new \App\Customer\Groups();
    $data = json_decode(detectRequestBody());

    switch ($do){
        case 1:

            echo $group->add($data);
            break;
        case 2:
            echo $group->getList();
            break;
    }


}