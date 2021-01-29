<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends MY_Model {

	private $_tableName = "users";

	public function getNewData()
	{
		$dataUser = new stdClass();
		$dataUser->uuid = NULL;
		$dataUser->fullname = NULL;
		$dataUser->email = NULL;
		$dataUser->password = NULL;
		$dataUser->phone = NULL;
		$dataUser->access = NULL;
		$dataUser->account_status = 0;
		$dataUser->pic_profile = NULL;
		return $dataUser;
	}

	public function getUserByUUID($uuid)
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
