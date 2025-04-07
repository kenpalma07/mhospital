<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->library(['session', 'form_validation']); 
        $this->load->helper(['form', 'url']); 
    }

    public function login() {
        //$data['users'] = $this->UserModel->get_user_list();
        $data['error'] = $this->session->flashdata('error');
        $data['success'] = $this->session->flashdata('success');
        $this->load->view('user/login', $data);
    }

    public function do_login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->UserModel->get_user_by_username($username);

        if ($user && password_verify($password, $user['password'])) {
            // Store session data
            $this->session->sess_regenerate();

            $session_data = [
                'user_id'   => $user['id'],
                'username'  => $user['username'],
                'email'     => $user['email'],
                'firstname' => $user['firstname'],
                'lastname'  => $user['lastname'],
                'logged_in' => TRUE
            ];
            $this->session->set_userdata($session_data);

            log_message('info', 'User ' . $user['username'] . ' logged in successfully.');

            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error', 'Invalid username or password');
            redirect('Auth/login');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }

    public function register() {
        // Form Validation Rules
        $this->form_validation->set_rules('firstname', 'First Name', 'required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[50]');

        if ($this->form_validation->run() == FALSE) {
            // Load registration page with errors
            $this->load->view('user/register', ['errors' => validation_errors()]);
        } else {
            // Insert data into database
            $data = [
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'created_at'=> date('Y-m-d H:i:s'),
                'status' => 'active',
            ];

            if ($this->UserModel->insert_user($data)) {
                $this->session->set_flashdata('success', 'User registered successfully!');
                redirect('Auth/login');
            } else {
                $this->session->set_flashdata('error', 'An error occurred while registering');
                $this->load->view('user/register');
            }
        }
    }
}
?>