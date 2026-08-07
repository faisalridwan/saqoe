<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wishlist extends CI_Controller
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
        $data['title'] = 'Target Menabung (Wishlist)';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        
        $this->db->where('username', $this->session->userdata('username'));
        $data['wishlists'] = $this->db->get('wishlist')->result_array();

        $this->load->view('templates/user_header', $data);
        $this->load->view('user/wishlist', $data);
        $this->load->view('templates/user_footer');
            $this->load->view("templates/user_content");
    }

    public function tambah()
    {
        $data = [
            'username' => $this->session->userdata('username'),
            'nama_target' => $this->input->post('nama_target'),
            'harga_target' => preg_replace('/[^0-9]/', '', $this->input->post('harga_target')),
            'deadline' => $this->input->post('deadline'),
            'saldo_terkumpul' => 0,
            'status' => 'Belum Tercapai'
        ];

        $this->db->insert('wishlist', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Target impian berhasil ditambahkan!</div>');
        redirect('wishlist');
    }

    public function nabung($id)
    {
        $nominal = preg_replace('/[^0-9]/', '', $this->input->post('nominal'));
        
        // Ambil data wishlist
        $wishlist = $this->db->get_where('wishlist', ['id_wishlist' => $id])->row_array();
        
        // Cek saldo user
        $user = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        
        if ($user['saldo'] < $nominal) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Saldo utama tidak mencukupi untuk menabung!</div>');
            redirect('wishlist');
        }

        // Kurangi saldo utama
        $new_saldo_user = $user['saldo'] - $nominal;
        $this->db->set('saldo', $new_saldo_user);
        $this->db->where('username', $user['username']);
        $this->db->update('pengguna');

        // Tambah saldo wishlist
        $new_saldo_wishlist = $wishlist['saldo_terkumpul'] + $nominal;
        $status = ($new_saldo_wishlist >= $wishlist['harga_target']) ? 'Tercapai' : 'Belum Tercapai';
        
        $this->db->set('saldo_terkumpul', $new_saldo_wishlist);
        $this->db->set('status', $status);
        $this->db->where('id_wishlist', $id);
        $this->db->update('wishlist');

        // Catat pengeluaran di history agar transparan (sebagai transfer ke wishlist)
        date_default_timezone_set('Asia/Jakarta');
        $histori_data = [
            'username' => $user['username'],
            'nama' => 'Nabung untuk: ' . $wishlist['nama_target'],
            'tanggal' => date('d-m-Y'),
            'jam' => date('H:i:s'),
            'kategoriHarian' => 'Pengeluaran',
            'kategoriPengeluaranH' => 'Tabungan',
            'pemasukan' => 0,
            'pengeluaran' => $nominal,
            'sisaSaldo' => $new_saldo_user
        ];
        $this->db->insert('harianhistori', $histori_data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menabung Rp. ' . number_format($nominal, 0, ',', '.') . ' untuk ' . $wishlist['nama_target'] . '</div>');
        redirect('wishlist');
    }

    public function hapus($id)
    {
        // Kembalikan uang ke saldo utama jika ada yang terkumpul (opsional)
        $wishlist = $this->db->get_where('wishlist', ['id_wishlist' => $id])->row_array();
        
        if ($wishlist['saldo_terkumpul'] > 0) {
            $user = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
            $new_saldo_user = $user['saldo'] + $wishlist['saldo_terkumpul'];
            
            $this->db->set('saldo', $new_saldo_user);
            $this->db->where('username', $user['username']);
            $this->db->update('pengguna');
            
            // Catat history
            date_default_timezone_set('Asia/Jakarta');
            $histori_data = [
                'username' => $user['username'],
                'nama' => 'Batal Tabungan: ' . $wishlist['nama_target'],
                'tanggal' => date('d-m-Y'),
                'jam' => date('H:i:s'),
                'kategoriHarian' => 'Pemasukan',
                'kategoriPengeluaranH' => '-',
                'pemasukan' => $wishlist['saldo_terkumpul'],
                'pengeluaran' => 0,
                'sisaSaldo' => $new_saldo_user
            ];
            $this->db->insert('harianhistori', $histori_data);
        }

        $this->db->where('id_wishlist', $id);
        $this->db->delete('wishlist');
        
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Target berhasil dihapus, dan dana dikembalikan ke saldo utama.</div>');
        redirect('wishlist');
    }
}
