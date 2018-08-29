<?php

Class Listasset_mdl extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function seldata($num, $offset, $src_zone = null, $src_branch = null, $src_unit = null, $src_faID = null, $src_faIDlama = null, $src_AsetName = null, $src_condition = null) {
        //Koneksi keSQL SERVER
        //die($src_zone.$src_branch);
        $this->db2 = $this->load->database('config1', true);
        $lokasi = $this->getLokasi($this->session->userdata('user_id'));
        $data = '';
//		if($this->session->userdata('groupid') != 1){
//			if((int)$lokasi->BranchCode == 00000)
//				$data = 'and req.BranchID='.$lokasi->BranchID.' and req.DivisionID='.$lokasi->DivisionID;
//			else
//				$data = 'and req.BranchID='.$lokasi->BranchID;
//		}
        // PENMABAHAN WILLY  18 AGUSTUS 2017
        //if ($this->session->userdata('groupid') != 1) {
        $div = $this->session->userdata('DivisionID');
        $branch = $this->session->userdata('BranchID');
        $usergroup = $this->session->userdata('groupid');

        $kodebranch = $this->getCodeBranch($lokasi->BranchID);

        if ((int) $kodebranch == 00000) //pusat
            $kodecabang = $this->getCodeDivisi($lokasi->DivisionID);
        else
            $kodecabang = $kodebranch;


        if ($branch == 1) { //JIKA PUSAT : semua ppi bisa lihat data kecuali ppi dengan usergroup support
            if (($div == '8' && $usergroup <> '3') || $div == '20' || $usergroup == '1') {
                $data = '';
            } else {
                //$data = 'AND req.DivisionID=' . "$div";
                $data = 'AND (SUBSTRING(trx.FAID,12,5) =' . $kodecabang . ' OR SUBSTRING(trx.FAID,12,5) in (select BisUnitCode from Mst_BisUnit where BisUnitBranchID = ' . $branch . '))';
            }
        } else { //JIKA CABANG : cabang hanya bisa melihat cabang dan divisinya saja
            $data = 'AND (SUBSTRING(trx.FAID,12,5) =' . $kodecabang . ' OR SUBSTRING(trx.FAID,12,5) in (select BisUnitCode from Mst_BisUnit where BisUnitBranchID = ' . $branch . '))';
            ;
        }

        if ($offset != null) {
            $of = $offset;
        } else {
            $of = 0;
        }

        if ($src_zone != "" || $src_branch != "" || $src_unit != "" || $src_faID != "" || $src_faIDlama != "" || $src_AsetName != "" || $src_condition != "") {
            if ($src_zone != "") {
                $zoneName = "and zone.ZoneName like '%$src_zone%'";
            } else {
                $zoneName = "";
            }

            if ($src_branch != "") {
                $branchName = "and (br.BranchName like '%$src_branch%' or div.DivisionName like '%$src_branch%')";
            } else {
                $branchName = "";
            }

            if ($src_unit != "") {
                $bisUnitName = "and bis.BisUnitName like '%$src_unit%'";
            } else {
                $bisUnitName = "";
            }

            if ($src_faID != "") {
                $FAID = "and trx.FAID like '%$src_faID%'";
            } else {
                $FAID = "";
            }

            if ($src_faIDlama != "") {
                $FAID_lama = "and trx.FAID_lama like '%$src_faIDlama%'";
            } else {
                $FAID_lama = "";
            }

            if ($src_AsetName != "") {
                $itemName = "and item.ItemName like '%$src_AsetName%'";
            } else {
                $itemName = "";
            }
//            die($zoneName.'->'.$branchName.'->'.$bisUnitName.'->'.$FAID.'->'.$FAID_lama.'->'.$itemName);
            $querydata = $this->db2->query("SELECT SUBSTRING(trx.FAID,12,5) as coa,trx.Status, trx.QTY, trx.Raw_ID, trx.FAID,trx.FAID_lama,
                    trx.Period, trx.PriceVendor, trx.SetDatePayment, trx.Condition, trx.Is_trash,trx.Image,
                    trx.DateCondition,item.ItemName,zone.ZoneName,br.BranchName, 
                    br.BranchCode,div.DivisionName,bis.BisUnitName--,dep.Value
                    FROM Trx_DetItemReq trx
                    INNER JOIN Mst_ItemList item ON trx.ItemID = item.ItemID
                    INNER JOIN Mst_Request req ON trx.RequestID = req.RequestID 
                    INNER JOIN Mst_Branch br ON req.BranchID = br.BranchID
                    INNER JOIN Mst_Zonasi zone ON req.ZoneID = zone.ZoneID
                    LEFT JOIN Mst_Division div ON req.DivisionID = div.DivisionID 
                    LEFT JOIN Mst_BisUnit bis ON SUBSTRING(trx.FAID,12,5) = bis.BisUnitCode
                    --LEFT JOIN Depreciation dep ON (trx.FAID = dep.TrxDetItemID and dep.Date like '%' . date('Y-m') . '%') 
                    where trx.Status IN (9,3,2) " . $data . "
                    and trx.StatusLelang=0 and item.AssetType='CAPEX' and req.ReqTypeID NOT IN (3) 
                    AND (trx.Period IS NOT NULL AND trx.Period <>0) AND trx.Is_header <> 1 
                    $zoneName $branchName $bisUnitName $FAID $FAID_lama $itemName
                    ORDER BY zone.ZoneID,Raw_ID DESC OFFSET $of ROWS FETCH NEXT $num ROWS ONLY");
        } else {
            $querydata = $this->db2->query("SELECT SUBSTRING(trx.FAID,12,5) as coa,trx.Status, trx.QTY, trx.Raw_ID, trx.FAID,trx.FAID_lama,
                    trx.Period, trx.PriceVendor, trx.SetDatePayment, trx.Condition, trx.Is_trash,trx.Image,
                    trx.DateCondition,item.ItemName,zone.ZoneName,br.BranchName, 
                    br.BranchCode,div.DivisionName,bis.BisUnitName--,dep.Value
                    FROM Trx_DetItemReq trx
                    INNER JOIN Mst_ItemList item ON trx.ItemID = item.ItemID
                    INNER JOIN Mst_Request req ON trx.RequestID = req.RequestID 
                    INNER JOIN Mst_Branch br ON req.BranchID = br.BranchID
                    INNER JOIN Mst_Zonasi zone ON req.ZoneID = zone.ZoneID
                    LEFT JOIN Mst_Division div ON req.DivisionID = div.DivisionID 
                    LEFT JOIN Mst_BisUnit bis ON SUBSTRING(trx.FAID,12,5) = bis.BisUnitCode
                    --LEFT JOIN Depreciation dep ON (trx.FAID = dep.TrxDetItemID and dep.Date like '%' . date('Y-m') . '%') 
                    where trx.Status IN (9,3,2) " . $data . "
                    and trx.StatusLelang=0 and item.AssetType='CAPEX' and req.ReqTypeID NOT IN (3) 
                    AND (trx.Period IS NOT NULL AND trx.Period <>0) AND trx.Is_header <> 1 ORDER BY zone.ZoneID,Raw_ID DESC OFFSET $of ROWS FETCH NEXT $num ROWS ONLY");
        }
//        if ($src != null) {
//            $date = " and dep.Date like '%" . date('Y-m') . "%'";
//            if ($src_category == 'BranchName') {
//                $kodecab = $this->searchByBranchMutasi($src);
//                $kodediv = $this->searchByDivisiMutasi($src);
//                $src_category = 'br.BranchName';
//                $src = "like '%" . $src . "%'";
//                if ($kodecab != '-')
//                    $src .= " OR (trx.FAID like '%" . trim($kodecab) . "%' AND trx.Status IN (9,3) or (trx.Status=3 AND SUBSTRING(trx.FAID,12,5)=" . $kodecabang . ") ) and trx.StatusLelang=0 and item.AssetType='CAPEX' and req.ReqTypeID NOT IN (3)  AND (trx.Period IS NOT NULL AND trx.Period <>0) AND trx.Is_header <> 1";
//                if ($kodediv != '-')
//                    $src .= " OR (trx.FAID like '%" . trim($kodediv) . "%' AND trx.Status IN (9,3) or (trx.Status=3 AND SUBSTRING(trx.FAID,12,5)=" . $kodecabang . ") ) and trx.StatusLelang=0 and item.AssetType='CAPEX' and req.ReqTypeID NOT IN (3)  AND (trx.Period IS NOT NULL AND trx.Period <>0) AND trx.Is_header <> 1";
//            }
//            elseif ($src_category == 'ItemName') {
//                $src_category = 'item.ItemName';
//                $src = "like '%" . $src . "%'";
//            } elseif ($src_category == 'Value') {
//                $src_category = 'dep.Value';
//                $src = "=" . $src . "";
//            } elseif ($src_category == 'Value1') {
//                $src_category = 'dep.Value';
//                $src = "=" . $src . "";
//                $date = "and dep.Date <= '" . date('Y-m-d') . "'";
//            } elseif ($src_category == 'trx.FAID') {
//                $src = "like '%" . $src . "%'";
//            } elseif ($src_category == 'trx.FAID_lama') {
//                $src = "like '%" . $src . "%'";
//            } elseif ($src_category == 'div.DivisionName') {
//                $src = "like '%" . $src . "%'";
//            } elseif ($src_category == 'bis.BisUnitName') {
//                $src = "like '%" . $src . "%'";
//            }
//            // untuk memunculkan barang yg sudah di check item tambahkan status = 1                                               
//            $querydata = $this->db2->query("SELECT SUBSTRING(trx.FAID,12,5) as coa,trx.Status, item.ItemName, zone.ZoneName, br.BranchName, br.BranchCode,bis.BisUnitName, div.DivisionName, trx.QTY, trx.Raw_ID, trx.FAID,trx.FAID_lama, trx.Period, dep.Value, trx.PriceVendor, trx.SetDatePayment, trx.Condition, trx.Is_trash
//												FROM Trx_DetItemReq trx
//												INNER JOIN Mst_ItemList item ON trx.ItemID = item.ItemID
//												INNER JOIN Mst_Request req ON trx.RequestID = req.RequestID
//												INNER JOIN Mst_Branch br ON req.BranchID = br.BranchID												
//												LEFT JOIN Mst_Division div ON req.DivisionID = div.DivisionID
//                                                                                                LEFT JOIN Mst_BisUnit bis ON SUBSTRING(trx.FAID,12,5) = bis.BisUnitCode
//												INNER JOIN Mst_Zonasi zone ON req.ZoneID = zone.ZoneID
//												LEFT JOIN Depreciation dep ON (trx.FAID = dep.TrxDetItemID " . $date . ")
//												where ((trx.Status IN (9,3) " . $data . " ) or (trx.Status=3 AND SUBSTRING(trx.FAID,12,5)=" . $kodecabang . ") ) and trx.StatusLelang=0 and item.AssetType='CAPEX' and req.ReqTypeID NOT IN (3)  AND (trx.Period IS NOT NULL AND trx.Period <>0) AND trx.Is_header <> 1 
//												and " . $src_category . " " . $src . " ORDER BY zone.ZoneID ");
//        } else {
//            if ($offset != null) {
//                $of = $offset;
//            } else {
//                $of = 0;
//            }
//            // print_r($num);die();
//            $querydata = $this->db2->query("SELECT SUBSTRING(trx.FAID,12,5) as coa,trx.Status, item.ItemName, zone.ZoneName, br.BranchName, br.BranchCode,bis.BisUnitName,div.DivisionName, trx.QTY, trx.Raw_ID, trx.FAID,trx.FAID_lama, trx.Period, dep.Value, trx.PriceVendor, trx.SetDatePayment, trx.Condition, trx.Is_trash
//													FROM Trx_DetItemReq trx
//													INNER JOIN Mst_ItemList item ON trx.ItemID = item.ItemID
//													INNER JOIN Mst_Request req ON trx.RequestID = req.RequestID
//													INNER JOIN Mst_Branch br ON req.BranchID = br.BranchID													
//													LEFT JOIN Mst_Division div ON req.DivisionID = div.DivisionID
//                                                                                                        LEFT JOIN Mst_BisUnit bis ON SUBSTRING(trx.FAID,12,5) = bis.BisUnitCode
//													INNER JOIN Mst_Zonasi zone ON req.ZoneID = zone.ZoneID
//													LEFT JOIN Depreciation dep ON (trx.FAID = dep.TrxDetItemID and dep.Date like '%" . date('Y-m') . "%')
//													where ((trx.Status IN (9,3,2) " . $data . " ) or (trx.Status=3 AND SUBSTRING(trx.FAID,12,5)=" . $kodecabang . ")) and trx.StatusLelang=0 and item.AssetType='CAPEX' and req.ReqTypeID NOT IN (3)  AND (trx.Period IS NOT NULL AND trx.Period <>0) AND trx.Is_header <> 1 
//					                                ORDER BY zone.ZoneID,Raw_ID DESC OFFSET $of ROWS FETCH NEXT $num ROWS ONLY");
//        }
        return $querydata->result();
        $querydata->close();
    }

    function seldetil($id) {
        //echo $id;die;
        $db2 = $this->load->database('config1', true);
        $querydata = $db2->query("SELECT * FROM Appv_List where Is_trash=0 and appvID='" . $id . "'");
        if (count($querydata) > 0) {
            return $querydata->result();
        } else {
            return false;
        }
        $querydata->close();
    }

    function searchByBranchMutasi($name) {
        $this->db2 = $this->load->database('config1', true);
        $division = $this->db2->query("SELECT BranchCode FROM Mst_Branch WHERE BranchName like '%" . $name . "%' ");
        if (!empty($division->row()->BranchCode)) {
            return $division->row()->BranchCode;
        } else {
            return '-';
        }
    }

    function searchByDivisiMutasi($name) {
        $this->db2 = $this->load->database('config1', true);
        $division = $this->db2->query("SELECT DivisionCode FROM Mst_Division WHERE DivisionName like '%" . $name . "%'");
        if (!empty($division->row()->DivisionCode)) {
            return $division->row()->DivisionCode;
        } else {
            return '-';
        }
    }

//    function jumlah() {
//        $this->db2 = $this->load->database('config1', true);
//        $lokasi = $this->getLokasi($this->session->userdata('user_id'));
//        $data = '';
////        if ($this->session->userdata('groupid') != 1) {
////            if ((int) $lokasi->BranchCode == 00000)
////                $dat = 'and req.BranchID=' . $lokasi->BranchID . ' and req.DivisionID=' . $lokasi->DivisionID;
////            else
////                $dat = 'and req.BranchID=' . $lokasi->BranchID;
////        }
////
////        $kodebranch = $this->getCodeBranch($lokasi->BranchID);
////
////        if ((int) $kodebranch == 00000) //pusat
////            $kodecabang = $this->getCodeDivisi($lokasi->DivisionID);
////        else
////            $kodecabang = $kodebranch;
//        
//        $div = $this->session->userdata('DivisionID');
//        $branch = $this->session->userdata('BranchID');
//        $usergroup = $this->session->userdata('groupid');
//        if ($branch == 1) { //JIKA PUSAT : semua ppi bisa lihat data kecuali ppi dengan usergroup support
//            if (($div == '8' && $usergroup <> '3') || $div == '20' || $usergroup == '1') {
//                $data = '';
//            } else {
//                $data = 'AND req.DivisionID=' . "$div" . ' AND req.BranchID=' . "$branch";
//            }
//        } else { //JIKA CABANG : cabang hanya bisa melihat cabang dan divisinya saja
//            $data = 'AND req.DivisionID=' . "$div" . ' AND req.BranchID=' . "$branch";
//        }
//
//
//        $data = $this->db2->query("SELECT COUNT(trx.Raw_ID) AS jml 
//									FROM Trx_DetItemReq trx
//									INNER JOIN Mst_ItemList item ON trx.ItemID = item.ItemID
//									INNER JOIN Mst_Request req ON trx.RequestID = req.RequestID
//									where trx.Status IN (9,3,2) " . $data . "  and item.AssetType='CAPEX' and trx.StatusLelang=0 and req.ReqTypeID NOT IN (3)");
//        return $data->result();
//    }


    function jumlah($src_zone = null, $src_branch = null, $src_unit = null, $src_faID = null, $src_faIDlama = null, $src_AsetName = null, $src_condition = null) {

        $this->db2 = $this->load->database('config1', true);
        $lokasi = $this->getLokasi($this->session->userdata('user_id'));
        $data = '';
        $div = $this->session->userdata('DivisionID');
        $branch = $this->session->userdata('BranchID');
        $usergroup = $this->session->userdata('groupid');
        if ($branch == 1) { //JIKA PUSAT : semua ppi bisa lihat data kecuali ppi dengan usergroup support
            if (($div == '8' && $usergroup <> '3') || $div == '20' || $usergroup == '1') {
                $data = '';
            } else {
                $data = 'AND req.DivisionID=' . "$div" . ' AND req.BranchID=' . "$branch";
            }
        } else { //JIKA CABANG : cabang hanya bisa melihat cabang dan divisinya saja
            $data = 'AND req.DivisionID=' . "$div" . ' AND req.BranchID=' . "$branch";
        }
        if ($src_zone != "" || $src_branch != "" || $src_unit != "" || $src_faID != "" || $src_faIDlama != "" || $src_AsetName != "" || $src_condition != "") {
            if ($src_zone != "") {
                $zoneName = "and zone.ZoneName like '%$src_zone%'";
            } else {
                $zoneName = "";
            }

            if ($src_branch != "") {
                $branchName = "and (br.BranchName like '%$src_branch%' or div.DivisionName like '%$src_branch%')";
            } else {
                $branchName = "";
            }

            if ($src_unit != "") {
                $bisUnitName = "and bis.BisUnitName like '%$src_unit%'";
            } else {
                $bisUnitName = "";
            }

            if ($src_faID != "") {
                $FAID = "and trx.FAID like '%$src_faID%'";
            } else {
                $FAID = "";
            }

            if ($src_faIDlama != "") {
                $FAID_lama = "and trx.FAID_lama like '%$src_faIDlama%'";
            } else {
                $FAID_lama = "";
            }

            if ($src_AsetName != "") {
                $itemName = "and item.ItemName like '%$src_AsetName%'";
            } else {
                $itemName = "";
            }
//            die($zoneName.'->'.$branchName.'->'.$bisUnitName.'->'.$FAID.'->'.$FAID_lama.'->'.$itemName);
            $querydata = $this->db2->query("SELECT COUNT(trx.Raw_ID) AS jml 
                        FROM Trx_DetItemReq trx
                        INNER JOIN Mst_ItemList item ON trx.ItemID = item.ItemID
                        INNER JOIN Mst_Request req ON trx.RequestID = req.RequestID 
                        INNER JOIN Mst_Branch br ON req.BranchID = br.BranchID
                        INNER JOIN Mst_Zonasi zone ON req.ZoneID = zone.ZoneID
                        LEFT JOIN Mst_Division div ON req.DivisionID = div.DivisionID 
                        LEFT JOIN Mst_BisUnit bis ON SUBSTRING(trx.FAID,12,5) = bis.BisUnitCode
                        --LEFT JOIN Depreciation dep ON (trx.FAID = dep.TrxDetItemID and dep.Date like '%' . date('Y-m') . '%') 
                        where trx.Status IN (9,3,2) " . $data . "  and item.AssetType='CAPEX' and trx.StatusLelang=0 and req.ReqTypeID NOT IN (3) $zoneName $branchName $bisUnitName $FAID $FAID_lama $itemName");
        } else {
            $querydata = $this->db2->query("SELECT COUNT(trx.Raw_ID) AS jml 
                                                FROM Trx_DetItemReq trx
                                                INNER JOIN Mst_ItemList item ON trx.ItemID = item.ItemID
                                                INNER JOIN Mst_Request req ON trx.RequestID = req.RequestID
                                                where trx.Status IN (9,3,2) " . $data . "  and item.AssetType='CAPEX' and trx.StatusLelang=0 and req.ReqTypeID NOT IN (3)");
        }
        return $querydata->result();
    }

    function jumlahII($src_zone = null, $src_branch = null, $src_unit = null, $src_faID = null, $src_faIDlama = null, $src_AsetName = null, $src_condition = null) {
        $this->db2 = $this->load->database('config1', true);
        $lokasi = $this->getLokasi($this->session->userdata('user_id'));
        $data = '';
        $div = $this->session->userdata('DivisionID');
        $branch = $this->session->userdata('BranchID');
        $usergroup = $this->session->userdata('groupid');
        if ($branch == 1) { //JIKA PUSAT : semua ppi bisa lihat data kecuali ppi dengan usergroup support
            if (($div == '8' && $usergroup <> '3') || $div == '20' || $usergroup == '1') {
                $data = '';
            } else {
                $data = 'AND req.DivisionID=' . "$div" . ' AND req.BranchID=' . "$branch";
            }
        } else { //JIKA CABANG : cabang hanya bisa melihat cabang dan divisinya saja
            $data = 'AND req.DivisionID=' . "$div" . ' AND req.BranchID=' . "$branch";
        }
        if ($src_zone != "") {
            $zoneName = "and zone.ZoneName like '%$src_zone%'";
        } else {
            $zoneName = "and zone.ZoneName like '%%'";
        }

        if ($src_branch != "") {
            $branchName = "and br.BranchName like '%$src_branch%'";
        } else {
            $branchName = "and br.BranchName like '%%'";
        }

        if ($src_unit != "") {
            $bisUnitName = "and bis.BisUnitName like '%$src_unit%'";
        } else {
            $bisUnitName = "and bis.BisUnitName like '%%'";
        }

        if ($src_faID != "") {
            $FAID = "and trx.FAID like '%$src_faID%'";
        } else {
            $FAID = "and trx.FAID like '%%'";
        }

        if ($src_faIDlama != "") {
            $FAID_lama = "and trx.FAID_lama like '%$src_faIDlama%'";
        } else {
            $FAID_lama = "and trx.FAID_lama like '%%'";
        }

        if ($src_AsetName != "") {
            $itemName = "and item.ItemName like '%$src_AsetName%'";
        } else {
            $itemName = "and item.ItemName like '%%'";
        }
        $data = $this->db2->query("SELECT COUNT(trx.Raw_ID) AS jml 
                                    FROM Trx_DetItemReq trx
                                    INNER JOIN Mst_ItemList item ON trx.ItemID = item.ItemID
                                    INNER JOIN Mst_Request req ON trx.RequestID = req.RequestID 
                                    INNER JOIN Mst_Branch br ON req.BranchID = br.BranchID
                                    INNER JOIN Mst_Zonasi zone ON req.ZoneID = zone.ZoneID
                                    LEFT JOIN Mst_Division div ON req.DivisionID = div.DivisionID 
                                    LEFT JOIN Mst_BisUnit bis ON SUBSTRING(trx.FAID,12,5) = bis.BisUnitCode
                                    LEFT JOIN Depreciation dep ON (trx.FAID = dep.TrxDetItemID and dep.Date like '%" . date('Y-m') . "%') 
                                    where trx.Status IN (9,3,2) " . $data . "  and item.AssetType='CAPEX' and trx.StatusLelang=0 and req.ReqTypeID NOT IN (3) $zoneName $branchName $bisUnitName $FAID $FAID_lama $itemName");
        return $data->result();
    }

    function getcategory() {
        $this->db2 = $this->load->database('config1', true);
        $data = $this->db2->query('SELECT AppvCategoryID, AppvCategoryMax, AppvCategoryMin  FROM Appv_ListCategory where Is_trash=0');
        return $data->result();
    }

    function getposition() {
        $this->db2 = $this->load->database('config1', true);
        $data = $this->db2->query('SELECT PositionID, PositionName FROM Mst_Position where Is_trash=0');
        return $data->result();
    }

    function setPeriod($id, $period) {
        $this->db2 = $this->load->database('config1', true);
        $data = $this->db2->query('UPDATE Trx_DetItemReq set Period=' . $period . ', Depreciation=PriceVendor/' . $period . ' where RAW_ID=' . $id);

        $depreciation = $this->db2->query('SELECT Depreciation,PriceVendor,SetDatePayment FROM Trx_DetItemReq where RAW_ID=' . $id);

        return $depreciation->row();
        $this->db2->close();
    }

    function setDepreciation($trxid, $date, $value) {
        $data = array(
            'TrxDetItemID' => $trxid,
            'Date' => $date,
            'Value' => $value
        );

        $this->db2 = $this->load->database('config1', true);
        $this->db2->insert('Depreciation', $data);
        $this->db2->close();
    }

    function getDetil($id) {
        $this->db2 = $this->load->database('config1', true);

        $data = $this->db2->query("SELECT item.ItemName, de.Date, de.Value
									FROM Depreciation de 
									INNER JOIN Trx_DetItemReq trx ON de.TrxDetItemID = trx.FAID AND trx.Status IN (3,9)
									INNER JOIN Mst_ItemList item ON trx.ItemID = item.ItemID
									WHERE de.TrxDetItemID='" . $id . "'  order by de.DepreciationID");
        return $data->result();
    }

    function getLokasi($id) {
        $this->db2 = $this->load->database('config1', true);

        $data = $this->db2->query('SELECT emp.BranchID, emp.BisUnitID, emp.DivisionID , br.BranchCode
									FROM Mst_Employee emp
									LEFT JOIN Mst_Branch br ON br.BranchID = emp.BranchID
									WHERE EmployeeID=' . $id);
        return $data->row();
    }

    function setlelang($id) {
        $data = array(
            'StatusLelang' => 1,
            'DateLelang' => date('Y-m-d H:i:s')
        );
        $this->db2 = $this->load->database('config1', true);
        $this->db2->where('Raw_ID', $id);
        $this->db2->update('Trx_DetItemReq', $data);
        $this->db2->close();
    }

    function getzone() {
        $this->db2 = $this->load->database('config1', true);
        $data = $this->db2->query('SELECT ZoneID, ZoneName FROM Mst_Zonasi where Is_trash=0');
        return $data->result();
    }

    function getbranch($zone) {
        $this->db2 = $this->load->database('config1', true);
        $data = $this->db2->query('SELECT BranchID, BranchName, BranchCode FROM Mst_Branch where Is_trash=0 AND ZoneID=' . $zone);
        return $data->result();
    }

    function getdivisi($unit) {
        $this->db2 = $this->load->database('config1', true);
        $division = $this->db2->query('SELECT DivisionID, DivisionName FROM Mst_Division where Is_trash=0 AND BranchID=' . $unit);
        return $division->result();
    }

    function getunit($branch) {
        $this->db2 = $this->load->database('config1', true);
        $unit = $this->db2->query('SELECT BisUnitID, BisUnitName FROM Mst_BisUnit where Is_trash=0 AND BisUnitBranchID=' . $branch);
        return $unit->result();
    }

    function gettype($id) {
        $this->db2 = $this->load->database('config1', true);
        $division = $this->db2->query("SELECT class.ClassCode, type.TypeCode
										FROM Trx_DetItemReq trx
										INNER JOIN Mst_ItemList item ON trx.ItemID = item.ItemID
										INNER JOIN Mst_ItemType type ON item.ItemTypeID = type.ItemTypeID
										INNER JOIN Mst_ItemClass class ON item.IClassID = class.IClassID
										WHERE trx.Raw_ID=" . $id);
        return $division->row();
    }

    function setMutasi() {
        $this->db2 = $this->load->database('config1', true);
        $kodebranch = $this->getCodeBranch($this->input->post('cabang'));

        if ((int) $kodebranch == 00000) {
            $counter = $this->getCounter($this->input->post('type'), $this->input->post('class'), $this->input->post('cabang'), $this->input->post('divisi'), 'pusat');
            $kodedivisi = $this->getCodeDivisi($this->input->post('divisi'));
            $akhiran = trim($kodedivisi) . sprintf("%04s", ($counter + 1));
        } else {
            $unit = $this->input->post('unit');
            if ($unit == null) {
                $counter = $this->getCounter($this->input->post('type'), $this->input->post('class'), $this->input->post('cabang'), null, 'cabang');
                $akhiran = trim($kodebranch) . sprintf("%04s", ($counter + 1));
                //echo $akhiran;die();
            } else {
                $counter = $this->getCounter($this->input->post('type'), $this->input->post('class'), $this->input->post('cabang'), $unit, 'unit');
                $kodeunit = $this->getCodeUnit($unit);
                $akhiran = trim($kodeunit) . sprintf("%04s", ($counter + 1));
                //echo $akhiran;die();
            }
        }

        $status = $this->db2->query("UPDATE Trx_DetItemReq SET Status=3 , DateMutation='" . date('Y-m-d H:i:s') . "' , FAID= CONCAT(SUBSTRING(FAID, 1, 11),'" . $akhiran . "') WHERE Raw_ID=" . $this->input->post('id'));
        if ($status) {
            $status = $this->db2->query("UPDATE Depreciation SET TrxDetItemID=CONCAT(SUBSTRING(TrxDetItemID, 1, 11),'" . $akhiran . "') WHERE TrxDetItemID='" . $this->input->post('faid') . "'");
            if ($status) {
                $namalama = trim($this->input->post('faid')) . '.png';
                $namabaru = substr(trim($this->input->post('faid')), 0, 11) . $akhiran;
                $Dir = FCPATH . "assets\\temp\\";

                // rename($Dir.$namalama, $Dir.$namabaru);
                return $namabaru;
                $this->session->set_flashdata('msg', 'Mutation assets success !!!');
            } else
                $this->session->set_flashdata('msg', 'Mutation assets failed !!!');
        }else {
            $this->session->set_flashdata('msg', 'Mutation assets failed !!!');
        }
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

    function getCodeUnit($idUnit) {
        $this->db2 = $this->load->database('config1', true);
        $unit = $this->db2->query("SELECT BisUnitCode FROM Mst_BisUnit WHERE BisUnitID=" . $idUnit);

        return $unit->row()->BisUnitCode;
    }

    function getCounter($type, $class, $branch, $divisi, $lokasi) {
        $this->db2 = $this->load->database('config1', true);
        if ($lokasi == 'pusat') {
            //echo 'tes';die();
            $tempat = " AND req.BranchID=" . $branch . " AND req.DivisionID=" . $divisi;
            $code = $this->getCodeDivisi($divisi);
        } elseif ($lokasi == 'cabang') {
            //echo 'dewi';die();
            $tempat = " AND req.BranchID=" . $branch;
            $code = $this->getCodeBranch($branch);
        } else {
            //echo 'adadd';die();
            $code = $this->getCodeUnit($divisi);
            $tempat = "AND CAST(SUBSTRING(trx.FAID, 12, 5) AS NVARCHAR)=" . $code;
        }

        $division = $this->db2->query("SELECT TOP 1 trx.FAID, SUBSTRING(trx.FAID, 17, 4) as counter
            FROM Trx_DetItemReq trx
            INNER JOIN Mst_ItemList item ON trx.ItemID = item.ItemID
            INNER JOIN Mst_ItemType type ON item.ItemTypeID = type.ItemTypeID
            INNER JOIN Mst_ItemClass class ON item.IClassID = class.IClassID
            INNER JOIN Mst_Request req ON trx.RequestID = req.RequestID
            WHERE type.TypeCode=" . trim($type) . "  AND class.ClassCode=" . trim($class) . "" . $tempat . " 
            OR (CAST(SUBSTRING(trx.FAID, 1, 5) AS NVARCHAR)  = '" . trim($class) . "" . trim($type) . "' AND CAST(SUBSTRING(trx.FAID, 12, 5) AS NVARCHAR) = '" . trim($code) . "' )
            GROUP BY trx.FAID
            ORDER BY MAX(trx.FAID) DESC");
//        print_r("SELECT TOP 1 trx.FAID, SUBSTRING(trx.FAID, 17, 4) as counter
//										FROM Trx_DetItemReq trx
//										INNER JOIN Mst_ItemList item ON trx.ItemID = item.ItemID
//										INNER JOIN Mst_ItemType type ON item.ItemTypeID = type.ItemTypeID
//										INNER JOIN Mst_ItemClass class ON item.IClassID = class.IClassID
//										INNER JOIN Mst_Request req ON trx.RequestID = req.RequestID
//										WHERE type.TypeCode=" . trim($type) . "  AND class.ClassCode=" . trim($class) . "" . $tempat . " 
//										OR (CAST(SUBSTRING(trx.FAID, 1, 5) AS NVARCHAR)  = '" . trim($class) . "" . trim($type) . "' AND CAST(SUBSTRING(trx.FAID, 12, 5) AS NVARCHAR) = '" . trim($code) . "' )
//										GROUP BY trx.FAID
//										ORDER BY MAX(trx.FAID) DESC");
        if (!empty($division->row())) {
            return $division->row()->counter;
        } else {
            return 0;
        }
    }

    function disposal($id, $faid) {
        $data = array(
            'Is_trash' => 1,
            'DeleteDate' => date('Y-m-d H:i:s')
        );
        $this->db2 = $this->load->database('config1', true);
        $this->db2->where('Raw_ID', $id);
        $this->db2->update('Trx_DetItemReq', $data);
        $this->db2->close();


        $data = array(
            'Value' => 0
        );
        //delete depresi
        $this->db2 = $this->load->database('config1', true);
        $this->db2->where('TrxDetItemID', trim($faid));
        $this->db2->update('Depreciation', $data);
        if ($this->db2->trans_status() === FALSE) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
        $this->db2->close();
    }

    function getItemDisposal() {
        $data = $this->input->get('iddisposal');
        $in = "";
        $data = explode(",", $data);
        for ($i = 0; $i < count($data); $i++) {
            if ($i == 0)
                $in .= explode("-", $data[$i])[0];
            else
                $in .= "," . explode("-", $data[$i])[0];
        }
//        print_r($in);die();
        $this->db2 = $this->load->database('config1', true);

        $division = $this->db2->query("SELECT item.ItemName, trx.QTY, br.BranchName, br.BranchCode, div.DivisionName, trx.PriceVendor, trx.SetDatePayment, trx.Status, trx.FAID
										FROM Trx_DetItemReq trx 
										INNER JOIN Mst_Request req ON trx.RequestID = req.RequestID
										INNER JOIN Mst_ItemList item ON trx.ItemID = item.ItemID
										INNER JOIN Mst_Branch br ON req.BranchID = br.BranchID										
										LEFT JOIN Mst_Division div ON req.DivisionID = div.DivisionID
										WHERE trx.Is_trash=0 AND trx.Raw_ID IN (" . $in . ")");

        return $division->result();
    }

    function getItemQR($id, $statusMutasi) {
        $this->db2 = $this->load->database('config1', true);
        if ((int) $statusMutasi == 9) {
            $division = $this->db2->query("SELECT SUBSTRING(trx.FAID,12,5) as coa, trx.FAID , br.BranchCode, br.BranchName, div.DivisionName, bis.BisUnitName
											FROM Trx_DetItemReq trx
											INNER JOIN Mst_Request req ON trx.RequestID = req.RequestID
											LEFT JOIN Mst_Branch br ON req.BranchID = br.BranchID
											LEFT JOIN Mst_Division div ON req.DivisionID = div.DivisionID
                                                                                        LEFT JOIN Mst_BisUnit bis ON SUBSTRING(trx.FAID,12,5) = bis.BisUnitCode
											WHERE trx.Raw_ID=" . $id);
        } else {

            $division = $this->db2->query("SELECT SUBSTRING(trx.FAID,12,5) as coa, trx.FAID , br.BranchCode, br.BranchName, div.DivisionName, bis.BisUnitName
											FROM Trx_DetItemReq trx
											LEFT JOIN Mst_Branch br ON substring(trx.FAID, 12, 5) = br.BranchCode
											LEFT JOIN Mst_Division div ON substring(trx.FAID, 12, 5) = div.DivisionCode
                                                                                        LEFT JOIN Mst_BisUnit bis ON SUBSTRING(trx.FAID,12,5) = bis.BisUnitCode
											WHERE trx.Raw_ID=" . $id);
        }

        return $division->row();
    }

    function getBranchFromCode($id) {
        $this->db2 = $this->load->database('config1', true);

        $data = $this->db2->query("SELECT br.BranchName , div.DivisionName, br.BranchCode,unit.BisUnitName
                                FROM Mst_Branch br
                                LEFT JOIN Mst_Division div ON div.BranchID = br.BranchID
                                LEFT JOIN Mst_BisUnit unit ON unit.BisUnitBranchID = br.BranchID
                                where br.Is_trash=0 AND (br.BranchCode=" . $id . " OR div.DivisionCode=" . $id . " OR unit.BisUnitCode=" . $id . ")");
        return $data->row();
    }

    function getCodeBranchDivisi($faid) {
        $this->db2 = $this->load->database('config1', true);

        $data = $this->db2->query("SELECT br.BranchCode,br.BranchName, div.DivisionName
                                            FROM Mst_Branch br                                            
                                            LEFT JOIN Mst_Division div ON br.BranchID = div.BranchID
                                            WHERE div.DivisionCode = " . substr($faid, 11, 5) . " OR  br.BranchCode = " . substr($faid, 11, 5));
        return $data->row();
    }

}

?>