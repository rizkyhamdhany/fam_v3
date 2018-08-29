<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Restore_db_m extends CI_Model {

    public function getUtilityDB() {
        $sql = "select * from utility_db";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }
	public function restore($path){
        $sql = "select * from utility_db where direktori = '".$path."'";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }
	
}
/* End of file sec_menu_user_m.php */
/* Location: ./application/models/restore_db.php */