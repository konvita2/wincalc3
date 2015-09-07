<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 06.07.2015
 * Time: 14:05
 */

class Glass_model extends CI_Model {

    public $id = 0;
    public $nam = '';
    public $description = '';
    public $cur_name = '';
    public $price = 0;

    public function __construct(){
        parent::__construct();
    }

    /**
     * вернуть строку ввиде массива по имени стеклопакета
     * @param $nam
     * @return array
     */
    function get_row_by_name($nam){
        $res = array();

        $this->db->where('nam',$nam);
        $qres = $this->db->get('glass',1);
        foreach($qres->result_array() as $qrow){
            $res = $qrow;
            break;
        }

        return $res;
    }

    /**
     * вернуть массив со списком всех стеклопакетов упорядоченных по наименованию
     * @return array
     */
    function get_all(){
        $res = array();

        $this->db->order_by('nam','asc');
        $qres = $this->db->get('glass');
        foreach($qres->result_array() as $qrow){
            $res[] = $qrow;
        }

        return $res;
    }

    /**
     * вернуть строку ввиде массива по ид стеклопакета
     * @param $id
     * @return array
     */
    function get_row_by_id($id){
        $res = array();

        $this->db->where('id',$id);
        $qres = $this->db->get('glass',1);
        foreach($qres->result_array() as $qrow){
            $res = $qrow;
            break;
        }

        return $res;
    }

    function update_by_id($data, $id){
        $this->db->update('glass',$data,array('id' => $id));
    }

    function delete_by_id($id){
        $this->db->delete('glass', array('id' => $id));
    }

    /**
     *  $nam - symbolic description by glass
     */
    function get_desc_by_name($nam){
        $res = '';
        $ar = $this->get_row_by_name($nam);
        if(!empty($ar)){
            $res = $ar['description'];
        }
        return $res;
    }

    /**
     *  $id - glass id
     */
    function get_desc_by_id($id){
        $res = '';
        $ar = $this->get_row_by_id($id);
        if(!empty($ar)){
            $res = $ar['description'];
        }
        return $res;
    }

    /**
     * get string as 4-10-4 (СП оджнокамерный)
     *  $id - glass id
     */
    function get_namdesc_by_id($id){
        $res = '';
        $ar = $this->get_row_by_id($id);
        if(!empty($ar)){
            $res = $ar['nam'] . " (" . $ar['description'] . ")";
        }
        return $res;
    }


    /**
     *
     * @param $data
     */
    function add($data){
        $this->db->insert('glass',$data);
    }

    /**
     * get select list as html
     * filled by glasses
     * @param $attr - attribute set
     */
    public function get_html_select($attr){
        $res = '';

        $loc = '';
        foreach ($attr as $atrkey => $atrval) {
            $loc = $atrkey . '="' . $atrval . '" ';
        }

        $res = "<select $loc >";

        $res .= "<option value=\"0\">-- не выбран --</option>";

        $arselect = $this->get_all();
        foreach($arselect as $row){
            $id = $row['id'];
            $nam = $row['nam'];
            $res .= "<option value=\"$id\">$nam</option>";
        }
        $res .= '</select>';

        return $res;

    }

    /**
     * получить стоимость стеклопакета указанного типа и размера
     * @param $glass_id
     * @param $area - площадь в мм
     * returns -1 if error
     */
    public function get_glass_cost($glass_id, $area){
        $res = -1;

        $row = $this->get_row_by_id($glass_id);
        if(!empty($row)){
            $price = $row['price'];
            $res = $price * $area / 1000000; // считаем что цена СП в кв м
        }

        return $res;
    }

} 