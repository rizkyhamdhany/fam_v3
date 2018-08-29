<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class master_requesttype_m extends CI_Model {
   public function getIdMax() { //query untuk mendapatkan id_kyw selanjutnya
        $sql = "select ReqTypeID from Mst_RequestType";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        if ($jml == 0) {
            $ReqTypeID = "001";
            return $ReqTypeID;
        } else {
            $sql = "select max(right(ReqTypeID,6)) as ReqTypeID from Mst_RequestType";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $ReqTypeID = $hasil[0]->ReqTypeID;
            $ReqTypeID = sprintf('%06u', $ReqTypeID + 1);
            return $ReqTypeID;
        }
    }

   public function getzones() { //query untuk mendapatkan id_kyw selanjutnya
        $sql = "select ZoneID from ams_zone";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        if ($jml == 0) {
            $ZoneID = "001";
            return $ZoneID;
        } else {
            $sql = "select max(right(ZoneID,6)) as ZoneID from ams_zone";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $ZoneID = $hasil[0]->ZoneID;
            $ZoneID = sprintf('%06u', $ZoneID + 1);
            return $ZoneID;
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
                $this->db->from('Mst_RequestType');
                $query = $this->db->get();
                return $query->result();
                
    }

    
}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */