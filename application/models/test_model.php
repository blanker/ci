<?php
/**
 * Created by JetBrains PhpStorm.
 * User: blank
 * Date: 13-7-26
 * Time: 上午1:31
 * To change this template use File | Settings | File Templates.
 */
class Test_model extends CI_Model{
    function getTruckInfo(){
        $q = $this->db->get("truckInfo");
        if ($q->num_rows() > 0){
            foreach ($q->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }
}