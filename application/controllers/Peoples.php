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

    // config
    $config['base_url'] = 'http://localhost/main/belajar/framework/CodeIgniter/ci-app/peoples/index';
    $config['total_rows'] = $this->peoples->countAllPeoples();
    $config['per_page'] = 12;

    $data['peoples'] = $this->peoples->getPeoples(12, 30);

    $this->load->view('templates/header', $data);
    $this->load->view('peoples/index', $data);
    $this->load->view('templates/footer');
  }
}
