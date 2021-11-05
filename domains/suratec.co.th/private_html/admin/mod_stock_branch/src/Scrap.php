<?php
/**
 * Created by PhpStorm.
 * User: DEV-001
 * Date: 10/10/2561
 * Time: 15:34
 */

namespace App\StockBranch;


class Scrap
{
    use DatabaseTrait;

    public function Add($data){
        session_start();
        $cmd = "INSERT INTO product_stock_branch_adjust(id_product_stock_branch, id_member, amount, remark, status ,create_datetime) VALUES (?,?,?,?,?,?)";
        $stmt = $this->db->prepare($cmd);
        $date = $this->getDateTime();
        $id_employee = $_SESSION['user_member'];
        if($stmt->bind_param('isisis',$data->id_product_stock_branch , $id_employee,$data->amount,$data->remark,$data->status,$date)){
            //var_dump($stmt);
            if($stmt->execute()){
                $stmt->close();
                $cmd = "UPDATE product_stock_branch SET sum_stock=sum_stock-? , balance_stock=sum_stock-order_stock WHERE id=?";
                $stmt = $this->db->prepare($cmd);
                if($stmt->bind_param('ii',$data->amount,$data->id_product_stock_branch)){
                    if($stmt->execute()){
                        return json_encode(['error'=>0]);
                    }
                }
            }
        }
        return json_encode(['error'=>0 , 'msg'=>$stmt->error]);
    }

    public function getListAll($data){
        //var_dump($data);
        $cmd = "SELECT a.id,a.amount,a.remark,a.status,p.name_product,at.option_name,e.username,e.surname,a.create_datetime,a.id_product_stock_branch
FROM product_stock_branch_adjust a
       LEFT JOIN product_stock_branch b ON b.id = a.id_product_stock_branch
       LEFT JOIN product p ON p.id_product= b.id_product
       LEFT JOIN product_attribute at ON at.id_attr=b.id_product_attr
       LEFT JOIN tbl_member m ON m.id_member=a.id_member
       LEFT JOIN mod_employee e ON e.id_employee=m.data_role
       WHERE b.id_branch='$data->id_branch' AND p.name_product LIKE '%$data->name_product%' AND date(a.create_datetime) BETWEEN '$data->begin' AND '$data->end'";
        $result = $this->db->query($cmd);
        $data = [];

        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }

        return json_encode($data);


    }

    public function addBack($data)
    {
        $cmd = "UPDATE product_stock_branch_adjust SET amount_back=? , amount=amount-amount_back WHERE id=?";
        $stmt = $this->db->prepare($cmd);
        if($stmt->bind_param('ii',$data->amount_back,$data->id)){
            if($stmt->execute()){
                $cmd = "INSERT INTO product_stock_branch_adjust_history(id_adjust, id_member, amount, create_datetime) VALUES (?,?,?,NOW())";
                $stmt = $this->db->prepare($cmd);
                session_start();
                $id_member = $_SESSION['user_member'];
                if($stmt->bind_param('iii',$data->id,$id_member,$data->amount_back)){
                    if($stmt->execute()){
                        $cmd = "UPDATE product_stock_branch SET sum_stock=sum_stock+? WHERE id=? ";
                        $stmt = $this->db->prepare($cmd);
                        if($stmt->bind_param('ii',$data->amount_back,$data->id_product_stock_branch)){
                            if($stmt->execute()){
                                return json_encode(['error' => 0]);
                            }
                        }
                    }
                }
            }
        }
        return json_encode(['error' => 1 , 'msg'=>$stmt->error]);
    }


}