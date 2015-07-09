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

        if(isset($_POST['btnSave'])){

            //update
            $newdata = array(
                'nam' => $_POST['nam'],
                'description' => $_POST['description'],
                'cur_name' => $_POST['cur_name'],
                'price' => $_POST['price'],
            );
            $this->Glass_model->update_by_id($newdata, $id);

            $data['textinfo'] = 'Сохранен стеклопакет ' . $this->input->post('nam') . ' ' .
                $this->input->post('description') . '. Цена за 1 кв.м. ' .
                $this->input->post('price') . ' ' . $this->input->post('cur_name');
            $this->load->view('conf/glass_success',$data);
        }
        else{
            $this->load->view('conf/glass_edit',$data);
        }
    }

    /**
     * добавление нового стеклопакета
     */
    public function add(){
        $this->load->model('Glass_model');

        //currency list
        $this->load->model('Currency_model');
        $data['currency_list'] = $this->Currency_model->get_html_rows('');

        $data['mode'] = 'nw'; // режим добавления нового СП

        if(!isset($_POST['btnSave'])){
            $this->load->view('conf/glass_edit',$data);
        }
        else{

            $newdata = array(
                'nam' => $this->input->post('nam'),
                'cur_name' => $this->input->post('cur_name'),
                'price' => $this->input->post('price'),
                'description' => $this->input->post('description'),
            );

            $this->Glass_model->add($newdata);

            $data['textinfo'] = 'Добавлен стеклопакет ' . $this->input->post('nam') . ' ' .
                $this->input->post('description') . '. Цена за 1 кв.м. ' .
                $this->input->post('price') . ' ' . $this->input->post('cur_name');
            $this->load->view('conf/glass_success',$data);
        }





    }



} 