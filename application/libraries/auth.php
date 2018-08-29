<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Auth library
 */
class Auth {

    var $CI = NULL;

    function __construct() {
        // get CI's object
        $this->CI = & get_instance();
    }

//    // untuk validasi login
//    function do_login($username, $password, $tgl_d, $tgl_y, $nama_kantor) {
//        $password = base64_encode($password);
//        // cek di database, ada ga?
//        $this->CI->db->select('p.userid,p.username,p.id_kyw,p.usergroup,u.usergroup_desc,mk.nama_kyw'); //,md.nama_dept
//        $this->CI->db->from('sec_passwd p');
//        $this->CI->db->join('sec_usergroup u', 'p.usergroup=u.usergroup_id');
//        $this->CI->db->join('master_karyawan mk', 'p.id_kyw=mk.id_kyw');
////        $this->CI->db->join('master_dept md', 'mk.dept_kyw=md.id_dept');
//        $this->CI->db->where('p.username', $username);
//        $this->CI->db->where('p.password', $password);
//        $result = $this->CI->db->get();
//        if ($result->num_rows() == 0) {
//            // username dan password tsb tidak ada
//            return false;
//        } else {
//            // ada, maka ambil informasi dari database
//            $userdata = $result->row();
//            $session_data = array(
//                'id_user' => $userdata->userid,
//                'id_kyw' => $userdata->id_kyw,
//                // 'namaDept' => $userdata->nama_dept,
//                'namaKyw' => $userdata->nama_kyw,
//                'usergroup' => trim($userdata->usergroup),
//                'usergroup_desc' => $userdata->usergroup_desc,
//                'tgl_y' => $tgl_y,
//                'tgl_d' => $tgl_d,
//                'ZoneID' => 1,
//                'DivisionID' => 27,
//                'BranchID' => 1
//            );
//            // buat session
//            $this->CI->session->set_userdata($session_data);
//            return true;
//        }
//    }

    // untuk mengecek apakah user sudah login/belum
    function is_logged_in() {
        if ($this->CI->session->userdata('id_user') == '') {
            return false;
        }
        return true;
    }

    // untuk validasi di setiap halaman yang mengharuskan authentikasi
    function restrict() {

        if ($this->is_logged_in() == false) {
            redirect('main/login');
        }
    }

    // untuk mengecek menu
    function cek_menu($idmenu) {
        $this->CI->load->model('user_m');
        $allowed_level = $this->CI->user_m->get_array_menu($idmenu);
        $status_user = $this->CI->session->userdata('usergroup');

//         var_dump($status_user);
//        echo '<pre>';        print_r($allowed_level); die();
        if (in_array($status_user, $allowed_level)) {
//            return true;
        } else {
            die("Maaf, Anda tidak berhak untuk mengakses halaman ini.");
        }
    }

    // untuk logout
//    function do_logout() {
//        $this->CI->session->sess_destroy();
//        session_destroy();
//    }

//    ===============from sso
    public function redirect_me() {
        if ($this->CI->session->userdata('redirected_from') == FALSE) {
            redirect('main');
        } else {
            redirect($this->CI->session->userdata('redirected_from'));
        }
    }

    // untuk logout sso
    function do_logout() {
        $this->CI->session->sess_destroy();
        session_destroy();
        redirect("http://182.23.52.249/SSO_WebService/login.php?source=" . base_url() . "admin/chekinglogin&app_code=MASSET");
    }

}
