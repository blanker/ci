<?php
class Freight_source extends CI_Controller{
    function freight_list(){
        $codeNames = array('freightstate','packtype','freighttype');
        $this->load->model('system_model');
        $codes = $this->system_model->selectSomeSystemCode($codeNames);
        $data['codes'] = json_encode($codes, JSON_FORCE_OBJECT);
        $this->load->view('manager/freight_list', $data);
    }
    function audit_list(){
        $codeNames = array('freightstate','packtype','freighttype');
        $this->load->model('system_model');
        $codes = $this->system_model->selectSomeSystemCode($codeNames);
        $data['codes'] = json_encode($codes, JSON_FORCE_OBJECT);
        $this->load->view('manager/freight_audit_list', $data);
    }
    
    function get_freight_list(){
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $offset = ($page - 1 ) * $rows;
        
        $where = array();
        if ( isset($_POST['freightState']) ){
            $where['freightState'] = $_POST['freightState'];
        }
        if ( isset($_POST['freightType']) ){
            $where['freightType'] = $_POST['freightType'];
        }
        if ( isset($_POST['packType']) ){
            $where['packType'] = $_POST['packType'];
        }
        if ( isset($_POST['originProvince']) ){
            $where['originProvince'] = $_POST['originProvince'];
        }
        if ( isset($_POST['originCity']) ){
            $where['originCity'] = $_POST['originCity'];
        }
        if ( isset($_POST['originRegion']) ){
            $where['originRegion'] = $_POST['originRegion'];
        }
        if ( isset($_POST['freightName']) ){
            $where['freightName like'] = '%'.$_POST['freightName'].'%';
        }        
        
        $this->load->model("common_model");
        $result = $this->common_model->get_select_result(TABLE_FREIGHT_SOURCE, $where, 'id desc', $offset, $rows);
        //$result['sql'] = $this->db->last_query();
        $this->output
            ->set_content_type("application/json")
            ->set_output( json_encode( $result));
    }

    function save_freight_source(){
        $uid = $this->session->userdata('user.id');
        if ($uid) {
            $data = isset($_POST['data']) ? json_decode( $_POST['data'], true ) : false;
            unset($data['id']);
            $data['makeTime'] = date_format(date_create(), 'Y-m-d H:i:s');
            $data['makeType'] = 2;
            $data['createUserId'] = $uid;
            $data['createUserName'] = $this->session->userdata('user.userName');
            $data['auditUserId'] = 0;
            $data['deliverUserId'] = 0;
            $data['receiveUserId'] = 0;
            $data['freightState'] = 0;
            $this->load->model("common_model");
            $id = $this->common_model->save ( TABLE_FREIGHT_SOURCE, $data );
            
            $this->load->model('system_model');
            $this->system_model->recordFreightSourceHis($id, 1, $uid);
                
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

    function update_freight_source(){
        $uid = $this->session->userdata('user.id');
        if ($uid) {
            $data = isset($_POST['data']) ? json_decode( $_POST['data'], true ) : false;
            $id = $data['id'];
            unset($data['id']);
            $data['modifyTime'] = date_format(date_create(), 'Y-m-d H:i:s');
            $this->load->model("common_model");
            $freightSource = $this->common_model->getOne(TABLE_FREIGHT_SOURCE, 'id', $id);
            if ( $freightSource->freightState > 1){
                $result['status'] = 'ERROR';
                $result['msg'] = '货源状态['.$freightSource->freightState.']不允许删除!';
            } else {            
                $this->common_model->update ( TABLE_FREIGHT_SOURCE, $data, $id );
                
                $this->load->model('system_model');
                $this->system_model->recordFreightSourceHis($id, 2, $uid);
                    
                $result['status'] = 'OK';
            }
            //$result['sql'] = $this->db->last_query();
        } else {
             $result['status'] = 'ERROR';
             $result['msg'] = '请先登录再操作';
        }
        $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($result));
    }
    function del_freight_source(){
        $uid = $this->session->userdata('user.id');
        if ($uid) {
            $id = isset($_POST['id']) ? $_POST['id'] : false;
            if ( $id ) {
                $this->load->model('common_model');
                $freightSource = $this->common_model->getOne(TABLE_FREIGHT_SOURCE, 'id', $id);
                if ( $freightSource->freightState > 1){
                    $result['status'] = 'ERROR';
                    $result['msg'] = '货源状态['.$freightSource->freightState.']不允许删除!';
                } else {                
                    $this->load->model('system_model');
                    $this->system_model->recordFreightSourceHis($id, 3, $uid);
                    
                    $this->common_model->delete(TABLE_FREIGHT_SOURCE,'id',$id);
                    $result['status'] = 'OK';
                }
            }
            
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
                $truckInfo = $this->common_model->getOne(TABLE_FREIGHT_SOURCE, 'id', $id);
                if ($truckInfo->freightState == 0) {
                    $data = array(
                        'auditTime' => date_format(date_create(), 'Y-m-d H:i:s'),
                        'auditUserId' => $uid,
                        'auditUserName' => $this->session->userdata('user.userName'),
                        'freightState' => 1,
                    );
                    $this->common_model->update ( TABLE_FREIGHT_SOURCE, $data, $id );
                    
                    $this->load->model('system_model');
                    $this->system_model->recordFreightSourceHis($id, 4, $uid);
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

    function deliver_freight(){
        $codeNames = array('freightstate','packtype','freighttype');
        $this->load->model('system_model');
        $codes = $this->system_model->selectSomeSystemCode($codeNames);
        $data['codes'] = json_encode($codes, JSON_FORCE_OBJECT);
        $this->load->view('manager/deliver_freight',$data);
    }
}
