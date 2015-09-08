<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 07.08.2015
 * Time: 22:01
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

    // @todo
    // - remap
    // - block admin deleting
    // -  - admin can not be deleted
    // -  -

    /**
     * fields:
     * username
     * password
     * email
     * last_name
     * first_name
     * company
     * phone
     */

    /**
     *
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * get array of users
     * +
     * 'description', 'active'
     */
    public function get_all(){
        $res = array();
        $this->load->model('Ion_auth_model', 'ion');

        $query = $this->ion->users()->result();
        foreach($query as $row){

            $phone = $row->phone == 0 ? "" : $row->phone;

            $ar = array(
                'id' => $row->id,
                'username' => $row->username,
                'password' => $row->password,
                'email' => $row->email,
                'last_name' => $row->last_name,
                'first_name' => $row->first_name,
                'company' => $row->company,
                'phone' => $row->phone,
                'active' => $row->active,
                'admin' => $this->ion_auth->is_admin($row->id) ? 1 : 0,
                'calcinfo' => $this->_get_calc_str($row->id),
                'description' => trim($row->last_name) . ' ' . trim($row->first_name)
                    . ' (' . trim($row->company) . ') тел:' . trim($phone),

            );

            $res[] = $ar;
        }

        return $res;
    }

    /**
     * get user's row as array
     * @param $id
     */
    public function get_by_id($id){
        $res = array();

        $this->load->model('Ion_auth_model', 'ion');
        $user = $this->ion_auth->user($id)->row();
        if(!empty($user)){
            $res['id'] = $user->id;
            $res['username'] = $user->username;
            $res['email'] = $user->email;
            $res['last_name'] = $user->last_name;
            $res['first_name'] = $user->first_name;
            $res['company'] = $user->company;
            $res['phone'] = $user->phone;
            $res['admin'] = $this->ion_auth->is_admin($user->id) ? 1 : 0;
        }

        return $res;
    }

    /**
     *
     * @param $user_id
     */
    public function get_username_by_id($user_id){
        $res = '';

        $qr = $this->get_by_id($user_id);
        if(!empty($qr)){
            $res = $qr['username'];
        }

        return $res;
    }

    /**
     * добавить нового пользователя
     * @param $row - массив с полями записи
     * - username
     * - password
     * - email
     * - last_name
     * - first_name
     * - company
     * - phone
     * @todo не знаю что делать с активностью - пока обойдусь
     */
    public function add_row($row){
        $this->load->model('Ion_auth_model', 'ion');

        $username = $row['username'];
        $email = $row['email'];
        $last_name = $row['last_name'];
        $first_name = $row['first_name'];
        $password = $row['password'];
        $company = $row['company'];
        $phone = $row['phone'];
        $admin = $row['admin'];

        $ar = array(
            'last_name' => $last_name,
            'first_name' => $first_name,
            'company' => $company,
            'phone' => $phone,
        );

        // group
        //!!! ??? admin what type
        if($admin == 1)
            $arg = array('1');
        else
            $arg = array();

        $this->ion->register($username, $password, $email, $ar, $arg);
        //!!! result

    }

    /**
     * @param $row
     */
    public function update_row($row){
        $id = $row['id'];
        $admin = $row['admin'];

        $ar = array(
            'last_name' => $row['last_name'],
            'first_name' => $row['first_name'],
            'company' => $row['company'],
            'phone' => $row['phone'],
        );

        $this->ion_auth->update($id, $ar);

        //admin
        if($this->ion_auth->is_admin($id) && $admin != 1){
            $this->ion_auth->remove_from_group(1,$id);
        }

        if(!$this->ion_auth->is_admin($id) && $admin == 1){
            $this->ion_auth->add_to_group(1,$id);
        }
    }

    /**
     * delete user row by id
     * @param $row
     */
    public function delete_row_by_id($id){
        $this->ion_auth->delete_user($id);
    }

    /**
     * проверить существование пользователя по id
     * @param $user_id
     */
    public function user_exists($user_id){
        $res = FALSE;

        $query = $this->db->get_where('users', array('id' => $user_id));
        if($query->num_rows() > 0){
            $res = TRUE;
        }

        return $res;
    }


    /**
     * set new password for user (by id)
     * @param $id - user's id
     * @param $password - new password
     */
    public function set_password($id, $password){
        $this->ion_auth->update($id, array('password' => $password));
    }

    /**
     * установить параметры калькуляции для указанного пользователя     *
     * @param $id
     * @param $calc - массив с ключами 'prod' & 'mater' & 'marg'
     */
    public function set_calc($id, $calc){
        // test if exist
        if($this->_calc_exists($id)){
            $this->db->where(array('user_id' => $id));
            $this->db->update('users_calc', $calc);
        }
        else{
            $data = array(
                'user_id' => $id,
                'mater' => $calc['mater'],
                'prod' => $calc['prod'],
            );
            $this->db->insert('users_calc', $data);
        }
    }

    /**
     * получить параметры калькуляции ввиде массива prod/mater по user id
     * @param $id - user id
     */
    public function get_calc($id){
        $res = array(
            'mater' => 0,
            'prod' => 0,
            'marg' => 0
        );

        if($this->_calc_exists($id)){
            $query = $this->db->get_where('users_calc', array('user_id' => $id));
            if($query->num_rows() > 0){
                $row = $query->row();
                $res['mater'] = $row->mater;
                $res['prod'] = $row->prod;
                $res['marg'] = $row->marg;
            }
        }

        return $res;
    }

    /**
     * получить калькуляционные параметры как ххх/ххх
     * @return string
     */
    private function _get_calc_str($id){
        $res = '';

        if($this->_calc_exists($id)){
            $calc = $this->get_calc($id);
            $res = trim(strval($calc['mater'])) . '/'
                . trim(strval($calc['prod'])) . '/'
                . trim(strval($calc['marg']));
        }

        return $res;
    }

    /**
     * проверить существуют ли параметры калькуляции для пользователя id
     * @param $id - user id
     */
    private function _calc_exists($id){
        $res = FALSE;

        $query = $this->db->get_where('users_calc', array('user_id' => $id), 1);
        if($query->num_rows() > 0){
            $res = TRUE;
        }

        return $res;
    }

} 