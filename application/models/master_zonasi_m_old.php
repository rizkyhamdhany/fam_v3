<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class master_zonasi_m extends CI_Model {

 public function getUserInfo() {
        $this->db->select('*');
        $this->db->from('amspar_zonasi');
        $query = $this->db->get();
        return $query->result();
    }

}


/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */

