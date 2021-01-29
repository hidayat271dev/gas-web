<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends MY_Controller
{

	public function __construct()
	{
		// Construct the parent class
		parent::__construct();
		$this->load->model('web/UserModel', 'UserModel');
	}

	public function index()
	{
		$this->data['content_view'] = 'web/user/user_list';
		$this->data['content_script'] = array('user_list');
		$this->load->view('web/template/index', $this->data);
	}

	public function action($id = NULL)
	{
		if ($id) {
			$dataUser = $this->UserModel->getUserByUUID($id);
		} else {
			$dataUser = $this->UserModel->getNewData();
		}

		$this->data['data_user'] = $dataUser;
		$this->data['content_view'] = 'web/user/user_action';
		$this->load->view('web/template/index', $this->data);
	}

	public function detail($id) {
		$this->data['data_user'] = $this->UserModel->getUserByUUID($id);
		$this->data['content_view'] = 'web/user/user_detail';
		$this->load->view('web/template/index', $this->data);
	}

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function save($id = null) {
		$dataRequest = $this->input->post();

		$this->UserModel->saveData($dataRequest, $id);

		if ($id) {
			$this->session->set_flashdata('alert', 'Your data have been update');
		} else {
			$this->session->set_flashdata('alert', 'Your data have been insert');
		}

		redirect('user');
	}

	public function delete($id)
	{
		$this->UserModel->deteleSoftData($id);
		$this->session->set_flashdata('alert', 'Your data have been delete');
		redirect('user');
	}

}
