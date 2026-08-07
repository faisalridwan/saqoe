<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kalender extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }
        $this->load->model('M_User');
    }

    public function index()
    {
        $data['title'] = 'Kalender Keuangan';
        $username = $this->session->userdata('username');
        $data['user'] = $this->db->get_where('pengguna', ['username' => $username])->row_array();
        $event = $this->M_User->GetNamaEvent($username);

        $this->load->view('templates/user_header', $data);
        $this->load->view('user/kalender', array_merge($data, ['event' => $event]));
        $this->load->view('templates/user_footer');
        $this->load->view('templates/user_content');
    }

    public function get_events()
    {
        $username = $this->session->userdata('username');
        $this->db->where('username', $username);
        $history = $this->db->get('harianhistori')->result_array();
        
        $events = [];
        foreach ($history as $h) {
            // Konversi dari d-m-Y ke Y-m-d
            $date = DateTime::createFromFormat('d-m-Y', $h['tanggal']);
            if ($date) {
                $dateString = $date->format('Y-m-d');
                $isPemasukan = $h['tipe'] == 'Pemasukan';
                $events[] = [
                    'title' => ($isPemasukan ? '+ Rp' : '- Rp') . number_format($isPemasukan ? $h['pemasukan'] : $h['pengeluaran'], 0, ',', '.'),
                    'start' => $dateString,
                    'color' => $isPemasukan ? '#1cc88a' : '#e74a3b', // Success vs Danger
                    'description' => $h['nama'] . ' (' . $h['kategori'] . ')'
                ];
            }
        }
        echo json_encode($events);
    }
}
