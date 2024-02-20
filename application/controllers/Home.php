<?php 

// extends CI_Controller sangat wajib
class Home extends CI_Controller {
  // untuk mengambil param dari url tinggal tambahkan param di index functionnya
  public function index($nama = 'John Doe')
  {
    // echo "Hello";
    // membuat controller baru,

    // mengirim data ke view
    $data['judul'] = 'Halaman Home';
    $data['nama'] = $nama;
    // header templates
    $this->load->view('templates/header', $data);
    // untuk tampilkan view ke folder application/views/nama-folder
    $this->load->view('home/index');
    // footer templates
    $this->load->view('templates/footer');

  }
}

?>