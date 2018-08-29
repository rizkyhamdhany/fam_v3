<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_pengguna_asset extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('admin/konfigurasi_menu_status_user_m');
        $this->load->model('global_m');
        $this->load->model('master_ams_m/master_pengguna_asset_m');
        
        session_start();
    }
    public $tabel_utama ='sec_passwd';

    public function index() {
        if ($this->auth->is_logged_in() == false) {
            $this->login();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));

            //$data ['nama'] = $this->home_m->get_nama_kantor ();
            $this->template->set('title', 'Home');
            $this->template->load('template/template1', 'global/index', $data);
        }
    }

    function home() {
        $menuId = $this->home_m->get_menu_id('parameter/master_pengguna_asset/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        //$data['level_user'] = $this->sec_user_m->get_level_user();
         if (isset($_POST["idTmpAksiBtn"])) {
             $act=$_POST["idTmpAksiBtn"];
        if ($act==1) {
            $this->simpan();
        }elseif ($act==2) {
            $this->ubah();
        }elseif ($act=='3') {
            $this->hapus();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);
            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan','id_kyw','nama_kyw','id_kyw');
            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user','goluser_id','goluser_desc','goluser_id');
            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user','statususer_id','statususer_desc','statususer_id');
            $data['propinsi'] = $this->master_pengguna_asset_m->getProp();
            $this->template->set('title', 'Master Pengguna Asset');
            $this->template->load('template/template_dataTable', 'master_ams/master_pengguna_asset_v', $data);
        }
    } else {
            $data['propinsi'] = $this->master_pengguna_asset_m->getProp();
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);
            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan','id_kyw','nama_kyw','id_kyw');
            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user','goluser_id','goluser_desc','goluser_id');
            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user','statususer_id','statususer_desc','statususer_id');
            $data['kab'] = $this->master_pengguna_asset_m->getKab();
            $this->template->set('title', 'Master Pengguna Asset');
            $this->template->load('template/template_dataTable', 'master_ams/master_pengguna_asset_v', $data);
        }
    }

   public function getUserInfo() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->master_pengguna_asset_m->getUserInfo();
        $data['data'] = array();
        foreach ($rows as $row) {

            $array = array(
                 'kodepengguna' => trim($row->kodepengguna),
                'keterangan' => trim($row->keterangan),
            );

            array_push($data['data'], $array);
        }

        $this->output->set_output(json_encode($data));
    }
    function simpan() {
    
           $kodepengguna = $this->master_pengguna_asset_m->getIdMax();
        $keterangan = trim($this->input->post('id_keterangan'));

        
        $data = array(
             'kodepengguna' => $kodepengguna,
            'keterangan' => $keterangan
        );
        $model = $this->global_m->simpan('amsrefpengguna', $data);
        if ($model) {
            $notifikasi = Array(
                'msgType' => 'success',
                'msgTitle' => 'Success',
                'msg' => 'Data Berhasil Disimpan'
            );
        } else {
            $notifikasi = Array(
                'msgType' => 'error',
                'msgTitle' => 'Error',
                'msg' => 'Data Gagal Disimpan'
            );
        }
        $this->session->set_flashdata('notif', $notifikasi);
        //echo $model;
        redirect('parameter/master_pengguna_asset/home');
        
    }

    function ubah() {
   
        $kodepengguna = trim($this->input->post('id_kodepengguna'));
        $keterangan = trim($this->input->post('id_keterangan'));
        
//        $cariProp = $this->master_kecamatan_m->kodeProp($kodeKab);     
//        $kodeprop = $cariProp[0]->kodepropinsi;
        
        $data = array(
             'keterangan' => $keterangan,
        );
        $model = $this->global_m->ubah('amsrefpengguna', $data,'kodepengguna',$kodepengguna);
        if ($model) {
            $notifikasi = Array(
                'msgType' => 'success',
                'msgTitle' => 'Success',
                'msg' => 'Data Berhasil Diubah'
            );
        } else {
            $notifikasi = Array(
                'msgType' => 'error',
                'msgTitle' => 'Error',
                'msg' => 'Data Berhasil Diubah'
            );
        }
        $this->session->set_flashdata('notif', $notifikasi);
        //echo $model;
        redirect('parameter/master_pengguna_asset/home');
    }

    function hapus() {
         $this->CI = & get_instance();

        $kodepengguna = trim($this->input->post('id_kodepengguna'));
        $model = $this->global_m->deleteUser('amsrefpengguna','kodepengguna',$kodepengguna);
        if ($model) {
            $notifikasi = Array(
                'msgType' => 'success',
                'msgTitle' => 'Success',
                'msg' => 'Data Berhasil Dihapus'
            );
        } else {
            $notifikasi = Array(
                'msgType' => 'error',
                'msgTitle' => 'Error',
                'msg' => 'Data Berhasil Dihapus'
            );
        }
         $this->session->set_flashdata('notif', $notifikasi);
        //echo $model;
        redirect('parameter/master_pengguna_asset/home');
    }

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */