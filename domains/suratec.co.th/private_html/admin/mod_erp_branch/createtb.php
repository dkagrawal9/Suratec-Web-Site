<?php
/**
 * Created by PhpStorm.
 * User: DEV-001
 * Date: 20/9/2561
 * Time: 13:21
 */

class CreateTable
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
    private static function getConnect(){
        include('../library/config.php');

        $seft = new self();
        $seft->host = $dbHost;
        $seft->db = $dbName;
        $seft->user = $dbUser;
        $seft->pass = $dbPass;

        $seft->con = mysqli_connect($seft->host,$seft->user,$seft->pass,$seft->db);
        $seft->con ->set_charset($seft->charset);



        return $seft->con;
    }

    protected static $table_name = "logo";

    public static function Create(){

        $db = self::getConnect();

        $cmd = "CREATE TABLE IF NOT EXISTS `mod_erp_branch` (
              `id_branch` varchar(35) NOT NULL,
              `code_branch` varchar(10) NOT NULL,
              `name_branch` varchar(100) NOT NULL,
              `province` varchar(100) NOT NULL,
              `amphoe` varchar(100) NOT NULL,
              `district` varchar(100) NOT NULL,
              `zipcode` varchar(10) NOT NULL,
              `address` text NOT NULL,
              `location` text NOT NULL,
              `phone` varchar(10) NOT NULL,
              `email` text NOT NULL,
              `type` int(11) NOT NULL,
              PRIMARY KEY (`id_branch`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $stmt = $db->prepare($cmd);
        $stmt->execute();

        $cmd = "CREATE TABLE IF NOT EXISTS `mod_erp_branch_image` (
                `id_image` varchar(35) NOT NULL,
                `name_image` varchar(100) NOT NULL,
                `size` int(11) NOT NULL,
                `date_image` datetime NOT NULL,
                `id_branch` varchar(35) NOT NULL,
                PRIMARY KEY (`id_image`)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $stmt = $db->prepare($cmd);
        $stmt->execute();
    }

}

CreateTable::Create();

// include ('../library/connect.php');

// $table_name = "mod_logo";

// $cmd = "CREATE TABLE IF NOT EXISTS `".$table_name."` (
//               `id_logo` int(11) NOT NULL,
//               `name` varchar(100) NOT NULL,
//               `size` int(11) NOT NULL,
//               `date` date NOT NULL
//             ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
// $query = mysqli_query($objConnect,$cmd);

// if($query){
//     echo 'complete'.$cmd;
// }else{
//     echo 'error'.$cmd;
// }

#
 // $cmd = "CREATE TABLE IF NOT EXISTS `".self::$table_name."` (
 //            `id_member` varchar(35) NOT NULL,
 //            `user_member` varchar(20) DEFAULT NULL,
 //            `pass_member` varchar(100) DEFAULT NULL,
 //            `member_re` varchar(50) DEFAULT NULL,
 //            `state` varchar(50) DEFAULT NULL,
 //            `district` varchar(50) DEFAULT NULL,
 //            `address` text,
 //            `location` text,
 //            `email` text,
 //            `phone` text,
 //            `fax` text,
 //            `create_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
 //            `update_datetime` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 //            `delete_datetime` datetime DEFAULT NULL,
 //            PRIMARY KEY (`id_sup`)
 //          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";