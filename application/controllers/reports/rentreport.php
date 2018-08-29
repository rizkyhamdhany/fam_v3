<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Rentreport extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata("is_login") === FALSE) {
            $this->sso->log_sso();
        } else {
            session_start();
            $this->load->model('home_m');
            $this->load->model('admin/konfigurasi_menu_status_user_m');
            $this->load->model('global_m');
            $this->load->model('reports/rentreport_mdl', 'report');
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
        $menuId = $this->home_m->get_menu_id('reports/rentreport/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['group_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();

//        $data['vendor'] = $this->report->getVendor();
        $data['cabang'] = $this->report->getBranchDivisi();
//        print_r($data);die();
        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
//        $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user', 'statususer_id', 'statususer_desc', 'statususer_id');

        $this->template->set('title', 'Rent report');
        $this->template->load('template/template_dataTable', 'reports/rentreport/rentreport_v', $data);
    }

    public function ajax_GridVendor() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
//        $iPID = trim($this->input->post('sPID'));
        $rows = $this->report->getRentAll();
        print_r($rows);
        die();
        $data['data'] = array();
        $no = 1;
        foreach ($rows as $row) {
            $array = array(
                'no' => $no++,
                'ias' => $row->ias,
                'deskripsi' => $row->deskripsi,
                'vendor' => $row->VendorName,
                'kwi' => $row->Kwi,
                'Fpur' => $row->Fpur,
                'Nomor' => $row->Nomor,
                'nominal' => "Rp " . number_format((float) $row->WorkPayment, 2),
                'tgl_upload_doc' => $row->tgl_upload_doc,
                'tgl_dibayar' => $row->tgl_dibayar,
                'status_doc' => $row->status_doc,
                'status_pembayaran' => $row->status_pembayaran
            );
            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }

    public function downloadReport() {
        $this->load->helper('download');

        $this->load->library('excel/phpexcel');

        //membuat objek
        $objPHPExcel = new PHPExcel();
        //activate worksheet number 1
        $objPHPExcel->setActiveSheetIndex(0);
        //name the worksheet
        $objPHPExcel->getActiveSheet()->setTitle('budget worksheet');

        // $users = (array)$users[0];
        //set cell A1 content with some text
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'NO IAS');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Deskripsi PR');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Nama Vendor');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'NO FPUR');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'NO KWITANSI');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'NO Tagihan');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Nominal');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Tgl. Upload Dokumen');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Tgl. Dibayarkan');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Status Pembayaran');

        //make the font become bold
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);

        $data = $this->report->getExcelData();
        $counter = 2;
        foreach ($data as $key) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $counter, trim($key->ias));
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $counter, trim($key->deskripsi));
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $counter, trim($key->VendorName));
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $counter, trim($key->Fpur));
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $counter, trim($key->Kwi));
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $counter, trim($key->Nomor));
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $counter, "Rp " . number_format((float) $key->WorkPayment, 2));
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $counter, trim($key->tgl_upload_doc));
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $counter, trim($key->tgl_dibayar));
            $objPHPExcel->getActiveSheet()->setCellValue('J' . $counter, trim($key->status_pembayaran));
            $counter++;
        }

        ob_end_clean();
        //Header
        $filename = "Vendor Report.xlsx";
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Content-type: application/vnd.ms-excel");
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header("Pragma: no-cache");
        header("Expires: 0");

        //Save ke .xlsx, kalau ingin .xls, ubah 'Excel2007' menjadi 'Excel5'
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        //Download
        $objWriter->save("php://output");
    }

}

/* End of file sec_user.php */
    /* Location: ./application/controllers/sec_user.php */    