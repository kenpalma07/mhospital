<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {
    private $table = 'users';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Insert a new user
    public function insert_user($data) {
        return $this->db->insert($this->table, $data);
    }

    //Get all user by list
    public function get_user_list() {
        return $this->db->get($this->table)->result_array();
    }

    //Get user by id
    public function get_user_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get($this->table)->row_array();
    }

    public function get_user_by_username($username) {
        $query = $this->db->get_where('users', ['username' => $username]);

        if ($query->num_rows() > 0) {
            return $query->row_array(); // Return user data as an associative array
        } else {
            return null; // User not found
        }
    }
}


?>