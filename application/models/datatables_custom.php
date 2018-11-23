<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class datatables_custom extends CI_Model {

    public $table;
    public $column = array();
    public $order = array();
    public $where = array();
    public $like = array();
    public $group_by;
    public $where_not_in = array();
    public $param_not_in;
    public $where_in = array();
    public $param_in;
    public $or_where = array();

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getalldata() {
        $this->db->from($this->table);
        $query = $this->db->get();

        return $query->row();
    }

    private function _get_datatables_query() {
        $this->db->select($this->column);
        $this->db->where($this->where);
        $this->db->like($this->like);
        $this->db->where_in($this->param_in, $this->where_in);
        $this->db->from($this->table);
        $this->db->where_not_in($this->param_not_in, $this->where_not_in);
        $this->db->or_where($this->or_where);
        // $this->db->group_by($this->group_by);
//        $this->db->like($this->where);
//        $this->db->from($this->table);

        $i = 0;
//
        foreach ($this->column as $item) {
			if($_POST['search']['value']){
                ($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
            }	
            $column[$i] = $item;
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($s_Table = null, $s_column = array(), $s_order = array(), $s_where = array(), $s_like = array(), $s_where_in = array(), $s_param_in = null, $s_where_not_in = array(), $s_param_not_in = null, $s_or_where = array()) {
        $this->table = $s_Table;
        $this->column = $s_column;
        $this->order = $s_order;
        $this->where = $s_where;
        $this->like = $s_like;
        $this->where_in = $s_where_in;
        $this->param_in = $s_param_in;
        $this->where_not_in = $s_where_not_in;
        $this->param_not_in = $s_param_not_in;
        $this->or_where = $s_or_where;
//        $this->param_or_where = $s_param_or_where;

        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_by_pid($pid) {
        $this->db->from($this->table);
        $this->db->where('pid_pelamar', $pid);
        $query = $this->db->get();

        return $query->row();
    }

    //  public function get_by_education($edu)
    // {
    // 	$this->db->from($this->table);
    // 	$this->db->where('pendidikan',$edu);
    // 	$query = $this->db->get();
    // 	return $query->result();
    // }

    public function save($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($where, $data) {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_pid($id) {
        $this->db->where('pid_pelamar', $id);
        $this->db->delete($this->table);
    }

}
