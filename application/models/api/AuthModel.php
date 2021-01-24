<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class AuthModel extends MY_Model {

	public function loginApp($dataRequest) {
		$this->db->where("username", $dataRequest["username"]);
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
