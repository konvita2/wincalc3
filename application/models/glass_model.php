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

    }

    /**
     *
     * @param $data
     */
    function add($data){
        $this->db->insert($data);
    }

} 