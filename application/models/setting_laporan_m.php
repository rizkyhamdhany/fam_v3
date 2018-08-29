<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Setting_laporan_m extends CI_Model
{
   function updateSetting($data,$id){
		$this->db->trans_begin();
		$query1 = $this->db->where('id', $id);
		$query2 = $this->db->update('setting_laporan', $data);
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else{
			$this->db->trans_commit();
			return true;
		}
	}
	
	function getAllSetting(){
		$sql="SELECT * from setting_laporan where id='1'";
		$query=$this->db->query($sql);
		return $query->result();
	}	

}