<?php

Class Mutation_mdl extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function seldata($num, $offset, $src_category = null, $src = null) {
        //Koneksi keSQL SERVER
        $this->db2 = $this->load->database('config1', true);
        // PENMABAHAN DEWI  22 AGUSTUS 2017

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

        //END PENAMBAHAN DEWI
//        $lokasi = $this->getLokasi($this->session->userdata('user_id'));
//        $data = '';
//        if ($this->session->userdata('groupid') != 1) {
//            if ((int) $lokasi->BranchCode == 00000)
//                $data = 'and req.BranchID=' . $lokasi->BranchID . ' and req.DivisionID=' . $lokasi->DivisionID;
//            else
//                $data = 'and req.BranchID=' . $lokasi->BranchID;
//        }

        if ($src != null) {
            $date = " and dep.Date like '%" . date('Y-m') . "%'";
            if ($src_category == 'BranchName') {
                $src_category = 'br.BranchName';
                $src = "like '%" . $src . "%'";
            } elseif ($src_category == 'ItemName') {
                $src_category = 'item.ItemName';
                $src = "like '%" . $src . "%'";
            } elseif ($src_category == 'Value') {
                $src_category = 'dep.Value';
                $src = "=" . $src . "";
            } elseif ($src_category == 'Value1') {
                $src_category = 'dep.Value';
                $src = "=" . $src . "";
                $date = "and dep.Date <= '" . date('Y-m-d') . "'";
            }

            $querydata = $this->db2->query("SELECT item.ItemName, zone.ZoneName, br.BranchName, br.BranchCode,  div.DivisionName, trx.QTY, trx.Raw_ID, trx.FAID, trx.Period, dep.Value, trx.PriceVendor, trx.SetDatePayment, trx.Condition,bis.BisUnitName
												FROM Trx_DetItemReq trx
												INNER JOIN Mst_ItemList item ON trx.ItemID = item.ItemID
												INNER JOIN Mst_Request req ON trx.RequestID = req.RequestID
												INNER JOIN Mst_Branch br ON req.BranchID = br.BranchID												
												LEFT JOIN Mst_Division div ON req.DivisionID = div.DivisionID
												INNER JOIN Mst_Zonasi zone ON req.ZoneID = zone.ZoneID
                                                                                                LEFT JOIN Mst_BisUnit bis ON SUBSTRING(trx.FAID,12,5) = bis.BisUnitCode
												LEFT JOIN Depreciation dep ON (trx.FAID = dep.TrxDetItemID " . $date . ")
												where trx.Is_trash=0 and trx.Status=3 and trx.StatusLelang=0 and item.AssetType='CAPEX'" . $data . "
												and " . $src_category . " " . $src . " ORDER BY zone.ZoneID ");
        } else {
            if ($offset != null) {
                $of = $offset;
            } else {
                $of = 0;
            }

            $querydata = $this->db2->query("SELECT item.ItemName, zone.ZoneName, br.BranchName, br.BranchCode,  div.DivisionName, trx.QTY, trx.Raw_ID, trx.FAID, trx.Period, dep.Value, trx.PriceVendor, trx.SetDatePayment, trx.Condition,bis.BisUnitName
												FROM Trx_DetItemReq trx
												INNER JOIN Mst_ItemList item ON trx.ItemID = item.ItemID
												INNER JOIN Mst_Request req ON trx.RequestID = req.RequestID
												INNER JOIN Mst_Branch br ON req.BranchID = br.BranchID																					
												LEFT JOIN Mst_Division div ON req.DivisionID = div.DivisionID
												INNER JOIN Mst_Zonasi zone ON req.ZoneID = zone.ZoneID
                                                                                                LEFT JOIN Mst_BisUnit bis ON SUBSTRING(trx.FAID,12,5) = bis.BisUnitCode
												LEFT JOIN Depreciation dep ON (trx.FAID = dep.TrxDetItemID and dep.Date like '%" . date('Y-m') . "%')
												where trx.Is_trash=0 and trx.Status=3 and trx.StatusLelang=0 and item.AssetType='CAPEX'" . $data . " 
				                                ORDER BY zone.ZoneID OFFSET $of ROWS FETCH NEXT $num ROWS ONLY ");
        }
        return $querydata->result();
        $querydata->close();
    }

    function jumlah() {
        $this->db2 = $this->load->database('config1', true);
        $lokasi = $this->getLokasi($this->session->userdata('user_id'));
        $dat = '';
        // PENMABAHAN DEWI  22 AGUSTUS 2017
        //if ($this->session->userdata('groupid') != 1) {
        $div = $this->session->userdata('DivisionID');
        $branch = $this->session->userdata('BranchID');
        $usergroup = $this->session->userdata('groupid');
        if ($branch == 1) { //JIKA PUSAT : semua ppi bisa lihat data kecuali ppi dengan usergroup support
            if (($div == '8' && $usergroup <> '3') || $div == '20' || $usergroup == '1') {
                $dat = '';
            } else {
                $dat = 'AND req.DivisionID=' . "$div";
            }
        } else { //JIKA CABANG : cabang hanya bisa melihat cabang dan divisinya saja
            $dat = ' AND req.BranchID=' . "$branch";
        }

        //END PENAMBAHAN DEWI
//        if ($this->session->userdata('groupid') != 1) {
//            if ((int) $lokasi->BranchCode == 00000)
//                $dat = 'and req.BranchID=' . $lokasi->BranchID . ' and req.DivisionID=' . $lokasi->DivisionID;
//            else
//                $dat = 'and req.BranchID=' . $lokasi->BranchID;
//        }

        $data = $this->db2->query("SELECT COUNT(trx.Raw_ID) AS jml 
									FROM Trx_DetItemReq trx
									INNER JOIN Mst_ItemList item ON trx.ItemID = item.ItemID
									INNER JOIN Mst_Request req ON trx.RequestID = req.RequestID
									where trx.Is_trash=0 and trx.Status=3 and item.AssetType='CAPEX' and trx.StatusLelang=0 " . $dat . "");
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

    function getbranch($id) {
        $this->db2 = $this->load->database('config1', true);
        $data = $this->db2->query('SELECT BranchName FROM Mst_Branch where Is_trash=0 AND BranchID=' . $id);
        return $data->row()->BranchName;
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

}

?>