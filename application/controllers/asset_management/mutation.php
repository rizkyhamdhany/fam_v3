<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Mutation extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata("is_login") === FALSE) {
            $this->sso->log_sso();
        } else {
            session_start();
            $this->load->model('home_m');
            $this->load->model('admin/konfigurasi_menu_status_user_m');
//        $this->load->model('zsessions_m');
            $this->load->model('global_m');
            $this->load->model('procurement/menu_mdl', 'Menu_mdl');
            $this->load->model('asset_management/mutation_mdl', 'mutation');
            $this->load->model('datatables_custom');
        }
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
        $menuId = $this->home_m->get_menu_id('asset_management/mutation/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        //$data['level_user'] = $this->sec_user_m->get_level_user();

        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
        $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan', 'id_kyw', 'nama_kyw', 'id_kyw');
        $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user', 'goluser_id', 'goluser_desc', 'goluser_id');
        $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user', 'statususer_id', 'statususer_desc', 'statususer_id');

        $this->template->set('title', 'Mutation');
        $this->template->load('template/template_dataTable', 'asset_management/mutation/mutation_v', $data);
    }

    public function ajax_GridMutation() {
        $div = $this->session->userdata('DivisionID');
        $branch = $this->session->userdata('BranchID');
        $usergroup = $this->session->userdata('groupid');
        if ($branch == 1) { //JIKA PUSAT : semua ppi bisa lihat data kecuali ppi dengan usergroup support
            if (($div == '8' && $usergroup <> '3') || $div == '20' || $usergroup == '1') {
                $iwhere = array(
                    'Date' => date('Y-m'),
                    $this->input->post('sSearch') => $_POST['search']['value']
                );
            } else {
                $iwhere = array(
                    'Date' => date('Y-m'),
                    'DivisionID' => $div,
                    $this->input->post('sSearch') => $_POST['search']['value']
                );
            }
        } else { //JIKA CABANG : cabang hanya bisa melihat cabang dan divisinya saja
            $iwhere = array(
                'Date' => date('Y-m'),
                'BranchID' => $div,
                $this->input->post('sSearch') => $_POST['search']['value']
            );
        }

        $icolumn = array('pid', 'ZoneName', 'BranchName', 'FAID', 'ItemName', 'QTY', 'Condition', 'BranchCode', 'DivisionName', 'BisUnitName');
        $iorder = array('pid' => 'asc');

        if ($this->input->post('sSearch') == 'Value1') {
            $list = $this->datatables_custom->get_datatables('vw_asset_mutation2', $icolumn, $iorder, $iwhere);
        } else {
            $list = $this->datatables_custom->get_datatables('vw_asset_mutation', $icolumn, $iorder, $iwhere);
        }
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {
            $statuspembayaran = (empty($idatatables->SetDatePayment)) ? 'disabled' : '';
            $tujuan = $this->mutation->getBranchFromCode(substr($idatatables->FAID, 11, 5));
            $irow = '';
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $idatatables->ZoneName;
            $row[] = ((int) $idatatables->BranchCode == 00000) ? $idatatables->BranchName . ' - ' . $idatatables->DivisionName : $idatatables->BranchName . ' => <strong>' . (((int) $tujuan->BranchCode == 00000) ? $tujuan->DivisionName : $tujuan->BranchName) . '</strong>' . ($idatatables->BisUnitName == '') ? '' : '<strong>[' . $idatatables->BisUnitName . ']</strong>';
            $row[] = $idatatables->FAID;
            $row[] = $idatatables->ItemName;
            $row[] = $idatatables->QTY;
            if (!empty($idatatables->FAID)) {
                $irow = '<a href="' . base_url() . 'uploads/qr_code/' . trim($idatatables->FAID) . '.png" download="' . trim($idatatables->FAID) . '.png">'
                        . '<img src="' . base_url() . 'uploads/qr_code/' . trim($idatatables->FAID) . '.png" style="width: 30px; height:30px"></a>.';
            }
            $row[] = $irow;
            $row[] = $idatatables->Condition;
            $row[] = '<a data-toggle="modal" data-target="#myModal" id="' . $idatatables->FAID . '" onclick="detilasset(this)"><button class="btn btn-primary btn-xs" type="button" >Depreciation</button></a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatables_custom->count_all(),
            "recordsFiltered" => $this->datatables_custom->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function detilasset($id) {

        $data = $this->mutation->getDetil($id);
        $icount = count($data);
        $datas = array(
            'listdata' => $data,
            'icount' => $icount
        );
        $this->load->view('asset_management/mutation/detil_asset', $datas);
    }

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */