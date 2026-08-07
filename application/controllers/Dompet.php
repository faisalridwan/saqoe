<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dompet extends CI_Controller
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
        $data['title'] = 'Kelola Dompet';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        
        $this->db->where('username', $this->session->userdata('username'));
        $data['dompet'] = $this->db->get('dompet')->result_array();

        $this->load->view('templates/user_header', $data);
        $this->load->view('user/dompet', $data);
        $this->load->view('templates/user_content', $data);
    }

    public function tambah()
    {
        $data = [
            'username' => $this->session->userdata('username'),
            'nama_dompet' => $this->input->post('nama_dompet'),
            'saldo' => preg_replace('/[^0-9]/', '', $this->input->post('saldo'))
        ];

        $this->db->insert('dompet', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Dompet baru berhasil ditambahkan!</div>');
        redirect('dompet');
    }

    public function edit()
    {
        $id = $this->input->post('id_dompet');
        $data = [
            'nama_dompet' => $this->input->post('nama_dompet'),
            'saldo' => preg_replace('/[^0-9]/', '', $this->input->post('saldo'))
        ];

        $this->db->where('id_dompet', $id);
        $this->db->where('username', $this->session->userdata('username'));
        $this->db->update('dompet', $data);
        
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Dompet berhasil diupdate!</div>');
        redirect('dompet');
    }

    public function hapus($id)
    {
        $this->db->where('id_dompet', $id);
        $this->db->where('username', $this->session->userdata('username'));
        $this->db->delete('dompet');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Dompet berhasil dihapus!</div>');
        redirect('dompet');
    }
}
