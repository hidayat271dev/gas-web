<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;


class Welcome extends CI_controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		redirect('template');
		$key = "example_key";
		$payload = array(
			"iss" => "http://example.org",
			"aud" => "http://example.com",
			"iat" => 1356999524,
			"nbf" => 1357000000
		);
		$jwt = JWT::encode($payload, $key);

		print_r($jwt);

        $decoded = JWT::decode($jwt, $key, array('HS256'));

        print_r($decoded);

        $decoded_array = (array) $decoded;

        JWT::$leeway = 60; // $leeway in seconds
        $decoded = JWT::decode($jwt, $key, array('HS256'));

        print_r($decoded_array);
        print_r($decoded);

        var_dump($this->input->get_request_header('Authorization'));
	}
}
