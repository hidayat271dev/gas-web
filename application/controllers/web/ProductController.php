<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends MY_Controller
{
	public function __construct()
	{
		// Construct the parent class
		parent::__construct();
		$this->load->model('web/ProductModel', 'ProductModel');
	}

	public function index()
	{
		$this->data['content_view'] = 'web/product/product_list';
		$this->data['content_script'] = array('product_list');
		$this->load->view('web/template/index', $this->data);
	}

	public function action($id = NULL)
	{
		if ($id) {
			$dataProduct = $this->ProductModel->getProductByUUID($id);
		} else {
			$dataProduct = $this->ProductModel->getNewData();
		}

		$this->data['data_product'] = $dataProduct;
		$this->data['content_view'] = 'web/product/product_action';
		$this->load->view('web/template/index', $this->data);
	}

	public function detail($id) {
		$this->data['data_product'] = $this->ProductModel->getProductByUUID($id);
		$this->data['content_view'] = 'web/product/product_detail';
		$this->load->view('web/template/index', $this->data);
	}

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function save($id = null) {
		$dataRequest = $this->input->post();

		$this->ProductModel->saveData($dataRequest, $id);

		if ($id) {
			$this->session->set_flashdata('alert', 'Your data have been update');
		} else {
			$this->session->set_flashdata('alert', 'Your data have been insert');
		}

		redirect('product');
	}

	public function delete($id)
	{
		$this->ProductModel->deteleSoftData($id);
		$this->session->set_flashdata('alert', 'Your data have been delete');
		redirect('product');
	}

}
