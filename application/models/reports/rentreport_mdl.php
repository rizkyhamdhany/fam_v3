<?php

Class Rentreport_mdl extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

        function getRentAll() {
        //Koneksi keSQL SERVER
        $this->db2 = $this->load->database('config1', true);

//        (!empty($this->input->post('vendor'))) ? $vendor = "AND vendor.VendorID='" . $this->input->post('vendor') . "'" : $vendor = " ";
//        ($this->input->post('status') != '10') ? $status = "AND termin.StatusPayment=" . $this->input->post('status') : $status = " ";
////        print_r($this->input->post('vendor'));die();
//        $cabang = "";
//        if (!empty($this->input->post('branch'))) {
//            if ((int) explode('-', $this->input->post('branch'))[0] == 00000) //pusat
//                $cabang = "AND req.BranchID=" . explode('-', $this->input->post('branch'))[1] . " AND req.DivisionID=" . explode('-', $this->input->post('branch'))[2];
////                $cabang = "AND req.BranchID=" . explode('-', $this->input->post('branch'))[1] . " AND req.DivisionID=10";
//            else
//                $cabang = "AND req.BranchID=" . explode('-', $this->input->post('branch'))[1];
//        }
        
//        parameter filter belum selesai.
        (empty($this->input->post('status'))) ? $status = "req.Status IN (3,4)" : $status = "req.Status IN (" . implode(",", $this->input->post('status')) . ")";
        $cabang = "";
        if (!empty($this->input->post('branch'))) {
            if ((int) explode('-', $this->input->post('branch'))[0] == 00000) //pusat
                $cabang = "AND req.BranchID=" . explode('-', $this->input->post('branch'))[1] . " AND req.DivisionID=" . explode('-', $this->input->post('branch'))[2];
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

        $query = "SELECT * FROM (SELECT 
                CASE WHEN br.BranchCode=00000 THEN div.DivisionCode ELSE br.BranchCode END AS kd_entitas,
                CASE WHEN br.BranchCode=00000 THEN div.DivisionAlias ELSE br.BranchAlias END AS Inisial_entitas,
                CASE WHEN br.BranchCode=00000 THEN div.DivisionName ELSE br.BranchName END AS cab_div,
                CONVERT(varchar, req.StartDate, 105) as tanggal,
                replace(('IAS/'+convert(varchar,req.RequestID)+'/'+convert(varchar,termin.TerminID)),' ','') as bukti,
                reqcat.ReqCategoryName,
                req.PriceVendor, 
                CASE WHEN req.Status=3 THEN 'Belum Lunas' ELSE 'Sudah Lunas' END AS st_pembayaran,
                req.StartDate,
                req.PriodSewa
                FROM Mst_Request req
                LEFT JOIN Mst_RequestCategory reqcat ON req.ReqCategoryID = reqcat.ReqCategoryID
                INNER JOIN Mst_Branch br ON req.BranchID = br.BranchID
                LEFT JOIN Mst_Division div ON req.DivisionID = div.DivisionID										
                LEFT JOIN Pay_Termin termin ON req.RequestID = termin.RequestID and termin.Step = 1 )as z";
//                WHERE termin.DatePayment_termin between'" . $tglawal . " 00:00:00.000' AND  '" . $tglakhir . " 23:59:59.997'
//		" . $cabang . " " . $vendor . " " . $status . ") AS z "
//                . "WHERE z.ias IS NOT NULL ".$src1.$src2.$src3.$src4.$src5.$src6.$src7.$src8.$src9.$src10.$src11."  ORDER BY z.RequestID";
        $querydata=$this->db2->query($query);
        return $querydata->result();
        $querydata->close();
    }
    
    function seldata($num, $offset) {
        //Koneksi keSQL SERVER
        $this->db2 = $this->load->database('config1', true);

        (empty($this->input->post('status'))) ? $status = "req.Status IN (3,4)" : $status = "req.Status IN (" . implode(",", $this->input->post('status')) . ")";
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

        $querydata = $this->db2->query("SELECT br.BranchCode, br.BranchAlias, div.DivisionCode, div.DivisionAlias, req.StartDate, req.Status,
                                req.EndDate, req.PriodSewa, req.PriceVendor, reqcat.ReqCategoryName, br.BranchName, div.DivisionName, req.RequestID, termin.TerminID
                                FROM Mst_Request req
                                LEFT JOIN Mst_RequestCategory reqcat ON req.ReqCategoryID = reqcat.ReqCategoryID
                                INNER JOIN Mst_Branch br ON req.BranchID = br.BranchID
                                LEFT JOIN Mst_Division div ON req.DivisionID = div.DivisionID										
                                LEFT JOIN Pay_Termin termin ON req.RequestID = termin.RequestID and termin.Step = 1
                                WHERE " . $status . " " . $cabang . " and req.ReqTypeID = 3 and req.StartDate between '" . $tglawal . " 00:00:00.000' and '" . $tglakhir . " 23:59:59.997'
                                ORDER BY req.RequestID /*OFFSET 0 ROWS FETCH NEXT 20 ROWS ONLY*/");

        return $querydata->result();
        $querydata->close();
    }

    function getExcelData() {
        $this->db2 = $this->load->database('config1', true);

        (empty($this->input->get('status'))) ? $status = "req.Status IN (3,4)" : $status = "req.Status IN (" . implode(",", $this->input->get('status')) . ")";
        $cabang = $this->input->get('branch');

        if (!empty($cabang)) {
            if ((int) explode('-', $this->input->get('branch'))[0] == 00000) //pusat
                $cabang = "AND req.BranchID=" . explode('-', $this->input->get('branch'))[1] . " AND req.DivisionID=" . explode('-', $this->input->get('branch'))[2];
            else
                $cabang = "AND req.BranchID=" . explode('-', $this->input->get('branch'))[1];
        }
        //echo $cabang;die();
        $tgl = explode("-", $this->input->get('start'));
        $tglawal = $tgl[0];
        $tglakhir = $tgl[1];
        $querydata = $this->db2->query("SELECT br.BranchCode, br.BranchAlias, div.DivisionCode, div.DivisionAlias, req.StartDate, req.Status,
										req.EndDate, req.PriodSewa, req.PriceVendor, reqcat.ReqCategoryName, br.BranchName, div.DivisionName, req.RequestID, termin.TerminID
										FROM Mst_Request req
										LEFT JOIN Mst_RequestCategory reqcat ON req.ReqCategoryID = reqcat.ReqCategoryID
										INNER JOIN Mst_Branch br ON req.BranchID = br.BranchID
										LEFT JOIN Mst_Division div ON req.DivisionID = div.DivisionID										
										LEFT JOIN Pay_Termin termin ON req.RequestID = termin.RequestID and termin.Step = 1
										WHERE " . $status . " " . $cabang . " and req.ReqTypeID = 3 and req.StartDate between '" . $tglawal . " 00:00:00.000' and '" . $tglakhir . " 23:59:59.997'
										ORDER BY req.RequestID");
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

    function getBranchDivisi() {
        $this->db2 = $this->load->database('config1', true);
        $div = $this->session->userdata('DivisionID');
        $branch = $this->session->userdata('BranchID');
        $usergroup = $this->session->userdata('groupid');
        if ($branch == '1') {
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
            }
        } else {
            $division = $this->db2->query("SELECT br.BranchID, br.BranchName, br.BranchCode,div.DivisionID, div.DivisionName  
										FROM Mst_Branch br
										FULL OUTER JOIN Mst_Division div ON div.BranchID = br.BranchID
                                                                                where br.BranchID=$branch
										");
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

    function getPembayaran($reqid) {
        $this->db2 = $this->load->database('config1', true);

        $data = $this->db2->query("SELECT SUM(CAST([WorkPayment] as DECIMAL(9,0))) as work FROM Pay_Termin WHERE 
			StatusPayment=1 AND RequestID=" . $reqid);
        return $data->row()->work;
    }

}

?>