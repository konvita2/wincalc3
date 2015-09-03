<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 02.09.2015
 * Time: 21:28
 */

class Test_bs3 extends CI_Controller {

    public function index(){
        $this->load->view('bs3');
    }

    // test ajax
    public function ajax1(){
        $p1 = $this->input->post('par1');
        $p2 = $this->input->post('par2');

        $res = array(
            "car1" => $p1,
            "car2" => $p2,
            "drivers" => array(
                "smith",
                "bond",
                "miller"
            )
        );

        $je = json_encode($res);

        echo $je;
    }

} 