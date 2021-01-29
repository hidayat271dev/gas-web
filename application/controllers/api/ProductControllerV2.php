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
		// $pagination['page'] --> current page
		// $pagination['pages'] --> total page
		// $pagination['perpage'] --> show data per page
		// $pagination['total'] --> total data
		$query = $this->input->get('query', TRUE);
		// $query['generalSearch']
		// $query['Status']
		// $query['Type']
		$sort = $this->input->get('sort', TRUE);
		// $sort['field']
		// $sort['sort']

		$response = $this->ProductModel->getData($pagination, $query, $sort);
		return $this->response($response["response"], $response["code"]);

	}

}
