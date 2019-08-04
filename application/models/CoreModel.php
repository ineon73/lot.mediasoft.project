<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CoreModel extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    //Создать лот
    function createData()
    {
        $end_time = $this->input->post('end_time') . " " . $this->input->post('end_time2');
        $now = date("Y-m-d H:i:s");
        if ($now < $end_time) {
            $data = array(
                'name' => $this->input->post('name'),
                'text' => $this->input->post('text'),
                'price' => $this->input->post('price'),
                'step' => $this->input->post('step'),
                'user_id' => $this->session->userdata('id'),
                'end_time' => "{$end_time}",
                'status' => '1',
                'image' => $this->upload->data('file_name')
            );
            $this->db->set('time', 'NOW()', FALSE);
            $this->db->insert('lot', $data);
        }
    }

    //Получить конкретный лот
    function getData($id)
    {
        $query = $this->db->query("SELECT * FROM lot WHERE id={$id}");
        return $query->row();
    }

    //Обновление лота после редактирования
    function updateData($id)
    {
        $data = array(
            'name' => $this->input->post('name'),
            'text' => $this->input->post('text'),
            'step' => $this->input->post('step')
        );
        $img = $this->upload->data('file_name');
        if (!empty($img)) {
            $data = array('image' => $this->upload->data('file_name'));
        }
        $this->db->where('id', $id);
        $this->db->update('lot', $data);
    }

    // Общее кол-во лотов
    function getCount($status, $id)
    {
        $this->db->where('status', $status);
        if ($id > 0) {
            $this->db->where('user_id', $id);
        }
        return $this->db->count_all_results('lot');
    }

    //Вывод лотов постранично и обновление их статуса
    function getCountPerPage($limit, $start, $id, $status = 2)
    {
        //обновление статуса
        $now = date("Y-m-d H:i:s");
        $this->db->where('end_time <', $now);
        $this->db->set('status', '2');
        $this->db->update('lot');
        //вывод
        $this->db->where('status', $status);
        if ($id > 0) {
            $this->db->where('user_id', $id);
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('lot');
        return $query->result();
    }

    //Поставить ставку
    function addBet($id, $login)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('lot');
        $array = $query->row_array();

        if ($array['status'] == 1) {
            $price = $array['price'];
            $step = $array['step'];
            $sum = $price + $step;
            $this->db->where('id', $id);
            $this->db->set('price', $sum, FALSE);
            $this->db->set('win_id', $login, TRUE);
            $this->db->update('lot');
        }
    }

    //Завершить лот
    function endBet($id, $login)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('lot');
        $array = $query->row_array();
        if ($login == $array['user_id']) {
            $this->db->where('id', $id);
            $this->db->set('status', '2', FALSE);
            $this->db->update('lot');
        }
    }
}