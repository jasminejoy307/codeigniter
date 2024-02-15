<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Books_model extends CI_Model {

    public function insert_book($data) {
        return $this->db->insert('books', $data);
    }
    public function get_books_by_user_id($user_id) {
        $this->db->select('books.*, category.category_name,category_id');
        $this->db->from('books');
        $this->db->join('category', 'books.category = category.category_id', 'left');
        $this->db->where('user_id', $user_id);
        $this->db->where('books.status', 1);
        $query = $this->db->get();
    
        return $query->result_array();
    }
    public function update_book($book_id, $data) {
        $this->db->where('book_id', $book_id);
        $this->db->update('books', $data);
    }
    public function get_all_categories() {
        
        $query = $this->db->get('category');
        return $query->result_array();
    }
    public function change_book_status($book_id, $status) {
        $data = array('status' => $status);
        $this->db->where('book_id', $book_id);
        $this->db->update('books', $data);
    }

    public function insert_category($data){
        return $this->db->insert('category', $data);
    }

    public function update_category($cat_id, $data){

        $this->db->where('category_id', $cat_id);
        $this->db->update('category', $data);

    }

    public function change_category_status($category_id){
        $data = array('status' => $status);
        $this->db->where('category_id', $category_id);
        $this->db->update('category', $data); 

    }
    public function get_all_categories_list() {
        
         $this->db->select('*');
         $this->db->from('category');
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->result_array(); 
    }
    public function get_books(){
        $this->db->select('books.*, category.category_name,category_id');
        $this->db->from('books');
        $this->db->join('category', 'books.category = category.category_id', 'left');
        $this->db->where('books.status', 1);
        $query = $this->db->get();
    
        return $query->result_array();
    }
    public function get_books_by_category($category_id) {
        $this->db->select('books.*, category.category_name, category.category_id');
        $this->db->from('books');
        $this->db->join('category', 'books.category = category.category_id', 'left');
        $this->db->where('books.status', 1);
        $this->db->where('books.category', $category_id);
        $query = $this->db->get();
    
        return $query->result_array();
    }
    
   
}