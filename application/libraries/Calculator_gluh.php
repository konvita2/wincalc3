<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calculator_gluh {

    public $width = 0;
    public $height = 0;
    public $glass_id = 0;
    public $profil_sym = '';
    public $dealer_id = 0;

    public $error_msg = ''; // сюда кладем описание последней ошибки если была

    protected $CI;

    /**
     * constructor
     * // @todo - need for init models
     */
    public function __construct(){
        $this->CI =& get_instance();

        $this->CI->load->model('Profil_model', 'profil');
        $this->CI->load->model('Glass_model', 'glass');
        $this->CI->load->model('Users_model', 'users');
        $this->CI->load->model('Price_gluh_model', 'price');

    }

    /**
     * set input params
     * @param $w - width
     * @param $h - height
     * @param $g - glass_id (number)
     * @param $p - profil_sym (string)
     * @param $dealer - dealer id
     */
    public function set_input_data($w, $h, $g, $p, $dealer = 0){
        $this->width = $w;
        $this->height = $h;
        $this->glass_id = $g;
        $this->profil_sym = $p;
        $this->dealer_id = $dealer;
    }

    /**
     * get input data as string
     * need for debug
     */
    public function get_input_data(){
        $res = '';

        $res = '<p>Входные параметры:<br/>';
        $res .= ' ширина: ' . $this->width . ";<br/>";
        $res .= ' высота: ' . $this->height . ";<br/>";
        $res .= ' стеклопакет: ' . $this->glass_id . " ("
            . $this->CI->glass->get_namdesc_by_id($this->glass_id) . ");<br/>";
        $res .= ' профиль: ' . $this->profil_sym
            . " (" . $this->CI->profil->get_description_by_sym($this->profil_sym) . ")"
            . ";<br/></p>";

        return $res;
    }

    /**
     * get cost based on inputdata
     * @return int -1 if error
     *
     */
    public function get_cost(){
        $res = 0;

        // profil cost
        $profil_cost = $this->CI->price->get_cost_by_profil_size($this->profil_sym, $this->width, $this->height);
        if($profil_cost == -1){
            $this->error_msg = "Нет прайса на окно данного размера";
            return -1;
        }

        // glass cost
        $glass_area = $this->CI->profil->get_glass_area($this->profil_sym, $this->width, $this->height);
        if($glass_area == -1){
            $this->error_msg = "Некорректное вычисление площади стеклопакета";
            return -1;
        }
        $glass_cost = $this->CI->glass->get_glass_cost($this->glass_id, $glass_area);
        if($glass_cost == -1){
            $this->error_msg = "Неправильно указан тип стеклопакета";
            return -1;
        }

        // row cost
        $row_cost = $glass_cost + $profil_cost;

        // получить проценты на переработку
        $user_calc = $this->CI->users->get_calc($this->dealer_id);
        $mater = $user_calc['mater'];
        $prod = $user_calc['prod'];
        $marg = $user_calc['marg'];

        // расчет стоимости по формуле
        $cost = ($row_cost + ($mater + $mater * $prod)) * (100 + $marg)/100;

        // скидка для дилера
        // @todo make dealer skid






        $res = $cost;

        return $res;
    }

}