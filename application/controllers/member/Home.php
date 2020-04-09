<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model');
    }

    public function index() {
        if(!$this->isLogin()) {
            redirect(base_url('member'));
        }
        else {
            $this->load->view('member/home');
        }
    }

    private function isLogin() {
        if($this->session->bbcourse_username_member != '')
            return true;
        else 
            return false;
    }

}