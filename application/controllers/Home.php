<?php
defined('BASEPATH') or exit ('no direct script access allowed');
class Home extends CI_Controller
{
    function __construct()
	{
		parent::__construct();
        $this->Auth_model->cek_login();
    }
    
    public function index()
    {
        $data['count_user'] = $this->Home_model->getCountUser();
        $data['count_product'] = $this->Home_model->getCountProduct();
        $data['count_category'] = $this->Home_model->getCountCategory();
        $data['count_borrowed'] = $this->Home_model->getCountBorrowedGoods();
        $data['list_user'] = $this->User_model->list_user();
        $data['list_product'] = $this->Product_model->list_product();
        $this->load->view('extended/header');
        $this->load->view('home/index', $data);
        $this->load->view('extended/footer');
    }

    public function borrowed_item_create()
    {
        $last_item = $this->BorrowedItemModel->getLastItem();
        $data = [
            'user_id' => $this->input->post('user_id'),
            'product_id' => $this->input->post('product_id'),
            'registration_number' => 'ITEM/'.date('yy').'/'.date('m').'/'.sprintf("%08d",$last_item->id+1),
            'borrowed_at' => date('yy-m-d',time()),
            'returned_at' => null,
            'description' => $this->input->post('description'),
            'admin_id' => $this->session->userdata('user_id')
        ];

        $borrowed_item = $this->BorrowedItemModel->create_item($data);

        if ($borrowed_item['status']) {
            $this->session->set_flashdata('success','Proses peminjaman berhasil berikut adalah nomor registrasi barang anda: '. $data['registration_number']);
		    redirect('home');
        }
		$this->session->set_flashdata('error','Proses peminjaman gagal harap kembalikan barang yang anda pinjam sebelumnya, berikut adalah nomor registrasi barang anda: '. $borrowed_item['data']->registration_number);
		redirect('home');
    }
}
