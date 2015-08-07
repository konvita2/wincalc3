<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 07.08.2015
 * Time: 20:59
 */

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

        //temporary @todo
        $this->load->view('conf/users_index', $data);
    }

    public function add(){



    }

    public function edit(){

    }

    public function del(){

    }

    private function _get_rules(){

    }





} 