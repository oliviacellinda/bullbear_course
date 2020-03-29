<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\CodeigniterAdapter;

class Transaksi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model');
    }


    /** 
     * Section ini adalah fungsi untuk menampilkan view 
     */

    public function index() {
        if(!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        else {
            $this->load->view('admin/transaksi/list');
        }
    }

    public function tambah() {
        if(!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        else {
            $this->load->view('admin/transaksi/form');
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
            $datatables = new Datatables(new CodeigniterAdapter);
            $query = 'SELECT `invoice`, `username_member`, `tanggal_transaksi`, `status_verifikasi`, `total_pembelian` FROM `transaksi`';
            $datatables->query($query);
            echo $datatables->generate();
        }
    }

    public function getDetail() {
        if(!$this->isLogin()) {
            echo json_encode('User not authorized');
            die();
        }

        $invoice = preg_replace('/[^a-zA-Z0-9_]/', '', $this->input->post('invoice'));

        $where = array('invoice' => $invoice);
        $transaksi = $this->model->getDataWhere('transaksi', $where);

        if($transaksi == '') {
            $return['type'] = 'error';
            $return['message'] = 'Transaksi tidak ditemukan.';
            echo json_encode($return);
            die();
        }

        $where = array('id_video_paket' => $transaksi['id_paket']);
        $paket = $this->model->getDataWhere('video_paket', $where);

        $where = array('username_member' => $transaksi['username_member']);
        $member = $this->model->getDataWhere('member', $where);

        $return['type'] = 'success';
        $return['transaksi'] = $transaksi;
        $return['paket'] = $paket;
        $return['member'] = $member;
        echo json_encode($return);
    }


    /**
     * Section ini khusus untuk private function
     */

    private function isLogin() {
        if($this->session->bullbear_username_admin != '')
            return true;
        else 
            return false;
    }
}