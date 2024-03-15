<?php

// kalau semisal banyak controller yang mau memakai database tinggal ke application/config/autoload.php
// jadi ada 3 cara
// di method, di controller, atau di autoload

// extends CI_Controller sangat wajib
class Peoples extends CI_Controller
{

  public function index()
  {
    $this->load->model('Peoples_model', 'peoples');
    $data['judul'] = 'List of Peoples';

    // PAGINATION
    $this->load->library('pagination');

    // ambil data searching
    if ($this->input->post('submit')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    // config
    if ($data['keyword'] !== null) {
      $this->db->like('name', $data['keyword']);
      $this->db->or_like('email', $data['keyword']);
    }
    $this->db->from('peoples');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 8;

    // initialize
    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);
    $data['peoples'] = $this->peoples->getPeoples($config['per_page'], $data['start'], $data['keyword']);

    $this->load->view('templates/header', $data);
    $this->load->view('peoples/index', $data);
    $this->load->view('templates/footer');
  }
}
