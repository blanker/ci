<?php
class Common_model extends CI_Model{
    function save($t, $data){
        $this->db->insert($t, $data);
        return $this->db->insert_id();
    }
    
    function delete($t, $col, $val){
        $this->db->delete($t, array($col => $val ));
    }
    
    function update( $t, $data, $id){
        $this->db->where('id', $id);
        $this->db->update($t, $data); 
    }
    
    function getOne($t, $col, $val, $id=0){
        $this->db->where($col, $val);
        if ( $id ) {
            $this->db->where('id !=', $id);
        }
        $this->db->limit(1);        
        $q = $this->db->get($t);
        if ($q->num_rows() > 0){
            foreach( $q->result() as $row){
                return $row;
            }
        }
    }
    
    function get_select_result( $table, $where, $order, $offset=0, $rows=0, $likeFilter=array(), $filter=array() ){
        $this->db->from($table);
        $this->db->like($likeFilter);
        $this->db->where($where);
        foreach($filter as $filt){
            $this->db->where($filt);
        }
        $total = $this->db->count_all_results();
        
        $this->db->from($table);
        $this->db->where($where);
        $this->db->like($likeFilter);
        foreach($filter as $filt){
            $this->db->where($filt);
        }
        $this->db->order_by($order);
        if ($rows > 0) {
            $this->db->limit( $rows, $offset );
        }
        $query = $this->db->get();
        $items = array();
        if ( $query->num_rows() > 0 ) {
            foreach( $query->result() as $row){
                $items[] = $row;
            }
        }
        $result = array( 'total' => $total, 'rows' => $items);
        //$result['sql'] = $this->db->last_query();
        return $result;
    }
    
    function insertItems ( $table, $rows ){
        $this->db->insert_batch($table, $rows); 
    }
    
    function updateItems ( $table, $rows, $id ){
        $this->db->update_batch($table, $rows, $id);
    }    
    
    function deleteItems ( $table, $ids, $idName) {
        foreach($ids as $id) {
            $this->db->delete($table, array($idName => $id));
        } 
    }
}