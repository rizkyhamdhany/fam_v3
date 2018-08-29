<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class Master_karyawan_m extends CI_Model {
	public function get_dept() {
		$rows 		=	array(); //will hold all results
		$sql		=	"select * from master_dept order by id_dept asc ";
		$query		=	$this->db->query($sql);
		foreach($query->result_array() as $row){
			$rows[] = $row; //add the fetched result to the result array;
		}
		return $rows; // returning rows, not row
	}
	public function getKywAll()
	{
		$sql="SELECT mk.id_kyw, mk.nama_kyw,mk.dept_kyw,mk.nama_akun_bank,mk.no_akun_bank,mk.nama_bank,mk.kode_perk,
				mp.nama_perk,md.nama_dept from master_karyawan mk 
				left join perkiraan mp on mk.kode_perk = mp.kode_perk
				left join master_dept md on mk.dept_kyw = md.id_dept";
		$query=$this->db->query($sql);
		return $query->result(); // returning rows, not row
	}
	public function getIdKyw(){
		$sql= "select id_kyw from master_karyawan";
		$query = $this->db->query($sql);
		$jml = $query->num_rows();
		if($jml == 0){
			$id_kyw = "000001";
			return $id_kyw;
		}else{
			$sql= "select max(right(id_kyw,6)) as id_kyw from master_karyawan";
			$query = $this->db->query($sql);
			$hasil = $query->result();
			$id_kyw =  $hasil[0]->id_kyw;
			$id_kyw = sprintf('%06u',$id_kyw+1);
			return $id_kyw;
		}
	}
	public function insertKyw($data){
		
		$this->db->trans_begin();
		$model = $this->db->insert('master_karyawan', $data);
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else{
			$this->db->trans_commit();
			return true;
		}
	
	}
	function updateKyw($data,$kywId){
		$this->db->trans_begin();
		$query1 = $this->db->where('id_kyw', $kywId);
		$query2 = $this->db->update('master_karyawan', $data);
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else{
			$this->db->trans_commit();
			return true;
		}
	}
	public function cekMasterAdvance($kywId){
		$sql= "select id_kyw from master_advance where id_kyw = '$kywId'";
		$query = $this->db->query($sql);
		$jml = $query->num_rows();
		if($jml == 0){
			return true;
		}else{
			return false;
		}
	}
	public function cekMasterReqpay($kywId){
		$sql= "select id_kyw from master_reqpay where id_kyw = '$kywId'";
		$query = $this->db->query($sql);
		$jml = $query->num_rows();
		if($jml == 0){
			return true;
		}else{
			return false;
		}
	}
	public function cekMasterReimpay($kywId){
		$sql= "select id_kyw from master_reimpay where id_kyw = '$kywId'";
		$query = $this->db->query($sql);
		$jml = $query->num_rows();
		if($jml == 0){
			return true;
		}else{
			return false;
		}
	}
	function deleteKyw($kywId){
		$this->db->trans_begin();
		$query1	=	$this->db->where('id_kyw',$kywId);
		$query2	=   $this->db->delete('master_karyawan');
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
