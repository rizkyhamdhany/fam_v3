<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trans_keluar_m extends CI_Model {

    public function getRencanaOutAll() {
        $sql = "SELECT * from master_out mo left join master_customer mc on mo.id_cust = mc.id_cust where mo.no_cukai= ''";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }

    public function getProduk() {
        $rows = array(); //will hold all results
        $sql = "select * from master_produk_cukai order by id_produk asc ";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $rows[] = $row; //add the fetched result to the result array;
        }
        return $rows; // returning rows, not row
    }

    public function getJnsDoc() {
        $rows = array(); //will hold all results
        $sql = "select * from master_jnsdoc order by id_jnsdoc asc ";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $rows[] = $row; //add the fetched result to the result array;
        }
        return $rows; // returning rows, not row
    }

    public function getStorage() {
        $rows = array(); //will hold all results
        $sql = "select * from master_storage order by id_storage asc ";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $rows[] = $row; //add the fetched result to the result array;
        }
        return $rows; // returning rows, not row
    }

    public function getCust() {
        $rows = array(); //will hold all results
        $sql = "select * from master_customer order by id_cust asc ";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $rows[] = $row; //add the fetched result to the result array;
        }
        return $rows; // returning rows, not row
    }

    public function getDescSo($idSo) {
        $this->db->select('mo.id_cust,mo.tgl_trans,mo.id_jnsdoc,mo.no_po_cust,mo.no_cukai,mo.no_batch,mo.eta,mo.etd,mo.keterangan_so,tro.id_produk,tro.qty_rencana,tro.id_storage ');
        $this->db->from('master_out mo');
        $this->db->join('trans_out tro', 'mo.id_master_out = tro.id_master', 'LEFT');
        $this->db->where('mo.id_master_out', $idSo);
        $query = $this->db->get();
        if ($query->num_rows() == '1') {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getDescProduk($idProduk) {
        $this->db->select('*');
        $this->db->from('master_produk_cukai');
        $this->db->where('id_produk', $idProduk);
        $query = $this->db->get();
        if ($query->num_rows() == '1') {
            return $query->result();
        } else {
            return false;
        }
    }
    

    public function getDescCustomer($idCust) {
        $this->db->select('*');
        $this->db->from('master_customer');
        $this->db->where('id_cust', $idCust);
        $query = $this->db->get();
        if ($query->num_rows() == '1') {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getDescStorage($idStorage) {
        $this->db->select('mjs.nama_jns_storage');
        $this->db->from('master_storage ms');
        $this->db->join('master_jns_storage mjs', 'ms.id_jns_storage = mjs.id_jns_storage', 'LEFT');
        $this->db->where('ms.id_storage', $idStorage);
        $query = $this->db->get();
        if ($query->num_rows() == '1') {
            return $query->result();
        } else {
            return false;
        }
    }

    function getIdMasterOut($bulan, $tahun) {
        $sql = "select id_master_out from master_out where MONTH(tgl_trans)='$bulan' and YEAR(tgl_trans)='$tahun'";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        $kode = "OU";
        $th = substr($tahun, -2);
        if ($jml == 0) {
            $id_adv = "0000001";
            return $kode . "-" . $id_adv . "-" . $bulan . $th;
        } else {
            $sql = "select max(substring(id_master_out,4,7)) as id_adv from master_out where MONTH(tgl_trans)='$bulan' and YEAR(tgl_trans)='$tahun'";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $id_adv = $hasil[0]->id_adv;
            $id_adv = sprintf('%07u', $id_adv + 1);
            return $kode . "-" . $id_adv . "-" . $bulan . $th;
        }
    }

    function insertMaster($data) {
        $this->db->trans_begin();
        $model = $this->db->insert('master_out', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    function ubahMaster($data, $id_master) {
        $model1 = $this->db->where('id_master_out', $id_master);
        $model2 = $this->db->update('master_out', $data);
        if ($model1 && $model2) {
            return true;
        } else {
            return false;
        }
    }

    function insertTransOut($data) {
        $this->db->trans_begin();
        $model = $this->db->insert('trans_out', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    function ubahTransOut($data, $id_master) {
        $model1 = $this->db->where('id_master', $id_master);
        $model2 = $this->db->update('trans_out', $data);
        if ($model1 && $model2) {
            return true;
        } else {
            return false;
        }
    }

    function updateMProduk($qty_kg, $id_produk) {
        $sql2 = "update master_produk_cukai set keluar = (keluar  + '$qty_kg') where id_produk = '$id_produk'";
        $query = $this->db->query($sql2);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */