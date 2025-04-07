<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use OpenApi\Annotations as OA;

class MedicalRecord extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('PatientModel');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
    }

    /**
     *  @OA\Get(
     *      path="/api/v1/medicalRecords",
     *      summary="Get all active patients",
     *      description="Returns a list of active patients",
     *      operationId="getAllMedicalRecords",
     *      tags={"MedicalRecord"},
     *      @OA\Response(
     *          response=200,
     *          description="A list of Medical Records",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                  type="object",
     *                  @OA\Property(property="id", type="integer", example=1),
     *                  @OA\Property(property="firstname", type="string", example="John"),
     *                  @OA\Property(property="middlename", type="string", example="Doe"),
     *                  @OA\Property(property="lastname", type="string", example="Smith"),
     *                  @OA\Property(property="email", type="string", example="john.doe@example.com"),
     *                  @OA\Property(property="birthdate", type="string", example="1990-08-15")
     *              )
     *          )
     *      )
     *  )
     */
    public function getMedicalRecord() {
        $patients = $this->PatientModel->get_all_patients();
        return $this->output->set_content_type('application/json')->set_output(json_encode($patients));
    }
}
?>
