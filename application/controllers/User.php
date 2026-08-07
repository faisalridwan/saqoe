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

        // Rasio Pengeluaran
        $saldo = $data['user']['saldo'] ?? 0;
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
            if ($ht['kategoriHarian'] == 'Pemasukan') {
                $month = (int)substr($ht['tanggal'], 3, 2); 
                if ($month >= 1 && $month <= 12) {
                    $area_data[$month - 1] += $ht['pemasukan'];
                }
            }
        }
        $data['chart_area'] = $area_data;

        // Chart Pie: Kategori Pengeluaran
        $this->db->select('kategoriPengeluaranH, SUM(pengeluaran) as total');
        $this->db->where('username', $username);
        $this->db->where('kategoriHarian', 'Pengeluaran');
        $this->db->where('kategoriPengeluaranH !=', '-');
        $this->db->group_by('kategoriPengeluaranH');
        $pie_results = $this->db->get('harianhistori')->result_array();
        
        $pie_labels = [];
        $pie_data = [];
        foreach ($pie_results as $pr) {
            $pie_labels[] = $pr['kategoriPengeluaranH'];
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
        $data['user'] = $this->db->get_where(
            'pengguna',
            ['username' => $this->session->userdata('username')]
        )
            ->row_array();

        $username = $this->session->userdata('username');

        $event = $this->M_User->GetNamaEvent($username);


        $this->form_validation->set_rules('namaPemasukan', 'Nama Pemasukan', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/user_header', $data);
            $this->load->view('user/harianPemasukan', ['event' => $event]);
            $this->load->view('templates/user_footer');
            $this->load->view("templates/user_content");
        } else {

            $data = [

                'username' => $this->session->userdata('username'),
                'namaPemasukan' => $this->input->post('namaPemasukan', true),
                'besarPemasukan' => preg_replace('/[^0-9]/', '', $this->input->post('besarPemasukan', true)),
                'tanggalPemasukan' => date('Y-m-d '),
                'jamPemasukan' => date('H:i:s'),
            ];

            $this->db->insert('harianpemasukan', $data);

            $saldo = preg_replace('/[^0-9]/', '', $this->input->post('saldo', true));

            $saldosekarang = $data['besarPemasukan'] + $saldo;

            $this->db->set('saldo', $saldosekarang);
            $this->db->where('username', $data['username']);
            $this->db->update('pengguna');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			You Pemasukan has been updated ! </div>');
            redirect('user/harianPemasukan');
        }
    }



    public function harianPengeluaran()
    {
        $data['title'] = 'Harian Pengeluaran';
        $data['user'] = $this->db->get_where(
            'pengguna',
            ['username' => $this->session->userdata('username')]
        )
            ->row_array();

        $username = $this->session->userdata('username');

        $event = $this->M_User->GetNamaEvent($username);



        $this->form_validation->set_rules('namaPengeluaran', 'Nama Pengeluaran', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/user_header', $data);
            $this->load->view('user/harianPengeluaran', ['event' => $event]);
            $this->load->view('templates/user_footer');
            $this->load->view("templates/user_content");
        } else {

            $data = [

                'username' => $this->session->userdata('username'),
                'namaPengeluaran' => $this->input->post('namaPengeluaran', true),
                'besarPengeluaran' => preg_replace('/[^0-9]/', '', $this->input->post('besarPengeluaran', true)),
                'tanggalPengeluaran' => date('Y-m-d '),
                'jamPengeluaran' => date('H:i:s'),
            ];

            $this->db->insert('harianPengeluaran', $data);

            $saldo = preg_replace('/[^0-9]/', '', $this->input->post('saldo', true));

            $saldosekarang =  $saldo - $data['besarPengeluaran'];

            $this->db->set('saldo', $saldosekarang);
            $this->db->where('username', $data['username']);
            $this->db->update('pengguna');



            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			You Pengeluaran has been updated ! </div>');
            redirect('user/harianPengeluaran');
        }
    }


    public function event()
    {

        $data['user'] = $this->db->get_where(
            'pengguna',
            ['username' => $this->session->userdata('username')]
        )
            ->row_array();

        $username = $this->session->userdata('username');

        $event = $this->M_User->GetNamaEvent($username);

        $this->form_validation->set_rules('namaEvent', 'Nama Event', 'required|trim');

        $data = [

            'username' => $this->session->userdata('username'),
            'namaEvent' => $this->input->post('namaEvent', true),
            'budget' => preg_replace('/[^0-9]/', '', $this->input->post('budget', true)),
        ];

        $this->db->insert('event', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        You Pengeluaran has been updated ! </div>');
        redirect();
    }


    public function eventPemasukan()
    {
        $namaEvent = $this->input->post('namaEvent');
        $username = $this->session->userdata('username');
        $data['title'] = 'Event ' . $namaEvent . ' Pemasukan';
        $data['eventsekarang'] = $namaEvent;
        $data['user'] = $this->db->get_where(
            'pengguna',
            ['username' => $username]
        )
            ->row_array();

        $data['eventt'] = $this->db->get_where(
            'event',
            ['username' => $username, 'namaEvent' => $namaEvent]
        )
            ->row_array();



        $event = $this->M_User->GetNamaEvent($username);



        $this->form_validation->set_rules('namaPemasukan', 'Nama Pemasukan', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/user_header', $data);
            $this->load->view('user/eventPemasukan', $data, ['event' => $event]);
            $this->load->view('templates/user_footer', ['event' => $event]);
            $this->load->view("templates/user_content", ['event' => $event]);
        } else {

            $data = [

                'username' => $this->session->userdata('username'),
                'namaEvent' => $namaEvent,
                'namaPemasukanEvent' => $this->input->post('namaPemasukan', true),
                'budget' => preg_replace('/[^0-9]/', '', $this->input->post('budget', true)),
                'tanggalPemasukan' => date('Y-m-d '),
                'jamPemasukan' => date('H:i:s'),
            ];

            $this->db->insert('eventpemasukan', $data);

            $saldo = preg_replace('/[^0-9]/', '', $this->input->post('budgetSekarang', true));

            $saldosekarang = $data['budget'] + $saldo;

            $this->db->set('budget', $saldosekarang);
            $this->db->where('username', $data['username']);
            $this->db->where('namaEvent', $namaEvent);
            $this->db->update('event');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                You Pemasukan has been updated ! </div>');

                $namaEvent = $this->input->post('namaEvent');
        $username = $this->session->userdata('username');
        $data['title'] = 'Event ' . $namaEvent . ' Pemasukan';
        $data['eventsekarang'] = $namaEvent;
        $data['user'] = $this->db->get_where(
            'pengguna',
            ['username' => $username]
        )
            ->row_array();

        $data['eventt'] = $this->db->get_where(
            'event',
            ['username' => $username, 'namaEvent' => $namaEvent]
        )
            ->row_array();



        $event = $this->M_User->GetNamaEvent($username);
            $this->load->view('templates/user_header', $data);
            $this->load->view('user/eventPemasukan', $data, ['event' => $event]);
            $this->load->view('templates/user_footer', ['event' => $event]);
            $this->load->view("templates/user_content", ['event' => $event]);
        }
    }

    // 

    public function eventPengeluaran()
    {
        $namaEvent = $this->input->post('namaEvent');
        $username = $this->session->userdata('username');
        $data['title'] = 'Event ' . $namaEvent . ' Pengeluaran';
        $data['eventsekarang'] = $namaEvent;
        $data['user'] = $this->db->get_where(
            'pengguna',
            ['username' => $username]
        )
            ->row_array();

        $data['eventt'] = $this->db->get_where(
            'event',
            ['username' => $username, 'namaEvent' => $namaEvent]
        )
            ->row_array();



        $event = $this->M_User->GetNamaEvent($username);



        $this->form_validation->set_rules('namaPengeluaran', 'Nama Pengeluaran', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/user_header', $data);
            $this->load->view('user/eventPengeluaran', $data, ['event' => $event]);
            $this->load->view('templates/user_footer', ['event' => $event]);
            $this->load->view("templates/user_content", ['event' => $event]);
        } else {

            $data = [

                'username' => $this->session->userdata('username'),
                'namaEvent' => $namaEvent,
                'namaPengeluaranEvent' => $this->input->post('namaPengeluaran', true),
                'besarPengeluaran' => preg_replace('/[^0-9]/', '', $this->input->post('budget', true)),
                'kategoriPengeluaranEvent' => $this->input->post('kategori',true),
                'tglPengeluaranEvent' => date('Y-m-d'),
                'jamPengeluaran' => date('H:i:s'),
            ];

            $this->db->insert('eventpengeluaran', $data);

            $saldo = preg_replace('/[^0-9]/', '', $this->input->post('budgetSekarang', true));

            $saldosekarang =  $saldo - $data['besarPengeluaran'];

            $this->db->set('budget', $saldosekarang);
            $this->db->where('username', $data['username']);
            $this->db->where('namaEvent', $namaEvent);
            $this->db->update('event');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                You Pemasukan has been updated ! </div>');

                $namaEvent = $this->input->post('namaEvent');
        $username = $this->session->userdata('username');
        $data['title'] = 'Event ' . $namaEvent . ' Pengeluaran';
        $data['eventsekarang'] = $namaEvent;
        $data['user'] = $this->db->get_where(
            'pengguna',
            ['username' => $username]
        )
            ->row_array();

        $data['eventt'] = $this->db->get_where(
            'event',
            ['username' => $username, 'namaEvent' => $namaEvent]
        )
            ->row_array();



        $event = $this->M_User->GetNamaEvent($username);
            $this->load->view('templates/user_header', $data);
            $this->load->view('user/eventPengeluaran', $data, ['event' => $event]);
            $this->load->view('templates/user_footer', ['event' => $event]);
            $this->load->view("templates/user_content", ['event' => $event]);
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
