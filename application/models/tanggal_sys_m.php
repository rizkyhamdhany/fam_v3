<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class Tanggal_sys_m extends CI_Model {

	function updateTglSys($data){
		$this->db->trans_begin();
		$query1 = $this->db->where('keyname', 'web_tanggal_hari_ini');
		$query2 = $this->db->update('web_sysid', $data);
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else{
			$this->db->trans_commit();
			return true;
		}
	}

	
}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */