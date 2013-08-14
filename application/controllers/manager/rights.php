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
            $this->common_model->save(TABLE_SYSTEM_USER, $systemUser);
            $data['status'] = 'OK';
        }
        
        $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($data));
    }
}