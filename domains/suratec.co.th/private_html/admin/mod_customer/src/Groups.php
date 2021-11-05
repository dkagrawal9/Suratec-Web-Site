<?php /** @noinspection ALL */

/**
 * Created by PhpStorm.
 * User: DEV-001
 * Date: 19/10/2561
 * Time: 14:10
 */

namespace App\Customer;


class Groups
{
    use DatabaseTrait;

    public function add($data){
        $date = $this->getDateTime();
        $cmd = "INSERT INTO mod_customer_group(name_group,detail_group,create_datetime,update_datetime) values (?,?,?,?)";
        $stmt = $this->db->prepare($cmd);
        if($stmt->bind_param('ssss' , $data->name_group,$data->detail_group,$date,$date)){
            if($stmt->execute()){
                return json_encode(['error'=>0]);
            }
        }
        return json_encode(['error'=>1,'msg'=>$stmt->error]);
    }

    public function getList(){
        $cmd = "SELECT * FROM mod_customer_group";
        $data = [];
        $result = $this->db->query($cmd);
        while($row = $result->fetch_assoc()){
            $cmd = "SELECT count(id_customer) as total FROM mod_customer WHERE cus_group LIKE '%".$row['id_group']."%'";
            $total = $this->db->query($cmd)->fetch_assoc()['total'];

            $row['total'] = $total;

            $data[] = $row;
        }
        return json_encode($data);
    }


}