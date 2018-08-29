<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Integrasi_jurnal_m extends CI_Model {

    public function getAllJurnal() {
        $sql = "SELECT * from integrasi_jurnal i left join perkiraan p on i.kode_perk = p.kode_perk";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }

    public function simpan($data) {

        $this->db->trans_begin();
        $model = $this->db->insert('integrasi_jurnal', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function ubah($data, $jurnalId) {
        $this->db->trans_begin();
        $query1 = $this->db->where('id_integrasi', $jurnalId);
        $query2 = $this->db->update('integrasi_jurnal', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function hapus($jurnalId) {
        $this->db->trans_begin();
        $query1 = $this->db->where('id_integrasi', $jurnalId);
        $query2 = $this->db->delete('integrasi_jurnal');
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