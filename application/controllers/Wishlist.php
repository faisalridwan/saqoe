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

        $data['list_dompet'] = $this->db->get_where('dompet', ['username' => $this->session->userdata('username')])->result_array();

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
        $id_dompet = $this->input->post('id_dompet');
        
        // Ambil data wishlist
        $wishlist = $this->db->get_where('wishlist', ['id_wishlist' => $id])->row_array();
        
        // Cek saldo dompet & user
        $user = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $dompet = $this->db->get_where('dompet', ['id_dompet' => $id_dompet, 'username' => $user['username']])->row_array();
        
        if (!$dompet) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Dompet tidak ditemukan!</div>');
            redirect('wishlist');
            return;
        }

        if ($dompet['saldo'] < $nominal) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Saldo Dompet tidak mencukupi untuk menabung!</div>');
            redirect('wishlist');
            return;
        }

        // Kurangi saldo dompet & utama
        $new_saldo_dompet = $dompet['saldo'] - $nominal;
        $new_saldo_user = $user['saldo'] - $nominal;

        $this->db->set('saldo', $new_saldo_dompet);
        $this->db->where('id_dompet', $id_dompet);
        $this->db->update('dompet');

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
            'tipe' => 'Pengeluaran',
            'kategori' => 'Tabungan',
            'pemasukan' => 0,
            'pengeluaran' => $nominal,
            'sisaSaldo' => $new_saldo_dompet,
            'id_dompet' => $id_dompet
        ];
        $this->db->insert('harianhistori', $histori_data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menabung Rp. ' . number_format($nominal, 0, ',', '.') . ' untuk ' . $wishlist['nama_target'] . '</div>');
        redirect('wishlist');
    }

    public function hapus($id)
    {
        // Kembalikan uang ke saldo dompet utama jika ada yang terkumpul (opsional)
        $wishlist = $this->db->get_where('wishlist', ['id_wishlist' => $id])->row_array();
        
        if ($wishlist['saldo_terkumpul'] > 0) {
            $user = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
            
            // Ambil Dompet Utama (karena tidak terikat di db saat nabung per wishlist, kembalikan ke default saja)
            $dompet_utama = $this->db->get_where('dompet', ['username' => $user['username'], 'nama_dompet' => 'Dompet Utama'])->row_array();
            if (!$dompet_utama) {
                // fallback if Dompet Utama doesn't exist
                $dompet_utama = $this->db->get_where('dompet', ['username' => $user['username']])->row_array();
            }

            $new_saldo_dompet = $dompet_utama['saldo'] + $wishlist['saldo_terkumpul'];
            $new_saldo_user = $user['saldo'] + $wishlist['saldo_terkumpul'];
            
            $this->db->set('saldo', $new_saldo_dompet);
            $this->db->where('id_dompet', $dompet_utama['id_dompet']);
            $this->db->update('dompet');

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
                'tipe' => 'Pemasukan',
                'kategori' => '-',
                'pemasukan' => $wishlist['saldo_terkumpul'],
                'pengeluaran' => 0,
                'sisaSaldo' => $new_saldo_dompet,
                'id_dompet' => $dompet_utama['id_dompet']
            ];
            $this->db->insert('harianhistori', $histori_data);
        }

        $this->db->where('id_wishlist', $id);
        $this->db->delete('wishlist');
        
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Target berhasil dihapus, dan dana dikembalikan ke saldo utama.</div>');
        redirect('wishlist');
    }
}
