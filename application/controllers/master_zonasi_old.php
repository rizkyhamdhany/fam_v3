<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class master_zonasi extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('admin/konfigurasi_menu_status_user_m');
        $this->load->model('global_m');
        $this->load->model('master_zonasi_m');
        
        session_start();
    }

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
        $menuId = $this->home_m->get_menu_id('master_zonasi/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = 'Master Zonasi';//$menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        //$data['level_user'] = $this->sec_user_m->get_level_user();
        
        if (isset($_POST["btnSimpan"])) {
                $this->simpan();
        } elseif (isset($_POST["btnUbah"])) {
                $this->ubah();
        } elseif (isset($_POST["btnHapus"])) {
                $this->hapus();
        }else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);
            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan','id_kyw','nama_kyw','id_kyw');
            $data['departemen'] = $this->global_m->tampil_id_desk('master_dept','id_dept','nama_dept','id_dept');
            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user','goluser_id','goluser_desc','goluser_id');
            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user','statususer_id','statususer_desc','statususer_id');
            
            $this->template->set('title', 'Master Zonasi');
            $this->template->load('template/template_dataTable', 'master_zonasi_v', $data);
        }
    }

      function get_server_side() {
        $requestData = $_REQUEST;
//        print_r($requestData);die();
        $columns = array(
            // datatable column index  => database column name
            0 => 'ZoneID',
            1 => 'ZoneName',
            2 => 'Status'
            // 3 => 'CreateDate',
            // 4 => 'CreateBy',
            // 5 => 'UpdateDate',
            // 6 => 'UpdateBy',
            // 7 => 'DeleteDate',
            // 8 => 'DeleteBy',
            // 9 => 'Is_trash'
           
        );
        $sql = "SELECT * from amspar_zonasi ";
        $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
        $totalFiltered = $totalData;

        if (!empty($requestData['search']['value'])) {
            // if there is a search parameter
            $sql.=" WHERE UPPER(ZoneID::character varying) LIKE '" . strtoupper($requestData['search']['value']) . "%' ";    // $requestData['search']['value'] contains search parameter
            $sql.=" OR UPPER(ZoneName::character varying) LIKE '" . strtoupper($requestData['search']['value']) . "%' ";
            $sql.=" OR UPPER(Status::character varying) LIKE '" . strtoupper($requestData['search']['value']) . "%' ";
            // $sql.=" OR UPPER(CreateDate::character varying) LIKE '" . strtoupper($requestData['search']['value']) . "%' ";
            // $sql.=" OR UPPER(CreateBy::character varying) LIKE '" . strtoupper($requestData['search']['value']) . "%' ";
            // $sql.=" OR UPPER(UpdateDate::character varying) LIKE '" . strtoupper($requestData['search']['value']) . "%' ";
            // $sql.=" OR UPPER(UpdateBy::character varying) LIKE '" . strtoupper($requestData['search']['value']) . "%' ";
            // $sql.=" OR UPPER(DeleteDate::character varying) LIKE '" . strtoupper($requestData['search']['value']) . "%' ";
            // $sql.=" OR UPPER(DeleteBy::character varying) LIKE '" . strtoupper($requestData['search']['value']) . "%' ";
            // $sql.=" OR UPPER(Is_trash::character varying) LIKE '" . strtoupper($requestData['search']['value']) . "%' ";

            $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   OFFSET " . $requestData['start'] . " LIMIT " . $requestData['length'] . "   ";
            
            $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
            $totalFiltered = $totalData;
        } else {

            $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   OFFSET " . $requestData['start'] . " LIMIT " . $requestData['length'] . "   ";
        }

        $row = $this->global_m->tampil_semua_array($sql)->result_array(); 
        
        $data = array();
        foreach ($row as $row) {
            # code...
            // preparing an array
            $nestedData = array();
           
            $nestedData[] = $row["ZoneID"];
            $nestedData[] = $row["ZoneName"];
            $nestedData[] = $row["Status"];
            // $nestedData[] = $row["CreateDate"];
            // $nestedData[] = $row["CreateBy"];
            // $nestedData[] = $row["UpdateDate"];
            // $nestedData[] = $row["UpdateBy"];
            // $nestedData[] = $row["DeleteDate"];
            // $nestedData[] = $row["DeleteBy"];
            // $nestedData[] = $row["Is_trash"];




            $data[] = $nestedData;
        }

        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );

        echo json_encode($json_data);  
    }

    public function getUserInfo() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->master_zonasi_m->getUserInfo();
        $data['data'] = array();
        foreach ($rows as $row) {
            $array = array(
                'ZoneID' => trim($row->ZoneID),
                'ZoneName' => trim($row->ZoneName),
                'Status' => trim($row->Status),
               
            );

            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }

function simpan() {
        $ZoneID = trim($this->input->post('ZoneID'));
        $ZoneName = trim($this->input->post('ZoneName'));
        
        $ipaddress = $this->global_m->ipaddress();
        $hostname = $this->global_m->hostname();
        $user = $this->session->userdata('namaKyw');

        $id_user = $this->session->userdata('id_user');
        $password = $this->session->userdata('password');

        $atwaktuupdate = date("Y/m/d H:i:s");
        $atflag = 'T';


        $model = $this->global_m->simpan('amspar_zonasi', $data);
        if ($model) {
            $notifikasi = Array(
                'msgType' => 'success',
                'msgTitle' => 'Success',
                'msg' => $result[0]
            );
        } else {
            $notifikasi = Array(
                'msgType' => 'error',
                'msgTitle' => 'Error',
                'msg' => $result[0]
            );
        }
        $this->session->set_flashdata('notif', $notifikasi);
        redirect('master_zonasi/home');
    }

    function ubah() {
        $kodepropinsi = trim($this->input->post('kodepropinsi'));
        $namapropinsi = trim($this->input->post('namapropinsi'));
        
        $ipaddress = $this->global_m->ipaddress();
        $hostname = $this->global_m->hostname();
        $user = $this->session->userdata('namaKyw');

        $id_user = $this->session->userdata('id_user');
        $password = $this->session->userdata('password');

        $atwaktuupdate = date("Y/m/d H:i:s");
        $atflag = 'U';


        $model = $this->parameter_propinsi_m->execsp($kodepropinsi,$namapropinsi,$atflag,$atwaktuupdate,$id_user,$password,$ipaddress,$hostname);
        $result = explode(',',str_replace(')','',str_replace('(','',str_replace('"','',$model[0]->sp_amsparpropinsi))));
        if ($result[1] == '0') {
            $notifikasi = Array(
                'msgType' => 'success',
                'msgTitle' => 'Success',
                'msg' => $result[0]
            );
        } else {
            $notifikasi = Array(
                'msgType' => 'error',
                'msgTitle' => 'Error',
                'msg' => $result[0]
            );
        }
        $this->session->set_flashdata('notif', $notifikasi);
        redirect('parameter/parameter_propinsi/home');
    }

    function hapus() {
        $kodepropinsi = trim($this->input->post('kodepropinsi'));
        $namapropinsi = trim($this->input->post('namapropinsi'));
        
        $ipaddress = $this->global_m->ipaddress();
        $hostname = $this->global_m->hostname();
        $user = $this->session->userdata('namaKyw');

        $id_user = $this->session->userdata('id_user');
        $password = $this->session->userdata('password');

        $atwaktuupdate = date("Y/m/d H:i:s");
            $atflag = 'H';


        $model = $this->parameter_propinsi_m->execsp($kodepropinsi,$namapropinsi,$atflag,$atwaktuupdate,$id_user,$password,$ipaddress,$hostname);
        $result = explode(',',str_replace(')','',str_replace('(','',str_replace('"','',$model[0]->sp_amsparpropinsi))));
        if ($result[1] == '0') {
            $notifikasi = Array(
                'msgType' => 'success',
                'msgTitle' => 'Success',
                'msg' => $result[0]
            );
        } else {
            $notifikasi = Array(
                'msgType' => 'error',
                'msgTitle' => 'Error',
                'msg' => $result[0]
            );
        }
        $this->session->set_flashdata('notif', $notifikasi);
        redirect('parameter/parameter_propinsi/home');
    }
}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */