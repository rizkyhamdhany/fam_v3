<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_kecamatan_m extends CI_Model {
    public function getIdMax(){
		$sql= "select kodekecamatan from amsparkecamatan";
		$query = $this->db->query($sql);
		$jml = $query->num_rows();
		if($jml == 0){
			$id_kyw = "001";
			return $id_kyw;
		}else{
			$sql= "select max((kodekecamatan)) as id_kyw from amsparkecamatan";
			$query = $this->db->query($sql);
			$hasil = $query->result();
			$id_kyw =  $hasil[0]->id_kyw;
			$id_kyw = sprintf('%03u',$id_kyw+1);
			return $id_kyw;
		}
	}
         function getProp(){
		$sql="SELECT * from amsparpropinsi";
		$query=$this->db->query($sql);
		return $query->result();
	}
   function kodeProp($kode){
		$sql="SELECT kodepropinsi from amsparkabupaten where kodekabupaten='$kode'";
		$query=$this->db->query($sql);
		return $query->result();
	}
         function getKab(){
		$sql="SELECT * from amsparkabupaten";
		$query=$this->db->query($sql);
		return $query->result();
	}
    public function get_level_user() {
        $rows = array(); //will hold all results
        $sql = "select * from sec_level order by level_id asc ";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $rows[] = $row; //add the fetched result to the result array;
        }
        return $rows; // returning rows, not row
    }
   function deleteUser($userId) {
        $this->db->trans_begin();
        $query1 = $this->db->where('userid', $userId);
        $query2 = $this->db->delete('sec_passwd');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
            
        }
    }
    public function getUserInfo() {
                       $sql = "select kab.namakabupaten,kec.* from amsparkecamatan kec
                         left join amsparkabupaten kab on kab.kodekabupaten = kec.kodekabupaten";
                        
                
                $query = $this->db->query($sql);
                return $query->result();
                
    }

    
}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */