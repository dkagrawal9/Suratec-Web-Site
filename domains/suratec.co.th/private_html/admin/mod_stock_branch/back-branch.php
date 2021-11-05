<?php
/**
 * Created by PhpStorm.
 * User: DEV-001
 * Date: 9/10/2561
 * Time: 12:50
 */
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
include ('vendor/autoload.php');
use App\StockBranch\Branch;

header("Content-type:application/json");
$branch = new Branch();
echo $branch->getList();
