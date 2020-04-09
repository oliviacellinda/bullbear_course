<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getAllData($table) {
        $query = $this->db->get($table);
        if($query->num_rows() > 0)
            return $query->result_array();
    }

    public function getAllDataWhere($table, $where) {
        $this->db->where($where);
        $query = $this->db->get($table);
        if($query->num_rows() > 0)
            return $query->result_array();
    }

    public function getDataWhere($table, $where) {
        $this->db->where($where);
        $query = $this->db->get($table);
        if($query->num_rows() > 0)
            return $query->row_array();
    }

    public function getDataWhereOrderBy($table, $where, $order) {
        $this->db->where($where);
        $this->db->order_by($order);
        $query = $this->db->get($table);
        if($query->num_rows() > 0)
            return $query->result_array();
    }

    public function insertData($table, $data) {
        $this->db->insert($table, $data);
    }

    public function updateData($table, $where, $data) {
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->where($where);
        $this->db->update($table);
    }

    public function deleteData($table, $where) {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function getContent($search, $sort, $is_owner) {
        // List library yang dimiliki member
        $this->db->where('username_member', $this->session->bbcourse_username_member);
        $query = $this->db->get('member_paket');
        $list = [];
        if($query->num_rows() > 0) {
            $query = $query->result_array();
            $list = array();
            foreach ($query as $element) {
                $list[] = $element['id_video_paket'];
            }
        }
        
        if($is_owner === 'true') {
            if(count($list) > 0)
                $this->db->where_in('id_video_paket', $list);
            else
                return;
        }
        elseif($is_owner === 'false' && count($list) > 0)
            $this->db->where_not_in('id_video_paket', $list);

        if($search != '')
            $this->db->where('MATCH (nama_paket, deskripsi_paket, deskripsi_singkat) AGAINST ("'.$search.'*" IN BOOLEAN MODE)');

        if($sort === 'latest')
            $this->db->order_by('tanggal_dibuat', 'desc');
        else
            $this->db->order_by('harga_paket', $sort);

        $query = $this->db->get('video_paket');
        if($query->num_rows() > 0)
            return $query->result_array();
    }

    public function searchMember($search) {
        $this->db->select('username_member, nama_member, email_member');
        $this->db->like('username_member', $search, 'after');
        $this->db->or_where('MATCH (nama_member) AGAINST ("'.$search.'*" IN BOOLEAN MODE)');
        $query = $this->db->get('member');
        if($query->num_rows() > 0)
            return $query->result_array();
    }
    
    public function insertNewLibrary($username, $id) {
        // INSERT INTO table_listnames (name, address, tele)
        // SELECT * FROM (SELECT 'Rupert', 'Somewhere', '022') AS tmp
        // WHERE NOT EXISTS (
        //     SELECT name FROM table_listnames WHERE name = 'Rupert'
        // ) LIMIT 1;
        $query = "INSERT INTO member_paket (username_member, id_video_paket) ";
        $query .= "SELECT * FROM (SELECT '".$username."', '".$id."') AS temp ";
        $query .= "WHERE NOT EXISTS(SELECT * FROM member_paket WHERE username_member = '".$username."' AND id_video_paket = '".$id."') LIMIT 1";
        $this->db->query($query);
    }
}