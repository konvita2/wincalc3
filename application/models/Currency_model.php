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
     * получить множитель по num
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
    function delete($id){
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


}

?>