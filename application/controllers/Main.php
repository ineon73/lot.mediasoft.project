<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CoreModel');
        $this->load->library('pagination');
        $this->load->library('session');
        //конфиг для загрузки изображений
        $this->load->library('upload');
        $config['upload_path'] = './upload/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_width'] = 1920;
        $config['max_height'] = 1080;
        $this->upload->initialize($config);
        if (!isset($_SESSION['login'])) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['login'] = $this->session->userdata('login');
        $stat = $this->input->post('filter1');
        $user_id = $this->input->post('filter2');

        if ($stat !== NULL) {
            $this->session->set_userdata(array("status" => $stat));
        }
        $status = $this->session->userdata('status');
        if ($status == NULL) {
            $status = 1;
        }

        if (isset($_POST['filter2'])) {
            if ($_POST['filter2'] > 0) {
                $this->session->set_userdata(array("filter" => $user_id));
            } else {
                $this->session->set_userdata(array("filter" => NULL));
            }
        }
        $user_id = $this->session->userdata('filter');
        $data['check'] = ($user_id > 0) ? 'checked' : '';
        $data['check1'] = ($status == 1) ? 'checked' : '';
        $data['check2'] = ($status == 2) ? 'checked' : '';
        //пагинация
        $data['base_url'] = base_url() . "main/index/";
        $data["total_rows"] = $this->CoreModel->getCount($status, $user_id);
        $data["per_page"] = 3;
        $data["uri_segment"] = 3;
        $data['first_link'] = '< Первая';
        $data['last_link'] = 'Последняя >';
        $this->pagination->initialize($data);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['result'] = $this->CoreModel->getCountPerPage($data["per_page"], $page, $user_id, $status);

        $this->load->view('home/header');
        $this->load->view('home/index', $data);
        $this->load->view('home/footer');
    }

    public function create()
    {
        if (empty($_FILES['userfile']['name'])) {
            $this->CoreModel->createData();
            redirect('main');
        } else {
            if ($this->upload->do_upload()) {
                $this->CoreModel->createData();
                redirect('main');
            }
            redirect('main');
        }
    }

    public function edit($id)
    {
        $data['item'] = $this->CoreModel->getData($id);
        $this->load->view('home/header');
        $this->load->view('home/edit', $data);
        $this->load->view('home/footer');
    }

    public function update($id)
    {
        if (empty($_FILES['userfile']['name'])) {
            $this->CoreModel->updateData($id);
            redirect('main');
        } else {
            if ($this->upload->do_upload()) {
                $this->CoreModel->updateData($id);
                redirect('main');
            }
            redirect('main');
        }
    }

    public function bet($id)
    {
        $login = $_SESSION['login'];
        $this->CoreModel->addBet($id, $login);
        redirect('Main');
    }

    public function end($id)
    {
        $login = $_SESSION['id'];
        $this->CoreModel->endBet($id, $login);
        redirect('Main');
    }



}
