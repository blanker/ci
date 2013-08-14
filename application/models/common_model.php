<?php
class Common_model extends CI_Model{
    function save($t, $data){
        $this->db->insert($t, $data);
        return $this->db->insert_id();
    }
    
    function delete($t, $col, $val){
        $this->db->delete($t, array($col => $val ));
    }
    
    function getOne($t, $col, $val){
        $q = $this->db->get_where($t,array($col => $val),1);
        if ($q->num_rows() > 0){
            foreach( $q->result() as $row){
                return $row;
            }
        }
    }
}