<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Main extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library("session");
        if ($this->session->userdata("is_login") === FALSE) {
            $this->sso->log_sso();
        } else {
            $this->load->model('home_m');
            $this->load->model('user_m');
            $this->load->model('dashboard/dashboard_m');
            $this->load->helper('cookie');
            session_start();
        }
    }

    public function index() {
        if ($this->auth->is_logged_in() == false) {
            $this->login();
        } else {
            $data ['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            //$data ['nama'] = $this->home_m->get_nama_kantor ();
            $data['menu_id'] = 0;
            $tanggal = $this->session->userdata('tgl_d');
            $this->template->set('title', 'Mega Jaya | Beranda');
            $this->template->set('title', 'Home');
            $this->template->load('template/template1', 'dashboard_v', $data);
        }
    }

    public function login() {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('tgl_login', 'tgl login', 'trim|required');
        $this->form_validation->set_error_delimiters(' <span style="color:#FF0000">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $tanggal_hari_ini = $this->home_m->get_tanggal_hari_ini();
            $data ['tanggal_hari_ini'] = $tanggal_hari_ini[0]->value;

            $lembaga_nama = $this->home_m->get_lembaga_nama();
            $data ['lembaga_nama'] = $lembaga_nama[0]->value; //
            //COPYRIGHT 
            $aplikasi_nama = $this->home_m->get_aplikasi_copyright();
            $data['copyright_year'] = $aplikasi_nama[0]->value;
            $aplikasi_nama = $this->home_m->get_aplikasi_copyright();
            $data ['copyright_content'] = $aplikasi_nama[1]->value;
            //END COPYRIGHT
            //TITLE
            $data ['title'] = "SIMI | Login";
            //END TITLE
            //VIEW
            $this->load->view('global/login_v', $data);
            //END VIEW
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $nama_kantor = $this->input->post('nama_kantor');
            //$jenis_kantor = $this->input->post ( 'daftar_kantor' );//
            //
            $tgl_y = $this->input->post('tgl_login');
            $tgl_d = date('d-m-Y', strtotime($tgl_y));
            //
            $tanggalWaktu = date("Y-m-d H:i:s");

            $success = $this->auth->do_login($username, $password, $tgl_d, $tgl_y, $nama_kantor, $tanggalWaktu);

            if ($success) {

                $data ['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
                //$data ['nama'] = $this->home_m->get_nama_kantor ();
                $this->template->set('title', 'Microtech | Beranda');
                //$a = $this->template->load ( 'template/template1', 'bpr/index',$data );
                redirect('/main/index');
            } else {
                $tanggal_hari_ini = $this->home_m->get_tanggal_hari_ini();
                $data ['tanggal_hari_ini'] = $tanggal_hari_ini[0]->value;

                /* $data ['daftar_kantor'] 	= $this->home_m->get_daftar_kantor (); */
                $lembaga_nama = $this->home_m->get_lembaga_nama();
                $data ['lembaga_nama'] = $lembaga_nama[0]->value; //
                //COPYRIGHT 
                $aplikasi_nama = $this->home_m->get_aplikasi_copyright();
                $data['copyright_year'] = $aplikasi_nama[0]->value;
                $aplikasi_nama = $this->home_m->get_aplikasi_copyright();
                $data ['copyright_content'] = $aplikasi_nama[1]->value;
                //END COPYRIGHT
                //TITLE
                $data ['title'] = "Microtech Web | Login";
                //END TITLE
                //$data ['login_info'] = "Maaf, username dan password salah!";
                $data ['login_info'] = "Maaf, username dan password salah!";
                $this->load->view('global/login_v', $data);
            }//else if (success)*/
        }// else if ($this->form_validation->run () == FALSE) {
    }

    public function vResetPassword() {
        $data ['title'] = "SKI | Reset Password";
        $this->load->view('global/resetPasswordV', $data);
    }

    public function resetPassword() {

        $userId = $this->input->post('username');
        $password = trim($this->input->post('password'));

        $data = array(
            'password' => $password,
            'status_password' => 1
        );

        $updatePasswd = $this->home_m->updatePassword($userId, $data);

        if ($updatePasswd) {
            $session_data = array(
                'user_id' => $userId,
                'idroom' => get_cookie('idroom'),
                'idcust' => get_cookie('idcust'),
                'no_va_jaminan' => get_cookie('no_va_jaminan'),
                'namaroom' => get_cookie('namaroom'),
                'namacust' => get_cookie('namacust'),
                'usergroup' => get_cookie('usergroup'),
                'usergroup_desc' => get_cookie('usergroup_desc'),
                'nama_lokasi' => get_cookie('nama_lokasi'),
                'nama_tower' => get_cookie('nama_tower'),
                'nama_lantai' => get_cookie('nama_lantai'),
                'id_lokasi' => get_cookie('id_lokasi'),
                'nama_cabang' => get_cookie('nama_cabang'),
                'id_cabang' => get_cookie('id_cabang'),
                'nama_regional' => get_cookie('nama_regional'),
                'id_regional' => get_cookie('id_regional'),
                'tgl_y' => get_cookie('tgl_y'),
                'tgl_d' => get_cookie('tgl_d')
            );
            // buat session
            delete_cookie("idroom");
            delete_cookie("idcust");
            delete_cookie("no_va_jaminan");
            delete_cookie("namaroom");
            delete_cookie("namacust");
            delete_cookie("usergroup");
            delete_cookie("usergroup_desc");
            delete_cookie("nama_lokasi");
            delete_cookie("nama_tower");
            delete_cookie("nama_lantai");
            delete_cookie("id_lokasi");
            delete_cookie("nama_cabang");
            delete_cookie("id_cabang");
            delete_cookie("nama_regional");
            delete_cookie("usergroup_desc");
            delete_cookie("id_regional");
            delete_cookie("tgl_y");
            delete_cookie("tgl_d");
            $this->session->set_userdata($session_data);
            redirect('main/login_penghuni');
        } else {
            $data ['title'] = "Microtech Web | Login";
            $data ['login_info'] = 'Reset password gagal.';
            $this->load->view('global/login_v', $data);
        }
    }

    public function logout() {
        if ($this->auth->is_logged_in() == true) {
            // jika dia memang sudah login, destroy session
            $this->auth->do_logout();
            $this->session->sess_destroy();
        }
        // larikan ke halaman utama
        redirect('main');
        //$this->load->view ( 'admin/login_form' );
    }

    public function logout2() {
        if ($this->auth->is_logged_in2() == true) {
            // jika dia memang sudah login, destroy session
            $this->auth->do_logout();
            $this->session->sess_destroy();
        }
        // larikan ke halaman utama
        redirect('main/login_penghuni');
        //$this->load->view ( 'admin/login_form' );
    }

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */
