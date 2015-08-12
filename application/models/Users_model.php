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
     * set new password for user (by id)
     * @param $id - user's id
     * @param $password - new password
     */
    public function set_password($id, $password){
        $this->ion_auth->update($id, array('password' => $password));
    }

} 