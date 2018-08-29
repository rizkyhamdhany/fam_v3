<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class master_dept_m extends CI_Model {
	
	public function getDeptAll()
	{
		$sql="SELECT * from master_dept ";
		$query=$this->db->query($sql);
		return $query->result(); // returning rows, not row
	}
	public function getIdDept(){
		$sql= "select id_dept from master_dept";
		$query = $this->db->query($sql);
		$jml = $query->num_rows();
		if($jml == 0){
			$id_dept = "001";
			return $id_dept;
		}else{
			$sql= "select max(right(id_dept,3)) as id_dept from master_dept";
			$query = $this->db->query($sql);
			$hasil = $query->result();
			$id_dept =  $hasil[0]->id_dept;
			$id_dept = sprintf('%03u',$id_dept+1);
			return $id_dept;
		}
	}
	public function simpan($data){
		
		$this->db->trans_begin();
		$model = $this->db->insert('master_dept', $data);
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else{
			$this->db->trans_commit();
			return true;
		}
	
	}
	function ubah($data,$idDept){
		$this->db->trans_begin();
		$query1 = $this->db->where('id_dept', $idDept);
		$query2 = $this->db->update('master_dept', $data);
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else{
			$this->db->trans_commit();
			return true;
		}
	}
	
	function hapus($idDept){
		$this->db->trans_begin();
		$query1	=	$this->db->where('id_dept',$idDept);
		$query2	=   $this->db->delete('master_dept');
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