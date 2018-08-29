<?php

Class Menu_mdl extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function seldata($id) {
        // $this->db->select('*');
        // $this->db->from('menu');
        // $this->db->where('id_menugroup',$id);
        // //$this->db->where('a.is_trash',0);
        // $query = $this->db->get();
        // if($query->num_rows > 0) {
        //           return $query->result();
        //       } 
        // else {
        //           return false;
        //       }

        $this->db2 = $this->load->database('config1', true);
        $qdata = $this->db2->query("SELECT * 
                                FROM [menu]									   
                                WHERE id_menugroup='$id'
                                AND is_trash=0 ");

        if ($qdata->num_rows() > 0) {
            return $qdata->result();
        } else {
            return false;
        }
    }

    function get_menuname($id) {
        $this->db2 = $this->load->database('config1', true);
        $qdata = $this->db2->query("SELECT menugroup_name 
										   FROM [menu_group]									   
										   WHERE id_menugroup= '$id'
										   ");
        return $qdata->result_array()[0]['menugroup_name'];
    }

    public function sel_updatemenu($id) {
        // $this->db->select('*');
        // $this->db->from('menu');
        // $this->db->where('id',$id);
        // //$this->db->where('a.is_trash',0);
        // $query = $this->db->get();
        // if($query->num_rows > 0) {
        //           return $query->result();
        //       } 
        // else {
        //           return false;
        //       }
        $this->db2 = $this->load->database('config1', true);
        $qdata = $this->db2->query("SELECT * 
										   FROM [menu] a									   
										   WHERE id= '$id' 
										   AND is_trash=0
										   ");
        // echo $this->db->last_query();die();
        //return $qdata->num_rows();
        if ($qdata->num_rows() > 0) {
            return $qdata->result();
        } else {
            return false;
        }
    }

    function maxid() {

        // $query = $this->db->query("SELECT MAX(id) AS idmax FROM menu");
        // return $query->result();
        $this->db2 = $this->load->database('config1', true);
        $qdata = $this->db2->query("SELECT MAX(id) AS idmax FROM [menu]
										   ");
        return $qdata->result();
    }

    function sel_usergroup() {
        //  $query = $this->db->query("SELECT id FROM user_group");
        // return $query->result();
        $this->db2 = $this->load->database('config1', true);
        $qdata = $this->db2->query("SELECT id FROM [user_group]
										   ");
        return $qdata->result();
    }

    function sel_hak_acces($id) {
        // $this->db->select('*');
        // $this->db->from('menu_hakaccess a');
        // $this->db->join('menu b','b.id=a.menu_id');
        // $this->db->where('b.id_menugroup',$id);
        // $this->db->where('b.is_trash',0);
        // $this->db->order_by('b.id', 'ASC');
        // $query = $this->db->get();
        // if($query->num_rows > 0) {
        //           return $query->result();
        //       } 
        // else {
        //           return false;
        //       }

        $this->db2 = $this->load->database('config1', true);
        $qdata = $this->db2->query("SELECT * 
										   FROM [menu_hakaccess] a									   
										   INNER JOIN [menu] b ON b.id=a.menu_id
										   WHERE b.id_menugroup= '$id' 
										   AND b.is_trash=0
										   ORDER BY b.id ASC
										   ");
        // echo $this->db->last_query();die();
        //return $qdata->num_rows();
        if ($qdata->num_rows() > 0) {
            return $qdata->result();
        } else {
            return false;
        }
    }

    function sel_mastermenu() {
        // $this->db->where('is_trash',0);
        // $data = $this->db->get('menu_group');
        // return $data->result();

        $this->db2 = $this->load->database('config1', true);
        $qdata = $this->db2->query("SELECT * FROM [menu_group]
									WHERE is_trash=0
										   ");
        return $qdata->result();
    }

    function jumlah() {
        // $query = $this->db->query("SELECT COUNT(id_menugroup) AS jml FROM menu_group where is_trash=0");
        // return $query->result();
        $this->db2 = $this->load->database('config1', true);
        $qdata = $this->db2->query("SELECT COUNT(id_menugroup) AS jml FROM [menu_group] where is_trash=0
										   ");
        return $qdata->result();
    }

    public function get_groupmenu($sessid) {
        //echo $sessid;
        // $this->db->cache_on();
        // $this->db->select('*');
        // $this->db->from('menu_hakaccess_menugroup a');
        // $this->db->join('menu_group b','b.id_menugroup=a.grp_id');
        // $this->db->where('a.is_menu',1);
        // $this->db->where('a.usergroup_id',$sessid);
        // $this->db->where('b.is_trash',0);
        // //$this->db->order_by('id', 'ASC');
        // $query = $this->db->get();
        // if($query->num_rows > 0) {
        //           return $query->result();
        //       } 
        // else {
        //           return false;
        //       }
        $this->db2 = $this->load->database('config1', true);
        $qdata = $this->db2->query("SELECT * 
										   FROM [menu_hakaccess_menugroup] a									   
										   INNER JOIN [menu_group] b ON b.id_menugroup=a.grp_id
										   WHERE a.usergroup_id LIKE '%" . $sessid . "%'
										   AND a.is_menu=1 
										   AND b.is_trash=0
										   ORDER BY id ASC
										   ");
        // echo $this->db->last_query();die();
        //return $qdata->num_rows();
        if ($qdata->num_rows() > 0) {
            return $qdata->result();
        } else {
            return false;
        }
    }

    public function get_menusetting($id, $sessid) {
        // $this->db->cache_on();
        // $this->db->select('*');
        // $this->db->from('menu_hakaccess a');
        // $this->db->join('menu b','b.id=a.menu_id');
        // $this->db->where('a.usergroup_id',$sessid);
        // $this->db->where('a.is_menu',1);
        // $this->db->where('b.is_trash',0);
        // $this->db->where('b.id_menugroup',$id);
        // $this->db->order_by('b.by_order', 'ASC');
        // $query = $this->db->get();
        // if($query->num_rows > 0) {
        //           return $query->result();
        //       } 
        // else {
        //           return false;
        //       }
        $this->db2 = $this->load->database('config1', true);
        $qdata = $this->db2->query("SELECT * 
										   FROM [menu_hakaccess] a									   
										   INNER JOIN [menu] b ON b.id=a.menu_id
										   WHERE a.usergroup_id LIKE '%" . $sessid . "%'
										   AND a.is_menu=1 
										   AND b.is_trash=0
										   AND b.id_menugroup LIKE '%" . $id . "%'
										   ORDER BY b.by_order ASC
										   ");
        // echo $this->db->last_query();die();
        //return $qdata->num_rows();
        if ($qdata->num_rows() > 0) {
            return $qdata->result();
        } else {
            return false;
        }
    }

    public function get_menusetting2($sessid, $id) {
        $this->db2 = $this->load->database('config1', true);
//        old
//        $qdata = $this->db2->query("SELECT * 
//                        FROM [menu_hakaccess] a									   
//                        INNER JOIN [menu] b ON b.id=a.menu_id
//                        WHERE a.usergroup_id LIKE '%" . $sessid . "%'
//                        AND b.controller_name LIKE '%" . $id . "%' ");
         $qdata = $this->db2->query("SELECT * 
                        FROM [dbo].[sec_menu]
                        WHERE menu_allowed LIKE '%" . $sessid . "%'
                        AND menu_nama LIKE '%" . $id . "%' ");
        if ($qdata->num_rows() > 0) {
            return $qdata->result();
        } else {
            return false;
        }
    }

    function insert_menu($data) {
        $this->db2 = $this->load->database('config1', true);
        $qdata = $this->db2->query("SET IDENTITY_INSERT [dbo].[menu] ON");
        $qdata = $this->db2->query("INSERT into [menu] 
									(	id,
										id_menugroup,
										menu_name,
										controller_name,
										link,
										description,
										by_order,
										is_trash) 
									values(
										'" . $data['id'] . "',
										'" . $data['id_menugroup'] . "',
										'" . $data['menu_name'] . "',
										'" . $data['controller_name'] . "',
										'" . $data['link'] . "',
										'" . $data['description'] . "',
										'" . $data['by_order'] . "',
										0
										)
										   ");
        $qdata = $this->db2->query("SET IDENTITY_INSERT [dbo].[menu] OFF");
        return;
    }

    function update_menu($data) {
        $this->db2 = $this->load->database('config1', true);
        $qdata = $this->db2->query("SET IDENTITY_INSERT [dbo].[menu] ON");
        $qdata = $this->db2->query("UPDATE [menu] 
									SET	
										menu_name='" . $data['menu_name'] . "',
										controller_name='" . $data['controller_name'] . "',
										description='" . $data['description'] . "'
									WHERE id='" . $data['id'] . "'

										   ");
        $qdata = $this->db2->query("SET IDENTITY_INSERT [dbo].[menu] OFF");
        return;
    }

    function insert_hak_akses($data) {
        $this->db2 = $this->load->database('config1', true);
        // $qdata = $this->db2->query("SET IDENTITY_INSERT [dbo].[menu_hakaccess] ON");
        $qdata = $this->db2->query("INSERT into [menu_hakaccess] 
									(	id_menugroup,
										menu_id,
										usergroup_id,
										is_menu,
										is_view,
										is_add,
										is_update,
										is_delete) 
									values(
										'" . $data['id_menugroup'] . "',
										'" . $data['menu_id'] . "',
										'" . $data['usergroup_id'] . "',
										'" . $data['is_menu'] . "',
										'" . $data['is_view'] . "',
										'" . $data['is_add'] . "',
										'" . $data['is_update'] . "',
										'" . $data['is_delete'] . "'
										
										)
										   ");
        // $qdata = $this->db2->query("SET IDENTITY_INSERT [dbo].[menu_hakaccess] OFF");	
        return;
    }

}

?>