<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class master_itemgenset_m extends CI_Model {
   public function getIdMax() { //query untuk mendapatkan id_kyw selanjutnya
        $sql = "select ItemID from Mst_ItemListAP";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        if ($jml == 0) {
            $ItemID = "001";
            return $ItemID;
        } else {
            $sql = "select max(right(ItemID,6)) as ItemID from Mst_ItemListAP";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $ItemID = $hasil[0]->ItemID;
            $ItemID = sprintf('%06u', $ItemID + 1);
            return $ItemID;
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
                $this->db->from('SELECT a.IClassID,a.ItemTypeID,a.ItemID,a.ItemName,a.VendorID,a.Image,b.IClassName,
                                c.ItemTypeName, a.Is_trash,d.NamaCompany,a.Id_company,
                                a.Gst_Desc,a.Gst_Pelaksana,a.Gst_SerialNumber,a.Knd_Merk,a.Knd_ThnPmbtn
                                FROM Mst_ItemListAP a INNER JOIN Mst_ItemClass b ON a.IClassID=b.IClassID 
                                INNER JOIN Mst_ItemType c ON a.ItemTypeID=c.ItemTypeID LEFT JOIN Mst_Company d ON a.Id_company = d.IdCompany    
                                WHERE a.ItemID');
                $query = $this->db->get();
                return $query->result();
                
    }

    
}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */