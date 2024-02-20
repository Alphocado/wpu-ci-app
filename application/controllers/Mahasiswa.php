<?php 

// kalau semisal banyak controller yang mau memakai database tinggal ke application/config/autoload.php
// jadi ada 3 cara
// di method, di controller, atau di autoload

// extends CI_Controller sangat wajib
class Mahasiswa extends CI_Controller {
  // dicomment karena sudah pasang database di autoload
  // public function __construct()
  // {
  //   parent::__construct();
  //   // kalau mau banyak method menggunakan database pakai cara ini
  //   $this->load->database();
  // }

  public function __construct()
  {
    parent::__construct();
    // gk cocok di controller
    // $this->load->helper('url');

    // import method 
    $this->load->model('Mahasiswa_model');
    $this->load->library('form_validation');
  }

  public function index()
  {
    // dengan code ini maka method ini akan otomatis terkoneksi database
    // di method ini saja...
    // $this->load->database();

    // jika membuat model wajib giniin dulu
    // $this->load->model('Mahasiswa_model');

    // test
    // ketika di config.php ada isi index,
    // base tidak akan include index.php di url
    // var_dump(base_url());
    // site akan include
    // var_dump(site_url());

    $data['judul'] = 'Daftar Mahasiswa';
    $data['mahasiswa'] = $this->Mahasiswa_model->getAllMahasiswa();
    if( $this->input->post('keyword') ){
      $data['mahasiswa'] = $this->Mahasiswa_model->cariDataMahasiswa();
    }
    $this->load->view('templates/header', $data);
    $this->load->view('mahasiswa/index', $data);
    $this->load->view('templates/footer');
  }

    public function tambah()
    {
      $data['judul'] = 'Form Tambah Data Mahasiswa';

      // param 1 : name form
      // param 2 : alias
      // param 3 : aturan/rules/syarat 
      $this->form_validation->set_rules('nama', 'Nama', 'required');
      $this->form_validation->set_rules('nrp', 'NRP', 'required|numeric');
      $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

      
      $data['jurusan'] = ['Teknik Informatika', 'Teknik Robotik', 'Teknik Mesin', 'Ilmu Sejarah', 'Matematika'];
      if( $this->form_validation->run() == FALSE ){
        $this->load->view('templates/header', $data);
        $this->load->view('mahasiswa/tambah', $data);
        $this->load->view('templates/footer');
      } else {
        $this->Mahasiswa_model->tambahDataMahasiswa();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('mahasiswa');
      }
    }

  public function hapus($id)
  {
    $this->Mahasiswa_model->hapusDataMahasiswa($id);
    $this->session->set_flashdata('flash', 'Dihapus');
    redirect('mahasiswa');
  }

  public function detail($id)
  {
    $data['judul'] = 'Detail Data Mahasiswa';
    $data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaById($id);
    $this->load->view('templates/header', $data);
    $this->load->view('mahasiswa/detail', $data);
    $this->load->view('templates/footer');
  }

  public function ubah($id)
  {
    $data['judul'] = 'Form Ubah Data Mahasiswa';
    $data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaById($id);
    $data['jurusan'] = ['Teknik Informatika', 'Teknik Robotik', 'Teknik Mesin', 'Ilmu Sejarah', 'Matematika'];

    $this->form_validation->set_rules('nama', 'Nama', 'required');
    $this->form_validation->set_rules('nrp', 'NRP', 'required|numeric');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

    if( $this->form_validation->run() == FALSE ){
      $this->load->view('templates/header', $data);
      $this->load->view('mahasiswa/ubah', $data);
      $this->load->view('templates/footer');
    } else {
      $this->Mahasiswa_model->ubahDataMahasiswa();
      $this->session->set_flashdata('flash', 'Diubah');
      redirect('mahasiswa');
    }
  }
}

?>