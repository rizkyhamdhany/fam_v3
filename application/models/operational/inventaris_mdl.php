<?php

Class Inventaris_mdl extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function seldata($num, $offset, $src_category = null, $src = null) {
        //Koneksi keSQL SERVER
        $this->db2 = $this->load->database('config1', true);
        $lokasi = $this->getLokasi($this->session->userdata('user_id'));
        $data = '';
//		if($this->session->userdata('groupid') != 1){
//			if((int)$lokasi->BranchCode == 00000)
//				$data = 'and req.BranchID='.$lokasi->BranchID.' and req.DivisionID='.$lokasi->DivisionID;
//			else
//				$data = 'and req.BranchID='.$lokasi->BranchID;
//		}
//                
        //dewi 23 08 17
        $div = $this->session->userdata('DivisionID');
        $branch = $this->session->userdata('BranchID');
        $usergroup = $this->session->userdata('groupid');
        if ($branch == 1) { //JIKA PUSAT : semua ppi bisa lihat data kecuali ppi dengan usergroup support
            if (($div == '8' && $usergroup <> '3') || $div == '20' || $usergroup == '1') {
                $data = '';
            } else {
                $data = 'AND req.DivisionID=' . "$div";
            }
        } else { //JIKA CABANG : cabang hanya bisa melihat cabang dan divisinya saja
            $data = ' AND req.BranchID=' . "$branch";
        }

        $kodebranch = $this->getCodeBranch($lokasi->BranchID);

        if ((int) $kodebranch == 00000) //pusat
            $kodecabang = $this->getCodeDivisi($lokasi->DivisionID);
        else
            $kodecabang = $kodebranch;

        if ($src != null) {
            $date = " and dep.Date like '%" . date('Y-m') . "%'";
            if ($src_category == 'BranchName') {
                $src_category = 'br.BranchName';
                $src = "like '%" . $src . "%'";
            } elseif ($src_category == 'ItemName') {
                $src_category = 'item.ItemName';
                $src = "like '%" . $src . "%'";
            } elseif ($src_category == 'SetDatePayment') {
                $src_category = 'trx.SetDatePayment';
                $src = "like '%" . $src . "%'";
            }
            $querydata = $this->db2->query("SELECT item.ItemName, zone.ZoneName, br.BranchName, br.BranchCode,  
                                        div.DivisionName, trx.QTY, trx.Raw_ID, trx.Period,  trx.PriceVendor, trx.SetDatePayment,  trx.FAID, trx.Status, trx.Is_trash
                                        FROM Trx_DetItemReq trx
                                        INNER JOIN Mst_ItemList item ON trx.ItemID = item.ItemID
                                        INNER JOIN Mst_Request req ON trx.RequestID = req.RequestID
                                        INNER JOIN Mst_Branch br ON req.BranchID = br.BranchID													
                                        LEFT JOIN Mst_Division div ON req.DivisionID = div.DivisionID
                                        INNER JOIN Mst_Zonasi zone ON req.ZoneID = zone.ZoneID
                                        where trx.Is_trash=0 and ((trx.Status IN (9,4) " . $data . " ) or (trx.Status=4 AND SUBSTRING(trx.FAID,12,5)=" . $kodecabang . ")) and item.AssetType 
                                        NOT IN ('CAPEX','OPEX') and  req.ReqTypeID NOT IN (3) AND trx.Is_header <> 1
                                        and " . $src_category . " " . $src . " ORDER BY zone.ZoneID ");
        } else {
            if ($offset != null) {
                $of = $offset;
            } else {
                $of = 0;
            }

            $querydata = $this->db2->query("SELECT itemC.ClassCode,req.ReqTypeID,item.ItemName, zone.ZoneName, br.BranchName, br.BranchCode,
                                        div.DivisionName, trx.QTY, trx.Raw_ID, trx.Period,  trx.PriceVendor, trx.SetDatePayment, trx.FAID, trx.Status, trx.Is_trash
                                        FROM Trx_DetItemReq trx
                                        INNER JOIN Mst_ItemList item ON trx.ItemID = item.ItemID
                                        INNER JOIN Mst_Request req ON trx.RequestID = req.RequestID
                                        INNER JOIN Mst_Branch br ON req.BranchID = br.BranchID													
                                        LEFT JOIN Mst_Division div ON req.DivisionID = div.DivisionID
                                        INNER JOIN Mst_Zonasi zone ON req.ZoneID = zone.ZoneID
                                        LEFT JOIN Mst_ItemClass itemC ON item.IClassID = itemC.IClassID
                                        where trx.Is_trash=0 and ((trx.Status IN (9,4,2) " . $data . " ) or (trx.Status=4 AND SUBSTRING(trx.FAID,12,5)=" . $kodecabang . ")) 
                                            AND itemC.ClassCode LIKE '%2%' and item.AssetType 
                                NOT IN ('CAPEX','OPEX') and req.ReqTypeID NOT IN (3)  AND trx.Is_header <> 1
                ORDER BY zone.ZoneID OFFSET $of ROWS FETCH NEXT $num ROWS ONLY ");
        }
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

    function sel_vendortype() {
        $db2 = $this->load->database('config1', true);
        $querydata = $db2->query("SELECT * FROM Mst_VendorType where Is_trash=0");
        return $querydata->result();
    }

    function jumlah() {
        $this->db2 = $this->load->database('config1', true);
        $lokasi = $this->getLokasi($this->session->userdata('user_id'));
        $dat = '';
        $div = $this->session->userdata('DivisionID');
        $branch = $this->session->userdata('BranchID');
        $usergroup = $this->session->userdata('groupid');
        if ($branch == 1) { //JIKA PUSAT : semua ppi bisa lihat data kecuali ppi dengan usergroup support
            if (($div == '8' && $usergroup <> '3') || $div == '20' || $usergroup == '1') {
                $dat = '';
            } else {
                $dat = 'AND req.DivisionID=' . "$div" . ' AND req.BranchID=' . "$branch";
            }
        } else { //JIKA CABANG : cabang hanya bisa melihat cabang dan divisinya saja
            $dat = 'AND req.DivisionID=' . "$div" . ' AND req.BranchID=' . "$branch";
        }

        $kodebranch = $this->getCodeBranch($lokasi->BranchID);

        if ((int) $kodebranch == 00000) //pusat
            $kodecabang = $this->getCodeDivisi($lokasi->DivisionID);
        else
            $kodecabang = $kodebranch;

        $data = $this->db2->query("SELECT COUNT(trx.Raw_ID) AS jml
									FROM Trx_DetItemReq trx
									INNER JOIN Mst_ItemList item ON trx.ItemID = item.ItemID
									INNER JOIN Mst_Request req ON trx.RequestID = req.RequestID
									LEFT JOIN Mst_Branch br ON req.BranchID = br.BranchID									
									WHERE item.AssetType NOT IN ('CAPEX','OPEX') AND ((trx.Status IN (9) " . $dat . " ) or (trx.Status=4 AND SUBSTRING(trx.FAID,10,1)='" . $kodecabang . "')) AND trx.Is_trash=0  and req.ReqTypeID NOT IN (3) AND trx.Is_header <> 1");

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

    function getDetil($id) {
        $this->db2 = $this->load->database('config1', true);

        $data = $this->db2->query('SELECT item.ItemName, de.Date, de.Value
									FROM Depreciation de 
									INNER JOIN Trx_DetItemReq trx ON de.TrxDetItemID = trx.Raw_ID
									INNER JOIN Mst_ItemList item ON trx.ItemID = item.ItemID
									WHERE de.TrxDetItemID=' . $id);
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

    function getunit($branch) {
        $this->db2 = $this->load->database('config1', true);
        $division = $this->db2->query('SELECT BisUnitID, BisUnitName FROM Mst_BisUnit where Is_trash=0 AND BisUnitBranchID=' . $branch);
        return $division->result();
    }

    function getdivisi($unit) {
        $this->db2 = $this->load->database('config1', true);
        $division = $this->db2->query('SELECT DivisionID, DivisionName FROM Mst_Division where Is_trash=0 AND BranchID=' . $unit);
        return $division->result();
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
            $akhiran = trim($kodedivisi) . sprintf("%03s", ($counter + 1));
        } else {
            $counter = $this->getCounter($this->input->post('type'), $this->input->post('class'), $this->input->post('cabang'), null, 'cabang');
            $akhiran = trim($kodebranch) . sprintf("%03s", ($counter + 1));
        }

        $status = $this->db2->query("UPDATE Trx_DetItemReq SET Status=4 , DateMutation='" . date('Y-m-d H:i:s') . "' , FAID= CONCAT(SUBSTRING(FAID, 1, 11),'" . $akhiran . "') WHERE Raw_ID=" . $this->input->post('id'));
        if ($status) {
            $namalama = trim($this->input->post('faid')) . '.png';
            $namabaru = substr(trim($this->input->post('faid')), 0, 11) . $akhiran;
            // $Dir = FCPATH . "assets\\temp\\";						
            // rename($Dir.$namalama, $Dir.$namabaru);
            $this->session->set_flashdata('msg', 'Mutation assets success !!!');
            return $namabaru;
        } else {
            $this->session->set_flashdata('msg', 'Mutation assets failed !!!');
        }
    }

    function getCounter($type, $class, $branch, $divisi, $lokasi) {
        $this->db2 = $this->load->database('config1', true);
        if ($lokasi == 'pusat') {
            $tempat = " AND req.BranchID=" . $branch . " AND req.DivisionID=" . $divisi;
            $code = $this->getCodeDivisi($divisi);
        } else {
            $tempat = " AND req.BranchID=" . $branch;
            $code = $this->getCodeBranch($branch);
        }


        $division = $this->db2->query("SELECT TOP 1 trx.FAID, SUBSTRING(trx.FAID, 17, 3) as counter
										FROM Trx_DetItemReq trx
										INNER JOIN Mst_ItemList item ON trx.ItemID = item.ItemID
										INNER JOIN Mst_ItemType type ON item.ItemTypeID = type.ItemTypeID
										INNER JOIN Mst_ItemClass class ON item.IClassID = class.IClassID
										INNER JOIN Mst_Request req ON trx.RequestID = req.RequestID
										WHERE type.TypeCode=" . $type . "  AND class.ClassCode=" . $class . "" . $tempat . "
										OR (CAST(SUBSTRING(trx.FAID, 1, 5) AS NVARCHAR)  = '" . trim($class) . "" . trim($type) . "' AND CAST(SUBSTRING(trx.FAID, 12, 5) AS NVARCHAR) = '" . trim($code) . "' )										
										GROUP BY trx.FAID
										ORDER BY MAX(trx.FAID)DESC");
        if (!empty($division->row())) {
            return $division->row()->counter;
        } else {
            return 0;
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

    function getBranchFromCode($id) {
        $this->db2 = $this->load->database('config1', true);
        $data = $this->db2->query("SELECT br.BranchName , div.DivisionName, br.BranchCode
									FROM Mst_Branch br
									LEFT JOIN Mst_Division div ON div.BranchID = br.BranchID									
									where br.Is_trash=0 AND (br.BranchCode=" . $id . " OR div.DivisionCode=" . $id . ")");
        return $data->row();
    }

}

?>