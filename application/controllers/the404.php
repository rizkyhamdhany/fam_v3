<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class The404 extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library("session");
        if ($this->session->userdata("is_login") === FALSE) {
            $this->sso->log_sso();
        } else {
            $this->load->model('home_m');
            $this->load->model('user_m');
            $this->load->model('dashboard/dashboard_m');
            $this->load->helper('cookie');
            session_start();
        }
    }

    public function index() {
        if ($this->auth->is_logged_in() == false) {
            $this->login();
        } else {
            $data ['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_id'] = 0;
            $data['error'] = 'Page Not Found';
            $tanggal = $this->session->userdata('tgl_d');
            $this->template->set('title', 'Page Not Found');
            $this->template->load('template/template1', 'dashboard_v', $data);
        }
    }
}