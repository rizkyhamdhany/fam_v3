<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sec_aktivasi extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('home_m');
		$this->load->model('sec_aktivasi_m');
        $this->load->library('kripton');
        $this->load->helper('file');
        $this->load->helper(array('form', 'url'));
		session_start ();
	}
	public function index(){
		if($this->auth->is_logged_in () == false){
			$this->login();
		}else{
			$data['multilevel'] = $this->user_m->get_data(0,$this->session->userdata('usergroup'));
			$this->template->set ( 'title', 'home' );
			$this->template->load ( 'template/template1', 'global/index',$data );
		}

	}

    function simpan(){
        $institusiName			= trim($this->input->post('institusiName'));
        $serialNumb			    = trim($this->input->post('serialNumb'));
        $maxCab			        = trim($this->input->post('maxCab'));
        $cipher			        = trim($this->input->post('cipher'));
        $kodeCabang			    = trim($this->input->post('kodeCabang'));
        $namaCabang			    = trim($this->input->post('namaCabang'));
        $passwordAdm			= trim($this->input->post('passwordAdm'));
        $expired			    = trim($this->input->post('expired'));
        if($expired=='') {
            $expired='0000-00-00';
        }

        $stringToEncrypt        = $institusiName.'_'.$serialNumb.'_'.$maxCab.'_'.$cipher.'_'.$kodeCabang.'_'.$namaCabang.'_'.$passwordAdm.'_'.$expired;

        $kunci                  = 'microtechwebmitra';
        $encryptedText = $this->kripton->encrypt($stringToEncrypt,$kunci);
        //$decryptedText           = $this->kripton->decrypt($encryptedText,$kunci);
        $file_name  = $institusiName.'.key';
        $path_file  = 'outsyst/'.$file_name;
        if ( ! write_file($path_file, $encryptedText))
        {
            $this->session->set_flashdata('error','Create aktivasi txt gagal !');
            redirect('sec_aktivasi/home');
        }
        else
        {
            $this->session->set_flashdata('success','Create aktivasi txt berhasil !' );

            $this->session->set_flashdata('path_file',$path_file );
            $this->session->set_flashdata('name_file',$file_name );

            redirect('sec_aktivasi/home');
            /* DOWNLOAD JIKA SUKSES CREATE FILE */

          //  $this->load->helper('download');

           // $data = file_get_contents($path_file); // Read the file's contents
           // force_download($file_name, $data);

        }
    }
    function baca(){
        $config['upload_path'] = 'insyst/';
        $config['allowed_types'] = '*';
        $config['max_size']	= '100';
        //$config['max_width']  = '1024';
        //$config['max_height']  = '768';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('institusiFile'))
        {
            $error = $this->upload->display_errors();

            $this->session->set_flashdata('error',$error);
            redirect('sec_aktivasi/home');
        }
        else
        {

            //$data = array('upload_data' => $this->upload->data());
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];
            $path_file  = 'insyst/'.$file_name;
            $string_file = read_file($path_file);

            $kunci                  = 'microtechwebmitra';
            $decryptedText  = $this->kripton->decrypt($string_file,$kunci);

            $this->session->set_flashdata('success','Baca key sukses!' );
            $this->session->set_flashdata('data',$decryptedText );
            $this->session->set_flashdata('path_fileBaca',$path_file );
            $this->session->set_flashdata('name_fileBaca',$file_name );
            unlink($path_file);
            redirect('sec_aktivasi/home');
        }

    }
    function home(){
		$menuId = $this->home_m->get_menu_id('sec_aktivasi/home');
		$data['menu_id'] = $menuId[0]->menu_id;
		$data['menu_parent'] = $menuId[0]->parent;
		$this->auth->restrict ($data['menu_id']);
		$this->auth->cek_menu ( $data['menu_id'] );

		if(isset($_POST["btnCreate"])){
			$this->simpan();
		}elseif(isset($_POST["btnRead"])){
            $this->baca();
        }elseif(isset($_POST["btnDownload"])){
            $this->unduh();
        }else{
			$data['multilevel'] = $this->user_m->get_data(0,$this->session->userdata('usergroup'));
			$data['menu_all'] = $this->user_m->get_menu_all(0);

			$this->template->set ( 'title', 'home' );
			$this->template->load ( 'template/template3', 'admin/sec_aktivasi_v',$data );
		}
	}
    function unduh(){
        $this->load->helper('download');
        $pathFile			= trim($this->input->post('pathFileUnduh'));
        $nameFile			= trim($this->input->post('nameFileUnduh'));

        $data = file_get_contents($pathFile); // Read the file's contents
        $download = force_download($nameFile, $data);
        if($download){
            unlink($pathFile);
        }

    }

}

/* End of file sec_menu_user.php */
/* Location: ./application/controllers/sec_menu_user.php */