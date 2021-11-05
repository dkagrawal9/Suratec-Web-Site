<?php
/**
 * Created by PhpStorm.
 * User: DEV-001
 * Date: 9/10/2561
 * Time: 14:45
 */

include ('vendor/autoload.php');


header("Content-type:application/json");
$product = new \App\StockBranch\Product();
echo $product->getCategoryList();
