<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderModelV2 extends MY_Model {

	private $_tableName = "orders";

	public function getData($pagination, $query, $sort) {
		$sortType = 'asc';
		$sortField = 'id';

		$page = intval($pagination['page']);
		$totalRows = $this->getCountAllData($query);
		$perpage = intval($pagination['perpage']);
		$numPages = ceil($totalRows / $perpage);
		$offset = ($page * $perpage) - $perpage;
		if ($offset < 0) $offset = 0;

		if ($page > $numPages) $page = $numPages;

		if (isset($sort['sort'])) {
			$sortType = $sort['sort'];
		}

		if (isset($sort[''])) {
			$sortField = $sort['field'];
		}

		$from = $this->db->from($this->_tableName);
		$from->join('users', $this->_tableName . '.user_id = users.uuid');
		$from->select( $this->_tableName . '.id, ' . $this->_tableName . '.uuid, fullname, email, phone, order_number');

		if (isset($query['generalSearch'])) {

			$search = $query['generalSearch'];
			$from
				->group_start()
				->like('order_number', $search)
				->or_like('fullname', $search)
				->or_like('email', $search)
				->group_end();
		}

		if (isset($query['order_status'])) {
			$from->where("order_status", intval($query['order_status']));
		} else {
			$from->where("order_status", 0);
		}

		$from->where($this->_tableName .".deleted_at", NULL);
	 	$from->order_by($sortField, $sortType);
		$from->limit($perpage, $offset);
		$data = $from->get()->result();

		$code = 200;
		$message = "Success get list product";
		$dataResponse = $data;
		$dataMeta =  array(
			'page' => $page,
			'pages' => $numPages,
			'perpage' => $perpage,
			'total' => $totalRows,
			'sort' => $sortType,
			'field' => $sortField,
		);
		$error = NULL;
		return $this->generateResponse($message, $dataResponse, $error, $code, $dataMeta);
	}

	public function getCountAllData($query) {
		$from = $this->db->from($this->_tableName);
		$from->join('users', $this->_tableName . '.user_id = users.uuid');

		if (isset($query['generalSearch'])) {

			$search = $query['generalSearch'];
			$from
				->group_start()
				->like('order_number', $search)
				->or_like('fullname', $search)
				->or_like('email', $search)
				->group_end();
		}

		if (isset($query['order_status'])) {
			$from->where("order_status", intval($query['order_status']));
		} else {
			$from->where("order_status", 0);
		}

		$from->where($this->_tableName .".deleted_at", NULL);
		return $from->get()->num_rows();
	}

}
