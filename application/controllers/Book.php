<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends CI_Controller {
   
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('books_model');
    }
    public function insert_book() {
        $config['upload_path']   = './uploads/'; 
        $config['allowed_types'] = 'pdf';
        $config['max_size']      = 1024; // 1 MB

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('pdf_file')) {
            $file_data = $this->upload->data();

            $data = array(
                'title' => $this->input->post('title'),
                'author' => $this->input->post('author'),
                'publication_date' => $this->input->post('publication_date'),
                'category' => $this->input->post('category'),
                'pdf_file' => $file_data['file_name'], 
                'user_id' => $this->input->post('user_id'), 
                'description' => $this->input->post('description'), 
                'status' => 1, 
               
            );

           
            $inserted = $this->books_model->insert_book($data);

            if ($inserted) {
                echo json_encode(array('status' => 'success', 'message' => 'Book added successfully'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Failed to add book'));
            }
        } else {
            echo json_encode(array('status' => 'error', 'message' => $this->upload->display_errors()));
        }
    }

    public function update_book() {
        $book_id = $this->input->post('edit_book_id');
            $title = $this->input->post('edit_title');
            $author = $this->input->post('edit_author');
            $description = $this->input->post('edit_description');
            $publication_date = $this->input->post('edit_date');
            $category_id = $this->input->post('edit_category');

            // Check if a new PDF file is uploaded
            if (!empty($_FILES['edit_pdff']['name'])) {
                // Handle file upload for the new PDF file
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = 1024; // 1 MB limit

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('edit_pdff')) {
                    $data = $this->upload->data();
                    $pdf_file = $data['file_name'];

                    // Update the 'pdf_file' field in the database
                    $data['pdf_file'] = $pdf_file;
                } else {
                    // Handle file upload error
                    $upload_error = $this->upload->display_errors();
                    
                }
            }

            // Update book in the database
            $data = array(
                'title' => $title,
                'author' => $author,
                'description' => $description,
                'publication_date' => $publication_date,
                'category' => $category_id,
                // 'pdf_file' =>  $pdf_file['file_name'], 
                'user_id' =>$this->session->userdata('user_id'),
               
            );

            if (isset($pdf_file)) {
                $data['pdf_file'] = $pdf_file;
            }

            $this->books_model->update_book($book_id, $data);

            // Redirect to the book list or another appropriate page
            redirect('Auth/dashboard');
        }
    
    

    public function fetch_categories() {
        

        // Fetch categories from the database
        $categories = $this->books_model->get_all_categories();

        // Send the categories as JSON response
        $this->output->set_content_type('application/json')->set_output(json_encode($categories));
    }

    public function delete_book($book_id) {
        // Call the model method to change the status to 0
        $this->books_model->change_book_status($book_id, 0);

        // Redirect to the book list or another appropriate page
        redirect('dashboard');
    }

    public function category(){
        if (!$this->session->userdata('user_id')) {
            // If not logged in, redirect to the login page
            redirect('login');
        }
        $user_id = $this->session->userdata('user_id');
        $data['cat'] = $this->books_model->get_all_categories_list();
        // Load the view and pass the data
         $this->load->view('category_list', $data);
    }

    public function insert_category(){
        $data = array(
            'category_name' => $this->input->post('category_name'),
            'status' => 1, 
           
        );

       
        $inserted = $this->books_model->insert_category($data);

        if ($inserted) {
            echo json_encode(array('status' => 'success', 'message' => 'Category added successfully'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Failed to add category'));
        }
   
    }


    public function edit_category(){
        $cat_id = $this->input->post('edit_category_id');
        $category_name = $this->input->post('edit_category_name');

        $data = array(
            'category_name' => $category_name,
           
        );
        $this->books_model->update_category($cat_id, $data);

        redirect('category');

    }

    public function delete_category($category_id){
       
        $this->books_model->change_category_status($category_id, 0);
    redirect('category');

    }
    public function all_books(){
        if (!$this->session->userdata('user_id')) {
            // If not logged in, redirect to the login page
            redirect('login');
        }
        $user_id = $this->session->userdata('user_id');
        $data['books'] = $this->books_model->get_books();
        $data['categories'] = $this->books_model->get_all_categories();
        $selected_category = $this->input->get('category');
        if ($selected_category) {
            $data['books'] = $this->books_model->get_books_by_category($selected_category);
        }
        // Load the view and pass the data
         $this->load->view('all_books', $data);
    }

}



