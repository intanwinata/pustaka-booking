<?php 
if (!defined('BASEPATH')) exit('No Direct Script Access Allowed'); 
 
 class Pinjam extends CI_Controller 
 {
    public function __construct()
    {
         parent::__construct();
         $this->load->model(['Buku_model', 'User_model', 'Booking_model', 'Pinjam_model']);
         cek_login();
         cek_user();
    } 
  
    public function index() 
    {
        $data['judul'] = "Data Pinjam";
        $data['user'] = $this->User_model->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['pinjam'] = $this->Pinjam_model->joinData(); 
 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pinjam/data-pinjam', $data);
        $this->load->view('templates/footer');
    }
  
    public function daftarBooking() 
    {
        $data['judul'] = "Daftar Booking";
        $data['user'] = $this->User_model->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['pinjam'] = $this->db->query("select * from booking")->result_array(); 
  
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('booking/daftar-booking', $data);
        $this->load->view('templates/footer');
    }

    public function bookingDetail()
    {
        $id_booking = $this->uri->segment(3);

        $data['judul'] = "Booking Detail";
        $data['user'] = $this->User_model->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['agt_booking'] = $this->db->query("select * from booking b, user u where b.id_user = u.id and b.id_booking='$id_booking'")->result_array();
        $data['detail'] = $this->db->query("select id_buku,judul_buku,pengarang,penerbit,tahun_terbit from booking_detail d, buku b where d.id_buku=b.id and d.id_booking='$id_booking'")->result_array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('booking/booking-detail', $data);
        $this->load->view('templates/footer');
    }

    public function pinjamAct()
    {
        $id_booking = $this->uri->segment(3);
        $lama = $this->input->post('lama', TRUE);

        $bo = $this->db->query("SELECT * FROM booking WHERE id_booking='$id_booking'")->row();

        $tglsekarang = date('Y-m-d');
        $no_pinjam = $this->Booking_model->kodeOtomatis('pinjam', 'no_pinjam');
        $databooking = [
            'no_pinjam' => $no_pinjam,
            'tgl_pinjam' => $tglsekarang,
            'id_booking' => $id_booking,
            'id_user' => $bo->id_user,
            'tgl_kembali' => date('Y-m-d', strtotime('+' . $lama . ' days', strtotime($tglsekarang))),
            'tgl_pengembalian' => '0000-00-00',
            'status' => 'Pinjam',
            'total_denda' => 0
        ];

        $this->Pinjam_model->simpanPinjam($databooking);
        $this->Pinjam_model->simpanDetail($id_booking, $no_pinjam);
        $denda = $this->input->post('denda', TRUE);
        $this->db->query("update detail_pinjam set denda='$denda'"); 
 
        //hapus Data booking yang bukunya diambil untuk dipinjam
        $this->Pinjam_model->deleteData('booking', ['id_booking' => $id_booking]);
        $this->Pinjam_model->deleteData('booking_detail', ['id_booking' => $id_booking]);
        //$this->db->query("DELETE FROM booking WHERE id_booking='$id_booking'"); 
 
        //update dibooking dan dipinjam pada tabel buku saat buku yang dibooking diambil untuk dipinjam
        $this->db->query("UPDATE buku, detail_pinjam SET buku.dipinjam=buku.dipinjam+1, buku.dibooking=buku.dibooking-1 WHERE buku.id=detail_pinjam.id_buku");
        $this->session->set_flashdata('pesan', '<div class="alert alert-message alert-success" role="alert">Data Peminjaman Berhasil Disimpan</div>');
        redirect(base_url() . 'pinjam');
    }
} 