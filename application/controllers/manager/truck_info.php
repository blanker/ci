<?php
class Truck_info extends CI_Controller{
    function truck_list(){
        $codeNames = array('sex','truckstate','trucktype','trucklength','bodystruc','capacity','licensetype');
        $this->load->model('system_model');
        $codes = $this->system_model->selectSomeSystemCode($codeNames);
        $data['codes'] = json_encode($codes, JSON_FORCE_OBJECT);
        $this->load->view('manager/truck_list', $data);
    }
    function audit_list(){
        $codeNames = array('sex','truckstate','trucktype','trucklength','bodystruc','capacity','licensetype');
        $this->load->model('system_model');
        $codes = $this->system_model->selectSomeSystemCode($codeNames);
        $data['codes'] = json_encode($codes, JSON_FORCE_OBJECT);
        $this->load->view('manager/truck_audit_list', $data);
    }
    
    function get_truck_list(){
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $offset = ($page - 1 ) * $rows;
        
        $where = array();
        if ( isset($_POST['truckState']) ){
            $where['truckState'] = $_POST['truckState'];
        }
        if ( isset($_POST['truckType']) ){
            $where['truckType'] = $_POST['truckType'];
        }
        if ( isset($_POST['truckLength']) ){
            $where['truckLength'] = $_POST['truckLength'];
        }
        if ( isset($_POST['capacity']) ){
            $where['capacity'] = $_POST['capacity'];
        }
        if ( isset($_POST['locProvince']) ){
            $where['locProvince'] = $_POST['locProvince'];
        }
        if ( isset($_POST['locCity']) ){
            $where['locCity'] = $_POST['locCity'];
        }
        if ( isset($_POST['locRegion']) ){
            $where['locRegion'] = $_POST['locRegion'];
        }
        if ( isset($_POST['driverName']) ){
            $where['driverName like'] = '%'.$_POST['driverName'].'%';
        }
        if ( isset($_POST['mobileNo']) ){
            $where['mobileNo like'] = '%'.$_POST['mobileNo'].'%';
        }
        
        $this->load->model("common_model");
        $result = $this->common_model->get_select_result(TABLE_TRUCK_INFO, $where, 'id desc', $offset, $rows);
        //$result['sql'] = $this->db->last_query();
        $this->output
            ->set_content_type("application/json")
            ->set_output( json_encode( $result));
    }
    function save_truck_info(){
        $uid = $this->session->userdata('user.id');
        if ($uid) {
            $data = isset($_POST['data']) ? json_decode( $_POST['data'], true ) : false;
            unset($data['id']);
            $data['makeTime'] = date_format(date_create(), 'Y-m-d H:i:s');
            $data['makeType'] = 2;
            $data['createUserId'] = $uid;
            $data['createUserName'] = $this->session->userdata('user.userName');
            $data['auditUserId'] = 0;
            $data['truckState'] = 0;
            $this->load->model("common_model");
            $id = $this->common_model->save ( TABLE_TRUCK_INFO, $data );
            
            $this->load->model('system_model');
            $this->system_model->recordTruckInfoHis($id, 1, $uid);
                
            $result['status'] = 'OK';
            //$result['sql'] = $this->db->last_query();
        } else {
             $result['status'] = 'ERROR';
             $result['msg'] = '请先登录再操作';
        }
        $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($result));
    }
    
    function update_truck_info(){
        $uid = $this->session->userdata('user.id');
        if ($uid) {
            $data = isset($_POST['data']) ? json_decode( $_POST['data'], true ) : false;
            $id = $data['id'];
            unset($data['id']);
            $data['modifyTime'] = date_format(date_create(), 'Y-m-d H:i:s');
            $this->load->model("common_model");
            $this->common_model->update ( TABLE_TRUCK_INFO, $data, $id );
            
            $this->load->model('system_model');
            $this->system_model->recordTruckInfoHis($id, 2, $uid);
                
            $result['status'] = 'OK';
            //$result['sql'] = $this->db->last_query();
        } else {
             $result['status'] = 'ERROR';
             $result['msg'] = '请先登录再操作';
        }
        $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($result));
    }

    function del_truck_info(){
        $uid = $this->session->userdata('user.id');
        if ($uid) {
            $id = isset($_POST['id']) ? $_POST['id'] : false;
            if ( $id ) {
                $this->load->model('system_model');
                $this->system_model->recordTruckInfoHis($id, 3, $uid);
                
                $this->load->model('common_model');
                $this->common_model->delete(TABLE_TRUCK_INFO,'id',$id);
            }
            $result['status'] = 'OK';
        } else {
             $result['status'] = 'ERROR';
             $result['msg'] = '请先登录再操作';
        }
        $this->output
            ->set_content_type("application/json")
            ->set_output( json_encode( $result));
    }
    
    function commit_audit(){
        $uid = $this->session->userdata('user.id');
        if ($uid) {
            $ids = isset($_POST['ids']) ? json_decode( $_POST['ids'], true ) : false;
            
            foreach($ids as $id) {
                $this->load->model("common_model");
                $truckInfo = $this->common_model->getOne(TABLE_TRUCK_INFO, 'id', $id);
                if ($truckInfo->truckState == 0) {
                    $data = array(
                        'auditTime' => date_format(date_create(), 'Y-m-d H:i:s'),
                        'auditUserId' => $uid,
                        'auditUserName' => $this->session->userdata('user.userName'),
                        'truckState' => 1,
                    );
                    $this->common_model->update ( TABLE_TRUCK_INFO, $data, $id );
                    
                    $this->load->model('system_model');
                    $this->system_model->recordTruckInfoHis($id, 4, $uid);
                }
            }
                
            $result['status'] = 'OK';
            //$result['sql'] = $this->db->last_query();
        } else {
             $result['status'] = 'ERROR';
             $result['msg'] = '请先登录再操作';
        }
        $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($result));
    }
}
