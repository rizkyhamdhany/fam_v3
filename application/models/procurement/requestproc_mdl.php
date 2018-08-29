<?php

Class Requestproc_mdl extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function seldata($num, $offset, $src_category = null, $src = null) {
        $sesid = $this->session->userdata('user_id');
        $this->db2 = $this->load->database('config1', true);
        $usergroup = $this->session->userdata('groupid');
        $branch = $this->session->userdata('BranchID');
        if ($branch == 1) { //JIKA PUSAT : semua ppi bisa lihat data kecuali ppi dengan usergroup support
            $branch = '';
        } else { //JIKA CABANG : cabang hanya bisa melihat cabang dan divisinya saja
            $branch = ' AND a.BranchID=' . "$branch";
        }
        if ($usergroup == '2') {
            if ($src != null) {

                $qdata = $this->db2->query("SELECT a.Direktory_PR,a.RequestID,ISNULL(e.DivisionCode,f.BranchCode) as DivisionCode,a.DeleteDate,a.Is_trash,a.Jenis_periode_sewa,a.Jangka_waktu,a.Termin_sewa,a.RequestID,a.BudgetCOA,a.CreateDate, a.Status,b.ReqCategoryName,c.ReqTypeName,d.EmployeeName,e.DivisionName,f.BranchCode,f.BranchName,g.RktName
				   FROM Mst_Request a
				   LEFT JOIN Mst_RequestCategory b ON a.ReqCategoryID=b.ReqCategoryID 
				   LEFT JOIN Mst_RequestType c ON a.ReqTypeID=c.ReqTypeID
				   LEFT JOIN Mst_Employee d ON a.CreateBy=d.EmployeeID
				   LEFT JOIN Mst_Division e ON a.DivisionID=e.DivisionID
				   LEFT JOIN Mst_Branch f ON a.BranchID=f.BranchID
				   LEFT JOIN Mst_Rkt g ON a.RktID=g.RktID
				   WHERE  a.Is_trash in (0,1) and a.Is_Migrasi=0 $branch and ( LOWER($src_category) like LOWER('%$src%') or LOWER(ReqCategoryName) like LOWER('%$src%') or LOWER(RktName) like LOWER('%$src%') ) ");
            } else {
                if ($offset != null) {
                    $of = $offset;
                } else {
                    $of = 0;
                }
                $qdata = $this->db2->query("SELECT a.Direktory_PR,a.RequestID,ISNULL(e.DivisionCode,f.BranchCode) as DivisionCode,a.DeleteDate,a.Is_trash,a.Jenis_periode_sewa,a.Jangka_waktu,a.Termin_sewa,a.RequestID,a.BudgetCOA,a.CreateDate, a.Status,b.ReqCategoryName,c.ReqTypeName,d.EmployeeName,e.DivisionName,f.BranchCode,f.BranchName,g.RktName
                                           FROM Mst_Request a
                                           LEFT JOIN Mst_RequestCategory b ON a.ReqCategoryID=b.ReqCategoryID 
                                           LEFT JOIN Mst_RequestType c ON a.ReqTypeID=c.ReqTypeID
                                           LEFT JOIN Mst_Employee d ON a.CreateBy=d.EmployeeID
                                           LEFT JOIN Mst_Division e ON a.DivisionID=e.DivisionID
                                           LEFT JOIN Mst_Branch f ON a.BranchID=f.BranchID
                                           LEFT JOIN Mst_Rkt g ON a.RktID=g.RktID
                                           WHERE  a.Is_trash in (0,1) and a.Is_Migrasi=0 $branch ORDER BY a.RequestID DESC OFFSET $of ROWS FETCH NEXT $num ROWS ONLY ");
            }
        } else {
            if ($src != null) {

                $qdata = $this->db2->query("SELECT a.Direktory_PR,a.RequestID,ISNULL(e.DivisionCode,f.BranchCode) as DivisionCode,a.DeleteDate,a.Is_trash,a.Jenis_periode_sewa,a.Jangka_waktu,a.Termin_sewa,a.RequestID,a.BudgetCOA,a.CreateDate, a.Status,b.ReqCategoryName,c.ReqTypeName,d.EmployeeName,e.DivisionName,f.BranchCode,f.BranchName,g.RktName
				   FROM Mst_Request a
				   LEFT JOIN Mst_RequestCategory b ON a.ReqCategoryID=b.ReqCategoryID 
				   LEFT JOIN Mst_RequestType c ON a.ReqTypeID=c.ReqTypeID
				   LEFT JOIN Mst_Employee d ON a.CreateBy=d.EmployeeID
				   LEFT JOIN Mst_Division e ON a.DivisionID=e.DivisionID
				   LEFT JOIN Mst_Branch f ON a.BranchID=f.BranchID
				   LEFT JOIN Mst_Rkt g ON a.RktID=g.RktID
				   WHERE a.Is_trash in (0,1) and a.Is_Migrasi=0 and  a.EmployeeID=" . $sesid . " and  ( LOWER($src_category) like LOWER('%$src%') or LOWER(ReqCategoryName) like LOWER('%$src%') or LOWER(RktName) like LOWER('%$src%') ) ");
            } else {
                if ($offset != null) {
                    $of = $offset;
                } else {
                    $of = 0;
                }
                $qdata = $this->db2->query("SELECT a.Direktory_PR,a.RequestID,ISNULL(e.DivisionCode,f.BranchCode) as DivisionCode,a.DeleteDate,a.Is_trash,a.Jenis_periode_sewa,a.Jangka_waktu,a.Termin_sewa,a.RequestID,a.BudgetCOA,a.CreateDate, a.Status,b.ReqCategoryName,c.ReqTypeName,d.EmployeeName,e.DivisionName,f.BranchCode,f.BranchName,g.RktName
                                           FROM Mst_Request a
                                           LEFT JOIN Mst_RequestCategory b ON a.ReqCategoryID=b.ReqCategoryID 
                                           LEFT JOIN Mst_RequestType c ON a.ReqTypeID=c.ReqTypeID
                                           LEFT JOIN Mst_Employee d ON a.CreateBy=d.EmployeeID
                                           LEFT JOIN Mst_Division e ON a.DivisionID=e.DivisionID
                                           LEFT JOIN Mst_Branch f ON a.BranchID=f.BranchID
                                           LEFT JOIN Mst_Rkt g ON a.RktID=g.RktID
                                           WHERE  a.Is_trash in (0,1) and a.Is_Migrasi=0 and a.EmployeeID=" . $sesid . " ORDER BY a.RequestID DESC OFFSET $of ROWS FETCH NEXT $num ROWS ONLY ");
            }
        }

        return $qdata->result();
        $qdata->close();
    }

    function seldetil($id) {
        $db2 = $this->load->database('config1', true);
        $qdata = $this->db->query("SELECT a.file_vendor,a.DeleteDate,a.Is_trash,a.Keterangan_hapus,f.DivisionCode,f.DivisionName,
                    a.Jenis_periode_sewa,a.Jangka_waktu,a.Termin_sewa,a.RequestID,a.PriodSewa,a.CreateDate,a.Jtempo_sewa,a.Termin_sewa,
                    b.ReqCategoryName,c.ReqTypeID,c.ReqTypeName,d.EmployeeName,e.BranchName 
                    FROM Mst_Request a
                    INNER JOIN Mst_RequestCategory b ON a.ReqCategoryID=b.ReqCategoryID 
                    INNER JOIN Mst_RequestType c ON a.ReqTypeID=c.ReqTypeID
                    INNER JOIN Mst_Employee d ON a.EmployeeID=d.EmployeeID
                    /*INNER JOIN Mst_Division e ON a.DivisionID=e.DivisionID*/
                    INNER JOIN Mst_Branch e ON a.BranchID=e.BranchID
                    Left Join Mst_Division f ON a.DivisionID=f.DivisionID 
                    WHERE /*a.Is_trash=0 and*/  a.RequestID=" . $id . "");
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    function info_aproval($id) {
        $db2 = $this->load->database('config1', true);
//                print_r("SELECT a.AppvStatus,a.AppvDate,b.EmployeeID,b.EmployeeName,b.image,c.PositionName FROM Appv_Request a
//						   LEFT JOIN Mst_Employee b ON a.Appvby=b.EmployeeID
//						   LEFT JOIN Mst_Position c ON a.PositionID=c.PositionID
//						   WHERE a.Is_trash=0 and a.RequestID=".$id."");die();
        $qdata = $db2->query("SELECT a.Vendor_win,d.ApprovalLevel,a.AppvStatus,a.AppvDate,b.EmployeeID,b.EmployeeName,b.image,c.PositionName 
                                        FROM Appv_Request a 
                                        LEFT JOIN Mst_Employee b ON a.Appvby=b.EmployeeID 
                                        LEFT JOIN Mst_Position c ON a.PositionID=c.PositionID 
                                        LEFT JOIN Appv_List d ON a.AppvID=d.AppvID 
                                        WHERE /*a.Is_trash=0 and */a.RequestID=" . $id . " order by d.ApprovalLevel asc");
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    function req_itemdetail($id) {
        $db2 = $this->load->database('config1', true);

        $qdata = $db2->query("SELECT a.ItemID,a.QTY,a.Price,a.Keterangan,b.AssetType,b.ItemName,b.Image 
                              FROM Trx_DetItemReq a
                              LEFT JOIN Mst_ItemList b ON a.ItemID=b.ItemID
			      WHERE /*a.Is_trash=0 and */a.RequestID=" . $id . " and a.Status IN(0,1,2,8)");
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    function selopt_item() {
        $db2 = $this->load->database('config1', true);
        $reqid = $this->session->userdata("requestid");
        if ($reqid != NULL) {
            //die('SELECT * FROM Mst_ItemList where Is_trash=0 and ReqCategoryID='.$reqid.'');
            $qdata = $db2->query('SELECT * FROM Mst_ItemList where Is_trash=0 and ReqCategoryID=' . $reqid . '');
        } else {
            //die('SELECT * FROM Mst_ItemList where Is_trash=0');
            $qdata = $db2->query('SELECT * FROM Mst_ItemList where Is_trash=0');
        }
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

//FUNCTION SELECT OPTION FORM-------------------------------------------------------------------------------------------------------->
    function selreqtype() {
        $db2 = $this->load->database('config1', true);
        if ($this->session->userdata('BranchID') == 1) {
            $qdata = $db2->query('SELECT * FROM Mst_RequestType where Is_trash=0 and ReqTypeID!=5 order by ReqTypeName DESC');
        } else {
            $qdata = $db2->query('SELECT * FROM Mst_RequestType where Is_trash=0 and ReqTypeID!=2 order by ReqTypeName DESC');
        }
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    /* PENGGUNAAN UNTUK SELECT OPTION REQUEST */

    function selreqcategory($reqtypeid) {
        $branchid = $this->session->userdata('BranchID');
        $divid = $this->session->userdata('DivisionID');

        if ($branchid == 1) {
            $querdiv = 'and b.DivisionID=' . $divid . '';
        } else {
            $querdiv = '';
        }
        $thn = date('Y');
        $db2 = $this->load->database('config1', true);
//		echo 'SELECT DISTINCT a.ReqCategoryID, a.ReqCategoryName,b.BudgetCOA,b.BudgetValue,b.BudgetUsed FROM Mst_RequestCategory a
//		    LEFT JOIN Mst_Budget b ON b.BudgetID=a.BudgetID
//		    WHERE a.Is_trash=0 and a.ReqTypeID='.$reqtypeid.' and b.BranchID='.$branchid.''.$querdiv.' and b.Year='.$thn.'';
//                die();
        $qdata = $db2->query('SELECT DISTINCT a.ReqCategoryID, a.ReqCategoryName,b.BudgetCOA,b.BudgetValue,b.BudgetUsed FROM Mst_RequestCategory a
		    LEFT JOIN Mst_Budget b ON b.BudgetID=a.BudgetID
		    WHERE a.Is_trash=0 and a.ReqTypeID=' . $reqtypeid . ' and b.BranchID=' . $branchid . '' . $querdiv . ' and b.Year=' . $thn . '');
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    /* PENGGUNAAN UNTUK SELECT OPTION RKT(RANCANGAN KERJATAHUNAN) */

    function sel_optrtk($reqCategotyid) {
        $branchID = $this->session->userdata('BranchID');
        //$zoneID=$this->session->userdata('BranchID');
        $db2 = $this->load->database('config1', true);
//                die('SELECT DISTINCT a.RktID, a.RktName,a.ZoneID FROM Mst_Rkt a
//						   LEFT JOIN Mst_RequestCategory b ON a.ReqCategoryID=b.ReqCategoryID
//						   WHERE a.Is_trash=0 and a.ReqCategoryID='.$reqCategotyid.' and a.BranchID='.$branchID.'');
        $qdata = $db2->query('SELECT DISTINCT a.RktID, a.RktName,a.ZoneID FROM Mst_Rkt a
						   LEFT JOIN Mst_RequestCategory b ON a.ReqCategoryID=b.ReqCategoryID
						   WHERE a.Is_trash=0 and a.ReqCategoryID=' . $reqCategotyid . ' and a.BranchID=' . $branchID . '');

        if (count($qdata) > 0) {

            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    /* PENGGUNAAN UNTUK SELECT OPTION EKSEKUTOR */

    function sel_opt_eksekutor($ZoneID) {
        $db2 = $this->load->database('config1', true);
//                die("SELECT * FROM Mst_Branch WHERE ZoneID='".$ZoneID."' and Is_trash=0");
        $qdata = $db2->query("SELECT * FROM Mst_Branch WHERE ZoneID='" . $ZoneID . "' and Is_trash=0");
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    function sel_chekdataitem($itemid) {

        $zona = $this->session->userdata('ZoneID');
        $dates = date('Y-m-d');
        $thn = date('Y');
        $mount = date('m');
        $db2 = $this->load->database('config1', true);
//                die("SELECT a.*,b.Price,c.ItemTypeName 
//							  FROM Mst_ItemList a
//							  	INNER JOIN Mst_HPS b ON b.ItemID=a.ItemID
//                                INNER JOIN Mst_Zonasi e ON e.ZoneID=b.ZoneID
//							  	INNER JOIN Mst_ItemType c ON c.ItemTypeID=a.ItemTypeID
//							  WHERE a.Is_trash=0 and e.ZoneID='".$zona."' and a.ItemID=".$itemid." and  b.StartDate<='$dates' and b.EndDate >='$dates'");

        $qdata = $db2->query("SELECT a.*,b.Price,c.ItemTypeName 
							  FROM Mst_ItemList a
							  	INNER JOIN Mst_HPS b ON b.ItemID=a.ItemID
                                INNER JOIN Mst_Zonasi e ON e.ZoneID=b.ZoneID
							  	INNER JOIN Mst_ItemType c ON c.ItemTypeID=a.ItemTypeID
							  WHERE a.Is_trash=0 and e.ZoneID='" . $zona . "' and a.ItemID=" . $itemid . " and  b.StartDate<='$dates' and b.EndDate >='$dates'");
//        print_r($qdata);die();
        //asli haris
//		$qdata = $db2->query("SELECT a.*,b.Price,c.ItemTypeName 
//							  FROM Mst_ItemList a
//							  	INNER JOIN Mst_HPS b ON b.ItemID=a.ItemID
//                                INNER JOIN Mst_Zonasi e ON e.ZoneID=b.ZoneID
//							  	INNER JOIN Mst_ItemType c ON c.ItemTypeID=a.ItemTypeID
//							  WHERE a.Is_trash=0 and e.ZoneID='".$zona."' and a.ItemID=".$itemid." and b.StartDate <=".$thn." AND b.StartDate >=".$mount.")");
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    /* END PENGGUNAAN UNTUK SELECT OPTION REQUEST */

    function selitemlist_jikaHPs_tdkperbulan($num, $offset, $ReqType, $reqCategotyid, $rktid, $zone, $srccat = NULL, $src = NULL) {
        $dates = date('Y-m-d');
        $thn = date('Y');
        $mount = date('m');
        $db2 = $this->load->database('config1', true);
        if ($offset != null) {
            $of = $offset;
        } else {
            $of = 0;
        }
        if ((int) $ReqType == 2 || (int) $ReqType == 5) {
            //jika Requesttype Project & Project Non Pusat-------------------------------------------------------->
            if ($srccat == "") {

                $qdata = $db2->query("SELECT DISTINCT c.ItemID,c.ItemName,c.Image,c.AssetType,e.ZoneID,e.ZoneName,d.Price,f.IClassName,g.ItemTypeName FROM Mst_Rkt a
					INNER JOIN Mst_RequestCategoryDetail b ON b.ReqCategoryID = a.ReqCategoryID
					INNER JOIN Mst_ItemList c ON c.IClassID=b.IClassID
					INNER JOIN Mst_HPS d ON d.ItemID=c.ItemID
					INNER JOIN Mst_Zonasi e ON e.ZoneID=d.ZoneID
					INNER JOIN Mst_ItemClass f ON f.IClassID=c.IClassID
					INNER JOIN Mst_ItemType g ON g.ItemTypeID=c.ItemTypeID
					where a.Is_trash=0 and c.Is_trash=0 and a.RktID=" . $rktid . " and e.ZoneID='" . $zone . "' and  d.StartDate<='$dates' and d.EndDate >='$dates' /*and (DATEPART(yy, d.StartDate) = " . $thn . " AND DATEPART(mm, d.StartDate) = " . $mount . ") */
					and a.ReqCategoryID='" . $reqCategotyid . "' and c.ItemName like '%" . $src . "%' ORDER BY c.ItemID OFFSET $of ROWS FETCH NEXT $num ROWS ONLY");
            } else {

                $qdata = $db2->query("SELECT DISTINCT c.ItemID,c.ItemName,c.Image,c.AssetType,e.ZoneID,e.ZoneName,d.Price,f.IClassName,g.ItemTypeName FROM Mst_Rkt a
					INNER JOIN Mst_RequestCategoryDetail b ON b.ReqCategoryID = a.ReqCategoryID
					INNER JOIN Mst_ItemList c ON c.IClassID=b.IClassID
					INNER JOIN Mst_HPS d ON d.ItemID=c.ItemID
					INNER JOIN Mst_Zonasi e ON e.ZoneID=d.ZoneID
					INNER JOIN Mst_ItemClass f ON f.IClassID=c.IClassID
					INNER JOIN Mst_ItemType g ON g.ItemTypeID=c.ItemTypeID
					where a.Is_trash=0 and c.Is_trash=0 and a.RktID=" . $rktid . " and e.ZoneID='" . $zone . "' and  d.StartDate<='$dates' and d.EndDate >='$dates' /*and (DATEPART(yy, d.StartDate) = " . $thn . " AND DATEPART(mm, d.StartDate) = " . $mount . ")*/
					and a.ReqCategoryID='" . $reqCategotyid . "' and b.IClassID='" . $srccat . "' and c.ItemName like '%" . $src . "%' ORDER BY c.ItemID OFFSET $of ROWS FETCH NEXT $num ROWS ONLY");
            }
        } else {

            if ($srccat == "") {
                $search = "and c.ItemName like '%" . $src . "%'";
            } else {
                $search = "and b.IClassID='" . $srccat . "' and c.ItemName like '%" . $src . "%'";
            }
            if ((int) $ReqType == 1) {
                $assetype = " and c.AssetType='OPEX'";
            } else {
                $assetype = "";
            }
//				 die("SELECT DISTINCT  c.ItemID,c.ItemName,c.Image,c.AssetType,e.ZoneID,e.ZoneName,d.Price,f.IClassName,g.ItemTypeName  FROM Mst_RequestCategory a
//					    INNER JOIN Mst_RequestCategoryDetail b ON b.ReqCategoryID = a.ReqCategoryID
//						INNER JOIN Mst_ItemList c ON c.IClassID=b.IClassID
//						INNER JOIN Mst_HPS d ON d.ItemID=c.ItemID
//						INNER JOIN Mst_Zonasi e ON e.ZoneID=d.ZoneID
//						INNER JOIN Mst_ItemClass f ON f.IClassID=c.IClassID
//						INNER JOIN Mst_ItemType g ON g.ItemTypeID=c.ItemTypeID
//						where a.Is_trash=0 and c.Is_trash=0 and e.ZoneID='".$zone."'and  d.StartDate<='$dates' and d.EndDate >='$dates' /*(DATEPART(yy, d.StartDate) = ".$thn." AND DATEPART(mm, d.StartDate) = ".$mount.") ".$assetype."*/
//						and a.ReqCategoryID='".$reqCategotyid."' ".$search."ORDER BY c.ItemID OFFSET $of ROWS FETCH NEXT $num ROWS ONLY
//				");	
            $qdata = $db2->query("SELECT DISTINCT  c.ItemID,c.ItemName,c.Image,c.AssetType,e.ZoneID,e.ZoneName,d.Price,f.IClassName,g.ItemTypeName  FROM Mst_RequestCategory a
					    INNER JOIN Mst_RequestCategoryDetail b ON b.ReqCategoryID = a.ReqCategoryID
						INNER JOIN Mst_ItemList c ON c.IClassID=b.IClassID
						INNER JOIN Mst_HPS d ON d.ItemID=c.ItemID
						INNER JOIN Mst_Zonasi e ON e.ZoneID=d.ZoneID
						INNER JOIN Mst_ItemClass f ON f.IClassID=c.IClassID
						INNER JOIN Mst_ItemType g ON g.ItemTypeID=c.ItemTypeID
						where a.Is_trash=0 and c.Is_trash=0 and e.ZoneID='" . $zone . "'and  d.StartDate<='$dates' and d.EndDate >='$dates'/* (DATEPART(yy, d.StartDate) = " . $thn . " AND DATEPART(mm, d.StartDate) = " . $mount . ") " . $assetype . "*/
						and a.ReqCategoryID='" . $reqCategotyid . "' " . $search . "ORDER BY c.ItemID OFFSET $of ROWS FETCH NEXT $num ROWS ONLY
				");
        }
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    function selitemlist_aris($num, $offset, $ReqType, $reqCategotyid, $rktid, $zone, $srccat = NULL, $src = NULL) {

        $thn = date('Y');
        $mount = date('m');
        $db2 = $this->load->database('config1', true);
        if ($offset != null) {
            $of = $offset;
        } else {
            $of = 0;
        }
        if ((int) $ReqType == 2 || (int) $ReqType == 5) {
            //jika Requesttype Project & Project Non Pusat-------------------------------------------------------->
            if ($srccat == "") {
                $qdata = $db2->query("SELECT DISTINCT c.ItemID,c.ItemName,c.Image,c.AssetType,e.ZoneID,e.ZoneName,d.Price,f.IClassName,g.ItemTypeName FROM Mst_Rkt a
					INNER JOIN Mst_RequestCategoryDetail b ON b.ReqCategoryID = a.ReqCategoryID
					INNER JOIN Mst_ItemList c ON c.IClassID=b.IClassID
					INNER JOIN Mst_HPS d ON d.ItemID=c.ItemID
					INNER JOIN Mst_Zonasi e ON e.ZoneID=d.ZoneID
					INNER JOIN Mst_ItemClass f ON f.IClassID=c.IClassID
					INNER JOIN Mst_ItemType g ON g.ItemTypeID=c.ItemTypeID
					where a.Is_trash=0 and c.Is_trash=0 and a.RktID=" . $rktid . " and e.ZoneID='" . $zone . "'and (DATEPART(yy, d.StartDate) = " . $thn . " AND DATEPART(mm, d.StartDate) = " . $mount . ") 
					and a.ReqCategoryID='" . $reqCategotyid . "' and c.ItemName like '%" . $src . "%' ORDER BY c.ItemID OFFSET $of ROWS FETCH NEXT $num ROWS ONLY");
            } else {

                $qdata = $db2->query("SELECT DISTINCT c.ItemID,c.ItemName,c.Image,c.AssetType,e.ZoneID,e.ZoneName,d.Price,f.IClassName,g.ItemTypeName FROM Mst_Rkt a
					INNER JOIN Mst_RequestCategoryDetail b ON b.ReqCategoryID = a.ReqCategoryID
					INNER JOIN Mst_ItemList c ON c.IClassID=b.IClassID
					INNER JOIN Mst_HPS d ON d.ItemID=c.ItemID
					INNER JOIN Mst_Zonasi e ON e.ZoneID=d.ZoneID
					INNER JOIN Mst_ItemClass f ON f.IClassID=c.IClassID
					INNER JOIN Mst_ItemType g ON g.ItemTypeID=c.ItemTypeID
					where a.Is_trash=0 and c.Is_trash=0 and a.RktID=" . $rktid . " and e.ZoneID='" . $zone . "'and (DATEPART(yy, d.StartDate) = " . $thn . " AND DATEPART(mm, d.StartDate) = " . $mount . ")
					and a.ReqCategoryID='" . $reqCategotyid . "' and b.IClassID='" . $srccat . "' and c.ItemName like '%" . $src . "%' ORDER BY c.ItemID OFFSET $of ROWS FETCH NEXT $num ROWS ONLY");
            }
        } else {

            if ($srccat == "") {
                $search = "and c.ItemName like '%" . $src . "%'";
            } else {
                $search = "and b.IClassID='" . $srccat . "' and c.ItemName like '%" . $src . "%'";
            }
            if ((int) $ReqType == 1 || (int) $ReqType == 2 || (int) $ReqType == 4) {
                $assetype = "";
            } else {
                $assetype = " and c.AssetType='OPEX'";
            }
//                                    die("SELECT DISTINCT  c.ItemID,c.ItemName,c.Image,c.AssetType,e.ZoneID,e.ZoneName,d.Price,f.IClassName,g.ItemTypeName  FROM Mst_RequestCategory a
//                                        INNER JOIN Mst_RequestCategoryDetail b ON b.ReqCategoryID = a.ReqCategoryID
//                                            INNER JOIN Mst_ItemList c ON c.IClassID=b.IClassID
//                                            INNER JOIN Mst_HPS d ON d.ItemID=c.ItemID
//                                            INNER JOIN Mst_Zonasi e ON e.ZoneID=d.ZoneID
//                                            INNER JOIN Mst_ItemClass f ON f.IClassID=c.IClassID
//                                            INNER JOIN Mst_ItemType g ON g.ItemTypeID=c.ItemTypeID
//                                            where a.Is_trash=0 and c.Is_trash=0 and e.ZoneID='".$zone."'and (DATEPART(yy, d.StartDate) = ".$thn." AND DATEPART(mm, d.StartDate) = ".$mount.") ".$assetype."
//                                            and a.ReqCategoryID='".$reqCategotyid."' ".$search."ORDER BY c.ItemID OFFSET $of ROWS FETCH NEXT $num ROWS ONLY
//                            ");
            $qdata = $db2->query("SELECT DISTINCT  c.ItemID,c.ItemName,c.Image,c.AssetType,e.ZoneID,e.ZoneName,d.Price,f.IClassName,g.ItemTypeName  FROM Mst_RequestCategory a
					    INNER JOIN Mst_RequestCategoryDetail b ON b.ReqCategoryID = a.ReqCategoryID
						INNER JOIN Mst_ItemList c ON c.IClassID=b.IClassID
						INNER JOIN Mst_HPS d ON d.ItemID=c.ItemID
						INNER JOIN Mst_Zonasi e ON e.ZoneID=d.ZoneID
						INNER JOIN Mst_ItemClass f ON f.IClassID=c.IClassID
						INNER JOIN Mst_ItemType g ON g.ItemTypeID=c.ItemTypeID
						where a.Is_trash=0 and c.Is_trash=0 and e.ZoneID='" . $zone . "'and (DATEPART(yy, d.StartDate) = " . $thn . " AND DATEPART(mm, d.StartDate) = " . $mount . ") " . $assetype . "
						and a.ReqCategoryID='" . $reqCategotyid . "' " . $search . "ORDER BY c.ItemID OFFSET $of ROWS FETCH NEXT $num ROWS ONLY
				");
        }
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    function selitemlist($num, $offset, $ReqType, $reqCategotyid, $rktid, $zone, $srccat = NULL, $src = NULL) {
        $dates = date('Y-m-d');
        $thn = date('Y');
        $mount = date('m');
        //die($ReqType);
        $db2 = $this->load->database('config1', true);
        if ($offset != null) {
            $of = $offset;
        } else {
            $of = 0;
        }
        if ((int) $ReqType == 2 || (int) $ReqType == 5) {
            //jika Requesttype Project & Project Non Pusat-------------------------------------------------------->
            if ($srccat == "") {

                $qdata = $db2->query("SELECT DISTINCT c.ItemID,c.ItemName,c.Image,c.AssetType,e.ZoneID,e.ZoneName,d.Price,f.IClassName,g.ItemTypeName FROM Mst_Rkt a
					INNER JOIN Mst_RequestCategoryDetail b ON b.ReqCategoryID = a.ReqCategoryID
					INNER JOIN Mst_ItemList c ON c.IClassID=b.IClassID
					INNER JOIN Mst_HPS d ON d.ItemID=c.ItemID
					INNER JOIN Mst_Zonasi e ON e.ZoneID=d.ZoneID
					INNER JOIN Mst_ItemClass f ON f.IClassID=c.IClassID
					INNER JOIN Mst_ItemType g ON g.ItemTypeID=c.ItemTypeID
					where a.Is_trash=0 and c.Is_trash=0 and a.RktID=" . $rktid . " and e.ZoneID='" . $zone . "' and  d.StartDate<='$dates' and d.EndDate >='$dates' /*and (DATEPART(yy, d.StartDate) = " . $thn . " AND DATEPART(mm, d.StartDate) = " . $mount . ") */
					and a.ReqCategoryID='" . $reqCategotyid . "' and c.ItemName like '%" . $src . "%' ORDER BY c.ItemID OFFSET $of ROWS FETCH NEXT $num ROWS ONLY");
            } else {

                $qdata = $db2->query("SELECT DISTINCT c.ItemID,c.ItemName,c.Image,c.AssetType,e.ZoneID,e.ZoneName,d.Price,f.IClassName,g.ItemTypeName FROM Mst_Rkt a
					INNER JOIN Mst_RequestCategoryDetail b ON b.ReqCategoryID = a.ReqCategoryID
					INNER JOIN Mst_ItemList c ON c.IClassID=b.IClassID
					INNER JOIN Mst_HPS d ON d.ItemID=c.ItemID
					INNER JOIN Mst_Zonasi e ON e.ZoneID=d.ZoneID
					INNER JOIN Mst_ItemClass f ON f.IClassID=c.IClassID
					INNER JOIN Mst_ItemType g ON g.ItemTypeID=c.ItemTypeID
					where a.Is_trash=0 and c.Is_trash=0 and a.RktID=" . $rktid . " and e.ZoneID='" . $zone . "' and  d.StartDate<='$dates' and d.EndDate >='$dates' /*and (DATEPART(yy, d.StartDate) = " . $thn . " AND DATEPART(mm, d.StartDate) = " . $mount . ")*/
					and a.ReqCategoryID='" . $reqCategotyid . "' and b.IClassID='" . $srccat . "' and c.ItemName like '%" . $src . "%' ORDER BY c.ItemID OFFSET $of ROWS FETCH NEXT $num ROWS ONLY");
            }
        } else {

            if ($srccat == "") {
                $search = "and c.ItemName like '%" . $src . "%'";
            } else {
                $search = "and b.IClassID='" . $srccat . "' and c.ItemName like '%" . $src . "%'";
            }
            if ((int) $ReqType == 1) {
                $assetype = "";
            } else {
                $assetype = "and c.AssetType='OPEX'";
            }
//				 die("SELECT DISTINCT  c.ItemID,c.ItemName,c.Image,c.AssetType,e.ZoneID,e.ZoneName,d.Price,f.IClassName,g.ItemTypeName  FROM Mst_RequestCategory a
//					    INNER JOIN Mst_RequestCategoryDetail b ON b.ReqCategoryID = a.ReqCategoryID
//						INNER JOIN Mst_ItemList c ON c.IClassID=b.IClassID
//						INNER JOIN Mst_HPS d ON d.ItemID=c.ItemID
//						INNER JOIN Mst_Zonasi e ON e.ZoneID=d.ZoneID
//						INNER JOIN Mst_ItemClass f ON f.IClassID=c.IClassID
//						INNER JOIN Mst_ItemType g ON g.ItemTypeID=c.ItemTypeID
//						where a.Is_trash=0 and c.Is_trash=0 and e.ZoneID='".$zone."'and  d.StartDate<='$dates' and d.EndDate >='$dates' /*(DATEPART(yy, d.StartDate) = ".$thn." AND DATEPART(mm, d.StartDate) = ".$mount.") ".$assetype."*/
//						and a.ReqCategoryID='".$reqCategotyid."' ".$search."ORDER BY c.ItemID OFFSET $of ROWS FETCH NEXT $num ROWS ONLY
//				");	
            $qdata = $db2->query("SELECT DISTINCT  c.ItemID,c.ItemName,c.Image,c.AssetType,e.ZoneID,e.ZoneName,d.Price,f.IClassName,g.ItemTypeName  FROM Mst_RequestCategory a
					    INNER JOIN Mst_RequestCategoryDetail b ON b.ReqCategoryID = a.ReqCategoryID
						INNER JOIN Mst_ItemList c ON c.IClassID=b.IClassID
						INNER JOIN Mst_HPS d ON d.ItemID=c.ItemID
						INNER JOIN Mst_Zonasi e ON e.ZoneID=d.ZoneID
						INNER JOIN Mst_ItemClass f ON f.IClassID=c.IClassID
						INNER JOIN Mst_ItemType g ON g.ItemTypeID=c.ItemTypeID
						where a.Is_trash=0 and c.Is_trash=0 and e.ZoneID='" . $zone . "'and  d.StartDate<='$dates' and d.EndDate >='$dates' " . $assetype . "/* (DATEPART(yy, d.StartDate) = " . $thn . " AND DATEPART(mm, d.StartDate) = " . $mount . ") */
						and a.ReqCategoryID='" . $reqCategotyid . "' " . $search . "ORDER BY c.ItemID OFFSET $of ROWS FETCH NEXT $num ROWS ONLY
				");
        }
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    function jumlahitem($ReqType, $reqCategotyid = null, $rktid, $srccategory = null, $src = null) {
        $dates = date('Y-m-d');
        $thn = date('Y');
        $mount = date('m');
        $zoneid = $this->session->userdata('ZoneID');
        $this->db2 = $this->load->database('config1', true);
        if ($srccategory != null) {
            $search = "and b.IClassID='" . $srccategory . "' and c.ItemName like '%" . $src . "%'";
        } else {
            $search = "and c.ItemName like '%" . $src . "%'";
        }
        if ((int) $ReqType == 2 || (int) $ReqType == 5) {

            $qdata = $this->db2->query("SELECT COUNT(c.ItemID) AS jml 
                    FROM Mst_Rkt a
                    INNER JOIN Mst_RequestCategoryDetail b ON b.ReqCategoryID = a.ReqCategoryID
                    INNER JOIN Mst_ItemList c ON c.IClassID = b.IClassID
                    INNER JOIN Mst_HPS d ON d.ItemID=c.ItemID
                    where a.RktID=$rktid and c.Is_trash=0 $search and c.Is_trash=0 and d.ZoneID=$zoneid and d.StartDate<='$dates' and d.EndDate >='$dates' /*(DATEPART(yy, d.StartDate) = '$thn' AND DATEPART(mm, d.StartDate) = '$mount')*/");
            return $qdata->result();
        } else {
            if ((int) $ReqType == 1) {
                $assetype = " and c.AssetType='OPEX'";
            } else {
                $assetype = "";
            }


            $qdata = $this->db2->query("SELECT COUNT(c.ItemID) AS jml 
										FROM Mst_RequestCategory a
										INNER JOIN Mst_RequestCategoryDetail b ON b.ReqCategoryID = a.ReqCategoryID
										INNER JOIN Mst_ItemList c ON c.IClassID = b.IClassID
										INNER JOIN Mst_HPS d ON d.ItemID = c.ItemID
										where a.ReqCategoryID=$reqCategotyid /*$assetype*/ and c.Is_trash=0 and d.ZoneID=$zoneid and d.StartDate<='$dates' and d.EndDate >='$dates' /*(DATEPART(yy, d.StartDate) = ' . $thn . ' AND DATEPART(mm, d.StartDate) = ' . $mount . ')*/");
            return $qdata->result();
        }
    }

    //END FUNCTION SELECT OPTION FORM----------------------------------------------------------------------------------------------------->
    function getOptClassItem($rktid = null, $zoneid, $ReqCatId, $ReqType) {
        //echo $ReqType;
        //if Project Filter---------------------------------------------------------------------------------->
        if ($ReqType == 2) {
            $this->db2 = $this->load->database('config1', true);
            $qdata = $this->db2->query('SELECT DISTINCT d.IClassID,d.IClassName 
									FROM Mst_Rkt a
									INNER JOIN Mst_RequestCategory b ON b.ReqCategoryID = a.ReqCategoryID
									INNER JOIN Mst_RequestCategoryDetail c ON c.ReqCategoryID = b.ReqCategoryID
									INNER JOIN Mst_ItemClass d ON d.IClassID = c.IClassID
									Where a.Is_trash = 0 AND a.RktID=' . $rktid . ' AND a.zoneid=' . $zoneid . ' AND b.ReqCategoryID=' . $ReqCatId . '');
            return $qdata->result();
        } else {
            //echo $ReqCatId;
            $this->db2 = $this->load->database('config1', true);
            $qdata = $this->db2->query('SELECT DISTINCT c.IClassID,c.IClassName 
									FROM Mst_RequestCategory a
									INNER JOIN Mst_RequestCategoryDetail b ON b.ReqCategoryID = a.ReqCategoryID
									INNER JOIN Mst_ItemClass c ON c.IClassID = b.IClassID
									Where a.Is_trash = 0 AND a.ReqCategoryID=' . $ReqCatId . '');
            return $qdata->result();
        }
    }

    /* SET SUBTOTAL UNTUK MENENTUKAN APROVAL BERDASARKAN SUBTOTAL */

    function sel_aprovcatx($subtotal) {
        $db2 = $this->load->database('config1', true);
        $qdata = $db2->query("SELECT AppvCategoryID FROM Appv_listCategory
		 WHERE Is_trash=0 and AppvCategoryMax >= " . $subtotal . " ORDER BY AppvCategoryID ASC /*OFFSET 0 ROWS FETCH NEXT 1 ROWS ONLY*/");
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    /* EDITED BY WILLY 5 agustus 2017 */

    function sel_aprovcat($subtotal) {
        $BranchID = $this->session->userdata('BranchID');
        if ($BranchID == 1) {
            $plc = "pusat";
        } else {
            $plc = "cabang";
        }$db2 = $this->load->database('config1', true);
        $qdata = $db2->query("SELECT A.AppvCategoryID FROM Appv_listCategory as A 
							INNER JOIN Appv_list as B ON A.AppvCategoryID=B.AppvCategoryID
							WHERE B.Is_trash=0 and A.AppvCategoryMax >=" . $subtotal . " 
							 and A.AppvCategoryMin <= " . $subtotal . " 
							 and B.place='" . $plc . "'  GROUP BY A.AppvCategoryID");
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    /* end EDITED BY WILLY 5 agustus 2017 */

    function sel_aprovallist($appvid) {
        $BranchID = $this->session->userdata('BranchID');
        if ($BranchID == 1) {
            $plc = "pusat";
        } else {
            $plc = "cabang";
        }
        $db2 = $this->load->database('config1', true);
        $qdata = $db2->query("SELECT * FROM Appv_list WHERE AppvCategoryID=" . $appvid . " and Is_trash=0 and Place='" . $plc . "' order by ApprovalLevel ASC");
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    /* function sel_unit($reqCategotyid){
      $db2 = $this->load->database('config1', true);
      $qdata = $db2->query("SELECT BisUnitID FROM Mst_RequestCategory
      INNER JOIN Mst_Budget b ON b.BudgetID = a.BudgetID
      WHERE AppvCategoryID=".$reqCategotyid." and Is_trash=0");
      if(count($qdata) > 0) {
      return $qdata->result();
      }
      else {
      return false;
      }
      $qdata->close();

      } */

    function calculatbudget($coa) {
        $db2 = $this->load->database('config1', true);
        $tahun=date('Y');
        $qdata = $db2->query("SELECT BudgetUsed,BudgetID FROM Mst_Budget WHERE BudgetCOA='$coa' and Year='$tahun'");
        if ($qdata->num_rows() > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    function delbudget($id) {
        $db2 = $this->load->database('config1', true);
        $qdata = $db2->query("SELECT a.BudgetCOA,a.SubTotalPrice,a.PriceVendor,b.BudgetUsed FROM Mst_Request a 
                                LEFT JOIN Mst_Budget b ON b.BudgetCOA = a.BudgetCOA
			WHERE RequestID=" . $id . "");
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    /* EDITED BY WILLY 5 agustus 2017 */

    function savedata($paydata, $id, $idnumber, $rktID = null, $RktZoneID = null, $reqCatID = null, $BudgetCOA, $divid, $budgetUsed,$budgetID) {
        //echo($paydata);die();
//echo($budgetUsed.'-'.$budgetID);die();
        $zone = $this->session->userdata('ZoneID');
        if ($this->input->post('ReqTypeID') == 3) {
            // EDITED BY WILLY 11 AGUSTUS 2017	
            $periode_pembayaran = 0;
            $swa = $this->input->post('priod'); //termin pembayaran
            $jk_waktu = $_POST['jangka_waktu'];
            $jtempo_sewa = $_POST['jtempo_sewa'];
            $periode_pembayaran = $jk_waktu / $swa;
            // END 	
        } else {
            $periode_pembayaran = '';
            $swa = '';
            $jk_waktu = '';
            $jtempo_sewa = '';
        }
        if ($this->session->userdata('BranchID') == 1) {
            $div = $divid;
        } else {
            $div = '';
        }
//PENAMBAHAN 14 AGUSTUS 2017 WILLY
        $div = $this->session->userdata('DivisionID');

        $datas = array(
            'RequestID' => $idnumber,
            'ReqCategoryID' => $reqCatID,
            'ReqTypeID' => $this->input->post('ReqTypeID'),
            'RktID' => $rktID,
            'RktZoneID' => $RktZoneID,
            'EmployeeID' => $this->session->userdata('user_id'),
            'PositionID' => $this->session->userdata('PositionID'),
            'DivisionID' => $div,
            'PriodSewa' => $jk_waktu, //$periode_pembayaran,//$swa, jika sewa makan jangka waktu dibagi banyak (periode per-pembayaran)
            'BisUnitID' => '',
            'ZoneID' => $zone,
            'Eksekutor' => $this->input->post('eksekutor'),
            'BranchID' => $this->session->userdata('BranchID'),
            'Eksekutor' => $this->input->post('eksekutor'),
            'BudgetCOA' => $BudgetCOA,
            'MyBudget' => $this->input->post('budget'),
            'SubTotalPrice' => $this->input->post('BudgetUsed'),
            'RestOfBudget' => $this->input->post('RestOfBudget'),
            'CreateDate' => date('Y-m-d H:i:s'),
            'CreateBy' => $this->session->userdata('user_id'),
            // PENAMBAHAN FIELD OLEH WILLY
            'Jenis_periode_sewa' => $_POST['jenis_periode_sewa'], //1:harian 2.bulanan 3.tahunan
            'Jangka_waktu' => $periode_pembayaran,
            'Termin_sewa' => $swa, //Termin sewa
            'file_vendor' => $paydata,
            'Jtempo_sewa' => $jtempo_sewa            
                // END SEWA
        );
        // echo "<pre>";
//		 print_r($datas);die();
        $this->db2 = $this->load->database('config1', true);
        $this->db2->insert('Mst_Request', $datas);
        $this->db2->close();

        for ($i = 0; $i < $this->input->post('totrow'); $i++) {
            $itemdata = array(
                'RequestID' => $idnumber,
                'ItemID' => $this->input->post('ItemID' . $i),
                'QTY' => $this->input->post('QTY' . $i),
                'Price' => $this->input->post('Price' . $i),
                'Keterangan' => nl2br($this->input->post('keterangan' . $i)),
                'Status' => 0,
                'CreateDate' => date('Y-m-d H:i:s'),
                'CreateBy' => $this->session->userdata('user_id'),
                'Is_header' => 1 //PENAMBAHAN OLEH WILLY
            );
            //print_r($itemdata);die;
            $this->db3 = $this->load->database('config1', true);
            $this->db3->insert('Trx_DetItemReq', $itemdata);
            $this->db3->close();
        }
        //UPDAT BUDGET USED----------------------------------------->
        $jmlbudget = $budgetUsed + $this->input->post('BudgetUsed');
        $budgetData = array(
            'BudgetUsed' => $jmlbudget,
        );
        //print_r($budgetData);die();
        $this->db4 = $this->load->database('config1', true);
        $this->db4->where('BudgetID', $budgetID);
        $this->db4->update('Mst_Budget', $budgetData);
        $this->db4->close();
    }

    /* END EDITED BY WILLY 5 agustus 2017 */

    function updatedata($id) {
        $datas = array(
            'RequestID' => $id,
            'BisUnitName' => $this->input->post('BisUnitName'),
            'BisUnitBranchID' => $this->input->post('Branch'),
            'Status' => 0,
            'UpdateDate' => date('Y-m-d H:i:s'),
            'UpdateBy' => $this->session->userdata('user_id')
        );
        $this->db2 = $this->load->database('config1', true);
        $this->db2->where('RequestID', $id);
        $this->db2->update('Mst_Request', $datas);
        $this->db2->close();
    }

    /* CHEKING APPROVAL- */

    function cheking_aproval($id) {
        $db2 = $this->load->database('config1', true);
        $qdata = $db2->query("SELECT * FROM Appv_Request WHERE RequestID='" . $id . "' and AppvStatus IN(1,3)");
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    function cheking_paytermin($id) {
        $db2 = $this->load->database('config1', true);
        $qdata = $db2->query("SELECT * FROM Pay_Termin WHERE RequestID='" . $id . "' and  StatusPayment=1 ");
        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }

    function deletedata($id) {
        //Delete Request--------------------------------------------/
        $datas = array(
            'Is_trash' => 1,
            'DeleteDate' => date('Y-m-d H:i:s'),
            'DeleteBy' => $this->session->userdata('user_id')
        );
        $this->db2 = $this->load->database('config1', true);
        $this->db2->where('RequestID', $id);
        $this->db2->update('Mst_Request', $datas);
        $this->db2->close();

        //Delete TRXDetail Item--------------------------------------/
        $data_ItemDetail = array(
            'Is_trash' => 1,
            'DeleteDate' => date('Y-m-d H:i:s')
                //'DeleteBy'=>$this->session->userdata('user_id')
        );
        $this->db2 = $this->load->database('config1', true);
        $this->db2->where('RequestID', $id);
        $this->db2->update('Trx_DetItemReq', $data_ItemDetail);
        $this->db2->close();

        //Delete approval Request-----------------------------------/	
        $data_apprv = array(
            'Is_trash' => 1
        );
        $this->db2 = $this->load->database('config1', true);
        $this->db2->where('RequestID', $id);
        $this->db2->update('Appv_Request', $data_apprv);
        $this->db2->close();
    }

    

    function jumlah() {
        $this->db2 = $this->load->database('config1', true);
        $qdata = $this->db2->query('SELECT COUNT(RequestID) AS jml FROM Mst_Request where Is_trash=0');
        return $qdata->result();
    }

    function maxid() {
        $this->db2 = $this->load->database('config1', true);
        $qdata = $this->db2->query('SELECT MAX(RequestID) AS idmax FROM Mst_Request');
        return $qdata->result();
    }

    function seldetil_cetak($id, $branchid) {
        $db2 = $this->load->database('config1', true);
        //die($branchid);
        if ($branchid == 1) {
            $qdata = $db2->query("SELECT a.file_vendor,a.DeleteDate,a.Is_trash,a.Keterangan_hapus,f.DivisionCode as code_middel,f.DivisionName,a.Jenis_periode_sewa,a.Jangka_waktu,a.Termin_sewa,a.RequestID,a.PriodSewa,a.CreateDate,b.ReqCategoryName,c.ReqTypeID,c.ReqTypeName,d.EmployeeName,e.BranchName 
						   FROM Mst_Request a
						   INNER JOIN Mst_RequestCategory b ON a.ReqCategoryID=b.ReqCategoryID 
						   INNER JOIN Mst_RequestType c ON a.ReqTypeID=c.ReqTypeID
						   INNER JOIN Mst_Employee d ON a.EmployeeID=d.EmployeeID
						   /*INNER JOIN Mst_Division e ON a.DivisionID=e.DivisionID*/
						   INNER JOIN Mst_Branch e ON a.BranchID=e.BranchID
						   Left Join Mst_Division f ON a.DivisionID=f.DivisionID 
						   WHERE /*a.Is_trash=0 and*/  a.RequestID=" . $id . "");
        } else {
            $qdata = $db2->query("SELECT a.file_vendor,a.DeleteDate,a.Is_trash,a.Keterangan_hapus,e.BranchCode as code_middel,f.DivisionName,
                                                    a.Jenis_periode_sewa,a.Jangka_waktu,a.Termin_sewa,a.RequestID,a.PriodSewa,a.CreateDate,b.ReqCategoryName,
                                                    c.ReqTypeID,c.ReqTypeName,d.EmployeeName,e.BranchName 
                                                    FROM Mst_Request a 
                                                    INNER JOIN Mst_RequestCategory b ON a.ReqCategoryID=b.ReqCategoryID 
                                                    INNER JOIN Mst_RequestType c ON a.ReqTypeID=c.ReqTypeID 
                                                    INNER JOIN Mst_Employee d ON a.EmployeeID=d.EmployeeID /*INNER JOIN Mst_Division e ON a.DivisionID=e.DivisionID*/ 
                                                    INNER JOIN Mst_Branch e ON a.BranchID=e.BranchID 
                                                    Left Join Mst_Division f ON a.DivisionID=f.DivisionID 
                                                    WHERE /*a.Is_trash=0 and*/  a.RequestID=" . $id . "");
        }

        if (count($qdata) > 0) {
            return $qdata->result();
        } else {
            return false;
        }
        $qdata->close();
    }
    
    function deletedata2($id, $note) {
        //Delete Request--------------------------------------------/

        $datas = array(
            'Is_trash' => 1,
            'DeleteDate' => date('Y-m-d H:i:s'),
            'DeleteBy' => $this->session->userdata('user_id'),
            'Keterangan_hapus' => $note
        );
        $this->db2 = $this->load->database('config1', true);
        $this->db2->where('RequestID', $id);
        $this->db2->update('Mst_Request', $datas);
        $this->db2->close();


//delete Pay Termin dan Ias
        $db2 = $this->load->database('config1', true);
        $qdata = $db2->query(" DELETE FROM Pay_Termin WHERE RequestID='" . $id . "'");

        $db2 = $this->load->database('config1', true);
        $qdata = $db2->query(" DELETE FROM Pay_IAS WHERE RequestID='" . $id . "'");
//end	
        //Delete TRXDetail Item--------------------------------------/
        $data_ItemDetail = array(
            'Is_trash' => 1,
            'DeleteDate' => date('Y-m-d H:i:s')
                //'DeleteBy'=>$this->session->userdata('user_id')
        );
        $this->db2 = $this->load->database('config1', true);
        $this->db2->where('RequestID', $id);
        $this->db2->update('Trx_DetItemReq', $data_ItemDetail);
        $this->db2->close();

        //Delete approval Request-----------------------------------/	
        $data_apprv = array(
            'Is_trash' => 1
        );
        $this->db2 = $this->load->database('config1', true);
        $this->db2->where('RequestID', $id);
        $this->db2->update('Appv_Request', $data_apprv);
        $this->db2->close();
    }
    
    function updatefilepr($name_file_up,$requestid) {
        $this->db2 = $this->load->database('config1', true);
        $this->db2->trans_begin();
        
        $data = array(
            'Direktory_PR' => $name_file_up,
        ); 
        
        $model = $this->db2->where('RequestID', $requestid);
        $model = $this->db2->update('Mst_Request', $data);
        
        if ($this->db2->trans_status() === FALSE) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
        
    }

}

?>