<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sec_user extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('admin/konfigurasi_menu_status_user_m');
        $this->load->model('global_m');
        $this->load->model('admin/sec_user_m');
        
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
        $menuId = $this->home_m->get_menu_id('admin/sec_user/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        //$data['level_user'] = $this->sec_user_m->get_level_user();
        
        if (isset($_POST["userId"])) {
            $id = trim($_POST["userId"]);
            if($id == ''){
                $this->simpan();
            }else{
                $this->ubah();
            }
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);
            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan','id_kyw','nama_kyw','id_kyw');
            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user','goluser_id','goluser_desc','goluser_id');
            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user','statususer_id','statususer_desc','statususer_id');
            
            $this->template->set('title', 'Konfigurasi User');
            $this->template->load('template/template_dataTable', 'admin/sec_user_v', $data);
        }
    }

    public function getUserInfo() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->sec_user_m->getUserInfo();
        $data['data'] = array();
        foreach ($rows as $row) {
            $passwd = base64_decode($row->password);
            $array = array(
                'userid' => trim($row->userid),
                'username' => trim($row->username),
                'nama_kyw' => trim($row->nama_kyw),
                'passwd' => $passwd,
                'usergroup' => trim($row->usergroup),
                'id_kyw' => trim($row->id_kyw)
            );

            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }

    function simpan() {
        $userName = trim($this->input->post('userName'));
        $idKyw = trim($this->input->post('karyawan'));
        //$userFullName = $this->sec_user_m->getNamaKaryawan($idKyw);
        $password = base64_encode(trim($this->input->post('kataKunci')));
        $groupUser = trim($this->input->post('userGroup'));

        $data = array(
            'userid' => '0',
            'id_kyw' => $idKyw,
            'username' => $userName,
//            'userfullname'		        =>$userFullName,
            'password' => $password,
            'status_password' => 0,
            'tgl_password' => $this->session->userdata('tgl_y'),
            'usergroup' => $groupUser,
            
             'ZoneID'=>1,
            'DivisionID'=>27,
            'BranchID'=>1

           
        );
        $model = $this->global_m->simpan($this->tabel_utama, $data);
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
        redirect('admin/sec_user/home');
        
    }

    function ubah() {
        $userId = trim($this->input->post('userId'));
        $userName = trim($this->input->post('userName'));
        $idKyw = trim($this->input->post('karyawan'));
        $userFullName = $this->sec_user_m->getNamaKaryawan($idKyw);
        $password = base64_encode(trim($this->input->post('kataKunci')));
        $groupUser = trim($this->input->post('userGroup'));

        $data = array(
            'id_kyw' => $idKyw,
            'username' => $userName,
//            'userfullname'		        =>$userFullName,
            'password' => $password,
            'status_password' => 0,
            'tgl_password' => $this->userdata('tgl_y'),
            'usergroup' => $groupUser
        );
        $model = $this->global_m->ubah($this->tabel_utama, $data,'userid',$userId);
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
        //echo $model;
        redirect('admin/sec_user/home');
    }

    function hapus() {
        $this->CI = & get_instance();
        $userId = $this->input->post('userId', TRUE);
        $model = $this->sec_user_m->deleteUser($userId);
        if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Data berhasil dihapus.'
            );
        } else {
            $array = array(
                'act' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Data gagal dihapus.'
            );
        }
        $this->output->set_output(json_encode($array));
    }

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */