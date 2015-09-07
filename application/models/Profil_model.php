<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil_model extends CI_Model {

    /**
     * id
     * sym as nam
     * description
     * width_for_glass
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
                'sym' => $row->sym,
                'description' => $row->description,
                'width_for_glass' => $row->width_for_glass
            );
            $res[] = $arow;
        }

        return $res;
    }

    /**
     * get profil description by sym
     * @param $sym
     * @return string
     */
    public function get_description_by_sym($sym){
        $res = '';

        $query = $this->db->get_where('profil' , array('sym' => $sym), 1);
        if($query->num_rows() > 0){
            $row = $query->row();
            $res = $row->description;
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
            $res['width_for_glass'] = $row->width_for_glass;
        }

        return $res;
    }

    /**
     * read row by sym
     * @param $sym
     */
    public function get_by_sym($sym){
        $res = array();

        $query = $this->db->get_where('profil', array('sym' => $sym));
        if($query->num_rows() > 0){
            $row = $query->row();
            $res['id'] = $row->id;
            $res['nam'] = $row->sym;
            $res['description'] = $row->description;
            $res['width_for_glass'] = $row->width_for_glass;
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
            'description' => $row['description'],
            'width_for_glass' => $row['width_for_glass'],
        );
        $this->db->insert('profil', $ar);
    }

    /*
     * update by id
     */
    public function update_by_id($id, $row){
        $ar = array(
            'sym' => $row['nam'],
            'description' => $row['description'],
            'width_for_glass' => $row['width_for_glass'],
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

    /**
     * get select-option set for all
     * ordered by sym
     * $attr - attributes as array
     */
    public function get_html_select($attr = array()){
        $res = "";

        $loc = '';
        foreach ($attr as $atrkey => $atrval) {
            $loc = $atrkey . '="' . $atrval . '" ';
        }

        $res = "<select $loc >";

        $res .= "<option value=\"0\">-- не выбран --</option>";

        $arselect = $this->get_all();
        foreach($arselect as $row){
            $sym = $row['sym'];
            $des = $row['description'];
            $res .= "<option value=\"$sym\">$des</option>";
        }
        $res .= '</select>';

        return $res;
    }

    /**
     * Получить площадь СП для рамы указанного размера
     * возв -1 - если ошибка
     * @param $profil_sym
     * @param $width
     * @param $height
     */
    public function get_glass_area($profil_sym, $width, $height){
        $res = -1;

        $row = $this->get_by_sym($profil_sym);
        if(!empty($row)){
            $wg = $row['width_for_glass'];
            $res = ($width - 2 * $wg) * ($height - 2 * $wg);
            if($res < 0 )
            {
                $res = -1;
            }
        }

        return $res;
    }



} 