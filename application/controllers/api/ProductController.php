<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class ProductController extends RestController {

	function __construct()
	{
		// Construct the parent class
		parent::__construct();
		$this->load->model('api/ProductModel', 'ProductModel');
	}

	public function index_post()
	{
		$dataSave = $this->input->post();

		// TODO: Create validation
		$response = $this->ProductModel->createData($dataSave);

		$this->response( $response["response"], $response["code"] );
	}

	public function index_get()
	{
		// Users from a data store e.g. database
		$response = $this->ProductModel->getAllData();
		return $this->response( $response["response"], $response["code"] );
	}

	public function detail_get($id) {
		$response = $this->ProductModel->getDataById($id);
		return $this->response( $response["response"], $response["code"] );
	}

	public function update_post($id)
	{
		$dataSave = $this->input->post();

		$response = $this->ProductModel->updateData($id, $dataSave);

		$this->response( $response["response"], $response["code"] );
	}

	public function deletesoft_delete($id)
	{
		$response = $this->ProductModel->deteleSoftData($id);

		$this->response( $response["response"], $response["code"] );
	}

	public function deletehard_delete($id)
	{
		$response = $this->ProductModel->deteleHardData($id);

		$this->response( $response["response"], $response["code"] );
	}

}
