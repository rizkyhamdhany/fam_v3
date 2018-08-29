<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_m extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database('config1');
    }
    
    public function getIdMax(){
		$sql= "select menu_id from sec_menu";
		$query = $this->db->query($sql);
		$jml = $query->num_rows();
		if($jml == 0){
			$id_kyw = "001";
			return $id_kyw;
		}else{
			$sql= "select max((menu_id)) as id_kyw from sec_menu";
			$query = $this->db->query($sql);
			$hasil = $query->result();
			$id_kyw =  $hasil[0]->id_kyw;
			$id_kyw = sprintf('%01u',$id_kyw+1);
			return $id_kyw;
            }
        }

    function get_UserGroup() {
        $sql = "SELECT value from web_sysid where keyname ='usergroup_proses21'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function get_menu_id($menu_uri) {
        $this->db->select('menu_id,menu_nama,menu_header,parent');
        $this->db->from('sec_menu');
        $this->db->where('menu_uri', $menu_uri);
        $hasil = $this->db->get();
        return $hasil->result();
    }

    public function get_data($id_lokasi) {
        $sql = "select mt.nama_tower,
				(select count(mro.id_room) from master_room mro where mro.status_sewa = '1' and mro.id_tower = mt.id_tower) as terisi,
				(select count(mro.id_room) from master_room mro where mro.status_sewa = '0' and mro.id_tower = mt.id_tower) as kosong 
				from master_tower mt 
				left join master_lokasi ml on mt.id_lokasi = ml.id_lokasi
				where  ml.id_lokasi = '" . $id_lokasi . "' group by mt.id_tower 
				";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function get_data_bayar($lokasi, $tanggal) {
        $sql = "select * from master_sewa m 
				left join master_room mr on m.id_room = mr.id_room
				where m.tgl_trans = '" . $tanggal . "' and m.status_uangjaminan = '1' and mr.id_lokasi = '" . $lokasi . "'
				";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function get_lembaga_nama() {
        $this->db->select('value');
        $this->db->from('web_sysid');
        $this->db->where('keyname', 'web_lembaga_nama1');
        //$this->db->or_where('keyname', 'web_nama_lembaga2'); 
        $query = $this->db->get();
        return $query->result();
    }

    // angga
    public function get_tanggal_hari_ini() {
        $this->db->select('value');
        $this->db->from('web_sysid');
        $this->db->where('keyname', 'web_tanggal_hari_ini');
        $query = $this->db->get();
        return $query->result();
    }

    // NEW
    public function get_aplikasi_copyright() {
        $this->db->select('value');
        $this->db->from('web_sysid');
        $this->db->where('keyname', 'web_copyright_year');
        $this->db->or_where('keyname', 'web_copyright_content');
        $this->db->or_where('keyname', 'web_copyright_auth');
        $query = $this->db->get();
        return $query->result();
    }

    // end NEW
    public function updatePassword($userId, $data) {
        $model1 = $this->db->where('no_va_jaminan', $userId);
        $model2 = $this->db->update('master_room', $data);
        if ($model1 && $model2) {
            return true;
        } else {
            return false;
        }
    }

    public function update_room($roomId, $data) {
        $model1 = $this->db->where('id_room', $roomId);
        $model2 = $this->db->update('master_room', $data);
        if ($model1 && $model2) {
            return true;
        } else {
            return false;
        }
    }

}

/* End of file homeModel.php */
/* Location: ./application/models/homemodel.php */