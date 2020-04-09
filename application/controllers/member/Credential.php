<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Credential extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model');
    }

    public function index() {
        $this->load->view('member/login');
    }

    public function prosesLogin() {
        $username = preg_replace('/[^A-Za-z0-9]/', '', $this->input->post('username'));
        $password = $this->input->post('password');

        $where = array('username_member' => $username);
        $informasi_member = $this->model->getDataWhere('member', $where);

        if($informasi_member == '') {
            echo json_encode('username tidak ada');
            die();
        }
        elseif(!password_verify($password, $informasi_member['password_member'])) {
            echo json_encode('password salah');
            die();
        }
        else {
            $this->session->set_userdata('bbcourse_username_member', $informasi_member['username_member']);
            echo json_encode('berhasil');
        }
    }

    public function gantiPassword() {
        $lama = $this->input->post('password_lama');
        $baru = $this->input->post('password_baru');
        $konfirmasi = $this->input->post('konfirmasi_password');
        
        if($lama == '' || $baru == '' || $konfirmasi == '') {
            $return['type'] = 'error';
            $return['message'] = 'Data tidak lengkap.';
            echo json_encode($return);
            die();
        }
        elseif(strlen($baru) < 8) {
            $return['type'] = 'error';
            $return['message'] = 'Password baru minimal terdiri dari 8 karakter.';
            echo json_encode($return);
            die();
        }
        elseif($konfirmasi != $baru) {
            $return['type'] = 'error';
            $return['message'] = 'Konfirmasi password baru tidak sesuai.';
            echo json_encode($return);
            die();
        }
        
        $where = array('username_member' => $this->session->bbcourse_username_member);
        $informasi_member = $this->model->getDataWhere('member', $where);
        
        if(!password_verify($lama, $informasi_member['password_member'])) {
            $return['type'] = 'error';
            $return['message'] = 'Password salah.';
            echo json_encode($return);
            die();
        }
        
        $data = array('password_member' => password_hash($baru, PASSWORD_DEFAULT));
        $this->model->updateData('member', $where, $data);
        
        $return['type'] = 'success';
        $return['message'] = 'Berhasil mengubah password.';
        echo json_encode($return);
    }
    
    public function logout() {
        session_destroy();
        redirect(base_url('member'));
    }
}