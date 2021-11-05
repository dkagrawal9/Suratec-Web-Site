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

    protected static $table_name = "product";

    public static function Create(){

        $db = self::getConnect();

        $cmd = "CREATE TABLE IF NOT EXISTS `product`(
               `id_product` varchar(35) NOT NULL,
                `name_product` varchar(100) NOT NULL,
                `name_product_en` varchar(100) NOT NULL,
                `detail_product` text NOT NULL,
                `detail_product_en` text NOT NULL,
                `date_add` datetime NOT NULL,
                `date_edit` datetime NOT NULL,
                `status_product` varchar(100) NOT NULL,
                `status_product_sale` varchar(100) NOT NULL,
                `status_ready` int(11) NOT NULL,
                `id_catagory` varchar(100) NOT NULL,
                `view` int(11) NOT NULL,
                `level_product` int(11) NOT NULL,
                PRIMARY KEY (`id_product`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $stmt = $db->prepare($cmd);
        $stmt->execute();

       $cmd = "CREATE TABLE IF NOT EXISTS `product_attribute`(
                `id_attr` varchar(35) NOT NULL,
                `attribute_name` varchar(100) NOT NULL,
                `option_name` varchar(100) NOT NULL,
                `price_attr` int(100) NOT NULL,
                `price_n_attr` int(100) NOT NULL,
                `stock_attr` int(11) NOT NULL,
                `weight_attr` varchar(100) NOT NULL,
                `SKU_attr` varchar(100) NOT NULL,
                `show_attr` int(11) NOT NULL,
                `orderby` int(11) NOT NULL AUTO_INCREMENT,
                `id_product` varchar(35) NOT NULL,
                PRIMARY KEY (`id_attr`),
                UNIQUE KEY `orderby` (`orderby`),
                FOREIGN KEY (`id_product`) REFERENCES product (`id_product`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $stmt = $db->prepare($cmd);
        $stmt->execute();

        $cmd = "CREATE TABLE IF NOT EXISTS `product_attribute_head` (
                `id_attr_head` int(11) NOT NULL AUTO_INCREMENT,
                `name_attr_head` varchar(100) NOT NULL,
                `name_attr_head_show` varchar(100) NOT NULL,
                `name_attr_head_show_en` varchar(100) NOT NULL,
                PRIMARY KEY (`id_attr_head`)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $stmt = $db->prepare($cmd);
        $stmt->execute();

        $cmd = "CREATE TABLE IF NOT EXISTS  `product_attribute_sub` (
              `id_attr_sub` int(11) NOT NULL AUTO_INCREMENT,
              `name_attr_sub` varchar(100) NOT NULL,
              `name_attr_sub_en` varchar(100) NOT NULL,
              `id_attr_head` int(11) NOT NULL,
              PRIMARY KEY (`id_attr_sub`),
              FOREIGN KEY (`id_attr_head`) REFERENCES product_attribute_head (`id_attr_head`)
              ON DELETE CASCADE
              ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $stmt = $db->prepare($cmd);
        $stmt->execute();

        $cmd = "CREATE TABLE IF NOT EXISTS `product_catagory` (
                `id_catagory` int(11) NOT NULL AUTO_INCREMENT,
                `name_catagory` varchar(100) NOT NULL,
                `name_catagory_en` varchar(100) NOT NULL,
                `date_catagory` date NOT NULL,
                `group_sub` varchar(100) NOT NULL,
                `icon` varchar(100) NOT NULL,
                `img` varchar(100) NOT NULL,
                `level` int(11) NOT NULL,
                 PRIMARY KEY (`id_catagory`)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $stmt = $db->prepare($cmd);
        $stmt->execute();

        $cmd = "CREATE TABLE IF NOT EXISTS `product_image` (
              `id_image` varchar(35) NOT NULL,
              `name_image` varchar(100) NOT NULL,
              `size_image` int(11) NOT NULL,
              `date_image` varchar(100) NOT NULL,
              `active` varchar(100) NOT NULL,
              `id_product` varchar(35) NOT NULL,
               PRIMARY KEY (`id_image`),
               FOREIGN KEY (`id_product`) REFERENCES product (`id_product`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $stmt = $db->prepare($cmd);
        $stmt->execute();

        $cmd = "CREATE TABLE IF NOT EXISTS `product_image_attr` (
                `id_image` varchar(35) NOT NULL,
                `name_image` varchar(100) NOT NULL,
                `size_image` int(11) NOT NULL,
                `date_image` varchar(100) NOT NULL,
                `active` varchar(100) NOT NULL,
                `id_attr` varchar(35) NOT NULL,
                PRIMARY KEY (`id_image`),
                FOREIGN KEY (`id_attr`) REFERENCES product_attribute (`id_attr`)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $stmt = $db->prepare($cmd);
        $stmt->execute();

        $cmd = "CREATE TABLE IF NOT EXISTS `product_image_thumb` (
                `id_thumb` int(11) NOT NULL AUTO_INCREMENT,
                `name_thumb` varchar(100) NOT NULL,
                `date_thumb` varchar(100) NOT NULL,
                `size_thumb` int(11) NOT NULL,
                `user_id` varchar(35) NOT NULL,
                `active` varchar(20) NOT NULL,
                PRIMARY KEY (`id_thumb`)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $stmt = $db->prepare($cmd);
        $stmt->execute();

         $cmd = "CREATE TABLE IF NOT EXISTS `product_stock` (
                `id_stock` varchar(35) NOT NULL,
                `sum_stock` int(11) NOT NULL,
                `order_stock` int(11) NOT NULL,
                `balance_stock` int(11) NOT NULL,
                `id_product` text NOT NULL,
                PRIMARY KEY (`id_stock`)
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