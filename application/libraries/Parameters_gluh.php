<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Parameters_gluh
 * этот класс определяет параметры для расчета стоимости материалов глухого окна
 * @todo сделать чтение из файла настроек (подумать какого типа) в конструкторе
 */

class Parameters_gluh {

    // массив прайсов
    private $price_array = array();

    // Определить Цена строимости за 1м
    public function __construct(){
        $this->price_array = array(
            'ED_TD_60' => array(
                'perimeter_price' => 78.01,
                'width_price' => 0,
                'constant_price' => 2.64,
                'manufacturing_price' => 5.45,
            ),
        );
    }

    /**
     * Получить массив параметрических цен по обозначению профиля
     * @param $profil_sym
     * @return mixed
     */
    public function get_prices_by_profil($profil_sym){
        return $this->price_array[$profil_sym];
    }

} 