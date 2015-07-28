<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 13.07.2015
 * Time: 11:22
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Conf_curr extends CI_Controller {


    function __construct(){
        parent::__construct();

        // test login
        if(!$this->ion_auth->logged_in()){
            redirect('login', 'refresh');
        }

    }

    public function index(){
        $this->load->model('Currency_model');
        $today = date('d-m-Y');
        $data['currs'] = $this->Currency_model->get_rows_with_rate($today);
        $data['today'] = date('d-m-Y');
        $this->load->view('conf/curr_index', $data);
    }

    public function del($id){
        $this->load->model('Currency_model');
        $data['row'] = $this->Currency_model->get_row_by_id($id);
        $data['mode'] = 'dl';

        if(isset($_POST['btn_save'])){
            //delete
            // prepare info
            $data['textinfo'] = 'Удалена валюта ' . $this->input->post('nam') . '.';

            // delete
            $this->Currency_model->delete_by_id($id);
            $this->load->view('conf/curr_success', $data);
        }
        else{
            //show
            $this->load->view("conf/curr_edit", $data);
        }
    }

    public function edit($id){
        $this->load->library('form_validation');
        $this->load->model('Currency_model');
        $data['row'] = $this->Currency_model->get_row_by_id($id);
        $data['mode'] = 'ed';

        //set rules
        $this->form_validation->set_rules('nam', 'Наименование валюты',
            'trim|required|min_length[3]|max_length[8]|callback_test_currency');
        $this->form_validation->set_rules('mult', 'Множитель', 'required');

        if($this->form_validation->run() == TRUE){
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

    /**
     * проверить (валидация) уникальность имени
     * @param $nam
     * @return bool
     */
    public function test_currency($nam){
        $this->load->model('Currency_model','model');
        $qres = $this->model->get_row_by_nam($nam);
        if(empty($qres)){
            return TRUE;
        }
        else{
            $this->form_validation->set_message('test_currency', "%s $nam уже присутсвует в справочнике");
            return FALSE;
        }
    }



} 