<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*
| -------------------------------------------------------------------------
| API URI ROUTING
| -------------------------------------------------------------------------
*/

// Authentication Endpoint
$route['api/v1/login']['POST'] = 'api/AuthController/index';

// Users Endpoint
$route['api/v1/users']['GET'] = 'api/UserController/index';
$route['api/v1/users']['POST'] = 'api/UserController/index';
$route['api/v1/users/(:any)']['GET'] = 'api/UserController/detail/$1';
$route['api/v1/users/(:any)']['POST'] = 'api/UserController/update/$1';
$route['api/v1/users/(:any)']['DELETE'] = 'api/UserController/deletesoft/$1';
$route['api/v1/users/drop/(:any)']['DELETE'] = 'api/UserController/deletehard/$1';

// Product Endpoint
$route['api/v1/products']['GET'] = 'api/ProductController/index';
$route['api/v1/products']['POST'] = 'api/ProductController/index';
$route['api/v1/products/(:any)']['GET'] = 'api/ProductController/detail/$1';
$route['api/v1/products/(:any)']['POST'] = 'api/ProductController/update/$1';
$route['api/v1/products/(:any)']['DELETE'] = 'api/ProductController/deletesoft/$1';
$route['api/v1/products/drop/(:any)']['DELETE'] = 'api/ProductController/deletehard/$1';

// Order Endpoint
$route['api/v1/orders']['GET'] = 'api/OrderController/index';
$route['api/v1/orders']['POST'] = 'api/OrderController/index';
$route['api/v1/orders/(:any)']['GET'] = 'api/OrderController/detail/$1';
$route['api/v1/orders/(:any)']['POST'] = 'api/OrderController/update/$1';
$route['api/v1/orders/(:any)']['DELETE'] = 'api/OrderController/deletesoft/$1';
$route['api/v1/orders/drop/(:any)']['DELETE'] = 'api/OrderController/deletehard/$1';
