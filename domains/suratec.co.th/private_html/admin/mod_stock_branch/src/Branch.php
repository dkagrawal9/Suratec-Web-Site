<?php
/**
 * Created by PhpStorm.
 * User: DEV-001
 * Date: 9/10/2561
 * Time: 11:59
 */

namespace App\StockBranch;


class Branch
{
    use DatabaseTrait;

    public function getList(){
        session_start();
        $user_id = $_SESSION['user_member'];
        $data = [];
        $cmd = "SELECT * FROM tbl_member m LEFT JOIN mod_employee e ON e.id_employee = m.id_data_role WHERE m.id_member=?";
        $stmt = $this->db->prepare($cmd);
        if($stmt->bind_param('s' , $user_id)){
            if($stmt->execute()){
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                if($row['id_branch'] != null){
                    $branch_id = $row['id_branch'];
                    //$cmd = "SELECT * FROM mod_erp_branch WHERE delete_datetime IS NULL AND id_branch='".$branch_id."'";
                    $cmd = 'SELECT * FROM mod_erp_branch WHERE delete_datetime IS NULL ORDER BY id_branch';
                }else{
                    $cmd = 'SELECT * FROM mod_erp_branch WHERE delete_datetime IS NULL ORDER BY id_branch';
                }
            }
        }
        $result = $this->db->query($cmd);
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }

        return json_encode($data);
    }
}