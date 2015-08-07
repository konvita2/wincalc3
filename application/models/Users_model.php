<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 07.08.2015
 * Time: 22:01
 */

class Users_model extends CI_Model {

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
                'username' => $row->username,
                'password' => $row->password,
                'email' => $row->email,
                'last_name' => $row->last_name,
                'first_name' => $row->first_name,
                'company' => $row->company,
                'phone' => $row->phone,
                'active' => $row->active,
                'description11' => 'to be or not to be that is the question '
                    . '/// to be or not to be that is the question'
                    . '/// to be or not to be that is the question',
                'description' => trim($row->last_name) . ' ' . trim($row->first_name)
                    . ' (' . trim($row->company) . ') тел:' . trim($phone),

            );

            $res[] = $ar;
        }

        return $res;
    }

} 