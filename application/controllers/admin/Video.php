<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\CodeigniterAdapter;

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
            redirect(base_url('admin'));
        }
        else {
            $this->load->view('admin/video/list');
        }
    }

    public function tambah() {
        if(!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        else {
            $this->load->view('admin/video/form');
        }
    }

    public function detail($id) {
        if(!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        else {
            $where = array('id_video_paket' => $id);
            $data['video'] = $this->model->getDataWhere('video_paket', $where);

            if($data['video'] == '') {
                redirect(base_url('admin'));
            }
            else {
                $this->load->view('admin/video/detail', $data);
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
            // Jika request dari DataTable
            if($this->input->post('draw')) {
                $datatables = new Datatables(new CodeigniterAdapter);
                $query = 'SELECT `id_video_paket`, `nama_paket`, `harga_paket`, `tanggal_dibuat` FROM `video_paket`';
                $datatables->query($query);
                echo $datatables->generate();
            }
            else {
                $data = $this->model->getAllData('video_paket');
                echo json_encode($data);
            }
        }
    }

    public function getContent($id) {
        if(!$this->isLogin()) {
            echo json_encode('User not authorized');
            die();
        }
        else {
            $id = preg_replace('/[^0-9]/', '', $id);
            $where = array('id_video_paket' => $id);
            $isi = $this->model->getDataWhereOrderBy('video_isi', $where, 'urutan ASC');
            echo json_encode(($isi == '') ? [] : $isi);
        }
    }

    public function addPaket() {
        if(!$this->isLogin()) {
            echo json_encode('User not authorized');
            die();
        }

        $data = $this->getDataVideo('tambah');

        if($data['type'] === 'error') {
            echo json_encode($data);
            die();
        }
        elseif($data['type'] === 'success') {
            $this->model->insertData('video_paket', $data['data']);

            $return['type'] = 'success';
            $return['message'] = base_url('admin/video/detail/') . $this->db->insert_id();
            echo json_encode($return);
        }
    }

    public function editPaket() {
        if(!$this->isLogin()) {
            echo json_encode('User not authorized');
            die();
        }

        $id = preg_replace('/[^0-9]/', '', $this->input->post('id'));
        $where = array('id_video_paket' => $id);
        $informasi_video = $this->model->getDataWhere('video_paket', $where);

        if($informasi_video == '') {
            $return['type'] = 'error';
            $return['message'] = 'Data paket video tidak ditemukan.';
            echo json_encode($return);
            die();
        }

        $data = $this->getDataVideo('edit');

        if($data['type'] === 'error') {
            echo json_encode($data);
            die();
        }
        else {
            // Hapus thumbnail lama jika ada thumbnail baru
            if($data['data']['thumbnail_paket'] != '') {
                $path = './course/thumbnail/' . $informasi_video['thumbnail_paket'];
                if( file_exists($path) ) {
                    unlink($path);
                }
            }
            else {
                unset($data['data']['thumbnail_paket']);
            }

            $this->model->updateData('video_paket', $where, $data['data']);

            $return['type'] = 'success';
            $this->session->set_flashdata('type', 'success');
            $this->session->set_flashdata('message', 'Berhasil mengedit data.');
            echo json_encode($return);
        }
    }

    public function addContent() {
        if(!$this->isLogin()) {
            echo json_encode('User not authorized');
            die();
        }

        $id = preg_replace('/[^0-9]/', '', $this->input->post('id'));
        $judul = trim($this->input->post('judul'));
        $judul = htmlspecialchars(strip_tags($judul), ENT_QUOTES);
        $durasi = trim($this->input->post('durasi'));

        if($id == '' || $judul == '' || $durasi == '') {
            $return['type'] = 'error';
            $return['message'] = 'Data tidak lengkap.';
            echo json_encode($return);
            die();
        }
        elseif($this->model->getDataWhere('video_paket', array('id_video_paket' => $id)) == '') {
            $return['type'] = 'error';
            $return['message'] = 'Data paket video tidak ditemukan.';
            echo json_encode($return);
            die();
        }

        if( !file_exists('./course/content/'.$id) ) {
            mkdir('./course/content/'.$id, 0777);
        }

        $this->lang->load('upload', 'indonesia');
        $this->config->set_item('language', 'indonesia');

		$config['upload_path']		= './course/content/'.$id;
		$config['allowed_types']	= 'mp4';
		$config['file_ext_tolower']	= true;
		$config['overwrite']		= false;
		$config['remove_spaces']	= true;
        $this->load->library('upload', $config);

        $video = '';
        if( !$this->upload->do_upload('video') ) {
            $return['type'] = 'error';
            $return['message'] = $this->upload->display_errors();
            echo json_encode($return);
            die();
        }
        else {
            $upload_data = $this->upload->data();
            $video = $upload_data['file_name'];
        }

        $where = "urutan = (SELECT MAX(urutan) FROM video_isi)";
        $latest = $this->model->getDataWhere('video_isi', $where);

        $data = array(
            'id_video_paket'=> $id,
            'urutan'        => $latest['urutan'] + 1,
            'nama_video'    => $judul,
            'file_video'    => $video,
            'durasi_video'  => $durasi,
        );
        $this->model->insertData('video_isi', $data);

        $return['type'] = 'success';
        $return['message'] = 'Berhasil menyimpan data.';
        echo json_encode($return);
    }

    public function deleteContent() {
        if(!$this->isLogin()) {
            echo json_encode('User not authorized');
            die();
        }

        $id = preg_replace('/[^0-9]/', '', $this->input->post('id'));
        $where = array('id_video' => $id);
        $informasi_video = $this->model->getDataWhere('video_isi', $where);

        if($informasi_video == '') {
            $return['type'] = 'error';
            $return['message'] = 'Data tidak ditemukan.';
            echo json_encode($return);
            die();
        }

        $path = './course/content/' . $informasi_video['id_video_paket'] . '/' . $informasi_video['file_video'];
        if( file_exists($path) ) {
            unlink($path);

            $this->model->deleteData('video_isi', $where);

            $list_lama = $this->model->getAllDataWhere('video_isi', 'urutan > '.$informasi_video['urutan']);
            if($list_lama != '') {
                for($i=0; $i<count($list_lama); $i++) {
                    $data = ['urutan' => $list_lama[$i]['urutan'] - 1];
                    $where = ['id_video' => $list_lama[$i]['id_video']];
                    $this->model->updateData('video_isi', $where, $data);
                }
            }

            $return['type'] = 'success';
            $return['message'] = 'Berhasil menghapus data.';
            echo json_encode($return);
        }
        else {
            $return['type'] = 'error';
            $return['message'] = 'Gagal menghapus data.';
            echo json_encode($return);
        }
    }

    public function updateContentOrder() {
        if(!$this->isLogin()) {
            echo json_encode('User not authorized');
            die();
        }
        else {
            $id = preg_replace('/[^0-9]/', '', $this->input->post('id'));
            $list = json_decode($this->input->post('list'));
            for($i=0; $i<count($list); $i++) $list[$i] = preg_replace('/[^0-9]/', '', $list[$i]);

            $paket = $this->model->getDataWhere('video_paket', ['id_video_paket' => $id]);
            if($paket == '') {
                $return['type'] = 'error';
                $return['message'] = 'Data paket video tidak ditemukan.';
                echo json_encode($return);
                die();
            }

            $konten = $this->model->getAllDataWhere('video_isi', ['id_video_paket' => $id]);
            if($konten == '') {
                $return['type'] = 'error';
                $return['message'] = 'Data isi paket video tidak ditemukan.';
                echo json_encode($return);
                die();
            }

            $konten_id = array_column($konten, 'id_video');
            if(count($list) != count($konten_id)) {
                $return['type'] = 'error';
                $return['message'] = 'Data isi paket video tidak sesuai.';
                echo json_encode($return);
                die();
            }
            for($i=0; $i<count($list); $i++) {
                if(!in_array($list[$i], $konten_id)) {
                    $return['type'] = 'error';
                    $return['message'] = 'Data isi paket video tidak sesuai.';
                    echo json_encode($return);
                    die();
                }
            }

            for($i=0; $i<count($list); $i++) {
                $data = ['urutan' => $i+1];
                $where = ['id_video' => $list[$i]];
                $this->model->updateData('video_isi', $where, $data);
            }
            $return['type'] = 'success';
            $return['message'] = 'Urutan video berhasil diubah.';
            echo json_encode($return);
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

    private function getDataVideo($param) {
        $nama = trim($this->input->post('nama'));
        $nama = htmlspecialchars(strip_tags($nama), ENT_QUOTES);
        $deskripsi = trim($this->input->post('deskripsi'));
        $deskripsi = htmlspecialchars(strip_tags($deskripsi), ENT_QUOTES);
        $singkat = trim($this->input->post('singkat'));
        $singkat = htmlspecialchars(strip_tags($singkat), ENT_QUOTES);
        $harga = preg_replace('/[^0-9]/', '', trim($this->input->post('harga')));
        $link = filter_var(trim($this->input->post('link')), FILTER_SANITIZE_URL);

        if($nama == '' || $deskripsi == '' || $singkat == '' || $harga == '' || $harga == 0) {
            $return['type'] = 'error';
            $return['message'] = 'Data tidak lengkap.';
            return $return;
        }

        // $this->lang->load('upload', 'indonesia');
        // $this->config->set_item('language', 'indonesia');

		$config['upload_path']		= './course/thumbnail';
		$config['allowed_types']	= 'jpg|png|jpeg';
		$config['file_ext_tolower']	= true;
		$config['overwrite']		= false;
		$config['remove_spaces']	= true;
        $this->load->library('upload', $config);

        $thumbnail = '';
        if( $param === 'tambah' || ($param === 'edit' && isset($_FILES['thumbnail'])) ) {
            if( !$this->upload->do_upload('thumbnail') ) {
                $return['type'] = 'error';
                $return['message'] = $this->upload->display_errors();
                return $return;
            }
            else {
                $upload_data = $this->upload->data();
                $thumbnail = $upload_data['file_name'];
            }
        }

        $return['type'] = 'success';
        $return['data'] = array(
            'nama_paket'        => $nama,
            'deskripsi_paket'   => $deskripsi,
            'deskripsi_singkat' => $singkat,
            'harga_paket'       => $harga,
            'thumbnail_paket'   => $thumbnail,
            'tanggal_dibuat'    => date('Y-m-d H:i:s'),
            'link_video'        => $link,
        );
        return $return;
    }
}