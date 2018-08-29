<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Utility_db_m extends CI_Model {

    public function insert($data) {
        $this->db->trans_begin();
        $model = $this->db->insert('utility_db', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
	
	function delete($path){
		$this->db->trans_begin();
		$query1 = $this->db->where('direktori', $path);
		$query2 = $this->db->delete();
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        }else{
            $this->db->trans_commit();
            return true;
        }
	}	
}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */