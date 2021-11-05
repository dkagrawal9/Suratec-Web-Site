<?php
/**
 * Created by PhpStorm.
 * User: DEV-001
 * Date: 11/10/2561
 * Time: 9:03
 */

namespace App\StockBranch;


class Employee
{
    use DatabaseTrait;

    public $id_employee; //String
    public $username; //String
    public $surname; //String
    public $username_en; //String
    public $surname_en; //String
    public $birthday; //String
    public $position; //String
    public $position_en; //String
    public $code_id; //String
    public $detail_employee; //String
    public $detail_employee_en; //String
    public $email; //String
    public $user_city; //String
    public $user_state; //String
    public $user_district; //String
    public $detail_city; //String
    public $tel; //String
    public $task_view; //String
    public $task_authen; //String
    public $id_branch; //String

    /**
     * @param $id_member
     * @return bool|object|Employee
     */
    public function getEmployeeData($id_member){
        $cmd = "SELECT * FROM tbl_member m LEFT JOIN mod_employee e ON e.id_employee=m.id_data_role WHERE m.id_member=?";
        $stmt = $this->db->prepare($cmd);
        if($stmt->bind_param('s',$id_member)){
            if($stmt->execute()){
                return $stmt->get_result()->fetch_object();
            }
        }
        return false;
    }
}