<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("Auth_model");
    }

    function index(){
        $this->login();
    }

    function login() {
    	$this->load->view('user/login');
    }

	function join() {
		$this->load->view('user/join');
	}

	function ajax_mailCheck(){
    	$email = $this->input->post("email",true);
    	$res = $this->Auth_model->get_member_info($email);
		header('Content-Type: application/json');
    	if(empty($res)){
			echo json_encode(array("code"=>"success"));
		}else{
			echo json_encode(array("code"=>"fail"));
		}
	}

	function new(){
		foreach ($this->input->post(NULL, TRUE) as $key=>$value){
			$data["{$key}"] = $value;
		}

		if(!isset($data["email2"])){
			$data["email2"] = $data["email2_2"];
		}

		$data["email"] = $data["email1"]."@".$data["email2"];

		unset($data["email1"]);
		unset($data["email2"]);
		unset($data["email2_2"]);

		$data["created_at"] = date();

		var_dump($data);

		$result =  $this->Auth_model->insert_member($data);

		var_dump($result);

	}
}
