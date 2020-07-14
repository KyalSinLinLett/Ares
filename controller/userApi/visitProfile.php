<?php

	// header('Access-Control-Allow-Origin: *');
	// header('Access-Control-Allow-Method: GET');
	// header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Access-Control-Allow-Header, Authorization, X-Requested-With');

	include_once '../dbconnector/Database.php';
	include_once '../models/User.php';

	//Instantiate DB
	$database = new Database();
	$db = $database->connect();

	//Instantiate a user object
	$user = new User($db);

	//get user id
	$user->id = isset($_GET['posted_by']) ? $_GET['posted_by'] : die();

	//perform a get user query
	$user = $user->get_user();	

	$name = $user['name'];
	$email = $user['email'];
	$birthday = $user['birthday'];
	$profession = $user['profession'];
	$biography = $user['biography'];	
?>