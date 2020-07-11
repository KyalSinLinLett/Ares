<?php

	session_start();
	header('Access-Control-Allow-Origin: *');
	include_once '../dbconnector/Database.php';
	include_once '../models/User.php';

	//Instantiate DB
	$database = new Database();
	$db = $database->connect();

	//Instantiate a user object
	$user = new User($db);

	//get user id
	$user->id = isset($_GET['user_id']) ? $_GET['user_id'] : die();

	//perform a get user query
	$user = $user->get_user();	

	$name = $user['name'];
	$email = $user['email'];
	$birthday = $user['birthday'];
	$profession = $user['profession'];
	$biography = $user['biography'];	
?>