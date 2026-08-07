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
		// Jika user sudah login, langsung arahkan ke Dashboard
		if ($this->session->userdata('username')) {
			redirect('user');
		}

		$data['title'] = 'Saqoe - Manajemen Keuangan Cerdas';
		$this->load->view('landing', $data);
	}
}
