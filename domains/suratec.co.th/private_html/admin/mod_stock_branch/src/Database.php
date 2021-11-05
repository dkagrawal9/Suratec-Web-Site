<?php
/**
 * Created by PhpStorm.
 * User: DEV-001
 * Date: 17/9/2561
 * Time: 16:46
 */

namespace App\StockBranch;

class Database
{

    public $host = 'localhost';
    public $db = 'flowerUSA';
    public $user = 'root';
    public $pass = '';
    public $charset = 'utf8';

    /**
     * @var \mysqli
     */
    public $con;

    /**
     * @return \mysqli
     */
    public static function getConnect(){

        $config = include (__DIR__ . '/../../library/db.php');

        $seft = new self();
        $seft->host = $config['host'];
        $seft->db = $config['dbname'];
        $seft->user = $config['user'];
        $seft->pass = $config['password'];

        $seft->con = mysqli_connect($seft->host,$seft->user,$seft->pass,$seft->db);
        $seft->con ->set_charset($seft->charset);



        return $seft->con;
    }

    public static function Create_uniqid(){

        $passuniq = uniqid();
        $passmd5 = md5($passuniq);

        $sumlenght = strlen($passmd5);#num passmd5

        $letter_pre = chr(rand(97,122));#set char for prefix

        $letter_post = chr(rand(97,122));#set char for postfix

        $letter_mid = chr(rand(97,122));#set char for middle string

        $num_rand = rand(0,$sumlenght);#random for cut passmd5

        $cut_pre = substr($passmd5,0,$num_rand);#cutmd5 start 0 stop $numrand
        $setmid = $cut_pre.$letter_mid;#set pre string + char middle

        $cut_post = substr($passmd5,$num_rand, $sumlenght+1);

        $set_modify_md5 = $letter_pre.$setmid.$cut_post.$letter_post;
        return $set_modify_md5;
    }
}