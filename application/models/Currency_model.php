<?php

class Currency_model extends CI_Model {

    public $id = 0;     // id - валюты
    public $nam = '';   // представление валюты USD, EUR so on
    public $mult = 1;   // базовый множитель (т.е. грн на 100USD)

    public function __construct(){
        parent::__construct();
    }

    // todo
    // - получить множитель по nam
    // - обновить запись
    // - удалить запись
    // - получить список представлений валют
    // - получить что-то готовое для select

    /**
     * получить множитель по nam
     * @param $pnam
     * @return int
     */
    function get_mult_by_nam($pnam){
        $res = 0;

        $this->db->where('nam',$pnam);
        $qres = $this->db->get('currency',1);
        foreach($qres->result() as $sres){
            $res = $sres->mult;
        }

        return $res;
    }

    /**
     * добавлить новую валюту
     * @param $ar - массив с параметрами
     */
    function insert($ar){
        $this->db->insert('currency', $ar);
    }

    /**
     * обновить валюту (need id)
     * @param $ar - массив с данными для обновления
     */
    function update($ar,$id){
        $this->db->update('currency', $ar, array('id' => $id));
    }

    /**
     * delete row by id
     * @param $id
     */
    function delete_by_id($id){
        $this->db->delete('currency', array('id' => $id));
    }

    /**
     * получить список массива валют упорядоченных по наименованию
     */
    function get_rows(){
        $res = array();

        $this->db->order_by('nam');
        $qres = $this->db->get('currency');
        foreach($qres->result_array() as $row){
            $res[] = $row;
        }

        return $res;
    }

    /**
     * получить курс валюты также в массиве
     * @param $day - the day on which rate is
     */
    function get_rows_with_rate($day){
        $this->load->model('Rate_model','Rate');
        $res = $this->get_rows();
        foreach($res as &$row){
            $row['rate'] = $this->Rate->get_rate_by_curr_dat($row['nam'], $day);
        }
        return $res;
    }

    /**
     * возвращает список для выбора в виде
     * <option value='uah'>uah</uah>
     * <option value='usd'>usd</usd>
     * ...
     * @return string
     */
    function get_html_rows($selected){
        $res = '';
        $ar = $this->get_rows();
        foreach($ar as $el){
            $vl = $el['nam'];
            if($vl == $selected){
                $res .= "<option selected value='$vl'>$vl</option>";
            }
            else{
                $res .= "<option value='$vl'>$vl</option>";
            }
        }
        return $res;
    }

    /**
     * Получить запись по id
     * @param $id
     * @return array
     */
    function get_row_by_id($id){
        $res = array();

        $qres = $this->db->get_where('currency', array('id' => $id), 1);
        foreach ($qres->result_array() as $qrow) {
            $res = $qrow;
            break;
        }

        return $res;
    }

    /**
     * получить запись по наименованию валюты
     * @param $nam
     * @return array
     */
    function get_row_by_nam($nam){
        $res = array();

        $qres = $this->db->get_where('currency', array('nam' => trim($nam)), 1);
        foreach ($qres->result_array() as $qrow) {
            $res = $qrow;
            break;
        }

        return $res;
    }

    /**
     * Получить наименование валюты по id
     * @param $id
     * @return string
     */
    function get_nam_by_id($id){
        $res = '';

        $ar = $this->get_row_by_id($id);
        if(!empty($ar)){
            $res = trim($ar['nam']);
        }

        return $res;
    }

    /**
     * Получить id валюты по ее наименованию
     * */
    function get_id_by_nam($nam){
        $res = 0;

        $this->db->where('nam', trim($nam));
        $query = $this->db->get('currency', 1);
        foreach($query->result() as $row){
            $res = $row->id;
            break;
        }

        return $res;
    }

}

?>