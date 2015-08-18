<?php
if (!defined('BASEPATH')) exit('Нет доступа к скрипту');

/**
 * Class Mycsv
 * библиотека для работы
 * с файлами csv - выгрузка прайсов
 *
 */

class Mycsv {

    /**
     * Подготовить данные для записи в таблицу цен глухого окна
     * т.е. у нас
     * 500, 600, 254.00
     * need
     * 500 599 600 699 254.00
     * @param $arcsv
     * returns new array w,wmax,h,hmax,p
     */
    public function prep_data_gluh($arcsv){
        $res = array();

        // get w array and h array
        $war = array();
        $har = array();
        foreach($arcsv as $row){
            $war[] = $row['w'];
            $har[] = $row['h'];
        }

        // prepare width line with max sizes
        $wmax = $this->_get_top_borders($war);

        // prepare height line with max sizes
        $hmax = $this->_get_top_borders($har);

        foreach($arcsv as $row){
            $nrow = array(
                'w' => $row['w'],
                'wmax' => $wmax[$row['w']],
                'h' => $row['h'],
                'hmax' => $hmax[$row['h']],
                'p' => $row['p'],
            );
            $res[] = $nrow;
        }

        return $res;
    }

    /**
     * @param $ar - array of numbers
     */
    private function _get_top_borders($ar){
        $lar = array_unique($ar);
        sort($lar);
        $res = array();
        $cnt = count($lar);

        for($i = 0; $i < $cnt; $i++){
            $elem = $lar[$i];
            if($i < $cnt-1){  // not last
                $next = $lar[$i+1];
                $res[$elem] = $next-1;
            }
            else{ // last
                $res[$elem] = $elem;
            }
        }

        return $res;
    }

}

?>