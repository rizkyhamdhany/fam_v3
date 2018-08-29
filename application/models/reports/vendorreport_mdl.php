<?php

Class Vendorreport_mdl extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getVendorAll() {
        //Koneksi keSQL SERVER
        $this->db2 = $this->load->database('config1', true);

        (!empty($this->input->post('vendor'))) ? $vendor = "AND vendor.VendorID='" . $this->input->post('vendor') . "'" : $vendor = " ";
        ($this->input->post('status') != '10') ? $status = "AND termin.StatusPayment=" . $this->input->post('status') : $status = " ";
//        print_r($this->input->post('vendor'));die();
        $cabang = "";
        if (!empty($this->input->post('branch'))) {
            if ((int) explode('-', $this->input->post('branch'))[0] == 00000) //pusat
                $cabang = "AND req.BranchID=" . explode('-', $this->input->post('branch'))[1] . " AND req.DivisionID=" . explode('-', $this->input->post('branch'))[2];
//                $cabang = "AND req.BranchID=" . explode('-', $this->input->post('branch'))[1] . " AND req.DivisionID=10";
            else
                $cabang = "AND req.BranchID=" . explode('-', $this->input->post('branch'))[1];
        }
        $tglawal = date('Y-m-d', strtotime($this->input->post('from')));
        $tglakhir = date('Y-m-d', strtotime($this->input->post('to')));
        
        $src1= ($this->input->post('s1')=="")?"":"and z.ias like '%".$this->input->post('s1')."%'";
        $src2= ($this->input->post('s2')=="")?"":"and z.deskripsi like '%".$this->input->post('s2')."%'";
        $src3= ($this->input->post('s3')=="")?"":"and z.VendorName like '%".$this->input->post('s3')."%'";
        $src4= ($this->input->post('s4')=="")?"":"and z.Kwi like '%".$this->input->post('s4')."%'";
        $src5= ($this->input->post('s5')=="")?"":"and z.Fpur like '%".$this->input->post('s5')."%'";
        $src6= ($this->input->post('s6')=="")?"":"and z.Nomor like '%".$this->input->post('s6')."%'";
        $src7= ($this->input->post('s7')=="")?"":"and z.WorkPayment like '%".$this->input->post('s7')."%'";
        $src8= ($this->input->post('s8')=="")?"":"and z.tgl_upload_doc like '%".$this->input->post('s8')."%'";
        $src9= ($this->input->post('s9')=="")?"":"and z.tgl_dibayar like '%".$this->input->post('s9')."%'";
        $src10= ($this->input->post('s10')=="")?"":"and z.status_doc like '%".$this->input->post('s10')."%'";
        $src11= ($this->input->post('s11')=="")?"":"and z.status_pembayaran like '%".$this->input->post('s11')."%'";

        $query = "SELECT * FROM (SELECT vendor.VendorName,iasKwi.Nomor as Kwi,iasFpur.Nomor as Fpur,ias.Nomor,termin.WorkPayment,termin.RequestID,
            replace(('IAS/'+convert(varchar,termin.RequestID)+'/'+convert(varchar,termin.TerminID)),' ','') as ias,
            isnull(reqcat.ReqCategoryName,'')+' - '+rkt.RktName as deskripsi,
            case when termin.DatePayment_termin is null then '-' else CONVERT(varchar, termin.DatePayment_termin, 105) end as tgl_upload_doc,
            case when termin.Date_Payment_IAS is null then '-' else CONVERT(varchar, termin.Date_Payment_IAS, 105) end as tgl_dibayar,
            case when termin.StatusPayment =1 then 'Sudah Upload Ias' else 'Belum Upload Ias' end as status_doc,
            case when termin.Date_Payment_IAS is null then 'Belum Dibayarkan' else 'Sudah Dibayarkan' end as status_pembayaran 
                FROM Pay_Termin termin 
                INNER JOIN Mst_Vendor vendor ON termin.VendorID = vendor.VendorID 
                INNER JOIN Mst_Request req ON termin.RequestID = req.RequestID 
                LEFT JOIN Mst_RequestCategory reqcat ON req.ReqCategoryID = reqcat.ReqCategoryID 
                LEFT JOIN Mst_Rkt rkt ON req.RktID = rkt.RktID 
                LEFT JOIN Pay_IAS iasKwi ON termin.TerminID = iasKwi.TerminID AND iasKwi.ListDocIas like 'Kwitansi(Receipt)' 
                LEFT JOIN Pay_IAS ias ON termin.TerminID = ias.TerminID AND ias.ListDocIas like '%Surat Penagihan (Khusus Vendor Pkp)%' 
                LEFT JOIN Pay_IAS iasFpur ON termin.TerminID = iasFpur.TerminID AND iasFpur.ListDocIas like '%No. Document FPUR & No. Document FPUM%' 
                Left join Mst_request status on termin.RequestID=status.RequestID 
                WHERE termin.DatePayment_termin between'" . $tglawal . " 00:00:00.000' AND  '" . $tglakhir . " 23:59:59.997'
		" . $cabang . " " . $vendor . " " . $status . ") AS z "
                . "WHERE z.ias IS NOT NULL ".$src1.$src2.$src3.$src4.$src5.$src6.$src7.$src8.$src9.$src10.$src11."  ORDER BY z.RequestID";
        $querydata=$this->db2->query($query);
        return $querydata->result();
        $querydata->close();
    }

    function seldata($num, $offset) {
        //Koneksi keSQL SERVER
        $this->db2 = $this->load->database('config1', true);

        (!empty($this->input->post('vendor'))) ? $vendor = "AND vendor.VendorID='" . $this->input->post('vendor') . "'" : $vendor = " ";
        ($this->input->post('status') != '10') ? $status = "AND termin.StatusPayment=" . $this->input->post('status') : $status = " ";
        $cabang = "";
        if (!empty($this->input->post('branch'))) {
            if ((int) explode('-', $this->input->post('branch'))[0] == 00000) //pusat
                $cabang = "AND req.BranchID=" . explode('-', $this->input->post('branch'))[1] . " AND req.DivisionID=" . explode('-', $this->input->post('branch'))[2];
            else
                $cabang = "AND req.BranchID=" . explode('-', $this->input->post('branch'))[1];
        }

        $tgl = explode("-", $this->input->post('start'));
        $tglawal = $tgl[0];
        $tglakhir = $tgl[1];

//		$querydata = $this->db2->query("SELECT termin.RequestID, termin.TerminID, vendor.VendorName, termin.WorkPayment, ias.Date,
//										termin.StatusPayment, termin.DatePayment_termin, ias.Nomor, reqcat.ReqCategoryName, rkt.RktName,status.status  
//										FROM Pay_Termin termin
//										INNER JOIN Mst_Vendor vendor ON termin.VendorID = vendor.VendorID
//										INNER JOIN Mst_Request req ON termin.RequestID = req.RequestID
//										LEFT JOIN Mst_RequestCategory reqcat ON req.ReqCategoryID = reqcat.ReqCategoryID
//										LEFT JOIN Mst_Rkt rkt ON req.RktID = rkt.RktID
//										LEFT JOIN Pay_IAS ias ON termin.TerminID = ias.TerminID AND ias.ListDocIas like '%Surat Penagihan (Khusus Vendor Pkp)%'
//                                                                                Left join Mst_request status on termin.RequestID=status.RequestID
//										WHERE termin.DatePayment_termin between '".$tglawal." 00:00:00.000' AND  '".$tglakhir." 23:59:59.997'
//										".$cabang." ".$vendor." ".$status."  ORDER BY termin.RequestID /* OFFSET 0 ROWS FETCH NEXT 20 ROWS ONLY */");

        $querydata = $this->db2->query("SELECT termin.RequestID, termin.TerminID, vendor.VendorName, termin.WorkPayment, iasKwi.Date,iasKwi.Nomor as Kwi, termin.StatusPayment, 
termin.DatePayment_termin,termin.Date_Payment_IAS, ias.Nomor, iasFpur.Nomor as Fpur,reqcat.ReqCategoryName, rkt.RktName,status.status 
FROM Pay_Termin termin 
INNER JOIN Mst_Vendor vendor ON termin.VendorID = vendor.VendorID 
INNER JOIN Mst_Request req ON termin.RequestID = req.RequestID 
LEFT JOIN Mst_RequestCategory reqcat ON req.ReqCategoryID = reqcat.ReqCategoryID 
LEFT JOIN Mst_Rkt rkt ON req.RktID = rkt.RktID 
LEFT JOIN Pay_IAS iasKwi ON termin.TerminID = iasKwi.TerminID AND iasKwi.ListDocIas like 'Kwitansi(Receipt)' 
LEFT JOIN Pay_IAS ias ON termin.TerminID = ias.TerminID AND ias.ListDocIas like '%Surat Penagihan (Khusus Vendor Pkp)%' 
LEFT JOIN Pay_IAS iasFpur ON termin.TerminID = iasFpur.TerminID AND iasFpur.ListDocIas like '%No. Document FPUR & No. Document FPUM%' 
                                                                                Left join Mst_request status on termin.RequestID=status.RequestID 
										WHERE termin.DatePayment_termin between '" . $tglawal . " 00:00:00.000' AND  '" . $tglakhir . " 23:59:59.997'
										" . $cabang . " " . $vendor . " " . $status . "  ORDER BY termin.RequestID /* OFFSET 0 ROWS FETCH NEXT 20 ROWS ONLY */");

//                $querydata = "SELECT termin.RequestID, termin.TerminID, vendor.VendorName, termin.WorkPayment, ias.Date,
//										termin.StatusPayment, termin.DatePayment_termin, ias.Nomor, reqcat.ReqCategoryName, rkt.RktName,status.status  
//										FROM Pay_Termin termin
//										INNER JOIN Mst_Vendor vendor ON termin.VendorID = vendor.VendorID
//										INNER JOIN Mst_Request req ON termin.RequestID = req.RequestID
//										LEFT JOIN Mst_RequestCategory reqcat ON req.ReqCategoryID = reqcat.ReqCategoryID
//										LEFT JOIN Mst_Rkt rkt ON req.RktID = rkt.RktID
//										LEFT JOIN Pay_IAS ias ON termin.TerminID = ias.TerminID AND ias.ListDocIas like '%Surat Penagihan (Khusus Vendor Pkp)%'
//                                                                                Left join Mst_request status on termin.RequestID=status.RequestID
//										WHERE termin.DatePayment_termin between '".$tglawal." 00:00:00.000' AND  '".$tglakhir." 23:59:59.997'
//										".$cabang." ".$vendor." ".$status."  ORDER BY termin.RequestID /* OFFSET 0 ROWS FETCH NEXT 20 ROWS ONLY */";
//                die($querydata);
        return $querydata->result();
        $querydata->close();
    }

    function getExcelData() {
        $this->db2 = $this->load->database('config1', true);

        (!empty($this->input->get('vendor'))) ? $vendor = "AND vendor.VendorID='" . $this->input->get('vendor') . "'" : $vendor = " ";
        ($this->input->get('status') != '10') ? $status = "AND termin.StatusPayment=" . $this->input->get('status') : $status = " ";
        $cabang = $this->input->get('branch');
        if (!empty($cabang)) {
            if ((int) explode('-', $this->input->get('branch'))[0] == 00000) //pusat
                $cabang = "AND req.BranchID=" . explode('-', $this->input->get('branch'))[1] . " AND req.DivisionID=" . explode('-', $this->input->get('branch'))[2];
//                $cabang = "AND req.BranchID=" . explode('-', $this->input->get('branch'))[1] . " AND req.DivisionID=10";
            else
                $cabang = "AND req.BranchID=" . explode('-', $this->input->get('branch'))[1];
        }

        $tglawal = date('Y-m-d', strtotime($this->input->get('from')));
        $tglakhir = date('Y-m-d', strtotime($this->input->get('to')));
        
        $querydata = $this->db2->query("SELECT vendor.VendorName,iasKwi.Nomor as Kwi,iasFpur.Nomor as Fpur,ias.Nomor,termin.WorkPayment,termin.RequestID,
            replace(('IAS/'+convert(varchar,termin.RequestID)+'/'+convert(varchar,termin.TerminID)),' ','') as ias,
            isnull(reqcat.ReqCategoryName,'')+' - '+rkt.RktName as deskripsi,
            case when termin.DatePayment_termin is null then '-' else CONVERT(varchar, termin.DatePayment_termin, 105) end as tgl_upload_doc,
            case when termin.Date_Payment_IAS is null then '-' else CONVERT(varchar, termin.Date_Payment_IAS, 105) end as tgl_dibayar,
            case when termin.StatusPayment =1 then 'Sudah Upload Ias' else 'Belum Upload Ias' end as status_doc,
            case when termin.Date_Payment_IAS is null then 'Belum Dibayarkan' else 'Sudah Dibayarkan' end as status_pembayaran 
                FROM Pay_Termin termin 
                INNER JOIN Mst_Vendor vendor ON termin.VendorID = vendor.VendorID 
                INNER JOIN Mst_Request req ON termin.RequestID = req.RequestID 
                LEFT JOIN Mst_RequestCategory reqcat ON req.ReqCategoryID = reqcat.ReqCategoryID 
                LEFT JOIN Mst_Rkt rkt ON req.RktID = rkt.RktID 
                LEFT JOIN Pay_IAS iasKwi ON termin.TerminID = iasKwi.TerminID AND iasKwi.ListDocIas like 'Kwitansi(Receipt)' 
                LEFT JOIN Pay_IAS ias ON termin.TerminID = ias.TerminID AND ias.ListDocIas like '%Surat Penagihan (Khusus Vendor Pkp)%' 
                LEFT JOIN Pay_IAS iasFpur ON termin.TerminID = iasFpur.TerminID AND iasFpur.ListDocIas like '%No. Document FPUR & No. Document FPUM%' 
                Left join Mst_request status on termin.RequestID=status.RequestID 
                WHERE termin.DatePayment_termin between'" . $tglawal . " 00:00:00.000' AND  '" . $tglakhir . " 23:59:59.997'
		" . $cabang . " " . $vendor . " " . $status . "  ORDER BY termin.RequestID");
        return $querydata->result();
        $querydata->close();
    }

    function getCodeBranch($idbranch) {
        $this->db2 = $this->load->database('config1', true);
        $division = $this->db2->query("SELECT BranchCode FROM Mst_Branch WHERE BranchID=" . $idbranch);

        return $division->row()->BranchCode;
    }

    function getCodeDivisi($iddivisi) {
        $this->db2 = $this->load->database('config1', true);
        $division = $this->db2->query("SELECT DivisionCode FROM Mst_Division WHERE DivisionID=" . $iddivisi);

        return $division->row()->DivisionCode;
    }

    function getVendor() {
        $this->db2 = $this->load->database('config1', true);
        $division = $this->db2->query("SELECT VendorID,VendorName FROM Mst_Vendor");

        return $division->result();
    }

    function getBranchDivisi() {
        $this->db2 = $this->load->database('config1', true);
        $div = $this->session->userdata('DivisionID');
        $branch = $this->session->userdata('BranchID');
        $usergroup = $this->session->userdata('groupid');
        if ($branch == 1) { //JIKA PUSAT : semua ppi bisa lihat data kecuali ppi dengan usergroup support
            if (($div == '8' && $usergroup <> '3') || $usergroup == '1' || $div == '20') {
                $division = $this->db2->query("SELECT br.BranchID, br.BranchName, br.BranchCode,div.DivisionID, div.DivisionName 
										FROM Mst_Branch br
										FULL OUTER JOIN Mst_Division div ON div.BranchID = br.BranchID
										");
            } else {
                $division = $this->db2->query("SELECT br.BranchID, br.BranchName, br.BranchCode,div.DivisionID, div.DivisionName 
										FROM Mst_Branch br
										FULL OUTER JOIN Mst_Division div ON div.BranchID = br.BranchID
                                                                                where div.DivisionID=$div
										");
                //$data = 'AND req.DivisionID=' . "$div" . ' AND req.BranchID=' . "$branch";
            }
        } else { //JIKA CABANG : cabang hanya bisa melihat cabang dan divisinya saja
            $division = $this->db2->query("SELECT br.BranchID, br.BranchName, br.BranchCode,div.DivisionID, div.DivisionName 
										FROM Mst_Branch br
										FULL OUTER JOIN Mst_Division div ON div.BranchID = br.BranchID
                                                                                where br.BranchID=$branch
										");
            //$data = 'AND req.DivisionID=' . "$div" . ' AND req.BranchID=' . "$branch";
        }
        return $division->result();
    }

    function getBranchFromCode($id) {
        $this->db2 = $this->load->database('config1', true);

        $data = $this->db2->query("SELECT br.BranchName , div.DivisionName, div.DivisionCode, div.DivisionAlias, br.BranchCode, br.BranchAlias
									FROM Mst_Branch br
									LEFT JOIN Mst_Division div ON div.BranchID = br.BranchID									
									where br.Is_trash=0 AND (br.BranchCode=" . $id . " OR div.DivisionCode=" . $id . ")");
        return $data->row();
    }

}

?>