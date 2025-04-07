<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use OpenApi\Annotations as OA;

class Patient extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('PatientModel');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');

        if (!$this->session->userdata('logged_in')) {
            redirect('Auth/login'); // Redirect to login if not logged in
        }
    }

    //Display patient list
    public function index() {
        $status = 'active'; // Define the status
        $data['patients'] = $this->PatientModel->get_patient_by_status($status); // Call the model function
        //$this->load->view('patient/index', $data);
        // $data['patients'] = $this->PatientModel->get_all_patients();
        $this->load->view('patient/index', $data);
        // return $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function mrecord() {
        $data['patients'] = $this->PatientModel->get_all_patients();
        $this->load->view('patient/mrecord', $data);
        // $status = 'active'; // Define the status
        // $data['patients'] = $this->PatientModel->get_patient_by_status($status); // Call the model function
        // $this->load->view('patient/mrecord', $data);
    }

    //Add new patient with form validation
    public function add() {
        $this->form_validation->set_rules('firstname', 'First Name', 'required|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('middlename', 'Middle Name', 'required|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('sex', 'Sex', 'required');
        $this->form_validation->set_rules('birthdate', 'Birth Date', 'required'); // date format: YYYY-MM-DD
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[patients.email]');
        $this->form_validation->set_rules('phone', 'Phone', 'required|min_length[10]|max_length[20]');
    
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('patient/add'); // Reload form if validation fails
        } else {
            // Handle Image Upload
            // echo $_FILES['profile_image']['name'];
            // die();

            if (!empty($_FILES['profile_image']['name'])) {

                $this->load->library('upload');

                $config['upload_path']   = './uploads/'; // Folder to store images
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size']      = 2048; // Max size (2MB)
                $config['file_name']     = time() . '_' . $_FILES['profile_image']['name'];
    
                $this->upload->initialize($config);
    
                if ($this->upload->do_upload('profile_image')) {
                    $uploadData = $this->upload->data();
                    $image_path = 'uploads/' . $uploadData['file_name'];
                    // $image_path = $uploadData['file_name'];
                    // $image_path = 'uploads/' . $uploadData['file_name']; // Save relative path
                } else {
                    $image_path = NULL;
                    // $this->session->set_flashdata('error', $this->upload->display_errors());
                    // $this->load->view('patient/add');
                    // return; // Stop execution if upload fails
                }
            }
    
            // Insert Patient Data with Image
            $patient_data = [
                'firstname' => $this->input->post('firstname'),
                'middlename' => $this->input->post('middlename'),
                'lastname' => $this->input->post('lastname'),
                'sex' => $this->input->post('sex'),
                'birthdate' => $this->input->post('birthdate'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'profile_image' => $image_path, // Store image path in DB
                'created_at' => date('Y-m-d H:i:s'),
                'status' => 'active'
            ];
    
            if ($this->PatientModel->insert_patient($patient_data)) {
                $this->session->set_flashdata('success', 'Patient added successfully');
                redirect('patient/index');
            } else {
                $this->session->set_flashdata('error', 'Failed to add patient');
                $this->load->view('patient/add');
            }
        }
    }

    //Edit patient details
    public function edit($id) {
        $data['patient'] = $this->PatientModel->get_patient_by_id($id);

        if (!$data['patient']) {
            show404();
        }

        $this->form_validation->set_rules('firstname', 'First Name', 'required|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('middlename', 'Middle Name', 'required|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('sex', 'Sex', 'required');
        $this->form_validation->set_rules('birthdate', 'Birth Date', 'required'); //date format: YYYY-MM-DD
        $this->form_validation->set_rules('email', 'Email', 'required|min_length[3]|max_length[255]');
        // $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[patients.email]');
        $this->form_validation->set_rules('phone', 'Phone', 'required|min_length[10]|max_length[20]');
        

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('patient/edit', $data);
        } else {
            if (!empty($_FILES['profile_image']['name'])) {

                $this->load->library('upload');

                $config['upload_path']   = './uploads/'; // Folder to store images
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size']      = 2048; // Max size (2MB)
                $config['file_name']     = time() . '_' . $_FILES['profile_image']['name'];
    
                $this->upload->initialize($config);
    
                if ($this->upload->do_upload('profile_image')) {
                    $uploadData = $this->upload->data();
                    $image_path = 'uploads/' . $uploadData['file_name'];
                    // $image_path = $uploadData['file_name'];
                    // $image_path = 'uploads/' . $uploadData['file_name']; // Save relative path
                } else {
                    $image_path = NULL;
                    // $this->session->set_flashdata('error', $this->upload->display_errors());
                    // $this->load->view('patient/add');
                    // return; // Stop execution if upload fails
                    // $image_path = $patient['profile_image'];
                }
            } else {
                $image_path = $this->input->post('profile_image');
                // echo $image_path;
                // die();
            }

            $update_data = [
                'firstname' => $this->input->post('firstname'),
                'middlename' => $this->input->post('middlename'),
                'lastname' => $this->input->post('lastname'),
                'sex' => $this->input->post('sex'),
                'birthdate' => $this->input->post('birthdate'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'profile_image' => $image_path, // Store image path in DB
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            if ($this->PatientModel->update_patient($id, $update_data)) {
                $this->session->set_flashdata('success', 'Patient updated successfully');
                redirect('patient/index');
            } else {
                $this->session->set_flashdata('error', 'Failed to update patient');
                $this->load->view('patient/edit', $data);
            }
        }
    }

    //Delete patient
    public function delete($id) {
        if ($this->PatientModel->delete_patient($id)) {
            $this->session->set_flashdata('success', 'Patient deleted successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete patient');
        }

        redirect('patient/index');
    }

    //Soft delete patient
    public function soft_delete($id) {
        $data['patient'] = $this->PatientModel->get_patient_by_id($id);
        if ($data['patient']) {
            $update_data = [
                'deleted_at' => date('Y-m-d H:i:s'),
                'status' => 'inactive'
            ];

            $this->PatientModel->update_patient($id, $update_data);
            $this->session->set_flashdata('success', 'Patient soft deleted successfully');
        } else {
            $this->session->set_flashdata('error', 'Patient not found');
        }
        redirect('patient/index');
    }

    public function undo_soft_delete($id) {
        $data['patient'] = $this->PatientModel->get_patient_by_id($id);
        if ($data['patient']) {
            $update_data = [
                'deleted_at' => NULL,
                'status' => 'active'
            ];

            $this->PatientModel->update_patient($id, $update_data);
            $this->session->set_flashdata('success', 'Patient soft deleted successfully');
        } else {
            $this->session->set_flashdata('error', 'Patient not found');
        }
        redirect('patient/index');
    }

    // Upload file
    function upload_photo() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 100;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('upload_form', $error);
        } else {
            $data = array('upload_data' => $this->upload->data());
            $this->load->view('upload_success', $data);
        }
    }

    public function view_patient($id) {
        $data['patient'] = $this->PatientModel->get_patient_by_id($id);
    
        if (!$data['patient']) {
            echo "<p class='text-danger'>Patient not found.</p>";
            return;
        }
    
        $this->load->view('patient/view_patient', $data); // Load only view content
    }

    /**
     *  @OA\Get(
     *      path="/api/v1/patient",
     *      summary="Get all active patients",
     *      description="Returns a list of active patients",
     *      operationId="getAllPatients",
     *      tags={"Patient"},
     *      @OA\Response(
     *          response=200,
     *          description="A list of active patients",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                  type="object",
     *                  @OA\Property(property="id", type="integer", example=1),
     *                  @OA\Property(property="firstname", type="string", example="John"),
     *                  @OA\Property(property="middlename", type="string", example="Doe"),
     *                  @OA\Property(property="lastname", type="string", example="Smith"),
     *                  @OA\Property(property="email", type="string", example="john.doe@example.com"),
     *                  @OA\Property(property="phone", type="string", example="1234567890"),
     *                  @OA\Property(property="birthdate", type="string", format="date", example="1985-08-15")
     *              )
     *          )
     *      )
     *  )
     */
    public function getPatientByID($id) {

        $output = [];
        $data = $this->PatientModel->get_patient_by_id($id);

        $output = array (
            'firstname'=> $data['firstname'],
            'middlename'=> $data['middlename'],
            'lastname'=> $data['lastname'],
            'name'=> $data['firstname'] . ' ' . $data['middlename'] . ' ' . $data['lastname'],
            'birthday'=> date('F d, Y', strtotime($data['birthdate'])),
            // 'birthday'=> date('m/d/Y', strtotime($data['birthdate'])),
            'sex'=> ($data['sex'] == 'F' ? 'Female' : 'Male'),
            'email'=> $data['email'],
            'phone'=> $data['phone'],
            'photo'      => !empty($data['photo']) ? base_url($data['photo']) : base_url('uploads/default-profile.png'),
        );

        //$data['patient'] = $this->PatientModel->get_patient_by_id($id);
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($output));
    }

    public function getAllActivePatient() {
        $status = 'active'; // Define the status
        $data['patients'] = $this->PatientModel->get_patient_by_status($status); // Call the model function
        //$this->load->view('patient/index', $data);
        // $data['patients'] = $this->PatientModel->get_all_patients();
        // $this->load->view('patient/index', $data);
        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/patient/{id}",
     *     summary="Get patient by ID",
     *     description="Fetch a patient using their unique ID",
     *     operationId="getPatientById",
     *     tags={"Patient"},
     *     security={{"BasicAuth": {}}}, 
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Unique Patient ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response with patient details",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="firstname", type="string", example="John"),
     *             @OA\Property(property="middlename", type="string", example="Doe"),
     *             @OA\Property(property="lastname", type="string", example="Smith"),
     *             @OA\Property(property="email", type="string", format="email", example="john.doe@example.com"),
     *             @OA\Property(property="phone", type="string", example="1234567890"),
     *             @OA\Property(property="birthdate", type="string", format="date", example="1985-08-15")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Patient not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Patient not found.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized request",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Authentication Required.")
     *         )
     *     )
     * )
     */
    public function getPatientByIds($id) {
        if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
            header('HTTP/1.0 401 Unauthorized');
            echo json_encode(["error" => "Authentication Required."]);
            exit;
        }

        $patient = $this->PatientModel->get_by_id($id);
        if ($patient) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($patient));

        } else {
            header("HTTP/1.0 404 Not Found");
            echo json_encode(["error" => "Patient not found."]);
        }
    }
}

?>
