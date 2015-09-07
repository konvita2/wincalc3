<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

    /*
     *
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('Profil_model', 'profil');
        $this->load->library('form_validation');
    }

    /*
     * restrict access
     */
    public function _remap($method, $params = array()){
        if(!$this->ion_auth->logged_in()){  // @todo add admin priv-s checking
            redirect('admin/required', 'refresh');
        }
        else{
            if($method == 'index'){
                $this->index();
            }
            elseif($method == 'add'){
                $this->add();
            }
            elseif($method == 'edit'){
                $this->edit($params[0]);
            }
            elseif($method == 'del'){
                $this->del($params[0]);
            }
        }
    }

    public function index(){
        $rows = $this->profil->get_all();
        $data['rows'] = $rows;
        $this->load->view('conf/profil_index', $data);
    }

    /*
     * delete profil row
     */
    public function del($id){
        $data['mode'] = 'dl';

        //test existing
        if($this->profil->exist_by_id($id)){
            // read data
            $row = $this->profil->get_by_id($id);

            // init fields
            $data['id'] = $row['id'];
            $data['nam'] = $row['nam'];
            $data['description'] = $row['description'];

            // set rules
            $this->form_validation->set_rules('nam', 'Обозначение', 'required');
            $this->form_validation->set_rules('description', 'Описание', 'required');

            if($this->form_validation->run() == FALSE){
                $this->load->view('conf/profil_edit', $data);
            }
            else{
                $this->profil->delete_by_id($id);
                redirect('profil/index', 'refresh');
            }
        }
        else{
            // @todo 404
        }
    }

    /*
     * edit profil row
     */
    public function edit($id){
        $data['mode'] = 'ed';

        // test existing
        if($this->profil->exist_by_id($id)){

            // read data
            $row = $this->profil->get_by_id($id);

            // init fields
            $data['id'] = $row['id'];
            $data['nam'] = $row['nam'];
            $data['description'] = $row['description'];
            $data['width_for_glass'] = $row['width_for_glass'];

            // set rules
            $this->form_validation->set_rules('nam', 'Обозначение', 'required');
            $this->form_validation->set_rules('description', 'Описание', 'required');

            if($this->form_validation->run() == FALSE){
                $this->load->view('conf/profil_edit', $data);
            }
            else{
                $ar = array(
                    'nam' => $this->input->post('nam'),
                    'description' => $this->input->post('description'),
                    'width_for_glass' => $this->input->post('width_for_glass'),
                );
                $this->profil->update_by_id($id, $ar);

                redirect('profil/index', 'refresh');
            }
        }
        else{
            // @todo 404
        }
    }

    /**
     * add new row
     */
    public function add(){
        $data['mode'] = 'nw';

        // init fields
        $data['id'] = '';
        $data['nam'] = '';
        $data['description'] = '';

        // set rules
        $this->form_validation->set_rules('nam', 'Обозначение', 'required');
        $this->form_validation->set_rules('description', 'Описание', 'required');

        if($this->form_validation->run() == FALSE){
            $this->load->view("conf/profil_edit", $data);
        }
        else{
            $ar = array(
                'nam' => $this->input->post('nam'),
                'description' => $this->input->post('description')
            );
            $this->profil->add($ar);

            redirect('profil/index', 'refresh');
        }
    }




} 