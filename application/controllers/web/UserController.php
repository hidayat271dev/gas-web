<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends MY_Controller
{

	public function index()
	{
		$this->data['content_view'] = 'web/user/user_list';
		$this->load->view('web/template/index', $this->data);
	}

	public function action()
	{
		$this->data['content_view'] = 'web/user/user_action';
		$this->load->view('web/template/index', $this->data);
	}

}
