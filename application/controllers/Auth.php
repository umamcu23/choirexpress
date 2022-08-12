<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Choir Express | Login';
        $data['user'] = $this->db->get_where('tb_user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header_login', $data);
        $this->load->view('login', $data);
        $this->load->view('templates/footer_login');
    }

    public function login()
    {
        if ($this->session->userdata('email')) {
            redirect('order');
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'valid_email' => '<label class="text-danger mt-2">Format Email Salah!</label>',
            'required' => '<label class="text-danger mt-2">Email Wajib Diisi!</label>',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => '<label class="text-danger mt-2">Kata Sandi Wajib Diisi!</label>',
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Choir Express | Login';
            $this->load->view('templates/header_login', $data);
            $this->load->view('login', $data);
            $this->load->view('templates/footer_login');
        } else {
            $this->_login();
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('idRole');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kamu Berhasil Keluar!</div>');
        redirect('auth/login');
    }

    public function blocked()
    {
        $data['title'] = 'Umay Store - Access Blocked';
        $data['titleMenu'] = 'Profil Ku';

        $data['user'] = $this->db->get_where('tb_user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('blocked', $data);
        $this->load->view('templates/footer');
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('tb_user', [
            'email' => $email
        ])->row_array();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'email' => $user['email'],
                    'akses' => $user['akses'],
                    'id_user' => $user['id'],
                ];
                $this->session->set_userdata($data);
                if ($user['akses'] == 'admin') {
                    redirect('order');
                } else if ($user['akses'] == 'user') {
                    redirect('order');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email atau Kata Sandi Anda Salah!</div>');
                redirect('auth/login');
            }
        } else {
            // jika user tidak ada
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email Belum Terdaftar !</div>');
            redirect('auth/login');
        }
    }
}
