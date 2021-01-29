<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Ramsey\Uuid\Uuid;
use \Firebase\JWT\JWT;

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

	public function generateJWT($data)
	{
		$key = $this->config->item('encryption_key');
		$jwt = JWT::encode($data, $key);

		return $jwt;
	}

	public function generateDataJWT($token)
	{
		$key = $this->config->item('encryption_key');
		$decoded = JWT::decode($token, $key, array('HS256'));

		return $decoded;
	}

	public function generateResponse($message, $data, $error, $code, $meta = NULL) {
		$response["response"]["message"] = $message;
		$response["response"]["data"] = $data;
		$response["response"]["error"] = $error;
		if ($meta) $response["response"]["meta"] = $meta;
		$response["code"] = $code;
		return $response;
	}
}
