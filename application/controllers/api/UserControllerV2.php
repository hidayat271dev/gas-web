<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class UserControllerV2 extends RestController
{

	function __construct()
	{
		// Construct the parent class
		parent::__construct();
		$this->load->model('api/UserModelV2', 'UserModel');
	}

	public function index_get()
	{

		$pagination = $this->input->get('pagination', TRUE);
		$query = $this->input->get('query', TRUE);
		$sort = $this->input->get('sort', TRUE);

		$response = $this->UserModel->getData($pagination, $query, $sort);
		return $this->response($response["response"], $response["code"]);

	}

}
