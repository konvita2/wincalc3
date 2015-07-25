<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 22.07.2015
 * Time: 0:11
 */

class Conf_rate extends CI_Controller {

    /**
     * выводит таблицу изменения курсов валют по id валюты
     * @param $id
     */
    function index($id){
        $this->load->model('Rate_model');

        $this->load->model('Currency_model');

        $nam = $this->Currency_model->get_nam_by_id($id);

        $data['rates'] = $this->Rate_model->get_currency_list_by_nam($nam);
        $data['cur_nam'] = $nam;
        $data['cur_id'] = $id;
        $data['mult'] = $this->Currency_model->get_mult_by_nam($nam);

        $this->load->view('conf/rate_index', $data);
    }

    /**
     * open edit page for rate
     * @param $rate_id
     */
    function edit($rate_id){
        $this->load->library('form_validation');

        $this->load->model('Rate_model');
        $this->load->model('Currency_model');

        $data['mode'] = 'ed';
        $ar = $this->Rate_model->get_row_by_id($rate_id);
        $data['row'] = $ar;
        $data['rate_id'] = $rate_id;
        $cur_nam = $ar['cur_nam'];
        $data['cur_nam'] = $cur_nam;
        $data['cur_id'] = $this->Currency_model->get_id_by_nam($cur_nam);
        $mult = $this->Currency_model->get_mult_by_nam($cur_nam);
        $data['mult'] = $mult;

        //set rules
        $this->form_validation->set_rules($this->get_rules());

        if($this->form_validation->run() == FALSE){
            $this->load->view('conf/rate_edit', $data);
        }
        else{
            $dat = $this->input->post('dat');
            $price = $this->input->post('price');
            //save (update or insert: we don't care about it)
            $this->Rate_model->add_rate($cur_nam, $dat, $price);
            //form message
            $data['textinfo'] = "Записаны изменения: для валюты $cur_nam на $dat ".
                "установлен курс $price за $mult единиц";
            //ok
            $this->load->view('conf/rate_success', $data);
        }
    }

    /**
     * open edit page to delete row
     * @param $rate_id
     */
    function del($rate_id){
        $this->load->library('form_validation');

        $this->load->model('Rate_model');
        $this->load->model('Currency_model');

        $data['mode'] = 'dl';
        $ar = $this->Rate_model->get_row_by_id($rate_id);
        $data['row'] = $ar;
        $data['rate_id'] = $rate_id;
        $cur_nam = $ar['cur_nam'];
        $dat = $ar['dat'];
        $data['cur_nam'] = $cur_nam;
        $data['cur_id'] = $this->Currency_model->get_id_by_nam($cur_nam);
        $mult = $this->Currency_model->get_mult_by_nam($cur_nam);
        $data['mult'] = $mult;

        //set rules
        $this->form_validation->set_rules($this->get_rules());

        if($this->form_validation->run() == FALSE){
            //open
            $this->load->view('conf/rate_edit', $data);
        }
        else{
            //delete
            $this->Rate_model->delete_by_id($rate_id);

            //ok page
            //form message

            $data['textinfo'] = "Удалена запись о курсе для валюты $cur_nam на $dat ";
            $this->load->view('conf/rate_success', $data);
        }
    }

    /**
     * open edit page to add rate for defined currency
     * @param $cur_id
     */
    function add($cur_id){
        $this->load->library('form_validation');

        $this->load->model('Rate_model');
        $this->load->model('Currency_model');

        $data['mode'] = 'nw';

        $ar = array(
            'dat' => date('d-m-Y'),
            'price' => 0
        );
        $data['row'] = $ar;

        $data['cur_id'] = $cur_id;

        $cur_nam = $this->Currency_model->get_nam_by_id($cur_id);
        $data['cur_nam'] = $cur_nam;

        $mult = $this->Currency_model->get_mult_by_nam($cur_nam);
        $data['mult'] = $mult;

        //set rules
        $this->form_validation->set_rules($this->get_rules());

        if($this->form_validation->run() == FALSE){
            $this->load->view('conf/rate_edit', $data);
        }
        else{
            //add new row
            $dat = $this->input->post('dat');
            $price = $this->input->post('price');
            $this->Rate_model->add_rate($cur_id, $dat, $price);

            //OK form message


            $data['textinfo'] = "Добавлен курс $price за $mult единиц для валюты $cur_nam на $dat";
            $this->load->view('conf/rate_success', $data);
        }

    }

    // --------------------- rules
    private function get_rules(){
        $ar = array(
            array(
                'field' => 'dat',
                'label' => 'Дата изменения курса',
                'rules' => 'required'
            ),
            array(
                'field' => 'price',
                'label' => 'Стоимость валюты',
                'rules' => 'required|numeric'
            ),
        );
        return $ar;
    }


}