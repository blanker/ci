<?php
class System_model extends CI_Model{
    function getSystemUser($userId){
        $this->db->where("userId", $userId);
        $this->db->or_where("mobileNo", $userId);
        $q = $this->db->get(TABLE_SYSTEM_USER);
        if ($q->num_rows() > 0){
            foreach ( $q->result() as $row){
                return $row;  
            } 
        }
    }    
}