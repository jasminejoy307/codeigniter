<?php
class User_model extends CI_Model {

    public function register_user($data) {
        $this->db->insert('users', $data);
    }
   
    public function get_user_by_email($email) {
        $this->db->select('id, email,password');  
        $query = $this->db->get_where('users', array('email' => $email));
        return $query->row_array();
    }
    
}
