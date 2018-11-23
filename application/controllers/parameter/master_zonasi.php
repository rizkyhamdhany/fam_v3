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

        $menuId = $this->home_m->get_menu_id('master_zonasi/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        $data['zonasi1'] = $this->global_m->tampil_zone1();
        $data['branch'] = $this->global_m->tampil_division();
        //$data['level_user'] = $this->sec_user_m->get_level_user();
         if (isset($_POST["idTmpAksiBtn"])) {
             $act=$_POST["idTmpAksiBtn"];
        if ($act==1) {
            $this->simpan();
        }elseif ($act==2) {
            $this->ubah();
        }elseif ($act=='3') {
            $this->hapus();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);
            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan','id_kyw','nama_kyw','id_kyw');
            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user','goluser_id','goluser_desc','goluser_id');
            
            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user','statususer_id','statususer_desc','statususer_id');
            $this->template->set('title', 'Master Zonasi');
            $this->template->load('template/template_dataTable', 'master_zonasi_v', $data);
        }
    } else {
      $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);
            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan','id_kyw','nama_kyw','id_kyw');
            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user','goluser_id','goluser_desc','goluser_id');
            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user','statususer_id','statususer_desc','statususer_id');
            
            $this->template->set('title', 'Master Zonasi');
            $this->template->load('template/template_dataTable', 'master_zonasi_v', $data);
        }
    }

    function get_server_side() {
        $requestData = $_REQUEST;
//        print_r($requestData);die();
        $iStatus=$this->input->post('sStatus');
        $iSearch=$this->input->post('sSearch');
        $columns = array(
            // datatable column index  => database column name
            0 => 'Raw_ID',
            1 => 'ZoneID',
            2 => 'ZoneName',
            3 => 'Status'
        );

        $sql = "SELECT * from Mst_Zonasi where Status like '%".$iStatus."%'";            
        $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
        $totalFiltered = $totalData;

        if (!empty($requestData['search']['value'])) {
            if ($iSearch=='1'){
                $sql = "SELECT * from Mst_Zonasi where Status like '%".$iStatus."%'and Raw_ID like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='2'){
                $sql = "SELECT * from Mst_Zonasi where Status like '%".$iStatus."%'and ZoneID like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='3'){
                $sql = "SELECT * from Mst_Zonasi where Status like '%".$iStatus."%'and ZoneName like '%".$requestData['search']['value']."%'";
            }else{
                $sql = "SELECT * from Mst_Zonasi where Status like '%".$iStatus."%'"; 
                $sql .= "and Raw_ID like '%".$requestData['search']['value']."%'"; 
                $sql .= "or PositionID  like '%".$requestData['search']['value']."%'";
                $sql .= "or PositionName  like '%".$requestData['search']['value']."%'";
            }
           
            $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";
             
            $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
            $totalFiltered = $totalData;
        } else {
             $sql.=" ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . " OFFSET ". $requestData['start'] . " ROWS FETCH NEXT " . $requestData['length'] . " ROWS ONLY  ";   
        }

        $row = $this->global_m->tampil_semua_array($sql)->result_array(); 
        
        $data = array();
        $no=$_POST['start']+1;
        foreach ($row as $row) {
            # code...
            // preparing an array
            $nestedData = array();
           
            $nestedData[] = $no++;     
            $nestedData[] = $row["Raw_ID"];     
            $nestedData[] = $row["ZoneID"];
            $nestedData[] = $row["ZoneName"];
            // $nestedData[] = $row["Status"];

            if($row["Status"]==0)
            {
                $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update</a><a class="btn  btn-sm btn-danger" id="btnAktiv" href="#">Aktivate</a>';
            }
            else
            {
                $nestedData[] = '<a class="btn btn-sm btn-primary" href="#" id="btnDetail" data-toggle="modal" data-target="#mdl_Update">Detail</a><a class="btn btn-sm btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update<a class="btn btn-sm green-meadow" id="btnDeactivate" href="#">Deactivate</a>';
            }

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


    public function ajax_UpdateStatusCategory(){
        $this->load->helper('array');
        $i_list = $this->input->post('sTbl');

        $id = trim(element('Raw_ID',$i_list));
        $id_kyw=(int)$this->session->userdata('id_kyw');
        $Status = trim(element('Status',$i_list));
        
        $data = array(
            'Raw_ID' => $id,
            'Status' => $Status,
            'UpdateBy' => $id_kyw,
            'UpdateDate' => date('Y-m-d H:i:s'),
            
        );
        $model = $this->global_m->ubah('Mst_Zonasi', $data,'Raw_ID',$id);
        if ($model) {
            $notifikasi = Array(
                'msgType' => true,
                'msgTitle' => 'Success',
                'msg' => 'Data Berhasil Diubah'
            );
        } else {
            $notifikasi = Array(
                'msgType' => false,
                'msgTitle' => 'Error',
                'msg' => 'Data Berhasil Diubah'
            );
        }
        echo json_encode($notifikasi);
    }

    public function ajax_UpdateCategory(){
        $this->load->helper('array');
        $i_list = $this->input->post('sTbl');

        $id_kyw=(int)$this->session->userdata('id_kyw');
        $Raw_ID = trim(element('Raw_ID',$i_list)); 
        $ZoneID = trim(element('ZoneID',$i_list));
        $ZoneName = element('ZoneName',$i_list); 
       
        $iStatus = trim(element('Status',$i_list));
        
        if(element('Raw_ID',$i_list)=="Generate"){
            $id = $this->master_zonasi_m->getIdMax();
            $ZoneID = $this->master_zonasi_m->getzones();
             $data = array(
            'ZoneID' => $ZoneID,
            'Raw_ID' => $id,
            'ZoneName' => $ZoneName,
            
            'Status' => $iStatus,
            'CreateBy' => $id_kyw,
            'CreateDate' => date('Y-m-d H:i:s'),
            
        );
       }else{
            $id = trim(element('Raw_ID',$i_list));
         $data = array(
            'Raw_ID' => trim(element('Raw_ID',$i_list)),
            'ZoneID' => $ZoneID,
            'ZoneName' => $ZoneName,
            'UpdateBy' => $id_kyw,
            'UpdateDate' => date('Y-m-d H:i:s'),
            
        );
       }
      
       
        if(element('Raw_ID',$i_list)=="Generate"){
        $model = $this->global_m->simpan('Mst_Zonasi', $data);

       }else{
        $model = $this->global_m->ubah('Mst_Zonasi', $data,'Raw_ID',$id);
       }
        if ($model) {
            $notifikasi = Array(
                'msgType' => true,
                'msgTitle' => 'Success',
                'msg' => 'Data Berhasil Diubah'
            );
        } else {
            $notifikasi = Array(
                'msgType' => false,
                'msgTitle' => 'Error',
                'msg' => 'Data Berhasil Diubah'
            );
        }
        echo json_encode($notifikasi);
    }

   public function getUserInfo() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->master_zonasi_m->getUserInfo();
        $data['data'] = array();
        foreach ($rows as $row) {

            $array = array(
                                 
               'Raw_ID' => trim($roq->Raw_ID),    
               'ZoneID' => trim($row->ZoneID),
               'ZoneName' => trim($row->ZoneName)
                
               
            );

            array_push($data['data'], $array);
        }

        $this->output->set_output(json_encode($data));
    }

  

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */