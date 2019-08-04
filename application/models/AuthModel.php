<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    function registerUser()
    {
        if (isset($_POST['username'])) {
        $data = array(
            'username' => $this->input->post('username'),
            'password' =>  password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'email' => $this->input->post('email')
        );
        //проверка занятости логина
            $this->db->where('username', $data['username']);
            $query = $this->db->get('users');
           $login =  $query->row_array();
            if (empty($login)) {
        $this->db->insert('users', $data);}
        }
    }

    function loginUser($login, $password)
    {
        $this->db->where('username', $login);
        $query = $this->db->get('users');
        $query = $query->row_array();
        if ( password_verify($password, $query['password']) ) {
            $data['key'] = 1;
            $data['id'] = $query['id'];
        } else {
            $data['key'] = 0;
        }
        return $data;
    }

}