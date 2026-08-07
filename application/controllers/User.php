<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }
        $this->load->model('M_User');
        $this->load->library('form_validation');
        $this->_cekTransaksiRutin();
    }

    private function _cekTransaksiRutin()
    {
        $username = $this->session->userdata('username');
        if (!$username) return;

        $today_date = (int)date('d');
        $current_month = date('Y-m');

        // Cari transaksi rutin yang aktif dan tanggal eksekusinya adalah hari ini atau sebelumnya di bulan ini
        $this->db->where('username', $username);
        $this->db->where('status_aktif', 1);
        $this->db->where('tanggal_eksekusi <=', $today_date);
        $this->db->where("(last_executed IS NULL OR DATE_FORMAT(last_executed, '%Y-%m') != '$current_month')", NULL, FALSE);
        $rutin = $this->db->get('transaksi_rutin')->result_array();

        foreach ($rutin as $r) {
            $dompet = $this->db->get_where('dompet', ['id_dompet' => $r['id_dompet'], 'username' => $username])->row_array();
            if (!$dompet) continue;

            $saldosekarang = $dompet['saldo'];
            if ($r['jenis'] == 'Pemasukan') {
                $saldosekarang += $r['nominal'];
            } else {
                $saldosekarang -= $r['nominal'];
            }

            // Update dompet
            $this->db->where('id_dompet', $r['id_dompet']);
            $this->db->update('dompet', ['saldo' => $saldosekarang]);

            // Insert ke histori
            $histori_data = [
                'username' => $username,
                'nama' => '[Rutin] ' . $r['judul'],
                'tanggal' => date('d-m-Y'),
                'jam' => date('H:i:s'),
                'tipe' => $r['jenis'],
                'kategori' => $r['kategori'],
                'pemasukan' => $r['jenis'] == 'Pemasukan' ? $r['nominal'] : 0,
                'pengeluaran' => $r['jenis'] == 'Pengeluaran' ? $r['nominal'] : 0,
                'sisaSaldo' => $saldosekarang,
                'id_dompet' => $r['id_dompet']
            ];
            $this->db->insert('harianhistori', $histori_data);

            // Update last_executed
            $this->db->where('id_tr', $r['id_tr']);
            $this->db->update('transaksi_rutin', ['last_executed' => date('Y-m-d')]);
        }
    }
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where(
            'pengguna',
            ['username' => $this->session->userdata('username')]
        )
            ->row_array();


        $username = $this->session->userdata('username');
        $event = $this->M_User->GetNamaEvent($username);

        $this->db->select_sum('pemasukan');
        $this->db->where('username', $username);
        $total_pemasukan = $this->db->get('harianhistori')->row()->pemasukan ?? 0;
        $data['total_pemasukan'] = $total_pemasukan;

        $this->db->select_sum('pengeluaran');
        $this->db->where('username', $username);
        $total_pengeluaran = $this->db->get('harianhistori')->row()->pengeluaran ?? 0;
        $data['total_pengeluaran'] = $total_pengeluaran;

        // Hitung total saldo dari semua dompet
        $this->db->select_sum('saldo');
        $this->db->where('username', $username);
        $total_saldo = $this->db->get('dompet')->row()->saldo ?? 0;
        $data['user']['saldo'] = $total_saldo; // override the old field

        // List semua dompet untuk ditampilkan
        $this->db->where('username', $username);
        $data['list_dompet'] = $this->db->get('dompet')->result_array();

        // Rasio Pengeluaran
        $saldo = $total_saldo;
        $total_kas = $saldo + $total_pengeluaran;
        $persentase = $total_kas > 0 ? round(($total_pengeluaran / $total_kas) * 100) : 0;
        $data['persentase_pengeluaran'] = $persentase;

        // Total Transaksi
        $this->db->where('username', $username);
        $count_harian = $this->db->count_all_results('harianhistori');
        
        $this->db->where('username', $username);
        $count_event = $this->db->count_all_results('eventhistori');
        $data['total_transaksi'] = $count_harian + $count_event;

        // Chart Area: Pemasukan per bulan tahun berjalan
        $current_year = date('Y');
        $area_data = array_fill(0, 12, 0); 
        $this->db->where('username', $username);
        $this->db->like('tanggal', "-$current_year"); 
        $histori_thn = $this->db->get('harianhistori')->result_array();
        
        foreach ($histori_thn as $ht) {
            if ($ht['tipe'] == 'Pemasukan') {
                $month = (int)substr($ht['tanggal'], 3, 2); 
                if ($month >= 1 && $month <= 12) {
                    $area_data[$month - 1] += $ht['pemasukan'];
                }
            }
        }
        $data['chart_area'] = $area_data;

        // Chart Pie: Kategori Pengeluaran
        $this->db->select('kategori, SUM(pengeluaran) as total');
        $this->db->where('username', $username);
        $this->db->where('tipe', 'Pengeluaran');
        $this->db->where('kategori !=', '-');
        $this->db->group_by('kategori');
        $pie_results = $this->db->get('harianhistori')->result_array();
        
        $pie_labels = [];
        $pie_data = [];
        foreach ($pie_results as $pr) {
            $pie_labels[] = $pr['kategori'];
            $pie_data[] = $pr['total'];
        }
        $data['chart_pie_labels'] = $pie_labels;
        $data['chart_pie_data'] = $pie_data;

        $this->load->view('templates/user_header', $data);
        $this->load->view('user/index', array_merge($data, ['event' => $event]));
        $this->load->view('templates/user_footer');
            $this->load->view("templates/user_content");
    }

    public function profile()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where(
            'pengguna',
            ['username' => $this->session->userdata('username')]
        )
            ->row_array();
        $username = $this->session->userdata('username');

        $event = $this->M_User->GetNamaEvent($username);

        $this->load->view('templates/user_header', $data);
        $this->load->view('user/profile', ['event' => $event]);
        $this->load->view('templates/user_footer');
            $this->load->view("templates/user_content");
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $username = $this->session->userdata('username');

        $event = $this->M_User->GetNamaEvent($username);
        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('user/edit', $data, ['event' => $event]);
            $this->load->view('templates/user_footer');
            $this->load->view("templates/user_content");
        } else {
            $new_image = null;
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '22048';
                $config['upload_path'] = './assets/img/profile/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                    redirect('user/edit');
                    return;
                }
            }
            $this->M_User->EditPengguna($new_image);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Your profile has been updated ! </div>');
            redirect('user/edit');
        }
    }

    public function harianPemasukan()
    {
        $data['title'] = 'Harian Pemasukan';
        $username = $this->session->userdata('username');
        
        $data['user'] = $this->db->get_where('pengguna', ['username' => $username])->row_array();
        $event = $this->M_User->GetNamaEvent($username);

        $data['list_dompet'] = $this->db->get_where('dompet', ['username' => $username])->result_array();
        $data['kategori_pemasukan'] = $this->db->get_where('kategori', ['username' => $username, 'tipe' => 'Pemasukan'])->result_array();

        $this->form_validation->set_rules('namaPemasukan', 'Nama Pemasukan', 'required|trim');
        $this->form_validation->set_rules('id_dompet', 'Dompet', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('user/harianPemasukan', ['event' => $event, 'list_dompet' => $data['list_dompet'], 'kategori_pemasukan' => $data['kategori_pemasukan'], 'user' => $data['user']]);
            $this->load->view('templates/user_footer');
            $this->load->view("templates/user_content");
        } else {
            $id_dompet = $this->input->post('id_dompet', true);
            $besarPemasukan = preg_replace('/[^0-9]/', '', $this->input->post('besarPemasukan', true));
            $kategori = $this->input->post('kategori', true);
            $nama = $this->input->post('namaPemasukan', true);
            
            $kombinasi_dompet = $this->input->post('kombinasi_dompet');
            
            $dompet1 = $this->db->get_where('dompet', ['id_dompet' => $id_dompet, 'username' => $username])->row_array();
            
            if ($dompet1) {
                // Upload Struk
                $struk_img = null;
                if (!empty($_FILES['struk']['name'])) {
                    $config['upload_path'] = './assets/img/struk/';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $config['max_size'] = 2048;
                    $config['file_name'] = 'struk_masuk_' . time() . '_' . $username;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('struk')) {
                        $struk_img = $this->upload->data('file_name');
                    }
                }

                if ($kombinasi_dompet == '1') {
                    $id_dompet_2 = $this->input->post('id_dompet_2', true);
                    $nominal_dompet_1 = preg_replace('/[^0-9]/', '', $this->input->post('nominal_dompet_1', true));
                    
                    if ($nominal_dompet_1 > $besarPemasukan) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Nominal dompet pertama tidak boleh melebihi total pemasukan!</div>');
                        redirect('user/harianPemasukan');
                        return;
                    }
                    
                    $nominal_dompet_2 = $besarPemasukan - $nominal_dompet_1;
                    $dompet2 = $this->db->get_where('dompet', ['id_dompet' => $id_dompet_2, 'username' => $username])->row_array();
                    
                    if (!$dompet2) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Dompet ke-2 tidak ditemukan!</div>');
                        redirect('user/harianPemasukan');
                        return;
                    }
                    
                    // Update saldo dompet 1
                    $this->db->where('id_dompet', $id_dompet);
                    $this->db->update('dompet', ['saldo' => $dompet1['saldo'] + $nominal_dompet_1]);
                    
                    // Update saldo dompet 2
                    $this->db->where('id_dompet', $id_dompet_2);
                    $this->db->update('dompet', ['saldo' => $dompet2['saldo'] + $nominal_dompet_2]);
                    
                    $dompet_nama_histori = $dompet1['nama_dompet'] . " (Rp " . number_format($nominal_dompet_1, 0, ',', '.') . ") & " . $dompet2['nama_dompet'] . " (Rp " . number_format($nominal_dompet_2, 0, ',', '.') . ")";
                    $saldosekarang = $dompet1['saldo'] + $nominal_dompet_1; // for histori logic
                } else {
                    $saldosekarang = $dompet1['saldo'] + $besarPemasukan;
                    // Update saldo dompet 1 only
                    $this->db->where('id_dompet', $id_dompet);
                    $this->db->update('dompet', ['saldo' => $saldosekarang]);
                    
                    $dompet_nama_histori = $dompet1['nama_dompet'];
                }

                // Update saldo total pengguna
                $this->db->set('saldo', 'saldo + ' . $besarPemasukan, FALSE);
                $this->db->where('username', $username);
                $this->db->update('pengguna');

                // Insert harian histori
                $histori_data = [
                    'username' => $username,
                    'nama' => $nama,
                    'tanggal' => date('d-m-Y'),
                    'jam' => date('H:i:s'),
                    'tipe' => 'Pemasukan',
                    'kategori' => $kategori,
                    'pemasukan' => $besarPemasukan,
                    'pengeluaran' => 0,
                    'sisaSaldo' => $saldosekarang,
                    'id_dompet' => $id_dompet,
                    'dompet_nama' => $dompet_nama_histori,
                    'struk_img' => $struk_img
                ];
                $this->db->insert('harianhistori', $histori_data);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pemasukan berhasil ditambahkan!</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Dompet tidak ditemukan!</div>');
            }
            redirect('user/harianPemasukan');
        }
    }



    public function harianPengeluaran()
    {
        $data['title'] = 'Harian Pengeluaran';
        $username = $this->session->userdata('username');
        
        $data['user'] = $this->db->get_where('pengguna', ['username' => $username])->row_array();
        $event = $this->M_User->GetNamaEvent($username);

        $data['list_dompet'] = $this->db->get_where('dompet', ['username' => $username])->result_array();
        $data['kategori_pengeluaran'] = $this->db->get_where('kategori', ['username' => $username, 'tipe' => 'Pengeluaran'])->result_array();

        $this->form_validation->set_rules('namaPengeluaran', 'Nama Pengeluaran', 'required|trim');
        $this->form_validation->set_rules('id_dompet', 'Dompet', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('user/harianPengeluaran', ['event' => $event, 'list_dompet' => $data['list_dompet'], 'kategori_pengeluaran' => $data['kategori_pengeluaran'], 'user' => $data['user']]);
            $this->load->view('templates/user_footer');
            $this->load->view("templates/user_content");
        } else {
            $id_dompet = $this->input->post('id_dompet', true);
            $besarPengeluaran = preg_replace('/[^0-9]/', '', $this->input->post('besarPengeluaran', true));
            $kategori = $this->input->post('kategori', true);
            $nama = $this->input->post('namaPengeluaran', true);
            
            $kombinasi_dompet = $this->input->post('kombinasi_dompet');

            $dompet1 = $this->db->get_where('dompet', ['id_dompet' => $id_dompet, 'username' => $username])->row_array();
            
            if ($dompet1) {
                // Upload Struk
                $struk_img = null;
                if (!empty($_FILES['struk']['name'])) {
                    $config['upload_path'] = './assets/img/struk/';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $config['max_size'] = 2048;
                    $config['file_name'] = 'struk_keluar_' . time() . '_' . $username;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('struk')) {
                        $struk_img = $this->upload->data('file_name');
                    }
                }

                if ($kombinasi_dompet == '1') {
                    $id_dompet_2 = $this->input->post('id_dompet_2', true);
                    $nominal_dompet_1 = preg_replace('/[^0-9]/', '', $this->input->post('nominal_dompet_1', true));
                    
                    if ($nominal_dompet_1 > $besarPengeluaran) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Nominal dompet pertama tidak boleh melebihi total pengeluaran!</div>');
                        redirect('user/harianPengeluaran');
                        return;
                    }
                    
                    if ($dompet1['saldo'] < $nominal_dompet_1) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Saldo di Dompet Utama tidak mencukupi!</div>');
                        redirect('user/harianPengeluaran');
                        return;
                    }
                    
                    $nominal_dompet_2 = $besarPengeluaran - $nominal_dompet_1;
                    $dompet2 = $this->db->get_where('dompet', ['id_dompet' => $id_dompet_2, 'username' => $username])->row_array();
                    
                    if (!$dompet2) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Dompet ke-2 tidak ditemukan!</div>');
                        redirect('user/harianPengeluaran');
                        return;
                    }
                    
                    if ($dompet2['saldo'] < $nominal_dompet_2) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Saldo di Dompet ke-2 tidak mencukupi!</div>');
                        redirect('user/harianPengeluaran');
                        return;
                    }
                    
                    // Update saldo dompet 1
                    $this->db->where('id_dompet', $id_dompet);
                    $this->db->update('dompet', ['saldo' => $dompet1['saldo'] - $nominal_dompet_1]);
                    
                    // Update saldo dompet 2
                    $this->db->where('id_dompet', $id_dompet_2);
                    $this->db->update('dompet', ['saldo' => $dompet2['saldo'] - $nominal_dompet_2]);
                    
                    $dompet_nama_histori = $dompet1['nama_dompet'] . " (Rp " . number_format($nominal_dompet_1, 0, ',', '.') . ") & " . $dompet2['nama_dompet'] . " (Rp " . number_format($nominal_dompet_2, 0, ',', '.') . ")";
                    $saldosekarang = $dompet1['saldo'] - $nominal_dompet_1; // for histori logic
                } else {
                    if ($dompet1['saldo'] < $besarPengeluaran) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Saldo di Dompet tidak mencukupi!</div>');
                        redirect('user/harianPengeluaran');
                        return;
                    }
                    
                    $saldosekarang = $dompet1['saldo'] - $besarPengeluaran;
                    // Update saldo dompet 1
                    $this->db->where('id_dompet', $id_dompet);
                    $this->db->update('dompet', ['saldo' => $saldosekarang]);
                    
                    $dompet_nama_histori = $dompet1['nama_dompet'];
                }

                // Update saldo total pengguna
                $this->db->set('saldo', 'saldo - ' . $besarPengeluaran, FALSE);
                $this->db->where('username', $username);
                $this->db->update('pengguna');

                // Insert harian histori
                $histori_data = [
                    'username' => $username,
                    'nama' => $nama,
                    'tanggal' => date('d-m-Y'),
                    'jam' => date('H:i:s'),
                    'tipe' => 'Pengeluaran',
                    'kategori' => $kategori,
                    'pemasukan' => 0,
                    'pengeluaran' => $besarPengeluaran,
                    'sisaSaldo' => $saldosekarang,
                    'id_dompet' => $id_dompet,
                    'dompet_nama' => $dompet_nama_histori,
                    'struk_img' => $struk_img
                ];
                $this->db->insert('harianhistori', $histori_data);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengeluaran berhasil ditambahkan!</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Dompet tidak ditemukan!</div>');
            }
            redirect('user/harianPengeluaran');
        }
    }




    public function eventPemasukan()
    {
        $username = $this->session->userdata('username');
        $data['title'] = 'Pemasukan Event';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $username])->row_array();
        
        // Get all events for the dropdown
        $data['events'] = $this->db->get_where('event', ['username' => $username])->result_array();
        
        $event = $this->M_User->GetNamaEvent($username);
        $data['kategori_pemasukan'] = $this->db->get_where('kategori', ['username' => $username, 'tipe' => 'Pemasukan'])->result_array();

        $this->form_validation->set_rules('namaEvent', 'Nama Event', 'required|trim');
        $this->form_validation->set_rules('namaPemasukan', 'Nama Pemasukan', 'required|trim');
        $this->form_validation->set_rules('budget', 'Besar Pemasukan', 'required|trim');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('user/eventPemasukan', $data, ['event' => $event]);
            $this->load->view('templates/user_footer', ['event' => $event]);
            $this->load->view("templates/user_content", ['event' => $event]);
        } else {
            $namaEvent = $this->input->post('namaEvent', true);
            
            // Get current budget for the selected event directly from DB for security
            $eventt = $this->db->get_where('event', ['username' => $username, 'namaEvent' => $namaEvent])->row_array();
            $budgetSekarang = $eventt ? $eventt['budget'] : 0;
            
            $dataInsert = [
                'username' => $username,
                'namaEvent' => $namaEvent,
                'namaPemasukanEvent' => $this->input->post('namaPemasukan', true),
                'budget' => preg_replace('/[^0-9]/', '', $this->input->post('budget', true)),
                'tanggalPemasukan' => date('Y-m-d '),
                'jamPemasukan' => date('H:i:s'),
                'kategoriPemasukanEvent' => $this->input->post('kategori', true),
            ];

            $this->db->insert('eventpemasukan', $dataInsert);

            $saldosekarang = $dataInsert['budget'] + $budgetSekarang;

            $this->db->set('budget', $saldosekarang);
            $this->db->where('username', $username);
            $this->db->where('namaEvent', $namaEvent);
            $this->db->update('event');

            // Insert to eventhistori
            $histori_data = [
                'username' => $username,
                'kategoriEvent' => 'Pemasukan',
                'namaEvent' => $namaEvent,
                'namaPemaPengEvent' => $this->input->post('namaPemasukan', true),
                'kategoriPengeluaranE' => $this->input->post('kategori', true),
                'tanggal' => date('d-m-Y'),
                'jam' => date('H:i:s'),
                'pemasukanEvent' => $dataInsert['budget'],
                'pengeluaranEvent' => 0,
                'sisaBudget' => $saldosekarang,
            ];
            $this->db->insert('eventhistori', $histori_data);
            
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pemasukan Event berhasil ditambahkan!</div>');
            redirect('user/eventPemasukan');
        }
    }

    // 

    public function eventPengeluaran()
    {
        $username = $this->session->userdata('username');
        $data['title'] = 'Pengeluaran Event';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $username])->row_array();
        
        // Get all events for the dropdown
        $data['events'] = $this->db->get_where('event', ['username' => $username])->result_array();
        
        $event = $this->M_User->GetNamaEvent($username);
        $data['kategori_pengeluaran'] = $this->db->get_where('kategori', ['username' => $username, 'tipe' => 'Pengeluaran'])->result_array();

        $this->form_validation->set_rules('namaEvent', 'Nama Event', 'required|trim');
        $this->form_validation->set_rules('namaPengeluaran', 'Nama Pengeluaran', 'required|trim');
        $this->form_validation->set_rules('budget', 'Besar Pengeluaran', 'required|trim');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('user/eventPengeluaran', $data, ['event' => $event]);
            $this->load->view('templates/user_footer', ['event' => $event]);
            $this->load->view("templates/user_content", ['event' => $event]);
        } else {
            $namaEvent = $this->input->post('namaEvent', true);
            
            // Get current budget directly from DB for security
            $eventt = $this->db->get_where('event', ['username' => $username, 'namaEvent' => $namaEvent])->row_array();
            $budgetSekarang = $eventt ? $eventt['budget'] : 0;
            $besarPengeluaran = preg_replace('/[^0-9]/', '', $this->input->post('budget', true));
            
            if ($budgetSekarang < $besarPengeluaran) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Budget tidak mencukupi!</div>');
                redirect('user/eventPengeluaran');
                return;
            }
            
            $dataInsert = [
                'username' => $username,
                'namaEvent' => $namaEvent,
                'namaPengeluaranEvent' => $this->input->post('namaPengeluaran', true),
                'besarPengeluaran' => $besarPengeluaran,
                'kategoriPengeluaranEvent' => $this->input->post('kategori', true),
                'tglPengeluaranEvent' => date('Y-m-d'),
                'jamPengeluaran' => date('H:i:s'),
            ];

            $this->db->insert('eventpengeluaran', $dataInsert);

            $saldosekarang = $budgetSekarang - $besarPengeluaran;

            $this->db->set('budget', $saldosekarang);
            $this->db->where('username', $username);
            $this->db->where('namaEvent', $namaEvent);
            $this->db->update('event');
            
            // Insert to eventhistori
            $histori_data = [
                'username' => $username,
                'kategoriEvent' => 'Pengeluaran',
                'namaEvent' => $namaEvent,
                'namaPemaPengEvent' => $this->input->post('namaPengeluaran', true),
                'kategoriPengeluaranE' => $this->input->post('kategori', true),
                'tanggal' => date('d-m-Y'),
                'jam' => date('H:i:s'),
                'pemasukanEvent' => 0,
                'pengeluaranEvent' => $besarPengeluaran,
                'sisaBudget' => $saldosekarang,
            ];
            $this->db->insert('eventhistori', $histori_data);
            
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengeluaran Event berhasil ditambahkan!</div>');
            redirect('user/eventPengeluaran');
        }
    }

    public function historyHarian()
    {
        $data['title'] = 'History Harian';
        $username = $this->session->userdata('username');
        $data['user'] = $this->db->get_where('pengguna', ['username' => $username])->row_array();
        
        $this->db->order_by('tanggal', 'DESC');
        $this->db->order_by('jam', 'DESC');
        $data['history'] = $this->db->get_where('harianhistori', ['username' => $username])->result_array();
        $event = $this->M_User->GetNamaEvent($username);

        $this->load->view('templates/user_header', $data);
        $this->load->view('user/historyHarian', array_merge($data, ['event' => $event]));
        $this->load->view('templates/user_footer');
            $this->load->view("templates/user_content");
    }

    public function historyEvent()
    {
        $data['title'] = 'History Event';
        $username = $this->session->userdata('username');
        $data['user'] = $this->db->get_where('pengguna', ['username' => $username])->row_array();
        
        $this->db->order_by('tanggal', 'DESC');
        $this->db->order_by('jam', 'DESC');
        $data['history'] = $this->db->get_where('eventhistori', ['username' => $username])->result_array();
        $event = $this->M_User->GetNamaEvent($username);

        $this->load->view('templates/user_header', $data);
        $this->load->view('user/historyEvent', array_merge($data, ['event' => $event]));
        $this->load->view('templates/user_footer');
            $this->load->view("templates/user_content");
    }
}
