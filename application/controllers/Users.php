<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Users
 * контроллер для работы с таблицей пользователей
 * используем стандартную модель Ion
 */
class Users extends CI_Controller {

    /**
     *
     */
    public function __constuct(){
        parent::__construct();
    }

    /* @todo - uncomment and fill body of the function
    public function _remap(){

    }
    */

    public function index(){
        $this->load->model('Users_model', 'users');
        $rows = $this->users->get_all();
        $data['rows'] = $rows;
        $this->load->view('conf/users_index', $data);
    }

    public function add(){
        $this->load->library('form_validation');

        $this->load->model('Users_model', 'users');

        $data['mode'] = 'nw';

        // init fields
        $data['id'] = 0;
        $data['username'] = '';
        $data['email'] = '';
        $data['last_name'] = '';
        $data['first_name'] = '';
        $data['company'] = '';
        $data['phone'] = '';
        $data['password'] = '';
        $data['password1'] = '';
        $data['active'] = 1;

        //set rules
        $this->form_validation->set_rules($this->_get_rules_add());

        if($this->form_validation->run() == FALSE){
            $this->load->view('conf/users_edit', $data);
        }
        else{
            // add new row
            $row = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'email' => $this->input->post('email'),
                'last_name' => $this->input->post('last_name'),
                'first_name' => $this->input->post('first_name'),
                'company' => $this->input->post('company'),
                'phone' => $this->input->post('phone'),
                'active' => $this->input->post('active'),
                'admin' => $this->input->post('admin'),
            );

            //deb
            //log_message('debug', print_r($row));

            $this->users->add_row($row);

            //go to index
            redirect('users/index', 'refresh');
        }

    }

    /**
     * edit user fields
     * @param $id
     */
    public function edit($id){
        $this->load->library('form_validation');
        $this->load->model('Users_model', 'users');

        $data['mode'] = 'ed';

        //set rules
        $this->form_validation->set_rules($this->_get_rules_edit());

        // read data & fill fields
        $row = $this->users->get_by_id($id);
        if(!empty($row)){

            $data['id'] = $row['id'];
            $data['username'] = $row['username'];
            $data['email'] = $row['email'];
            $data['last_name'] = $row['last_name'];
            $data['first_name'] = $row['first_name'];
            $data['company'] = $row['company'];
            $data['phone'] = $row['phone'];
            $data['admin'] = $row['admin'];

            if($this->form_validation->run() == FALSE){
                $this->load->view('conf/users_edit', $data);
            }
            else{

                // prepare update
                $row = array(
                    'id' => $this->input->post('id'),
                    'last_name' => $this->input->post('last_name'),
                    'first_name' => $this->input->post('first_name'),
                    'company' => $this->input->post('company'),
                    'phone' => $this->input->post('phone'),
                    'admin' => $this->input->post('admin'),
                );

                // update
                $this->users->update_row($row);

                // go to list
                redirect('users/index', 'refresh');

            }
        }
        else{
            // !!! @todo 404
        }



    }

    /**
     * delete user row
     * @param $id
     */
    public function del($id){
        $this->load->library('form_validation');
        $this->load->model('Users_model', 'users');

        $data['mode'] = 'dl';

        //set rules
        $this->form_validation->set_rules($this->_get_rules_edit());

        // read data & fill fields
        $row = $this->users->get_by_id($id);
        if(!empty($row)){
            $data['id'] = $row['id'];
            $data['username'] = $row['username'];
            $data['email'] = $row['email'];
            $data['last_name'] = $row['last_name'];
            $data['first_name'] = $row['first_name'];
            $data['company'] = $row['company'];
            $data['phone'] = $row['phone'];
            $data['admin'] = $row['admin'];

            if($this->form_validation->run() == FALSE){
                $this->load->view('conf/users_edit', $data);
            }
            else{
                // delete
                $this->users->delete_row_by_id($id);
                // redirect
                redirect('users/index','refresh');
            }
        }
        else{
            // @todo 404
        }
    }

    /**
     * set new password for user
     * @param $id
     */
    public function psw($id){
        $this->load->library('form_validation');
        $this->load->model('Users_model', 'users');

        //set rules
        $this->form_validation->set_rules($this->_get_rules_psw());

        // read data & fill fields
        $row = $this->users->get_by_id($id);
        if(!empty($row)){
            $data['id'] = $id;
            $data['username'] = $row['username'];
            $data['password'] = '';
            $data['password1'] = '';

            if($this->form_validation->run() == FALSE){
                $this->load->view('conf/users_psw', $data);
            }
            else{
                $new_psw = $this->input->post('password');
                // save psw
                $this->users->set_password($id, $new_psw);
                // redirect
                redirect('users/index', 'refresh');
            }
        }
        else{
            // @todo 404
        }
    }

    /**
     * получить правила для валидации формы режим добавления
     * @return array
     */
    private function _get_rules_add(){
        $ar = array(
            array(
                'field' => 'username',
                'label' => 'Имя пользователя',
                'rules' => 'required|is_unique[users.username]|alpha_dash',
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email',
            ),
            array(
                'field' => 'password',
                'label' => 'Пароль',
                'rules' => 'required',
            ),
        );
        return $ar;
    }

    /**
     * получить правила для валидации формы режим редактирования
     * @return array
     */
    private function _get_rules_edit(){
        $ar = array(
            array(
                'field' => 'username',
                'label' => 'Имя пользователя',
                'rules' => 'required',
            ),
        );
        return $ar;
    }

    /**
     * получить правила для валидации формы ввода пароля
     * @return array
     */
    private function _get_rules_psw(){
        $ar = array(
            array(
                'field' => 'password',
                'label' => 'Пароль',
                'rules' => 'required',  // @todo make length of password testing
            ),
        );
        return $ar;
    }






} 