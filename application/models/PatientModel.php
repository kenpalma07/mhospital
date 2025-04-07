<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PatientModel extends CI_Model {

    private $table = 'patients';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Insert a new patient
    public function insert_patient($data) {
        return $this->db->insert($this->table, $data);
    }

    //Get patient by list
    public function get_patient_list() {
        $this->db->select("id, name, phone, email, created_at, updated_at");
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    //Get patient list all
    public function get_patient_list_all() {
        $this->db->select("id, name, phone, email, created_at, updated_at");
        $this->db->from($this->table);

        
        return $this->db->get()->result_array();
    }

    //Get all patients
    public function get_all_patients() {
        return $this->db->get($this->table)->result_array();
    }

    public function get_patient_by_status($status) {
        return $this->db->get_where($this->table, ['status' => $status])->result_array();
    }

    //Get patient by id
    public function get_patient_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    //Update patient details
    public function update_patient($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    //Delete patient (soft delete can be implemented if needed)
    public function delete_patient($id) {
        return $this->db->delete($this->table, ['id' => $id]);
    }

    // Get active patients
    public function get_patient_list_active() {
        $this->db->select("id, name, phone, email, created_at, updated_at");
        $this->db->from($this->table);
        $this->db->where('status', 'active');
        
        return $this->db->get()->result_array();
    }
}
?>
