<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HutangPiutang extends CI_Controller
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
        $data['title'] = 'Manajemen Hutang & Piutang';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        
        $this->db->select('hutang_piutang.*, dompet.nama_dompet');
        $this->db->from('hutang_piutang');
        $this->db->join('dompet', 'dompet.id_dompet = hutang_piutang.id_dompet', 'left');
        $this->db->where('hutang_piutang.username', $this->session->userdata('username'));
        $this->db->order_by('tanggal_pinjam', 'DESC');
        $data['catatan'] = $this->db->get()->result_array();

        $data['list_dompet'] = $this->db->get_where('dompet', ['username' => $this->session->userdata('username')])->result_array();

        // Hitung total hutang dan piutang
        $data['total_hutang'] = 0;
        $data['total_piutang'] = 0;
        foreach($data['catatan'] as $c) {
            if ($c['status'] == 'Belum Lunas') {
                if ($c['jenis'] == 'Hutang') {
                    $data['total_hutang'] += $c['nominal'];
                } else {
                    $data['total_piutang'] += $c['nominal'];
                }
            }
        }

        $this->load->view('templates/user_header', $data);
        $this->load->view('user/hutang_piutang', $data);
        $this->load->view('templates/user_footer');
            $this->load->view("templates/user_content");
    }

    public function tambah()
    {
        $id_dompet = $this->input->post('id_dompet');
        $data = [
            'username' => $this->session->userdata('username'),
            'jenis' => $this->input->post('jenis'),
            'nama_orang' => $this->input->post('nama_orang'),
            'nominal' => preg_replace('/[^0-9]/', '', $this->input->post('nominal')),
            'tanggal_pinjam' => $this->input->post('tanggal_pinjam'),
            'jatuh_tempo' => $this->input->post('jatuh_tempo') ?: NULL,
            'status' => 'Belum Lunas',
            'id_dompet' => $id_dompet
        ];

        $user = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $dompet = $this->db->get_where('dompet', ['id_dompet' => $id_dompet, 'username' => $user['username']])->row_array();

        if (!$dompet) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Dompet tidak ditemukan!</div>');
            redirect('hutangpiutang');
            return;
        }

        // Jika jenisnya Piutang (Kita meminjamkan uang ke orang), potong saldo dompet
        if ($data['jenis'] == 'Piutang') {
            if ($dompet['saldo'] < $data['nominal']) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Saldo di Dompet tidak mencukupi untuk meminjamkan uang sejumlah itu!</div>');
                redirect('hutangpiutang');
                return;
            }
            $new_saldo_dompet = $dompet['saldo'] - $data['nominal'];
            $new_saldo_user = $user['saldo'] - $data['nominal'];

            $this->db->set('saldo', $new_saldo_dompet);
            $this->db->where('id_dompet', $id_dompet);
            $this->db->update('dompet');

            $this->db->set('saldo', $new_saldo_user);
            $this->db->where('username', $user['username']);
            $this->db->update('pengguna');
            
            // Catat history
            date_default_timezone_set('Asia/Jakarta');
            $histori_data = [
                'username' => $user['username'],
                'nama' => 'Meminjamkan Uang ke: ' . $data['nama_orang'],
                'tanggal' => date('d-m-Y'),
                'jam' => date('H:i:s'),
                'tipe' => 'Pengeluaran',
                'kategori' => 'Piutang',
                'pemasukan' => 0,
                'pengeluaran' => $data['nominal'],
                'sisaSaldo' => $new_saldo_dompet,
                'id_dompet' => $id_dompet
            ];
            $this->db->insert('harianhistori', $histori_data);
        } else {
            // Jika jenisnya Hutang (Kita meminjam uang dari orang), tambah saldo dompet
            $new_saldo_dompet = $dompet['saldo'] + $data['nominal'];
            $new_saldo_user = $user['saldo'] + $data['nominal'];

            $this->db->set('saldo', $new_saldo_dompet);
            $this->db->where('id_dompet', $id_dompet);
            $this->db->update('dompet');

            $this->db->set('saldo', $new_saldo_user);
            $this->db->where('username', $user['username']);
            $this->db->update('pengguna');
            
            // Catat history
            date_default_timezone_set('Asia/Jakarta');
            $histori_data = [
                'username' => $user['username'],
                'nama' => 'Menerima Pinjaman dari: ' . $data['nama_orang'],
                'tanggal' => date('d-m-Y'),
                'jam' => date('H:i:s'),
                'tipe' => 'Pemasukan',
                'kategori' => '-',
                'pemasukan' => $data['nominal'],
                'pengeluaran' => 0,
                'sisaSaldo' => $new_saldo_dompet,
                'id_dompet' => $id_dompet
            ];
            $this->db->insert('harianhistori', $histori_data);
        }

        $this->db->insert('hutang_piutang', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Catatan ' . $data['jenis'] . ' berhasil ditambahkan!</div>');
        redirect('hutangpiutang');
    }

    public function lunas($id)
    {
        $catatan = $this->db->get_where('hutang_piutang', ['id_hp' => $id])->row_array();
        $user = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        
        $id_dompet = $catatan['id_dompet'];
        $dompet = $this->db->get_where('dompet', ['id_dompet' => $id_dompet])->row_array();

        if ($catatan['jenis'] == 'Piutang') {
            // Orang bayar hutang ke kita = Saldo bertambah
            $new_saldo_dompet = $dompet['saldo'] + $catatan['nominal'];
            $new_saldo_user = $user['saldo'] + $catatan['nominal'];
            
            $nama_history = 'Penerimaan Pembayaran Piutang dari: ' . $catatan['nama_orang'];
            $pemasukan = $catatan['nominal'];
            $pengeluaran = 0;
            $kategori_harian = 'Pemasukan';
            $kategori_pengeluaran = '-';
        } else {
            // Kita bayar hutang ke orang = Saldo berkurang
            if ($dompet['saldo'] < $catatan['nominal']) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Saldo Dompet tidak mencukupi untuk melunasi hutang ini!</div>');
                redirect('hutangpiutang');
                return;
            }
            $new_saldo_dompet = $dompet['saldo'] - $catatan['nominal'];
            $new_saldo_user = $user['saldo'] - $catatan['nominal'];
            
            $nama_history = 'Melunasi Hutang ke: ' . $catatan['nama_orang'];
            $pemasukan = 0;
            $pengeluaran = $catatan['nominal'];
            $kategori_harian = 'Pengeluaran';
            $kategori_pengeluaran = 'Bayar Hutang';
        }

        // Update Saldo User
        $this->db->set('saldo', $new_saldo_user);
        $this->db->where('username', $user['username']);
        $this->db->update('pengguna');

        // Update Saldo Dompet
        $this->db->set('saldo', $new_saldo_dompet);
        $this->db->where('id_dompet', $id_dompet);
        $this->db->update('dompet');

        // Update Status Lunas
        $this->db->set('status', 'Lunas');
        $this->db->where('id_hp', $id);
        $this->db->update('hutang_piutang');

        // Catat di history
        date_default_timezone_set('Asia/Jakarta');
        $histori_data = [
            'username' => $user['username'],
            'nama' => $nama_history,
            'tanggal' => date('d-m-Y'),
            'jam' => date('H:i:s'),
            'tipe' => $kategori_harian,
            'kategori' => $kategori_pengeluaran,
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
            'sisaSaldo' => $new_saldo_dompet,
            'id_dompet' => $id_dompet
        ];
        $this->db->insert('harianhistori', $histori_data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Status berhasil diubah menjadi Lunas! Transaksi tercatat di history.</div>');
        redirect('hutangpiutang');
    }

    public function hapus($id)
    {
        $this->db->where('id_hp', $id);
        $this->db->delete('hutang_piutang');
        
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Catatan berhasil dihapus! (Tidak mempengaruhi saldo)</div>');
        redirect('hutangpiutang');
    }
}
