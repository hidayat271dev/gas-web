<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class UserController extends RestController {

	function __construct()
	{
		// Construct the parent class
		parent::__construct();
		$this->load->model('api/UserModel', 'UserModel');
	}

	public function index_post()
	{
		$dataSave = $this->input->post();

		// TODO: Create validation
		$this->UserModel->getValidationCreate();
		$response = $this->UserModel->createData($dataSave);

		$this->response( $response["response"], $response["code"] );
	}

	public function index_get()
	{
		// Users from a data store e.g. database
		$response = $this->UserModel->getAllData();
		return $this->response( $response["response"], $response["code"] );
	}

	public function detail_get($id) {
		$response = $this->UserModel->getDataById($id);
		return $this->response( $response["response"], $response["code"] );
	}

	public function update_post($id)
	{
		$dataSave = $this->input->post();

		// TODO: Create validation
		$response = $this->UserModel->updateData($id, $dataSave);

		$this->response( $response["response"], $response["code"] );
	}
}
