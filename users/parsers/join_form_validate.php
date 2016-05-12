<?php
require_once '../init.php';
$db = DB::getInstance();
$settingsQ = $db->query("SELECT * FROM settings");
$settings = $settingsQ->first();
$validation = new Validate();
$validation->check($_POST,array(
  'username' => array(
    'display' => 'Username',
    'required' => true,
    'min' => 2,
    'max' => 35,
  ),
  'fname' => array(
    'display' => 'First Name',
		'required' => true,
		'min' => 2,
		'max' => 35,
  ),
  'lname' => array(
    'display' => 'Last Name',
    'required' => true,
    'min' => 2,
    'max' => 35,
  ),
  'email' => array(
    'display' => 'Email',
    'required' => true,
    'valid_email' => true,
    'unique' => 'users',
  ),
  'company' => array(
    'display' => 'Company Name',
    'required' => false,
    'min' => 2,
    'max' => 75,
  ),
  'password' => array(
    'display' => 'Password',
    'required' => true,
    'min' => 6,
    'max' => 25,
  ),
  'confirm' => array(
    'display' => 'Confirm Password',
    'required' => true,
    'matches' => 'password',
  ),
));

if($validation->passed()){
	echo 'success';
}else{
	echo display_errors($validation->errors());
}
