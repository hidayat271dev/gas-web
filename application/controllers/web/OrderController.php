<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderController extends MY_Controller
{
	public function __construct()
	{
		// Construct the parent class
		parent::__construct();
		$this->load->model('web/OrderModel', 'OrderModel');
	}

	public function index()
	{
		$this->data['content_view'] = 'web/order/order_list';
		$this->data['content_script'] = array('order_list');
		$this->load->view('web/template/index', $this->data);
	}

	public function detail($id)
	{
		$this->data['data_order'] = $this->OrderModel->getOrderByUUID($id);
		$this->data['data_order_detail'] = $this->OrderModel->getOrderDetail($id);

		$this->data['content_view'] = 'web/order/order_detail';
		$this->load->view('web/template/index', $this->data);
	}

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function confirm($id)
	{
		$data_save['order_status'] = 1;
		$this->OrderModel->saveData($data_save, $id);
		$this->session->set_flashdata('alert', 'Your data have been update');
		redirect('order');
	}

	public function delete($id)
	{
		$this->OrderModel->deteleSoftData($id);
		$this->session->set_flashdata('alert', 'Your data have been delete');
		redirect('order');
	}

}
