<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Closing_perk_m extends CI_Model {

    public function cekSaldoBefore($bulan, $tahun) {
        $sql = "select * from closing_perk where bulan = month(DATE_SUB(concat('$tahun','-','$bulan','-01'), INTERVAL 1 MONTH))
                and tahun = year(DATE_SUB(concat('$tahun','-','$bulan','-01'), INTERVAL 1 MONTH))";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function cekSaldo($bulan, $tahun) {
        $sql = "select * from closing_perk where bulan = '$bulan' and tahun = '$tahun'";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function getSaldoCOA() {
        $sql = "select * from perkiraan
                order by kode_perk asc";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
     public function getSaldoCOA2($bulan, $tahun) {
        $sql = "select * from closing_perk where bulan = month(DATE_SUB(concat('$tahun','-','$bulan','-01'), INTERVAL 1 MONTH))
                and tahun = year(DATE_SUB(concat('$tahun','-','$bulan','-01'), INTERVAL 1 MONTH))
                order by kode_perk asc";
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function updateClosing($kode_perk,$saldoakhir,$bulan,$tahun){
        $sql4 = "UPDATE closing_perk SET saldo_awal = '" . $saldoakhir . "' WHERE kode_perk = '$kode_perk' and bulan = '$bulan' and tahun = '$tahun'";
        $query4 = $this->db->query($sql4);
        
    }

    function get_saldo_induk($kode_perk,$bulan,$tahun) {
        $sql = "SELECT a.saldo_awal from closing_perk a left join perkiraan b on a.kode_perk = b.kode_perk 
                where b.kode_induk ='" . $kode_perk . "' And a.bulan='".$bulan."' And a.tahun='".$tahun."'";
        $query = $this->db->query($sql);
        return $query;
    }

    function update_saldo_induk($kode_perk, $saldo,$bulan, $tahun) {
        $sql = "UPDATE closing_perk SET saldo_awal ='" . $saldo . "' WHERE kode_perk='" . $kode_perk . "' and bulan = '".$bulan."' and tahun = '".$tahun."'";
        $query = $this->db->query($sql);
    }

    function get_kode_induk() {
        $sql = "select * from perkiraan where type='G' order by level desc";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getSaldoAwal($kodeperk) {
        $sql = "select saldo_awal from perkiraan where kode_perk = '$kodeperk'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getSaldoTrans($bulan,$tahun){
        $sql = "select a.kode_perk,sum(debet) as debet,sum(kredit) as kredit,b.dk from trans_detail_perk a left join
                perkiraan b on a.kode_perk = b.kode_perk    
                where month(tgl_trans) = '".$bulan."' and year(tgl_trans) = '".$tahun."' 
                and post = 1
                group by a.kode_perk";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function getSaldoTransClosing($kodePerk,$bulan,$tahun){
        $sql = "select saldo_awal from closing_perk where kode_perk = '$kodePerk' and bulan = '$bulan' and tahun = '$tahun' ";
        $query = $this->db->query($sql);
        $hasil = $query->result();
        $id_pemb = $hasil[0]->saldo_awal;
        return $id_pemb;
    }

    public function inisiasiSaldoCOA($dataH) {
        $this->db->trans_begin();
        $model = $this->db->insert('closing_perk', $dataH);
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