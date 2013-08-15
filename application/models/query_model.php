<?php
class Query_model extends CI_Model{
    
    function queryByFilter($ao, $table){
        $this->_getWhereClause($ao);
        $count = $this->db->count_all_results($table);
        
        if ($count > 0) {
            $this->_getWhereClause($ao);
            $this->db->limit(10);
            $this->db->order_by("id", "desc");
            $query = $this->db->get($table);
            
            foreach($query->result() as $row){
                $rows[] = $row;
            }
            $result['data'] = $rows;
        } else {
            $result['data'] = null;
        }
        $result['status'] = 'OK';
        $result['count'] = $count;
        return $result;
        /*Before the query runs:

        $this->db->_compile_select(); 
        And after it has run:
        
        $this->db->last_query(); */

    }
    
    function queryTruckAndLocation($ao){
        $this->_getTruckWhereClause($ao);
        $count = $this->db->count_all_results();
        
        if ($count > 0) {
            $this->_getTruckWhereClause($ao);
            $this->db->join(TABLE_DRIVER_LOCATION_RT, TABLE_DRIVER_LOCATION_RT.'.id = '. TABLE_TRUCK_INFO . '.id', 'left');
            
            $this->db->limit(10);
            $this->db->order_by(TABLE_TRUCK_INFO . ".id", "desc");
            $query = $this->db->get();
            
            foreach($query->result() as $row){
                $rows[] = $row;
            }
            $result['data'] = $rows;
        } else {
            $result['data'] = null;
        }
        $result['status'] = 'OK';
        $result['count'] = $count;
        //return $this->db->last_query();
        return $result;
    }
    
    function _getWhereClause($ao){
        if ( $ao ) {
            if ( $ao->ids ) {
                $this->db->where_not_in('id', $ao->ids);
            }
            if ( $ao->list ) {
                foreach ( $ao->list as $one ) {
                    if ($one->type == 5){
                        $this->db->where($one->col, $one->val.'');
                    } else {
                        $this->db->where($one->col, $one->val);
                    }
                }
            }
        }
    }

    function _getTruckWhereClause($ao){
        if ( $ao ) {
            if ( $ao->ids ) {
                $this->db->where_not_in( TABLE_TRUCK_INFO . '.id', $ao->ids);
            }
            if ( $ao->list ) {
                foreach ( $ao->list as $one ) {
                    if ($one->type == 5){
                        $this->db->where( TABLE_TRUCK_INFO . '.'.$one->col, $one->val.'');
                    } else {
                        $this->db->where( TABLE_TRUCK_INFO . '.'.$one->col, $one->val);
                    }
                }
            }
        }
        $this->db->where(TABLE_TRUCK_INFO . '.truckState >' , 0);
        $this->db->select(TABLE_TRUCK_INFO.'.id,'.TABLE_TRUCK_INFO .'.truckBrand,'.TABLE_TRUCK_INFO .'.truckType,'.TABLE_TRUCK_INFO .'.capacity,'.TABLE_TRUCK_INFO .'.plateNo,'.TABLE_TRUCK_INFO .'.truckLength'
            .'     ,'.TABLE_TRUCK_INFO .'.truckVolumn,'.TABLE_TRUCK_INFO .'.bodyStruc,'.TABLE_TRUCK_INFO .'.locProvince,'.TABLE_TRUCK_INFO .'.locCity,'.TABLE_TRUCK_INFO .'.locRegion,'.TABLE_TRUCK_INFO .'.drivingLicense'
            .'     ,'.TABLE_TRUCK_INFO .'.runningToken,'.TABLE_TRUCK_INFO .'.driverName,'.TABLE_TRUCK_INFO .'.driverSex,'.TABLE_TRUCK_INFO .'.mobileNo,'.TABLE_TRUCK_INFO .'.licenseType,'.TABLE_TRUCK_INFO .'.freqLine'
            .'     ,'.TABLE_TRUCK_INFO .'.makeTime,'.TABLE_TRUCK_INFO .'.modifyTime,'.TABLE_TRUCK_INFO .'.truckState,'.TABLE_TRUCK_INFO .'.createUserId,'.TABLE_TRUCK_INFO .'.createUserName,'.TABLE_TRUCK_INFO .'.auditUserId'
            .'     ,'.TABLE_TRUCK_INFO .'.auditUserName,'.TABLE_TRUCK_INFO .'.auditTime'
            .'     ,'.TABLE_DRIVER_LOCATION_RT .'.lat,'.TABLE_DRIVER_LOCATION_RT .'.lng,'.TABLE_DRIVER_LOCATION_RT .'.getTime,'.TABLE_DRIVER_LOCATION_RT .'.cityCode,'.TABLE_DRIVER_LOCATION_RT .'.addressDetail,'.TABLE_DRIVER_LOCATION_RT .'.locationDesc'
        );
        $this->db->from(TABLE_TRUCK_INFO);
    }
}
