<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class OrderController extends RestController
{

	function __construct()
	{
		// Construct the parent class
		parent::__construct();
		$this->load->model('api/OrderModel', 'OrderModel');
	}

	public function index_post()
	{
		$token = $this->input->get_request_header('Authorization');
		$token = explode(" ", $token);
		$token = $token[1];

		$request = $this->input->post();

		// TODO: Create validation
		$response = $this->OrderModel->createData($token, $request);

		$this->response($response["response"], $response["code"]);
	}

	public function index_get()
	{
		$token = $this->input->get_request_header('Authorization');
		$token = explode(" ", $token);
		$token = $token[1];
		$response = $this->OrderModel->getAllData($token);
		return $this->response($response["response"], $response["code"]);
	}

	public function detail_get($id)
	{
		$response = $this->OrderModel->getDataById($id);
		return $this->response($response["response"], $response["code"]);
	}

	public function update_post($id)
	{
		$dataSave = $this->input->post();

		$response = $this->OrderModel->updateData($id, $dataSave);

		$this->response($response["response"], $response["code"]);
	}

	public function deletesoft_delete($id)
	{
		$response = $this->OrderModel->deteleSoftData($id);

		$this->response($response["response"], $response["code"]);
	}

	public function deletehard_delete($id)
	{
		$response = $this->OrderModel->deteleHardData($id);

		$this->response($response["response"], $response["code"]);
	}

}
