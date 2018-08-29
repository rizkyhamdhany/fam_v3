<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_kategoribarang_m extends CI_Model {

    public function getKategoribarangAll() {
        $sql = "SELECT n.id_kategoribarang, n.nama_kategoribarang
				from master_kategoribarang n";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }

    public function getIdKategoribarang() {
        $sql = "select id_kategoribarang from master_kategoribarang";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        if ($jml == 0) {
            $id_kategoribarang = "001";
            return $id_kategoribarang;
        } else {
            $sql = "select max(right(id_kategoribarang,3)) as id_kategoribarang from master_kategoribarang";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $id_kategoribarang = $hasil[0]->id_kategoribarang;
            $id_kategoribarang = sprintf('%03u', $id_kategoribarang + 1);
            return $id_kategoribarang;
        }
    }

    public function simpan($data) {

        $this->db->trans_begin();
        $model = $this->db->insert('master_kategoribarang', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function ubah($data, $kategoribarangId) {
        $this->db->trans_begin();
        $query1 = $this->db->where('id_kategoribarang', $kategoribarangId);
        $query2 = $this->db->update('master_kategoribarang', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function hapus($kategoribarangId) {
        $this->db->trans_begin();
        $query1 = $this->db->where('id_kategoribarang', $kategoribarangId);
        $query2 = $this->db->delete('master_kategoribarang');
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
/* Location: ./application/models/master_kategoribarang_m.php */