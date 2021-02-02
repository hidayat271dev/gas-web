<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class AuthModel extends MY_Model {

	private $_tableName = "users";

	public function createRegisterUser($data) {
		$data['uuid'] = $this->generateUUID();
		$data['access'] = 1;
		$data['account_status'] = 1;
		$data['pic_profile'] = "https://jrlifesciences.com/wp-content/uploads/2018/09/gravatar.jpg";
		$data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
		$data['created_at'] = $this->getCurrentDateTime();
		$data['updated_at'] = $this->getCurrentDateTime();

		$result = $this->db->insert($this->_tableName, $data);

		$code = 201;
		$message = "Success create new user";
		$dataResponse = $data;
		$error = NULL;
		return $this->generateResponse($message, $dataResponse, $error, $code);
	}

	public function createForgotUser()
	{
		$code = 200;
		$message = "Success forgot user";
		$dataResponse = NULL;
		$error = NULL;
		return $this->generateResponse($message, $dataResponse, $error, $code);
	}

	public function loginApp($dataRequest) {
		$this->db->where("phone", $dataRequest["username"]);
		$this->db->or_where("email", $dataRequest["username"]);
		$currentData = $this->db->get("users")->row();

		if ($currentData) {
			$isMatchPass = password_verify($dataRequest['password'], $currentData->password);

			if ($isMatchPass) {

				if ($currentData->account_status == 0) {
					$code = 402;
					$message = "Failed login";
					$dataResponse = NULL;
					$error["title"] = "User cannot login";
					$error["message"] = "Please contact administrator, because your account not active";
					return $this->generateResponse($message, $dataResponse, $error, $code);
				} elseif ($currentData->account_status == -1) {
					$code = 402;
					$message = "Failed login";
					$dataResponse = NULL;
					$error["title"] = "User cannot login";
					$error["message"] = "Please contact administrator, because your account has been suspend";
					return $this->generateResponse($message, $dataResponse, $error, $code);
				} else {
					$dataResponse = array();

					$dataResponse['token'] = $this->generateJWT($currentData);
					$dataResponse['user'] = $currentData;

					$this->db->where("user_id", $currentData->uuid);
					$this->db->where("is_primary", 1);
					$dataResponse['current_address'] = $this->db->get("user_address")->row();

					$code = 200;
					$message = "Success Login";
					$error = NULL;
					return $this->generateResponse($message, $dataResponse, $error, $code);
				}
			} else {
				$code = 402;
				$message = "Failed login";
				$dataResponse = NULL;
				$error["title"] = "User cannot login";
				$error["message"] = "Please check again username/email or password combination";
				return $this->generateResponse($message, $dataResponse, $error, $code);
			}
		} else {
			$code = 402;
			$message = "Failed login";
			$dataResponse = NULL;
			$error["title"] = "User cannot login";
			$error["message"] = "Username or email not available";
			return $this->generateResponse($message, $dataResponse, $error, $code);
		}
	}

	public function generateJWT($data)
	{
		$key = $this->config->item('encryption_key');
		$jwt = JWT::encode($data, $key);

		return $jwt;
	}

	public function getValidationLogin() {
		$this->form_validation->set_rules(
				'username', 'Username',
				'required',
				array(
						'required' => 'You must provide a %s.',
				)
		);

		$this->form_validation->set_rules(
				'password', 'Password',
				'required',
				array(
						'required' => 'You must provide a %s.',
				)
		);
	}

}
