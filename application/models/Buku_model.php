<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku_model extends CI_Model
{
    //manajemen buku
    public function getBuku()
    {
        return $this->db->get('buku');
    }

    public function bukuWhere($where)
    {
        return $this->db->get_where('buku', $where);
    }

    public function simpanBuku($data=null)
    {
        $this->db->insert('buku', $data);
    }

    public function updateBuku($data=null, $where=null)
    {
        $this->db->update('buku', $data, $where);
    }

    public function hapusBuku($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('buku');
    }


    public function UbahBuku($id)
    {
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

        $this->db->where('id', $this->input->post('id')); //mengambil id yang di hidden
        $this->db->update('buku', $data);
    }

    public function total($field, $where)
    {
        $this->db->select_sum($field);
        if(!empty($where) && count($where) > 0){
            $this->db->where($where);
        }
        $this->db->from('buku');
        return $this->db->get()->row($field);
    }

    //manajemen kategori
    public function getKategori()
    {
        return $this->db->get('kategori');
    }

    public function kategoriWhere($where)
    {
        return $this->db->get_where('kategori', $where);
    }

    public function simpanKategori($data=null)
    {
        $this->db->insert('kategori', $data);
    }

    public function hapusKategori($where=null)
    {
        $this->db->delete('kategori', $where);
    }

    public function updateKategori($where=null, $data=null)
    {
        $this->db->uodate('kategori',$data,$where);
    }

    //join
    public function joinKategoriBuku($where)
    {
        $this->db->select('buku.id_kategori,kategori.nama_kategori, buku.judul_buku, buku.pengarang, buku.penerbit,
        ,kategori.nama_kategori, buku.tahun_terbit, buku.isbn, buku_image
        , buku.pinjaman, buku.dibooking, buku.stok');
        $this->db->from('buku');
        $this->db->join('kategori','kategori.id = buku.id_kategori');
        $this->db->where($where);
        return $this->db->get();
    }
}

// Dengan model seperti di atas, Untuk menginput data ke database kita bisa menggunakan function simpan(),
//untuk menampilkan data atau mengambil data dari database kita bisa menggunakan function tampil(),
//untuk menghapus data dari database kita bisa menggunakan function hapus(),
//dan untuk mengupdate data pada database kita bisa menggunakan function ubah(). 
