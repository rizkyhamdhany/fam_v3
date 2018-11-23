<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class cek_barang extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata("is_login") === FALSE) {
            $this->sso->log_sso();
        } else {
            session_start();
            $this->load->model('home_m');
            $this->load->model('admin/konfigurasi_menu_status_user_m');
            $this->load->model('global_m');
            $this->load->model('procurement/cek_barang_mdl');
            $this->load->model('procurement/master_po_m');
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

//        print_r($this->global_m->tampil_data('SELECT * FROM TBL_R_JNS_BUDGET'));die();
//            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan', 'id_kyw', 'nama_kyw', 'id_kyw');
//            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user', 'goluser_id', 'goluser_desc', 'goluser_id');
//            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user', 'statususer_id', 'statususer_desc', 'statususer_id');

        $this->template->set('title', 'Cek Barang');
        $this->template->load('template/template_dataTable', 'procurement/cek_barang/table_cek_v', $data);
    }

    function form($id) {
        $ops = $this->cek_barang_mdl->get_var();
        $ret_val = "<option disabled selected>Pilih Variable</option>";
        foreach ($ops as $op) {
            $ret_val .= "<option value='".$op->BOBOT."'>".$op->VARIABEL."</option>";
        }

        $data['var'] = $ret_val;

        $menuId = $this->home_m->get_menu_id('procurement/budget/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        //$data['level_user'] = $this->sec_user_m->get_level_user();
        $data['ias'] = $this->cek_barang_mdl->get_ias($id);
        $data['barang'] = $this->cek_barang_mdl->get_barang($id);
        $data['lists'] = $this->cek_barang_mdl->get_list($id);
        // var_dump($data['barang']);exit();
        $barang = $this->cek_barang_mdl->get_barang($id);

        // var_dump($data['ias']);exit();

        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
        $data['dd_jns_budget'] = $this->global_m->tampil_data('SELECT ID_JNS_BUDGET,BUDGET_DESC FROM TBL_R_JNS_BUDGET');
        $data['dd_Division'] = $this->global_m->tampil_data("SELECT DivisionID, DivisionName FROM Mst_Division where Is_trash=0");
        $data['dd_Branch'] = $this->global_m->tampil_data("SELECT BranchID, BranchName FROM Mst_Branch where Is_trash=0");

//        print_r($this->global_m->tampil_data('SELECT * FROM TBL_R_JNS_BUDGET'));die();
//            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan', 'id_kyw', 'nama_kyw', 'id_kyw');
//            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user', 'goluser_id', 'goluser_desc', 'goluser_id');
//            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user', 'statususer_id', 'statususer_desc', 'statususer_id');

        $this->template->set('title', 'Cek Barang');
        $this->template->load('template/template_dataTable', 'procurement/cek_barang/form_cek_barang', $data);
    }

    public function get_sn($id_tb, $id_po)
    {
        $data = $this->cek_barang_mdl->get_sn($id_tb, $id_po);

        echo json_encode($data);
    }

    public function update_sn()
    {
        // var_dump($this->input->post('idsn')[0]);exit();
        for ($i=0; $i < count($_POST['idsn']); $i++) { 
            if (!empty($_POST['sn'][$i])) {
                $data['SN'] = $_POST['sn'][$i];
                $this->cek_barang_mdl->update_sn(array('ID' => $_POST['idsn'][$i]), $data);
            }
        }

        echo json_encode(array("status" => TRUE));
    }

    public function savedata()
    {
        if (isset($_POST['repr'])) {
            $this->cek_barang_mdl->cancelpr($this->input->post('id_pr'));
            $id_pr = $this->global_m->getIdMax('RequestID','TBL_REQUEST');
            $pr = $this->cek_barang_mdl->getpr($this->input->post('id_pr'));
            $data['RequestID'] = $id_pr;
            $data['flow_id'] = $pr->flow_id;
            $data['status'] = $pr->status;
            $data['BranchID'] = $pr->BranchID;
            $data['DivisionID'] = $pr->DivisionID;
            $data['ReqTypeID'] = $pr->ReqTypeID;
            $data['ReqCategoryID'] = $pr->ReqCategoryID;
            $data['JenisPR'] = $pr->JenisPR;
            $data['CreateDate'] = date('Y-m-d H:i:s');
            $data['CreateBy'] = $this->session->userdata('user_id');
            $this->cek_barang_mdl->save_pr($data);
        }elseif(isset($_POST['repo'])){
            $this->master_po_m->cancelpo($this->input->post('id_po'));
            $id_po = $this->global_m->getIdMax('ID_PO','TBL_T_PO');
            $head['ID_PO'] = $id_po;
            $head['ID_PR'] = $this->input->post('id_pr');
            $head['flow_id'] = 1;
            $head['status'] = '7-2';
            $this->master_po_m->save_po($head);
        }elseif(isset($_POST['simpan'])){
            for ($i=0; $i < count($_POST['qty']); $i++) {
                if (!empty($_POST['qty'][$i])) {
                    $id_barang = $this->global_m->getIdMax('ID','TBL_T_TERIMA_BARANG');
                    $barang['ID'] = $id_barang;
                    $barang['ID_PO_DETAIL'] =  $_POST['podetail'][$i];
                    $barang['ITEM_ID'] = $_POST['itemid'][$i];
                    $barang['NAMA_BARANG'] = $_POST['nama_barang'][$i];
                    $barang['QTY'] = $_POST['qty'][$i];
                    $barang['TGL_TERIMA'] = DateTime::createFromFormat('d/m/Y', $_POST['tgl_terima'][$i])->format('Y-m-d');
                    $barang['CREATE_BY'] = $this->session->userdata("user_id");
                    $this->cek_barang_mdl->save_barang($barang);

                    for ($j=1; $j <= $_POST['qty'][$i]; $j++) { 
                        $id_sn = $this->global_m->getIdMax('ID','TBL_T_TB_DETAIL');
                        $sn['ID'] = $id_sn;
                        $sn['ID_PO_DETAIL'] = $_POST['podetail'][$i];
                        $sn['ID_TB'] = $id_barang;
                        $sn['ITEM_ID'] = $_POST['itemid'][$i];
                        $sn['QTY'] = 1;
                        $sn['CREATE_DATE'] = DateTime::createFromFormat('d/m/Y', $_POST['tgl_terima'][$i])->format('Y-m-d');
                        $sn['CREATE_BY'] = $this->session->userdata("user_id");
                        $this->cek_barang_mdl->save_sn($sn);
                    }
                }
            }
        }
        redirect('procurement/cek_barang/home');
    }

    public function ajax_GridBudgetCapex() {
        $icolumn = array('ID_PO', 'ID_PR', 'STATUS_CEK', 'status_ke', 'TGL_PR', 'BranchID', 'BRANCH_DESC');
//        $icolumn = array('BudgetID');
        $ilike = array(
            $this->input->post('sSearch') => $_POST['search']['value']
        );
        // var_dump(date("Y-m-d H:i:s", strtotime($this->input->post('sMulai'))).' dan '.$this->input->post('sSampai'));exit();

        if (!empty($this->input->post('sMulai')) && !empty($this->input->post('sSampai'))) {
            $iwhere = array(
                'TGL_PR >' => DateTime::createFromFormat('d/m/Y', $_POST['sMulai'])->format('Y-m-d'),
                'TGL_PR <' => DateTime::createFromFormat('d/m/Y', $_POST['sSampai'])->format('Y-m-d')
            );
        }else{
            $iwhere = array();
        }

        $iorder = array('ID_PR' => 'asc');
        $list = $this->datatables_custom->get_datatables('VW_CEK_BARANG', $icolumn, $iorder, $iwhere, $ilike);

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();

            $row[] = $idatatables->ID_PO;
            $row[] = $idatatables->ID_PR;
            $row[] = $idatatables->TGL_PR;
            $row[] = $idatatables->BRANCH_DESC;
            $row[] = $idatatables->BranchID;
            $row[] = $idatatables->STATUS_CEK;
            $row[] = '<a href="'.base_url().'procurement/cek_barang/form/'.$idatatables->ID_PO.'" class="btn btn-primary">Cek</a>';

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

    public function get_var()
    {
        $ops = $this->cek_barang_mdl->get_var();
        $ret_val = "<option disabled selected>Pilih Variable</option>";
        foreach ($ops as $op) {
            $ret_val .= "<option value='".$op->BOBOT."'>".$op->VARIABEL."</option>";
        }

        echo $ret_val;
    }

    public function ddBranchTF() {
        $iAsal = $this->input->post('sDivAsal');
        $ddBranchTujuan = $this->global_m->tampil_data("SELECT DivisionID, DivisionName FROM Mst_Division where Is_trash=0 and DivisionID!=$iAsal");
        $options = "<select id='dd_tf_tujuan' name='tf_tujuan' class='form-control input-sm select2me'>";
        $options .= "<option value=''>-- Select --</option>";
        foreach ($ddBranchTujuan as $k) {
            $options .= "<option  value='" . $k->DivisionID . "'>" . $k->DivisionName . "</option>";
        }
        $options .= "</select>";

        echo json_encode($options);
    }

    public function ddBranch() {
        $ddBranch = $this->cek_barang_mdl->getBranch();
        $options = "<select id='dd_id_branch' class='form-control' onchange='dd_Divisi(this.id)'>";
        $options .= "<option value=''>-- Select --</option>";
        foreach ($ddBranch as $k) {
            $options .= "<option  value='" . $k->BranchID . "'>" . $k->BranchName . "</option>";
        }
        $options .= "</select>";

        echo json_encode($options);
    }

    public function ddDivisi() {
        $BranchID = $this->input->post('sBranchID');
        $ddDivisi = $this->cek_barang_mdl->getdivisi($BranchID);
        $options = "<select id='dd_id_divisi' class='form-control'>";
//        $options .= "<option value=''>-- Pilih Project --</option>";
        foreach ($ddDivisi as $k) {
            $options .= "<option  value='" . $k->DivisionID . "'>" . $k->DivisionName . "</option>";
        }
        $options .= "</select>";

        echo json_encode($options);
    }

    public function ajax_Update() {
        $budgetid = $this->input->post('BudgetID');
        $COA = $this->input->post('BudgetCOA');
        $this->cek_barang_mdl->updatedata($budgetid);

        $result = array('istatus' => true, 'iremarks' => 'Success! budget COA: ' . $COA . ' Success Update data'); //, 'body'=>'Data Berhasil Disimpan');

        echo json_encode($result);
    }

    public function ajax_delete() {
        $id = $this->input->post('sbudgetID');
        $this->cek_barang_mdl->deletedata($id);

        $result = array('istatus' => true, 'iremarks' => 'Success.!'); //, 'body'=>'Data Berhasil Disimpan');

        echo json_encode($result);
    }

    public function ajax_Transfer() {
        $data = array(
            'TANGGAL' => date('Y-m-d', strtotime($this->input->post('tf_tanggal'))),
            'NAMA' => $this->input->post('tf_nama'),
            'POSISI' => $this->input->post('tf_posisi'),
            'BRANCH_DIV_ASAL' => (int) $this->input->post('tf_asal'),
            'BRANCH_DIV_TUJUAN' => (int) $this->input->post('tf_tujuan'),
            'JUMLAH' => str_replace(",", "", $this->input->post('tf_jumlah')),
            'CREATE_BY' => $this->session->userdata("id_user"),
            'CREATE_DATE' => date('Y-m-d h:i:s')
        );
//        print_r($data);die();
        $result = $this->global_m->simpan('TBL_T_TRANSFER_BUDGET', $data);
        if ($result) {
            $result = array('istatus' => true, 'type' => 'success', 'iremarks' => 'Transfer Success.!'); //, 'body'=>'Data Berhasil Disimpan');
        } else {
            $result = array('istatus' => false, 'type' => 'error', 'iremarks' => 'Transfer Gagal.!'); //, 'body'=>'Data Berhasil Disimpan');
        }
        echo json_encode($result);
    }

    public function ajax_GridSetting() {
        $icolumn = array('ID_PO', 'ID_PR', 'STATUS_CEK', 'status_ke', 'TGL_PR', 'BranchID', 'BRANCH_DESC');
//        $icolumn = array('BudgetID');
        $ilike = array(
            $this->input->post('sSearch') => $_POST['search']['value']
        );

        if (!empty($this->input->post('sMulai')) && !empty($this->input->post('sSampai'))) {
            $iwhere = array(
                'TGL_PR >' => date("Y-m-d", strtotime($this->input->post('sMulai'))),
                'TGL_PR <' => date("Y-m-d", strtotime($this->input->post('sSampai')))
            );
        }else{
            $iwhere = array();
        }

        $iorder = array('ID_PR' => 'asc');
        $list = $this->datatables_custom->get_datatables('VW_CEK_BARANG', $icolumn, $iorder, $iwhere, $ilike);

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {

            $no++;
            $row = array();

            $row[] = $idatatables->ID_PO;
            $row[] = $idatatables->ID_PR;
            $row[] = $idatatables->TGL_PR;
            $row[] = $idatatables->BRANCH_DESC;
            $row[] = $idatatables->BranchID;
            $row[] = $idatatables->status_ke;
            $row[] = $idatatables->STATUS_CEK;
            $row[] = '<a href="'.base_url().'procurement/cek_barang/form/'.$idatatables->ID.'" class="btn btn-primary">Cek</a>';

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

    public function ajax_insert_setBudget() {
        $data = array(
            'TAHUN' => $this->input->post('st_Tahun'),
            'ID_JNS_BUDGET' => (int) $this->input->post('st_jns_budget'),
            'STATUS' => (int) $this->input->post('detail'),
            'IS_TRASH' => 0
        );
//        print_r($data);die();
        $result = $this->global_m->simpan('TBL_T_SETTING_BUDGET', $data);
        if ($result) {
            $result = array('istatus' => true, 'type' => 'success', 'iremarks' => 'Transfer Success.!'); //, 'body'=>'Data Berhasil Disimpan');
        } else {
            $result = array('istatus' => false, 'type' => 'error', 'iremarks' => 'Transfer Gagal.!'); //, 'body'=>'Data Berhasil Disimpan');
        }
        echo json_encode($result);
    }

    public function ajax_setDelete() {
        $data = array('IS_TRASH' => 1);

        $result = $this->global_m->ubah('TBL_T_SETTING_BUDGET', $data, 'ID_SETTTING_BUDGET', $this->input->post('sID'));
        if ($result) {
            $result = array('istatus' => true, 'type' => 'success', 'iremarks' => 'Delete Success.!'); //, 'body'=>'Data Berhasil Disimpan');
        } else {
            $result = array('istatus' => false, 'type' => 'error', 'iremarks' => 'Delete Gagal.!'); //, 'body'=>'Data Berhasil Disimpan');
        }
        echo json_encode($result);
    }

    public function ajax_setBudget() {
        if ($this->input->post('sParam') == 1) {
            $data = array('STATUS' => 1);
        } else {
            $data = array('STATUS' => 0);
        }
        $result = $this->global_m->ubah('TBL_T_SETTING_BUDGET', $data, 'ID_SETTTING_BUDGET', $this->input->post('sID'));
        if ($result) {
            $result = array('istatus' => true, 'type' => 'success', 'iremarks' => 'Success.!'); //, 'body'=>'Data Berhasil Disimpan');
        } else {
            $result = array('istatus' => false, 'type' => 'error', 'iremarks' => 'Gagal.!'); //, 'body'=>'Data Berhasil Disimpan');
        }
        echo json_encode($result);
    }

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */