<?php
/**
 * Created by PhpStorm.
 * User: DEV-001
 * Date: 9/10/2561
 * Time: 14:45
 */

include ('vendor/autoload.php');
use App\StockBranch\Stock;

if(detectRequestBody() != ''){
    header("Content-type:application/json");

    $branch = new Stock();
    echo $branch->Add(json_decode(detectRequestBody(),false));

}

function detectRequestBody() {
    $entityBody = file_get_contents('php://input');
    return $entityBody;
}