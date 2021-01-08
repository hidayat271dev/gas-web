<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends MY_Model {

	private $_table_name = "users";

	public function createData($data = NULL) {
		if ($data) {

			$data['uuid'] = $this->generateUUID();
			$data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
			$data['created_at'] = $this->getCurrentDateTime();
			$data['updated_at'] = $this->getCurrentDateTime();

			if ($this->form_validation->run() == TRUE) {
				$result = $this->db->insert($this->_table_name, $data);

				$code = 201;
				$message = "Success create new user";
				$data = $data;
				$error = NULL;
				return $this->generateResponse($message, $data, $error, $code);
			} else {
				$code = 500;
				$message = "Failed create new user";
				$data = NULL;
				$error["title"] = "Cannot Create User";
				$error["message"] = validation_errors();
				return $this->generateResponse($message, $data, $error, $code);
			}

		} else {
			$code = 500;
			$message = "Failed create new user";
			$data = NULL;
			$error["title"] = "Cannot Create User";
			$error["message"] = "Please double check the data to be stored, because the system has detected an empty data";
			return $this->generateResponse($message, $data, $error, $code);
		}
	}

	public function getAllData()
	{
		$this->db->where("deleted_at", NULL);
		$data = $this->db->get($this->_table_name)->result();

		$code = 200;
		$message = "Success get list user";
		$data = $data;
		$error = NULL;
		return $this->generateResponse($message, $data, $error, $code);
	}

	public function getDataById($id)
	{
		$this->db->where("uuid", $id);
		$data = $this->db->get($this->_table_name)->row();

		$code = 200;
		$message = "Success get detail user";
		$data = $data;
		$error = NULL;
		return $this->generateResponse($message, $data, $error, $code);
	}

	public function getValidationCreate() {
		$this->form_validation->set_rules(
                'username', 'Username',
                'is_unique[users.username]',
                array(
                        'is_unique'     => 'This %s already exists.'
                )
        );

        $this->form_validation->set_rules(
				'email', 'Email',
				'is_unique[users.email]',
				array(
						'is_unique'     => 'This %s already exists.'
				)
		);
	}
}
