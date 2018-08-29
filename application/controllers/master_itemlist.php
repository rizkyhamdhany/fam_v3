<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class master_itemlist extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('admin/konfigurasi_menu_status_user_m');
        $this->load->model('global_m');
        $this->load->model('master_itemlist_m');
        $this->load->model('master_itemcategory_m');
        
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

        $menuId = $this->home_m->get_menu_id('master_itemlist/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        $data['zonasi1'] = $this->global_m->tampil_zone1();
        $data['branch'] = $this->global_m->tampil_division();
        $data['item_class'] = $this->global_m->tampil_item();
        // $data['item_class'] = $this->global_m->tampil_id_desk('ams_itemcategory', 'IClassID', 'ClassCode', 'IClassName', 'Priod','Status','CreateDate','CreateBy','UpdateDate', 'UpdateBy','DeleteDate','DeleteBy', 'Is_trash','IClassID');
        
        // print_r($data['item_class']);

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
            $this->template->set('title', 'Master ItemList');
            $this->template->load('template/template_dataTable', 'master_itemlist_v', $data);
        }
    } else {
      $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);
            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan','id_kyw','nama_kyw','id_kyw');
            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user','goluser_id','goluser_desc','goluser_id');
            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user','statususer_id','statususer_desc','statususer_id');
            
            $this->template->set('title', 'Master ItemList');
            $this->template->load('template/template_dataTable', 'master_itemlist_v', $data);
        }
    }

    function get_server_side() {
        $requestData = $_REQUEST;
//        print_r($requestData);die();
        $iStatus=$this->input->post('sStatus');
        $iSearch=$this->input->post('sSearch');
        $columns = array(
            // datatable column index  => database column name
            0 => 'IClassID',
            1 => 'ItemTypeID',
            2 => 'ItemID',
            3 => 'ItemName',
            4 => 'Image',
            5 => 'VendorID',
            6 => 'StatusMadya',
            7 => 'StatusPratama',
            8 => 'StatusUtama',
            9 => 'AssetType',   
            10 => 'Status'
        );

        $sql = "SELECT * from Mst_ItemList where Status like '%".$iStatus."%'";            
        $totalData = $this->global_m->tampil_semua_array($sql)->num_rows(); 
        $totalFiltered = $totalData;

        if (!empty($requestData['search']['value'])) {
            if ($iSearch=='1'){
                $sql = "SELECT * from Mst_ItemList where Status like '%".$iStatus."%'and IClassID like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='2'){
                $sql = "SELECT * from Mst_ItemList where Status like '%".$iStatus."%'and ItemTypeID like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='3'){
                $sql = "SELECT * from Mst_ItemList where Status like '%".$iStatus."%'and ItemID like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='4'){
                $sql = "SELECT * from Mst_ItemList where Status like '%".$iStatus."%'and ItemName like '%".$requestData['search']['value']."%'"; 
            }else if ($iSearch=='5'){
                $sql = "SELECT * from Mst_ItemList where Status like '%".$iStatus."%'and Image like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='6'){
                $sql = "SELECT * from Mst_ItemList where Status like '%".$iStatus."%'and VendorID like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='7'){
                $sql = "SELECT * from Mst_ItemList where Status like '%".$iStatus."%'and StatusMadya like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='8'){
                $sql = "SELECT * from Mst_ItemList where Status like '%".$iStatus."%'and StatusPratama like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='9'){
                $sql = "SELECT * from Mst_ItemList where Status like '%".$iStatus."%'and StatusUtama like '%".$requestData['search']['value']."%'";
            }else if ($iSearch=='10'){
                $sql = "SELECT * from Mst_ItemList where Status like '%".$iStatus."%'and AssetType like '%".$requestData['search']['value']."%'";
            }else{

                $sql = "SELECT * from Mst_ItemList where Status like '%".$iStatus."%'"; 
                $sql .= "and IClassID like '%".$requestData['search']['value']."%'"; 
                $sql .= "or ItemTypeID  like '%".$requestData['search']['value']."%'";
                $sql .= "or ItemID  like '%".$requestData['search']['value']."%'";
                $sql .= "or ItemName  like '%".$requestData['search']['value']."%'";
                $sql .= "or Image  like '%".$requestData['search']['value']."%'";
                $sql .= "or VendorID  like '%".$requestData['search']['value']."%'";
                $sql .= "or StatusMadya  like '%".$requestData['search']['value']."%'";
                $sql .= "or StatusPratama  like '%".$requestData['search']['value']."%'";
                $sql .= "or StatusUtama  like '%".$requestData['search']['value']."%'";
                $sql .= "or AssetType  like '%".$requestData['search']['value']."%'";
                $sql .= "or Is_trash  like '%".$requestData['search']['value']."%'";
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
            $nestedData[] = $row["IClassID"];     
            $nestedData[] = $row["ItemTypeID"];
            $nestedData[] = $row["ItemID"];
            $nestedData[] = $row["ItemName"];
            $nestedData[] = $row["Image"];
            $nestedData[] = $row["VendorID"];     
            $nestedData[] = $row["StatusMadya"];
            $nestedData[] = $row["StatusPratama"];
            $nestedData[] = $row["StatusUtama"];
            $nestedData[] = $row["AssetType"];
          
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

        $id = trim(element('ItemID',$i_list));
        $id_kyw=(int)$this->session->userdata('id_kyw');
        $Status = trim(element('Status',$i_list));
        
        $data = array(
            'ItemID' => $id,
            'Status' => $Status,
            'UpdateBy' => $id_kyw,
            'UpdateDate' => date('Y-m-d H:i:s'),
            
        );
        $model = $this->global_m->ubah('Mst_ItemList', $data,'ItemID',$id);
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
        $IClassID = trim(element('IClassID',$i_list)); 
        $ItemTypeID = trim(element('ItemTypeID',$i_list));
        $ItemID = trim(element('ItemID',$i_list)); 
        $ItemName = trim(element('ItemName',$i_list));
        $Image = trim(element('Image',$i_list));
        $VendorID = trim(element('VendorID',$i_list));
        $StatusMadya = trim(element('StatusMadya',$i_list));
        $StatusPratama = trim(element('StatusPratama',$i_list));
        $StatusUtama = trim(element('StatusUtama',$i_list));
        $StatusMekar = trim(element('StatusMekar',$i_list));
        $AssetType = trim(element('AssetType',$i_list)); 
        $iStatus = trim(element('Status',$i_list));
        
        if(element('ItemID',$i_list)=="Generate"){
            $id = $this->master_itemlist_m->getIdMax();
            
             $data = array(
            'ItemID' => $id,
            'ItemTypeID' => $ItemTypeID,
            'IClassID' => $IClassID,
            'ItemName' => $ItemName,
            'Image' => $Image,
            'VendorID' => $VendorID,
            'StatusMadya' => $StatusMadya,
            'StatusPratama' => $StatusPratama,
            'StatusUtama' => $StatusUtama,
            'StatusMekar' => $StatusMekar,
            'AssetType' => $AssetType,
            'Status' => $iStatus,
            'CreateBy' => $id_kyw,
            'CreateDate' => date('Y-m-d H:i:s'),
            
        );
       }else{
            $id = trim(element('ItemID',$i_list));
         $data = array(
            'ItemID' => trim(element('ItemID',$i_list)),
            'ItemTypeID' => $ItemTypeID,
            'IClassID' => $IClassID,
            'ItemName' => $ItemName,
            'Image' => $Image,
            'VendorID' => $VendorID,
            'StatusMadya' => $StatusMadya,
            'StatusPratama' => $StatusPratama,
            'StatusUtama' => $StatusUtama,
            'StatusMekar' => $StatusMekar,
            'AssetType' => $AssetType,
            
            'UpdateBy' => $id_kyw,
            'UpdateDate' => date('Y-m-d H:i:s'),
            
        );
       }
      
       
        if(element('ItemID',$i_list)=="Generate"){
        $model = $this->global_m->simpan('Mst_ItemList', $data);
       }else{
        $model = $this->global_m->ubah('Mst_ItemList', $data,'ItemID',$id);
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


    public function OnClassItem($prop = '') {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->master_itemcategory_m->getUserKab($prop);
        $options = "";
        $options .= "<option  value='NULL' selected>-Pilih-</option>";
        foreach ($rows as $v) {
            $options .= "<option  value='" . $v->IClassID . "'>" . $v->ItemTypeName . "</option>";
        };

        //$this->output->set_output(json_encode($data));
        $this->output->set_output(json_encode($options));
    }

   public function getItemList() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->master_itemlist_m->getItemList();
        $data['data'] = array();
        foreach ($rows as $row) {

            $array = array(
                                 
               'ItemID' => trim($roq->ItemID),
               'ItemTypeID' => trim($row->ItemTypeID),
               'itemname' => trim($row->itemname), 
               'Image' => trim($row->Image)
              
            
            );

            array_push($data['data'], $array);
        }

        $this->output->set_output(json_encode($data));
    }

  

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */