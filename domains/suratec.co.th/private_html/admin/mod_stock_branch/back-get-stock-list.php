<?php
/**
 * Created by PhpStorm.
 * User: DEV-001
 * Date: 9/10/2561
 * Time: 15:14
 */

include ('vendor/autoload.php');
use App\StockBranch\Stock;

if(isset($_GET['id_branch'])){
    $id = filter_input(INPUT_GET , 'id_branch' ,FILTER_SANITIZE_STRING);


    header("Content-type:application/json");
    $Stock = new Stock();
    echo $Stock->getItemStock($id);
}