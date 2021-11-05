<?php
/**
 * Created by PhpStorm.
 * User: DEV-001
 * Date: 9/10/2561
 * Time: 14:58
 */

namespace App\StockBranch;

if(!isset($_SESSION)) {
    session_start();
}

class Stock
{
    use DatabaseTrait;

    public function getItemStock($id_branch)
    {
        $data = [];
        $cmd = "SELECT * FROM  product_stock_branch b LEFT JOIN product p ON p.id_product = b.id_product LEFT JOIN product_attribute a ON a.id_product = b.id_product_attr WHERE b.id_branch='$id_branch' AND b.delete_datetime IS NULL ORDER BY b.id";
        $result = $this->db->query($cmd);
        while ( $row = $result->fetch_assoc() ) {
            $date = \DateTime::createFromFormat('Y-m-d H:i:s', $row['create_datetime']);
            $row['create_datetime'] = $date->format('Y-m-d');
            $data[] = $row;
        }
        return json_encode($data);

    }

    public function Add($data)
    {
        $cmd = "INSERT INTO product_stock_branch(id_branch, id_product, id_product_attr,min,max,create_datetime) VALUES (?,?,?,?,?,?)";
        $stmt = $this->db->prepare($cmd);
        $date = $this->DateTime->format('Y-m-d H:i:s');
        if ($stmt->bind_param('sssiis', $data->id_branch, $data->id_product, $data->id_attr, $data->min, $data->max, $date)) {
            if ($stmt->execute()) {
                return json_encode(['error' => 0]);
            }
        }
        return json_encode(['error' => 1, 'msg' => $stmt->error]);
    }

    public function Edit($data)
    {
        $cmd = "UPDATE product_stock_branch SET min=?,max=? WHERE id=?";
        $stmt = $this->db->prepare($cmd);
        if ($stmt->bind_param('iii', $data->min, $data->max, $data->id)) {
            if ($stmt->execute()) {
                return json_encode(['error' => 0]);
            }
        }
        return json_encode(['error' => 1, 'msg' => $stmt->error]);
    }

    public function AddToStock($data)
    {
        $cmd = 'UPDATE product_stock_branch SET sum_stock = sum_stock+? WHERE id=?';
        $stmt = $this->db->prepare($cmd);
        if ($stmt->bind_param('ii', $data->amount, $data->stock_id)) {
            if ($stmt->execute()) {
                $stmt->close();
                
                $cu = 'INSERT INTO product_stock_branch_history(product_stock_id, amount, id_member) VALUES (?,?,?);';
                $stmt = $this->db->prepare($cu);
                $stmt->bind_param('iis',$data->stock_id,$data->amount,$_SESSION['user_member']);
                $stmt->execute();

                $date = $this->DateTime->format('Y-m-d H:i:s');
                $sql = "INSERT INTO `product_lotsize`(`id_attr`, `lot_number`, `qty`, `price`, `startdate_time`, `enddate_time`, `id_employee`, `datetime_create`) VALUES ('".$data->stock_id."','".$data->lot."','".$data->amount."','".$data->price."','".$date."','".$data->endtime."','".$_SESSION['id_employee']."','".$date."');";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();

                return json_encode(['error' => 0]);
            }
        }

        return json_encode(['error' => 1, 'msg' => $stmt->error]);
    }


}