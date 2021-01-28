<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends MY_Model {

    private $_tableName = "users";
    
    public function loginApp($dataRequest) {
        $this->db->where("phone", $dataRequest["username"]);
		$this->db->or_where("email", $dataRequest["username"]);
		$currentData = $this->db->get("users")->row();

		if ($currentData) {
			$isMatchPass = password_verify($dataRequest['password'], $currentData->password);

			if ($isMatchPass) {
                return $currentData;
            }
        } else {
            return NULL;
        }
    }
}
