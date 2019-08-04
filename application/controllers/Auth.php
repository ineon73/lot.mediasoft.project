<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AuthModel');
        $this->load->library('session');
    }

    public function index()
    {
        $this->load->view('auth/login');
    }

    public function register()
    {
        $this->load->view('auth/register');
        if (isset($_POST['username'])) {
            $this->AuthModel->registerUser();
        redirect('auth');}
    }

    public function login()
    {
        $login = $this->input->post('username');
        $password = $this->input->post('password');
        $data = $this->AuthModel->loginUser($login, $password);
        if ($data['key'] === 1) {
            $config = array(
                'login' => $login,
                'id' => $data['id']
            );
            $this->session->set_userdata($config);
            redirect('Main/index', $login);
        } else {
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Main');
    }


}