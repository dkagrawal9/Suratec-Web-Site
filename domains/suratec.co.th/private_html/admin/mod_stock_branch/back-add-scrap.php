<?php
/**
 * Created by PhpStorm.
 * User: DEV-001
 * Date: 10/10/2561
 * Time: 13:22
 */

include ('vendor/autoload.php');
use App\StockBranch\Scrap;

if(detectRequestBody() != ''){
    header("Content-type:application/json");

    $branch = new Scrap();
    echo $branch->Add(json_decode(detectRequestBody(),false));

}

function detectRequestBody() {
    $entityBody = file_get_contents('php://input');
    return $entityBody;
}