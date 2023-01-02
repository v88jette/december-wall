<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'users';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

# user routes
$route['login']             = 'users/index';
$route['process_login']     = 'users/process_login';
$route['signup']            = 'users/signup';
$route['process_signup']    = 'users/process_signup';

# post routes
$route['home']              = 'posts/index';
$route['logout']            = 'posts/logout';
$route['post']              = 'posts/create';
$route['delete_post']       = 'posts/destroy';

# reply routes
$route['reply']             = 'replies/create';
$route['delete_reply']      = 'replies/destroy';
