<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 03.09.2015
 * Time: 12:07
 */

/**
 * Class Calc
 * контроллер для реализации процедуры расчета стоимости окон
 * различных  типов
 * - глухое окно
 * - ... @todo other types of window
 */

class Calc extends CI_Controller {

    // @todo remap later

    // no index

    private $user_id = 0;

    public function __construct(){
        parent::__construct();
        //$this->user_id = $this->ion_auth->user()->id;
        $row = $this->ion_auth->user()->row();
        $this->user_id = $row->id;
    }

    /**
     * открыть страницу для расчета глухого окна
     */
    public function gluh(){

        // prep profil
        $this->load->model('Profil_model', 'profil');
        $par = array(
            'id' => 'profil',
            'class' => 'form-control'
        );
        $data['profil_set'] = $this->profil->get_html_select($par);

        // prep glass
        $this->load->model('Glass_model', 'glass');
        $par = array(
            'id' => 'glass',
            'class' => 'form-control'
        );
        $data['glass_set'] = $this->glass->get_html_select($par);

        $this->load->view('calc/gluh', $data);  // @todo gluh or gluh1 ?
    }

    /**
     * ajax-response for gluh win
     */
    public function gluhajax(){
        $user_id = $this->user_id;

        $task = $this->input->post('task');

        if($task == 'calc'){
            $profil_sym = $this->input->post('profil_sym');
            $glass_id = $this->input->post('glass_id');
            $width = $this->input->post('w');
            $height = $this->input->post('h');

            $jsonans = array();

            $inp = new Calculator_gluh();
            $inp->set_input_data($width, $height, $glass_id, $profil_sym, $user_id);

            $jsonans["input"] = $inp->get_input_data();

            // calculation
            $cost = $inp->get_cost();
            $jsonans["cost"] = $cost;

            echo json_encode($jsonans);
        }
    }


} 