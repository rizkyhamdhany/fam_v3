<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class master_itemtype_m extends CI_Model {
   public function getIdMax() { //query untuk mendapatkan id_kyw selanjutnya
        $sql = "select ItemTypeID from item_type";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        if ($jml == 0) {
            $ItemTypeID = "001";
            return $ItemTypeID;
        } else {
            $sql = "select max(right(ItemTypeID,6)) as ItemTypeID from item_type";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $ItemTypeID = $hasil[0]->ItemTypeID;
            $ItemTypeID = sprintf('%06u', $ItemTypeID + 1);
            return $ItemTypeID;
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

         public function getUserKab($prop) {
        $this->db->select('kab.*,p.ItemTypeName');
        $this->db->from('Mst_ItemType kab');
        $this->db->join('Mst_ItemListAP p', 'p.kodepropinsi=kab.kodepropinsi', 'inner');
        $this->db->where('p.kodepropinsi', $prop);

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
        $sql = "select * from item_type a left join ams_itemcategory b on a.IClassID = b.IClassID ";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row

       echo  $this->db->last_query();
    }
     

   
 //     public function getUserInfo() {
    //     $sql = "select * from item_type";
    //     $query = $this->db->query($sql);
    //     return $query->result(); // returning rows, not row
    // }


      


    

    
}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */