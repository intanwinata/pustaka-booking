<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku extends CI_Controller
	{
	public function __construct()
	{
	parent::__construct();
	cek_login();
	}
	//manajemen Buku
	public function index()
	{
		$data['judul'] = 'Data Buku';
		$data['user'] = $this->User_model->cekData(['email' => $this->session->userdata('email')])->row_array();
		$data['buku'] = $this->Buku_model->getBuku()->result_array();
		$data['kategori'] = $this->Buku_model->getKategori()->result_array();

		$this->form_validation->set_rules('buku', 'Judul Buku', 'required|min_length[3]', [ 
			'required' => 'Judul Buku harus diisi', 
			'min_length' => 'Judul buku terlalu pendek'
			]);
		$this->form_validation->set_rules('id', 'Kategori', 'required', [
			'required' => 'Nama pengarang harus diisi'
			]);
		$this->form_validation->set_rules('pengarang', 'Nama Pengarang', 'required|min_length[3]', [
			'required' => 'Nama pengarang harus diisi', 
			'min_length' => 'Nama pengarang terlalu pendek'
			]);
		$this->form_validation->set_rules('penerbit', 'Nama Penerbit', 'required|min_length[3]', [
		'required' => 'Nama penerbit harus diisi', 
		'min_length' => 'Nama penerbit terlalu pendek'
			]);
		$this->form_validation->set_rules('tahun', 'Tahun Terbit', 'required|min_length[3]|max_length[4]|numeric', [
			'required' => 'Tahun terbit harus diisi', 
			'min_length' => 'Tahun terbit terlalu pendek',
			'max_length' => 'Tahun terbit terlalu panjang',
			'numeric' => 'Hanya boleh diisi angka'
			]);
	    $this->form_validation->set_rules('isbn', 'Nomor ISBN', 'required|min_length[3]|numeric', [
            'required' => 'Nama ISBN harus diisi',
            'min_length' => 'Nama ISBN terlalu pendek',
            'numeric' => 'Yang anda masukan bukan angka'
		]);
	    $this->form_validation->set_rules('buku', 'Stok', 'required|numeric', [
            'required' => 'Stok harus diisi',
            'numeric' => 'Yang anda masukan bukan angka'
		]);

		//konfigurasi sebelum gambar diupload
        $config['upload_path'] = './assets/img/upload/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '3000';
        $config['max_width'] = '1024';
        $config['max_height'] = '1000';
        $config['file_name'] = 'img' . time();

	    $this->load->library('upload', $config);

	if ($this->form_validation->run() == false) {
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('buku/index', $data);
		$this->load->view('templates/footer');
	} else {
		if ($this->upload->do_upload('image')) {
			$image = $this->upload->data();
			$gambar = $image['file_name'];
		} else {
			$gambar = '';
		}
		$data = [
			'judul_buku' => $this->input->post('judul_buku', true),
			'id_kategori' => $this->input->post('id_kategori', true),
			'pengarang' => $this->input->post('pengarang', true),
			'penerbit' => $this->input->post('penerbit', true),
			'tahun_terbit' => $this->input->post('tahun', true),
			'isbn' => $this->input->post('isbn', true),
			'stok' => $this->input->post('stok', true),
			'dipinjam' => 0,
			'dibooking' => 0,
			'image' => $gambar
		];

		$this->Buku_model->simpanBuku($data);
		redirect('buku');
		}
	}

	public function hapus($id)
	{
		$this->Buku_model->hapusBuku(['id' => $id]);
        $this->session->set_flashdata('flash', '<div class="alert alert-danger alert-message" role="alert">Buku ini berhasil dihapus</div>');
        redirect('buku');
	}

	public function ubah($id)
	{
		$data['judul'] = 'Data Buku';
		$data['user'] = $this->User_model->cekData(['email' => $this->session->userdata('email')])->row_array();
		$data['buku'] = $this->Buku_model->bukuWhere($id)->result();
		$data['kategori'] = $this->Buku_model->kategoriWhere(['id'=>$data['buku'][0]->id_kategori])->result();
		// var_dump($data['kategori']);
		// die();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('buku/ubah', $data);
		$this->load->view('templates/footer');
	}
	
	public function ubahBuku() {
        $data['judul'] = 'Ubah Data Buku';
        $data['user'] = $this->User_model->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['buku'] = $this->Buku_model->bukuWhere(['id' => $this->uri->segment(3)])->row();
        $kategori = $this->Buku_model->joinKategoriBuku(['buku.id' => $this->uri->segment(3)])->result_array();
        foreach ($buku as $b) {
            $data['id'] = $b['id'];
            $data['b'] = $b['judul_buku'];
        }
        $data['kategori'] = $this->Buku_model->getKategori()->result_array();

        $this->form_validation->set_rules('judul_buku', 'Judul Buku', 'required|min_length[3]', [
            'required' => 'Judul Buku harus diisi!',
            'min_length' => 'Judul Buku terlalu pendek'
        ]);
        $this->form_validation->set_rules('id', 'Kategori', 'required', [
            'required' => 'Kategori harus diisi!'
        ]);
        $this->form_validation->set_rules('pengarang', 'Nama Pengarang', 'required|min_length[3]', [
            'required' => 'Nama Pengarang harus diisi!',
            'min_length' => 'Nama Pengarang terlalu pendek'
        ]);
        $this->form_validation->set_rules('penerbit', 'Nama Penerbit', 'required|min_length[3]', [
            'required' => 'Nama Penerbit harus diisi!',
            'min_length' => 'Nama Penerbit terlalu pendek'
        ]);
        $this->form_validation->set_rules('tahun', 'Tahun Terbit', 'required|min_length[3]|max_length[4]|numeric', [
            'required' => 'Tahun Terbit harus diisi!',
            'min_length' => 'Tahun Terbit terlalu pendek',
            'max_length' => 'Tahun Terbit terlalu panjang',
            'numeric' => 'Hanya boleh diisi angka'
        ]);
        $this->form_validation->set_rules('isbn', 'Nomor ISBN', 'required|min_length[3]|numeric', [
            'required' => 'Nama ISBN harus diisi!',
            'min_length' => 'Nama ISBN terlalu pendek',
            'numeric' => 'Hanya boleh diisi angka'
        ]);
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric', [
            'required' => 'Stok harus diisi!',
            'numeric' => 'Hanya boleh diisi angka'
        ]);


        $this->form_validation->set_rules('judul_buku', 'Judul Buku', 'required|min_length[3]', [ 'required' => 'Judul Buku harus diisi', 'min_length' => 'Judul buku terlalu pendek']);
		$this->form_validation->set_rules('id', 'Kategori', 'required', ['required' => 'Nama pengarang harus diisi']);
		$this->form_validation->set_rules('pengarang', 'Nama Pengarang', 'required|min_length[3]', [ 'required' => 'Nama pengarang harus diisi', 'min_length' => 'Nama pengarang terlalu pendek']);
		$this->form_validation->set_rules('penerbit', 'Nama Penerbit', 'required|min_length[3]', [
		'required' => 'Nama penerbit harus diisi', 'min_length' => 'Nama penerbit terlalu pendek']);
		$this->form_validation->set_rules('tahun', 'Tahun Terbit', 'required|min_length[3]|max_length[4]|numeric', [
			'required' => 'Tahun terbit harus diisi', 
			'min_length' => 'Tahun terbit terlalu pendek',
			'max_length' => 'Tahun terbit terlalu panjang',
			'numeric' => 'Hanya boleh diisi angka'
			]);
	    $this->form_validation->set_rules('isbn', 'Nomor ISBN', 'required|min_length[3]|numeric', [
            'required' => 'Nama ISBN harus diisi',
            'min_length' => 'Nama ISBN terlalu pendek',
            'numeric' => 'Yang anda masukan bukan angka'
		]);
	    $this->form_validation->set_rules('stok', 'Stok', 'required|numeric', [
            'required' => 'Stok harus diisi',
            'numeric' => 'Yang anda masukan bukan angka'
		]);
        if ($this->form_validation->run() == FALSE)
                {
                    $this->load->view('templates/header', $data);
					$this->load->view('templates/sidebar', $data);
                    $this->load->view('templates/topbar', $data);
                    $this->load->view('buku/ubah', $data);
                    $this->load->view('templates/footer');
                }
                else
                {
                    $this->Buku_model->updateBuku([
						'judul_buku' => $this->input->post('judul_buku'),
						'pengarang' => $this->input->post('pengarang'),
						'penerbit' => $this->input->post('penerbit'),
						'tahun_terbit' => $this->input->post('tahun_terbit'),
						'isbn' => $this->input->post('isbn'),
						'stok' => $this->input->post('stok'),
						'dipinjam' => $this->input->post('dipinjam'),
						'dibooking' => $this->input->post('dibooking'),
						'image' => $this->input->post('image'),
					]);
                    $this->session->set_flashdata('flash', '<div class="alert alert-danger alert-message" role="alert">Buku berhasil diubah.</div>');
                    redirect('buku');
                }
	}

	public function kategori()
	{
		$data['judul'] = 'Kategori Buku';
		$data['user'] = $this->User_model->cekData(['email' => $this->session->userdata('email')])->row_array();
		$data['kategori'] = $this->Buku_model->getKategori()->result_array();

		$this->form_validation->set_rules('kategori', 'Kategori', 'required', [
		'required' => 'Kategori Harus Diisi'
		]);

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('buku/kategori', $data);
			$this->load->view('templates/footer');
		} else {
		$data = [
			'kategori' => $this->input->post('kategori', TRUE)
		];

		$this->Buku_model->simpanKategori($data);
		redirect('buku/kategori');
		}
	}

	public function hapusKategori()
	{	
		$where = ['id' => $this->uri->segment(3)];
		$this->Buku_model->hapusKategori($where);
		redirect('buku/kategori');
	}

	public function ubahKategori() 
	{
        $data['judul'] = 'Ubah Data Kategori';
        $data['user'] = $this->User_model->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->Buku_model->kategoriWhere(['id' => $this->uri->segment(3)])->result_array();

		$this->form_validation->set_rules('kategori', 'Nama Kategori', 'required', [
            'required' => 'Nama Kategori Harus Diisi!'
        ]);
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('buku/ubah_kategori', $data);
			$this->load->view('templates/footer');

		} else {

			$data = [
				'kategori' => $this->input->post('kategori', TRUE)
			];

			$this->Buku_model->updateKategori(['id' => $this->input->post('id')], $data);
			redirect('buku/kategori');
		}
	}
}