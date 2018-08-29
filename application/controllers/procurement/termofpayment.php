<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Termofpayment extends CI_Controller {

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
            $this->load->model('procurement/budget_mdl', 'Budget_mdl');
            $this->load->model('procurement/menu_mdl', 'Menu_mdl');
            $this->load->model('procurement/termofpayment_mdl', 'Termofpayment_mdl');
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
        $menuId = $this->home_m->get_menu_id('procurement/termofpayment/home');
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
//            $data['karyawan'] = $this->global_m->tampil_id_desk('master_karyawan', 'id_kyw', 'nama_kyw', 'id_kyw');
//            $data['goluser'] = $this->global_m->tampil_id_desk('sec_gol_user', 'goluser_id', 'goluser_desc', 'goluser_id');
//            $data['statususer'] = $this->global_m->tampil_id_desk('sec_status_user', 'statususer_id', 'statususer_desc', 'statususer_id');

        $this->template->set('title', 'Term Of Payment');
        $this->template->load('template/template_dataTable', 'procurement/termofpayment/termofpayment_v', $data);
    }

    public function ajax_GridBudgetCapex() {
//        dari login
//        $sessid = $this->session->userdata('usergroup');
//        $method = $this->uri->segment('2');
//        $accesdata = $this->Menu_mdl->get_menusetting2($sessid, $method);
        $div = $this->session->userdata('DivisionID');
        $branch = $this->session->userdata('BranchID');
        $usergroup = $this->session->userdata('groupid');
        if ($branch == 1) { //JIKA PUSAT : semua ppi bisa lihat data kecuali ppi dengan usergroup support
            if (($div == '8' && $usergroup <> '3') || $div == '20' || $usergroup == '1') {
                $iwhere = array(
                    $this->input->post('sSearch') => $_POST['search']['value']
                );
            } else {
                $iwhere = array(
                    'DivisionID' => $div,
                    $this->input->post('sSearch') => $_POST['search']['value']
                );
            }
        } else { //JIKA CABANG : cabang hanya bisa melihat cabang dan divisinya saja
            $iwhere = array(
                'BranchID' => $div,
                $this->input->post('sSearch') => $_POST['search']['value']
            );
        }
        $icolumn = array('RequestID', 'ReqTypeName', 'DivisionCode', 'BranchName', 'SubTotalPrice', 'ReqCategoryName', 'RktName', 'PriceVendor', 'VendorName', 'Status', 'PathFile', 'Jenis_periode_sewa', 'Jangka_waktu', 'Termin_sewa', 'DivisionName', 'ReqTypeID', 'num');
        $iorder = array('RequestID' => 'asc');
        $list = $this->datatables_custom->get_datatables('vw_pr_termofpayment', $icolumn, $iorder, $iwhere);

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {
            $selt = $this->Termofpayment_mdl->seltermin($idatatables->RequestID);
            // EDITED BY WILLY 11 AGUSTUS 2017  
            $jenisperiode = $idatatables->Jenis_periode_sewa;
            if ($jenisperiode == '1') {
                $jenisperiode_ket = "[ Harian ]";
                $add_ket = "Hari";
            } elseif ($jenisperiode == '2') {
                $jenisperiode_ket = "[ Bulanan ]";
                $add_ket = "Bulan";
            } elseif ($jenisperiode == '3') {
                $jenisperiode_ket = "[ Tahunan ]";
                $add_ket = "Tahun";
            } else {
                $jenisperiode_ket = "";
                $add_ket = "Month";
            }
            $jangkawaktu = $idatatables->Jangka_waktu;
            $terminsewa = $idatatables->Termin_sewa;




            $no++;
            $row = array();
            $row[] = $no;

            $row[] = '<b>' . $idatatables->ReqTypeName . ' ' . $jenisperiode_ket . '</b> -' . $idatatables->ReqCategoryName . ' (' . $idatatables->RktName . ') ';
            $row[] = 'PO-' . trim($idatatables->DivisionCode) . '-' . trim(sprintf('%03u', $idatatables->RequestID));
            $row[] = $idatatables->BranchName . '<br>(' . $idatatables->DivisionName . ')';
            $row[] = 'Rp ' . number_format((float) $idatatables->SubTotalPrice) . '<br>Vendor: Rp ' . number_format((float) $idatatables->PriceVendor) . ' (' . $idatatables->VendorName . ')';
            $tblseltermin = '';
            if ($idatatables->Status == 2) {
                if (!empty($idatatables->PathFile)) {
                    $tblseltermin .= '<a data-toggle="modal" data-target="#MyTermin" data-id="<?php echo $row->RequestID; ?>" onclick="fom_modal("' . $idatatables->RequestID . '", ' . "'termin'" . ')"><button class="btn btn-primary btn-xs" type="button">Set Termin</button>';
                } else {
                    $tblseltermin .= '<button class="btn btn-primary btn-xs" type="button">Waiting...Upload List Item From PPI (Complete PO)</button>';
                }
            } else if ($idatatables->Status == 3 || $idatatables->Status == 4) {
                $seltermin = $this->Termofpayment_mdl->seltermin($idatatables->RequestID);
                $no_ = 1;
                if (count($seltermin) > 0) {
                    $tblseltermin .= '<table width="auto" border="1">';
                    foreach ($seltermin as $rows) {
                        $format = 'Y-m-d H:i:s.u';
                        $format_date = 'Y-m-d';
                        $date = DateTime::createFromFormat($format, $rows->DatePayment_termin);
                        //PENAMBAHAN WILLY 15 AGUSTUS
                        $date_jadwal = date("d-m-Y", strtotime($rows->DatePayment));
                        // END            
                        if ($rows->StatusPayment == 1 && $rows->NotifStatus == 1) {
                            $clr = 'lunas';
                            $pyst = '<img src="' . base_url() . 'metronic/img/lunas.png" width="40px" height="15px">';
                        } else if ($rows->StatusPayment == 0 || $rows->NotifStatus == 0) {
                            $clr = '';
                            $pyst = "";
                        }
                        $tblseltermin .='<tr class="' . $clr . '">';
                        $tblseltermin .=' <td width="" align="left">';
                        if ((int) $idatatables->ReqTypeID != 3) {
                            $tblseltermin .='Termin: ' . number_format((float) $rows->WorkProgress) . ' %';
                        } else {
                            $tblseltermin .= $add_ket . ' : ' . $no_;
                        }
                        $tblseltermin .='</td>';
                        $tblseltermin .='<td width="" align="left">Rp.' . $rows->WorkPayment . '</td>';
                        $tblseltermin .='<td width="" align="left">Date_Schedule: ';
                        if (!empty($rows->DatePayment)) {
                            $tblseltermin .= $date_jadwal;
                        }
                        $tblseltermin .='</td>';
                        $tblseltermin .=' <td width="" align="left">Date_Payment: ';
                        if (!empty($rows->Date_Payment_IAS)) {
                            $tblseltermin .= $rows->Date_Payment_IAS;
                        } else {
                            $tblseltermin .= '-';
                        }
                        $tblseltermin .='</td>';
                        $tblseltermin .='<td width="" align="left"><a href="' . base_url() . 'assets/uploads/' . $rows->File_PaymentReceipt . '">' . $pyst . '</a></td>';
                        $tblseltermin .='</tr>';

                        $no_++;
                    }
//                    $i + 1;
                }
                $tblseltermin .='</table>';
            }
            $row[] = $tblseltermin;
            $selaccess = '';
            //        dari login
//            if ($accesdata[0]->is_update == 1) {
            if ((int) $idatatables->ReqTypeID != 3) {
                if ((int) $idatatables->num < 1) {
                    if (!empty($idatatables->PathFile)) {
                        if (count($selt) > 0) {
                            $selaccess.='<a data-toggle="modal" data-target="#MyTermin" data-id="' . $idatatables->RequestID . '/upd" onclick="fom_modal(' . $idatatables->RequestID . ', ' . "'upd'" . ')">
                                                <button class="btn btn-primary btn-xs" type="button">Update</button></a><br>
                                                <a target="_blank" class="btn btn-primary btn-xs" style="margin-top: 7px;" href="' . base_url() . 'procurement/termofpayment/cetak_po/' . trim($idatatables->VendorID) . '/' . $idatatables->RequestID . '">Doc PO</a> ';
                        }
                    }
                }
            }
//            }
            if (!empty($rows->File_PaymentReceipt)) {
                if (!empty($idatatables->PathFile)) {
                    $selaccess.='<a href="' . base_url() . 'uploads/po/' . $idatatables->PathFile . '" download><button class="btn btn-primary btn-xs" type="button">Download</button></a>';
                }
            }
            $row[] = $selaccess;

            $data[] = $row;
        }
//        print_r($data);
//        die();
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->datatables_custom->count_all(),
            "recordsFiltered" => $this->datatables_custom->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function cetak_po($idvendor, $reqid) {
        //die($idvendor.'-'.$reqid);
        $vendor = $this->Termofpayment_mdl->getVendorPO($idvendor);
        $detailrequest = $this->Termofpayment_mdl->getDetailreq($reqid);
        $secNumber = $this->Termofpayment_mdl->getSeqNumber($detailrequest->BranchID, $detailrequest->DivisionID, $detailrequest->DatePO);
        $kodecab = $this->Termofpayment_mdl->getCodeBranch($detailrequest->BranchID);
        $lokasi = ((int) $kodecab == 00000) ? $detailrequest->DivisionCode : $detailrequest->BranchCode;
        $detailitem = $this->Termofpayment_mdl->getItem($reqid);
        $seltermin = $this->Termofpayment_mdl->seltermin($reqid);
        $id_divisi = $this->session->userdata('DivisionID');
        $id_branch = $this->session->userdata('BranchID');
        //die($id_divisi.'-'.$id_branch);
        if ($id_divisi != '0') {
//                die('cabang');
            $selDivisi = $this->Termofpayment_mdl->selDivisi($id_divisi);
        } else {
//                die('cabang I');
            $selDivisi = $this->Termofpayment_mdl->selCabang($id_branch);
        }
        $data = array(
            'vendor' => $vendor,
            'secNumber' => $secNumber,
            'detailitem' => $detailitem,
            'lokasi' => $lokasi,
            'seltermin' => $seltermin,
            'selDivisi' => $selDivisi
        );
        define('FPDF_FONTPATH', $this->config->item('fonts_path'));
        $data['image1'] = base_url('metronic/img/tatamasa_logo.jpg');
        $this->load->view('procurement/termofpayment/cetak_po', $data);
        // die('in');
    }

    public function payment_termin() {
//        $id = $this->uri->segment('4');
        $id = $this->input->get('iid');
        $reqdetail = $this->Termofpayment_mdl->seldetil($id);
        $termin = $this->Termofpayment_mdl->payment_termin($id);
        $data = array(
            'listdata' => $reqdetail[0],
            'termin' => $termin,
            'RequestID' => $id
        );
        $this->load->view('procurement/termofpayment/payment_termin', $data);
    }

    public function set_termin() {
//        $id = $this->uri->segment('4');
        $RequestID = $this->input->get('iid');
//        $RequestName = $this->input->post('RequestName');
        if ($RequestID != "") {
            $this->Termofpayment_mdl->settermin($RequestID);
            $this->session->set_flashdata('msg', 'Success! Set Termin');
        } else {
            $chektermin = $this->Termofpayment_mdl->chek_termin($this->uri->segment('4'));
            if (empty($chektermin)) {
                $divdetail = $this->Termofpayment_mdl->seldetil($id);
                $itemdetail = $this->Termofpayment_mdl->req_itemdetail($id);
                $data = array(
                    'listdata' => $divdetail[0],
                    'reqitem' => $itemdetail
                );
                $this->load->view('procurement/termofpayment/set_termin', $data);
            } else {
                echo "Proses Tidak Dapat Dilanjutkan!, Set Termin Sudah Pernah Diset Sebelumnya,Mohon Reload Untuk Mengetahui Termin Yang Sudah Di Prosess ";
            }
        }
    }

    /* EDITED BY WILLY 8 AGUSTUS 2017 */

    public function update_termin() {
        $RequestID = $this->input->post('RequestID');
        //INSERT DATA TERMIN
        $this->db2 = $this->load->database('config1', true);
        $this->db2->query("DELETE from Pay_Termin where RequestID ='$RequestID'");
        $this->db2->query("DELETE from Pay_IAS where RequestID ='$RequestID'");

        for ($i = 1; $i < $this->input->post('totalrow') + 1; $i++) {
            $chektermin = $this->Termofpayment_mdl->find_termin($this->input->post('terminID' . $i));
            // echo $this->input->post('terminID'.$i);echo "<br>++++++++++++++++";
            $chektermin = count($chektermin);

            if ($chektermin < 1) {
                // print_r("expression111");
                $datatermin = array(
                    'RequestID' => $RequestID,
                    'VendorID' => $this->input->post('VendorID'),
                    'Step' => $i,
                    'WorkProgress' => $this->input->post('progress' . $i),
                    'WorkPayment' => $this->input->post('payment' . $i),
                    'DatePayment' => $this->input->post('DatePayment' . $i),
                    'StatusPayment' => 0,
                    'NotifStatus' => 1,
                    'Status_Ias' => 0
                );
                $this->db2 = $this->load->database('config1', true);
                $this->db2->insert('Pay_Termin', $datatermin);
                $this->db2->close();
            } else {
                // print_r("expression222");
                $terminID = $this->input->post('terminID' . $i);
                $updtermin = array(
                    'RequestID' => $RequestID,
                    'VendorID' => $this->input->post('VendorID'),
                    'Step' => $i,
                    'WorkProgress' => $this->input->post('progress' . $i),
                    'WorkPayment' => $this->input->post('payment' . $i),
                    'DatePayment' => $this->input->post('DatePayment' . $i),
                    'StatusPayment' => 0
                        //'NotifStatus'=>1
                );
                //print_r($updtermin);
                $this->db2 = $this->load->database('config1', true);
                $this->db2->where('TerminID', $terminID);
                $status = $this->db2->update('Pay_Termin', $updtermin);
                $this->db2->close();
                if ($status)
                    $this->session->set_flashdata('msg', 'Success! Update Termin');
                else
                    $this->session->set_flashdata('msg', 'Faild! Update data');
                /* $this->db2 = $this->load->database('ms', true);
                  $this->db2->where('TerminID',$this->input->post('terminID'.$i));
                  $this->db2->update('Pay_Termin',$updtermin);
                  $this->db2->close(); */
            }
            $this->session->set_flashdata('msg', 'Success! Update Termin');
        }
    }

    /* END EDITED BY WILLY */

    public function prosess_termin() {
        $RequestID = $this->input->post('RequestID');
        $chektermin = $this->Termofpayment_mdl->chek_termin($RequestID);
        print_r($chektermin);
        die();
        if (empty($chektermin)) {
            $this->Termofpayment_mdl->settermin($RequestID);
            $this->session->set_flashdata('msg', 'Success! Set Termin');
        } else {
            $this->session->set_flashdata('msg', 'Gagal! Set Termin sudah Pernah Dilakukuan');
        }
    }

//    old
    public function readExcel() {
        $config['upload_path'] = "./uploads/";
        $config['allowed_types'] = 'xlsx|xls';
        $config['max_size'] = '25000';
        $config['file_name'] = 'BUDGET-' . date('YmdHis');

        $this->load->library('upload', $config);


        if ($this->upload->do_upload("namafile")) {
            $data = $this->upload->data();
            $file = './uploads/' . $data['file_name'];

//load the excel library
            $this->load->library('excel/phpexcel');
//read file from path
            $objPHPExcel = PHPExcel_IOFactory::load($file);
//get only the Cell Collection
            $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
//extract to a PHP readable array format
            foreach ($cell_collection as $cell) {
                $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
//header will/should be in row 1 only. of course this can be modified to suit your need.
                if ($row == 1) {
                    $header[$row][$column] = $data_value;
                } else {
                    $arr_data[$row][$column] = $data_value;
                }
            }
// BudgetCOA, Year, BranchID, BisUnitID, DivisionID, BudgetValue, CreateDate, CreateBy, BudgetOwnID, BudgetUsed, Status, Is_trash
            $data = '';
            $flag = 1;
            $date = date('Y-m-d');
            $by = $this->session->userdata('user_id');

            foreach ($arr_data as $key => $value) {
                if (!empty($value["F"]) && $value["F"] != "-" && $value["F"] != "" && !empty($value["A"])) {
                    $this->Budget_mdl->simpan($value["A"], $value["B"], $value["D"], $value["E"], $value["F"]);
                }
            }

// $this->Budget_mdl->simpanData($data);	
        } else {
            $this->session->set_flashdata('msg', $this->upload->display_errors());
        }
        echo json_encode(TRUE);
    }

    public function downloadWord() {
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
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'COA');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'YEAR');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Branch - (Divisi)');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'BranchID');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'DivisionID');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'BudgetValue');

        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'LENGKAPI DATA HANYA DI BAGIAN COA, YEAR DAN BUDGET VALUE');
        $objPHPExcel->getActiveSheet()->setCellValue('I2', 'DILARANG MENGUBAH DATA SELAIN KOLOM YANG DISEBUTKAN DIATAS');

//make the font become bold
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
        $data = $this->Budget_mdl->allBranch();
        $counter = 2;
        foreach ($data as $key) {

            $objPHPExcel->getActiveSheet()->setCellValue('A' . $counter, " " . $key->coa);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $counter, date("Y"));
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $counter, ((int) $key->BranchCode == 00000) ? $key->BranchName . "-" . $key->DivisionName : $key->BranchName);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $counter, $key->BranchID);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $counter, ((int) $key->BranchCode == 00000) ? $key->DivisionID : " ");
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $counter, "");
            $objPHPExcel->getActiveSheet()->getStyle('A1:A' . $counter)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
            $counter++;
        }

        ob_end_clean();
//Header
        $filename = "budget.xlsx";
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

    public function ddBranch() {
        $ddBranch = $this->Budget_mdl->getBranch();
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
        $ddDivisi = $this->Budget_mdl->getdivisi($BranchID);
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
        $this->Budget_mdl->updatedata($budgetid);

        $result = array('istatus' => true, 'iremarks' => 'Success! budget COA: ' . $COA . ' Success Update data'); //, 'body'=>'Data Berhasil Disimpan');

        echo json_encode($result);
    }

    public function ajax_delete() {
        $id = $this->input->post('sbudgetID');
        $this->Budget_mdl->deletedata($id);

        $result = array('istatus' => true, 'iremarks' => 'Success.!'); //, 'body'=>'Data Berhasil Disimpan');

        echo json_encode($result);
    }

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */