<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserAddressModel extends MY_Model {

	private $_tableName = "user_address";

	public function createData($data = NULL, $token) {

		$dataUser = $this->generateDataJWT($token);

		$data['user_id'] = $dataUser->uuid;
		$data['uuid'] = $this->generateUUID();
		$data['created_at'] = $this->getCurrentDateTime();
		$data['updated_at'] = $this->getCurrentDateTime();

		$result = $this->db->insert($this->_tableName, $data);

		$code = 201;
		$message = "Success create new address";
		$dataResponse = $data;
		$error = NULL;
		return $this->generateResponse($message, $dataResponse, $error, $code);

	}

	public function getAllData($token = NULL)
	{
		if ($token) {
			$dataUser = $this->generateDataJWT($token);

			$this->db->where("user_id", $dataUser->uuid);
			$this->db->where("deleted_at", NULL);
			$data = $this->db->get($this->_tableName)->result();

			$code = 200;
			$message = "Success get list address user";
			$dataResponse = $data;
			$error = NULL;
			return $this->generateResponse($message, $dataResponse, $error, $code);
		} else {
			$code = 500;
			$message = "Failed create new address user";
			$dataResponse = NULL;
			$error["title"] = "Cannot Create address user";
			$error["message"] = "Please check your token";
			return $this->generateResponse($message, $dataResponse, $error, $code);
		}
	}

	public function getDataById($id)
	{
		$this->db->where("uuid", $id);
		$data = $this->db->get($this->_tableName)->row();

		$code = 200;
		$message = "Success get detail address";
		$dataResponse = $data;
		$error = NULL;
		return $this->generateResponse($message, $dataResponse, $error, $code);
	}

	public function updateData($id, $dataSave, $token) {
		$dataUser = $this->generateDataJWT($token);
		$dataTemp['is_primary'] = 0;
		$this->db->where('user_id', $dataUser->uuid);
		$this->db->update($this->_tableName, $dataTemp);

		$this->db->where("uuid", $id);
		$currentData = $this->db->get($this->_tableName)->row();

		$dataSave['updated_at'] = $this->getCurrentDateTime();

		$this->db->where('id', $currentData->id);
		$this->db->update($this->_tableName, $dataSave);

		$this->db->where("uuid", $id);
		$currentData = $this->db->get($this->_tableName)->row();

		$code = 200;
		$message = "Success update data address";
		$dataResponse = $currentData;
		$error = NULL;
		return $this->generateResponse($message, $dataResponse, $error, $code);

	}

	public function deteleSoftData($id) {
		$this->db->where("uuid", $id);
		$currentData = $this->db->get($this->_tableName)->row();

		$dataSave = array();
		$dataSave['deleted_at'] = $this->getCurrentDateTime();

		$this->db->where('id', $currentData->id);
		$this->db->update($this->_tableName, $dataSave);

		$code = 200;
		$message = "Success delete data order";
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
		$message = "Success hard delete data order";
		$dataResponse = $currentData;
		$error = NULL;
		return $this->generateResponse($message, $dataResponse, $error, $code);
	}

}
