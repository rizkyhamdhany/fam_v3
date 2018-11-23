<?php

Class Fpur_mdl extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

	function save_fpur($data)
    {
        $this->db->insert('TBL_T_FPUR', $data);
        return $this->db->insert_id();
    }

    function save_fpum($data)
    {
        $this->db->insert('TBL_T_FPUM', $data);
        return $this->db->insert_id();
    }
}
?>