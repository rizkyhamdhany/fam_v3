<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Utility_db extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->load->dbutil();
        $this->load->model('home_m');
        $this->load->model('utility/utility_db_m');
        session_start();
    }

    public function index() {
	$this->load->dbutil();
        $prefs = array(
            'format' => 'sql',
            'filename' => 'my_db_backup.sql'
        );
        $backup = & $this->dbutil->backup($prefs);
        $db_name = 'backup-on-' . date("Y-m-d-H-i") . '.sql';
        $save = 'backup_db/' . $db_name;
        //chmod($save, 0777);
        //unlink($save);
        $this->load->helper('file');
        $buatfile = write_file($save, $backup);
/*
        if ($this->auth->is_logged_in() == false) {
            $this->login();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));

            $this->template->set('title', 'Home');
            $this->template->load('template/template1', 'global/index', $data);
        }
*/
    }

    function home() {
        $menuId = $this->home_m->get_menu_id('utility/utility_db/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);

        if (isset($_POST["btnProses"])) {
            $this->backup();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);

            $this->template->set('title', $data['menu_nama']);
            $this->template->load('template/template_dataTable', 'utility/utility_db_v', $data);
        }
    }

    function download() {
        $b = $this->backup();
        $a = $this->buat_file();
    }

    function buat_file() {
        $this->load->dbutil();
        $prefs = array(
            'format' => 'sql',
            'filename' => 'my_db_backup.sql'
        );
        $backup = & $this->dbutil->backup($prefs);
        $db_name = 'backup-on-' . date("Y-m-d-H-i") . '.sql';
        $save = 'backup_db/' . $db_name;
        //chmod($save, 0777);
        //unlink($save);
        $this->load->helper('file');
        $buatfile = write_file($save, $backup);

        //$this->load->helper('download');
        //force_download($db_name, $backup);
    }

    function backup() {
        $this->load->dbutil();
        $prefs = array(
            'format' => 'sql',
            'filename' => 'my_db_backup.sql'
        );
        $backup = & $this->dbutil->backup($prefs);
        $db_name = 'backup-on-' . date("Y-m-d-H-i") . '.sql';
        $save = 'backup_db/' . $db_name;
        //$hapusExisting = $this->utility_db_m->delete($save);
        $tglTrans = $this->session->userdata('tgl_y');
        date_default_timezone_set("Asia/Bangkok");
        $time = date('H:i:s');

        $data = array(
            'nama_file' => $db_name,
            'direktori' => $save,
            'tgl_backup' => $tglTrans,
            'time_backup' => $time
        );
        $model = $this->utility_db_m->insert($data);
    }

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */
