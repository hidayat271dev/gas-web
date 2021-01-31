<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends MY_Controller
{

	public function index()
	{
		$this->data['content_view'] = 'web/dashboard/dashboard';
		$this->load->view('web/template/index', $this->data);
	}

}
