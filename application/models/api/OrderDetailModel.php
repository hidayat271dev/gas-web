<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderDetailModel extends MY_Model {

	private $_tableName = "order_details";

	/*
    | -------------------------------------------------------------------------
    | Function for Order
    | -------------------------------------------------------------------------
    */

	public function createOrderDetailByOrder($orderId, $userId, $item, $qty)
	{
		for ($idx = 0; $idx < count($item); $idx++) {
			$this->db->where("uuid", $item[$idx]);
			$dataProduct = $this->db->get('products')->row();

			$saveData = array();
			$saveData["uuid"] = $this->generateUUID();
			$saveData["order_id"] = $orderId;
			$saveData["qty"] = $qty[$idx];
			$saveData["product_id"] = $dataProduct->uuid;
			$saveData["price"] = $dataProduct->sale_price;
			$saveData["created_at"] = $this->getCurrentDateTime();
			$saveData["updated_at"] = $this->getCurrentDateTime();

			$result = $this->db->insert($this->_tableName, $saveData);

			$dataUpdate['qty'] = $dataProduct->qty - $qty[$idx];
			$this->db->where('id', $dataProduct->id);
			$this->db->update("products", $dataUpdate);
		}
	}

	public function getOrderDetailByOrder($orderId)
	{
		$this->db->select("*, " . $this->_tableName . ".qty, " . $this->_tableName . ".price AS sale_price");
		$this->db->where("order_id", $orderId);
		$this->db->join('products', 'products.uuid = ' . $this->_tableName . '.product_id');
		$data = $this->db->get($this->_tableName)->result();
		return $data;
	}

}
