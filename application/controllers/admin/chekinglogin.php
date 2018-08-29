<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Chekinglogin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/Chekinglogin_mdl');
    }

    public function index() {

        $secret_code = strtoupper("$3cretc0d3" . $_GET['UserName'] . ",MASSET," . $_GET['IDSDM']);
        //$apiuser = file_get_contents("http://103.76.17.197/SSO_WebService/crosscheck.php?secret=" . $secret_code . "&&app_code=MASSET&username=" . $_GET['UserName'] . "");
        $apiuser = file_get_contents("http://182.23.52.249/SSO_WebService/crosscheck.php?secret=" . $secret_code . "&&app_code=MASSET&username=" . $_GET['UserName'] . "");
        if ($apiuser) {
            $userlog = json_decode($apiuser);
            $userdata = $userlog->login[0];
        } else {
            echo 'Maaf untuk sementara didapat diakses. Coba beberapa saat lagi!!!';
        }

//         echo "<pre>";
//         print_r($apiuser);die();

        $chekBranch = $this->Chekinglogin_mdl->chek_branch($userdata->data[0]->cabang, $userdata->data[0]->lokasi_kerja);
        $chekPosition = $this->Chekinglogin_mdl->chek_position($userdata->data[0]->posisi_nama);
        $chekDivisi = $this->Chekinglogin_mdl->chek_divisi($userdata->data[0]->organisasi_name);
        $chekinguser = $this->Chekinglogin_mdl->chek_user($userdata->data[0]->nik);
        $usr = $chekinguser[0];

        if (!empty(trim($userdata->data[0]->nik))) {
            if (empty($chekinguser)) {
                die('tes');
                $maxid = $this->Chekinglogin_mdl->maxuser();
                $id = $maxid[0]->maxid + 1;
                $idsdm = $userdata->data[0]->idsdm;
                $nik = $userdata->data[0]->nik;
                $usrname = $userdata->data[0]->username;
                $name = $userdata->data[0]->nama;
                $email = $userdata->data[0]->email;
                $branchid = $chekBranch[0]->BranchID;
                $zoneid = $chekBranch[0]->ZoneID;
                if (!empty($chekPosition)) {
                    $positionid = $chekPosition[0]->PositionID;
                } else {
                    $positionid = "";
                }

                if (!empty($chekDivisi[0]->DivisionID)) {
                    $division = $chekDivisi[0]->DivisionID;
                } else {
                    $division = "0";
                }

                $foto = $userdata->data[0]->foto;
                $this->Chekinglogin_mdl->save_user($id, $idsdm, $nik, $usrname, $name, $email, $positionid, $branchid, $zoneid, $division, $foto);
                $this->Chekinglogin_mdl->save_employee($id, $idsdm, $nik, $usrname, $name, $email, $positionid, $branchid, $zoneid, $division, $foto);
            }
            $chekinguser2 = $this->Chekinglogin_mdl->chek_user($userdata->data[0]->nik);
            $usr2 = $chekinguser2[0];
            //multiinserting
            if ($usr2->user_groupid == '1') {
                $this->check_user_avail();
            }
            if ($usr2->BranchID == "") {
                $brc = 1;
            } else {
                $brc = $usr2->BranchID;
            }

            if ($usr2->user_photo == '') {
                $foto = "" . base_url() . "assets/img/avatars/noPhoto.jpg";
            } else {
                $foto = $usr2->user_photo;
            }
            $session_data = array(
                'user_id' => $usr2->user_id,
                'name' => $usr2->name,
                'user_name' => $usr2->user_name,
                'user_email' => $usr2->user_email,
                'PositionID' => $usr2->PositionID,
                'BranchID' => $brc,
                'BranchName' => $usr2->BranchName,
                'BranchCode' => $usr2->BranchCode,
                'DivisionID' => $usr2->DivisionID,
                'DivisionCode' => $usr2->DivisionCode,
                'ZoneName' => $usr2->ZoneName,
                'ZoneID' => $usr2->ZoneID,
                'groupid' => $usr2->user_groupid,
                'groupname' => '',
                'foto' => $foto,
                'is_login' => 1,
//                ==================local mtm
                'id_user' => $usr2->user_id,
                'namaKyw' => $usr2->user_name,
                'usergroup' => $usr2->user_groupid,
                'usergroup_desc' => ''
            );
//        print_r($session_data);die();
            $this->session->set_userdata($session_data);
            $this->auth->redirect_me();
        } else {
            $this->auth->redirect_me();
        }
//        $this->auth->redirect_me();
    }

    public function check_user_avail() {

        // $username='event';
        // $password='event';
        // $URL='http://182.23.52.249/WebService/SSO_Mobile/getSSObyAppCode.php?&&app_code=MASSET&user=event&pas=event';
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL,$URL);
        // curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        // curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        // curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        // $result=curl_exec ($ch);
        // $userdata=json_decode($result);
        // $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
        // curl_close ($ch);
        // echo "<pre>";
        // print_r($result);die();

        $apiuser = file_get_contents("http://event:event@182.23.52.249/WebService/SSO_Mobile/getSSObyAppCode.php?&&app_code=MASSET");
        $userdata = json_decode($apiuser);
        // echo "<pre>";
        // print_r($userdata);die();
        foreach ($userdata->profile as $mydata) {
            foreach ($mydata->data as $values) {
                $nik = $values->profile_nip;
                //echo $values->profile_nama . "<br>";

                $chekBranch = ''; //$this->Chekinglogin_mdl->chek_branch($values->cabang,$values->lokasi_kerja);
                $chekPosition = $this->Chekinglogin_mdl->chek_position($values->profile_posisi);
                //$chekUnit=$this->Chekinglogin_mdl->chek_unit($userdata->data[0]->unit);
                $chekDivisi = $this->Chekinglogin_mdl->chek_divisi($values->profile_organisasi_name);
                $chekinguser = $this->Chekinglogin_mdl->chek_user($values->profile_nip);


                if (!empty($chekBranch)) {
                    $branchid = $chekBranch[0]->BranchID;
                    $zoneid = $chekBranch[0]->ZoneID;
                } else {
                    $branchid = 1;
                    $zoneid = 1;
                }

                if (empty($chekinguser)) {
                    $maxid = $this->Chekinglogin_mdl->maxuser();
                    $id = $maxid[0]->maxid + 1;
                    $idsdm = $values->profile_id_sdm;
                    $nik = $values->profile_nip;
                    $usrname = $values->profile_username;
                    $name = $values->profile_nama;
                    $email = $values->profile_email;
                    // $branchid = ''; //$chekBranch[0]->BranchID;
                    // $zoneid = ''; //$chekBranch[0]->ZoneID;
                    if (!empty($chekPosition)) {
                        $positionid = $chekPosition[0]->PositionID;
                    } else {
                        $positionid = "";
                    }

                    if (!empty($chekDivisi[0]->DivisionID)) {
                        $division = $chekDivisi[0]->DivisionID;
                    } else {
                        $division = "0";
                    }

                    $foto = ""; //.base_url()."assets/img/avatars/noPhoto.jpg"; //$userdata['foto'];
                    $this->Chekinglogin_mdl->save_user($id, $idsdm, $nik, $usrname, $name, $email, $positionid, $branchid, $zoneid, $division, $foto);
                    $this->Chekinglogin_mdl->save_employee($id, $idsdm, $nik, $usrname, $name, $email, $positionid, $branchid, $zoneid, $division, $foto);
                };
            }
        }return;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */