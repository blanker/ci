<?php
class Download extends CI_Controller{
    function client($date){
        //echo BASEPATH.$date;
        //$this->load->helper('file');
        $this->load->helper('download');
        
        $name = "com.anda.driver.location_".$date.".apk";
        //echo "./download/".$name;
        //echo "<br/>";
        //print_r (get_file_info(BASEPATH."../download/".$name) );
        $data = file_get_contents(BASEPATH."../download/".$name); // 读文件内容
        //$name = 'myphoto.jpg';
        force_download($name, $data);
    }
}