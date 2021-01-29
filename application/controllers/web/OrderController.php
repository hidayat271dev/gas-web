<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderController extends MY_Controller
{

	public function index()
	{
		$this->data['content_view'] = 'web/order/order_list';
		$this->load->view('web/template/index', $this->data);
	}

	public function detail()
	{
		$this->data['content_view'] = 'web/order/order_detail';
		$this->load->view('web/template/index', $this->data);
	}

}
