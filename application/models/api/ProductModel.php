<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductModel extends MY_Model {

	private $_tableName = "products";

	public function createData($data = NULL) {
		if ($data) {

			$data['uuid'] = $this->generateUUID();
			$data['created_at'] = $this->getCurrentDateTime();
			$data['updated_at'] = $this->getCurrentDateTime();

			$result = $this->db->insert($this->_tableName, $data);

			$code = 201;
			$message = "Success create new product";
			$dataResponse = $data;
			$error = NULL;
			return $this->generateResponse($message, $dataResponse, $error, $code);

		} else {
			$code = 500;
			$message = "Failed create new product";
			$dataResponse = NULL;
			$error["title"] = "Cannot Create product";
			$error["message"] = "Please double check the data to be stored, because the system has detected an empty data";
			return $this->generateResponse($message, $dataResponse, $error, $code);
		}
	}

	public function getAllData()
	{
		$this->db->where("deleted_at", NULL);
		$data = $this->db->get($this->_tableName)->result();

		$code = 200;
		$message = "Success get list product";
		$dataResponse = $data;
		$error = NULL;
		return $this->generateResponse($message, $dataResponse, $error, $code);
	}

	public function getDataById($id)
	{
		$this->db->where("uuid", $id);
		$data = $this->db->get($this->_tableName)->row();

		$code = 200;
		$message = "Success get detail product";
		$dataResponse = $data;
		$error = NULL;
		return $this->generateResponse($message, $dataResponse, $error, $code);
	}

	public function updateData($id, $dataSave) {
		$this->db->where("uuid", $id);
		$currentData = $this->db->get($this->_tableName)->row();

		$dataSave['updated_at'] = $this->getCurrentDateTime();

		$this->db->where('id', $currentData->id);
		$this->db->update($this->_tableName, $dataSave);

		$code = 200;
		$message = "Success update data product";
		$dataResponse = $dataSave;
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
		$message = "Success delete data product";
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
		$message = "Success hard delete data product";
		$dataResponse = $currentData;
		$error = NULL;
		return $this->generateResponse($message, $dataResponse, $error, $code);
	}

}
