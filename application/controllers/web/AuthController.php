<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

	function __construct()
	{
		// Construct the parent class
		parent::__construct();
		$this->data = array();

		$this->load->model('web/AuthModel', 'AuthModel');
	}

	public function index()
	{
		$this->load->view('web/template/blank', $this->data);
	}

	public function login()
	{
		$dataSave = $this->input->post();
		$result = $this->AuthModel->loginApp($dataSave);

		if ($result) {
			if ($result->access == 0) {
				if($result->account_status == 1) {
					$this->session->set_userdata('user_logged', $result);
					redirect(base_url('dashboard'));
				} else {
					$this->session->set_flashdata('error', 'Your account not active');
				}
			} else {
				$this->session->set_flashdata('error', 'You not have privilage');
			}
		} else {
			$this->session->set_flashdata('error', 'Wrong username / password please try again');
		}

		redirect(base_url('login'));
	}

	public function forgot()
	{
		$dataSave = $this->input->post();
		$this->session->set_flashdata('error', 'Please check your email for reset password');
		redirect(base_url('login'));
	}

}
