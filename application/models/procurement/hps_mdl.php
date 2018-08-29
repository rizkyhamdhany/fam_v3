<?php

Class Hps_mdl extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function seldata($id, $num, $offset, $src_category = null, $src = null) {
        //Koneksi keSQL SERVER
        $this->db2 = $this->load->database('config1', true);
        $zone = $this->getZoneID($this->session->userdata('id_user'));
        //echo $id;
        if ($id == '0') {
            if (!empty($this->session->userdata('zone_src'))) {
                $zone = 'AND hps.ZoneID=' . $id;
            } else {
                if ($this->session->userdata('groupid') != 1) {
                    $zone = 'AND hps.ZoneID=' . $zone->ZoneID;
                } else {
                    $zone = ' ';
                }
            }
        } else {
            $zone = 'AND hps.ZoneID=' . $id;
        }

//                echo 'melehoy ->'.$this->session->userdata('zone_src');
        if ($src != null) {
            if ($src_category == 'ItemID')
                $src_category = 'item.ItemName';
            elseif ($src_category == 'ZoneID')
                $src_category = 'zone.ZoneName';

            $division = $this->db2->query("SELECT hps.HpsID, hps.StartDate, hps.EndDate , hps.Price, item.ItemName, zone.ZoneName FROM Mst_HPS hps 
				INNER JOIN Mst_ItemList item ON hps.ItemID = item.ItemID
				INNER JOIN Mst_Zonasi zone ON hps.ZoneID = zone.ZoneID
				where hps.Is_trash=0 " . $zone . "  and $src_category like '%$src%' 
				ORDER BY zone.ZoneID");
            return $division->result();
        }else {
            if ($offset != null) {
                $of = $offset;
            } else {
                $of = 0;
            }
            $division = $this->db2->query("SELECT hps.HpsID, hps.StartDate, hps.EndDate , hps.Price, item.ItemName, zone.ZoneName FROM Mst_HPS hps 
				INNER JOIN Mst_ItemList item ON hps.ItemID = item.ItemID
				INNER JOIN Mst_Zonasi zone ON hps.ZoneID = zone.ZoneID
				where hps.Is_trash=0 " . $zone . " 
				ORDER BY zone.ZoneID OFFSET $of ROWS FETCH NEXT $num ROWS ONLY ");


//                        $division = "SELECT hps.HpsID, hps.StartDate, hps.EndDate , hps.Price, item.ItemName, zone.ZoneName FROM Mst_HPS hps 
//				INNER JOIN Mst_ItemList item ON hps.ItemID = item.ItemID
//				INNER JOIN Mst_Zonasi zone ON hps.ZoneID = zone.ZoneID
//				where hps.Is_trash=0 ".$zone." 
//				ORDER BY zone.ZoneID OFFSET $of ROWS FETCH NEXT $num ROWS ONLY ";
//                        die($division);
            // where hps.Is_trash=0 ".$zone." AND CONVERT(VARCHAR(10),hps.StartDate,120) LIKE '".date('Y-m')."%'

            return $division->result();
        }
        $division->close();
    }

    function seldetil($id) {
        $db2 = $this->load->database('config1', true);
        $division = $db2->query('SELECT hps.HpsID,hps.ZoneID, hps.StartDate, hps.EndDate, hps.Price, item.ItemID, item.ItemName, class.IClassID, type.ItemTypeID
								FROM Mst_HPS hps
								INNER JOIN Mst_ItemList item ON hps.ItemID = item.ItemID
								INNER JOIN Mst_ItemType type ON item.ItemTypeID = type.ItemTypeID
								INNER JOIN Mst_ItemClass class ON type.IClassID = class.IClassID
								Where hps.Is_trash = 0 AND hps.HpsID = ' . $id . '');
        if (count($division) > 0) {
            return $division->result();
        } else {
            return false;
        }
        $division->close();
    }

    function savedata($ItemID, $price, $bulan, $zona) {

        $this->db2 = $this->load->database('config1', true);
        $tgl = explode("-", $this->input->post('start'));

        $this->db2->query("IF NOT EXISTS ( SELECT ItemID FROM Mst_HPS WHERE ItemID = '" . $ItemID . "' AND ZoneID = '" . $zona . "' AND  CONVERT(VARCHAR(10),StartDate,120) LIKE '" . $bulan . "%' )
					BEGIN
					    INSERT INTO Mst_HPS (ItemID, ZoneID, StartDate, EndDate, CreateDate, CreateBy, Is_trash,Price) VALUES 
					    ('" . $ItemID . "', '" . $this->input->post('zone') . "', '" . $tgl[0] . "','" . $tgl[1] . "',
					    	'" . date('Y-m-d H:i:s') . "','" . $this->session->userdata('id_user') . "','0','" . str_replace(",", "", $price) . "')
					END
					ELSE 
					BEGIN 
					    UPDATE Mst_HPS 
					    SET ZoneID = '" . $this->input->post('zone') . "', StartDate = '" . $tgl[0] . "',
					    EndDate = '" . $tgl[1] . "', UpdateDate ='" . date('Y-m-d H:i:s') . "' , UpdateBy = '" . $this->session->userdata('id_user') . "', Price = '" . str_replace(",", "", $price) . "'
					    WHERE ItemID = " . $ItemID . " AND ZoneID='" . $zona . "'
					END ");
        // $this->db2->insert('Mst_HPS',$divisiondata);
        $this->db2->close();
    }

    function updatedata($id,$sZone) {
        $divisiondata = array(
            // 'ItemID'=>$this->input->post('item'),
            'ZoneID' => $sZone,
            'StartDate' => date('Y-m-d', strtotime($this->input->post('StartDate'))),
            'EndDate' => date('Y-m-d', strtotime($this->input->post('EndDate'))),
            'UpdateDate' => date('Y-m-d H:i:s'),
            'UpdateBy' => $this->session->userdata('id_user'),
            'Price' => str_replace(",", "", $this->input->post('price'))
        );
        $this->db2 = $this->load->database('config1', true);
        $this->db2->where('HpsID', $id);
        $this->db2->update('Mst_HPS', $divisiondata);
        if ($this->db2->trans_status() === FALSE) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
        $this->db2->close();
    }

    function deletedata($id) {
        $data = array(
            'Is_trash' => 1,
            'DeleteDate' => date('Y-m-d H:i:s'),
            'DeleteBy' => $this->session->userdata('id_user')
        );
        $this->db2 = $this->load->database('config1', true);
        $this->db2->trans_begin();
        $this->db2->where('HpsID', $id);
        $this->db2->update('Mst_HPS', $data);
        if ($this->db2->trans_status() === FALSE) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
        $this->db2->close();
    }

    function jumlah($id) {
        $this->db2 = $this->load->database('config1', true);

        if ($this->session->userdata('groupid') == 1) {
            // $division = $this->db2->query("SELECT COUNT(HpsID) AS jml FROM Mst_HPS where Is_trash=0 AND CONVERT(VARCHAR(10),StartDate,120) LIKE '".date('Y-m')."%'");		
            $division = $this->db2->query("SELECT COUNT(HpsID) AS jml FROM Mst_HPS where Is_trash=0");
        } else {
            //$zone = $this->getZoneID($this->session->userdata('id_user'));
            // $division = $this->db2->query("SELECT COUNT(HpsID) AS jml FROM Mst_HPS where Is_trash=0 AND ZoneID=".$zone->ZoneID." AND CONVERT(VARCHAR(10),StartDate,120) LIKE '".date('Y-m')."%'");
            $division = $this->db2->query("SELECT COUNT(HpsID) AS jml FROM Mst_HPS where Is_trash=0 AND ZoneID=" . $id . "");
        }
        return $division->result();
    }

    function getclass() {
        $this->db2 = $this->load->database('config1', true);
        $division = $this->db2->query('SELECT IClassID, IClassName  FROM Mst_ItemClass where Is_trash=0');
        return $division->result();
    }

    function gettype($class) {
        $this->db2 = $this->load->database('config1', true);
        $division = $this->db2->query('SELECT ItemTypeID, ItemTypeName  FROM Mst_ItemType where Is_trash=0 AND IClassID=' . $class);
        return $division->result();
    }

    function getitem($type) {
        $this->db2 = $this->load->database('config1', true);
        $division = $this->db2->query('SELECT ItemID, ItemName FROM Mst_ItemList where Is_trash=0 AND ItemTypeID=' . $type);
        return $division->result();
    }

    function getzone() {
        $this->db2 = $this->load->database('config1', true);
        $division = $this->db2->query('SELECT ZoneID, ZoneName  FROM Mst_Zonasi where Is_trash=0');
        return $division->result();
    }

    function getzone2($zone) {
        $this->db2 = $this->load->database('config1', true);
        $division = $this->db2->query("SELECT ZoneID, ZoneName  FROM Mst_Zonasi where Is_trash=0 and zoneID='$zone' ");
        return $division->result();
    }

    function getzone3() {
        $this->db2 = $this->load->database('config1', true);
        $division = $this->db2->query('SELECT ZoneID, ZoneName  FROM Mst_Zonasi where Is_trash=0');
        return $division->result();
    }

    function getItemType($class) {
        $this->db2 = $this->load->database('config1', true);
        $division = $this->db2->query('SELECT ItemTypeID, ItemTypeName  FROM Mst_ItemType where Is_trash=0 AND IClassID=' . $class . '');
        return $division->result();
    }

    function getItemList($type) {
        $this->db2 = $this->load->database('config1', true);
        $division = $this->db2->query('SELECT ItemID, ItemName  FROM Mst_ItemList where Is_trash=0 AND ItemTypeID=' . $type . '');
        return $division->result();
    }

    function getZoneID($userID) {
        $this->db2 = $this->load->database('config1', true);

        $division = $this->db2->query('SELECT a.ZoneID FROM Mst_Employee b
										INNER JOIN Mst_Branch a ON b.BranchID = a.BranchID
										Where b.EmployeeID=' . $userID . '');
        return $division->row();
    }

    function gethpsitem($class) {
        $this->db2 = $this->load->database('config1', true);
        $division = $this->db2->query('SELECT ItemID, ItemName, Image FROM Mst_ItemList WHERE IClassID=' . $class . ' AND Is_trash=0');
        return $division->result();
    }

    function getAllItem() {
        $this->db2 = $this->load->database('config1', true);
        $division = $this->db2->query('SELECT ItemID,ItemName FROM Mst_ItemList WHERE Is_trash=0');
        return $division->result();
    }

    function simpanData($zone, $itemid, $nama, $price, $start, $end) {
        $this->db2 = $this->load->database('config1', true);
        $this->db2->query("IF NOT EXISTS ( SELECT ItemID FROM Mst_HPS WHERE ItemID = '" . $itemid . "' AND ZoneID = '" . $zone . "' )
                BEGIN
                    INSERT INTO Mst_HPS (ItemID, ZoneID, StartDate, EndDate, CreateDate, CreateBy, Is_trash,Price) VALUES 
                    ('" . $itemid . "', '" . $zone . "', '" . date('Y-m-d H:i:s', strtotime($start)) . "','" . date('Y-m-d H:i:s', strtotime($end)) . "',
                        '" . date('Y-m-d H:i:s') . "','" . $this->session->userdata('id_user') . "','0','" . str_replace(",", "", $price) . "')
                END
                ELSE 
                BEGIN 
                    UPDATE Mst_HPS 
                    SET ZoneID = '" . $zone . "', StartDate = '" . date('Y-m-d H:i:s', strtotime($start)) . "',
                    EndDate = '" . date('Y-m-d H:i:s', strtotime($end)) . "', UpdateDate ='" . date('Y-m-d H:i:s') . "' , UpdateBy = '" . $this->session->userdata('id_user') . "', Price = '" . str_replace(",", "", $price) . "'
                    WHERE ItemID = " . $itemid . " AND ZoneID='" . $zone . "'
                END ");
    }

    // PENAMBAHAN WILLY 16 AGUSTUS
    function updateDatas($zone, $itemid, $nama, $price, $start, $end) {
        $sql_price = "";
        $sql_start = "";
        $sql_end = "";
        $p = 0;
        $q = 0;
        $r = 0;
        if ($nama != '-' || $nama != '') {
            
        }
        if ($price != '-' || $price != 0) {
            $sql_price = " Price = '" . str_replace(",", "", $price) . "' ,";
            $p = 1;
        }
        if ($start != '-' || $start != 0) {
            $sql_start = " StartDate = '" . date('Y-m-d H:i:s', strtotime($start)) . "', ";
            $q = 1;
        }
        if ($end != '-' || $end != 0) {
            $sql_end = " EndDate = '" . date('Y-m-d H:i:s', strtotime($end)) . "', ";
            $r = 1;
        }
        if ($p == 0 && $q == 0 && $r == 0) {
            $sql_price = "";
        }

        $this->db2 = $this->load->database('config1', true);

        $sql_cek = $this->db2->query("SELECT count(ItemID) as jml FROM Mst_HPS WHERE ItemID = '" . $itemid . "' AND ZoneID = '" . $zone . "' ");
        $cek = $sql_cek->result()[0]->jml;
//		 echo $cek."<br>";
        //JIKA ITEMID DAN ZONA SUDAH ADA : UPDATE
        if ($cek > 0) {
            $this->db2 = $this->load->database('config1', true);
            $this->db2->query("
					    UPDATE Mst_HPS 
					    SET ZoneID = '" . $zone . "', $sql_start $sql_end $sql_price
					    UpdateDate ='" . date('Y-m-d H:i:s') . "' , UpdateBy = '" . $this->session->userdata('id_user') . "'
					    WHERE ItemID = " . $itemid . " AND ZoneID='" . $zone . "'
					");
        } else {
            //JIKA ITEMID DAN ZONA BELUM ADA : INSERT
            // echo "string";
            $this->db2 = $this->load->database('config1', true);
            $this->db2->query("
					   INSERT INTO Mst_HPS (ItemID, ZoneID, StartDate, EndDate, CreateDate, CreateBy, Is_trash,Price) VALUES 
		 			    ('" . $itemid . "', '" . $zone . "', '" . date('Y-m-d H:i:s', strtotime($start)) . "','" . date('Y-m-d H:i:s', strtotime($end)) . "',
		 			    	'" . date('Y-m-d H:i:s') . "','" . $this->session->userdata('id_user') . "','0','" . str_replace(",", "", $price) . "')
					");
        }

        return $this->db2->trans_status();

        // $this->db2 ->query("IF NOT EXISTS ( SELECT ItemID FROM Mst_HPS WHERE ItemID = '".$itemid."' AND ZoneID = '".$zone."' )
        // 			BEGIN
        // 			    INSERT INTO Mst_HPS (ItemID, ZoneID, StartDate, EndDate, CreateDate, CreateBy, Is_trash,Price) VALUES 
        // 			    ('".$itemid."', '".$zone."', '".date('Y-m-d H:i:s', strtotime($start))."','".date('Y-m-d H:i:s', strtotime($end))."',
        // 			    	'".date('Y-m-d H:i:s')."','".$this->session->userdata('id_user')."','0','".str_replace(",", "", $price)."')
        // 			END
        // 			ELSE 
        // 			BEGIN 
        // 			    UPDATE Mst_HPS 
        // 			    SET ZoneID = '".$zone."', StartDate = '".date('Y-m-d H:i:s', strtotime($start))."',
        // 			    EndDate = '".date('Y-m-d H:i:s', strtotime($end))."', UpdateDate ='".date('Y-m-d H:i:s')."' , UpdateBy = '".$this->session->userdata('id_user')."', Price = '".str_replace(",", "", $price)."'
        // 			    WHERE ItemID = ".$itemid." AND ZoneID='".$zone."'
        // 			END ");
    }

    //END
}

?>