<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends MY_Model {

	private $_tableName = "users";

	public function createData($data = NULL) {
		if ($data) {

			$data['uuid'] = $this->generateUUID();
			$data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
			$data['created_at'] = $this->getCurrentDateTime();
			$data['updated_at'] = $this->getCurrentDateTime();

			if ($this->form_validation->run() == TRUE) {
				$result = $this->db->insert($this->_tableName, $data);

				$code = 201;
				$message = "Success create new user";
				$dataResponse = $data;
				$error = NULL;
				return $this->generateResponse($message, $dataResponse, $error, $code);
			} else {
				$code = 500;
				$message = "Failed create new user";
				$dataResponse = NULL;
				$error["title"] = "Cannot Create User";
				$error["message"] = validation_errors();
				return $this->generateResponse($message, $dataResponse, $error, $code);
			}

		} else {
			$code = 500;
			$message = "Failed create new user";
			$dataResponse = NULL;
			$error["title"] = "Cannot Create User";
			$error["message"] = "Please double check the data to be stored, because the system has detected an empty data";
			return $this->generateResponse($message, $dataResponse, $error, $code);
		}
	}

	public function getAllData()
	{
		$this->db->where("deleted_at", NULL);
		$data = $this->db->get($this->_tableName)->result();

		$code = 200;
		$message = "Success get list user";
		$dataResponse = $data;
		$error = NULL;
		return $this->generateResponse($message, $dataResponse, $error, $code);
	}

	public function getDataById($id)
	{
		$this->db->where("uuid", $id);
		$data = $this->db->get($this->_tableName)->row();

		$code = 200;
		$message = "Success get detail user";
		$dataResponse = $data;
		$error = NULL;
		return $this->generateResponse($message, $dataResponse, $error, $code);
	}
	
	public function updateData($id, $dataSave) {
		$this->db->where("uuid", $id);
		$currentData = $this->db->get($this->_tableName)->row();

		$dataSave['updated_at'] = $this->getCurrentDateTime();

		if ($currentData->username == $dataSave['username'] && $currentData->email == $dataSave['email']) {

			$this->db->where('id', $currentData->id);
            $this->db->update($this->_tableName, $dataSave);

			$code = 201;
			$message = "Success update data user";
			$dataResponse = $dataSave;
			$error = NULL;
			return $this->generateResponse($message, $dataResponse, $error, $code);

		} else {
			if ($currentData->username != $dataSave['username']) {
				$this->getValidationCreateUsername();
			} elseif ($currentData->email == $dataSave['email']) {
				$this->getValidationCreateEmail();
			}

			if ($this->form_validation->run() == TRUE) {

				$this->db->where('id', $currentData->id);
				$this->db->update($this->_tableName, $dataSave);

				$code = 201;
				$message = "Success update data user";
				$dataResponse = $currentData;
				$error = NULL;
				return $this->generateResponse($message, $dataResponse, $error, $code);
			} else {
				$code = 500;
				$message = "Failed create new user";
				$dataResponse = NULL;
				$error["title"] = "Cannot Create User";
				$error["message"] = validation_errors();
				return $this->generateResponse($message, $dataResponse, $error, $code);
			}
		}
	}

	public function deteleSoftData($id) {
		$this->db->where("uuid", $id);
		$currentData = $this->db->get($this->_tableName)->row();

		$dataSave = array();
		$dataSave['deleted_at'] = $this->getCurrentDateTime();

		$this->db->where('id', $currentData->id);
		$this->db->update($this->_tableName, $dataSave);

		$code = 200;
		$message = "Success delete data user";
		$dataResponse = $currentData;
		$error = NULL;
		return $this->generateResponse($message, $dataResponse, $error, $code);
	}

	public function deteleHardData($id) {
		$this->db->where("uuid", $id);
		$currentData = $this->db->get($this->_tableName)->row();

		$this->db->where("id", $currentData->id);
		$this->db->delete($this->_tableName);

		$code = 200;
		$message = "Success hard delete data user";
		$dataResponse = $currentData;
		$error = NULL;
		return $this->generateResponse($message, $dataResponse, $error, $code);
	}

	public function getValidationCreate() {
		$this->getValidationCreateUsername();
		$this->getValidationCreateEmail();
	}

	public function getValidationCreateUsername() {
		$this->form_validation->set_rules(
                'username', 'Username',
                'is_unique[users.username]',
                array(
                        'is_unique'     => 'This %s already exists.'
                )
        );
	}

	public function getValidationCreateEmail() {
        $this->form_validation->set_rules(
				'email', 'Email',
				'is_unique[users.email]',
				array(
						'is_unique'     => 'This %s already exists.'
				)
		);
	}
}
