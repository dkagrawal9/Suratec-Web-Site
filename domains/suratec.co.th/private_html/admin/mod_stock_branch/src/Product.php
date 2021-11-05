<?php
/**
 * Created by PhpStorm.
 * User: DEV-001
 * Date: 9/10/2561
 * Time: 14:16
 */

namespace App\StockBranch;


class Product
{
    use DatabaseTrait;

    public function getList($id_branch,$cat_id = ''){
        $data = [];
        $cmd = "SELECT * FROM product p 
        LEFT JOIN product_image i ON i.id_product = p.id_product 
        LEFT JOIN product_catagory pc ON p.id_catagory = pc.id_catagory
        WHERE p.delete_datetime IS NULL  ";
        if (isset($cat_id)) {
            $cmd .= " AND p.id_catagory LIKE '%".$cat_id."%'";
        }
        $result = $this->db->query($cmd);
        while($row = $result->fetch_assoc()){
            $item = ['product'=>'' , 'attr'=>[]];
            $item['product'] = $row;

            $cmd = "SELECT p.id_attr , p.option_name ,p.SKU_attr ,a.name_image ,p.price_attr ,p.barcode FROM product_attribute p LEFT JOIN product_image_attr a ON a.id_attr = p.id_attr WHERE p.id_product ='".$row['id_product']."' AND NOT EXISTS(SELECT * FROM product_stock_branch sb WHERE sb.id_branch='$id_branch' AND sb.id_product_attr=p.id_attr)";
            $resultAttr = $this->db->query($cmd);
            // if($resultAttr->num_rows == 0){
            //     continue;
            // }
            while($attr = $resultAttr->fetch_assoc()){
                array_push($item['attr'] , $attr);
            }
            array_push($data,$item);
        }
        return json_encode($data);
    }

    public function getListAll($id_branch,$cat_id = ''){
        $data = [];
        $cmd = "SELECT b.id ,b.id_product_attr , p.name_product , a.option_name , (b.sum_stock - b.order_stock) as  balance_stock ,b.order_stock,b.min,b.max , b.create_datetime ,a.barcode FROM product_stock_branch b LEFT JOIN product p ON p.id_product = b.id_product LEFT JOIN product_attribute a 
ON a.id_attr = b.id_product_attr WHERE b.id_branch=? AND b.delete_datetime IS NULL ";
        if (isset($cat_id)) {
            $cmd .= " AND p.id_catagory LIKE '%$cat_id%'";
        }
        $stmt = $this->db->prepare($cmd);
        if($stmt->bind_param('s' , $id_branch)){
            if($stmt->execute()){
                $result = $stmt->get_result();
                while($row = $result->fetch_assoc()){
                    $date = \DateTime::createFromFormat('Y-m-d H:i:s', $row['create_datetime']);
                    //$row['create_datetime'] =  $date->format('d/m/Y');
                    $data[] = $row;
                }
            }
        }
        return json_encode($data);
    }

    public function getCategoryList(){
        $data = [];
        $cmd = "SELECT * FROM product_catagory";
        $result = $this->db->query($cmd);
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return json_encode($data);
    }
}