<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderModel extends MY_Model {

	private $_tableName = "orders";

	public function getOrderByUUID($uuid)
	{
		$this->db->select("*," . $this->_tableName . ".uuid");
		$this->db->where($this->_tableName . ".uuid", $uuid);
		$this->db->join('users', $this->_tableName . '.user_id = users.uuid');
		$this->db->join('user_address', $this->_tableName . '.address_id = user_address.uuid', 'left');
		return $this->db->get($this->_tableName)->row();
	}

	public function getOrderDetail($uuid)
	{
		$this->db->select("*, order_details.qty");
		$this->db->where("order_id", $uuid);
		$this->db->join('products', 'products.uuid = order_details.product_id');
		return $this->db->get("order_details")->result();
	}

	public function saveData($data, $id) {

		if ($id) {
			$data['updated_at'] = $this->getCurrentDateTime();
			$this->db->where('uuid', $id);
			$this->db->update($this->_tableName, $data);
		}

		return true;
	}

	public function deteleSoftData($id)
	{
		$this->db->where("uuid", $id);
		$currentData = $this->db->get($this->_tableName)->row();

		$dataSave = array();
		$dataSave['deleted_at'] = $this->getCurrentDateTime();

		$this->db->where('id', $currentData->id);
		$this->db->update($this->_tableName, $dataSave);
	}
}
