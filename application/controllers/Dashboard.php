<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('PatientModel');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
        
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('Auth/login'); // Redirect to login if not logged in
        }
    }

    public function index() {
        $this->load->view('dashboard/index'); // Load your dashboard view
    }
}
?>