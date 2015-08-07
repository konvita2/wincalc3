<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 28.07.2015
 * Time: 17:25
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    // constructor
    function __construct(){
        parent::__construct();
    }

    function index(){
        if(!$this->ion_auth->logged_in()){
            $this->load->view('admin_required');
        }
        else{
            // that's ok
            $this->load->view('admin_index');
        }
    }

    /**
     * login
     */
    function login(){
        $login = $this->input->post('login');
        $password = $this->input->post('password');

        // try to login
        if($this->ion_auth->login($login, $password)){
            if($this->ion_auth->is_admin()){
                //ok, go to admin main page
                redirect('admin/index', 'refresh');
            }
            else{
                // user don't have admin privileges
                $data['login_error'] = 1;
                $this->load->view('admin_required', $data);
            }
        }
        else{
            // error login page
            $data['login_error'] = 2;
            $this->load->view('admin_required', $data);
        }
    }

    /**
     * logout
     */
    function logout(){
        if($this->ion_auth->logged_in()){
            $this->ion_auth->logout();
            redirect('main/index', 'refresh');
        }
        else{
            redirect('main/index', 'refresh');
        }
    }

    /**
     *
     */
    public function required(){
        // @todo perhaps some data should be passed
        $this->load->view('admin_required');
    }

    // rules for validation
    function _get_rules(){
        $ar = array(
            array(
                'field' => 'login',
                'label' => 'Логин',
                'rules' => 'required'
            ),
            array(
                'field' => 'password',
                'label' => 'Пароль',
                'rules' => 'required'
            ),
        );
        return $ar;
    }

}