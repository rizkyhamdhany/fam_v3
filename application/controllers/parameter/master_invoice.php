<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_invoice extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('admin/konfigurasi_menu_status_user_m');
        $this->load->model('global_m');
        $this->load->model('master_ams_m/master_invoice_m');
        
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
        $menuId = $this->home_m->get_menu_id('parameter/master_invoice/home');
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
//             print_r($act); die('ffff');
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
            $data['propinsi'] = $this->master_invoice_m->getProp();
            $data['grup'] = $this->master_invoice_m->getGrupAset();
          
            $this->template->set('title', 'Master Invoice');
            $this->template->load('template/template_dataTable', 'master_ams/master_invoice_v', $data);
        }
    } else {
            $data['propinsi'] = $this->master_invoice_m->getProp();
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);
            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan','id_kyw','nama_kyw','id_kyw');
            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user','goluser_id','goluser_desc','goluser_id');
            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user','statususer_id','statususer_desc','statususer_id');
            $data['kab'] = $this->master_invoice_m->getKab();
            $data['grup'] = $this->master_invoice_m->getGrupAset();
            $this->template->set('title', 'Master Invoice');
            $this->template->load('template/template_dataTable', 'master_ams/master_invoice_v', $data);
        }
    }

   public function getUserInfo() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->master_invoice_m->getUserInfo();
        $data['data'] = array();
        foreach ($rows as $row) {

            $array = array(
            
                'kodegroup' => trim($row->kodegroup),
                'keteranganinv' => trim($row->keteranganinv),
                'footerinv' => trim($row->footerinv),
                'rekeningbayar' => trim($row->rekeningbayar),
                'umurinvoice' => trim($row->umurinvoice),
                'formatnoinvoice' => trim($row->formatnoinvoice),
                'noakhirinvoice' => trim($row->noakhirinvoice)
            );
            

            array_push($data['data'], $array);
        }

        $this->output->set_output(json_encode($data));
    }
    function simpan() {
    
        $grup = trim($this->input->post('grup'));
        $ketInvoice = trim($this->input->post('ketInvoice'));
        $foot_Invoice = trim($this->input->post('foot_Invoice'));
        $rekInvoice = trim($this->input->post('rekInvoice'));
        $umurInvoice = trim($this->input->post('umurInvoice'));
        $formatNoInvoice = trim($this->input->post('formatNoInvoice'));
        $formatTerInvoice = trim($this->input->post('formatTerInvoice'));

            
        $cekgroup = $this->master_invoice_m->cekGroup($grup);
    
         if($cekgroup[0]->count >= 1)  {
            $notifikasi = Array(
                'msgType' => 'error',
                'msgTitle' => 'Error',
                'msg' => 'Gagal Tersimpan, Parameter Invoice Untuk Kode Group <b>'. $grup .'</b> sudah terdaftar...!'
            );
             $this->session->set_flashdata('notif', $notifikasi);
        redirect('parameter/master_invoice/home');
        }
        
        if($umurInvoice <= 0){
            $notifikasi = Array(
                'msgType' => 'error',
                'msgTitle' => 'Error',
                'msg' => 'Gagal Tersimpan, Umur Invoice harus >= 1'
            );
             $this->session->set_flashdata('notif', $notifikasi);
        redirect('parameter/master_invoice/home');
        }
        if($formatTerInvoice < 0){
            $notifikasi = Array(
                'msgType' => 'error',
                'msgTitle' => 'Error',
                'msg' => 'Gagal Tersimpan, No Akhir Invoice Harus >= 0'
            );
             $this->session->set_flashdata('notif', $notifikasi);
        redirect('parameter/master_invoice/home');
        }
        
     
        
        
        
        $data = array(
            'kodegroup' => $grup,
            'keteranganinv' => $ketInvoice,
            'footerinv' => $foot_Invoice,
            'rekeningbayar' => $rekInvoice,
            'umurinvoice' => $umurInvoice,
            'formatnoinvoice' => $formatNoInvoice,
            'noakhirinvoice' => $formatTerInvoice,
        );
        $model = $this->global_m->simpan('amsparinvoice', $data);
       
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
        redirect('parameter/master_invoice/home');
        
    }

    function ubah() {
   
        $grup = trim($this->input->post('kab'));
        $ketInvoice = trim($this->input->post('ketInvoice'));
        $foot_Invoice = trim($this->input->post('foot_Invoice'));
        $rekInvoice = trim($this->input->post('rekInvoice'));
        $umurInvoice = trim($this->input->post('umurInvoice'));
        $formatNoInvoice = trim($this->input->post('formatNoInvoice'));
        $formatTerInvoice = trim($this->input->post('formatTerInvoice'));
//        die($grup);
        
           $cekgroup = $this->master_invoice_m->cekGroup($grup);
    

        
        $data = array(
//            'kodegroup' => $grup,
            'keteranganinv' => $ketInvoice,
            'footerinv' => $foot_Invoice,
            'rekeningbayar' => $rekInvoice,
            'umurinvoice' => $umurInvoice,
            'formatnoinvoice' => $formatNoInvoice,
            'noakhirinvoice' => $formatTerInvoice,
        );
        
        $model = $this->global_m->ubah('amsparinvoice', $data,'kodegroup',$grup);
    
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
                'msg' => 'Data Gagal Diubah'
            );
        }
           $this->session->set_flashdata('notif', $notifikasi);
        redirect('parameter/master_invoice/home');
        
    }
    function hapus() {
         $this->CI = & get_instance();

          $grup = trim($this->input->post('grup'));
        $model = $this->global_m->deleteUser('amsparinvoice','kodegroup',$grup);
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
        redirect('parameter/master_invoice/home');
    }

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */