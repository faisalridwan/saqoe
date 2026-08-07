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

        $this->load->view('templates/user_header', $data);
        $this->load->view('user/index', ['event' => $event]);
        $this->load->view('templates/user_footer');
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
        } else {

            $data = [

                'username' => $this->session->userdata('username'),
                'namaPemasukan' => $this->input->post('namaPemasukan', true),
                'besarPemasukan' => $this->input->post('besarPemasukan', true),
                'tanggalPemasukan' => date('Y-m-d '),
                'jamPemasukan' => date('H:i:s'),
            ];

            $this->db->insert('harianpemasukan', $data);

            $saldo = $this->input->post('saldo', true);

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
        } else {

            $data = [

                'username' => $this->session->userdata('username'),
                'namaPengeluaran' => $this->input->post('namaPengeluaran', true),
                'besarPengeluaran' => $this->input->post('besarPengeluaran', true),
                'tanggalPengeluaran' => date('Y-m-d '),
                'jamPengeluaran' => date('H:i:s'),
            ];

            $this->db->insert('harianPengeluaran', $data);

            $saldo = $this->input->post('saldo', true);

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
            'budget' => 0,
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
        } else {

            $data = [

                'username' => $this->session->userdata('username'),
                'namaEvent' => $namaEvent,
                'namaPemasukanEvent' => $this->input->post('namaPemasukan', true),
                'budget' => $this->input->post('budget', true),
                'tanggalPemasukan' => date('Y-m-d '),
                'jamPemasukan' => date('H:i:s'),
            ];

            $this->db->insert('eventpemasukan', $data);

            $saldo = $this->input->post('budgetSekarang', true);

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
        } else {

            $data = [

                'username' => $this->session->userdata('username'),
                'namaEvent' => $namaEvent,
                'namaPengeluaranEvent' => $this->input->post('namaPengeluaran', true),
                'besarPengeluaran' => $this->input->post('budget', true),
                'kategoriPengeluaranEvent' => $this->input->post('kategori',true),
                'tglPengeluaranEvent' => date('Y-m-d'),
                'jamPengeluaran' => date('H:i:s'),
            ];

            $this->db->insert('eventpengeluaran', $data);

            $saldo = $this->input->post('budgetSekarang', true);

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
        }
    }
}
