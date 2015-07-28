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

        if(!$this->ion_auth->logged_in()){
            //redirect('admin/login', 'refresh');
        }
    }

    /**
     * login
     */
    function login(){

        $this->load->view('login', 'data');

    }

    /**
     * logout
     */
    function logout(){

    }

}