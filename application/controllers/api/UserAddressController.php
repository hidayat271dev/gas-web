<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class UserAddressController extends RestController
{

	function __construct()
	{
		// Construct the parent class
		parent::__construct();
		$this->load->model('api/UserAddressModel', 'UserAddressModel');
	}

	public function index_post()
	{
		$token = $this->input->get_request_header('Authorization');
		$token = explode(" ", $token);
		$token = $token[1];

		$dataSave = $this->input->post();

		$response = $this->UserAddressModel->createData($dataSave, $token);

		$this->response($response["response"], $response["code"]);
	}

	public function index_get()
	{
		$token = $this->input->get_request_header('Authorization');
		$token = explode(" ", $token);
		$token = $token[1];
		$response = $this->UserAddressModel->getAllData($token);
		return $this->response($response["response"], $response["code"]);
	}

	public function detail_get($id)
	{
		$response = $this->UserAddressModel->getDataById($id);
		return $this->response($response["response"], $response["code"]);
	}

	public function update_post($id)
	{
		$token = $this->input->get_request_header('Authorization');
		$token = explode(" ", $token);
		$token = $token[1];

		$dataSave = $this->input->post();

		$response = $this->UserAddressModel->updateData($id, $dataSave, $token);

		$this->response($response["response"], $response["code"]);
	}

	public function deletesoft_delete($id)
	{
		$response = $this->UserAddressModel->deteleSoftData($id);

		$this->response($response["response"], $response["code"]);
	}

	public function deletehard_delete($id)
	{
		$response = $this->UserAddressModel->deteleHardData($id);

		$this->response($response["response"], $response["code"]);
	}
}
