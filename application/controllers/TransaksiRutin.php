<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TransaksiRutin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }
        $this->load->library('form_validation');
        $this->load->model('M_User');
    }

    public function index()
    {
        $data['title'] = 'Transaksi Rutin';
        $username = $this->session->userdata('username');
        $data['user'] = $this->db->get_where('pengguna', ['username' => $username])->row_array();
        $event = $this->M_User->GetNamaEvent($username);
        
        $this->db->select('transaksi_rutin.*, dompet.nama_dompet');
        $this->db->from('transaksi_rutin');
        $this->db->join('dompet', 'dompet.id_dompet = transaksi_rutin.id_dompet', 'left');
        $this->db->where('transaksi_rutin.username', $username);
        $data['rutin'] = $this->db->get()->result_array();

        $data['list_dompet'] = $this->db->get_where('dompet', ['username' => $username])->result_array();

        // Ambil kategori untuk pemasukan dan pengeluaran
        $data['kategori_pemasukan'] = $this->db->get_where('kategori', ['username' => $username, 'tipe' => 'Pemasukan'])->result_array();
        $data['kategori_pengeluaran'] = $this->db->get_where('kategori', ['username' => $username, 'tipe' => 'Pengeluaran'])->result_array();

        $this->load->view('templates/user_header', $data);
        $this->load->view('user/transaksi_rutin', array_merge($data, ['event' => $event]));
        $this->load->view('templates/user_footer');
        $this->load->view('templates/user_content');
    }

    public function tambah()
    {
        $this->form_validation->set_rules('judul', 'Judul Transaksi', 'required|trim');
        $this->form_validation->set_rules('nominal', 'Nominal', 'required|trim');
        $this->form_validation->set_rules('id_dompet', 'Dompet', 'required');
        $this->form_validation->set_rules('tanggal_eksekusi', 'Tanggal Eksekusi', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $jenis = $this->input->post('jenis', true);
            $kategori = $this->input->post('kategori', true);
            
            $data = [
                'username' => $this->session->userdata('username'),
                'judul' => $this->input->post('judul', true),
                'nominal' => preg_replace('/[^0-9]/', '', $this->input->post('nominal', true)),
                'jenis' => $jenis,
                'kategori' => $kategori,
                'id_dompet' => $this->input->post('id_dompet', true),
                'tanggal_eksekusi' => $this->input->post('tanggal_eksekusi', true),
                'status_aktif' => 1
            ];

            $this->db->insert('transaksi_rutin', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Transaksi Rutin berhasil ditambahkan!</div>');
            redirect('transaksirutin');
        }
    }

    public function hapus($id)
    {
        $this->db->where('id_tr', $id);
        $this->db->where('username', $this->session->userdata('username'));
        $this->db->delete('transaksi_rutin');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Transaksi Rutin berhasil dihapus!</div>');
        redirect('transaksirutin');
    }

    public function toggle($id)
    {
        $tr = $this->db->get_where('transaksi_rutin', ['id_tr' => $id, 'username' => $this->session->userdata('username')])->row_array();
        if ($tr) {
            $new_status = $tr['status_aktif'] == 1 ? 0 : 1;
            $this->db->where('id_tr', $id);
            $this->db->update('transaksi_rutin', ['status_aktif' => $new_status]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Status Transaksi Rutin berhasil diubah!</div>');
        }
        redirect('transaksirutin');
    }
}
