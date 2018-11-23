<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class po extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('admin/konfigurasi_menu_status_user_m');
        $this->load->model('global_m');
        $this->load->model('procurement/master_po_m');
        
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
        $flow = $this->master_po_m->getflow();
        $menuId = $this->home_m->get_menu_id('procurement/po/home');
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
            $this->template->set('title', 'PO');
            // $this->template->load('template/template_dataTable', 'procurement/po/test', $data);
            $this->template->load('template/template_dataTable', 'procurement/po/index_po_v', $data);
            // $this->template->load('template/template_dataTable', 'v_po_2', $data);
        }
    } else {
      $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);
            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan','id_kyw','nama_kyw','id_kyw');
            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user','goluser_id','goluser_desc','goluser_id');
            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user','statususer_id','statususer_desc','statususer_id');
            
            $this->template->set('title', 'PO');
            // $this->template->load('template/template_dataTable', 'procurement/po/test', $data);
            $this->template->load('template/template_dataTable', 'procurement/po/index_po_v', $data);
            // $this->template->load('template/template_dataTable', 'v_po_2', $data);
        }
    }

    function po_form($id){
        $menuId = $this->home_m->get_menu_id('procurement/po/home');
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
        $data['po'] = $this->master_po_m->get_po($id);
        $data['listvendor'] = $this->master_po_m->get_all_vendor($id);
        $data['listvendors'] = $this->master_po_m->get_win_vendor($id);
        $data['item'] = $this->master_po_m->getItemList($id);
        $data['titem'] = count($this->master_po_m->getItemList($id));
        $data['thps'] = 0;
        $data['tqty'] = 0;
        foreach ($data['item'] as $item) {
            $data['thps'] += $item->total;
            $data['tqty'] += $item->Qty;
        }

        $data['request'] = $this->master_po_m->getRequest($id);
        $data['hargatotal'] = 0;
        foreach ($this->master_po_m->getItemList($id) as $total) {
            $data['hargatotal'] += $total->total;
        }

        $data['nama_po'] = "PO";
        $data['nama_spk'] = "SPK";
        $data['nama_kpbj'] = "KPBJ";
        $data['nama_psw'] = "PSW";


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
            $this->template->set('title', 'PO');
            $this->template->load('template/template_dataTable', 'procurement/po/master_po_v', $data);
        }
    } else {
      $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);
            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan','id_kyw','nama_kyw','id_kyw');
            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user','goluser_id','goluser_desc','goluser_id');
            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user','statususer_id','statususer_desc','statususer_id');
            
            $this->template->set('title', 'PO');
            $this->template->load('template/template_dataTable', 'procurement/po/master_po_v', $data);
        }
    }

    public function po_dokumen($id)
    {
        $menuId = $this->home_m->get_menu_id('procurement/po/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);

        $data['detail_po'] = $this->master_po_m->get_detail_po($id);
        $data['dokumen'] = $this->master_po_m->get_doc($id);
        $this->template->set('title', 'Upload Dokumen');
        $this->template->load('template/template_dataTable', 'procurement/po/form_upload', $data);
    }

    public function getTableList() {
        $this->CI = & get_instance();
        $rows = $this->master_po_m->getList($this->global_m->getFlow('7-2'));
        $data['data'] = array();
        foreach ($rows as $row) {
            $array = array(
                'noPr' => trim($row->RequestID),
                'tglReq' => trim($row->DATE),
                'reqType' => trim($row->ReqTypeName),
                'catName' => trim($row->ReqCategoryName),
                'projName' => trim($row->PROJECT_NAME),
                'branch' => trim($row->BRANCH_DESC),
                'divisi' => trim($row->DIV_DESC),
                'catatan' => trim($row->NOTE),
                'status' => trim($row->status),
                'jumlah' => $row,
            );
            // var_dump($array['jumlah']);exit();

            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }

    public function savedata()
    {
        $flow = $this->master_po_m->getflow();
        $cek_po = $this->master_po_m->cek_po($this->input->post('id_pr'));
        $id_po_detail = $this->global_m->getIdMax('ID_PO_DETAIL','TBL_T_PO_DETAIL');
        if (!empty($cek_po)) {
            $id_po = $cek_po->ID_PO;
        }else{
            $id_po = $this->global_m->getIdMax('ID_PO','TBL_T_PO');
            $head['ID_PO'] = $id_po;
            $head['ID_PR'] = $this->input->post('id_pr');
            $head['flow_id'] = 1;
            $head['status'] = '7-2';
            $this->master_po_m->save_po($head);
        }

        // po detail total
        $detail['ID'] = $this->global_m->getIdMax('ID','TBL_T_PO_DTL_TOTAL');
        $detail['ID_PO_DETAIL'] = $id_po_detail;
        $detail['JML_ITEM'] = $this->input->post('jnsbrg');
        $detail['TTL_QTY'] = $this->input->post('jmlbrg');
        $detail['SUB_TOTAL'] = $this->input->post('subtotal');
        $detail['DISC'] = $this->input->post('disc');
        $detail['PPN'] = $this->input->post('ppn');
        $detail['PPH'] = $this->input->post('pph');
        $detail['TOTAL'] = $this->input->post('totalall');
        $detail['CREATE_BY'] = $this->session->userdata('user_id');
        $detail['CREATE_DATE'] = date('Y-m-d H:i:s');
        $this->master_po_m->save_detail_total($detail);
        
        //request log
        $log['RequestID'] = $this->input->post('id_pr');
        $log['status_dari'] = $flow->status_dari;
        $log['action'] = $flow->ACTION;
        $log['status_ke'] = $flow->status_ke;
        $log['user_id'] = $this->session->userdata('user_id');
        $log['date'] = date('Y-m-d H:i:s');
        $this->master_po_m->save_log($log);

        //berdasarkan vendor

        for ($i=0; $i < count($_POST['barang']); $i++) { 
            $data['ID_PO'] = $id_po;
            $data['VENDOR_ID'] = $this->input->post('id_vendor');
            $data['ID_PO_DETAIL'] = $id_po_detail;
            $data['ITEM_ID'] = $_POST['itemid'][$i];
            $data['NAMA_BARANG'] = $_POST['barang'][$i];
            $data['QTY'] = $_POST['qty'][$i];
            $data['HARGA'] = $_POST['satuan'][$i];
            $data['TTL_HARGA'] = $_POST['hargatotal'][$i];

            $this->master_po_m->save_po_detail($data);
        }
        
        // termin
        for ($i=0; $i < count($_POST['persentase']); $i++) {
            $termin = array(
                            'ID_PO' => $id_po,
                            'TERMIN' => $_POST['term'][$i],
                            'ID_PO_DETAIL' => $id_po_detail,
                            'PERSENTASE' => $_POST['persentase'][$i],
                            'NILAI' => $_POST['nilai'][$i],
                            'TGL_JATUH_TEMPO' => DateTime::createFromFormat('d/m/Y', $_POST['tempo'][$i])->format('Y-m-d')
                            );

            if (!empty($this->input->post('dterima'))) {
                // $date2 = DateTime::createFromFormat('d/m/Y', $this->input->post('dterima'));
                $termin['TGL_JT_TERIMA_BRG'] = DateTime::createFromFormat('d/m/Y', $this->input->post('dterima'))->format('Y-m-d');
            }else{
                $termin['TGL_JT_TERIMA_BRG'] = DateTime::createFromFormat('d/m/Y', $_POST['akhir'][$i])->format('Y-m-d');
            }

            $this->master_po_m->save_termin($termin);
        }

        if (count($_POST['check'] > 0)) {
            for ($i=0; $i < count($_POST['check']); $i++) { 
                $doc['ID'] = $this->global_m->getIdMax('ID','TBL_T_PO_GENERATE_DOC');
                $doc['ID_PO_DETAIL'] = $id_po_detail;
                $doc['NAMA_DOC'] = $_POST['check'][$i];
                
                $doc['CREATE_BY'] = $this->session->userdata('user_id');
                $doc['CREATE_DATE'] = date('Y-m-d H:i:s');
                if ($_POST['check'][$i] == 'PO') {
                    $max_po = "PO-00000000000-0000";
                    // $urut_dpo = (int) substr($max_po, 15, 18);
                    $kode_po = substr($max_po, 0, 16);
                    $doc['NO_DOC'] = $kode_po.sprintf("%04s", $id_po);
                }elseif ($_POST['check'][$i] == 'SPK') {
                    $get_spk = $this->master_po_m->no_doc($_POST['check'][$i], strlen($_POST['check'][$i]));
                    if (!empty($get_spk)) {
                        $max_spk = $get_spk->NO_DOC;
                    }else{
                        $max_spk = "SPK-00000000000-0000";
                    }

                    $urut_spk = (int) substr($max_spk, 16, 19);
                    $kode_spk = substr($max_spk, 0, 16);
                    $doc['NO_DOC'] = $kode_spk.sprintf("%04s", $urut_spk+1);
                }elseif ($_POST['check'][$i] == 'KPBJ') {
                    $get_kpbj = $this->master_po_m->no_doc($_POST['check'][$i], strlen($_POST['check'][$i]));
                    if (!empty($get_kpbj)) {
                        $max_kpbj = $get_kpbj->NO_DOC;
                    }else{
                        $max_kpbj = "KPBJ-00000000000-0000";
                    }

                    $urut_kpbj = (int) substr($max_kpbj, 17, 20);
                    $kode_kpbj = substr($max_kpbj, 0, 17);
                    $doc['NO_DOC'] = $kode_kpbj.sprintf("%04s", $urut_kpbj+1);
                }elseif ($_POST['check'][$i] == 'PSW') {
                    $get_psw = $this->master_po_m->no_doc($_POST['check'][$i], strlen($_POST['check'][$i]));
                    if (!empty($get_psw)) {
                        $max_psw = $get_psw->NO_DOC;
                    }else{
                        $max_psw = "PSW-00000000000-0000";
                    }

                    $urut_psw = (int) substr($max_psw, 16, 19);
                    $kode_psw = substr($max_psw, 0, 16);
                    $doc['NO_DOC'] = $kode_psw.sprintf("%04s", $urut_psw+1);
                }

                $this->master_po_m->save_doc($doc);
            }
        }

        $return['status'] = true;
        if (!empty($this->input->post('redirect'))) {
            $return['redirect'] = true;
        }

        echo json_encode($return);
    }

    public function uploaddok()
    {
        // var_dump($_FILES);exit();
        foreach ($_FILES as $key => $value) {
            if ($_FILES[$key]['name'] != NULL) {
                $new_name = time().$_FILES[$key]['name'];
                $config = array(
                        'upload_path' => "./uploads/template/doc/",
                        'allowed_types' => "doc|docx",
                        'file_name' => $new_name,
                        'overwrite' => TRUE,
                        // 'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                        // 'max_height' => "2048",
                        // 'max_width' => "2048"
                        );
                $upload = $this->load->library('upload', $config);
                if($this->upload->do_upload($key))
                {
                    $doc['DOC_PATH'] = 'uploads/template/doc/'.$new_name;
                    $this->master_po_m->uploaddoc($doc, $key);
                }else{
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('procurement/po/home');
                }
            }
        }
        $this->session->set_flashdata('success', 'Data Berhasil Disimpan');
        redirect('procurement/po/home');
    }

    public function dl_dok($no_dok)
    {
        $this->load->library('word');
        $PHPWord = $this->word; // New Word Document
        $section = $PHPWord->createSection(); // New portrait section
        // Add text elements
        $section->addText($no_dok, array('name'=>'Verdana', 'color'=>'006699'));
        $section->addTextBreak(2);
        $PHPWord->addFontStyle('rStyle', array('bold'=>true, 'italic'=>true, 'size'=>16));
        $PHPWord->addParagraphStyle('pStyle', array('align'=>'center', 'spaceAfter'=>100));
        // Save File / Download (Download dialog, prompt user to save or simply open it)
        $section->addText('Test dokumen', 'rStyle', 'pStyle');
        
        $filename='dokumen '.$no_dok.'.docx'; //save our document as this file name
        ob_end_clean();
        header("Content-type: application/vnd.ms-word");
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        header("Pragma: no-cache");
        header("Expires: 0");
        $objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
        $objWriter->save('php://output');
    }
  
}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */