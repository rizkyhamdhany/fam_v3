<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class master_itemtype extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('admin/konfigurasi_menu_status_user_m');
        $this->load->model('global_m');
        $this->load->model('master_itemtype_m');
        
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

        $menuId = $this->home_m->get_menu_id('master_itemtype/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        $data['itemcategory'] = $this->global_m->tampil_zone();

            // print_r($data['itemcategory']);
            // die();
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
            $data['ddCategory'] = $this->global_m->tampil_id_desk('ams_itemcategory','IClassID','IClassName','IClassID');
            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user','goluser_id','goluser_desc','goluser_id');
            
            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user','statususer_id','statususer_desc','statususer_id');
            $this->template->set('title', 'Master Zonasi');
            $this->template->load('template/template_dataTable', 'master_itemtype_v', $data);
        
            
        }
    } else {
      $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);
            $data['ddCategory'] = $this->global_m->tampil_id_desk('ams_itemcategory','IClassID','IClassName','IClassID');
            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user','goluser_id','goluser_desc','goluser_id');
            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user','statususer_id','statususer_desc','statususer_id');
            
            $this->template->set('title', 'Master Item Type');
            $this->template->load('template/template_dataTable', 'master_itemtype_v', $data);
        }
    }

function get_server_side() {
        $iStatus=$this->input->post('sStatus');
        $iSearch=$this->input->post('sSearch');
        $requestData = $_REQUEST;
//        print_r($requestData);die();
        $columns = array(
            // datatable column index  => database column name
            0 => 'ItemTypeID',
            1 => 'IClassName',
            2 => 'TypeCode',
            3 => 'ItemTypeName'
           
        );
        
        $sql = " SELECT item_type.IClassID,item_type.ItemTypeID,ams_itemcategory.IClassName,item_type.ItemTypeName,item_type.TypeCode,item_type.Status 
        FROM item_type
        LEFT JOIN ams_itemcategory ON item_type.IClassID = ams_itemcategory.IClassID where item_type.Status like '%".$iStatus."%'"; 
        $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
        $totalFiltered = $totalData;

       if (!empty($requestData['search']['value'])) {
            if ($iSearch=='1'){
                $sql = $sql."and TypeCode like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='2'){
                $sql = $sql."and ItemTypeName like '%".$requestData['search']['value']."%'";
            }else{
                $sql = $sql; 
                $sql .= "and TypeCode like '%".$requestData['search']['value']."%'"; 
                $sql .= "or ItemTypeName like '%".$requestData['search']['value']."%'"; 
                $sql .= "or IClassName like '%".$requestData['search']['value']."%'"; 
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
            $nestedData[] = $row["ItemTypeID"];
            $nestedData[] = $row["IClassID"];
            $nestedData[] = $row["IClassName"];
            $nestedData[] = $row["ItemTypeName"];
            $nestedData[] = $row["TypeCode"];

        if($row["Status"]==0)
            {
                $nestedData[] = '<a class="btn btn-sm btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update</a><a class="btn  btn-sm btn-danger" id="btnAktiv" href="#">Aktivate</a>';
            }
            else
            {
                $nestedData[] = '<a class="btn btn-sm btn-warning" href="#" id="btnUpdate" data-toggle="modal" data-target="#mdl_Update">Update<a class="btn btn-sm green-meadow" id="btnDeactivate" href="#">Deactivate</a>';
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

    public function ajax_UpdateStatusType(){
        $this->load->helper('array');
        $i_list = $this->input->post('sTbl');

        $id = trim(element('ItemTypeID',$i_list));
        $id_kyw=(int)$this->session->userdata('id_kyw');
        $Status = trim(element('Status',$i_list));
        
        $data = array(
            'ItemTypeID' => $id,
            'Status' => $Status,
            'UpdateBy' => $id_kyw,
            'UpdateDate' => date('Y-m-d H:i:s'),
            
        );
        $model = $this->global_m->ubah('item_type', $data,'ItemTypeID',$id);
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

 public function ajax_UpdateType(){
        $this->load->helper('array');
        $i_list = $this->input->post('sTbl');

        $id_kyw=(int)$this->session->userdata('id_kyw');
        $IClassID = trim(element('IClassID',$i_list));
        $TypeCode = trim(element('TypeCode',$i_list));
        $ItemTypeName = trim(element('ItemTypeName',$i_list));
        $iStatus = trim(element('Status',$i_list));
        
        if(element('ItemTypeID',$i_list)=="Generate"){
            $id = $this->master_itemtype_m->getIdMax();
             $data = array(
            'ItemTypeID' => $id,
            'IClassID' => $IClassID,
            'TypeCode' => $TypeCode,
            'ItemTypeName' => $ItemTypeName,
            'Status' => $iStatus,
            'CreateBy' => $id_kyw,
            'CreateDate' => date('Y-m-d H:i:s'),
            
        );
       }else{
            $id = trim(element('ItemTypeID',$i_list));
         $data = array(
            'ItemTypeID' => $id,
            'IClassID' => $IClassID,
            'TypeCode' => $TypeCode,
            'ItemTypeName' => $ItemTypeName,
            'UpdateBy' => $id_kyw,
            'UpdateDate' => date('Y-m-d H:i:s'),
            
        );
       }
      
       
        if(element('ItemTypeID',$i_list)=="Generate"){
        $model = $this->global_m->simpan('item_type', $data);
       }else{
        $model = $this->global_m->ubah('item_type', $data,'ItemTypeID',$id);
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
        $rows = $this->master_itemtype_m->getUserInfo();
        $data['data'] = array();
        foreach ($rows as $row) {

            $array = array(
                
               'IClassID' => trim($row->IClassID),
               'IClassName' => trim($row->IClassName),
               'ItemTypeID' => trim($row->ItemTypeID),
               'TypeCode' => trim($row->TypeCode),
               'ItemTypeName' => trim($row->ItemTypeName)      
               
            );

            array_push($data['data'], $array);
        }

        $this->output->set_output(json_encode($data));
                                                                                                                                                               }

    function simpan() {


       $id_kyw=(int)$this->session->userdata('id_kyw');
       $ItemTypeID = $this->master_itemtype_m->getIdMax();
      
       $TypeCode = trim($this->input->post('TypeCode'));
       $ItemTypeName = trim($this->input->post('ItemTypeName'));
              
        $data = array(
            
            'ItemTypeID' =>  $ItemTypeID,
           
            'TypeCode' => $TypeCode,
            'ItemTypeName' => $ItemTypeName,
            'CreateBy' => $id_kyw,
            'CreateDate' => date('Y-m-d'),
            
            
        );
        $model = $this->global_m->simpan('item_type', $data);
        if ($model) {
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
        //echo $model;
        redirect('/master_itemtype/home');
        
    }

    function ubah() {
   
       $id_kyw=(int)$this->session->userdata('id_kyw');
       $ItemTypeID = $this->master_itemtype_m->getIdMax();
       $IClassName = trim($this->input->post('IClassName')); 
       $TypeCode = trim($this->input->post('TypeCode'));
       $ItemTypeName = trim($this->input->post('ItemTypeName'));

        $data = array(
            'ItemTypeID' =>  $ItemTypeID,
            'IClassName' =>  $IClassName,
            'TypeCode' => $TypeCode,
            'ItemTypeName' => $ItemTypeName,
            'CreateBy' => $id_kyw,
            'CreateDate' => date('Y-m-d'),
            
        );
        $model = $this->global_m->ubah('item_type', $data,'ItemTypeID',$id);
        if ($model) {
            $notifikasi = Array(
                'msgType' => 'success',
                'msgTitle' => 'Success',
                'msg' => 'Data Berhasil Diubah'
            );
        } else {
            $notifikasi = Array(
                'msgType' => 'error',
                'msgTitle' => 'Error',
                'msg' => 'Data Berhasil Diubah'
            );
        }
        $this->session->set_flashdata('notif', $notifikasi);
        //echo $model;
         redirect('/master_itemtype/home');
    }

    function hapus() {
        $this->CI = & get_instance();
        $id = trim($this->input->post('ZoneID'));
        $model = $this->global_m->deleteUser('ams_cabang','BranchID',$id);
        if ($model) {
            $notifikasi = Array(
                'msgType' => 'success',
                'msgTitle' => 'Success',
                'msg' => 'Data Berhasil Dihapus'
            );
        } else {
            $notifikasi = Array(
                'msgType' => 'error',
                'msgTitle' => 'Error',
                'msg' => 'Data Berhasil Dihapus'
            );
        }
         $this->session->set_flashdata('notif', $notifikasi);
        //echo $model;
         redirect('/master_cabang/home');
    }

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */