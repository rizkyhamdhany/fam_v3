<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_dept extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('master_dept_m');
        session_start();
    }

    public function index() {
        if ($this->auth->is_logged_in() == false) {
            $this->login();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));

            $this->template->set('title', 'Home');
            $this->template->load('template/template1', 'global/index', $data);
        }
    }

    function home() {
        $menuId = $this->home_m->get_menu_id('master_dept/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
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
            $data['menu_all'] = $this->user_m->get_menu_all(0);

            $this->template->set('title', $data['menu_nama']);
            $this->template->load('template/template_dataTable', 'master/master_dept_v', $data);
        }
    }

    public function getDeptAll() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->master_dept_m->getDeptAll();
        $data['data'] = array();
        foreach ($rows as $row) {
            $array = array(
                'idDept' => trim($row->id_dept),
                'namaDept' => trim($row->nama_dept)
            );
            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }

    function simpan() {
        $namaDept = trim($this->input->post('namaDept'));

        $modelidDept = $this->master_dept_m->getIdDept();
        $data = array(
            'id_dept' => $modelidDept,
            'nama_dept' => $namaDept
        );
        $model = $this->master_dept_m->simpan($data);
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
        $idDept = trim($this->input->post('idDept'));
        $namaDept = trim($this->input->post('namaDept'));

        $data = array(
            'nama_dept' => $namaDept
        );

        $model = $this->master_dept_m->ubah($data, $idDept);
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
        $this->CI = & get_instance();
        $idDept = trim($this->input->post('idDept'));
        $model = $this->master_dept_m->hapus($idDept);
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

        //$cekMasterAdv	= $this->master_proyek_m->cekMasterAdvance($kywId);
//    	$cekMasterReqpay	= $this->master_proyek_m->cekMasterReqpay($kywId);
//    	$cekMasterReimpay	= $this->master_proyek_m->cekMasterReimpay($kywId);
        /**
         * if($cekMasterAdv == true && $cekMasterReqpay ==true && $cekMasterReimpay ==true){
         *     		$model = $this->master_proyek_m->deleteProyek( $kywId);
         *     		if($model){
         *     			$array = array(
         *     					'act'	=>1,
         *     					'tipePesan'=>'success',
         *     					'pesan' =>'Data berhasil dihapus.'
         *     			);
         *     		}else{
         *     			$array = array(
         *     					'act'	=>0,
         *     					'tipePesan'=>'error',
         *     					'pesan' =>'Data gagal dihapus.'
         *     			);
         *     		}
         *     	}else{
         *     		$array = array(
         *     				'act'	=>0,
         *     				'tipePesan'=>'error',
         *     				'pesan' =>'Data digunakan pada data master yang lain.</br>Data gagal dihapus.'
         *     		);
         *     	}
         */
        $this->output->set_output(json_encode($array));
    }

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */