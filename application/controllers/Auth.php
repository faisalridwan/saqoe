<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Auth');
		$this->load->library('form_validation');
	}

	public function index()
	{
		//agar tidak bisa ke halaman login
		if ($this->session->userdata('username')) {
			redirect('user');
		}

		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == false) {

			$data['title'] = 'Login - SAQOE';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		} else {
			$this->_login();
		}
	}

	private function _login()
	{
		$username = trim($this->input->post('username', true));
		$password = $this->input->post('password');

		$user = $this->db->get_where('pengguna', ['username' => $username])->row_array();

		if ($user) {
			if (password_verify($password, $user['password'])) {
				$data = [
					'username' => $user['username'],
					'name' => $user['name']
				];
				$this->session->set_userdata($data);
				redirect('user');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				Wrong password !</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Username is not registred !</div>');
			redirect('auth');
		}
	}


	public function registration()
	{
		//agar tidak bisa ke halaman registration
		if ($this->session->userdata('username')) {
			redirect('user');
		}

		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[pengguna.username]', [
			'is_unique' => 'This Username is already registered !'
		]);
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[pengguna.email]', [
			'is_unique' => 'This Email is already registered !'
		]); //|is_unique[pengguna.email]
		$this->form_validation->set_rules('phoneNumber', 'Phone Number', 'required|trim');
		$this->form_validation->set_rules('address', 'Address', 'required|trim');
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[5]|matches[password2]', [
			'matches' => 'Password dont Match !',
			'min_length' => 'Password too short must > 5!',
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Registration - SAQOE';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/registration');
			$this->load->view('templates/auth_footer');
		} else {

			$this->M_Auth->InsertPengguna();
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Congratulation! your account has been created. Please Login</div>');
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			You have been logged out ! </div>');
		redirect('auth');
	}
}
