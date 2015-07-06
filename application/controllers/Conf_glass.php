<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 06.07.2015
 * Time: 13:30
 */

/**
 * контроллер для доступа к таблице стеклопакетов
 * Class Conf_glass
 */
class Conf_glass extends CI_Controller {

    public function index(){
        $this->load->view('conf/glass_index');
    }



} 