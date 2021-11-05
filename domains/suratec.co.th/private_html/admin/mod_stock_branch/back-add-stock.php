<?php
/**
 * Created by PhpStorm.
 * User: pasupat
 * Date: 2019-02-05
 * Time: 19:55
 */

include 'vendor/autoload.php';

$stock = new \App\StockBranch\Stock();
echo $stock->AddToStock(json_decode(detectRequestBody()));

function detectRequestBody() {
    return file_get_contents('php://input');
}