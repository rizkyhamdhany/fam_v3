<?php

Class Termofpayment_mdl extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function seldatax($notreqid, $num, $offset, $getreq = null, $src_category = null, $src = null) {
        $sesid = $this->session->userdata('user_id');
        $this->db2 = $this->load->database('config1', true);

        if ($src != null) {

            $qdata = $this->db2->query("SELECT a.RequestID,a.BudgetCOA,a.CreateDate,a.SubTotalPrice,a.PriceVendor,a.Status,a.PathFile,a.PathFile,b.ReqCategoryName,c.ReqTypeID,c.ReqTypeName,d.EmployeeName,e.DivisionName,f.VendorName,g.BranchName,h.RktName
				   FROM Mst_Request a
				   LEFT JOIN Mst_RequestCategory b ON a.ReqCategoryID=b.ReqCategoryID 
				   LEFT JOIN Mst_RequestType c ON a.ReqTypeID=c.ReqTypeID
				   LEFT JOIN Mst_Employee d ON a.EmployeeID=d.EmployeeID
				   LEFT JOIN Mst_Division e ON a.DivisionID=e.DivisionID
				   LEFT JOIN Mst_Vendor f ON a.VendorID=f.VendorID
				   LEFT JOIN Mst_Branch g ON a.BranchID=g.BranchID
				   LEFT JOIN Mst_Rkt h ON a.RktID=h.RktID
				   WHERE a.Is_trash=0 and a.Status=3 or a.Status=2 or a.Status=4 and " . $src_category . " like '%$src%'");
        } else {
            //echo $getreq;die;
            if ($offset != null) {
                $of = $offset;
            } else {
                $of = 0;
            }
            if ($notreqid != "") {
                $qrt = "and a.RequestID=" . $notreqid . "";
            } else {
                $qrt = "and a.Status=3 or a.Status=2 or a.Status=4 ORDER BY a.RequestID DESC OFFSET $of ROWS FETCH NEXT $num ROWS ONLY ";
            }

            $qdata = $this->db2->query("SELECT a.RequestID,a.BudgetCOA,a.CreateDate,a.SubTotalPrice,a.PriceVendor,a.Status,a.PathFile,b.ReqCategoryName,c.ReqTypeID,c.ReqTypeName,d.EmployeeName,e.DivisionName,f.VendorName,g.BranchName,h.RktName
				   FROM Mst_Request a
				   LEFT JOIN Mst_RequestCategory b ON a.ReqCategoryID=b.ReqCategoryID 
				   LEFT JOIN Mst_RequestType c ON a.ReqTypeID=c.ReqTypeID
				   LEFT JOIN Mst_Employee d ON a.EmployeeID=d.EmployeeID
				   LEFT JOIN Mst_Division e ON a.DivisionID=e.DivisionID
				   LEFT JOIN Mst_Vendor f ON a.VendorID=f.VendorID
				   LEFT JOIN Mst_Branch g ON a.BranchID=g.BranchID
				   LEFT JOIN Mst_Rkt h ON a.RktID=h.RktID
				   WHERE a.Is_trash=0 " . $qrt . "");
        }
        return $qdata->result();
        $qdata->close();
    }

    /* EDITED BY WILLY 8 AGUSTUS 2017  */

    function seldata($notreqid, $num, $offset, $getreq = null, $src_category = null, $src = null) {

        $sesid = $this->session->userdata('user_id');
        $this->db2 = $this->load->database('config1', true);
        //willy : agar cabang hanya melihat cabangnya saja
//        $BranchID = $this->session->userdata('BranchID');
//
//        if ($BranchID == 1) {
//            $add = " ";
//        } else {
//            $add = " and a.BranchID='" . $BranchID . "' ";
//        }
        
        $div = $this->session->userdata('DivisionID');
        $branch = $this->session->userdata('BranchID');
        $usergroup = $this->session->userdata('groupid');
        if ($branch == 1) { //JIKA PUSAT : semua ppi bisa lihat data kecuali ppi dengan usergroup support
            if (($div == '8' && $usergroup <> '3') || $div == '20' || $usergroup == '1') {
                $add = '';
            } else {
                $add = 'AND a.DivisionID=' . "$div";
            }
        } else { //JIKA CABANG : cabang hanya bisa melihat cabang dan divisinya saja
            $add = ' AND a.BranchID=' . "$branch";
        }


        // $DivisionID=$this->session->userdata('DivisionID');
        // if ($DivisionID==8 || $DivisionID==20) {
        // 	$add="";
        // }else{
        // 	$add=" and b.Place='".$plac."' and c.BranchID='".$BranchID."' ";
        // }
//end	
        if ($src != null) {

            $qdata = $this->db2->query("SELECT ISNULL(e.DivisionCode,g.BranchCode) as DivisionCode,a.Jenis_periode_sewa,a.Jangka_waktu,a.Termin_sewa,a.PriodSewa,COALESCE(i.num,0) as num,a.RequestID,a.BudgetCOA,a.CreateDate,a.SubTotalPrice,a.PriceVendor,a.Status,a.PathFile,a.PathFile,b.ReqCategoryName,c.ReqTypeID,c.ReqTypeName,d.EmployeeName,e.DivisionName,f.VendorName,g.BranchName,h.RktName
				   FROM Mst_Request a
				   LEFT JOIN Mst_RequestCategory b ON a.ReqCategoryID=b.ReqCategoryID 
				   LEFT JOIN Mst_RequestType c ON a.ReqTypeID=c.ReqTypeID
				   LEFT JOIN Mst_Employee d ON a.EmployeeID=d.EmployeeID
				   LEFT JOIN Mst_Division e ON a.DivisionID=e.DivisionID
				   LEFT JOIN Mst_Vendor f ON a.VendorID=f.VendorID
				   LEFT JOIN Mst_Branch g ON a.BranchID=g.BranchID
				   LEFT JOIN Mst_Rkt h ON a.RktID=h.RktID
				    LEFT JOIN (SELECT RequestID,count(RequestID) as num from Pay_Termin where StatusPayment=1 group by RequestID) i ON i.RequestID=a.RequestID 
				    WHERE a.Is_trash=0 and a.Status=3 or a.Status=2 or a.Status=4 and " . $src_category . " like '%$src%'");
        } else {
            //echo $getreq;die;
            if ($offset != null) {
                $of = $offset;
            } else {
                $of = 0;
            }
            if ($notreqid != "") {
                $qrt = "and a.RequestID=" . $notreqid . "";
            } else {
                $qrt = "and a.Status IN (3,2,4) ORDER BY a.RequestID DESC OFFSET $of ROWS FETCH NEXT $num ROWS ONLY ";
            }
//            die("SELECT ISNULL(e.DivisionCode,g.BranchCode) as DivisionCode,a.Jenis_periode_sewa,a.Jangka_waktu,a.Termin_sewa,a.PriodSewa,COALESCE(i.num,0) as num,a.RequestID,a.BudgetCOA,a.CreateDate,a.SubTotalPrice,a.PriceVendor,a.Status,a.PathFile,b.ReqCategoryName,c.ReqTypeID,c.ReqTypeName,d.EmployeeName,e.DivisionName,f.VendorName,g.BranchName,h.RktName
//				   FROM Mst_Request a
//				   LEFT JOIN Mst_RequestCategory b ON a.ReqCategoryID=b.ReqCategoryID 
//				   LEFT JOIN Mst_RequestType c ON a.ReqTypeID=c.ReqTypeID
//				   LEFT JOIN Mst_Employee d ON a.EmployeeID=d.EmployeeID
//				   LEFT JOIN Mst_Division e ON a.DivisionID=e.DivisionID
//				   LEFT JOIN Mst_Vendor f ON a.VendorID=f.VendorID
//				   LEFT JOIN Mst_Branch g ON a.BranchID=g.BranchID
//				   LEFT JOIN Mst_Rkt h ON a.RktID=h.RktID
//				   LEFT JOIN (SELECT RequestID,count(RequestID) as num from Pay_Termin where StatusPayment=1  group by RequestID) i ON i.RequestID=a.RequestID 
//				    WHERE a.Is_trash=0 $add " . $qrt . "");
            $qdata = $this->db2->query("SELECT ISNULL(e.DivisionCode,g.BranchCode) as DivisionCode,f.VendorID,a.Jenis_periode_sewa,a.Jangka_waktu,a.Termin_sewa,a.PriodSewa,COALESCE(i.num,0) as num,a.RequestID,a.BudgetCOA,a.CreateDate,a.SubTotalPrice,a.PriceVendor,a.Status,a.PathFile,b.ReqCategoryName,c.ReqTypeID,c.ReqTypeName,d.EmployeeName,e.DivisionName,f.VendorName,g.BranchName,h.RktName
				   FROM Mst_Request a
				   LEFT JOIN Mst_RequestCategory b ON a.ReqCategoryID=b.ReqCategoryID 
				   LEFT JOIN Mst_RequestType c ON a.ReqTypeID=c.ReqTypeID
				   LEFT JOIN Mst_Employee d ON a.EmployeeID=d.EmployeeID
				   LEFT JOIN Mst_Division e ON a.DivisionID=e.DivisionID
				   LEFT JOIN Mst_Vendor f ON a.VendorID=f.VendorID
				   LEFT JOIN Mst_Branch g ON a.BranchID=g.BranchID
				   LEFT JOIN Mst_Rkt h ON a.RktID=h.RktID
				   LEFT JOIN (SELECT RequestID,count(RequestID) as num from Pay_Termin where StatusPayment=1  group by RequestID) i ON i.RequestID=a.RequestID 
				    WHERE a.Is_trash=0 $add " . $qrt . "");
        }
        //  echo "<pre>";
        // print_r($this->db2->last_query());
        // echo "</pre>";
        return $qdata->result();

        $qdata->close();
    }

    /* END EDITED BY WILLY */

    function seltermin($id) {
        $db2 = $this->load->database('config1', true);
//       die("SELECT * FROM Pay_Termin
//						   WHERE RequestID=".$id."");
        $qdata = $db2->query("SELECT * FROM Pay_Termin
						   WHERE RequestID=".$id."");
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

// EDITED  BY WILLY 11 AGUSTUS 2017
    function seldetil($id) {
        $db2 = $this->load->database('config1', true);
        $qdata = $db2->query("SELECT a.Jenis_periode_sewa,a.Jangka_waktu,a.Termin_sewa,a.RequestID,a.PriodSewa,a.SubTotalPrice,a.CreateDate,a.PriceVendor,a.VendorID,a.StartDate,a.EndDate,b.ReqCategoryName,c.ReqTypeID,c.ReqTypeName,d.EmployeeName,e.DivisionName,f.VendorName,f.VendorAddress,g.RktName,h.BranchName
						   FROM Mst_Request a
						   LEFT JOIN Mst_RequestCategory b ON a.ReqCategoryID=b.ReqCategoryID 
						   LEFT JOIN Mst_RequestType c ON a.ReqTypeID=c.ReqTypeID
						   LEFT JOIN Mst_Employee d ON a.EmployeeID=d.EmployeeID
						   LEFT JOIN Mst_Division e ON a.DivisionID=e.DivisionID
						   LEFT JOIN Mst_Vendor f ON f.VendorID=a.VendorID
						   LEFT JOIN Mst_Rkt g ON a.RktID=g.RktID
						   LEFT JOIN Mst_Branch h ON a.BranchID=h.BranchID
						   WHERE a.Is_trash=0 and a.RequestID=" . $id . "");
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

// END	
    function payment_termin($id) {
        $db2 = $this->load->database('config1', true);
        $qdata = $db2->query("SELECT * FROM Pay_Termin WHERE RequestID=" . $id . "");
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    function req_itemdetail($id) {
        $db2 = $this->load->database('config1', true);
        $qdata = $db2->query("SELECT a.ItemID,a.QTY,a.Price,b.ItemName,b.Image FROM Trx_DetItemReq a
						   INNER JOIN Mst_ItemList b ON a.ItemID=b.ItemID
						   WHERE a.Is_trash=0 and a.RequestID=" . $id . "");
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    function chek_termin($ReqID) {
        $db2 = $this->load->database('config1', true);
        $qdata = $db2->query("SELECT * FROM Pay_Termin WHERE RequestID=" . $ReqID . "");
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    function find_termin($terminid) {
        $db2 = $this->load->database('config1', true);
        $qdata = $db2->query("SELECT TerminID FROM Pay_Termin WHERE TerminID=" . $terminid . "");
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    function settermin($RequestID) {

        //INSERT DATA TERMIN
        if ((int) $this->input->post('ReqTypeID') != 3) {
            for ($i = 1; $i < $this->input->post('tot') + 1; $i++) {
                $datatermin = array(
                    'RequestID' => $RequestID,
                    'VendorID' => $this->input->post('VendorID'),
                    'Step' => $i,
                    'WorkProgress' => $this->input->post('progress' . $i),
                    'WorkPayment' => $this->input->post('payment' . $i),
                    'DatePayment' => $this->input->post('DatePayment' . $i),
                    'NotifStatus' => 1
                );

                //print_r($datatermin);die;
                $this->db2 = $this->load->database('config1', true);
                $this->db2->insert('Pay_Termin', $datatermin);
                $this->db2->close();
            }
        } else {
            for ($i = 1; $i < $this->input->post('totitem') + 1; $i++) {
                $datatermin = array(
                    'RequestID' => $RequestID,
                    'VendorID' => $this->input->post('VendorID'),
                    'Step' => $i,
                    'WorkProgress' => $this->input->post('progress' . $i),
                    'WorkPayment' => $this->input->post('payment' . $i),
                    'DatePayment' => $this->input->post('DatePayment' . $i),
                    'NotifStatus' => 1
                );

                //print_r($datatermin);die;
                $this->db2 = $this->load->database('config1', true);
                $this->db2->insert('Pay_Termin', $datatermin);
                $this->db2->close();
            }
        }
        //UPDTE STATUS REQUEST------------------------------------//
        $stdata = array(
            'Status' => 3,
        );
        $this->db2 = $this->load->database('config1', true);
        $this->db2->where('RequestID', $RequestID);
        $this->db2->update('Mst_Request', $stdata);
        $this->db2->close();
    }

    function jumlah() {
        $this->db2 = $this->load->database('config1', true);
        $qdata = $this->db2->query('SELECT COUNT(RequestID) AS jml FROM Mst_Request where Is_trash=0 and Status IN(2,3,4)');
        return $qdata->result();
    }

    function maxid() {
        $this->db2 = $this->load->database('config1', true);
        $qdata = $this->db2->query('SELECT MAX(RequestID) AS idmax FROM Mst_Request where Is_trash=0');
        return $qdata->result();
    }

    function deletedata($id) {

        $this->db2 = $this->load->database('config1', true);
        $this->db2->where('TerminID', $id);
        $this->db2->delete('Pay_Termin');
        $this->db2->close();
    }
    
    function getVendorPO($idvendor) {
        $this->db2 = $this->load->database('config1', true);
        $qdata = $this->db2->query("SELECT * FROM Mst_Vendor where Is_trash=0 AND VendorID='" . $idvendor . "'");
        return $qdata->row();
    }
    
    function getCodeBranch($idbranch) {
        $this->db2 = $this->load->database('config1', true);
        $division = $this->db2->query("SELECT BranchCode FROM Mst_Branch WHERE BranchID=" . $idbranch);

        return $division->row()->BranchCode;
    }
    
    function getDetailreq($reqid) {
        $this->db2 = $this->load->database('config1', true);
        $division = $this->db2->query('SELECT req.CreateDate, req.DatePO, req.BranchID, req.DivisionID, br.BranchCode, div.DivisionCode 
                                        FROM Mst_Request req
                                        INNER JOIN Mst_Branch br ON req.BranchID = br.BranchID									    
                                        LEFT JOIN Mst_Division div ON req.DivisionID = div.DivisionID
                                        WHERE req.RequestID=' . $reqid);

        return $division->row();
    }
    
    function getSeqNumber($cabang, $divisi, $create) {
        $this->db2 = $this->load->database('config1', true);
        $BranchCode = $this->getCodeBranch($cabang);

        if ((int) $BranchCode == 00000)
            $branch = 'and BranchID=' . $cabang . ' and DivisionID=' . $divisi;
        else
            $branch = 'and BranchID=' . $cabang;

        $division = $this->db2->query("SELECT COUNT(Raw_ID) as counter FROM Mst_Request WHERE  CreateDate like '%" . date('Y') . "%' AND Status IN (2,3,4) " . $branch . " AND DatePO >= '" . date('Y') . "-01-01 00:00:00' and DatePO < '" . $create . "'");
        return (sprintf("%04s", ($division->row()->counter + 1)));
    }
        
    function getItem($id){
            $this->db2 = $this->load->database('config1', true);
//die("SELECT trx.RequestID, trx.ItemID, item.ItemName, trx.QTY,  trx.Price as HPS, trx.PriceVendor
//                                                                    FROM Trx_DetItemReq trx
//                                                                    INNER JOIN Mst_ItemList item ON trx.ItemID = item.ItemID
//                                                                    WHERE trx.Is_trash=0 AND trx.Status IN (0,1) AND trx.RequestID='.$id");
            $qdata = $this->db2->query('SELECT trx.RequestID, trx.ItemID, item.ItemName, trx.QTY,  trx.Price as HPS, trx.PriceVendor
                                                                    FROM Trx_DetItemReq trx
                                                                    INNER JOIN Mst_ItemList item ON trx.ItemID = item.ItemID
                                                                    WHERE trx.Is_trash=0 AND trx.Status IN (0,1) AND trx.RequestID='.$id);
            return $qdata->result();	
    }
    
    function selDivisi($id_divisi) {
        $db2 = $this->load->database('config1', true);
        $qdata = $db2->query("SELECT * FROM Mst_Division WHERE DivisionID=".$id_divisi."");
        
        return $qdata->result();	
    }
    
    function selCabang($id_branch) {
        $db2 = $this->load->database('config1', true);
        $qdata = $db2->query("SELECT BranchName as DivisionName FROM Mst_Branch WHERE BranchID=".$id_branch."");
        
        return $qdata->result();	
    }
   

}

?>