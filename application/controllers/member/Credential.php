<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Credential extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model');
    }

    public function index() {
        if($this->isLogin()) {
            redirect(base_url('member/home'));
        }
        else {
            $this->load->view('member/login');
        }
    }

    public function register() {
        if($this->isLogin()) {
            redirect(base_url('member/home'));
        }
        else {
            $this->load->view('member/register');
        }
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

    public function prosesRegister() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $name = $this->input->post('name');

        if($username == '' || $password == '' || $email == '' || $name == '') {
            $return['type'] = 'error';
            $return['message'] = 'Data is not complete.';
            echo json_encode($return);
            die();
        }

        if(!ctype_alnum($username)) {
            $return['type'] = 'error';
            $return['message'] = 'Username can only contain letters and numbers.';
            echo json_encode($return);
            die();
        }

        if(strlen($password) < 8) {
            $return['type'] = 'error';
            $return['message'] = 'The minimum length of password is 8 characters.';
            echo json_encode($return);
            die();
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $return['type'] = 'error';
            $return['message'] = 'Invalid email format.';
            echo json_encode($return);
            die();
        }

        if (!preg_match("/^[a-zA-Z ]/", $name)) {
            $return['type'] = 'error';
            $return['message'] = 'Name can only contain letters and white space.';
            echo json_encode($return);
            die();
        }

        $username = trim($username);
        $password = trim($password);
        $email = trim($email);
        $name = trim($name);

        $where = array('username_member' => $username);
        $informasi_member = $this->model->getDataWhere('member', $where);
        if($informasi_member != '') {
            $return['type'] = 'error';
            $return['message'] = 'Username is already used.';
            echo json_encode($return);
            die();
        }

        $where = array('email_member' => $email);
        $informasi_member = $this->model->getDataWhere('member', $where);
        if($informasi_member != '') {
            $return['type'] = 'error';
            $return['message'] = 'Email is already used.';
            echo json_encode($return);
            die();
        }

        $data = array(
            'username_member'   => $username,
            'password_member'   => password_hash($password, PASSWORD_DEFAULT),
            'nama_member'       => $name,
            'email_member'      => $email,
        );
        $this->model->insertData('member', $data);

        $this->session->set_userdata('bbcourse_username_member', $username);
        $return['type'] = 'success';
        echo json_encode($return);
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

    private function isLogin() {
        if($this->session->bbcourse_username_member != '')
            return true;
        else 
            return false;
    }
}