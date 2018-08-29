<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sec_koneksi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('sec_koneksiM');
        $this->load->library('kripton');
        $this->load->helper('file');
        session_start();
    }

    public function index()
    {
        $this->home();
    }

    function home()
    {
        if (isset($_POST["btnCreate"])) {
            $this->simpan();
        } else {
            $this->template->set('title', 'Konfigurasi Koneksi Database');
            $this->template->load('template/templateKoneksi', 'admin/sec_koneksi_v');
        }
    }

    function simpan()
    {
        $config['upload_path'] = 'insyst/';
        $config['allowed_types'] = '*';
        $config['max_size'] = '100';

        $serverDb = trim($this->input->post('serverDb'));
        $namaDb = trim($this->input->post('namaDb'));
        $userDb = trim($this->input->post('userDb'));
        $passwdDb = trim($this->input->post('passwdDb'));
        $portDb = trim($this->input->post('portDb'));
/*ISI FILE DATABASE.PHP*/
        $dataKoneksi = '<?php  if ( ! defined(\'BASEPATH\')) exit(\'No direct script access allowed\');

$active_group = \'config1\';
$active_record = TRUE;

$db[\'config1\'][\'hostname\'] = \'' . $serverDb . ':' . $portDb . '\';
$db[\'config1\'][\'username\'] = \'' . $userDb . '\';
$db[\'config1\'][\'password\'] = \'' . $passwdDb . '\';
$db[\'config1\'][\'database\'] = \'' . $namaDb . '\';
$db[\'config1\'][\'dbdriver\'] = \'mysql\';
$db[\'config1\'][\'dbprefix\'] = \'\';
$db[\'config1\'][\'pconnect\'] = TRUE;
$db[\'config1\'][\'db_debug\'] = TRUE;
$db[\'config1\'][\'cache_on\'] = FALSE;
$db[\'config1\'][\'cachedir\'] = \'\';
$db[\'config1\'][\'char_set\'] = \'utf8\';
$db[\'config1\'][\'dbcollat\'] = \'utf8_general_ci\';
$db[\'config1\'][\'swap_pre\'] = \'\';
$db[\'config1\'][\'autoinit\'] = TRUE;
$db[\'config1\'][\'stricton\'] = FALSE; ';
/*END ISI FILE DATABASE.PHP*/
        /*LOAD LIBRARY UPLOAD FILE*/
        $this->load->library('upload', $config);
        /*UPLOAD KEY FILE*/
        if (!$this->upload->do_upload('institusiFile')) {//JIKA GAGAL UPLOAD TAMPILKAN PESAN ERROR
            $error = $this->upload->display_errors();

            $this->session->set_flashdata('error', $error);
            redirect('sec_koneksi/home');
        } else {
            //JIKA BERHASIL UPLOAD
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];
            $path_file = 'insyst/' . $file_name;

            //BACA KEY FILE
            $string_file = read_file($path_file);

            $kunci = 'microtechwebmitra';

            //DEKRIPSI FILE KEY
            $decryptedText = $this->kripton->decrypt($string_file, $kunci);

            //CEK SIZE OF KEY FILE
            $decryptedTextArray = explode('_', $decryptedText);
            $sizeArrayDecryptedTextArray = sizeof($decryptedTextArray);
            /*DEKRIPSI DALAM VARIABEL*/
            $namaInstitusi      = $decryptedTextArray[0];
            $serialNumber       = $decryptedTextArray[1];
            $maxCab             = $decryptedTextArray[2];
            $cipher             = $decryptedTextArray[3];
            $kodeCabang         = $decryptedTextArray[4];
            $namaCabang         = $decryptedTextArray[5];
            $passwdAdm          = $decryptedTextArray[6];
            $expired            = $decryptedTextArray[7];

            //SERIAL NUMBER DAN PASSWORD ADMINISTRATOR DIENKRIP DENGAN CIPHER
            $serialNumberEnc = $this->kripton->encrypt($serialNumber,$cipher);
            $passwdAdmEnc    = $this->kripton->encrypt($passwdAdm,$cipher);

            //HAPUS KEY FILE DARI DIREKTORI
            unlink($path_file);

            if($sizeArrayDecryptedTextArray==8){
                $file_name = 'database.php';
                $path_file = 'application/config/' . $file_name;
                //CREATE FILE DATABASE.PHP
                if (!write_file($path_file, $dataKoneksi)) {
                    //JIKA GAGAL CREATE FILE DATABASE.PHP TAMPILKAN PESAN ERROR
                    $this->session->set_flashdata('error', 'Create file koneksi gagal !');
                    redirect('sec_koneksi/home');
                } else {
                    //JIKA BERHASIL LANGSUNG TEST KONEKSI DATABASE
                    $this->testKoneksiDatabase($namaInstitusi,$serialNumber,$maxCab,$cipher,$kodeCabang,$namaCabang,$passwdAdm,$expired,$serialNumberEnc,$passwdAdmEnc);
                }

            }else{
                //JIKA KEY FILE SIZE NYA SALAH
                $this->session->set_flashdata('error', 'File anda bukan key Aplikasi Microtech !');
                redirect('sec_koneksi/home');
            }
            //JIKA KEY FILE SIZE NYA BENAR
        }

    }/*END FUNCTION SIMPAN*/
    public function testKoneksiDatabase($namaInstitusi,$serialNumber,$maxCab,$cipher,$kodeCabang,$namaCabang,$passwdAdm,$expired,$serialNumberEnc,$passwdAdmEnc){
        $testKoneksiDatabase = $this->sec_koneksiM->testKoneksiDatabase();
        if($testKoneksiDatabase){
            $this->cekTabelPi_institusi($namaInstitusi,$serialNumber,$maxCab,$cipher,$kodeCabang,$namaCabang,$passwdAdm,$expired,$serialNumberEnc,$passwdAdmEnc);
        }else{
            $this->session->set_flashdata('error', 'Test koneksi gagal !');
            redirect('sec_koneksi/home');
        }
    }
    public function cekTabelPi_institusi($namaInstitusi,$serialNumber,$maxCab,$cipher,$kodeCabang,$namaCabang,$passwdAdm,$expired,$serialNumberEnc,$passwdAdmEnc){
        $cekTabelPi_institusi = $this->sec_koneksiM->cekTabelPi_institusi();
        if($cekTabelPi_institusi){
            $this->cekTabelPi_cabang($namaInstitusi,$serialNumber,$maxCab,$cipher,$kodeCabang,$namaCabang,$passwdAdm,$expired,$serialNumberEnc,$passwdAdmEnc);
        }else{
            $this->session->set_flashdata('error', 'Tabel pi_institusi belum ada!');
            redirect('sec_koneksi/home');
        }
    }
    public function cekTabelPi_cabang($namaInstitusi,$serialNumber,$maxCab,$cipher,$kodeCabang,$namaCabang,$passwdAdm,$expired,$serialNumberEnc,$passwdAdmEnc){
        $cekTabelPi_cabang = $this->sec_koneksiM->cekTabelPi_cabang();
        if($cekTabelPi_cabang){
            $this->cekTabelSc_user($namaInstitusi,$serialNumber,$maxCab,$cipher,$kodeCabang,$namaCabang,$passwdAdm,$expired,$serialNumberEnc,$passwdAdmEnc);
        }else{
            $this->session->set_flashdata('error', 'Tabel pi_cabang belum ada!');
            redirect('sec_koneksi/home');
        }
    }
    public function cekTabelSc_user($namaInstitusi,$serialNumber,$maxCab,$cipher,$kodeCabang,$namaCabang,$passwdAdm,$expired,$serialNumberEnc,$passwdAdmEnc){
        $cekTabelSc_user = $this->sec_koneksiM->cekTabelSc_user();
        if($cekTabelSc_user){
            $this->cekTabelPi_kontrolhariproses($namaInstitusi,$serialNumber,$maxCab,$cipher,$kodeCabang,$namaCabang,$passwdAdm,$expired,$serialNumberEnc,$passwdAdmEnc);
        }else{
            $this->session->set_flashdata('error', 'Tabel sc_user belum ada!');
            redirect('sec_koneksi/home');
        }
    }
    public function cekTabelPi_kontrolhariproses($namaInstitusi,$serialNumber,$maxCab,$cipher,$kodeCabang,$namaCabang,$passwdAdm,$expired,$serialNumberEnc,$passwdAdmEnc){
        $cekTabelPi_kontrolhariproses = $this->sec_koneksiM->cekTabelPi_kontrolhariproses();
        if($cekTabelPi_kontrolhariproses){
            $this->cekRowTabelPi_kontrolhariproses($namaInstitusi,$serialNumber,$maxCab,$cipher,$kodeCabang,$namaCabang,$passwdAdm,$expired,$serialNumberEnc,$passwdAdmEnc);
        }else{
            $this->session->set_flashdata('error', 'Tabel pi_kontrolhariproses belum ada!');
            redirect('sec_koneksi/home');
        }
    }
    public function cekRowTabelPi_kontrolhariproses($namaInstitusi,$serialNumber,$maxCab,$cipher,$kodeCabang,$namaCabang,$passwdAdm,$expired,$serialNumberEnc,$passwdAdmEnc){
        $cekRowTabelPi_kontrolhariproses = $this->sec_koneksiM->cekRowTabelPi_kontrolhariproses();
        if($cekRowTabelPi_kontrolhariproses == 1){
            $this->session->set_flashdata('error', 'Tabel pi_kontrolhariproses sudah terisi!');
            redirect('sec_koneksi/home');
        }else{
            $insertRowPi_kontrolhariproses = $this->insertRowPi_kontrolhariproses();
            if(!$insertRowPi_kontrolhariproses){
                $this->session->set_flashdata('error', 'Row pi_kontrolhariproses gagal insert!');
                redirect('sec_koneksi/home');
            }else{
                $this->cekRowTabelPi_institusi($namaInstitusi,$serialNumber,$maxCab,$cipher,$kodeCabang,$namaCabang,$passwdAdm,$expired,$serialNumberEnc,$passwdAdmEnc);
            }
        }
    }
    public  function insertRowPi_kontrolhariproses(){
        $data = array(
            'KontrolAkses'		      	            =>1,
            'FlagProses'		                    =>0,
            'PeriksaHariLibur'		                =>'N',
            'TglOperasiHariLalu'		            =>date("Y-m-d",strtotime("-1 days")),
            'TglOperasiHariIni'		      	        =>date("Y-m-d"),
            'TglOperasiBerikut'		                =>date("Y-m-d",strtotime("+1 days")),
            'TglOperasi1BulanLalu'		        	=>date("Y-m-d",strtotime("-1 month")),
            'TglOperasi2BulanLalu'		        	=>NULL,
            'TglOperasi3BulanLalu'		        	=>NULL,
            'TglOperasi4BulanLalu'		        	=>NULL,
            'TglOperasi5BulanLalu'		        	=>NULL,
            'TglOperasi6BulanLalu'		        	=>NULL,
            'TglOperasi7BulanLalu'		        	=>NULL,
            'TglOperasi8BulanLalu'		        	=>NULL,
            'TglOperasi9BulanLalu'		        	=>NULL,
            'TglOperasi10BulanLalu'		        	=>NULL,
            'TglOperasi11BulanLalu'		        	=>NULL,
            'TglOperasi12BulanLalu'		        	=>NULL
        );

        $model = $this->sec_koneksiM->insertRowPi_kontrolhariproses($data);
        if($model){
            return TRUE;
        }else{
            return FALSE;
        }

    }
    public function cekRowTabelPi_institusi($namaInstitusi,$serialNumber,$maxCab,$cipher,$kodeCabang,$namaCabang,$passwdAdm,$expired,$serialNumberEnc,$passwdAdmEnc){
        $cekRowTabelPi_institusi = $this->sec_koneksiM->cekRowTabelPi_institusi();
        if($cekRowTabelPi_institusi==1){
            $cekNamaInstitusiSN = $this-> cekNamaInstitusiSN($namaInstitusi,$serialNumber,$maxCab,$cipher,$kodeCabang,$namaCabang,$passwdAdm,$expired,$serialNumberEnc,$passwdAdmEnc);
            /*JIKA */
            if(!$cekNamaInstitusiSN){
                $this->session->set_flashdata('error', 'Institusi gagal disimpan, nama institusi atau SN tidak sama!');
                redirect('sec_koneksi/home');
            }else{
                $cekRowTabelPi_cabang = $this->cekRowTabelPi_cabang($namaInstitusi,$serialNumber,$maxCab,$cipher,$kodeCabang,$namaCabang,$passwdAdm,$expired,$serialNumberEnc,$passwdAdmEnc);
                if($cekRowTabelPi_cabang){
                    $insertRowPi_cabang = $this->insertRowPi_cabang($namaInstitusi,$serialNumber,$maxCab,$cipher,$kodeCabang,$namaCabang,$passwdAdm,$expired,$serialNumberEnc,$passwdAdmEnc);
                    if($insertRowPi_cabang){
                        $cekRowTabelSc_user = $this->sec_koneksiM->cekRowTabelSc_user();
                        if($cekRowTabelSc_user==0){
                            $insertRowSc_user = $this->insertRowSc_user($namaInstitusi,$serialNumber,$maxCab,$cipher,$kodeCabang,$namaCabang,$passwdAdm,$expired,$serialNumberEnc,$passwdAdmEnc);
                            if($insertRowSc_user){
                                $this->session->set_flashdata('success', 'User administrator sukses disimpan, Koneksi database sistem selesai!');
                                redirect('sec_koneksi/home');
                            }else{
                                $this->session->set_flashdata('error', 'User administrator gagal disimpan, Koneksi database gagal!');
                                redirect('sec_koneksi/home');
                            }
                        }else{
                            $this->session->set_flashdata('error', 'Tabel sc_user sudah terdapat user administrator!');
                            redirect('sec_koneksi/home');
                        }
                    }else{
                        $this->session->set_flashdata('error', 'Pi_cabang gagal disimpan!');
                        redirect('sec_koneksi/home');
                    }
                }else{
                    $this->session->set_flashdata('error', 'Kosongkan dahulu tabel pi_cabang, proses simpan dibatalkan!');
                    redirect('sec_koneksi/home');
                }

                //$this->session->set_flashdata('success', 'Sampai di sini oke, nama institusi atau SN  sama!');
               // redirect('sec_koneksi/home');
            }
        }elseif($cekRowTabelPi_institusi == 0){
            $insertRowPi_institusi = $this->insertRowPi_institusi($namaInstitusi,$serialNumber,$maxCab,$cipher,$kodeCabang,$namaCabang,$passwdAdm,$expired,$serialNumberEnc,$passwdAdmEnc);
            if(!$insertRowPi_institusi){
                $this->session->set_flashdata('error', 'Institusi gagal disimpan!');
                redirect('sec_koneksi/home');
            }else{
                $cekRowTabelPi_cabang = $this->cekRowTabelPi_cabang($namaInstitusi,$serialNumber,$maxCab,$cipher,$kodeCabang,$namaCabang,$passwdAdm,$expired,$serialNumberEnc,$passwdAdmEnc);
                if($cekRowTabelPi_cabang){
                    $insertRowPi_cabang = $this->insertRowPi_cabang($namaInstitusi,$serialNumber,$maxCab,$cipher,$kodeCabang,$namaCabang,$passwdAdm,$expired,$serialNumberEnc,$passwdAdmEnc);
                    if($insertRowPi_cabang){
                        $cekRowTabelSc_user = $this->sec_koneksiM->cekRowTabelSc_user();
                        if($cekRowTabelSc_user==0){
                            $insertRowSc_user = $this->insertRowSc_user($namaInstitusi,$serialNumber,$maxCab,$cipher,$kodeCabang,$namaCabang,$passwdAdm,$expired,$serialNumberEnc,$passwdAdmEnc);
                            if($insertRowSc_user){
                                $this->session->set_flashdata('success', 'User administrator sukses disimpan, Koneksi database sistem selesai!');
                                redirect('sec_koneksi/home');
                            }else{
                                $this->session->set_flashdata('error', 'User administrator gagal disimpan, Koneksi database gagal!');
                                redirect('sec_koneksi/home');
                            }
                        }else{
                            $this->session->set_flashdata('error', 'Tabel sc_user sudah terdapat user administrator!');
                            redirect('sec_koneksi/home');
                        }
                    }else{
                        $this->session->set_flashdata('error', 'Pi_cabang gagal disimpan!');
                        redirect('sec_koneksi/home');
                    }
                }else{
                    $this->session->set_flashdata('error', 'Kosongkan dahulu tabel pi_cabang, proses simpan dibatalkan!');
                    redirect('sec_koneksi/home');
                }
                //$this->session->set_flashdata('success', 'Sampai di sini oke!');
                //redirect('sec_koneksi/home');
            }
        }else{
            $this->session->set_flashdata('error', 'Institusi lebih dari satu, proses simpan dibatalkan!');
            redirect('sec_koneksi/home');
        }
    }
    public  function insertRowPi_institusi($namaInstitusi,$serialNumber,$maxCab,$cipher,$kodeCabang,$namaCabang,$passwdAdm,$expired,$serialNumberEnc,$passwdAdmEnc){
        $data = array(
            'NamaInstitusi'                     =>$namaInstitusi,
            'Alamat'		                    =>NULL,
            'Kecamatan'		                    =>NULL,
            'Kota'		                        =>NULL,
            'DaerahTK1'		      	            =>NULL,
            'KdPos'		                        =>NULL,
            'Telp'		        	            =>NULL,
            'Fax'		        	            =>NULL,
            'Email'		        	            =>NULL,
            'WebSite'		        	        =>NULL,
            'NPWP'		        	            =>NULL,
            'SIUP'		        	            =>NULL,
            'TDP'		        	            =>NULL,
            'KantorPusat'		        	    =>$kodeCabang,
            'SerialNumber'		        	    =>$serialNumberEnc,
            'NoLedgerTolakan'		        	=>NULL,
            'TimerLogOff'		        	    =>10,
            'SID_IdLembaga'		        	    =>NULL,
            'SID_IdBank'		        	    =>NULL,
            'FolderReport'		        	    =>NULL
        );

        $model = $this->sec_koneksiM->insertRowPi_institusi($data);
        if($model){
            return TRUE;
        }else{
            return FALSE;
        }

    }
    public function cekNamaInstitusiSN($namaInstitusi,$serialNumber,$maxCab,$cipher,$kodeCabang,$namaCabang,$passwdAdm,$expired,$serialNumberEnc,$passwdAdmEnc){
        $model1 = $this->sec_koneksiM->getNamaInstitusiSN();

        $namaInstitusiDec = $model1[0]->NamaInstitusi;
        $serialNumberDec = $this->kripton->decrypt($model1[0]->SerialNumber,$cipher);

        if(($namaInstitusi<>$namaInstitusiDec)&& ($serialNumber<>$serialNumberDec)) {
            return FALSE;
        }elseif(($namaInstitusi<>$namaInstitusiDec)&& ($serialNumber==$serialNumberDec)){
            return FALSE;
        }elseif(($namaInstitusi==$namaInstitusiDec)&& ($serialNumber<>$serialNumberDec)){
            return FALSE;
        }else{
            return TRUE;
        }
    }
    public function cekRowTabelPi_cabang($namaInstitusi,$serialNumber,$maxCab,$cipher,$kodeCabang,$namaCabang,$passwdAdm,$expired,$serialNumberEnc,$passwdAdmEnc){
        $cekRowTabelPi_cabang = $this->sec_koneksiM->cekRowTabelPi_cabang();
        if($cekRowTabelPi_cabang==0){
            return TRUE;
        }else{
            return FALSE;
            //$this->session->set_flashdata('error', 'Kosongkan dahulu tabel pi_cabang, proses simpan dibatalkan!');
            //redirect('sec_koneksi/home');
        }
    }
    public  function insertRowPi_cabang($namaInstitusi,$serialNumber,$maxCab,$cipher,$kodeCabang,$namaCabang,$passwdAdm,$expired,$serialNumberEnc,$passwdAdmEnc){
        $data = array(
            'KodeCabang'                     =>$kodeCabang,
            'NamaCabang'		             =>$namaCabang,
            'Alamat'		                 =>NULL,
            'Kecamatan'		                 =>NULL,
            'Kota'		      	             =>NULL,
            'DaerahTK2'		                 =>NULL,
            'DaerahTK1'		        	     =>NULL,
            'KdPos'		        	         =>NULL,
            'Telp'		        	         =>NULL,
            'Fax'		        	         =>NULL,
            'Email'		        	         =>NULL,
            'WebSite'		        	     =>NULL,
            'LevelCabang'		        	 =>NULL,
            'CabangInduk'		        	 =>NULL,
            'StatusCabang'		        	 =>NULL,
            'Uplink'		        	     =>NULL,
            'DownLink'		        	     =>$namaCabang,
            'TransBesarPerTran'		         =>NULL,
            'TransBesarPerHari'		         =>NULL,
            'TransBesarPerBulan'		     =>NULL
        );

        $model = $this->sec_koneksiM->insertRowPi_cabang($data);
        if($model){
            return TRUE;
        }else{
            return FALSE;
        }

    }
    public  function insertRowSc_user($namaInstitusi,$serialNumber,$maxCab,$cipher,$kodeCabang,$namaCabang,$passwdAdm,$expired,$serialNumberEnc,$passwdAdmEnc){

        $data = array(
            'UserID'                                =>'Administrator',
            'KodeCabang'		                    =>$kodeCabang,
            'KodeOutlet'		                    =>NULL,
            'NamaUser'		                        =>'Administrator System',
            'TmpLahir'		      	                =>NULL,
            'TglLahir'		                        =>NULL,
            'JnsKelamin'		        	        =>NULL,
            'Agama'		        	                =>NULL,
            'StsNikah'		        	            =>NULL,
            'Alamat'		        	            =>NULL,
            'Kota'		        	                =>NULL,
            'KdPos'		        	                =>NULL,
            'TelpRmh'		        	            =>NULL,
            'HandPhone'		        	            =>NULL,
            'Email'		        	                =>NULL,
            'TglMulaiKerja'		        	        =>NULL,
            'Password'		        	            =>$passwdAdmEnc,
            'CounterErrPassword'		        	=>0,
            'StsPassword'		        	        =>'A',
            'UmurPassword'		        	        =>10,
            'WaktuKadaluarsaPassword'		        =>NULL,
            'StatusUser'		        	        =>NULL,
            'StsAktif'		        	            =>'Y',
            'KetStsAktif'		        	        =>NULL,
            'WaktuOperasiMulai'		        	    =>'00:00',
            'WaktuOperasiSelesai'		        	=>'23:59',
            'KodeBagian'		        	        =>'99999',
            'LevelUser'		        	            =>9,
            'AuditID'		        	            =>0,
        );

        $model1 = $this->sec_koneksiM->insertRowSc_user($data);
        $userId = 'Administrator';
        if($model1){
            $model2 = $this->sec_koneksiM->getIdUserAdministrator($userId);
            $userId = $model2[0]->UserID;
            $passwdCombine = $passwdAdm.$userId;
            $passwdAdmEnc2 = $this->kripton->encrypt($passwdCombine,$cipher);
            $data = array(
                'Password'        	=>$passwdAdmEnc2
            );
            $model3 = $this->sec_koneksiM->updatePasswdAdministrator($userId,$data);
        }

        if($model1 && $model3){
            return TRUE;
        }else{
            return FALSE;
        }

    }

}

/* End of file sec_koneksiM.php */
/* Location: ./application/controllers/sec_koneksiM.php */