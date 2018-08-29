<?php

if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

class Sec_koneksiM extends CI_Model
{

    public function testKoneksiDatabase()
    {
        $testKoneksiDatabase = $this->load->database('config1', TRUE);
        if ($testKoneksiDatabase) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function cekTabelPi_institusi()
    {
        $cekTabelPi_institusi = $this->db->table_exists('pi_institusi');
        if ($cekTabelPi_institusi) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function cekTabelPi_cabang()
    {
        $cekTabelPi_cabang = $this->db->table_exists('pi_cabang');
        if ($cekTabelPi_cabang) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function cekTabelSc_user()
    {
        $cekTabelSc_user = $this->db->table_exists('sc_user');
        if ($cekTabelSc_user) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function cekTabelPi_kontrolhariproses()
    {
        $cekTabelPi_kontrolhariproses = $this->db->table_exists('pi_kontrolhariproses');
        if ($cekTabelPi_kontrolhariproses) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function cekRowTabelPi_kontrolhariproses()
    {
        $this->db->from('pi_kontrolhariproses');
        $query = $this->db->get();
        $rowcount = $query->num_rows();

        return $rowcount;
    }
    public function insertRowPi_kontrolhariproses($data){
        $query = $this->db->insert('pi_kontrolhariproses', $data);
        if ($query){
            return true;
        }else{
            return false;
        }
    }
    public function cekRowTabelPi_institusi(){
        $this->db->from('pi_institusi');
        $query = $this->db->get();
        $rowcount = $query->num_rows();

        return $rowcount;
    }
    public function insertRowPi_institusi($data){
        $query = $this->db->insert('pi_institusi', $data);
        if ($query){
            return true;
        }else{
            return false;
        }
    }
    public function getNamaInstitusiSN(){
        $this->db->select('NamaInstitusi,SerialNumber');
        $this->db->from('pi_institusi');
        $query = $this->db->get();
        return $query->result ();
    }
    public function cekRowTabelPi_cabang(){
        $this->db->from('pi_cabang');
        $query = $this->db->get();
        $rowcount = $query->num_rows();

        return $rowcount;
    }
    public function insertRowPi_cabang($data){
        $query = $this->db->insert('pi_cabang', $data);
        if ($query){
            return true;
        }else{
            return false;
        }
    }
    public function cekRowTabelSc_user(){
        $this->db->from('sc_user');
        $query = $this->db->get();
        $rowcount = $query->num_rows();

        return $rowcount;
    }
    public function insertRowSc_user($data){
        $query = $this->db->insert('sc_user', $data);
        if ($query){
            return true;
        }else{
            return false;
        }
    }
    public function getIdUserAdministrator($userId)  {
        $this->db->from('sc_user');
        $this->db->where('UserID',$userId);
        $query = $this->db->get ();
        return $query->result();
    }
    public function updatePasswdAdministrator($userId,$data){
        $model1 = $this->db->where('UserID', $userId);
        $model2 = $this->db->update('sc_user', $data);
        if ($model1 && $model2){
            return true;
        }else{
            return false;
        }
    }
}

/* End of file sec_koneksi_user_m.php */
/* Location: ./application/models/sec_koneksi_user.php */