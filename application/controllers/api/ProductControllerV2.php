<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class ProductControllerV2 extends RestController
{

	function __construct()
	{
		// Construct the parent class
		parent::__construct();
		$this->load->model('api/ProductModelV2', 'ProductModel');
	}

	public function index_get()
	{

		$pagination = $this->input->get('pagination', TRUE);
		$query = $this->input->get('query', TRUE);
		$sort = $this->input->get('sort', TRUE);

		$response = $this->ProductModel->getData($pagination, $query, $sort);
		return $this->response($response["response"], $response["code"]);

	}

	public function uploadCoverProduct_post()
	{
		$config['upload_path']          = './assets/uploads/products';
		$config['allowed_types'] 		= 'jpg|jpeg|png|gif';
		$config['max_size']             = 1000000000000;

		$this->load->library('upload', $config);

		if ( !$this->upload->do_upload('files'))
		{
			return $this->response($this->upload->display_errors(), 500);
		}
		else
		{
			return $this->response($this->upload->data(), 200);
		}
	}

}
