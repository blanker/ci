<?php
class System extends CI_Controller{
    function __construct(){
        parent::__construct();
        //$this->load->library('session');
    }
    
    function menu_list(){
        $this->load->view("manager/menu_list");
    }
    function code_list(){
        $this->load->view("manager/code_list");
    }
    
    function get_menu_list(){
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $offset = ($page - 1 ) * $rows;
        
        $this->load->model("common_model");
        $result = $this->common_model->get_select_result(TABLE_SYSTEM_MENU, array(), 'sortNum', $offset, $rows);
        $this->output
            ->set_content_type("application/json")
            ->set_output( json_encode( $result));
    }
    function get_code_list(){
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $offset = ($page - 1 ) * $rows;
        
        $likeFilter = array();
        if ( isset($_POST['codeName']) && $_POST['codeName']  ){
            $likeFilter['codeName'] = $_POST['codeName'];
        }        
        if ( isset($_POST['codeText']) && $_POST['codeText']  ){
            $likeFilter['codeText'] = $_POST['codeText'];
        }
        $filter = array();
        if ( isset($_POST['codeValue']) && $_POST['codeValue'] ){
            $filter['codeValue'] = $_POST['codeValue'];
        }
        if ( isset($_POST['codeStartDate']) && $_POST['codeStartDate'] ){
            $filter[] = 'date(create_time) >= \''.$_POST['codeStartDate'].'\'';
        }
        if ( isset($_POST['codeEndDate']) && $_POST['codeEndDate'] ){
            $filter[] = 'date(create_time) <= \''.$_POST['codeEndDate'].'\'';
        }
        
        $this->load->model("common_model");
        $result = $this->common_model->get_select_result(TABLE_SYSTEM_CODE, $filter, 'codeName,sortNum', $offset, $rows, $likeFilter);
        
        $this->output
            ->set_content_type("application/json")
            ->set_output( json_encode( $result));
    }
    
    function commit_menu(){
        $inserted = isset($_POST['inserted']) ? json_decode( $_POST['inserted'], true ) : false;
        $updated = isset($_POST['updated']) ? json_decode( $_POST['updated'], true ) : false;
        $deleted = isset($_POST['deleted']) ? json_decode( $_POST['deleted'], true ) : false;
        
        $this->load->model('system_model');
        if ( $inserted ) {
            $this->system_model->insertMenus($inserted);
        }
        if ( $updated ) {
            $this->system_model->updateMenus($updated);
        }
        if ( $deleted ) {
            $this->system_model->deleteMenus($deleted);
        }
        
        $result['status'] = 'OK';
        $this->output
            ->set_content_type("application/json")
            ->set_output( json_encode( $result));
    }
    function commit_code(){
        $inserted = isset($_POST['inserted']) ? json_decode( $_POST['inserted'], true ) : false;
        $updated = isset($_POST['updated']) ? json_decode( $_POST['updated'], true ) : false;
        $deleted = isset($_POST['deleted']) ? json_decode( $_POST['deleted'], true ) : false;
        
        $this->load->model('system_model');
        if ( $inserted ) {
            $this->system_model->insertCodes($inserted);
        }
        if ( $updated ) {
            $this->system_model->updateCodes($updated);
        }
        if ( $deleted ) {
            $this->system_model->deleteCodes($deleted);
        }
        
        $result['status'] = 'OK';
        $this->output
            ->set_content_type("application/json")
            ->set_output( json_encode( $result));
    }
}
