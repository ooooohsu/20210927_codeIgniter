<?php

class Main extends  CI_Controller
{
	function __construct(){
		parent::__construct();
	}

	function index(){
		$this->main();
	}

	function main(){
		$this->load->view('user/main');
	}

}
