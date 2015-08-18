<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 18.08.2015
 * Time: 21:32
 */

class Price_gluh_model extends CI_Model {

    /*
     * - add array for date
     * - get by date all table
     * - get by date and size
     * - deactivate by date
     * - activate by date
     * -
     */

    /**
     *
     */
    public function __construct(){
        parent::__construct();

    }

    public function add_array_by_date($dat, $ardata){
        // deactivate all
        $ar = array('active' => 0);
        $this->db->update('win_calc_gluh', $ar);

        // add new array
        $today = date('Ymd');
        foreach ($ardata as $row) {
            $newrow = array(
                'minx' => $row['w'],
                'maxx' => $row['wmax'],
                'miny' => $row['h'],
                'maxy' => $row['hmax'],
                'price' => $row['p'],
                'dat' => $dat,
                'active' => 1,
            );
            $this->db->insert('win_calc_gluh', $newrow);
        }
    }

    /**
     * returns true if one or more records (for certain date) exist
     * @param $dat
     */
    public function exist_date($dat){
        $res = FALSE;
        $query = $this->db->get_where('win_calc_gluh', array('dat' => $dat), 1);
        if($query->num_rows() > 0){
            $res = TRUE;
        }
        return $res;
    }



} 