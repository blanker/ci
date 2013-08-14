<?php
class Jquery extends CI_Controller{
	
	function test_jquery(){
		$data["content"] = "test_jquery";
		$this->load->view("includes/template", $data);
	}
	
	function test_jquery_click(){
		echo "good job.";
	}
	
	function click(){
		$data['name'] = $this->input->get("name");
		$this->output
			->set_content_type("text/json")
			->set_output( json_encode( $data));
		//echo IS_AJAX;
	}

    function test(){
        echo "<pre>";
        print_r($_REQUEST);
        //print_r($GLOBALS);
        //print_r($HTTP_SERVER_VARS);
        //print_r($_ENV);
        //print_r($this);
        print_r($_SERVER);
        echo "</pre>";
        $this->load->view("");
        $this->load->model("");
        //$this->load
        //$this->load->
        //$this->load->
    }
    
    
}