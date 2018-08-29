<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Listasset extends CI_Controller {

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
            $this->load->model('procurement/menu_mdl', 'Menu_mdl');
            $this->load->model('asset_management/payment_mdl', 'Payment_mdl');
            $this->load->model('asset_management/listasset_mdl', 'assetlist');
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
        $menuId = $this->home_m->get_menu_id('asset_management/listasset/home');
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

        $this->template->set('title', 'Listasset');
        $this->template->load('template/template_dataTable', 'asset_management/listasset/listasset_v', $data);
    }

    public function ajax_GridMutation() {
        $div = $this->session->userdata('DivisionID');
        $branch = $this->session->userdata('BranchID');
        $usergroup = $this->session->userdata('groupid');

        if ($this->input->post('sZoneName') != "") {
            $iwhere1 = array('ZoneName' => $this->input->post('sZoneName'));
        } else {
            $iwhere1 = array();
        }
        if ($this->input->post('sDivisionName') != "") {
            $iwhere2 = array('DivisionName' => $this->input->post('sDivisionName'));
        } else {
            $iwhere2 = array();
        }
        if ($this->input->post('sBisUnitName') != "") {
            $iwhere3 = array('BisUnitName' => $this->input->post('sBisUnitName'));
        } else {
            $iwhere3 = array();
        }
        if ($this->input->post('sFAID') != "") {
            $iwhere4 = array('FAID' => $this->input->post('sFAID'));
        } else {
            $iwhere4 = array();
        }
        if ($this->input->post('sItemName') != "") {
            $iwhere5 = array('ItemName' => $this->input->post('sItemName'));
        } else {
            $iwhere5 = array();
        }

        $iwhere = array_merge($iwhere1, $iwhere2, $iwhere3, $iwhere4, $iwhere5);
        $icolumn = array('coa', 'Status', 'QTY', 'Raw_ID', 'FAID', 'FAID_lama', 'Period', 'PriceVendor', 'SetDatePayment', 'Condition', 'Is_trash', 'Image', 'DateCondition', 'ItemName', 'ZoneName', 'BranchName', 'BranchCode', 'DivisionName', 'BisUnitName');
        $iorder = array('Raw_ID' => 'desc');

        $list = $this->datatables_custom->get_datatables('vw_asset_list', $icolumn, $iorder, $iwhere);
//        print_r($list);die();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $idatatables) {
            if ($idatatables->Status == 3) {
                $tujuan = $this->assetlist->getBranchFromCode(substr($idatatables->FAID, 11, 5));
            }
            $statuspembayaran = (empty($idatatables->SetDatePayment)) ? 'disabled' : '';
            $tujuan = $this->assetlist->getBranchFromCode(substr($idatatables->FAID, 11, 5));
            $irow = '';
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $idatatables->ZoneName;
            $row[] = ((int) $idatatables->BranchCode == 00000) ? $idatatables->BranchName . ' - ' . $idatatables->DivisionName : $idatatables->BranchName
                    . ($idatatables->Status == 3) ? ' => <strong>'
                            . (((int) $tujuan->BranchCode == 00000) ? $tujuan->DivisionName : $tujuan->BranchName) . '</strong>' : '';
            $row[] = ($idatatables->BisUnitName == '') ? '-' : $idatatables->BisUnitName;
            $row[] = $idatatables->FAID;
            $row[] = $idatatables->FAID_lama;
            $row[] = $idatatables->ItemName;
            $row[] = $idatatables->QTY;
            if (!empty($idatatables->Image)) {
                $irow_img = '<a href="' . base_url() . 'uploads/item_images/' . trim($idatatables->Image) . '" download="' . trim($idatatables->Image) . '.png">'
                        . '<img src="' . base_url() . 'uploads/item_images/' . trim($idatatables->Image) . '" style="width: 30px; height:30px"></a>.';
            }
            $row[] = $irow_img;
            if (!empty($idatatables->FAID)) {
                $irow_qr = '<a href="' . base_url() . 'uploads/qr_code/' . trim($idatatables->FAID) . '.png" download="' . trim($idatatables->FAID) . '.png">'
                        . '<img src="' . base_url() . 'uploads/qr_code/' . trim($idatatables->FAID) . '.png" style="width: 30px; height:30px"></a>.';
            }
            $row[] = $irow_qr;
            $date = date('d-m-Y H:i:s', strtotime($idatatables->DateCondition));
            if ($idatatables->Condition == 1) {
                $cond = '<b>Bagus</b> <br>' . $date;
            } elseif ($idatatables->Condition == 2) {
                $cond = '<b>Rusak</b> <br>' . $date;
            } elseif ($idatatables->Condition == 3) {
                $cond = '<b>Hilang</b> <br>' . $date;
            } elseif ($idatatables->Condition == 4) {
                $cond = '<b>Musnah</b> <br>' . $date;
            }
            $row[] = $cond;
            $btn = '';
            if ($idatatables->Is_trash == 0) {
                $iclass = 'btn-primary';
            } else {
                $iclass = 'btn-danger';
            }
            if ($idatatables->Is_trash == 1 || $idatatables->Status == 1) {
                $idisabled = 'disabled';
            } else {
                $idisabled = '';
            }
            if ($idatatables->Is_trash == 0) {
                $hd = 'Disposal';
            } else {
                $hd = 'Has Disposal';
            }
            if ($div == 8 && $branch == 1 && $usergroup <> 3) {
                $btn.='<a onclick="mutationasset(this)" data-toggle="modal" data-target="#myModal" id="' . $idatatables->Raw_ID . '" name="' . $idatatables->FAID . '" class="mutationasset"  ><button class="btn btn-primary btn-xs" type="button" ' . $idisabled . '>Mutation</button></a>'
                        . '<a><button onclick="disposal(this)" class="btn btn-xs disposal ' . $iclass . '" type="button" name="' . $idatatables->FAID . '" id="' . $idatatables->Raw_ID . '" ' . $idisabled . '>' . $hd . '</button></a>';
            } elseif ($branch <> 1) {
                $btn.='<a onclick="mutationasset(this)" data-toggle="modal" data-target="#myModal" id="' . $idatatables->Raw_ID . '" name="' . $idatatables->FAID . '" class="mutationasset"  ><button class="btn btn-primary btn-xs" type="button" ' . $idisabled . '>Mutation</button></a>';
            } else {
                $btn.='<a onclick="mutationasset(this)" data-toggle="modal" data-target="#myModal" id="' . $idatatables->Raw_ID . '" name="' . $idatatables->FAID . '" class="mutationasset"  ><button class="btn btn-primary btn-xs" type="button" ' . $idisabled . '>Mutation</button></a>'
                        . '<a><button onclick="disposal(this)" class="btn btn-xs disposal ' . $iclass . '" type="button" name="' . $idatatables->FAID . '" id="' . $idatatables->Raw_ID . '" ' . $idisabled . '>' . $hd . '</button></a>';
            }
            $row[] = '<a data-toggle="modal" data-target="#myModal" id="' . $idatatables->FAID . '" onclick="detilasset(this)"><button class="btn btn-primary btn-xs" type="button" >Depreciation</button></a>' . $btn;
            $row[] = $idatatables->Raw_ID . "-" . $idatatables->Status;

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

    public function detilasset($id) {
        $data = $this->assetlist->getDetil($id);
        $icount = count($data);
        $datas = array(
            'listdata' => $data,
            'icount' => $icount
        );
        $this->load->view('asset_management/listasset/detil_asset', $datas);
    }

    public function mutationasset($id, $faid) {
        $branch = $this->session->userdata('BranchID');
//        $branch = 8;
        $data = $this->assetlist->getzone();
        $type = $this->assetlist->gettype($id);
        $dataUnit = $this->assetlist->getunit($branch);
//            print_r($dataUnit);die();
        $datas = array(
            'zona' => $data,
            'id' => $id,
            'faid' => $faid,
            'type' => $type,
            'dataUnit' => $dataUnit
        );
        $this->load->view('asset_management/listasset/mutation', $datas);
    }

    public function disposal($id, $faid) {
        $return = $this->assetlist->disposal($id, $faid);
        echo json_encode($return);
    }

    public function mutasi($iid) {
        $faid = $this->assetlist->setMutasi();
        $data = $this->generateQR(1, $faid, $iid);
//        print_r($data);die();
//        $this->load->view('asset_management/listasset/generateqr', $data);
    }

    function generateQR($status, $faid, $id) {
        $dataitem = $this->Payment_mdl->gendata_qrmutasi($id);
        foreach ($dataitem as $row) {
            //$BranchCode=substr($faid, 12,5);
            //echo $BranchCode;
            $array = explode(".", $faid);
            $kode = substr($array[2], 0, 5);

            $db2 = $this->load->database('config1', true);
            $sqlBranchCode = $db2->query("SELECT BranchCode FROM Mst_Branch WHERE BranchCode='" . $kode . "'");
            $BranchCode = '';
            if (!empty($sqlBranchCode->result())) {
                $BranchCode = $sqlBranchCode->result()[0]->BranchCode;
            }
//                        echo "1. ".$BranchCode."<br>";
            if ($BranchCode == '') {
                $sqlDivisionCode = $db2->query("SELECT DivisionCode FROM Mst_Division WHERE DivisionCode='" . $kode . "'");
                $DivisionCode = '';
                if (!empty($sqlDivisionCode->result())) {
                    $DivisionCode = $sqlDivisionCode->result()[0]->DivisionCode;
                }
                //                            echo "2. ".$DivisionCode."<br>";
                if ($DivisionCode == '') {
                    $field = 'br.BranchName,div.DivisionName,unit.BisUnitName';
                    $codefix = "LEFT JOIN Mst_BisUnit unit on br.BranchID = unit.BisUnitBranchID
                                LEFT JOIN Mst_Division div on br.BranchID = div.BranchID
                                where unit.BisUnitCode = '$kode'";
                } else {
                    $field = 'br.BranchName,div.DivisionName,unit.BisUnitName';
                    $codefix = "LEFT JOIN Mst_Division div on br.BranchID = div.BranchID
                                LEFT JOIN Mst_BisUnit unit on br.BranchID = unit.BisUnitBranchID
                                where div.DivisionCode = '$kode'";
                }
            } else {
                $field = 'br.BranchName,div.DivisionName,unit.BisUnitName';
                $codefix = "LEFT JOIN Mst_Division div on div.DivisionCode = '$kode'"
                        . "LEFT JOIN Mst_BisUnit unit on unit.BisUnitCode = '$kode'"
                        . "where br.BranchCode = '$kode'";
            }
//                        echo $codefix."<br>";
//                        die();
            $qdata = $db2->query("SELECT $field FROM Mst_Branch br $codefix");
            $qdata = $qdata->result_array();
            foreach ($qdata as $key) {
                $BranchName = $key['BranchName'];
                $DivisionName = $key['DivisionName'];
                $BisUnitName = $key['BisUnitName'];
            }
            if ($DivisionName == '') {
                $location = "(" . $BisUnitName . ")";
            } elseif ($BisUnitName == '') {
                $location = "(" . $DivisionName . ")";
            } else {
                $location = $BranchName;
            }
            $data = array(
                'faid' => $faid,
                'ItemName' => $row->ItemName,
                'IClassName' => $row->IClassName,
                'BranchName' => $BranchName,
                'location' => $location,
            );
        }
        // $this->load->view('payment/generateqr',$data);
        if ($status == 1)
            $this->session->set_flashdata('msg', 'Success! Mutation Assets Success');
        else
            $this->session->set_flashdata('msg', 'Success! Mutation Item Inventory Success');
        return $data;
//        $this->load->view('payment/generateqr', $data);
    }

    public function getBranch($zone) {
        $item = $this->assetlist->getbranch($zone);
        $data = "<option value=''>--Select--</option> ";
        foreach ($item as $row) {
            $data .=' <option kode="' . $row->BranchCode . '"  value="' . $row->BranchID . '">' . $row->BranchName . '</option>';
        }
        echo $data;
    }

    public function getdivisi($unit) {
        $data = $this->assetlist->getdivisi($unit);
        $list = "<option value=''>--Select--</option>";
        foreach ($data as $row) {
            $list .= '<option value="' . $row->DivisionID . '">' . $row->DivisionName . '</option>';
        }

        echo $list;
    }

    public function getunit($branch) {
        $data = $this->assetlist->getunit($branch);
        $list = "<option value=''>--Select--</option>";
        foreach ($data as $row) {
            $list .= '<option value="' . $row->BisUnitID . '">' . $row->BisUnitName . '</option>';
        }

        echo $list;
    }

    public function formdisposal() {
        if (empty($this->input->get('iddisposal')))
            echo "Check list Item yang akan di disposal !";
        else {
            $this->load->library('word');
            //our docx will have 'lanscape' paper orientation
            $section = $this->word->createSection(array('orientation' => 'portrait'));

            $header = $section->createHeader();

            // Add image elements		
            $header->addImage(FCPATH . 'metronic/img/logo.png', array('width' => 177, 'height' => 40, 'align' => 'left'));

            // Define table style arrays
            $styleTable = array('borderSize' => 6, 'borderColor' => '006699', 'cellMargin' => 80);
            $styleFirstRow = array('borderBottomSize' => 18, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF');

            // Define cell style arrays
            $styleCell = array('valign' => 'center');
            // $styleCellBTLR = array('valign'=>'center', 'textDirection'=>PHPWord_Style_Cell::TEXT_DIR_BTLR);
            // Define font style for first row
            $fontStyle = array('bold' => true, 'align' => 'center');

            // Add table style
            $this->word->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);

            // Add table
            $table = $section->addTable('myOwnTableStyle');

            // Add row
            $table->addRow(900);

            // Add cells
            $table->addCell(2000, $styleCell)->addText('Location', $fontStyle);
            $table->addCell(2000, $styleCell)->addText('Item Name', $fontStyle);
            $table->addCell(2000, $styleCell)->addText('FAID', $fontStyle);
            $table->addCell(2000, $styleCell)->addText('Price', $fontStyle);
            $table->addCell(2000, $styleCell)->addText('Depreciation (' . Date('d/m/Y') . ')', $fontStyle);
            $table->addCell(2000, $styleCell)->addText('Purchase Date', $fontStyle);

            $item = $this->assetlist->getItemDisposal();
            $tgl = date('Y-m-d');
            foreach ($item as $key) {
                if ($key->Status == 3) {
                    $lokasi = $this->assetlist->getCodeBranchDivisi($key->FAID);
                    $lokasi = ((int) $lokasi->BranchCode == 00000) ? $lokasi->BranchName . " - " . $lokasi->DivisionName : $lokasi->BranchName;
                } else
                    $lokasi = ((int) $key->BranchCode == 00000) ? $key->BranchName . " - " . $key->DivisionName : $key->BranchName;
                $lama = $this->get_interval_in_month($key->SetDatePayment, $tgl);
                $nilaibuku = $key->PriceVendor - ($lama * $key->Depreciation);
                $table->addRow();
                $table->addCell(2000)->addText($lokasi);
                $table->addCell(2000)->addText($key->ItemName);
                $table->addCell(2000)->addText($key->FAID);
                $table->addCell(2000)->addText("Rp " . number_format($key->PriceVendor) . ".00");
                $table->addCell(2000)->addText("Rp " . (((int) $nilaibuku <= 0) ? "1" : number_format($nilaibuku)) . ".00");
                $table->addCell(2000)->addText(date('d-m-Y', strtotime($key->SetDatePayment)));
            }

            $footer = $section->createFooter();
            $footer->addText('PT Permodalan Nasional Madani (Persero)');
            $footer->addText('Kantor Pusat : Gedung Arthaloka Lt. 1,6 dan 10 Jl. Jend Sudirman Kav.2-Jakarta 10220 Telp.(021)2511 405 E-mail madani@pnm.co.id, www.pnm.co.id ');
            $filename = 'DISPOSAL.docx'; //save our document as this file name

            ob_end_clean();
            header("Content-type: application/vnd.ms-word");
//            header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document'); //mime type
            header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
            header('Cache-Control: max-age=0'); //no cache
            header("Pragma: no-cache");
            header("Expires: 0");

            $objWriter = PHPWord_IOFactory::createWriter($this->word, 'Word2007');
            $objWriter->save('php://output');
        }
    }

    public function downloadPDF() {
        if ($this->input->get('iddisposal') == "")
            echo "Check list Item untuk generate Dokumen QR CODE  !";
        else {
            $tabel = '';
            $pnm = base_url() . 'metronic/img/logo.png';
            $arrData = explode(",", $this->input->get('iddisposal'));
            foreach ($arrData as $value) {
                $id = explode("-", $value);
                $data = $this->assetlist->getItemQR($id[0], $id[1]);
                $qrcode = base_url() . 'uploads/qr_code/' . $data->FAID . '.png';

                $BranchName = $data->BranchName;
                $DivisionName = $data->DivisionName;
                $BisUnitName = $data->BisUnitName;
                $branchCode = (int) $data->BranchCode;

                if ($branchCode == '00000' && $BisUnitName == '') {
                    $lokasi = strtoupper($DivisionName);
                } elseif ($branchCode <> '00000' && $DivisionName == '' && $BisUnitName == '') {
                    $lokasi = strtoupper($BranchName);
                } elseif ($branchCode == '' && $BranchName == '' && $BisUnitName == '') {
                    $lokasi = strtoupper($DivisionName);
                } elseif ($branchCode == '' && $BranchName == '' && $DivisionName == '') {
                    $lokasi = strtoupper($BisUnitName);
                } elseif ($branchCode != '' && $BranchName != '' && $BisUnitName != '') {
                    $lokasi = strtoupper($BisUnitName);
                } else {
                    $lokasi = strtoupper($BranchName);
                }

                $tabel .= '<table style="height:100px;page-break-inside: avoid;">
                <tr>
                <td>
                <table border="1" cellpadding="1" cellspacing="1" width="360" height="120">
                <tr>
                <td style="text-align: center;"><img src="' . $pnm . '" style="width: 200px; height: 55px; "></td>
                <td rowspan="3" width="28%"><img src="' . $qrcode . '" style="width: 150px; height: 150px; padding: 5px !important"></td> 
                </tr>
                <tr>
                <td style="text-align: center; font-size: 14px">' . $lokasi . '</td>			    			    			
                </tr>
                <tr>
                <td style="text-align: center; font-size: 14px">' . $data->FAID . '</td>			    			    			
                </tr>
                </table>
                </td>
                <td>
                <table border="1" cellpadding="1" cellspacing="1" width="180" height="60" >                                                        
                <tr>
                <td style="text-align: center;"><img src="' . $pnm . '" style="width: 200px; height: 55px; "></td>
                <td rowspan="3" width="28%"><img src="' . $qrcode . '" style="width: 150px; height: 150px; padding: 5px !important"></td> 
                </tr>
                <tr>
                <td style="text-align: center; font-size: 7px">' . $lokasi . '</td>			    			    			
                </tr>
                <tr>
                <td style="text-align: center; font-size: 6px">' . $data->FAID . '</td>			    			    			
                </tr>
                </table>
                </td>
                </tr>
                </table>    ';
                $tabel .= '</div>';
                $tabel .= '<script>window.print()</script>';
            }
        }

        echo $tabel;
    }

    public function add_disposal() {

        $config['upload_path'] = "./uploads/";
        $config['allowed_types'] = '*';
        $config['max_size'] = '0';
        $config['file_name'] = 'DISPOSAL-' . date('YmdHis');

        $this->load->library('upload', $config);
        if ($this->upload->do_upload("namafile")) {
            $error = array('array' => $this->upload->display_errors());
            $data = $this->upload->data();
            $source = "./uploads/" . $data['file_name'];
            chmod($source, 0777);
            $paydata = $data['file_name'];
        } else {
            $istatus = false;
            $iremarks = $this->upload->display_errors();
        }

        print_r($iremarks);
        die();
    }

}

/* End of file sec_user.php */
    /* Location: ./application/controllers/sec_user.php */    