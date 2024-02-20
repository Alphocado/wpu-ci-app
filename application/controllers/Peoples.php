<?php

// kalau semisal banyak controller yang mau memakai database tinggal ke application/config/autoload.php
// jadi ada 3 cara
// di method, di controller, atau di autoload

// extends CI_Controller sangat wajib
class Peoples extends CI_Controller
{

  public function index()
  {

    $data['judul'] = 'List of Peoples';
    $this->load->view('templates/header', $data);
    $this->load->view('peoples/index', $data);
    $this->load->view('templates/footer');
  }
}
