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
        $this->load->model('Glass_model');
        $data['glasses'] = $this->Glass_model->get_all();
        $this->load->view('conf/glass_index',$data);
    }

    /**
     * редактирование существующего стеклопакета
     * @param $id
     */
    public function edit($id){
        $this->load->model('Glass_model');
        $ar = $this->Glass_model->get_row_by_id($id);
        $cur_name = $ar['cur_name'];
        $data['glass'] = $ar;
        $data['mode'] = 'ed';

        //currency list
        $this->load->model('Currency_model');
        $data['currency_list'] = $this->Currency_model->get_html_rows($cur_name);

        $this->load->view('conf/glass_edit',$data);
    }



} 