<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Restore_db extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        //$this->load->model('master_penanganan_m');
        //$this->load->model('master_keluhan_m');
        $this->load->model('utility/restore_db_m');
        session_start();
    }

    public function index() {
        if ($this->auth->is_logged_in() == false) {
            $this->login();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);

            $this->template->set('title', 'Home');
            $this->template->load('template/template4', 'master/index', $data);
        }
    }

    function home() {
        $menuId = $this->home_m->get_menu_id('utility/restore_db/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        //$data['kategori'] = $this->master_keluhan_m->getKategori();
        //$data['dept'] = $this->master_keluhan_m->getDept();


        if (isset($_POST["btnSimpan"])) {
//            $this->simpan();
        }
        else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);

            $this->template->set('title', $data['menu_nama']);
            $this->template->load('template/template_dataTable', 'utility/restore_db_v', $data);
        }
    }

    public function getUtilityDB() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->restore_db_m->getUtilityDB();
        $data['data'] = array();
        $i = 0;
        foreach ($rows as $row) {
            $i++;
            $tgl_backup = date(trim("d-m-Y", strtotime($row->tgl_backup)));
            $array = array(
                'no' => $i,
                'nama_file' => trim($row->nama_file),
                'direktori' => trim($row->direktori),
                'tgl_backup' => $tgl_backup,
                'time_backup' => trim($row->time_backup),
            );
            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }

	function restore(){
		$this->CI =& get_instance();
		$path	= trim($this->input->post('path'));
		
		$query = $this->db->query("SHOW TABLES");
		$name = $this->db->database;
		  foreach ($query->result_array() as $row)
		  {
			$table = $row['Tables_in_' . $name];
			$this->db->query("TRUNCATE " . $table);
			$this->db->query("ALTER TABLE ".$table." AUTO_INCREMENT = 1");
		  }
		
		$isi_file=file_get_contents($path);
		$string_query=rtrim($isi_file, "\n;" );
		$array_query=explode(";", $string_query);
		
		foreach($array_query as $query){
			$this->db->query($query);
		}
		
		if ($query) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Database berhasil di backup.'
            );
        } else {
            $array = array(
                'act' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Database gagal di backup.'
            );
        }
       $this->output->set_output(json_encode($array)); 
	}
}

/* End of file sec_user.php */
/* Location: ./application/controllers/restore_db.php */