<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends MY_Controller {

	public function index()
	{
		$this->load->view('web/template/index', $this->data);
	}

}
