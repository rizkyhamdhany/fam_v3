<?php

Class Payment_mdl extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function selRequest($id, $terminid) {
        $db2 = $this->load->database('config1', true);
        $qdata = $db2->query("SELECT a.RequestID,a.CreateDate,a.PriceVendor,a.VendorID,a.StartDate,a.EndDate,b.ReqCategoryName,c.ReqTypeID,c.ReqTypeName,d.EmployeeName,e.DivisionCode,e.DivisionName,f.VendorName,f.VendorAddress,f.NoTlp,f.NoRekening,g.RktName,h.BranchName,i.TerminID,i.WorkProgress,i.WorkPayment,i.File_PaymentReceipt
                            FROM Mst_Request a
                            LEFT JOIN Mst_RequestCategory b ON a.ReqCategoryID=b.ReqCategoryID 
                            LEFT JOIN Mst_RequestType c ON a.ReqTypeID=c.ReqTypeID
                            LEFT JOIN Mst_Employee d ON a.EmployeeID=d.EmployeeID
                            LEFT JOIN Mst_Division e ON a.DivisionID=e.DivisionID
                            LEFT JOIN Mst_Vendor f ON f.VendorID=a.VendorID
                            LEFT JOIN Mst_Rkt g ON a.RktID=g.RktID
                            LEFT JOIN Mst_Branch h ON a.BranchID=h.BranchID
                            LEFT JOIN Pay_Termin i ON a.RequestID=i.RequestID
                            WHERE a.Is_trash=0 and a.RequestID=" . $id . " and i.NotifStatus=1 and i.TerminID=" . $terminid . "");
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    function payment_termin($terminid) {
        $db2 = $this->load->database('config1', true);
      //die("SELECT * FROM Pay_Termin WHERE TerminID=" . $terminid . "");
       $qdata = $db2->query("SELECT req.StartDate as tgl_po,* 
FROM Pay_Termin ter
LEFT JOIN Mst_Request req ON req.RequestID = ter.RequestID
WHERE ter.TerminID=" . $terminid . "");
//        $qdata = $db2->query("SELECT req.StartDate as tgl_po,* 
//                                FROM Pay_Termin ter
//                                LEFT JOIN Mst_Request req ON req.RequestID = ter.RequestID
//                                WHERE TerminID==" . $terminid . "");
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }
    
    //mamat
    function tgl_po($reqid) {
        $db2 = $this->load->database('config1', true);
        //die("SELECT * FROM Mst_Request WHERE RequestID=" . $reqid . "");
       $qdata = $db2->query("SELECT StartDate FROM Mst_Request WHERE RequestID=" . $reqid . "");
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    function checkRequest($id) {
        $db2 = $this->load->database('config1', true);
        $qdata = $db2->query("SELECT a.QTY,a.Is_header,a.Price,a.PriceVendor,a.Raw_ID,a.RequestID,a.ItemID,a.Status,b.BranchID,b.DivisionID,c.IClassID,d.BranchCode,e.ClassCode,f.TypeCode,g.DivisionCode
                            FROM Trx_DetItemReq a 
                            LEFT JOIN Mst_Request b ON b.RequestID=a.RequestID
                            LEFT JOIN Mst_ItemList c ON c.ItemID=a.ItemID 
                            LEFT JOIN Mst_Branch d ON d.BranchID=b.BranchID 
                            LEFT JOIN Mst_ItemClass e ON e.IClassID=c.IClassID
                            LEFT JOIN Mst_ItemType f ON f.ItemTypeID=c.ItemTypeID 
                            LEFT JOIN Mst_Division g ON g.DivisionID=b.DivisionID 
                            WHERE a.RequestID=" . $id . " AND Is_header=1");
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    function ias_data($reqid, $terminid) {
        $db2 = $this->load->database('config1', true);
        $qdata = $db2->query("SELECT * FROM Pay_IAS WHERE RequestID=" . $reqid . " and TerminID=" . $terminid . "");
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    function sum_requesttermin($id) {
        $db2 = $this->load->database('config1', true);
        $qdata = $db2->query("SELECT SUM(WorkProgress) as totprogress 
							  FROM Pay_Termin WHERE RequestID=" . $id . " and StatusPayment=1");
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    //EXTAK ITEM PAYMENT----------------------------------------------------------------------------------------------------->
    function counitem_extrak($reqid) {
        $db2 = $this->load->database('config1', true);
        $qdata = $db2->query("SELECT count(ItemID) as tot
							  FROM Trx_DetItemReq WHERE RequestID=" . $reqid . " and Status=2");
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    function checkRequest_extrak($id) {
        $db2 = $this->load->database('config1', true);
        $qdata = $db2->query("SELECT a.Raw_ID,a.RequestID,a.ItemID,a.Status,b.BranchID,b.DivisionID,c.IClassID,d.BranchCode,e.ClassCode,f.TypeCode,g.DivisionCode
							  FROM Trx_DetItemReq a 
							  LEFT JOIN Mst_Request b ON b.RequestID=a.RequestID
							  LEFT JOIN Mst_ItemList c ON c.ItemID=a.ItemID 
							  LEFT JOIN Mst_Branch d ON d.BranchID=b.BranchID 
							  LEFT JOIN Mst_ItemClass e ON e.IClassID=c.IClassID
							  LEFT JOIN Mst_ItemType f ON f.ItemTypeID=c.ItemTypeID 
							  LEFT JOIN Mst_Division g ON g.DivisionID=b.DivisionID 
							  WHERE a.RequestID=" . $id . " and a.Status IN('2')");
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    function extrakitem($reqid) {
        $db2 = $this->load->database('config1', true);
        $qdata = $db2->query("SELECT * FROM Trx_DetItemReq WHERE RequestID=" . $reqid . " and Status=2");
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    function chekdefdata($reqid) {
        $db2 = $this->load->database('config1', true);
        $qdata = $db2->query("SELECT Raw_ID,RequestID,QTY,FAID FROM Trx_DetItemReq WHERE RequestID=" . $reqid . " and Status=2");
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    function gendata_qr($reqid) {
        $db2 = $this->load->database('config1', true);
        $qdata = $db2->query("
                    SELECT a.ItemName,b.IClassName,d.BranchName,det.Raw_ID,det.RequestID,det.QTY,det.FAID 
                    FROM Trx_DetItemReq det
                    left join Mst_ItemList a on det.ItemID = a.ItemID
                    left join Mst_ItemClass b on a.IClassID = b.IClassID
                    left join Mst_Request c on det.RequestID = c.RequestID
                    left join Mst_Branch d on c.BranchID = d.BranchID
                    WHERE det.RequestID=" . $reqid . " and det.Status=9");
        //$qdata = $db2->query("SELECT Raw_ID,RequestID,QTY,FAID FROM Trx_DetItemReq WHERE RequestID=".$reqid." and Status=9");
        //echo "SELECT Raw_ID,RequestID,QTY,FAID FROM Trx_DetItemReq WHERE RequestID=".$reqid." and Status=9";
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    function gendata_qrmutasi($id) {
        $db2 = $this->load->database('config1', true);
        $qdata = $db2->query("
                    SELECT a.ItemName,b.IClassName,d.BranchName
                    FROM Trx_DetItemReq det
                    left join Mst_ItemList a on det.ItemID = a.ItemID
                    left join Mst_ItemClass b on a.IClassID = b.IClassID
                    left join Mst_Request c on det.RequestID = c.RequestID
                    left join Mst_Branch d on c.BranchID = d.BranchID
                    WHERE det.Raw_ID=" . $id . " /*and det.Status=3 */");
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }
    // function gendata_qr1($reqid){
    // 	$db2 = $this->load->database('config1', true);
    // 	$qdata = $db2->query("SELECT Raw_ID,RequestID,QTY,FAID FROM Trx_DetItemReq WHERE RequestID=".$reqid." and Status=9");
    // 	//echo "SELECT Raw_ID,RequestID,QTY,FAID FROM Trx_DetItemReq WHERE RequestID=".$reqid." and Status=9";
    // 	if(count($qdata) > 0) {
    //            return $qdata->result();
    //        } 
    // 	else {
    //            return false;
    //        }
    //        $qdata->close();
    // }

    function defdata($Raw_id) {
        $db2 = $this->load->database('config1', true);
        $qdata = $db2->query("SELECT * FROM Depreciation WHERE TrxDetItemID=" . $Raw_id . "");
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

        function gendata_qr_check($reqid) {
        $db2 = $this->load->database('config1', true);
        $qdata = $db2->query("
                    SELECT a.ItemName,b.IClassName,d.BranchName,det.Raw_ID,det.RequestID,det.QTY,det.FAID 
                    FROM Trx_DetItemReq det
                    left join Mst_ItemList a on det.ItemID = a.ItemID
                    left join Mst_ItemClass b on a.IClassID = b.IClassID
                    left join Mst_Request c on det.RequestID = c.RequestID
                    left join Mst_Branch d on c.BranchID = d.BranchID
                    WHERE det.RequestID=" . $reqid . " and det.Status=9 AND det.Is_header <>1");
        //$qdata = $db2->query("SELECT Raw_ID,RequestID,QTY,FAID FROM Trx_DetItemReq WHERE RequestID=".$reqid." and Status=9");
        //echo "SELECT Raw_ID,RequestID,QTY,FAID FROM Trx_DetItemReq WHERE RequestID=".$reqid." and Status=9";
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

}

?>