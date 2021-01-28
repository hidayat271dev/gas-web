<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class CategoryController extends RestController {

	function __construct()
	{
		// Construct the parent class
		parent::__construct();
	}

	public function index_get()
	{
		$response["response"]["message"] = "Success get categories";
		$response["response"]["data"] = array(
			array(
				"id" => 1,
				"name" => "Kategori 1",
				"count_item" => 23,
				"image" => ""
			),
						array(
            				"id" => 1,
            				"name" => "Kategori 1",
            				"count_item" => 23,
            				"image" => ""
            			),
            						array(
                        				"id" => 1,
                        				"name" => "Kategori 1",
                        				"count_item" => 23,
                        				"image" => ""
                        			),
                        						array(
                                    				"id" => 1,
                                    				"name" => "Kategori 1",
                                    				"count_item" => 23,
                                    				"image" => ""
                                    			),
                                    						array(
                                                				"id" => 1,
                                                				"name" => "Kategori 1",
                                                				"count_item" => 23,
                                                				"image" => ""
                                                			),
                                                						array(
                                                            				"id" => 1,
                                                            				"name" => "Kategori 1",
                                                            				"count_item" => 23,
                                                            				"image" => ""
                                                            			),
                                                            						array(
                                                                        				"id" => 1,
                                                                        				"name" => "Kategori 1",
                                                                        				"count_item" => 23,
                                                                        				"image" => ""
                                                                        			),
                                                                        						array(
                                                                                    				"id" => 1,
                                                                                    				"name" => "Kategori 1",
                                                                                    				"count_item" => 23,
                                                                                    				"image" => ""
                                                                                    			),
                                                                                    						array(
                                                                                                				"id" => 1,
                                                                                                				"name" => "Kategori 1",
                                                                                                				"count_item" => 23,
                                                                                                				"image" => ""
                                                                                                			),
                                                                                                						array(
                                                                                                            				"id" => 1,
                                                                                                            				"name" => "Kategori 1",
                                                                                                            				"count_item" => 23,
                                                                                                            				"image" => ""
                                                                                                            			),
		);
		$response["response"]["error"] = NULL;
		$response["code"] = 200;

		$this->response( $response["response"], $response["code"] );
	}

}
