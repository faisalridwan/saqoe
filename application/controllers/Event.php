<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Kelola Event';
        $data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
        
        $this->db->where('username', $this->session->userdata('username'));
        $data['event'] = $this->db->get('event')->result_array();

        $this->load->view('templates/user_header', $data);
        $this->load->view('user/event', $data);
        $this->load->view('templates/user_content', $data);
    }

    public function tambah()
    {
        $this->form_validation->set_rules('namaEvent', 'Nama Event', 'required|trim');
        
        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $data = [
                'username' => $this->session->userdata('username'),
                'namaEvent' => $this->input->post('namaEvent', true),
                'budget' => preg_replace('/[^0-9]/', '', $this->input->post('budget', true))
            ];

            $this->db->insert('event', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Event baru berhasil ditambahkan!</div>');
            redirect('event');
        }
    }

    public function edit()
    {
        $namaEventLama = $this->input->post('namaEventLama');
        $namaEventBaru = $this->input->post('namaEvent', true);
        $budget = preg_replace('/[^0-9]/', '', $this->input->post('budget', true));
        
        $data = [
            'namaEvent' => $namaEventBaru,
            'budget' => $budget
        ];

        // Ensure we update the event name in child tables as well
        if ($namaEventLama !== $namaEventBaru) {
            // Update eventhistori
            $this->db->where('namaEvent', $namaEventLama);
            $this->db->where('username', $this->session->userdata('username'));
            $this->db->update('eventhistori', ['namaEvent' => $namaEventBaru]);

            // Update eventpemasukan
            $this->db->where('namaEvent', $namaEventLama);
            $this->db->where('username', $this->session->userdata('username'));
            $this->db->update('eventpemasukan', ['namaEvent' => $namaEventBaru]);

            // Update eventpengeluaran
            $this->db->where('namaEvent', $namaEventLama);
            $this->db->where('username', $this->session->userdata('username'));
            $this->db->update('eventpengeluaran', ['namaEvent' => $namaEventBaru]);
        }

        $this->db->where('namaEvent', $namaEventLama);
        $this->db->where('username', $this->session->userdata('username'));
        $this->db->update('event', $data);
        
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Event berhasil diupdate!</div>');
        redirect('event');
    }

    public function hapus($namaEvent)
    {
        // Decode URI component since it might have spaces
        $namaEvent = urldecode($namaEvent);
        
        $this->db->where('namaEvent', $namaEvent);
        $this->db->where('username', $this->session->userdata('username'));
        $this->db->delete('event');

        // Also delete history related to this event
        $this->db->where('namaEvent', $namaEvent);
        $this->db->where('username', $this->session->userdata('username'));
        $this->db->delete('eventhistori');
        
        $this->db->where('namaEvent', $namaEvent);
        $this->db->where('username', $this->session->userdata('username'));
        $this->db->delete('eventpemasukan');
        
        $this->db->where('namaEvent', $namaEvent);
        $this->db->where('username', $this->session->userdata('username'));
        $this->db->delete('eventpengeluaran');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Event beserta historinya berhasil dihapus!</div>');
        redirect('event');
    }
}
