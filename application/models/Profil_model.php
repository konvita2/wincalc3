<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil_model extends CI_Model {

    /**
     * id
     * sym as nam
     * description
     */

    /**
     *
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * get array of rows ordered by sym(nam)
     */
    public function get_all(){
        $res = array();

        $this->db->order_by('sym');
        $query = $this->db->get('profil');
        foreach($query->result() as $row){
            $arow = array(
                'id' => $row->id,
                'nam' => $row->sym,
                'description' => $row->description
            );
            $res[] = $arow;
        }

        return $res;
    }

    /**
     * read row by id
     */
    public function get_by_id($id){
        $res = array();

        $query = $this->db->get_where('profil', array('id' => $id));
        if($query->num_rows() > 0){
            $row = $query->row();
            $res['id'] = $row->id;
            $res['nam'] = $row->sym;
            $res['description'] = $row->description;
        }

        return $res;
    }

    /**
     * define existing by id
     * @param $id
     */
    public function exist_by_id($id){
        $res = FALSE;

        $query = $this->db->get_where('profil', array('id' => $id));
        if($query->num_rows() > 0){
            $res = TRUE;
        }

        return $res;
    }

    /**
     * @param $row (nam/description)
     */
    public function add($row){
        $ar = array(
            'sym' => $row['nam'],
            'description' => $row['description']
        );
        $this->db->insert('profil', $ar);
    }

    /*
     * update by id
     */
    public function update_by_id($id, $row){
        $ar = array(
            'sym' => $row['nam'],
            'description' => $row['description']
        );
        $this->db->where('id', $id);
        $this->db->update('profil', $ar);
    }

    /**
     * @param $id
     */
    public function delete_by_id($id){
        $this->db->delete('profil', array('id' => $id));
    }




} 