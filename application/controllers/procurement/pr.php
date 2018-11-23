<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class pr extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('admin/konfigurasi_menu_status_user_m');
        $this->load->model('global_m');
        $this->load->model('procurement/master_pr_m');
        
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

        $menuId = $this->home_m->get_menu_id('procurement/po/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        $data['zonasi1'] = $this->global_m->tampil_zone1();
        $data['branch'] = $this->global_m->tampil_division();
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
            $this->template->set('title', 'PO');
            // $this->template->load('template/template_dataTable', 'procurement/po/test', $data);
            $this->template->load('template/template_dataTable', 'procurement/pr/table_tiket', $data);
            // $this->template->load('template/template_dataTable', 'v_po_2', $data);
        }
    } else {
      $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);
            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan','id_kyw','nama_kyw','id_kyw');
            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user','goluser_id','goluser_desc','goluser_id');
            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user','statususer_id','statususer_desc','statususer_id');
            
            $this->template->set('title', 'Create Tiket HPS');
            // $this->template->load('template/template_dataTable', 'procurement/po/test', $data);
            $this->template->load('template/template_dataTable', 'procurement/pr/table_tiket', $data);
            // $this->template->load('template/template_dataTable', 'v_po_2', $data);
        }
    }

    public function getTableList() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->master_pr_m->getList();
        $data['data'] = array();
        foreach ($rows as $row) {
            $array = array(
                'tgl' => trim($row->TANGGAL),
                'div' => trim($row->DIVISI),
                'nama' => trim($row->NAMA_BARANG),
                'spek' => trim($row->JUMLAH),
                'jml' => trim($row->SPESIFIKASI),
                'status' => trim($row->STATUS),
                'aksi' => '',
            );
            // var_dump($array['jumlah']);exit();

            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }

    public function savedata()
    {
        $data['TANGGAL'] = date("Y-m-d", strtotime($this->input->post('tgl')));
        $data['DIVISI'] = $this->input->post('divisi');
        $data['NAMA_BARANG'] = $this->input->post('nama');
        $data['JUMLAH'] = $this->input->post('jml');
        $data['SPESIFIKASI'] = $this->input->post('spek');
        $data['STATUS'] = 'PENGAJUAN';

        $po_id = $this->master_pr_m->save_tiket($data);

        redirect('procurement/pr/home');
    }
  
}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */