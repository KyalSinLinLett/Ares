<?php

	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../dbconnector/Database.php';
	include_once '../../models/User.php';

	//Instantiate DB
	$database = new Database();
	$db = $database->connect();

	//Instantiate a user object
	$user = new User($db);

	//get user id
	$user->id = isset($_REQUEST['id']) ? $_REQUEST['id'] : die();

	//perform a get user query
	$user->get_user();

	//create array for user data
	$user_info_array = array(
		'id' => $user->id,
		'name' => $user->name,
		'email' => $user->email,
		'birthday' => $user->birthday,
		'profession' => $user->profession,
		'biography' => $user->biography,
		'created_at' => $user->created_at
	);

	print_r(json_encode($user_info_array));

?>