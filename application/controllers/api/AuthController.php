<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class AuthController extends RestController
{

	function __construct()
	{
		// Construct the parent class
		parent::__construct();
		$this->load->model('api/AuthModel', 'AuthModel');
	}

	public function index_post()
	{
		$dataRequest = $this->input->post();

		$this->AuthModel->getValidationLogin();
		$response = $this->AuthModel->loginApp($dataRequest);

		$this->response($response["response"], $response["code"]);
	}

	public function register_post()
	{
		$dataRequest = $this->input->post();

		$response = $this->AuthModel->createRegisterUser($dataRequest);

		$this->response($response["response"], $response["code"]);
	}

	public function forgot_post()
	{
		$dataRequest = $this->input->post();

		$response = $this->AuthModel->createForgotUser($dataRequest);

		$this->response($response["response"], $response["code"]);
	}
}
