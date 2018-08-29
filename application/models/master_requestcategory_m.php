<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class master_requestcategory_m extends CI_Model {
   public function getIdMax() { //query untuk mendapatkan id_kyw selanjutnya
        $sql = "select ReqCategoryID from Mst_RequestCategory";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        if ($jml == 0) {
            $ReqCategoryID = "001";
            return $ReqCategoryID;
        } else {
            $sql = "select max(right(ReqCategoryID,6)) as ReqCategoryID from Mst_RequestCategory";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $ReqCategoryID = $hasil[0]->ReqCategoryID;
            $ReqCategoryID = sprintf('%06u', $ReqCategoryID + 1);
            return $ReqCategoryID;
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
        $sql = "SELECT mc.*,reqcat.ReqCategoryID, reqcat.ReqCategoryName, reqcat.CreateDate, reqtype.ReqTypeName, reqcat.Is_trash, div.DivisionName, br.BranchName
                                FROM Mst_RequestCategory reqcat
                INNER JOIN Mst_RequestType reqtype ON reqcat.ReqTypeID = reqtype.ReqTypeID
                                LEFT JOIN Mst_Budget mc ON mc.BudgetCOA=reqcat.BudgetCOA
                                LEFT JOIN Mst_Division div ON div.DivisionID=mc.DivisionID/*ON reqcat.BudgetCoa = div.DivisionCode*/
                                LEFT JOIN ams_cabang br ON br.BranchID=mc.BranchID /*reqcat.BudgetCoa = br.BranchCode*/";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row

       echo  $this->db->last_query();
    }
        
}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */