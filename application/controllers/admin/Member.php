<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\CodeigniterAdapter;

class Member extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model');
    }

    public function index() {
        if(!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        else {
            $this->load->view('admin/user/list');
        }
    }

    public function getList() {
        if(!$this->isLogin()) {
            echo json_encode('User not authorized');
            die();
        }
        else {
            $datatables = new Datatables(new CodeigniterAdapter);
            $query = 'SELECT `username_member`, `nama_member`, `email_member` FROM `member`';
            $datatables->query($query);
            echo $datatables->generate();
        }
    }

    public function resetPassword() {
        $return = array();

        if(!$this->isLogin()) {
            $return['type'] = 'forbidden';
            $return['message'] = 'User not authorized';
            echo json_encode($return);
            die();
        }

        $username = preg_replace('/[^A-Za-z0-9]/', '', $this->input->post('username'));
        $password = password_hash('12345678', PASSWORD_DEFAULT);
        
        $where = array('username_member' => $username);
        $informasi_member = $this->model->getDataWhere('member', $where);

        if($informasi_member == '') {
            $return['type'] = 'error';
            $return['message'] = 'Data member tidak ditemukan.';
            echo json_encode($return);
            die();
        }
        else {
            $data = array('password_member' => $password);
            $this->model->updateData('member', $where, $data);
            $return['type'] = 'success';
            $return['message'] = 'Berhasil mereset password member.';
            echo json_encode($return);
        }
    }

    private function isLogin() {
        if($this->session->bullbear_username_admin != '')
            return true;
        else 
            return false;
    }
}