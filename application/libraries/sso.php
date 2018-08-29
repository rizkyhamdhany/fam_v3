<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sso {
	private $CI = NULL;
	public function __construct()
	{
		$this->CI =& get_instance();
	}

	// untuk validasi login
	public function log_sso()
	{
//            print_r("shdhj");die();
		redirect("http://182.23.52.249/SSO_WebService/login.php?source=".base_url()."admin/chekinglogin&app_code=MASSET");	
	}

}