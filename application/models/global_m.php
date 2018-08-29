<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Global_m extends CI_Model {

    public function simpan($tabel, $data) {
        $this->db->trans_begin();
        $model = $this->db->insert($tabel, $data);
//        echo $this->db->last_query(); die();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function simpan2table($tabel1, $data1, $tabel1, $data1) {
        $this->db->trans_begin();
        $model = $this->db->insert($tabel, $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function ubah($tabel, $data, $id_kolom, $id_data) {
        $this->db->trans_begin();
        $query1 = $this->db->where($id_kolom, $id_data);
        $query2 = $this->db->update($tabel, $data);

        // echo $this->db->last_query(); die('');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function tampil_semua_array($sql) {
        $query = $this->db->query($sql);
        return $query;
    }

    public function tampil_data($sql) {
        $query = $this->db->query($sql);
        return $query->result();
    }

    function deleteUser($tabel, $id_kolom, $id_data) {
        $this->db->trans_begin();
        $query1 = $this->db->where($id_kolom, $id_data);
        $query2 = $this->db->delete($tabel);
//        echo $this->db->last_query(); die();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function tampil_semua($tabel, $orderby_1) {
        $sql = "select * from $tabel order by $orderby_1 asc ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function tampil_id_desk($tabel, $kolom_id_data, $kolom_desk_data, $orderby_1) {
        $sql = "select $kolom_id_data,$kolom_desk_data from $tabel order by $orderby_1 asc ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function truncateAllData() {
        $this->db->query("truncate table master_in");
        $this->db->query("update master_produk set masuk= 0.00, masuk_campur = 0.00, masuk_lain = 0.00, keluar = 0.00, keluar_req = 0.00, keluar_campur = 0.00, keluar_lain = 0.00, stok_avl =0.00, stok_akhir = 0.00");

        //$result = $query->result();
        //return $result;
    }

    public function tampil_zone() {
        $sql = "select * from ams_itemcategory ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function tampil_item() {
        $sql = "select * from ams_itemcategory a left join item_type b on  a.IClassID = b.IClassID ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function tampil_zone1() {
        $sql = "select * from Mst_Zonasi";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function tampil_division() {
        $sql = "select * from Mst_Branch";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function tampilitemcategory() {
        $sql = "select * from Mst_RequestType ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function tampil_vendor() {

        $sql = "select * from VendorType";
        $query = $this->db->query($sql);
        $result = $query->result();

        return$result;
    }

}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */