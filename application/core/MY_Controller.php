<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_controller {

	function __construct()
	{
		// Construct the parent class
		parent::__construct();
		$this->data = array();
	}

}
