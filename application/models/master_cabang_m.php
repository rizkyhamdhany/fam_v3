<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class master_cabang_m extends CI_Model {
   public function getIdMax() { //query untuk mendapatkan id_kyw selanjutnya
        $sql = "select BranchID from ams_cabang";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        if ($jml == 0) {
            $BranchID = "1";
            return $BranchID;
        } else {
            $sql = "select max(right(BranchID,6)) as BranchID from ams_cabang";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $BranchID = $hasil[0]->BranchID;
            $BranchID = sprintf('%06u', $BranchID + 1);
            return $BranchID;
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

 

    function savedata($divid, $divname){
        $divisiondata=array(
            'BranchID'=>$this->input->post('branch'),
            'DivisionCode'=>$divid,
            'DivisionName'=>$this->input->post('DivisionName'),
            'CreateDate'=>date('Y-m-d H:i:s'),
            'CreateBy'=>$this->session->userdata('user_id'),
            'Status'=>0,
            'DivisionAlias'=>$this->input->post('DivisionAlias')
        );      
        $this->db2 = $this->load->database('ms', true);
        $status = $this->db2->insert('Mst_Division',$divisiondata); 
        $this->db2->close();
        if($status) 
            $this->session->set_flashdata('msg', 'Success! Division Name '.$DivisionName.' Success Insert data');
        else
            $this->session->set_flashdata('msg', 'Error! Division Name '.$DivisionName.' Failed Insert data');
    }



       public function getUserInfo() {
        $this->db->select ( '*' );
                $this->db->from('ams_cabang');
                $query = $this->db->get();
                return $query->result();
                
    }

    
}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */