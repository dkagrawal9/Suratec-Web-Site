<?php
/**
 * Created by PhpStorm.
 * User: DEV-001
 * Date: 23/8/2561
 * Time: 15:20
 */

require_once ('vendor/autoload.php');

$create = new \Card\Create(null,null,null,546659887,null);



switch ($_GET['gen']){
    case 'qr':
        $create->QRGen();
        break;
    case 'barcode':
        $create->BarCodeGen();
        break;
}
