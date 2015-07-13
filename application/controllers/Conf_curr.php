<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 13.07.2015
 * Time: 11:22
 */

class Conf_curr extends CI_Controller {

    public function index(){
        $this->load->model('Currency_model');
        $data['currs'] = $this->Currency_model->get_rows();
        $this->load->view('conf/curr_index', $data);
    }

    public function del(){

    }

    /**
     * edit currency by $id
     * @param $id
     */
    public function edit($id){

        $this->load->model('Currency_model');
        $data['row'] = $this->Currency_model->get_row_by_id($id);
        $data['mode'] = 'ed';

        if(isset($_POST['btn_save'])){
            //save
            $newdata = array(
                'nam' => $this->input->post('nam'),
                'mult' => $this->input->post('mult'),
            );
            $this->Currency_model->update($newdata, $id);

            $data['textinfo'] = 'Записаны изменения: валюта ' . $this->input->post('nam') . '.';
            $this->load->view('conf/curr_success',$data);
        }
        else{
            //edit
            $this->load->view('conf/curr_edit', $data);
        }


    }

    /**
     * add new currency
     */
    public function add(){

        $this->load->model('Currency_model');
        $data['mode'] = 'nw';
        $data['row'] = array(
            'id' => 0,
            'nam' => '',
            'mult' => 1
        );

        if(isset($_POST['btn_save'])){
            //save
            $newdata = array(
                'nam' => $this->input->post('nam'),
                'mult' => $this->input->post('mult'),
            );
            $this->Currency_model->insert($newdata);

            $data['textinfo'] = 'Добавлена валюта ' . $this->input->post('nam') . '.';
            $this->load->view('conf/curr_success',$data);
        }
        else{
            //edit to add
            $this->load->view('conf/curr_edit', $data);
        }

    }

} 