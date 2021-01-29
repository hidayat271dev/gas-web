<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModelV2 extends MY_Model {

	private $_tableName = "users";

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

		if (isset($query['generalSearch'])) {

			$search = $query['generalSearch'];
			$from
				->group_start()
				->like('fullname', $search)
				->or_like('email', $search)
				->or_like('phone', $search)
				->group_end();
		}

		if (isset($query['account_status'])) {
			$from->where("account_status", intval($query['account_status']));
		} else {
			$from->where("account_status", 1);
		}

		$from->where("deleted_at", NULL);
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

		if (isset($query['generalSearch'])) {

			$search = $query['generalSearch'];
			$from
				->group_start()
				->like('fullname', $search)
				->or_like('email', $search)
				->or_like('phone', $search)
				->group_end();
		}

		if (isset($query['account_status'])) {
			$from->where("account_status", intval($query['account_status']));
		} else {
			$from->where("account_status", 1);
		}

		$from->where("deleted_at", NULL);
		return $from->get()->num_rows();
	}
}
