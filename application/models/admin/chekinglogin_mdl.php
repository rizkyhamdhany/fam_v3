<?php
Class Chekinglogin_mdl extends CI_Model
{
	public function __construct()
	{
        parent::__construct();
    }
    function chek_user($nik){
    	$this->db2 = $this->load->database('config1', true);	
		$sqldata = $this->db2->query("SELECT a.*,mz.ZoneName,mb.BranchName,mb.BranchCode,md.DivisionCode from [user] a
                                              left join Mst_Zonasi mz on a.ZoneID = mz.ZoneID
                                              left join Mst_Branch mb on a.BranchID = mb.BranchID
                                              left join Mst_Division md on a.DivisionID = md.DivisionID
                                              WHERE nik='".$nik."'");
    	//$sqldata = $db2->query("SELECT * FROM Mst_Branch");  
    	return $sqldata->result();

	}
	
	/* MODEL FINANCE MONITORING BUDGET------------------------------------------------------------------------------------------------------------------*/
	function chek_branch($cabang,$lokasikerja){
		$this->db2 = $this->load->database('config1', true);
		if($cabang!=""){
			$sqldata = $this->db2->query("SELECT BranchID,ZoneID FROM [Mst_Branch] where BranchName='".$cabang."' and Is_trash=0");
		}else{
			$sqldata = $this->db2->query("SELECT BranchID,ZoneID FROM [Mst_Branch] where BranchName='".$lokasikerja."' and Is_trash=0");
		} 
    	return $sqldata->result();
	}
	function chek_position($positionname){
		$this->db2 = $this->load->database('config1', true);
		$sqldata = $this->db2->query("SELECT PositionID FROM [Mst_Position] where PositionName='".$positionname."' and Is_trash=0");
    	//$sqldata = $db2->query("SELECT * FROM Mst_Branch");  
    	return $sqldata->result();
	}
	function chek_divisi($organisasiName){
		$this->db2 = $this->load->database('config1', true);
		$sqldata = $this->db2->query("SELECT DivisionID FROM [Mst_Division] where DivisionName='".$organisasiName."' and Is_trash=0");
	    	//$sqldata = $db2->query("SELECT * FROM Mst_Branch");  
	    	return $sqldata->result();
	}
	function save_employee($id,$idsdm,$nik,$usrname,$name,$email,$positionid,$branchid,$zoneid,$division,$foto){
		$dataemployee=array(
				'EmployeeID'=>$id,
        		'IdSdm'=>$idsdm,
				'Nik'=>$nik,
				'EmployeeName'=>$name,
				'EmployeeEmail'=>$email,
				'PositionID'=>$positionid,
				'BranchID' =>$branchid,
				'DivisionID' =>$division,
				'ZoneID' =>$zoneid,
				'AccessLevel'=>1,
				'user_groupid' =>7,
				'image' =>$foto,
				'Status' =>1
				);
		//print_r($dataemployee);
           $this->db2 = $this->load->database('config1', true);
			$this->db2->insert('[Mst_Employee]',$dataemployee);
	}
	function save_user($id,$idsdm,$nik,$usrname,$name,$email,$positionid,$branchid,$zoneid,$division,$foto){
			$data=array(
				'user_id'=>$id,
	    		'idsdm'=>$idsdm,
				'nik'=>$nik,
				'user_name'=>$usrname,
				'name'=>$name,
				'user_email'=>$email,
				'PositionID'=>$positionid,
				'BranchID' =>$branchid,
				'DivisionID' =>$division,
				'ZoneID' =>$zoneid,
				'JointDate' =>date('Y-m-d H:i:s'),
				'user_groupid' =>7,
				'user_photo' =>$foto,
				'status' =>1,
				'user_password' =>''
			);
			// print_r($data);
		$this->db2 = $this->load->database('config1', true);	
		$this->db2->query("SET IDENTITY_INSERT [dbo].[user] ON");
        $this->db2->insert('[user]',$data);
        $this->db2->query("SET IDENTITY_INSERT [dbo].[user] OFF");
	    $this->db2->close();

	}
	function maxuser(){
		$this->db2 = $this->load->database('config1', true);
		$sqldata = $this->db2->query("SELECT max(user_id) as maxid from [user]");
    	//$sqldata = $db2->query("SELECT * FROM Mst_Branch");  
    	return $sqldata->result();

	}

}	


	

?>