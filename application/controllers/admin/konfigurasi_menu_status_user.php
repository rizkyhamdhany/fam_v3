<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Konfigurasi_menu_status_user extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('admin/konfigurasi_menu_status_user_m');
        session_start();
         
    }

    public function index() {
        if ($this->auth->is_logged_in() == false) {
            $this->login();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));

            //$data ['nama'] = $this->home_m->get_nama_kantor ();
            $this->template->set('title', 'home');
            $this->template->load('template/template1', 'global/index', $data);
        }
    }

    function home() {
        $menuId = $this->home_m->get_menu_id('admin/konfigurasi_menu_status_user/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);

        if (isset($_POST["btnSimpan"])) {
            $this->simpan();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);
            $data['status_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
            $data['usergrup'] = $this->session->userdata('usergroup');

            $this->template->set('title', 'Home');
            $this->template->load('template/template_treeView', 'admin/konfigurasi_menu_status_user_v', $data);
        }
    }

    function get_menu_group_user() {
        $this->CI = & get_instance();
        $kd_group_user = $this->input->post('kd_group_user', TRUE);
        $rows = $this->konfigurasi_menu_status_user_m->get_menu_group_user_m($kd_group_user,null);
//      die($rows);
       $data['data_menu'] = array();
        foreach ($rows as $keyword2) {
            $menu_alowed2 = explode('+', $keyword2->menu_allowed);

            foreach ($menu_alowed2 as $keyword) {
//                dd($keyword);
                if ((strlen(trim($keyword)) != 0) && ($keyword == $kd_group_user)) {
                    $array = array(
                        'menu_id' => $keyword2->menu_id,
                        'parent' => $keyword2->parent
                    );
                    array_push($data['data_menu'], $array);
                }else{

                }
            }
        }

//        return json_encode($data);
//        print_r($data);die();
        $this->output->set_output(json_encode($data));
    }

    function simpan() {
        $status_user = trim($this->input->post('status_user'));
        $menu_allow = trim($this->input->post('menu_allow'));

        $data_menu = array();
        $data_menu = explode(',', $menu_allow);
        ///print_r($data_menu);
        //die($menu_allow);
        $simpan = $this->konfigurasi_menu_status_user_m->update_menu_status_user_m($data_menu, $status_user);
        if ($simpan) {
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
        redirect('admin/konfigurasi_menu_status_user/home');
        //header("Location: ".base_url().'admin/konfigurasi_menu_status_user/home');
    }

    function update_level() {
        $this->konfigurasi_menu_status_user_m->update_level();
    }

}

/* End of file akses_user.php */
/* Location: ./application/controllers/akses_user.php */