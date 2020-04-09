<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Credential extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model');
    }

    public function index() {
        $this->load->view('admin/login');
    }

    public function prosesLogin() {
        $username = preg_replace('/[^A-Za-z0-9]/', '', $this->input->post('username'));
        $password = $this->input->post('password');

        $where = array('username_admin' => $username);
        $informasi_admin = $this->model->getDataWhere('admin', $where);

        if($informasi_admin == '') {
            echo json_encode('username tidak ada');
            die();
        }
        elseif(!password_verify($password, $informasi_admin['password_admin'])) {
            echo json_encode('password salah');
            die();
        }
        else {
            $this->session->set_userdata('bbcourse_username_admin', $informasi_admin['username_admin']);
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
        
        $where = array('username_admin' => $this->session->bbcourse_username_admin);
        $informasi_admin = $this->model->getDataWhere('admin', $where);
        
        if(!password_verify($lama, $informasi_admin['password_admin'])) {
            $return['type'] = 'error';
            $return['message'] = 'Password salah.';
            echo json_encode($return);
            die();
        }
        
        $data = array('password_admin' => password_hash($baru, PASSWORD_DEFAULT));
        $this->model->updateData('admin', $where, $data);
        
        $return['type'] = 'success';
        $return['message'] = 'Berhasil mengubah password.';
        echo json_encode($return);
    }
    
    public function logout() {
        session_destroy();
        redirect(base_url('admin'));
    }
}