<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class master_po_m extends CI_Model {

	public function getList($status) {
		$sql = "SELECT VW_T_PR.*, (SELECT count(ID_PR) from TBL_T_PO WHERE ID_PR = VW_T_PR.RequestID) as Jumlah FROM VW_T_PR WHERE VW_T_PR.statusID = '".$status."'";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getItemList($id) {
		$sql = "select a.ItemID, a.Qty, a.HargaHPS, a.Qty*a.HargaHPS as total, b.ItemName, c.ItemTypeName from TBL_REQUEST_ITEMLIST a join Mst_ItemList b on a.ItemID = b.ItemID join Mst_ItemType c on b.ItemTypeID = c.ItemTypeID WHERE a.RequestID = $id";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getflow()
	{
		$query = "SELECT id, flow_id, nama_flow, status_dari, ACTION, status_ke FROM MS_FLOW WHERE ( ACTION = 'approve' ) AND status_dari = '7-2'";
		$get = $this->db->query($query);
		return $get->row();
	}

	public function get_po($id)
	{
		$this->db->where('RequestID', $id);
		return $this->db->get('VW_T_PR')->row();
	}

	public function get_doc($id)
	{
		$query = $this->db->query("SELECT * FROM TBL_T_PO WHERE ID_PR = $id")->row();
		$query2 = $this->db->query("select ID_PO_DETAIL from TBL_T_PO_DETAIL where ID_PO = $query->ID_PO GROUP BY ID_PO_DETAIL")->result_array();
		$id_pos = [];
		foreach ($query2 as $val) {
			$id_pos[] = $val['ID_PO_DETAIL'];
		}
		$this->db->where_in('ID_PO_DETAIL', $id_pos);
        return $this->db->get('TBL_T_PO_GENERATE_DOC')->result();
	}

	public function get_detail_po($id)
	{
		$query = $this->db->query("SELECT * FROM TBL_T_PO WHERE ID_PR = $id")->row();
		return $query2 = $this->db->query("select ID_PO_DETAIL from TBL_T_PO_DETAIL where ID_PO = $query->ID_PO GROUP BY ID_PO_DETAIL")->result();
	}

	public function cek_po($id)
	{
		$this->db->where('ID_PR', $id);
		return $this->db->get('TBL_T_PO')->row();
	}

	public function getRequest($id)
	{
		$this->db->where('RequestID', $id);
		return $this->db->get('TBL_REQUEST')->row();
	}

	public function get_all_vendor($id)
	{
		$this->db->select("a.RequestID, b.*");
		$this->db->from("TBL_REQUEST_VENDOR a");
		$this->db->join("Mst_Vendor b", "a.VendorID = b.VendorID");
		$this->db->where('a.RequestID', $id);
		return $this->db->get()->result();
	}

	public function get_win_vendor($id)
	{
		$this->db->select("a.RequestID, a.Pemenang, b.*");
		$this->db->from("TBL_REQUEST_VENDOR a");
		$this->db->join("Mst_Vendor b", "a.VendorID = b.VendorID");
		$this->db->where('a.RequestID', $id);
		$this->db->where('a.Pemenang', 1);
		return $this->db->get()->result();
	}

	public function save_po($data)
	{
   		return $this->db->insert('TBL_T_PO', $data);
   	}

   	public function save_log($data)
   	{
   		return $this->db->insert('TBL_REQUEST_LOG', $data);
   	}

   	public function save_po_detail($data)
	{
   		return $this->db->insert('TBL_T_PO_DETAIL', $data);
   	}

   	public function save_detail_total($data)
	{
   		return $this->db->insert('TBL_T_PO_DTL_TOTAL', $data);
   	}

	public function save_termin($termin)
	{
		return $this->db->insert('TBL_T_TERMIN', $termin);
	}

	function cancelpo($id)
    {
        $data = array(
            'IS_TRASH' => 1
        );

        $this->db->where('ID_PO', $id);
        return $this->db->update('TBL_T_PO', $data);
    }

    public function uploaddoc($data, $id)
    {
    	$this->db->where('ID', $id);
        return $this->db->update('TBL_T_PO_GENERATE_DOC', $data);
    }

    function no_doc($code, $length)
    {
    	$this->db->where("LEFT(NO_DOC, $length) = '$code'");
    	$this->db->order_by('ID', 'desc');
    	return $this->db->get('TBL_T_PO_GENERATE_DOC')->row();
    }

    function get_t_po()
    {
    	$this->db->order_by('ID_PO', 'desc');
    	return $this->db->get('TBL_T_PO')->row();
    }

    function save_doc($data)
    {
    	return $this->db->insert('TBL_T_PO_GENERATE_DOC', $data);
    }

}


/* End of file master_po_m.php */
/* Location: ./application/models/master_po_m.php */

