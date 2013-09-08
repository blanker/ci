<?php
class Home extends CI_Controller{
     function __construct() {
        parent::__construct();
        //$this->load->library('session');
     }
    
    function index(){
        $uid = $this->session->userdata('user.id');
        if (!$uid) {
            redirect('welcome/index');
        }
        $this->load->model('system_model');
        $data['menu'] = $this->system_model->getUserMenu($uid);
        $this->load->view('manager/home', $data);
    }
    
    function login_check(){
        $userId = $this->input->post('userId');
        $encryptedPassword = $this->input->post('encryptedPassword');
        $result['status'] = 'OK';
        
        try {
            $this->load->model('system_model');
            $systemUser = $this->system_model->getSystemUser($userId);
            
            if ($systemUser ) {
                if ( strtoupper($systemUser->encryptedPass) === strtoupper($encryptedPassword) ) {
                    //$result['data'] = $systemUser;
                    $newdata = array(
                        'user.userId' => $systemUser->userId,
                        'user.encryptedPassword' => $systemUser->encryptedPass,
                        'user.mobileNo' => $systemUser->mobileNo,
                        'user.userName' => $systemUser->userName,
                        'user.custType' => $systemUser->custType,
                        'user.makeType' => $systemUser->makeType,
                        'user.id' => $systemUser->id,
                    );
                    $this->session->set_userdata($newdata);
                } else {
                    $result['status'] = 'ERROR1';
                    $result['msg'] = '用户名或手机号['.$userId.']的密码错误';
                }
            } else {
                $result['status'] = 'ERROR2';
                $result['msg'] = '用户名或手机号['.$userId.']不存在';
            }
        } catch (Exception $e){
            $result['status'] = 'ERROR3';
            $result['msg'] = $e->getMessage();
        }
            
        $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode($result));
    }
}
