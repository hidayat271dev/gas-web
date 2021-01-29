<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductModel extends MY_Model {

	private $_tableName = "products";

	public function getNewData()
	{
		$dataProduct = new stdClass();
		$dataProduct->uuid = NULL;
		$dataProduct->name = NULL;
		$dataProduct->qty = NULL;
		$dataProduct->short_desc = NULL;
		$dataProduct->status_product = 0;
		$dataProduct->sale_price = NULL;
		$dataProduct->img_cover = NULL;
		$dataProduct->img_gallery = NULL;
		$dataProduct->desc = NULL;
		return $dataProduct;
	}

	public function getProductByUUID($uuid)
	{
		$this->db->where("uuid", $uuid);
		return $this->db->get($this->_tableName)->row();
	}

	public function saveData($data, $id) {

		if ($id) {
			$data['updated_at'] = $this->getCurrentDateTime();
			$this->db->where('uuid', $id);
			$this->db->update($this->_tableName, $data);
		} else {
			$data['uuid'] = $this->generateUUID();
			$data['created_at'] = $this->getCurrentDateTime();
			$data['updated_at'] = $this->getCurrentDateTime();
			$this->db->insert($this->_tableName, $data);
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
