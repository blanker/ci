<?php
/**
 * Created by JetBrains PhpStorm.
 * User: blank
 * Date: 13-7-26
 * Time: 上午12:42
 * To change this template use File | Settings | File Templates.
 */
class Test extends CI_Controller{
    function index(){
        //$this->load->model("test_model");
        //$data['records'] = $this->test_model->getTruckInfo();
        //$this->load->view("test", $data);
        $t = '1376584988077';
		echo $t.'<br/>';
        echo date('Y-m-d H:i:s', substr($t,0,10));
        phpinfo();
    }
}