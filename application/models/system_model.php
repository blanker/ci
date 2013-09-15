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
    
    function getUserMenu( $uid ) {
        $where = "id in ( select a.menuId ".
            "  from ".TABLE_ROLE_MENU_RIGHTS." a , ".TABLE_SYSTEM_USER_ROLE." b".
            " where a.roleId = b.roleId and a.accessRights = 1 ".
            "   and b.userId = ". $uid .
            ")";
        $this->db->where($where);
        $this->db->order_by('sortNum', 'asc');
        $query = $this->db->get(TABLE_SYSTEM_MENU);
        $data = array();
        
        if ($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
        }
        return $data;
        /*
        select * from SystemMenu where id in ( ")
            .append("   select a.menuId from RoleMenuRights a , SystemUserRole b ")
            .append("    where a.roleId = b.roleId and a.accessRights = 1 ")
            .append("      and b.userId = :userId ) order by sortNum");
         */
    }
    
    function insertMenus ( $rows ){
        $this->db->insert_batch(TABLE_SYSTEM_MENU, $rows); 
    }
    
    function updateMenus ( $rows ){
        $this->db->update_batch(TABLE_SYSTEM_MENU, $rows,'id');
    }    
    
    function deleteMenus ( $ids ) {
        foreach($ids as $id) {
            $this->db->delete(TABLE_SYSTEM_MENU, array('id' => $id));
        } 
    }
    function insertCodes ( $rows ){
        $date = date_format(date_create(), 'Y-m-d H:i:s');
        $newRows = array();
        foreach($rows as $row){
            $row['makeTime'] = $date;
            $newRows[] = $row;
        }
        $this->db->insert_batch(TABLE_SYSTEM_CODE, $newRows); 
    }
    
    function updateCodes ( $rows ){
        $date = date_format(date_create(), 'Y-m-d H:i:s');
        $newRows = array();
        foreach($rows as $row){
            $row['modifyTime'] = $date;
            unset($row['createTime']);
            $newRows[] = $row;
        }
        $this->db->update_batch(TABLE_SYSTEM_CODE, $newRows,'id');
    }    
    
    function deleteCodes ( $ids ) {
        foreach($ids as $id) {
            $this->db->delete(TABLE_SYSTEM_CODE, array('id' => $id));
        } 
    }
    
    function get_menu_rights_list(){
        $total =  $this->db->count_all_results(TABLE_SYSTEM_MENU);
        
        $rightsCols = array(TABLE_SYSTEM_MENU_RIGHTS.'.id');
        for($i=1;$i<=20;$i++){
            $rightsCols[] = TABLE_SYSTEM_MENU_RIGHTS.'.rights'.sprintf('%02d',$i);
        }
        $this->db->select(TABLE_SYSTEM_MENU.'.id as `menuId`,'.TABLE_SYSTEM_MENU.'.menuName, '.implode(",", $rightsCols));
        $this->db->from(TABLE_SYSTEM_MENU);
        $this->db->join(TABLE_SYSTEM_MENU_RIGHTS, TABLE_SYSTEM_MENU.'.id = '.TABLE_SYSTEM_MENU_RIGHTS.'.menuId', 'left');
        $this->db->order_by(TABLE_SYSTEM_MENU.".sortNum, ".TABLE_SYSTEM_MENU.'.id');
        $query = $this->db->get();
        
        $items = array();
        if ($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $items[] = $row;
            }
        }
        
        $result = array( 'total' => $total, 'rows' => $items);
        $result['sql'] = $this->db->last_query();
        return $result;
    }
    
    function deleteMenuRights($ids){
        foreach($ids as $id) {
            $this->db->delete(TABLE_SYSTEM_MENU_RIGHTS, array('id' => $id));
        } 
    }
    function updateMenuRights($rows) {
        foreach($rows as $row) {
            if ($row['id']) {
                $id = $row['id'];
                unset($row['id']);
                unset($row['menuName']);
                $this->db->update(TABLE_SYSTEM_MENU_RIGHTS, $row, array('id' => $id));
            } else {
                unset($row['id']);
                unset($row['menuName']);
                $this->db->insert(TABLE_SYSTEM_MENU_RIGHTS, $row);
            }
        }
    }
    function insertRoleRights($rows){
        foreach($rows as $row) {
            unset($row['menuName']);
            $this->db->insert(TABLE_ROLE_MENU_RIGHTS, $row);
        }
    }
    function updateRoleRights($rows){
        foreach($rows as $row) {
            $id = $row['id'];
            unset($row['id']);
            unset($row['menuName']);
            $this->db->update(TABLE_ROLE_MENU_RIGHTS, $row, array('id' => $id));
        }
    }
    
    function recordSystemUserHis($id, $modifyType, $uid){
        $sql = 'insert into '.TABLE_SYSTEM_USER_HIS;
        $sql .= ' ( `encryptedPass`, `mobileNo`, `roleStr`, `userId`, `userName`, `address`, `custType`, `makeType`, `makeTime`,  `mainId`, `modifyType`, `uid` ) ';
        $sql .= 'select `encryptedPass`, `mobileNo`, `roleStr`, `userId`, `userName`, `address`, `custType`, `makeType`,';
        $sql .= 'current_timestamp, ' .$id. ', '.$modifyType.', '.$uid;
        $sql .= '  from '.TABLE_SYSTEM_USER;
        $sql .= ' where id = ' .$id;
        $this->db->query($sql);
    }
    
    function selectSomeSystemCode( $codeNames ){
        $this->db->where_in('codeName', $codeNames);
        // Produces: WHERE username IN ('Frank', 'Todd', 'James')
        $this->db->select('codeName, codeValue, codeText');
        $this->db->order_by('codeName, sortNum');
        $q = $this->db->get(TABLE_SYSTEM_CODE);
        $data = array();
        if ( $q->num_rows() > 0 ) {
            foreach ($q->result() as $row){
                $data[$row->codeName][$row->codeValue] = $row->codeText;
            }
        }
        return $data;
    }
    
    function get_user_role($userId){
        $this->db->select(TABLE_SYSTEM_USER_ROLE.'.id,'.TABLE_SYSTEM_USER_ROLE.'.userId,'.TABLE_SYSTEM_USER_ROLE.'.roleId,'.TABLE_SYSTEM_ROLE.'.roleName');
        $this->db->from(TABLE_SYSTEM_USER_ROLE);
        $this->db->join(TABLE_SYSTEM_ROLE, TABLE_SYSTEM_USER_ROLE.'.roleId = '.TABLE_SYSTEM_ROLE.'.id');
        $this->db->where(TABLE_SYSTEM_USER_ROLE.'.userId',$userId);
        $this->db->order_by(TABLE_SYSTEM_USER_ROLE.'.roleId');
        $q = $this->db->get();
        $data = array();
        if ($q->num_rows()>0){
            foreach($q->result() as $row){
                $data[] = $row;
            }
        }
        return $data;
    }
    function insertUserRoleRights($rows){
        foreach($rows as $row) {
            unset($row['roleName']);
            $this->db->insert(TABLE_SYSTEM_USER_ROLE, $row);
        }
    }
    
    function recordTruckInfoHis($id, $modifyType, $uid){
        $sql = 'insert into '.TABLE_TRUCK_INFO_HIS;
        $sql .= '     ( `makeType`,`auditTime`, `auditUserId`, `auditUserName`, `bodyStruc`, `capacity`, `createUserName`, `driverName`, `driverSex`, `drivingLicense`, `freqLine`, `licenseType`, `locCity`, `locProvince`, `locRegion`, `mobileNo`, `plateNo`, `runningToken`, `truckBrand`, `truckLength`, `truckState`, `truckType`, `truckVolumn`,`modifyTime`,`truckInfoId`,`modifyType`,`createUserId` ) ';
        $sql .= 'select `makeType`,`auditTime`, `auditUserId`, `auditUserName`, `bodyStruc`, `capacity`, `createUserName`, `driverName`, `driverSex`, `drivingLicense`, `freqLine`, `licenseType`, `locCity`, `locProvince`, `locRegion`, `mobileNo`, `plateNo`, `runningToken`, `truckBrand`, `truckLength`, `truckState`, `truckType`, `truckVolumn`,';
        $sql .= 'current_timestamp, ' .$id. ', '.$modifyType.', '.$uid;
        $sql .= '  from '.TABLE_TRUCK_INFO;
        $sql .= ' where id = ' .$id;
        $this->db->query($sql);
    }

    function recordFreightSourceHis($id, $modifyType, $uid){
        $sql = 'insert into '.TABLE_FREIGHT_SOURCE_HIS;
        $sql .= '     ( `attention`, `auditTime`, `auditUserId`, `auditUserName`, `createUserName`, `deliverTime`, `deliverUserId`, `destCity`, `destProvince`, `destRegion`, `freightName`, `freightState`, `freightType`, `freightVolumn`, `freightWeight`, `makeTime`, `originCity`, `originProvince`, `originRegion`, `packType`, `receiveTime`, `receiveUserId`, `makeType`, `modifyTime`, `freightSourceId`, `modifyType`,`createUserId` ) ';
        $sql .= 'select `attention`, `auditTime`, `auditUserId`, `auditUserName`, `createUserName`, `deliverTime`, `deliverUserId`, `destCity`, `destProvince`, `destRegion`, `freightName`, `freightState`, `freightType`, `freightVolumn`, `freightWeight`, `makeTime`, `originCity`, `originProvince`, `originRegion`, `packType`, `receiveTime`, `receiveUserId`, `makeType`,';
        $sql .= 'current_timestamp, id, '.$modifyType.', '.$uid;
        $sql .= '  from '.TABLE_FREIGHT_SOURCE;
        $sql .= ' where id = ' .$id;
        $this->db->query($sql);
    }
}