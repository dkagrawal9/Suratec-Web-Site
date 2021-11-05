<?php
/**
 * Created by PhpStorm.
 * User: DEV-001
 * Date: 17/9/2561
 * Time: 16:46
 */
namespace App\Customer;

class Database
{
    public $host = '';
    public $db = '';
    public $user = '';
    public $pass = '';
    public $charset = 'utf8';

    /**
     * @var mysqli
     */
    public $con;

    /**
     * @return mysqli
     */
    public static function getConnect(){
        $config = include (__DIR__ . '/../../library/db.php');

        $seft = new self();
        $seft->host = $config['host'];
        $seft->db = $config['dbname'];
        $seft->user = $config['user'];
        $seft->pass = $config['password'];

        $seft->con = mysqli_connect($seft->host,$seft->user,$seft->pass,$seft->db);
        $seft->con->set_charset($seft->charset);

        return $seft->con;
    }
}