<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_groupasset extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('admin/konfigurasi_menu_status_user_m');
        $this->load->model('global_m');
        $this->load->model('master_ams_m/master_groupasset_m');
        
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

    function home() 
    
   
    {
//       $menuId = $this->home_m->get_menu_id('parameter/master_groupasset/home');
        $menuId = $this->home_m->get_menu_id('parameter/master_invoice/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        
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
            $data['propinsi'] = $this->master_groupasset_m->getProp();
            $this->template->set('title', 'Master Group Asset');
            $this->template->load('template/template_dataTable', 'master_ams/master_groupasset_v', $data);
        }
    } else {
            $data['propinsi'] = $this->master_groupasset_m->getProp();
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);
            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan','id_kyw','nama_kyw','id_kyw');
            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user','goluser_id','goluser_desc','goluser_id');
            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user','statususer_id','statususer_desc','statususer_id');
            $this->template->set('title', 'Master Group Asset');
            $this->template->load('template/template_dataTable', 'master_ams/master_groupasset_v', $data);
        }
    }

   public function getUserInfo() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->master_groupasset_m->getUserInfo();
        $data['data'] = array();
        foreach ($rows as $row) {

            $array = array(
                'kodegroup' => trim($row->kodegroup),
                'namagroup' => trim($row->namagroup),
                'jenisasset' => trim($row->jenisasset),
                'metodesusut' => trim($row->metodesusut),
                'umurassetdalambulan' => trim($row->umurassetdalambulan),
                'statussusut' => trim($row->statussusut),
                'persennilaisisa' => trim($row->persennilaisisa),
                'pembulatan' => trim($row->pembulatan),
                'waktumulaisusut' => trim($row->waktumulaisusut),
                'formatkodeasset' => trim($row->formatkodeasset),
                'noakhirkodeasset' => trim($row->noakhirkodeasset),
                //mobil
                'merk_mobil' =>trim ($row->merk_mobil),
                'type_mobil' =>trim ($row->type_mobil),
                'model_mobil' =>trim ($row->model_mobil),
                'warna_mobil' =>trim ($row->warna_mobil),
                'norangka_mobil' => trim ($row->norangka_mobil),
                'nomesin_mobil' => trim ($row->nomesin_mobil),
                'isisilinder_mobil' => trim ($row->isisilinder_mobil),
                'tahunpembuatan_mobil' => trim ($row->tahunpembuatan_mobil),
                //computer
                'merk_computer' => trim($row->merk_computer),
                'type_computer' => trim($row->type_computer),
                'model_computer' => trim ($row->model_computer),
                'jenisprocessor_computer' => trim ($row->jenisprocessor_computer),
                 'ram_computer' => trim ($row->ram_computer),
                'sd_computer' => trim ($row->sd_computer),
                'hdd_computer' => trim ($row->hdd_computer),
                'serialnumber_computer' => trim ($row->serialnumber_computer),
                //genset
                 'merk_genset' => trim ($row->merk_genset),
                 'type_genset' => trim ($row->type_genset),
                 'model_genset' => trim ($row->model_genset),
                'kva_genset' => trim ($row->kva_genset),
                'enginesn_genset' => trim ($row->enginesn_genset),
                'noenginetype_genset' => trim ($row->noenginetype_genset),
                 'alternatortype_genset' => trim ($row->alternatortype_genset),
                'alternatorsn_genset' => trim ($row->alternatorsn_genset),
                //inventaris
                'merk_inventaris' => trim ($row->merk_inventaris),
                'typemodel_inventaris' => trim ($row->typemodel_inventaris),
                'ukuran_inventaris' => trim ($row->ukuran_inventaris),
                
            );

            array_push($data['data'], $array);
        }

        $this->output->set_output(json_encode($data));
    }
    function simpan() {
    
        
        $kodegroup = $this->master_groupaset_m->getIdMax();
        $namagroup = trim($this->input->post('namagroup'));
        $jenisasset = trim($this->input->post('jenisasset'));
        $metodesusut = trim($this->input->post('metodesusut'));
        $umurassetdalambulan = trim($this->input->post('murassetdalambulan'));
        $statussusut = trim($this->input->post('statussusut'));
        $persennilaisisa = trim($this->input->post('persennilaisisa'));
        $pembulatan = trim($this->input->post('pembulatan'));
        $waktumulaisusut = trim($this->input->post('waktumulaisusut'));
        $formatkodeasset = trim($this->input->post('formatkodeasset'));
        $noakhirkodeasset = trim($this->input->post('noakhirkodeasset'));
        $merk = trim($this->input->post('merk_mobil')); 
        $type = trim($this->input->post('type_mobil'));
        $model = trim($this->input->post('model_mobil')); 
        $warna = trim($this->input->post('warna_mobil')); 
        $norangka = trim($this->input->post('norangka_mobil')); 
        $nomesin = trim($this->input->post('nomesin_mobil'));
        $isisilinder = trim($this->input->post('isisilinder_mobil'));
        $tahunpembuatan = trim($this->input->post('tahunpembuatan_mobil'));
        //computer
        $merk = trim($this->input->post('merk_computer'));
        $type = trim($this->input->post('type_computer')); 
        $model = trim ($this->input->post('model_computer')); 
        $jenisprocessor = trim($this->input->post('jenisprocessor_computer'));
        $ram = trim ($this->input->post('ram_computer')); 
        $sd = trim ($this->input->post('sd_computer'));
        $hdd = trim ($this->input->post('hdd_computer')); 
        $serialnumber = trim ($this->input->post('serialnumber_computer'));
        //genset
        $merk = trim ($this->input->post('merk_genset')); 
        $type = trim ($this->input->post('type_genset')); 
        $model = trim($this->input->post('model_genset')); 
        $kva = trim ($this->input->post('kva_genset')); 
        $enginetype = trim($this->input->post('noenginetype_genset'));
        $enginesn = trim ($this->input->post('enginesn_genset'));
        $alternatortype= trim ($this->input->post('alternatortype_genset'));
        $alternatorsn = trim ($this->input->post('alternatorsn_genset')); 
        //inventaris
        $merk = trim ($this->input->post('merk_inventaris')); 
        $type = trim ($this->input->post('typemodel_inventaris'));
        $ukuran = trim ($this->input->post('ukuran_inventaris'));
        
        
        
         
        $data = array(
            
            'kodegroup' => $kodegroup,
            'namagroup' => $namagroup,
            'jenisasset' => $jenisasset,
            'metodesusut' => $metodesusut,
            'umurassetdalambulan' => empty(trim($umurassetdalambulan)) ? 0 : $umurassetdalambulan,
            'statussusut' => $statussusut,
            'persennilaisisa' => $persennilaisisa,
            'pembulatan' => $pembulatan,
            'waktumulaisusut' => $waktumulaisusut,
            'formatkodeasset' => $formatkodeasset,
            'noakhirkodeasset' => $noakhirkodeasset,
            //mobil
            '0merk' => empty(trim($merk)) ? 0 : $merk,
            '0type' => empty(trim($type)) ? 0 : $type,
            '0model' => empty(trim($model)) ? 0 : $model,
            '0warna' => empty(trim($warna)) ? 0 : $warna,
            '0norangka' => empty(trim($norangka)) ? 0 : $norangka,
            '0nomesin' => empty(trim($nomesin)) ? 0 : $nomesin,
            '0isisilinder' => empty(trim($isisilinder)) ? 0 : $isisilinder,
            '0tahunpembuatan' =>  empty(trim($tahunpembuatan)) ? 0 : $tahunpembuatan, 
            //computer
            '1merk' => empty(trim($merk)) ? 0 : $merk, 
            '1type' => empty(trim($type)) ? 0 : $type,
            '1model' =>  empty(trim($model)) ? 0 : $model,
            '1jenisprocessor' => empty(trim($jenisprocessor)) ? 0 : $jenisprocessor, 
            '1ram' =>  empty(trim($ram)) ? 0 : $ram, 
            '1sd' =>  empty(trim($sd)) ? 0 : $sd, 
            '1hdd' =>  empty(trim($hdd)) ? 0 : $hdd,
            '1sn' => empty(trim($serialnumber)) ? 0 : $serialnumber, 
            //genset
            '2merk' =>empty(trim($merk)) ? 0 : $merk,  
            '2type' =>empty(trim($type)) ? 0 : $type, 
            '2model' => empty(trim($model)) ? 0 : $model,
            '2kva' => empty(trim($kva)) ? 0 : $kva,
            '2enginetype' =>  empty(trim($enginetype)) ? 0 : $enginetype,
            '2enginesn' =>  empty(trim($enginesn)) ? 0 : $enginesn,
            '2alternatortype' => empty(trim($alternatortype)) ? 0 : $alternatortype,
            '2alternatorsn' =>  empty(trim($alternatorsn)) ? 0 : $alternatorsn,
            //inventaris
            '3merk' => empty(trim($merk)) ? 0 : $merk,//$type,
            '3type' => empty(trim($type)) ? 0 : $type,//$type,
            '3ukuran' => empty(trim($ukuran)) ? 0 : $ukuran
        );
        $model = $this->global_m->simpan('amspargroupasset', $data);
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
        redirect('parameter/master_groupasset/home');
        
    }

    function ubah() {
   
      $id = trim($this->input->post('kab'));
        $prop = trim($this->input->post('prop'));
        $namaKab = trim($this->input->post('namaKab'));
        
        $data = array(
            'kodepropinsi' => $prop,
//            'kodekabupaten' => $id,
            'namakabupaten' => $namaKab
        );
        $model = $this->global_m->ubah('amsparkabupaten', $data,'kodekabupaten',$id);
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
        redirect('parameter/master_kabupaten/home');
    }

    function hapus() {
        $this->CI = & get_instance();
          $id = trim($this->input->post('kab'));
        $model = $this->global_m->deleteUser('amsparkabupaten','kodekabupaten',$id);
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
        redirect('parameter/master_kabupaten/home');
    }

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */