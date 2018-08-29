<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Globalc extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('home_m');
        session_start();
        $this->load->model('global_m');
        //session_start();
    }
    function getStockAvl() {
        $this->CI = & get_instance();
        $idProduk = $this->input->post('idProduk', TRUE);
        $rows = $this->global_m->getStokAvlProduk($idProduk);
        if ($rows) {
                $array = array(
                    'baris' => 1,
                    'stok_avl' => $rows[0]->stok_avl
                        //'' => $row->
                );
        } else {
            $array = array('baris' => 0);
        }
        $this->output->set_output(json_encode($array));
    }
    function getKuotaCust() {
        $this->CI = & get_instance();
        $idCust = $this->input->post('idCust', TRUE);
        
        $tglTrans = $this->session->userdata('tgl_y');
        $tahun = date('Y', strtotime($tglTrans)); //$tglTrans->format("Y");

        $rows = $this->global_m->getKuotaCust($idCust);
        $rows_l = $this->global_m->getLastKuotaId($idCust);
        
        if ($rows) {
            
                $array = array(
                    'baris' => 1,
                    'kuota' => $rows[0]->kuota,
                    'kuota_terpakai' => $rows[0]->terpakai,
                    'kuota_saldo_akhir' => $rows[0]->saldo_akhir,
                    'no_skep'=>$rows_l[0]->no_skep
                        //'' => $row->
                );
        } else {
            $array = array('baris' => 0);
        }
        $this->output->set_output(json_encode($array));
    }
    
    public function truncateAllData() {
        $result = $this->global_m->truncateAllData();
        if($result){
            echo "data berhasil truncate";
        }else{
            echo "data gagal truncate";
        }
    }
    public function getHitungStokAkhirAll() {
        $result = $this->global_m->getHitungStokAkhirAll();
        if($result){
            echo "data berhasil truncate";
        }else{
            echo "data gagal truncate";
        }
    }
    public function getHitungStokAvlAll() {
        $result = $this->global_m->getHitungStokAvlAll();
        if($result){
            echo "data berhasil truncate";
        }else{
            echo "data gagal truncate";
        }
    }
    
}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */