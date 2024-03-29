<?php
defined('BASEPATH') or exit ('no direct script access allowed');

class Home extends CI_Controller
{
    function __construct()
	{
		parent::__construct();
        $this->load->model(['Buku_model', 'User_model', 'Booking_model']);
    }
    
    public function index()
    {
        $data = [
            'judul' => "Katalog Buku", 
            'buku' => $this->Buku_model->getBuku()->result(),
        ];
    
    //jika sudah login dan jika belum login 
        if ($this->session->userdata('email')) {             
            $user = $this->User_model->cekData(['email' => $this->session->userdata('email')])->row_array(); 

            $data['user'] = $user['nama']; 

            $this->load->view('templates/templates-user/header', $data);
            $this->load->view('buku/daftarbuku', $data);
            $this->load->view('templates/templates-user/modal');
            $this->load->view('templates/templates-user/footer', $data);
        } else {
            $data['user'] = 'Pengunjung';
            $this->load->view('templates/templates-user/header', $data);
            $this->load->view('buku/daftarbuku', $data);
            $this->load->view('templates/templates-user/modal');
            $this->load->view('templates/templates-user/footer', $data);
        } 
    } 

    public function detailBuku()
    {
        $id = $this->uri->segment(3);
        $buku = $this->Buku_model->joinKategoriBuku(['buku.id' => $id])->result(); 

        $data['user'] = "Pengunjung";
        $data['title'] = "Detail Buku"; 
 
        foreach ($buku as $fields) {
            $data['judul'] = $fields->judul_buku;
            $data['pengarang'] = $fields->pengarang;
            $data['penerbit'] = $fields->penerbit;
            $data['kategori'] = $fields->kategori;
            $data['tahun'] = $fields->tahun_terbit;
            $data['isbn'] = $fields->isbn;
            $data['gambar'] = $fields->image;
            $data['dipinjam'] = $fields->dipinjam;
            $data['dibooking'] = $fields->dibooking;
            $data['stok'] = $fields->stok;
            $data['id'] = $id;
        }
        $this->load->view('templates/templates-user/header', $data);
        $this->load->view('buku/detail-buku', $data);
        $this->load->view('templates/templates-user/modal');
        $this->load->view('templates/templates-user/footer');
    } 

    public function logout() {
        session_unset();
        session_destroy();
        redirect('home');
    }
}
 