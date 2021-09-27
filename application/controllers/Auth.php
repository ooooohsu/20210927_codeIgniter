<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public $redis;

    function __construct() {
        parent::__construct();
    }

    function index(){
        $this->login();
    }

    //로그인 - 이메일 입력 화면
    function login() {
    	var_dump("auth");
    }
}
