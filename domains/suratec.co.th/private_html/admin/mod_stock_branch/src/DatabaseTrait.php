<?php
/**
 * Created by PhpStorm.
 * User: DEV-001
 * Date: 9/10/2561
 * Time: 12:01
 */

namespace App\StockBranch;


trait DatabaseTrait
{
    /**
     * @var \mysqli
     */
    protected $db;

    protected $DateTime;


    public function __construct()
    {
        date_default_timezone_set("Asia/Bangkok");
        $this->db = Database::getConnect();
        $this->DateTime = new \DateTime();
    }

    public function __destruct()
    {
        $this->db->close();
    }

    public function getDateTime()
    {
        return $this->DateTime->format('Y-m-d H:i:s');
    }


}