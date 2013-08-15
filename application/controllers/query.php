<?php
class Query extends CI_Controller{
    function freight(){
        $this->_queryInfo(TABLE_FREIGHT_SOURCE);
    }
    
    function truck_info(){
        $a = $this->input->get('a');
        $ao = json_decode( urldecode($a) );
        
        $this->load->model('query_model');
        $result = $this->query_model->queryTruckAndLocation($ao);
        $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode($result));
    }
    
    function _queryInfo( $table ){
        $a = $this->input->get('a');
        $ao = json_decode( urldecode($a) );
        
        $this->load->model('query_model');
        $result = $this->query_model->queryByFilter($ao, $table);
        $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode($result));
    }
    /*private long [] ids;
    private Map<String, String> map;
    private List<SqlFilter> list;
    */
}
