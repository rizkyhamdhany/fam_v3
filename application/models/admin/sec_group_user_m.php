<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sec_group_user_m extends CI_Model {

    public function getUserGroupAll() {
        $sql = "SELECT * from sec_usergroup ";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }
    
     public function generateRandomString($length = 1) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $cekFound = $this->db->query("Select count(usergroup_id) jml from sec_usergroup where usergroup_id in('$randomString')");
       
        $jml = $cekFound->result();
//         die($jml[0]->jml);
        if ($jml[0]->jml == 0) 
        {
            return $randomString;
        }else{
            return $this->generateRandomString();
        }

    }
    
    public function getIdUsergroup() {
        $sql = "select usergroup_id from sec_usergroup";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        if ($jml == 0) {
            $usergroup_id = "1";
            return $usergroup_id;
        } else {
            $sql = "select max(usergroup_id) as usergroup_id from sec_usergroup";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $usergroup_id = $hasil[0]->usergroup_id;
            $usergroup_id = $usergroup_id + 1;
            return $usergroup_id;
        }
    }
    public function insert_group_user_m($data) {
        $model = $this->db->insert('sec_usergroup', $data);
        if ($model) {
            return true;
        } else {
            return false;
        }
    }

    public function update_group_user_m($id_group_user, $data) {
        $model1 = $this->db->where('usergroup_id', $id_group_user);
        $model2 = $this->db->update('sec_usergroup', $data);
        if ($model1 && $model2) {
            return true;
        } else {
            return false;
        }
    }

    public function delete_group_user_m($id_group_user) {
        $model1 = $this->db->where('usergroup_id', $id_group_user);
        $model2 = $this->db->delete('sec_usergroup');
        if ($model1 && $model2) {
            return true;
        } else {
            return false;
        }
    }

}

/* End of file sec_group_user_m.php */
/* Location: ./application/models/sec_group_user.php */