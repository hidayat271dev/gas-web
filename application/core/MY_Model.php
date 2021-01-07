<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Ramsey\Uuid\Uuid;

class MY_Model extends CI_model {

	function __construct()
	{
		// Construct the parent class
		parent::__construct();

		$this->dataApi = array();
	}

	public function generateUUID() {
		return Uuid::uuid4();
	}

	public function getCurrentDateTime($pattern = 'Y-m-d H:i:s') {
		return date($pattern);
	}

	public function generateResponse($message, $data, $error, $code) {
		$response["response"]["message"] = $message;
		$response["response"]["data"] = $data;
		$response["response"]["error"] = $error;
		$response["code"] = $code;
		return $response;
	}
}
