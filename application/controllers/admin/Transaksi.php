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

        $where = array('id_video_paket' => $transaksi['id_video_paket']);
        $paket = $this->model->getDataWhere('video_paket', $where);

        $where = array('username_member' => $transaksi['username_member']);
        $member = $this->model->getDataWhere('member', $where);

        $return['type'] = 'success';
        $return['transaksi'] = $transaksi;
        $return['paket'] = $paket;
        $return['member'] = $member;
        echo json_encode($return);
    }

    public function addTransaksi() {
        if(!$this->isLogin()) {
            echo json_encode('User not authorized');
            die();
        }

        $username = preg_replace('/[^a-zA-Z0-9]/', '', $this->input->post('username'));
        $paket = preg_replace('/[^0-9]/', '', $this->input->post('paket'));

        $member = $this->model->getDataWhere('member', ['username_member' => $username]);
        $video_paket = $this->model->getDataWhere('video_paket', ['id_video_paket' => $paket]);

        $where = array(
            'username_member'   => $username,
            'id_video_paket'    => $paket,
        );
        $member_paket = $this->model->getDataWhere('member_paket', $where);

        if($member == '') {
            $return['type'] = 'error';
            $return['message'] = 'Member tidak ditemukan.';
            echo json_encode($return);
            die();
        }
        elseif($video_paket == '') {
            $return['type'] = 'error';
            $return['message'] = 'Paket tidak ditemukan.';
            echo json_encode($return);
            die();
        }
        elseif($member_paket != '') {
            $return['type'] = 'error';
            $return['message'] = 'Member telah memiliki paket ini.';
            echo json_encode($return);
            die();
        }
        else {
            $data = array(
                'invoice'           => "bbcourse_$username" . "_" . $paket . "_" . date('YmdHis'),
                'username_member'   => $username,
                'id_video_paket'    => $paket,
                'tanggal_transaksi' => date('Y-m-d H:i:s'),
                'tanggal_verifikasi'=> date('Y-m-d H:i:s'),
                'status_verifikasi' => 'verified',
                'total_pembelian'   => $video_paket['harga_paket'],
                'sumber_pembayaran' => 'manual',
            );
            $this->model->insertData('transaksi', $data);

            $data = array(
                'username_member'   => $username,
                'id_video_paket'    => $paket,
            );
            $this->model->insertData('member_paket', $data);

            $return['type'] = 'success';
            $return['message'] = 'Transaksi berhasil disimpan.';
            echo json_encode($return);
            die();
        }
    }


    /**
     * Section ini khusus untuk private function
     */

    private function isLogin() {
        if($this->session->bbcourse_username_admin != '')
            return true;
        else 
            return false;
    }
}