<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Auth_model');
        $this->load->database();
    }
    public function index()
    {
        $data = [
            'title' => 'Halaman Login'
        ];

        $this->form_validation->set_rules('uname', 'Username', 'required', [
            'required' => '{field} harus diisi'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required', [
            'required' => '{field} harus diisi'
        ]);
        
        if( $this->form_validation->run() == FALSE) {
            $this->load->view('header', $data);
            $this->load->view('auth/login');
            $this->load->view('footer');
        } else {
            $this->Auth_model->login();
        }
        
    }


    public function registration()
    {
        $data = [
            'title' => 'Halaman Registrasi'
        ];

        $this->form_validation->set_rules('uname', 'Username', 'required|is_unique[users.user_id]|alpha_dash|max_length[50]', [
            'is_unique' => '{field} sudah digunakan', 
            'required' => '{field} harus diisi',
            'alpha_dash' => '{field} harus berupa alfanumerik, underscore, dan dash' ,
            'max_length' => '{field} terlalu panjang'
        ]);
        $this->form_validation->set_rules('name', 'Nama Lengkap', 'required|max_length[100]', [
            'required' => '{field} harus diisi',
            'max_length' => '{field} terlalu panjang'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|matches[password2]|min_length[8]|max_length[72]', [
            'required' => '{field} harus diisi', 
            'matches' => '{field} tidak sama',
            'min_length' => '{field} terlalu pendek',
            'max_length' => '{field} terlalu panjang'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|matches[password]', [
            'required' => '{field} harus diisi',
            'matches' => '{field} tidak sama'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[254]', [
            'required' => '{field} harus diisi',
            'valid_email' => '{field} harus valid',
            'max_length' => '{field} terlalu panjang'
        ]);
        $this->form_validation->set_rules('phone', 'Nomor Telepon', 'required|max_length[20]', [
            'required' => '{field} harus diisi',
            'max_length' => '{field} terlalu panjang'
        ]);

        if( $this->form_validation->run() == FALSE) {
            $this->load->view('header', $data);
            $this->load->view('auth/registration');
            $this->load->view('footer');
        } else {
            $this->Auth_model->addUserData();
            $session_data = [
                'auth_msg' => '<div class="alert alert-success" role="alert">Akun berhasil dibuat! Silahkan login</div>'
            ];
            $this->session->set_userdata($session_data);
            redirect(base_url('auth'));
        }
    }

    public function forget()
    {
        $data = [
            'title' => 'Lupa Password'
        ];
        
        $this->load->view('header', $data);
        $this->load->view('auth/forget');
        $this->load->view('footer');


    }
}

?>