<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_laporan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('home_m');
		$this->load->model('user_m');
		$this->load->model('setting_laporan_m');
		session_start ();
	}
	public function index(){
		if($this->auth->is_logged_in () == false){
			$this->login();
		}else{
			$data['multilevel'] = $this->user_m->get_data(0,$this->session->userdata('usergroup'));
			//$data ['nama'] = $this->home_m->get_nama_kantor ();
			$this->template->set ( 'title', 'home' );
			$this->template->load ( 'template/template1', 'global/index',$data );
		}	
	}
	
	function home(){
		$menuId = $this->home_m->get_menu_id('setting_laporan/home');
		$data['menu_id'] = $menuId[0]->menu_id;
		$data['menu_parent'] = $menuId[0]->parent;
		$data['menu_nama'] = $menuId[0]->menu_nama;
		$this->auth->restrict ($data['menu_id']);
		$this->auth->cek_menu ( $data['menu_id'] );
               
		if(isset($_POST["btnSimpan"])){
			$this->simpan();
		}elseif(isset($_POST["btnUbah"])){
			$this->ubah();
		}elseif(isset($_POST["btnHapus"])){
			$this->hapus();
		}else{
			$data['multilevel'] = $this->user_m->get_data(0,$this->session->userdata('usergroup'));
			$data['menu_all'] = $this->user_m->get_menu_all(0);
			$data['info'] = $this->setting_laporan_m->getAllSetting();	
			$this->template->set ( 'title', $data['menu_nama'] );
			$this->template->load ( 'template/template3', 'admin/setting_laporan_v',$data );
		}
	}
	function ubah(){
        $id 			= trim($this->input->post('id'));
		$nama_pt		= trim($this->input->post('pt'));
    	$nama_kantor	= trim($this->input->post('kantor'));
		$alamat			= trim($this->input->post('alamat'));		
        
        $data = array(
			'pt'		      	=> $nama_pt,
            'kantor'		    => $nama_kantor,
            'alamat'		    => $alamat
        );
    	
    	$model = $this->setting_laporan_m->updateSetting($data,$id);
		if($model){
			$array = array(
					'act'	=>1,
					'tipePesan'=>'success',
					'pesan' =>'Data berhasil diubah.'
			);
		}else{
			$array = array(
					'act'	=>0,
					'tipePesan'=>'error',
					'pesan' =>'Data gagal diubah.'
			);
		}
    	$this->output->set_output(json_encode($array));
    }
}

/* End of file akses_user.php */
/* Location: ./application/controllers/akses_user.php */