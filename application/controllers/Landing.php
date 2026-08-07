<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Landing extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] = 'Saqoe - Manajemen Keuangan Cerdas';
		$data['is_logged_in'] = false;

		if ($this->session->userdata('username')) {
			$data['is_logged_in'] = true;
			$data['user'] = $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array();
		}

		$data['title'] = 'Saqoe - Manajemen Keuangan Cerdas';
		$this->load->view('landing', $data);
	}
}
