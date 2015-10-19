<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calculator_gluh {

    //const MANUFACTURING_COST = 5.45; // стоимость переработки из адуло

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

        // !!! этот кусок надо закоментировать
        // profil cost
        /*
        $profil_cost = $this->CI->price->get_cost_by_profil_size($this->profil_sym, $this->width, $this->height);
        if($profil_cost == -1){
            $this->error_msg = "Нет прайса на окно данного размера";
            return -1;
        }
        */

        // !!! новый вариант расчета
        // profil cost
        $param_object = new Parameters_gluh();
        $profil_price = $param_object->get_prices_by_profil($this->profil_sym);

        if(empty($profil_price)){
            $this->error_msg = "Нет параметрических цен на профиль для глухого окна";
            return -1;
        }

        $perim_price = $profil_price['perimeter_price'];
        $width_price = $profil_price['width_price'];
        $constant_price = $profil_price['constant_price'];
        $manuf_price = $profil_price['manufacturing_price'];

        $profil_cost = (2 * $this->width + 2 * $this->height) / 1000 * $perim_price
            + $this->width * $width_price
            + $constant_price;

        log_message('debug', "!!! profil cost is $profil_cost");

        // glass cost
        $glass_area = $this->CI->profil->get_glass_area($this->profil_sym, $this->width, $this->height);
        if($glass_area == -1){
            $this->error_msg = "Некорректное вычисление площади стеклопакета";
            return -1;
        }
        log_message('debug', "!!! glass area is $glass_area");

        $glass_cost = $this->CI->glass->get_glass_cost($this->glass_id, $glass_area);
        if($glass_cost == -1){
            $this->error_msg = "Неправильно указан тип стеклопакета";
            return -1;
        }
        log_message('debug', "!!! glass cost is $glass_cost");

        // row cost
        $row_cost = $glass_cost + $profil_cost;

        // получить проценты на переработку
        $user_calc = $this->CI->users->get_calc($this->dealer_id);
        $mater = $user_calc['mater'];
        $prod = $user_calc['prod'];
        $marg = $user_calc['marg'];
        $discount = $user_calc['discount'];

        // расчет стоимости по формуле
        $cost = $row_cost + $manuf_price
            + $mater / 100 * $row_cost
            + $prod / 100 * $manuf_price;

        $cost += $cost * $marg / 100;

        // скидка для дилера
        // @todo make dealer skid
        $cost -= $cost * $discount / 100;

        $res = $cost;

        return $res;
    }

}