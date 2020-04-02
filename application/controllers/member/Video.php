<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model');
    }


    /** 
     * Section ini adalah fungsi untuk menampilkan view 
     */

    public function index() {
        if(!$this->isLogin()) {
            redirect('member');
        }
        else {
            $this->load->view('member/video');
        }
    }

    public function content($id) {
        if(!$this->isLogin()) {
            redirect('member');
        }
        else {
            $id = preg_replace('/[^0-9]/', '', $id);
            $where = array('id_video_paket' => $id);
            $data['video'] = $this->model->getDataWhere('video_paket', $where);
            $data['content'] = $this->model->getAllDataWhere('video_isi', $where);

            $where = array('username_member' => $this->session->bullbear_username_member, 'id_video_paket' => $id);
            $data['is_owner'] = ($this->model->getDataWhere('member_paket', $where) == '') ? false : true;

            $transaksi = $this->model->getDataWhere('transaksi', $where);
            $data['is_pending'] = ($transaksi['status_verifikasi'] == 'pending') ? true : false;

            if($data['video'] == '') {
                redirect(base_url('member'));
            }
            else {
                $this->load->view('member/content', $data);
            }
        }
    }


    /** 
     * Section ini adalah fungsi untuk pengolahan data
     * Fungsi ini akan diakses client melalui ajax
     */

    public function getList() {
        if(!$this->isLogin()) {
            echo json_encode('User not authorized');
            die();
        }
        else {
            $sort = preg_replace('/[^a-z]/', '', $this->input->post('sort'));
            $search = preg_replace('/[^a-zA-Z0-9 ]/', '', $this->input->post('search'));
            $is_owner = preg_replace('/[^a-z]/', '', $this->input->post('is_owner'));
            
            $data = $this->model->getContent($search, $sort, $is_owner);
            
            if($data != '') {
                for($i=0; $i<count($data); $i++) {
                    $data[$i]['thumbnail_paket'] = base_url('course/thumbnail/') . $data[$i]['thumbnail_paket'];
                }
            }
            else $data = [];

            echo json_encode($data);
        }
    }


    /**
     * Section ini khusus untuk private function
     */

    private function isLogin() {
        if($this->session->bullbear_username_member != '')
            return true;
        else 
            return false;
    }
}