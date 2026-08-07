<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_auth extends CI_Model
{

    public function InsertPengguna()
    {
        $data = [
            'username' => htmlspecialchars($this->input->post('username', true)),
            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'name' => htmlspecialchars($this->input->post('name', true)),
            'phoneNumber' => htmlspecialchars($this->input->post('phoneNumber', true)),
            'address' => htmlspecialchars($this->input->post('address', true)),
            'saldo' => '0',
            'email' => htmlspecialchars($this->input->post('email', true)),
            'image' => 'default.jpg',
            'datecreated' => time(),
        ];

        $this->db->insert('pengguna', $data);
    }
}
