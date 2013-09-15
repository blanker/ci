<?php
class Rights extends CI_Controller{
    function user_login(){
        $u = urldecode( $this->input->get("u") );
        $uo = json_decode($u);
        
        //syslog(LOG_NOTICE,  $u."\n");
        
        //closelog();
        
        $this->load->model("system_model");
        $user = $this->system_model->getSystemUser($uo->regUsername);
        if ( !$user ){
            $data['msg'] = '用户帐号['.$u.']不存在';
            $data['status'] = 'ERROR';
        } else {
            if ( $user->encryptedPass === $uo->regPassword ){
                $data['status'] = 'OK';
                $data['data'][] = $user;
            } else {
                $data['msg'] = '用户帐号['.$u.']的密码不正确';
                $data['status'] = 'ERROR';
            }
        }
        
        //echo "<pre>";
        //var_dump($uo);
        //var_dump($user);
        //echo "</pre>";
        $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($data));
    }
    
    function user_register(){
        $u = urldecode( $this->input->get("u") );
        $uo = json_decode($u);
        //print_r($uo);
        
        $systemUser = array(
            'encryptedPass' => $uo->regPassword,
            'mobileNo' => $uo->regPhone,
            'userId' => $uo->regPhone,
            'userName' => $uo->regUsername,
            'address' => $uo->regAddress,
            'custType' => $uo->custType, 
            'makeTime' => date_format(date_create(), 'Y-m-d H:i:s'),
            'makeType' => 1,
        );
        $this->load->model("common_model");
        if ( $this->common_model->getOne(TABLE_SYSTEM_USER,'userId',$uo->regPhone) ){
            $data['msg'] = '用户ID['.$uo->regPhone.']已经被注册';
            $data['status'] = 'ERROR';
        } else if ( $this->common_model->getOne(TABLE_SYSTEM_USER,'mobileNo',$uo->regPhone) ) {
            $data['msg'] = '用户ID['.$uo->regPhone.']已经被注册';
            $data['status'] = 'ERROR';
        } else {
            $id = $this->common_model->save(TABLE_SYSTEM_USER, $systemUser);
            
            $this->load->model('system_model');
            $this->system_model->recordSystemUserHis($id, 1, 0);
                
            $data['status'] = 'OK';
        }
        
        $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($data));
    }

    function save_user(){
        $uid = $this->session->userdata('user.id');
        if ($uid) {
            $data = isset($_POST['data']) ? json_decode( $_POST['data'], true ) : false;
            unset($data['id']);
            $this->load->model("common_model");
            if ( $this->common_model->getOne(TABLE_SYSTEM_USER,'userId',$data['userId']) ){
                $result['msg'] = '用户ID['.$data['userId'].']已经被注册';
                $result['status'] = 'ERROR';
            } else if ( $this->common_model->getOne(TABLE_SYSTEM_USER,'mobileNo',$data['mobileNo']) ) {
                $result['msg'] = '手机号码['.$data['mobileNo'].']已经被注册';
                $result['status'] = 'ERROR';
            } else {
                $data['makeTime'] = date_format(date_create(), 'Y-m-d H:i:s');
                $id = $this->common_model->save(TABLE_SYSTEM_USER, $data);
                
                $this->load->model('system_model');
                $this->system_model->recordSystemUserHis($id, 1, $uid);
            
                $result['status'] = 'OK';
            }
        } else {
             $result['status'] = 'ERROR';
             $result['msg'] = '请先登录再操作';
        }
        $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($result));
    }
    function update_user(){
        $uid = $this->session->userdata('user.id');
        if ($uid) {
            $data = isset($_POST['data']) ? json_decode( $_POST['data'], true ) : false;
            $id = $data['id'];
            unset($data['id']);
            unset($data['makeType']);
            unset($data['encryptedPass']);
            $this->load->model("common_model");
            if ( $this->common_model->getOne(TABLE_SYSTEM_USER,'userId',$data['userId'], $id) ){
                $result['msg'] = '用户ID['.$data['userId'].']已经被注册';
                $result['status'] = 'ERROR';
            } else if ( $this->common_model->getOne(TABLE_SYSTEM_USER,'mobileNo',$data['mobileNo'], $id) ) {
                $result['msg'] = '手机号码['.$data['mobileNo'].']已经被注册';
                $result['status'] = 'ERROR';
            } else {
                $this->common_model->update ( TABLE_SYSTEM_USER, $data, $id );
                
                $this->load->model('system_model');
                $this->system_model->recordSystemUserHis($id, 2, $uid);
                
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

    function destroy_user(){
        $uid = $this->session->userdata('user.id');
        if ($uid) {
            $id = isset($_POST['id']) ? $_POST['id'] : false;
            if ( $id ) {
                $this->load->model('system_model');
                $this->system_model->recordSystemUserHis($id, 3, $uid);
                
                $this->load->model('common_model');
                $this->common_model->delete(TABLE_SYSTEM_USER,'id',$id);
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

    function save_new_password(){
        $uid = $this->session->userdata('user.id');
        if ($uid) {
            $data = isset($_POST['data']) ? json_decode( $_POST['data'], true ) : false;
            $id = $data['id'];
            unset($data['id']);
            $this->load->model("common_model");
            $this->common_model->update ( TABLE_SYSTEM_USER, $data, $id );
            
            $this->load->model('system_model');
            $this->system_model->recordSystemUserHis($id, 4, $uid);
                
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

    function system_menu_rights(){
        $this->load->view("rights/system_menu_rights");
    }
    function system_role(){
        $this->load->model('system_model');
        $data['allMenus'] = $this->system_model->get_menu_rights_list();
        $this->load->view("rights/system_role", $data);
    }
    function system_user(){
        $this->load->model('system_model');
        $codeNames = array('makeType','custType');
        $codes = $this->system_model->selectSomeSystemCode($codeNames);
        $data['codes'] = json_encode($codes, JSON_FORCE_OBJECT);
        $this->load->view("rights/system_user", $data);
    }
    function get_menu_rights_list(){
        $this->load->model('system_model');
        $data = $this->system_model->get_menu_rights_list();
        $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($data));
    }
    function get_role_list(){
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $offset = ($page - 1 ) * $rows;
        
        $this->load->model("common_model");
        $result = $this->common_model->get_select_result(TABLE_SYSTEM_ROLE, array(), 'id desc', $offset, $rows);
        $this->output
            ->set_content_type("application/json")
            ->set_output( json_encode( $result));
    }
    function get_user_list(){
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $offset = ($page - 1 ) * $rows;
        
        $this->load->model("common_model");
        $result = $this->common_model->get_select_result(TABLE_SYSTEM_USER, array(), 'id desc', $offset, $rows);
        $this->output
            ->set_content_type("application/json")
            ->set_output( json_encode( $result));
    }
    function get_role_rights_list(){
        $roleId = isset($_POST['roleId']) ? intval($_POST['roleId']) : 0;
        $this->load->model("common_model");
        $result = $this->common_model->get_select_result(TABLE_ROLE_MENU_RIGHTS, array('roleId'=>$roleId), 'id desc');
        $this->output
            ->set_content_type("application/json")
            ->set_output( json_encode( $result));
    }
    function commit_menu_rights(){
        $updated = isset($_POST['updated']) ? json_decode( $_POST['updated'], true ) : false;
        $deleted = isset($_POST['deleted']) ? json_decode( $_POST['deleted'], true ) : false;
        
        $this->load->model('system_model');
        if ( $updated ) {
            $this->system_model->updateMenuRights($updated);
        }
        if ( $deleted ) {
            $this->system_model->deleteMenuRights($deleted);
        }
        
        $result['status'] = 'OK';
        $this->output
            ->set_content_type("application/json")
            ->set_output( json_encode( $result));
    }
    function commit_role(){
        $inserted = isset($_POST['inserted']) ? json_decode( $_POST['inserted'], true ) : false;
        $updated = isset($_POST['updated']) ? json_decode( $_POST['updated'], true ) : false;
        $deleted = isset($_POST['deleted']) ? json_decode( $_POST['deleted'], true ) : false;
        
        $this->load->model('common_model');
        if ( $inserted ) {
            $this->common_model->insertItems(TABLE_SYSTEM_ROLE, $inserted);
        }
        if ( $updated ) {
            $this->common_model->updateItems(TABLE_SYSTEM_ROLE, $updated, 'id');
        }
        if ( $deleted ) {
            $this->common_model->deleteItems(TABLE_SYSTEM_ROLE, $deleted, 'id');
        }
        
        $result['status'] = 'OK';
        $this->output
            ->set_content_type("application/json")
            ->set_output( json_encode( $result));
    }
    function commit_role_rights(){
        $inserted = isset($_POST['inserted']) ? json_decode( $_POST['inserted'], true ) : false;
        $updated = isset($_POST['updated']) ? json_decode( $_POST['updated'], true ) : false;
        $deleted = isset($_POST['deleted']) ? json_decode( $_POST['deleted'], true ) : false;
        
        $this->load->model('system_model');
        if ( $inserted ) {
            $this->system_model->insertRoleRights($inserted);
        }
        if ( $updated ) {
            $this->system_model->updateRoleRights($updated);
        }
        if ( $deleted ) {
            $this->load->model('common_model');
            $this->common_model->deleteItems(TABLE_ROLE_MENU_RIGHTS, $deleted, 'id');
        }
        
        $result['status'] = 'OK';
        $this->output
            ->set_content_type("application/json")
            ->set_output( json_encode( $result));
    }
    
    function test_code(){
        $this->load->model('system_model');
        $codeNames = array('makeType','custType');
        $data = $this->system_model->selectSomeSystemCode($codeNames);
        print_r($data);
        echo "<br>".json_encode($data, JSON_FORCE_OBJECT);
    }
    function get_user_role(){
        $userId = isset($_POST['userId']) ? intval($_POST['userId']) : 0;
        $this->load->model('system_model');
        $list = $this->system_model->get_user_role($userId);
        $result['rows'] = $list ;
        $this->output
            ->set_content_type("application/json")
            ->set_output( json_encode( $result));
    }
    function commit_user_role_rights(){
        $inserted = isset($_POST['inserted']) ? json_decode( $_POST['inserted'], true ) : false;
        $deleted = isset($_POST['deleted']) ? json_decode( $_POST['deleted'], true ) : false;
        if ( $inserted ) {
            $this->load->model('system_model');
            $this->system_model->insertUserRoleRights($inserted);
        }
        if ( $deleted ) {
            $this->load->model('common_model');
            $this->common_model->deleteItems(TABLE_SYSTEM_USER_ROLE, $deleted, 'id');
        }
        
        $result['status'] = 'OK';
        $this->output
            ->set_content_type("application/json")
            ->set_output( json_encode( $result));
    }
}