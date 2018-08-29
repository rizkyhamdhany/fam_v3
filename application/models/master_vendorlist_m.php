<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class master_vendorlist_m extends CI_Model {
   public function getIdMax() { //query untuk mendapatkan id_kyw selanjutnya
        $sql = "select Raw_ID from VendorList";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        if ($jml == 0) {
            $Raw_ID = "001";
            return $Raw_ID;
        } else {
            $sql = "select max(right(Raw_ID,6)) as Raw_ID from VendorList";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $Raw_ID = $hasil[0]->Raw_ID;
            $Raw_ID = sprintf('%06u', $Raw_ID + 1);
            return $Raw_ID;
        }
    }

  public function getIdMax_typeid(){
        $sql = "select VendorID from VendorList";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        if ($jml == 0) {
            $VendorID = "00000000";
            return $VendorID;
        } else {
            $sql = "select right('00000000'+convert(varchar,convert(int,max(VendorID))+1),8) as VendorID from VendorList";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $VendorID = $hasil[0]->VendorID;
            return $VendorID;
        }
    
        }

   

            public function getUserzone($ZoneID) {
        $this->db->select('kab.*,p.ZoneID');
        $this->db->from('ams_zone kab');
        $this->db->join('ams_cabang p', 'p.BranchID=kab.BranchID', 'inner');
        $this->db->where('p.BranchID', $ZoneID);

        $query = $this->db->get();
        // echo $this->db->last_query(); die();
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
        $sql = "SELECT *
FROM VendorList AS a INNER JOIN
VendorType AS b ON a.VendorTypeID COLLATE Hebrew_CI_AS = b.VendorTypeID";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }


    //    public function getUserInfo() {
    //     $this->db->select ( '*' );
    //             $this->db->from('VendorList');
    //             $query = $this->db->get();
    //             return $query->result();      
    // }

    
}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */