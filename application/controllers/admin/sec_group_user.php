<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sec_group_user extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('admin/sec_group_user_m');
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
    public function getUserGroupAll() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->sec_group_user_m->getUserGroupAll();
        $data['data'] = array();
        foreach ($rows as $row) {
            $array = array(
                'usergroupId' => trim($row->usergroup_id),
                'usergroupDesc' => trim($row->usergroup_desc)
            );

            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }
    function home() {
        $menuId = $this->home_m->get_menu_id('admin/sec_group_user/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);

        if (isset($_POST["btnSimpan"])) {
            $this->simpan();
        } elseif (isset($_POST["btnUbah"])) {
            $this->ubah();
        } elseif (isset($_POST["btnHapus"])) {
            $this->hapus();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            //$data['data_user_group'] = $this->sec_group_user_m->get_user_group_modal();

            $this->template->set('title', 'Home');
            $this->template->load('template/template_dataTable', 'admin/sec_group_user_v', $data);
        }
    }

    function simpan() {
        $desc_group_user = trim($this->input->post('descUsergroup'));
        $id_group_user  = $this->sec_group_user_m->generateRandomString();
        $data = array(
            'usergroup_id' => $id_group_user,
            'usergroup_desc' => $desc_group_user
        );
        $model = $this->sec_group_user_m->insert_group_user_m($data);
        if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Data berhasil disimpan.'
            );
        } else {
            $array = array(
                'act' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Data gagal disimpan.'
            );
        }
        $this->output->set_output(json_encode($array));
    }
    

    function ubah() {
        $id_group_user = trim($this->input->post('idUsergroup'));
        $desc_group_user = trim($this->input->post('descUsergroup'));
        $data = array(
            'usergroup_desc' => $desc_group_user
        );
        $model = $this->sec_group_user_m->update_group_user_m($id_group_user, $data);
        if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Data berhasil diubah.'
            );
        } else {
            $array = array(
                'act' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Data gagal diubah.'
            );
        }
        $this->output->set_output(json_encode($array));
    }

    function hapus() {
        $id_group_user = trim($this->input->post('idM'));
        $model = $this->sec_group_user_m->delete_group_user_m($id_group_user);
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

/* End of file sec_group_user.php */
/* Location: ./application/controllers/sec_group_user.php */