<?php
/**
 * Created by PhpStorm.
 * User: DEV-001
 * Date: 9/10/2561
 * Time: 14:45
 */

include ('vendor/autoload.php');
use App\StockBranch\Branch;

header("Content-type:application/json");
$product = new \App\StockBranch\Product();
$id_branch = filter_input(INPUT_GET,'id_branch',FILTER_SANITIZE_STRING);
echo $product->getList($id_branch);
