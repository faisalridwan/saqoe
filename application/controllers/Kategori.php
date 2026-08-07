<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = 'Kelola Kategori';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        
        $this->db->where('username', $this->session->userdata('username'));
        $data['kategori'] = $this->db->get('kategori')->result_array();

        $this->load->view('templates/user_header', $data);
        $this->load->view('user/kategori', $data);
        $this->load->view('templates/user_footer');
        $this->load->view('templates/user_content', $data);
    }

    public function tambah()
    {
        $data = [
            'username' => $this->session->userdata('username'),
            'tipe' => $this->input->post('tipe'),
            'nama_kategori' => $this->input->post('nama_kategori')
        ];

        $this->db->insert('kategori', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kategori baru berhasil ditambahkan!</div>');
        redirect('kategori');
    }

    public function edit()
    {
        $id = $this->input->post('id_kategori');
        $data = [
            'tipe' => $this->input->post('tipe'),
            'nama_kategori' => $this->input->post('nama_kategori')
        ];

        $this->db->where('id_kategori', $id);
        $this->db->where('username', $this->session->userdata('username'));
        $this->db->update('kategori', $data);
        
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kategori berhasil diupdate!</div>');
        redirect('kategori');
    }

    public function hapus($id)
    {
        $this->db->where('id_kategori', $id);
        $this->db->where('username', $this->session->userdata('username'));
        $this->db->delete('kategori');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kategori berhasil dihapus!</div>');
        redirect('kategori');
    }
}
