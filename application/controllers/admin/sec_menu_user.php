<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sec_menu_user extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('admin/sec_menu_user_m');
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
     
        $menuId = $this->home_m->get_menu_id('admin/sec_menu_user/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
      
//        dd($this->input->post('btnSimpanRoot'));
//print_r($_POST["btnSimpanRoot"]);die();
        if (isset($_POST["btnSimpan"])) {
            $this->simpan();
        } elseif (isset($_POST["btnUbah"])) {
            $this->ubah();
        } elseif (isset($_POST["btnHapus"])) {
            $this->hapus();
        } elseif (isset($_POST["btnSimpanRoot"])) {
            $this->simpanRoot();
        } elseif (isset($_POST["btnUbahRoot"])) {
            $this->ubahRoot();
        } elseif (isset($_POST["btnHapusRoot"])) {
            $this->hapusRoot();
        } else {
              
            $data['multilevel'] = $this->user_m->get_data(0,$this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);

            $this->template->set('title', 'home');
            $this->template->load('template/template_treeView', 'admin/sec_menu_user_v', $data);
        }
    }

    function getDescMenu() {
        $this->CI = & get_instance();
        $idMenu = $this->input->post('idMenu', TRUE);
        $rows = $this->sec_menu_user_m->getDescMenu($idMenu);
        if ($rows) {
            foreach ($rows as $row)
                $header = $row->menu_header;
            $urutan = $row->menu_seq;
            $array = array(
                'baris' => 1,
                'header' => $header,
                'urutan' => $urutan
            );
        } else {
            $array = array('baris' => 0);
        }

        $this->output->set_output(json_encode($array));
    }

    function simpan() {
        $idParent = trim($this->input->post('idParent'));
        $descMenu = trim($this->input->post('descMenu'));
        $uriMenu = trim($this->input->post('uriMenu'));
        $headerMenu = trim($this->input->post('headerMenu'));
        $urutMenu = trim($this->input->post('urutMenu'));
        $idmax = $this->home_m->getIdMax();    
  
        $data = array(
            'menu_id' => $idmax,
            'menu_nama' => $descMenu,
            'menu_uri' => $uriMenu,
            'menu_header' => $headerMenu,
            'parent' => $idParent,
            'menu_allowed' => '',
            'menu_seq' => $urutMenu,
            'lvl' => 1
        );
//        print_r($data); die();
        $model = $this->sec_menu_user_m->insert_menu_user_m($data);
        if ($model) {
            $this->session->set_flashdata('success', 'Simpan menu user berhasil !');
            redirect('admin/sec_menu_user/home');
        } else {
            $this->session->set_flashdata('error', 'Simpan menu user gagal !');
            redirect('admin/sec_menu_user/home');
        }
    }

    function ubah() {
        $idParent = trim($this->input->post('idParent'));
        $idMenu = trim($this->input->post('idMenu'));
        $descMenu = trim($this->input->post('descMenu'));
        $uriMenu = trim($this->input->post('uriMenu'));
        $headerMenu = trim($this->input->post('headerMenu'));
        $urutMenu = trim($this->input->post('urutMenu'));

        $data = array(
            'menu_id' => $idMenu,
            'menu_nama' => $descMenu,
            'menu_uri' => $uriMenu,
            'parent' => $idParent,
            'menu_header' => $headerMenu,
            'menu_seq' => $urutMenu
        );
        $model = $this->sec_menu_user_m->update_menu_user_m($idMenu, $data);
        if ($model) {
            $this->session->set_flashdata('success', 'Ubah menu user berhasil !');
            redirect('admin/sec_menu_user/home');
        } else {
            $this->session->set_flashdata('error', 'Ubah menu user gagal !');
            redirect('admin/sec_menu_user/home');
        }
    }

    function hapus() {
        $idParent = trim($this->input->post('idParent'));
        $idMenu = trim($this->input->post('idMenu'));
        $descMenu = trim($this->input->post('descMenu'));
        $uriMenu = trim($this->input->post('uriMenu'));
        $data = array(
            'menu_id' => $idMenu,
        );

        $modelCek = $this->sec_menu_user_m->cek_menuChild_user_m($idMenu);
        if ($modelCek == 0) {
            $model = $this->sec_menu_user_m->delete_menu_user_m($idMenu, $data);
            if ($model) {
                $this->session->set_flashdata('success', 'Hapus menu user berhasil !');
                redirect('admin/sec_menu_user/home');
            } else {
                $this->session->set_flashdata('error', 'Hapus menu user gagal !');
                redirect('admin/sec_menu_user/home');
            }
        } else {
            $this->session->set_flashdata('error', 'Hapus menu user gagal, root menu mempunyai child !');
            redirect('admin/sec_menu_user/home');
        }
    }

    function simpanRoot() {
        $descRootMenu = trim($this->input->post('descRootMenu'));
        $urutanRootMenu = trim($this->input->post('urutRootMenu'));
        $getID = $this->home_m->getIdMax();
//        die($getID);
        $data = array(
            'menu_id' => $getID,
            'menu_nama' => $descRootMenu,
            'menu_uri' => '#',
            'menu_header'=>'',
            'parent' => 0,
            'menu_allowed' => '',
            'menu_seq' => $urutanRootMenu,
            'lvl' => 1,
        );
//        print_r($data);
//        die();
        $model = $this->sec_menu_user_m->insert_menu_user_m($data);
        if ($model) {
            $this->session->set_flashdata('successRoot', 'Simpan root menu user berhasil !');
            redirect('admin/sec_menu_user/home');
        } else {
            $this->session->set_flashdata('errorRoot', 'Simpan root menu user gagal !');
            redirect('admin/sec_menu_user/home');
        }
    }

    function ubahRoot() {
        $idRootMenu = trim($this->input->post('idRootMenu'));
        $descRootMenu = trim($this->input->post('descRootMenu'));
        $urutanRootMenu = trim($this->input->post('urutRootMenu'));
        $data = array(
            'menu_id' => $idRootMenu,
            'menu_nama' => $descRootMenu,
            'menu_seq' => $urutanRootMenu
        );
        $model = $this->sec_menu_user_m->update_menu_user_m($idRootMenu, $data);
        if ($model) {
            $this->session->set_flashdata('successRoot', 'Ubah root menu user berhasil !');
            redirect('admin/sec_menu_user/home');
        } else {
            $this->session->set_flashdata('errorRoot', 'Ubah root menu user gagal !');
            redirect('admin/sec_menu_user/home');
        }
    }

    function hapusRoot() {
        $idRootMenu = trim($this->input->post('idRootMenu'));
        $data = array(
            'menu_id' => $idRootMenu,
        );
        $modelCek = $this->sec_menu_user_m->cek_menuChild_user_m($idRootMenu);
        if ($modelCek == 0) {
            $model = $this->sec_menu_user_m->delete_menu_user_m($idRootMenu, $data);
            if ($model) {
                $this->session->set_flashdata('successRoot', 'Hapus menu user berhasil !');
                redirect('admin/sec_menu_user/home');
            } else {
                $this->session->set_flashdata('errorRoot', 'Hapus menu user gagal !');
                redirect('admin/sec_menu_user/home');
            }
        } else {
            $this->session->set_flashdata('errorRoot', 'Hapus menu user gagal, root menu mempunyai child !');
            redirect('admin/sec_menu_user/home');
        }
    }

}

/* End of file sec_menu_user.php */
/* Location: ./application/controllers/sec_menu_user.php */