<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class master_company_m extends CI_Model {
   public function getIdMax() { //query untuk mendapatkan id_kyw selanjutnya
        $sql = "select IdCompany from Mst_Company";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        if ($jml == 0) {
            $IdCompany = "001";
            return $IdCompany;
        } else {
            $sql = "select max(right(IdCompany,6)) as IdCompany from Mst_Company";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $IdCompany = $hasil[0]->IdCompany;
            $IdCompany = sprintf('%06u', $IdCompany + 1);
            return $IdCompany;
        }
    }

  public function getzone(){
        $sql= "select Raw_ID from ams_zone";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        if($jml == 0){
            $id_Raw = 1;
            return $id_Raw;
        }else{
            $sql= "select max((Raw_ID)) as id_Raw from ams_zone";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $id_Raw =  ($hasil[0]->id_Raw)+1;
            return $id_Raw;
            }
        }

          function getZoneID() {
        $sql = "SELECT * from ams_cabang";
        $query = $this->db->query($sql);
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
        $this->db->select ( '*' );
                $this->db->from('Mst_Company');
                $query = $this->db->get();
                return $query->result();
                
    }

    
}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */