<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderModel extends MY_Model {

	private $_tableName = "orders";

	public function createData($token = NULL, $data) {
		if ($token) {

			$dataUser = $this->generateDataJWT($token);

			$data['order_number'] = $this->generateNewOrderNumber($dataUser->uuid);
			$data['uuid'] = $this->generateUUID();
			$data['user_id'] = $dataUser->uuid;
			$data['created_at'] = $this->getCurrentDateTime();
			$data['updated_at'] = $this->getCurrentDateTime();

			$result = $this->db->insert($this->_tableName, $data);

			$code = 201;
			$message = "Success create new order";
			$dataResponse = $data;
			$error = NULL;
			return $this->generateResponse($message, $dataResponse, $error, $code);

		} else {
			$code = 500;
			$message = "Failed create new product";
			$dataResponse = NULL;
			$error["title"] = "Cannot Create product";
			$error["message"] = "Please check your token";
			return $this->generateResponse($message, $dataResponse, $error, $code);
		}
	}

	public function getAllData()
	{
		$this->db->where("deleted_at", NULL);
		$data = $this->db->get($this->_tableName)->result();

		$code = 200;
		$message = "Success get list order";
		$dataResponse = $data;
		$error = NULL;
		return $this->generateResponse($message, $dataResponse, $error, $code);
	}

	public function getDataById($id)
	{
		$this->db->where("uuid", $id);
		$data = $this->db->get($this->_tableName)->row();

		$code = 200;
		$message = "Success get detail order";
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

		$this->db->where("uuid", $id);
		$currentData = $this->db->get($this->_tableName)->row();

		$code = 200;
		$message = "Success update data order";
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

	public function generateNewOrderNumber($token)
	{
		$orderNumber = $this->getCurrentDateTime('Ymd');
		$idUser = explode("-", $token);
		$idUser = $idUser[0];

		$this->db->like('order_number', $orderNumber);
		$countOrder = $this->db->count_all_results($this->_tableName) + 1;

		return $orderNumber . '-' . $idUser . '-' . '000' . $countOrder;
	}
}
