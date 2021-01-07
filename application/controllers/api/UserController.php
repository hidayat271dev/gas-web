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
		$users = [
			['id' => $this->UserModel->getAllData(), 'name' => 'John', 'email' => 'john@example.com'],
			['id' => $this->UserModel->getAllData(), 'name' => 'Jim', 'email' => 'jim@example.com'],
		];

		$id = $this->get( 'id' );

		if ( $id === null )
		{
			// Check if the users data store contains users
			if ( $users )
			{
				// Set the response and exit
				$this->response( $users, 200 );
			}
			else
			{
				// Set the response and exit
				$this->response( [
					'status' => false,
					'message' => 'No users were found'
				], 404 );
			}
		}
		else
		{
			if ( array_key_exists( $id, $users ) )
			{
				$this->response( $users[$id], 200 );
			}
			else
			{
				$this->response( [
					'status' => false,
					'message' => 'No such user found'
				], 404 );
			}
		}
	}
}
