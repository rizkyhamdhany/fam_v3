<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_m extends CI_Model {

    public function get_menu_for_level($user_group) {
        $this->db->from('sec_menu');
        $this->db->like('menu_allowed', '+' . $user_group . '+');
        $result = $this->db->get();
        return $result;
    }

    //memanggil menu dari database
    function get_password($username) {
        $data = array();
        $this->db->select('password');
        $this->db->from('sec_passwd');
        $this->db->where('username', $username);
        $query = $this->db->get();
        return $query->result();
    }

    function get_array_menu($id) {
        $this->db->select('menu_allowed');
        $this->db->from('sec_menu');
        $this->db->where('menu_id', $id);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            $row = $data->row();
            $level = $row->menu_allowed;
            $arr = explode('+', $level);
            return $arr;
        } else {
            die();
        }
    }

    public function get_data($induk = 0, $user_group) {
        $data = array();
////        $this->db->select('menu_allowed');
//        $this->db->from('sec_menu');
//        $this->db->where('parent', $induk);
//        $this->db->like('menu_allowed', '+' . $user_group);
//        $this->db->order_by("menu_seq", "asc");
//        $result = $this->db->get();
        $SQL ="select * from sec_menu where parent=$induk and menu_allowed like '%+$user_group%' ORDER BY menu_seq ASC";
        $result= $this->db->query($SQL);
        
//        print_r($SQL); die();
        foreach ($result->result() as $row) {
            $data[] = array(
                'id' => $row->menu_id,
                'nama' => $row->menu_nama,
                'menu_header' =>$row->menu_header,
                'parent' => $row->parent,
                'link' => $row->menu_uri,
                // recursive
                'child' => $this->get_data($row->menu_id, $user_group)
            );
        }
        return $data;
    }

    //operasi user
    function get_all_user() {
        $this->db->from('sec_passwd');
        $this->db->join('sec_level', 'level_id=STATUS_USER', 'left');
        return $this->db->get();
    }

    public function get_menu_all($induk = 0) {
        $data = array();
          $this->db->select('*');
        $this->db->from('sec_menu');
        $this->db->where('parent', $induk);
        $this->db->order_by("menu_seq", "asc");
        $result = $this->db->get();
//        print_r($result->result());die();
        
        foreach ($result->result() as $row) {
            $data[] = array(
                'id' => $row->menu_id,
                'nama' => $row->menu_nama,
                'header' => $row->menu_header,
                'urutan' => $row->menu_seq,
                'parent' => $row->parent,
                'link' => $row->menu_uri,
                'child' => $this->get_menu_all($row->menu_id)
            );
        }
        return $data;
    }

    public function get_menuBreadcumb($induk = 0, $menu_id) {
        $data = array();
        $this->db->from('sec_menu');
        $this->db->where('parent', $induk);
        //$this->db->where('menu_id',$menu_id);
        $this->db->order_by("menu_id", "asc");
        $result = $this->db->get();

        foreach ($result->result() as $row) {
            $data[] = array(
                'id' => $row->menu_id,
                'nama' => $row->menu_nama,
                'link' => $row->menu_uri,
                // recursive
                'child' => $this->get_data($row->menu_id, $menu_id)
            );
        }
        return $data;
    }

}
