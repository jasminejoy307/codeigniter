<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('books_model');
    }
   

    public function index() {
        $this->form_validation->set_rules('name', 'Full Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('registration_form');
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
            );

            $this->user_model->register_user($data);
            redirect('login');
        }
    }

    public function login() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
    
        $this->form_validation->set_message('required', '{field} is required');
        $this->form_validation->set_message('valid_email', 'Please enter a valid {field}');
    
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login_form');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
    
            $user = $this->user_model->get_user_by_email($email);
    
            if ($user && $password === $user['password']) {
                // Login successful, set session or redirect as needed
                $this->session->set_userdata('user_id', $user['id']);
                // echo $this->session->userdata('user_id'); 
                redirect('dashboard'); // Change to your dashboard page
               // echo 'success';
            } else {
                // Login failed, display error
                $data['error'] = 'Invalid email or password';
                $this->load->view('login_form', $data);
            }
        }
    }
    public function dashboard(){
        if (!$this->session->userdata('user_id')) {
            // If not logged in, redirect to the login page
            redirect('login');
        }
        $user_id = $this->session->userdata('user_id');
        $data['books'] = $this->books_model->get_books_by_user_id($user_id);
        $data['categories'] = $this->books_model->get_all_categories();
        // Load the view and pass the data
         $this->load->view('dashboard', $data);
        
    }
   
    
}
