<?php
/**
 * Created by PhpStorm.
 * User: DEV-001
 * Date: 9/10/2561
 * Time: 14:45
 */

include ('vendor/autoload.php');
use App\StockBranch\Product;

header("Content-type:application/json");
if(isset($_GET['id_branch'])){
    $id_branch = filter_input(INPUT_GET,'id_branch',FILTER_SANITIZE_STRING);
    $cat_id = filter_input(INPUT_GET,'cat_id',FILTER_VALIDATE_INT);

    $product = new Product();
    if($cat_id == false){
        echo $product->getListAll($id_branch);
    }else{
        echo $product->getListAll($id_branch,$cat_id);
    }

}

