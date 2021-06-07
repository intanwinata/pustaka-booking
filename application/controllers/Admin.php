<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        cek_user();
    }

    public function index()
    {
        $data['judul']= 'Dashboard';
        $data['user']= $this->User_model->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['anggota']= $this->User_model->getUserLimit()->result_array();
        $data['buku']= $this->Buku_model->getBuku()->result_array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer', $data);
    }
}