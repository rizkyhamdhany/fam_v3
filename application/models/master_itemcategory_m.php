<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class master_itemcategory_m extends CI_Model {
   public function getIdMax() { //query untuk mendapatkan id_kyw selanjutnya
        $sql = "select IClassID from ams_itemcategory";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        if ($jml == 0) {
            $IClassID = "001";
            return $IClassID;
        } else {
            $sql = "select max(right(IClassID,6)) as IClassID from ams_itemcategory";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $IClassID = $hasil[0]->IClassID;
            $IClassID = sprintf('%06u', $IClassID + 1);
            return $IClassID;
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
        $sql = "SELECT * from ams_zone";
        $query = $this->db->query($sql);
        return $query->result();
    }


    //  function getUserKab($prop) {
    //     $sql = "select * from ams_itemcategory a left join item_type b on  a.IClassID = b.IClassID" where ='IClassID';
    //     $query = $this->db->query($sql);
    //     return $query->result();
    // }


    // public function getUserKab($prop) {
    //     $this->db->select('kab.*,p.IClassName');
    //     $this->db->from('item_type kab');
    //     $this->db->join('ams_itemcategory p', 'p.ItemTypeID=kab.ItemTypeID', 'inner');
    //     $this->db->where('p.ItemTypeID', $prop);

    //     $query = $this->db->get();
    //     // echo $this->db->last_query(); die();
    //     return $query->result();
    // }

     public function getUserKab($prop) {
        $sql = "select kab.ItemTypeName,kec.* from ams_itemcategory kec
                         left join item_type kab on kab.IClassID = kec.IClassID
                         where kab.IClassID = '$prop'";


        $query = $this->db->query($sql);
        return $query->result();
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
        $this->db->select ( '*' );
                $this->db->from('ams_itemcategory');
                $query = $this->db->get();
                return $query->result();
                
    }

    
}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */