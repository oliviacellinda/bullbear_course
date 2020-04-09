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
            redirect(base_url('member'));
        }
        else {
            $this->load->view('member/video');
        }
    }

    public function content($id) {
        if(!$this->isLogin()) {
            redirect(base_url('member'));
        }
        else {
            $id = preg_replace('/[^0-9]/', '', $id);
            $where = array('id_video_paket' => $id);
            $data['video'] = $this->model->getDataWhere('video_paket', $where);
            $data['content'] = $this->model->getAllDataWhere('video_isi', $where);

            $where = array('username_member' => $this->session->bbcourse_username_member, 'id_video_paket' => $id);
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

    public function getContentList() {
        if(!$this->isLogin()) {
            echo json_encode('User not authorized');
            die();
        }
        else {
            $id = preg_replace('/[^0-9]/', '', $this->input->post('id'));

            $paket = $this->model->getDataWhere('video_paket', ['id_video_paket' => $id]);
            if($paket == '') {
                $return['type'] = 'error';
                $return['message'] = 'Course not found.';
                echo json_encode($return);
                die();
            }

            $isi = $this->model->getDataWhereOrderBy('video_isi', ['id_video_paket' => $id], 'urutan ASC');
            if($isi != '') {
                $where = array(
                    'username_member'   => $this->session->bbcourse_username_member,
                    'id_video_paket'    => $id,
                );
                $progress = $this->model->getDataWhere('member_paket', $where);

                if($progress != '') {
                    if($progress['current_progress'] > count($isi)) {
                        $data = ['current_progress' => count($isi)];
                        $this->model->updateData('member_paket', $where, $data);
                        $progress['current_progress'] = count($isi);
                    }

                    $return['type'] = 'success';
                    $return['message'] = json_encode(['content' => $isi, 'progress' => $progress['current_progress']]);
                    echo json_encode($return);
                }
                else {
                    $return['type'] = 'error';
                    $return['message'] = 'You do not have access to this course.';
                    echo json_encode($return);
                }
            }
            else {
                $return['type'] = 'info';
                $return['message'] = 'No data.';
                echo json_encode($return);
            }
        }
    }

    public function updateProgress() {
        if(!$this->isLogin()) {
            echo json_encode('User not authorized');
            die();
        }
        else {
            $id = preg_replace('/[^0-9]/', '', $this->input->post('id'));

            $video = $this->model->getDataWhere('video_isi', ['id_video' => $id]);
            if($video == '') {
                $return['type'] = 'error';
                $return['message'] = 'Course not found.';
                echo json_encode($return);
                die();
            }

            $where = array(
                'username_member'   => $this->session->bbcourse_username_member,
                'id_video_paket'    => $video['id_video_paket'],
            );
            $member_paket = $this->model->getDataWhere('member_paket', $where);
            if($member_paket == '') {
                $return['type'] = 'error';
                $return['message'] = 'You do not have access to this course.';
                echo json_encode($return);
                die();
            }

            $where = array(
                'id_video_paket'=> $video['id_video_paket'],
                'urutan'        => $video['urutan'] + 1,
            );
            $next = $this->model->getDataWhere('video_isi', $where);
            if($next == '') {
                $return['type'] = 'info';
                $return['message'] = 'You have reached the end of the course.';
                echo json_encode($return);
            }
            else {
                $data = ['current_progress' => $video['urutan'] + 1];
                $where = array(
                    'username_member'   => $this->session->bbcourse_username_member,
                    'id_video_paket'    => $video['id_video_paket'],
                );
                $this->model->updateData('member_paket', $where, $data);

                $return['type'] = 'success';
                $return['message'] = 'Successfully updated progress.';
                echo json_encode($return);
            }
        }
    }


    /**
     * Section ini khusus untuk private function
     */

    private function isLogin() {
        if($this->session->bbcourse_username_member != '')
            return true;
        else 
            return false;
    }
}