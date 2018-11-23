<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Fpur extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata("is_login") === FALSE) {
            $this->sso->log_sso();
        } else {
            session_start();
            $this->load->model('home_m');
            $this->load->model('admin/konfigurasi_menu_status_user_m');
            $this->load->model('global_m');
            $this->load->model('procurement/ias_mdl');
            $this->load->model('procurement/cek_barang_mdl');
            $this->load->model('procurement/fpur_mdl');
            $this->load->model('api/api_m');
            $this->load->model('datatables_custom');
        }
    }

    public function index(){
    	$menuId = $this->home_m->get_menu_id('procurement/budget/home');
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
        $data['dd_jns_budget'] = $this->global_m->tampil_data('SELECT ID_JNS_BUDGET,BUDGET_DESC FROM TBL_R_JNS_BUDGET');
        $data['dd_Division'] = $this->global_m->tampil_data("SELECT DivisionID, DivisionName FROM Mst_Division where Is_trash=0");
        $data['dd_Branch'] = $this->global_m->tampil_data("SELECT BranchID, BranchName FROM Mst_Branch where Is_trash=0");


    	$this->template->set('title', 'IAS');
        $this->template->load('template/template_dataTable', 'procurement/fpur/fpur', $data);
    }

    public function ajax_table_fpur() {
        $icolumn = array('ID_PO', 'ID_PR', 'NAMA_BARANG', 'STATUS_CEK', 'status_ke', 'TGL_PR', 'BranchID', 'BRANCH_DESC');
        $ilike = array(
            $this->input->post('sSearch') => $_POST['search']['value']
        );

        if (!empty($this->input->post('sMulai')) && !empty($this->input->post('sSampai'))) {
            $iwhere = array(
                'TGL_PR <' => date("Y-m-d", strtotime($this->input->post('sMulai'))),
                'TGL_PR >' => date("Y-m-d", strtotime($this->input->post('sSampai')))
            );
        }else{
            $iwhere = array();
        }

        $iorder = array('ID_PR' => 'asc');
        $list = $this->datatables_custom->get_datatables('VW_IAS', $icolumn, $iorder, $iwhere, $ilike);

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();

            $row[] = $idatatables->ID_PR;
            $row[] = $idatatables->ID_PO;
            $row[] = $idatatables->TGL_PR;
            $row[] = $idatatables->BRANCH_DESC;
            $row[] = $idatatables->NAMA_BARANG;
            $row[] = $idatatables->BranchID;
            $row[] = $idatatables->status_ke;
            $row[] = $idatatables->STATUS_CEK;
            $row[] = '<a href="'.base_url().'procurement/fpur/detail_fpur/'.$idatatables->ID_PO.'" class="btn btn-primary">VIEW</a>';

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

    public function ajax_table_fpum() {
        $icolumn = array('ID_PO', 'ID_PR', 'NAMA_BARANG', 'STATUS_CEK', 'status_ke', 'TGL_PR', 'BranchID', 'BRANCH_DESC');
        $ilike = array(
            $this->input->post('sSearch') => $_POST['search']['value']
        );

        if (!empty($this->input->post('sMulai')) && !empty($this->input->post('sSampai'))) {
            $iwhere = array(
                'TGL_PR <' => date("Y-m-d", strtotime($this->input->post('sMulai'))),
                'TGL_PR >' => date("Y-m-d", strtotime($this->input->post('sSampai')))
            );
        }else{
            $iwhere = array();
        }

        $iorder = array('ID_PR' => 'asc');
        $list = $this->datatables_custom->get_datatables('VW_IAS', $icolumn, $iorder, $iwhere, $ilike);

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();

            $row[] = $idatatables->ID_PR;
            $row[] = $idatatables->ID_PO;
            $row[] = $idatatables->TGL_PR;
            $row[] = $idatatables->BRANCH_DESC;
            $row[] = $idatatables->NAMA_BARANG;
            $row[] = $idatatables->BranchID;
            $row[] = $idatatables->status_ke;
            $row[] = $idatatables->STATUS_CEK;
            $row[] = '<a href="'.base_url().'procurement/fpur/detail_fpum/'.$idatatables->ID_PO.'" class="btn btn-primary">VIEW</a>';

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

    public function detail_fpur($id_detail){
    	$ops = $this->ias_mdl->get_var();
        $ret_val = "<option disabled selected>Pilih Variable</option>";
        foreach ($ops as $op) {
            $ret_val .= "<option value='".$op->BOBOT."-".$op->ID_VNILAI."'>".$op->VARIABEL."</option>";
        }
        $data['var'] = $ret_val;

        $ndoc = $this->ias_mdl->get_doc();
        $doc_val = "<option disabled selected>Pilih Dokumen</option>";
        foreach ($ndoc as $doc) {
            $doc_val .= "<option value='".$doc->ID_DOC."'>".$doc->NAMA_DOC."</option>";
        }
        $data['doc'] = $doc_val;

        $menuId = $this->home_m->get_menu_id('procurement/budget/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        $get_ias = $this->ias_mdl->get_all_ias($id_detail);
        $data['dpp'] = $this->ias_mdl->get_dpp($id_detail);
        $data['quant'] = $this->ias_mdl->get_quant($id_detail);
        $data['detail'] = $this->cek_barang_mdl->get_detail($id_detail);
        $data['barang'] = $this->cek_barang_mdl->get_one_barang($id_detail);
        $data['ias'] = $this->ias_mdl->get_ias($data['detail']->ID_PO);
        $all_termin = $this->ias_mdl->get_all_termin($id_detail);
        if ((count($all_termin)-1) == count($get_ias)) {
            $data['last_termin'] = '1';
        }

        if (count($get_ias) >= count($all_termin)) {
            $data['done_termin'] = '1';
        }

        $data['all_item'] = $this->cek_barang_mdl->get_all_barang($id_detail);
        $jt_barang = new DateTime($this->cek_barang_mdl->get_termin($data['detail']->ID_PO)->TGL_JT_TERIMA_BRG);
        $jt_po = new DateTime($data['barang']->TGL_TERIMA);
        $diff = $jt_barang->diff($jt_po);
        $total = $data['detail']->TTL_HARGA;
        $data['total'] = intval((1/1000)*$total*$diff->days);
        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
        $data['dd_jns_budget'] = $this->global_m->tampil_data('SELECT ID_JNS_BUDGET,BUDGET_DESC FROM TBL_R_JNS_BUDGET');
        $data['dd_Division'] = $this->global_m->tampil_data("SELECT DivisionID, DivisionName FROM Mst_Division where Is_trash=0");
        $data['dd_Branch'] = $this->global_m->tampil_data("SELECT BranchID, BranchName FROM Mst_Branch where Is_trash=0");

        $this->template->set('title', 'FORM FPUR');
        $this->template->load('template/template_dataTable', 'procurement/fpur/detail_fpur', $data);
    }

    public function detail_fpum($id_detail){
    	 $ops = $this->ias_mdl->get_var();
        $ret_val = "<option disabled selected>Pilih Variable</option>";
        foreach ($ops as $op) {
            $ret_val .= "<option value='".$op->BOBOT."-".$op->ID_VNILAI."'>".$op->VARIABEL."</option>";
        }
        $data['var'] = $ret_val;

        $ndoc = $this->ias_mdl->get_doc();
        $doc_val = "<option disabled selected>Pilih Dokumen</option>";
        foreach ($ndoc as $doc) {
            $doc_val .= "<option value='".$doc->ID_DOC."'>".$doc->NAMA_DOC."</option>";
        }
        $data['doc'] = $doc_val;

        $menuId = $this->home_m->get_menu_id('procurement/budget/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        $get_ias = $this->ias_mdl->get_all_ias($id_detail);
        $data['dpp'] = $this->ias_mdl->get_dpp($id_detail);
        $data['quant'] = $this->ias_mdl->get_quant($id_detail);
        $data['detail'] = $this->cek_barang_mdl->get_detail($id_detail);
        $data['barang'] = $this->cek_barang_mdl->get_one_barang($id_detail);
        $data['ias'] = $this->ias_mdl->get_ias($data['detail']->ID_PO);
        $all_termin = $this->ias_mdl->get_all_termin($id_detail);
        if ((count($all_termin)-1) == count($get_ias)) {
            $data['last_termin'] = '1';
        }

        if (count($get_ias) >= count($all_termin)) {
            $data['done_termin'] = '1';
        }

        $data['all_item'] = $this->cek_barang_mdl->get_all_barang($id_detail);
        $jt_barang = new DateTime($this->cek_barang_mdl->get_termin($data['detail']->ID_PO)->TGL_JT_TERIMA_BRG);
        $jt_po = new DateTime($data['barang']->TGL_TERIMA);
        $diff = $jt_barang->diff($jt_po);
        $total = $data['detail']->TTL_HARGA;
        $data['total'] = intval((1/1000)*$total*$diff->days);
        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
        $data['dd_jns_budget'] = $this->global_m->tampil_data('SELECT ID_JNS_BUDGET,BUDGET_DESC FROM TBL_R_JNS_BUDGET');
        $data['dd_Division'] = $this->global_m->tampil_data("SELECT DivisionID, DivisionName FROM Mst_Division where Is_trash=0");
        $data['dd_Branch'] = $this->global_m->tampil_data("SELECT BranchID, BranchName FROM Mst_Branch where Is_trash=0");

        $this->template->set('title', 'FORM FPUM');
        $this->template->load('template/template_dataTable', 'procurement/fpur/detail_fpum', $data);
    }

    public function update_fpur($id){
		$head['TYPE_FPUR'] = $this->input->post("type_fpur");
		$head['NO_FPUR'] = $this->input->post("no_fpur");
		$head['JML'] = $this->input->post("jumlah");
		$head['NAMA_REK'] = $this->input->post("nama_rekening");
		$head['NO_REK'] = $this->input->post("no_rekening");
		$head['NAMA_BANK'] = $this->input->post("bank");
		$head['ALAMAT_BANK'] = $this->input->post("alamat_bank");
		$head['DOC_FPUR_PATH'] = $this->input->post("dokumen_kelengkapan");
    	$this->fpur_mdl->save_fpur($head);
    	redirect('procurement/fpur/');
    }

     public function update_fpum(){
    	$head['TYPE_FPUR'] = $this->input->post("type_fpur");
		$head['NO_FPUR'] = $this->input->post("no_fpur");
		$head['JML'] = $this->input->post("jumlah");
		$head['NAMA_REK'] = $this->input->post("nama_rekening");
		$head['NO_REK'] = $this->input->post("no_rekening");
		$head['NAMA_BANK'] = $this->input->post("bank");
		$head['ALAMAT_BANK'] = $this->input->post("alamat_bank");
		$head['DOC_FPUR_PATH'] = $this->input->post("dokumen_kelengkapan");
    	$id_pfur = $this->fpur_mdl->save_fpur($head);

    	$head_fpum['ID_FPUR'] = $id_pfur;
    	$head_fpum['NO_FPUM'] = $this->input->post("no_fpum");
    	$head_fpum['KET_JML'] = $this->input->post("ket_jumlah_fpum");
    	$head_fpum['JUMLAH'] = $this->input->post("jumlah_fpum");
    	$head_fpum['DOC_FPUM_PATH'] = $this->input->post("dokumen_kelengkapan_fpum");
    	$this->fpur_mdl->save_fpum($head_fpum);
    	redirect('procurement/fpur/');
    }
}